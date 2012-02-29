<?php

function getHost($Address) { 
   $parseUrl = parse_url(trim($Address)); 
   return trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2))); 
} 

function timespan($seconds = 1, $time = '') {
	if ( ! is_numeric($seconds))
	{
		$seconds = 1;
	}

	if ( ! is_numeric($time))
	{
		$time = time();
	}

	if ($time <= $seconds)
	{
		$seconds = 1;
	}
	else
	{
		$seconds = $time - $seconds;
	}

	$str = '';
	$years = floor($seconds / 31536000);

	if ($years > 0)
	{
		$str .= $years.' '.((($years	> 1) ? 'lata' : 'rok')).', ';
	}

	$seconds -= $years * 31536000;
	$months = floor($seconds / 2628000);

	if ($years > 0 OR $months > 0)
	{
		if ($months > 0)
		{
			$str .= $months.' '.((($months	> 1) ? 'miesięcy' : 'miesiąc')).', ';
		}

		$seconds -= $months * 2628000;
	}

	$weeks = floor($seconds / 604800);

	if ($years > 0 OR $months > 0 OR $weeks > 0)
	{
		if ($weeks > 0)
		{
			$str .= $weeks.' ';
			if($weeks==1) $str .= 'tydzień';
			elseif($weeks>=2&&$weeks<=4) $str .= 'tygodnie';
			else $str .= 'tygodni';
			$str .= ' i ';
		}

		$seconds -= $weeks * 604800;
	}

	$days = floor($seconds / 86400);

	if ($months > 0 OR $weeks > 0 OR $days > 0)
	{
		if ($days > 0)
		{
			$str .= $days.' '.((($days	> 1) ? 'dni' : 'dzień')).', ';
		}

		$seconds -= $days * 86400;
	}


	return $days>0?substr(trim($str), 0, -1) .' temu':'dzisiaj';
}

function timespan2($seconds = 1, $time = '') {
	if ( ! is_numeric($seconds))
	{
		$seconds = 1;
	}

	if ( ! is_numeric($time))
	{
		$time = time();
	}

	if ($time <= $seconds)
	{
		$seconds = 1;
	}
	else
	{
		$seconds = $time - $seconds;
	}

	$str = '';
	$years = floor($seconds / 31536000);

	if ($years > 0)
	{
		$str .= $years.' '.((($years	> 1) ? 'lata' : 'rok')).', ';
	}

	$seconds -= $years * 31536000;
	$months = floor($seconds / 2628000);

	if ($years > 0 OR $months > 0)
	{
		if ($months > 0)
		{
			$str .= $months.' '.((($months	> 1) ? 'miesięcy' : 'miesiąc')).', ';
		}

		$seconds -= $months * 2628000;
	}

	$weeks = floor($seconds / 604800);

	if ($years > 0 OR $months > 0 OR $weeks > 0)
	{
		if ($weeks > 0)
		{
			$str .= $weeks.' '.((($weeks	> 1) ? 'tygodni' : 'tydzień')).', ';
		}

		$seconds -= $weeks * 604800;
	}

	$days = floor($seconds / 86400);

	if ($months > 0 OR $weeks > 0 OR $days > 0)
	{
		if ($days > 0)
		{
			$str .= $days.' '.((($days	> 1) ? 'dni' : 'dzień')).', ';
		}

		$seconds -= $days * 86400;
	}

	$hours = floor($seconds / 3600);

	if ($days > 0 OR $hours > 0)
	{
		if ($hours > 0)
		{
			$str .= $hours.' '.((($hours	> 1) ? 'godzin' : 'godzinę')).', ';
		}

		$seconds -= $hours * 3600;
	}

	$minutes = floor($seconds / 60);

	if ($days > 0 OR $hours > 0 OR $minutes > 0)
	{
		if ($minutes > 0)
		{
			$str .= $minutes.' '.((($minutes	> 1) ? 'minut' : 'minutę')).', ';
		}

		$seconds -= $minutes * 60;
	}

	if ($str == '')
	{
		$str .= $seconds.' '.((($seconds	> 1) ? 'sekund' : 'sekundę')).', ';
	}

	return substr(trim($str), 0, -1);
}

function getBrowser() { 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return $ub;
}

function formatTime($ts) {
	return date("d/m/Y H:i", strtotime($ts));
}

function conjunction($str) {
   return preg_replace('/ ([a-z]{1}) /', " $1&nbsp;", $str);
}

function character_limiter($str, $n = 500, $end_char = '&#8230;') {
	if (strlen($str) < $n)
	{
		return $str;
	}
	
	$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

	if (strlen($str) <= $n)
	{
		return $str;
	}

	$out = "";
	foreach (explode(' ', trim($str)) as $val)
	{
		$out .= $val.' ';
		
		if (strlen($out) >= $n)
		{
			$out = trim($out);
			return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
		}		
	}
}

function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
	if (trim($str) == '')
	{
		return $str;
	}

	preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);
		
	if (strlen($str) == strlen($matches[0]))
	{
		$end_char = '';
	}
	
	return rtrim($matches[0]).$end_char;
}

function word_wrap($str, $charlim = '76') {
	// Se the character limit
	if ( ! is_numeric($charlim))
		$charlim = 76;

	// Reduce multiple spaces
	$str = preg_replace("| +|", " ", $str);

	// Standardize newlines
	if (strpos($str, "\r") !== FALSE)
	{
		$str = str_replace(array("\r\n", "\r"), "\n", $str);			
	}

	// If the current word is surrounded by {unwrap} tags we'll 
	// strip the entire chunk and replace it with a marker.
	$unwrap = array();
	if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches))
	{
		for ($i = 0; $i < count($matches['0']); $i++)
		{
			$unwrap[] = $matches['1'][$i];				
			$str = str_replace($matches['1'][$i], "{{unwrapped".$i."}}", $str);
		}
	}

	// Use PHP's native function to do the initial wordwrap.  
	// We set the cut flag to FALSE so that any individual words that are 
	// too long get left alone.  In the next step we'll deal with them.
	$str = wordwrap($str, $charlim, "\n", FALSE);

	// Split the string into individual lines of text and cycle through them
	$output = "";
	foreach (explode("\n", $str) as $line) 
	{
		// Is the line within the allowed character count?
		// If so we'll join it to the output and continue
		if (strlen($line) <= $charlim)
		{
			$output .= $line."\n";			
			continue;
		}
		
		$temp = '';
		while((strlen($line)) > $charlim) 
		{
			// If the over-length word is a URL we won't wrap it
			if (preg_match("!\[url.+\]|://|wwww.!", $line))
			{
				break;
			}

			// Trim the word down
			$temp .= substr($line, 0, $charlim-1);
			$line = substr($line, $charlim-1);
		}
	
		// If $temp contains data it means we had to split up an over-length 
		// word into smaller chunks so we'll add it back to our current line
		if ($temp != '')
		{
			$output .= $temp . "\n" . $line; 
		}
		else
		{
			$output .= $line;
		}

		$output .= "\n";
	}

	// Put our markers back
	if (count($unwrap) > 0)
	{	
		foreach ($unwrap as $key => $val)
		{
			$output = str_replace("{{unwrapped".$key."}}", $val, $output);
		}
	}

	// Remove the unwrap tags
	$output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

	return $output;	
}

function custom_wrap($string, $max_length=15) {
     $separate_words = explode(" ", $string);

     for($i = 0; $i < count($separate_words); $i++) {
		if(strlen($separate_words[$i]) > $max_length) {
			$separate_words_new[] = substr($separate_words[$i], 0, $max_length);
		} else {
			$separate_words_new[] = $separate_words[$i];
		}
     }

     $string = implode(" ", $separate_words_new);
     return $string;
}

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}

function strpos_array($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = strpos_array($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return $pos;
            }
        }
    } else {
        return strpos($haystack, $needles);
    }
}

function countDays($date) {
	list($y,$d,$m) = explode('/',$date);
	$today = time();
	$event = mktime(0,0,0,$m,$d,$y);
	$apart = $event - $today;
	if ($apart >= -86400)
	{
		$myevent = $event;
	}
	else
	{
		  $myevent = mktime(09,0,0,$m,$d,$y);
	}
	$countdown = round(($myevent - $today)/86400);
	if ($countdown > 1)
	{
		  return "za $countdown dni";
	}
	elseif (($myevent-$today) <= 0 && ($myevent-$today) >= -86400)
	{
		  return "dzisiaj!";
	}
	else
	{
		  return "jutro!";
	}
}

?>

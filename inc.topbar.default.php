<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
      		<ul class="nav">
				<li><a class="brandx" href="/"><?php echo $config['app']['title']; ?></a></li>
				<?php if($is_signin) {?>
        		<li class="<?php echo in_array($sammy->segment(2), array('pages'))?'active':''; ?>"><a href="/cms/pages">Strony</a></li>
        		<li class="<?php echo in_array($sammy->segment(2), array('blog'))?'active':''; ?>"><a href="/cms/blog">Blog</a></li>
        		<li class="<?php echo in_array($sammy->segment(2), array('comments'))?'active':''; ?>"><a href="/cms/comments">Komentarze</a></li>
        		<!-- <li class="<?php echo in_array($sammy->segment(2), array('templates'))?'active':''; ?>"><a href="/cms/templates">Szablony</a></li> -->
        		<li class="dropdown">
					<a href="#" class="dropdown-toggle"data-toggle="dropdown">Narzędzia <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<!-- <li><a href="#">Sprawdź strukturę plików...</a></li> -->
						<li><a href="/cms/backup">Wykonaj kopię zapasową...</a></li>
						<li class="divider"></li>
						<li><a href="/cms/install">Reinstalacja aplikacji...</a></li>
					</ul>
				</li>
				<?php } ?>
      		</ul>

			<?php if($is_signin) {?>
     		<ul class="nav pull-right">
				<li class="divider-vertical"></li>
				<li><a href="/cms/logout">Wyloguj się</a></li>
      		</ul>
			<?php } ?>
		</div>
	</div>
</div>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		
		<!-- google font -->
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,400italic,700' rel='stylesheet' type='text/css'>
		

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class( $class ); ?>>
		<nav class="navbar navbar-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class="logo img-responsive" alt="logo" />
						<img src="<?php echo get_template_directory_uri(); ?>/img/small-logo.png" class="sticky-logo img-responsive" alt="sticky logo" />
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

					<!--<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Home</a></li>
						<li><a href="#">Adout</a></li>
						<li><a href="#">Services</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</li>
						<li><a href="#">Blog</a></li>
						<li>
							<form class="search hidden-xs">
							  <div class="search-wrapper">
								<input type="text" placeholder="Search" class="search-input"/><span class="ion-ios-search-strong"></span>
							  </div>
							</form>
						</li>
					</ul>-->
					
					<?php
						wp_nav_menu( array(
							'menu'              => __( 'Primay Menu', 'joker'),
							'theme_location'    => 'primarymenu',
							'depth'             => 4,
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'bestblog_default_menu',
							'walker'            => new wp_bootstrap_navwalker()));
					?>
					
					
					
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
			
	<section class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-xs-12">
					<h1>Blog Page
						<br><small>Subtext for header</small>
					</h1>
				</div>
				<div class="col-md-offset-4 col-sm-offset-4 col-sm-4 col-md-4 col-xs-12">
					<?php //custom_breadcrumbs(); ?>
					
					<?php the_breadcrumb(); ?>
					
				</div>
			</div>	
		</div>
	</section>	
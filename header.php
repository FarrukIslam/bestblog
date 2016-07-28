<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
						<span class="sr-only"><?php _e('Toggle navigation','bestblog'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						
						<?php $bestblog_logo = get_theme_mod( 'bestblog_logo'); ?>
						<?php $bestblog_logo_sticky = get_theme_mod( 'bestblog_logo_sticky'); ?>
						
						<?php 
							if($bestblog_logo){
								echo '<img src="'.$bestblog_logo.'" class="logo img-responsive" alt="logo" />';
							}
							else{
								$bestblog_logo_text = get_theme_mod( 'bestblog_logo_text'); 
								$f_logo_text = $bestblog_logo_text[0];
								$f_logo_text = ucfirst($f_logo_text);
								echo '<div class="logo logo-text">
										<span>'.$f_logo_text.'</span><h3>'.$bestblog_logo_text.'</h3>
									  </div>	';
							}
						?>
						
						<?php
							if($bestblog_logo_sticky){
								echo '<img src="'.$bestblog_logo_sticky.'" class="sticky-logo img-responsive" alt="sticky logo" />';
							}
							else{
								
								
								$bestblog_sticky_logo_text = get_theme_mod( 'bestblog_sticky_logo_text'); 
								
								$f_s_logo_text = $bestblog_logo_text[0];
								$f_s_logo_text = ucfirst($f_s_logo_text);
								
								echo '<div class="sticky-logo sticky-logo-text">
										<span>'.$f_s_logo_text.'</span><h3>'.$bestblog_sticky_logo_text.'</h3>
									  </div>	';
							}
						?>					
						
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					<?php
						wp_nav_menu( array(
							'menu'              => __( 'Primay Menu', 'bestblog'),
							'theme_location'    => 'primarymenu',
							'depth'             => 4,
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'bestblog_default_menu',
							'walker'            => new wp_bootstrap_navwalker()));
					?>
					
					
					
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
	
	<?php 
	
	$bestblog_banner_img = get_theme_mod( 'bestblog_banner_img');
	$bestblog_banner_overlay = get_theme_mod( 'bestblog_banner_overlay');
	
	
	if($bestblog_banner_img && $bestblog_banner_overlay){
		echo '<style>
	
		.page-header{
		background-image: url('.$bestblog_banner_img.');
		}
		.page-header:before {
			background-color: '.$bestblog_banner_overlay.';
		}
		</style>';
	}
	
	?>
	
	<section class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-md-4 col-xs-12">
					<h1>Blog Page
						<br><small>Subtext for header</small>
					</h1>
					
					
				</div>
				<div class="col-md-offset-4 col-sm-offset-4 col-sm-4 col-md-4 col-xs-12">
					
					

					<?php bestblog_breadcrumb(); ?>

				</div>
			</div>	
		</div>
	</section>	
<?php

	/*
		This is the template for the hedaer

		@package
	*/

?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
		<head>
			<title><?php bloginfo( 'name' ); wp_title(); ?></title>
			<meta name="description" content="<?php bloginfo( 'description' ); ?>">
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
				<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php endif; ?>
			<?php wp_head(); ?>

			<?php
				$custom_css = esc_attr( get_option( 'sunset_css' ) );
				if( !empty( $custom_css ) ):
					echo '<style>' . $custom_css . '</style>';
				endif;
			?>

		</head>

	<body <?php body_class(); ?> class="dynamic-header" onload="loadcrypto()">

	<div class="page-box">
		<header class="site-header">
			<div class="container">
				<div class="row">
					<div class="col col-xs-6 col-md-2">
						<a href="<?php echo site_url();?>" class="logo">
							<img src="<?php  echo get_template_directory_uri();?>/assets/img/logo.jpg" width="120" height="66" alt="Logo">
						</a>
					</div>

					<div class="col col-xs-4 col-md-8 right-align1">
						<div class="menu main-menu">
							<a href="#" class="menu-btn"><span></span><span></span><span></span></a>

							<nav class="menu-list-wrap">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'container' => false,
										'menu_class' => 'nav navbar-nav menu-list',
										'walker' => new Sunset_Walker_Nav_Primary()
									) );
								?>


							</nav><!-- .menu-list-wrap -->
						</div><!-- .main-menu -->

					</div>
					<div class="col col-xs-2 col-md-2 right-align">

						<ul class="nav pull-right navbar-nav search_user_btn">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo get_template_directory_uri();?>/assets/img/user.png" alt="user"></a>

									<ul class="dropdown-menu">
										<!-- <li class="menu-item"><i class="fa fa-cog" aria-hidden="true"></i></i><a href="">Account Setting</a></li>
										<li class="menu-item"><i class="fa fa-user-o" aria-hidden="true"></i><a href="">Profile</a></li>
										<li class="menu-item"><i class="fa fa-bookmark-o" aria-hidden="true"></i><a href="">Saved Stories</a></li>
										<li class="menu-item"><i class="fa fa-heart-o" aria-hidden="true"></i>
										<a href="">Favorite Post</a></li>
										<li class="menu-item"><i class="fa fa-lock" aria-hidden="true"></i></i><a href="">Logout</a></li> -->
										<li><a href="#">Comming Soon!</a></li>
									</ul>
							</li>
							<li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo get_template_directory_uri();?>/assets/img/search.png" alt="search"></a>
	            	<ul class="dropdown-menu">

									<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
									        <input type="text" class="form-control pull-left" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;' ); ?>" />

									    </form>
	              </ul>
	          </li>
						</ul>


					</div>
				</div>
			</div>
		</header><!-- .site-header -->


			<?php if(is_front_page()||is_home()){?>
				<div class="market_box1">
					<marquee behavior="scroll" id="markqq" direction="left" loop="infinite" onmousedown="this.stop();" onmouseup="this.start();">

					</marquee>
				</div>
			<div id="crypto"></div>
			<?php
			}?>

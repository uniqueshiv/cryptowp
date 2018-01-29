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
								
								<!-- <ul class="menu-list">
									<li class="menu-item menu-item-has-children">
										<a href="index.html">Home</a>
										<div class="sub-menu-wrap">
											<ul class="sub-menu">
												<li class="menu-item"><a href="index.html">Main</a></li>
												<li class="menu-item"><a href="index-2.html">With main post</a></li>
												<li class="menu-item"><a href="index-3.html">With sidebar</a></li>
												<li class="menu-item"><a href="index-4.html">Fullscreen slider</a></li>
												<li class="menu-item"><a href="index-5.html">Animation</a></li>
												<li class="menu-item"><a href="index-6.html">Timeline</a></li>
											</ul>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="#">Features</a>
										<div class="sub-menu-wrap">
											<ul class="sub-menu">
												<li class="menu-item menu-item-has-children">
													<a href="header-1.html">Headers</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="header-1.html">Standard</a></li>
															<li class="menu-item"><a href="header-2.html">Fixed</a></li>
															<li class="menu-item"><a href="header-3.html">Fixed with dynamic height</a></li>
															<li class="menu-item"><a href="header-4.html">Divided</a></li>
															<li class="menu-item"><a href="header-5.html">Full width</a></li>
															<li class="menu-item"><a href="header-6.html">Transparent</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="menu-1.html">Menu styles</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="menu-1.html">Standard</a></li>
															<li class="menu-item"><a href="menu-2.html">Collapsed</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="page-header-1.html">Page titles</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="page-header-1.html">Standard</a></li>
															<li class="menu-item"><a href="page-header-2.html">With background</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="index-3.html">Sliders</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="index-3.html">Standard</a></li>
															<li class="menu-item"><a href="index.html">Slider Overlay</a></li>
															<li class="menu-item"><a href="index-4.html">Fullscreen</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="footer-1.html#footer">Footer</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="footer-1.html#footer">Standard</a></li>
															<li class="menu-item"><a href="footer-2.html#footer">With menu</a></li>
															<li class="menu-item"><a href="footer-3.html#footer">With widgets</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item"><a href="typography.html">Typography</a></li>
											</ul>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="blog-standard.html">Blog</a>
										<div class="sub-menu-wrap">
											<ul class="sub-menu">
												<li class="menu-item menu-item-has-children">
													<a href="blog-standard.html">Standard Layout</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="blog-standard-ls.html">Sidebar Left</a></li>
															<li class="menu-item"><a href="blog-standard-rs.html">Sidebar Right</a></li>
															<li class="menu-item"><a href="blog-standard.html">Fullwidth</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="blog-grid.html">Grid Layout</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="blog-grid-ls.html">Grid Sidebar Left</a></li>
															<li class="menu-item"><a href="blog-grid-rs.html">Grid Sidebar Right</a></li>
															<li class="menu-item"><a href="blog-grid.html">Grid 2 Columns</a></li>
															<li class="menu-item"><a href="blog-grid-3.html">Grid 3 Columns</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item"><a href="blog-list.html">List Layout</a></li>
												<li class="menu-item"><a href="blog-modern.html">Modern List Layout</a></li>
												<li class="menu-item"><a href="blog-masonry.html">Masonry Layout</a></li>
												<li class="menu-item"><a href="blog-social.html">Social Feed Layout</a></li>
												<li class="menu-item"><a href="blog-timeline.html">Timeline Layout</a></li>
												<li class="menu-item menu-item-has-children">
													<a href="post.html">Single Post</a>
													<div class="sub-menu-wrap">
														<ul class="sub-menu">
															<li class="menu-item"><a href="post.html">Standard Post</a></li>
															<li class="menu-item"><a href="post-video.html">Video Post</a></li>
															<li class="menu-item"><a href="post-music.html">Music Post</a></li>
															<li class="menu-item"><a href="post-gallery.html">Gallery Post</a></li>
															<li class="menu-item"><a href="post-quote.html">Quote Post</a></li>
														</ul>
													</div>
												</li>
											</ul>
										</div>
									</li>
									<li class="menu-item menu-item-has-children">
										<a href="about-me.html">Pages</a>
										<div class="sub-menu-wrap">
											<ul class="sub-menu">
												<li class="menu-item menu-item-has-children">
													<a href="about-me.html">About Me</a>
													<div class="sub-menu-wrap reverted">
														<ul class="sub-menu">
															<li class="menu-item"><a href="about-me.html">About Me</a></li>
															<li class="menu-item"><a href="about-me-2.html">About Me 2</a></li>
															<li class="menu-item"><a href="about-us.html">About Us</a></li>
															<li class="menu-item"><a href="about-us-2.html">About Us 2</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item menu-item-has-children">
													<a href="contacts.html">Contacts</a>
													<div class="sub-menu-wrap reverted">
														<ul class="sub-menu">
															<li class="menu-item"><a href="contacts.html">Contact Me</a></li>
															<li class="menu-item"><a href="contacts-2.html">Contact Us</a></li>
														</ul>
													</div>
												</li>
												<li class="menu-item"><a href="404.html">Page 404</a></li>
											</ul>
										</div>
									</li>
									<li class="menu-item"><a href="about-me.html">About Me</a></li>
									<li class="menu-item"><a href="contacts.html">Contacts</a></li>
								</ul> -->
							</nav><!-- .menu-list-wrap -->
						</div><!-- .main-menu -->

					</div>
					<div class="col col-xs-2 col-md-2 right-align">

						<ul class="nav pull-right navbar-nav search_user_btn">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo get_template_directory_uri();?>/assets/img/user.png" alt="user"></a>

									<ul class="dropdown-menu">
										<li class="menu-item"><i class="fa fa-cog" aria-hidden="true"></i></i><a href="">Account Setting</a></li>
										<li class="menu-item"><i class="fa fa-user-o" aria-hidden="true"></i><a href="">Profile</a></li>
										<li class="menu-item"><i class="fa fa-bookmark-o" aria-hidden="true"></i><a href="">Saved Stories</a></li>
										<li class="menu-item"><i class="fa fa-heart-o" aria-hidden="true"></i>
										<a href="">Favorite Post</a></li>
										<li class="menu-item"><i class="fa fa-lock" aria-hidden="true"></i></i><a href="">Logout</a></li>
									</ul>
							</li>
							<li class="dropdown">
	            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo get_template_directory_uri();?>/assets/img/search.png" alt="search"></a>
	            	<ul class="dropdown-menu">
	                <form class="form-inline">
	     										<input type="text" class="form-control pull-left" placeholder="Search">
	                </form>
	              </ul>
	          </li>
						</ul>


					</div>
				</div>
			</div>
		</header><!-- .site-header -->

			<div class="market_box1">
				<marquee behavior="scroll" id="markqq" direction="left" loop="infinite" onmousedown="this.stop();" onmouseup="this.start();">

				</marquee>
			</div>
			<div id="crypto"></div>

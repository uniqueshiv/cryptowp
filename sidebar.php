<?php /*

@package sunsettheme

*/

if ( ! is_active_sidebar( 'sunset-sidebar' ) ) {
	return;
}

?>


	<aside class="widget bg text-center">
							<h4 class="widget-title"><span>Newsletter</span></h4>

							<form class="subscribe m-b-0">
								<div class="form-group">
									<input id="subscribe" class="form-control" type="email" name="subscribe" placeholder="your email">
									<span class="form-message"></span>
								</div>
								<button class="btn btn-block btn-outline-default">Subscribe</button>
							</form>
							<div class="text-md-center">
							<span class="widget-title1 text-center"><small>JOIN US ON SOCIAL MEDIA</small></span>

							<ul class="social">
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
							</ul>
							</div>
						</aside>
  <!-- <div class="visible-xs">
    <?php
      // wp_nav_menu( array(
      //   'theme_location' => 'primary',
      //   'container' => 'aside',
      //   'menu_class' => 'nav navbar-nav navbar-collapse',
      //   'walker' => new Sunset_Walker_Nav_Primary()
      // ) );
    ?>
  </div> -->

	<?php dynamic_sidebar( 'sunset-sidebar' ); ?>

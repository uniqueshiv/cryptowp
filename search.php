<?php /*

@package sunsettheme

*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="search_panel">
				<div class="container">

						 <div class="row">

							 <div class="col-md-7 offset-md-2">

								 		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
												<div class="input-group">
													<input class="form-control search-input"  name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Crypto New Search ...">
													<span class="input-group-btn">
														<button class="btn btn-search" type="submit" > <i class="fa fa-search" aria-hidden="true"></i> Search...</button>
												 </span>
											 </div>

										 </form>
							 </div>
						</div>
						<div class="row" style="width:68%;margin:0px auto;">

								 	<div class="col-md-4">
										<div class="search_heading">Categories</div>
										<?php
										echo get_all_category();
    								?>
									</div>
									<div class="col-md-4">
										<div class="search_heading">Tags</div>
										<?php echo get_all_tag();?>
									</div>
									<div class="col-md-4">
										<div class="search_heading">Archives</div>
										<?php //echo get_all_archive();?>
										<div class="tagcloud">
											<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
										</div>
									</div>

						 </div>
						 <header class="archive-header text-center">
							<?php //the_archive_title('<h1 class="page-title">', '</h1>'); ?>
						</header>
					</div>
				</div><!-- search panel -->

			<?php if( is_paged() ): ?>

				<div class="container text-center container-load-previous">
					<a class="btn-sunset-load sunset-load-more" data-prev="1" data-archive="<?php echo sunset_grab_current_uri(); ?>" data-page="<?php echo sunset_check_paged(1); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
						<span class="sunset-icon sunset-loading"></span>
						<span class="text">Load Previous</span>
					</a>
				</div><!-- .container -->

			<?php endif; ?>

			<div class="container sunset-posts-container">

				<?php

					if( have_posts() ):

						echo '<div class="page-limit" data-page="' . $_SERVER["REQUEST_URI"] . '">';

						while( have_posts() ): the_post();

							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						echo '</div>';

					endif;

				?>

			</div><!-- .container -->

			<div class="container text-sm-center">
				<a class="btn-sunset-load sunset-load-more" data-page="<?php echo sunset_check_paged(1); ?>" data-archive="<?php echo sunset_grab_current_uri(); ?>" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
					<span class="sunset-icon sunset-loading"></span>
					<span class="text btn">Load More</span>
				</a>
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>

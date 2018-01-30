<?php /*

@package sunsettheme

*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

					<header class="page-header bg-page-header" style="background-image: url(http://localhost/crypto/wp-content/uploads/2018/01/e68f925e-a7aa-31ba-a84d-1296e68e1238.jpg);">
						<?php the_archive_title('<h4 class="page-title">', '</h4>'); ?>
					</header>


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

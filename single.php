<?php /*

@package sunsettheme

*/

get_header(); ?>
<main id="main">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-8 posts-list">

				<?php

					if( have_posts() ):

						while( have_posts() ): the_post();
							setPostViews(get_the_ID());
							sunset_save_post_views( get_the_ID() );

							get_template_part( 'template-parts/single', get_post_format() );

							echo crypto_post_navigation();

							// if ( comments_open() ):
							// 	comments_template();
							// endif;

						endwhile;

					endif;

				?>

			</div>

			<div class="col-xs-12 col-lg-4 sidebar1">

<?php get_sidebar();?>

			</div><!-- .sidebar -->
		</div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>

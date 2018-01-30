<?php /*

@package sunsettheme

*/

get_header(); ?>

<main id="main">
		<!-- <header class="page-header">
			<h1><span class="accent-color"><?php echo get_the_title();?></h1>
		</header> -->

		<div class="container">
			<article class="page bg margin">
				<div class="page-content">

				<?php

					if( have_posts() ):

						while( have_posts() ): the_post();

							get_template_part( 'template-parts/content', 'page' );

						endwhile;

					endif;

				?>
					</div>
				</article>
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>

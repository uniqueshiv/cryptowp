<?php

/*

@package sunsettheme
-- Image Post Format

*/

?>
<article  id="post-<?php the_ID(); ?>" data-post_id="<?php the_ID(); ?>" <?php post_class( 'sunset-format-image post bg' ); ?>>
	<div class="post-media">
		<a href="<?php the_permalink();?>">

			<img class="retina img img-responsive" src="<?php echo sunset_get_attachment(); ?>"  alt="Post Image">
		</a>
	</div>

	<div class="post-header center-align">
			<div class="article-left">
				<?php
			$user = wp_get_current_user();

			if ( $user ) :
			    ?>
			    <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" class=" img author-image img-circle" />
			<?php endif; ?>
			</div>
			<div class="article-right">
				<div class="row">
						<div class="col-sm-4 col-xs-6"><?php echo the_author_posts_link();?>
						<div class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>   <?php $posted_on = human_time_diff(get_the_time('U'), current_time('timestamp')); echo $posted_on." ago";?></div></div>
						<div class="col-sm-8 col-xs-6 text-xs-right tags all-caps">
									<?php echo crypto_posted_meta();?>
						</div>
				</div>

			</div>
		<div class="clearfix"></div>
	</div>

	<div class="post-content">
		<div class="article-left">
			<?php $id=get_the_ID(); echo crypto_share_this($id);?>
		</div>
		<div class="article-right">
			<h2 class="post-title">
				<a href="<?php the_permalink();?>" class="title"><?php the_title();?></a></h2>
			<div class="article_content">
		<?php the_excerpt();?>

		</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="row post-footer">
		<div class="article-left"></div>
		<div class="article-right">
			<div class="row">
			<div class="col-sm-4 post-comment">
				<i class="fa fa-commenting-o" aria-hidden="true"></i> <strong>32 </strong> Comment
			</div>

			<div class="col-sm-4 text-sm-right post-views">
					<i class="fa fa-eye" aria-hidden="true"></i>
					 <strong><?php echo getPostViews(get_the_ID()); ?></strong> Total views

			</div>
			<div class="col-sm-4 text-sm-right post-sharing">
					<i class="fa fa-share-square-o" aria-hidden="true"></i> <strong>983343</strong> Total share

			</div>
			 </div>
		</div>
	</div>
</article><!-- .post -->

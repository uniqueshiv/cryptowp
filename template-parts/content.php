<?php

/*

@package sunsettheme
-- Image Post Format

*/

?>
<article  id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-image post bg' ); ?>>
	<div class="post-media">
		<a href="<?php the_permalink();?>">

			<img class="retina" src="<?php echo sunset_get_attachment(); ?>"  height="452" alt="Post Image">
		</a>
	</div>

	<div class="post-header center-align">
			<div class="article-left">
			<a href=""><img src="<?php echo get_template_directory_uri();?>/assets/img/author.jpeg" class=" img img-circle" style="width:40px;"></a>
			</div>
			<div class="article-right">
				<div class="row">
						<div class="col-sm-4 col-xs-6"><a href="#" class="author"><?php the_author();?></a>
						<div class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>2 hours ago</div></div>
						<div class="col-sm-8 col-xs-6 text-xs-right tags all-caps">
							<a href="#" class="tag-btn">Mobile</a>
						</div>
				</div>

			</div>
		<div class="clearfix"></div>
	</div>

	<div class="post-content">
		<div class="article-left">
			<ul class="post_shares">
			<li><div class="count_like">1.9k</div><a href="#">
			<img src="<?php echo get_template_directory_uri();?>/assets/img/favourite.png"></i></a>
			</li>
			<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li><a href="#" class="fb_circle"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a href="#"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a></li>
			</ul>
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
					 <strong>798445</strong> Total views

			</div>
			<div class="col-sm-4 text-sm-right post-sharing">
					<i class="fa fa-share-square-o" aria-hidden="true"></i> <strong>983343</strong> Total share

			</div>
			 </div>
		</div>
	</div>
</article><!-- .post -->

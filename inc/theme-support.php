<?php

/*

@package sunsettheme

    ========================
        THEME SUPPORT OPTIONS
    ========================
*/

$options = get_option('post_formats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$output = array();
foreach ($formats as $format) {
    $output[] = (@$options[$format] == 1 ? $format : '');
}
if (!empty($options)) {
    add_theme_support('post-formats', $output);
}

$header = get_option('custom_header');
if (@$header == 1) {
    add_theme_support('custom-header');
}

$background = get_option('custom_background');
if (@$background == 1) {
    add_theme_support('custom-background');
}

add_filter( 'the_author_posts_link', function( $link )
{
    return str_replace( 'rel="author"', 'rel="author" class="author"', $link );
});


add_theme_support('post-thumbnails');

/* Activate Nav Menu Option */
function sunset_register_nav_menu()
{
    register_nav_menu('primary', 'Header Navigation Menu');
}
add_action('after_setup_theme', 'sunset_register_nav_menu');

/* Activate HTML5 features */
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

/*
    ========================
        SIDEBAR FUNCTIONS
    ========================
*/
function sunset_sidebar_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sunset Sidebar', 'sunsettheme'),
            'id' => 'sunset-sidebar',
            'description' => 'Dynamic Right Sidebar',
            'before_widget' => '<aside id="%1$s" class="bg widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        )
    );
}
add_action('widgets_init', 'sunset_sidebar_init');

/*
    ========================
        BLOG LOOP CUSTOM FUNCTIONS
    ========================
*/

function crypto_posted_meta()
{
    //$posted_on = human_time_diff(get_the_time('U'), current_time('timestamp'));

    $categories = get_the_category();
    $separator = '  ';
    $output = '';
    $i = 1;

    if (!empty($categories)):
        foreach ($categories as $category):
            if ($i > 1): $output .= $separator;
    endif;
    $output .= '<a href="'.esc_url(get_category_link($category->term_id)).'"  class="tag-btn" alt="'.esc_attr('View all posts in%s', $category->name).'">'.esc_html($category->name).'</a>';
    ++$i;
    endforeach;
    endif;
    return $output;
  //  return '<span class="posted-on">Posted <a href="'.esc_url(get_permalink()).'">'.$posted_on.'</a> ago</span> / <span class="posted-in">'.$output.'</span>';
}

function sunset_posted_footer($onlyComments = false)
{
    $comments_num = get_comments_number();
    if (comments_open()) {
        if ($comments_num == 0) {
            $comments = __('No Comments');
        } elseif ($comments_num > 1) {
            $comments = $comments_num.__(' Comments');
        } else {
            $comments = __('1 Comment');
        }
        $comments = '<a class="comments-link small text-caps" href="'.get_comments_link().'">'.$comments.' <span class="sunset-icon sunset-comment"></span></a>';
    } else {
        $comments = __('Comments are closed');
    }

    if ($onlyComments) {
        return $comments;
    }

    return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'.get_the_tag_list('<div class="tags-list"><span class="sunset-icon sunset-tag"></span>', ' ', '</div>').'</div><div class="col-xs-12 col-sm-6 text-right">'.$comments.'</div></div></div>';
}

function sunset_get_attachment($num = 1)
{
    $output = '';
    if (has_post_thumbnail() && $num == 1):
        $output = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); else:
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => $num,
            'post_parent' => get_the_ID(),
        ));
    if ($attachments && $num == 1):
            foreach ($attachments as $attachment):
                $output = wp_get_attachment_url($attachment->ID);
    endforeach; elseif ($attachments && $num > 1):
            $output = $attachments;
    endif;

    wp_reset_postdata();

    endif;

    return $output;
}

function sunset_get_embedded_media($type = array())
{
    $content = do_shortcode(apply_filters('the_content', get_the_content()));
    $embed = get_media_embedded_in_content($content, $type);

    if (in_array('audio', $type)):
        $output = str_replace('?visual=true', '?visual=false', $embed[0]); else:
        $output = $embed[0];
    endif;

    return $output;
}

function sunset_get_bs_slides($attachments)
{
    $output = array();
    $count = count($attachments) - 1;

    for ($i = 0; $i <= $count; ++$i):

        $active = ($i == 0 ? ' active' : '');

    $n = ($i == $count ? 0 : $i + 1);
    $nextImg = wp_get_attachment_thumb_url($attachments[$n]->ID);
    $p = ($i == 0 ? $count : $i - 1);
    $prevImg = wp_get_attachment_thumb_url($attachments[$p]->ID);

    $output[$i] = array(
            'class' => $active,
            'url' => wp_get_attachment_url($attachments[$i]->ID),
            'next_img' => $nextImg,
            'prev_img' => $prevImg,
            'caption' => $attachments[$i]->post_excerpt,
        );

    endfor;

    return $output;
}

function sunset_grab_url()
{
    if (!preg_match('/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links)) {
        return false;
    }

    return esc_url_raw($links[1]);
}

function sunset_grab_current_uri()
{
    $http = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://');
    $referer = $http.$_SERVER['HTTP_HOST'];
    $archive_url = $referer.$_SERVER['REQUEST_URI'];

    return $archive_url;
}

/*
    ========================
        SINGLE POST CUSTOM FUNCTIONS
    ========================
*/
function crypto_post_navigation()
{
    $nav = '<div class="row">';

    $prev = get_previous_post_link('<div class="post-link-nav"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> %link </div>', '%title');
    $nav .= '<div class="col-xs-12 col-sm-6">'.$prev.'</div>';

    $next = get_next_post_link('<div class="post-link-nav">%link <i class="fa fa-long-arrow-right" aria-hidden="true"></i></div>', '%title');
    $nav .= '<div class="col-xs-12 col-sm-6 text-right">'.$next.'</div>';

    $nav .= '</div>';

    return $nav;
}

function crypto_share_this($postid)
{

        $content .= '';

        $title = get_the_title();
        $permalink = get_permalink();

        $twitterHandler = (get_option('twitter_handler') ? '&amp;via='.esc_attr(get_option('twitter_handler')) : '');

        $twitter = 'https://twitter.com/intent/tweet?text=Hey! Read this: '.$title.'&amp;url='.$permalink.$twitterHandler.'';
        $facebook = 'https://www.facebook.com/sharer/sharer.php?u='.$permalink;
        $google = 'https://plus.google.com/share?url='.$permalink;

        $content .= '<ul class="post_shares">';

          $content .= '<li id="likepost"><div class="count_like">'.get_post_meta($postid, "votes_count", true).'</div><img src="'.get_template_directory_uri().'/assets/img/favourite.png"></li>';
        $content .= '<li><a href="'.$twitter.'" target="_blank" rel="nofollow"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
        $content .= '<li><a href="'.$facebook.'" target="_blank" rel="nofollow"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
        //$content .= '<li><a href="'.$google.'" target="_blank" rel="nofollow"><i class="fa fa-googleplus" aria-hidden="true"></i></a></li>';
        $content .= '<li><i class="fa fa-bookmark-o" aria-hidden="true"></i></li>';

        $content .= '</ul>';

        return $content;

}
//add_filter('the_content', 'sunset_share_this');

function sunset_get_post_navigation()
{
    if (get_comment_pages_count() > 1 && get_option('page_comments')):

        require get_template_directory().'/inc/templates/crypto-comment-nav.php';

    endif;
}

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '';
  $phpmailer->Password = '';
}

add_action('phpmailer_init', 'mailtrap');

// Initialize global Mobile Detect
function mobileDetectGlobal() {
    global $detect;
    $detect = new Mobile_Detect;
}

add_action('after_setup_theme', 'mobileDetectGlobal');


function get_all_tag(){
  $tags = get_tags(array('get'=>'all'));
  $output='<div class="tagcloud">';
  if($tags) {
  foreach ($tags as $tag):
  $output .= '<a href="'. get_term_link($tag).'">'. $tag->name .'</a>';
  endforeach;
  } else {
  _e('No tags created.', 'text-domain');
  }
  $output .= '</div>';
  return $output;
}

function get_all_category(){
  $categories =  get_categories();
  //var_dump($categories);
  $output= '<div class="tagcloud">';
  foreach  ($categories as $category) {
    //echo $category_id = get_cat_ID( $category);

  $category_link = get_category_link( $category->cat_ID );
    $output.= '<a href="'.$category_link.'">'. $category->cat_name .'</a>';
  }
  $output.= '</div>';
  return $output;
}
function wpse_62509_current_month_selector( $link_html ) {
    $current_month = date("F Y");
    if ( preg_match('/'.$current_month.'/i', $link_html ) )
        $link_html = preg_replace('/<li>/i', '', $link_html );
    return $link_html;
}
add_filter( 'get_archives_link', 'wpse_62509_current_month_selector' );



function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

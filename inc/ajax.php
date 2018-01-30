<?php

/*

@package sunsettheme

    ========================
        AJAX FUNCTIONS
    ========================
*/
add_action('wp_ajax_nopriv_sunset_load_more', 'sunset_load_more');
add_action('wp_ajax_sunset_load_more', 'sunset_load_more');

add_action('wp_ajax_nopriv_sunset_save_user_contact_form', 'sunset_save_contact');
add_action('wp_ajax_sunset_save_user_contact_form', 'sunset_save_contact');

function sunset_load_more()
{
    $paged = $_POST['page'] + 1;
    $prev = $_POST['prev'];
    $archive = $_POST['archive'];

    if ($prev == 1 && $_POST['page'] != 1) {
        $paged = $_POST['page'] - 1;
    }

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $paged,
    );

    if ($archive != '0') {
        $archVal = explode('/', $archive);
        $flipped = array_flip($archVal);

        switch (isset($flipped)) {

            case $flipped['category']:
                $type = 'category_name';
                $key = 'category';
                break;

            case $flipped['tag']:
                $type = 'tag';
                $key = $type;
                break;

            case $flipped['author']:
                $type = 'author';
                $key = $type;
                break;

        }

        $currKey = array_keys($archVal, $key);
        $nextKey = $currKey[0] + 1;
        $value = $archVal[ $nextKey ];

        $args[ $type ] = $value;

        //check page trail and remove "page" value
        if (isset($flipped['page'])) {
            $pageVal = explode('page', $archive);
            $page_trail = $pageVal[0];
        } else {
            $page_trail = $archive;
        }
    } else {
        $page_trail = '/';
    }

    $query = new WP_Query($args);

    if ($query->have_posts()):

        echo '<div class="page-limit" data-page="'.$page_trail.'page/'.$paged.'/">';

    while ($query->have_posts()): $query->the_post();

    get_template_part('template-parts/content', get_post_format());

    endwhile;

    echo '</div>'; else:

        echo 0;

    endif;

    wp_reset_postdata();

    die();
}

function sunset_check_paged($num = null)
{
    $output = '';

    if (is_paged()) {
        $output = 'page/'.get_query_var('paged');
    }

    if ($num == 1) {
        $paged = (get_query_var('paged') == 0 ? 1 : get_query_var('paged'));

        return $paged;
    } else {
        return $output;
    }
}

function sunset_save_contact()
{
    $title = wp_strip_all_tags($_POST['name']);
    $email = wp_strip_all_tags($_POST['email']);
    $message = wp_strip_all_tags($_POST['message']);

    $args = array(
        'post_title' => $title,
        'post_content' => $message,
        'post_author' => 1,
        'post_status' => 'publish',
        'post_type' => 'sunset-contact',
        'meta_input' => array(
            '_contact_email_value_key' => $email,
        ),
    );

    $postID = wp_insert_post($args);

    if ($postID !== 0) {
        $to = get_bloginfo('admin_email');
        $subject = 'Sunset Contact Form - '.$title;

        $headers[] = 'From: '.get_bloginfo('name').' <'.$to.'>'; // 'From: Alex <me@alecaddd.com>'
        $headers[] = 'Reply-To: '.$title.' <'.$email.'>';
        $headers[] = 'Content-Type: text/html: charset=UTF-8';

        wp_mail($to, $subject, $message, $headers);
    }

    echo $postID;

    die();
}


wp_enqueue_script('like_post', get_template_directory_uri().'/assets/js/like.js', array('jquery'), '1.0', true );
wp_localize_script('like_post', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajax-nonce')
));

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');
function post_like()
{
    // Check for nonce security
    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');

    if(isset($_POST['post_like']))
    {
        // Retrieve user IP address
        $ip = $_SERVER['REMOTE_ADDR'];
        $post_id = $_POST['post_id'];

        // Get voters'IPs for the current post
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = $meta_IP[0];

        if(!is_array($voted_IP))
            $voted_IP = array();

        // Get votes count for the current post
        $meta_count = get_post_meta($post_id, "votes_count", true);

        // Use has already voted ?
        if(!hasAlreadyVoted($post_id))
        {
            $voted_IP[$ip] = time();

            // Save IP and increase votes count
            update_post_meta($post_id, "voted_IP", $voted_IP);
            update_post_meta($post_id, "votes_count", ++$meta_count);

            // Display count (ie jQuery return value)
            echo $meta_count;
        }
        else
            echo "already";
    }
    exit;
}

function hasAlreadyVoted($post_id)
{
    global $timebeforerevote;

    // Retrieve post votes IPs
    $meta_IP = get_post_meta($post_id, "voted_IP");
    $voted_IP = $meta_IP[0];

    if(!is_array($voted_IP))
        $voted_IP = array();

    // Retrieve current user IP
    $ip = $_SERVER['REMOTE_ADDR'];

    // If user has already voted
    if(in_array($ip, array_keys($voted_IP)))
    {
        $time = $voted_IP[$ip];
        $now = time();

        // Compare between current time and vote time
        if(round(($now - $time) / 60) > $timebeforerevote)
            return false;

        return true;
    }

    return false;
}

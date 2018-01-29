<?php

/*

@package cryptotheme

	========================
		ADMIN ENQUEUE FUNCTIONS
	========================
*/

function crypto_load_admin_scripts( $hook ){
	//echo $hook;

	//register css admin section
	wp_register_style( 'raleway-admin', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
	wp_register_style( 'crypto_admin', get_template_directory_uri() . '/css/crypto.admin.css', array(), '1.0.0', 'all' );

	//register js admin section
	wp_register_script( 'crypto-admin-script', get_template_directory_uri() . '/js/crypto.admin.js', array('jquery'), '1.0.0', true );

	$pages_array = array(
		'toplevel_page_alecaddd_crypto',
		'crypto_page_alecaddd_crypto_theme',
		'crypto_page_alecaddd_crypto_theme_contact',
		'crypto_page_alecaddd_crypto_css'
	);

	//PHP 7

	if( in_array( $hook, $pages_array ) ){

		wp_enqueue_style( 'raleway-admin' );
		wp_enqueue_style( 'crypto_admin' );

	}

	if( 'toplevel_page_alecaddd_crypto' == $hook ){

		wp_enqueue_media();

		wp_enqueue_script( 'crypto-admin-script' );

	}

	if ( 'crypto_page_alecaddd_crypto_css' == $hook ){

		wp_enqueue_style( 'ace', get_template_directory_uri() . '/css/crypto.ace.css', array(), '1.0.0', 'all' );

		wp_enqueue_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.2.1', true );
		wp_enqueue_script( 'crypto-custom-css-script', get_template_directory_uri() . '/js/crypto.custom_css.js', array('jquery'), '1.0.0', true );

	}

}
add_action( 'admin_enqueue_scripts', 'crypto_load_admin_scripts' );

/*

	========================
		FRONT-END ENQUEUE FUNCTIONS
	========================

*/

function crypto_load_scripts(){
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4', 'all' );
	wp_enqueue_style( 'crypto', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'crypto-custom', get_template_directory_uri().'/assets/css/custom.css','1.0.0' );
 	wp_register_script('jquery','2');
	//wp_deregister_script( 'jquery' );
	//wp_register_script( 'jquery' , get_template_directory_uri() . '/js/jquery.js', false, '1.11.3', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'crypto_tether',  'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), true );
wp_enqueue_script( 'loadpost',  get_template_directory_uri().'/assets/js/loadpost.js');
	wp_enqueue_script( 'crypto_touchwipe', get_template_directory_uri() . '/assets/js/jquery.touchwipe.min.js' );
	wp_enqueue_script( 'crypto_mag', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js' );
  wp_enqueue_script( 'crypto_custom', get_template_directory_uri() . '/assets/js/main.js');

}
add_action( 'wp_enqueue_scripts', 'crypto_load_scripts' );

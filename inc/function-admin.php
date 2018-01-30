<?php

/*

@package cryptotheme

	========================
		ADMIN PAGE
	========================
*/

function crypto_add_admin_page() {

	//Generate crypto Admin Page
	add_menu_page( 'crypto Theme Options', 'Cryptoscoop', 'manage_options', 'alecaddd_crypto', 'crypto_theme_create_page', get_template_directory_uri() . '/assets/img/bitcoin.webp', 110 );

	//Generate crypto Admin Sub Pages
	add_submenu_page( 'alecaddd_crypto', 'crypto Sidebar Options', 'Sidebar', 'manage_options', 'alecaddd_crypto', 'crypto_theme_create_page' );
	add_submenu_page( 'alecaddd_crypto', 'crypto Theme Options', 'Theme Options', 'manage_options', 'alecaddd_crypto_theme', 'crypto_theme_support_page' );
	add_submenu_page( 'alecaddd_crypto', 'crypto Contact Form', 'Contact Form', 'manage_options', 'alecaddd_crypto_theme_contact', 'crypto_contact_form_page' );
	add_submenu_page( 'alecaddd_crypto', 'crypto CSS Options', 'Custom CSS', 'manage_options', 'alecaddd_crypto_css', 'crypto_theme_settings_page');

}
add_action( 'admin_menu', 'crypto_add_admin_page' );

//Activate custom settings
add_action( 'admin_init', 'crypto_custom_settings' );

function crypto_custom_settings() {
	//Sidebar Options
	register_setting( 'crypto-settings-group', 'profile_picture' );
	register_setting( 'crypto-settings-group', 'first_name' );
	register_setting( 'crypto-settings-group', 'last_name' );
	register_setting( 'crypto-settings-group', 'user_description' );
	register_setting( 'crypto-settings-group', 'twitter_handler', 'crypto_sanitize_twitter_handler' );
	register_setting( 'crypto-settings-group', 'facebook_handler' );
	register_setting( 'crypto-settings-group', 'gplus_handler' );

	add_settings_section( 'crypto-sidebar-options', 'Sidebar Option', 'crypto_sidebar_options', 'alecaddd_crypto');

	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'crypto_sidebar_profile', 'alecaddd_crypto', 'crypto-sidebar-options');
	add_settings_field( 'sidebar-name', 'Full Name', 'crypto_sidebar_name', 'alecaddd_crypto', 'crypto-sidebar-options');
	add_settings_field( 'sidebar-description', 'Description', 'crypto_sidebar_description', 'alecaddd_crypto', 'crypto-sidebar-options');
	add_settings_field( 'sidebar-twitter', 'Twitter handler', 'crypto_sidebar_twitter', 'alecaddd_crypto', 'crypto-sidebar-options');
	add_settings_field( 'sidebar-facebook', 'Facebook handler', 'crypto_sidebar_facebook', 'alecaddd_crypto', 'crypto-sidebar-options');
	//add_settings_field( 'sidebar-gplus', 'Google+ handler', 'crypto_sidebar_gplus', 'alecaddd_crypto', 'crypto-sidebar-options');

	//Theme Support Options
	register_setting( 'crypto-theme-support', 'post_formats' );
	register_setting( 'crypto-theme-support', 'custom_header' );
	register_setting( 'crypto-theme-support', 'custom_background' );

	add_settings_section( 'crypto-theme-options', 'Theme Options', 'crypto_theme_options', 'alecaddd_crypto_theme' );

	add_settings_field( 'post-formats', 'Post Formats', 'crypto_post_formats', 'alecaddd_crypto_theme', 'crypto-theme-options' );
	add_settings_field( 'custom-header', 'Custom Header', 'crypto_custom_header', 'alecaddd_crypto_theme', 'crypto-theme-options' );
	add_settings_field( 'custom-background', 'Custom Background', 'crypto_custom_background', 'alecaddd_crypto_theme', 'crypto-theme-options' );

	//Contact Form Options
	register_setting( 'crypto-contact-options', 'activate_contact' );

	add_settings_section( 'crypto-contact-section', 'Contact Form', 'crypto_contact_section', 'alecaddd_crypto_theme_contact');

	add_settings_field( 'activate-form', 'Activate Contact Form', 'crypto_activate_contact', 'alecaddd_crypto_theme_contact', 'crypto-contact-section' );

	//Custom CSS Options
	register_setting( 'crypto-custom-css-options', 'crypto_css', 'crypto_sanitize_custom_css' );

	add_settings_section( 'crypto-custom-css-section', 'Custom CSS', 'crypto_custom_css_section_callback', 'alecaddd_crypto_css' );

	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'crypto_custom_css_callback', 'alecaddd_crypto_css', 'crypto-custom-css-section' );

}

function crypto_custom_css_section_callback() {
	echo 'Customize crypto Theme with your own CSS';
}

function crypto_custom_css_callback() {
	$css = get_option( 'crypto_css' );
	$css = ( empty($css) ? '/* crypto Theme Custom CSS */' : $css );
	echo '<div id="customCss">'.$css.'</div><textarea id="crypto_css" name="crypto_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}

function crypto_theme_options() {
	echo 'Activate and Deactivate specific Theme Support Options';
}

function crypto_contact_section() {
	echo 'Activate and Deactivate the Built-in Contact Form';
}

function crypto_activate_contact() {
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></label>';
}

function crypto_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' /> '.$format.'</label><br>';
	}
	echo $output;
}

function crypto_custom_header() {
	$options = get_option( 'custom_header' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';
}

function crypto_custom_background() {
	$options = get_option( 'custom_background' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';
}

// Sidebar Options Functions
function crypto_sidebar_options() {
	echo 'Customize your Sidebar Information';
}

function crypto_sidebar_profile() {
	$picture = esc_attr( get_option( 'profile_picture' ) );
	if( empty($picture) ){
		echo '<button type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><span class="crypto-icon-button dashicons-before dashicons-format-image"></span> Upload Profile Picture</button><input type="hidden" id="profile-picture" name="profile_picture" value="" />';
	} else {
		echo '<button type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><span class="crypto-icon-button dashicons-before dashicons-format-image"></span> Replace Profile Picture</button><input type="hidden" id="profile-picture" name="profile_picture" value="'.$picture.'" /> <button type="button" class="button button-secondary" value="Remove" id="remove-picture"><span class="crypto-icon-button dashicons-before dashicons-no"></span> Remove</button>';
	}

}
function crypto_sidebar_name() {
	$firstName = esc_attr( get_option( 'first_name' ) );
	$lastName = esc_attr( get_option( 'last_name' ) );
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name" />';
}
function crypto_sidebar_description() {
	$description = esc_attr( get_option( 'user_description' ) );
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write something smart.</p>';
}
function crypto_sidebar_twitter() {
	$twitter = esc_attr( get_option( 'twitter_handler' ) );
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter handler" /><p class="description">Input your Twitter username without the @ character.</p>';
}
function crypto_sidebar_facebook() {
	$facebook = esc_attr( get_option( 'facebook_handler' ) );
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}
function crypto_sidebar_gplus() {
	$gplus = esc_attr( get_option( 'gplus_handler' ) );
	echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="Google+ handler" />';
}

//Sanitization settings
function crypto_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}

function crypto_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

//Template submenu functions
function crypto_theme_create_page() {
	require_once( get_template_directory() . '/inc/templates/crypto-admin.php' );
}

function crypto_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/crypto-theme-support.php' );
}

function crypto_contact_form_page() {
	require_once( get_template_directory() . '/inc/templates/crypto-contact-form.php' );
}

function crypto_theme_settings_page() {
	require_once( get_template_directory() . '/inc/templates/crypto-custom-css.php' );
}

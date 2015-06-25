<?php
add_filter( 'login_headerurl', 'ssm_login_headerurl' );
/**
 * Makes the login screen's logo link to your homepage, instead of to WordPress.org.
 * @since 1.0.0
 */
function ssm_login_headerurl() {
    return home_url();
}

add_filter( 'login_headertitle', 'ssm_login_headertitle' );
/**
 * Makes the login screen's logo title attribute your site title, instead of 'WordPress'.
 * @since 1.0.0
 */
function ssm_login_headertitle() {
    return get_bloginfo( 'name' );
}

add_action( 'login_enqueue_scripts', 'ssm_replace_login_logo' );
/**
 * Replaces the login screen's WordPress logo with the 'login-logo.png' in your child theme images folder.
 * Disabled by default. Make sure you have a login logo before using this function!
 * Updated 2.0.1: Assumes SVG logo by default
 * @since 1.0.0
 */
function ssm_replace_login_logo() { ?>

<?php if ( $image = get_field('brand_logo', 'options') ) { 
	
	$background_image = $image['url'];
	
	} else {	
	
	$background_image =  get_stylesheet_directory_uri() . '/assets/images/ph-logo.png';
	
	} 
	
	?>
	
	<style type="text/css">
		body.login div#login h1 a {
			background: url(<?php echo $background_image; ?>) no-repeat !important;
			background-size: 292px 36px;
			height: 36px;
			padding-bottom: 15px;
			width: 292px;
		}
	</style>

<?php

}

add_filter( 'wp_mail_from_name', 'ssm_mail_from_name' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress site name, instead of from 'WordPress'.
 * @since 1.0.0
 */
function ssm_mail_from_name() {
	return get_option( 'blogname' );
}

add_filter( 'wp_mail_from', 'ssm_wp_mail_from' );
/**
 * Makes WordPress-generated emails appear 'from' your WordPress admin email address.
 * Disabled by default, in case you don't want to reveal your admin email.
 * @since 1.0.0
 */
function ssm_wp_mail_from() {
	return get_option( 'admin_email' );
}

add_action( 'wp_before_admin_bar_render', 'ssm_remove_wp_icon_from_admin_bar' );
/**
 * Removes the WP icon from the admin bar
 * See: http://wp-snippets.com/remove-wordpress-logo-admin-bar/
 * @since 1.0.0
 */
function ssm_remove_wp_icon_from_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

add_filter( 'admin_footer_text', 'ssm_admin_footer_text' );
/**
 * Modify the admin footer text
 * See: http://wp-snippets.com/change-footer-text-in-wp-admin/
 * @since 1.0.0
 */
function ssm_admin_footer_text () {
	echo 'Built by <a href="http://www.secretstache.com" target="_blank">Secret Stache Media</a> with WordPress.';
}
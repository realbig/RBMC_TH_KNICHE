<?php
/**
 * Modify the login page.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function kidniche_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'kidniche_logo_url' );

function kidniche_login_logo_url_title() {
	return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'kidniche_login_logo_url_title' );

function kidniche_login_stylesheet() {

	global $theme_fonts;

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_enqueue_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}

	wp_enqueue_style( THEME_ID . '-login', get_template_directory_uri() . '/login.css' );
}
add_action( 'login_enqueue_scripts', 'kidniche_login_stylesheet' );
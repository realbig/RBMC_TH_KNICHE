<?php
/**
 * Provides an options page for the theme.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', function() {
	add_options_page(
		'KidNiche Settings',
		'KidNiche Settings',
		'manage_options',
		'kidniche-settings',
		'_kidniche_page_kidniche_settings_output'
	);
});

function _kidniche_page_kidniche_settings_output() {

	// Include template
	include_once __DIR__ . '/views/html-kidniche-settings.php';
}

// Register settings
add_action( 'admin_init', function() {

	register_setting( 'kidniche-settings', 'kidniche_about_page' );
});
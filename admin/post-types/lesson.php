<?php
/**
 * Lesson post type.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'lesson', 'Activity', 'Activities', array(
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports'  => array( 'title', 'editor', 'thumbnail', 'author' ),
		'has_archive' => false,
		'rewrite' => array(
			'slug' => 'activity',
		),
	) );
} );
<?php
/**
 * The theme's admin file for providing additional admin-related functionality.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Require files
require_once __DIR__ . '/post-types/testimonial.php';
require_once __DIR__ . '/post-types/book.php';
require_once __DIR__ . '/extra-meta/home.php';
require_once __DIR__ . '/extra-meta/contact.php';
require_once __DIR__ . '/extra-meta/shop.php';

/**
 * Easy way to register a new post type!
 *
 * Example: easy_register_post_type( 'book', 'Book', 'Books', array( 'menu_icon' => 'dashicons-book' ) );
 *
 * @param string $name         The name of the post type (not the label, must be lowercase and no spaces or dashes).
 * @param string $label        The label of the post type. This is public facing.
 * @param string $label_plural The plural version of the label.
 * @param array  $_args        An array of args to overwrite or add to the register_post_type() args.
 */
function easy_register_post_type( $name, $label, $label_plural, $_args = array() ) {

	global $_easy_post_type_messages;

	$labels = array(
		'name'               => $label_plural,
		'singular_name'      => $label,
		'menu_name'          => $label_plural,
		'name_admin_bar'     => $label,
		'add_new'            => "Add New",
		'add_new_item'       => "Add New $label",
		'new_item'           => "New $label",
		'edit_item'          => "Edit $label",
		'view_item'          => "View $label",
		'all_items'          => "All $label_plural",
		'search_items'       => "Search $label_plural",
		'parent_item_colon'  => "Parent $label_plural:",
		'not_found'          => "No $label_plural found.",
		'not_found_in_trash' => "No $label_plural found in Trash.",
	);

	$args = wp_parse_args( $_args, array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $name ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	) );

	register_post_type( $name, $args );

	$_easy_post_type_messages[ $name ] = $label;
}

/**
 * Filters the custom post type messages.
 *
 * @param array $messages Array of all post type messages.
 * @return array The updated messages.
 */
add_filter( 'post_updated_messages', function ( $messages ) {

	global $_easy_post_type_messages;

	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );

	if ( isset( $_easy_post_type_messages[ $post_type ] ) ) {

		$label                  = $_easy_post_type_messages[ $post_type ];
		$messages[ $post_type ] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => "$label updated.",
			2  => 'Custom field updated.',
			3  => 'Custom field deleted.',
			4  => "$label updated.",
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? "$label restored to revision from " . wp_post_revision_title( (int) $_GET['revision'], false ) : false,
			6  => "$label published.",
			7  => "$label saved.",
			8  => "$label submitted.",
			9  => "$label scheduled for: <strong>" . date( 'M j, Y @ G:i', strtotime( $post->post_date ) ) . '</strong>.',
			10 => "$label draft updated.",
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink = get_permalink( $post->ID );

			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), "View $label" );
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link      = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), "Preview $label" );
			$messages[ $post_type ][8] .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;
		}
	}

	return $messages;
} );
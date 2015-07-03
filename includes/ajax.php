<?php
/**
 * The theme's ajax functionality.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'wp_ajax_kniche_load_posts', '_kniche_load_posts' );
add_action( 'wp_ajax_nopriv_kniche_load_posts', '_kniche_load_posts' );

function _kniche_load_posts() {

	$settings = $_POST['settings'];

	$posts = get_posts( $settings );

	$response = array(
		'status' => 'good',
		'post_count' => 0,
		'posts' => array(),
	);

	if ( empty( $posts ) ) {
		$response['status'] = 'no_posts';
	} else {

		global $post;

		foreach ( $posts as $i => $post ) {

			setup_postdata( $post );

			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );

			$new_post = array(
				'title' => get_the_title( $post->ID ),
				'excerpt' => apply_filters( 'the_excerpt', get_the_excerpt() ),
				'image' => $image ? $image[0] : '',
				'link' => get_permalink( $post->ID ),
			);

			$posts[ $i ] = $new_post;

			wp_reset_postdata();
		}

		$response['posts'] = $posts;
		$response['post_count'] = count( $posts );
	}

	wp_send_json( $response );
}
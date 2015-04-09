<?php
/**
 * Testimonial post type.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'testimonial', 'Testimonial', 'Testimonials', array(
		'menu_icon' => 'dashicons-testimonial',
		'supports'  => array( 'title', 'editor', 'thumbnail', 'author' ),
		'rewrite'   => array( 'slug' => 'testimonials' ),
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'kidniche-role',
		'Role',
		'_kidniche_metabox_testimonial_role',
		'testimonial'
	);
} );

/**
 * The form callback for the testimonial role.
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _kidniche_metabox_testimonial_role( $post ) {

	wp_nonce_field( 'testimonial_role', 'testimonial_role_nonce' );

	$testimonial_role = get_post_meta( $post->ID, '_testimonial_role', true );
	?>
	<label>
		<input type="text" class="widefat" name="testimonial_role" value="<?php echo $testimonial_role; ?>"/>
	</label>
<?php
}

add_action( 'save_post', function ( $post_id ) {

	if ( ! isset( $_POST['testimonial_role_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['testimonial_role_nonce'], 'testimonial_role' ) ) {
		return;
	}


	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'render_shortcode' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( empty( $_POST['testimonial_role'] ) ) {
		delete_post_meta( $post_id, '_testimonial_role' );
	} else {
		update_post_meta( $post_id, '_testimonial_role', $_POST['testimonial_role'] );
	}
} );
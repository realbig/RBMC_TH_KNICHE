<?php
/**
 * Contact us template extra meta.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_kidniche_add_metaboxes_contact' );
add_action( 'save_post', '_kidniche_save_metaboxes_contact' );

function _kidniche_add_metaboxes_contact() {

	global $post;

	if ( get_post_meta( $post->ID, '_wp_page_template', true ) != 'page-templates/contact.php' ) {
		return;
	}

	add_meta_box(
		'kidniche_mb_contact_extra',
		__( 'Gravity Form ID', 'KidNiche' ),
		'_kidniche_mb_contact_extra_callback',
		'page'
	);
}

function _kidniche_mb_contact_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'kidniche_mb_contact_extra_nonce' );

	$welcome_blurb_title = get_post_meta( $post->ID, '_kidniche_contact_form', true );
	?>
	<p>
		<label>
			<input type="text" name="_kidniche_contact_form"
			       value="<?php echo $welcome_blurb_title; ?>"/>
		</label>
	</p>
<?php
}

function _kidniche_save_metaboxes_contact( $post_ID ) {

	if ( ! isset( $_POST['kidniche_mb_contact_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['kidniche_mb_contact_extra_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_kidniche_contact_form',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}
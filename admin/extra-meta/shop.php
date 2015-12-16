<?php
/**
 * Shop extra meta.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_kidniche_add_metaboxes_shop' );
add_action( 'save_post', '_kidniche_save_metaboxes_shop' );

function _kidniche_add_metaboxes_shop() {

	global $post;

	if ( ! function_exists( 'is_shop' ) || get_option( 'woocommerce_shop_page_id' ) != $post->ID ) {
		return;
	}

	add_meta_box(
		'kidniche_mb_shop_extra',
		__( 'Gravity Form ID', 'KidNiche' ),
		'_kidniche_mb_shop_extra_callback',
		'page'
	);

    add_meta_box(
		'kidniche_mb_user_updater',
		__( 'Gravity Form User Updater ID', 'KidNiche' ),
		'_kidniche_mb_user_updater_callback',
		'page'
	);

}

function _kidniche_mb_shop_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'kidniche_mb_shop_extra_nonce' );

	$shop_form = get_post_meta( $post->ID, '_kidniche_shop_form', true );
	?>
	<p>
		<label>
			<input type="text" name="_kidniche_shop_form"
			       value="<?php echo $shop_form; ?>"/>
		</label>
	</p>
<?php
}

function _kidniche_mb_user_updater_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'kidniche_mb_user_updater_nonce' );

	$updater_form = get_post_meta( $post->ID, '_kidniche_user_update_form', true );
	?>
	<p>
		<label>
			<input type="text" name="_kidniche_user_update_form"
			       value="<?php echo $updater_form; ?>"/>
		</label>
	</p>
<?php
}

function _kidniche_save_metaboxes_shop( $post_ID ) {

	if ( ! isset( $_POST['kidniche_mb_shop_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['kidniche_mb_shop_extra_nonce'], __FILE__ ) ) {
		return;
	}

    if ( ! isset( $_POST['kidniche_mb_user_updater_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['kidniche_mb_user_updater_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_kidniche_shop_form',
        '_kidniche_user_update_form',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}

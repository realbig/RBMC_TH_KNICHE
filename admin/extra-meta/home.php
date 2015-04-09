<?php
/**
 * Home extra meta.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', '_kidniche_add_metaboxes_home' );
add_action( 'save_post', '_kidniche_save_metaboxes_home' );

function _kidniche_add_metaboxes_home() {

	global $post;

	if ( $post->post_name != 'home' ) {
		return;
	}

	// Disable editor
	remove_post_type_support( 'page', 'editor' );

	add_meta_box(
		'kidniche_mb_home_extra',
		__( 'Home Information', 'KidNiche' ),
		'_kidniche_mb_home_extra_callback',
		'page'
	);
}

function _kidniche_mb_home_extra_callback() {

	global $post;

	wp_nonce_field( __FILE__, 'kidniche_mb_home_extra_nonce' );

	$welcome_blurb_title = get_post_meta( $post->ID, '_kidniche_home_welcome_blurb_title', true );
	$welcome_blurb       = get_post_meta( $post->ID, '_kidniche_home_welcome_blurb', true );
	$author_image        = get_post_meta( $post->ID, '_kidniche_home_author_image', true );
	$about_the_author    = get_post_meta( $post->ID, '_kidniche_home_about_the_author', true );
	$author_social       = get_post_meta( $post->ID, '_kidniche_home_author_social', true );
	$blog_post_count     = get_post_meta( $post->ID, '_kidniche_home_blog_post_count', true );
	?>

	<h2>Welcome Blurb</h2>

	<p>
		<label>
			Welcome Blurb Title:
			<br/>
			<input type="text" class="widefat" name="_kidniche_home_welcome_blurb_title"
			       value="<?php echo $welcome_blurb_title; ?>"/>
		</label>
	</p>

	<p>
		<label>
			Welcome Blurb:
			<br/>
			<input type="text" class="widefat" name="_kidniche_home_welcome_blurb"
			       value="<?php echo $welcome_blurb; ?>"/>
		</label>
	</p>

	<h2>About the Author</h2>

	<p>
		<label>
			Author Image:
			<br/>
			<img class="image-preview" style="max-width: 100%; max-height: 300px;"
			     src="<?php $image = wp_get_attachment_image_src( $author_image, 'medium' ); echo $image[0]; ?>"/>
			<input type="hidden" class="image-id" name="_kidniche_home_author_image"
			       value="<?php echo $author_image; ?>"/>
			<input type="button" class="button image-button"
			       value="<?php _e( 'Choose or Upload an Image', 'KidNiche' ) ?>"/>
		</label>
	</p>

	<p>
		<label>
			About the Author:
			<br/>
			<textarea class="widefat" style="height: 60px;"
			          name="_kidniche_home_about_the_author"><?php echo $about_the_author; ?></textarea>
		</label>
	</p>

	<p>
		<label>
			Author social:
			<br/>
			<textarea class="widefat" style="height: 60px;"
			          name="_kidniche_home_author_social"><?php echo $author_social; ?></textarea>
		</label>
	</p>

	<h2>From the Blog</h2>

	<p>
		<label>
			Post Count:
			<br/>
			<input type="text" name="_kidniche_home_blog_post_count"
			       value="<?php echo $blog_post_count; ?>">
		</label>
	</p>
<?php
}

function _kidniche_save_metaboxes_home( $post_ID ) {

	if ( ! isset( $_POST['kidniche_mb_home_extra_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['kidniche_mb_home_extra_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_kidniche_home_welcome_blurb_title',
		'_kidniche_home_welcome_blurb',
		'_kidniche_home_author_image',
		'_kidniche_home_about_the_author',
		'_kidniche_home_author_social',
		'_kidniche_home_blog_post_count',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}
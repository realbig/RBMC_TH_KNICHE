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

	$featured_background         = get_post_meta( $post->ID, '_kidniche_home_featured_background', true );
	$featured_background_preview = $featured_background ? wp_get_attachment_image_src( $featured_background, 'medium' ) : '';
	$featured_image              = get_post_meta( $post->ID, '_kidniche_home_featured_image', true );
	$featured_image_preview      = $featured_image ? wp_get_attachment_image_src( $featured_image, 'medium' ) : '';
	$featured_blurb              = get_post_meta( $post->ID, '_kidniche_home_featured_blurb', true );
	$welcome_blurb_title = get_post_meta( $post->ID, '_kidniche_home_welcome_blurb_title', true );
	$welcome_blurb       = get_post_meta( $post->ID, '_kidniche_home_welcome_blurb', true );
	$blog_post_count     = get_post_meta( $post->ID, '_kidniche_home_blog_post_count', true );
	?>

	<h2>Featured Product Section</h2>

	<p>
		<label>
			Section Background:
			<br/>
			<img src="<?php echo $featured_background_preview[0]; ?>" class="image-preview"
			     style="max-width: 100%; width: 300px;"/>
			<br/>
			<input type="hidden" class="image-id" name="_kidniche_home_featured_background"
			       value="<?php echo $featured_background; ?>"/>
			<a class="image-button button">Upload / Choose Image</a>
		</label>
	</p>

	<p>
		<label>
			Product Image:
			<br/>
			<img src="<?php echo $featured_image_preview[0]; ?>" class="image-preview"
			     style="max-width: 100%; width: 300px;"/>
			<br/>
			<input type="hidden" class="image-id" name="_kidniche_home_featured_image"
			       value="<?php echo $featured_image; ?>"/>
			<a class="image-button button">Upload / Choose Image</a>
		</label>
	</p>

	<label for="_kidniche_home_featured_blurb">
		Blurb:
	</label>

		<?php
		wp_editor( $featured_blurb, '_kidniche_home_featured_blurb', array(
			'teeny' => true,
			'id'    => '_kidniche_home_featured_blurb',
			'textarea_rows' => 6,
			'name'  => '_kidniche_home_featured_blurb,'
		) );
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
		'_kidniche_home_featured_background',
		'_kidniche_home_featured_image',
		'_kidniche_home_featured_blurb',
		'_kidniche_home_welcome_blurb_title',
		'_kidniche_home_welcome_blurb',
		'_kidniche_home_blog_post_count',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
}
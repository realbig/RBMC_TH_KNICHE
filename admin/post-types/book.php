<?php
/**
 * Book post type.
 *
 * @since   1.0.0
 * @package Render
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'book', 'Book', 'Books', array(
		'menu_icon' => 'dashicons-book',
		'supports'  => array( 'title' ),
		'rewrite'   => array( 'slug' => 'books' ),
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'kidniche-book-product-link',
		'Product Link',
		'_kidniche_metabox_book_product_link',
		'book'
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
function _kidniche_metabox_book_product_link( $post ) {

	wp_nonce_field( __FILE__, 'book_product_link_nonce' );

	$product_link = (int) get_post_meta( $post->ID, '_product_link', true );

	$products = get_posts( array(
		'post_type' => 'product',
	) );
	?>
	<label>
		<?php
		if ( ! empty( $products ) ) {
			?>
			<select name="_product_link" data-placeholder="Select a product" class="chosen">
				<option></option>
				<?php
				foreach ( $products as $product ) {
					?>
					<option value="<?php echo $product->ID; ?>" <?php selected( $product->ID, $product_link ); ?>>
						<?php echo $product->post_title; ?>
					</option>
					<?php
				}
				?>
			</select>
		<?php
		}
		?>
	</label>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['book_product_link_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['book_product_link_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_product_link',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );
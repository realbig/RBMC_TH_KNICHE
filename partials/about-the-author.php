<?php
/**
 * About the author section.
 *
 * @since   1.0.0
 * @package KidNiche
 *
 * @global $author_ID
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<div class="about-the-author row collapse">

	<?php
	$author_info = get_userdata( $author_ID );
	$author_link = get_permalink( get_option( 'kidniche_about_page', 0 ) );
	$author_name = $author_info->data->display_name ? $author_info->data->display_name : '';
	?>
	<div class="author-meta columns small-12 medium-3">
		<div class="author-image">
			<?php
			if ( function_exists( 'get_wp_user_avatar' ) ) {
				echo get_wp_user_avatar( $author_ID, 'thumbnail' );
			} else {
				echo get_avatar( $author_ID, 500 );
			}
			?>
		</div>

		<div class="author-social">
			<?php
			if ( $facebook = get_user_meta( $author_ID, 'facebook', true ) ) {
				echo _kidniche_sc_facebook( array( 'link' => $facebook ) );
			}

			if ( $twitter = get_user_meta( $author_ID, 'twitter', true ) ) {
				echo _kidniche_sc_twitter( array( 'link' => $twitter ) );
			}

			if ( $linkedin = get_user_meta( $author_ID, 'linkedin', true ) ) {
				echo _kidniche_sc_linkedin( array( 'link' => $linkedin ) );
			}
			?>
		</div>
	</div>

	<div class="author-info columns small-12 medium-9">

		<h3 class="author-title">
			<a href="<?php echo $author_link; ?>">
				About the author
			</a>
		</h3>

		<h4 class="author-name">
			<a href="<?php echo $author_link; ?>">
				<?php echo $author_name; ?>
			</a>
		</h4>

		<div class="author-content">
			<?php
			echo wpautop( $author_info->description );
			?>
		</div>
	</div>
</div>

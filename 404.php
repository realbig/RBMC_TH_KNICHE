<?php
/**
 * The theme's 404 page for showing not found pages.
 *
 * @since 1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

kidniche_page_start();
?>
		<div class="page-content columns small-12 medium-9">
			<?php kidniche_page_title( __( '404 - Page not found', 'KidNiche' ) ); ?>

			<p>
				<?php _e( 'Sorry, but this page doesn\'t seem to be here!', 'KidNiche' ); ?>
			</p>
		</div>

		<?php get_sidebar(); ?>
<?php
kidniche_page_end();

get_footer();
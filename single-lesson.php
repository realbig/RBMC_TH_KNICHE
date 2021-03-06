<?php
/**
 * Shows lessons.
 *
 * @since   1.0.0
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
		<?php kidniche_page_title(); ?>

		<?php the_content(); ?>

		<?php comments_template(); ?>
	</div>

<?php
get_sidebar( 'lesson' );

kidniche_page_end();

get_footer();
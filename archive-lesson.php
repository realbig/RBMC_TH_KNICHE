<?php
/**
 * The theme's archive file for generic display of post archives.
 *
 * @since   1.0.0
 * @package KidNiche
 *
 * @global WP_Query $wp_query
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$post_type = $wp_query->query['post_type'];

get_header();

kidniche_page_start();

kidniche_page_title( post_type_archive_title( '', false ) );

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12">
		<div class="<?php echo $post_type; ?>-list">
			<?php
			while ( have_posts() ) :
				the_post();
				kidniche_post_loop_content();
			endwhile;
			?>
		</div>

		<?php // Extra space ?>
		<p>&nbsp;</p>
		<p class="text-center">
			<?php kniche_load_more(); ?>
		</p>
	</div>
<?php
endif;

kidniche_page_end();

get_footer();
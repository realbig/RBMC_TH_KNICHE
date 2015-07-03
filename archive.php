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

switch( $title = post_type_archive_title( '', false ) ) {
	case 'Testimonials':
		$title = 'Reviews';
		break;
}

kidniche_page_title( $title );

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12 medium-9">
		<div class="<?php echo $post_type; ?>-list">
			<?php
			while ( have_posts() ) :
				the_post();
				kidniche_post_loop_content();
			endwhile;
			?>
		</div>
	</div>
<?php
endif;

get_sidebar();

kidniche_page_end();

get_footer();
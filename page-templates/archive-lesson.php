<?php
/**
 * Template Name: Lesson Archive
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
	<div class="page-content columns small-12">

		<?php kidniche_page_title(); ?>

		<div class="page-copy">
			<?php the_content(); ?>
		</div>

		<?php
		$lessons = get_posts( array(
			'post_type'   => 'lesson',
			'numberposts' => - 1,
		) );

		if ( ! empty( $lessons ) ) :
			global $post;
			?>
			<div class="lesson-list">
				<?php
				foreach ( $lessons as $post ) :
					setup_postdata( $post );
					kidniche_post_loop_content();
				endforeach;

				wp_reset_postdata();
				?>
			</div>
		<?php endif; ?>
	</div>
<?php
kidniche_page_end();

get_footer();
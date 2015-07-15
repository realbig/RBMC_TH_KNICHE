<?php
/**
 * Template Name: Activity Archive
 *
 * @since   1.0.0
 * @package KidNiche
 *
 * @global int $page Current paged number
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function kniche_lesson_pagination( $page, $lessons ) {

	$all_lessons = get_posts( array(
		'post_type'   => 'lesson',
		'numberposts' => - 1,
	) );

	$total_lessons = count( $all_lessons );

	$total_pages = ceil( $total_lessons / 30 );

	$page_links = array();

	// Exact pages
	for ( $i = 0; $i < $total_pages; $i ++ ) {

		if ( $page !== $i + 1 ) {
			$page_link = '<a href="' . add_query_arg( 'page', $i + 1 ) . '">';
		} else {
			$page_link = '<span>';
		}

		$first_lesson = $i * 3;
		$first_lesson = $first_lesson === 0 ? 1 : $first_lesson;

		$last_lesson = ( $i * 3 ) + 3;

		$page_link .= "{$first_lesson}a - {$last_lesson}c";

		if ( $page !== $i + 1 ) {
			$page_link .= '</a>';
		} else {
			$page_link .= '</span>';
		}

		$page_links[] = $page_link;
	}

	$prefix  = count( $page_links ) > 4 ? true : false;
	$postfix = count( $page_links ) > 3 ? true : false;

	$page_links = kniche_trim_array_ends( $page_links, 3 );

	// First, next
	if ( $page > 1 ) {

		if ( $prefix ) {
			array_unshift( $page_links, '...' );
		}

		array_unshift( $page_links, '<a href="' . add_query_arg( 'page', $page ? $page - 1 : 1 ) . '" title="Previous"><</a>' );
		array_unshift( $page_links, '<a href="' . get_permalink( get_the_ID() ) . '" title="First"><<</a>' );
	}

	// Next, last
	if ( count( $lessons ) == 30 ) {

		if ( $postfix ) {
			$page_links[] = '...';
		}

		$page_links[] = '<a href="' . add_query_arg( 'page', $page ? $page + 1 : 2 ) . '" title="Next">></a>';
		$page_links[] = '<a href="' . add_query_arg( 'page', ceil( $total_lessons / 30 ) ) . '" title="Last">>></a>';
	}

	foreach ( $page_links as $i => $link ) {
		echo $link . ( $i + 1 < count( $page_links ) ? '&nbsp;' : '' );
	}
}

function kniche_trim_array_ends( $array, $length ) {

	if ( count( $array ) > $length ) {
		$array = array_splice( $array, 0, count( $array ) - 1 );
	}

	if ( count( $array ) > $length ) {
		$array = array_splice( $array, 1, count( $array ) );
	}

	if ( count( $array ) > $length ) {
		$array = kniche_trim_array_ends( $array, $length );
	}

	return $array;
}

$lessons_page = $page;

get_header();

the_post();

kidniche_page_start();
?>
	<div class="page-content columns small-12 medium-9">

		<?php kidniche_page_title(); ?>

		<div class="page-copy">
			<?php the_content(); ?>
		</div>

		<?php
		$lessons = get_posts( array(
			'post_type'   => 'lesson',
			'numberposts' => 30,
			'offset'      => $lessons_page > 1 ? ( $lessons_page - 1 ) * 30 : 0,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		) );

		if ( ! empty( $lessons ) ) :
			global $post;
			?>
			<div class="lesson-pagination text-center">
				<?php kniche_lesson_pagination( $lessons_page, $lessons ); ?>
			</div>

			<div class="lesson-list">
				<?php
				foreach ( $lessons as $post ) :
					setup_postdata( $post );
					kidniche_post_loop_content();
				endforeach;

				wp_reset_postdata();
				?>
			</div>

			<div class="lesson-pagination text-center">
				<?php kniche_lesson_pagination( $lessons_page, $lessons ); ?>
			</div>
		<?php endif; ?>
	</div>
<?php
get_sidebar( 'lesson' );

kidniche_page_end();

get_footer();
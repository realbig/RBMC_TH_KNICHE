<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in KidNiche theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $theme_fonts ) ) {
	wp_die( 'ERROR in KidNiche theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '1.0.0' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'kidniche' );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$theme_fonts = array(
	'architects-daughter' => 'http://fonts.googleapis.com/css?family=Architects+Daughter',
);

/**
 * Setup theme properties and stuff.
 *
 * @since 1.0.0
 */
add_action( 'after_theme_setup', function () {

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter( 'widget_text', 'do_shortcode' );
} );

/**
 * Register theme files.
 *
 * @since 1.0.0
 */
add_action( 'init', function () {

	global $theme_fonts;

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		array( 'woocommerce-general' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Admin script
	wp_register_script(
		THEME_ID . '-admin',
		get_template_directory_uri() . '/admin.js',
		array( 'jquery', THEME_ID . '-chosen' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Chosen
	wp_register_script(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/lib/chosen/chosen.jquery.min.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Chosen
	wp_register_style(
		THEME_ID . '-chosen',
		get_template_directory_uri() . '/lib/chosen/chosen.min.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_register_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}
} );

/**
 * Enqueue theme files.
 *
 * @since 1.0.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $theme_fonts;

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_enqueue_style( THEME_ID . "-font-$ID" );
		}
	}
} );

/**
 * Enqueue admin script.
 *
 * @since 1.0.0
 */
add_action( 'admin_enqueue_scripts', function () {

	wp_enqueue_script( THEME_ID . '-admin' );
	wp_enqueue_script( THEME_ID . '-chosen' );
	wp_enqueue_style( THEME_ID . '-chosen' );
} );

/**
 * Register nav menus.
 *
 * @since 1.0.0
 */
add_action( 'after_setup_theme', function () {

	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'top_nav', 'Top Navigation' );
} );

/**
 * Register sidebars.
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', function () {

	// Primary
	register_sidebar( array(
		'name'         => 'Primary',
		'id'           => 'primary',
		'description'  => 'Displays on the side of most pages.',
		'before_title' => '<h3 class="widget-title">',
		'after_title'  => '</h3>',
	) );

	// Footer
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'footer',
		'description'   => 'Displays in the footer.',
		'before_title'  => '<h3 class="footer-widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '',
		'after_widget'  => '',
	) );
} );

/**
 * Outputs the theme page title.
 *
 * @since 1.0.0
 *
 * @param bool|string $title Enter a string to override the title.
 */
function kidniche_page_title( $title = false ) {

	$title = $title === false ? get_the_title() : $title;
	?>
	<h1 class="page-title">
		<?php echo $title; ?>
	</h1>
	<?php
	wp_reset_postdata();
}

/**
 * Outputs the HTML to start a page.
 *
 * @since 1.0.0
 */
function kidniche_page_start() {
	include_once __DIR__ . '/partials/html-page-start.php';
}

/**
 * Outputs the HTML to end a page.
 *
 * @since 1.0.0
 */
function kidniche_page_end() {
	include_once __DIR__ . '/partials/html-page-end.php';
}

/**
 * Outputs the HTML of a post in the loop.
 *
 * @since 1.0.0
 */
function kidniche_post_loop_content() {
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'row' ) ); ?>>

		<?php
		$column_class = 'medium-12';
		if ( has_post_thumbnail() ) {
			?>
			<div class="post-image columns small-12 medium-3">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
			<?php
			$column_class = 'medium-9';
		}
		?>

		<div class="post-content columns small-12 <?php echo $column_class; ?>">

			<h4 class="post-title">
				<a href="<?php the_permalink(); ?>" class="color-invert">
					<?php the_title(); ?>
				</a>
			</h4>

			<p class="post-comment-count">
				<span class="icon-bubble"></span>
				<?php $comment_count = wp_count_comments()->approved; ?>
				<?php echo $comment_count . _n( ' comment', ' comments', $comment_count ); ?>
			</p>

			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<a href="<?php the_permalink(); ?>" class="read-more button tiny">
				<?php _e( 'Read More', 'KidNiche' ); ?>
			</a>

		</div>

	</article>
<?php
}

function custom_excerpt_length( $length = 15, $append = '...' ) {

	global $post;

	$excerpt = explode( ' ', strip_tags( get_the_excerpt( $post ) ) );

	// Determine if appending is necessary
	if ( count( $excerpt ) <= $length ) {
		$append = '';
	}

	$excerpt = implode( ' ', array_splice( $excerpt, 0, $length ) );

	return $excerpt . $append;
}

// Include other static files
require_once __DIR__ . '/includes/shortcodes.php';
require_once __DIR__ . '/includes/widgets.php';
require_once __DIR__ . '/includes/login.php';
require_once __DIR__ . '/admin/admin.php';
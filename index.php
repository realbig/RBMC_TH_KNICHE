<?php
/**
 * The theme's index file for displaying a list of blog posts.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// FIXED Remove period from slogan
// FIXED top menu alignment (left side)
// FIXED move top menu to align right, cart flush to the right
// FIXED Login in message is reversed... and move it to left align
// FIXED Featured books, same height, cart stays at bottom
// FIXED Gutter on featured books (everywhere!) same as welcome blurb (home page)
// FIXED Main header background, change
// FIXED Move logo down on sub-pages so trunk comes into content more, ties into increased page gutters
// FIXED align classes in content
// FIXED responsive lightbox for content images
// FIXED Online store buttons need to match better (actually, all buttons on WC pages are messed up) (buy button hover)
// FIXED Book landing page header text too big
// FIXED Shop items equalizer, button and price vertical alignment
// FIXED Style Book Page template
// FIXED direct form submissions to kidniche@gmail.com
// FIXED Add link to Privacy Policy from home page footer
// FIXED Style Contact Us page
// FIXED fix Captcha error.
// FIXED Add workflow for client to request wholesaler order status. Place link in footer for now. This should be a form with questions and a check box that they agree to the T&C  available here. Questions required - Name - Email - Company - Address - Phone - Tax ID
// FIXED Store page notification for wholesale, as well as the notification containing a button to pop-up an AJAX form to submit. (NO REDIRECT)
// FIXED Add purchase workflow for digital download of Workbook requiring the end user to sign off on T&C available here

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

kidniche_page_start();

kidniche_page_title( __( 'Blog', 'KidNiche' ) );

if ( have_posts() ) :
	?>
	<div class="page-content columns small-12 medium-9">
		<div class="post-list">
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
<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$privacy_policy_page = get_page_by_path( 'privacy-policy' );
?>

<footer id="site-footer">
	<div class="row">
		<div class="columns small-12">

			<?php dynamic_sidebar( 'footer' ); ?>

			<?php if ( $privacy_policy_page ) : ?>
				<p class="privacy-policy text-center">
					<a href="<?php echo get_permalink( $privacy_policy_page->ID ); ?>">
						View Privacy Policy
					</a>
				</p>
			<?php endif; ?>

		</div>
	</div>
</footer>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

<script type = "text/javascript">

    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71404004-1', 'auto');
    ga('require', 'linkid');
    ga('send', 'pageview');

</script>

</body>
</html>

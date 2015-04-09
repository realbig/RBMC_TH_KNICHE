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
?>

<footer id="site-footer" class="row">

	<div class="columns small-12">

		<?php dynamic_sidebar( 'footer' ); ?>

	</div>

</footer>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
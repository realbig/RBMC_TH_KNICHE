<?php
/**
 * The theme's sidebar file that appears on most pages.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<aside id="site-sidebar" class="columns small-12 medium-3">

	<ul class="widgets">
		<?php dynamic_sidebar( 'primary' ); ?>
	</ul>

</aside>
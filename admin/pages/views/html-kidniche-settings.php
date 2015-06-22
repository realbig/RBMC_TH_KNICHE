<?php
/**
 * KidNiche Settings page HTML.
 *
 * @since   1.0.0
 * @package KidNiche
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<div class="wrap">

	<h2>KidNiche Settings</h2>

	<form method="post" action="options.php">

		<?php settings_fields( 'kidniche-settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="kidniche_about_page">
						About Page
					</label>
				</th>
				<td>
					<?php
					wp_dropdown_pages( array(
						'name'             => 'kidniche_about_page',
						'selected'         => get_option( 'kidniche_about_page', 0 ),
						'show_option_none' => '- Select a Page -',
					) );
					?>
					<br/>
					<label>
						Anchor
						<input type="text" name="kidniche_about_page_anchor" class="regular-text"
						       value="<?php echo esc_attr( get_option( 'kidniche_about_page_anchor' ) ); ?>"/>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="kidniche_testimonial_widget_slider_interval">
						Testimonial Slider Widget Delay
					</label>
				</th>
				<td>
					<input type="text" name="kidniche_testimonial_widget_slider_interval"
					       id="kidniche_testimonial_widget_slider_interval"
					       value="<?php echo get_option( 'kidniche_testimonial_widget_slider_interval', 5000 ); ?>" />

					<p class="description">Enter in seconds</p>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>
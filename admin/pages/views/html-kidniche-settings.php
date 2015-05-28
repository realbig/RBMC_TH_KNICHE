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
						'name' => 'kidniche_about_page',
						'selected' => get_option( 'kidniche_about_page', 0 ),
						'show_option_none' => '- Select a Page -',
					));
					?>
					<br/>
					<label>
						Anchor
						<input type="text" name="kidniche_about_page_anchor" class="regular-text"
						       value="<?php esc_attr( get_option( 'kidniche_about_page_anchor' ) ); ?>"/>
					</label>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>
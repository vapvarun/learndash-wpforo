<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wbcomdesigns.com/plugins
 * @since      1.0.0
 *
 * @package    Learndash_Wpforo
 * @subpackage Learndash_Wpforo/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
/**
 * This file is used for rendering and saving plugin welcome settings.
 *
 * @package    Lms_Related_Courses
 * @subpackage Lms_Related_Courses/admin/partials
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
	// Exit if accessed directly.
}
?>

<div class="wbcom-tab-content">
	<div class="ld-wpforo-adming-setting">
		<div class="ld-wpforo-tab-header"><h3><?php esc_html_e( 'FAQ(s)', 'learndash-wpforo' ); ?></h3></div>
		<div class="ld-wpforo-admin-settings-block">
			<div id="ld-wpforo-settings-tbl">
				<div class="ld-wpforo-admin-row">
					<div>
						<button class="ld-wpforo-accordion"><?php esc_html_e( 'Does this plugin require LearnDash?', 'learndash-wpforo' ); ?></button>
						<div class="panel">
							<p><?php esc_html_e( 'Yes, It needs you to have LearnDash installed and activated.', 'learndash-wpforo' ); ?></p>
						</div>
					</div>
				</div>
				<div class="ld-wpforo-admin-row">
					<div>
						<button class="ld-wpforo-accordion"><?php esc_html_e( 'If I need to customize plugin, to whom I should contact?', 'learndash-wpforo' ); ?></button>
						<div class="panel">
							<p><?php esc_html_e( 'If you need additional help you can contact us at' ); ?> <a href="<?php echo esc_url( 'https://wbcomdesigns.com/contact/' ); ?>" title="<?php esc_attr( 'Wbcom Designs' ); ?>" target="_blank" ><?php esc_html_e( 'Wbcom Designs', 'learndash-wpforo' ); ?></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

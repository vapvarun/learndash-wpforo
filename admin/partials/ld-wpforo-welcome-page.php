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
	<div class="wbcom-welcome-main-wrapper">
		<div class="wbcom-welcome-head">
			<h2 class="wbcom-welcome-title"><?php esc_html_e( 'Learndash wpForo', 'learndash-wpforo' ); ?></h2>
			<p class="wbcom-welcome-description"><?php esc_html_e( 'Using forums on your e-learning website will increase the engagement of your learners with your courses. All you need is the integration of wpForo Forum and Learndash wpForo.', 'learndash-wpforo' ); ?></p>
		</div><!-- .wbcom-welcome-head -->
		<div class="wbcom-welcome-content">
			<div class="wbcom-video-link-wrapper">
		</div>

			<div class="wbcom-welcome-support-info">
				<h3><?php esc_html_e( 'Help &amp; Support Resources', 'learndash-wpforo' ); ?></h3>
				<p><?php esc_html_e( 'Here are all the resources you may need to get help from us. Documentation is usually the best place to start. Should you require help anytime, our customer care team is available to assist you at the support center.', 'learndash-wpforo' ); ?></p>
				<hr>

				<div class="three-col">

					<div class="col">
						<h3><span class="dashicons dashicons-book"></span><?php esc_html_e( 'Documentation', 'learndash-wpforo' ); ?></h3>
						<p><?php esc_html_e( 'We have prepared an extensive guide on Learndash wpForo to learn all aspects of the plugin. You will find most of your answers here.', 'learndash-wpforo' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/downloads/learndash-wpforo/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Read Documentation', 'learndash-wpforo' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( 'Support Center', 'learndash-wpforo' ); ?></h3>
						<p><?php esc_html_e( 'We strive to offer the best customer care via our support center. Once your theme is activated, you can ask us for help anytime.', 'learndash-wpforo' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/support/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Get Support', 'learndash-wpforo' ); ?></a>
					</div>

					<div class="col">
						<h3><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e( 'Got Feedback?', 'learndash-wpforo' ); ?></h3>
						<p><?php esc_html_e( 'We want to hear about your experience with the plugin. We would also love to hear any suggestions you may for future updates.', 'learndash-wpforo' ); ?></p>
						<a href="<?php echo esc_url( 'https://wbcomdesigns.com/contact/' ); ?>" class="button button-primary button-welcome-support" target="_blank"><?php esc_html_e( 'Send Feedback', 'learndash-wpforo' ); ?></a>
					</div>

				</div>

			</div>
		</div>

	</div><!-- .wbcom-welcome-content -->
</div><!-- .wbcom-welcome-main-wrapper -->

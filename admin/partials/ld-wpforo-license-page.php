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
<?php
$license = get_option( 'edd_wbcom_LDWPF_license_key', true );
$status  = get_option( 'edd_wbcom_LDWPF_license_status' );
?>

<div class="wbcom-tab-content">
  <div class="wbcom-welcome-main-wrapper">
	<div class="wb-plugins-license-tables-wrap">
	  <table class="form-table wb-license-form-table desktop-license-headings">
		<thead>
		  <tr>
			<th class="wb-product-th"><?php esc_html_e( 'Product', 'learndash-wpforo' ); ?></th>
			<th class="wb-version-th"><?php esc_html_e( 'Version', 'learndash-wpforo' ); ?></th>
			<th class="wb-key-th"><?php esc_html_e( 'Key', 'learndash-wpforo' ); ?></th>
			<th class="wb-status-th"><?php esc_html_e( 'Status', 'learndash-wpforo' ); ?></th>
			<th class="wb-action-th"><?php esc_html_e( 'Action', 'learndash-wpforo' ); ?></th>
		  </tr>
		</thead>
	  </table>
	  <?php do_action( 'wbcom_add_plugin_license_code' ); ?>
	  <table class="form-table wb-license-form-table">
		<tfoot>
		  <tr>
			<th class="wb-product-th"><?php esc_html_e( 'Product', 'learndash-wpforo' ); ?></th>
			<th class="wb-version-th"><?php esc_html_e( 'Version', 'learndash-wpforo' ); ?></th>
			<th class="wb-key-th"><?php esc_html_e( 'Key', 'learndash-wpforo' ); ?></th>
			<th class="wb-status-th"><?php esc_html_e( 'Status', 'learndash-wpforo' ); ?></th>
			<th class="wb-action-th"><?php esc_html_e( 'Action', 'learndash-wpforo' ); ?></th>
		  </tr>
		</tfoot>
	  </table>
	</div>
  </div>

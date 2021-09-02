<div class="wrap">
	<?php echo do_shortcode( '[wbcom_admin_setting_header]' ); ?>
    <h1 class="wbcom-plugin-heading"><?php esc_html_e( 'Plugin License Settings', 'buddypress-moderation-pro' ); ?></h1>
    <div class="wb-plugins-license-tables-wrap">
    	<table class="form-table wb-license-form-table desktop-license-headings">
			<thead>
				<tr>
					<th class="wb-product-th"><?php esc_html_e( 'Product', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-version-th"><?php esc_html_e( 'Version', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-key-th"><?php esc_html_e( 'Key', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-status-th"><?php esc_html_e( 'Status', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-action-th"><?php esc_html_e( 'Action', 'buddypress-moderation-pro' ); ?></th>
				</tr>
			</thead>
		</table>
    	<?php do_action( 'wbcom_add_plugin_license_code' ); ?>
    	<table class="form-table wb-license-form-table">
			<tfoot>
				<tr>
					<th class="wb-product-th"><?php esc_html_e( 'Product', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-version-th"><?php esc_html_e( 'Version', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-key-th"><?php esc_html_e( 'Key', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-status-th"><?php esc_html_e( 'Status', 'buddypress-moderation-pro' ); ?></th>
					<th class="wb-action-th"><?php esc_html_e( 'Action', 'buddypress-moderation-pro' ); ?></th>
				</tr>
			</tfoot>
		</table>
	</div>

    <!-- <table class="form-table wb-license-form-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Product', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Version', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Key', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Status', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Action', 'buddypress-moderation-pro' ); ?></th>
				<th></th>
			</tr>
		</thead>

		<form>
		<tr>
			<td class="wb-plugin-name">BuddyPress Profile Pro</td>
			<td class="wb-plugin-version">3.0.1</td>
			<td class="wb-plugin-license-key"><input id="edd_wbcom_wbbpp_license_key" name="edd_wbcom_wbbpp_license_key" type="text" class="regular-text" value="AIzaSyDej_OIorXYT5Ds7MR5TVDSbmcze08v020" /></td>
			<td class="wb-license-status active">Active</td>
			<td class="wb-license-action"><input type="submit" class="button-secondary" name="edd_license_deactivate" value="<?php _e( 'Deactivate License', 'buddypress-moderation-pro' ); ?>"/></td>
			<td><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></td>
		</tr>
		</form>
		<tr>
			<td class="wb-plugin-name">BuddyPress Polls</td>
			<td class="wb-plugin-version">3.0.1</td>
			<td class="wb-plugin-license-key"><input id="edd_wbcom_wbbpp_license_key" name="edd_wbcom_wbbpp_license_key" type="text" class="regular-text" value="AIzaSyDej_OIorXYT5Ds7MR5TVDSbmcze08v020" /></td>
			<td class="wb-license-status inactive">Inactive</td>
			<td class="wb-license-action"><input type="submit" class="button-secondary" name="edd_license_deactivate" value="<?php _e( 'Deactivate License', 'buddypress-moderation-pro' ); ?>"/></td>
			<td><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></td>
		</tr>
		<tr>
			<td class="wb-plugin-name">BuddyPress Private Community Pro</td>
			<td class="wb-plugin-version">3.0.1</td>
			<td class="wb-plugin-license-key"><input id="edd_wbcom_wbbpp_license_key" name="edd_wbcom_wbbpp_license_key" type="text" class="regular-text" value="AIzaSyDej_OIorXYT5Ds7MR5TVDSbmcze08v020" /></td>
			<td class="wb-license-status active">Active</td>
			<td class="wb-license-action"><input type="submit" class="button-secondary" name="edd_license_deactivate" value="<?php _e( 'Deactivate License', 'buddypress-moderation-pro' ); ?>"/></td>
			<td><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></td>
		</tr>
		<tfoot>
			<tr>
				<th><?php esc_html_e( 'Product', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Version', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Key', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Status', 'buddypress-moderation-pro' ); ?></th>
				<th><?php esc_html_e( 'Action', 'buddypress-moderation-pro' ); ?></th>
				<th></th>
			</tr>
		</tfoot>
    </table> -->
</div>

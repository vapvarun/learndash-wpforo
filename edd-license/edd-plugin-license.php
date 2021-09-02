<?php
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'EDD_LDWPF_STORE_URL', 'https://wbcomdesigns.com/' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of your product. This should match the download name in EDD exactly
// define('EDD_LDWPF_ITEM_NAME', 'PeepSo bbPress Integration'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
define( 'EDD_LDWPF_ITEM_NAME', 'Learndash wpForo' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of the settings page for the license input to be displayed
define( 'EDD_LDWPF_PLUGIN_LICENSE_PAGE', 'wbcom-license-page' );

if ( ! class_exists( 'EDD_LDWPF_Plugin_Updater' ) ) {
		// load our custom updater.
		include dirname( __FILE__ ) . '/EDD_LDWPF_Plugin_Updater.php';
}

function edd_LDWPF_plugin_updater() {
		// retrieve our license key from the DB.
		$license_key = trim( get_option( 'edd_wbcom_LDWPF_license_key' ) );

		// setup the updater
		$edd_updater = new EDD_LDWPF_Plugin_Updater(
			EDD_LDWPF_STORE_URL,
			LEARNDASH_WPFORO_FILE,
			array(
				'version'   => LEARNDASH_WPFORO_VERSION,             // current version number.
				'license'   => $license_key,        // license key (used get_option above to retrieve from DB).
				'item_name' => EDD_LDWPF_ITEM_NAME,  // name of this plugin.
				'author'    => 'wbcomdesigns',  // author of this plugin.
				'url'       => home_url(),
			)
		);
}
add_action( 'admin_init', 'edd_LDWPF_plugin_updater', 0 );

function edd_wbcom_LDWPF_register_option() {
	// creates our settings in the options table
	register_setting( 'edd_wbcom_LDWPF_license', 'edd_wbcom_LDWPF_license_key', 'edd_LDWPF_sanitize_license' );
}
add_action( 'admin_init', 'edd_wbcom_LDWPF_register_option' );

function edd_LDWPF_sanitize_license( $new ) {
	$old = get_option( 'edd_wbcom_LDWPF_license_key' );
	if ( $old && $old != $new ) {
		delete_option( 'edd_wbcom_LDWPF_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}


/************************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 */
 add_action( 'wbcom_add_plugin_license_code', 'edd_wbcom_LDWPF_license_page' );
function edd_wbcom_LDWPF_license_page() {
	$license     = get_option( 'edd_wbcom_LDWPF_license_key', true );
	$status      = get_option( 'edd_wbcom_LDWPF_license_status' );
	$plugin_data = get_plugin_data( LEARNDASH_WPFORO_PLUGIN_PATH . '/learndash-wpforo.php', $markup = true, $translate = true );

	if ( $status !== false && $status == 'valid' ) {
		$status_class = 'active';
		$status_text  = 'Active';
	} else {
		$status_class = 'inactive';
		$status_text  = 'Inactive';
	}
	?>
		<table class="form-table wb-license-form-table mobile-license-headings">
			<thead>
				<tr>
					<th class="wb-product-th"><?php esc_html_e( 'Product', 'learndash-wpforo' ); ?></th>
					<th class="wb-version-th"><?php esc_html_e( 'Version', 'learndash-wpforo' ); ?></th>
					<th class="wb-key-th"><?php esc_html_e( 'Key', 'learndash-wpforo' ); ?></th>
					<th class="wb-status-th"><?php esc_html_e( 'Status', 'learndash-wpforo' ); ?></th>
					<th class="wb-action-th"><?php esc_html_e( 'Action', 'learndash-wpforo' ); ?></th>
					<th></th>
				</tr>
			</thead>
		</table>
		<form method="post" action="options.php">
			<?php settings_fields( 'edd_wbcom_LDWPF_license' ); ?>
			<table class="form-table wb-license-form-table">
				<tr>
					<td class="wb-plugin-name"><?php esc_attr_e( $plugin_data['Name'], 'learndash-wpforo' ); ?></td>
					<td class="wb-plugin-version"><?php esc_attr_e( $plugin_data['Version'], 'learndash-wpforo' ); ?></td>
					<td class="wb-plugin-license-key"><input id="edd_wbcom_LDWPF_license_key" name="edd_wbcom_LDWPF_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license, 'learndash-wpforo' ); ?>" /></td>
					<td class="wb-license-status <?php echo $status_class; ?>"><?php esc_attr_e( $status_text, 'learndash-wpforo' ); ?></td>
					<td class="wb-license-action">
						<?php
						if ( $status !== false && $status == 'valid' ) {
							wp_nonce_field( 'edd_wbcom_LDWPF_nonce', 'edd_wbcom_LDWPF_nonce' );
							?>
							<input type="submit" class="button-secondary" name="edd_LDWPF_license_deactivate" value="<?php _e( 'Deactivate License', 'learndash-wpforo' ); ?>"/>
							<?php
						} else {
							wp_nonce_field( 'edd_wbcom_LDWPF_nonce', 'edd_wbcom_LDWPF_nonce' );
							?>
							<input type="submit" class="button-secondary" name="edd_ldwpf_license_activate" value="<?php _e( 'Activate License', 'learndash-wpforo' ); ?>"/>
						<?php } ?>
					</td>
				</tr>
			</table>
		</form>

		<?php
}



/************************************
 * this illustrates how to activate
 * a license key
 *************************************/

function edd_wbcom_LDWPF_activate_license() {
		// listen for our activate button to be clicked
	if ( isset( $_POST['edd_ldwpf_license_activate'] ) ) {
			// run a quick security check
		if ( ! check_admin_referer( 'edd_wbcom_LDWPF_nonce', 'edd_wbcom_LDWPF_nonce' ) ) {
				return; // get out if we didn't click the Activate button
		}

			// retrieve the license from the database
			$license = $_POST['edd_wbcom_LDWPF_license_key'];

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'activate_license',
				'license'    => $license,
				'item_name'  => urlencode( EDD_LDWPF_ITEM_NAME ), // the name of our product in EDD
				'url'        => home_url(),
			);

			// Call the custom API.
			$response = wp_remote_post(
				EDD_LDWPF_STORE_URL,
				array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params,
				)
			);

			// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
			} else {
					$message = __( 'An error occurred, please try again.', 'learndash-wpforo' );
			}
		} else {
				$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {
				switch ( $license_data->error ) {
					case 'expired':
								$message = sprintf(
									__( 'Your license key expired on %s.', 'learndash-wpforo' ),
									date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
								);
						break;

					case 'revoked':
										$message = __( 'Your license key has been disabled.', 'learndash-wpforo' );
						break;

					case 'missing':
						$message = __( 'Invalid license.', 'learndash-wpforo' );
						break;

					case 'invalid':
					case 'site_inactive':
						$message = __( 'Your license is not active for this URL.', 'learndash-wpforo' );
						break;

					case 'item_name_mismatch':
						$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'learndash-wpforo' ), EDD_LDWPF_ITEM_NAME );
						break;

					case 'no_activations_left':
						$message = __( 'Your license key has reached its activation limit.', 'learndash-wpforo' );
						break;

					default:
						$message = __( 'An error occurred, please try again.', 'learndash-wpforo' );
						break;
				}
			}
		}

			// Check if anything passed on a message constituting a failure
		if ( ! empty( $message ) ) {
				$base_url = admin_url( 'admin.php?page=' . EDD_LDWPF_PLUGIN_LICENSE_PAGE );
				$redirect = add_query_arg(
					array(
						'WPWFI_activation' => 'false',
						'message'          => urlencode( $message ),
					),
					$base_url
				);
				$license  = trim( $license );
				update_option( 'edd_wbcom_LDWPF_license_key', $license );
				update_option( 'edd_wbcom_LDWPF_license_status', $license_data->license );
				wp_redirect( $redirect );
				exit();
		}

			// $license_data->license will be either "valid" or "invalid"
			$license = trim( $license );
			update_option( 'edd_wbcom_LDWPF_license_key', $license );
			update_option( 'edd_wbcom_LDWPF_license_status', $license_data->license );
			wp_redirect( admin_url( 'admin.php?page=' . EDD_LDWPF_PLUGIN_LICENSE_PAGE ) );
			exit();
	}
}
add_action( 'admin_init', 'edd_wbcom_LDWPF_activate_license' );


/***********************************************
 * Illustrates how to deactivate a license key.
 * This will decrease the site count
 ***********************************************/

function edd_wbcom_LDWPF_deactivate_license() {
		// listen for our activate button to be clicked
	if ( isset( $_POST['edd_license_deactivate'] ) ) {
			// run a quick security check
		if ( ! check_admin_referer( 'edd_wbcom_LDWPF_nonce', 'edd_wbcom_LDWPF_nonce' ) ) {
				return; // get out if we didn't click the Activate button
		}

			// retrieve the license from the database
			$license = trim( get_option( 'edd_wbcom_LDWPF_license_key' ) );

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license,
				'item_name'  => urlencode( EDD_LDWPF_ITEM_NAME ), // the name of our product in EDD
				'url'        => home_url(),
			);

			// Call the custom API.
			$response = wp_remote_post(
				EDD_LDWPF_STORE_URL,
				array(
					'timeout'   => 15,
					'sslverify' => false,
					'body'      => $api_params,
				)
			);

			// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
			} else {
					$message = __( 'An error occurred, please try again.', 'learndash-wpforo' );
			}

			$base_url = admin_url( 'admin.php?page=' . EDD_LDWPF_PLUGIN_LICENSE_PAGE );
			$redirect = add_query_arg(
				array(
					'WPWFI_activation' => 'false',
					'message'          => urlencode( $message ),
				),
				$base_url
			);

			wp_redirect( $redirect );
			exit();
		}

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data->license == 'deactivated' ) {
				delete_option( 'edd_wbcom_LDWPF_license_status' );
		}

			wp_redirect( admin_url( 'admin.php?page=' . EDD_LDWPF_PLUGIN_LICENSE_PAGE ) );
			exit();
	}
}
add_action( 'admin_init', 'edd_wbcom_LDWPF_deactivate_license' );


/************************************
 * this illustrates how to check if
 * a license key is still valid
 * the updater does this for you,
 * so this is only needed if you
 * want to do something custom
 *************************************/

function edd_wbcom_LDWPF_check_license() {
		global $wp_version;

		$license = trim( get_option( 'edd_wbcom_LDWPF_license_key' ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license'    => $license,
			'item_name'  => urlencode( EDD_LDWPF_ITEM_NAME ),
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			EDD_LDWPF_STORE_URL,
			array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			)
		);

	if ( is_wp_error( $response ) ) {
			return false;
	}

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if ( $license_data->license == 'valid' ) {
			echo 'valid';
			exit;
			// this license is still valid
	} else {
			echo 'invalid';
			exit;
			// this license is no longer valid
	}
}

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function edd_wbcom_LDWPF_admin_notices() {
	if ( isset( $_GET['WPWFI_activation'] ) && ! empty( $_GET['message'] ) ) {
		switch ( $_GET['WPWFI_activation'] ) {
			case 'false':
				$message = urldecode( $_GET['message'] );
				?>
								<div class="error">
										<p><?php echo $message; ?></p>
								</div>
						<?php
				break;

			case 'true':
			default:
						// Developers can put a custom success message here for when activation is successful if they way.
				break;
		}
	}
}
add_action( 'admin_notices', 'edd_wbcom_LDWPF_admin_notices' );

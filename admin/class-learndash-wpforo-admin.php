<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wbcomdesigns.com/plugins
 * @since      1.0.0
 *
 * @package    Learndash_Wpforo
 * @subpackage Learndash_Wpforo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Learndash_Wpforo
 * @subpackage Learndash_Wpforo/admin
 * @author     wbcomdesigns <admin@wbcomdesigns.com>
 */
class Learndash_Wpforo_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The slug of this plugin.
	 *
	 * @since    1.6.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $plugin_slug = 'learndash-wpforo';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Learndash_Wpforo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Learndash_Wpforo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'selectize', plugin_dir_url( __FILE__ ) . 'css/selectize.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/learndash-wpforo-admin.css', array(), $this->version, 'all' );

	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Learndash_Wpforo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Learndash_Wpforo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/learndash-wpforo-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'selectize', plugin_dir_url( __FILE__ ) . 'js/selectize.min.js', array( 'jquery' ), $this->version, false );
		$wpforo_foums    = sanitize_title( __( 'Forums', 'learndash-wpforo' ) );
		$locale_settings = array(
			'wpforo_foums_body_class' => $wpforo_foums . '_page_wpforo-forums',
		);
		wp_localize_script( $this->plugin_name, 'learndashwpforo', $locale_settings );

	}

	public function wbcom_hide_all_admin_notices_from_setting_page() {
		$wbcom_pages_array  = array( 'wbcomplugins', 'wbcom-plugins-page', 'wbcom-support-page', 'learndash-wpforo' );
		$wbcom_setting_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : '';
		if ( in_array( $wbcom_setting_page, $wbcom_pages_array, true ) ) {
			remove_all_actions( 'admin_notices' );
			remove_all_actions( 'all_admin_notices' );
		}
	}


	public function ldforo_admin_menu() {
		if ( empty( $GLOBALS['admin_page_hooks']['wbcomplugins'] ) ) {
			add_menu_page(
				esc_html__( 'WB Plugins', 'learndash-wpforo' ),
				esc_html__( 'WB Plugins', 'learndash-wpforo' ),
				'manage_options',
				'wbcomplugins',
				array( $this, 'ldforo_admin_settings_page' ),
				'dashicons-lightbulb',
				59
			);

			add_submenu_page(
				'wbcomplugins',
				esc_html__( 'General', 'learndash-wpforo' ),
				esc_html__( 'General', 'learndash-wpforo' ),
				'manage_options',
				'wbcomplugins'
			);

		}
		add_submenu_page(
			'wbcomplugins',
			esc_html__( 'Learndash wpForo', 'learndash-wpforo' ),
			esc_html__( 'Learndash wpForo', 'learndash-wpforo' ),
			'manage_options',
			'learndash-wpforo',
			array( $this, 'ldforo_admin_settings_page' )
		);
	}

	public function ldforo_admin_settings_page() {
		global $allowedposttags;
		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'learndash-wpforo-welcome';
		?>
		<div class="wrap">
			<div class="wbcom-bb-plugins-offer-wrapper">
				<div id="wb_admin_logo">
					<a href="https://wbcomdesigns.com/downloads/buddypress-community-bundle/" target="_blank">
						<img src="<?php echo esc_url( LEARNDASH_WPFORO_URL ) . 'admin/wbcom/assets/imgs/wbcom-offer-notice.png'; ?>">
					</a>
				</div>
			</div>
			<div class="wbcom-wrap">
			<div class="blpro-header">
					<div class="wbcom_admin_header-wrapper">
						<div id="wb_admin_plugin_name">
							<?php esc_html_e( 'Learndash wpForo', 'learndash-wpforo' ); ?>
							<span><?php printf( __( 'Version %s', 'learndash-wpforo' ), LEARNDASH_WPFORO_VERSION ); ?></span>
						</div>
						<?php echo do_shortcode( '[wbcom_admin_setting_header]' ); ?>
					</div>
				</div>
				<?php settings_errors(); ?>
				<div class="wbcom-admin-settings-page">
					<?php
					$this->ldforum_plugin_settings_tabs();
					do_settings_sections( $tab );
					?>
				</div>
			</div>
		</div>
		<?php
	}

	public function ldforum_plugin_settings_tabs() {
		$current_tab = isset( $_GET['tab'] ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : 'learndash-wpforo-welcome';
		echo '<div class="wbcom-tabs-section"><div class="nav-tab-wrapper"><div class="wb-responsive-menu"><span>' . esc_html( 'Menu' ) . '</span><input class="wb-toggle-btn" type="checkbox" id="wb-toggle-btn"><label class="wb-toggle-icon" for="wb-toggle-btn"><span class="wb-icon-bars"></span></label></div><ul>';
		foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
			$active = $current_tab === $tab_key ? 'nav-tab-active' : '';
			echo '<li class="' . $tab_key . '"><a class="nav-tab ' . esc_attr( $active ) . '" href="?page=' . esc_attr( $this->plugin_slug ) . '&tab=' . esc_attr( $tab_key ) . '">' . esc_html__( $tab_caption, 'learndash-wpforo' ) . '</a></li>';
		}
		echo '</div></ul></div>';
	}

	/**
	 * Actions performed to create General Tab.
	 *
	 * @since    1.0.0
	 * @author   wbcomdesigns
	 * @access   public
	 */
	public function ld_forum_settings() {
		$this->plugin_settings_tabs['learndash-wpforo-welcome'] = __( 'Welcome', 'learndash-wpforo' );
		add_settings_section( 'learndash-wpforo-welcome-section', ' ', array( $this, 'ld_forum_admin_welcome_content' ), 'learndash-wpforo-welcome' );

		$this->plugin_settings_tabs['ld-forum-faq'] = __( 'FAQ', 'learndash-wpforo' );
		add_settings_section( 'ld-forum-faq-section', ' ', array( $this, 'ld_forum_admin_faq_content' ), 'ld-forum-faq' );

	}

	/**
	 * Actions performed to create Welcome Tab Content .
	 *
	 * @since    1.0.0
	 * @author   wbcomdesigns
	 * @access   public
	 */
	public function ld_forum_admin_welcome_content() {
		if ( file_exists( dirname( __FILE__ ) . '/partials/ld-wpforo-welcome-page.php' ) ) {
			require_once dirname( __FILE__ ) . '/partials/ld-wpforo-welcome-page.php';
		}
	}

	public function ld_forum_admin_faq_content() {
		if ( file_exists( dirname( __FILE__ ) . '/partials/ld-wpforo-faq-page.php' ) ) {
			require_once dirname( __FILE__ ) . '/partials/ld-wpforo-faq-page.php';
		}

	}


	public function ldwpforo_display_course_selector() {

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'wpforo-forums' && isset( $_GET['action'] ) ) {
			$courses            = $this->ld_get_course_list();
			$associated_courses = $limit_post_access = $allow_forum_view = $message_without_access = '';
			if ( isset( $_GET['id'] ) && $_GET['id'] != '' ) {
				$forumid                = sanitize_text_field( $_GET['id'] );
				$ld_forum_settings      = get_option( 'ld_forum_' . $forumid );
				$associated_courses     = isset( $ld_forum_settings['ld_course_selector_dd'] ) ? $ld_forum_settings['ld_course_selector_dd'] : '';
				$limit_post_access      = isset( $ld_forum_settings['ld_post_limit_access'] ) ? $ld_forum_settings['ld_post_limit_access'] : '';
				$allow_forum_view       = isset( $ld_forum_settings['ld_allow_forum_view'] ) ? $ld_forum_settings['ld_allow_forum_view'] : '';
				$message_without_access = isset( $ld_forum_settings['ld_message_without_access'] ) ? $ld_forum_settings['ld_message_without_access'] : 'This forum is restricted to members of the associated course(s).';
			}

			$selected = null;
			?>
			<div id="ldwpforo_course_selector-sortables" style="display:none;">
				<div  id="ldwpforo_course_settings" class="meta-box-sortables ui-sortable">
					<div id="ldwpforo_course_selector" class="postbox ">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h2 class="hndle ui-sortable-handle"><span><?php _e( 'LearnDash wpForo Settings', 'learndash-wpforo' ); ?></span></h2>
						<div class="inside">
							<table class="form-table">
								<tbody>
								<tr>
								<td>
									<label for="ld_course_selector_dd"><strong><?php _e( 'Associated Course(s)', 'learndash-wpforo' ); ?>: </strong></label>
									<br>
									<select name='ld_forum[ld_course_selector_dd][]' size="4" id='ld_course_selector_dd' multiple="multiple">
										<optgroup label="<?php _e( 'Select Courses', 'learndash-wpforo' ); ?>">
										<?php
										if ( is_array( $courses ) ) {
											foreach ( $courses as $course ) {
												$selected = null;
												if ( is_array( $associated_courses ) && in_array( $course->ID, $associated_courses ) ) {
													$selected = 'selected';
												}
												?>
											<option value="<?php echo $course->ID; ?>" <?php echo $selected; ?>><?php echo get_the_title( $course->ID ); ?></option>
												<?php
											}
										}
										?>
										</optgroup>
									</select>
								</td>
								</tr>
								<tr>
									<td>
										<label for="ld_post_limit_access"><strong><?php _e( 'Post Limit Access', 'learndash-wpforo' ); ?>: </strong></label>
										<select name="ld_forum[ld_post_limit_access]" id="ld_post_limit_access">
											<option value="all" <?php selected( 'all', $limit_post_access, true ); ?>><?php _e( 'All', 'learndash-wpforo' ); ?></option>
											<option value="any" <?php selected( 'any', $limit_post_access, true ); ?>><?php _e( 'Any', 'learndash-wpforo' ); ?></option>
										</select>
										<p class="desc"><?php _e( 'If you select ALL, then users must have access to all of the associated courses in order to post.', 'learndash-wpforo' ); ?></p>
										<p class="desc"><?php _e( 'If you select ANY, then users only need to have access to any one of the selected courses in order to post.', 'learndash-wpforo' ); ?></p>
									</td>
								</tr>
								<tr>
									<td>
										<label for="ld_message_without_access"><strong><?php _e( 'Message shown to users without access', 'learndash-wpforo' ); ?>: </strong></label>
										<br>
										<textarea cols="100" rows="5" name="ld_forum[ld_message_without_access]"><?php echo esc_attr( $message_without_access ); ?></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label for="ld_allow_forum_view"><strong><?php _e( 'Forum View', 'learndash-wpforo' ); ?>: </strong></label>
										<br>
										<input type="hidden" name="ld_forum[ld_allow_forum_view]" value="0">
										<input type="checkbox" name="ld_forum[ld_allow_forum_view]" value="1" <?php checked( '1', $allow_forum_view, true ); ?>>&nbsp;<?php _e( 'Check this box to allow non-enrolled users to view forum threads and topics (they will not be able to post replies).', 'learndash-wpforo' ); ?>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}

	/*
	 * Update LearnDash Forum Setting on wpForo settings.
	 *
	 */
	public function ldwpforo_add_edit_ldwpforo_settings() {
		if ( isset( $_REQUEST['page'] ) && isset( $_REQUEST['action'] ) && isset( $_REQUEST['ld_forum'] ) ) {
			/* wpForo forum ADD OR EDIT action */
			$page     = sanitize_text_field( $_REQUEST['page'] );
			$action   = sanitize_text_field( $_REQUEST['action'] );
			$id       = sanitize_text_field( $_REQUEST['id'] );
			$ld_forum = filter_var_array( $_REQUEST['ld_forum'], FILTER_SANITIZE_STRING );

			if ( isset( $page ) && $page == 'wpforo-forums' && ( isset( $action ) && ( $action == 'edit' || $action == 'add' ) ) ) {
				if ( 'edit' == $action ) {
					$forumid = $id;
				} elseif ( 'add' == $action ) {
					global $wpdb;
					$forum_table = $wpdb->prefix . 'wpforo_forums';
					$forumid = $wpdb->get_var( $wpdb->prepare( "SELECT forumid from $forum_table ORDER BY forumid DESC LIMIT 1" ) );
				}
				if ( $forumid != '' && $forumid != 0 ) {
					update_option( 'ld_forum_' . $forumid, $ld_forum );
				}
			}
			/* Delete LD Forum Settings*/
			if ( isset( $page ) && $page == 'wpforo-forums' && isset( $action ) && $action == 'del' ) {
				$forumid = $id;
				delete_option( 'ld_forum_' . $forumid );
			}
		}
	}

	/**
	 * Course integrate in wpforo board forum
	 *
	 * @return void
	 */
	public function wpforo_course_integrate_in_board() {
		$board_obj = WPF()->board->get_boards();
		foreach ( $board_obj as $board_obj_key => $board_obj_val ) {
			if ( 0 === $board_obj_val['boardid'] ) {
				continue;
			}
			$page = 'wpforo-' . $board_obj_val['boardid'] . '-forums';
			if ( isset( $_GET['page'] ) && $_GET['page'] == $page && isset( $_GET['action'] ) ) {
				$courses            = $this->ld_get_course_list();
				$associated_courses = $limit_post_access = $allow_forum_view = $message_without_access = '';
				if ( $board_obj_val['boardid'] != '' ) {
					$ld_board_forum_settings    = get_option( 'ld_board_forum_' . $board_obj_val['boardid'] . '_' . $_GET['id'] );
					$associated_courses         = isset( $ld_board_forum_settings['ld_course_selector_dd'] ) ? $ld_board_forum_settings['ld_course_selector_dd'] : '';
					$limit_post_access          = isset( $ld_board_forum_settings['ld_post_limit_access'] ) ? $ld_board_forum_settings['ld_post_limit_access'] : '';
					$allow_forum_view           = isset( $ld_board_forum_settings['ld_allow_forum_view'] ) ? $ld_board_forum_settings['ld_allow_forum_view'] : '';
					$message_without_access     = isset( $ld_board_forum_settings['ld_message_without_access'] ) ? $ld_board_forum_settings['ld_message_without_access'] : 'This forum is restricted to members of the associated course(s).';
				}

				$selected = null;
				?>
				<div id="ldwpforo_course_selector-sortables" style="display:none;">
					<div  id="ldwpforo_course_settings" class="meta-box-sortables ui-sortable">
						<div id="ldwpforo_course_selector" class="postbox ">
							<div class="handlediv" title="Click to toggle"><br></div>
							<h2 class="hndle ui-sortable-handle"><span><?php _e( 'LearnDash wpForo Settings', 'learndash-wpforo' ); ?></span></h2>
							<div class="inside">
								<table class="form-table">
									<tbody>
									<tr>
									<td>
										<label for="ld_course_selector_dd"><strong><?php _e( 'Associated Course(s)', 'learndash-wpforo' ); ?>: </strong></label>
										<br>
										<select name='ld_board_forum[ld_course_selector_dd][]' size="4" id='ld_course_selector_dd' multiple="multiple">
											<optgroup label="<?php _e( 'Select Courses', 'learndash-wpforo' ); ?>">
											<?php
											if ( is_array( $courses ) ) {
												foreach ( $courses as $course ) {
													$selected = null;
													if ( is_array( $associated_courses ) && in_array( $course->ID, $associated_courses ) ) {
														$selected = 'selected';
													}
													?>
												<option value="<?php echo $course->ID; ?>" <?php echo $selected; ?>><?php echo get_the_title( $course->ID ); ?></option>
													<?php
												}
											}
											?>
											</optgroup>
										</select>
									</td>
									</tr>
									<tr>
										<td>
											<label for="ld_post_limit_access"><strong><?php _e( 'Post Limit Access', 'learndash-wpforo' ); ?>: </strong></label>
											<select name="ld_board_forum[ld_post_limit_access]" id="ld_post_limit_access">
												<option value="all" <?php selected( 'all', $limit_post_access, true ); ?>><?php _e( 'All', 'learndash-wpforo' ); ?></option>
												<option value="any" <?php selected( 'any', $limit_post_access, true ); ?>><?php _e( 'Any', 'learndash-wpforo' ); ?></option>
											</select>
											<p class="desc"><?php _e( 'If you select ALL, then users must have access to all of the associated courses in order to post.', 'learndash-wpforo' ); ?></p>
											<p class="desc"><?php _e( 'If you select ANY, then users only need to have access to any one of the selected courses in order to post.', 'learndash-wpforo' ); ?></p>
										</td>
									</tr>
									<tr>
										<td>
											<label for="ld_message_without_access"><strong><?php _e( 'Message shown to users without access', 'learndash-wpforo' ); ?>: </strong></label>
											<br>
											<textarea cols="100" rows="5" name="ld_board_forum[ld_message_without_access]"><?php echo esc_attr( $message_without_access ); ?></textarea>
										</td>
									</tr>
									<tr>
										<td>
											<label for="ld_allow_forum_view"><strong><?php _e( 'Forum View', 'learndash-wpforo' ); ?>: </strong></label>
											<br>
											<input type="hidden" name="ld_board_forum[ld_allow_forum_view]" value="0">
											<input type="checkbox" name="ld_board_forum[ld_allow_forum_view]" value="1" <?php checked( '1', $allow_forum_view, true ); ?>>&nbsp;<?php _e( 'Check this box to allow non-enrolled users to view forum threads and topics (they will not be able to post replies).', 'learndash-wpforo' ); ?>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		}
	}
	/**
	 * Wpforo board forum course setting save
	 *
	 * @return void
	 */
	public function wpforo_board_forum_course_setting_save() {
		$board_obj = WPF()->board->get_boards();
		foreach ( $board_obj as $board_obj_key => $board_obj_val ) {
			if ( 0 === $board_obj_val['boardid'] ) {
				continue;
			}
			if ( isset( $_REQUEST['page'] ) && isset( $_REQUEST['action'] ) && isset( $_REQUEST['ld_board_forum'] ) ) {
				// * wpForo forum ADD OR EDIT action */
				$page           = sanitize_text_field( $_REQUEST['page'] );
				$action         = sanitize_text_field( $_REQUEST['action'] );
				$id             = sanitize_text_field( $_REQUEST['id'] );
				$ld_board_forum = filter_var_array( $_REQUEST['ld_board_forum'], FILTER_SANITIZE_STRING );
				$board_id 		= $board_obj_val['boardid'];
				if ( isset( $page ) && $page === 'wpforo-' . $board_obj_val['boardid'] . '-forums' && ( isset( $action ) && ( $action == 'edit' || $action == 'add' ) ) ) {
					if ( 'edit' == $action ) {
						$board_forumid = $id;
					} elseif ( 'add' == $action ) {
						global $wpdb;
						$forum_table = $wpdb->prefix . 'wpforo_' . $board_id . '_forums';
						$board_forumid = $wpdb->get_var( $wpdb->prepare( "SELECT forumid from $forum_table ORDER BY forumid DESC LIMIT 1" ) );
					}
					if ( $board_forumid != '' && $board_forumid != 0 ) {
						update_option( 'ld_board_forum_' . $board_id . '_' . $board_forumid, $ld_board_forum );
					}
				}
			}
		}
	}

	/*
	 * Get the learndash course list.
	 *
	 */
	public function ld_get_course_list() {
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'sfwd-courses',
			'post_status'    => 'publish',
		);

		$courses = get_posts( $args );
		return $courses;
	}
}

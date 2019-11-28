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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		
		$wpforo_foums = sanitize_title( __( 'Forums', 'wpforo' ) );		
		$locale_settings = array(
			'wpforo_foums_body_class' => $wpforo_foums . '_page_wpforo-forums'
		);
		wp_localize_script( $this->plugin_name, 'learndashwpforo', $locale_settings);

	}

	/*
	 *
	 *
	 */
	public function ldwpforo_display_course_selector(){
		
		if ( isset($_GET['page']) && $_GET['page'] == 'wpforo-forums' && isset($_GET['action'])){
			$courses = $this->ld_get_course_list();
			$forumid = sanitize_text_field( $_GET['id'] );

			$ld_forum_settings = get_option( 'ld_forum_' . $forumid);

			$associated_courses     = $ld_forum_settings['ld_course_selector_dd'];
			$limit_post_access      = $ld_forum_settings['ld_post_limit_access'];
			$allow_forum_view       = $ld_forum_settings['ld_allow_forum_view'];
			$message_without_access = ( $ld_forum_settings['ld_message_without_access'] != '') ? $ld_forum_settings['ld_message_without_access'] : __( 'This forum is restricted to members of the associated course(s).', 'learndash-bbpress' );
			$selected = null;
			?>
			<div id="ldwpforo_course_selector-sortables" style="display:none;">
				<div  id="ldwpforo_course_settings" class="meta-box-sortables ui-sortable">
					<div id="ldwpforo_course_selector" class="postbox ">
						<div class="handlediv" title="Click to toggle"><br></div>
						<h2 class="hndle ui-sortable-handle"><span><?php _e('LearnDash wpForo Settings','learndash-wpforo');?></span></h2>
						<div class="inside">
							<script>
								jQuery( document ).ready( function( $ ){
									$( '#ld_clearcourse' ).click( function( e ) {
										e.preventDefault();
										$( "#ld_course_selector_dd option:selected" ).each( function() {
												$( this ).removeAttr( 'selected' ); //or whatever else
										} );
									} );
								});
							</script>

							<table class="form-table">
								<tbody>
								<tr>
								<td>
									<label for="ld_course_selector_dd"><strong><?php _e( 'Associated Course(s)', 'learndash-wpforo' ); ?>: </strong></label>
									<br>
									<select name='ld_forum[ld_course_selector_dd][]' size="4" id='ld_course_selector_dd' multiple="multiple">
										<optgroup label="<?php _e( 'Select Courses', 'learndash-wpforo' ); ?>">
										<?php if(is_array($courses)){
										foreach( $courses as $course ){
											$selected = null;
											if(is_array($associated_courses) && in_array($course->ID, $associated_courses)){
												$selected = "selected";
											} ?>
											<option value="<?php echo $course->ID; ?>" <?php echo $selected; ?>><?php echo get_the_title($course->ID); ?></option>
										<?php } } ?>
										</optgroup>
									</select>
									<br>
									<a href="" id="ld_clearcourse" class="button" style="margin-top: 10px;"><?php _e( 'Clear All', 'learndash-wpforo' ); ?></a>
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
	public function ldwpforo_add_edit_ldwpforo_settings(){


		/* wpForo forum ADD OR EDIT action */
		$page     = sanitize_text_field( $_REQUEST['page'] );
		$action   = sanitize_text_field( $_REQUEST['action'] );
		$id       = sanitize_text_field( $_REQUEST['id'] );
		$ld_forum = filter_var_array( $_REQUEST['ld_forum'], FILTER_SANITIZE_STRING );

		if (isset( $page ) && $page == 'wpforo-forums' && ( isset( $action ) && ( $action == 'edit' || $action == 'add' ) ) ) {
			$forumid = ( isset( $id ) ) ? $id : WPF()->db->insert_id;
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

	/*
	 * Get the learndash course list.
	 *
	 */
	public function ld_get_course_list(){
		$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'sfwd-courses',
		'post_status'      => 'publish');

		$courses = get_posts( $args );
		return $courses;
	}
	/*
	 * Check learndash & wpForo Plugin Dependency Check
	 *
	 * @since      1.0.0
	 */
	public function ldwpforo_activation_dependency_check(){
		//check if wpForo is active
		$is_wpforo_active = is_plugin_active('wpforo/wpforo.php');

		//check if learndash is active
		$is_learndash_active = is_plugin_active('sfwd-lms/sfwd_lms.php');

		if ( !$is_wpforo_active || !$is_learndash_active ) {
			deactivate_plugins( 'learndash-wpforo/learndash-wpforo.php' );			
			add_action( 'admin_notices', array( $this, 'ldwpforo_ctivation_dependency_check_notices' ) );
		}
	}
	
	/*
	 * Display admin notice for activate wpforo and LearnDash plugin to use this plugin
	 *
	 * @since      1.0.0
	 */	
	public function ldwpforo_ctivation_dependency_check_notices() {
		echo "<div class='notice notice-error'><p>" . esc_html__( 'Please activate wpForo & Learndash plugins before activation Learndash wpForo integration.', 'learndash-wpforo' ) . "</p></div>";
	}
}

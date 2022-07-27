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
<div class="wbcom-faq-adming-setting">
	<div class="wbcom-admin-title-section">
		<h3><?php esc_html_e( 'FAQ(s)', 'learndash-wpforo' ); ?></h3>
	   </div>
	   <div class="wbcom-faq-admin-settings-block">
		  <div id="wbcom-faq-settings-section" class="wbcom-faq-table">
			<div class="wbcom-faq-section-row">
				<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'How to Assign Courses to a forum?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
							<p>
							<?php
							esc_html_e(
								'Navigate to forums- “Dashboard >  Forums > Add new” to create a new forum. Scroll down to the Learndash WPforo Settings, and associate the courses.',
								'learndash-wpforo'
							);
							?>
							</p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'Can I associate more than one course in a forum?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
							<p><?php esc_html_e( 'Yes! Off course you can associate more than one course in a single forum.', 'learndash-wpforo' ); ?></p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'How does the forum restriction work?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
							<p>
							<?php
							esc_html_e(
								'This plugin assist us to restrict the students from accessing a forum until unless he/she is enrolled in a particular course(That is associated in the forum) Plugin provides two types of access restrictions All and Any',
								'learndash-wpforo'
							);
							?>
							</p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					 <div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'Differentiate between All and Any access limit restriction?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
							<ul>
								<li>
									<p>
									<?php
									esc_html_e(
										'All: This means users must have access to all of the associated courses in order to post. For ex: If you have associated 2 courses in a forum then students won’t be able to access the forum until they have enrolled in both of the courses.',
										'learndash-wpforo'
									);
									?>
									</p>
							</li>
							<li>
								<p>
									<?php
									esc_html_e(
										'Any: This means users only need to have access to any one of the selected courses in order to post. For example: If you have associated 2 courses in a forum then your student can access the forum even if they have enrolled in one of the associated courses.',
										'learndash-wpforo'
									);
									?>
								</p>
							</li>
							</ul>

						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					 <div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'How to show customized forum restriction notice  to the users?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
								<p>
								<?php
								esc_html_e(
									'Under the Learndash WPforo Settings section, the plugin provides a field to customize the message. This message will be shown to the students that do not have the forum access.',
									'learndash-wpforo'
								);
								?>
								</p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'How does the Forum View setting work?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
								<p>
								<?php
								esc_html_e(
									'If you want to show the forum threads (topics and replies) to your students even if they do not have access to a particular forum, then check the checkbox of the Forum View  setting. Please note that they can only view the threads, can’t post any topic or replies',
									'learndash-wpforo'
								);
								?>
								</p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'Can I display associated forums on a single course page?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
								<p>
								<?php
								esc_html_e(
									'Yes! You can display associated forums on a single course page using a widget.',
									'learndash-wpforo'
								);
								?>
								</p>
						</div>
					</div>
				</div>
				<div class="wbcom-faq-section-row">
					<div class="wbcom-faq-admin-row">
						<button class="wbcom-faq-accordion"><?php esc_html_e( 'How to display associated forums on a single course page?', 'learndash-wpforo' ); ?></button>
						<div class="wbcom-faq-panel">
								<p>
								<?php
								esc_html_e(
									'Plugin provides a Course wpForo Forum widget. Navigate to Appearance >> Widgets, and search for Course wpForo Forum and place it in the single course sidebar of your theme. Now when you’ll visit the single course page, Associated forums will be listed there on the widget',
									'learndash-wpforo'
								);
								?>
								</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

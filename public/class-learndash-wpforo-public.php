<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link  https://wbcomdesigns.com/plugins
 * @since 1.0.0
 *
 * @package    Learndash_Wpforo
 * @subpackage Learndash_Wpforo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Learndash_Wpforo
 * @subpackage Learndash_Wpforo/public
 * @author     wbcomdesigns <admin@wbcomdesigns.com>
 */
class Learndash_Wpforo_Public
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/learndash-wpforo-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/learndash-wpforo-public.js', array( 'jquery' ), $this->version, false);

    }

    public function learndash_wpforo_wpftpl($template)
    {

        if (strpos($template, "topic.php")) {
            $forum = WPF()->current_object['forum'] ;
            $forumid = $forum['forumid'];

            $ld_forum_info = get_option('ld_forum_' . $forumid);
            $associated_courses = $ld_forum_info['ld_course_selector_dd'];
            $allow_post = $ld_forum_info['ld_post_limit_access'];
            $allow_forum_view = $ld_forum_info['ld_allow_forum_view'];
            $message_without_access = $ld_forum_info['ld_message_without_access'];

            $has_access = true;
            $user_id = get_current_user_id();
            if (is_array($associated_courses) && ! empty($associated_courses) ) {
                $has_access = true;

                foreach( $associated_courses as $associated_course ) {
                    // Default expected value of $allow_post == 'all'
                    if ($allow_post == 'all' ) {
                        if (! sfwd_lms_has_access($associated_course, $user_id) || ! is_user_logged_in() ) {
                            $has_access = false;
                            break;
                        }
                    } else {
                        if (sfwd_lms_has_access($associated_course, $user_id) && is_user_logged_in() ) {
                               $has_access = true;
                               break;
                        } else {
                               $has_access = false;
                        }
                    }
                }
                if ($allow_forum_view == '1' ) {
                    $has_access = true;
                }
            }

            if ($has_access === false ) {
                $template = LEARNDASH_WPFORO_DIR_PATH . '/wpf-themes/topic-without-access.php';
            }
        }
        return $template;
    }

    public function learndash_wpforo_footer_hook()
    {
        if(in_array(WPF()->current_object['template'], array('post', 'topic')) ) {

            $forum = WPF()->current_object['forum'];            
            $forumid = $forum['forumid'];
            $ld_forum_info = get_option('ld_forum_' . $forumid);
            $associated_courses = $ld_forum_info['ld_course_selector_dd'];
            $allow_post = $ld_forum_info['ld_post_limit_access'];
            $allow_forum_view = $ld_forum_info['ld_allow_forum_view'];
            $message_without_access = $ld_forum_info['ld_message_without_access'];

            $topic_has_access = true;
            $user_id = get_current_user_id();
            if (is_array($associated_courses) && ! empty($associated_courses) ) {
                $topic_has_access = true;

                foreach( $associated_courses as $associated_course ) {
                    // Default expected value of $allow_post == 'all'
                    if ($allow_post == 'all' ) {
                        if (! sfwd_lms_has_access($associated_course, $user_id) || ! is_user_logged_in() ) {
                            $topic_has_access = false;
                            break;
                        }
                    } else {
                        if (sfwd_lms_has_access($associated_course, $user_id) && is_user_logged_in() ) {
                               $topic_has_access = true;
                               break;
                        } else {
                               $topic_has_access = false;
                        }
                    }
                }
            }
            
            if ($topic_has_access === false  && ( $allow_forum_view == '1' || $allow_forum_view == '0' ) ) {
                ?>
                <script>
                (function( $ ) {
                    'use strict';
                    $('#add_wpftopic').remove();
                    $('#wpf-form-wrapper #wpf-post-create').remove();
                    $('#wpf-form-wrapper #wpf-reply-form-title').html( '<?php esc_html_e('You cannot reply to this topic.', 'learndash-wpforo');?>');
                })( jQuery );
                </script>
                <?php
            }
        }
    }
    
    public function ld_include_widget_code()
    {
        include_once LEARNDASH_WPFORO_DIR_PATH . '/learnforum-widget.php';
    }

}

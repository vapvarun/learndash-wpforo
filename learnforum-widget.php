<?php

class Learnforum_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'learnforum_widget',
			__( 'Course wpForo Forum', 'learndash-wpforo' ),
			array(
				'customize_selective_refresh' => true,
			)
		);
	}

	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title    = strip_tags( $instance['title'] );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'learndash-wpforo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	public function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );

		if ( ! is_singular() ) {
			return;
		}

		$title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance );
		$associated_forums = '';
		$course_id         = get_the_ID();
		$wpforo_forums_get = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpforo_forums", OBJECT );
		if ( ! empty( $wpforo_forums_get ) ) :

			foreach ( $wpforo_forums_get as $forum ) {
				$forumid           = $forum->forumid;
				$forum_title       = $forum->title;
				$ld_forum_settings = get_option( 'ld_forum_' . $forumid );
				if ( ! empty( $ld_forum_settings['ld_course_selector_dd'] ) && in_array( $course_id, $ld_forum_settings['ld_course_selector_dd'] ) ) {
					$forum_url          = wpforo_forum( $forumid, 'url' );
					$associated_forums .= "<li><a href='" . esc_url( $forum_url ) . "' >" . esc_html( $forum_title ) . '</a></li>';
				}
			}
		endif;
		// BOARD FORUM
		$board_obj = WPF()->board->get_boards();
		if ( ! empty( $board_obj ) ) {
			foreach ( $board_obj as $board_obj_key => $board_obj_val ) {
				if ( 0 === $board_obj_val['boardid'] ) {
					continue;
				}
				$board_table = $wpdb->prefix . 'wpforo_' . $board_obj_val['boardid'] . '_forums';
				$wpforo_board_forums_get = $wpdb->get_results( "SELECT * FROM $board_table", OBJECT );
				if ( ! empty( $wpforo_board_forums_get ) ) {
					foreach ( $wpforo_board_forums_get as $board_forum ) {
						$board_forumid           = $board_forum->forumid;
						$board_forum_title       = $board_forum->title;
						$ld_board_forum_settings = get_option( 'ld_board_forum_' . $board_obj_val['boardid'] . '_' . $board_forumid );
						if ( ! empty( $ld_board_forum_settings['ld_course_selector_dd'] ) && in_array( $course_id, $ld_board_forum_settings['ld_course_selector_dd'] ) ) {
							$board_forum_url          = site_url() . '/' . $board_obj_val['slug'] . '/' . $board_forum->slug;
							$associated_forums .= "<li><a href='" . esc_url( $board_forum_url ) . "' >" . esc_html( $board_forum_title ) . '</a></li>';
						}
					}
				}
			}
		}

		if ( $associated_forums != '' ) :

			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			echo '<ul>';
			if ( $associated_forums != '' ) {
				echo $associated_forums;
			}
			echo '</ul>';

			echo $args['after_widget'];

		endif;

	}

}


register_widget( 'learnforum_widget' );

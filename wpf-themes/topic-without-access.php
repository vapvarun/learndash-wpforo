<?php
	$forum = WPF()->current_object['forum'];
	$forumid = $forum['forumid'];
	$ld_forum_info = get_option( 'ld_forum_' . $forumid );
	if ( ! empty( $ld_forum_info ) && ! empty( $ld_forum_info['ld_message_without_access'] ) ) {
		$message_without_access = $ld_forum_info['ld_message_without_access'];
	}

	$board_obj = WPF()->board->get_current();
	$board_id = $board_obj['boardid'];
	$board_forum = WPF()->current_object['forum'];
	$b_forumid = $board_forum['forumid'];
	$ld_b_forum_info = get_option( 'ld_board_forum_' . $board_id . '_' . $b_forumid );
	if ( ! empty( $ld_b_forum_info ) && ! empty( $ld_b_forum_info['ld_message_without_access'] ) ) {
		$message_without_access = $ld_b_forum_info['ld_message_without_access'];
	}
?>
<div id='wpf-forums' class='wpf-head-bar ld-wpf-forums'>
	<p class='pre-message'>
	<?php
	if ( ! empty( $message_without_access ) ) {
		echo esc_html( $message_without_access );
	} else {
		esc_html_e( 'This forum is restricted to members of the associated course(S).', 'learndash-wpforo' );
	}
	?>
	</p>
</div>

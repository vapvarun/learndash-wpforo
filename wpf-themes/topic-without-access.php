<?php
    $forum = WPF()->current_object['forum'] ;
    $forumid = $forum['forumid'];            
    $ld_forum_info = get_option('ld_forum_' . $forumid);    
    $message_without_access = $ld_forum_info['ld_message_without_access'];
    
?>

<div id='wpf-forums' class='wpf-head-bar ld-wpf-forums'>
    <p class='pre-message'><?php echo $message_without_access; ?></p>
</div>

<?php

/*
Plugin Name: Ajax Comment Posting
Plugin URI:
Description: Posts comments and validates the comment form using Ajax
Author: regua
Version: 2.0
Author URI:
*/ 

function acp_initialize() {
  $acp_url = get_template_directory_uri().'/plugins/ajax-comment-posting/';
  wp_enqueue_script('ACP', $acp_url.'acp.js', false, null, true);
  //wp_enqueue_script('queryform', $acp_url.'jquery.form.js');
  wp_enqueue_script( 'comment-reply' );
}

function acp_localize() {
  load_plugin_textdomain('acp');
  echo "<script type='text/javascript'>
   var acp_lang = ['".__('Loading...', 'acp')."',
                   '".__('Please enter your name.', 'acp')."',
                   '".__('Please enter your email address.', 'acp')."',
                   '".__('Please enter a valid email address.', 'acp')."',
                   '".__('Please enter your comment.', 'acp')."',
                   '".__('Your comment has been added.', 'acp')."',
                   '".__('ACP error!', 'acp')."'];
    var acp_path = '".get_template_directory_uri()."/plugins/ajax-comment-posting/';
   </script>";
}

add_action('init', 'acp_initialize');
add_action('wp_head', 'acp_localize');

?>
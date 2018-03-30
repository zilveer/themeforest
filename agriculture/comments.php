<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Comments Template
 * Created by CMSMasters
 * 
 */


if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    die(__('Please do not load this page directly. Thanks!', 'cmsmasters'));
}

if (post_password_required()) { 
	echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', 'cmsmasters') . '</p>';
	
    return;
}

if (have_comments()) {
	echo '<aside id="comments">' . "\n" . 
		'<h3>';
	
	comments_number(__('No Comments', 'cmsmasters'), '1 ' . __('Comment', 'cmsmasters'), '% ' . __('Comments', 'cmsmasters'));
	
	echo '</h3>' . "\n";
	
	if (get_previous_comments_link() || get_next_comments_link()) {
		echo '<aside class="project_navi" role="navigation">' . "\n\t" . 
			'<span class="fl">' . "\n\t\t";
		
		previous_comments_link('&larr; ' . __('Older Comments', 'cmsmasters'));
		
		echo "\n\t" . '</span>' . "\n\t" . 
		'<span class="fr">' . "\n\t\t";
		
		next_comments_link(__('Newer Comments', 'cmsmasters') . ' &rarr;');
		
		echo "\n\t" . '</span>' . "\r" . 
		'</aside>' . "\n";
	}
	
	echo '<ol class="commentlist">' . "\n";
	
	wp_list_comments(array( 
		'type' => 'comment', 
		'callback' => 'mytheme_comment' 
	));
	
	echo '</ol>' . "\n";
	
	if (get_previous_comments_link() || get_next_comments_link()) {
		echo '<aside class="project_navi" role="navigation">' . "\n\t" . 
			'<span class="fl">' . "\n\t\t";
		
		previous_comments_link('&larr; ' . __('Older Comments', 'cmsmasters'));
		
		echo "\n\t" . '</span>' . "\n\t" . 
		'<span class="fr">' . "\n\t\t";
		
		next_comments_link(__('Newer Comments', 'cmsmasters') . ' &rarr;');
		
		echo "\n\t" . '</span>' . "\r" . 
		'</aside>' . "\n";
	}
	
	echo '</aside>';
}

if (comments_open()) {
	$form_fields =  array( 
		'author' => '<p class="comment-form-author">' . "\n" . 
			'<label for="author">' . __('Name', 'cmsmasters') . (($req) ? ' <span class="required color_2">*</span>' : '') . '</label>' . "\n" . 
			'<input type="text" id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . ((isset($aria_req)) ? $aria_req : '') . ' />' . "\n" . 
		'</p>' . "\n", 
		'email' => '<p class="comment-form-email">' . "\n" . 
			'<label for="email">' . __('Email', 'cmsmasters') . (($req) ? ' <span class="required color_2">*</span>' : '') . '</label>' . "\n" . 
			'<input type="text" id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . ((isset($aria_req)) ? $aria_req : '') . ' />' . "\n" . 
		'</p>' . "\n", 
		'url' => '<p class="comment-form-url">' . "\n" . 
			'<label for="url">' . __('Website', 'cmsmasters') . '</label>' . "\n" . 
			'<input type="text" id="url" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />' . "\n" . 
		'</p>' . "\n" 
	);
	
	echo "\n\n";
	
	comment_form(array( 
		'fields' => apply_filters('comment_form_default_fields', $form_fields), 
		'comment_field' => '<p class="comment-form-comment">' . 
			'<textarea name="comment" id="comment" cols="28" rows="6"></textarea>' . 
		'</p>', 
		'must_log_in' => '<p class="must-log-in">' . __('You must be', 'cmsmasters') . ' <a href="' . wp_login_url(apply_filters('the_permalink', get_permalink())) . '">' . __('logged in', 'cmsmasters') . '</a> ' . __('to post a comment', 'cmsmasters') . '.</p>' . "\n", 
		'logged_in_as' => '<p class="logged-in-as">' . __('Logged in as', 'cmsmasters') . ' <a href="' . admin_url('profile.php') . '">' . $user_identity . '</a>. <a class="all" href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '" title="' . __('Log out of this account', 'cmsmasters') . '">' . __('Log out?', 'cmsmasters') . '</a></p>' . "\n", 
		'comment_notes_before' => '<p class="comment-notes">' . __('Your email address will not be published. Required fields are marked', 'cmsmasters') . ' <span class="required color_2">*</span></p>' . "\n", 
		'comment_notes_after' => '', 
		'id_form' => 'commentform', 
		'id_submit' => 'submit', 
		'title_reply' => __('Leave a Reply', 'cmsmasters'), 
		'title_reply_to' => __('Leave your comment to', 'cmsmasters'), 
		'cancel_reply_link' => __('Cancel Reply', 'cmsmasters'), 
		'label_submit' => __('Submit', 'cmsmasters') 
	));
}


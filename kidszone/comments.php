<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'iamd_text_domain'); ?></p>
<?php
	return;
}
?>
<!-- START EDITING HERE. -->

<?php $meta_set = get_post_meta($post->ID, '_dt_post_settings', true); $page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : 'content-full-width'; ?>

<?php if(have_comments()): ?>
	
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    	<div class="pagination">
            <ul class="commentNav">
                <li><?php previous_comments_link(); ?></li>
                <li><?php next_comments_link(); ?></li>
            </ul>
		</div>
	<?php endif; ?>
    
    <section class="commententries" id="comments">
	    <h3 class="hr-title"><?php comments_number(__('No Comments', 'iamd_text_domain'), __('Comment (1)', 'iamd_text_domain'), __('Comments (%)', 'iamd_text_domain')); ?></h3>
        <ul class="commentlist">
            <?php wp_list_comments('avatar_size=74&type=comment&callback=dt_theme_custom_comments&style=ul'); ?>
        </ul>
	</section><?php
	else:
		if('open' == $post->comment_status): ?>
            <h3 class="hr-title"><?php _e('No Comments', 'iamd_text_domain'); ?></h3><?php
		endif;
	endif;
	
	//PERFORMING COMMENT FORM...
	if('open' == $post->comment_status):
		$args = array(
			'comment_field' => '<div class="dt-sc-one-half column first"><textarea id="comment" name="comment" rows="7" cols="79" placeholder="'.__('Message', 'iamd_text_domain').'"></textarea></div>',
			'fields' => array(
					'author' => '<div class="dt-sc-one-half column"><input id="author" name="author" type="text" required="" placeholder="'.__('Name (required)', 'iamd_text_domain').'" />',
					'email' => '<input id="email" name="email" type="text" required="" placeholder="'.__('Email (required)', 'iamd_text_domain').'" />',
					'url' => '<input id="url" name="url" type="text" placeholder="'.__('URL', 'iamd_text_domain').'" /></div>',),
			'comment_notes_before' => '',
			'label_submit' => __('Comment', 'iamd_text_domain'),
			'comment_notes_after' => '',
			'title_reply' => __('Reply', 'iamd_text_domain'),
			'cancel_reply_link' => __('cancel reply', 'iamd_text_domain')
		);
		comment_form($args);
	endif; ?>
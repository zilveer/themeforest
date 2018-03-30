<?php
#Do not delete these lines...
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'iamd_text_domain'); ?></p>
<?php
	return;
}
?>
<!-- Start editing here -->

<?php if(have_comments()): ?>

	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    	<div class="pagination">
            <ul class="commentNav">
                <li><?php previous_comments_link(); ?></li>
                <li><?php next_comments_link(); ?></li>
            </ul>
		</div>
	<?php endif; ?>

    <div id="comments" class="commententries">
		<h3><?php comments_number(__('No Comments', 'iamd_text_domain'), __('Comment (1)', 'iamd_text_domain'), __('Comments (%)', 'iamd_text_domain')); ?></h3>
        <ul class="commentlist">
            <?php wp_list_comments('avatar_size=85&type=comment&callback=dt_theme_custom_comments&style=ul'); ?>
        </ul>
	</div><?php
	else:
		if('open' == $post->comment_status): ?>
            <div id="comments" class="commententries">
                <h3><?php _e('No Comments', 'iamd_text_domain'); ?></h3>
            </div><?php
		endif;
	endif;

	#Performing comment form...
	if('open' == $post->comment_status):
		$args = array(
			'comment_field' => '<textarea id="comment" name="comment" placeholder="'.__('Message', 'iamd_text_domain').'..."></textarea>',
			'fields' => array(
					'author' => '<div class="dt-sc-one-half column first"><input id="author" name="author" type="text" required="" placeholder="'.__('Name', 'iamd_text_domain').'..." /></div>',
					'email' => '<div class="dt-sc-one-half column"><input id="email" name="email" type="text" required="" placeholder="'.__('Email Address', 'iamd_text_domain').'..." /></div><div class="clear"></div>',
					'url' => '<input id="url" name="url" type="text" placeholder="'.__('Website', 'iamd_text_domain').'..." />',),
			'comment_notes_before' => '',
			'label_submit' => __('Submit Query', 'iamd_text_domain'),
			'comment_notes_after' => '',
			'title_reply' => __('Leave a Reply', 'iamd_text_domain'),
			'cancel_reply_link' => 'cancel reply'
		);
		comment_form($args);
	endif; ?>
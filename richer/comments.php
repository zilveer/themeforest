<div id="comments">
	<?php
	
		if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
			die ('Please do not load this page directly. Thanks!');
	
		if ( post_password_required() ) { ?>
			<?php _e('This post is password protected. Enter the password to view comments.', 'richer'); ?>
		<?php
			return;
		}
	?>
	
	<?php if ( have_comments() ) : ?>
		
		
		<h4 id="comments"><span><?php comments_number(__('comments', 'richer'), __('<span>1</span> comment', 'richer'), __('<span>%</span> comments', 'richer') );?></span></h4>
	
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link() ?></div>
			<div class="prev-posts"><?php next_comments_link() ?></div>
		</div>
	
		<ol class="commentlist clearfix">
			 <?php wp_list_comments(array('callback' => 'richer_comment' )); ?>
		</ol>
	
		<div class="navigation">
			<div class="next-posts"><?php previous_comments_link() ?></div>
			<?php paginate_comments_links(); ?> 
			<div class="prev-posts"><?php next_comments_link() ?></div>
		</div>
		
	 <?php else : // this is displayed if there are no comments so far ?>
	
		<?php if ( comments_open() ) : ?>
			<!-- If comments are open, but there are no comments. -->
	
		 <?php else : // comments are closed ?>
			<p class="hidden"><?php _e('Comments are closed.', 'richer'); ?></p>
	
		<?php endif; ?>
		
	<?php endif; ?>
		
		
<?php if ( comments_open() ) : ?>

	<?php
	
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		//Custom Fields
		$fields =  array(
			'author'=> '<div id="respond-inputs" class="row-fluid"><div class="span4"><input id="author" name="author" type="text" value="" placeholder="' . __('Name (required)', 'richer') . '" size="30"' . $aria_req . ' /></div>',
			
			'email' => '<div class="span4"><input id="email" name="email" type="text" value="" placeholder="' . __('E-Mail (required)', 'richer') . '" size="30"' . $aria_req . ' /></div>',
			
			'url' 	=> '<div class="span4"><input id="url" name="url" type="text" value="" placeholder="' . __('Website', 'richer') . '" size="30" /></div></div>',
		);

		//Comment Form Args
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>__('Leave A Comment', 'richer'),
			'comment_field' => '<div id="respond-textarea"><textarea id="comment" name="comment" placeholder="' . __('Comment text', 'richer') . '" aria-required="true" cols="58" rows="10" tabindex="4"></textarea></div>',
			'comment_notes_after' => '',
			'label_submit' => __('Post comment','richer')
		);
		
		// Show Comment Form
		comment_form($comments_args); 
	?>


<?php endif; // if you delete this the sky will fall on your head ?>

</div>
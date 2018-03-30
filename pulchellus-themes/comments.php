<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( __( 'This post is password protected. Enter the password to view comments.' , THEME_NAME ));?></p>
	<?php
		return;
	}
	
?>
<!-- Comment list -->
<div id="comments">
<?php //You can start editing here. ?>
<?php $commentNr=1; ?>
<?php if ( have_comments() && comments_open()) : ?>
			<h4 class="comments-title"><?php comments_number("0","1","%"); ?> <?php _e(' Comment responses', THEME_NAME);?></h4>
			<ol class="comment-list" id="comments">
				<?php wp_list_comments('type=comment&callback=orangethemes_comment'); ?>
			</ol>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->	
              <!-- Comments lists -->
             
               	  <h4><?php _e( 'No comments yet.' , THEME_NAME );?></h4>
                  <p><?php _e( 'No one have left a comment for this post yet!' , THEME_NAME );?></p>

	<?php endif; ?>
<?php endif; ?>

<?php if ( comments_open() ) : ?>


	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php printf ( __( 'Only <a href="%1$s"> registered </a> users can comment.', THEME_NAME ), wp_login_url( get_permalink() ));?> </p>
	<?php else : ?>

			<a href="#" name="respond"></a>
			<a href="#" name="comments"></a>
			<?php 
				$defaults = array(
					'comment_field'       	=> '<div id="respond-textarea"><div><label>'.__("Comment:",THEME_NAME).'</label><textarea name="comment" id="comment" placeholder="'.__("Your comment..",THEME_NAME).'"></textarea></div></div>',
					//'must_log_in'          => '',
					'comment_notes_before' 	=> '',
					'comment_notes_after'  	=> '',
					'id_form'              	=> 'comment-respond',
					'id_submit'            	=> 'submit',
					'title_reply'          => '',
					'title_reply_to'       => '',
					'cancel_reply_link'    	=> '',
					'label_submit'         	=> ''.__( 'Send', THEME_NAME ).'',
				);
				comment_form($defaults);			
			?>

	<?php endif; // if you delete this the sky will fall on your head ?>

<?php endif; ?>
</div>

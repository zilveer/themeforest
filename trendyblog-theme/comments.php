<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php printf ( esc_html__( 'This post is password protected. Enter the password to view comments.' , THEME_NAME ));?></p>
	<?php
		return;
	}

	
	add_action('comment_form_top', 'DF_fields_rules' );
	$differentThemesCommentID=1;

?>
<?php //You can start editing here. ?>
        <!-- Comments -->
        <div id="comments">
            <div class="panel_title">
                <div>
                    <h4><?php comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?></h4>
                </div>
            </div>

			<?php if ( have_comments()) { ?>
				<?php //comments_number(esc_html__('0 Comments', THEME_NAME), esc_html__('1 Comment', THEME_NAME), esc_html__('% Comments', THEME_NAME)); ?>
			<?php  } ?>

			<?php if ( have_comments() && comments_open()) : ?>
				<ol class="comment_list" id="comments">
					<?php wp_list_comments('type=all&callback=differentthemes_comment'); ?>
				</ol>
				<div class="comments-pager"><?php paginate_comments_links(); ?></div>
			<?php else : // this is displayed if there are no comments so far ?>
				<?php if ( comments_open() ) : ?>
				    <div class="no_comments">
				        <i class="fa fa-comments-o"></i>
				        <div>
				            <h4><?php esc_html_e('No Comments Yet!', THEME_NAME);?></h4>
				            <p><?php esc_html_e('You can be first to', THEME_NAME);?> <a href="#respond"><?php esc_html_e('comment this post!', THEME_NAME);?></p>
				        </div>
				    </div>
				<?php endif; ?>
			<?php endif; ?>
			<span id="success"></span>
		</div>
		<!-- End Comments -->


	<?php if ( comments_open() ) : ?>
		 <div id="respond">
		 	<h3><?php esc_html_e( 'Leave a Reply', THEME_NAME );?></h3>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p class="registered-user-restriction"><?php printf ( esc_html__( 'Only %1$s registered %2$s users can comment.', THEME_NAME ), '<a href="'.esc_url(wp_login_url( get_permalink() )).'">', '</a>');?> </p>
			<?php else : ?>
				<div id="writecomment" class="writecomment">
					<a href="#" name="respond"></a>
					<?php 
						$defaults = array(
							'comment_field'       	=> '<p><label for="comment">'.esc_html__("Comment",THEME_NAME).' <span>*</span></label><textarea name="comment" id="comment" placeholder="'.esc_html__("Your comment..",THEME_NAME).'"></textarea></p>',
							'comment_notes_before' 	=> '',
							'comment_notes_after'  	=> '',
							'id_form'              	=> '',
							'id_submit'            	=> 'submit',
							'title_reply'          => '',
							'title_reply_to'       => '',
							'cancel_reply_link'    	=> '',
							'label_submit'         	=> ''.esc_html__( 'Post a Comment', THEME_NAME ).'',
						);
						comment_form($defaults);			
					?>
				</div>
			<?php endif; // if you delete this the sky will fall on your head ?>
		</div>
	<?php endif; ?>
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.','veda'); ?></p>
<?php  return;
	endif;?>
    
    <h3><?php comments_number(esc_html__('No Comments','veda'), esc_html__('Comment ( 1 )','veda'), esc_html__('Comments ( % )','veda') );?></h3>
    <?php if ( have_comments() ) : ?>
    
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments','veda'  ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments','veda') ); ?></div>
                    </div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
        <ul class="commentlist">
     		<?php wp_list_comments( array( 'callback' => 'veda_comment_style' ) ); ?>
        </ul>
    
    <?php else: ?>
		<?php if ( ! comments_open() ) : ?>
            <p class="nocomments"><?php esc_html_e( 'Comments are closed.','veda'); ?></p>
        <?php endif;?>    
    <?php endif; ?>
	
    <!-- Comment Form -->
    <?php if ('open' == $post->comment_status) :
			$comment = "<div class='column dt-sc-one-half first'><textarea id='comment' name='comment' cols='5' rows='3' placeholder='".esc_html__("Comment",'veda')."' ></textarea></div>";
			$author = "<div class='column dt-sc-one-half'><p><input id='author' name='author' type='text' placeholder='".esc_html__("Name",'veda')."' required /></p>";
			$email = "<p> <input id='email' name='email' type='text' placeholder='".esc_html__("Email",'veda')."' required /> </p></div>";

				$comments_args = array(
					'title_reply' => esc_html__( 'Give a Reply','veda' ),
					'fields'=>array('author' => $author,'email' =>	$email),
					'comment_field'=> $comment,
					'comment_notes_before'=>'','comment_notes_after'=>'','label_submit'=>esc_html__('Comment','veda'));
            comment_form($comments_args);?>
	<?php endif; ?>
<div id="comments">
<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!','vulcan'));

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php echo __('This post is password protected. Enter the password to view comments.', 'vulcan') ?></p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

	<?php if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
    		
    		<h3><?php comment_form_title(__('Comment', 'vulcan')); ?></h3>
        <div class="divider"></div>
    		
    		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=50&callback=indonez_comment'); ?>
        </ol>
        <?php endif; ?>
        <div class="clear"></div>
        
        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
    		<h6><?php echo __('Trackbacks for this post', 'vulcan') ?></h6>
    		<ol class="commentlist">
        <?php wp_list_comments('type=pings&callback=indonez_list_pings'); ?>
        </ol>
        <?php endif; ?>
		    <div class="clear"></div>
        
    		<div class="navigation">
    			<div class="alignleft"><?php previous_comments_link(); ?></div>
    			<div class="alignright"><?php next_comments_link(); ?></div>
    		</div>
    		
		<?php if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		<p class="nocomments"><?php echo __('Comments are now closed for this article.', 'vulcan') ?></p>
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>
        <!-- If comments are open, but there are no comments. -->

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php echo __('Comments are closed.', 'vulcan') ?></p><?php } ?>

        <?php endif; ?>
        
        
<?php endif; ?>


	<?php if ( comments_open() ) : ?>

	<div id="respond">
    <div id="commentform-wrap">	
    <?php 
      $defaults = array( 
      'fields' => apply_filters( 'comment_form_default_fields', 
        array(
          'author' => 
                  '<fieldset><label for="author">' . __( 'Name' ,'vulcan') . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
                  '<input id="author" name="author" type="text" value="' .esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" class="textfield"/>',
          
          'email'  => 
                  '<label for="email">' . __( 'Email','vulcan' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
                  '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" class="textfield" />',
          
          'url'    => 
                  '<label for="url">' . __( 'Website','vulcan' ) . '</label>' .
                  '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3"  class="textfield" />'  ) ),
          
          'comment_field' => 
                    '<textarea id="comment" name="comment" cols="2" rows="4" tabindex="4" aria-required="true" class="textarea" ></textarea><div class="clear"></div> </fieldset>',
          
          'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%s">%s</a>. <a title="Log out of this account" href="%s">Log out?</a></p>
                    ' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ),
          
          'comment_notes_after' => '',
          'id_form' => 'comment-form',
          'id_submit' => 'submit',
          'title_reply' => __( 'Leave a Reply','vulcan' ),
          'title_reply_to' => __( 'Leave a Reply to %s' ,'vulcan'),
          'cancel_reply_link' => __( 'Cancel reply' ,'vulcan'),
          'label_submit' => __( 'Submit','vulcan')
          );
    
    comment_form($defaults); 

    ?>
      </div>
    </div>
	<?php endif; // If registration required and not logged in ?>


</div>
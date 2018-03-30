<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/


    /* Password protected? ----------------------------------------------------------*/
    if ( post_password_required() ) 
		return;
?>

<div id="comments">
<?php 
/*-----------------------------------------------------------------------------------*/
/*	Display the Comments & Pings
/*-----------------------------------------------------------------------------------*/

	if ( have_comments() ) :
	
        /* Display Comments ---------------------------------------------------------*/    
        if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
	
	        <h3 class="comments-title"><?php comments_number(__('0 Comments', AZ_THEME_NAME), __('1 Comment', AZ_THEME_NAME), __('% Comments', AZ_THEME_NAME)); ?></h3>
	
        	<ol class="commentlist">
            <?php wp_list_comments( 'type=comment&callback=az_comment' ); ?>
            </ol>

        <?php endif; // end normal comments 
        
        /* Display Pings -------------------------------------------------------------*/
        if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
    		<h3 class="pings-title"><?php _e('Trackbacks for this post', AZ_THEME_NAME) ?></h3>
		
    		<ol class="pinglist">
            <?php wp_list_comments( 'type=pings&callback=az_comment_list_pings' ); ?>
            </ol>

            <span class="divider-comment"><i class="font-icon-ellipsis"></i></span>

        <?php endif; // end pings 
		
		/* Display Comment Navigation -----------------------------------------------*/
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    		<div class="comment-navigation">
    			<div class="nav-previous"><?php previous_comments_link( sprintf( '&larr; %s', __('Older Comments', AZ_THEME_NAME) ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( sprintf( '%s &rarr; ', __('Newer Comments', AZ_THEME_NAME) ) ); ?></div>
    		</div>
		<?php endif; // end comment pagination check ?>
        
        <?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e('Comments are closed.', AZ_THEME_NAME) ?></p>
		<?php endif; ?>
        
    <?php endif; // have_comments() ?>
		

<?php 
	/*-----------------------------------------------------------------------------------*/
	/*	Comment Form
	/*-----------------------------------------------------------------------------------*/
	
	if ( comments_open() ) :

	    $fields = array(
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="40" rows="10" aria-required="true"></textarea></p>',
            'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', AZ_THEME_NAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', AZ_THEME_NAME ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'title_reply' => __('Leave a Reply', AZ_THEME_NAME),
            'title_reply_to' => __('Leave a Reply to %s', AZ_THEME_NAME),
            'cancel_reply_link' => __('/ Cancel Reply', AZ_THEME_NAME),
            'label_submit' => __('Submit Comment', AZ_THEME_NAME)
	    );
		    	
	    comment_form($fields); 

	 endif; // end if comments open check ?>
</div>
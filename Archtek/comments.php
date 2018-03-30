<?php
    
// ---------------------------------------------- //
// This template is for listing the comments and 
// comment form
// ---------------------------------------------- //
    
?>

<?php if( ! post_password_required()) : // Only visible for non-protected post or after verified ?>

	<a id="comments" class="topic"></a>
	<div id="comments-wrapper" class="comment-section">
	    <h4 class="comment-section-title"><?php comments_number('', __('1 Comment', 'uxbarn'), __('% Comments', 'uxbarn')); ?></h4>
	
	    <?php 
	    
	    $args = array(
	    		    'style'             => 'ul',
	    		    'type'              => 'all',
	    		    'avatar_size'       => 50,
	    		    'callback' => 'uxbarn_create_custom_comment',
	    			);
	    ?>
	    
	    <ul class="commentlist">
	    <?php wp_list_comments($args); ?>
	    </ul>
	    
	    <?php
	    //$current_page = max(1, get_query_var('paged'));
	    $comment_paging_args = array(
	    							//'current' => $current_page,
	    							'prev_text' => '<i class="fa fa-angle-left"></i>', 
	    							'next_text' => '<i class="fa fa-angle-right"></i>');
	    
	    
	    echo '<div class="comment-paging">';
	    paginate_comments_links($comment_paging_args);
	    echo '</div>';
	    
	    $commenter = wp_get_current_commenter();
	    $req = get_option( 'require_name_email' );
	    $aria_req = ( $req ? " aria-required='true'" : '' );
	    
	    $email_watermark = '';
	    $website_watermark = '';
	    
	    $fields =  array(
	    	'author' => '<div class="row"><div class="large-5 columns less-padding"><label for="author" class="required label">' . __('Name', 'uxbarn') . ' ' . ( $req ? '<span class="required"></span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
	    	
	    	'email'  => '<div class="row"><div class="large-5 columns less-padding"><label for="email" class="required label">' . __('Email', 'uxbarn') . ' ' . ( $req ? '<span class="required"></span>' : '' ) . '</label><input id="email" placeholder="' . $email_watermark . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
	    	
	    	'url'    => '<div class="row"><div class="large-5 columns less-padding"><label for="url">' . __('Website', 'uxbarn') . '</label><input id="url" name="url" type="text" placeholder="' . $website_watermark . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div>',
	    );
	    
	    $comments_args = array(
	        'fields' =>  $fields,
	        
	        'comment_field' => '<div class="row"><div class="large-12 columns less-padding"><label for="comment">' . __('Comment', 'uxbarn') . '</label><textarea id="comment" name="comment" aria-required="true"></textarea></div></div>',
	        
	        'comment_notes_before' => '',
	                        
	        'comment_notes_after' => '',
	        
	        'title_reply'=> __('Leave a Comment', 'uxbarn'),
	        
	        'cancel_reply_link' => __('<span class="cancel-reply">Cancel Reply</span>', 'uxbarn'),
	        
	        'label_submit' => __('Submit', 'uxbarn'),
	        
	        'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'uxbarn'), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	        
	        'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'uxbarn'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	        
	    );
	     
	    comment_form($comments_args);
	    
	    ?>
	
	</div> <!-- close id="comments-wrapper" -->
	
<?php endif; ?>

<?php
global $of_option;
// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_no_comments = $of_option[$prefix.'tr_no_comments'];
	$tr_comment = $of_option[$prefix.'tr_comment'];
	$tr_comments = $of_option[$prefix.'tr_comments'];
	$tr_leave_reply = $of_option[$prefix.'tr_leave_reply'];
	$tr_cancel_reply = $of_option[$prefix.'tr_cancel_reply'];
	$tr_no_comments_msg = $of_option[$prefix.'tr_no_comments_msg'];
	$tr_name = $of_option[$prefix.'tr_name']; 
	$tr_email = $of_option[$prefix.'tr_email']; 
	$tr_website = $of_option[$prefix.'tr_website']; 
}else{			
	$tr_no_comments = __('No Comments', 'spacing');
	$tr_comment = __('Comment', 'spacing');
	$tr_comments = __('Comments', 'spacing');
	$tr_leave_reply = __('Leave a Reply', 'spacing');
	$tr_cancel_reply = __('Cancel', 'spacing');
	$tr_no_comments_msg = __('There are no comments on this post yet', 'spacing');
	$tr_name = __('Name', 'spacing');
	$tr_email = __('E-Mail', 'spacing'); 
	$tr_website = __('Website', 'spacing');
}
$blog_layout = $of_option['st_blog_layout'];
$layout = get_post_meta($post->ID, 'page_layout', true);
?>

<div class="divider"></div>
<!-- Comments Section Begin --> 
    
	<div id="comments" class="blog-default-holder">
    
    	<?php if($blog_layout == "1"){ ?>
        <div class="blog-default-meta post-meta-box two columns">  
        	<p>    
              <span><?php echo $tr_comments ?></span>
              <?php comments_number($tr_no_comments, '1 '.$tr_comment, '% '.$tr_comments ); ?>
            </p>
        </div>
        <?php } ?>        
        
        <div class=" <?php if($blog_layout == "1" && $layout == "fullwidth"){ echo "fourteen"; } elseif($blog_layout == "1" && $layout == "sidebar-right" || $blog_layout == "1" && $layout == "sidebar-left"){ echo "ten"; }elseif($blog_layout == "1" && $layout == "sidebar-both"){ echo "six"; }elseif($blog_layout == "2" && $layout == "fullwidth"){ echo "sixteen"; }elseif($blog_layout == "2" && $layout == "sidebar-both"){ echo "eight"; }else{ echo "twelve"; }  ?> columns">
        	<?php if($blog_layout == "2"){?>
        	<h3><?php comments_number($tr_no_comments, '1 '.$tr_comment, '% '.$tr_comments ); ?></h3>        
        	<?php } ?>
            
        	<div class="comments-holder">
        	<?php if ( have_comments() ) : ?>
            <ul>
            <?php wp_list_comments('type=comment&callback=st_comment&per_page=4&reverse_top_level=1'); ?>
            </ul>
            <?php

			else : // no comments so far
				echo $tr_no_comments_msg;
				if ('open' == $post->comment_status) :
					// If comments are open, but there are no comments.
				else :
				endif;
			
			endif;
			?>
            </div>
        	<?php blog_pagination() ?>
            
        </div>
    
    </div>


<?php if ('open' == $post->comment_status) : ?>

	<div class="comments-reply blog-default-holder">
       
        <?php if($blog_layout == "1"){ ?>
        <div class="blog-default-meta post-meta-box two columns">  
        	<p>    
              <span><?php echo $tr_leave_reply ?></span>
            </p>
        </div>
        <?php } ?>
        
       <div class=" <?php if($blog_layout == "1" && $layout == "fullwidth"){ echo "fourteen"; } elseif($blog_layout == "1" && $layout == "sidebar-right" || $blog_layout == "1" && $layout == "sidebar-left"){ echo "ten"; }elseif($blog_layout == "1" && $layout == "sidebar-both"){ echo "six"; }elseif($blog_layout == "2" && $layout == "fullwidth"){ echo "sixteen"; }elseif($blog_layout == "2" && $layout == "sidebar-both"){ echo "eight"; }else{ echo "twelve"; }  ?> columns">
       
       		<?php if($blog_layout == "2"){?>
        	<h3><?php comments_number($tr_no_comments, '1 '.$tr_comment, '% '.$tr_comments ); ?></h3>        
        	<?php } ?>
            
            <div id="respond" class="comments-respond padding-bottom">
                
                <span><?php cancel_comment_reply_link($tr_cancel_reply); ?></span>
                <div class="cancel-comment-reply">                
                </div>
                
                <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                        <p class="reply-note">You must be <a href="<?php echo get_option('siteurl'); ?>
                /wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
                    <?php else : ?>
                
                                             
                    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" class="contact-form" method="post" id="commentform">
                
                <?php if ( $user_ID ) : ?>
                
                    <p class="reply-note">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php">
                <?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" 
                title="Log out of this account">Log out »</a></p>
                
                <?php else : ?>
                    <label for="author"><?php echo $tr_name ?>:</label>
                    <input type="text" class="text" name="author" id="author" value="<?php echo $comment_author; ?>">
                    
                    <label for="email"><?php echo $tr_email ?>:</label>
                    <input type="text" class="text" name="email" id="email" value="<?php echo $comment_author_email; ?>"> 
                
                    <label for="url"><?php echo $tr_website; ?>:</label>
                    <input type="text" class="text" name="url" id="url" value="<?php echo $comment_author_url; ?>"> 
                
                <?php endif; ?>
                
                    <label for="comment"><?php echo $tr_comment; ?>:</label> 
                    <textarea name="comment" id="comment" rows="8" cols="60"></textarea><br />
                
                    <input type="submit" name="submit" id="submit" class="button light" value="<?php _e('Submit','spacing') ?>">
                    
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                
                    </form>
                
                <?php endif;  ?>
                
            </div>
            
        </div>
    
    </div>
    
<!-- Comments Section End --> 
 
<?php endif; ?>    
    



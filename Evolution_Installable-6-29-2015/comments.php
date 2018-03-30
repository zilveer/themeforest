<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) : ?>
	<p class="nocomment"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'Evolution' ); ?></p>
</div>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>
<!-- You can start editing here. -->
<div class="comments">
<?php if ( have_comments() ) : ?>
<p class="color comment_count">
	<?php printf( _n( '%1$s Comments ', '%1$s Comments', get_comments_number(), 'Evolution' ),
		number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
	?>
</p>
 

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Evolution' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Evolution' ) ); ?></div>
	</div> <!-- .navigation -->
<?php endif; ?>
 
<ol class="comment_list">
	<?php wp_list_comments('callback=Evolution_comment'); ?>
</ol>
 
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'Evolution' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'Evolution' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e( 'Comments are closed.', 'Evolution' ); ?></p>
 
<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
</div>
<div id="respond" class="leave_comment">
    <p class="contact_title"><?php comment_form_title( 'Leave a Comment', 'Leave a Reply to %s' ); ?></p>
    <div class="cancel-comment-reply bottom10">
        <?php cancel_comment_reply_link(); ?>
    </div>
 
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p class="bottom20">
            You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> 
            to post a comment.
        </p>
    <?php else : ?> 
        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
            <div class="contact_form">     
            <?php if ( $user_ID ) : ?>
            <div class="row">
                <div class="large-12 columns">
                    <p class="com_logined_text">
                        <?php _e('Logged in as', 'Evolution')?> 
                        <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
                        <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'Evolution')?> &raquo;</a>
                    </p>
                </div>
            </div> 
            
            <?php else : ?>
           
                <div class="row">
                    <div class="large-4 columns">
                        <input type="text" name="author" id="author" placeholder="Name" title="<?php _e('Name', 'Evolution')?>" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                    </div>
                    <div class="large-4 columns">
                        <input type="text" name="email" id="email" placeholder="Email" title="<?php _e('Email', 'Evolution')?>" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                    </div>
                    <div class="large-4 columns">
                        <input type="text" name="website" id="website" placeholder="Website" title="<?php _e('Website', 'Evolution')?>" value="<?php echo $comment_author_website; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                    </div>
                
                <?php endif; ?>
                
                    <div class="large-12 columns">
                        <textarea name="comment" title="<?php _e('Comment', 'Evolution')?>" id="comment" cols="10" rows="15" tabindex="4"></textarea>
                    </div>
                    <div class="small-4 columns right">
                        <input type="submit" class="button right" value="Add a comment">
                    </div>
                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </div>
            </div>
        </form>
</div>
	<?php endif; // If registration required and not logged in ?>

 
<?php endif;  ?>

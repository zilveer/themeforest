<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename
($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>

<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework'); ?></p>
    <?php
		return;
	}
?>
    <!-- You can start editing here. -->
    <?php if ( have_comments() ) : ?>
   <div class="commentsheader">
    <h3><?php _e('Comments', 'framework'); ?></h3>
    </div>
<ol class="listcomments">
    <?php wp_list_comments('type=comment&callback=ag_comment'); ?>
</ol>
<div class="navigation-comments">
    <div class="alignleft">
        <p>
            <?php previous_comments_link() ?>
        </p>
    </div>
    <div class="alignright">
        <p>
            <?php next_comments_link() ?>
        </p>
    </div>
</div>
<div class="clear"></div>
<?php else : // this is displayed if there are no comments so far ?>
<?php if ('open' == $post->comment_status) : ?>
<?php else : // comments are closed ?>
<?php endif; ?>
<?php endif; ?>
<?php
/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

if ( comments_open() ) : ?>
<!-- Submit Comment Form -->
<div class="commentsform">
<h4><?php _e('Submit a Comment', 'framework'); ?></h4>
<div class="divider"></div>
<div id="respond">
    <div class="cancel-reply">
        <p>
            <?php cancel_comment_reply_link(__('This post is password protected. Enter the password to view comments.', 'framework')); ?>
        </p>
    </div>
    <div class="clear"></div>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p><?php _e('You must be logged in to post a comment.', 'framework'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('Login', 'framework'); ?></a></p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentsubmit">
        <?php if ( $user_ID ) : ?>
        <p><?php _e('Logged in as', 'framework'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account"><?php _e('Logout.', 'framework'); ?>  &raquo;</a></p>
        <?php else : ?>
        <div class="grid_4 alpha">
            <label for="author"><?php _e('Name', 'framework'); ?>
                <?php if ($req) echo "<span>*</span>"; ?>
            </label>
            <input type="text" name="author"  id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "class='required'"; ?> />
        </div>
        <div class="grid_4 alpha">
            <label for="email"><?php _e('Mail', 'framework'); ?> 
                <?php if ($req) echo "<span>*</span>"; ?>
            </label>
            <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "class='required email'"; ?>/>
        </div>
        <div class="clear"></div>
        <label for="url"><?php _e('Website', 'framework'); ?> 
            <?php if ($req) echo "<span>*</span>"; ?>
        </label>
        <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="44" tabindex="3" <?php if ($req) echo "class='required'"; ?> />
        <?php endif; ?>
        <label for="comment"><?php _e('Message', 'framework'); ?> <span>*</span></label>
        <textarea name="comment" id="comment" cols="58" rows="8" tabindex="3" <?php if ($req) echo "class='required'"; ?>></textarea>
        <p>
            <input name="submit" type="submit" class="button" tabindex="5" value="Submit Comment" />
            <?php comment_id_fields(); ?>
        </p>
        <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        <?php do_action('comment_form', $post->ID); ?>
        <div class="clear"></div>
    </form>
    <div class="clear"></div>
    </div>
</div>
<?php endif; // If registration required and not logged in ?>
<?php endif; ?>

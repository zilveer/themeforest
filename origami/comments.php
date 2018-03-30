<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
        <div class="clear"> </div>
        <p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>


        <div class="clear"> </div>
        <div class="comments-box clearfix">
<?php if ( have_comments() ) : ?>
          <div class="legend"><span class="comment-stats"><span><?php comments_number('0', '1', '%'); ?></span></span></div>
	      <ol class="commentlist">
	        <?php wp_list_comments('type=comment&callback=custom_comment'); ?>
	      </ol>
	      <div class="pagenavi"> <?php previous_comments_link() ?> <?php next_comments_link() ?> </div>
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
          <div class="legend"><span class="comment-stats"><span><?php comments_number('0', '1', '%'); ?></span></span></div>
          <p>&nbsp;</p>
          <p class="nocomments">No comments yet</p>
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>
	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>
          <div class="clear"></div>
          <div id="respond">
            <h2><span><?php comment_form_title( 'What do you think' ); ?></span></h2>
            <div class="commentform clearfix">
              <p><small><?php cancel_comment_reply_link(); ?></small></p>
              <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" onsubmit="if(document.getElementById('url').value=='Your website'){document.getElementById('url').value=''}">
                <div class="left">
                  <p> <input type="text" name="author" id="author" value="Name" onBlur="if(this.value==''){this.value='Name'}" onFocus="if(this.value=='Name'){this.value=''}" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /> </p>
                  <p> <input type="text" name="email" value="Your email" onBlur="if(this.value==''){this.value='Your email'}" onFocus="if(this.value=='Your email'){this.value=''}" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /> </p>
                  <p> <input type="text" name="url" id="url" value="Your website" onBlur="if(this.value==''){this.value='Your website'}" onFocus="if(this.value=='Your website'){this.value=''}" size="22" tabindex="3" /> </p>                
                </div>
                <div class="right">
                  <p><textarea name="comment" rows="10" tabindex="4" onBlur="if(this.value==''){this.value='Your Message'}" onFocus="if(this.value=='Your Message'){this.value=''}" >Your Message</textarea></p>
                  <p><button class="button small slateblue" name="submit" type="submit" id="submit" tabindex="5"><span><span>SUBMIT</span></span></button><?php comment_id_fields(); ?></p>
                </div>
                <?php do_action('comment_form', $post->ID); ?>
              </form>
            </div>
          </div>

<?php endif; // if you delete this the sky will fall on your head ?>
        </div>


<?php
	global $prk_astro_options;
	global $prk_translations;
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
	}
?>
<?php function astro_comment($comment, $args, $depth) {
	global $prk_astro_options;
	global $prk_translations;
  	$GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article id="comment-<?php comment_ID(); ?>" class="cf single_comment">
      <header class="comment-author vcard">
        <?php echo get_avatar($comment, $size = '44'); ?>
      </header>
      <div class="comment_floated prk_bordered">
      	<div class="comments_meta_wrapper prk_uppercased zero_color">
        <?php printf(__('<div class="fn author_name left_floated">%s</div>', 'astro'), get_comment_author_link()); ?>
	        <div class="pir_divider_cmts left_floated">|</div>
	        <time datetime="<?php echo comment_date('c'); ?>" class="comment_date left_floated prk_bold">
					<?php 
						echo get_comment_date(); 
						echo " @ ";
						echo get_comment_time(); 
	                ?>
	       	</time>
        <div class="left_floated">
        	<div class="pir_divider_cmts left_floated">|</div>
      		<?php 
      			comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<div class="left_floated prk_bold">'.$prk_translations['reply_text'].'</div><div class="navicon-forward left_floated"></div>'))); ?>
		</div>
        </div>
      <?php if ($comment->comment_approved == '0') { ?>
        <div class="alert alert-block fade in">
          <a class="close" data-dismiss="alert">&times;</a>
          <p><?php _e('Your comment is awaiting moderation.', 'astro'); ?></p>
        </div>
      <?php } ?>
      <section class="comment comment_text left_floated">
        <?php comment_text() ?>
      </section>
      <div class="clearfix"></div>
		</div>
    </article>
<?php } ?>

<?php if (post_password_required()) { ?>
  <div id="comments">
    <div class="alert alert-block fade in">
      <a class="close" data-dismiss="alert">&times;</a>
      <p><?php _e('This post is password protected. Enter the password to view comments.', 'astro'); ?></p>
    </div>
  </div><!-- /#comments -->
<?php
  return;
} ?>

<?php if (have_comments() && comments_open()) { ?>
  <div id="comments">
    	<div>
    		<h3 class="small header_font bd_headings_text_shadow zero_color">
                <?php printf(_n(($prk_translations['comments_one_response']), '%1$s '.($prk_translations['comments_oneplus_response']), get_comments_number()), number_format_i18n(get_comments_number())); ?>
        	</h3>
        </div>
    <ol class="commentlist">
      <?php wp_list_comments(array('callback' => 'astro_comment')); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) { // are there comments to navigate through ?>
      <nav id="comments-nav" class="pager">
        <div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'astro')); ?></div>
        <div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'astro')); ?></div>
      </nav>

    <?php } // check for comment navigation ?>

  </div><!-- /#comments -->
  <div class="clearfix"></div>
<?php } ?>

<?php 
	if (0) 
	{
		comment_form();
	}
	if (comments_open()) { 
	?>
  		<section id="respond">
    		<h3 class="small header_font bd_headings_text_shadow zero_color">
                <?php comment_form_title(($prk_translations['comments_leave_reply']), ($prk_translations['comments_leave_reply'].' to %s')); ?>
        	</h3>
            <p class="cancel-comment-reply not_zero_color"><?php cancel_comment_reply_link(('Click here to cancel reply')); ?></p>
            <?php 
				if (get_option('comment_registration') && !is_user_logged_in()) 
				{ 
					?>
              		<p><?php printf(('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(get_permalink())); ?></p>
            		<?php 
				} 
				else 
				{ 
					?>
              		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="comment_form">
						<?php 
							if (is_user_logged_in()) 
							{ 
								?>
								<p><?php printf(('Logged in as <a href="%s/wp-admin/profile.php" class="not_zero_color">%s</a>.'), get_option('siteurl'), $user_identity); ?> 
									<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php ('Log out of this account'); ?>" class="not_zero_color">
										<?php _e('Log out &raquo;', 'astro'); ?>
									</a>
								</p>
								<?php 
							} 
							else 
							{ 
								?>
                                <div class="row">
                                <div class="four columns">
                                    <input type="text" class="text pirenko_highlighted" name="author" id="author" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php echo esc_attr($prk_translations['comments_author_text']); if ($req) echo($prk_translations['required_text']); ?>" data-original="<?php echo esc_attr($prk_translations['comments_author_text']);echo esc_attr($prk_translations['required_text']); ?>" />
							  	</div>
                                <div class="four columns">
                                    <input type="email" class="text pirenko_highlighted" name="email" id="email" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> 
                                    placeholder="<?php echo esc_attr($prk_translations['comments_email_text']); if ($req) echo($prk_translations['required_text']); ?>" data-original="<?php echo esc_attr($prk_translations['comments_email_text']);echo esc_attr($prk_translations['required_text']); ?>" />		
                                </div>
                                <div class="four columns">
                                    <input type="url" class="text pirenko_highlighted" name="url" id="url" size="22" tabindex="3" 
                                    placeholder="<?php echo esc_attr($prk_translations['comments_url_text']); ?>" />
                                </div>
                                </div>
								<?php 
							} 
						?>
                        <textarea name="comment" id="comment" class="input-xlarge pirenko_highlighted" tabindex="4"
                        placeholder="<?php echo esc_attr($prk_translations['comments_comment_text']); ?>" data-original="<?php echo esc_attr($prk_translations['comments_comment_text']); ?>"></textarea>
                        <div id="comment_form_messages" class="cf zero_color special_italic"></div>
                        <div class="clearfix"> </div>
                        <div id="submit_comment_div" class="body_text_shadow default_color header_font">
                        	<a href="#">
                        		<div class="left_floated">
                        			<?php echo($prk_translations['comments_submit']); ?>
                        		</div>
                        		<div class="navicon-forward left_floated"></div>
                        	</a>
                      	</div>
                        <div class="clearfix"></div>
                        <?php comment_id_fields(); ?>
                        <?php do_action('comment_form', $post->ID); ?>
              		</form>
            		<?php 
				} 
			?>
  		</section>
        <div class="clearfix"></div>
		<?php 
	} 
?>
<script type="text/javascript">
jQuery(document).ready(function()
{
	var wordpress_directory = '<?php echo get_option('siteurl'); ?>';
	var empty_text_error = '<?php echo esc_attr($prk_translations['empty_text_error']); ?>';
	var invalid_email_error = '<?php echo esc_attr($prk_translations['invalid_email_error']); ?>';
	var wait_message = '<?php echo esc_attr($prk_translations['contact_wait_text']); ?>';
	var comment_ok_message = '<?php echo esc_attr($prk_translations['comment_ok_message']); ?>';
	var already_submitted_comment=false;
	jQuery('#commentform textarea, #author, #email').focus(function () {
		jQuery("#comment_form_messages").hide("slow");
	});
	jQuery('#submit_comment_div a').click(function(e) {
		e.preventDefault();
		//REMOVE PREVIOUS ERROR MESSAGES IF THEY EXIST
		jQuery("#respond .contact_error").remove();
		error = false;
        emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;	
		if (already_submitted_comment===false) {
			//DATA VALIDATION
			jQuery('#commentform textarea, #author, #email').each(function() {
				value = jQuery(this).val();
				theID = jQuery(this).attr('id');
				if(value == '' || value===jQuery(this).attr('data-original')) {
					jQuery(this).after('<p class="contact_error zero_color special_italic">'+empty_text_error+'</p>');
					error = true;
				}
				if(theID === 'email' && value !=='' && value!==jQuery(this).attr('data-original') && !emailReg.test(value)) {
					jQuery(this).after('<p class="contact_error zero_color special_italic">'+invalid_email_error+'</p>');
					error = true;
				}
				
			});
			//SEND COMMENT IF THERE ARE NO ERRORS
			if(error === false) {
				jQuery('#comment_form_messages').html('');
				jQuery('#comment_form_messages').append('<p class="comment_error">'+wait_message+'</p>');
				jQuery("#comment_form_messages").css({'display':'inline-block'});
				//POST COMMENT
				jQuery.ajax({  
				type: "POST",  
				url: wordpress_directory+"/wp-comments-post.php",  
				data: jQuery("#commentform").serialize(),  
				success: function(resp) {
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append('<p class="comment_error">'+comment_ok_message+'</p>');
					jQuery("#comment_form_messages").css({'display':'inline-block'});
					already_submitted_comment=true;
				},  
				error: function(e) {  
					jQuery('#comment_form_messages').html('');
					jQuery('#comment_form_messages').append('<p class="comment_error">Comment error. Please try again!</p>');
					jQuery("#comment_form_messages").css({'display':'inline-block'});
				}
				});
			}
		}
	});
});
</script>
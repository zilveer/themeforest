<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) :
	die (__('Please do not load this page directly. Thanks!','vbegy'));
endif;

if ( post_password_required() ) :
    ?><p class="no-comments"><?php _e("This post is password protected. Enter the password to view comments.","vbegy");?></p><?php
    return;
endif;
echo '<div id="comments"></div>';
if ( have_comments() ) :
	$k = 0;?>
	<div id="commentlist" class="page-content <?php if (is_page()) {echo "no_comment_box";}?>">
		<div class="boxedtitle page-title"><h2><?php comments_number(__('Comments','vbegy'),__('Comment','vbegy'), __('Comments','vbegy'));?> ( <span class="color"><?php comments_number(__('No','vbegy'),__('1','vbegy'), __('%','vbegy'));?></span> )</h2></div>
		<ol class="commentlist clearfix">
            <?php wp_list_comments('callback=vbegy_comment');?>
        </ol><!-- End commentlist -->
    </div><!-- End page-content -->
    
    <div class="pagination comments-pagination">
        <?php paginate_comments_links(array('prev_text' => '&laquo;', 'next_text' => '&raquo;'))?>
    </div><!-- End comments-pagination -->
<?php endif;

if ( comments_open() ) :
	if (vpanel_options("Ahmed") == 1) :comment_form();endif;?>
	
	<div id="respond" class="comment-respond page-content clearfix <?php if (!have_comments()) {echo "no_comment_box";}?>">
	    <div class="boxedtitle page-title"><h2><?php comment_form_title(__('Leave a reply','vbegy'),__('Leave a reply to %s','vbegy'));?></h2></div>
	    <?php $post_comments_user = vpanel_options("post_comments_user");
	    $post_comments_user_active = true;
	    if ($post_comments_user == 1) {
	    	if (!is_user_logged_in()) {
	    		$post_comments_user_active = false;
	    	}
	    }
	    if ($post_comments_user_active == true) {?>
		    <form action="<?php echo esc_url(home_url('/'));?>wp-comments-post.php" method="post" id="commentform">
		    	<div class="ask_error"></div>
		        <?php if ( is_user_logged_in() ) : ?>
		            <p><?php _e('Logged in as','vbegy')?> <a href="<?php echo get_option('siteurl');?>/wp-admin/profile.php"><?php echo $user_identity;?></a>. <a href="<?php echo wp_logout_url(get_permalink());?>" title="Log out of this account"><?php _e('Log out &raquo;','vbegy')?></a></p>
		        <?php else : ?>
			        <div id="respond-inputs" class="clearfix">
			            <p>
			                <label class="required" for="comment_name"><?php _e('Name','vbegy');?><span>*</span></label>
			                <input name="author" type="text" value="" id="comment_name" aria-required="true">
			            </p>
			            <p>
			                <label class="required" for="comment_email"><?php _e('E-Mail','vbegy');?><span>*</span></label>
			                <input name="email" type="text" value="" id="comment_email" aria-required="true">
			            </p>
			            <p class="last">
			                <label class="required" for="comment_url"><?php _e('Website','vbegy');?></label>
			                <input name="url" type="text" value="" id="comment_url">
			            </p>
			        </div>
		        <?php endif;?>
		        <div class="clearfix">
		        	<?php
		        	$the_captcha_comment = vpanel_options("the_captcha_comment");
		        	$captcha_style = vpanel_options("captcha_style");
		        	$captcha_question = vpanel_options("captcha_question");
		        	$captcha_answer = vpanel_options("captcha_answer");
		        	$show_captcha_answer = vpanel_options("show_captcha_answer");
		        	if ($the_captcha_comment == 1) {
		        		if ($captcha_style == "question_answer") {
		        			echo "<div class='clearfix'></div>
		        			<p class='ask_captcha_p'>
		        				<label for='ask_captcha' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
		        				<input size='10' id='ask_captcha' name='ask_captcha' class='ask_captcha captcha_answer' value='' type='text'>
		        				<span class='question_poll ask_captcha_span'>".$captcha_question.($show_captcha_answer == 1?" ( ".$captcha_answer." )":"")."</span>
		        				<span class='clearfix'></span>
		        			</p>";
		        		}else {
		        			$rand = rand(0000,9999);
		        			echo "
		        			<span class='clearfix'></span>
		        			<p class='ask_captcha_p'>
		        				<label for='ask_captcha_".$rand."' class='required'>".__("Captcha","vbegy")."<span>*</span></label>
		        				<input size='10' id='ask_captcha_".$rand."' name='ask_captcha' class='ask_captcha' value='' type='text'><img class='ask_captcha_img' src='".get_template_directory_uri()."/captcha/create_image.php' alt='".__("Captcha","vbegy")."' title='".__("Click here to update the captcha","vbegy")."' onclick=";echo '"javascript:ask_get_captcha';echo "('".get_template_directory_uri()."/captcha/create_image.php', 'ask_captcha_img_".$rand."');";echo '"';echo " id='ask_captcha_img_".$rand."'>
		        				<span class='question_poll ask_captcha_span'>".__("Click on image to update the captcha .","vbegy")."</span>
		        				<span class='clearfix'></span>
		        			</p>";
		        		}
		        	}
		        	?>
		        </div>
		        <div id="respond-textarea">
		            <p>
		                <label class="required" for="comment"><?php _e('Comment','vbegy');?><span>*</span></label>
		                <?php $comment_editor = vpanel_options("comment_editor");
		                if ($comment_editor == 1) {
		                    $settings = array("textarea_name" => "comment","media_buttons" => true,"textarea_rows" => 10);
		                    wp_editor("","comment",$settings);
		                }else {?>
		                	<textarea id="comment" name="comment" aria-required="true" cols="58" rows="10"></textarea>
		                <?php }?>
		            </p>
		            <?php echo '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s','vbegy' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>'?>
		        </div>
	        	<div class="cancel-comment-reply"><?php cancel_comment_reply_link();?></div>
		        <p class="form-submit">
		        	<input name="submit" type="submit" id="submit" value="<?php _e('Post Comment','vbegy')?>" class="button small color">
		        	<?php comment_id_fields();?>
		        	<?php do_action('comment_form', $post->ID);?>
		        </p>
		    </form>
		<?php }else {?>
			<p class="no-login-comment"><?php printf(__('You must <a href="%s" class="login-comments">login</a> or <a href="%s" class="signup">register</a> to add a new comment .','vbegy'),get_page_link(vpanel_options('login_register_page')),get_page_link(vpanel_options('login_register_page')))?></p>
		<?php }?>
	</div>
<?php endif;?>
<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	update_option('im_lang_slide_read_more',trim(mysql_real_escape_string($_POST['im_lang_slide_read_more'])));
	
	update_option('im_lang_blog_more',trim(mysql_real_escape_string($_POST['im_lang_blog_more'])));
	update_option('im_lang_blog_author',trim(mysql_real_escape_string($_POST['im_lang_blog_author'])));
	update_option('im_lang_blog_date',trim(mysql_real_escape_string($_POST['im_lang_blog_date'])));
	update_option('im_lang_blog_attchment',trim(mysql_real_escape_string($_POST['im_lang_blog_attchment'])));
	update_option('im_lang_blog_categories',trim(mysql_real_escape_string($_POST['im_lang_blog_categories'])));
	update_option('im_lang_blog_tags',trim(mysql_real_escape_string($_POST['im_lang_blog_tags'])));
	
	update_option('im_lang_blog_post_comments',trim(mysql_real_escape_string($_POST['im_lang_blog_post_comments'])));
	update_option('im_lang_blog_post_comment_write',trim(mysql_real_escape_string($_POST['im_lang_blog_post_comment_write'])));
	update_option('im_lang_blog_message',trim(mysql_real_escape_string($_POST['im_lang_blog_message'])));
	update_option('im_lang_blog_send',trim(mysql_real_escape_string($_POST['im_lang_blog_send'])));
	
?>
	<script language="javascript" type="text/javascript">window.top.window.$.stopUpload('1');</script>  
<?php	
} # / else if post image 
else
{
?>
<?php include_once('../func.php'); ?>
    

<script language="javascript" type="text/javascript">
$.startUpload = function(){
	$("#form_image_return").html('<?php echo $loadingBar; ?>' + 'eynnn'); 
}


$.stopUpload = function (success){
	if (success == 1)
	{
		$("#form_image_return").html(''); 	
	}
	else
	{
	  	$("#form_image_return").html(''); 
	}
}
</script>            


 <!-- #Bigtitle -->
<div class="bigtitle">
    <h1><?php lang('General Language Settings'); ?></h1>
</div>
        
<form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">


    <div class="stage">
        <h1 class="mini-title"><?php lang('Homepage : Slide : Read More'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_slide_read_more" id="im_lang_slide_read_more" value="<?php echo get_option('im_lang_slide_read_more', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : More'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_more" id="im_lang_blog_more" value="<?php echo get_option('im_lang_blog_more', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Author'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_author" id="im_lang_blog_author" value="<?php echo get_option('im_lang_blog_author', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Date'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_date" id="im_lang_blog_date" value="<?php echo get_option('im_lang_blog_date', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Attachment'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_attchment" id="im_lang_blog_attchment" value="<?php echo get_option('im_lang_blog_attchment', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Categories'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_categories" id="im_lang_blog_categories" value="<?php echo get_option('im_lang_blog_categories', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Tags'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_tags" id="im_lang_blog_tags" value="<?php echo get_option('im_lang_blog_tags', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Comments'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_post_comments" id="im_lang_blog_post_comments" value="<?php echo get_option('im_lang_blog_post_comments', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Comment Write'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_post_comment_write" id="im_lang_blog_post_comment_write" value="<?php echo get_option('im_lang_blog_post_comment_write', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Message'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_message" id="im_lang_blog_message" value="<?php echo get_option('im_lang_blog_message', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Comment Write'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_blog_send" id="im_lang_blog_send" value="<?php echo get_option('im_lang_blog_send', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
        <iframe id="upload_target_<?php echo $q_slider_id; ?>" name="upload_target_<?php echo $q_slider_id; ?>" src="<?php bloginfo('template_url'); ?>/admin/pages" style="width:0;height:0;border:0px solid #fff;"></iframe>
    </div>
    

    <input type="hidden" name="update" />	
    <input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $q_slider_id; ?>" />
</form>

<div id="form_image_return"></div>

<div class="stage-alt">
<button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $q_slider_id; ?>').click(); $.startUpload()" class="btn_pink">Save</button>
</div>
          


   <?php include_once('../func2.php'); ?>
    
<?php } ?>     


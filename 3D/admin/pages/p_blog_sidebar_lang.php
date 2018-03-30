<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	update_option('im_sidebar_lang_blog_categories',trim(mysql_real_escape_string($_POST['im_sidebar_lang_blog_categories'])));
	update_option('im_sidebar_lang_blog_populer_tags',trim(mysql_real_escape_string($_POST['im_sidebar_lang_blog_populer_tags'])));
	update_option('im_sidebar_lang_blog_archive',trim(mysql_real_escape_string($_POST['im_sidebar_lang_blog_archive'])));
	update_option('im_sidebar_lang_blog_last_comment',trim(mysql_real_escape_string($_POST['im_sidebar_lang_blog_last_comment'])));
	
	update_option('im_sidebar_lang_single_post_detail',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail'])));
	update_option('im_sidebar_lang_single_post_tags',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_tags'])));
	update_option('im_sidebar_lang_single_related_post',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_related_post'])));
	
	update_option('im_sidebar_lang_single_post_detail_author',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_author'])));
	update_option('im_sidebar_lang_single_post_detail_date',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_date'])));
	update_option('im_sidebar_lang_single_post_detail_categories',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_categories'])));
	update_option('im_sidebar_lang_single_post_detail_total',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_total'])));
	update_option('im_sidebar_lang_single_post_detail_total',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_comments'])));
	update_option('im_sidebar_lang_single_post_detail_view_post_image',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_view_post_image'])));
	update_option('im_sidebar_lang_single_post_detail_watch_post_video',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_watch_post_video'])));
	update_option('im_sidebar_lang_single_post_detail_look_post_iframe',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_post_detail_look_post_iframe'])));
	
	
	update_option('im_sidebar_lang_single_adress_detail',trim(mysql_real_escape_string($_POST['im_sidebar_lang_single_adress_detail'])));
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
    <h1><?php lang('Sidebar Language Settings'); ?></h1>
</div>
        
<form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">

    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Blog Categories'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_blog_categories" id="im_sidebar_lang_blog_categories" value="<?php echo get_option('im_sidebar_lang_blog_categories', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Populer Tags'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_blog_populer_tags" id="im_sidebar_lang_blog_populer_tags" value="<?php echo get_option('im_sidebar_lang_blog_populer_tags', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Blog Archive'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_blog_archive" id="im_sidebar_lang_blog_archive" value="<?php echo get_option('im_sidebar_lang_blog_archive', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Blog : Last Comment'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_blog_last_comment" id="im_sidebar_lang_blog_last_comment" value="<?php echo get_option('im_sidebar_lang_blog_last_comment', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail" id="im_sidebar_lang_single_post_detail" value="<?php echo get_option('im_sidebar_lang_single_post_detail', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Tags'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_tags" id="im_sidebar_lang_single_post_tags" value="<?php echo get_option('im_sidebar_lang_single_post_tags', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>

	<div class="stage">
        <h1 class="mini-title"><?php lang('Single : Related Post'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_related_post" id="im_sidebar_lang_single_related_post" value="<?php echo get_option('im_sidebar_lang_single_related_post', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Author'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_author" id="im_sidebar_lang_single_post_detail_author" value="<?php echo get_option('im_sidebar_lang_single_post_detail_author', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Date'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_date" id="im_sidebar_lang_single_post_detail_date" value="<?php echo get_option('im_sidebar_lang_single_post_detail_date', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Categories'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_categories" id="im_sidebar_lang_single_post_detail_categories" value="<?php echo get_option('im_sidebar_lang_single_post_detail_categories', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Total'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_total" id="im_sidebar_lang_single_post_detail_total" value="<?php echo get_option('im_sidebar_lang_single_post_detail_total', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Comments'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_total" id="im_sidebar_lang_single_post_detail_total" value="<?php echo get_option('im_sidebar_lang_single_post_detail_comments', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : View Post Image'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_view_post_image" id="im_sidebar_lang_single_post_detail_view_post_image" value="<?php echo get_option('im_sidebar_lang_single_post_detail_view_post_image', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : Watch Post Video'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_watch_post_video" id="im_sidebar_lang_single_post_detail_watch_post_video" value="<?php echo get_option('im_sidebar_lang_single_post_detail_watch_post_video', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Single : Post Detail : look Post Iframe'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_post_detail_look_post_iframe" id="im_sidebar_lang_single_post_detail_look_post_iframe" value="<?php echo get_option('im_sidebar_lang_single_post_detail_look_post_iframe', true); ?>" />
    	</div>
  	  	<div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Contact : Adress Detail'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_sidebar_lang_single_adress_detail" id="im_sidebar_lang_single_adress_detail" value="<?php echo get_option('im_sidebar_lang_single_adress_detail', true); ?>" />
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


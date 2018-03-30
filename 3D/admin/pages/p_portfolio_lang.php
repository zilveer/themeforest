<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	update_option('im_lang_portfolio_all',trim(mysql_real_escape_string($_POST['im_lang_portfolio_all'])));
	
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
    <h1><?php lang('Portfolio Language Settings'); ?></h1>
</div>
        
<form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">

    <div class="stage">
        <h1 class="mini-title"><?php lang('Portfolio : All'); ?>:</h1>
        <div class="form-elements">
        	<input type="text" class="form-input" name="im_lang_portfolio_all" id="im_lang_portfolio_all" value="<?php echo get_option('im_lang_portfolio_all', true); ?>" />
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


<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	$im_theme_google_analytics = trim(mysql_real_escape_string($_POST['im_theme_google_analytics']));
	update_option('im_theme_google_analytics',$im_theme_google_analytics);
	
?>
	<script language="javascript" type="text/javascript">window.top.window.$.im_stop('1');</script>  
<?php	
} # / else if post image 
else
{
?>
<?php include_once('../func.php'); ?>
    

<script language="javascript" type="text/javascript">
$.im_start = function(){
	$("#form_image_return").html('<?php echo $loadingBar; ?>'); 
}


$.im_stop = function (success){
	if (success == 1)
	{
		$("#form_image_return").html(''); 
		$.reloadPage();	
	}
	else
	{
	  	$("#form_image_return").html(''); 
	}
}
</script>            


 <!-- #Bigtitle -->
<div class="bigtitle">
    <h1><?php lang('Google Analytics Code'); ?></h1>
</div>
        
<form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">

<!-- #Text Area -->
<div class="stage">
    <h1 class="mini-title"><?php lang('Enter The Google Analytics Code'); ?>:</h1>
    <div class="form-elements">
        <textarea name="im_theme_google_analytics" class="form-input" required><?php echo str_replace('\\"','',stripcslashes(get_option('im_theme_google_analytics',true))); ?></textarea>
    </div>
    <div class="clear"></div>
     
    <iframe id="upload_target_<?php echo $q_slider_id; ?>" name="upload_target_<?php echo $q_slider_id; ?>" src="<?php bloginfo('template_url'); ?>/admin/pages" style="width:0;height:0;border:0px solid #fff;"></iframe>
	<div id="form_image_return"></div>
</div>

    <input type="hidden" name="update" />	
    <input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $q_slider_id; ?>" />
</form>
            
            <div class="stage-alt">
            
            <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $q_slider_id; ?>').click(); $.im_start()" class="btn_pink">Update</button>
            </div>
    

   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


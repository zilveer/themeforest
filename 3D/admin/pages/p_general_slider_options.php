<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	$pg_slider_style = trim(mysql_real_escape_string($_POST['sbox_slider_style']));
	
	update_option('iam_theme_3D_slider_style',$pg_slider_style);
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
	$("#form_image_return").html('<?php echo $loadingBar; ?>'); 
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
                <h1><?php lang('Slider Options'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="<?php bloginfo('template_url'); ?>/admin/pages/p_general_slider_options.php" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
           
            <div class="stage">
            	<h1 class="mini-title"><?php lang('Select Style'); ?>:</h1>
                <div class="form-elements">
                    <div class="select-wrapper">
                        <select name="sbox_slider_style" id="sbox_slider_style">
                            <option value="1" <?php if(get_option('iam_theme_3D_slider_style', true) == 1){ echo 'selected="selected"';} ?>> Style 1</option>
                            <option value="2" <?php if(get_option('iam_theme_3D_slider_style', true) == 2){ echo 'selected="selected"';} ?>> Style 2</option>
                            <option value="3" <?php if(get_option('iam_theme_3D_slider_style', true) == 3){ echo 'selected="selected"';} ?>> Style 3</option>
                            <option value="4" <?php if(get_option('iam_theme_3D_slider_style', true) == 4){ echo 'selected="selected"';} ?>> Style 4</option>
                        </select>
                    </div> <!-- /.select-wrapper -->
                </div> <!-- /.form-elements -->
                <div class="clear"></div>
                <iframe id="upload_target_<?php echo $q_slider_id; ?>" name="upload_target_<?php echo $q_slider_id; ?>" src="<?php bloginfo('template_url'); ?>/admin/pages" style="width:0;height:0;border:0px solid #fff;"></iframe>
            </div> <!-- /.stage --> 
            
            	<input type="hidden" name="update" />	
            	<input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $q_slider_id; ?>" />
            </form>
            
            <div id="form_image_return"></div>
            
            <div class="stage-alt">
            <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $q_slider_id; ?>').click(); $.startUpload()" class="btn_pink">Save</button>
            </div>
          


   <?php include_once('../func2.php'); ?>
    
<?php } ?>     


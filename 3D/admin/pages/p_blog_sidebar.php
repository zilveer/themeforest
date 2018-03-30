<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	$pp_category_sidebar_lr = trim(mysql_real_escape_string($_POST['sbox_sidebar_category_lr']));
	$pp_sidebar_page_lr = trim(mysql_real_escape_string($_POST['sbox_sidebar_page_lr']));
	
	update_option('im_theme_sidebar_category_lr',$pp_category_sidebar_lr);
	update_option('im_theme_sidebar_page_lr', $pp_sidebar_page_lr);
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
                <h1><?php lang('Blog Page & Page Sidebar Options'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
           
            <div class="stage">
            	<h1 class="mini-title"><?php lang('Sidebar Category Left/Right'); ?>:</h1>
                <div class="form-elements">
                    <div class="select-wrapper">
                        <select name="sbox_sidebar_category_lr" id="sbox_sidebar_category_lr">
                            <option value="LEFT" <?php if(get_option('im_theme_sidebar_category_lr', true) == 'LEFT'){ echo 'selected="selected"';} ?>>Left</option>
                            <option value="RIGHT" <?php if(get_option('im_theme_sidebar_category_lr', true) == 'RIGHT'){ echo 'selected="selected"';} ?>>Right</option>
                        </select>
                    </div> <!-- /.select-wrapper -->
                </div> <!-- /.form-elements -->
                <div class="clear"></div>
            </div> <!-- /.stage --> 
            
            <div class="stage">
                <h1 class="mini-title"><?php lang('Sidebar Page Left/Right'); ?>:</h1>
                <div class="form-elements">
                    <div class="select-wrapper">
                        <select name="sbox_sidebar_page_lr" id="sbox_sidebar_page_lr">
                            <option value="LEFT" <?php if(get_option('im_theme_sidebar_page_lr', true) == 'LEFT'){ echo 'selected="selected"';} ?>>Left</option>
                            <option value="RIGHT" <?php if(get_option('im_theme_sidebar_page_lr', true) == 'RIGHT'){ echo 'selected="selected"';} ?>>Right</option>
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


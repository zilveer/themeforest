<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	if(isset($_POST['im_theme_show_tab_menu'])){ update_option('im_theme_show_tab_menu','true'); } else { update_option('im_theme_show_tab_menu','false'); }
	if(isset($_POST['im_theme_show_3_column'])){ update_option('im_theme_show_3_column','true'); } else { update_option('im_theme_show_3_column','false'); }
	
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
                <h1><?php lang('Home Page Module On / Off'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
			
            <div class="stage">
                <span class="title-icon"><?php lang('Tab Menu') ;?>:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_show_tab_menu" name="im_theme_show_tab_menu" <?php if(get_option('im_theme_show_tab_menu', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
             <div class="stage">
                <span class="title-icon"><?php lang('3 Colomn Area') ;?>:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_show_3_column" name="im_theme_show_3_column" <?php if(get_option('im_theme_show_3_column', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
                <iframe id="upload_target_<?php echo $q_slider_id; ?>" name="upload_target_<?php echo $q_slider_id; ?>" src="<?php bloginfo('template_url'); ?>/admin/pages" style="width:0;height:0;border:0px solid #fff;"></iframe>
            </div>

            	<input type="hidden" name="update" />	
            	<input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $q_slider_id; ?>" />
            </form>
            
            <div id="form_image_return"></div>
            
            <div class="stage-alt">
            <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $q_slider_id; ?>').click(); $.im_start()" class="btn_pink">Update</button>
            </div>
    

   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


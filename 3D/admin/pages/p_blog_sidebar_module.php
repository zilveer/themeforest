<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	if(isset($_POST['im_theme_sidebar_cat'])){ update_option('im_theme_sidebar_cat','true'); } else { update_option('im_theme_sidebar_cat','false'); }
	if(isset($_POST['im_theme_sidebar_tag'])){ update_option('im_theme_sidebar_tag','true'); } else { update_option('im_theme_sidebar_tag','false'); }
	if(isset($_POST['im_theme_blog_archive'])){ update_option('im_theme_blog_archive','true'); } else { update_option('im_theme_blog_archive','false'); }
	if(isset($_POST['im_theme_last_comment'])){ update_option('im_theme_last_comment','true'); } else { update_option('im_theme_last_comment','false'); }
	if(isset($_POST['im_theme_single_detail'])){ update_option('im_theme_single_detail','true'); } else { update_option('im_theme_single_detail','false'); }
	if(isset($_POST['im_theme_single_tag'])){ update_option('im_theme_single_tag','true'); } else { update_option('im_theme_single_tag','false'); }
	if(isset($_POST['im_theme_single_related'])){ update_option('im_theme_single_related','true'); } else { update_option('im_theme_single_related','false'); }
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
                <h1><?php lang('Sidebar Modeule On / Off'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
			
            
            <!-- sidebar category -->
            <div class="stage">
                <span class="title-icon">Theme Category:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_sidebar_cat" name="im_theme_sidebar_cat" <?php if(get_option('im_theme_sidebar_cat', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- sidebar tag -->
            <div class="stage">
                <span class="title-icon">Theme Tag:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_sidebar_tag" name="im_theme_sidebar_tag" <?php if(get_option('im_theme_sidebar_tag', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- sidebar blog archive -->
            <div class="stage">
                <span class="title-icon">Theme Blog Arcihve:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_blog_archive" name="im_theme_blog_archive" <?php if(get_option('im_theme_blog_archive', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- sidebar last comments -->
            <div class="stage">
                <span class="title-icon">Theme Last Comments:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_last_comment" name="im_theme_last_comment" <?php if(get_option('im_theme_last_comment', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            
            <!-- sidebar post detail -->
            <div class="stage">
                <span class="title-icon">Sinle Post Detail:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_single_detail" name="im_theme_single_detail" <?php if(get_option('im_theme_single_detail', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- sidebar sinle post tags -->
            <div class="stage">
                <span class="title-icon">Sinle Post Tags:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_single_tag" name="im_theme_single_tag" <?php if(get_option('im_theme_single_tag', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- sidebar sinle related post -->
            <div class="stage">
                <span class="title-icon">Sinle Post Related:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_theme_single_related" name="im_theme_single_related" <?php if(get_option('im_theme_single_related', true) == 'true'){echo 'checked="checked"'; } ?> />
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


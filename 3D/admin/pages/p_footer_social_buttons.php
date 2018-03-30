<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	if(isset($_POST['im_footer_sb_facebook'])){ update_option('im_footer_sb_facebook','true'); } else { update_option('im_footer_sb_facebook','false'); }
	if(isset($_POST['im_footer_sb_twitter'])){ update_option('im_footer_sb_twitter','true'); } else { update_option('im_footer_sb_twitter','false'); }
	if(isset($_POST['im_footer_sb_google'])){ update_option('im_footer_sb_google','true'); } else { update_option('im_footer_sb_google','false'); }
	if(isset($_POST['im_footer_sb_yahoo'])){ update_option('im_footer_sb_yahoo','true'); } else { update_option('im_footer_sb_yahoo','false'); }
	if(isset($_POST['im_footer_sb_de'])){ update_option('im_footer_sb_de','true'); } else { update_option('im_footer_sb_de','false'); }
	if(isset($_POST['im_footer_sb_in'])){ update_option('im_footer_sb_in','true'); } else { update_option('im_footer_sb_in','false'); }
	if(isset($_POST['im_footer_sb_sb'])){ update_option('im_footer_sb_sb','true'); } else { update_option('im_footer_sb_sb','false'); }
	if(isset($_POST['im_footer_sb_te'])){ update_option('im_footer_sb_te','true'); } else { update_option('im_footer_sb_te','false'); }
	if(isset($_POST['im_footer_sb_rss'])){ update_option('im_footer_sb_rss','true'); } else { update_option('im_footer_sb_rss','false'); }
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
                <h1><?php lang('Footer Social Buttons'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
			
            <!-- facebook -->
            <div class="stage">
                <span class="title-icon">Facebook:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_facebook" name="im_footer_sb_facebook" <?php if(get_option('im_footer_sb_facebook', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- twitter -->
            <div class="stage">
                <span class="title-icon">Twitter:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_twitter" name="im_footer_sb_twitter" <?php if(get_option('im_footer_sb_twitter', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- google -->
            <div class="stage">
                <span class="title-icon">Google:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_google" name="im_footer_sb_google" <?php if(get_option('im_footer_sb_google', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- yahoo -->
            <div class="stage">
                <span class="title-icon">Yahoo:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_yahoo" name="im_footer_sb_yahoo" <?php if(get_option('im_footer_sb_yahoo', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- delicious -->
            <div class="stage">
                <span class="title-icon">Delicious:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_de" name="im_footer_sb_de" <?php if(get_option('im_footer_sb_de', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- in -->
            <div class="stage">
                <span class="title-icon">İn:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_in" name="im_footer_sb_in" <?php if(get_option('im_footer_sb_in', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- stumbleupon -->
            <div class="stage">
                <span class="title-icon">Stumbleupon:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_sb" name="im_footer_sb_sb" <?php if(get_option('im_footer_sb_sb', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- technoratti -->
            <div class="stage">
                <span class="title-icon">Technoratti:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_te" name="im_footer_sb_te" <?php if(get_option('im_footer_sb_te', true) == 'true'){echo 'checked="checked"'; } ?> />
                        <span id="slider">
                            <span id="sliderOn">ON</span>
                            <span id="sliderOff">OFF</span>
                            <span id="sliderBlock"></span>
                        </span>
                    </label>
                    </span>
                <div class="clear"></div>
            </div>
            
            <!-- rss -->
            <div class="stage">
                <span class="title-icon">Rss:</span>                  
                    <span class="icononoff">
                    <label id="sliderLabel">
                        <input type="checkbox" id="im_footer_sb_rss" name="im_footer_sb_rss" <?php if(get_option('im_footer_sb_rss', true) == 'true'){echo 'checked="checked"'; } ?> />
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


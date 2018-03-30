<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	update_option('im_theme_contact_name',trim(mysql_real_escape_string($_POST['im_theme_contact_name'])));
	update_option('im_theme_contact_telephone',trim(mysql_real_escape_string($_POST['im_theme_contact_telephone'])));
	update_option('im_theme_contact_fax',trim(mysql_real_escape_string($_POST['im_theme_contact_fax'])));
	update_option('im_theme_contact_email',trim(mysql_real_escape_string($_POST['im_theme_contact_email'])));
	update_option('im_theme_contact_web',trim(mysql_real_escape_string($_POST['im_theme_contact_web'])));
	update_option('im_theme_contact_maps_iframe_code',trim(mysql_real_escape_string($_POST['im_theme_contact_maps_iframe_code'])));
	
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
                <h1><?php lang('Contact Form Settins'); ?></h1>
            </div>
        
            <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $q_slider_id; ?>">
			
               
               <div class="stage">
                    <h1 class="mini-title"><?php lang('Name'); ?>:</h1>
                    <div class="form-elements">
                        <input type="text" class="form-input" name="im_theme_contact_name" value="<?php echo get_option('im_theme_contact_name',true); ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="stage">
                    <h1 class="mini-title"><?php lang('Telephone'); ?>:</h1>
                    <div class="form-elements">
                        <input type="text" class="form-input" name="im_theme_contact_telephone" value="<?php echo get_option('im_theme_contact_telephone',true); ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="stage">
                    <h1 class="mini-title"><?php lang('Fax'); ?>:</h1>
                    <div class="form-elements">
                        <input type="text" class="form-input" name="im_theme_contact_fax" value="<?php echo get_option('im_theme_contact_fax',true); ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="stage">
                    <h1 class="mini-title"><?php lang('E-Mail'); ?>:</h1>
                    <div class="form-elements">
                        <input type="text" class="form-input" name="im_theme_contact_email" value="<?php echo get_option('im_theme_contact_email',true); ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                
                <div class="stage">
                    <h1 class="mini-title"><?php lang('Web'); ?>:</h1>
                    <div class="form-elements">
                        <input type="text" class="form-input" name="im_theme_contact_web" value="<?php echo get_option('im_theme_contact_web',true); ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
               
                <div class="stage">
                    <h1 class="mini-title"><?php lang('Google Maps Iframe Code'); ?>:</h1>
                    <div class="form-elements">
                        <textarea name="im_theme_contact_maps_iframe_code" class="form-input" required><?php echo str_replace('\\"','"',stripcslashes(get_option('im_theme_contact_maps_iframe_code',true))); ?></textarea>
                    </div>
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


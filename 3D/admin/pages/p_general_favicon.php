<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	$upload = new upload($_FILES['image1']);
	if ($upload->uploaded)
	{
		$upload->file_auto_rename = true;
		$upload->image_resize = false;
		$upload->image_ratio_crop      = false;
		$upload->process($three_folder.'/wp-content/uploads/iamthemes/');
	
		if($upload->processed)
		{
			if(strstr(get_iam($pg_slider_id,'','1'),'/wp-content/uploads/iamthemes/')){unlink($three_folder.str_replace(get_bloginfo('url'), '', get_iam($pg_slider_id,'','1')));}
			$image1 = get_bloginfo('url').'/wp-content/uploads/iamthemes/'.$upload->file_dst_name;
			update_option('im_theme_favicon',$image1);
			$uploaded = 1;
		}
		else { echo  $upload->error; $uploaded = 0;}
	}
	else { $uploaded = 0;}
	
?>
	<script language="javascript" type="text/javascript">window.top.window.$.im_stop('1');</script>  
<?php	
} # / else if post image
else if(isset($_GET['image']))
{
	echo '<img src="'.get_option('im_theme_favicon').'">';
}
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
		$("#div_image_1").load("http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>?image");	
	}
	else
	{
	  	$("#form_image_return").html(''); 
	}
}
</script>            


<!-- #Bigtitle -->
<div class="bigtitle">
    <h1>Favicon Options</h1>
</div>
    
				<div class="stage">
                <form name="form_1" id="form_1" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data" target="upload_target_1">
			
          <!-- #Picture -->
                    <div class="logo-preview">
                    	<div id="div_image_1">
                       		<img src="<?php echo get_option('im_theme_favicon'); ?>" alt="">
                        </div>
                        <!-- #Form Input -->
                        <span class="logo-text-two">
                            
                            <div class="uploader red">
                                <div id="div_form_image">
                                    <input type="text" name="image1_text" id="image1_text" class="filename" readonly="readonly" value=""/>
                                    <input type="button" name="file" class="buttonupload" value="File"/>
                                    <input type="file" name="image1" id="image1" size="30"/>
                                </div>
                            </div>
						</span>
					</div>
                    <div class="clear"></div>
            
            	<input type="hidden" name="update" />	
            	<input type="submit" value="Submit" style="display:none;" id="submit_buttons_1" />
            </form>
      
      
            <iframe id="upload_target_1" name="upload_target_1" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
            <br />
            <div id="form_image_return"></div>
            </div>
            
            <div class="stage-alt">
            <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_1').click(); $.im_start()" class="btn_pink">Update</button>
            </div>
    

   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


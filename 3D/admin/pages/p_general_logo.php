<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_GET['logo'])) # get logo
{
	echo '<img id="image_logo_src" src="'.get_option('iam_theme_3D_logo', true).'" />';
	
} # /get logo
else if(isset($_GET['delete_image'])) # get delete image
{
	if(get_option('iam_theme_3D_logo'))
	{
		unlink($three_folder.str_replace(get_bloginfo('url'), '', get_option('iam_theme_3D_logo', true)));
		delete_option('iam_theme_3D_logo');
	}	
} # /get delete image
else if(isset($_POST['imageUpload'])) # else if post image
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
			unlink($three_folder.str_replace(get_bloginfo('url'), '', get_option('iam_theme_3D_logo', true)));
			$image1 = get_bloginfo('url').'/wp-content/uploads/iamthemes/'.$upload->file_dst_name;
			update_option('iam_theme_3D_logo',$image1);
			$uploaded = 1;
			
		}
		else { echo  $upload->error; $uploaded = 0;}
	}
	else { $uploaded = 0;}
?>
	<script language="javascript" type="text/javascript">window.top.window.stopUpload('<?php echo $uploaded; ?>');</script>  
<?php	
} # / else if post image 
else
{
?>
<?php include_once('../func.php'); ?>


<script language="javascript" type="text/javascript">
$(document).ready(function () {
	if($("#image1_text").val() == '')
	{
		$.startUpload();
	}
});


$.startUpload = function(){
	$("#form_image_return").html('<?php echo $loadingBar; ?>'); 
	// $("#div_form_image").hide();
}

$("#form_image_button").click( function () {
	$.startUpload();
});


$.delete_image = function(){
	$("#div_image_logo").load("<?php bloginfo('template_url'); ?>/admin/pages/p_general_logo.php?delete_image");	
}

function stopUpload(success){

      if (success == 1)
	  {
			$("#form_image_return").html(''); 
			$("#div_form_image").show("crop");
			$("#div_image_logo").load("<?php bloginfo('template_url'); ?>/admin/pages/p_general_logo.php?logo");	
      }
	  else
	  {
		  $("#form_image_return").html(''); 
	  }
}
</script>    



<!-- #Bigtitle -->
<div class="bigtitle">
    <h1>Logo Options</h1>
</div>



<!-- #Logo Upload -->
<form name="form_image" id="form_image" action="<?php bloginfo('template_url'); ?>/admin/pages/p_general_logo.php" method="POST" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();">
<div class="stage">
    <h1 class="mini-title">Logo Upload:</h1>
    <div class="uploader red">
    	<div id="div_form_image">
            <input type="hidden" name="imageUpload" />	
            <input type="text" name="image1_text" id="image1_text" class="filename" readonly="readonly" value=""/>
            <input type="button" name="file" class="buttonupload" value="File"/>
            <input type="file" name="image1" id="image1" size="30"/>
        </div>
        <input type="submit" value="Gonder" style="display:none;" id="submit_buttons" />
    </div>
    <div id="form_image_return"></div>
    <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
</div>
</form> 

<!-- #Logo Preview -->
<div class="stage">
    <h1 class="mini-title">Logo Preview:</h1>
    <a href="#" class="delete-button"><img src="<?php echo bloginfo('template_url'); ?>/admin/img/delete.png" onclick="$.delete_image()" alt=""></a>
    <div class="logo-preview">
    	<div id="div_image_logo">
        	<?php if(get_option('iam_theme_3D_logo')){ ?><img id="image_logo_src" src="<?php echo get_option('iam_theme_3D_logo', true); ?>" /><?php } ?>
        </div>
        <span class="logo-text">
            <p>If your logo appears here after installation, save it if you approve or remove it if you do not approve.</p>
        </span>
    </div>
    <div class="clear"></div>
</div>

<!-- #Save Button -->

<div class="stage-alt">
    <a href="#" id="form_image_button" onClick="document.getElementById('submit_buttons').click();" class="btn_pink">Save</a>
</div>
            
            
<?php include_once('../func2.php'); ?>
 
<?php } ?>


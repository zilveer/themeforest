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
    <h1>Support Videos</h1>
</div>
    
				<div class="stage">
                    <h1 class="mini-title">Step 1 - Install Theme</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/RcDAJ5ESyvg" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 2 - Slider Options</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/jy4-mdgorqI" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 3 - Tab Slider</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/yG5YNmBt6Dw" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 4 - Sidebar Options</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/e7UifMsAd9A" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 5 - Portfolio Setting</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/4CPZvzqZaGw" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 6 - Company Logo Setting</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/Q1_T_hZ0fN8" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
                
                <div class="stage">
                    <h1 class="mini-title">Step 7 - Shortcodes & Buttons</h1>
                    <iframe width="560" height="480" src="http://www.youtube.com/embed/QXz0hnXPTw4" frameborder="0" allowfullscreen></iframe>
                    <div class="clear"></div>
            	</div>
    

   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


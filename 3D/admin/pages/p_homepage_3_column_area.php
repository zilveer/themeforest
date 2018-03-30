<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_GET['logo'])) # get logo
{
	$qp_im_ID = trim(mysql_real_escape_string($_GET['im_ID']));
	echo '<img id="image_logo_src" src="'.get_iam($qp_im_ID,'','1').'" />';
} # /get logo
else if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	$pp_ID = trim(mysql_real_escape_string($_POST['im_ID']));
	$pp_value2 = trim(mysql_real_escape_string($_POST['text_title']));
	$pp_value3 = trim(mysql_real_escape_string($_POST['text_button_title']));
	$pp_value4 = trim(mysql_real_escape_string($_POST['text_button_url']));
	$pp_value5 = trim(mysql_real_escape_string($_POST['text_description']));
	
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
			update_iam('','hompage_3_column_area',$image1,$pp_value2,$pp_value3,$pp_value4,$pp_value5,$pp_tab_category_id,'','',$pp_ID);
			$uploaded = 1;
			
		}
		else { echo  $upload->error; $uploaded = 0;}
	}
	else if($pp_value2 != '' or $pp_value3 != '' or $pp_value4 != '' or $pp_value5 != '')
	{
		update_iam('','hompage_3_column_area',get_iam($pp_ID,'','1'),$pp_value2,$pp_value3,$pp_value4,$pp_value5,$pp_tab_category_id,'','',$pp_ID);
		$uploaded = 1;
	}
	else { $uploaded = 0;}
?>
	<script language="javascript" type="text/javascript">window.top.window.$.stopUpload('<?php echo $uploaded; ?>', <?php echo $pp_ID; ?>);</script>  

<?php	
} # / else if post image 
else
{
?>
<?php include_once('../func.php'); ?>

<!-- #Bigtitle -->
<div class="bigtitle">
    <h1><?php lang('3 Colomn Area'); ?></h1>
</div>



<!-- #Slide View -->
<div class="stage">
    

<script language="javascript" type="text/javascript">
$.startUpload = function(im_ID){
	$("#form_image_return_" + im_ID).html('<?php echo $loadingBar; ?>'); 
}


$.stopUpload = function (success, im_ID){
	if (success == 1)
	{
		$("#form_image_return_" + im_ID).html(''); 
		$("#div_image_logo_" + im_ID).load("<?php bloginfo('template_url'); ?>/admin/pages/p_homepage_3_column_area.php?logo&im_ID=" + im_ID);	
	}
	else
	{
	  	$("#form_image_return_" + im_ID).html(''); 
	}
}
</script>            
<ul id="list">   
	<?php
    $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='hompage_3_column_area' ORDER BY ord ASC");
    while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
    {
        $im_ID = $list_homepage_slider['id'];
        $q_3_columun_image_url = $list_homepage_slider['value1'];
        $q_3_columun_title = $list_homepage_slider['value2'];
        $q_3_columun_button_title = $list_homepage_slider['value3'];
        $q_3_columun_url = $list_homepage_slider['value4'];
		$q_3_columun_description = $list_homepage_slider['value5'];
		$q_3_columun_no = $list_homepage_slider['value6'];
    ?>
        
    <li id="id_<?php echo $q_slider_id; ?>">
	<!-- Accordion Start -->
    <div class="mfx_accordion">
        
        <div class="section">
            <h2 class="trigger settings">
            	3 Column Area : <?php echo $q_3_columun_title; ?>
            </h2>
            
            <!-- #Content -->
            <div class="content"> 
                <div class="detail">
                <form name="form_<?php echo $im_ID; ?>" id="form_<?php echo $im_ID; ?>" action="<?php bloginfo('template_url'); ?>/admin/pages/p_homepage_3_column_area.php" method="POST" enctype="multipart/form-data" target="upload_target_<?php echo $im_ID; ?>">
                
                    <!-- #Picture -->
                    <div class="logo-preview">
                    	<div id="div_image_logo_<?php echo $im_ID; ?>">
                       		<img src="<?php echo $q_3_columun_image_url; ?>" alt="">
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
                            
                            <h1 class="mini-title-two">Title:</h1>
                            <input type="text" name="text_title" id="text_title" class="form-input" style="margin-bottom:24px;" value="<?php echo $q_3_columun_title; ?>"/>
                            <span class="clear"></span>
                                                                    
                            <h1 class="mini-title-two">Button Title:</h1>
                            <input type="text" name="text_button_title" id="text_button_title" class="form-input" style="margin-bottom:24px;" value="<?php echo $q_3_columun_button_title; ?>"/>
                            <span class="clear"></span>
                            
                            <h1 class="mini-title-two">Button Url:</h1>
                            <input type="text" name="text_button_url" id="text_button_url" class="form-input" style="margin-bottom:24px;" value="<?php echo $q_3_columun_url; ?>"/>
                            <span class="clear"></span>
                            
                            <h1 class="mini-title-two">Description 2:</h1>
                            <textarea name="text_description" id="text_description" class="form-input"><?php echo $q_3_columun_description; ?></textarea>
                            <span class="clear"></span>
 
                            
                        </span>
                        
                    </div> <!-- /.logo-preview -->
                    <div class="clear"></div> 
                    <input type="hidden" name="im_ID" value="<?php echo $im_ID; ?>" />	
                    <input type="hidden" name="update" />	
                    <input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $im_ID; ?>" />
                </form>
                <iframe id="upload_target_<?php echo $im_ID; ?>" name="upload_target_<?php echo $im_ID; ?>" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
				<div id="form_image_return_<?php echo $im_ID; ?>"></div>
<div class="stage">
    <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $im_ID; ?>').click(); $.startUpload(<?php echo $im_ID; ?>)" class="btn_pink">Save</button>
</div>
                </div> <!-- /.detail -->
            </div> <!-- /.content -->
            
        </div> <!-- /.section -->
        
	</div> <!-- /.mfx_accordion -->
    </li> <!-- /#id_ -->
        
        
         <?php
		}
		?>
        
        
</ul> <!-- /#list -->

    <div class="clear"></div>
</div> <!-- /.stage -->
  <div id="div_return"></div> 
   <?php include_once('../func2.php'); ?>
    
<?php } ?>     


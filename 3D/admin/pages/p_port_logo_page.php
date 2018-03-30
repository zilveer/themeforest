<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_GET['logo'])) # get logo
{
	$qp_slider_id = trim(mysql_real_escape_string($_GET['slider_id']));
	echo '<img id="image_logo_src" src="'.get_iam($qp_slider_id,'','1').'" />';
} # /get logo
else if(isset($_GET['order'])) # order
{
	$orderArray = $_POST['id']; // move array that comes with post into variable									
    $order = 2; // the head of record number in the sequence database
    foreach ($orderArray as $id) // move all ID that is in array to user ID thanks to foreach function								
    {
		// Update with UPDATE function in the database for every foreach loop
		$order = trim(strip_tags(mysql_real_escape_string($order)));
		$id = trim(strip_tags(mysql_real_escape_string($id)));
		
        mysql_query("UPDATE ".$prefix."iam SET ord = " . $order . " WHERE id = " . $id . "") or die('Error, insert query failed');
        $order++;	 // Increase the value of variable as [1] in every foreach loop. By this means, sequence is increased. 		
    }	
} # /order
else if(isset($_GET['delete'])) # delete
{
	$pg_slider_id = trim(mysql_real_escape_string($_GET['slider_id']));
	if(strstr(get_iam($pg_slider_id,'','1'),'/wp-content/uploads/iamthemes/')){unlink($three_folder.str_replace(get_bloginfo('url'), '', get_iam($pg_slider_id,'','1')));}
	mysql_query("DELETE FROM ".$prefix."iam WHERE id='$pg_slider_id'");
} # /delete
else if(isset($_POST['sliderUpload'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	include_once(TEMPLATEPATH."/admin/class.upload.php");  
	
	$pg_slider_id = trim(mysql_real_escape_string($_POST['sliderID']));
	$pp_description = str_replace('\n', '<br />', str_replace('\r', ' ', trim(mysql_real_escape_string($_POST['text_description']))));
	$pp_url = trim(mysql_real_escape_string($_POST['text_url']));
	$pp_ord = trim(mysql_real_escape_string($_POST['sliderORD']));
	
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
			update_iam('','logo_page',$image1,'',$pp_url,$pp_description,'','','',$pp_ord,$pg_slider_id);
			$uploaded = 1;
			
		}
		else { echo  $upload->error; $uploaded = 0;}
	}
	else if($pp_title != '' or $pp_url != '' or $pp_description != '')
	{
		update_iam('','logo_page',get_iam($pg_slider_id,'','1'), $pp_title,$pp_url,$pp_description,'','','',$pp_ord,$pg_slider_id);
		$uploaded = 1;
	}
	else { $uploaded = 0;}
?>
	<script language="javascript" type="text/javascript">window.top.window.$.stopUpload('<?php echo $uploaded; ?>', '<?php echo $pg_slider_id; ?>');</script>  

<?php	
} # / else if post image 
else if(isset($_POST['addNew'])) # else if new logo
{
	include_once('../func_wp_load.php'); 
	add_iam('','logo_page',get_bloginfo('template_url').'/img/sponsors/1.png','','','ccccccorem Ipsum is simply dummy text of the printing and typesetting industry.','','','1');
	$uploaded = 1;
?>
	<script language="javascript" type="text/javascript">window.top.window.$.stopNew('<?php echo $uploaded; ?>');</script>  
<?php	
} # / else if new logo
else if(isset($_GET['ul']))
{
?>
<script src="<?php bloginfo('template_url'); ?>/admin/js/general.js"></script>
	<?php
    $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='logo_page' ORDER BY ord ASC");
    while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
    {
        $q_slider_id = $list_homepage_slider['id'];
        $q_slider_image_url = $list_homepage_slider['value1'];
		$q_slider_url = $list_homepage_slider['value3'];
        $q_slider_description = stripslashes($list_homepage_slider['value4']);
		$q_slider_ord = $list_homepage_slider['ord'];
    ?>
        
	<li id="id_<?php echo $q_slider_id; ?>" class="accordion-li">
	<!-- Accordion Start -->
    <div class="mfx_accordion">
        
        <div class="section">
            <h2 class="trigger settings">
            	<a href="#" class="icon"><img src="<?php bloginfo('template_url'); ?>/admin/img/move.png" alt=""></a> 
            	<span class="icon-title">Logo : <?php echo mb_substr(strip_tags($q_slider_description),0,20,'UTF-8'); ?> ...</span>
            </h2>
            
            <!-- #Content -->
            <div class="content"> 
                <div class="detail">
                <form name="form_<?php echo $q_slider_id; ?>" id="form_<?php echo $q_slider_id; ?>" action="<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php" method="POST" enctype="multipart/form-data" target="upload_target">
                    <a href="#" class="delete-button" onclick="$.deleteLogo('<?php echo $q_slider_id; ?>')">
                    	<img src="<?php bloginfo('template_url'); ?>/admin/img/delete.png" alt="">
                    </a>
                    <!-- #Picture -->
                    <div class="logo-preview">
                    	<div id="div_image_logo_<?php echo $q_slider_id; ?>">
                       		<img src="<?php echo $q_slider_image_url; ?>" alt="">
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
                            
                            
                            <h1 class="mini-title-two"><?php lang('Descrioption'); ?>:</h1>
                            <textarea name="text_description" class="form-input"><?php echo $q_slider_description; ?></textarea>
                            <span class="clear"></span>
                            
                            <h1 class="mini-title-two"><?php lang('Url'); ?>:</h1>
                            <input type="text" class="form-input" name="text_url" value="<?php echo $q_slider_url; ?>" />
                            <span class="clear"></span>
                            
                            <div class="stage-two">
    <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_<?php echo $q_slider_id; ?>').click(); $.startUpload(<?php echo $q_slider_id; ?>)" class="btn_pink">Save</button>
</div>
                            
                        </span>
                        
                    </div> <!-- /.logo-preview -->
                    <div class="clear"></div> 
                    <input type="hidden" name="sliderID" value="<?php echo $q_slider_id; ?>" />	
                    <input type="hidden" name="sliderORD" value="<?php echo $q_slider_ord; ?>" />
                    <input type="hidden" name="sliderUpload" />	
                    <input type="submit" value="Submit" style="display:none;" id="submit_buttons_<?php echo $q_slider_id; ?>" />
                </form>
               
				<div id="form_image_return_<?php echo $q_slider_id; ?>"></div>

                </div> <!-- /.detail -->
            </div> <!-- /.content -->
            
        </div> <!-- /.section -->
        
	</div> <!-- /.mfx_accordion -->
    </li> <!-- /#id_ -->
	 <?php
    }
    ?>

<?php	
}
else
{
?>
<?php include_once('../func.php'); ?>

<!-- #Bigtitle -->
<div class="bigtitle">
    <h1>Company Logo Setting</h1>
</div>




<form name="form_new" id="form_new" action="<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php" method="POST" target="upload_target">      
    <input type="submit" value="Submit" style="display:none;" id="submit_buttons_new" />
    <input type="hidden" name="addNew" value="addNew" />
</form>

<div id="form_image_return_new"></div>

<button id="form_image_button" onClick="document.getElementById('submit_buttons_new').click(); $.startNew()" class="btn_pink"><?php lang('Add'); ?></button>

<!-- #Slide View -->
<div class="stage">
 
    

<script language="javascript" type="text/javascript">


$.startNew = function(){
	$("#form_image_return_new").html('<?php echo $loadingBar; ?>'); 
}

$.stopNew = function (success){
	if (success == 1)
	{
		$("#form_image_return_new").html(''); 
		$("#list").load("<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php?ul");
	}
}




$.startUpload = function(slider_id){
	$("#form_image_return_" + slider_id).html('<?php echo $loadingBar; ?>'); 
}


$.stopUpload = function (success, slider_id){
	if (success == 1)
	{
		$("#form_image_return_" + slider_id).html(''); 
		$("#div_image_logo_" + slider_id).load("<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php?logo&slider_id=" + slider_id);	
	}
	else
	{
	  $("#form_image_return").html(''); 
	}
}

$.deleteLogo = function (slider_id)
{
	$("#li_id_" + slider_id).hide(2000);
	$("#div_image_logo_" + slider_id).load("<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php?delete&slider_id=" + slider_id);
}

$.sortTable = function() // function created
{
	//When the function works, convert all data in in <ul> label with #list ID into array 
	var orderArray = $(this).sortable("serialize"); 
	//Post the variable in [orderArray] to updata_mysql.php page.
	//We add the returned result from update_mysql.php to #div_return ID								 
	$.post("<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php?order", orderArray, function(theResponse){$("#div_return").html(theResponse);});  
}	
<!-- /FUNCTION CREATED -->

$(document).ready(function(){ 	
   $("#list").load("<?php bloginfo('template_url'); ?>/admin/pages/p_port_logo_page.php?ul");
	$(function() {
		$("#list").sortable({ 
		opacity: 0.6,  // opacity value is [0.6] in the process of moving
						
		cursor: 'move', // mouse cursor is [move] during moving
						
		update: $.sortTable // Required function during movement process [defined above]
					
		});
	});
	
	

});	
</script>            

<ul id="list">   
	
        
</ul> <!-- /#list -->

 <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>

    <div class="clear"></div>
</div> <!-- /.stage -->
  <div id="div_return"></div> 

    
<?php } ?>     


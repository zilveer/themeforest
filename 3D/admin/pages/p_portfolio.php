<?php include_once('../func_wp_load.php'); ?>

<?php
if(isset($_POST['add'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	$pp_category = trim(mysql_real_escape_string($_POST['sbox_category']));
	
	update_option('im_theme_portfolio_category_'.$pp_category,$pp_category);
	update_iam($pp_category,$pp_category,'PORTFOLIO_CATEGORY','','','','','','','','');
?>
	<script language="javascript" type="text/javascript">window.top.window.$.stopUpload('1');</script>  
<?php	
} # / else if post image 
else if(isset($_POST['updatelen']))
{
	include_once('../func_wp_load.php'); 
	update_option('im_theme_portfolio_amount', trim(mysql_real_escape_string($_POST['sbox_portfolio_amount'])));
?>
	<script language="javascript" type="text/javascript">  window.top.window.$.stopUpload('1');</script>  
<?php
}
else if(isset($_GET['getload']))
{
	
	$query_category = mysql_query("SELECT * FROM ".$prefix."iam WHERE value1='PORTFOLIO_CATEGORY'");
	while($list_category = mysql_fetch_assoc($query_category))
	{
		$cat_id = $list_category['cat_id'];
	
		echo '
		<div class="mfx_accordion"> 
			<div class="section">
				<h2 class="trigger settings">
					<a href="#" onclick="$.startUpload(); $.deleteCat('.$cat_id.')">Delete</a> '.get_cat_name( $cat_id ).'
				</h2>
			</div>
		</div>
		';
	}	

}
else if(isset($_GET['delete']))
{
	$dete_cat_id = trim(mysql_real_escape_string($_GET['delete']));
	
	mysql_query("DELETE FROM ".$prefix."iam WHERE cat_id='$dete_cat_id' AND value1='PORTFOLIO_CATEGORY'");
	echo '<script>$.stopUpload(1);</script>';
}
else
{
?>
<?php include_once('../func.php'); ?>
    

<script language="javascript" type="text/javascript">
$.startUpload = function(){
	$("#form_image_return").html('<?php echo $loadingBar; ?>'); 
}

$.startUpload_2 = function(){
	$("#form_image_return_2").html('<?php echo $loadingBar; ?>'); 
}


$.stopUpload = function (success){
	if (success == 1)
	{
		$("#form_image_return").html(''); 
		$("#form_image_return_2").html(''); 
		$.reloadPage();	
	}
	else
	{
	  	$("#form_image_return").html(''); 
		$("#form_image_return_2").html(''); 
	}
}

$.reloadPage = function(){$("#category_list").load("http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>?getload");}
$.reloadPage();

$.deleteCat = function(cat_id){$("#category_list2").load("http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>?delete=" + cat_id);}
</script>            


 <!-- #Bigtitle -->
            <div class="bigtitle">
                <h1><?php lang('Portfolio Category Select'); ?></h1>
            </div>
            
            <!-- SELECT LIST AMOUNT -->
            <form name="form_2" id="form_2" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" target="upload_target">
               
               <div class="stage">
                    <h1 class="mini-title-two">Select of Page Navigation:</h1>
                    <div class="form-elements">
                        <div class="select-wrapper">
                            <select name="sbox_portfolio_amount" id="sbox_portfolio_amount">
                            	<option value="4" <?php if(get_option('im_theme_portfolio_amount', true) == '4'){ echo 'selected="selected"';} ?>>4</option>
                                <option value="8" <?php if(get_option('im_theme_portfolio_amount', true) == 8){ echo 'selected="selected"'; } ?>>8</option>
                                <option value="12" <?php if(get_option('im_theme_portfolio_amount', true) == 12){ echo 'selected="selected"'; } ?>>12</option>
                                <option value="16" <?php if(get_option('im_theme_portfolio_amount', true) == 16){ echo 'selected="selected"'; } ?>>16</option>
                                <option value="20" <?php if(get_option('im_theme_portfolio_amount', true) == 20){ echo 'selected="selected"'; } ?>>20</option>
                                <option value="24" <?php if(get_option('im_theme_portfolio_amount', true) == 24){ echo 'selected="selected"'; } ?>>24</option>
                                <option value="26" <?php if(get_option('im_theme_portfolio_amount', true) == 28){ echo 'selected="selected"'; } ?>>26</option>
                                <option value="32" <?php if(get_option('im_theme_portfolio_amount', true) == 32){ echo 'selected="selected"'; } ?>>32</option>
                                <option value="36" <?php if(get_option('im_theme_portfolio_amount', true) == 36){ echo 'selected="selected"'; } ?>>36</option>
                                <option value="40" <?php if(get_option('im_theme_portfolio_amount', true) == 40){ echo 'selected="selected"'; } ?>>40</option>
                                <option value="44" <?php if(get_option('im_theme_portfolio_amount', true) == 44){ echo 'selected="selected"'; } ?>>44</option>
                                <option value="48" <?php if(get_option('im_theme_portfolio_amount', true) == 48){ echo 'selected="selected"'; } ?>>48</option>
                            </select>
                        </div> <!-- /.select-wrapper -->
                    </div> <!-- /.form-elements -->
                    <div class="clear"></div>
                </div> <!-- /.stage -->
                
                <input type="hidden" name="updatelen" />	
                <input type="submit" value="Submit" style="display:none;" id="submit_buttons_x" />
                
            </form>
            
            <div id="form_image_return_2"></div>
            
            <div class="stage-alt">
           		<button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_x').click(); $.startUpload_2()" class="btn_pink">Save</button>
            </div>
                
                
            <form name="form_1" id="form_1" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" target="upload_target">
           
           <div class="stage">
                <h1 class="mini-title-two">Category:</h1>
                <div class="form-elements">
                    <div class="select-wrapper">
                        <select name="sbox_category" id="sbox_category">
                            <?php
                            $query = mysql_query("SELECT * FROM ".$prefix."term_taxonomy WHERE taxonomy='category'");
                            while($list = mysql_fetch_assoc($query))
                            {
                                $q_category_id = $list['term_id']; 
                                
                                $query2 = mysql_query("SELECT * FROM ".$prefix."terms WHERE term_id='$q_category_id'");
                                while($list2 = mysql_fetch_assoc($query2))
                                {
                                    $q_category_name = $list2['name'];	
                                }
                                if($q_categoryID == $q_category_id){$selected = 'selected="selected"';}else{$selected = '';}
                                echo '<option '.$selected.' value="'.$q_category_id.'">'.$q_category_name.'</option>';
                            }
                            ?>
                        </select>
                    </div> <!-- /.select-wrapper -->
                </div> <!-- /.form-elements -->
                <div class="clear"></div>
            </div> <!-- /.stage -->
            
            <input type="hidden" name="add" />	
            <input type="submit" value="Submit" style="display:none;" id="submit_buttons_cat" />
        </form>
            
            <div id="form_image_return"></div>
            
            <div class="stage-alt">
           		<button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons_cat').click(); $.startUpload()" class="btn_pink">Add</button>
            </div>
            
             <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
    
<div id="category_list"></div>
<div id="category_list2"></div>

   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


<?php include_once('../func_wp_load.php'); ?>
<?php include_once('../func.php'); ?>

<?php
if(isset($_POST['update'])) # else if post image
{
	include_once('../func_wp_load.php'); 
	
	update_option('im_theme_backgorund_color',trim(mysql_real_escape_string($_POST['im_theme_backgorund_color'])));
	update_option('im_theme_font_color',trim(mysql_real_escape_string($_POST['im_theme_font_color'])));
	echo '<script language="javascript" type="text/javascript">window.top.window.$.im_stop(\'1\');</script> ';
		
} # / else if post image 
else
{
?>


<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/admin/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/admin/colorpicker/js/colorpicker.js"></script>
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
    <h1><?php lang('Theme Style Settings'); ?></h1>
</div>
    
<form name="form1" id="form1" action="http://<?php echo $_SERVER["SERVER_NAME"]; ?><?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" target="upload_target">
   <div class="stage">
        <h1 class="mini-title"><?php lang('Background Color'); ?>:</h1>
        <div class="form-elements">
        <div id="div_im_theme_backgorund_color" class="color_boxes">&nbsp;</div>
            <input type="text" class="form-input" name="im_theme_backgorund_color" id="im_theme_backgorund_color" value="<?php echo get_option('im_theme_backgorund_color', true); ?>" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="stage">
        <h1 class="mini-title"><?php lang('Font Color'); ?>:</h1>
        <div class="form-elements">
            <div id="div_im_theme_font_color" class="color_boxes">&nbsp;</div>
            <input type="text" class="form-input" name="im_theme_font_color" id="im_theme_font_color" value="<?php echo get_option('im_theme_font_color', true); ?>" />
        </div>
        <div class="clear"></div>
        <iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
    </div>

    <input type="hidden" name="update" />	
    <input type="submit" value="Submit" style="display:none;" id="submit_buttons" />
</form>
    <div id="form_image_return"></div>
    
    <div class="stage-alt">
    <button href="#" id="form_image_button" onClick="document.getElementById('submit_buttons').click(); $.im_start()" class="btn_pink"><?php lang('Update'); ?></button>
    </div>
    
<script>
$('#im_theme_backgorund_color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			$('#div_im_theme_backgorund_color').css('backgroundColor', '#' + hex);
			$('#im_theme_backgorund_color').val(hex);
		}
	})
	.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});

$('#im_theme_font_color').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		},
		onChange: function (hsb, hex, rgb) {
			$('#div_im_theme_font_color').css('backgroundColor', '#' + hex);
			$('#im_theme_font_color').val(hex);
		}
	})
	.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});



$(document).ready(function(e) {
	$('#div_im_theme_backgorund_color').css('backgroundColor', '#' + $('#im_theme_backgorund_color').val());
	$('#div_im_theme_font_color').css('backgroundColor', '#' + $('#im_theme_font_color').val());
});

</script>
   <?php include_once('../func2.php'); ?>
   
<?php } ?>     


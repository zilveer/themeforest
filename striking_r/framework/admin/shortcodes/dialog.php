<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php do_action('admin_xml_ns'); ?> <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title><?php printf(__('Insert %s Shortcode','theme_admin'), $array['title']); ?></title>
<script type="text/javascript">
//<![CDATA[
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var userSettings = {'url':'<?php echo SITECOOKIEPATH; ?>','uid':'<?php if ( ! isset($current_user) ) $current_user = wp_get_current_user(); echo $current_user->ID; ?>','time':'<?php echo time(); ?>'};
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>', pagenow = 'shortcode-dialog-popup', adminpage = 'media-upload-popup',
isRtl = <?php echo (int) is_rtl(); ?>;
//]]>
</script>
<?php
do_action('admin_print_styles');
do_action('admin_print_scripts');
do_action('admin_head');

if(isset($array['options']['tabs'])){
		$generator = new shortcodeTabOptionGenerator($array['options']);
	} else {
		$generator = new shortcodeOptionGenerator($array['options']);
	}
?>
</head>
<body<?php if ( isset($GLOBALS['body_id']) ) echo ' id="' . $GLOBALS['body_id'] . '"'; ?> class="no-js wp-core-ui">
<script type="text/javascript">
//<![CDATA[
(function(){
var c = document.body.className;
c = c.replace(/no-js/, 'js');
document.body.className = c;
})();
//]]>
</script>
<?php
if(isset($_GET['dialog']) && $_GET['dialog'] == 'nav_menu_icon'):?>
	<div id="theme-dialog-wrap">
		<div class="inner">
			<div id="theme-dialog-options-wrap">
				<h3>Customize the Icon</h3>
				<div id="theme-dialog-options"><?php $generator->render();?></div>
			</div>
		</div>
	</div>
	<div id="theme-dialog-footer">
		<div class="inner">
			<input type="button" id="theme-button-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
			<input type="button" id="theme-button-insert" class="button button-primary" name="insert" value="Insert" accesskey="I" />
		</div>
	</div>
<?php do_action('admin_print_footer_scripts');?>
<script type="text/javascript">
//<![CDATA[
if(typeof wpOnload=='function')wpOnload();
(function ($) {
	$(document).ready( function($) {
		dialog.init({
<?php if(isset($array['shortcode'])) echo "\t\t\tshortcode:'".$array['shortcode']."',\n";?>
<?php if(isset($array['attributes'])) echo "\t\t\tattributes:'".$array['attributes']."',\n";?>
			select:<?php echo (isset($_GET['select']))? 'true':'false';?>,
<?php if(isset($array['init'])) echo "\t\t\tinit:function(){\n".$array['init']."\n},\n";?>
<?php if(isset($array['custom'])) echo "\t\t\tcustom:function(attrs){\n".$array['custom']."\n},\n";?>
<?php if(isset($array['contentOption'])) echo "\t\t\tcontentOption:'".$array['contentOption']."',\n";?>
<?php if(isset($array['insert'])) echo "\t\t\tinsert:function(){\n".$array['insert']."\n},\n";?>
			type:"<?php echo $array['type'];?>"
		});
	});
})(jQuery);
//]]>
</script>

<?php else:?>
	<div id="theme-dialog-wrap">
		<div class="inner">
			<div id="theme-dialog-options-wrap">
				<h3>Customize the <?php echo $array['title'];?> Shortcode</h3>
				<div id="theme-dialog-options"><?php $generator->render();?></div>
			</div>
			<div id="theme-dialog-preview-wrap">
				<iframe name="preview-iframe" id="theme-dialog-preview-iframe" frameborder="0" style="width:100%;height:100%" scrolling="auto"></iframe>   
			</div>
			<form id="theme-dialog-preview-form" action="<?php echo admin_url('admin-ajax.php'); ?>?action=theme-shortcode-preview" method="post" target="preview-iframe">
				<input id="theme-dialog-preview-shortcode" type="hidden" name="shortcode" value=""/>
			</form>
		</div>
	</div>
	<div id="theme-dialog-footer">
		<div class="inner">
			<input type="button" id="theme-button-cancel" class="button" name="cancel" value="Cancel" accesskey="C" />
			<input type="button" id="theme-button-insert" class="button button-primary" name="insert" value="Insert" accesskey="I" />
			<input type="button" id="theme-button-preview" class="button" name="preview" value="Preview" accesskey="P" />
		</div>
	</div>
<?php do_action('admin_print_footer_scripts');
do_action('admin_footer');
?>

<script type="text/javascript">
//<![CDATA[
if(typeof wpOnload=='function')wpOnload();
(function ($) {
	$(document).ready( function($) {
		dialog.init({
<?php if(isset($array['shortcode'])) echo "\t\t\tshortcode:'".$array['shortcode']."',\n";?>
<?php if(isset($array['attributes'])) echo "\t\t\tattributes:'".$array['attributes']."',\n";?>
			select:<?php echo (isset($_GET['select']))? 'true':'false';?>,
<?php if(isset($array['init'])) echo "\t\t\tinit:function(){\n".$array['init']."\n},\n";?>
<?php if(isset($array['custom'])) echo "\t\t\tcustom:function(attrs){\n".$array['custom']."\n},\n";?>
<?php if(isset($array['contentOption'])) echo "\t\t\tcontentOption:'".$array['contentOption']."',\n";?>
			type:"<?php echo $array['type'];?>"
		});
	});
})(jQuery);
//]]>
</script>
<?php endif;?>
</body>
</html>
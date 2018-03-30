<?php 
//Setup URL to WordPres
$absolute_path = __FILE__;
$path_to_wp = explode( 'wp-content', $absolute_path );
$wp_url = $path_to_wp[0];

//Access WordPress
require_once( $wp_url.'/wp-load.php' );

//URL to TinyMCE plugin folder
$plugin_url = get_template_directory_uri().'/framework/inc/tinymce/';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<div id="dialog">
	<div class="clear">
		<div class="alignleft">
		   <h3 class="sc-options-title"><?php _e( 'Shortcode options', 'richer-framework' ); ?></h3>
		</div>
		<div class="clear"></div><!--/.clear-->
	</div><!-- #options-buttons(end) -->
	<div id="shortcode-options" class="alignleft">
		<table id="options-table">
		</table>
	</div>
  <div class="clear"></div>
  <div class="buttons-wrapper">
    <input type="button" id="cancel-button" class="button alignleft" name="cancel" value="<?php _e('Cancel','richer-framework'); ?>" accesskey="C" />
    <input type="button" id="insert-button" class="button-primary alignright" name="insert" value="<?php _e('Insert Shortcode','richer-framework'); ?>" accesskey="I" />
    <div class="clear"></div>
  </div>
	
<script type="text/javascript" src="<?php echo $plugin_url; ?>layout/js/dialog-js.php"></script>

</div><!-- #dialog (end) -->

</body>
</html>
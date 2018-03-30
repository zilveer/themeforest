<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
$id = Mk_Static_Files::shortcode_id();

global $mk_options;

$bg_color = !empty( $bg_color ) ? $bg_color : $mk_options['skin_color'];
$text_color = !empty( $text_color ) ? $text_color : "#fff";
?>

<span id="mk-highlight-<?php echo $id; ?>" class="mk-highlight <?php echo $el_class; ?>"><?php echo $text; ?></span>

<?php
/**
 * Custom CSS Output
 * ==================================================================================
 */
$app_styles = '
	#mk-highlight-'.$id.' {
		background-color: '.$bg_color.';
		color: '.$text_color.';
	}
';

Mk_Static_Files::addCSS($app_styles, $id);

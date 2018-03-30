<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

?>

<div style="<?php echo $border_color.$bg_color.$blend_mode_css; ?>" class="<?php echo $css_class; ?> <?php echo $visibility; ?> _ height-full">
	<?php echo wpb_js_remove_wpautop($content); ?>
</div>

<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

?>

<span id="drop-caps-<?php echo $id; ?>" class="mk-dropcaps <?php echo $style; ?> <?php echo $el_class; ?>">
	<?php echo do_shortcode( strip_tags( $content ) ); ?>
</span>

<?php

$app_styles = !empty( $background_color ) ? ( '#drop-caps-'.$id.' {background-color:'.$background_color.' !important;}' ) : '';
$app_styles .= !empty( $padding ) ? ( '#drop-caps-'.$id.' {padding:'.$padding.'px !important;}' ) : '';
$app_styles .= !empty( $text_color ) ? ( '#drop-caps-'.$id.' {color:'.$text_color.' !important;}' ) : '';
$app_styles .= !empty( $size ) ? ( '#drop-caps-'.$id.' {font-size:'.$size.'px !important;}' ) : '';

Mk_Static_Files::addCSS($app_styles, $id);
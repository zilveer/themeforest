<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
$id = Mk_Static_Files::shortcode_id();
Mk_Static_Files::addCSS('#box-' . $id . '{background-image:url('.THEME_IMAGES.'/box-'.$type.'-icon.png)}', $id);
?>

<div id="box-<?php echo $id; ?>" class="mk-message-box <?php echo $el_class; ?> mk-<?php echo $type; ?>-box">
	<a class="box-close-btn" href="#"><i class="mk-icon-remove"></i></a>
	<span>
		<?php echo strip_tags( do_shortcode( $content ) ); ?>
	</span>
	<div class="clearboth"></div>
</div>

<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );
?>

<div class="mk-mini-callout <?php echo $el_class; ?> <?php echo $visibility; ?>">
	
	<span class="callout-title"><?php echo $title; ?></span>
	
	<span class="callout-desc"><?php echo wpb_js_remove_wpautop( $content, true ); ?></span>
	
	<?php if ( $button_text ) { ?>
		<a class="callout-button" href="<?php echo $button_url; ?>"><?php echo $button_text; ?><i class="mk-icon-caret-right center-icon"></i></a>
	<?php } ?>

</div>

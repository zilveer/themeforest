<?php
extract( shortcode_atts( array(
			'el_class' => ''
		), $atts ) );
?>

<div class="mk-fancy-table <?php echo $el_class; ?>">
	<?php echo wpb_js_remove_wpautop( $content ); ?>
</div>

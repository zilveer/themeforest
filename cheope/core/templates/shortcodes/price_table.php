<?php
	$color = (isset($color) && $color != '' && $color != '#686767"') ? 'style="background-image: none; background-color: '.$color.';"' : '';
	$type = (isset($type)) ? $type : '';
    $content = str_replace( '<ul>', '', $content );
	$content = str_replace( '</ul>', '', $content );
?>
<div class="pricing_box <?php echo $type; ?> radius-right">
	<div class="header" <?php echo $color ?>><h3><?php echo $title; ?></h3></div>
	<ul>
		<?php echo do_shortcode( $content ); ?>
	</ul>
	<p></p>
	<h3><?php echo $price; ?></h3>
	<?php if ( isset($href) && isset($buttontext) && $href != '' && $buttontext != '' ) : ?>
		<p class="button signup"><a href="<?php echo esc_url($href); ?>"><?php echo $buttontext; ?></a></p>
	<?php endif; ?>
</div>
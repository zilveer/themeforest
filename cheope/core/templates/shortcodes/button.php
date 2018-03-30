<?php
	global $yit_button_index;
	if ( ! isset( $yit_button_index )  ) $yit_button_index = 0;
	
	$target = (isset($target) && $target != '') ? 'target="' . $target . '"' : '';
	
	if (isset($color) && $color != '') {
	
		//if( isset($force_style) && $force_style == "1" ) {
			//echo "<link rel='stylesheet' id='custom-button-{$color}-css'  href='". YIT_CORE_ASSETS_URL . "/css/buttons/{$color}.css' type='text/css' media='all' />";
		wp_enqueue_style( "custom-button-{$color}-css", YIT_CORE_ASSETS_URL . "/css/buttons/{$color}.css" );
        //}


	} elseif (isset($colorstart) && isset($colorend) && $colorstart != '' && $colorend != '') {
		$colortext = (isset($colortext) && $colortext != '') ? $colortext : '#FFFFFF';
		$color = 'id' . $yit_button_index;
		$name = 'id' . $yit_button_index;
		$align = ( $align == '' ) ? 'vertical' : $align;
		
		$yit_button_index++;
		
		$yit_gradients = new YIT_Gradients();
		?>
		<style type="text/css">
		<?php
			echo $yit_gradients->gradient_from_to( '.btn-' . $name, $colorstart, $colorend, $align );
			echo $yit_gradients->gradient_lighter( '.btn-' . $name .':hover', $colorstart, $align, 50);
			echo 'a.btn-' . $name . '{ color: ' . $colortext . ';}';
			echo 'a.btn-' . $name . ':hover { color: ' . $colortext . ';}';
		?>
		</style>
<?php } ?>
<?php
	$color = ' btn-' . $color;
    $width = ( strcmp($width, 'normal') == 0 || strcmp($width, 'medium') == 0 || $width == '' ) ? '' : 'btn-' . $width;
    $icon_size = ( $icon_size != '' ) ? 'style="font-size: ' . $icon_size . 'px;"' : '';
    
	$content = (isset($content) && $content != '') ? $content : '&nbsp;';
    if( isset($icon) && $icon != '' ) {
        $icon = '<i class="icon-'. str_replace('icon-', '', $icon) .'" '.$icon_size.'></i>';
		$html = '<a href="' . $href . '" ' . $target . ' class="btn ' . $width . ' ' . $color . ' ' . $class . '">' . $icon . ' ' . $content . '</a>';
    }
	else {
		$html = '<a href="' . $href . '" ' . $target . ' class="btn ' . $width . ' ' . $color . ' ' . $class . '">' . $content . '</a>';
	}
?>
<?php echo $html; ?>
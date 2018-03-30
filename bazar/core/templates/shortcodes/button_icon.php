<?php

	if( $icon_path != '' ):
		$icon_path = esc_url( $icon_path );
	endif;
	//else
		//$path = get_template_directory_uri() . '/images/icons/for_button/' . $icon . '.png';

	$style = '';
	if( isset($icon_path) && $icon_path != '' )
		$style = ' style="background-image:url(\'' . $icon_path . '\')"';

    $target = !empty( $target ) ? ' target="' . $target . '"' : '';
?>

<a class="more-button more-button-<?php echo $sense; ?>" href="<?php echo $href; ?>" title="<?php echo $content ?>"<?php echo $target ?>>
	<?php echo $content; ?>
	<span class="icon <?php echo $icon; ?>"<?php echo $style; ?>>&nbsp;</span>
</a>
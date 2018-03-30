<?php
	$color = ( $color == 'grey' ) ? '' : ' twitter_label-' . $color;
	
    $icon = ( !isset($icon) ) ? '">' : ' ' . 'icon-' . str_replace('icon-', '', $icon) . '"> ';
?>

<span class="twitter_label <?php echo $color . $icon . do_shortcode( $content ); ?></span>
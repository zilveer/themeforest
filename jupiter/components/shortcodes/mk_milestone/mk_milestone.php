<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$icon = !empty( $icon ) ? (strpos($icon, 'mk-') !== FALSE) ? $icon : ( 'mk-'.$icon.'' ) : '';        
$text_size = ($text_size > 12) ? ';font-size:'.$text_size.'px' : '';
$font_weight = ($font_weight) ? ';font-weight:'.$font_weight.'' : '';

echo mk_get_fontfamily( "#milestone-", $id, $font_family, $font_type );

Mk_Static_Files::addCSS('#milestone-'.$id.' .milestone-text:after{background:'.$text_color.';}', $id);

?>

<div id="milestone-<?php echo $id; ?>" class="mk-milestone milestone-<?php echo $icon_size; ?> <?php echo $align; ?>-align <?php echo $el_class; ?> <?php echo $visibility; ?>">
	
	<?php echo ($link != '') ? '<a href="'.$link.'">' : ''; ?>
	<i><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, $icon, null, $icon_color); ?></i>

	<div class="milestone-top">
		<?php echo !empty( $prefix ) ? ( '<span style="color:'.$text_color.$text_size.$font_weight.'" class="milestone-prefix">'.$prefix.'</span> ' ) : ''; ?>
		<span style="color:<?php echo $text_color.$text_size.$font_weight; ?>" class="milestone-number" data-speed="<?php echo $speed; ?>" data-stop="<?php echo $stop; ?>"><?php echo $start; ?></span>
		<?php echo !empty( $suffix ) ? ( ' <span style="color:'.$text_color.$text_size.$font_weight.'" class="milestone-suffix">'.$suffix.'</span>' ) : ''; ?>
		<?php echo (!empty($text)) ? ('<div style="color:'.$text_color.';font-size:'.$desc_size.'px" class="milestone-text">'.$text.'</div>') : ''; ?>
	</div>

	<div class="clearboth"></div>
	<?php echo ($link != '') ? '</a>' : ''; ?>
</div>

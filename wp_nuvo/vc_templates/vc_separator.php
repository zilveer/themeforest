<?php
extract( shortcode_atts( array(
	'el_width' => '',
	'style' => '',
	'color' => '',
	'separator_arrow' => '',
	'arrow_color'=>'',
	'arrow_width' =>'12',
	'border_width'=>'1',
	'accent_color' => '',
	'el_class' => ''
), $atts ) );

if($color == 'custom'){
	$color = $accent_color;
}

if(!$arrow_color){
	$arrow_color = $color;
}

$class = "vc_separator no-text wpb_content_element";
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : ' vc_el_width_100';

$inline_css = 'style="border-style:'.esc_attr($style).';border-color:'.esc_attr($color).';border-width: '.esc_attr($border_width).'px;"';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>">
	<span class="vc_sep_holder vc_sep_holder_l <?php if($separator_arrow == 'yes'){ echo 'separator_arrow'; } ?>">
		<span <?php echo $inline_css; ?> class="vc_sep_line">
			<span class="arrow" style="border-width: <?php echo esc_attr($arrow_width); ?>px; border-color:<?php echo $arrow_color; ?> transparent  transparent;"></span>
		</span>
	</span>
</div>
<?php

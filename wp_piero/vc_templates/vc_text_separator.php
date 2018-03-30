<?php
extract(shortcode_atts(array(
    'title' => '',
    'heading_size' => 'h4',
    'title_align' => '',
    'text_transform' =>'',
    'el_width' => '',
    'border_width'=>'1',
    'heading_font_color'=>'',
    'heading_size'=>'h4',
    'heading_font_size'=>'',
    'style' => '',
    'color' => '',
    'desc' =>'',
    'accent_color' => '',
    'el_class' => ''
), $atts));
$class = "vc_separator wpb_content_element";

$class .= ($title_align!='') ? ' vc_'.$title_align : '';
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : ' vc_el_width_100';
$class .= ($style!='') ? ' vc_sep_'.$style : '';
$class .= ($color!='') ? ' vc_sep_color_'.$color : '';

$inline_css = ($accent_color!='') ? ' style="'.vc_get_css_color('border-color', $accent_color).'border-width: '.esc_attr($border_width).';"' : '';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr(trim($css_class)); ?>">
	<div class="cs_separator_title">
		<span class="vc_sep_holder vc_sep_holder_l"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
        <?php if($title!=''): ?><<?php echo esc_attr($heading_size); ?> class="title" <?php echo " style='color: $heading_font_color; font-size: $heading_font_size;text-transform: $text_transform;'"; ?>><?php echo $title; ?></<?php echo esc_attr($heading_size); ?>><?php endif; ?>
		<span class="vc_sep_holder vc_sep_holder_r"><span<?php echo $inline_css; ?> class="vc_sep_line"></span></span>
	</div>
	<div class="cs_separator_desc">
		<span><?php echo esc_attr($desc); ?></span>
	</div>
</div>
<?php echo $this->endBlockComment('separator')."\n";
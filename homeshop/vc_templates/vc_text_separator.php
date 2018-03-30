<?php $rgb = sc_hexToRGB(get_option(SHORTNAME . '_accent_color'));
$output = $title = $title_align = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "homeShop"),
    'title_align' => 'separator_align_center',
    'el_class' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_text_separator_wrapper wpb_content_element '.$title_align.$el_class, $this->settings['base']);
?>
<!-- <div class="<?php echo  $css_class ?>" style="border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);"></div>
<div><?php echo  $title ?></div>
<div class="<?php echo  $css_class ?>" style="border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);"></div> -->

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="<?php echo  $css_class ?>" >
	<tr>
		<td class="vc_text_separator" style="border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);"></td>
		<td class="separator_title"><div class="title"><?php echo  $title ?></div></td>
		<td class="vc_text_separator" style="border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);"></td>
	</tr>
</table>
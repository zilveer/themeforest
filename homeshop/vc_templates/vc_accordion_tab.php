<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "homeShop")
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);

$rgb = sc_hexToRGB(get_option(SHORTNAME . '_accent_color'));
?>
<div class="<?php echo  $css_class ?>" style="border-bottom-color: rgba(<?php echo  implode(',', $rgb) ?>, 0.2);">
    <h3 class="wpb_accordion_header ui-accordion-header">
    	<a href="#<?php echo  sanitize_title($title) ?>">
    		<span class="plus">+</span>
    		<span class="minus">-</span>
    		<?php echo  $title ?>
		</a>
    </h3>
    <div class="wpb_accordion_content ui-accordion-content clearfix">
        <?php echo ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "homeShop") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content); ?>
    </div>
</div>
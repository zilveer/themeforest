<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "js_composer")
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);

$rgb = candidat_sc_hexToRgb(get_option(SHORTNAME . '_accent1_color'));
?>

	<!-- Accordion -->
	<li class="accordion">
		
		<div class="accordion-header">
			<div class="accordion-icon"></div>
			<h6><?php echo  $title ?></h6>
			
		</div>
		
		<div class="accordion-content">
			<?php echo ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content); ?>
		</div>
		
	</li>
	<!-- /Accordion -->


<?php

add_shortcode('cs-custombtn', 'cs_custombtn_render');

function cs_custombtn_render($atts, $content = null) {

	extract(shortcode_atts(array(

	'el_selector' => '.section-scroll-top',
	'icon_class' => 'fa fa-arrow-down',
	'el_class' => '',

	), $atts));

	ob_start();
	wp_register_script('custombtn', get_template_directory_uri() . '/framework/shortcodes/custombtn/custombtn.js');
	wp_enqueue_script('custombtn');
	?>
	<div class="sidebar-custom-button-wrap <?php echo $el_class;?>">
		<a class="btn smooth2pager" data-el-selector="<?php echo $el_selector;?>" href="javascript:void(0);"><i class="<?php echo $icon_class;?>"></i></a>
	</div>
	<?php
	return ob_get_clean();

}
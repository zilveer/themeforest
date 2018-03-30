<?php

extract( shortcode_atts( array(
			'el_class' => '',
			'flickr_id' => '95572727@N00',
			'count' => '6',
			'column' => 'one'
		), $atts ) );
global $mk_settings;

$api_key = $mk_settings['flickr-api-key'];

?>

<div class="mk-flickr-feeds flickr-widget-wrapper <?php echo $el_class; ?>">
	<div data-count="<?php echo $count; ?>" data-userid="<?php echo $flickr_id; ?>" data-key="<?php echo $api_key; ?>" class="mk-flickr-feeds <?php echo $column; ?>-column"></div>
	<div class="clearboth"></div>
</div>

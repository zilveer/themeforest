<?php

class WPV_Flickr {
	public function __construct() {
		add_shortcode('flickr', array(&$this, 'flickr'));
	}

	public function flickr($atts) {
		extract(shortcode_atts(array(
		'id' => '',
		'type' => 'user',
		'count' => 4,
		'display' => 'latest'//lastest or random
	), $atts));
	
	return <<<HTML
		<div class="flickr_wrap clearfix">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count={$count}&amp;display={$display}&amp;size=s&amp;layout=x&amp;source={$type}&amp;{$type}={$id}"></script>
		</div>
HTML;
	}
}

new WPV_Flickr;
<?php

class AQ_Map_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Map',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add a google map<br />to the page.'
		);
		//create the block
		parent::__construct('aq_map_block', $block_options);
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'image' => '',
			'url' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Upload a Marker Image
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Address for map, use plain text, e.g: <code>Lord Mayors Walk, York, England</code><br /><code>Note: You require a Google Maps API key for this to work, please see the settings in <a href="<?php echo admin_url('/customize.php'); ?>">Appearance => Customize</a></code>
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('url') ?>">
				Link map marker to another URL? Enter Link here. <code>Optional</code>
				<?php echo aq_field_input('url', $block_id, $url, $size = 'full') ?>
			</label>
		</p>

	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		if(!( isset($url) ))
			$url = false;
		
		$unique = wp_rand(0,1000);
		
		echo '<div id="google-maps"><div class="google-maps"></div></div>'; 
		echo "<script type='text/javascript'>
				jQuery(document).ready(function($){
				'use strict';
				
					jQuery('.google-maps').gmap3({
						marker:{     
							address:'$title', 
							options:{ icon: '$image'},";
							
							if( $url ){
							echo "clickable: true,	events:{
								      click: function(marker, event, context){
								      	location.assign('" . esc_url($url) . "');
								      }
								}";
							}
							
		echo "},
						map:{
							options:{
								styles: [ {
									stylers: [ { 'saturation':-100 }, { 'lightness': 0 }, { 'gamma': 0.5 }]},
								],
								zoom: 17,
								scrollwheel:false,
								draggable: false 
							}
						}
					});	
				
				});
			</script>";
			
	}//end block
	
}//end class
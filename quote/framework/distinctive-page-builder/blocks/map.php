<?php
/** Google Map block **/

if(!class_exists('AQ_Map_Block')) {
	class AQ_Map_Block extends AQ_Block {
		
		//set and create block
		function __construct() {
			$block_options = array(
				'name' => 'Full Width Map',
				'size' => 'span12',
			);
			
			//create the block
			parent::__construct('aq_map_block', $block_options);
		}
		
		function form($instance) {
			
			$defaults = array(
				'title' => '',
				'address' => '',
				'height' => '350',
				'zoom' => '15',
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			
			?>
			
			<div class="description two-third">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title (optional)<br/>
					<?php echo aq_field_input('title', $block_id, $title) ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('address') ?>">
					Address
					<?php echo aq_field_textarea('address', $block_id, $address, $size = 'full') ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Height<br/>
					<?php echo aq_field_input('height', $block_id, $height, $size = 'full') ?>
				</label>
			</div>

			<div class="description">
				<label for="<?php echo $this->get_field_id('zoom') ?>">
					Zoom<br/>
					<?php echo aq_field_input('zoom', $block_id, $zoom, $size = 'full') ?>
				</label>
			</div>

			<?php
			
		}
		
		function block($instance) {
			extract($instance); 
			$themeurl = get_template_directory_uri(); ?> 
            <script type="text/javascript">
            jQuery(document).ready(function(){
            	jQuery("#mapwrapper").gMap({  
					controls: false,
         			scrollwheel: false,
         			markers: [{ 	
              			address: '<?php echo $address; ?>',
          				icon: { image: "<?php echo $themeurl; ?>/assets/img/marker.png",
          					iconsize: [44,44],
          					iconanchor: [12,46],
          					infowindowanchor: [12, 0] 
          				} 
          			}],
		          	icon: { 
		              	image: "<?php echo $themeurl; ?>/assets/img/marker.png", 
		             	iconsize: [26, 46],
		              	iconanchor: [12, 46],
		              	infowindowanchor: [12, 0] },
		         	address: '<?php echo $address; ?>',
		          	zoom: <?php echo $zoom; ?> 
		          	});
            });
            </script>
            <div style="height:<?php echo $height ;?>" id="mapwrapper"><div id="map"></div></div>
            <?php			
			 
			
		}
		
	}
}
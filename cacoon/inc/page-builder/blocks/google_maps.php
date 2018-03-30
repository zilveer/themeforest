<?php
if(!class_exists('MET_Google_Maps')) {
	class MET_Google_Maps extends AQ_Block {

		function __construct() {
			$block_options = array(
				'name' => 'Google Maps',
				'size' => 'span12',
				'resize' => 0
			);

			parent::__construct('MET_Google_Maps', $block_options);
			add_action('wp_ajax_aq_block_mapelem_add_new', array($this, 'add_tab'));
		}

		function form($instance) {

			$defaults = array(
				'lat' 				=> '-12.043333',
				'lng' 				=> '-77.028333',
				'marker'			=> 'false',
				'show_polylines'	=> 'false',
				'marker_lat'		=> '-12.043333',
				'marker_lng'		=> '-77.028333',
				'marker_text'		=> 'MetCreative Office',
				'info_box'			=> 'false',
				'info_box_content' 	=> '',
				'height' 			=> '620',
				'zoom'				=> 11,
				'polyline_color'	=> '#000000',
				'polyline_opacity'	=> '0.5',
				'polyline_weight'	=> '3',
				'tabs' => array(
					1 => array(
						'title'	=> 'Elem #1',
						'lat' 	=> '-12.043333',
						'lng' 	=> '-77.028333',
						'content'	=> '',
						'type'		=> 'p'
					)
				)
			);
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);

			$bool_options = array('false' => 'FALSE' , 'true' => 'TRUE');

			for($zi = 0; $zi <= 21; $zi++){
				$zoom_options[$zi] = $zi;
			}

			?>

			<p class="description">
				<label for="<?php echo $this->get_field_id('lat') ?>">
					Latitude (required)<br/>
					<?php echo aq_field_input('lat', $block_id, $lat) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('lng') ?>">
					Longitude (required)<br/>
					<?php echo aq_field_input('lng', $block_id, $lng) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('zoom') ?>">
					Zoom Level<br/>
					<?php echo aq_field_select('zoom', $block_id, $zoom_options , $zoom) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('info_box') ?>">
					Infobox?<br/>
					<?php echo aq_field_select('info_box', $block_id, $bool_options , $info_box) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('info_box_content') ?>">
					Infobox Content<br/>
					<?php echo aq_field_textarea('info_box_content', $block_id , $info_box_content) ?>
				</label>
			</p>

			<p class="description">
				<label for="<?php echo $this->get_field_id('height') ?>">
					Map Height (required)<br/>
					<?php echo aq_field_input('height', $block_id, $height) ?>
				</label>
			</p>

			<br>
			<strong>Map Elements</strong>
			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
						$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
						$count = 1;
						foreach($tabs as $tab) {
							$this->mapelem($tab, $count);
							$count++;
						}
					?>
				</ul>
				<p></p>
				<a href="#" rel="mapelem" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>

			<div class="description half" style="width: 20%">
				<label for="<?php echo $this->get_field_id('polyline_color') ?>">
					Polylines Color
					<?php echo aq_field_color_picker('polyline_color', $block_id, $polyline_color, '#000000') ?>
				</label>
			</div>

			<div class="description half" style="width: 15%">
				<label for="<?php echo $this->get_field_id('polyline_opacity') ?>">
					Opacity<br/>
					<?php echo aq_field_input('polyline_opacity', $block_id, $polyline_opacity, 'min') ?>
				</label>
			</div>

			<div class="description half" style="width: 15%">
				<label for="<?php echo $this->get_field_id('polyline_weight') ?>">
					Weight (px)<br/>
					<?php echo aq_field_input('polyline_weight', $block_id, $polyline_weight, 'min') ?>
				</label>
			</div>

			<p class="description half last" style="width: 20%;margin-right: 2%">
				<label for="<?php echo $this->get_field_id('show_polylines') ?>">
					Show Polylines?<br/>
					<?php echo aq_field_select('show_polylines', $block_id, $bool_options , $show_polylines) ?>
				</label>
			</p>

			<p class="description half last" style="width: 22%">
				<label for="<?php echo $this->get_field_id('marker') ?>">
					Show Markers?<br/>
					<?php echo aq_field_select('marker', $block_id, $bool_options , $marker) ?>
				</label>
			</p>

		<?php

		}

		function mapelem($tab = array(), $count = 0) {

			$elem_types = array( 'p' => 'Polyline', 'm' => 'Marker' );

			?>
			<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">

				<div class="sortable-head cf">
					<div class="sortable-title">
						<strong><?php echo $tab['title'] ?> (<?php echo $elem_types[$tab['type']] ?>)</strong>
					</div>
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>

				<div class="sortable-body">
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
							Title<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" value="<?php echo $tab['title'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-lat">
							Latitude (required)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-lat" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][lat]" value="<?php echo $tab['lat'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-lng">
							Longitude (required)<br/>
							<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-lng" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][lng]" value="<?php echo $tab['lng'] ?>" />
						</label>
					</p>
					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content">
							Content (Marker Only)<br/>
							<textarea id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-content" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][content]"><?php echo $tab['content'] ?></textarea>
						</label>
					</p>

					<p class="tab-desc description">
						<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-type">
							Element Type<br/>
							<select id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-type" class="input-full" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][type]">
								<?php foreach($elem_types as $elemtVAL => $elemtTITLE): ?>
									<option <?php echo (($elemtVAL == $tab['type']) ? 'selected=""' : '') ?> value="<?php echo $elemtVAL ?>"><?php echo $elemtTITLE ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					</p>

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>

			</li>
		<?php
		}

		function block($instance) {
			extract($instance);

			$widgetID = uniqid('met_google_maps_');

			wp_enqueue_script('metcreative-gmaps-api');
			wp_enqueue_script('metcreative-gmaps');

			if(!isset($zoom)){ $zoom = 11; }
			if(!isset($polyline_color)){ $polyline_color = '#000000'; }
			if(!isset($polyline_opacity)){ $polyline_opacity = '0.5'; }
			if(!isset($polyline_weight)){ $polyline_weight = '3'; }
			if(!isset($show_polylines)) $show_polylines = 'false';


?>
			<style>
				#<?php echo $widgetID ?> img {
					max-width: none;
					vertical-align: baseline;
				}
			</style>

			<div class="row-fluid">
				<div class="span12">
					<div id="<?php echo $widgetID ?>" style="width:100%;height:<?php echo $height ?>px"></div>
					<?php if($info_box == 'true'): ?>
						<div class="<?php echo $widgetID ?>_met_contact_map_box met_contact_map_box met_bgcolor3 met_color2">
							<?php echo do_shortcode(htmlspecialchars_decode($info_box_content)); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<?php
				if(!isset($tabs)) $tabs = array();
				$polylines = array();
				if($tabs){
					foreach($tabs as $tab_item){
						if($tab_item['type'] == 'p'){
							$polylines[] = $tab_item['lat'] . ',' . $tab_item['lng'];
						}
					}
				}


				if($polylines AND $show_polylines == 'true'){
					$polylines_encode = '';
					foreach($polylines as $polyline){
						$polylines_encode .= '['.$polyline.'],';
					}
					$polylines_encode = substr($polylines_encode,0,-1);
				}
			?>

			<script>
				jQuery(document).ready(function(){
					var <?php echo $widgetID ?>_map = new GMaps({
						div: '#<?php echo $widgetID ?>',
						lat: <?php echo $lat ?>,
						lng: <?php echo $lng ?>,
						zoom: <?php echo $zoom ?>
					});

					<?php if($polylines AND $show_polylines == 'true'): ?>
					<?php echo $widgetID ?>_path = [<?php echo $polylines_encode ?>];

					<?php echo $widgetID ?>_map.drawPolyline({
						path: <?php echo $widgetID ?>_path,
						strokeColor: '<?php echo $polyline_color ?>',
						strokeOpacity: <?php echo $polyline_opacity ?>,
						strokeWeight: <?php echo $polyline_weight ?>
					});
					<?php endif; ?>

					<?php if($marker == 'true' AND $tabs): ?>
						<?php foreach($tabs as $tab_item): ?>
							<?php if($tab_item['type'] == 'm'): ?>
							<?php echo $widgetID ?>_map.addMarker({
								lat: <?php echo $tab_item['lat'] ?>,
								lng: <?php echo $tab_item['lng'] ?>,
								title: '<?php echo $tab_item['title'] ?>',
								infoWindow: {
									content: '<?php echo htmlspecialchars_decode($tab_item['content']) ?>'
								}
							});
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				});
			</script>
<?php

		}

		/* AJAX add tab */
		function add_tab() {
			$nonce = $_POST['security'];
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');

			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';

			//default key/value for the tab
			$tab = array(
				'title'	=> 'Elem #'.$count,
				'lat' 	=> '',
				'lng' 	=> '',
				'content'	=> '',
				'type'		=> 'p'
			);

			if($count) {
				$this->mapelem($tab, $count);
			} else {
				die(-1);
			}

			die();
		}

		function update($new_instance, $old_instance) {
			$new_instance = aq_recursive_sanitize($new_instance);
			return $new_instance;
		}

	}
}
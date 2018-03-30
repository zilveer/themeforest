<?php
/* List Block */
if(!class_exists('Clients_Block')) {
	class Clients_Block extends AQ_Block {
	
		function __construct() {
			$block_options = array(
				'name' => 'Clients Carousel',
				'size' => 'span12',
			);
			
			//create the widget
			parent::__construct('Clients_Block', $block_options);
			
			//add ajax functions
			add_action('wp_ajax_aq_block_client_add_new', array($this, 'add_client_item'));
			
		}
		
		function form($instance) {
		
			$defaults = array(
				'title' => 'Our Clients',
				'items' => array(
					1 => array(
						'link' => '',
						'photo' => '',
					)
				),
			);
			
			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			?>

			<div class="description">
				<label for="<?php echo $this->get_field_id('title') ?>">
					Title
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</div>

			<div class="cf"></div>

			<div class="description cf">
				<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
					<?php
					$items = is_array($items) ? $items : $defaults['items'];
					$count = 1;
					foreach($items as $item) {	
						$this->item($item, $count);
						$count++;
					}
					?>
				</ul>
				<p></p>
				<a href="#" rel="client" class="aq-sortable-add-new button">Add New</a>
				<p></p>
			</div>
			
			<?php
		}
		
		function item($item = array(), $count = 0) {

			?>
			<li id="sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
				
				<div class="sortable-head cf">
					<div class="sortable-handle">
						<a href="#">Open / Close</a>
					</div>
				</div>
				
				<div class="sortable-body">					

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo">
							Photo <em style="font-size: 0.8em;">(Recommended - 250px x 80px)</em><br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-photo" class="input-full input-upload" value="<?php echo $item['photo'] ?>" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][photo]">
							<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
						</label>
					</div>

					<div class="tab-desc description">
						<label for="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link">
							Link<br/>
							<input type="text" id="<?php echo $this->get_field_id('items') ?>-<?php echo $count ?>-link" class="input-full" name="<?php echo $this->get_field_name('items') ?>[<?php echo $count ?>][link]" value="<?php echo $item['link'] ?>" />
						</label>
					</div>

					<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
				</div>
				
			</li>
			<?php
		}
		
		function block($instance) {
			extract($instance);
			
			$output = '';
			$output .= '<div id="logo-carousel" class="owl-carousel">';

				if (!empty($items)) {
					$i = 1;
					foreach( $items as $item ) {
						$output .= '<div>';
						$output .= (!empty($item['link']) ? '<a href="'.esc_url($item['link']).'">' : '');
                        $output .= ''.(!empty($item['photo']) ? '<img src="'.esc_url($item['photo']).'" class="bounce-in" />' : '');
                        $output .= (!empty($item['link']) ? '</a>' : '');
						$output .= '</div>';
						$i++;
					}
				}
			
			$output .= '</div>';				
			echo $output;
			
		}
		
		/* AJAX add testimonial */
		function add_client_item() {
			$nonce = $_POST['security'];	
			if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
			
			$count = isset($_POST['count']) ? absint($_POST['count']) : false;
			$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
			
			//default key/value for the testimonial
			$item = array(
				'link' => '',
				'photo' => '',
			);
			
			if($count) {
				$this->item($item, $count);
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

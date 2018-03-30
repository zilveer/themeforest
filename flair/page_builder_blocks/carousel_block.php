<?php

class AQ_Slider_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => 'Slider',
			'size' => 'span12',
			'block_description' => 'Add a slider of images<br />into the page.'
		);
		parent::__construct('AQ_Slider_Block', $block_options);
		add_action('wp_ajax_aq_block_slide_add_new', array($this, 'add_slide'));
	}//end construct
	
	function form($instance) {
	
		$defaults = array(
			'tabs' => array(
				1 => array(
					'title' => ''
				)
			),
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>

		<div class="description cf">
			<ul id="aq-sortable-list-<?php echo $block_id ?>" class="aq-sortable-list" rel="<?php echo $block_id ?>">
				<?php
				$tabs = is_array($tabs) ? $tabs : $defaults['tabs'];
				$count = 1;
				foreach($tabs as $tab) {	
					$this->tab($tab, $count);
					$count++;
				}
				?>
			</ul>
			<p></p>
			<a href="#" rel="slide" class="aq-sortable-add-new button"><?php _e('Add New', 'flair'); ?></a>
			<p></p>
		</div>
		
	<?php
	}//end form
	
	function tab($tab = array(), $count = 0) {
			
		?>
		<li id="<?php echo $this->get_field_id('tabs') ?>-sortable-item-<?php echo $count ?>" class="sortable-item" rel="<?php echo $count ?>">
			
			<div class="sortable-head cf">
				<div class="sortable-title">
					<strong>Image</strong>
				</div>
				<div class="sortable-handle">
					<a href="#"><?php _e('Open / Close', 'flair'); ?></a>
				</div>
			</div>
			
			<div class="sortable-body">
				<p class="tab-desc description">
					<label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title">
						Insert an Image (Required)<br/>
						<input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo $count ?>-title" class="input-full input-upload" value="<?php echo $tab['title'] ?>" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo $count ?>][title]" />
						<a href="#" class="aq_upload_button button" rel="image">Upload</a><p></p>
					</label>
				</p>
				<p class="tab-desc description"><a href="#" class="sortable-delete">Delete</a></p>
			</div>
			
		</li>
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		if( $tabs ) :
	?>
		
		<div class="owl-slider-wrapper main">
		  <div class="owl-portfolio-slider owl-carousel">
		  
		  	<?php foreach( $tabs as $tab ) : ?>
		  	  <div class="item"> 
		  	  	<img src="<?php echo esc_url($tab['title']); ?>" alt="<?php echo $block_id; ?>" /> 
		  	  </div>
		  	<?php endforeach; ?>
		  	
		  </div>
		  <div class="owl-custom-nav"> <a class="slider-prev"></a> <a class="slider-next"></a> </div>
		</div>
		
	<?php
		endif;
		
	}//end block
	
	/* AJAX add tab */
	function add_slide() {
		$nonce = $_POST['security'];	
		if (! wp_verify_nonce($nonce, 'aqpb-settings-page-nonce') ) die('-1');
		
		$count = isset($_POST['count']) ? absint($_POST['count']) : false;
		$this->block_id = isset($_POST['block_id']) ? $_POST['block_id'] : 'aq-block-9999';
		
		//default key/value for the tab
		$tab = array(
			'title' => ''
		);
		
		if($count) {
			$this->tab($tab, $count);
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
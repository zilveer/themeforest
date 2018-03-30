<?php

class AQ_Header_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Page Header',
			'size' => 'span12',
			'block_icon' => '<i class="fa fa-cog"></i>',
			'block_description' => 'Use to add a column<br />with text & icon.',
			'resizable' => false
		);
		parent::__construct('aq_header_block', $block_options);
		add_action('wp_ajax_aq_block_slide_add_new', array($this, 'add_slide'));
	}//end construct
	
	function form($instance) {
		
		$defaults = array(
			'tabs' => array(
				1 => array(
					'title' => ''
				)
			),
			'type' => 'pattern',
			'top_small_text' => '',
			'large_text' => '',
			'bottom_small_text' => '',
			'image' => '',
			'youtube' => '',
			'webm' => '',
			'ogg' => '',
			'mpfour' => '',
			'logo' => '',
			'logo_anim_duration' => '3',
			'logo_anim_delay' => '5',			
			'large_text_anim_duration' => '2',
			'large_text_anim_delay' => '3',
			'small_text_anim_duration' => '3',
			'small_text_anim_delay' => '1',
			'top_small_text_anim_delay' => '6',
			'caret_anim_duration' => '1',
			'caret_anim_delay' => '7',
		);
		
		$type_options = array(
			'pattern' => 'Pattern Background',
			'image' => 'Image Background',
			'video' => 'HTML5 Video Background',
			'slideshow' => 'Slideshow Background',
			'slider' => 'Slider Background',
			'youtube' => 'YouTube Background',
			'rain' => 'Rain Background',
			'animated' => 'Animated Fractals Background',
			'colour' => 'Colour Fade Background',
			'shards' => 'Shards Background',
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<h4 class="description section-settings">Settings Required for all Header types.</h4>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Header Type
				<?php echo aq_field_select('type', $block_id, $type_options, $type) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('logo') ?>">
				Intro Titles Logo <code>Optional</code>
				<?php echo aq_field_upload('logo', $block_id, $logo, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('top_small_text') ?>">
				Top Small Text <code>Optional</code>
				<?php echo aq_field_input('top_small_text', $block_id, $top_small_text, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('large_text') ?>">
				Large Text <code>Use a line return to break text into animated sections, 1 return per section</code>
				<?php echo aq_field_textarea('large_text', $block_id, $large_text, $size = 'full', false) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('bottom_small_text') ?>">
				Bottom Small Text <code>Optional</code>
				<?php echo aq_field_input('bottom_small_text', $block_id, $bottom_small_text, $size = 'full') ?>
			</label>
		</p>
		
		<hr />
		
		<h4 class="description section-settings">Settings Required for Pattern, Rain, Image, and YouTube Header types.</h4>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Header Background Image <code>Used by: Pattern, Rain, Image, YouTube, Video header types.</code>
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<hr />
		
		<h4 class="description section-settings">Settings Required for Youtube Header.</h4>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('youtube') ?>">
				Youtube Share URL <code>Youtube Header Option Only. E.g: http://youtu.be/j-mEnMMmSrQ</code>
				<?php echo aq_field_input('youtube', $block_id, $youtube, $size = 'full') ?>
			</label>
		</p>
		
		<hr />
		
		<h4 class="description section-settings">Images for the Slider and Slideshow header types. Drag to reorder.</h4>
		
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
		
		<hr />
		
		<h4 class="description section-settings">Settings for the Video Header</h4>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('webm') ?>">
				.webm Video File URL
				<?php echo aq_field_input('webm', $block_id, $webm, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('ogg') ?>">
				.ogv Video File URL
				<?php echo aq_field_input('ogg', $block_id, $ogg, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('mpfour') ?>">
				.mp4 Video File URL
				<?php echo aq_field_input('mpfour', $block_id, $mpfour, $size = 'full') ?>
			</label>
		</p>

		<hr />

		<h4 class="description section-settings">Animation Settings</h4>

		<p class="description">
			<label for="<?php echo $this->get_field_id('logo_anim_duration') ?>">
				Logo Animation Duration (In Seconds)
				<?php echo aq_field_input('logo_anim_duration', $block_id, $logo_anim_duration, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('logo_anim_delay') ?>">
				Logo Animation Delay (In Seconds)
				<?php echo aq_field_input('logo_anim_delay', $block_id, $logo_anim_delay, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('large_text_anim_duration') ?>">
				Large Text Animation Duration (In Seconds)
				<?php echo aq_field_input('large_text_anim_duration', $block_id, $large_text_anim_duration, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('large_text_anim_delay') ?>">
				Large Text Animation Delay (In Seconds)
				<?php echo aq_field_input('large_text_anim_delay', $block_id, $large_text_anim_delay, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('small_text_anim_duration') ?>">
				Bottom Small Text Animation Duration (In Seconds)
				<?php echo aq_field_input('small_text_anim_duration', $block_id, $small_text_anim_duration, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('small_text_anim_delay') ?>">
				Bottom Small Text Animation Delay (In Seconds)
				<?php echo aq_field_input('small_text_anim_delay', $block_id, $small_text_anim_delay, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('top_small_text_anim_delay') ?>">
				Top Small Text Animation Delay (In Seconds)
				<?php echo aq_field_input('top_small_text_anim_delay', $block_id, $top_small_text_anim_delay, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('caret_anim_duration') ?>">
				Caret Animation Duration (In Seconds)
				<?php echo aq_field_input('caret_anim_duration', $block_id, $caret_anim_duration, $size = 'full') ?>
			</label>
		</p>

		<p class="description">
			<label for="<?php echo $this->get_field_id('caret_anim_delay') ?>">
				Caret Animation Delay (In Seconds)
				<?php echo aq_field_input('caret_anim_delay', $block_id, $caret_anim_delay, $size = 'full') ?>
			</label>
		</p>

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
	}//end tab
	
	function block($instance) {
		extract($instance);
		
		if(!( isset($logo) ))
			$logo = false;
		
		if( $type == 'rain' ){
			wp_enqueue_script( 'ebor-rain', get_template_directory_uri() . '/js/rain/rainyday.js', array('jquery'), false, true  );	
		} elseif( $type == 'shards' ){
			wp_enqueue_script( 'ebor-shards', get_template_directory_uri() . '/js/shards/shards.js', array('jquery'), false, true  );
		} elseif( $type == 'animated' ){
			wp_enqueue_script( 'ebor-fss', get_template_directory_uri() . '/js/animated/fss.js', array('jquery'), false, true  );
		} elseif( $type == 'youtube' ){
			wp_enqueue_script( 'ebor-ytplater', get_template_directory_uri() . '/js/youtube/YTPlayer.js', array('jquery'), false, true  );
		} elseif( $type == 'slider' ){
			wp_enqueue_script( 'ebor-slider-1', get_template_directory_uri() . '/js/slider/flickerplate.min.js', array('jquery'), false, true  );
			wp_enqueue_script( 'ebor-slider-2', get_template_directory_uri() . '/js/slider/jquery-finger-v0.1.0.min.js', array('jquery'), false, true  );
		}
		
		$lines = preg_split( '/\r\n|\r|\n/', $large_text );
		$large_text_output = false;
		
		/**
		 * Get header template depending on our options.
		 * Using this function allows the header files to be more easily overridden by a child-theme.
		 * It's also a bit more organised don't you think?
		 */
		include( locate_template('inc/content-header-' . $type . '.php') );
			
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
	
}//end class
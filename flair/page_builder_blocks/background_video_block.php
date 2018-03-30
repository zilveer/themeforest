<?php
class AQ_Background_Video_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Background Video',
			'size' => 'span12',
			'block_icon' => '<i class="fa fa-font"></i>',
			'block_description' => 'Use to add Text,<br />HTML or shortcodes.',
			'resizable' => false
		);
		
		//create the block
		parent::__construct('aq_background_video_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
			'webm' => '',
			'ogg' => '',
			'mpfour' => '',
			'image' => ''
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
	?>
		
		<p class="description">Any required videos should be uploaded to the WordPress Media gallery directly, or by FTP, then copy the URLs to this block. Please ensure all video types are used for cross browser compatibility.</p>
		
		<hr />
		
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
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('image') ?>">
				Poster Image
				<?php echo aq_field_upload('image', $block_id, $image, $media_type = 'image') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content on top of video
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full', true) ?>
			</label>
		</p>
		
	<?php
	}// end form
	
	function block($instance) {
		extract($instance);
	?>
		
		<section  class="wallpapered video-section" data-wallpaper-options='{"source":{
				"webm":"<?php echo $webm; ?>",
				"mp4":"<?php echo $mpfour; ?>",
				"ogg":"<?php echo $ogg; ?>",
				"poster":"<?php echo $image; ?>"}}'>
		
		<div class="video_overlay">	
			<div id="video_content">
				<div class="col-sm-12 col-lg-10 col-lg-offset-1 text-center wow fadeInUp" data-wow-offset="80" data-wow-duration="2s">
					<?php echo htmlspecialchars_decode($text); ?>
				</div>
			</div>
		</div>
				
		</section>
		
	<?php
	}//end block
	
}//end class
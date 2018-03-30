<?php
/** Video block **/
class Video_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Video',
			'size' => 'span6',
		);
		
		//create the block
		parent::__construct('video_block', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'title' => '',
			'height' => '350',
			'video' => '',
			'type' => 'youtube'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);

		$videotype = array(
			'youtube' => 'Youtube',
			'vimeo' => 'Vimeo',
		);
		
		?>
		<div class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</div>
		
		<div class="description">
			<label for="<?php echo $this->get_field_id('video') ?>">
				Video URL
				<?php echo aq_field_input('video', $block_id, $video, $size = 'full') ?>
				<em style="font-size: 0.8em; padding-left: 5px;">(example: <code>http://vimeo.com/51333291</code> or <code>http://youtu.be/iOiE6XMy0y8</code>)</em>
			</label>
		</div>

		<div class="description half">
			<label for="<?php echo $this->get_field_id('type') ?>">
				Video Type<br/>
				<?php echo aq_field_select('type', $block_id, $videotype, $type); ?>
			</label>
		</div>

		<div class="description half last">
			<label for="<?php echo $this->get_field_id('height') ?>">
				Video Height
				<?php echo aq_field_input('height', $block_id, $height, $size = 'full') ?>
			</label>
		</div>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);

		$video = esc_url($video);

		switch ($type) {
			case 'youtube':
				$youtube = array(
					"http://youtu.be/",
					"http://www.youtube.com/watch?v=",
					"http://www.youtube.com/embed/",
					"https://youtu.be/",
					"https://www.youtube.com/watch?v=",
					"https://www.youtube.com/embed/"
					);
				$videonum = str_replace($youtube, "", $video);
				$videocode = 'https://www.youtube.com/embed/' . $videonum;
				break;
			case 'vimeo':
				$vimeo = array(
					"http://vimeo.com/",
					"http://player.vimeo.com/video/",
					"https://vimeo.com/",
					"https://player.vimeo.com/video/"
					);
				$videonum = str_replace($vimeo, "", $video);
				$videocode = 'http://player.vimeo.com/video/' . $videonum;
				break;
		}

		$output = '';

		$output .= '<div class="video-box'.$class.' fade-up">';
		$output .= '<iframe src="'.$videocode.'" width="100%" height="'.esc_attr($height).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		$output .= '</div>';


		echo $output;
	}
	
}
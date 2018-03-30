<?php
class AnythingSlider extends BaseSlider {
	public $id = 'anything';
	private $width = 960;
	private $height = 400;
	private $default_position;
	private $default_text_position;
	private $auto_play;
	private $flash_markup = '<object type="application/x-shockwave-flash" style="width:{width}px; height:{height}px;" data="{path}"><param name="wmode" value="{wmode}" /><param name="movie" value="{path}" /></object>';
	private $quicktime_markup = '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>';

	public function __construct() {
		add_image_size('slider_anything_big', $this->width, $this->height, true);
		add_image_size('slider_anything_small', 660, 400, true);
		$this->auto_play = get_option('anything_auto_play');
		$this->default_position = get_option('anything_default_cation_position');
		$this->default_text_position = get_option('anything_default_text_position');
		parent::__construct();
	}

	public function get_name() {
		return __('Anything', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_anything', get_bloginfo('template_directory') . '/stylesheets/anything-slider.css');
		wp_register_script('js_slider_anything', get_bloginfo('template_directory') . '/js/jquery.anythingslider.js', array('jquery'));
		wp_register_script('js_easing', get_bloginfo('template_directory') . '/js/jquery.easing.1.3.js', array('jquery'));
		wp_enqueue_style('css_slider_anything');
		wp_enqueue_script('js_slider_anything');
		wp_enqueue_script('js_easing');
	}

	public function scripts_init() {
 ?>
function formatText(index, panel) {
	return index + "";
};

jQuery(function () {
	jQuery('#anythingSlider').css('display', 'block');
	jQuery('#anythingSlider').anythingSlider({
		width:            <?php echo $this->width ?>,
		height:           <?php echo $this->height ?>,
		playRtl:          <?php echo get_option_str('anything_playRtl'); ?>,
		delay:            <?php echo get_option('anything_delay'); ?>,
		animationTime:    <?php echo get_option('anything_animationTime'); ?>,
		easing:           '<?php echo get_option('anything_easing'); ?>',
		buildArrows:      <?php echo get_option_str('anything_buildArrows'); ?>,
		toggleArrows:     <?php echo (get_option('anything_buildArrows')) ? get_option_str('anything_toggleArrows', false) : 'false'; ?>,
		buildNavigation:  <?php echo get_option_str('anything_buildNavigation'); ?>,
		toggleControls:   <?php echo get_option_str('anything_toggleControls'); ?>,
		autoPlay:         <?php echo get_option_str('anything_autoPlay'); ?>,
		pauseOnHover:     <?php echo get_option_str('anything_pauseOnHover'); ?>,
		resumeOnVideoEnd: <?php echo get_option_str('anything_resumeOnVideoEnd'); ?>,
		stopAtEnd:        <?php echo get_option_str('anything_stopAtEnd'); ?>,
		navigationFormatter: formatText
	});
	function formatText(index, panel) {
		return '';
	}
  });
<?php
	}

	protected function get_caption() {
		if (!$this->show_caption)
			return;
		$caption = parent::get_caption();
		if (empty($caption))
			return;
		$position = get_post_meta(get_the_ID(), 'anything_caption_position', true);
		if (empty($position))
			$position = $this->default_position;
		return "<div class=\"anything_caption caption_{$position}\">{$caption}</div>";
	}

	private function getLinkType($url){
		if (preg_match('/youtube\.com\/watch/i', $url)) {
			return 'youtube';
		}else if (preg_match('/vimeo\.com/i', $url)) {
			return 'vimeo';
		}else if (preg_match('/dailymotion\.com/i', $url)) {
			return 'daily';
		}else if(strpos($url, '.mov') !== false){
			return 'quicktime';
		}else if(strpos($url, '.swf') !== false){
			return 'flash';
		}else{
			return false;
		};
	}

	private function getVideoObject($url) {
		$video_type = $this->getLinkType($url);
		if ($video_type === false)
			return;
		$out = '';
		switch ($video_type) {
			case 'youtube':
				$url = parse_url($url);
				parse_str($url['query'], $vars);
				$move = "http://www.youtube.com/v/{$vars['v']}";
				if ($this->auto_play)
					$move .= '&autoplay=1';
				$out = str_replace(array('{width}', '{height}', '{wmode}', '{path}'), array($this->width, $this->height, 'opaque', $move), $this->flash_markup);
				break;
			case 'vimeo':
				$move_id = str_replace('http://vimeo.com/','', $url);
				$move = "http://vimeo.com/moogaloop.swf?clip_id={$move_id}";
				if ($this->auto_play)
					$move .= '&autoplay=1';
				$out = str_replace(array('{width}', '{height}', '{wmode}', '{path}'), array($this->width, $this->height, 'opaque', $move), $this->flash_markup);
				break;
			case 'daily':
				$move_id = substr($url, strpos($url, 'dailymotion.com'), strlen($url));
				$move_id = str_replace('dailymotion.com/video/','', $move_id);
				$move_id = substr($move_id, 0, strpos($move_id, '_'));
				$move = "http://www.dailymotion.com/swf/video/{$move_id}?additionalInfos=0";
				$out = str_replace(array('{width}', '{height}', '{wmode}', '{path}'), array($this->width, $this->height, 'opaque', $move), $this->flash_markup);
				break;
			case 'quicktime':
				$out = str_replace(array('{width}', '{height}', '{wmode}', '{path}', '{autoplay}'), array($this->width, $this->height, 'opaque', $url, $this->auto_play), $this->quicktime_markup);
				break;
			case 'flash':
				$flash_vars = substr($url, strpos($url, 'flashvars') + 10, strlen($url));
				$filename = substr($url, 0, strpos($url, '?'));
				$out = str_replace(array('{width}', '{height}', '{wmode}', '{path}'), array($this->width, $this->height, 'opaque', $filename . '?' . $flash_vars), $this->flash_markup);
				break;
		}
		return $out;
	}

	public function render($loop) {
?>
		<ul id="anythingSlider" style="display:none;">
			<?php
				while ($loop->have_posts()) :
				$loop->the_post();
				$this->target_link = metaboxesGenerator::the_superlink();
				$slide_type = get_post_meta(get_the_ID(), 'anything_slide_type', true);
				$video_link = get_post_meta(get_the_ID(), 'anything_video_link', true);
				if (!empty($video_link))
					$slide_type = 'video';
			?>
			<li><?php
				switch ($slide_type) {
					case 'video':
						echo $this->getVideoObject($video_link);
						break;
					case 'text':
						the_content();
						break;
					case 'image_text':
						if (!get_post_thumbnail_id())
							continue;
						$caption = parent::get_caption();
						$position = get_post_meta(get_the_ID(), 'anything_text_position', true);
						if (empty($position))
							$position = $this->default_text_position;
					?>
						<div class="text_slide_<?php echo $position; ?>">
							<div class="pic"><?php the_post_thumbnail('slider_anything_small', array('title' => false)); ?></div>
							<div class="txt"><?php echo $caption; ?></div>
							<div class="clear"></div>
						</div>
					<?php
						break;
					case 'image':
					default:
						if (!get_post_thumbnail_id())
							continue;
						echo $this->get_caption();
						the_post_thumbnail('slider_anything_big', array('title' => false));
						break;
				}
			?></li>
			<?php endwhile; ?>
		</ul>
<?php
	}

	public function options() {
		ap_add_section('anything_slider', __('Anything Slider', TEMPLATENAME));
		ap_add_checkbox(array(
			'name' => 'anything_playRtl',
			'title' => __('Transition Right To Left', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this for transition right-to-left.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'anything_delay',
			'title' => __('Delay', TEMPLATENAME),
			'default' => 3000,
			'desc' => __('ms. How long between slideshow transitions in AutoPlay mode.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'anything_animationTime',
			'title' => __('Animation Speed', TEMPLATENAME),
			'default' => 600,
			'desc' => __('ms. How long the slideshow transition takes.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'anything_easing',
			'title' => __('Transition easing effect', TEMPLATENAME),
			'default' => 'swing',
			'options' => array(
				'linear' => 'linear',
				'swing' => 'swing',
				'easeInQuad' => 'easeInQuad',
				'easeOutQuad' => 'easeOutQuad',
				'easeInOutQuad' => 'easeInOutQuad',
				'easeInCubic' => 'easeInCubic',
				'easeOutCubic' => 'easeOutCubic',
				'easeInOutCubic' => 'easeInOutCubic',
				'easeInQuart' => 'easeInQuart',
				'easeOutQuart' => 'easeOutQuart',
				'easeInOutQuart' => 'easeInOutQuart',
				'easeInQuint' => 'easeInQuint',
				'easeOutQuint' => 'easeOutQuint',
				'easeInOutQuint' => 'easeInOutQuint',
				'easeInSine' => 'easeInSine',
				'easeOutSine' => 'easeOutSine',
				'easeInOutSine' => 'easeInOutSine',
				'easeInExpo' => 'easeInExpo',
				'easeOutExpo' => 'easeOutExpo',
				'easeInOutExpo' => 'easeInOutExpo',
				'easeInCirc' => 'easeInCirc',
				'easeOutCirc' => 'easeOutCirc',
				'easeInOutCirc' => 'easeInOutCirc',
				'easeInElastic' => 'easeInElastic',
				'easeOutElastic' => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack' => 'easeInBack',
				'easeOutBack' => 'easeOutBack',
				'easeInOutBack' => 'easeInOutBack',
				'easeInBounce' => 'easeInBounce',
				'easeOutBounce' => 'easeOutBounce',
				'easeInOutBounce' => 'easeInOutBounce'
			),
			'desc' => __('Select which easing effect to use for transition.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_buildArrows',
			'title' => __('Build arrows', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this for builds the forwards and backwards buttons.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_toggleArrows',
			'title' => __('Toggle arrows', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this for side navigation arrows will slide out on hovering & hide @ other times.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_buildNavigation',
			'title' => __('Build navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this for builds a list of anchor links to link to each slide.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_toggleControls',
			'title' => __('Toggle controls', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this for show navigation on hover and hide other.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_autoPlay',
			'title' => __('Auto play', TEMPLATENAME),
			'default' => true,
			'desc' => __('This turns off the entire slideshow FUNCTIONALY, not just if it starts running or not.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_pauseOnHover',
			'title' => __('Pause on hover', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this for the slideshow will pause on hover.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_resumeOnVideoEnd',
			'title' => __('Resume on video end', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this for pause the autoplay until the youtube video is complete.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'anything_stopAtEnd',
			'title' => __('Stop at end', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this for the slideshow will stop on the last slide.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'anything_default_cation_position',
			'title' => __('Default caption position', TEMPLATENAME),
			'default' => 'left',
			'options' => array(
				'top' => __('Top', TEMPLATENAME),
				'bottom' => __('Bottom', TEMPLATENAME),
				'left' => __('Left', TEMPLATENAME),
				'right' => __('Right', TEMPLATENAME),
			),
			'desc' => __('Choose a default caption position.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'anything_default_text_position',
			'title' => __('Default text position', TEMPLATENAME),
			'default' => 'left',
			'options' => array(
				'left' => __('Left', TEMPLATENAME),
				'right' => __('Right', TEMPLATENAME),
			),
			'desc' => __('Choose a default text position.', TEMPLATENAME),
		));


		$config = array(
			'title' => __('Anything-Slider Options', TEMPLATENAME),
			'id' => 'slideshow_anything',
			'pages' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
		$options = array(
			array(
				'name' => __('Type', TEMPLATENAME),
				'id' => 'anything_slide_type',
				'default' => 'image',
				'type' => 'select',
				'options' => array(
					'image' => __('Image', TEMPLATENAME),
					'image_text' => __('Image with text', TEMPLATENAME),
					'text' => __('Only text', TEMPLATENAME),
				),
			),
			array(
				'name' => __('Caption Position', TEMPLATENAME),
				'id' => 'anything_caption_position',
				'default' => 'top',
				'type' => 'select',
				'options' => array(
					'top' => __('Top', TEMPLATENAME),
					'bottom' => __('Bottom', TEMPLATENAME),
					'left' => __('Left', TEMPLATENAME),
					'right' => __('Right', TEMPLATENAME),
				),
			),
			array(
				'name' => __('Text Position', TEMPLATENAME),
				'id' => 'anything_text_position',
				'default' => 'left',
				'type' => 'select',
				'options' => array(
					'left' => __('Left', TEMPLATENAME),
					'right' => __('Right', TEMPLATENAME),
				),
			),
			array(
				'name' => __('Video (optional)', TEMPLATENAME),
				'desc' => sprintf('%s %s:<br/>%s<br/>%s<br/>%s<br/>%s<br/>%s', __('Supported YouTube, Vimeo, Dailymotion or Flash. (If this option is set then the above will be ignored)', TEMPLATENAME), __('For example', TEMPLATENAME), 'http://www.youtube.com/watch?v=bhzJO34SCoc', 'http://vimeo.com/6698094', 'http://www.dailymotion.com/video/xuhuv_within-temptation-ice-queen_music', '*.mov', '*.swf'),
				'id' => 'anything_video_link',
				'default' => '',
				'type' => 'text',
				'class' => 'large-text',
			),
		);
		new metaboxesGenerator($config,$options);
	}
}
?>

<?php
class NivoSlider extends BaseSlider {
	public $id = 'nivo';
	private $captions = '';
	private $default_position;

	public function __construct() {
		add_image_size('slider_nivo', 960, 400, true);
		$this->default_position = get_option('nivo_slider_caption_position');
		parent::__construct();
	}

	public function get_name() {
		return __('Nivo', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_nivo', get_bloginfo('template_directory') . '/stylesheets/nivo-slider.css');
		wp_register_script('js_slider_nivo', get_bloginfo('template_directory') . '/js/jquery.nivo.slider.js', array('jquery'));
		wp_register_script('js_easing', get_bloginfo('template_directory') . '/js/jquery.easing.1.3.js', array('jquery'));
		wp_enqueue_style('css_slider_nivo');
		wp_enqueue_script('js_slider_nivo');
		wp_enqueue_script('js_easing');
	}

	public function scripts_init() {
?>
jQuery(window).load(function() {
	jQuery('#nivo-slider').nivoSlider({
		effect:          '<?php echo get_option('nivo_slider_effect'); ?>',
		slices:          <?php echo get_option('nivo_slider_slices'); ?>,
		animSpeed:       <?php echo get_option('nivo_slider_speed'); ?>,
		pauseTime:       <?php echo get_option('nivo_slider_pause'); ?>,
		directionNav:    <?php echo get_option_str('nivo_slider_direction_nav'); ?>,
		directionNavHide:<?php echo get_option_str('nivo_slider_direction_nav_hide'); ?>,
		controlNav:      <?php echo get_option_str('nivo_slider_control_nav'); ?>,
		controlNavThumbs: <?php echo get_option_str('nivo_slider_thumb'); ?>,
		controlNavThumbsFromAlt: <?php echo get_option_str('nivo_slider_thumb'); ?>,
		pauseOnHover:    <?php echo get_option_str('nivo_slider_pause_on_hover'); ?>,
		manualAdvance:   <?php echo get_option_str('nivo_slider_manual_advance'); ?>,
		captionOpacity:  <?php echo get_option('nivo_slider_caption_opacity')/100; ?>,
		captionEasing:   '<?php echo get_option('nivo_slider_caption_easing'); ?>'
	});
	<?php if (!get_option('nivo_slider_thumb')): ?>
	jQuery('div.nivo-controlNav').css('margin-left', function(index, val){
		return -this.offsetWidth/2;
	}).css('display', 'none');
	<?php endif; ?>
	jQuery('#nivo-slider').hover(
		function() {
			jQuery(this).find('.nivo-controlNav').slideDown(200);
		},
		function() {
			jQuery(this).find('.nivo-controlNav').slideUp(200);
		 }
	);
});
<?php
	}

	protected function get_caption() {
		if (!$this->show_caption)
			return;
		$caption = parent::get_caption();
		if (empty($caption))
			return;
		$position = get_post_meta(get_the_ID(), 'nivo_caption_position', true);
		if (empty($position))
			$position = $this->default_position;
		$this->captions .= "<div id=\"slide-".get_the_ID()."\" class=\"nivo-html-caption\" data-position=\"{$position}\">{$caption}</div>";
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="nivo-slider">
		<?php
			while ($loop->have_posts()) {
				$loop->the_post();
				if (!get_post_thumbnail_id())
					continue;
				$this->target_link = metaboxesGenerator::the_superlink();
				$full_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'slider_nivo');
				$src = get_bloginfo('template_url') . "/timthumb.php?src={$full_thumbnail[0]}&w=80&h=50&zc=1";
				$this->get_caption();
				the_post_thumbnail('slider_nivo', array('alt' => $src, 'title' => '#slide-'.get_the_ID()));
			}
		?>
	</div>
	<?php echo $this->captions; ?>
</div>
<?php
	}

	public function options() {
		ap_add_section('nivo_slider', __('Nivo slider', TEMPLATENAME));
		ap_add_select(array(
			'name' => 'nivo_slider_effect',
			'title' => __('Sliding effect', TEMPLATENAME),
			'default' => 'random',
			'options' => array(
				'sliceDown' => __('Down', TEMPLATENAME),
				'sliceDownLeft' => __('DownLeft', TEMPLATENAME),
				'sliceUp' => __('Up', TEMPLATENAME),
				'sliceUpLeft' => __('UpLeft', TEMPLATENAME),
				'sliceUpDown' => __('UpDown', TEMPLATENAME),
				'sliceUpDownLeft' => __('UpDownLeft', TEMPLATENAME),
				'fold' => __('Fold', TEMPLATENAME),
				'fade' => __('Fade', TEMPLATENAME),
				'random' => __('Random', TEMPLATENAME),
			),
			'desc' => __('Choose an effect of changing slides.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'nivo_slider_slices',
			'title' => __('Number of slices', TEMPLATENAME),
			'default' => '15',
			'class' => 'small-text',
			'desc' => __('Number of slices in slide.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'nivo_slider_speed',
			'title' => __('Animation speed', TEMPLATENAME),
			'default' => '600',
			'desc' => __('ms. Type an amount of time slide transition lasts.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'nivo_slider_pause',
			'title' => __('Pause time', TEMPLATENAME),
			'default' => '3000',
			'desc' => __('ms. Type an amount of time slide transition lasts.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_direction_nav',
			'title' => __('Direction navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to display "Prev" & "Next" buttons.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_direction_nav_hide',
			'title' => __('Direction navigation hide', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this to show "Prev" & "Next" buttons when mouse is over slides.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_control_nav',
			'title' => __('Control navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to display control navigation (bullets).', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_thumb',
			'title' => __('Show thumbnails', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this if you want shwow thumbnail control navigation.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_pause_on_hover',
			'title' => __('Pause on mouse hover', TEMPLATENAME),
			'default' => true,
			'desc' => __('Determines if slideshow will pause while mouse is hovering over slideshow.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'nivo_slider_manual_advance',
			'title' => __('Manual transitions', TEMPLATENAME),
			'default' => false,
			'desc' => __('Check this if you want force manual transitions.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'nivo_slider_caption_easing',
			'title' => __('Caption easing effect', TEMPLATENAME),
			'default' => 'linear',
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
			'desc' => __('Select which easing effect to use for caption.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'nivo_slider_caption_opacity',
			'title' => __('Caption opacity', TEMPLATENAME),
			'default' => '80',
			'desc' => __('% The Opacity of Caption with it\'s background.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_select(array(
			'name' => 'nivo_slider_caption_position',
			'title' => __('Default caption position', TEMPLATENAME),
			'default' => 'left',
			'options' => array(
				'left' => __('Left', TEMPLATENAME),
				'right' => __('Right', TEMPLATENAME),
			),
			'desc' => __('Choose a default caption position.', TEMPLATENAME),
		));

		$config = array(
			'title' => __('Nivo Slider Options', TEMPLATENAME),
			'id' => 'nivopostoptions',
			'pages' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
		$options = array(
			array(
				'name' => __('Caption Position', TEMPLATENAME),
				'desc' => __('Position of caption on the slide.', TEMPLATENAME),
				'id' => 'nivo_caption_position',
				'default' => '',
				'type' => 'select',
				'options' => array(
					'right' => __('Right', TEMPLATENAME),
					'left' => __('Left', TEMPLATENAME),
				),
				'empty' => __('Default', TEMPLATENAME),
			),
		);
		new metaboxesGenerator($config,$options);
	}
}
?>

<?php
class RoundAboutSlider extends BaseSlider {
	public $id = 'roundabout';

	public function __construct() {
		add_image_size('slider_roundabout', 400, 220, true);
		parent::__construct();
	}

	public function get_name() {
		return __('RoundAbout', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_roundabout', get_bloginfo('template_directory') . '/stylesheets/roundabout.css');
		wp_register_script('js_slider_roundabout', get_bloginfo('template_directory') . '/js/jquery.roundabout.js', array('jquery'));
		wp_register_script('js_easing', get_bloginfo('template_directory') . '/js/jquery.easing.1.3.js', array('jquery'));
		wp_register_script('js_roundabout_shapes', get_bloginfo('template_directory') . '/js/jquery.roundabout-shapes.min.js', array('jquery'));
		wp_enqueue_style('css_slider_roundabout');
		wp_enqueue_script('js_slider_roundabout');
		wp_enqueue_script('js_easing');
		wp_enqueue_script('js_roundabout_shapes');
	}

	public function scripts_init() {
 ?>
jQuery(document).ready(function() {
	jQuery('#roundabout').css('display', 'block');
	jQuery('#roundabout ul').roundabout({
		bearing:       0.0,
		tilt:          0.0,
		minZ:          80,
		maxZ:          100,
		minOpacity:    0.7,
		maxOpacity:    1.0,
		minScale:      0.4,
		maxScale:      1.0,
		duration:      <?php echo get_option('roundabout_slider_speed'); ?>,
		easing:        '<?php echo get_option('roundabout_slider_easing'); ?>',
		clickToFocus:  <?php echo get_option_str('roundabout_slider_tofocus'); ?>,
		focusBearing:  0.0,
		shape:         'square',
		childSelector: 'li',
		startingChild: 6,
		reflect:       false
	});
});
<?php
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="roundabout" style="display:none;">
		<ul>
			<?php
				while ($loop->have_posts()):
				$loop->the_post();
				if (!get_post_thumbnail_id())
					continue;
				$this->target_link = metaboxesGenerator::the_superlink();
			?>
			<li><?php the_post_thumbnail('slider_roundabout', array('title' => false)); ?></li>
			<?php endwhile; ?>
		</ul>
	</div>
</div>
<?php
	}

	public function options() {
		ap_add_section('roundabout_slider', __('Roundabout slider', TEMPLATENAME));
		ap_add_input(array(
			'name' => 'roundabout_slider_speed',
			'title' => __('Animation speed', TEMPLATENAME),
			'default' => '800',
			'desc' => __('ms. The length of time that all animations take to complete by default.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'roundabout_slider_tofocus',
			'title' => __('Click to focus', TEMPLATENAME),
			'default' => true,
			'desc' => __('If true, will disable any click events on elements within the moving element that was clicked. Once the element is in focus, click events will no longer be blocked.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'roundabout_slider_easing',
			'title' => __('Easing animation', TEMPLATENAME),
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
			'desc' => __('Select which easing effect to use.', TEMPLATENAME),
		));
	}
}
?>

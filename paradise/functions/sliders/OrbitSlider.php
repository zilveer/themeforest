<?php
class OrbitSlider extends BaseSlider {
	public $id = 'orbit';
	private $captions = '';

	public function __construct() {
		add_image_size('slider_orbit', 960, 400, true);
		parent::__construct();
	}

	public function get_name() {
		return __('Orbit', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_orbit', get_bloginfo('template_directory') . '/stylesheets/orbit.css');
		wp_register_script('js_slider_orbit', get_bloginfo('template_directory') . '/js/jquery.orbit.js', array('jquery'));
		wp_enqueue_style('css_slider_orbit');
		wp_enqueue_script('js_slider_orbit');
	}

	public function scripts_init() {
 ?>
jQuery(window).load(function() {
	jQuery('#orbit-slider').orbit({
		'animation' : '<?php echo get_option('orbit_slider_animation'); ?>',
		'animationSpeed' : <?php echo get_option('orbit_slider_animation_speed'); ?>,
		'advanceSpeed' : <?php echo get_option('orbit_slider_advance_speed'); ?>,
		'startClockOnMouseOut' : <?php echo get_option_str('orbit_slider_mouse_out'); ?>,
		'startClockOnMouseOutAfter' : <?php echo get_option('orbit_slider_mouse_out_after'); ?>,
		'directionalNav' : <?php echo get_option_str('orbit_slider_direction_nav'); ?>,
		'captions' : <?php echo get_option_str('slider_caption'); ?>,
		'captionAnimationSpeed' : <?php echo get_option('orbit_slider_captions_speed'); ?>,
		'timer' : <?php echo get_option_str('orbit_slider_timer'); ?>,
		'bullets': <?php echo get_option_str('orbit_slider_bullets'); ?>
	});
});
<?php
	}

	protected function get_caption() {
		if (!$this->show_caption)
			return;
		$caption = parent::get_caption();
		if (empty($caption))
			return;
		$this->captions .= "<span class=\"orbit-caption\" id=\"post".get_the_ID()."\">{$caption}</span>";
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="orbit-slider">
		<?php
			while ($loop->have_posts()) {
				$loop->the_post();
				if (!get_post_thumbnail_id())
					continue;
				$this->target_link = metaboxesGenerator::the_superlink();
				the_post_thumbnail('slider_orbit', array('title' => false, 'alt' => 'post'.get_the_ID()));
				$this->get_caption();
			}
			echo $this->captions;
		?>
	</div>
</div>
<?php
	}

	public function options() {
		ap_add_section('orbit_slider', __('Orbit slider', TEMPLATENAME));
		ap_add_select(array(
			'name' => 'orbit_slider_animation',
			'title' => __('Type of animation', TEMPLATENAME),
			'default' => 'fade',
			'options' => array(
				'fade' => __('Fade', TEMPLATENAME),
				'horizontal-slide' => __('Horizontal', TEMPLATENAME),
				'vertical-slide' => __('Vertical', TEMPLATENAME),
			),
			'desc' => __('Choose an effect of changing slides.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'orbit_slider_animation_speed',
			'title' => __('Animation speed', TEMPLATENAME),
			'default' => '1500',
			'desc' => __('ms. How fast animations are.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'orbit_slider_direction_nav',
			'title' => __('Direct navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to display "Prev" & "Next" buttons.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'orbit_slider_bullets',
			'title' => __('Control navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to display control navigation (bullets).', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'orbit_slider_timer',
			'title' => __('Use auto transition', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to enable auto transition slides.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'orbit_slider_advance_speed',
			'title' => __('Auto transition pause', TEMPLATENAME),
			'default' => '4000',
			'desc' => __('ms. If auto transition is enabled, time between transitions.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'orbit_slider_mouse_out',
			'title' => __('Continue on mouse over', TEMPLATENAME),
			'default' => true,
			'desc' => __('Continue on mouse over if auto transition is enabled.', TEMPLATENAME)
		));
		ap_add_input(array(
			'name' => 'orbit_slider_mouse_out_after',
			'title' => __('Pause after mouse over', TEMPLATENAME),
			'default' => '3000',
			'desc' => __('ms. How long after mouseout timer should continue.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'orbit_slider_captions_speed',
			'title' => __('Caption animate speed', TEMPLATENAME),
			'default' => '600',
			'desc' => __('ms. How quickly to animate in caption on load and between captioned and uncaptioned photos.', TEMPLATENAME),
			'class' => 'small-text',
		));
	}
}
?>

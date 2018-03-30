<?php
class Serie3Slider extends BaseSlider {
	public $id = 'serie3';
	private $default_position;

	public function __construct() {
		add_image_size('slider_serie3', 960, 400, true);
		$this->default_position = get_option('s3_slider_default_cation_position');
		parent::__construct();
	}

	public function get_name() {
		return __('Serie3', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_s3', get_bloginfo('template_directory') . '/stylesheets/s3slider.css');
		wp_register_script('js_slider_s3', get_bloginfo('template_directory') . '/js/s3Slider.js', array('jquery'));
		wp_enqueue_style('css_slider_s3');
		wp_enqueue_script('js_slider_s3');
	}

	public function scripts_init() {
?>
jQuery(document).ready(function($) {
	$('#s3slider').s3Slider({
		timeOut: <?php echo get_option('s3_slider_time_out'); ?>
	});
});
<?php
	}

	protected function get_caption($i = 0) {
		$caption = parent::get_caption();
		$position = get_post_meta(get_the_ID(), 's3_caption_position', true);
		if (empty($position))
			$position = $this->default_position;
		if ($position == 'left-right') {
			($i % 2 == 0) ? $position = 'right' : $position = 'left';
		}
		return "<span class=\"s3slider-{$position}\">{$caption}</span>";
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="s3slider">
		<ul id="s3sliderContent">
			<?php
				$i = 0;
				while ($loop->have_posts()) :
					$loop->the_post();
					if (!get_post_thumbnail_id())
						continue;
					$this->target_link = metaboxesGenerator::the_superlink();
					$i++;
			?>
			<li class="s3sliderImage">
				<?php
					the_post_thumbnail('slider_serie3', array('title' => false));
					echo $this->get_caption($i);
				?>
			</li>
			<?php endwhile; ?>
			<div class="clear s3sliderImage"></div>
		</ul>
	</div>
</div>
<?php
	}

	public function options() {
		ap_add_section('s3_slider', __('Serie3 slider', TEMPLATENAME));
		ap_add_select(array(
			'name' => 's3_slider_default_cation_position',
			'title' => __('Default caption position', TEMPLATENAME),
			'default' => 'left-right',
			'options' => array(
				'top' => __('Top', TEMPLATENAME),
				'left' => __('Left', TEMPLATENAME),
				'right' => __('Right', TEMPLATENAME),
				'left-right' => __('Left & Right', TEMPLATENAME),
				'bottom' => __('Bottom', TEMPLATENAME),
			),
			'desc' => sprintf('%s <b>%s:</b> %s', __('Choose a default caption position.', TEMPLATENAME), __('Notice', TEMPLATENAME), __('This slider does not support disable captions.', TEMPLATENAME)),
		));
		ap_add_input(array(
			'name' => 's3_slider_time_out',
			'title' => __('Pause transitions', TEMPLATENAME),
			'default' => '3000',
			'class' => 'small-text',
			'desc' => __('ms. Set pause between transitions.', TEMPLATENAME),
		));
		$config = array(
			'title' => __('Serie3 Slider Options', TEMPLATENAME),
			'id' => 's3postoptions',
			'pages' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
		$options = array(
			array(
				'name' => __('Caption Position', TEMPLATENAME),
				'desc' => __('Position of caption on the slide.', TEMPLATENAME),
				'id' => 's3_caption_position',
				'default' => '',
				'type' => 'select',
				'options' => array(
					'top' => __('Top', TEMPLATENAME),
					'right' => __('Right', TEMPLATENAME),
					'bottom' => __('Bottom', TEMPLATENAME),
					'left' => __('Left', TEMPLATENAME),
				),
				'empty' => __('Default', TEMPLATENAME),
			),
		);
		new metaboxesGenerator($config,$options);
	}
}
?>

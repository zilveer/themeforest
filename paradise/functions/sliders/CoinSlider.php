<?php
class CoinSlider extends BaseSlider {
	public $id = 'coin';
	private $default_position;

	public function __construct() {
		add_image_size('slider_coin', 960, 400, true);
		$this->default_position = get_option('coin_slider_default_cation_position');
		parent::__construct();
	}

	public function get_name() {
		return __('Coin', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_coin', get_bloginfo('template_directory') . '/stylesheets/coin-slider.css');
		wp_register_script('js_slider_coin', get_bloginfo('template_directory') . '/js/coin-slider.js', array('jquery'));
		wp_enqueue_style('css_slider_coin');
		wp_enqueue_script('js_slider_coin');
	}

	public function scripts_init() {
 ?>
jQuery(document).ready(function() {
	jQuery('#coin-slider').css('display', 'block');
	jQuery('#coin-slider').coinslider({
		width:      960, // width of slider panel
		height:     400, // height of slider panel
		spw:        <?php echo get_option('coin_slider_squares_width'); ?>,
		sph:        <?php echo get_option('coin_slider_squares_height'); ?>,
		delay:      <?php echo get_option('coin_slider_delay'); ?>,
		sDelay:     <?php echo get_option('coin_slider_sdelay'); ?>,
		opacity:    <?php echo get_option('coin_slider_opacity')/100; ?>,
		titleSpeed: <?php echo get_option('coin_slider_title_speed'); ?>,
		effect:     '<?php echo get_option('coin_slider_effect'); ?>',
		navigation: <?php echo get_option_str('coin_slider_navigation'); ?>,
		links :     <?php echo get_option_str('slider_link'); ?>,
		hoverPause: <?php echo get_option_str('coin_slider_hover'); ?>
	});
	jQuery('#cs-buttons-coin-slider').css('margin-left', function(index, val){
		return -this.offsetWidth/2;
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
		$position = get_post_meta(get_the_ID(), 'coin_caption_position', true);
		if (empty($position))
			$position = $this->default_position;
		return "<span class=\"{$position}\">{$caption}</span>";
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="coin-slider" style="display:none;">
		<?php
			while ($loop->have_posts()) :
			$loop->the_post();
			if (!get_post_thumbnail_id())
				continue;
			$this->target_link = metaboxesGenerator::the_superlink();
		?>
		<div>
			<?php
				the_post_thumbnail('slider_coin', array('title' => false));
				echo $this->get_caption();
			?>
		</div>
		<?php endwhile; ?>
	</div>
</div>
<?php
	}

	public function options() {
		ap_add_section('coin_slider', __('Coin slider', TEMPLATENAME));
		ap_add_select(array(
			'name' => 'coin_slider_effect',
			'title' => __('Type of animation', TEMPLATENAME),
			'default' => 'random',
			'options' => array(
				'random' => __('Random', TEMPLATENAME),
				'swirl' => __('Swirl', TEMPLATENAME),
				'rain' => __('Rain', TEMPLATENAME),
				'straight' => __('Straight', TEMPLATENAME),
			),
			'empty' => __('All effects (random)', TEMPLATENAME),
			'desc' => __('Choose an effect of changing slides.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'coin_slider_delay',
			'title' => __('Delay between images', TEMPLATENAME),
			'default' => '3000',
			'desc' => __('ms. Delay between images.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'coin_slider_sdelay',
			'title' => __('Delay between squares', TEMPLATENAME),
			'default' => '30',
			'desc' => __('ms. Delay between squares.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'coin_slider_squares_width',
			'title' => __('Squares per width', TEMPLATENAME),
			'default' => '10',
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'coin_slider_squares_height',
			'title' => __('Squares per height', TEMPLATENAME),
			'default' => '5',
			'class' => 'small-text',
		));
		ap_add_select(array(
			'name' => 'coin_slider_default_cation_position',
			'title' => __('Default caption position', TEMPLATENAME),
			'default' => 'bottom-left',
			'options' => array(
				'top-left' => __('Top-Left Corner', TEMPLATENAME),
				'top-right' => __('Top-Right Corner', TEMPLATENAME),
				'bottom-right' => __('Bottom-Right Corner', TEMPLATENAME),
				'bottom-left' => __('Bottom-Left Corner', TEMPLATENAME),
			),
			'desc' => __('Choose a caption position.', TEMPLATENAME),
		));
		ap_add_input(array(
			'name' => 'coin_slider_opacity',
			'title' => __('Opacity title & navigation', TEMPLATENAME),
			'default' => '80',
			'desc' => __('% Opacity of title and navigation.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_input(array(
			'name' => 'coin_slider_title_speed',
			'title' => __('Speed of title appereance', TEMPLATENAME),
			'default' => '500',
			'desc' => __('ms. Speed of title appereance.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'coin_slider_navigation',
			'title' => __('Direct navigation', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check this to display "Prev" & "Next" buttons.', TEMPLATENAME),
		));
		ap_add_checkbox(array(
			'name' => 'coin_slider_hover',
			'title' => __('Pause on mouse hover', TEMPLATENAME),
			'default' => true,
			'desc' => __('Determines if slideshow will pause while mouse is hovering over slideshow.', TEMPLATENAME)
		));
		$config = array(
			'title' => __('Coin Slider Options', TEMPLATENAME),
			'id' => 'coinpostoptions',
			'pages' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
		$options = array(
			array(
				'name' => __('Caption Position', TEMPLATENAME),
				'desc' => __('Position of caption on the slide.', TEMPLATENAME),
				'id' => 'coin_caption_position',
				'default' => '',
				'type' => 'select',
				'options' => array(
					'top-left' => __('Top-Left Corner', TEMPLATENAME),
					'top-right' => __('Top-Right Corner', TEMPLATENAME),
					'bottom-right' => __('Bottom-Right Corner', TEMPLATENAME),
					'bottom-left' => __('Bottom-Left Corner', TEMPLATENAME),
				),
				'empty' => __('Default', TEMPLATENAME),
			),
		);
		new metaboxesGenerator($config,$options);
	}
}
?>

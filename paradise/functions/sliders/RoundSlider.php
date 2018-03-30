<?php
class RoundSlider extends BaseSlider {
	public $id = 'round';

	public function __construct() {
		add_image_size('slider_round', 400, 220, true);
		$this->use_thumb_filter = false;
		parent::__construct();
	}

	public function get_name() {
		return __('3D Round Carousel', TEMPLATENAME);
	}

	public function scripts() {
		wp_register_style('css_slider_round', get_bloginfo('template_directory') . '/stylesheets/round-slider.css');
		wp_register_script('js_slider_round', get_bloginfo('template_directory') . '/js/round-slider.js', array('jquery'));
		wp_register_script('js_easing', get_bloginfo('template_directory') . '/js/jquery.easing.1.3.js', array('jquery'));
		wp_enqueue_style('css_slider_round');
		wp_enqueue_script('js_slider_round');
		wp_enqueue_script('js_easing');
	}

	public function scripts_init() {
 ?>
jQuery(document).ready(function () {
	jQuery('#round-slider').css('display', 'block');
	jQuery("#round-slider").waterwheelCarousel("horizontal",{
		startingItem:           Math.ceil(jQuery('#round-slider').find('img').length / 2),
		startingItemSeparation: 150,
		itemSeparationFactor:   0.5,
		startingWaveSeparation: 35,
		waveSeparationFactor:   0.75,
		itemDecreaseFactor:     0.8,
		opacityDecreaseFactor:  0.5,
		centerOffset:           35,
		flankingItems:          4,
		speed:                  <?php echo get_option('round_slider_speed'); ?>,
		animationEasing:			'<?php echo get_option('round_slider_easing'); ?>',
		quickerForFurther:		<?php echo get_option_str('round_slider_quicker'); ?>,
		clickedCenter: function(e) {
			var link_id = jQuery(e).attr('rel');
			if (link_id != undefined) {
				window.location.href = jQuery(link_id).attr('href');
				return false;
			}
		},
		movedToCenter: function(e) {
			jQuery('#round-slider > img').each(function() {
				jQuery(this).css({cursor: 'default'});
			});
			if (jQuery(e).attr('rel') != undefined)
				jQuery(e).css({cursor: 'pointer'});
		}
	});
});
<?php
	}

	public function render($loop) {
?>
<div class="slider_wrapper">
	<div id="round-slider" style="display:none;">
		<?php
			$_links = array();
			while ($loop->have_posts()) {
				$loop->the_post();
				if (!get_post_thumbnail_id())
					continue;
				$img_attr = array('title' => false);
				if ($this->linked_slide) {
					$target_link = metaboxesGenerator::the_superlink();
					if (!empty($target_link)) {
						$_links['slide-'.get_the_ID()] = $target_link;
						$img_attr['rel'] = '#slide-'.get_the_ID();
					}
				}
				the_post_thumbnail('slider_round', $img_attr);
			}
		?>
	</div>
	<div id="round-slider-links" style="display:none;">
		<?php foreach($_links as $_key => $_link): ?>
		<?php echo "<a id=\"{$_key}\" href=\"{$_link}\"></a>"; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php
	}

	public function options() {
		ap_add_section('round_slider', __('3D round carousel', TEMPLATENAME));
		ap_add_input(array(
			'name' => 'round_slider_speed',
			'title' => __('Carousel speed', TEMPLATENAME),
			'default' => '300',
			'desc' => __('ms. Speed it will take to rotate from one to the next.', TEMPLATENAME),
			'class' => 'small-text',
		));
		ap_add_checkbox(array(
			'name' => 'round_slider_quicker',
			'title' => __('Quicker for further', TEMPLATENAME),
			'default' => true,
			'desc' => __('Check to make animations faster when clicking an item that is far away from the center.', TEMPLATENAME),
		));
		ap_add_select(array(
			'name' => 'round_slider_easing',
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

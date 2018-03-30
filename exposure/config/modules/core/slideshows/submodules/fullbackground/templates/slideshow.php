<?php
	$module_config = thb_config('core/slideshows/submodules/fullbackground');
	$module_path = 'core/slideshows/submodules/fullbackground';

	$config = array(
		'cycle-fx' => thb_get_post_meta($id, 'fullbackground_effects'),
		'cycle-speed' => thb_get_post_meta($id, 'fullbackground_transition_speed') * 1000,
		'cycle-timeout' => thb_get_post_meta($id, 'fullbackground_delay') * 1000
	);

	if( $config['cycle-speed'] == '0' ) { $config['cycle-speed'] = ''; }
	if( $config['cycle-timeout'] == '0' ) { $config['cycle-timeout'] = ''; }

	$data = array(
		'cycle-fx'      => 'fadeout',
		'cycle-easing'  => 'easeInOutQuint',
		'cycle-speed'   => '500',
		'cycle-slides'  => '> div.slide',
		'cycle-timeout' => '5000',
		'cycle-auto-height' => '-1'
	);

	if( count($slides) > 1 ) {
		$data['cycle-prev'] = '#fullbackground_prev';
		$data['cycle-next'] = '#fullbackground_next';
	}

	$data = thb_array_asum($data, $config, true);
	$sp = $data['cycle-speed'] / 1000;
?>

<?php if( thb_is_page_template($module_config['carousel']) ) : ?>
	<?php
		thb_get_module_template_part($module_path, 'carousel', array(
			'slides' => $slides
		));
	?>
<?php endif; ?>

<div id="thb-full-background-captions" class="cycle-slideshow" data-cycle-auto-height="-1" data-cycle-timeout="0" data-cycle-slides="> div.slide" data-cycle-fx="none">
	<?php foreach($slides as $slide ) : ?>
		<?php
			$slide_data = array(
				'type' => $slide['type']
			);

			if( $slide_data['type'] != 'image' ) {
				$slide_data['autoplay'] = $slide['autoplay'];
			}
		?>
		<div class="slide" <?php thb_data_attributes($slide_data); ?>>
			<?php if( $slide['caption'] != '' ) : ?>
				<div class="caption">
					<?php echo thb_text_format($slide['caption'], true); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<div class="thb-page-overlay"></div>

<div id="thb-full-background" class="cycle-slideshow" <?php thb_data_attributes($data); ?>>
	<?php foreach($slides as $slide ) : ?>
		<?php
			$slide_data = array(
				'type' => $slide['type']
			);

			if( $slide_data['type'] != 'image' ) {
				$slide_data['autoplay'] = $slide['autoplay'];
			}
		?>
		<div class="slide" <?php thb_data_attributes($slide_data); ?>>
			<?php if( $slide['type'] == 'image' ) : ?>
				<img src="<?php echo thb_image_get_size($slide['id'], $image_size); ?>" alt="">
			<?php else : ?>
				<?php
					$attributes = thb_get_attributes(array(
						'url' => $slide['url'],
						'class' => 'thb_slideshow_video thb-noFit',
						'autoplay' => $slide['autoplay'],
						'loop' => $slide['loop']
					));
					echo thb_do_shortcode('[thb_video ' . $attributes . ']');
				?>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<?php if( count($slides) > 1 && $module_config['controls'] ) : ?>
	<?php thb_get_module_template_part($module_path, 'controls'); ?>
<?php endif; ?>

<style type="text/css">
	<?php if( $fixed ) : ?>
		#thb-full-background { position: fixed; }
	<?php endif; ?>

	#thb-full-background .slide[data-type='image'] img {
		-webkit-transition: opacity <?php echo $sp; ?>s ease-in-out;
		-moz-transition: opacity <?php echo $sp; ?>s ease-in-out;
		-ms-transition: opacity <?php echo $sp; ?>s ease-in-out;
		-o-transition: opacity <?php echo $sp; ?>s ease-in-out;
		transition: opacity <?php echo $sp; ?>s ease-in-out;
	}
</style>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$.thb.config.set("fullbackground", $.thb.config.defaultKeyName, {
			container: "#thb-full-background",
			controls: <?php echo (int) thb_config($module_path, 'controls'); ?>,
			keyboard: <?php echo (int) thb_config($module_path, 'keyboard'); ?>,
			carousel: <?php echo (int) thb_is_page_template($module_config['carousel']); ?>,
			autoplay: <?php echo (int) thb_get_post_meta($id, 'fullbackground_autoplay'); ?>,
			fit: <?php echo (int) thb_get_post_meta($id, 'fullbackground_fit'); ?>
		});
	});
</script>
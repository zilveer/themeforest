<?php
if ( !defined('ABSPATH') ) exit;

if (!empty($slides)):

	wp_enqueue_style('tmm_flexslider');
	wp_enqueue_script('tmm_flexslider');

	if (!isset($alias)) {
		$alias = '1130*420';
	}

	$max_slider_height = 420;

	$uniqid = uniqid();
	?>

	<!-- - - - - - - - - - - Slider - - - - - - - - - - - - - -->

	<script type="text/javascript">

		jQuery(function() {
			jQuery('#slider_<?php echo $uniqid ?>').flexslider({
				start: function(){
					jQuery('#slider_<?php echo $uniqid ?>').css('background', 'none');
				},
				animation: "<?php echo $options['animation'] ?>",
				animationLoop: <?php echo ($options['animation_loop'] ? 'true' : 'false') ?>,
				slideshow: <?php echo ($options['slideshow'] ? 'true' : 'false') ?>,
				reverse: <?php echo $options['reverse'] ?>, //{NEW} Boolean: Reverse the animation direction
				slideshowSpeed: <?php echo $options['slideshow_speed'] ?>, //Integer: Set the speed of the slideshow cycling, in milliseconds
				animationSpeed: <?php echo $options['animation_speed'] ?>, //Integer: Set the speed of animations, in milliseconds
				initDelay: <?php echo $options['init_delay'] ?>, //{NEW} Integer: Set an initialization delay, in milliseconds
				randomize: <?php echo $options['randomize'] ?>, //Boolean: Randomize slide order
				controlNav: true,
				directionNav: false,
				easing: "swing", //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
				direction: "horizontal", //String: Select the sliding direction, "horizontal" or "vertical"
				smoothHeight: false, //{NEW} Boolean: Allow height of the slider to animate smoothly in horizontal mode
				startAt: 0, //Integer: The slide that the slider should start on. Array notation (0 = first slide)
				// Usability features
				pauseOnAction: true, //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
				pauseOnHover: false, //Boolean: Pause the slideshow when hovering over slider, then resume when no longer hovering
				useCSS: true, //{NEW} Boolean: Slider will use CSS3 transitions if available
				touch: true, //{NEW} Boolean: Allow touch swipe navigation of the slider on touch-enabled devices
				video: false//{NEW} Boolean: If using video in the slider, will prevent CSS3 3D Transforms to avoid graphical glitches
			});
		});

	</script>

	<div id="slider_<?php echo $uniqid ?>" class="flexslider clearfix" <?php echo !empty($max_slider_height) ? 'style="max-height: '.$max_slider_height.'px;"' : ''; ?>>

		<ul class="slides">

			<?php foreach ($slides as $slide_num => $slide) : ?>

				<?php
				$slide_url = TMM_Helper::get_image($slide['imgurl'], $alias);
				$slide_title_font_family = $slide['flex']['field_values']['title']['font_family'];
				$slide_title_font_size = $slide['flex']['field_values']['title']['font_size'];
				$slide_title_font_color = $slide['flex']['field_values']['title']['font_color'];

				$slide_subtitle_font_family = $slide['flex']['field_values']['subtitle']['font_family'];
				$slide_subtitle_font_size = $slide['flex']['field_values']['subtitle']['font_size'];
				$slide_subtitle_font_color = $slide['flex']['field_values']['subtitle']['font_color'];

				$style = "";
				if (!empty($slide_title_font_family)) {
					$style.='font-family:' . $slide_title_font_family . ';';
				}

				if (!empty($slide_title_font_size)) {
					$style.='font-size:' . $slide_title_font_size . 'px;';
				}

				if (!empty($slide_title_font_color)) {
					$style.='color:' . $slide_title_font_color . ';';
				}

				$subtitlestyle = "";
				if (!empty($slide_subtitle_font_family)) {
					$subtitlestyle.='font-family:' . $slide_subtitle_font_family . ';';
				}

				if (!empty($slide_subtitle_font_size)) {
					$subtitlestyle.='font-size:' . $slide_subtitle_font_size . 'px;';
				}

				if (!empty($slide_subtitle_font_color)) {
					$subtitlestyle.='color:' . $slide_subtitle_font_color . ';';
				}
				?>

				<li>

					<img src="<?php echo $slide_url ?>" alt="<?php echo $slide['flex']['title'] ?>" <?php echo !empty($max_slider_height) ? 'style="max-height: '.$max_slider_height.'px;"' : ''; ?> />

					<?php if($options['enable_caption']){ ?>
					<div class="caption">
						<div class="caption-entry">

							<dl class="auto-detailed clearfix">
								<?php if(!empty($slide['flex']['title'])){ ?>
								<dt><span class="model" <?php if (isset($slide['flex']['caption_default_styling'])): ?>style="<?php echo $style ?>"<?php endif; ?>><?php echo $slide['flex']['title'] ?></span></dt>
								<?php } ?>
								<?php if(!empty($slide['flex']['subtitle'])){ ?>
								<dd class="media-hidden" <?php if (isset($slide['flex']['caption_default_styling'])): ?>style="<?php echo $subtitlestyle ?>"<?php endif; ?>><?php echo $slide['flex']['subtitle'] ?></dd>
								<?php } ?>
							</dl><!--/ .auto-detailed-->

							<?php if (isset($slide['flex']['show_button']) && $slide['flex']['show_button']): ?>
								<a href="<?php echo $slide['flex']['url'] ?>"><?php _e('Details', 'cardealer'); ?> &raquo;</a>
							<?php endif; ?>
						</div><!--/ .caption-entry-->
					</div><!--/ .caption-->
					<?php } ?>

				</li>

			<?php endforeach; ?>


		</ul><!--/ .slides-->

	</div><!--/ #slider-->

	<!-- - - - - - - - - - - end Slider - - - - - - - - - - - - - -->
<?php endif; ?>
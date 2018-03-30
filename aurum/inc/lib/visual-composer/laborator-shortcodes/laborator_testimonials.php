<?php
/**
 *	Text Banner Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */


class WPBakeryShortCode_laborator_testimonials extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'testimonials_query' => '',
			'autoswitch' => 5,
			'el_class' => '',
			'css' => '',
		), $atts));

		list($args, $testimonials_query) = vc_build_loop_query($testimonials_query);

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_testimonials wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		ob_start();

		?>
		<div class="<?php echo $css_class; ?>" data-autoswitch="<?php echo absint($autoswitch); ?>">

			<div class="testimonials-inner">
				<?php
				if($testimonials_query->have_posts()):

					$i = 0;
					while($testimonials_query->have_posts()): $testimonials_query->the_post();

						$link_to_author = get_field('link_to_author');
						$new_win = get_field('open_in_new_window');

						?>
						<div class="testimonial-entry<?php echo $i > 0 ? ' hidden' : ''; ?>">

							<?php if(has_post_thumbnail()): ?>
								<?php
									$img = wpb_getImageBySize( array( 'attach_id' => get_post_thumbnail_id(), 'thumb_size' => '200x200' ) );
								?>
								<div class="testimonial-thumbnail">

									<?php if($link_to_author): ?><a href="<?php echo $link_to_author; ?>" target="<?php echo $new_win ? '_blank' : '_self'; ?>"><?php endif; ?>
										<?php echo $img['thumbnail']; ?>
									<?php if($link_to_author): ?></a><?php endif; ?>

								</div>
							<?php endif; ?>

							<div class="testimonial-blockquote">
								<?php the_content(); ?>

								<?php if(get_the_title()): ?>
								<cite>
									<?php if($link_to_author): ?><a href="<?php echo $link_to_author; ?>" target="<?php echo $new_win ? '_blank' : '_self'; ?>"><?php endif; ?>
										<?php the_title(); ?>
									<?php if($link_to_author): ?></a><?php endif; ?>
								</cite>
								<?php endif; ?>
							</div>

						</div>
						<?php

						$i++;
					endwhile;

					wp_reset_postdata();
					?>
					<?php

				endif;
				?>
			</div>

		</div>
		<?php

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

// Shortcode Options
$opts = array(
	"name"		=> __("Testimonials", TD),
	"description" => __('Show what your clients say.', TD),
	"base"		=> "laborator_testimonials",
	"class"		=> "vc_laborator_testimonials",
	"icon"		=> "icon-lab-testimonials",
	"controls"	=> "full",
	"category"  => __('Laborator', TD),
	"params"	=> array(

		array(
			"type" => "loop",
			"heading" => __("Testimonials Query", TD),
			"param_name" => "testimonials_query",
			'settings' => array(
				'size'          => array('hidden' => false, 'value' => 'All'),
				'order_by'      => array('value' => 'date'),
				'categories'    => array('hidden' => true),
				'tags'          => array('hidden' => true),
				'tax_query'     => array('hidden' => true),
				'authors'     	=> array('hidden' => true),
				'post_type'     => array('value' => 'testimonial', 'hidden' => false)
			),
			"description" => __("Create WordPress loop, to show testimonials from your site.", TD)
		),

		array(
			"type" => "textfield",
			"heading" => __("Auto Switch", TD),
			"param_name" => "autoswitch",
			"value" => "5",
			"description" => __("Set autoswitch interval to change testimonials. Set 0 to disable.", TD)
		),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", TD),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", TD)
		),

		array(
			"type" => "css_editor",
			"heading" => __('Css', TD),
			"param_name" => "css",
			"group" => __('Design options', TD)
		)
	)
);

// Add & init the shortcode
vc_map($opts);
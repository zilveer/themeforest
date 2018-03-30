<?php
/**
 *	Logo Carousel for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */

class WPBakeryShortCode_laborator_logo_carousel extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'title'          => '',
			'images'         => '',
			'max_height' 	 => '',
			'custom_links'   => '',
			'target'         => '',
			'img_size'       => '',
			'columns'        => '',
			'show_navigation'=> '',
			'autoswitch'     => '',
			'el_class'       => '',
			'css'            => '',
		), $atts));

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_vc_logo_carousel wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		$rand_id = "el_" . time() . mt_rand(10000,99999);

		wp_enqueue_script('owl-carousel');
		wp_enqueue_style('owl-carousel');

		$show_navigation = explode(',', $show_navigation);

		ob_start();

		$images = explode(',', $images);
		$custom_links = explode(",", $custom_links);

		?>
		<div class="<?php echo $css_class; ?>">

			<div class="logos-carousel is-hidden<?php echo in_array('pagination', $show_navigation) ? ' has-numbers' : ''; ?>" id="<?php echo $rand_id; ?>">
			<?php
			foreach($images as $i => $img_id):

				$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size ) );
				$link = isset($custom_links[$i]) ? $custom_links[$i] : '';

				if( ! isset($img) || ! isset($img['thumbnail']))
					continue;

				?>
				<div class="logo-entry">
					<?php if($link): ?>
					<a href="<?php echo $link; ?>" target="<?php echo $target; ?>">
					<?php endif; ?>

						<?php echo $img['thumbnail']; ?>

					<?php if($link): ?>
					</a>
					<?php endif; ?>
				</div>
				<?php

			endforeach;
			?>
			</div>

		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				var $carousel_el = $("#<?php echo $rand_id; ?>");

				$carousel_el.removeClass('is-hidden');

				$carousel_el.owlCarousel({
					items: <?php echo $columns; ?>,
					navigation: <?php echo in_array('next_prev', $show_navigation) ? 'true' : 'false'; ?>,
					pagination: <?php echo in_array('pagination', $show_navigation) ? 'true' : 'false'; ?>,
					autoPlay: <?php echo absint($autoswitch) <= 0 ? 'false' : $autoswitch * 1000; ?>,
					stopOnHover: true,
					singleItem: <?php echo $columns == 1 ? 'true' : 'false'; ?>,
					direction: _rtl()
				});
			});
		</script>
		
		<?php if ( $max_height ) : $max_height = intval( $max_height ); ?>
		<style>
			#<?php echo $rand_id; ?> .logo-entry,
			#<?php echo $rand_id; ?> .logo-entry a {
				height: <?php echo $max_height; ?>px;
				line-height: <?php echo $max_height; ?>px;
			}
		</style>
		<?php endif; ?>
		<?php

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

// Shortcode Options
$target_arr = array(
	__( 'Same window', 'lab_composer') => '_self',
	__( 'New window', 'lab_composer') => "_blank"
);

$opts = array(
	"name"		=> __("Logos Carousel", 'lab_composer'),
	"description" => __('Your clients logos into a rotative carousel.', 'lab_composer'),
	"base"		=> "laborator_logo_carousel",
	"class"		=> "vc_laborator_logo_carousel",
	"icon"		=> "icon-lab-logo-carousel",
	"controls"	=> "full",
	"category"  => __('Laborator', 'lab_composer'),
	"params"	=> array(

		array(
			"type" => "textfield",
			"heading" => __("Widget title", 'lab_composer'),
			"param_name" => "title",
			"value" => "",
			"description" => __("Enter text which will be used as widget title. Leave blank if no title is needed.", 'lab_composer')
		),

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'lab_composer'),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images (logos) from media library.', 'lab_composer')
		),

		array(
			"type" => "textfield",
			"heading" => __("Maximum Height", 'lab_composer'),
			"param_name" => "max_height",
			"value" => "",
			"description" => __("Enter maximum height for logo images in pixels. (Optional)", 'lab_composer')
		),

		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'lab_composer'),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). Leave blank if you don\'t want to add links.', 'lab_composer'),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'lab_composer'),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array( 'element'=>'custom_links', 'not_empty'=>true )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'lab_composer'),
			'param_name' => 'img_size',
			'value' => 'thumbnail',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'lab_composer')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns per slide', 'lab_composer'),
			'param_name' => 'columns',
			'value' => range(1,18),
			'std' => 5,
			'description' => __( 'How many logos you want to show per row (slide).', 'lab_composer'),
		),

		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider navigation', 'lab_composer'),
			'param_name' => 'show_navigation',
			'description' => __( 'Select whether you want to display carousel navigation links.', 'lab_composer'),
			'value' => array(
				__( 'Display pext/previous<br />', 'lab_composer') => 'next_prev' ,
				__( 'Display numbers (circles)', 'lab_composer') => 'pagination'
			),
		),

		array(
			"type" => "textfield",
			"heading" => __("Auto rotate", 'lab_composer'),
			"param_name" => "autoswitch",
			"value" => "5",
			"description" => __("Auto rotate slides each X seconds. Leave blank to disable auto switching.", 'lab_composer')
		),

		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'lab_composer'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'lab_composer')
		),

		array(
			"type" => "css_editor",
			"heading" => __('Css', 'lab_composer'),
			"param_name" => "css",
			"group" => __('Design options', 'lab_composer')
		)
	)
);

// Add & init the shortcode
vc_map($opts);
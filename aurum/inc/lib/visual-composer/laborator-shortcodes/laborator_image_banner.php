<?php
/**
 *	Image Banner Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $terms_list;

class WPBakeryShortCode_laborator_image_banner extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'image'              => '',
			'img_size'           => '',
			'is_category_link'   => '',
			'product_term_id'    => '',
			'title'              => '',
			'description'        => '',
			'font_color'         => '',
			'overlay_bg'         => '#000000',
			'href'               => '',
			'style'              => '',
			'position'		 	 => '',
			'animation'          => '',
			'animation_delay'    => '0s',
			'el_class'           => '',
			'css'                => '',
		), $atts));


		$rand_id = "el_" . time() . mt_rand(10000,99999);

		$link	  = vc_build_link($href);
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = trim($link['target']);

		$css_class  = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_image_banner wpb_content_element '.$style.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);
		$css_class .= " text-position-{$position}";

		$image_link = wp_get_attachment_url( $image );

		$animation_class = trim($animation) ? " wow {$animation}" : '';

		if($is_category_link == 'yes')
		{
			$term = get_term($product_term_id, 'product_cat');

			if($term && ! is_wp_error($term))
			{
				$a_target = '_self';
				$a_href = get_term_link( $term );

				$title = $term->name;
				$count = lab_total_cat_product_count( $term->term_id );

				//_n('%d items', 'lab_composer'); // Just for translation
				$description = sprintf( _n("%d item", "%d items", $count, 'aurum'), $count);
			}
		}

		if( ! $animation)
			$animation_delay = '0s';

		if($animation_class)
		{
			wp_enqueue_style('animate-css');
			$animation_class .= ' initially-hidden';
		}

		ob_start();

		?>

		<?php if($font_color): ?>
		<style>
			#<?php echo $rand_id; ?> .font-color { color: <?php echo $font_color; ?>; }

			#<?php echo $rand_id; ?> .bg-color { background-color: <?php echo $font_color; ?> }
			#<?php echo $rand_id; ?> .border-color { border-color: <?php echo $font_color; ?> }
			#<?php echo $rand_id; ?> .border-color-top { border-top-color: <?php echo $font_color; ?> }
			#<?php echo $rand_id; ?> .border-color-bottom { border-bottom-color: <?php echo $font_color; ?> }
			#<?php echo $rand_id; ?> .border-color-left { border-left-color: <?php echo $font_color; ?> }
			#<?php echo $rand_id; ?> .border-color-right { border-right-color: <?php echo $font_color; ?> }
		</style>
		<?php endif; ?>
		<div class="<?php echo $css_class; ?>" id="<?php echo $rand_id; ?>">

			<?php if($image_link): ?>

				<a href="<?php echo $a_href; ?>" target="<?php echo $a_target; ?>">

					<?php
					# Show Image
					$img = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size, 'class' => 'banner-img' ) );
					echo $img['thumbnail'];
					?>

					<span class="ol" style="background-color: <?php echo $overlay_bg; ?>;"></span>


					<?php if($title || $description): ?>
					<div class="banner-text-container">
						<div class="banner-text-content border-color <?php echo $animation_class ? " {$animation_class}" : ''; ?>">
						<?php
						switch($style):

							case "banner-type-title-description":
							case "banner-type-title-description-bordersep":
								?>
								<strong class="font-color"><?php echo $title; ?></strong>
								<em class="font-color border-top-color"><?php echo $description; ?></em>
								<?php
								break;

							case "banner-type-title-description-dash":
								?>
								<strong class="font-color"><?php echo $title; ?></strong>
								<em class="font-color"><?php echo $description; ?></em>
								<div class="dash bg-color"></div>
								<?php
								break;

							case "banner-type-title-only":
							case "banner-type-double-bordered-title":
							default:

							?><strong class="font-color border-color-top border-color-bottom"><?php echo $title; ?></strong><?php

						endswitch;
						?>
						</div>
					</div>
					<?php endif; ?>

				</a>

			<?php endif; ?>

		</div>
		<?php

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

$animated_transitions_list = array(
	"None"                  => '',
	"bounce"                => "bounce",
	"flash"                 => "flash",
	"pulse"                 => "pulse",
	"rubberBand"            => "rubberBand",
	"shake"                 => "shake",
	"swing"                 => "swing",
	"tada"                  => "tada",
	"wobble"                => "wobble",
	"bounceIn"              => "bounceIn",
	"bounceInDown"          => "bounceInDown",
	"bounceInLeft"          => "bounceInLeft",
	"bounceInRight"         => "bounceInRight",
	"bounceInUp"            => "bounceInUp",
	"fadeIn"                => "fadeIn",
	"fadeInDown"            => "fadeInDown",
	"fadeInDownBig"         => "fadeInDownBig",
	"fadeInLeft"            => "fadeInLeft",
	"fadeInLeftBig"         => "fadeInLeftBig",
	"fadeInRight"           => "fadeInRight",
	"fadeInRightBig"        => "fadeInRightBig",
	"fadeInUp"              => "fadeInUp",
	"fadeInUpBig"           => "fadeInUpBig",
	"flip"         			=> "flip",
	"flipInX"               => "flipInX",
	"flipInY"               => "flipInY",
	"lightSpeedIn"          => "lightSpeedIn",
	"rotateIn"              => "rotateIn",
	"rotateInDownLeft"      => "rotateInDownLeft",
	"rotateInDownRight"     => "rotateInDownRight",
	"rotateInUpLeft"        => "rotateInUpLeft",
	"rotateInUpRight"       => "rotateInUpRight",
	"hinge"                 => "hinge",
	"rollIn"                => "rollIn",
	"zoomIn"                => "zoomIn",
	"zoomInDown"            => "zoomInDown",
	"zoomInLeft"            => "zoomInLeft",
	"zoomInRight"           => "zoomInRight",
	"zoomInUp"              => "zoomInUp",
	"slideInDown"           => "slideInDown",
	"slideInLeft"           => "slideInLeft",
	"slideInRight"          => "slideInRight",
	"slideInUp"             => "slideInUp"
);

// Shortcode Options
$product_categories = get_categories(array('taxonomy' => 'product_cat', 'pad_counts' => false));
$terms_list = array();

foreach($product_categories as $term)
{
	if(is_object($term))
		$terms_list[$term->name . " ({$term->count})"] = $term->term_id;
}


function lab_total_cat_product_count( $cat_id )
{
	$q = new WP_Query( array(
		'nopaging'    => true,
		'tax_query'   => array(
			array(
				'taxonomy'          => 'product_cat',
				'field'             => 'id',
				'terms'             => $cat_id,
				'include_children'  => true,
			),
		),
		'fields' => 'ids',
	) );

	return $q->post_count;
}

$opts = array(
	"name"		=> __("Image Banner", 'lab_composer'),
	"description" => __('Graphical banner or category with text.', 'lab_composer'),
	"base"		=> "laborator_image_banner",
	"class"		=> "vc_laborator_banner2",
	"icon"		=> "icon-lab-banner2",
	"controls"	=> "full",
	"category"  => __('Laborator', 'lab_composer'),
	"params"	=> array(

		array(
			"type" => "attach_image",
			"heading" => __("Image", 'lab_composer'),
			"param_name" => "image",
			"value" => "",
			"description" => __("Set the banner image.", "js_composer")
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'lab_composer'),
			'param_name' => 'img_size',
			'value' => '',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'lab_composer')
		),


		array(
			"type" => "dropdown",
			"heading" => __("Link Type", 'lab_composer'),
			"param_name" => "is_category_link",
			"std" => '',
			"value" => array(
				__( "Title and Description", TD ) => 'no',
				__( "Category Link", TD ) => 'yes',
			),
			"description" => __("Instead of setting custom link, you can link this banner to a product category.", 'lab_composer')
		),


		array(
			"type" => "dropdown",
			"heading" => __("Category", 'lab_composer'),
			"param_name" => "product_term_id",
			"std" => '',
			"value" => $terms_list,
			"description" => __("Select product category. Second Line is category items counter.", 'lab_composer'),
			'dependency' => array( 'element' => 'is_category_link', 'value' => array( 'yes' ) )
		),

		array(
			"type" => "textfield",
			"heading" => __("Title", 'lab_composer'),
			"param_name" => "title",
			"value" => "",
			"description" => __("What text use as banner title.", 'lab_composer'),
			'dependency' => array( 'element' => 'is_category_link', 'value' => array( 'no' ) )
		),

		array(
			"type" => "textfield",
			'admin_label' => true,
			"heading" => __("Description", 'lab_composer'),
			"param_name" => "description",
			"value" => "",
			"description" => __("Second Line Text.", 'lab_composer'),
			'dependency' => array( 'element' => 'is_category_link', 'value' => array( 'no' ) )
		),

		array(
			"type" => "vc_link",
			"heading" => __("URL (Link)", 'lab_composer'),
			"param_name" => "href",
			"description" => __("Banner link.", 'lab_composer'),
			'dependency' => array( 'element' => 'is_category_link', 'value' => array( 'no' ) )
		),

		array(
			'type' => 'colorpicker',
			'heading' => __( 'Font Color', 'lab_composer'),
			'param_name' => 'font_color',
			'description' => __( 'Select font color', 'lab_composer'),
			'value' => '#fff'
		),

		array(
			"type" => "colorpicker",
			"heading" => __("Overlay Color", 'lab_composer'),
			"param_name" => "overlay_bg",
			"value" => "rgba(0,0,0,0.4)",
			"description" => __("Select banner overlay layer color.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Banner Style", 'lab_composer'),
			"param_name" => "style",
			"value" => array(
				"Double Bordered Title"     				=> 'banner-type-double-bordered-title',
				"Bordered Title"     						=> 'banner-type-bordered-title',
				"Title Only"                				=> 'banner-type-title-only',
				"Title + Description"						=> 'banner-type-title-description',
				"Title + Description + Dash"    			=> 'banner-type-title-description-dash',
				"Title + Description (Border Separated)"	=> 'banner-type-title-description-bordersep',
			),
			"description" => __("Select the type of banner.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Text Position", 'lab_composer'),
			"param_name" => "position",
			"value" => array(
				"Center"        => 'centered',

				"Bottom-Center" => 'bottom-centered',
				"Bottom-Left"   => 'bottom-left',
				"Bottom-Right"  => 'bottom-right',

				"Top-Center"    => 'top-centered',
				"Top-Left"      => 'top-left',
				"Top-Right"     => 'top-right',
			),
			"description" => __("Set the text position inside banner.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Box Animation", 'lab_composer'),
			"param_name" => "animation",
			"value" => $animated_transitions_list,
			"description" => __("Select transition of the element when it is visible in viewport. <a href='http://daneden.github.io/animate.css/' target='_blank'>View transitions live &raquo;</a>", 'lab_composer')
		),

		array(
			"type" => "textfield",
			"heading" => __("Animation Delay", 'lab_composer'),
			"param_name" => "animation_delay",
			"value" => "0s",
			"description" => __("When the elements is in viewport set the delay when the animation should start. Example values: <em>1s, 500ms</em>.", 'lab_composer')
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
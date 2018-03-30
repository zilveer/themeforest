<?php
/**
 *	Text Banner Shortcode for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */


class WPBakeryShortCode_laborator_banner extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'title'          => '',
			'description'    => '',
			'href'           => '',
			'color'          => '',
			'type'           => '',
			'el_class'       => '',
			'css'            => '',
		), $atts));

		$link     = vc_build_link($href);
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = trim($link['target']);

		switch($color)
		{
			case 'black':
				$el_class .= ' banner-black';
				break;

			case 'purple':
				$el_class .= ' banner-purple';
				break;

			default:
				$el_class .= ' banner-white';
		}

		if($type == 'button-left-text-right')
			$el_class .= ' button-right';
		else
		if($type == 'text-button-center')
			$el_class .= ' text-button-center';

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_banner wpb_content_element banner '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		ob_start();

		?>
		<div class="<?php echo $css_class; ?>">
			<div class="button_outer">
				<div class="button_middle">
					<div class="button_inner">

						<?php if($type == 'button-left-text-right'): ?>
							<?php if($a_title): ?>
							<div class="banner-call-button">
								<a href="<?php echo $a_href; ?>" class="btn" target="<?php echo $a_target; ?>"><?php echo $a_title; ?></a>
							</div>
							<?php endif; ?>
						<?php endif; ?>

						<div class="banner-content">
							<strong><?php echo $title; ?></strong>

							<?php if($description): ?>
							<span><?php echo $description; ?></span>
							<?php endif; ?>
						</div>

						<?php if( ! in_array($type, array('button-left-text-right'))): ?>
							<?php if($a_title): ?>
							<div class="banner-call-button">
								<a href="<?php echo $a_href; ?>" class="btn" target="<?php echo $a_target; ?>"><?php echo $a_title; ?></a>
							</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
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
	"name"		=> __("Text Banner", 'lab_composer'),
	"description" => __('Include a Call to Action banner.', 'lab_composer'),
	"base"		=> "laborator_banner",
	"class"		=> "vc_laborator_banner",
	"icon"		=> "icon-lab-banner",
	"controls"	=> "full",
	"category"  => __('Laborator', 'lab_composer'),
	"params"	=> array(

		array(
			"type" => "textfield",
			"heading" => __("Widget title", 'lab_composer'),
			"param_name" => "title",
			"value" => "",
			"description" => __("What text use as widget title. Leave blank if no title is needed.", 'lab_composer')
		),

		array(
			"type" => "textfield",
			'admin_label' => true,
			"heading" => __("Text", 'lab_composer'),
			"param_name" => "description",
			"value" => __("Free shipping over $125 for international orders", 'lab_composer'),
			"description" => __("Banner content.", 'lab_composer')
		),

		array(
			"type" => "vc_link",
			"heading" => __("URL (Link)", 'lab_composer'),
			"param_name" => "href",
			"description" => __("Button link.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Banner Color", 'lab_composer'),
			"param_name" => "color",
			"value" => array(
				"White"     => 'white',
				"Black"     => 'black',
				"Purple"    => 'purple',
			),
			"description" => __("Select the type of banner.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Banner Type", 'lab_composer'),
			"param_name" => "type",
			"value" => array(
				"Text (left) + Button (right)" => 'text-left-button-right',
				"Button (left) + Text (right)" => 'button-left-text-right',
				"Text + Button (Center)" => 'text-button-center',
			),
			"description" => __("Select the type of banner.", 'lab_composer')
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
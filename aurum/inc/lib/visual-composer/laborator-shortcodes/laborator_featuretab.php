<?php
/**
 *	Feature Tab for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */

class WPBakeryShortCode_laborator_featuretab extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'title'          => '',
			'type'           => '',
			'description'    => '',
			'text_align'     => 'left',
			'icon'           => '',
			'href'           => '',
			'el_class'       => '',
			'css'            => '',
		), $atts));

		wp_enqueue_style('vc-icons');

		$link     = vc_build_link($href);
		$a_href   = $link['url'];
		$a_title  = $link['title'];
		$a_target = trim($link['target']);

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_wpb_featuretab wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		$css_class .= " text-aligned-{$text_align}";

		ob_start();

		?>
		<div class="<?php echo $css_class; ?>">
			<a<?php if($a_href && $a_href != '#'): ?> href="<?php echo $a_href; ?>"<?php endif; ?> class="feature-tab <?php echo $type; ?>" target="<?php echo $a_target; ?>">
				<span class="icon">
					<span class="icon-inner">
						<i class="vc-icon-<?php echo $icon; ?>"></i>
					</span>
				</span>

				<span class="title"><?php echo $title; ?></span>

				<span class="description">
					<?php echo nl2br($description); ?>
				</span>
			</a>
		</div>
		<?php

		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}
}

// Shortcode Options
$opts = array(
	"name"		=> __("Feature Tab", TD),
	"description" => __('Good way to list your features.', TD),
	"base"		=> "laborator_featuretab",
	"class"		=> "vc_laborator_featuretab",
	"icon"		=> "icon-lab-featuretab",
	"controls"	=> "full",
	"category"  => __('Laborator', TD),
	"params"	=> array(

		array(
			"type" => "textfield",
			"heading" => __("Widget title", TD),
			"param_name" => "title",
			"value" => "My awesome service",
			"description" => __("What text use as widget title. Leave blank if no title is needed.", TD)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Block Type", TD),
			"param_name" => "type",
			"value" => array(
				"Top Icon" => 'icon-top',
				"Top Icon (Dark)" => 'icon-top-dark',
				"Inline icon with heading" => 'icon-inline'
			),
			"description" => __("Select the type of featured tab box.", TD)
		),

		array(
			"type" => "textarea",
			'admin_label' => true,
			"heading" => __("Text", TD),
			"param_name" => "description",
			"value" => __("Your brilliant description about this feautre.", TD),
			"description" => __("Feature small description.", TD)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Text align", 'lab_composer'),
			"param_name" => "text_align",
			"value" => array(
				"Left"      => 'left',
				"Center"    => 'center',
				"Right"     => 'right',
			),
			"description" => __("Set the text alignment.", 'lab_composer')
		),

		array(
			"type" => "fontelloicon",
			"heading" => __("Icon", TD),
			"param_name" => "icon",
			"value" => "heart",
			"description" => __("Tab icon to display.", TD)
		),

		array(
			"type" => "vc_link",
			"heading" => __("URL (Link)", TD),
			"param_name" => "href",
			"description" => __("Tab link.", TD)
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
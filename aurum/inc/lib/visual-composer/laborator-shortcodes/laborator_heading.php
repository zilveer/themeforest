<?php
/**
 *	Heading Title for Visual Composer
 *
 *	Laborator.co
 *	www.laborator.co
 */

class WPBakeryShortCode_laborator_heading extends  WPBakeryShortCode
{
	public function content($atts, $content = null)
	{
		if( function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		}
		
		extract(shortcode_atts(array(
			'title'              => '',
			'sub_title'          => '',
			'text_align'         => 'left',
			'icon'               => '',
			'font_size'			 => '',
			'show_breadcrumb'    => '',
			'show_dash'    		 => '',
			'el_class'           => '',
			'css'                => '',
		), $atts));

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'lab_vc_pagetitle wpb_content_element '.$el_class.vc_shortcode_custom_css_class($css, ' '), $this->settings['base']);

		ob_start();

		# Title
		if($icon)
		{
			wp_enqueue_style('vc-icons');
			$css_class .= ' has-icon';
		}

		$show_breadcrumb = $show_breadcrumb && function_exists('bcn_display');

		$css_class .= " text-aligned-{$text_align}";

		if($font_size)
			$css_class .= ' font-size-' . $font_size;

		if($sub_title)
			$css_class .= ' has-subtitle';

		if($show_breadcrumb)
			$css_class .= ' has-breadcrumb';

		?>
		<div class="<?php echo $css_class; ?>">
			<div class="row">
				<div class="col-sm-<?php echo $show_breadcrumb ? 6 : 12; ?>">

					<h2>
						<?php if($icon): ?>
						<i class="vc-icon-<?php echo $icon; ?>"></i>
						<?php endif; ?>

						<?php echo $title; ?>
						<?php if($sub_title): ?>
						<small><?php echo $sub_title; ?></small>
						<?php endif; ?>
					</h2>

					<?php if($show_dash): ?>
					<span class="dash"></span>
					<?php endif; ?>
				</div>
				<?php if($show_breadcrumb): ?>
				<div class="col-sm-6">
					<?php
						echo '<div class="breadcrumb pull-right-md">';
					    bcn_display();
						echo '</div>';
					?>
				</div>
				<?php endif; ?>
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
	"name"		=> __("Heading Title", 'lab_composer'),
	"description" => __('Custom heading title with other features.', 'lab_composer'),
	"base"		=> "laborator_heading",
	"class"		=> "vc_laborator_heading",
	"icon"		=> "icon-lab-heading",
	"controls"	=> "full",
	"category"  => __('Laborator', 'lab_composer'),
	"params"	=> array(

		array(
			"type" => "textfield",
			"heading" => __("Title", 'lab_composer'),
			"param_name" => "title",
			"value" => "Page title here",
			"description" => __("What text use as page title.", 'lab_composer')
		),

		array(
			"type" => "textfield",
			"heading" => __("Sub title", 'lab_composer'),
			"param_name" => "sub_title",
			"value" => "",
			"description" => __("Smaller text to display below the title.", 'lab_composer')
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
			"heading" => __("Icon", 'lab_composer'),
			"param_name" => "icon",
			"value" => "",
			"description" => __("Prepend an icon to the title.", 'lab_composer')
		),

		array(
			"type" => "dropdown",
			"heading" => __("Font Size", 'lab_composer'),
			"param_name" => "font_size",
			"value" => array(
				"Large"     => 'large',
				"Medium"    => 'medium',
				"Small"     => 'small',
			),
			"description" => __("Select font size of the title.", 'lab_composer')
		),

		array(
			"type" => "checkbox",
			"heading" => __("Show Breadcrumb", 'lab_composer'),
			"param_name" => "show_breadcrumb",
			"std" => '',
			"value" => array(
				__( "Show", 'lab_composer') => 'yes',
			),
			"description" => __('This will show current path of the page. To activate this feature you must install <a href="plugin-install.php?tab=search&s=Breadcrumb+NavXT" target="_blank"> <strong>Breadcrumb NavXT</strong></a> plugin.', 'lab_composer')
		),

		array(
			"type" => "checkbox",
			"heading" => __("Dash", 'lab_composer'),
			"param_name" => "show_dash",
			"std" => '',
			"value" => array(
				__( "Show", 'lab_composer') => 'yes',
			),
			"description" => __('Show small dash separator below the title.', 'lab_composer')
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
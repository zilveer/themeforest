<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Stage Box
 Description: Create and display an Stage Image Box element. To be used with Icon Boxes.
 Class: TH_StageImageBox
 Category: content, media
 Level: 3
*/
/**
 * Class TH_StageImageBox
 *
 * Create and display an Stage Image Box element containing an image with tooltips. To be used with Icon Boxes.
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StageImageBox extends ZnElements
{
	public static function getName(){
		return __( "Stage Image Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];

		$tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'px;' : '';
		$bpadding = $this->opt('bottom_padding') || $this->opt('bottom_padding') === '0' ? 'padding-bottom:'.$this->opt('bottom_padding').'px;' : '';
		$css .= ".$uid .stage-ibx__stage { $tpadding $bpadding }";

		$ibstg_points_color = $this->opt('ibstg_points_color', '#FFFFFF');
		$ibstg_points_style = $this->opt('ibstg_points_style', 'trp');

		if($ibstg_points_style == 'trp') {
			$css .= ".$uid.stage-ibx--points-trp .stage-ibx__point:after {background: ".zn_hex2rgba_str($ibstg_points_color, 60)."; box-shadow: 0 0 0 3px ".$ibstg_points_color."; }
			.$uid.stage-ibx--points-trp .stage-ibx__point:hover:after, .$uid.stage-ibx--points-trp .stage-ibx__point.is-hover:after { box-shadow: 0 0 0 5px ".$ibstg_points_color.", 0 4px 10px #000; } ";

		} elseif($ibstg_points_style == 'full') {
			$css .= ".$uid.stage-ibx--points-full .stage-ibx__point:after {background: ".$ibstg_points_color.";}
			.$uid.stage-ibx--points-full .stage-ibx__point:hover:after, .$uid.stage-ibx--points-full .stage-ibx__point.is-hover:after {background: ".adjustBrightness($ibstg_points_color, 20).";} ";
		}

		return $css;
	}

	/**
	 * This method is used to display the output of the element.
	 *
	 * @return void
	 */
	function element()
	{
		$uid = $this->data['uid'];
		$options = $this->data['options'];

		$classes=array();
		$classes[] = $uid = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$classes[] = 'stage-ibx--points-'.$this->opt('ibstg_points_style', 'trp');


?>

<div class="stage-ibx <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>

	<?php if($img = $this->opt('ibstg_stageimg','')){

		$saved_alt   = $this->opt('ibstg_stageimg_alt','') ? $this->opt('ibstg_stageimg_alt','') : ZngetImageAltFromUrl( $img, false );
		$saved_title = ZngetImageTitleFromUrl( $img, false );

		?>
	<div class="stage-ibx__stage">
		<img src="<?php echo $img; ?>" <?php echo ZngetImageSizesFromUrl($img, true); ?> alt="<?php echo $saved_alt; ?>" title="<?php echo $saved_title; ?>" class="stage-ibx__stage-img img-responsive">
	</div><!-- /.stage-ibx__stage -->
	<?php } ?>

	<div class="clearfix"></div>

</div><!-- /.stage-ibx -->

<?php

	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		$options = array(
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
						"description" => sprintf(__( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".%s {  }" data-tooltip="Click to copy CSS class to clipboard">.%s</span> .', 'zn_framework' ), $uid, $uid),
						"id"          => "id_element",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn_nomargin"
					),

					array (
						"name"        => __( "Stage Image", 'zn_framework' ),
						"description" => __( "Upload an image that will be placed in the middle", 'zn_framework' ),
						"id"          => "ibstg_stageimg",
						"std"         => "",
						"type"        => "media"
					),

					array (
						"name"        => __( "Img Alt", 'zn_framework' ),
						"description" => __( "Add an alternative text for the image (SEO purposes). Deprecated! Use built-in media browser.", 'zn_framework' ),
						"id"          => "ibstg_stageimg_alt",
						"std"         => "",
						"type"        => "text"
					),

					array (
						"name"        => __( "Point Style", 'zn_framework' ),
						"description" => __( "The style of the points.", 'zn_framework' ),
						"id"          => "ibstg_points_style",
						"std"         => "trp",
						"type"        => "select",
						'options'     => array(
							'trp' => 'Bordered transparent',
							'full' => 'Colored',
						),
					),

					array (
						"name"        => __( "Point Color", 'zn_framework' ),
						"description" => __( "The color of the points.", 'zn_framework' ),
						"id"          => "ibstg_points_color",
						"std"         => "#FFFFFF",
						"type"        => "colorpicker",
					),

					array(
						'id'          => 'top_padding',
						'name'        => 'Top padding',
						'description' => 'Select the top padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '150',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid.' .stage-ibx__stage',
							'css_rule'  => 'padding-top',
							'unit'      => 'px'
						)
					),
					array(
						'id'          => 'bottom_padding',
						'name'        => 'Bottom padding',
						'description' => 'Select the bottom padding ( in pixels ) for this section.',
						'type'        => 'slider',
						'std'         => '0',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '150',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid.' .stage-ibx__stage',
							'css_rule'  => 'padding-bottom',
							'unit'      => 'px'
						)
					),
				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#Gyo1FWwBpzI',
				'docs'    => 'http://support.hogash.com/documentation/stage-image-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
		return $options;
	}
}

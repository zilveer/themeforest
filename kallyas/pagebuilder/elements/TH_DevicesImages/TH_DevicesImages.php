<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Devices Images
 Description: Create and display a Devices Images element
 Class: TH_DevicesImages
 Category: content
 Level: 3
 Keywords: laptop, mobile, phone
*/
/**
 * Class TH_DevicesImages
 *
 * Create and display a Devices Images element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_DevicesImages extends ZnElements
{
	public static function getName(){
		return __( "Devices Images", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$image_type = $this->opt('di_imgtype','macbook');

		if( $this->opt('di_direction','ltr') == 'center' && $image_type == 'frame'){
			$height = $this->opt('di_center_height', 0);
			if( $height > 0 ){
				$css .= '.'.$uid.'.el-di-dir--center.el-di-imgtype--frame { max-height: '.$height.'px; }';
			}
		}

		if( $image_type == 'custom_frame' ){

			$cstcss = '';
			$cst_height = $this->opt('di_custom_frame_height', 520);
			$cst_width = $this->opt('di_custom_frame_width', 1160);

			if( $cst_height != 520 ){
				$cstcss .= 'height:'.$cst_height.'px;';
			}
			if( $cst_width != 1160 ){
				$cstcss .= 'width:'.$cst_width.'px;';
			}

			$css .= '.'.$uid.'.el-di-imgtype--custom_frame .el-di__frame {'.$cstcss.'}';
		}

		// Add delay transitions
		if( $this->opt('di_appear', '') == '1' ){
			$delay = $this->opt('di_appear_delay', '0');
			$css .= '.'.$uid.' .el-di__laptop.el--appear, .'.$uid.' .el-di__frame.el--appear { -webkit-transition-delay:'.$delay.'ms !important; transition-delay:'.$delay.'ms !important; }';
			$css .= '.'.$uid.' .el-di__smartphone.el--appear { -webkit-transition-delay:'.($delay+100).'ms !important; transition-delay:'.($delay+100).'ms !important; }
			 ';
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
		$options = $this->data['options'];

		$image_type = $this->opt('di_imgtype','macbook');

		$direction = $this->opt('di_direction','ltr');

		// Force LTR in case center is selected while Custom frame is defined aswell.
		// if($direction == 'center' && $image_type == 'custom_frame'){
		// 	$direction = 'ltr';
		// }

		$classes = array();
		$classes[] = 'el-di-type--'.$this->opt('di_type','vector');
		$classes[] = 'el-di-imgtype--'.$image_type;
		$classes[] = 'el-di-dir--'.$direction;
		$classes[] = $this->data['uid'];
		$classes[] = zn_get_element_classes($options);

		$attributes = zn_get_element_attributes($options);

		$appear_effect = $this->opt('di_appear','') == 1 ? 'el--appear el--appear-'.$this->opt('di_appear_effect','fadein') : '';
?>

<div class="el-di <?php echo implode(' ', $classes); ?>" <?php echo $attributes; ?>>

<?php if($image_type == 'macbook'){ ?>
	<?php if( $di_macbook_image = $this->opt('di_macbook_image','') ){ ?>
	<div class="el-di__laptop <?php echo $appear_effect; ?>">
		<img class="el-di__laptop-img cover-fit-img" src="<?php echo $di_macbook_image; ?>" <?php echo ZngetImageSizesFromUrl($di_macbook_image, true); ?> <?php echo ZngetImageAltFromUrl( $di_macbook_image, true ); ?> <?php echo ZngetImageTitleFromUrl( $di_macbook_image, true ); ?>>
	</div>
	<?php } ?>

<?php } else { ?>

	<?php if( $di_frame_image = $this->opt('di_frame_image','') ){ ?>
	<div class="el-di__frame <?php echo $appear_effect; ?>">
		<img class="el-di__frame-img cover-fit-img" src="<?php echo $di_frame_image; ?>" <?php echo ZngetImageSizesFromUrl($di_frame_image, true); ?> <?php echo ZngetImageAltFromUrl( $di_frame_image, true ); ?> <?php echo ZngetImageTitleFromUrl( $di_frame_image, true ); ?>>
	</div>
	<?php } ?>

<?php } ?>

	<?php if( ($di_iphone_image = $this->opt('di_iphone_image','')) && $direction != 'center' && $image_type != 'custom_frame' ){ ?>
	<div class="el-di__smartphone <?php echo $appear_effect; ?>">
		<img class="el-di__smartphone-img cover-fit-img" src="<?php echo $di_iphone_image; ?>" <?php echo ZngetImageSizesFromUrl($di_iphone_image, true); ?> <?php echo ZngetImageAltFromUrl( $di_iphone_image, true ); ?> <?php echo ZngetImageTitleFromUrl( $di_iphone_image, true ); ?>>
	</div>
	<?php } ?>

</div>

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
			'restrict' => array( 'appear_animation' ),

			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Main image type", 'zn_framework' ),
						"description" => __( "Select the main image type", 'zn_framework' ),
						"id"          => "di_imgtype",
						"std"         => "macbook",
						"type"        => "select",
						"options"     => array (
							"macbook" => __( "Laptop", 'zn_framework' ),
							"frame"    => __( "App Frames", 'zn_framework' ),
							"custom_frame"    => __( "Custom Sized App Frame", 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid,
							'val_prepend'  => 'el-di-imgtype--',
						),
					),

					array (
						"name"        => __( "Direction", 'zn_framework' ),
						"description" => __( "Select the direction of the images. ", 'zn_framework' ),
						"id"          => "di_direction",
						"std"         => "ltr",
						"type"        => "select",
						"options"     => array (
							"ltr" => __( "Left to right. Usually for RIGHT side placement.", 'zn_framework' ),
							"rtl"    => __( "Right to left. Usually for LEFT side placement.", 'zn_framework' ),
							"center"    => __( "Center display (Only Laptop or normal Frame)", 'zn_framework' ),
						),
						'live' => array(
							'type'      => 'class',
							'css_class' => '.'.$uid,
							'val_prepend'  => 'el-di-dir--',
						),
					),

					array (
						"name"        => __( "Max. Height ", 'zn_framework' ),
						"description" => __( "Maximum height (px)", 'zn_framework' ),
						"id"          => "di_center_height",
						"std"         => "100",
						"type"        => "slider",
						"helpers"     => array (
							"step" => "5",
							"min" => "100",
							"max" => "600"
						),
						"dependency"  => array(
							array( 'element' => 'di_direction' , 'value'=> array('center') ),
							array( 'element' => 'di_imgtype' , 'value'=> array('frame') )
						),
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$this->data['uid'].'.el-di-dir--center',
						   'css_rule'    => 'max-height',
						   'unit'        => 'px'
						),
					),

					array (
						"name"        => __( "Width ", 'zn_framework' ),
						"description" => __( "Frame width", 'zn_framework' ),
						"id"          => "di_custom_frame_width",
						"std"         => "1160",
						"type"        => "slider",
						"helpers"     => array (
							"step" => "5",
							"min" => "300",
							"max" => "1600"
						),
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('custom_frame') ),
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$uid.'.el-di-imgtype--custom_frame .el-di__frame',
						   'css_rule'    => 'width',
						   'unit'        => 'px'
						),
					),

					array (
						"name"        => __( "Height ", 'zn_framework' ),
						"description" => __( "Frame height", 'zn_framework' ),
						"id"          => "di_custom_frame_height",
						"std"         => "520",
						"type"        => "slider",
						"helpers"     => array (
							"step" => "5",
							"min" => "260",
							"max" => "900"
						),
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('custom_frame') ),
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$uid.'.el-di-imgtype--custom_frame .el-di__frame',
						   'css_rule'    => 'height',
						   'unit'        => 'px'
						),
					),

					array (
						"name"        => __( "Devices Type", 'zn_framework' ),
						"description" => __( "Select the type of devices images. The vector types looks more cartoonish.", 'zn_framework' ),
						"id"          => "di_type",
						"std"         => "vector",
						"type"        => "select",
						"options"     => array (
							"vector" => __( "Vector - Illustrations.", 'zn_framework' ),
							"img"    => __( "Normal - 3D Renderings.", 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook', 'frame') ),
						// 'live' => array(
						// 	'type'      => 'class',
						// 	'css_class' => '.'.$uid,
						// 	'val_prepend'  => 'el-di-type--',
						// ),
					),


					array (
						"name"        => __( "Appear on scroll?", 'zn_framework' ),
						"description" => __( "Start invisible and appear on scroll, when in viewport?", 'zn_framework' ),
						"id"          => "di_appear",
						"std"         => "",
						"value"         => "1",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Appear Effect", 'zn_framework' ),
						"description" => __( "Select the appear effect.", 'zn_framework' ),
						"id"          => "di_appear_effect",
						"std"         => "fadein",
						"type"        => "select",
						"options"     => array (
							"fadein" => __( "Fade IN", 'zn_framework' ),
							"sfl"    => __( "Slide from left", 'zn_framework' ),
							"sfr"    => __( "Slide from right", 'zn_framework' ),
							"sft"    => __( "Slide from top", 'zn_framework' ),
							"sfb"    => __( "Slide from bottom", 'zn_framework' ),
							"scale"    => __( "Scale IN", 'zn_framework' ),
						),
						"dependency"  => array( 'element' => 'di_appear' , 'value'=> array('1') )
					),

					array (
						"name"        => __( "Delay appearance (milliseconds)", 'zn_framework' ),
						"description" => __( "Delay the appearance? If multiple icon boxes, you can delay each one to appear sequentially. The numbers are in milliseconds.", 'zn_framework' ),
						"id"          => "di_appear_delay",
						"std"         => "0",
						"type"        => "slider",
						"helpers"     => array (
							"step" => "50",
							"min" => "0",
							"max" => "2500"
						),
						"dependency"  => array( 'element' => 'di_appear' , 'value'=> array('1') )
					),
				),
			),

			'image' => array(
				'title' => 'Image options',
				'options' => array(

					array (
						"name"        => __( "Image for Laptop", 'zn_framework' ),
						"description" => __( "Add an image to display inside the laptop. <br>
							Recommended image sizes:<br>
							Normal Macbook 3D rendering type - 836px x 530px <br>
							Vector Macbook Illustration render - 775px x 304px. ", 'zn_framework' ),
						"id"          => "di_macbook_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook') ),
					),

					array (
						"name"        => __( "Image for App Frame", 'zn_framework' ),
						"description" => __( "Add an image to display inside the App frame <br>
							Recommended image sizes: 1156px x 481px .", 'zn_framework' ),
						"id"          => "di_frame_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('frame', 'custom_frame') ),
					),

					array (
						"name"        => __( "Image for Iphone", 'zn_framework' ),
						"description" => __( "Add an image to display inside the smartphone. <br>
							Recommended image sizes:<br>
							Normal Iphone 3D rendering type - 170px x 301px <br>
							Vector Iphone Illustration rendering type - 171px x 236px <br>
						 ", 'zn_framework' ),
						"id"          => "di_iphone_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'di_imgtype' , 'value'=> array('macbook','frame') ),
					),

				),
			),

			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#xmNQYNuU2ms',
				'docs'    => 'http://support.hogash.com/documentation/devices-images/',
				'copy'    => $uid,
				'general' => true,
			)),

		);

		return $options;
	}
}

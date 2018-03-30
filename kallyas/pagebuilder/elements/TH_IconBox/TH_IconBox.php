<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Icon Box
 Description: Create and display an Icon Box element containing an icon, title description with different settings
 Class: TH_IconBox
 Category: content
 Level: 3
*/
/**
 * Class TH_IconBox
 *
 * Create and display an Icon Box element containing an icon, title description with different settings
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_IconBox extends ZnElements
{
	public static function getName(){
		return __( "Icon Box", 'zn_framework' );
	}

	/**
	 * Output the inline css to head or after the element in case it is loaded via ajax
	 */
	function css(){
		$css = '';
		$uid = $this->data['uid'];
		$icon_type = $this->opt('ibx_type', 'icon');

		// Title Styles
		$title_styles = '';
		$title_topmargin = $this->opt('ibx_floated_topmarg','0');
		if($title_topmargin != '0'){
			$title_styles .= 'margin-top:'. $title_topmargin.'px;';
		}
		$title_typo = $this->opt('title_typo');
		if( is_array($title_typo) && !empty($title_typo) ){
			foreach ($title_typo as $key => $value) {
				if(!empty($value)){
					if( $key == 'font-family' ){
						$title_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$title_styles .= $key .':'. $value.';';
					}
				}
			}
		}
		if(!empty($title_styles)){
			$css .= '.'.$uid.' .kl-iconbox__title {'.$title_styles.'} ';
		}


		// Description styles
		$desc_styles = '';
		$desc_typo = $this->opt('desc_typo');
		if( is_array($desc_typo) && !empty($desc_typo) ){
			foreach ($desc_typo as $key => $value) {
				if(!empty($value)){
					if( $key == 'font-family' ){
						$desc_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$desc_styles .= $key .':'. $value.';';
					}
				}
			}
			$css .= '.'.$uid.' .kl-iconbox__desc {'.$desc_styles.'} ';
		}

		// Icon color default and on hover
		$ibx_shape = $this->opt('ibx_shape', '');
		if( $this->opt('ibx_type', 'icon') == 'icon' ){

			$ibx_icon_color = $this->opt('ibx_icon_color', '#343434' );
			$ibx_icon_color_hover = $this->opt('ibx_icon_color_hover', '#cd2122' );

			$cc_stroke_box_sh = '';
			$cc_stroke_box_sh_hov = '';
			if( $ibx_shape == 'sh-circle-stroke' ){
				$cc_stroke_box_sh = 'box-shadow: 0 0 0 2px '.$ibx_icon_color.';';
				$cc_stroke_box_sh_hov = 'box-shadow: 0 0 0 4px '.$ibx_icon_color_hover.';';
			}

			$css .= '.'.$uid.' .kl-iconbox__icon {color:'.$ibx_icon_color.'; '.$cc_stroke_box_sh.'} ';
			$css .= '.'.$uid.':hover .kl-iconbox__icon {color:'.$ibx_icon_color_hover.'; '.$cc_stroke_box_sh_hov.'} ';

			// If has a shape behind
			if( $ibx_shape != '' && $ibx_shape != 'sh-circle-stroke' ){
				$css .= '.'.$uid.'.kl-iconbox--sh span.kl-iconbox__icon {background-color:'.$this->opt('ibx_shape_color', '#dfdfdf' ).'} ';
				$css .= '.'.$uid.'.kl-iconbox--sh span.kl-iconbox__icon:after {background-color:'.$this->opt('ibx_shape_color_hover', '#cd2122' ).'} ';
			}
		}

		// Icon sizes
		$icon_size = $this->opt('ibx_size','42');
		if( $icon_size != '42' && $icon_type == 'icon'){
			$css .= ".{$uid} span.kl-iconbox__icon { font-size: {$icon_size}px }";
		}

		// Image size
		$img_size = $this->opt('ibx_imgwidth','100');
		if( $img_size != '100' && $icon_type == 'img'){
			$css .= ".{$uid} img.kl-iconbox__icon { max-width: {$img_size}px }";
		}

		// Icon Shaped Padding
		$ibx_shaped_padding = $this->opt('ibx_shaped_padding','22');
		if( $ibx_shaped_padding != '22' && $ibx_shape != '' ){
			$css .= ".{$uid} span.kl-iconbox__icon { padding: {$ibx_shaped_padding}px }";
		}

		// Icon Opacity
		$ibx_opacity = $this->opt('ibx_opacity','100');
		if( $ibx_opacity != '100' && $ibx_opacity != '' ){
			$css .= '.'.$uid.' .kl-iconbox__icon {opacity: '.($ibx_opacity/100).'; }';
		}


		// Add delay transitions
		// if( $this->opt('ibx_appear', '') == '1' ){
		// 	$css .= '.'.$uid.'.el--appear { -webkit-transition-delay:'.$this->opt('ibx_appear_delay', '0').'ms !important; transition-delay:'.$this->opt('ibx_appear_delay', '0').'ms !important; } ';

		// }

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

		$link_start = '';
		$link_end = '';

		// $appear = $this->opt('ibx_appear','');

		$ibx_floated = $this->opt('ibx_floated','');

		$link_type = $this->opt('ibx_link_type','0');
		$link_style = $link_type == 'cta' ? 'btn btn-fullcolor' : 'kl-iconbox__link';
		$ibx_link = $this->opt('ibx_link');
		$link_extracted = $ibx_link ? zn_extract_link( $ibx_link, $link_style ) : '';

		// Check if link is wrapped on Icon or Both Icon & Title
		if( $link_type == 'icon' || $link_type == 'icontitle' ){
			if (!empty($link_extracted)) {
				$link_start = $link_extracted['start'];
				$link_end = $link_extracted['end'];
			}
		}
		// Check if link is wrapped on Title or Both Icon & Title
		elseif( $link_type == 'title' || $link_type == 'icontitle' ){
			if (!empty($link_extracted)) {
				$link_start = $link_extracted['start'];
				$link_end = $link_extracted['end'];
			}
		}
		//  Check if link is displayed separately as a Call to action button
		elseif( $link_type == 'cta' ){
			$link_text = '';
			if ( is_array( $ibx_link ) || !empty( $ibx_link['title'] ) ) {
				$link_text = $ibx_link['title'];
			}
			$link_start = $link_extracted['start'] . $link_text . $link_extracted['end'];
		}

		// Title
		$titlefirst = $this->opt('ibx_titleorder', '1') == 1;
		$titlehtml = '';
		if( $title = $this->opt('ibx_title') ){
			// Check if title has link
			if( $link_type == 'title' || $link_type == 'icontitle' ){
				$title = $link_start.$title.$link_end;
			}
			$titlehtml = '
			<div class="kl-iconbox__el-wrapper kl-iconbox__title-wrapper">
				<h3 class="kl-iconbox__title element-scheme__hdg1" '.WpkPageHelper::zn_schema_markup('title').'>'.$title.'</h3>
			</div>';
		}

		// Stage points
		$points = '';
		$ibstg_point_stage = $this->opt('ibstg_point_stage');
		if( !empty($ibstg_point_stage) ){
			$points .= ' data-stageid="'.str_replace(' ', '',$ibstg_point_stage).'"';
			// point coordinates of the stage
			$pointv = $this->opt('ibstg_point','');
			$x = '';
			$y = '';
			if(!empty($pointv)){
				$pointv = explode(',', $pointv);
				if(is_array($pointv)){
					$x = $pointv['0'];
					$y = $pointv['1'];
				}
			}
			$points .= ' data-pointx="'.$x.'"';
			$points .= ' data-pointy="'.$y.'"';
			//  add title tooltip
			if( $this->opt('ibstg_point_title','') ){
				$points .= ' data-pointtitle="'.$this->opt('ibstg_point_title').'"';
			}
			//  add point number
			if( $this->opt('ibstg_point_nr','') ){
				$points .= ' data-point-number="'.$this->opt('ibstg_point_nr','').'"';
			}
		}

		// Icon
		$icon_type = $this->opt('ibx_type', 'icon');

		// States and modificators
		$mods = array();
		$mods[] = $this->data['uid'];
		$mods[] = zn_get_element_classes($options);
		$attributes = zn_get_element_attributes($options);

		$mods[] = ' kl-iconbox--type-'.$icon_type;
		$mods[] = $this->opt('ibx_shape','') ? 'kl-iconbox--sh kl-iconbox--'.$this->opt('ibx_shape','') : '';
		$mods[] = $this->opt('ibx_floated','') ? 'kl-iconbox--'.$this->opt('ibx_floated','') : '';
		$mods[] = 'kl-iconbox--align-'.$this->opt('ibx_alignment','left').' text-'.$this->opt('ibx_alignment','left');
		// $mods[] = $appear == 1 ? 'el--appear el--appear-fadein' : '';

		$color_scheme = $this->opt( 'ibx_color_theme', '' ) == '' || $this->opt( 'ibx_color_theme', '' ) == 'default' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'ibx_color_theme', '' );
		$mods[] = 'kl-iconbox--theme-'.$color_scheme;
		$mods[] = 'element-scheme--'.$color_scheme;


?>
<div class="kl-iconbox <?php echo implode(' ', $mods); ?>" <?php echo $points; ?> <?php echo $attributes; ?>>
	<div class="kl-iconbox__inner clearfix">

		<?php
		// Display title
		if($titlefirst && $ibx_floated == ''){
			echo $titlehtml;
		}
		?>

		<?php
		$theicon = $this->opt('ibx_icon', '');
		$icon_img = $this->opt('ibx_image','');
		// Check if icon
		if( (is_array($theicon) && !empty($theicon['unicode']) && $icon_type == 'icon') || (!empty($icon_img) && $icon_type == 'img') ){

			// Add floating animation?
			$floating_animation = $this->opt('floating_animation','no') == 'yes' ? 'kl-iconbox-AnimateFloat':'' ;
		?>
		<div class="kl-iconbox__icon-wrapper <?php echo $floating_animation; ?>">
			<?php
			if( $link_type == 'icon' || $link_type == 'icontitle' ){
				echo $link_start;
			}
			// Icon Font
			if( $icon_type == 'icon'){
				if( is_array($theicon) && !empty($theicon['unicode']) ){
					echo '<span class="kl-iconbox__icon kl-iconbox__icon--'.$this->opt('force_square','').'" '. zn_generate_icon( $this->opt('ibx_icon') ) .'></span>';
				}
			}
			// Icon Image
			elseif ($icon_type == 'img'){
				if(!empty($icon_img)){
					echo '<img class="kl-iconbox__icon" src="' . $icon_img . '" '.ZngetImageSizesFromUrl($icon_img, true).' alt="'. ZngetImageAltFromUrl( $icon_img ) .'" title="'.ZngetImageTitleFromUrl( $icon_img ).'">';
				}
			}
			if( $link_type == 'icon' || $link_type == 'icontitle' ){
				echo $link_end;
			}
			?>
		</div><!-- /.kl-iconbox__icon-wrapper -->
		<?php } ?>

		<?php

		// Circle Icon
		if($icon_type == 'kicon_circle'){
			echo $link_start;
			echo '<span class="playVideo playvideo-size--'.$this->opt('playsize','md').'"></span>';
			echo $link_end;
		}
		elseif($icon_type == 'kicon_mscroll'){
			echo $link_start;
			echo '<span class="mouse-anim-icon"></span>';
			echo $link_end;
		}
		elseif($icon_type == 'kicon_circle_anim'){
			echo $link_start;
			echo '
			<div class="circleanim-svg circleanim-svg-size--'.$this->opt('playsize','lg').'">
				<div class="circleanim-svg-inner">
				<svg height="108" width="108" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet" viewBox="0 0 108 108">
					<circle stroke-opacity="0.1" fill="#FFFFFF" stroke-width="5" cx="54" cy="54" r="48" class="circleanim-svg__circle-back"></circle>
					<circle stroke-width="5" fill="#FFFFFF" cx="54" cy="54" r="48" class="circleanim-svg__circle-front" transform="rotate(50 54 54) "></circle>
					<path d="M62.1556183,56.1947505 L52,62.859375 C50.6192881,63.7654672 49.5,63.1544098 49.5,61.491212 L49.5,46.508788 C49.5,44.8470803 50.6250889,44.2383396 52,45.140625 L62.1556183,51.8052495 C64.0026693,53.0173767 63.9947588,54.9878145 62.1556183,56.1947505 Z" fill="#FFFFFF"></path>
				</svg>
				</div>
			</div>';
			echo $link_end;
		}



		?>

		<div class="kl-iconbox__content-wrapper">

			<?php
			// Display title after icon
			if( !$titlefirst ){
				echo $titlehtml;
			}

			// If floated style is selected, force title to display here
			else if( $titlefirst && $ibx_floated != '' ) {
				echo $titlehtml;
			}
			?>

			<?php if( $desc = $this->opt('ibx_desc') ): ?>
			<div class=" kl-iconbox__el-wrapper kl-iconbox__desc-wrapper">
				<p class="kl-iconbox__desc"><?php echo $desc; ?></p>
			</div>
			<?php endif; ?>

			<?php if( $link_type == 'cta' ): ?>
			<div class="kl-iconbox__el-wrapper kl-iconbox__cta-wrapper">
				<?php echo $link_start; ?>
			</div>
			<?php endif; ?>

		</div><!-- /.kl-iconbox__content-wrapper -->

	</div>
</div>

<?php
// print_r($this);
	}

	/**
	 * This method is used to retrieve the configurable options of the element.
	 * @return array The list of options that compose the element and then passed as the argument for the render() function
	 */
	function options()
	{
		$uid = $this->data['uid'];

		return array (
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array (
						"name"        => __( "Link Type", 'zn_framework' ),
						"description" => __( "Link type of the icon box.", 'zn_framework' ),
						"id"          => "ibx_link_type",
						"std"         => "0",
						"type"        => "select",
						"options"     => array (
							'0' => __( 'No Link', 'zn_framework' ),
							'icon' => __( 'Link wrapping the Icon', 'zn_framework' ),
							'title' => __( 'Link wrapping the Title', 'zn_framework' ),
							'cta' => __( 'Call to action link', 'zn_framework' ),
							'icontitle' => __( 'Link wrapping both Icon and Title', 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "The link", 'zn_framework' ),
						"description" => __( "Add a link here. For call to action button, title is used as anchor text.", 'zn_framework' ),
						"id"          => "ibx_link",
						"std"         => "",
						"type"        => "link",
						"options"     => zn_get_link_targets(),
						"dependency"  => array( 'element' => 'ibx_link_type' , 'value'=> array('icon','title','cta','icontitle') )
					),

					array (
						"name"        => __( "Icon Type", 'zn_framework' ),
						"description" => __( "Type of the icon.", 'zn_framework' ),
						"id"          => "ibx_type",
						"std"         => "icon",
						"type"        => "select",
						"options"     => array (
							'icon' => __( 'Font Icon', 'zn_framework' ),
							'img' => __( 'Image (PNG, JPG, SVG or even GIF)', 'zn_framework' ),
							'kicon_circle' => __( 'Kallyas Icon - Circle Play', 'zn_framework' ),
							'kicon_circle_anim' => __( 'Kallyas Icon - Circle Play Animated', 'zn_framework' ),
							'kicon_mscroll' => __( 'Kallyas Icon - Mouse Scroll', 'zn_framework' ),
						),
					),

					array (
						"name"        => __( "Image Icon", 'zn_framework' ),
						"description" => __( "Upload an Icon Image.", 'zn_framework' ),
						"id"          => "ibx_image",
						"std"         => "",
						"type"        => "media",
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('img') ),
					),

					array (
						"name"        => __( "Select Icon", 'zn_framework' ),
						"description" => __( "Select an icon to display.", 'zn_framework' ),
						"id"          => "ibx_icon",
						"std"         => "",
						"type"        => "icon_list",
						'class'       => 'zn_icon_list',
						'compact'       => true,
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
					),

					array (
						"name"        => __( "Play button size", 'zn_framework' ),
						"description" => __( "Select the size of the play button.", 'zn_framework' ),
						"id"          => "playsize",
						"std"         => "md",
						"type"        => "select",
						"options"		=> array(
							"xs" => "Extra Small",
							"sm" => "Small",
							"md" => "Medium",
							"lg" => "Large",
							"xl" => "Extra Large",
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('kicon_circle', 'kicon_circle_anim') ),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid.' .playVideo',
									'val_prepend'  => 'playvideo-size--',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid.' .circleanim-svg',
									'val_prepend'  => 'circleanim-svg-size--',
								)
							)
						),


					),

					array (
						"name"        => __( "Title", 'zn_framework' ),
						"description" => __( "Title text.", 'zn_framework' ),
						"id"          => "ibx_title",
						"std"         => "",
						"type"        => "text"
					),

					array (
						"name"        => __( "Description", 'zn_framework' ),
						"description" => __( "Description text.", 'zn_framework' ),
						"id"          => "ibx_desc",
						"std"         => "",
						"type"        => "textarea"
					),

				),
			),
			'styling' => array(
				'title' => 'Style options',
				'options' => array(

					// POSITIONING
					array (
						"name"        => __( "Icons Alignment" , 'zn_framework' ),
						// "description" => __( ".", 'zn_framework' ),
						"id"          => "ibstg_docs",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn-custom-title-large"
					),

					array (
						"name"        => __( "Box Alignment", 'zn_framework' ),
						"description" => __( "Alignment for the content inside the box.", 'zn_framework' ),
						"id"          => "ibx_alignment",
						"std"         => "left",
						"type"        => "select",
						"options"     => array (
							'left' => __( 'Align LEFT', 'zn_framework' ),
							'center' => __( 'Align CENTER', 'zn_framework' ),
							'right' => __( 'Align RIGHT', 'zn_framework' ),
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'        => 'class',
								   'css_class' => '.'.$uid,
								   'val_prepend'   => 'kl-iconbox--align-',
								),
								array(
									'type'        => 'class',
								   'css_class' => '.'.$uid,
								   'val_prepend'   => 'text-',
								),
							)

						)
					),

					array (
						"name"        => __( "Floated Style?", 'zn_framework' ),
						"description" => __( "Is the box left or right floated? Don't confuse with alignment.", 'zn_framework' ),
						"id"          => "ibx_floated",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( 'No', 'zn_framework' ),
							'fleft' => __( 'Yes - Left floated', 'zn_framework' ),
							'fright' => __( 'Yes - Right floated', 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon', 'img') ),
					),

					// COLORS
					array (
						"name"        => __( "Icons Color Styles" , 'zn_framework' ),
						// "description" => __( ".", 'zn_framework' ),
						"id"          => "ibstg_docs",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn-custom-title-large"
					),

					array (
						"name"        => __( "Icon Color", 'zn_framework' ),
						"description" => __( "Color of the icon.", 'zn_framework' ),
						"id"          => "ibx_icon_color",
						"std"         => "#343434",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$uid.' span.kl-iconbox__icon',
						   'css_rule'    => 'color',
						   'unit'        => ''
						),
					),

					array (
						"name"        => __( "Icon Hover Color", 'zn_framework' ),
						"description" => __( "Hover Color of the icon.", 'zn_framework' ),
						"id"          => "ibx_icon_color_hover",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
					),

				   array (
						"name"        => __( "Shaped Background Icon?", 'zn_framework' ),
						"description" => __( "Display the icon in a shape with hover effects? Available only for icon fonts to control the hover color.", 'zn_framework' ),
						"id"          => "ibx_shape",
						"std"         => "",
						"type"        => "select",
						"options"     => array (
							'' => __( 'No', 'zn_framework' ),
							'sh-circle' => __( 'Yes - Circle with hover', 'zn_framework' ),
							'sh-circle-stroke' => __( 'Yes - Circle Stroke with hover', 'zn_framework' ),
							'sh-square' => __( 'Yes - Square with hover', 'zn_framework' )
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
						'live' => array(
						   'type'        => 'class',
						   'css_class' => '.'.$uid,
						   'val_prepend'   => 'kl-iconbox--sh kl-iconbox--',
						)
					),

					array (
						"name"        => __( "Shape Background Color", 'zn_framework' ),
						"description" => __( "Background Color of the shape behind the icon.", 'zn_framework' ),
						"id"          => "ibx_shape_color",
						"std"         => "#dfdfdf",
						"type"        => "colorpicker",
						"dependency"  => array(
							array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
							array( 'element' => 'ibx_shape' , 'value'=> array('sh-circle', 'sh-square') ),
						),
						'live' => array(
						   'type'        => 'css',
						   'css_class' => '.'.$uid.'.kl-iconbox--sh span.kl-iconbox__icon',
						   'css_rule'    => 'background-color',
						   'unit'        => ''
						),
					),

					array (
						"name"        => __( "Shape Background Hover Color", 'zn_framework' ),
						"description" => __( "Hover background color of the shape behind the icon.", 'zn_framework' ),
						"id"          => "ibx_shape_color_hover",
						"std"         => "#cd2122",
						"type"        => "colorpicker",
						"dependency"  => array(
							array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
							array( 'element' => 'ibx_shape' , 'value'=> array('sh-circle', 'sh-square') ),
						),
					),

					array (
						"name"        => __( "Force equal shape", 'zn_framework' ),
						"description" => __( "Enable if you want to force the shape to be equal (eg: perfect circle, perfect square).", 'zn_framework' ),
						"id"          => "force_square",
						"std"         => "",
						'type'        => 'select',
						'options'     => array(
							'' => 'No',
							'force-square' => 'Yes'
						),
						'live' => array(
							'type'        => 'class',
							'css_class' => '.'.$uid .' span.kl-iconbox__icon',
							'val_prepend'   => 'kl-iconbox__icon--',
						),
						"dependency"  => array(
							array( 'element' => 'ibx_type' , 'value'=> array('icon')),
							array( 'element' => 'ibx_shape' , 'value'=> array('sh-circle', 'sh-square', 'sh-circle-stroke') )
						),
					),

					array(
						'id'          => 'ibx_color_theme',
						'name'        => 'Element Color Scheme',
						'description' => 'Select the color scheme of this element',
						'type'        => 'select',
						'std'         => '',
						'options'        => array(
							'' => 'Inherit from Kallyas options > Color Options [Requires refresh]',
							'light' => 'Light (default)',
							'dark' => 'Dark'
						),
						'live'        => array(
							'multiple' => array(
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'kl-iconbox--theme-',
								),
								array(
									'type'      => 'class',
									'css_class' => '.'.$uid,
									'val_prepend'  => 'element-scheme--',
								),
							)
						)
					),

					array (
						"name"        => __( "Icon Opacity", 'zn_framework' ),
						"description" => __( "Select the opacity of the icon.", 'zn_framework' ),
						"id"          => "ibx_opacity",
						"std"         => "100",
						'type'        => 'slider',
						// 'class'       => 'zn_full',
						"helpers"     => array (
							"step" => "5",
							"min" => "0",
							"max" => "100"
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon', 'img') ),
					),

					// SIZING
					array (
						"name"        => __( "Icons Sizing" , 'zn_framework' ),
						// "description" => __( ".", 'zn_framework' ),
						"id"          => "ibstg_docs",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn-custom-title-large"
					),

					array (
						"name"        => __( "Icon Size", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "ibx_size",
						"std"         => "42",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' span.kl-iconbox__icon',
							'css_rule'  => 'font-size',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('icon') ),
					),

					array (
						"name"        => __( "Image Size", 'zn_framework' ),
						"description" => __( "Select the size of the image.", 'zn_framework' ),
						"id"          => "ibx_imgwidth",
						"std"         => "100",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '10',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' img.kl-iconbox__icon',
							'css_rule'  => 'max-width',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'ibx_type' , 'value'=> array('img') ),
					),

					array (
						"name"        => __( "Icon Padding (Shaped)", 'zn_framework' ),
						"description" => __( "Select the size of the icon.", 'zn_framework' ),
						"id"          => "ibx_shaped_padding",
						"std"         => "22",
						'type'        => 'slider',
						'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '2',
							'max' => '400',
							'step' => '1'
						),
						'live' => array(
							'type'      => 'css',
							'css_class' => '.'.$uid .' span.kl-iconbox__icon',
							'css_rule'  => 'padding',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'ibx_shape' , 'value'=> array('sh-circle', 'sh-square', 'sh-circle-stroke') ),
					),

					array (
						"name"        => __( "Others" , 'zn_framework' ),
						// "description" => __( ".", 'zn_framework' ),
						"id"          => "ibstg_docs",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn-custom-title-large"
					),

					array (
						"name"        => __( "Add Floating Animation", 'zn_framework' ),
						"description" => __( "Enable this if you want to apply a floating up and down animation.", 'zn_framework' ),
						"id"          => "floating_animation",
						"std"         => "no",
						'type'        => 'zn_radio',
						'options'     => array(
							'no' => 'No',
							'yes' => 'Yes'
						),
						'class'        => 'zn_radio--yesno',
						"dependency"  => array(
							array( 'element' => 'ibx_type' , 'value'=> array('icon', 'img' ))
						),
					),

				),
			),

			'font_options' => array(
				'title' => 'Font Options',
				'options' => array(

					array (
						"name"        => __( "Title settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
						"id"          => "title_typo",
						"std"         => array (
							'font-size'   => '20px',
							'font-family'   => 'Open Sans',
							'line-height' => '30px',
							'font-style' => 'normal',
							'font-weight' => '400',
						),
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .kl-iconbox__title',
						),
					),

					array (
						"name"        => __( "Title first?", 'zn_framework' ),
						"description" => __( "Display the title first?", 'zn_framework' ),
						"id"          => "ibx_titleorder",
						"std"         => "",
						"value"       => "1",
						"type"        => "toggle2",
					),

					array (
						"name"        => __( "Title Top Margin", 'zn_framework' ),
						"description" => __( "Select the top margin of the title.", 'zn_framework' ),
						"id"          => "ibx_floated_topmarg",
						"std"         => "0",
						'type'        => 'slider',
						// 'class'       => 'zn_full',
						"helpers"     => array (
							"step" => "1",
							"min" => "0",
							"max" => "100"
						),
						'live' => array(
							'type'        => 'css',
							'css_class' => '.'.$uid.' .kl-iconbox__title',
							'css_rule'  => 'margin-top',
							'unit'      => 'px'
						),
						"dependency"  => array( 'element' => 'ibx_floated' , 'value'=> array('fleft','fright') )
					),

					array (
						"name"        => __( "Description text settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the description text.", 'zn_framework' ),
						"id"          => "desc_typo",
						"std"         => array (
							'font-size'   => '13px',
							'font-family'   => 'Open Sans',
							'line-height' => '24px',
							'font-style' => 'normal',
							'font-weight' => '400',
						),
						'supports'   => array( 'size', 'font', 'style', 'line', 'weight', 'color' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .kl-iconbox__desc',
						),
					),
				)
			),

			'stage_options' => array(
				'title' => 'Advanced Options',
				'options' => array(
					array (
						"name"        => __( "Hover Stage Points" , 'zn_framework' ),
						"description" => __( "Use the feature to display a target point onto a \"Stage object element\". First create the Stage element and customise it, then, copy the ID below.", 'zn_framework' ),
						"id"          => "ibstg_docs",
						"std"         => "",
						"type"        => "zn_title",
						"class"       => "zn_full zn-custom-title-large"
					),

					array (
						"name"        => __( "Point Target Stage ID", 'zn_framework' ),
						"description" => __( "Copy the ID from the Stage element you want to add points to.", 'zn_framework' ),
						"id"          => "ibstg_point_stage",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: eluidbacf913d",
					),

					array (
						"name"        => __( "Point Coordinates", 'zn_framework' ),
						"description" => __( "This will add an animated dot onto the stage image with the X and Y coordinates you provide. In px add \"x, y\" coordinates - X being distance from left and Y distance from top.", 'zn_framework' ),
						"id"          => "ibstg_point",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "ex: 100, 125",
					),

					array (
						"name"        => __( "Point Tootip", 'zn_framework' ),
						"description" => __( "Add a custom tooltip text. Leave empty if you don't want to display a tooltip.", 'zn_framework' ),
						"id"          => "ibstg_point_title",
						"std"         => "",
						"type"        => "text",
					),

					array (
						"name"        => __( "Point Number", 'zn_framework' ),
						"description" => __( "Add a custom number or symbol to be displayed inside the point.", 'zn_framework' ),
						"id"          => "ibstg_point_nr",
						"std"         => "",
						"type"        => "text",
					),
				),
			),


			'help' => znpb_get_helptab( array(
				'video'   => 'http://support.hogash.com/kallyas-videos/#F1ttWpjkKqQ',
				'docs'    => 'http://support.hogash.com/documentation/icon-box/',
				'copy'    => $uid,
				'general' => true,
			)),

		);
	}
}

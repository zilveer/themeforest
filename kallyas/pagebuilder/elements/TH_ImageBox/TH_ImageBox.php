<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Image Box
 Description: Create and display an Image Box element
 Class: TH_ImageBox
 Category: content, media
 Keywords: imagebox, image, picture, photo
 Level: 3
*/
	/**
	 * Class TH_ImageBox
	 *
	 * Create and display an Image Box element
	 *
	 * @package  Kallyas
	 * @category Page Builder
	 * @author   Team Hogash
	 * @since    3.8.0
	 */
	class TH_ImageBox extends ZnElements
	{
		public static function getName(){
			return __( "Image Box", 'zn_framework' );
		}


		/**
		 * Output the inline css to head or after the element in case it is loaded via ajax
		 */
		function css(){

			$uid = $this->data['uid'];
			$css = '';

			// Title Styles
			$title_styles = '';
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
				if(!empty($title_styles)){
					$css .= '.'.$uid.'.image-boxes .image-boxes-title{'.$title_styles.'}';
				}
			}

			// Desc. Styles
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
				if(!empty($desc_styles)){
					$css .= '.'.$uid.'.image-boxes .image-boxes-text{'.$desc_styles.'}';
				}
			}



			// Image height
			if($this->opt('image_box_imgfit','no') == 'cover-fit-img'){
				$height = $this->opt('image_box_height','280');
				if(!empty($height)){
					$css .= '.'.$uid.'.image-boxes .image-boxes-img-wrapper{height:'.$height.'px}';
				}
			}

			// Corner Radius
			if($this->opt('corner_radius','0') != '0'){
				$css .= '.'.$uid.' .image-boxes-img{border-radius:'.$this->opt('corner_radius','0').'px}';
			}

			// margin-bottom bkwards cpt.
			$ib_margin_std = array('bottom' => '30px');
			// backwards compatibility
			if(isset($this->data['options']['ib_bottom_margin']) && $this->data['options']['ib_bottom_margin'] != '' ){
				$ib_margin_std['bottom'] = $this->data['options']['ib_bottom_margin'];
			}

			// Margin
			if( $this->opt('cc_margin_lg', $ib_margin_std ) || $this->opt('cc_margin_md', '' ) || $this->opt('cc_margin_sm', '' ) || $this->opt('cc_margin_xs', '' ) ){
				$css .= zn_push_boxmodel_styles(array(
						'selector' => '.'.$uid,
						'type' => 'margin',
						'lg' =>  $this->opt('cc_margin_lg', $ib_margin_std ),
						'md' =>  $this->opt('cc_margin_md', '' ),
						'sm' =>  $this->opt('cc_margin_sm', '' ),
						'xs' =>  $this->opt('cc_margin_xs', '' ),
					)
				);
			}
			// Padding
			if( $this->opt('cc_padding_lg', '' ) || $this->opt('cc_padding_md', '' ) || $this->opt('cc_padding_sm', '' ) || $this->opt('cc_padding_xs', '' ) ){
				$css .= zn_push_boxmodel_styles(array(
						'selector' => '.'.$uid,
						'type' => 'padding',
						'lg' =>  $this->opt('cc_padding_lg', '' ),
						'md' =>  $this->opt('cc_padding_md', '' ),
						'sm' =>  $this->opt('cc_padding_sm', '' ),
						'xs' =>  $this->opt('cc_padding_xs', '' ),
					)
				);
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

			$elm_classes = array();
			$elm_classes[] = $uid = $this->data['uid'];
			$elm_classes[] = zn_get_element_classes($options);
			$attributes = zn_get_element_attributes($options);

			$slide_image = $this->opt( 'image_box_image', false );

			$image      = '';
			$title      = '';
			$text       = '';
			$link_text  = '';

			// Object Parallax
			if( $this->opt('obj_parallax_enable','') == 'yes' ){
				$elm_classes[] = 'znParallax-object';
				$obj_distance = $this->opt('obj_parallax_distance','100')/2;
				$parallaxObject = array(
					"scene" => array(
						'triggerHook' => 'onEnter',
						'triggerElement' => '.'.$uid,
						'duration' => 'force_full',
					),
					"tween" => array(
						'speed' => $this->opt('obj_parallax_speed','800')/1000,
						'reverse' => $this->opt('obj_parallax_reverse','') == 'yes' ? 'true':'false',
						'css' => array(
							"y" => array( "from" => -$obj_distance, "to" => $obj_distance )
						),
						'easing' => $this->opt('obj_parallax_easing', 'Power1.easeOut')
					),
				);
				$attributes .= ' data-zn-parallax-obj=\''.json_encode($parallaxObject).'\'';
			}

			// Title
			if ( ! empty ( $options['image_box_title'] ) ) {
				$title = '<h3 class="m_title m_title_ext text-custom imgboxes-title image-boxes-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['image_box_title'] . '</h3>';
			}

			// TEXT
			if ( ! empty ( $options['image_box_text'] ) ) {
				$text = $options['image_box_text'];
			}

			// READ MORE TEXT
			if ( ! empty ( $options['image_box_link_text'] ) ) {
				$link_text = '<span class="kl-main-bgcolor image-boxes-readon u-trans-all-2s">' . $options['image_box_link_text'] . '</span>';
			}

			// Check to see if we have an image
			if ( $slide_image ) {

				$saved_alt   = ZngetImageAltFromUrl( $slide_image, true );
				$saved_title = ZngetImageTitleFromUrl( $slide_image, true );

				if ( is_array( $slide_image ) ) {

					if ( $saved_image = $slide_image['image'] ) {

						// Image alt
						if ( ! empty( $slide_image['alt'] ) ) {
							$saved_alt = 'alt="' . $slide_image['alt'] . '"';
						}

						// Image title
						if ( ! empty( $slide_image['title'] ) ) {
							$saved_title = 'title="' . $slide_image['title'] . '"';
						}
					}
				}
				else {
					$saved_image = $slide_image;
				}
			}

			$fitimg = ($this->opt('image_box_imgfit','no') != 'no' ? 'cover-fit-img' : '');
			if(!empty($fitimg)){
				$elm_classes[] = ' image-boxes-cover-fit-img';
			}

			$img_boxes_wrapper_classes = array();
			$img_boxes_wrapper_classes[] = $this->opt('image_box_shadow','') ? 'znBoxShadow-'.$this->opt('image_box_shadow','') : '';
			$img_boxes_wrapper_classes[] = $this->opt('image_box_shadow_hover','') ? 'znBoxShadow--hov-'.$this->opt('image_box_shadow_hover',''). ' znBoxShadow--hover' : '';

			// Display the element based on what style is chosen

/**
 * --------------------------------
 * STYLE 2 - IMAGE IS ON THE RIGHT
 * --------------------------------
 */
			if ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style2' ) {
				$elm_classes[] = ' imgboxes_style1 zn_ib_style2';

				// IMAGE
				if ( ! empty ( $saved_image ) ) {
					$image = vt_resize( '', $saved_image, '220', '156', true );
					$image = '<div class="image-boxes-img-wrapper"><img class="image-boxes-img '.$fitimg.'" src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '" ' . $saved_alt . ' ' . $saved_title . ' /></div>';
				}

				// Reset link's bottom margin if no title or text under the image link
				$img_boxes_wrapper_classes[] = !$text ? 'u-mb-0' : '';
				$implode_classes = implode(' ', $img_boxes_wrapper_classes);

				$image_box_link = zn_extract_link(
					$this->opt('image_box_link',''),
					'imgboxes-wrapper image-boxes-link hoverBorder alignright '.$implode_classes,
					'',
					'<div class="imgboxes-wrapper zn_image_box_cont image-boxes-holder alignright '.$implode_classes.'">',
					'</div>'
				);

				echo '<div class="box image-boxes image-boxes--2 '.implode(' ', $elm_classes).'" '.$attributes.'>';

					echo $title;

					if(!empty($image)){
						echo $image_box_link['start'];
							echo $image;
						echo $image_box_link['end'];
					}

					echo '<div class="image-boxes-text">'.$text.'</div>';

				echo '</div>';
			}

/**
 * --------------------------------
 * STYLE 3 - CONTENT IS OVER IMAGE
 * --------------------------------
 */
			elseif ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style3' ) {
				$elm_classes[] = ' imgboxes_style2';
				// IMAGE
				if ( ! empty ( $saved_image ) ) {
					$image = '<div class="image-boxes-img-wrapper"><img class="image-boxes-img '.$fitimg.' sliding-details-img" src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' ' . $saved_alt . ' ' . $saved_title . ' /></div>';
				}

				$implode_classes = implode(' ', $img_boxes_wrapper_classes);

				$image_box_link = zn_extract_link(
					$this->opt('image_box_link',''),
					'imgboxes-wrapper image-boxes-link slidingDetails sliding-details u-mb-0 '.$implode_classes,
					'',
					'<div class="imgboxes-wrapper image-boxes-holder sliding-details u-mb-0 '.$implode_classes.'">',
					'</div>'
				);

				// Title
				if ( ! empty ( $options['image_box_title'] ) ) {
					$title = '<h4 class="image-boxes-title sliding-details-title" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['image_box_title'] . '</h4>';
				}

				echo '<div class="box image-boxes image-boxes--3 '.implode(' ', $elm_classes).'" '.$attributes.'>';

				if(!empty($image)){
					echo $image_box_link['start'];
						echo $image;
						echo '<div class="details sliding-details-content">';
							echo $title;
							echo '<div class="image-boxes-text">'.$text.'</div>';
						echo '</div>';
					echo $image_box_link['end'];
				}

				echo '</div>';
			}


/**
 * --------------------------------
 * SIMPLE IMAGE
 * --------------------------------
 */
			elseif ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'simple' ) {

				// IMAGE
				if ( ! empty ( $saved_image ) ) {
					$image = '<div class="image-boxes-img-wrapper"><img class="image-boxes-img img-responsive '.$fitimg.'" src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' ' . $saved_alt . ' ' . $saved_title . ' /></div>';
				}

				$implode_classes = implode(' ', $img_boxes_wrapper_classes);

				$image_box_link = zn_extract_link(
					$this->opt('image_box_link',''),
					'image-boxes-link imgboxes-wrapper u-mb-0'.$implode_classes,
					'',
					'<div class="image-boxes-holder imgboxes-wrapper u-mb-0 '.$implode_classes.'">',
					'</div>'
				);

				echo '<div class="box image-boxes imgbox-simple '.implode(' ', $elm_classes).'" '.$attributes.'>';

				if(!empty($image)){
					echo $image_box_link['start'];
						echo $image;
					echo $image_box_link['end'];
				}

				echo '</div>';
			}


/**
 * --------------------------------
 * STYLE 4 - IMAGE WITH READ MORE BUTTON OVER IT
 * --------------------------------
 */
			elseif ( ! empty ( $options['image_box_style'] ) && $options['image_box_style'] == 'style4' ) {
				$elm_classes[] = ' imgboxes_style4';

				// IMAGE
				if ( ! empty ( $saved_image ) ) {

					$image = '<div class="image-boxes-img-wrapper"><img src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' ' . $saved_alt . ' ' . $saved_title . ' class="img-responsive imgbox_image image-boxes-img '.$fitimg.'" /></div>';
				}

				// Add a call to action button
				if( $image_box_link_text = $this->opt('image_box_link_text','') ){
					$image_box_link_btn = zn_extract_link( $this->opt('image_box_link',''), 'btn btn-fullcolor btn-sm image-boxes-button');
					$link_text = $image_box_link_btn['start'] . $image_box_link_text . $image_box_link_btn['end'];
				}

				// Reset link's bottom margin if no title or text under the image link
				$img_boxes_wrapper_classes[] = !$text && !$link_text ? 'u-mb-0' : '';
				$implode_classes = implode(' ', $img_boxes_wrapper_classes);

				$image_box_link = zn_extract_link(
					$this->opt('image_box_link',''),
					'imgboxes4_link imgboxes-wrapper image-boxes-link '.$implode_classes,
					'',
					'<div class="imgboxes-wrapper image-boxes-holder '.$implode_classes.'">',
					'</div>'
				);

				$image_box_title_style = isset( $options['image_box_title_style'] ) && ! empty( $options['image_box_title_style']) ? $options['image_box_title_style'] : 'title_style_center';

				echo '<div class="box image-boxes image-boxes--4 kl-'. $image_box_title_style .' '.implode(' ', $elm_classes).'" '.$attributes.'>';

					if(!empty($image)){
						echo $image_box_link['start'];

							echo $image;
							echo '<span class="imgboxes-border-helper image-boxes-border-helper"></span>';

							echo $title;

						echo $image_box_link['end'];
					}

					if($text){
						echo '<div class="image-boxes-text"><p>'.$text.'</p></div>';
					}

					echo $link_text;

				echo '</div>';
			}

/**
 * --------------------------------
 * STYLE 1 - IMAGE WITH READ MORE BUTTON OVER IT
 * --------------------------------
 */
			else {
				$elm_classes[] = ' imgboxes_style1';

				// IMAGE
				if ( ! empty ( $saved_image ) ) {
					$image = '<div class="image-boxes-img-wrapper"><img class="image-boxes-img '.$fitimg.'" src="' . $saved_image . '" '.ZngetImageSizesFromUrl($saved_image, true).' ' . $saved_alt . ' ' . $saved_title . ' /></div>';
				}

				// Reset link's bottom margin if no title or text under the image link
				$img_boxes_wrapper_classes[] = !$text && !$title ? 'u-mb-0' : '';
				$implode_classes = implode(' ', $img_boxes_wrapper_classes);

				$image_box_link = zn_extract_link(
					$this->opt('image_box_link',''),
					'hoverBorder imgboxes-wrapper image-boxes-link '.$implode_classes,
					'',
					'<div class="image-boxes-holder imgboxes-wrapper '.$implode_classes.'">',
					'</div>'
				);

				echo '<div class="box image-boxes image-boxes--1 '.implode(' ', $elm_classes).'" '.$attributes.'>';

					if(!empty($image)){
						echo $image_box_link['start'];
							echo $image;
							echo $link_text;
						echo $image_box_link['end'];
					}
					echo $title;

					if($text){
						echo '<div class="image-boxes-text">'.$text.'</div>';
					}

				echo '</div>';
			}



		}

		/**
		 * This method is used to retrieve the configurable options of the element.
		 * @return array The list of options that compose the element and then passed as the argument for the render() function
		 */
		function options()
		{
			$uid = $this->data['uid'];

			$ib_margin_std = array('bottom' => '30px');
			// backwards compatibility
			if(isset($this->data['options']['ib_bottom_margin']) && $this->data['options']['ib_bottom_margin'] != '' ){
				$ib_margin_std['bottom'] = $this->data['options']['ib_bottom_margin'];
			}

			$options = array(
				'has_tabs'  => true,
				'general' => array(
					'title' => 'General options',
					'options' => array(

						array (
							"name"        => __( "Image", 'zn_framework' ),
							"description" => __( "Please select an image that will appear above the title.", 'zn_framework' ),
							"id"          => "image_box_image",
							"std"         => "",
							"type"        => "media",
							"alt"         => true,
						),

						array (
							"name"        => __( "Force Image Fill?", 'zn_framework' ),
							"description" => __( "Please select how to fit the image.", 'zn_framework' ),
							"id"          => "image_box_imgfit",
							"std"         => "no",
							'options'     => array(
								'cover-fit-img' => 'Yes (Custom height)',
								'no' => 'No (Natural height)',
							),
							"type"        => "select",
							'live' => array(
								'multiple' => array(
									array(
									   'type'        => 'class',
									   'css_class' => '.'.$uid,
									   'val_prepend' => 'image-boxes-',
									),
									array(
									   'type'        => 'class',
									   'css_class' => '.'.$uid.' .image-boxes-img',
									),
								),
							),
						),

						array (
							"name"        => __( "Image Height", 'zn_framework' ),
							"description" => __( "Please enter your desired height in pixels for this image.", 'zn_framework' ),
							"id"          => "image_box_height",
							"std"         => "280",
							"type" 		  => "slider",
							'class'       => 'zn_full',
							'helpers'     => array(
								'min' => '10',
								'max' => '1000',
								'step' => '1'
							),
							'live' => array(
								'type'      => 'css',
								'css_class' => '.'.$uid.'.image-boxes-cover-fit-img .image-boxes-img-wrapper',
								'css_rule'  => 'height',
								'unit'      => 'px'
							),
							"dependency"  => array( 'element' => 'image_box_imgfit' , 'value'=> array('cover-fit-img') )
						),

						array (
							"name"        => __( "Link text", 'zn_framework' ),
							"description" => __( "Enter a that will appear as link over the image.", 'zn_framework' ),
							"id"          => "image_box_link_text",
							"std"         => "",
							"type"        => "text",
							"dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('imgboxes_style1','style2','style3','style4') ),
						),
						array (
							"name"        => __( "Image Box link", 'zn_framework' ),
							"description" => __( "Please choose the link you want to use for your Image box button.", 'zn_framework' ),
							"id"          => "image_box_link",
							"std"         => "",
							"type"        => "link",
							"options"     => zn_get_link_targets(),
						),
						array (
							"name"        => __( "Image Box Title", 'zn_framework' ),
							"description" => __( "Enter a title for your Image box", 'zn_framework' ),
							"id"          => "image_box_title",
							"std"         => "",
							"type"        => "text",
							"dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('imgboxes_style1','style2','style3','style4') ),
						),
						array (
							"name"        => __( "Image Box Text", 'zn_framework' ),
							"description" => __("Please enter a text that will appear inside your action Image button.", 'zn_framework' ),
							"id"          => "image_box_text",
							"std"         => "",
							"type"        => "textarea",
							"dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('imgboxes_style1','style2','style3','style4') ),
						),
					),
				),

				'style' => array(
					'title' => 'Style options',
					'options' => array(

						array (
							"name"        => __( "Image Box Style", 'zn_framework' ),
							"description" => __( "Please select the style you want to use.", 'zn_framework' ),
							"id"          => "image_box_style",
							"std"         => "simple",
							"options"     => array(
								array(
									'value' => 'simple',
									'name'  => __( 'Simple Image', 'zn_framework' ),
									'desc'  => __( 'This will display a plain simple image.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_ImageBox/img/simple.png'
								),
								array(
									'value' => 'imgboxes_style1',
									'name'  => __( 'Style 1', 'zn_framework' ),
									'desc'  => __( 'Will display a simple image with title and text, below the image.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_ImageBox/img/style1.png'
								),
								array(
									'value' => 'style2',
									'name'  => __( 'Style 2', 'zn_framework' ),
									'desc'  => __( 'Will display a text with image aligned to right. This option is old and not recommended, you could use alternatives such as a simple TextBox element.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_ImageBox/img/style2.png'
								),
								array(
									'value' => 'style3',
									'name'  => __( 'Style 3', 'zn_framework' ),
									'desc'  => __( 'This hover based imagebox style, will display a title and text when hovering the image.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_ImageBox/img/style3.png'
								),
								array(
									'value' => 'style4',
									'name'  => __( 'Style 4', 'zn_framework' ),
									'desc'  => __( 'This will display a title inside the image aligned to the bottom with some sleek effects when hovering.', 'zn_framework' ),
									'image' => THEME_BASE_URI .'/pagebuilder/elements/TH_ImageBox/img/style4.png'
								),
							),
							"type"        => "smart_select",
							"class"        => "zn-smartselect--xl"
						),

						array (
							"name"        => __( "Image Box - Title Style", 'zn_framework' ),
							"description" => __( "Please select the style you want to use.", 'zn_framework' ),
							"id"          => "image_box_title_style",
							"std"         => "title_style_center",
							"options"     => array (
								'title_style_center' => __( 'Title Centered', 'zn_framework' ),
								'title_style_left'   => __( 'Title Left', 'zn_framework' ),
								'title_style_bottom' => __( 'Title Left with border bottom', 'zn_framework' )
							),
							"type"        => "select",
							 "dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('style4') ),
						),

						array (
							"name"        => __( "Title settings", 'zn_framework' ),
							"description" => __( "Specify the typography properties for the title.", 'zn_framework' ),
							"id"          => "title_typo",
							"std"         => '',
							'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
							"type"        => "font",
							"dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('imgboxes_style1','style2','style3','style4') ),
							'live' => array(
								'type'      => 'font',
								'css_class' => '.'.$uid. '.image-boxes .image-boxes-title',
							),
						),

						array (
							"name"        => __( "Description Typography settings", 'zn_framework' ),
							"description" => __( "Specify the typography properties for the description text.", 'zn_framework' ),
							"id"          => "desc_typo",
							"std"         => '',
							'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
							"type"        => "font",
							"dependency"  => array( 'element' => 'image_box_style' , 'value'=> array('imgboxes_style1','style2','style3','style4') ),
							'live' => array(
								'type'      => 'font',
								'css_class' => '.'.$uid. '.image-boxes .image-boxes-text',
							),
						),

						array(
							'id'          => 'corner_radius',
							'name'        => 'Image Corner radius',
							'description' => 'Select a corner radius (in pixels) for the image.',
							'type'        => 'slider',
							'std'		  => '0',
							'class'		  => 'zn_full',
							'helpers'	  => array(
								'min' => '0',
								'max' => '400',
								'step' => '1'
							),
							'live' => array(
								'type'		=> 'css',
								'css_class' => '.'.$uid.' .image-boxes-img',
								'css_rule'	=> 'border-radius',
								'unit'		=> 'px'
							)
						),

						array (
							"name"        => __( "Image-Box Shadow", 'zn_framework' ),
							"description" => __( "Please select a shadow style.", 'zn_framework' ),
							"id"          => "image_box_shadow",
							"std"         => "",
							"options"     => array(
								''  => __( 'No shadow', 'zn_framework' ),
								'1'  => __( 'Shadow 1x', 'zn_framework' ),
								'2'  => __( 'Shadow 2x', 'zn_framework' ),
								'3'  => __( 'Shadow 3x', 'zn_framework' ),
								'4'  => __( 'Shadow 4x', 'zn_framework' ),
								'5'  => __( 'Shadow 5x', 'zn_framework' ),
								'6'  => __( 'Shadow 6x', 'zn_framework' ),
							),
							"type"        => "select",
							'live' => array(
								'type'		=> 'class',
								'css_class' => '.'.$uid.' .imgboxes-wrapper',
								'val_prepend'	=> 'znBoxShadow-',
							),
						),

						array (
							"name"        => __( "Image-Box Shadow Hover", 'zn_framework' ),
							"description" => __( "Please select a shadow style for hover state.", 'zn_framework' ),
							"id"          => "image_box_shadow_hover",
							"std"         => "",
							"options"     => array(
								''  => __( 'No shadow', 'zn_framework' ),
								'1'  => __( 'Shadow 1x', 'zn_framework' ),
								'2'  => __( 'Shadow 2x', 'zn_framework' ),
								'3'  => __( 'Shadow 3x', 'zn_framework' ),
								'4'  => __( 'Shadow 4x', 'zn_framework' ),
								'5'  => __( 'Shadow 5x', 'zn_framework' ),
								'6'  => __( 'Shadow 6x', 'zn_framework' ),
							),
							"type"        => "select",
						),

						/**
						 * Margins and padding
						 */
						array (
							"name"        => __( "Edit padding & margins for each device breakpoint", 'zn_framework' ),
							"description" => __( "This will enable you to have more control over the padding of the container on each device. Click to see <a href='http://hogash.d.pr/1f0nW' target='_blank'>how box-model works</a>.", 'zn_framework' ),
							"id"          => "cc_spacing_breakpoints",
							"std"         => "lg",
							"tabs"        => true,
							"type"        => "zn_radio",
							"options"     => array (
								"lg"        => __( "LARGE", 'zn_framework' ),
								"md"        => __( "MEDIUM", 'zn_framework' ),
								"sm"        => __( "SMALL", 'zn_framework' ),
								"xs"        => __( "EXTRA SMALL", 'zn_framework' ),
							),
							"class"       => "zn_full zn_breakpoints"
						),
						// MARGINS
						array(
							'id'          => 'cc_margin_lg',
							'name'        => 'Margin (Large Breakpoints)',
							'description' => 'Select the margin (in percent % or px) for this container. Accepts negative margin.',
							'type'        => 'boxmodel',
							'std'	  => $ib_margin_std,
							'placeholder' => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
							'live' => array(
								'type'		=> 'boxmodel',
								'css_class' => '.'.$uid,
								'css_rule'	=> 'margin',
							),
						),
						array(
							'id'          => 'cc_margin_md',
							'name'        => 'Margin (Medium Breakpoints)',
							'description' => 'Select the margin (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
						),
						array(
							'id'          => 'cc_margin_sm',
							'name'        => 'Margin (Small Breakpoints)',
							'description' => 'Select the margin (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
						),
						array(
							'id'          => 'cc_margin_xs',
							'name'        => 'Margin (Extra Small Breakpoints)',
							'description' => 'Select the margin (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
						),
						// PADDINGS
						array(
							'id'          => 'cc_padding_lg',
							'name'        => 'Padding (Large Breakpoints)',
							'description' => 'Select the padding (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							"allow-negative" => false,
							'std'	  => '',
							'placeholder' => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('lg') ),
							'live' => array(
								'type'		=> 'boxmodel',
								'css_class' => '.'.$uid,
								'css_rule'	=> 'padding',
							),
						),
						array(
							'id'          => 'cc_padding_md',
							'name'        => 'Padding (Medium Breakpoints)',
							'description' => 'Select the padding (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							"allow-negative" => false,
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('md') ),
						),
						array(
							'id'          => 'cc_padding_sm',
							'name'        => 'Padding (Small Breakpoints)',
							'description' => 'Select the padding (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							"allow-negative" => false,
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('sm') ),
						),
						array(
							'id'          => 'cc_padding_xs',
							'name'        => 'Padding (Extra Small Breakpoints)',
							'description' => 'Select the padding (in percent % or px) for this container.',
							'type'        => 'boxmodel',
							"allow-negative" => false,
							'std'	  => 	'',
							'placeholder'        => '0px',
							"dependency"  => array( 'element' => 'cc_spacing_breakpoints' , 'value'=> array('xs') ),
						),

					),
				),

				'advanced' => array(
					'title' => 'Advanced',
					'options' => array(

						array (
						"name"        => __( "Enable Object Scrolling", 'zn_framework' ),
						"description" => __( "This will add a very nice slide up or down effect to this element, upon scrolling.", 'zn_framework' ),
						"id"          => "obj_parallax_enable",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
					),

					array (
						"name"        => __( "Distance", 'zn_framework' ),
						"description" => __( "Select the Y axis distance to run the effect. The effect will run on the entire screen, from entering the viewport until leaving it.", 'zn_framework' ),
						"id"          => "obj_parallax_distance",
						"std"         => "100",
						"type"        => "select",
						"options"     => array(
								"50" => "Slide for 50px",
								"100" => "Slide for 100px",
								"200" => "Slide for 200px",
								"300" => "Slide for 300px",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array(
						"name"        => __( "Speed", 'zn_framework' ),
						"description" => __( "How long should the animation take, or better said, how slow or fast should it be. Value is in miliseconds (1s = 1000ms).", 'zn_framework' ),
						'id'          => 'obj_parallax_speed',
						'type'        => 'slider',
						'std'         => '800',
						'helpers'     => array(
							'min' => '0',
							'max' => '5000',
							'step' => '100'
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Easing", 'zn_framework' ),
						"description" => __( "Select the effect's easing. You can play with the easing effects <a href=\"http://greensock.com/ease-visualizer\" target=\"_blank\">here</a>.", 'zn_framework' ),
						"id"          => "obj_parallax_easing",
						"std"         => "Power1.easeOut",
						"type"        => "select",
						"options"     => array(
							"Power0.easeOut" => "Power0.easeOut (Linear)",
							"Power1.easeOut" => "Power1.easeOut (Quad)",
							"Power2.easeOut" => "Power2.easeOut (Cubic)",
							"Power3.easeOut" => "Power3.easeOut (Quart)",
							"Power4.easeOut" => "Power4.easeOut (Quint)",
						),
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					array (
						"name"        => __( "Tween in reverse?", 'zn_framework' ),
						"description" => __( "This will make the tween effect to run in opposite direction of the scroll.", 'zn_framework' ),
						"id"          => "obj_parallax_reverse",
						"std"         => "",
						"type"        => "toggle2",
						"value"        => "yes",
						"dependency"  => array( 'element' => 'obj_parallax_enable' , 'value'=> array('yes') ),
					),

					),
				),


				'help' => znpb_get_helptab( array(
					'video'   => 'http://support.hogash.com/kallyas-videos/#aKNFr7BfB5k',
					'docs'    => 'http://support.hogash.com/documentation/image-box/',
					'copy'    => $uid,
					'general' => true,
				)),

			);
			return $options;
		}
	}

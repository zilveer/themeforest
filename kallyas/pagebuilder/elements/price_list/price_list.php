<?php if(! defined('ABSPATH')){ return; }
/*
Name: Price List
Description: This element will generate a list containing prices
Class: ZnPriceList
Category: content
Keywords: restaurant, menu
Level: 3
*/


class ZnPriceList extends ZnElements {

	public static function getName(){
		return __( "Price List", 'zn_framework' );
	}
	function options() {

		$uid = $this->data['uid'];


		// TODO
		// single_item: is featured
		// single_item: image
		// image display style - on left with click to open // on hover as a tooltip
		// extra style with more fields (for a pizza joint eg: large / medium / small)

		// OTHERS
		// custom button

		$options = array(
			'css_selector' => '.',
			'has_tabs'  => true,
			'general' => array(
				'title' => 'General options',
				'options' => array(

					array(
						"id"          => "pl_curr",
						"name"        => "Currency",
						"description" => "Please enter the currency symbol or text.",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: $",
					),

					array(
						"id"          => "pl_curr_pos",
						"name"        => "Currency Position",
						"description" => "Please enter the currency symbol or text.",
						"std"         => "before",
						"type"        => "select",
						'options'     => array(
							'before' => 'Before',
							'after' => 'After'
						),
					),

					array (
						"name"        => __( "Typography settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the title and price.", 'zn_framework' ),
						"id"          => "title_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
						"type"        => "font",
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'font',
									'css_class' => '.'.$uid. ' .priceListElement-itemTitle',
								),
								array(
									'type'      => 'font',
									'css_class' => '.'.$uid. ' .priceListElement-itemPrice',
								)
							)
						),
					),

					array (
						"name"        => __( "Description Typography settings", 'zn_framework' ),
						"description" => __( "Specify the typography properties for the description.", 'zn_framework' ),
						"id"          => "desc_typo",
						"std"         => '',
						'supports'   => array( 'size', 'font', 'style', 'line', 'color', 'weight' ),
						"type"        => "font",
						'live' => array(
							'type'      => 'font',
							'css_class' => '.'.$uid. ' .priceListElement-itemDesc ',
						),
					),

					array(
						"id"          => "pl_price_color",
						"name"        => "Prices Color",
						"description" => "Please choose the price default color.",
						"std"         => "#cd2122",
						"alpha"       => "true",
						"type"        => "colorpicker",
					),

					array(
						'id'          => 'vertical_spacing',
						'name'        => 'Vertical Spacing',
						'description' => 'Select the vertical spacing ( in pixels ) for the item list.',
						'type'        => 'slider',
						'std'         => '5',
						// 'class'       => 'zn_full',
						'helpers'     => array(
							'min' => '0',
							'max' => '100',
							'step' => '1'
						),
						'live' => array(
							'multiple' => array(
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid. ' > ul > li',
									'css_rule'  => 'margin-top',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid. ' > ul > li',
									'css_rule'  => 'margin-bottom',
									'unit'      => 'px'
								),
								array(
									'type'      => 'css',
									'css_class' => '.'.$uid. '.priceListElement-dash--separator > ul > li',
									'css_rule'  => 'padding-bottom',
									'unit'      => 'px'
								),
							)
						)
					),

					array(
						'id'          => 'dotted_line',
						'name'        => 'Dotted line style',
						'description' => 'Select the style of the dotted line.',
						'type'        => 'select',
						'std'         => 'classic',
						'options'        => array(
							'classic' => 'Classic',
							'separator' => 'As item separator',
						)
					),

					array(
						"id"          => "pl_dottedline_color",
						"name"        => "Dotted Line Color",
						"description" => "Use this option if you want to change the dotted line color.",
						"std"         => "rgba(0,0,0,0.2)",
						"alpha"       => "true",
						"type"        => "colorpicker",
					),

					array(
						'id'          => 'element_scheme',
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
									'val_prepend'  => 'priceListElement-scheme--',
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
						"name"        => __( "Image Sizes", 'zn_framework' ),
						"description" => __( "Choose image sizes.", 'zn_framework' ),
						"id"          => "img_sizes",
						"type"        => "image_size",
						"std"        => array(
							'width' => '38',
							'height' => '38'
						),
					)

				)
			),
			'price_items' => array(
				'title' => 'Items',
				'options' => array(

					array(
						'id'            => 'price_list',
						'name'          => 'Price list items',
						'description'   => 'Here you can add price list items',
						'type'          => 'group',
						'sortable'      => true,
						'element_title' => 'Item',
						'subelements'   => array(
							array(
								"id"          => "pl_title",
								"name"        => "Title",
								"description" => "Please enter the title that will appear on the left side.",
								"std"         => "",
								"type"        => "text",
								"class"        => "zn_input_xl",
							),
							array(
								"id"          => "pl_price",
								"name"        => "Price",
								"description" => "Please enter the price that will appear on the right side.",
								"std"         => "",
								"type"        => "text"
							),
							array(
								"id"          => "pl_desc",
								"name"        => "Description",
								"description" => "Please enter the description that will appear under the price.",
								"std"         => "",
								"type"        => "textarea"
							),

							array(
								"id"          => "pl_title_color",
								"name"        => "Title Color",
								"description" => "Select if you want to override the default title color.",
								"std"         => "",
								"alpha"       => "true",
								"type"        => "colorpicker",
							),

							array(
								"id"          => "pl_price_color",
								"name"        => "Price Color",
								"description" => "Select if you want to override the default price color.",
								"std"         => "",
								"alpha"       => "true",
								"type"        => "colorpicker",
							),

							array (
								"name"        => __( "Price font settings", 'zn_framework' ),
								"description" => __( "Override the font options of the price.", 'zn_framework' ),
								"id"          => "price_typo",
								"std"         => '',
								'supports'   => array( 'size', 'font', 'style', 'weight' ),
								"type"        => "font",
							),


							// Image Settings
							array(
								"id"          => "pl_img",
								"name"        => "Add image",
								"description" => "Add image to this item.",
								"type"        => "media",
								"std"         => "",
							),

							array(
								"id"          => "pl_featured",
								"name"        => "Is featured?",
								"description" => "Enable if you want this item to be featured/highlighted in the list.",
								"type"        => "toggle2",
								"std"         => "",
								"value"        => "yes"
							),
						),
					),

				),
			),

		);

		return $options;
	}

	function element() {

		$options = $this->data['options'];


		//Class
		$classes = array();
		$classes[] = $uid = $this->data['uid'];

		$classes[] = zn_get_element_classes($options);

		$color_scheme = $this->opt( 'element_scheme', '' ) == '' ? zget_option( 'zn_main_style', 'color_options', false, 'light' ) : $this->opt( 'element_scheme', '' );
		$classes[] = 'priceListElement-scheme--'.$color_scheme;
		$classes[] = 'element-scheme--'.$color_scheme;

		$classes[] = 'priceListElement-dash--'.$this->opt( 'dotted_line', 'classic' );

		$attributes = zn_get_element_attributes($options);

		?>

		<div class="priceListElement <?php echo implode(' ', $classes); ?> " <?php echo $attributes; ?>>
			<ul>
				<?php

				$currency = $this->opt('pl_curr', '');
				$currency_position = $this->opt('pl_curr_pos', 'before');

				$priceItems    = $this->opt( 'price_list' );

				// Set some defaults for buttons
				if( empty( $priceItems ) ){
					$priceItems = array(
						array(
							'pl_title' => 'Some title right here',
							'pl_price' => '79.99',
							'pl_desc' => 'Just some description, can be empty if you want.',
						),
					);
				}
				if(is_array($priceItems) && !empty($priceItems)){
					foreach ( $priceItems as $i => $entry ) {

						if($currency_position == 'before'){
							$pbefore = $currency;
							$pafter = '';
						}
						elseif($currency_position == 'after'){
							$pbefore = '';
							$pafter = $currency;
						}

						$title    = ! empty( $entry['pl_title'] ) ? '<h4 class="priceListElement-itemTitle" '.WpkPageHelper::zn_schema_markup('title').'>'.$entry['pl_title'].'</h4>' : '';
						$price    = ! empty( $entry['pl_price'] ) ? '<div class="priceListElement-itemPrice">'.$pbefore.$entry['pl_price'].$pafter.'</div>' : '';
						$desc    = ! empty( $entry['pl_desc'] ) ? '<div class="priceListElement-itemDesc">'.$entry['pl_desc'].'</div>' : '';

						$item_classes = array();
						$item_classes[] = 'priceListElement-item-'.$i;
						$item_classes[] = isset($entry['pl_featured']) && $entry['pl_featured'] == 'yes' ? 'is-featured' : '';
						?>
						<li class="<?php echo implode(' ', $item_classes); ?>">

							<?php
								if(isset($entry['pl_img']) && !empty($entry['pl_img'])){

										$img = $entry['pl_img'];
										// Thumb
										$_thumb_sizes = $this->opt('img_sizes', array('width'=>'38', 'height'=>'38'));
										$_thumb_resized = vt_resize('', $img, $_thumb_sizes['width'], $_thumb_sizes['height']);
										// Tooltip
										$_tooltip_sizes = array('width'=>'275', 'height'=>'275');
										$_tooltip_resized = vt_resize('', $img, $_tooltip_sizes['width'], $_tooltip_sizes['height']);

										$img_alt   = ZngetImageAltFromUrl( $img );
										$img_title = ZngetImageTitleFromUrl( $img );

									echo '<div class="priceListElement-imgTooltip">';
										echo '<a href="'.$img.'" data-lightbox="image" title="'. $img_title .'"><img src="'.$_tooltip_resized['url'].'" width="'.$_tooltip_sizes['width'].'" height="'.$_tooltip_sizes['height'].'" alt="'.$img_alt.'" title="'.$img_title.'"></a>';
									echo '</div>';

									echo '<div class="priceListElement-itemLeft">';
										echo '<img src="'.$_thumb_resized['url'].'" width="'.$_thumb_sizes['width'].'" height="'.$_thumb_sizes['height'].'" alt="'.$img_alt.'" title="'.$img_title.'">';
									echo '</div>';

								}
							?>

							<div class="priceListElement-itemRight">
								<div class="priceListElement-itemMain">
									<?php echo $title; ?>
									<div class="priceListElement-dottedSeparator"></div>
									<?php echo $price; ?>
									<?php
										if($this->opt( 'dotted_line', 'classic' ) == 'separator') echo '<div class="clearfix"></div>';
									?>
								</div>
							<?php echo $desc; ?>
							</div>

                  			<div class="clearfix"></div>
						</li>
					<?php
					} // end foreach
				}
				?>
			</ul>
			<div class="clearfix"></div>
		</div>
	<?php
	}

	function css(){

		$uid = $this->data['uid'];
		$css = '';

		$dotted_line = $this->opt( 'dotted_line', 'classic' );

		$vertical_spacing = $this->opt('vertical_spacing', 5);
		$ttl_bmargin = $vertical_spacing != '5' ?  : '';
		if( $vertical_spacing != '' && $vertical_spacing != 5 ){
			$css .= '.'.$uid.' > ul > li{margin-top:'.$vertical_spacing.'px; margin-bottom:'.$vertical_spacing.'px;}';
			if($dotted_line == 'separator'){
				$css .= '.'.$uid.'.priceListElement-dash--separator > ul > li{padding-bottom:'.$vertical_spacing.'px;}';
			}
		}

		// Title Styles
		$title_styles = '';
		$title_typo = $this->opt('title_typo');
		if( is_array($title_typo) && !empty($title_typo) ){
			foreach ($title_typo as $key => $value) {
				if($value != '') {
					if( $key == 'font-family' ){
						$title_styles .= $key .':'. zn_convert_font($value).';';
					}
					else {
						$title_styles .= $key .':'. $value.';';
					}
				}
			}
			if(!empty($title_styles)){
				$css .= '.'.$uid.' .priceListElement-itemTitle, .'.$uid.' .priceListElement-itemPrice {'.$title_styles.'}';
			}
			if($dotted_line == 'classic'){
				// Make proper dotted separator
				$font_size = !empty($title_typo['font-size']) ? $title_typo['font-size'] : 14;
				$line_height = !empty($title_typo['line-height']) ? $title_typo['line-height'] : 24;
				$css .= '.'.$uid.' .priceListElement-dottedSeparator {margin-bottom: calc(('.(int)$line_height.'px - '.(int)$font_size.'px) / 2);}';
			}
		}

		// Price Color
		$pl_price_color = $is_featured_color = $this->opt('pl_price_color', '#cd2122');
		if($pl_price_color != '#cd2122'){
			$css .= '.'.$uid.' .priceListElement-itemPrice {color:'.$pl_price_color.'}';
		}

		// Dotted Line Color
		$pl_dottedline_color = $this->opt('pl_dottedline_color', 'rgba(0,0,0,0.2)');
		if($pl_dottedline_color != 'rgba(0,0,0,0.2)'){
			if($dotted_line == 'classic'){
				$sel = '.'.$uid.'.priceListElement-dash--classic .priceListElement-dottedSeparator';
			} elseif($dotted_line == 'separator'){
				$sel = '.'.$uid.'.priceListElement-dash--separator > ul > li';
			}
			$css .= $sel . '{background-image: -webkit-radial-gradient(circle closest-side, '.$pl_dottedline_color.' 99%, transparent 1%); background-image: radial-gradient(circle closest-side, '.$pl_dottedline_color.' 99%, transparent 1%);}';
		}

		// Subtitle styles
		$desc_styles = '';
		$desc_typo = $this->opt('desc_typo');
		if( is_array($desc_typo) && !empty($desc_typo) ){
			foreach ($desc_typo as $key => $value) {
				if($value != '') {
					if( $key == 'font-family' ){
						$desc_styles .= $key .':'. zn_convert_font($value).';';
					} else {
						$desc_styles .= $key .':'. $value.';';
					}
				}
			}
			if(!empty($desc_styles)){
				$css .= '.'.$uid.' .priceListElement-itemDesc{'.$desc_styles.'}';
			}
		}

		// color per items
		$priceItems    = $this->opt( 'price_list' );
		if(is_array($priceItems) && !empty($priceItems)){
			foreach ( $priceItems as $i => $entry ) {
				if(isset($entry['pl_title_color']) && !empty($entry['pl_title_color'])){
					$css .= '.'.$uid.' .priceListElement-item-'.$i.' .priceListElement-itemTitle {color:'.$entry['pl_title_color'].'}';
				}
				if(isset($entry['pl_price_color']) && !empty($entry['pl_price_color'])){
					$css .= '.'.$uid.' .priceListElement-item-'.$i.' .priceListElement-itemPrice {color:'.$entry['pl_price_color'].'}';
					$is_featured_color = $entry['pl_price_color'];
				}

				// Featured item color
				if(isset($entry['pl_featured']) && $entry['pl_featured'] == 'yes'){
					$css .= '.'.$uid.' .priceListElement-item-'.$i.'.is-featured .priceListElement-itemLeft {border-left-color:'.$is_featured_color.'}';
				}

				// Price Font options
				$price_font_styles = '';
				if(isset($entry['price_typo']) && is_array($entry['price_typo']) && !empty($entry['price_typo']) ){
					foreach ($entry['price_typo'] as $key => $value) {
						if($value != '') {
							if( $key == 'font-family' ){
								$price_font_styles .= $key .':'. zn_convert_font($value).';';
							} else {
								$price_font_styles .= $key .':'. $value.';';
							}
						}
					}
					if(!empty($price_font_styles)){
						$css .= '.'.$uid.' .priceListElement-item-'.$i.' .priceListElement-itemPrice{'.$price_font_styles.'}';
					}
				}

			}
		}

		$img_sizes = $this->opt('img_sizes', array('width'=>'38', 'height'=>'38'));
		$img_width = (int)$img_sizes['width'];
		if( $img_width != '38' ){
			$css .= '.'.$uid.' .priceListElement-itemLeft {width:'.$img_width.'px;}';
			$css .= '.'.$uid.' .priceListElement-itemLeft + .priceListElement-itemRight {width:calc(100% - '.($img_width + 20).'px);}';
		}

		return $css;


	}

}

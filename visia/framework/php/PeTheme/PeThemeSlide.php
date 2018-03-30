<?php

class PeThemeSlide {

	protected $master;
	protected $fields;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/pe/jquery.pixelentity.utils.geom.js",array("jquery"),"pe_theme_utils_geom");
		PeThemeAsset::addScript("framework/js/pe/jquery.pixelentity.transform.js",array("jquery"),"pe_theme_transform");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.slide.js",array("pe_theme_utils","pe_theme_utils_geom","pe_theme_transform","editor","json2"),"pe_theme_slide");
		
		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Slides",'Pixelentity Theme/Plugin'),
						'singular_name'     => __("Slide",'Pixelentity Theme/Plugin'),
						'add_new_item'      => __("Add New Slide",'Pixelentity Theme/Plugin'),
						'search_items'      => __('Search Slides','Pixelentity Theme/Plugin'),
						'popular_items' 	  => __('Popular Slides','Pixelentity Theme/Plugin'),		
						'all_items' 		  => __('All Slides','Pixelentity Theme/Plugin'),
						'parent_item' 	  => __('Parent Slide','Pixelentity Theme/Plugin'),
						'parent_item_colon' => __('Parent Slide:','Pixelentity Theme/Plugin'),
						'edit_item' 		  => __('Edit Slide','Pixelentity Theme/Plugin'), 
						'update_item' 	  => __('Update Slide','Pixelentity Theme/Plugin'),
						'add_new_item' 	  => __('Add New Slide','Pixelentity Theme/Plugin'),
						'new_item_name' 	  => __('New Slide Name','Pixelentity Theme/Plugin')
						),
				  'public' => true,
				  'has_archive' => false,
				  //"supports" => array("title","editor","thumbnail"),
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("post_format")
				  );

		PeGlobal::$config["post_types"]["slide"] = $cpt;
		//PeGlobal::$config["post-formats-slide"] = array("gallery");

		$transitions = array("bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp", "bounceOut", "bounceOutDown", "bounceOutLeft", "bounceOutRight", "bounceOutUp", "fadeIn", "fadeInDownBig", "fadeInDown", "fadeInLeftBig", "fadeInLeft", "fadeInRightBig", "fadeInRight", "fadeInUpBig", "fadeInUp", "fadeOut", "fadeOutDownBig", "fadeOutDown", "fadeOutLeftBig", "fadeOutLeft", "fadeOutRightBig", "fadeOutRight", "fadeOutUpBig", "fadeOutUp", "flash", "flip", "flipInX", "flipInY", "flipOutX", "flipOutY", "hinge", "lightSpeedIn", "lightSpeedOut", "pulse", "rollIn", "rollOut", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight", "rotateOut", "rotateOutDownLeft", "rotateOutDownRight", "rotateOutUpLeft", "rotateOutUpRight", "shake", "swing", "tada", "wiggle", "wobble");

		$transitions = apply_filters("pe_theme_slider_caption_transitions",$transitions);

		$mbox = 
			array(
				  "title" => __("Layers Builder",'Pixelentity Theme/Plugin'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"layout" =>
						array(
							  "label"=>__("Layout",'Pixelentity Theme/Plugin'),
							  "section" => "preview",

							  "description" => __("A boxed slider (default) behaves like a responsive image. A full width slider will always fill all the available width and upscale the image if smaller than slider area.",'Pixelentity Theme/Plugin'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Boxed",'Pixelentity Theme/Plugin')=>"boxed",
									__("Full Width",'Pixelentity Theme/Plugin') => "fullwidth"
									),
							  "default"=>"boxed"
							  ),
						"preview" => 	
						array(
							  "section" => "preview",
							  "type"=>"LayersBuilder",
							  "default" => "940x300",
							  ),
						"captions" => 
						array(
							  "section" => "main",
							  "label"=>"",
							  "type"=>"Items",
							  "description" => "",
							  "button_label" => __("Add New Layer",'Pixelentity Theme/Plugin'),
							  "sortable" => true,
							  "auto" => __("Layer",'Pixelentity Theme/Plugin'),
							  "unique" => false,
							  "editable" => true,
							  "legend" => true,
							  "fields" => 
							  array(
									array(
										  "name" => "content",
										  "label" => __("Content",'Pixelentity Theme/Plugin'),
										  "type" => "textimg",
										  "width" => 300,
										  "default" => ""
										  ),
									array(
										  "name" => "x",
										  "label" => __("x",'Pixelentity Theme/Plugin'),
										  "type" => "text",
										  "width" => 40, 
										  "default" => "10"
										  ),
									array(
										  "name" => "y",
										  "label" => __("y",'Pixelentity Theme/Plugin'),
										  "type" => "text",
										  "width" => 40,
										  "default" => "10"
										  ),
									array(
										  "name" => "delay",
										  "label" => __("Wait",'Pixelentity Theme/Plugin'),
										  "type" => "text",
										  "width" => 30,
										  "default" => "0"
										  ),
									array(
										  "name" => "duration",
										  "label" => __("Duration",'Pixelentity Theme/Plugin'),
										  "type" => "text",
										  "width" => 30,
										  "default" => "1"
										  ),
									array(
										  "name" => "style",
										  "type" => "hidden",
										  "default" => "pe-caption-white"
										  ),
									array(
										  "name" => "size",
										  "type" => "hidden",
										  "default" => "pe-caption-small"
										  ),
									array(
										  "name" => "transition",
										  "type" => "hidden",
										  "default" => "fadeIn"
										  ),
									array(
										  "name" => "color",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "bgcolor",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "bgcolorAlpha",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "custom",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "classes",
										  "type" => "hidden",
										  "default" => ""
										  )
									),
							  "default" => ""
							  ),
						"style" => 
						array(
							  "label"=>__("Theme",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> 
							  array(
									__("Light",'Pixelentity Theme/Plugin') => "pe-caption-white",
									__("Dark",'Pixelentity Theme/Plugin') => "pe-caption-style-black"
									),
							  "default"=>"pe-caption-white"
							  ),
						"size" => 
						array(
							  "label"=>__("Text",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> 
							  array(
									__("Small",'Pixelentity Theme/Plugin') => "pe-caption-small",
									__("Medium",'Pixelentity Theme/Plugin') => "pe-caption-medium",
									__("Large",'Pixelentity Theme/Plugin') => "pe-caption-large",
									__("XLarge",'Pixelentity Theme/Plugin') => "pe-caption-xlarge",
									__("Bold",'Pixelentity Theme/Plugin') => "pe-caption-bold",
									__("Thick",'Pixelentity Theme/Plugin') => "pe-caption-thick"
									),
							  "default"=>"pe-caption-white"
							  ),
						"transition" => 
						array(
							  "label"=>__("Transition",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> $transitions,
							  "single" => true,
							  "default"=>"fadeIn"
							  ),
						"color" =>
						array(
							  "label"=>__("Color",'Pixelentity Theme/Plugin'),
							  "type"=>"Color",
							  "section"=>"edit",
							  "palette" => array("#ffffff","#222222"),
							  "default"=> ""
							  ),
						"bgcolorAlpha" =>
						array(
							  "label"=>__("Background",'Pixelentity Theme/Plugin'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=>
							  array(
									__("No background",'Pixelentity Theme/Plugin') => "",
									__("10%",'Pixelentity Theme/Plugin') => "0.1",
									__("20%",'Pixelentity Theme/Plugin') => "0.2",
									__("30%",'Pixelentity Theme/Plugin') => "0.3",
									__("40%",'Pixelentity Theme/Plugin') => "0.4",
									__("50%",'Pixelentity Theme/Plugin') => "0.5",
									__("60%",'Pixelentity Theme/Plugin') => "0.6",
									__("70%",'Pixelentity Theme/Plugin') => "0.7",
									__("80%",'Pixelentity Theme/Plugin') => "0.8",
									__("90%",'Pixelentity Theme/Plugin') => "0.9",
									__("100%",'Pixelentity Theme/Plugin') => "1",
									),
							  "default"=> ""
							  ),
						"bgcolor" =>
						array(
							  "label"=>__("BG Color",'Pixelentity Theme/Plugin'),
							  "type"=>"Color",
							  "section"=>"edit",
							  "palette" => array("#ffffff","#222222"),
							  "default"=> ""
							  ),
						"classes" =>
						array(
							  "label"=>__("Classes",'Pixelentity Theme/Plugin'),
							  "type"=>"Text",
							  "section"=>"edit",
							  "default"=> ""
							  ),
						"custom" =>
						array(
							  "label"=>__("Style",'Pixelentity Theme/Plugin'),
							  "type"=>"TextArea",
							  "section"=>"edit",
							  "default"=> ""
							  )
						/*,
						"saveCaption" => 
						array(
							  "label"=>__("Save current layer",'Pixelentity Theme/Plugin'),
							  "type"=>"Button",
							  "section"=>"edit",
							  "default"=> ""
							  )*/
						)
				  );

		$mboxFormat = 
			array(
				  "title" => __("Format",'Pixelentity Theme/Plugin'),
				  "type" => "Plain",
				  "context" => "side",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"type" => 
						array(
							  "label"=>"",
							  "type"=>"RadioUI",
							  "options"=>
							  array(
									__("Normal",'Pixelentity Theme/Plugin') => "normal",
									__("Layers",'Pixelentity Theme/Plugin') => "layers"
									),
							  "default"=>"normal"
							  ),
						)
				  );

		PeGlobal::$config["metaboxes-slide"] = 
			array(
				  "layers" => $mbox,
				  //"format" => $mboxFormat
				  );
		
		add_action('add_meta_boxes_slide',array(&$this,'add_meta_boxes_slide'));
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type" => "slide",
								 "posts_per_page" => -1,
								 "suppress_filters" => 0
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			$options[__("No Slide",'Pixelentity Theme/Plugin')] = 0;
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No slides defined.",'Pixelentity Theme/Plugin')=>-1);
		}
		return $options;
	}

	public function add_meta_boxes_slide() {
		// layer builder
		$this->registerAssets();
		wp_enqueue_script("pe_theme_slide");
	}

	public function caption($id) {
		$meta = $this->master->meta->get($id,"slide");
		return empty($meta->layers->captions) ? "" : $this->output($meta->layers->captions,$meta->layers->preview);
	}


	public function output($captions,$size = null) {
		$buffer = "";
		if ($captions && is_array($captions)) {
			foreach ($captions as $caption) {
				$style = "";
				$caption = (object) shortcode_atts(
												   array(
														 "x" => 0,
														 "y" => 0,
														 "delay" => 0,
														 "duration" => 1,
														 "style" => "pe-caption-white",
														 "size" => "pe-caption-small",
														 "transition" => "fadeIn",
														 "color" => "",
														 "bgcolor" => "",
														 "bgcolorAlpha" => 0,
														 "custom" => "",
														 "classes" => "",
														 "content" => ""
														 ),
												   $caption
												   );

				$style = "";

				if (!empty($caption->bgcolor) && floatval($caption->bgcolorAlpha) > 0) {
					$c = isset($caption->bgcolor) ? $caption->bgcolor : "#000000" ;
					$style = sprintf("background-color: %s;",$c);
					if (floatval($caption->bgcolorAlpha) < 1) {
						$style .= sprintf(
										  " background-color: rgba(%s,%s,%s,%s);",
										  hexdec(substr($c, 1, 2)),
										  hexdec(substr($c, 3, 2)),
										  hexdec(substr($c, 5, 2)),
										  $caption->bgcolorAlpha
										  );
					}
				}

				if (!empty($caption->color)) {
					$style .= sprintf("color: %s;",$caption->color);
				}


				//$style .= sprintf(" position:absolute;top:%spx;left:%spx;",$caption->y,$caption->x);
				
				if ($caption->custom) {
					$style .= sprintf(";%s;",$caption->custom);
				}

				if ($style) {
					$style = "style=\"{$style}\"";
				}

				$buffer .= sprintf(
								   '<div class="%s %s %s %s" %s data-transition="%s" data-duration="%s" data-delay="%s" data-x="%s" data-y="%s">%s</div>',
								   "peCaptionLayer",
								   $caption->style,
								   $caption->size,
								   $caption->classes,
								   $style,
								   $caption->transition,
								   $caption->duration,
								   $caption->delay,
								   $caption->x,
								   $caption->y,
								   $caption->content
								   );
			}
		}

		if ($size) {
			$ret = new StdClass();
			$ret->size = $size;
			$ret->caption = $buffer;
			return $ret;
		}

		return $buffer;
	}

}

?>

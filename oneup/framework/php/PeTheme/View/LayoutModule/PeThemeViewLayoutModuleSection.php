<?php

class PeThemeViewLayoutModuleSection extends PeThemeViewLayoutModuleContainer {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.section.js",array("jquery","pe_theme_layout_module_standard"),"pe_theme_layout_module_section");
	}

	public function requireAssets() {
		parent::requireAssets();
		wp_enqueue_script("pe_theme_layout_module_section");
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Section",'Pixelentity Theme/Plugin')
				  );
	}

	public function group() {
		return "section";
	}

	public function allowed() {
		return "default";
	}

	public function jsClass() {
		return "Section";
	}

	public function fields() {
		return 
			array(
				  "title" =>
				  array(
						"label" => __("Title",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Section Title.",'Pixelentity Theme/Plugin'),
						"default" => __("Title",'Pixelentity Theme/Plugin')
						),
				  "name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "style" =>
				  array(
						"label" => __("Style",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"description" => __("Section color style, use 'light' for light backgrounds (like white)",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Light",'Pixelentity Theme/Plugin') => "light",
							  __("Dark",'Pixelentity Theme/Plugin') => "dark"
							  ),
						"default" => "light"
						),
				  "ptop" =>
				  array(
						"label" => __("Top Padding",'Pixelentity Theme/Plugin'),
						"type" => "Number",
						"description" => __("Section top padding.",'Pixelentity Theme/Plugin'),
						"default" => 60
						),
				  "pbottom" =>
				  array(
						"label" => __("Bottom Padding",'Pixelentity Theme/Plugin'),
						"type" => "Number",
						"description" => __("Section bottom padding.",'Pixelentity Theme/Plugin'),
						"default" => 60
						),
				  "bg" =>
				  array(
						"label" => __("Background",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"description" => __("Background type.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Default",'Pixelentity Theme/Plugin') => "transparent",
							  __("Color",'Pixelentity Theme/Plugin') => "color",
							  __("Image",'Pixelentity Theme/Plugin') => "image",
							  __("Image + Color",'Pixelentity Theme/Plugin') => "imagecolor"
							  ),
						"default" => "transparent"
						),
				  "color" =>
				  array(
						"label" => __("BG Color",'Pixelentity Theme/Plugin'),
						"type" => "Color",
						"description" => __("Background color.",'Pixelentity Theme/Plugin'),
						"default" => "#ffffff"
						),
				  "alpha" =>
				  array(
						"label" => __("BG Color Alpha",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"single" => true,
						"description" => __("Background color transparency.",'Pixelentity Theme/Plugin'),
						"options" => range(0,100),
						"default" => "100"
						),
				  "image" =>
				  array(
						"label" => __("BG Image",'Pixelentity Theme/Plugin'),
						"type" => "Upload",
						"description" => __("Background image.",'Pixelentity Theme/Plugin'),
						"default" => ''
						),
				  "imageh" =>
				  array(
						"label" => __("BG Horizontal Align",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"description" => __("Horizontal alignment of the background image.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Left",'Pixelentity Theme/Plugin') => "left",
							  __("Center",'Pixelentity Theme/Plugin') => "center",
							  __("Right",'Pixelentity Theme/Plugin') => "right"
							  ),
						"default" => "center"
						),
				  "imagev" =>
				  array(
						"label" => __("BG Vertical Align",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"description" => __("Vertical alignment of the background image.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("Top",'Pixelentity Theme/Plugin') => "top",
							  __("Center",'Pixelentity Theme/Plugin') => "center",
							  __("Bottom",'Pixelentity Theme/Plugin') => "bottom",
							  __("Parallax",'Pixelentity Theme/Plugin') => "parallax",
							  ),
						"default" => "center"
						),
				  "imager" =>
				  array(
						"label" => __("BG Repeat",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"description" => __("Sets if/how a background image will be repeated.",'Pixelentity Theme/Plugin'),
						"options" => 
						array(
							  __("None",'Pixelentity Theme/Plugin') => "no-repeat",
							  __("Repeat X",'Pixelentity Theme/Plugin') => "repeat-x",
							  __("Repeat Y",'Pixelentity Theme/Plugin') => "repeat-y",
							  __("Repeat Both",'Pixelentity Theme/Plugin') => "repeat",
							  ),
						"default" => "no-repeat"
						),
				  
				  
				  
				  );
	}

	public function name() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Structure",'Pixelentity Theme/Plugin');
	}

	public function render() {

		//$data = empty($this->conf->data) ? new StdClass() : (object) $this->conf->data;

		$data = (object) shortcode_atts(
										array(
											  'title' => '',
											  'name' => '',
											  'style' => 'light',
											  'ptop' => 60,
											  'pbottom' => 60,
											  'bg' => 'transparent',
											  'color' => '',
											  'alpha' => 100,
											  'image' => '',
											  'imageh' => 'center',
											  'imagev' => 'center',
											  'imager' => 'no-repeat'
										),
										$this->conf->data
										);
		$classes = $data->style === 'light' ? 'pe-style-light' : 'pe-style-dark';

		$style = sprintf('padding: %spx 0px %spx 0px; ',$data->ptop,$data->pbottom);

		if ($data->bg === 'color' || $data->bg === 'imagecolor') {

			$color = $data->color;
			$rgba = sprintf(
							"rgba(%s,%s,%s,%s)",
							hexdec(substr($color, 1, 2)),
							hexdec(substr($color, 3, 2)),
							hexdec(substr($color, 5, 2)),
							intval($data->alpha)/100);

			$style .= sprintf('background-color:%s;',$color);
			$style .= sprintf('background-color:%s;',$rgba);

		}

		if (($data->bg === 'image' || $data->bg === 'imagecolor') && $data->image) {
			$style .= sprintf('background-image:url(%s);',$data->image);

			$x = $data->imageh;
			
			$classes .= ' pe-bg-'.$x;

			$x = $x === 'left' ? "0" : ($x === 'right' ? '100%' : '50%' );
			$y = $data->imagev;
			$y = $y === 'top' || $y === 'parallax' ? "0" : ($y === 'bottom' ? '100%' : '50%' );

			$classes .= $data->imagev === 'parallax' ? ' pe-parallax' : '';

			$style .= sprintf('background-position: %s %s;',$x,$y);

		}

		if (($data->bg === 'image' || $data->bg === 'imagecolor')) {
			$style .= sprintf('background-repeat:%s;',$data->imager);
		}

		if ($style) {
			$style = sprintf(' style="%s"',$style);
		}

		$id = empty($data->name) ? __("section",'Pixelentity Theme/Plugin').$this->conf->bid : $data->name;
		$id = strtr($id,array('#' => ''));
		$id = urlencode( $id );

		echo sprintf('<section class="pe-main-section pe-view-layout-block pe-view-layout-block-%s %s" id="section-%s"%s>',$this->conf->bid,$classes,$id,$style);
		$this->template();
		echo '</section>';
	}

	public function setTemplateData() {
		$items = isset($this->conf->items) && is_array($this->conf->items) ? $this->conf->items : array();
		peTheme()->template->data($this->data,$items);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","section");
	}

	public function tooltip() {
		return __("Use this block to add sections to the one page layout.",'Pixelentity Theme/Plugin');
	}

}

?>

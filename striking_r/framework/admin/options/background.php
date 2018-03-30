<?php
class Theme_Options_Page_Background extends Theme_Options_Page_With_Tabs {
	public $slug = 'background';

	function __construct(){
		$this->name = __('Background Settings','theme_admin');
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'box',
				"name" => __("Body Background",'theme_admin'),
				"desc" => __("<h3 align='center'>BODY BACKGROUND OPTIONS</h3>
<p>Striking provides two background options for the body area:</p>
<ol>
<li>Load a Custom Image using the settings array below.</li>
<li>Use one of the 39 backgrounds supplied with the theme.</li>
</ol>
<p>The new setting below <b>Body Layout Subtle Pattern</b> contains the list of patterns. &nbsp;The patterns vary in color and in the geometric shape used in the mix. &nbsp;Any of the patterns can also be used as a background for another webpage section (such as the header or page background) by simply uploading it from your unzipped Champion theme on your desktop, using the Custom Image setting. &nbsp;The patterns are all found in the &#34;patterns&#34; subfolder (champion/images/patterns).</p><p>Note: The theme has two layouts : </p><ol>
<li>Normal Mode. In normal mode to see the image or pattern the background color of each of the sections (header, featured header, page, footer) needs to be set to transparent in the theme color settings or a background-color with a partly transparency.</li>
<li>Box Mode. The pattern or image set is visible in the outer container around the box.</li>
</ol>", 'theme_admin'),
				"options"=>array(
				array(
						"name" => __("Body Layout Subtle Pattern",'theme_admin'),
						"desc" => __("<p>A collection of subtle patterns which can be applied as a background for the Boxed Layout. These patterns are an alternative to designing a custom background. &nbsp;The focus of these patterns is simplicity and subtlety. &nbsp;They are all repeating patterns.</p>",'theme_admin'),
						"id" => "nav_subtitle_align",
						"id" => "box_layout_pattern",
						"default" => '',
						"options" => array(
							"" => __('None','theme_admin'),
							"agsquare" => 'AG Square',
							"light_grey" => 'Light gray',
							"fabric_of_squares_gray" => 'Fabric of Squares',
							"paper_fibers" => 'Paper Fibers',
							"wavegrid" => 'Wave Grind',
							"nasty_fabric" => 'Nasty Fabric',
							"az_subtle" => 'AZ Subtle',
							"wild_oliva" => 'Wild Oliva',
							"greyzz" => 'Greyzz',
							"pw_pattern" => 'PW Pattern',
							"fresh_snow" => 'Fresh snow',
							'furley_bg' => 'Light Sketch',
							"subtle_white_feathers" => 'Subtle White Feathers',
							"knitting250px" => 'Knitted Sweater',
							"shl" => 'Simple Horizontal Light',
							"grid" => 'Grid',
							"straws" => 'Straws',
							"wet_snow" => 'Wet snow',
							"notebook" => 'Notebook',
							"geometry" => 'Inspiration Geometry',
							"extra_clean_paper" => 'Clean gray paper',
							"subtlenet2" => 'SubtleNet',
							'low_contrast_linen' => 'Low Contrast Linen',
							"light_wool" => 'Light wool',
							"tweed" => 'Tweed',
							"noisy_grid" => 'Noisy Grid',
							"cardboard_flat" => 'Cardboard Flat',
							"navy_blue" => 'Navy',
							"denim" => 'Denim',
							"wood" => 'Wood',
							"vertical_cloth" => 'Vertical cloth',
							"binding_dark" => 'Binding Dark',
							"binding_light"=>"Binding light",
							"black-Linen" => 'Black Linen',
							"brushed_alu_dark" =>  "Brushed Alum Dark",
							"noise_pattern_with_crosslines" => 'Noise pattern with subtle cross lines',
							"debut_dark" => 'Debut dark',
							"grey_wash_wall" => 'Grey Washed Wall',
							"pw_maze_black" => 'Maze black',
						),
						"type" => "select",
					),	
					array(
						"name" => __("Custom Image",'theme_admin'),
						"id" => "box_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Position X",'theme_admin'),
						"desc" => "",
						"id" => "box_position_x",
						"default" => 'center',
						"options" => array(				
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Position Y",'theme_admin'),
						"desc" => "",
						"id" => "box_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Repeat",'theme_admin'),
						"desc" => "",
						"id" => "box_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Attachment",'theme_admin'),
						"desc" => "",
						"id" => "box_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),	
						"id" => "box_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'header',
				"name" => __("Header Background",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Custom Image",'theme_admin'),
						"id" => "header_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Position X",'theme_admin'),
						"desc" => "",
						"id" => "header_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Position Y",'theme_admin'),
						"desc" => "",
						"id" => "header_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Repeat",'theme_admin'),
						"desc" => "",
						"id" => "header_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Attachment",'theme_admin'),
						"desc" => "",
						"id" => "header_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),
						"id" => "header_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'feature',
				"name" => __("Feature Header Background",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Custom Image",'theme_admin'),
						"id" => "feature_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Position X",'theme_admin'),
						"desc" => "",
						"id" => "feature_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Position Y",'theme_admin'),
						"desc" => "",
						"id" => "feature_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Repeat",'theme_admin'),
						"desc" => "",
						"id" => "feature_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Attachment",'theme_admin'),
						"desc" => "",
						"id" => "feature_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),	
						"id" => "feature_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'page',
				"name" => __("Page Background",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Custom Image",'theme_admin'),
						"id" => "page_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Position X",'theme_admin'),
						"desc" => "",
						"id" => "page_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Position Y",'theme_admin'),
						"desc" => "",
						"id" => "page_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Repeat",'theme_admin'),
						"desc" => "",
						"id" => "page_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Attachment",'theme_admin'),
						"desc" => "",
						"id" => "page_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),	
						"id" => "page_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"slug" => 'footer',
				"name" => __("Footer Background",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Custom Image",'theme_admin'),
						"id" => "footer_image",
						"default" => "",
						"type" => "upload"
					),
					array(
						"name" => __("Position X",'theme_admin'),
						"desc" => "",
						"id" => "footer_position_x",
						"default" => 'center',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"center" => __('Center','theme_admin'),
							"right" => __('Right','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Position Y",'theme_admin'),
						"desc" => "",
						"id" => "footer_position_y",
						"default" => 'top',
						"options" => array(				
							"top" => __('Top','theme_admin'),
							"center" => __('Center','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Repeat",'theme_admin'),
						"desc" => "",
						"id" => "footer_repeat",
						"default" => 'no-repeat',
						"options" => array(
							"no-repeat" => __('No Repeat','theme_admin'),
							"repeat" => __('Tile','theme_admin'),
							"repeat-x" => __('Tile Horizontally','theme_admin'),
							"repeat-y" => __('Tile Vertically','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Attachment",'theme_admin'),
						"desc" => "",
						"id" => "footer_attachment",
						"default" => 'scroll',
						"options" => array(
							"scroll" => __('Scroll','theme_admin'),
							"fixed" => __('Fixed','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Background Size",'theme_admin'),	
						"id" => "footer_size",
						"default" => '100% auto',
						"options" => array(
							"auto" => __('auto','theme_admin'),
							"100% auto" => __('100% auto','theme_admin'),
							"cover" => __('cover','theme_admin'),
							"contain" => __('contain','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
		);
		return $options;
	}
}

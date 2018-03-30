<?php

class PeThemeViewLayoutModuleFeature extends PeThemeViewLayoutModule {

	public function name() {
		return __("Feature",'Pixelentity Theme/Plugin');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Feature",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array( 
						"label" => __("Title",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Title",'Pixelentity Theme/Plugin'),
						"default" => 'Title'
						 ),
				  "content" =>
				  array( 
						"label" => __("Content",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Content",'Pixelentity Theme/Plugin'),
						"default" => ''
						 ),
				  "label" =>
				  array( 
						"label" => __("Button Label",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button label, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => 'Click Here'
						 ),
				  "link" =>
				  array( 
						"label" => __("Button Link",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button Link",'Pixelentity Theme/Plugin'),
						"default" => '#'
						 ),
				  "layout" =>
				  array( 
						"label" => __("Media Position",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"options" => array(__('Left','Pixelentity Theme/Plugin') => 'left',__('Bottom','Pixelentity Theme/Plugin') => 'bottom',__('Right','Pixelentity Theme/Plugin') => 'right',__('None','Pixelentity Theme/Plugin') => 'none'),
						"description" => __("Position of the media block",'Pixelentity Theme/Plugin'),
						"default" => 'left',
						 ),
				  "type" =>
				  array( 
						"label" => __("Media Type",'Pixelentity Theme/Plugin'),
						"type" => "RadioUI",
						"options" => array(__('Image','Pixelentity Theme/Plugin') => 'image',__('Video','Pixelentity Theme/Plugin') => 'video',__('View','Pixelentity Theme/Plugin') => 'view'),
						"description" => __("Position of the media block",'Pixelentity Theme/Plugin'),
						"default" => 'image',
						 ),
				  "height" =>
				  array( 
						"label" => __("Media Height",'Pixelentity Theme/Plugin'),
						"type" => "Number",
						"description" => __("Leave empty to avoid image cropping. In this case, slider based views will require all the (original) images to have the same size to work correctly.",'Pixelentity Theme/Plugin'),
						"default" => '300'
						 ),
				  "image" =>
				  array( 
						"label" => __("Image",'Pixelentity Theme/Plugin'),
						"type" => "Upload",
						"description" => __("Image",'Pixelentity Theme/Plugin'),
						"default" => ''
						 ),
				  "video" => 
				  array(
						"label"=>__("Video",'Pixelentity Theme/Plugin'),
						"type"=>"Select",
						"section"=>"main",
						"description" => __("Optional video",'Pixelentity Theme/Plugin'),
						"options" => array_merge(array(__("None",'Pixelentity Theme/Plugin')=>""),peTheme()->video->option()),
						"default"=>""
						),
				  "view" => 
				  array(
						"label" => __("View",'Pixelentity Theme/Plugin'),
						"description" => __("Select the view to be shown.",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"groups" => true,
						"options" => peTheme()->view->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  );
		
	}

	public function blockClass() {
		return "nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","feature");
	}

	public function tooltip() {
		return __("Use this block to add feature block to your layout. This consists of text content with an optional action button and a single image",'Pixelentity Theme/Plugin');
	}


}

?>

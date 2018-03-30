<?php
class Theme_Metabox_KenSlider extends Theme_Metabox_With_Tabs {
	public $slug = 'ken-slider';
	public function config(){
		return array(
			'title' => sprintf(__('%s KenBurner-Slider Options','theme_admin'),THEME_NAME),
			'post_types' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
	}

	public function __construct(){
		parent::__construct();
		foreach($this->config['post_types'] as $post_type){
			if (theme_is_post_type($post_type)){
				add_action('admin_init', array(&$this, '_enqueue_script'));
			}
		}
	}

	public function _enqueue_script(){
		wp_enqueue_script('theme-metabox-ken-slider', THEME_ADMIN_ASSETS_URI . '/js/metabox_ken_slider.js', array('jquery'));
	}
	
	public function tabs(){
		return array(
			array(
				"name" => __("KenBurner General Setup",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Transition",'theme_admin'),
						"id" => "_ken_transition",
						"default" => 'fade',
						"options" => array(
							"fade" => __('Fade','theme_admin'),
							"slide" => __('Slide','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Start Align",'theme_admin'),
						"id" => "_ken_startalign",
						"default" => 'random',
						"options" => array(
							"right_top" => __('Right Top','theme_admin'),
							"right_bottom" => __('Right Bottom','theme_admin'),
							"right_center" => __('Right Center','theme_admin'),
							"left_top" => __('Left Top','theme_admin'),
							"left_bottom" => __('Left Bottom','theme_admin'),
							"left_center" => __('Left Center','theme_admin'),
							"center_top" => __('Center Top','theme_admin'),
							"center_bottom" => __('Center Bottom','theme_admin'),
							"center_center" => __('Center Center','theme_admin'),
							"random" => __('Random','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("End Align",'theme_admin'),
						"id" => "_ken_endalign",
						"default" => 'random',
						"options" => array(
							"right_top" => __('Right Top','theme_admin'),
							"right_bottom" => __('Right Bottom','theme_admin'),
							"right_center" => __('Right Center','theme_admin'),
							"left_top" => __('Left Top','theme_admin'),
							"left_bottom" => __('Left Bottom','theme_admin'),
							"left_center" => __('Left Center','theme_admin'),
							"center_top" => __('Center Top','theme_admin'),
							"center_bottom" => __('Center Bottom','theme_admin'),
							"center_center" => __('Center Center','theme_admin'),
							"random" => __('Random','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Zoom",'theme_admin'),
						"id" => "_ken_zoom",
						"default" => 'random',
						"options" => array(
							"in" => __('In','theme_admin'),
							"out" => __('Out','theme_admin'),
							"random" => __('Random','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Zoom Fact",'theme_admin'),
						"id" => "_ken_zoomfact",
						"default" => '3',
						"min" => 1,
						"max" => 5,
						"step" => '0.1',
						"type" => "range",
					),
					array(
						"name" => __("Zoom Fact Random",'theme_admin'),
						"id" => "_ken_zoomfactr",
						"default" => false,
						"type"=>"toggle",
					),
					/*array(
						"name" => __("Video Src",'theme_admin'),
						"desc"=>__("Add the youtube or vimeo video url here, like <code>http://player.vimeo.com/video/27243869?title=0&byline=0&portrait=0</code>",'theme_admin'),
						"id" => "_ken_video_src",
						"size"=>150,
						"type" => "text",
					),*/
				),
			),
			array(
				"name" => __("KenBurner Description",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Description Type",'theme_admin'),
						"id" => "_ken_desc_type",
						"default" => 'desc',
						"options" => array(
							"none" => __('None','theme_admin'),
							"desc" => __('Description','theme_admin'),
							"caption" => __('Caption','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Description Position",'theme_admin'),
						"id" => "_ken_desc_position",
						"default" => 'left',
						"options" => array(
							"left" => __('Left','theme_admin'),
							"top" => __('Top','theme_admin'),
							"right" => __('Right','theme_admin'),
							"bottom" => __('Bottom','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Description Transition",'theme_admin'),
						"id" => "_ken_desc_transition",
						"default" => 'fade',
						"options" => array(
							"fade" => __('Fade','theme_admin'),
							"fadeup" => __('Fade Up','theme_admin'),
							"fadebottom" => __('Fade Bottom','theme_admin'),
							"fadeleft" => __('Fade Left','theme_admin'),
							"faderight" => __('Fade Right','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			array(
				"name" => __("KenBurner Video",'theme_admin'),
				"id" => 'ken_video',
				"options" => array(
					array(
						"name"=>__("Video Type",'theme_admin'),
						"id"=>"_ken_video_type",
						"type"=>"select",
						"default" => 'none',
						"options" => array(
							"none"=>__('None','theme_admin'),
							"iframe" => __('Iframe','theme_admin'),
							"html5" => __('Html5','theme_admin'),
						),
					),
					array(
						"name" => __("Video Src",'theme_admin'),
						"id" => "_ken_video_iframe_src",
						"default"=>'',
						"class"=> 'full',
						"type" => "text",
					),
					array(
						"name" => __("Mp4 Src",'theme_admin'),
						"id" => "_ken_video_mp4_src",
						"default"=>'',
						"class"=> 'full',
						"type" => "text",
					),
					array(
						"name" => __("Webm Src",'theme_admin'),
						"id" => "_ken_video_webm_src",
						"class"=> 'full',
						"default"=>'',
						"type" => "text",
					),
					array(
						"name" => __("Ogg Src",'theme_admin'),
						"id" => "_ken_video_ogg_src",
						"default"=>'',
						"class"=> 'full',
						"type" => "text",
					),
				),
			)
			/*array(
				"name" => __("KenBurner-Slider Video",'theme_admin'),
				"id" => 'ken_video',
				"options" => array(
					array(
						"name" => __("Video Src",'theme_admin'),
						"id" => "_ken_video_src",
						"size"=>150,
						"type" => "text",
					),
					array(
						"name" => __("Video Width",'theme_admin'),
						"id" => "_ken_video_width",
						"default" => '540',
						"min" => 200,
						"max" => 940,
						"type" => "range",
					),
					array(
						"name" => __("Video Height",'theme_admin'),
						"id" => "_ken_video_height",
						"default" => '300',
						"min" => 100,
						"max" => 800,
						"type" => "range",
					),
					array(
						"name" => __("Video Description",'theme_admin'),
						"id" => "_ken_video_desc",
						"type" => "textarea",
					),
				)
			),*/
			
		);
	}
}

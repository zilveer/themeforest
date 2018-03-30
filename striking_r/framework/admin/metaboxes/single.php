<?php
class Theme_Metabox_Single extends Theme_Metabox {
	public $slug = 'single';
	public function config(){
		$post_types = theme_get_option('advanced','post_single');
		if(!is_array($post_types)) {
			$post_types = array();
		}
		$post_types[] = 'post';

		return array(
			'title' => sprintf(__('%s Blog Single Options','theme_admin'),THEME_NAME),
			'post_types' => $post_types,
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
	}
	public function options(){
		return array(
			array(
				"name" => __("Featured Image Type",'theme_admin'),
				"desc" => __("There are 4 featured image positions: Full Width, Left Float, Right Float, and Below Title. &nbsp;Below Title refers to the post title and the meta appearing first, with the featured image below this information. &nbsp;Please see the demo for an example of this appearence.",'theme_admin'),
				"id" => "_featured_image_type",
				"default" => 'default',
				"options" => array(
					"default" => __('Default','theme_admin'),
					"full" => __('Full Width','theme_admin'),
					"left" => __('Left Float','theme_admin'),
					"right" => __('Right Float','theme_admin'),
					"below" => __('Below Title','theme_admin'),
				),
				"type" => "select",
			),
			array(
				"name" => __("Display Featured Image in the Post",'theme_admin'),
				"desc" => __("Whether to display Featured Image at the top of the post. &nbsp;This will override the global configuration from the same setting in the Single Post Tab/Blog Panel. &nbsp;Toggle to OFF if intending instead to insert a different image into the post body (an example being a different ratio of the featured image) or if there is no need to dispaly the Feature Image in the post. ",'theme_admin'),
				"id" => "_featured_image",
				"default" => '',
				"type" => "tritoggle",
			),
			array(
				"name" => __("Different Image for Blog List (Optional)&#x200E;",'theme_admin'),
				"desc" => __("This setting allows substitution of an alternate image for appearence in a blog list (ie the blog shortcode) in place of the featured image of the post. &nbsp;If not assigned, the featured image will appear in the post list.  ",'theme_admin'),
				"id" => "_list_image",
				"button" => "Insert Image",
				"default" => '',
				"type" => "upload",
			),
			array(
				"name" => __("Different Image for Masonry List (Optional)&#x200E;",'theme_admin'),
				"desc" => __("This setting allows substitution of an alternate image for appearence in a masonry List (ie the masonry shortcode) in place of the featured image of the post. &nbsp;If not assigned, the featured image will appear in the post list.  ",'theme_admin'),
				"id" => "_masonry_image",
				"button" => "Insert Image",
				"default" => '',
				"type" => "upload",
			),
			array(
				"name" => __("Show Title & Meta in Feature Header Area",'theme_admin'),
				"desc" => __("If this setting is ON, the post title and meta info will show in feature header text area. &nbsp;Turned OFF the Blogtitle and meta info will be shown in the page itself. &nbsp; This will override the global configuration from the same setting in the Single Post Tab/Blog Panel. Note : If the Featured Header area for single blog posts is set to show the Feature Header area of the blog listing page & the Featured Header Area type is set to 'default' then the Title and Meta Data will show in the page content. Similar applies when the Featured Header Area of the single post item is set to Type Slider, type Slider with title or Type Slider with custom text. The Title & Meta Data setting is then ignored and will show in the page content at the normal location.",'theme_admin'),
				"id" => "_show_in_header",
				"default" => '',
				"type" => "tritoggle"
			),
			array(
				"name" => __("Display the About Author Box",'theme_admin'),
				"desc" => __("Whether to display About Author Box in the webpage below the post content. This will override the global configuration from the same setting in the Single Post Tab/Blog Panel",'theme_admin'),
				"id" => "_author",
				"default" => '',
				"type" => "tritoggle"
			),
			array(
				"name" => __("Show the Related & Popular Post Module",'theme_admin'),
				"desc" => __("Whether to display the Related & Popular Post Module in this webpage below the post content. This will override the global configuration from the same setting in the Single Post Tab/Blog Panel",'theme_admin'),
				"id" => "_related_popular",
				"default" => '',
				"type" => "tritoggle"
			),
		);
	}
}
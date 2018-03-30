<?php
class Theme_Options_Page_Sidebar extends Theme_Options_Page_With_Tabs {
	public $slug = 'sidebar';

	function __construct(){
		$this->name = __('Sidebar Settings','theme_admin');
		parent::__construct();
	}

	function tabs(){
		$options = array(
			array(
				"slug" => 'general',
				"name" => __("Custom Sidebar Generator Tool",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Create A Custom Sidebar",'theme_admin'),
						"desc" => __("<p>In this field enter the name of the new custom sidebar and then click on the <b>Save Changes</b> button below. Once a custom sidebar has been created, it will be listed below. &nbsp;Then go to the Global Settings tabs and in each individual page, post and archive type selector dropdown list appearing will be the names of the sidebars created. &nbsp;Select the custom sidebar for use for that page or post type from the dropdown list an then save the tab.</p>",'theme_admin'),	
						"id" => "sidebars",
						"function" => "_option_sidebars_function",
						"default" => "",
						"type" => "custom"
					),
				),
			),
			array(
				"slug" => 'metabox',
				"name" => __("Striking Metabox Custom Sidebar - Global Settings",'theme_admin'),	
				"options" => array(
					array(
						"name" => __("Global Single Page Custom Sidebar Selector",'theme_admin'),
						"desc" => __("<p>Use this selector to set a custom sidebar to appear on all the sites &#34;normal&#34; webpages. &nbsp;However, when desired, Striking still allows override of this global setting on a page by page basis. </p><p>To do so go to the <b>Striking Page General Options</b> metabox below the WP content editor of the page. &nbsp;The <em>General Page</em> tab in this metabox has a <b>Custom Sidebar</b> setting. &nbsp;It is here that one can individually select another custom sidebar or default to the regular Page Widget sidebar to override the global setting for that page being edited. &nbsp;Be advised that for any pages which use another custom or the default page sidebar, and the page is subsequently edited it will be necessary to set it to that sidebar again in the selector as part of the edit, or the page will default to this globally set custom sidebar which is default by way of this setting.</p><p>The result is that Striking allows a unique sidebar on every page and post in a website.</p>",'theme_admin'),
						"id" => "single_page",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Global Single Blog Post Page Custom Sidebar Selector",'theme_admin'),
						"desc" => __("<p>Use this selector to set a custom sidebar to appear on all the sites site's &#34;single blog post&#34; webpages. &nbsp;However, when desired, Striking still allows override of this global setting on a post by post basis. </p><p>To do so go to the <b>Striking Page General Options</b> metabox below the WP content editor of the page. &nbsp;The <em>General Page</em> tab in this metabox has a <b>Custom Sidebar</b> setting. &nbsp;It is here that one can individually select another custom sidebar or default to the regular Blog Widget Area sidebar to override the global setting for that post being edited. &nbsp;Be advised that for any blog posts which use another custom or the default blog sidebar, and the post is subsequently edited it will be necessary to set it to that sidebar again in the selector as part of the edit, or the post will default to this globally set custom sidebar which is default by way of this setting.</p><p>The result is that Striking allows a unique sidebar on every single blog post in a website.</p>",'theme_admin'),
						"id" => "single_post",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Gobal Single Portfolio Post Page Custom Sidebar Selector",'theme_admin'),
						"desc" => __("<p>Use this selector to set a custom sidebar to appear on all the sites site's &#34;single portfolio post&#34; webpages. &nbsp;However, when desired, Striking still allows override of this global setting on a post by post basis. </p><p>To do so go to the <b>Striking Page General Options</b> metabox below the WP content editor of the page. &nbsp;The <em>General Page</em> tab in this metabox has a <b>Custom Sidebar</b> setting. &nbsp;It is here that one can individually select another custom sidebar or default to the regular Portfolio Widget Area sidebar to override the global setting for that post being edited. &nbsp;Be advised that for any portfolio posts which use another custom or the default portfolio sidebar, and the post is subsequently edited it will be necessary to set it to that sidebar again in the selector as part of the edit, or the post will default to this globally set custom sidebar which is default by way of this setting.</p><p>The result is that Striking allows a unique sidebar on every single portfolio post in a website.</p>",'theme_admin'),	
						"id" => "single_portfolio",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
				),
			),
			array(
				"name" => __("Archive Type Pages Custom Sidebars - Global Settings",'theme_admin'),
				"slug" => "archive",
				"options" => array(
					array(
						"name" => __("Archive Page",'theme_admin'),
						"id" => "archive",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Search Page",'theme_admin'),
						"id" => "search",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Post Category Page",'theme_admin'),
						"id" => "category",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Post Tag Page",'theme_admin'),
						"id" => "tag",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Post Date Page",'theme_admin'),
						"id" => "date",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Author Page",'theme_admin'),
						"id" => "author",
						"default" => '',
						"options"=> theme_get_sidebar_options(),
						"prompt" => __("None",'theme_admin'),
						"type" => "select",
					),
				),
			)
		);
		$post_types = get_post_types(array(
		  'public'   => true,
		  '_builtin' => false,
		  'show_ui'=> true,
		),'objects');

		if ($post_types) {
			if(array_key_exists('portfolio',$post_types)){
				unset($post_types['portfolio']);
			}
			if(!empty($post_types)){
				$post_types_option = array(
					"slug" => "post_types",
					"name" => "Custom Post Type Sidebar",
					"options" => array(),
				);
				foreach ($post_types as $post_type ) {
					if($post_type->name != 'portfolio'){
						$post_types_option['options'][] = array(
							"id" => 'post_type_'.$post_type->name.'_sidebar',
							"name" => sprintf(__("%s's Singular Page Sidebar",'theme_admin'),$post_type->labels->name),
							"desc" => '',
							"default" => '',
							"options"=> theme_get_sidebar_options(),
							"prompt" => __("None",'theme_admin'),
							"type" => "select",
						);
					}
				}
				$options[] = $post_types_option;
			}
		}

		if(function_exists('is_post_type_archive')){
			$post_types = get_post_types(array(
			  'public'   => true,
			  '_builtin' => false,
			  'show_ui'=> true,
			  'has_archive' => true,
			),'objects');

			if ($post_types) {
				if(array_key_exists('portfolio',$post_types)){
					unset($post_types['portfolio']);
				}
				if(!empty($post_types)){
					$post_types_option = array(
						"slug" => "post_types_archive",
						"name" => "Custom Post Type Archives Sidebar",
						"options" => array(),
					);
					foreach ($post_types as $post_type ) {
						if($post_type->name != 'portfolio'){
							$post_types_option['options'][] = array(
								"id" => 'post_type_archive_'.$post_type->name.'_sidebar',
								"name" => sprintf(__("%s's Archive Page Sidebar",'theme_admin'),$post_type->labels->name),
								"desc" => '',
								"default" => '',
								"options"=> theme_get_sidebar_options(),
								"prompt" => __("None",'theme_admin'),
								"type" => "select",
							);
						}
					}
					$options[] = $post_types_option;
				}
			}
		}

		$taxonomies=get_taxonomies(array(
			'public'   => true,
			'_builtin' => false,
			'show_ui'=> true,
		),'objects');

		if ($taxonomies && !empty($taxonomies)) {
			$taxonomies_option = array(
				"slug" => "taxonomies",
				"name" => "Custom Taxonomies Sidebar",
				"options" => array(),
			);
			foreach ($taxonomies  as $taxonomy ) {
				$taxonomies_option['options'][] = array(
					"id" => 'taxonomy_'.$taxonomy->name.'_sidebar',
					"name" => sprintf(__("%s Page Sidebar",'theme_admin'),$taxonomy->labels->name),
					"desc" => '',
					"default" => '',
					"options"=> theme_get_sidebar_options(),
					"prompt" => __("None",'theme_admin'),
					"type" => "select",
				);
			}
			$options[] = $taxonomies_option;
		}
		return $options;
	}

	function _option_sidebars_function($value, $default) {
		if(!empty($default)){
			$sidebars = explode(',',$default);
		}else{
			$sidebars = array();
		}
		
		echo <<<HTML
<script type="text/javascript">
jQuery(document).ready( function($) {
	$("#add_sidebar").validator({effect:'option'}).closest('form').submit(function(e) {
		if (!e.isDefaultPrevented() && $("#add_sidebar").val()) {
			if($('#sidebars').val()){
				$('#sidebars').val($('#sidebars').val()+','+$("#add_sidebar").val());
			}else{
				$('#sidebars').val($("#add_sidebar").val());
			}
		}
	});
	$(".sidebar-item input:button").click(function(){
		$(this).closest(".sidebar-item").fadeOut("normal",function(){
  			$(this).remove();
  			$('#sidebars').val('');
			$(".sidebar-item-value").each(function(){
				if($('#sidebars').val()){
					$('#sidebars').val($('#sidebars').val()+','+$(this).val());
				}else{
					$('#sidebars').val($(this).val());
				}
			});
 		});
		
	});
	
});
</script>
<style type="text/css">
.sidebar-title {
	margin:20px 0 5px;
	font-weight:bold;
}
.sidebar-item {
	padding-left:10px;
}
.sidebar-item span {
	margin-right:10px;
}
#add_sidebar { width: 200px; }
</style>
HTML;
		
		echo '<input type="text" id="add_sidebar" name="add_sidebar" pattern="([a-zA-Z\x7f-\xff][ a-zA-Z0-9_\x7f-\xff]*){0,1}" data-message="'.__('Please input a valid name which starts with a letter, followed by letters, numbers, spaces, or underscores.','theme_admin').'" maxlength="35" /><span class="validator-error"></span>';
		if(!empty($sidebars)){
			echo '<div class="sidebar-title">'.__('Below are the Custom Sidebars you have created:','theme_admin').'</div>';
			foreach($sidebars as $sidebar){
				echo '<div class="sidebar-item"><span>'.$sidebar.'</span><input type="hidden" class="sidebar-item-value" value="'.$sidebar.'"/><input type="button" class="button" value="'.__('Delete','theme_admin').'"/></div>';
			}
		}
		echo '<input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="sidebars"/>';
	}
}

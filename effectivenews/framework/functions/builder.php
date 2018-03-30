<?php 
if(class_exists('WPBakeryShortCodesContainer'))
{
	class WPBakeryShortCode_animate extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_visibility extends WPBakeryShortCodesContainer {
	}
}
if ( function_exists('vc_map')) { 
function mom_title_type ($settings, $value) {
   $dependency = vc_generate_dependencies_attributes($settings);
   return '<div class="mom_custom_title"><h4>'.$value.'</h4></div>';
}
add_shortcode_param('title', 'mom_title_type');

$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_name] = $of_cat->cat_ID;} 

$of_tags = array();  
$of_tags_obj = get_tags('hide_empty=0');
foreach ($of_tags_obj as $of_tag) {
    $of_tags[$of_tag->name] = $of_tag->term_id;}

$ads = array();
$get_ads = get_posts('post_type=ads&posts_per_page=-1');
foreach ($get_ads as $ad ) {
    $ads[$ad->post_title] = $ad->ID;
}


$ani = array(
    'bounce'  => 'bounce',
'flash' => 'flash',
'pulse' => 'pulse',
'rubberBand'  => 'rubberBand',
'shake' => 'shake',
'swing' => 'swing',
'tada'  => 'tada',
'wobble'  => 'wobble',
'bounceIn'  => 'bounceIn',
'bounceInDown'  => 'bounceInDown',
'bounceInLeft'  => 'bounceInLeft',
'bounceInRight' => 'bounceInRight',
'bounceInUp'  => 'bounceInUp',
'fadeIn'  => 'fadeIn',
'fadeInDown'  => 'fadeInDown',
'fadeInDownBig' => 'fadeInDownBig',
'fadeInLeft'  => 'fadeInLeft',
'fadeInLeftBig' => 'fadeInLeftBig',
'fadeInRight' => 'fadeInRight',
'fadeInRightBig'  => 'fadeInRightBig',
'fadeInUp'  => 'fadeInUp',
'fadeInUpBig' => 'fadeInUpBig',
'flip'  => 'flip',
'flipInX' => 'flipInX',
'flipInY' => 'flipInY',
'lightSpeedIn'  => 'lightSpeedIn',
'rotateIn'  => 'rotateIn',
'rotateInDownLeft'  => 'rotateInDownLeft',
'rotateInDownRight' => 'rotateInDownRight',
'rotateInUpLeft'  => 'rotateInUpLeft',
'rotateInUpRight' => 'rotateInUpRight',
'slideInDown' => 'slideInDown',
'slideInLeft' => 'slideInLeft',
'slideInRight'  => 'slideInRight',
'hinge' => 'hinge',
'rollIn'  => 'rollIn',  
);

$vc_formats = array(
		   __('Gallery') => 'gallery',
		   __('Audio') => 'audio',
		   __('Video') => 'video',
		   __('Chat') => 'chat',
		    );
    
vc_map( array(
    "name" => __("News Box", "framework"),
    "base" => "news_box",
	"category" => __('Effective'),
    "icon" => 'icon-mom_newsbox',
    "description" => __("insert news boxes.", 'theme'),
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Style", 'theme'),
         "param_name" => "style",
	 "admin_label" => true,
         "description" => __("select from newsbox styles.", 'theme'),
         "value" => array(
			'Default' => '1',
			'Style 2' => '2',
			'Style 3' => '3',
			'Style 4' => '4',
			'Style 5' => 'floated_posts',
			'Two Columns' => 'two_cols',
			'Four Columns' => 'four_cols',
			),
      ),
      
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Last", 'theme'),
         "param_name" => "last",
        "dependency" => Array('element' => "style", 'value' => array('two_cols', 'four_cols')),
         "value" => array(
			  __("No", 'theme') => '',
			  __("Yes", 'theme') => 'yes',
			  ),
      ),  
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title", 'theme'),
         "param_name" => "title",
         "value" => '',
         "description" => __("if you select display category or tag leave this blank and it will be the category/tag name.", 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
	 "admin_label" => true,
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
	 "admin_label" => true,
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
	 "admin_label" => true,
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
         "param_name" => "count",
         "description" => __('this count start after the recent post it mean if you set this as 10 the newsbox will show 11 posts the top post then the 10', 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Sort by", 'theme'),
         "param_name" => "sort",
         "value" => array(
			  __("DESC", 'theme') => '',
			  __("ASC", 'theme') => 'ASC',
			  ),
      ),      
      array(
         "type" => "checkbox",
         "class" => "",
         "heading" => __("Show more Button"),
         "param_name" => "show_more",
         "description" => __('Disable show more button as tabs on bottom of each news box', 'theme'),
        "value" => Array(__("Show/hide", "js_composer") => 'on')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("On click"),
         "param_name" => "show_more_type",
         "value" => array(
			__('More posts with Ajax', 'theme') => '',
			__('Category/tag page', 'theme') => 'link' ,
		),
      ),

       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom post type", 'framework'),
	 "admin_label" => true,
         "param_name" => "post_type",
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),
   )
));

vc_map( array(
    "name" => __("News List", "framework"),
    "base" => "news_list",
	"category" => __('Effective'),
    "icon" => 'icon-mom_newslist',
    "description" => __("insert news lists.", 'theme'),
    "params" => array(
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title", 'theme'),
         "param_name" => "title",
         "value" => '',
         "description" => __("if you select display category or tag leave this blank and it will be the category/tag name.", 'theme')
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Image Size", 'theme'),
         "param_name" => "image_size",
         "value" => array(
			__('Medium', 'theme') => '' ,
			__('Big', 'theme') => 'big',
			),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
	 "admin_label" => true,
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
	 "admin_label" => true,
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
	 "admin_label" => true,
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Format", 'theme'),
         "param_name" => "format",
	 "admin_label" => true,
	"description" => __('display posts by format, leave blank for all post formats spaerated by comma for multiple formats', 'theme'),
         "value" => '',
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
	 "admin_label" => true,
         "param_name" => "count",
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Excerpt Length", 'theme'),
         "param_name" => "excerpt_length",
         "description" => __('characters length default is 150', 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Sort by", 'theme'),
         "param_name" => "sort",
         "value" => array(
			  __("DESC", 'theme') => '',
			  __("ASC", 'theme') => 'ASC',
			  ),
      ),      
      array(
         "type" => "checkbox",
         "class" => "",
         "heading" => __("Show more Button"),
         "param_name" => "show_more",
         "description" => __('Disable show more button as tabs on bottom of each news box', 'theme'),
        "value" => Array(__("Show/hide", "js_composer") => 'on')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("On click"),
         "param_name" => "show_more_type",
         "value" => array(
			__('More posts with Ajax', 'theme') => '',
			__('Category/tag page', 'theme') => 'link' ,
		),
      ),
       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom post type", 'framework'),
	 "admin_label" => true,
         "param_name" => "post_type",
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),
   )
));

vc_map( array(
    "name" => __("Scrolling box", "framework"),
    "base" => "scrolling_box",
	"category" => __('Effective'),
    "icon" => 'icon-mom_scrolling_box',
    "description" => __("insert posts carousel.", 'theme'),
    "params" => array(
	  array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title", 'theme'),
         "param_name" => "title",
         "value" => '',
         "description" => __("if you select display category or tag leave this blank and it will be the category/tag name.", 'theme')
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
	 "admin_label" => true,
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
	 "admin_label" => true,
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
	 "admin_label" => true,
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Format", 'theme'),
         "param_name" => "format",
	"description" => __('display posts by format, leave blank for all post formats spaerated by comma for multiple formats', 'theme'),
	 "admin_label" => true,
         "value" => '',
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
         "param_name" => "count",
	 "admin_label" => true,
	"description" => __('-1 for all posts', 'theme'),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Items", 'theme'),
         "param_name" => "items",
	"description" => __('items displayed at a time depend on width default is 3', 'theme'),
         "value" => '',
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Excerpt Length", 'theme'),
         "param_name" => "excerpt_length",
         "description" => __('characters length default is 0', 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Sort by", 'theme'),
         "param_name" => "sort",
         "value" => array(
			  __("DESC", 'theme') => '',
			  __("ASC", 'theme') => 'ASC',
			  ),
      ),      
       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom post type", 'framework'),
	 "admin_label" => true,
         "param_name" => "post_type",
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),
   )
));


vc_map( array(
    "name" => __("Feature Slider", "framework"),
    "base" => "feature_slider",
	"category" => __('Effective'),
    "icon" => 'icon-mom_feature_slider',
    "description" => __("insert Feature Slider.", 'theme'),
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
         "param_name" => "count",
	"description" => __('-1 for all posts', 'theme'),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Caption", 'theme'),
         "param_name" => "caption",
         "value" => array(
			  __("ON", 'theme') => 'on',
			  __("OFF", 'theme') => 'off',
			  ),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Caption Style", 'theme'),
         "param_name" => "caption_style",
         "value" => array(
			  __("Default", 'theme') => '',
			  __("Alt", 'theme') => 2,
			  ),
      ),
            
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Caption Length", 'theme'),
         "param_name" => "caption_length",
         "description" => __('characters length default is 110', 'theme')
      ),
     
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Navigation", 'theme'),
         "param_name" => "nav",
         "value" => array(
			  __("Bullets", 'theme') => 'bullets',
			  __("Thumbs", 'theme') => 'thumbs',
			  __("Numbers", 'theme') => 'numbers',
			  __("none", 'theme') => 'none',
	    ),
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Arrows", 'theme'),
         "param_name" => "arrows",
         "value" => array(
			  __("ON", 'theme') => 'on',
			  __("OFF", 'theme') => 'off',
			  ),
      ),	
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Animation", 'theme'),
         "param_name" => "animation",
         "value" => array(
			  __("crossfade", 'theme') => 'crossfade',
			  __("scroll", 'theme') => 'scroll',
			  __("directscroll", 'theme') => 'directscroll',
			  __("fade", 'theme') => 'fade',
			  __("cover", 'theme') => 'cover',
			  __("cover-fade", 'theme') => 'cover-fade',
			  __("uncover", 'theme') => 'uncover',
			  __("uncover-fade", 'theme') => 'uncover-fade',
	    ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Easing", 'theme'),
         "param_name" => "easing",
         "value" => array(
	__('easeInOutCubic', 'theme') => 'easeInOutCubic',
	__('jswing', 'theme') => 'jswing',
	__('def', 'theme') => 'def',
	__('easeInQuad', 'theme') => 'easeInQuad',
	__('easeOutQuad', 'theme') => 'easeOutQuad',
	__('easeInOutQuad', 'theme') => 'easeInOutQuad',
	__('easeInCubic', 'theme') => 'easeInCubic',
	__('easeOutCubic', 'theme') => 'easeOutCubic',
	__('easeInQuart', 'theme') => 'easeInQuart',
	__('easeOutQuart', 'theme') => 'easeOutQuart',
	__('easeInOutQuart', 'theme') => 'easeInOutQuart',
	__('easeInQuint', 'theme') => 'easeInQuint',
	__('easeOutQuint', 'theme') => 'easeOutQuint',
	__('easeInOutQuint', 'theme') => 'easeInOutQuint',
	__('easeInSine', 'theme') => 'easeInSine',
	__('easeOutSine', 'theme') => 'easeOutSine',
	__('easeInOutSine', 'theme') => 'easeInOutSine',
	__('easeInExpo', 'theme') => 'easeInExpo',
	__('easeOutExpo', 'theme') => 'easeOutExpo',
	__('easeInOutExpo', 'theme') => 'easeInOutExpo',
	__('easeInCirc', 'theme') => 'easeInCirc',
	__('easeOutCirc', 'theme') => 'easeOutCirc',
	__('easeInOutCirc', 'theme') => 'easeInOutCirc',
	__('easeInElastic', 'theme') => 'easeInElastic',
	__('easeOutElastic', 'theme') => 'easeOutElastic',
	__('easeInOutElastic', 'theme') => 'easeInOutElastic',
	__('easeInBack', 'theme') => 'easeInBack',
	__('easeOutBack', 'theme') => 'easeOutBack',
	__('easeInOutBack', 'theme') => 'easeInOutBack',
	__('easeInBounce', 'theme') => 'easeInBounce',
	__('easeOutBounce', 'theme') => 'easeOutBounce',
	__('easeInOutBounce', 'theme') => 'easeInOutBounce',
    ),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Animation Speed", 'theme'),
         "param_name" => "speed",
         "description" => __('in ms, default is 600', 'theme')
      ),	

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Timeout", 'theme'),
         "param_name" => "timeout",
         "description" => __('the time between each slide in ms, default 4000 = 4 seconds', 'theme')
      ),
      
       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom post type", 'framework'),
	 "admin_label" => true,
         "param_name" => "post_type",
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),
      
   )
));

vc_map( array(
    "name" => __("Blog Posts", "framework"),
    "base" => "blog_posts",
	"category" => __('Effective'),
    "icon" => 'icon-mom_blog_posts',
    "description" => __("insert blog posts.", 'theme'),
    "params" => array(

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Style", 'theme'),
         "param_name" => "style",
         "value" => array(
			__('Medium Thumbnails', 'theme') => 'm1' ,
			__('Medium Thumbnails2', 'theme') => 'm2',
			__('Large Thumbnails', 'theme') => 'l',
			__('Grid', 'theme') => 'g',
			),
      ),
      
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Format", 'theme'),
         "param_name" => "format",
	"description" => __('display posts by format, leave blank for all post formats spaerated by comma for multiple formats', 'theme'),
         "value" => '',
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
         "param_name" => "count",
	"description" => __('-1 for all posts', 'theme'),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Excerpt Length", 'theme'),
         "param_name" => "excerpt_length",
         "description" => __('characters length', 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Sort by", 'theme'),
         "param_name" => "sort",
         "value" => array(
			  __("DESC", 'theme') => '',
			  __("ASC", 'theme') => 'ASC',
			  ),
      ),      

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Pagination", 'theme'),
         "param_name" => "pagination",
         "value" => array(
			  __("ON", 'theme') => 'on',
			  __("OFF", 'theme') => 'off',
			  ),
      ),
      
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Pagination type", 'theme'),
         "param_name" => "pagination_type",
        "dependency" => Array('element' => "pagination", 'value' => array('on')),
         "description" => __('caution: dont use ajax pagination if you order post by', 'theme'),
         "value" => array(
			__('Default') => '',  
			__('Ajax') => 'ajax',  
		),
      ),
      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Post count on load", 'theme'),
         "param_name" => "load_more_count",
        "dependency" => Array('element' => "pagination", 'value' => array('on')),
         "value" => '',
         "description" => __('the count of posts on load if you set the pagination type to ajax default is 3', 'theme')
      ),

// ads 
       array(
         "type" => "title",
         "class" => "",
         "value" => __("Ads", 'framework'),
         "param_name" => "hc_title",
        ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Select Ad:", 'theme'),
         "param_name" => "ad_id",
         "value" => array('')+$ads,
      ),
      
	array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Display after x posts", 'theme'),
         "param_name" => "ad_count",
         "value" => 3,
         "description" => __('the number of posts to display ads after it. default is 3', 'theme')
      ),

   	array(
         "type" => "checkbox",
         "class" => "",
         "heading" => __("Repeat ad", 'theme'),
         "param_name" => "ad_repeat",
         "description" => __('display the ad again after x posts', 'theme'),
         "value" => Array(__("Yes", "framework") => 'yes')
      ),
   
             
   )
));

vc_map( array(
    "name" => __("News in pictures", "framework"),
    "base" => "news_in_pics",
	"category" => __('Effective'),
    "icon" => 'icon-mom_news_pics',
    "description" => __("insert news in pictures.", 'theme'),
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Style", 'theme'),
         "param_name" => "style",
         "description" => __("select from newsbox styles.", 'theme'),
         "value" => array(
			'Grid' => '1',
			'Grid with feature post' => '2',
			),
      ),
      
	array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Title", 'theme'),
         "param_name" => "title",
         "value" => '',
         "description" => __("if you select display category or tag leave this blank and it will be the category/tag name.", 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Display", 'theme'),
         "param_name" => "display",
	 "admin_label" => true,
         "value" => array(
			__('Latest Posts', 'theme') => '' ,
			__('Category', 'theme') => 'category',
			__('Tag', 'theme') => 'tag'
			),
      ),

      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Category", 'theme'),
         "param_name" => "category",
        "dependency" => Array('element' => "display", 'value' => array('category')),
	 "admin_label" => true,
         "value" => array( "Select a Category" => '' ) + $of_categories,
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Tag", 'theme'),
         "param_name" => "tag",
        "dependency" => Array('element' => "display", 'value' => array('tag')),
	 "admin_label" => true,
         "value" => array( "Select a Tag" => '' ) + $of_tags,
      ),

      array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Number of posts", 'theme'),
         "param_name" => "count",
	 "admin_label" => true,
         "description" => __('this count start after the recent post it mean if you set this as 10 the newsbox will show 11 posts the top post then the 10', 'theme')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("order by", 'theme'),
         "param_name" => "orderby",
         "value" => array(
			  __("Recent", 'theme') => '',
			  __("Popular", 'theme') => 'popular',
			  __("Random", 'theme') => 'random',
			  ),
      ),      
        array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Sort by", 'theme'),
         "param_name" => "sort",
         "value" => array(
			  __("DESC", 'theme') => '',
			  __("ASC", 'theme') => 'ASC',
			  ),
      ),      
      array(
         "type" => "checkbox",
         "class" => "",
         "heading" => __("Show more Button"),
         "param_name" => "show_more",
         "description" => __('Disable show more button as tabs on bottom of each news box', 'theme'),
        "value" => Array(__("Show/hide", "js_composer") => 'on')
      ),
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("On click"),
         "param_name" => "show_more_type",
         "value" => array(
			__('More posts with Ajax', 'theme') => '',
			__('Category/tag page', 'theme') => 'link' ,
		),
      ),

       array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Custom post type", 'framework'),
	 "admin_label" => true,
         "param_name" => "post_type",
         "description" => __('Advanced: you can use this option to get posts from custom post types, if you set this to anything the category and tags options not working', 'framework')
      ),
   )
));

vc_map( array(
    "name" => __("Portfolio", "framework"),
    "base" => "portfolio",
	"category" => __('Effective'),
    "icon" => 'icon-mom_portfolio',
    "description" => __("insert portfolio items.", 'theme'),
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Columns", 'theme'),
         "param_name" => "columns",
         "description" => __("set the number of columns.", 'theme'),
         "value" => array(
			__('One columns', 'theme') => 'one',
			__('Two columns', 'theme') => 'two',
			__('Three columns', 'theme') => 'three',
			__('Four columns', 'theme') => 'four',
			),
      ),
      
	array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Items per page", 'theme'),
         "param_name" => "count",
         "value" => '',
         "description" => __("By default its: 12.", 'theme')
      ),
 
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Navigation", 'theme'),
         "param_name" => "nav",
         "description" => __("filter, pagination, both or none.", 'theme'),
         "value" => array(
			__('Filter', 'theme') => 'filter',
			__('Pagination', 'theme') => 'pagination',
			__('Both', 'theme') => 'both',
			__('None', 'theme') => 'none',
			),
      ), 
   )
));

vc_map( array(
    "name" => __("Ad", "framework"),
    "base" => "ad",
	"category" => __('Effective'),
    "icon" => 'icon-mom_ad',
    "description" => __("insert ad.", 'theme'),
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Select Ad:", 'theme'),
         "param_name" => "id",
         "value" => $ads,
      ),
      
   )
));

vc_map( array(
    "name" => __("Review", "framework"),
    "base" => "review",
	"category" => __('Effective'),
    "icon" => 'icon-mom_review',
    "description" => __("insert review.", 'theme'),
    "params" => array(
      array(
         "type" => "text",
         "class" => "",
         "heading" => __("Insert Post ID to get review from it:", 'theme'),
         "description" => __("leave empty for current post", 'theme'),
         "param_name" => "id",
         "value" => '',
      ),
      
   )
));

vc_map( array(
    "name" => __("Animator", "framework"),
    "base" => "animate",
	"category" => __('Effective'),
    "icon" => 'icon-mom_animate',
    "description" => __("elements Animation.", 'theme'),
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "as_parent" => array('except' => ''),
    
    
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Animation", 'theme'),
	"description" => __("tons of animations.", 'theme'),
         "param_name" => "animation",
         "value" => array(__('None') => '') + $ani,
      ),
      
            array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Duration", 'theme'),
	"description" => __("animation duration in seconds.", 'theme'),
         "param_name" => "duration",
      ),
            array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Delay", 'theme'),
	"description" => __("animated element delay in seconds.", 'theme'),
         "param_name" => "delay",
      ),
            array(
         "type" => "textfield",
         "class" => "",
         "heading" => __("Iteration Count", 'theme'),
	"description" => __("number of animation times -1 for non stop animation.", 'theme'),
         "param_name" => "iteration",
      ),  	    
   )
));


vc_map( array(
    "name" => __("Visibility", "framework"),
    "base" => "visibility",
	"category" => __('Effective'),
    "icon" => 'icon-mom_vis',
    "description" => __("visibility options.", 'theme'),
    "content_element" => true,
    "js_view" => 'VcColumnView',
    "as_parent" => array('except' => ''),
    
    
    "params" => array(
      array(
         "type" => "dropdown",
         "class" => "",
         "heading" => __("Animation", 'theme'),
	"description" => __("tons of animations.", 'theme'),
         "param_name" => "visible_on",
         "value" => array(
			  __('Desktop', 'theme') => 'desktop',
			  __('Device (mobiles and tablets)', 'theme') => 'device',
			  __('Tablet', 'theme') => 'tablet',
			  __('Mobile', 'theme') => 'mobile',
			  
			)
      ),
      
 	    
   )
));

} // if VC installed
?>
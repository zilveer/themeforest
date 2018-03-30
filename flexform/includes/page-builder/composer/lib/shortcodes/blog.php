<?php

class WPBakeryShortCode_blog extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
			
			$options = get_option('sf_flexform_options');
			$rss_feed_url = $options['rss_feed_url'];
			
		    $title = $width = $el_class = $output = $show_blog_aux = $blog_aux = $show_read_more = $items = $item_figure = $content_output = $el_position = $offset = '';
			
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'show_blog_aux' => 'yes',
	        	"pagination" 	=> "no",
	        	"blog_type"		=> "standard",
	        	'show_title'	=> 'yes',
	        	'show_excerpt'	=> 'yes',
	        	"show_details"	    => 'yes',
	        	"excerpt_length" => '20',
	        	'show_read_more' => 'no',
	        	"item_count"	=> '5',
	        	"category"		=> '',
	        	"offset" => '0',
	        	"content_output" => '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        $width = wpb_translateColumnWidthToSpan($width);
	        
	        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
	        
	        global $sidebars;
	        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
	        $sidebars = 'one-sidebar';
	        } else if ($sidebar_config == "both-sidebars") {
	        $sidebars = 'both-sidebars';
	        } else {
	        $sidebars = 'no-sidebars';
	        }
	        
	        global $sidebars;
	        
	        $options = get_option('sf_flexform_options');
	        $filter_wrap_bg = $options['filter_wrap_bg'];
	        
	        
	        /* TOP AUX BUTTONS OUTPUT
	        ================================================== */ 
	        
	        if ($show_blog_aux == "yes" && $sidebars == "no-sidebars") {
	        
	        $category_list = wp_list_categories('sort_column=name&title_li=&depth=-1&echo=0&show_count=1');
			$archive_list =  wp_get_archives('type=monthly&limit=120&echo=0');
	        $tags_list = wp_tag_cloud('smallest=12&largest=12&unit=px&format=list&number=50&orderby=name&echo=0');
	        
	        $blog_aux .= '<div class="blog-aux-wrap row">'; // open .blog-aux-wrap
	        $blog_aux .= '<ul class="blog-aux-options '.$width.'">'; // open .blog-aux-options
	        
	        // CATEGORIES
	        $blog_aux .= '<li><a href="#" class="blog-slideout-trigger" data-aux="categories"><i class="icon-list"></i>'.__("Categories", "swiftframework").'</a>';
	        
	        // TAGS
	        $blog_aux .= '<li><a href="#" class="blog-slideout-trigger" data-aux="tags"><i class="icon-tags"></i>'.__("Tags", "swiftframework").'</a>';
	        
	        // SEARCH FORM
	        $blog_aux .= '<li class="blog-aux-search"><form method="get" class="search-form" action="'. home_url().'/">';
	        $blog_aux .= '<input type="text" placeholder="'. __("Search", "swiftframework") .'" name="s" />';
	        $blog_aux .= '</form></li>';
	        
	        // ARCHIVES
	        $blog_aux .= '<li><a href="#" class="blog-slideout-trigger" data-aux="archives"><i class="icon-list"></i>'.__("Archives", "swiftframework").'</a>';
	        
	        // RSS LINK
	        if ($rss_feed_url != "") {
	        $blog_aux .= '<li><a href="'.$rss_feed_url.'" class="rss-link" target="_blank"><i class="icon-rss"></i>'.__("RSS", "swiftframework").'</a>';
	        }
	        
	        $blog_aux .= '</ul>'; // close .blog-aux-options
	        $blog_aux .= '</div>'; // close .blog-aux-wrap
	        
			$blog_aux .= '<div class="filter-wrap blog-filter-wrap row clearfix">'; // open .blog-filter-wrap
			$blog_aux .= '<div class="filter-slide-wrap span12 alt-bg '.$filter_wrap_bg.'">';
			if ($category_list != '') {  
			    $blog_aux .= '<ul class="aux-list aux-categories row clearfix">'.$category_list.'</ul>';  
			}
			if ($tags_list != '') {  
			    $blog_aux .= '<ul class="aux-list aux-tags row clearfix">'.$tags_list.'</ul>';  
			}	
			if ($archive_list != '') {  
			    $blog_aux .= '<ul class="aux-list aux-archives row clearfix">'.$archive_list.'</ul>';  
			}
			$blog_aux .='</div></div>'; // close .blog-filter-wrap
	        }
	        
	        
	        /* BLOG QUERY SETUP
	        ================================================== */ 
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		// BLOG QUERY SETUP
    		global $post, $wp_query;
    		
    		if ( get_query_var( 'paged' ) ) {
    		    $paged  = get_query_var( 'paged' );
    		    $offset = $offset + ( $item_count * ( $paged - 1 ) );
    		} elseif ( get_query_var( 'page' ) ) {
    		    $paged  = get_query_var( 'page' );
    		    $offset = $offset + ( $item_count * ( $paged - 1 ) );
    		} else {
    		    $paged = 1;
    		}
    		    		
    		$blog_args = array(
    			'post_type' => 'post',
    			'post_status' => 'publish',
    			'paged' => $paged,
    			'category_name' => $category_slug,
    			'posts_per_page' => $item_count,
    			'offset' => $offset
    			);
    			    		
    		$blog_items = new WP_Query( $blog_args );
    			
    		$list_class = '';
    		
    		if ($blog_type == "masonry") {
    		$list_class .= 'masonry-items';
    		} else if ($blog_type == "mini") {
    		$list_class .= 'mini-items';
    		} else {
    		$list_class .= 'standard-items';
    		}    		
    		
    		/* BLOG ITEMS OUTPUT
    		================================================== */ 
    		
    		$items .= '<ul class="blog-items row '. $list_class .' clearfix">';
    			
			while ( $blog_items->have_posts() ) : $blog_items->the_post();
				    				
				$post_format = get_post_format();
				if ( $post_format == "" ) {
					$post_format = 'standard';
				}
				
				$item_class = '';
				
				if ($blog_type == "mini") {
					$item_class = $width;
				} else if ($blog_type == "masonry") {
					if ($sidebars == "both-sidebars") {
					$item_class = "span3";
					} else {
					$item_class = "span4";
					}
				} else {
					$item_class = $width;
				}
								
				/* BLOG ITEM OUTPUT
				================================================== */ 
				
				if ($blog_type == "masonry") {
				$items .= '<li class="blog-item recent-post '.$item_class.' format-'.$post_format.'">';
				} else {
				$items .= '<li class="blog-item '.$item_class.' format-'.$post_format.'">';
				}
				$items .= sf_get_post_item($post->ID, $blog_type, $show_title, $show_excerpt, $show_details, $excerpt_length, $content_output, $show_read_more);
				$items .= '</li>';
				
			endwhile;
			
			wp_reset_postdata();
			$items .= '</ul>';
			
			
			/* PAGINATION OUTPUT
			================================================== */ 
			
			if ($pagination == "yes") {
			
				if ($blog_type == "masonry") {
				$items .= '<div class="pagination-wrap masonry-pagination">';
				} else {
				$items .= '<div class="pagination-wrap">';
				}
							
				$items .= pagenavi($blog_items);
													
				$items .= '</div>';
				
			}
			
			
			/* FINAL OUTPUT
			================================================== */ 
 			
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="wpb_blog_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper blog-wrap">';            
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading"><span>'.$title.'</span></h3></div>' : '';
            if ($show_blog_aux == "yes") {
            $output .= "\n\t\t\t\t".$blog_aux;
            }
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            if ($blog_type == "masonry") {
            global $include_isotope;
            $include_isotope = true;
            }
            
            global $has_blog;
            $has_blog = true;
            
            return $output;
		
    }
}

WPBMap::map( 'blog', array(
    "name"		=> __("Blog", "js_composer"),
    "base"		=> "blog",
    "class"		=> "wpb_blog",
    "icon"      => "icon-wpb-blog",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Show blog aux options", "js_composer"),
    	    "param_name" => "show_blog_aux",
    	    "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
    	    "description" => __("Show the blog aux options - categories/tags/search/archives/rss. NOTE: This is only available on a page with the no sidebar setup.", "js_composer")
    	),
    	array(
    	    "type" => "dropdown",
    	    "heading" => __("Blog type", "js_composer"),
    	    "param_name" => "blog_type",
    	    "value" => array(__('Standard', "js_composer") => "standard", __('Mini', "js_composer") => "mini", __('Masonry', "js_composer") => "masonry"),
    	    "description" => __("Select the display type for the blog.", "js_composer")
    	),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "5",
            "description" => __("The number of blog items to show per page.", "js_composer")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Blog category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('category'),
            "description" => __("Choose the category for the blog items.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Posts offset", "swift-framework-admin"),
            "param_name" => "offset",
            "value" => "0",
            "description" => __("The offset for the start of the posts that are displayed, e.g. enter 5 here to start from the 5th post.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show title text", "js_composer"),
            "param_name" => "show_title",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item title text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item excerpt", "js_composer"),
            "param_name" => "show_excerpt",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item excerpt text.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show item details", "js_composer"),
            "param_name" => "show_details",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show the item details.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Excerpt Length", "js_composer"),
            "param_name" => "excerpt_length",
            "value" => "20",
            "description" => __("The length of the excerpt for the posts.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Content Output", "js_composer"),
            "param_name" => "content_output",
            "value" => array(__("Excerpt", "js_composer") => "excerpt", __("Full Content", "js_composer") => "full_content"),
            "description" => __("Choose whether to display the excerpt or the full content for the post. Full content is not available for the masonry view.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show read more link", "js_composer"),
            "param_name" => "show_read_more",
            "value" => array(__("No", "js_composer") => "no", __("Yes", "js_composer") => "yes"),
            "description" => __("Show a read more link below the excerpt.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "js_composer"),
            "param_name" => "pagination",
            "value" => array(__("Yes", "js_composer") => "yes", __("No", "js_composer") => "no"),
            "description" => __("Show pagination.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>
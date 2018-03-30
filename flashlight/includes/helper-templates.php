<?php
/**
 * This file holds the helper classes and functions that are necessary to setect which template to display
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright ( c ) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://aviathemes.com
 * @since		Version 1.1
 * @package 	AviaFramework
 */




############################################################################################################################################
/**
*
* This function retrieves the template for the currently viewed post or page. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_template()
{
	global $avia_config, $post;
	$dynamic_id = "";
	if(isset($post)) $dynamic_id = $post->ID;
	
	/*
	*  Check if the frontpge redirected us to this function
	*/
	$frontpage_switch = avia_get_option('frontpage');
	if($frontpage_switch && isset($avia_config['new_query']) && $avia_config['new_query']['page_id'] == $frontpage_switch)
	{
		$dynamic_id = $frontpage_switch;
	}
	
	
	/*
	 *  if the user wants to display a blog on that page do so by
	 *  calling the blog template and then exit the script
	 */
	
	//wpml prepared
	$blog_page_id = avia_get_option('blogpage');
    if (function_exists('icl_object_id'))
    {
        $blog_page_id = icl_object_id($blog_page_id, 'page', true);
    }

	if(avia_get_option('frontpage') != "" && $blog_page_id == $post->ID && !isset($avia_config['new_query']))
	{ 	
		get_template_part( 'template', 'blog' ); exit();
	}
	
	if(!avia_is_overview() && strpos(avia_post_meta(avia_get_the_ID(), 'gallery_layout'), 'masonry') !== false )
	{ 	
		get_template_part( 'template', 'masonry' ); exit();
	}
	
	
	/*
	*  check if this page was set as a portfolio page by the user
	*  in the theme portfolio options 
 	*/
 
	if($portfolios = avia_get_option('portfolio'))
	{
		if(!empty($portfolios[0]['portfolio_page']))
		{
			foreach($portfolios as $portfolio)
			{	
			
				//wpml prepared
				if (function_exists('icl_object_id'))
                {
                    $portfolio['portfolio_page'] = icl_object_id($portfolio['portfolio_page'], 'page', true);
                }
					
				if(is_page($portfolio['portfolio_page']))
				{	
					if(empty($portfolio['portfolio_columns'])) $portfolio['portfolio_columns'] = 2;
				
					$avia_config['portfolio_columns'] = $portfolio['portfolio_columns'] ;
					$avia_config['portfolio_item_count'] = $portfolio['portfolio_item_count'];	
					
					if($portfolio['portfolio_pagination'] != 'yes')
					{
						$avia_config['remove_pagination'] = true;
					}
					
					if($portfolio['portfolio_text'] != 'yes')
					{
						$avia_config['remove_portfolio_text'] = true;
					}
					
					
					//$avia_config['portfolio_style'] = $portfolio['portfolio_style'];
					if(isset($portfolio['portfolio_cats']))
					{
						//wpml prepared:
						$terms = explode(',', $portfolio['portfolio_cats']);
	                    if (function_exists('icl_object_id'))
	                    {
	                        foreach ($terms as $key => $term_id) {
	                            $terms[$key] = icl_object_id($term_id, 'portfolio_entries', true);
	                        }
	                    }
					}
					
					if(isset($portfolio['portfolio_cats']))
					{		
					$avia_config['new_query'] = array("paged" => get_query_var( 'paged' ), "posts_per_page" => $portfolio['portfolio_item_count'],  'tax_query' => array( array( 'taxonomy' => 'portfolio_entries', 'field' => 'id', 'terms' => $terms, 'operator' => 'IN')));
					}
					get_template_part( 'template', 'portfolio' ); exit();
				}
			}
		}
	}
}




/**
*
* This function retrieves the template for the frontpage. 
* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
*
*/
function avia_get_frontpage_template()
{
	global $avia_config, $post;

	//if the user has set a different frontpage in the theme option settings show that page, otherwise show the default blog
	if(is_front_page() && avia_get_option('frontpage') != "" && !isset($avia_config['new_query']))
	{ 
		if(get_query_var('paged')) {
		     $paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
		     $paged = get_query_var('page');
		} else {
		     $paged = 1;
		}
	
		$avia_config['new_query'] = array("page_id"=> avia_get_option('frontpage'), "paged" => $paged);
				
		$custom_fields = get_post_meta(avia_get_option('frontpage'), '_wp_page_template', true);
		
		//if the page we are about to redirect uses a template use that template instead of the default page
		if($custom_fields != "" && strpos($custom_fields,'template') !== false && $custom_fields = explode('-',str_replace('.php','',$custom_fields)))
		{
			get_template_part( $custom_fields[0], $custom_fields[1]); 
		}
		else
		{
			get_template_part( 'page' );
		}
		exit();		
	}
}



/*
* support function that checks if the current page should have a post or page layout and sets the var $avia_config['layout']
*/
function avia_template_set_page_layout($post_type = '')
{
	global $avia_config;
	$post_type = 'entry_layout';

	//get the global page layout option set in your backend
 	 $avia_config['layout'] = 'bg_gallery';
 	 
 	 //overwrite the global setting with the page single setting, in case one is defined
 	 $post_id = avia_get_the_ID();

 	 if($post_id) 
 	 {
		$new = avia_post_meta($post_id, $post_type); 	
		$new .= " ".avia_post_meta($post_id, 'gallery_layout');
 	 	$avia_config['layout'] = $new;
 	 }
}

add_action('wp_head','avia_template_set_page_layout');

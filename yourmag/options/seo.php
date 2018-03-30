<?php 
function custom_titles() {
	global $shortname;
	
	
	if (is_home() || is_front_page()) {
		if (get_option($shortname.'_seo_home_title') == 'on') echo get_option($shortname.'_seo_home_titletext');  
		else { 
			 echo get_bloginfo('name');
		}
	}
	
	if (is_single() || is_page()) { 
		global $wp_query; 
		$postid = $wp_query->post->ID; 
		$result = get_post_meta($postid, 'custom-title', true);
				if (get_option($shortname.'_seo_single_title') == 'on' && $result !== '' ) echo $result; 
				else { 
                     echo wp_title('',false,'');
			    }
					
	}
	
	if (is_category() || is_archive() || is_search()) { 
	 echo get_bloginfo('name')." | ".wp_title('',false,''); 	
	}	
	
} 


function custom_description() {
	global $shortname;

	if (is_front_page() && get_option($shortname.'_seo_home_description') == 'on') echo '<meta name="description" content="'.get_option($shortname.'_seo_home_descriptiontext').'" />';
	
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	if (isset($postid)) $exists = get_post_meta($postid, 'custom-description', true);
	if (get_option($shortname.'_seo_single_description') == 'on' && $exists !== '') {
		if (is_single() || is_page()) echo '<meta name="description" content="'.$exists.'" />';
	}
	
	

   }

function custom_keywords() {
	global $shortname;
	
	if (is_front_page() && get_option($shortname.'_seo_home_keywords') == 'on') echo '<meta name="keywords" content="'.get_option($shortname.'_seo_home_keywordstext').'" />';
	
	global $wp_query; 
	if (isset($wp_query->post->ID)) $postid = $wp_query->post->ID; 
	if (isset($postid)) $exist = get_post_meta($postid, 'custom-keywords', true);
	if (isset($exist) && $exist !== '' && get_option($shortname.'_seo_single_keywords') == 'on') {
		if (is_single() || is_page()) echo '<meta name="keywords" content="'.$exist.'" />';	
	}
}

?>
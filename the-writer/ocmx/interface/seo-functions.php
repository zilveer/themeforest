<?php 
/* Theme Colour Selection */
function ocmx_site_title()
	{
		global $post;
		if(is_singular()) :
			$post_meta = get_post_meta($post->ID, "meta_title", true);
		endif;
		
		$seperator = get_option("ocmx_seperator");
		$default = get_bloginfo("name");
		
		if(get_option("ocmx_seo") == "yes") :
			if(is_singular() && $post_meta != "" ) :
				echo "\n<title>".get_bloginfo("name")." $seperator ".$post_meta."</title>";
			elseif(is_singular() || is_category()) :
				echo "\n<title>".wp_title($seperator, false, "right").$default."</title>";
			elseif(get_option("ocmx_meta_title")) :
				echo "\n<title>".get_option("ocmx_meta_title")."</title>";
			else :
				echo "\n<title>".$default."</title>";
			endif;
		else :
			echo "\n<title>".wp_title($seperator, false, "right").$default."</title>";
		endif;
	}
function ocmx_meta_keywords()
	{
		global $post;
		$post_meta = get_post_meta($post->ID, "meta_keywords", true);
		if(is_singular() && $post_meta != "") :
			echo "\n<meta name=\"keywords\" content=\"".$post_meta."\" />";
		elseif(is_singular() && fetch_post_tags($post->ID) !== "") :	
			echo "\n<meta name=\"keywords\" content=\"".fetch_post_tags($post->ID)."\" />";
		elseif(get_option("ocmx_meta_keywords")) :
			echo "\n<meta name=\"keywords\" content=\"".get_option("ocmx_meta_keywords")."\" />";
		endif;
		
	}
function ocmx_meta_description()
	{
		global $post;
		$post_meta = get_post_meta($post->ID, "meta_description", true);
		if(is_singular() && $post_meta != "") :
			echo "\n<meta name=\"description\" content=\"".$post_meta."\" />";
		elseif(is_singular() && $post->post_excerpt !== "") :	
			echo "\n<meta name=\"description\" content=\"".trim(strip_tags($post->post_excerpt))."\" />";
		elseif(get_option("ocmx_meta_description")) :
			echo "\n<meta name=\"description\" content=\"".get_option("ocmx_meta_description")."\" />";
		endif;
	}
?>
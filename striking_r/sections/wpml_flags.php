<?php
if(!function_exists('theme_section_wpml_flags')){
/**
 * The default template for displaying wpml flags in the pages
 */
function theme_section_wpml_flags(){
	$output = '';
	if(function_exists('icl_get_languages')){
		$languages = icl_get_languages('skip_missing=0');
		if(!empty($languages) && is_array($languages)){
			$output .= '<div id="language_flags"><ul>';
			foreach($languages as $l){
				$output .= '<li>';
				if(!$l['active']) $output .=  '<a href="'.$l['url'].'" title="'.$l['native_name'].'">';
				$output .=  '<img src="'.$l['country_flag_url'].'" alt="'.$l['language_code'].'" />';
				if(!$l['active']) $output .=  '</a>';
				$output .=  '</li>';
			}
			$output .=  '</ul></div>';
		}
	}
	return $output;
}
}
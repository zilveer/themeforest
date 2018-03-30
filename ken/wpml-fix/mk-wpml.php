<?php

/* - WPML compatibility - */
if(defined('ICL_SITEPRESS_VERSION') && defined('ICL_LANGUAGE_CODE'))
{
	if(!function_exists('mk_wpml_language_switch'))
	{
		function mk_wpml_language_switch()
		{
			$languages = icl_get_languages('skip_missing=0&orderby=id');
			$output = "";

			if(is_array($languages))
			{

	       		$output .= '<div class="mk-language-nav"><a href="#"><i class="mk-icon-globe"></i>'. __('Languages', 'mk_framework').'</a>';
				$output .= '<div class="mk-language-nav-sub-wrapper"><div class="mk-language-nav-sub">';
				$output .= "<ul class='mk-language-navigation'>";
				foreach($languages as $lang)
				{
					$output .= "<li class='language_".$lang['language_code']."'><a href='".$lang['url']."'>";
					$output .= "<span class='mk-lang-flag'><img title='".$lang['native_name']."' alt='".$lang['native_name']."' src='".$lang['country_flag_url']."' /></span>";
					$output .= "<span class='mk-lang-name'>".$lang['translated_name']."</span>";
					$output .= "</a></li>";
				}

				$output .= "</ul></div></div></div>";
			}

			echo $output;
		}
	}
}


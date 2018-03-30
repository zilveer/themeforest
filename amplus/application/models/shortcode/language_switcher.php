<?php

class BFIShortcodeLanguageSwitcherModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'language_switcher';
    const ALIAS = 'languageswitcher';
    
    public $class = ''; 
	public $size = '16'; // or 32
    
    public function render($content = NULL, $unusedAttributeString = '') {
		$size = $this->size;
		if ($this->size != '32' && $this->size != '16') {
			$size = '16';
		}
	
		// https://github.com/lafeber/world-flags-sprite
		bfi_wp_enqueue_style('flags32-'.$size, 'scripts/world-flag-sprite/css/flags'.$size.'.css', array(), NULL);
	
        // only show this if we have multi-languages
        $languages = bfi_get_option(BFI_SHORTNAME."_multilanguages");
        if (!$languages) return "";
        
        $languages = unserialize($languages);
        if (!count($languages)) return "";
    
        asort($languages);
        $countries = array_values($languages);
        $languages = array_keys($languages);
        
        // get the list of countries for the flags
        foreach ($countries as $key => $locale) {
            $locale = explode('_', $locale);
            if (count($locale)) {
                $countries[$key] = $locale[1];
            } else {
                $countries[$key] = "";
            }
        }
        
        // get default language
        $defaultLanguage = bfi_get_option(BFI_SHORTNAME.'_lang_main_locale');
        if ($defaultLanguage) {
            $defaultLanguage = explode('_', $defaultLanguage);
            array_splice($languages, 0, 0, $defaultLanguage[0]);
            if (count($defaultLanguage) > 1) {
                array_splice($countries, 0, 0, $defaultLanguage[1]);
            } else {
                array_splice($countries, 0, 0, '');
            }
        }
        
        // get the current link
        /*$perma = is_home() ? home_url() : get_permalink();
        
        // string lang from url
        if (preg_match('/\?/', $perma)) {
            if (preg_match('/\?l=[^\&]+/i', $perma)) {
                $perma = preg_replace('/\?l=[^\&]+/i', '', $perma);
            } else if (preg_match('/\&l=[^\&]+/i', $perma)) {
                $perma = preg_replace('/\&l=[^\&]+/i', '', $perma);
            }
        }
    
        // re-place get var
        if (preg_match('/\?/', $perma)) {
            $perma .= "&";
        } else {
            $perma .= "?";
        }
        */
        
        // create the link
        $countryNames = bfi_list_countries();
        $languageNames = bfi_list_languages();
        $ret = "<div class='language_switcher f$size $this->class' $unusedAttributeString>";
        foreach ($languages as $key => $language) {
            // $ret .= "<a href=\"".get_bloginfo('url')."?l=".$language."\">";
            $link = bfi_add_get_var(remove_query_arg('l', bfi_get_current_url()), "l", $language);
            $link = apply_filters('bfi_language_switcher_link', $link, $language);
            $ret .= "<a href=\"".$link."\" title=\"".$languageNames[strtolower($language)]." (".$countryNames[strtoupper($countries[$key])].")\">";
            // $ret .= "<img src=\"".BFI_IMAGEURL."blank.png\" class=\"flag flag-".strtolower($countries[$key])."\"/>";
            $ret .= "<img src=\"".BFI_BLANKIMAGE."\" class=\"flag ".strtolower($countries[$key])."\" style='width: {$size}px; height: {$size}px;'/>";
            $ret .= "</a> ";
        }
        $ret .= "</div>";
        
        return $ret;
    }
}

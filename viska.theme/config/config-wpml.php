<?php
if(defined('ICL_SITEPRESS_VERSION') && defined('ICL_LANGUAGE_CODE')){

	class aweConfigWpml{

		private $wpml_lang;
		private $default_lang;
		private $default_option;

		public function __construct(){
			global $sitepress;
			$this->default_lang = $sitepress->get_default_language();
			$this->wpml_lang = icl_get_languages('skip_missing=0&orderby=custom');
			add_action('awe_copy_default_theme_option',array($this,'awe_copy_default_theme_option'));
			
			add_filter('awe_get_option_by_lang',array($this,'awe_get_option_by_lang'),10,1);
			add_action('awe_lang_bar', array($this, 'awe_lang_bar'));
			do_action('awe_copy_default_theme_option');
		}

		function awe_copy_default_theme_option(){
            $options_name = $this->default_lang ? THEME_OPTIONS_NAME."_".$this->default_lang : THEME_OPTIONS_NAME;
			$options = get_option($options_name);
			if(is_array($this->wpml_lang) && !empty($this->wpml_lang))
			{
				foreach ($this->wpml_lang as $lang) {
					$lang_option = get_option(THEME_OPTIONS_NAME.'_'.$lang['language_code']);
					if($lang_option==''){
						update_option(THEME_OPTIONS_NAME.'_'.$lang['language_code'],$options);
					}
				}
			}
			
		}

		function awe_lang_bar(){
			if(is_array($this->wpml_lang) && !empty($this->wpml_lang)){
				$output = '<ul class="language-bar">';
				foreach ($this->wpml_lang as $lang) {
					$output .= '<li><a href="'.$lang['url'].'"><img src="'.$lang['country_flag_url'].'" alt="'.$lang['native_name'].'"></a></li>';
				}
				$output .= '</ul>';
				echo $output;
			}
		}

		function awe_get_option_by_lang($option){
			return $option_key = $option.'_'.ICL_LANGUAGE_CODE;
		}
	}
	new aweConfigWpml();
	
}// end if wpml is active

?>
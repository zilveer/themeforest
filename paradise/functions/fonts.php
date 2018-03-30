<?php
	function theme_get_base_fonts(){
		global $theme_base_fonts;
		if (empty($theme_base_fonts)) {
			$theme_base_fonts = array(
				'Arial Black,Gadget,sans-serif' => 'Arial Black, Gadget, sans-serif',
				'Arial,Helvetica,Garuda,sans-serif' => 'Arial, Helvetica, Garuda, sans-serif',
				'Verdana,Geneva,Kalimati,sans-serif' => 'Verdana, Geneva, Kalimati, sans-serif',
				'Lucida Sans Unicode,Lucida Grande,Garuda,sans-serif' => 'Lucida Sans Unicode, Lucida Grande, Garuda, sans-serif',
				'Georgia,Nimbus Roman No9 L,serif' => 'Georgia, Nimbus Roman No9 L, serif',
				'Palatino Linotype,Book Antiqua,Palatino,FreeSerif,serif' => 'Palatino Linotype, Book Antiqua, Palatino, FreeSerif, serif',
				'Tahoma,Geneva,Kalimati,sans-serif' => 'Tahoma, Geneva, Kalimati, sans-serif',
				'Trebuchet MS,Helvetica,Jamrul,sans-serif' => 'Trebuchet MS, Helvetica, Jamrul, sans-serif',
				'Times New Roman,Times,FreeSerif,serif' => 'Times New Roman, Times, FreeSerif, serif',
			);
		}
		return $theme_base_fonts;
	}

	function theme_get_cufon_fonts(){
		global $theme_cufon_fonts;
		if (empty($theme_cufon_fonts)) {
			$theme_cufon_fonts = array();
			foreach(glob(get_theme_root() . '/' . get_template() . '/fonts/*.js') as $font_file){
				if(preg_match('/"font-family":"(.*?)".*"font-weight":(.*?),/i', file_get_contents($font_file), $match)){
					$theme_cufon_fonts[trim($match[1])][trim($match[2])] = basename($font_file);
				}
			}
		}
		return $theme_cufon_fonts;
	}

	function theme_register_admin_cufon() {
		wp_enqueue_script('js_cufon', get_bloginfo('template_directory') . '/js/cufon-yui.js', array('jquery'));
		$script_init = "<script type='text/javascript'>\njQuery(document).ready(function($) {\n";
		foreach(theme_get_cufon_fonts() as $font_name => $font){
			foreach($font as $font_weight => $font_file) {
				wp_enqueue_script($font_name.' '.$font_weight, get_bloginfo('template_directory') . "/fonts/{$font_file}", array('js_cufon'));
				$id = str_replace(' ', '', $font_name.$font_weight);
				$script_init .= "Cufon('#preview-{$id}', { fontFamily: '{$font_name}', fontWeight: {$font_weight} });\n";
			}
		}
		$script_init .= "});\n</script>";
		do_action('admin_print_scripts');
		echo $script_init;
	}

	function theme_register_cufon() {
		if (!get_option('use_cufon_font', true))
			return;
		wp_enqueue_script('js_cufon', get_bloginfo('template_directory') . '/js/cufon-yui.js', array('jquery'));
		$font_name = get_option('cufon_font', 'MgOpen Modata');
		$fonts = theme_get_cufon_fonts();
		foreach ($fonts[$font_name] as $font_weight => $font_file) {
			wp_enqueue_script($font_name.' '.$font_weight, get_bloginfo('template_directory') . "/fonts/{$font_file}", array('js_cufon'));
		}
		do_action('admin_print_scripts');
		echo "<script type='text/javascript'>
		jQuery(document).ready(function($) {
		Cufon.replace('h1, h2, h3, h4, h5, h6, .big_btn', { fontFamily: '{$font_name}', hover: true });
		Cufon.replace('.btn.big', { fontFamily: '{$font_name}', color: '#fff', hover: true });
		Cufon.replace('#f_sidebar h3', { fontFamily: '{$font_name}', color: '#fff', textShadow: '1px 1px rgba(0, 0, 0, 0.4)' });
		Cufon.replace('.error404, .s3sliderImage b.title');
	});
</script>";
	}

	if (is_admin())
		add_filter('admin_head', 'theme_register_admin_cufon');
	else
		add_filter('wp_head', 'theme_register_cufon');

	function theme_base_font_options() {
		$options = array();
		foreach(theme_get_base_fonts() as $font => $font_name) {
			$options[$font] = "<span style='font-family: {$font}; font-size: 20px;'>{$font_name}</span><hr/>";
		}
		return $options;
	}

	function theme_cufon_font_options() {
		$options = array();
		foreach(theme_get_cufon_fonts() as $font_name => $font) {
			$label = '';
			foreach($font as $font_weight => $font_file) {
				$id = str_replace(' ', '', $font_name.$font_weight);
				if (!empty($label))
					$label .= '<br/>';
				$label .= "<span class=\"cufon_preview\" id=\"preview-{$id}\">This is a preview of the <span style=\"color:  #379BFF;\">{$font_name} {$font_weight}</span> font. Some numbers: 0123456789 &amp; some special chars âãäåæçèéêëìíîïðñòóôõöùúûüýÿ</span>";
			}
			$options[$font_name] = $label.'<hr/>';
		}
		return $options;
	}

?>

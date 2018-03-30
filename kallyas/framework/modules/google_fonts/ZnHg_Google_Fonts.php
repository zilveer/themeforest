<?php if(! defined('ABSPATH')){ return; }

class ZnHg_Google_Fonts{
	function __construct(){
		// Add actions
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_fonts' ), 5);
		// Add filters
		add_filter( 'tiny_mce_before_init', array( $this, 'add_fonts_dropdown_to_mce' ) );
	}

	/**
	 * Add fonts to TinyMCE fonts dropdown
	 * @param [type] $initArray [description]
	 */
	function add_fonts_dropdown_to_mce($initArray){
		// Custom Google Fonts
		$custom_fonts_list = '';

		if ( $google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options', false, array()) ){
			if( is_array( $google_fonts ) && !empty( $google_fonts ) ){
				foreach ( $google_fonts as $key => $font ) {
					if(isset($font['font_family']) && !empty($font['font_family'])){
						$custom_fonts_list .= $font['font_family'].'='.$font['font_family'].';';
					}
				}
			}
		}

		// Custom Fonts
		if ( $custom_fonts = zget_option('zn_custom_fonts', 'google_font_options', false, array()) ) {
			if( is_array( $custom_fonts ) && !empty( $custom_fonts ) ){
				foreach ( $custom_fonts as $font ) {
					if( $font_name = $font['cf_name'] ){
						$custom_fonts_list .= $font_name.'='.$font_name.';';
					}
				}
			}
		}

		$initArray['font_formats'] = $custom_fonts_list.'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
		return $initArray;
	}

	/**
	 * Add the fonts css to head
	 * @return [type] [description]
	 */
	function enqueue_fonts(){
		$google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options');
		$subsets = '';

		if( $google_subsets = zget_option('zn_google_fonts_subsets', 'google_font_options') ) {
			$subsets = '&subset=' . implode(',', $google_subsets);
		}

		if ( !empty( $google_fonts ) && is_array( $google_fonts ) ) {

			$all_final_fonts = array();

			foreach ($google_fonts as $key => $font) {

				if ( isset($font['font_variants']) ) {
					$variants = implode(',', array_values($font['font_variants']) );
					$all_final_fonts[] = $key.':'.$variants;
				}
				else{
					$all_final_fonts[] = $key;
				}

			}

			$gfont = implode('|', $all_final_fonts);
			wp_enqueue_style( 'zn_all_g_fonts', '//fonts.googleapis.com/css?family='.$gfont.''.$subsets);

		}
	}

	function get_fonts_array() {

		$fonts = array(
				'arial'=>'Arial',
				'verdana'=>'Verdana, Geneva',
				'trebuchet'=>'Trebuchet',
				'georgia' =>'Georgia',
				'times'=>'Times New Roman',
				'tahoma'=>'Tahoma, Geneva',
				'palatino'=>'Palatino',
				'helvetica'=>'Helvetica'
			);

		if ( $google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options') ){

			foreach ( $google_fonts as $key => $font ) {
				$fonts[$font['font_family']] = $font['font_family'];
			}

		}

		// Custom font option
		if ( $custom_fonts = zget_option('zn_custom_fonts', 'google_font_options') ){

			foreach ( $custom_fonts as $font ) {
				// $fonts[$font['font_family']] = $font['font_family'];
				if( ! empty( $font['cf_name'] ) ){
					$fonts[$font['cf_name']] = $font['cf_name'];
				}
			}

		}

		return $fonts;

	}

}

return new ZnHg_Google_Fonts();
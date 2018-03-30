<?php
add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );
if (!function_exists('mytheme_fonts')){
	function mytheme_fonts() {
		global $options_data;
		$customfont = '';

		$default = array(
						'arial',
						'verdana',
						'trebuchet',
						'georgia',
						'times',
						'tahoma',
						'helvetica');

		$googlefonts = array_unique(
			array(
				$options_data['font_top_navigation']['face'],
				$options_data['font_footerheadline']['face'],
				$options_data['font_copyright_menu']['face'],
				$options_data['font_headline_toparea']['face'],
				$options_data['font_titleh1']['face'],
				$options_data['font_titleh2']['face'],						
				$options_data['font_body']['face'],
				$options_data['font_h1']['face'],
				$options_data['font_h2']['face'],
				$options_data['font_h3']['face'],
				$options_data['font_h4']['face'],
				$options_data['font_h5']['face'],
				$options_data['font_h6']['face'],
				$options_data['font_button']['face'],
				$options_data['font_nav']['face'],
				$options_data['font_sidebarwidget']['face']
			)
		);	
		$google_style = ':100&#44;100italic&#44;200&#44;200italic&#44;300&#44;300italic&#44;400&#44;400italic&#44;600&#44;600italic&#44;700&#44;700italic&#44;800&#44;800italic';	
		foreach($googlefonts as $getfonts) {
			if(!in_array($getfonts, $default)) {
					$customfont .= str_replace(' ', '+', $getfonts).$google_style.'|';
			}
		}

		if($customfont != ''){
			$protocol = is_ssl() ? 'https' : 'http';
		    wp_enqueue_style( 'mytheme-googlefonts', $protocol."://fonts.googleapis.com/css?family=". substr_replace($customfont ,"",-1) . "&amp;subset=latin&#44;latin-ext&#44;cyrillic&#44;cyrillic-ext&#44;greek-ext&#44;greek&#44;vietnamese", array(), NULL, 'all' );
		}
		}
}
?>
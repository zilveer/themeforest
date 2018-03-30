<?php
global $smof_data;
$customfont = '';

$default = array(
				'arial',
				'verdana',
				'trebuchet',
				'georgia',
				'times',
				'tahoma',
				'helvetica');

$googlefonts = array(
				$smof_data['rnr_body_text']['face'],
				$smof_data['rnr_heading_h1']['face'],
				$smof_data['rnr_heading_h2']['face'],
				$smof_data['rnr_heading_h3']['face'],
				$smof_data['rnr_heading_h4']['face'],
				$smof_data['rnr_heading_h5']['face'],
				$smof_data['rnr_heading_h6']['face'],			
				$smof_data['rnr_menu']['face'],
				$smof_data['rnr_footer']['face'],
				$smof_data['rnr_heading_subtitle']['face'],
				$smof_data['rnr_parallax_headings_font']['face'],
				$smof_data['rnr_parallax_text_font']['face']
				);

$fonts_list = $googlefonts ;
$fonts_list = array_unique($fonts_list);	
foreach($fonts_list as $getfonts) {

	 
				if((!in_array($fonts_list, $default) && ($getfonts!="0"))) {
						 $customfont = str_replace(' ', '+', $getfonts). ':300italic,400italic,600italic,700italic,800italic,400,300,600,700,800|';
						 echo "<link href='http://fonts.googleapis.com/css?family=" . $customfont . "&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese' rel='stylesheet' type='text/css'>";			   
	}
}

?>
<?php
global $theme_options_default;
$theme_options_default = array(
    'logo'              	=>  ''
    ,'icon'             	 	=>  ''
	,'copyright_text'		=>	'Copyright &copy 2012 <a href="'.'http://wpdance.com'.'" title="Wordpress Template">RoeDok</a>. <br>Designed by <a href="'.'http://wpdance.com/'.'" title="WordPress Themes">WPDance.com</a>.WPDance is a member of <a href="'.'http://www.emthemes.com/'.'" title="Magento Themes">EMThemes</a>'


	
	,'headerAdsEnable'		=>  'Enable'


	,'custom_size'			=> serialize(array(
									array(1200,450)
									,array(960,350)
									,array(750,300)
								))
	
		//single config
	,'showtags'				=>	1
	,'showshare'			=>	1
	,'showauthor'			=>	1
	,'showrelated'			=>	1
	,'showcomments'			=>	1
	
	

	// Integration
	,'google_analytics'		=>	''
	,'code_before_end_body'	=>	''
	,'code_to_bottom_post'	=> ''
	,'code_to_top_post'		=> ''
);

function get_all_gallery_ids(){
    global $wpdb;
    $galleries = $wpdb->get_results('SELECT ter.term_id,ter.name FROM '.$wpdb->term_taxonomy.' AS tax, '.$wpdb->terms.' AS ter WHERE tax.taxonomy="gallery" AND ter.term_id=tax.term_id');
    $galids = "";
    foreach($galleries as $g){
        $galids .= $g->term_id.',';
    }
    return trim($galids,',');
}

function get_all_media_ids(){
    global $wpdb;
    $galleries = $wpdb->get_results('SELECT ter.term_id,ter.name FROM '.$wpdb->term_taxonomy.' AS tax, '.$wpdb->terms.' AS ter WHERE tax.taxonomy="media" AND ter.term_id=tax.term_id');
    $galids = "";
    foreach($galleries as $g){
        $galids .= $g->term_id.',';
    }
    return trim($galids,',');
}


?>
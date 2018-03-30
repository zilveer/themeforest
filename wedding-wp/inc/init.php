<?php

include_once ( 'helpers/get-the-image.php' );
include_once ( 'helpers/wp-pagenavi/wp-pagenavi.php' );
include_once ( 'nc-options/nc-options.php' );
include_once ( 'helpers/woptions.php' );
include_once ( 'helpers/breadcrumbs.php' );
include_once ( 'helpers/theme-config.php' );
include_once  get_template_directory().'/inc/metaboxes/setup.php';
include_once ( 'cpt/init.php' );
include_once ( 'shortcodes/shortcode.php' );
include_once ( 'sidebars/general-sidebars.php' );
//include_once ( 'plugins/post-type-archives.php' );

include_once ( 'plugins/woocommerce/index.php' );
include_once ( 'plugins/plugin-activator/init.php' );



/*
Visual Composer
*/




/*
METABOXES
*/


include_once  get_template_directory().'/inc/metaboxes/pagesubtitle-init.php';
include_once  get_template_directory().'/inc/metaboxes/featured-video-init.php';
include_once  get_template_directory().'/inc/metaboxes/page_title_meta.php';
include_once  get_template_directory().'/inc/metaboxes/slider-meta-init.php';
include_once  get_template_directory().'/inc/metaboxes/seo.php';
include_once  get_template_directory().'/inc/metaboxes/homedark-init.php';
include_once  get_template_directory().'/inc/metaboxes/pricing-table-init.php';
include_once  get_template_directory().'/inc/metaboxes/is_mega-init.php';


/*

Widgets

*/

include_once  get_template_directory().'/inc/widgets/widgets-init.php';


include_once ( 'editor/nc-sc.php' );

/*
	SWEET CUSTOM MENU
*/

include_once get_template_directory(). '/inc/plugins/sweet-custom-menu/sweet-custom-menu.php';




add_filter('the_content', 'webnus_fix_parallax');

function webnus_fix_parallax($content){

$array = array (
    '<p>[' => '[', 
    ']</p>' => ']', 
    ']<br />' => ']'
);
$content = strtr($content, $array);
return $content;
	
}


?>
<?php
/*VISUAL COMPOSER EXTEND*/
$attributes = array(
    'type' => 'dropdown',
    'heading' => "Inner Ellements Style",
    'param_name' => 'oi_ellements_style',
    'value' => array( "Without Paddings", "With Paddings", ),
    'description' => __( "Choose inner ellements style", "orangeidea" )
);
vc_add_param( 'vc_row', $attributes );

$equalizeHeights = array(
    'type' => 'dropdown',
    'heading' => "Inner Ellements Heights",
    'param_name' => 'oi_ellements_height',
    'value' => array( "Normal Heights", "Equalize Heights", ),
    'description' => __( "Choose inner ellements Heights", "orangeidea" )
);
vc_add_param( 'vc_row', $equalizeHeights ); 




/* ------------------------------------------------------------------------ */
/* SHORTCODES */
/* ------------------------------------------------------------------------ */

$uri = get_template_directory();
include($uri.'/framework/vc_extend/shortcodes/custom_heading.php');
include($uri.'/framework/vc_extend/shortcodes/dropcap.php');
include($uri.'/framework/vc_extend/shortcodes/simple_icon.php');
include($uri.'/framework/vc_extend/shortcodes/icons_list.php');
include($uri.'/framework/vc_extend/shortcodes/buttons.php');
include($uri.'/framework/vc_extend/shortcodes/progress_bar.php');
include($uri.'/framework/vc_extend/shortcodes/partners.php');
include($uri.'/framework/vc_extend/shortcodes/custom_slider.php');
include($uri.'/framework/vc_extend/shortcodes/testimonial.php');
include($uri.'/framework/vc_extend/shortcodes/pricing_tables.php');
include($uri.'/framework/vc_extend/shortcodes/team_memder.php');
include($uri.'/framework/vc_extend/shortcodes/portfolio_item.php');
include($uri.'/framework/vc_extend/shortcodes/g_map.php');
include($uri.'/framework/vc_extend/shortcodes/latest_news.php');
include($uri.'/framework/vc_extend/shortcodes/posts_slider.php');


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Oi_Icons_List extends WPBakeryShortCodesContainer {
    };
	class WPBakeryShortCode_Oi_Price_Table extends WPBakeryShortCodesContainer {
    };
	
	class WPBakeryShortCode_Oi_Custom_Slider extends WPBakeryShortCodesContainer {
    }
};
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Oi_List_Item extends WPBakeryShortCode {
    };
	 class WPBakeryShortCode_Vc_Testimonial_Item extends WPBakeryShortCode {
    }
};

?>
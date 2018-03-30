<?php
/**
 * The Sidebar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    global $apollo13;

	if( defined('A13_FULL_WIDTH') && A13_FULL_WIDTH ){
        //no sidebar
    }
	else{
        $sidebar = a13_has_active_sidebar();
        if($sidebar !== false){
            echo '<aside id="secondary" class="widget-area" role="complementary">';

            //if has children nav and it is activated
            $sidebar_meta = $apollo13->get_meta('_widget_area');
            if(strrchr($sidebar_meta, 'nav') && a13_page_menu(true)){
                a13_page_menu();
            }

            if(is_page()){
                //for pages only if enabled
                if(strrchr($sidebar_meta, 'sidebar')){
                    dynamic_sidebar( $sidebar );
                }
            }
            else{
                dynamic_sidebar( $sidebar );
            }

            echo '<div class="clear"></div>';
            echo '</aside>';
        }
    }
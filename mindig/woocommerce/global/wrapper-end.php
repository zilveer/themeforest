<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */


$template = get_option( 'template' );



switch( $template ) {
	case 'twentyeleven' :
		echo '</div></div>';
		break;
	case 'twentytwelve' :
		echo '</div></div>';
		break;
	case 'twentythirteen' :
		echo '</div></div>';
		break;
	case 'twentyfourteen' :
		echo '</div></div></div>';
		get_sidebar( 'content' );
		break;
	default :

        $mobile = YIT_Mobile()->isMobile();
        $sidebar = yit_get_sidebars();

        echo '</div>';
        if( is_product() && ( ! isset( $sidebar['layout'] ) || $sidebar['layout'] == 'sidebar-no' ) && yit_get_option( 'shop-single-layout-page' ) == 'creative' && ! $mobile ) {
            echo '<div class="sidebar clearfix col-sm-3" role="secondary">';
            do_action( 'yit_product_single_boxmeta' );
            echo '</div>';
        }
        yit_primary_sidebar_two();
        yit_primary_sidebar();
        yit_end_primary();
		break;
}
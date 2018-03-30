<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

function yit_tab_settings_settings( $items ) {
    unset( $items[20], $items[21], $items[22] );

    if( is_shop_installed() ) {
        $items[40] = array(
            'id' => 'product-seo-title',
            'type' => 'text',
            'name' => __( 'Products Title', 'yit' ),
            'desc' => __( 'Type in the product title.', 'yit' ),
            'std' => ''
        );

        $items[41] = array(
            'id' => 'product-seo-keywords',
            'type' => 'text',
            'name' => __( 'Products Keywords', 'yit' ),
            'desc' => __( 'Type in the product keywords.', 'yit' ),
            'std' => ''
        );

        $items[42] = array(
            'id' => 'product-seo-description',
            'type' => 'text',
            'name' => __( 'Products Description', 'yit' ),
            'desc' => __( 'Type in the product description.', 'yit' ),
            'std' => ''
        );
    }

    return $items;
}
add_filter( 'yit_submenu_tabs_seo_general_custom_post_type', 'yit_tab_settings_settings' );
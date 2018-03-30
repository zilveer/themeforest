<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Submenu Pages Order
 *
 * @package Yithemes
 * @author Simone D'Amico <simone.damico@yithemes.com>
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */
return apply_filters( 'yit_admin_menu_pages', array(
        /* Theme Options Tabs */
        'theme-options' => array(
            'general' => array(
                'settings',
                'google-font-subsets',
                ( function_exists( 'YIT_Seo') ) ? 'SEO': ''
            ),
            'header' => array(
                'settings',
                'topbar-and-infobar'
            ),
            'content' => array(
                'pages',
                'blog',
            ),
            'footer' => array(
                'settings',
            ),
            'shop' => array(
                'settings',
                'shop-page',
                'single-product-page',
                'category-page'
            ),
            'typography-and-color' => array(
                'general',
                'color-scheme',
                'html-tags',
                'header',
                'sidebars-and-widgets',
                'buttons',
                'content',
                'footer',
                'shop',
            ),
        ),

        /* Custom Login*/
        'custom-login' => array(
            'customize-login-screen' => array(
                'general',
                'background',
                'logo',
                'container'
            ),
        ) ,

        /* Admin Settings*/
        'admin-settings' => array(
            'general' => array(
                'logos'
            ),
        )
    )
);

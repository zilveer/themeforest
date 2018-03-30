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
 * Return an array with the options for Theme Options > General > Google Fonts Subsets
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* General > Google Fonts Subsets */
    array(
        'type' => 'title',
        'name' => __( 'Google Fonts Subsets', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'google_fonts_subsets',
        'type' => 'checklist',
        'name' => __( 'Google Fonts Subsets', 'yit' ),
        'desc' => __( 'Using many subsets can slow down your webpage, so only select the subsets that you actually need on your webpage. Make sure the fonts you\'re using supports the subsets chosen. More info on <a href="http://www.google.com/webfonts">Google Web Fonts</a>.', 'yit' ),
        'std' => '',
        'values' => array(
            'latin'        => __( 'Latin', 'yit' ),
            'latin-ext'    => __( 'Latin Extended', 'yit' ),
            'cyrillic'     => __( 'Cyrillic', 'yit' ),
            'cyrillic-ext' => __( 'Cyrillic Extended', 'yit' ),
            'greek'        => __( 'Greek', 'yit' ),
            'greek-ext'    => __( 'Greek Extended', 'yit' ),
            'khmer'        => __( 'Khmer', 'yit' ),
            'vietnamese'   => __( 'Vietnamese', 'yit' )
        )
    )
);


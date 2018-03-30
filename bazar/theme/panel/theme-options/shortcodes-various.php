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

function yit_tab_shortcodes_various( $items ) {
    
    $items[100] = array(
        'id'   => 'tabs-sep-icol-list',
        'type' => 'title',
        'name' => __('Icon list', 'yit'),
        'desc' => ''                
    );

	$items[110] = array(
        'id'   => 'icon-list-title',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Choose the font type, size and color for the title.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_icon-list-title_std', array(
            'size'   => 15,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'extra-bold',
            'color'  => '#2c2b2b' 
        ) ),
        'style' => apply_filters('yit_icon-list-title_style',array(
			'selectors' => 'div.icon_list h2',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		))
    );

	$items[120] = array(
        'id'   => 'icon-list-list',
        'type' => 'typography',
        'name' => __( 'Text', 'yit' ),
        'desc' => __( 'Choose the font type, size and color for the text.', 'yit' ),
        'min'  => 1,
        'max'  => 30,
        'std'  => apply_filters( 'yit_icon-list-list_std', array(
            'size'   => 15,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768' 
        ) ),
        'style' => apply_filters('yit_icon-list-list_style',array(
			'selectors' => 'div.icon_list ul li, div.icon_list ul li a',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		))
    );

	$items[130] = array(
        'id'   => 'icon-list-list-link',
        'type' => 'colorpicker',
        'name' => __( 'Link', 'yit' ),
        'desc' => __( 'Choose color of the link.', 'yit' ),
        'std'  => apply_filters( 'yit_icon-list-list-link_std', '#000000' ),
        'style' => apply_filters('yit_icon-list-list-link_style',array(
			'selectors' => 'div.icon_list ul li a',
			'properties' => 'color'
		))
    );

	$items[140] = array(
        'id'   => 'icon-list-list-link-hover',
        'type' => 'colorpicker',
        'name' => __( 'Link hover', 'yit' ),
        'desc' => __( 'Choose color of the link hover.', 'yit' ),
        'std'  => apply_filters( 'yit_icon-list-list-link-hover_std', '#d98104' ),
        'style' => apply_filters('yit_icon-list-list-link-hover_style',array(
			'selectors' => 'div.icon_list ul li a:hover',
			'properties' => 'color'
		))
    );
	
    $items[150] = array(
                'id'   => 'tabs-sep',
                'type' => 'title',
                'name' => '',
                'desc' => ''                
            );
            

    $items[160] = array(
                'id'   => 'faq-allcategories-url',
                'type' => 'upload',
                'name' => __( 'Faq "All Categories" Icon', 'yit' ),
                'desc' => __( 'Enter the URL to Faq "All Categories" icon.', 'yit' ),
                'validate' => 'esc_url'
            );

    $items[170] = array(
        'id'   => 'faq-minus-color',
        'type' => 'colorpicker',
        'name' => __( 'Faq minus color', 'yit' ),
        'desc' => __( 'Select the color of the sign minus when the faq is opened.', 'yit' ),
        'std'  => apply_filters( 'yit_faq-minus-color_std', '#C58408' ),
        'style' => apply_filters('yit_faq-minus-color_style',array(
            'selectors' => '.faq-title .minus',
            'properties' => 'background-color'
        ))
    );

    $items[180] = array(
        'id'   => 'faq-plus-color',
        'type' => 'colorpicker',
        'name' => __( 'Faq plus color', 'yit' ),
        'desc' => __( 'Select the color of the sign plus when the faq is opened.', 'yit' ),
        'std'  => apply_filters( 'yit_faq-plus-color_std', '#2C2B2B' ),
        'style' => apply_filters('yit_faq-plus-color_style',array(
            'selectors' => '.faq-title .plus',
            'properties' => 'background-color'
        ))
    );
    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_shortcodes_various', 'yit_tab_shortcodes_various' );

add_filter( 'yit_twitter-sc_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768'
			);")
);

add_filter( 'yit_twitter-link-sc_std', create_function('','return "#aa620d";'));
add_filter( 'yit_twitter-link-hover-sc_std', create_function('','return "#d98104";'));

add_filter( 'yit_bullet-list_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768'
			);")
);

add_filter( 'yit_toggle-title_std', create_function('',"return array(
            'size'   => 16,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#3e3e3e'
			);")
);

add_filter( 'yit_toggle-text_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768'
			);")
);

add_filter( 'yit_contact-info_std', create_function('',"return array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768'
			);")
);

add_filter( 'yit_icon-list-title_std', create_function('',"return array(
            'size'   => 15,
            'unit'   => 'px',
            'family' => 'Oswald',
            'style'  => 'regular',
            'color'  => '#2c2b2b'
			);")
);

add_filter( 'yit_icon-list-list_std', create_function('',"return array(
            'size'   => 15,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#676768'
			);")
);

add_filter( 'yit_icon-list-list-link_std', create_function('','return "#000000";'));
add_filter( 'yit_icon-list-list-link-hover_std', create_function('','return "#d98104";'));
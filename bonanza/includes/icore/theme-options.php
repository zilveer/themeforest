<?php

function bonanza_get_revolution_sliders() {
    if ( class_exists('RevSlider') ) {
        // Get Revolution sliders
        global $wpdb;
        $get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
        $revsliders['--none--'] = 'Select a slider';

        if($get_sliders) {
            foreach($get_sliders as $slider) {
                $revsliders[$slider->alias] = $slider->title;
            }
        }
        return $revsliders;
    }
}

function bonanza_get_layer_sliders() {

        if ( class_exists('LS_Sliders') ) {
        // Get WPDB Object
        global $wpdb;

        // Table name
        $table_name = $wpdb->prefix . "layerslider";

        $sliders = LS_Sliders::find();

        $layersliders['--none--'] = 'Select a slider';

        //print_r($sliders);
        if( $sliders ) {
            // Iterate over the sliders
            foreach( $sliders as $slider) {
                $id = $slider['id'];
                $layersliders[$id] = $slider['name'];
            }
        }
        return $layersliders;
    }
}


/*-----------------------------------------------------------------------------------*/
/* Register Theme Options */
/*-----------------------------------------------------------------------------------*/
global $theme_options;

$this->sections['general']      = __( 'General', 'icore' );
$this->sections['appearance']   = __( 'Appearance', 'icore' );
$this->sections['colors']   = __( 'Colors', 'icore' );
$this->sections['thumbnails']   = __( 'Thumbnails', 'icore' );
$this->sections['homepage']   = __( 'Homepage', 'icore' );
$this->sections['slider']   = __( 'Homepage Slider', 'icore' );

/* Define Theme Options */

/* General Settings
===========================================*/


$this->settings['favicon'] = array(
    'title'   => __( 'Custom Favicon ', 'icore'),
    'desc'    => __( 'Upload favicon image here.', 'icore'),
    'std'     => '',
    'type'    => 'upload',
    'section' => 'general'
);

$this->settings['logo'] = array(
    'title'   => __( 'Logo Image', 'icore' ),
    'desc'    => __( 'Upload logo image', 'icore' ),
    'std'     => '',
    'type'    => 'upload',
    'section' => 'general'
);

$this->settings['font_headline'] = array(
    'section' => 'general',
    'title'   => __( 'Headlines Font', 'icore' ),
    'desc'    => __( 'Select headlines font', 'icore' ),
    'type'    => 'select',
    'std'     => 'Oswald',
    'choices' => icore_google_fonts_choices()
);

$this->settings['font_body'] = array(
    'section' => 'general',
    'title'   => __( 'Body Font', 'icore' ),
    'desc'    => __( 'Select body text font', 'icore' ),
    'type'    => 'select',
    'std'     => 'Helvetica-Neue',
    'choices' => icore_google_fonts_choices()
);

$this->settings['google_analytics'] = array(
    'title'   => __( 'Google Analytics', 'icore' ),
    'desc'    => __( 'Paste your <a href="http://www.google.com/analytics/" rel="nofollow" target="_blank" >Google Analytics</a> code above.', 'icore' ),
    'std'     => '',
    'type'    => 'textarea',
    'section' => 'general'
);



/* Appearance
===========================================*/


$this->settings['primary_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Header/Footer Background Color <br />default: #fcfcfc', 'icore' ),
    'desc'    => __( 'select header and footer background color ( default: #fcfcfc )', 'icore' ),
    'type'    => 'color',
    'std'     => '#fcfcfc'
);


$this->settings['header_link_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Header/Footer Link Color <br />default: #4d4d4d', 'icore' ),
    'desc'    => __( 'select header and footer link color ( default: #4d4d4d )', 'icore' ),
    'type'    => 'color',
    'std'     => '#4d4d4d'
);

$this->settings['header_text_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Header/Footer Text Color<br />default: #777777', 'icore' ),
    'desc'    => __( 'select header and footer text color ( default: #777777 )', 'icore' ),
    'type'    => 'color',
    'std'     => '#777777'
);

$this->settings['secondary_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Theme Accent Color<br />default: #519400', 'icore' ),
    'desc'    => __( 'select accent color ( buttons, borders, etc ) ( default: #519400 )', 'icore' ),
    'type'    => 'color',
    'std'     => '#519400'
);

$this->settings['nav_bg_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Navigation Background Color<br />default: #f6f6f6', 'icore' ),
    'desc'    => __( 'select navigation background color ( default: #f6f6f6 )', 'icore' ),
    'type'    => 'color',
    'std'     => '#f6f6f6'
);

$this->settings['nav_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Navigation Link<br />default: #999999', 'icore' ),
    'desc'    => __( 'select navigation menu text color ( default: #999999 )', 'icore' ),
    'type'    => 'color',
    'std'     => '#999999'
);

$this->settings['nav_hover_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Navigation Link Hover<br />default: #3d3d3d', 'icore' ),
    'desc'    => __( 'select navigation menu hover text color ( default: #3d3d3d )', 'icore' ),
    'type'    => 'color',
    'std'     => '#3d3d3d'
);

$this->settings['nav_active_color'] = array(
    'section' => 'colors',
    'title'   => __( 'Navigation Link Active<br />default: #3d3d3d', 'icore' ),
    'desc'    => __( 'select navigation menu text color ( default: #3d3d3d )', 'icore' ),
    'type'    => 'color',
    'std'     => '#3d3d3d'
);

$this->settings['sidebar'] = array(
    'section' => 'appearance',
    'title'   => __( 'Sidebar Position', 'icore' ),
    'desc'    => __( 'Select sidebar position', 'icore' ),
    'type'    => 'select',
    'std'     => 'left',
    'choices' => array(
        'right' => 'right',
        'left' => 'left'
    )
);

$this->settings['portfolio_layout'] = array(
    'section' => 'appearance',
    'title'   => __( 'Portfolio Layout', 'icore' ),
    'desc'    => __( 'Select layout for portfolio archive pages', 'icore' ),
    'type'    => 'select',
    'std'     => 'two',
    'choices' => array(
        'one' => 'one column',
        'two' => 'two column',
        'three' => 'three column'
    )
);

$this->settings['search'] = array(
    'section' => 'appearance',
    'title'   => __( 'Search Bar', 'icore' ),
    'desc'    => __( 'display header search bar', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['blog_style'] = array(
    'section' => 'appearance',
    'title'   => __( 'Full Post Content', 'icore' ),
    'desc'    => __( 'show full post content instead of excerpt', 'icore' ),
    'type'    => 'checkbox',
    'std'     => ''
);



$this->settings['payment_visa'] = array(
    'section' => 'appearance',
    'title'   => __( 'We accept Visa', 'icore' ),
    'desc'    => __( 'check to show icon under "We Accept" footer area', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['payment_mastercard'] = array(
    'section' => 'appearance',
    'title'   => __( 'We accept Mastercard', 'icore' ),
    'desc'    => __( 'check to show icon under "We Accept" footer area', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['payment_amex'] = array(
    'section' => 'appearance',
    'title'   => __( 'We accept American Express', 'icore' ),
    'desc'    => __( 'check to show icon under "We Accept" footer area', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['payment_paypal'] = array(
    'section' => 'appearance',
    'title'   => __( 'We accept Paypal', 'icore' ),
    'desc'    => __( 'check to show icon under "We Accept" footer area', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['payment_checks'] = array(
    'section' => 'appearance',
    'title'   => __( 'We accept Checks', 'icore' ),
    'desc'    => __( 'check to show icon under "We Accept" footer area', 'icore' ),
    'type'    => 'checkbox',
    'std'     => ''
);

$this->settings['custom_css'] = array(
    'title'   => __( 'Custom CSS', 'icore' ),
    'desc'    => __( 'Enter your custom CSS code here.', 'icore' ),
    'std'     => '',
    'type'    => 'textarea',
    'section' => 'appearance',
    'class'   => 'code'
);


/* Homepage
===========================================*/

$this->settings['call_to_action_enabled'] = array(
            'section' => 'homepage',
            'title'   => __( 'Homepage message', 'icore' ),
            'desc'    => __( 'Display Homepage Message', 'icore'),
            'std'     => '1',
            'type'    => 'checkbox'
        );

$this->settings['call_to_action_one'] = array(
            'section' => 'homepage',
            'title'   => __( 'Homepage message line one', 'icore' ),
            'desc'    => __( 'Enter text for line one', 'icore'),
            'std'     => 'Free Shipping on all orders over $199',
            'type'    => 'text'
        );

$this->settings['call_to_action_two'] = array(
            'section' => 'homepage',
            'title'   => __( 'Homepage message line two', 'icore' ),
            'desc'    => __( 'Enter text for line two', 'icore'),
            'std'     => 'You can change this text by going to Appearance -> Theme Options -> Homepage',
            'type'    => 'text'
        );

$this->settings['homepage_team'] = array(
            'section' => 'homepage',
            'title'   => __( 'Team', 'icore' ),
            'desc'    => __( 'Display team on homepage', 'icore'),
            'std'     => '0',
            'type'    => 'checkbox'
        );

$this->settings['homepage_portfolio'] = array(
            'section' => 'homepage',
            'title'   => __( 'Portfolio', 'icore' ),
            'desc'    => __( 'Display portfolio on homepage', 'icore'),
            'std'     => '0',
            'type'    => 'checkbox'
        );

$this->settings['homepage_portfolio_number'] = array(
            'section' => 'homepage',
            'title'   => __( 'Portfolio items', 'icore' ),
            'desc'    => __( 'Select number of items to show in portoflio', 'icore'),
            'std'     => '6',
            'type'    => 'text'
        );

$this->settings['home_portfolio_excerpt'] = array(
            'section' => 'homepage',
            'title'   => __( 'Portfolio excerpt', 'icore' ),
            'desc'    => __( 'Display portfolio excerpt on homepage', 'icore'),
            'std'     => '0',
            'type'    => 'checkbox'
        );

$this->settings['homepage_page'] = array(
    'section' => 'homepage',
    'title'   => __( 'Homepage content page', 'icore' ),
    'desc'    => __( 'Display selected page content on the homepage', 'icore' ),
    'type'    => 'select',
    'std'     => 'none',
    'choices' => $this->getPages(),
);

$this->settings['homepage_page_2'] = array(
    'section' => 'homepage',
    'title'   => __( 'Homepage content page 2', 'icore' ),
    'desc'    => __( 'Display selected page content on the homepage', 'icore' ),
    'type'    => 'select',
    'std'     => 'none',
    'choices' => $this->getPages(),
);

$this->settings['home_products_featured'] = array(
            'section' => 'homepage',
            'title'   => __( 'Featured Products', 'icore' ),
            'desc'    => __( 'Display featured products on homepage', 'icore'),
            'std'     => '1',
            'type'    => 'checkbox'
        );

$this->settings['home_featured_number'] = array(
            'section' => 'homepage',
            'title'   => __( 'Number of Featured Products', 'icore' ),
            'desc'    => __( 'Select number of featured products to show on homepage', 'icore'),
            'std'     => '8',
            'type'    => 'text'
        );


$this->settings['home_products_recent'] = array(
            'section' => 'homepage',
            'title'   => __( 'Recent Products', 'icore' ),
            'desc'    => __( 'Display recent products on homepage', 'icore'),
            'std'     => '1',
            'type'    => 'checkbox'
        );

$this->settings['home_recent_number'] = array(
            'section' => 'homepage',
            'title'   => __( 'Number of Recent Products', 'icore' ),
            'desc'    => __( 'Select number of featured products to show on homepage', 'icore'),
            'std'     => '4',
            'type'    => 'text'
        );


/* Thumbnails
===========================================*/

$this->settings['front-page_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Front page thumbnails', 'icore'),
    'desc'    => __( 'show thumbnails on Front page', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['category_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Category page thumbnails', 'icore' ),
    'desc'    => __( 'show thumbnails on Category pages', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['author_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Author page thumbnails', 'icore' ),
    'desc'    => __( 'show thumbnails on Author pages', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['tag_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Tag page thumbnails', 'icore' ),
    'desc'    => __( 'show thumbnails on Tag pages', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['single_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Single post thumbnail', 'icore' ),
    'desc'    => __( 'show thumbnails on Single posts', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['page_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Single page thumbnail', 'icore' ),
    'desc'    => __( 'show thumbnails on Single page', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);

$this->settings['search_thumb'] = array(
    'section' => 'thumbnails',
    'title'   => __( 'Search page thumbnail', 'icore' ),
    'desc'    => __( 'show thumbnails on search page', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1'
);


/* Slider
===========================================*/

$this->settings['slider_enabled'] = array(
    'section' => 'slider',
    'title'   => __( 'Homepage Slider', 'icore' ),
    'desc'    => __( 'Enable Homepage Slider', 'icore' ),
    'type'    => 'checkbox',
    'std'     => ''
);

$this->settings['slider_size'] = array(
    'section' => 'slider',
    'title'   => __( 'Slider size', 'icore' ),
    'desc'    => __( 'select slider size', 'icore' ),
    'type'    => 'select',
    'std'     => 'full',
    'choices' => array(
        'full' => 'full width',
        'boxed' => 'boxed'
    )
);

$this->settings['slider_type'] = array(
    'section' => 'slider',
    'title'   => __( 'Slider Type', 'icore' ),
    'desc'    => __( 'select slider type', 'icore' ),
    'type'    => 'select',
    'std'     => 'flexslider',
    'class' => ' slider_type',
    'choices' => array(
        'flexslider' => 'flexslider',
        'flexthumbs' => 'flexslider + thumbnails',
        'flexlaptop' => 'laptop slider',
        'revslider' => 'revolution slider',
        'layerslider' => 'layer slider'
    )
);

$this->settings['rev_slider'] = array(
    'section' => 'slider',
    'title'   => __( 'Revolution Slider', 'icore' ),
    'desc'    => __( 'Select slider', 'icore' ),
    'type'    => 'select',
    'std'     => '',
    'choices' => bonanza_get_revolution_sliders(),
    'class' => ' pid revslider'
);

$this->settings['layer_slider'] = array(
    'section' => 'slider',
    'title'   => __( 'Layer Slider', 'icore' ),
    'desc'    => __( 'Select slider', 'icore' ),
    'type'    => 'select',
    'std'     => '',
    'choices' => bonanza_get_layer_sliders(),
    'class' => ' pid layerslider'
);

$this->settings['slider_auto'] = array(
    'section' => 'slider',
    'title'   => __( 'Automatic Animation', 'icore' ),
    'desc'    => __( 'Animate slider automatically', 'icore' ),
    'type'    => 'checkbox',
    'std'     => '1',
    'class' => ' pid flexslider flexthumbs flexlaptop'

);

$this->settings['slider_animation'] = array(
    'section' => 'slider',
    'title'   => __( 'Slider Effect', 'icore' ),
    'desc'    => __( 'Select slider animation effect', 'icore' ),
    'type'    => 'select',
    'std'     => 'fade',
    'choices' => array(
        'fade' => 'fade',
        'slide' => 'slide'
    ),
    'class' => ' pid flexslider flexthumbs flexlaptop'
);

$this->settings['slider_speed'] = array(
    'section' => 'slider',
    'title'   => __( 'Slideshow Speed', 'icore' ),
    'desc'    => __( 'Set the speed of the slideshow cycling, in milliseconds. 1 second = 1000 milliseconds.', 'icore' ),
    'type'    => 'text',
    'std'     => '7000',
    'class' => ' pid flexslider flexthumbs flexlaptop'
);


$this->settings['slider'] = array(
    'section' => 'slider',
    'title'   => __( 'Slideshow Images', 'icore' ),
    'desc'    => __( 'Upload slider Images. Drag and drop to reorganize.', 'icore'),
    'type'    => 'slide',
    'std'     => '',
    'class' => ' pid flexslider flexthumbs flexlaptop'
);

?>
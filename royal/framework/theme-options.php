<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options($return = false) {
    /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
	  
	  

	
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
   
   $sections = array(
        array(
            'id'       => 'general',
            'title'    => 'General',
            'icon'     => 'icon-cog'
        ),
        array(
            'id'       => 'color_scheme',
            'title'    => 'Color Scheme',
            'icon'     => 'icon-picture'
        ),
        array(
            'id'       => 'typography',
            'title'    => 'Typography',
            'icon'     => 'icon-text-height'
        ),
        array(
            'id'       => 'header',
            'title'    => 'Header',
            'icon'     => 'icon-cogs'
        ),
        array(
            'id'       => 'footer',
            'title'    => 'Footer',
            'icon'     => 'icon-cogs'
        ),
        array(
            'id'       => 'shop',
            'title'    => 'Shop',
            'icon'     => 'icon-shopping-cart'
        ),
        array(
            'id'       => 'product_grid',
            'title'    => 'Products Page Layout',
            'icon'     => 'icon-th'
        ),
        array(
            'id'       => 'single_product',
            'title'    => 'Single Product Page',
            'icon'     => 'icon-file-alt'
        ),
        array(
            'id'       => 'quick_view',
            'title'    => 'Quick View',
            'icon'     => 'icon-rocket'
        ),
        array(
            'id'       => 'promo_popup',
            'title'    => 'Promo Popup',
            'icon'     => 'icon-gift'
        ),
        array(
            'id'       => 'blog_page',
            'title'    => 'Blog Layout',
            'icon'     => 'icon-indent-right'
        ),
        array(
            'id'       => 'forum_page',
            'title'    => 'Forum Layout',
            'icon'     => 'icon-comments'
        ),
        array(
            'id'       => 'portfolio',
            'title'    => 'Portfolio',
            'icon'     => 'icon-briefcase'
        ),
        array(
            'id'       => 'contact_form',
            'title'    => 'Contact Form',
            'icon'     => 'icon-envelope'
        ),
        array(
            'id'       => 'responsive',
            'title'    => 'Responsive',
            'icon'     => 'icon-mobile-phone'
        ),
        array(
            'id'       => 'custom_css',
            'title'    => 'Custom CSS',
            'icon'     => 'icon-paper-clip'
        ),
        array(
            'id'       => 'backup',
            'title'    => 'Import/Export',
            'icon'     => 'icon-cog'
        )
   );
   
   if(!function_exists('is_bbpress')){
	   unset($sections[11]);
   }
   
   $settings = apply_filters('et_options_tree_settings', array(
        array(
            'id'          => 'main_layout',
            'label'       => 'Site Layout',
            'default'     => 'wide',
            'type'        => 'select',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 'wide',
                'label' => 'Wide' 
              ),
              array( 
                'value' => 'boxed',
                'label' => 'Boxed' 
              ),
              array( 
                'value' => 'bordered',
                'label' => 'Bordered' 
              )
            )
        ),
        array(
            'id'          => 'fixed_nav',
            'label'       => 'Fixed navigation',
            'default'     => array(0=>1),
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'favicon_badge',
            'label'       => 'Show products in cart count on the favicon',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'loader',
            'label'       => 'Show loader icon until site loading',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'to_top',
            'label'       => '"Back To Top" button',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'to_top_mobile',
            'label'       => '"Back To Top" button on mobile',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'google_code',
            'label'       => 'Google Analytics Code',
            'default'     => '',
            'type'        => 'textarea_simple',
            'section'     => 'general'
        ),
        array(
            'id'          => 'disable_right_click',
            'label'       => 'Disable right mouse click on the site',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'right_click_html',
            'label'       => 'HTML code that shows when you click mouse right button on the site',
            'default'     => '',
            'type'        => 'textarea_simple',
            'section'     => 'general'
        ),
        array(
            'id'          => 'force_addons_css',
            'label'       => 'Include styles from "Ultimate Addons for Visual Composer" on every page',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'general',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        // COLOR SCHEME
        array(
            'id'          => 'activecol',
            'label'       => 'Main Color',
            'default'     => '#cda85c',
            'type'        => 'colorpicker',
            'section'     => 'color_scheme',
        ),
        array(
            'id'          => 'background_img',
            'label'       => 'Site Background',
            'desc'        => '',
            'default'     => '',
            'type'        => 'background',
            'section'     => 'color_scheme',
        ),
        array(
            'id'          => 'transparent_container',
            'label'       => 'Transparent container',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'color_scheme',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'header_bg',
            'label'       => 'Header Background',
            'desc'        => '',
            'default'     => '',
            'type'        => 'background',
            'section'     => 'color_scheme',
        ),
        array(
            'id'          => 'header_transparent',
            'label'       => 'Header transparent',
            'type'        => 'checkbox',
            'section'     => 'color_scheme',
            'default'     => 0,
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'menu_bg',
            'label'       => 'Menu Background',
            'desc'        => '',
            'default'     => '',
            'type'        => 'background',
            'section'     => 'color_scheme',
        ),
        array(
            'id'          => 'breadcrumb_bg',
            'label'       => 'Breadcrumbs background',
            'default'     => '',
            'type'        => 'background',
            'section'     => 'color_scheme'
        ),
        // TYPOGRAPHY
        array(
            'id'          => 'mainfont',
            'label'       => 'Main Font',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'mainfont-google',
            'label'       => 'Main Google Font ',
            'default'     => '',
            'type'        => 'google_fonts',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'sfont',
            'label'       => 'Body Font',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'sfont-google',
            'label'       => 'Body Google Font',
            'default'     => '',
            'type'        => 'google_fonts',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'menufont',
            'label'       => 'Menu Font',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'menufont-google',
            'label'       => 'Menu Google Font',
            'default'     => '',
            'type'        => 'google_fonts',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'pade_heading',
            'label'       => 'Page heading',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'pade_heading-google',
            'label'       => 'Page heading google font',
            'default'     => '',
            'type'        => 'google_fonts',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h1',
            'label'       => 'H1',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h2',
            'label'       => 'H2',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h3',
            'label'       => 'H3',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h4',
            'label'       => 'H4',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h5',
            'label'       => 'H5',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        array(
            'id'          => 'h6',
            'label'       => 'H6',
            'default'     => '',
            'type'        => 'typography',
            'section'     => 'typography',
        ),
        // HEADER
        array(
            'id'          => 'top_bar',
            'label'       => 'Enable top bar',
            'default'     => array(0=>1),
            'type'        => 'checkbox',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'header_type',
            'label'       => 'Header Type',
            'default'     => 1,
            'type'        => 'radio-image',
            'section'     => 'header',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => 'Default',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/1.jpg'
                ),
                array(
                    'value'   => 2,
                    'label'   => 'Variant 2',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/2.jpg'
                ),
                array(
                    'value'   => 3,
                    'label'   => 'Variant 3',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/3.jpg'
                ),
                array(
                    'value'   => 4,
                    'label'   => 'Variant 4',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/4.jpg'
                ),
                array(
                    'value'   => 5,
                    'label'   => 'Variant 5',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/5.jpg'
                ),
                array(
                    'value'   => 6,
                    'label'   => 'Variant 6',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/6.jpg'
                ),
                array(
                    'value'   => 7,
                    'label'   => 'Variant 7',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/7.jpg'
                ),
                array(
                    'value'   => 8,
                    'label'   => 'Variant 8',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/8.jpg'
                ),
                array(
                    'value'   => 9,
                    'label'   => 'Variant 9',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/9.jpg'
                ),
                array(
                    'value'   => 10,
                    'label'   => 'Variant 10',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/10.jpg'
                ),
                array(
                    'value'   => 11,
                    'label'   => 'Variant 11',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/11.jpg'
                ),
                array(
                    'value'   => 12,
                    'label'   => 'Variant 12',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/12.jpg'
                ),
                array(
                    'value'   => 'vertical',
                    'label'   => 'Vertical header',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/13.jpg'
                ),
                array(
                    'value'   => 'vertical2',
                    'label'   => 'Vertical header 2',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/14.jpg'
                ),
                array(
                    'value'   => 15,
                    'label'   => 'Variant 15',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/15.jpg'
                ),
                array(
                    'value'   => 16,
                    'label'   => 'Variant 16',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/16.jpg'
                ),
                array(
                    'value'   => 17,
                    'label'   => 'Variant 17',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/17.jpg'
                ),
                array(
                    'value'   => 18,
                    'label'   => 'Variant 18',
                    'src'     => ETHEME_THEME_ASSETS . '/images/headers/18.jpg'
                ),
            )
        ),
        array(
            'id'          => 'header_custom_block',
            'label'       => 'Header custom HTML (for 6, 7, 13, 14, 18 headers)',
            'default'     => '
[share]',
            'type'        => 'textarea',
            'section'     => 'header'
        ),
        array(
            'id'          => 'logo',
            'label'       => 'Logo image',
            'default'     => '',
            'desc'        => 'Upload image: png, jpg or gif file',
            'type'        => 'upload',
            'section'     => 'header'
        ),
        array(
            'id'          => 'logo_fixed',
            'label'       => 'Logo image for Fixed header',
            'default'     => '',
            'desc'        => 'Upload image: png, jpg or gif file',
            'type'        => 'upload',
            'section'     => 'header'
        ),
        array(
            'id'          => 'favicon',
            'label'       => 'Favicon',
            'default'     => '[template_url]/images/favicon.ico',
            'desc'        => 'Upload image: png, jpg or gif file',
            'type'        => 'upload',
            'section'     => 'header'
        ),
        array(
            'id'          => 'top_links',
            'label'       => 'Enable top links (Register | Sign In)',
            'default'     => array(
            	0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'cart_widget',
            'label'       => 'Enable cart widget',
            'default'     => array(
            	0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'search_form',
            'label'       => 'Enable search form in header',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'search_post_type',
            'label'       => 'Search post type',
            'default'     => 'product',
            'type'        => 'select',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 'product',
                'label' => 'Product' 
              ),
              array( 
                'value' => 'post',
                'label' => 'Post' 
              )
            )
        ),
        array(
            'id'          => 'search_view',
            'label'       => 'Search view',
            'default'     => 'modal',
            'type'        => 'select',
            'section'     => 'header',
            'choices'     => array(
              array( 
                'value' => 'modal',
                'label' => 'Popup window' 
              ),
              array( 
                'value' => 'form',
                'label' => 'Form on hover' 
              )
            )
        ),
        array(
            'id'          => 'breadcrumb_type',
            'label'       => 'Breadcrumbs Style',
            'default'     => 'default',
            'type'        => 'select',
            'section'     => 'header',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => '1',
                    'label'   => 'Default'
                ),
                array(
                    'value'   => '2',
                    'label'   => 'Default left'
                ),
                array(
                    'value'   => '3',
                    'label'   => 'With background'
                ),
                array(
                    'value'   => '4',
                    'label'   => 'With background left'
                ),
                array(
                    'value'   => '5',
                    'label'   => 'Parallax'
                ),
                array(
                    'value'   => '6',
                    'label'   => 'Parallax left'
                ),
                array(
                    'value'   => '7',
                    'label'   => 'With animation'
                ),
                array(
                    'value'   => '8',
                    'label'   => 'Background large'
                ),
                array(
                    'value'   => '9',
                    'label'   => 'Disable'
                )
            )
        ),
        // FOOTER
        array(
            'id'          => 'footer_bg',
            'label'       => 'Footer Background Color',
            'default'     => '',
            'type'        => 'colorpicker',
            'section'     => 'footer',
        ),
        array(
            'id'          => 'footer_text_color',
            'label'       => 'Footer text color',
            'type'        => 'select',
            'section'     => 'footer',
            'default'     => 'default',
            'class'       => 'prodcuts_per_row',
            'choices'     => array(
              array( 
                'value' => 'default',
                'label' => 'Default' 
              ),
              array( 
                'value' => 'light',
                'label' => 'Light' 
              ),
              array( 
                'value' => 'dark',
                'label' => 'Dark' 
              )
            )
        ),
        array(
            'id'          => 'footer_demo',
            'label'       => 'Show footer demo blocks',
            'desc'        => 'Will be shown if footer sidebars are empty',
            'default'     => array(0=>1),
            'type'        => 'checkbox',
            'section'     => 'footer',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'footer_type',
            'label'       => 'Footer Type',
            'default'     => 3,
            'type'        => 'radio-image',
            'section'     => 'footer',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => 'Default',
                    'src'     => ETHEME_THEME_ASSETS . '/images/footer_v1.jpg'
                ),
                array(
                    'value'   => 2,
                    'label'   => 'Variant 2',
                    'src'     => ETHEME_THEME_ASSETS . '/images/footer_v2.jpg'
                ),
                array(
                    'value'   => 3,
                    'label'   => 'Variant 3',
                    'src'     => ETHEME_THEME_ASSETS . '/images/footer_v3.jpg'
                )
            )
        ),
        // CONTACT FORM
        array(
            'id'          => 'contacts_email',
            'label'       => 'Your email for contact form',
            'default'     => 'test@gmail.com',
            'type'        => 'text',
            'section'     => 'contact_form'
        ),
        // SHOP
        array(
            'id'          => 'shop_full_width',
            'label'       => 'Full width',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'shop',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'just_catalog',
            'label'       => 'Just Catalog',
            'desc'        => 'Disable "Add To Cart" button and shopping cart',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'shop',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'cats_accordion',
            'label'       => 'Enable Navigation Accordion',
            'type'        => 'checkbox',
            'section'     => 'shop',
            'default'     => array(
            	0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'new_icon',
            'label'       => 'Enable "NEW" icon',
            'type'        => 'checkbox',
            'section'     => 'shop',
            'default'     => array(
            	0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'out_of_icon',
            'label'       => 'Enable "Out of stock" icon',
            'type'        => 'checkbox',
            'section'     => 'shop',
            'default'     => array(
                0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'sale_icon',
            'label'       => 'Enable "Sale" icon',
            'type'        => 'checkbox',
            'section'     => 'shop',
            'default'     => array(
                0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'product_bage_banner',
            'label'       => 'Product Page Banner',
            'default'     => '
<p>
<img src="[template_url]/images/assets/shop-banner.jpg" />
</p>
            ',
            'desc'        => 'Upload image: png, jpg or gif file',
            'type'        => 'textarea',
            'section'     => 'shop'
        ),
        array(
            'id'          => 'empty_cart_content',
            'label'       => 'Text for empty cart',
            'default'     => '
<h2>Your cart is currently empty</h2>
<p>You have not added any items in your shopping cart</p>
            ',
            'type'        => 'textarea',
            'section'     => 'shop'
        ),
        // Product Grid
        array(
            'id'          => 'view_mode',
            'label'       => 'Products view mode',
            'type'        => 'select',
            'section'     => 'product_grid',
            'default'     => 'grid_list',
            'class'       => 'prodcuts_per_row',
            'choices'     => array(
              array( 
                'value' => 'grid_list',
                'label' => 'Grid/List' 
              ),
              array( 
                'value' => 'list_grid',
                'label' => 'List/Grid' 
              ),
              array( 
                'value' => 'grid',
                'label' => 'Only Grid' 
              ),
              array( 
                'value' => 'list',
                'label' => 'Only List' 
              )
            )
        ),
        array(
            'id'          => 'prodcuts_per_row',
            'label'       => 'Products per row',
            'type'        => 'select',
            'section'     => 'product_grid',
            'default'     => 3,
            'class'       => 'prodcuts_per_row',
            'choices'     => array(
              array( 
                'value' => 2,
                'label' => '2' 
              ),
              array( 
                'value' => 3,
                'label' => '3' 
              ),
              array( 
                'value' => 4,
                'label' => '4' 
              ),
              array( 
                'value' => 5,
                'label' => '5' 
              ),
              array( 
                'value' => 6,
                'label' => '6' 
              ),
            )
        ),
        array(
            'id'          => 'products_per_page',
            'label'       => 'Products per page',
            'type'        => 'text',
            'default'     => 12,
            'section'     => 'product_grid'
        ),
        array(
            'id'          => 'sidebar_hidden',
            'label'       => 'Hidden sidebar',
            'type'        => 'checkbox',
            'section'     => 'product_grid',
            'default'     => array(
                0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'grid_sidebar',
            'label'       => 'Layout',
            'desc'        => 'Sidebar position',
            'default'     => 'left',
            'type'        => 'radio-image',
            'section'     => 'product_grid',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'without',
                    'label'   => 'Without sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/full-width.png'
                ),
                array(
                    'value'   => 'left',
                    'label'   => 'Left Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/left-sidebar.png'
                ),
                array(
                    'value'   => 'right',
                    'label'   => 'Right Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/right-sidebar.png'
                )
            )
        ),
        array(
            'id'          => 'product_img_hover',
            'label'       => 'Product Image Hover',
            'type'        => 'select',
            'section'     => 'product_grid',
            'default'     => 'slider',
            'choices'     => array(
              array( 
                'value' => 'disable',
                'label' => 'Disable' 
              ),
              array( 
                'value' => 'swap',
                'label' => 'Swap' 
              ),
              array( 
                'value' => 'slider',
                'label' => 'Images Slider' 
              ),
              array( 
                'value' => 'mask',
                'label' => 'Mask with information' 
              ),
            )
        ),
        array(
            'id'          => 'product_page_productname',
            'label'       => 'Show product name',
            'type'        => 'checkbox',
            'section'     => 'product_grid',
            'default'     => array(
                0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'product_page_cats',
            'label'       => 'Show product categories',
            'type'        => 'checkbox',
            'section'     => 'product_grid',
            'default'     => array(
                0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'product_page_price',
            'label'       => 'Show Price',
            'type'        => 'checkbox',
            'section'     => 'product_grid',
            'default'     => array(
            	0 => 1
            ),
            'choices'     => array(
              array(
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'product_page_addtocart',
            'label'       => 'Show "Add to cart" button',
            'type'        => 'checkbox',
            'section'     => 'product_grid',
            'default'     => array(
            	0 => 1
            ),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        // BLOG 
        
        array(
            'id'          => 'blog_layout',
            'label'       => 'Blog Layout',
            'type'        => 'select',
            'section'     => 'blog_page',
            'default'     => 'default',
            'choices'     => array(
              array( 
                'value' => 'default',
                'label' => 'Default' 
              ),
              array( 
                'value' => 'grid',
                'label' => 'Grid' 
              ),
              array( 
                'value' => 'timeline',
                'label' => 'Timeline' 
              ),
              array( 
                'value' => 'small',
                'label' => 'Small' 
              ),
              array( 
                'value' => 'mosaic',
                'label' => 'Mosaic' 
              ),
            )
        ),
        array(
            'id'          => 'blog_full_width',
            'label'       => 'Full width (only for mosaic layout)',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => 0,
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),

        array(
            'id'          => 'blog_columns',
            'label'       => 'Columns (for mosaic and grid layouts)',
            'type'        => 'select',
            'section'     => 'blog_page',
            'default'     => 3,
            'choices'     => array(
              array( 
                'value' => 2,
                'label' => '2' 
              ),
              array( 
                'value' => 3,
                'label' => '3' 
              ),
              array( 
                'value' => 4,
                'label' => '4' 
              ),
            )
        ),
        array(
            'id'          => 'blog_byline',
            'label'       => 'Show "byline" on the blog',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'posts_links',
            'label'       => 'Show Previous and Next posts links',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'post_share',
            'label'       => 'Show Share buttons',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'about_author',
            'label'       => 'Show About Author block',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'post_related',
            'label'       => 'Show Related posts',
            'type'        => 'checkbox',
            'section'     => 'blog_page',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array (
            'id'      => 'excerpt_length',
            'label'   => 'Excerpt length(words)',
            'default' => 25,
            'type'    => 'text',
            'section' => 'blog_page',
        ),
        array(
            'id'          => 'blog_sidebar',
            'label'       => 'Sidebar position',
            'default'     => 'left',
            'type'        => 'radio-image',
            'section'     => 'blog_page',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'without',
                    'label'   => 'Without Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/full-width.png'
                ),
                array(
                    'value'   => 'left',
                    'label'   => 'Left Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/left-sidebar.png'
                ),
                array(
                    'value'   => 'right',
                    'label'   => 'Right Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/right-sidebar.png'
                )
            )
        ),
        array(
            'id'          => 'blog_sidebar_responsive',
            'label'       => 'Sidebar position for responsive layout',
            'default'     => 'bottom',
            'type'        => 'select',
            'section'     => 'blog_page',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'top',
                    'label'   => 'Top'
                ),
                array(
                    'value'   => 'bottom',
                    'label'   => 'Bottom'
                )
            )
        ),
        // FORUM
        array(
            'id'          => 'forum_sidebar',
            'label'       => 'Sidebar position',
            'default'     => 'left',
            'type'        => 'radio-image',
            'section'     => 'forum_page',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'without',
                    'label'   => 'Without Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/full-width.png'
                ),
                array(
                    'value'   => 'left',
                    'label'   => 'Left Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/left-sidebar.png'
                ),
                array(
                    'value'   => 'right',
                    'label'   => 'Right Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/right-sidebar.png'
                )
            )
        ),
        // Single Product Page
        array(
            'id'          => 'single_sidebar',
            'label'       => 'Sidebar position',
            'default'     => 'right',
            'type'        => 'radio-image',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'without',
                    'label'   => 'Without Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/full-width.png'
                ),
                array(
                    'value'   => 'left',
                    'label'   => 'Left Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/left-sidebar.png'
                ),
                array(
                    'value'   => 'right',
                    'label'   => 'Right Sidebar',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/right-sidebar.png'
                )
            )
        ),
        array(
            'id'          => 'single_product_layout',
            'label'       => 'Single product layout',
            'default'     => 'default',
            'type'        => 'radio-image',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'small',
                    'label'   => 'Small',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-small.png'
                ),
                array(
                    'value'   => 'default',
                    'label'   => 'Default',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-medium.png'
                ),
                array(
                    'value'   => 'large',
                    'label'   => 'Large',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-large.png'
                ),
                array(
                    'value'   => 'fixed',
                    'label'   => 'Fixed content',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-fixed.png'
                )
            )
        ),
        array(
            'id'          => 'tabs_location',
            'label'       => 'Location of product tabs',
            'default'     => 'after_content',
            'type'        => 'select',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'after_image',
                    'label'   => 'Next to image'
                ),
                array(
                    'value'   => 'after_content',
                    'label'   => 'Under content'
                )
            )
        ),
        array(
            'id'          => 'upsell_location',
            'label'       => 'Location of upsell products',
            'default'     => 'sidebar',
            'type'        => 'select',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'sidebar',
                    'label'   => 'Sidebar'
                ),
                array(
                    'value'   => 'after_content',
                    'label'   => 'After content'
                )
            )
        ),
        array(
            'id'          => 'show_product_title',
            'label'       => 'Show Product Title',
            'default'     => 1,
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                )
            )
        ),
        array(
            'id'          => 'show_related',
            'label'       => 'Display related products',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                )
            )
        ),
        array(
            'id'          => 'ajax_addtocart',
            'label'       => 'Ajax "Add To Cart"',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                )
            )
        ),
        array(
            'id'          => 'gallery_lightbox',
            'label'       => 'Enable Lightbox for Product Images',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                )
            )
        ),
        array(
            'id'          => 'images_slider',
            'label'       => 'Enable slider for gallery images',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                ),
            )
        ),
        array(
            'id'          => 'zoom_effect',
            'label'       => 'Zoom effect',
            'default'     => 'window',
            'type'        => 'select',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'disable',
                    'label'   => 'Disable'
                ),
                array(
                    'value'   => 'lens',
                    'label'   => 'Lens'
                ),
                array(
                    'value'   => 'window',
                    'label'   => 'Window'
                )
            )
        ),
        array(
            'id'          => 'tabs_type',
            'label'       => 'Tabs type',
            'default'     => 'tabs_default',
            'type'        => 'select',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'tabs-default',
                    'label'   => 'Default'
                ),
                array(
                    'value'   => 'left-bar',
                    'label'   => 'Left Bar'
                ),
                array(
                    'value'   => 'right-bar',
                    'label'   => 'Right Bar'
                ),
                array(
                    'value'   => 'accordion',
                    'label'   => 'Accordion'
                )
            )
        ),
        array(
            'id'          => 'reviews_position',
            'label'       => 'Reviews position',
            'default'     => 'tabs',
            'type'        => 'select',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'tabs',
                    'label'   => 'Tabs'
                ),
                array(
                    'value'   => 'outside',
                    'label'   => 'Next to tabs'
                ),
            )
        ),
        array(
            'id'          => 'share_icons',
            'label'       => 'Show share buttons',
            'default'     => array(
                0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'single_product',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 1,
                    'label'   => ''
                )
            )
        ),
        array(
            'id'          => 'custom_tab_title',
            'label'       => 'Custom Tab Title',
            'default'     => 'Returns & Delivery',
            'type'        => 'text',
            'section'     => 'single_product'
        ),
        array(
            'id'          => 'custom_tab',
            'label'       => 'Return',
            'desc'        => 'Enter custom content you would like to output to the product custom tab (for all products)',
            'default'     => '
[row][column size="one-half"]<h5>Returns and Exchanges</h5><p>There are a few important things to keep in mind when returning a product you purchased.You can return unwanted items by post within 7 working days of receipt of your goods.</p>[checklist style="arrow"]
<ul>
<li>You have 14 calendar days to return an item from the date you received it. </li>
<li>Only items that have been purchased directly from Us.</li>
<li>Please ensure that the item you are returning is repackaged with all elements.</li>
</ul>
[/checklist] [/column][column size="one-half"]
<h5>Ship your item back to Us</h5>Firstly Print and return this Returns Form to:<br /> <p>30 South Park Avenue, San Francisco, CA 94108, USA<br /> Please remember to ensure that the item you are returning is repackaged with all elements.</p><br /> <span class="underline">For more information, view our full Returns and Exchanges information.</span>[/column][/row]
            ',
            'type'        => 'textarea',
            'section'     => 'single_product'
        ),
        array(
            'id'          => 'demo_data',
            'label'       => 'Install demo content just in few clicks',
            'default'     => '',
            'desc'        => '',
            'type'        => 'demo_data',
            'section'     => 'backup',
            'choices'     => array(
                array(
                    'value'   => 'e-commerce',
                    'label'   => 'E-commerce'
                ),
                array(
                    'value'   => 'corporate',
                    'label'   => 'Corporate'
                )
            )
        ),
        array(
            'id'          => 'import_export',
            'label'       => 'Import or Export your theme configuration',
            'default'     => '',
            'desc'        => '',
            'type'        => 'backup',
            'section'     => 'backup'
        ),
        // QUICK VIEW
        array(
            'id'          => 'quick_view',
            'label'       => 'ENABLE QUICK VIEW',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_images',
            'label'       => 'Product images',
            'default'     => 'slider',
            'type'        => 'select',
            'section'     => 'quick_view',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => 'none',
                    'label'   => 'None'
                ),
                array(
                    'value'   => 'slider',
                    'label'   => 'Slider with zoom'
                ),
                array(
                    'value'   => 'single',
                    'label'   => 'Single'
                )
            )
        ),
        array(
            'id'          => 'quick_product_name',
            'label'       => 'Product name',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_price',
            'label'       => 'Price',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_rating',
            'label'       => 'Product star rating',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_descr',
            'label'       => 'Short description',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_add_to_cart',
            'label'       => 'Add to cart',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'quick_share',
            'label'       => 'Share icons',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'product_link',
            'label'       => 'Show link to full product details',
            'type'        => 'checkbox',
            'section'     => 'quick_view',
            'default'     => array(0=>0),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        // Promo popup
        array(
            'id'          => 'promo_popup',
            'label'       => 'Enable promo popup',
            'type'        => 'checkbox',
            'section'     => 'promo_popup',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'promo_auto_open',
            'label'       => 'Open popup on enter',
            'type'        => 'checkbox',
            'section'     => 'promo_popup',
            'default'     => 0,
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'promo_link',
            'label'       => 'Show link in the top bar',
            'type'        => 'checkbox',
            'section'     => 'promo_popup',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'pp_content',
            'label'       => 'Popup content',
            'type'        => 'textarea',
            'section'     => 'promo_popup',
            'default'     => 'You can add any HTML here (admin -> Theme Options -> Promo Popup).<br> We suggest you create a static block and put it here using shortcode'
        ),
        array(
            'id'          => 'pp_width',
            'label'       => 'Popup width',
            'default'     => 700,
            'type'        => 'text',
            'section'     => 'promo_popup'
        ),
        array(
            'id'          => 'pp_height',
            'label'       => 'Popup height',
            'default'     => 350,
            'type'        => 'text',
            'section'     => 'promo_popup'
        ),
        array(
            'id'          => 'pp_bg',
            'label'       => 'Popup background',
            'default'     => '',
            'type'        => 'background',
            'section'     => 'promo_popup'
        ),
        // Portfolio
        array(
            'id'          => 'portfolio_count',
            'label'       => 'Items per page',
            'default'     => -1,
            'desc'        => 'Use -1 to show all items',
            'type'        => 'text',
            'section'     => 'portfolio'
        ),
        array(
            'id'          => 'portfolio_columns',
            'label'       => 'Columns',
            'type'        => 'select',
            'section'     => 'portfolio',
            'default'     => 3,
            'choices'     => array(
              array( 
                'value' => 2,
                'label' => 2
              ),
              array( 
                'value' => 3,
                'label' => 3 
              ),
              array( 
                'value' => 4,
                'label' => 4 
              ),
            )
        ),
        array(
            'id'          => 'project_name',
            'label'       => 'Show Project names',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'project_byline',
            'label'       => 'Show ByLine',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'project_excerpt',
            'label'       => 'Show Excerpt',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'recent_projects',
            'label'       => 'Show recent projects',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'portfolio_comments',
            'label'       => 'Enable Comments For Projects',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'portfolio_lightbox',
            'label'       => 'Enable Lightbox For Projects',
            'type'        => 'checkbox',
            'section'     => 'portfolio',
            'default'     => array(0=>1),
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        array(
            'id'          => 'portfolio_image_width',
            'label'       => 'Project Images Width',
            'default'     => 720,
            'type'        => 'text',
            'section'     => 'portfolio'
        ),
        array(
            'id'          => 'portfolio_image_height',
            'label'       => 'Project Images Height',
            'default'     => 550,
            'type'        => 'text',
            'section'     => 'portfolio'
        ),
        array(
            'id'          => 'portfolio_image_cropping',
            'label'       => 'Image Cropping',
            'type'        => 'checkbox',
            'default'     => array(
                0 => 1
            ),
            'section'     => 'portfolio',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              ),
            )
        ),
        // Responsive
        array(
            'id'          => 'responsive',
            'label'       => 'Enable Responsive Design',
            'default'     => array(
            	0 => 1
            ),
            'type'        => 'checkbox',
            'section'     => 'responsive',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        // Custom CSS
        array(
            'id'          => 'global_custom_css',
            'label'       => 'Global Custom CSS',
            'section'     => 'custom_css',
            'default'     => '',
            'type'        => 'textarea_simple'
        ),
        array(
            'id'          => 'custom_css_desktop',
            'label'       => 'Custom CSS for desktop',
            'section'     => 'custom_css',
            'desc'        => '992px +',
            'default'     => '',
            'type'        => 'textarea_simple'
        ),
        array(
            'id'          => 'custom_css_tablet',
            'label'       => 'Custom CSS for tablet',
            'section'     => 'custom_css',
            'desc'        => '768px - 991px',
            'default'     => '',
            'type'        => 'textarea_simple'
        ),
        array(
            'id'          => 'custom_css_wide_mobile',
            'label'       => 'Custom CSS for mobile landscape',
            'section'     => 'custom_css',
            'desc'        => '481px - 767px',
            'default'     => '',
            'type'        => 'textarea_simple'
        ),
        array(
            'id'          => 'custom_css_mobile',
            'label'       => 'Custom CSS for mobile',
            'section'     => 'custom_css',
            'desc'        => '0 - 480px',
            'default'     => '',
            'type'        => 'textarea_simple'
        ),
        array(
            'id'          => 'custom_css',
            'label'       => 'Enable Custom CSS file',
            'desc'        => 'Enable this option to load "custom.css" file in which you can override the default styling of the theme. To create "custom.css" you can use the file "default.custom.css" which is located in theme directory.',
            'default'     => 0,
            'type'        => 'checkbox',
            'section'     => 'custom_css',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
   ));
   
   if($return) {
	   return $settings;
   }

  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => ''
        )
      ),
      'sidebar'       => '',
    ),
    'sections'        => $sections,
    'settings'        => $settings
  );
  
  if(is_array($settings)){
	  foreach($settings as $key => $value){	
		  $defaults[$value['id']] = $value['default'];
	  }
  }
  
  add_option( 'option_tree', $defaults ); // update_option  add_option
	
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
} 

/**
 * Initialize the meta boxes for pages. 
 */
add_action( 'admin_init', 'page_meta_boxes' );


function page_meta_boxes() {
global $wpdb;
    $statick_blocks = array();
    $statick_blocks[] = array("label"=>"Default","value"=>"");
    $statick_blocks[] = array("label"=>"Without","value"=>"without");
    $statick_blocks = array_merge($statick_blocks, et_get_static_blocks());
    
    $page_options = array(
        array(
            'id'          => 'sidebar_state',
            'label'       => 'Sidebar Position',
            'type'        => 'select',
            'choices'     => array(
                  array( 
                    'value' => '',
                    'label' => 'Default' 
                  ),
                  array( 
                    'value' => 'without',
                    'label' => 'Without Sidebar' 
                  ),
                  array( 
                    'value' => 'left',
                    'label' => 'Left Sidebar' 
                  ),
                  array( 
                    'value' => 'right',
                    'label' => 'Right Sidebar' 
                  )
                )
        ),
        array(
            'id'          => 'widget_area',
            'label'       => 'Widget Area',
            'type'        => 'sidebar_select'
        ),
        array(
            'id'          => 'sidebar_width',
            'label'       => 'Sidebar width',
            'type'        => 'select',
            'choices'     => array(
                  array( 
                    'value' => '',
                    'label' => 'Default' 
                  ),
                  array( 
                    'value' => 2,
                    'label' => '1/6' 
                  ),
                  array( 
                    'value' => 3,
                    'label' => '1/4' 
                  ),
                  array( 
                    'value' => 4,
                    'label' => '1/3' 
                  )
                )
        ),
        array(
            'id'          => 'custom_nav',
            'label'       => 'Custom navigation for this page',
            'type'        => 'select',
            'choices'     => et_get_menus_options()
        ),
        array(
            'id'          => 'custom_nav_right',
            'label'       => 'Custom navigation right',
            'type'        => 'select',
            'choices'     => et_get_menus_options()
        ),
        array(
            'id'          => 'custom_nav_mobile',
            'label'       => 'Custom mobile navigation for this page',
            'type'        => 'select',
            'choices'     => et_get_menus_options()
        ),
        array(
            'id'          => 'one_page',
            'label'       => 'One page navigation',
            'default'     => 0,
            'type'        => 'checkbox',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'full_page',
            'label'       => 'Full page sections',
            'default'     => 0,
            'type'        => 'checkbox',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        array(
            'id'          => 'page_background',
            'label'       => 'Page background',
            'type'        => 'background',
            'desc'        => '',
            'default'     => '',
        ),
        array(
            'id'          => 'page_heading',
            'label'       => 'Show Page Heading',
            'type'        => 'select',
            'choices'     => array(
                  array( 
                    'value' => 'enable',
                    'label' => 'Enable' 
                  ),
                  array( 
                    'value' => 'disable',
                    'label' => 'Disable' 
                  )
                )
        ),
        array(
            'id'          => 'breadcrumb_type',
            'label'       => 'Breadcrumbs Style',
            'default'     => 'default',
            'type'        => 'select',
            'section'     => 'header',
            'class'       => '',
            'choices'     => array(
                array(
                    'value'   => '',
                    'label'   => 'Default'
                ),
                array(
                    'value'   => '2',
                    'label'   => 'Default left'
                ),
                array(
                    'value'   => '3',
                    'label'   => 'With background'
                ),
                array(
                    'value'   => '4',
                    'label'   => 'With background left'
                ),
                array(
                    'value'   => '5',
                    'label'   => 'Parallax'
                ),
                array(
                    'value'   => '6',
                    'label'   => 'Parallax left'
                ),
                array(
                    'value'   => '7',
                    'label'   => 'With animation'
                ),
                array(
                    'value'   => '8',
                    'label'   => 'Background large'
                ),
                array(
                    'value'   => '9',
                    'label'   => 'Disable'
                )
            )
        ),
        array(
            'id'          => 'custom_breadcrumbs_image',
            'label'       => 'Background image for breadcrumbs',
            'type'        => 'upload'
        ),
        array(
            'id'          => 'custom_footer',
            'label'       => 'Use custom footer for this page',
            'type'        => 'select',
            'choices'     => $statick_blocks
        ),
        array(
            'id'          => 'custom_logo',
            'label'       => 'Logo image for this page',
            'type'        => 'upload'
        ),
        
    );

    if(class_exists('RevSliderAdmin')) {
        
        $rs = $wpdb->get_results( 
            "
            SELECT id, title, alias
            FROM ".$wpdb->prefix."revslider_sliders
            ORDER BY id ASC LIMIT 100
            "
        );
        $revsliders = array(array(
            'value' => 'no_slider',
            'label' => 'No Slider'
        ));
        if ($rs) {
        $_ri = 1;
        foreach ( $rs as $slider ) {
            $revsliders[$_ri]['value'] = $slider->alias;
            $revsliders[$_ri]['label'] = $slider->title;
            $_ri++;
        }
        } else {
            $revsliders["No sliders found"] = 0;
        }
        

        if(count($revsliders)>0 ){
            array_push($page_options, array(
                'id'          => 'page_slider',
                'label'       => 'Show revolution slider instead of breadcrumbs and page title',
                'type'        => 'select',
                'choices'     => $revsliders
            ));
        }
    }

  $my_meta_box = array(
    'id'        => 'page_layout',
    'title'     => 'Page Layout',
    'desc'      => '',
    'pages'     => array( 'page', 'post' ),
    'context'   => 'side',//side normal
    'priority'  => 'low',
    'fields'    => $page_options
  );
  
  ot_register_meta_box( $my_meta_box ); 

}
/**
 * Initialize the meta boxes for pages. 
 */
add_action( 'admin_init', 'posts_meta_boxes' );


function posts_meta_boxes() {
global $wpdb;
    $page_options = array(
        array(
            'id'          => 'disable_featured',
            'label'       => 'Hide featured image',
            'default'     => 0,
            'type'        => 'checkbox',
            'choices'     => array(
              array( 
                'value' => 1,
                'label' => '' 
              )
            )
        ),
        
    );
  $my_meta_box = array(
    'id'        => 'post_layout',
    'title'     => 'Post Layout',
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',//side normal
    'priority'  => 'low',
    'fields'    => $page_options
  );
  
  ot_register_meta_box( $my_meta_box ); 

}


/**
 * Initialize the meta boxes for products. 
 */
add_action( 'admin_init', 'products_meta_boxes' );


function products_meta_boxes() {
	$statick_blocks = array();
	$statick_blocks[] = array("label"=>"--choose--","value"=>"");
	$statick_blocks = array_merge($statick_blocks, et_get_static_blocks());
	
    $page_options = array(
        array(
            'id'          => 'additional_block',
            'label'       => 'Additional information block',
            'type'        => 'select',
            'choices'     => $statick_blocks
        ),
        array(
            'id'          => 'product_new',
            'label'       => 'Mark product as "New"',
            'type'        => 'select',
            'choices'     => array(
              array( 
                'value' => 'disable',
                'label' => 'Choose' 
              ),
              array( 
                'value' => 'disable',
                'label' => 'No' 
              ),
              array( 
                'value' => 'enable',
                'label' => 'Yes' 
              )
            )
        ),
        array(
            'name'    => 'Select the layout',
            'id'      => 'et_single_layout',
            'label'       => 'Single product layout',
            'type'    => 'radio-image',
            'choices' => array(
                array(
                    'value'   => 'small',
                    'label'   => 'Small',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-small.png'
                ),
                array(
                    'value'   => 'default',
                    'label'   => 'Default',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-medium.png'
                ),
                array(
                    'value'   => 'large',
                    'label'   => 'Large',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-large.png'
                ),
                array(
                    'value'   => 'fixed',
                    'label'   => 'Fixed content',
                    'src'     => ETHEME_THEME_ASSETS . '/images/layout/product-fixed.png'
                )
            ),
        ),

        array(
            'id'          => 'size_guide_img',
            'label'       => 'Size Guide img',
            'desc'        => 'Upload image: png, jpg or gif file',
            'type'        => 'upload'
        ),
        array(
            'id'          => 'hover_img',
            'label'       => 'Upload image for hover effect',
            'type'        => 'upload'
        ),
        array(
            'id'          => 'custom_tab1_title',
            'label'       => 'Title for custom tab',
            'type'        => 'text'
        ),
        array(
            'id'          => 'custom_tab1',
            'label'       => 'Text for custom tab',
            'type'        => 'textarea'
        ),
    );

  $my_meta_box = array(
    'id'        => 'product_options',
    'title'     => 'Additional product options [8theme]',
    'desc'      => '',
    'pages'     => array( 'product' ),
    'context'   => 'normal',//side normal
    'priority'  => 'low',
    'fields'    => $page_options
  );
  
  ot_register_meta_box( $my_meta_box ); 

}

/**
 * Initialize the meta boxes for portfolio. 
 */
//add_action( 'admin_init', 'portfolio_meta_boxes' );


function portfolio_meta_boxes() {
    $page_options = array(
        array(
            'id'          => 'project_url',
            'label'       => 'Project Url',
            'type'        => 'text'
        ),
        array(
            'id'          => 'client',
            'label'       => 'Client',
            'type'        => 'text'
        ),
        array(
            'id'          => 'client_url',
            'label'       => 'Client Url',
            'type'        => 'text'
        ),
        array(
            'id'          => 'copyright',
            'label'       => 'Copyright',
            'type'        => 'text'
        ),
        array(
            'id'          => 'copyright_url',
            'label'       => 'Copyright Url',
            'type'        => 'text'
        ),
    );

  $my_meta_box = array(
    'id'        => 'product_options',
    'title'     => 'Additional project information',
    'desc'      => '',
    'pages'     => array( 'etheme_portfolio' ),
    'context'   => 'normal',//side normal
    'priority'  => 'low',
    'fields'    => $page_options
  );
  
  ot_register_meta_box( $my_meta_box ); 

}

function etheme_theme_settings_defaults() {
        $defaults = array();
        return apply_filters('etheme_theme_settings_defaults', $defaults);
}



if ( ! function_exists( 'ot_type_checkbox' ) ) {
  function ot_type_checkbox( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-checkbox ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . htmlspecialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';    
      
        /* build checkbox */
        foreach ( (array) $field_choices as $key => $choice ) {
          if ( isset( $choice['value'] ) && isset( $choice['label'] ) ) {
            echo '<label>';
              echo '<input type="checkbox" name="' . esc_attr( $field_name ) . '[' . esc_attr( $key ) . ']" id="' . esc_attr( $field_id ) . '-' . esc_attr( $key ) . '" value="' . esc_attr( $choice['value'] ) . '" ' . ( isset( $field_value[$key] ) ? checked( $field_value[$key], $choice['value'], false ) : '' ) . ' class="ios-switch option-tree-ui-checkbox ' . esc_attr( $field_class ) . '" />';
              echo '<div class="switch"></div>';
              echo  esc_attr( $choice['label'] ) ;
            echo '</label>';
          }
        }
      
      echo '</div>';

    echo '</div>';
    
  }
  
}


/**
 * Import/Export Options
 */

if ( ! function_exists( 'ot_type_backup' ) ) {
  
  function ot_type_backup( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-backup ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
        
        $get_settings = get_option( 'option_tree' );
        $options_json = json_encode($get_settings);
        $options = base64_encode($options_json);
        
        ?>
        
            <p class="importBtn"><a href="javascript:void(0)">Import Options</a></p>
            
            <div class="import-block">
            
                <p>Insert code you previously exported</p>
                
                <textarea rows="16" cols="80" name="option_tree[new_options]"></textarea>
                
                <button type="submit" class="option-tree-ui-button blue light">Import</button>
            
            </div>
            
            <div class="clear"></div>
            
            <p class="importBtn"><a href="javascript:void(0)">Export Options</a></p>
            
            <div style="display:none;">
                <p>Place this export code into the import text field in your new site and press "Import".</p>
                <textarea rows="20" cols="60"><?php echo $options ?></textarea>
            </div>
        
        <?php    
    
    echo '</div>';
    
  }
  
}


if( ! function_exists( 'et_after_theme_options_save' ) ) {
    add_action( 'ot_after_theme_options_save', 'et_after_theme_options_save', 10, 1 );

    function et_after_theme_options_save($options) {
      if(isset($options['new_options']) && $options['new_options'] != '') {
          $new_options = json_decode(base64_decode($options['new_options']),true);
          update_option( 'option_tree', $new_options );
      }
    }
}

if ( ! function_exists( 'ot_type_demo_data' ) ) {
  
  function ot_type_demo_data( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-backup ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
        
        $get_settings = get_option( 'option_tree' );
        $options_json = json_encode($get_settings);
        $options = base64_encode($options_json);
        
        $vers_cats = array(
            'simple' => 'Simple page',
            'one_page' => 'One page',
            'landing' => 'Landing page'
        );  
        
        
        $versions = et_get_versions_option();
        
        $demo_data_installed = get_option('demo_data_installed');
        
        $button_label = __('Install base demo content', ETHEME_DOMAIN);
        
        if($demo_data_installed != 'yes') { 
            ?>
                <a href="javascript:void(0)" class="option-tree-ui-button blue" id="install_demo_pages" ><?php echo $button_label; ?></a>
            <?php   
        } 
        else {
            ?>
                <div class="clear"></div>
                <br />
                <p><?php _e('<strong>Note:</strong> You have already installed base demo content.', ETHEME_DOMAIN) ?></p>
            <?php
        }
        ?> 
            <div class="clear"></div>
            <br />
    
            <div class="format-setting-label"><h3 class="label">Set up one of our theme versions</h3></div>
            
            <div class="ver-install-result"></div>
            
            <ul class="versions-filters">
                <li>
                    <a href="#" data-filter="*" class="btn active">All</a>
                </li>
                <?php foreach($vers_cats as $slug => $name): ?>
                    <li>
                        <a href="#" data-filter=".sort-<?php echo $slug ?>" class="btn"><?php echo $name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <div class="et-theme-versions">
                <?php foreach($versions as $key => $value): ?>
                    <div class="theme-ver sort-<?php echo $value['cat']; ?>">
                        <img src="<?php echo ETHEME_CODE_IMAGES_URL.'/vers/v_'.$key.'.jpg'; ?>"> 
                        <button class="option-tree-ui-button blue install-ver" data-ver="<?php echo $key; ?>" data-home_id="<?php echo $value['home_id']; ?>">Install version</button>
                        <h4><?php echo $vers_cats[$value['cat']]; ?></h4>
                        <h2><?php echo $value['title']; ?></h2>
                    </div>
                <?php endforeach; ?>
            </div>
        
        <?php
    
    echo '</div>';
    
  }
  
}


if(!function_exists('et_theme_options_icon_url')) {
    add_filter( 'ot_theme_options_icon_url', 'et_theme_options_icon_url' );
    function et_theme_options_icon_url() {
        return ETHEME_CODE_CSS_URL.'/images/etheme.png';
    }
}

if(!function_exists('et_theme_options_position')) {
    add_filter( 'ot_theme_options_position', 'et_theme_options_position' );
    function et_theme_options_position() {
        return '58.925';
    }
}


if(!function_exists('et_theme_options_parent_slug')) {
    add_filter( 'ot_theme_options_parent_slug', 'et_theme_options_parent_slug' );
    function et_theme_options_parent_slug() {
        return false;
    }
}



?>
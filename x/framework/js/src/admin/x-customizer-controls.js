
// =============================================================================
// JS/ADMIN/X-CUSTOMIZER-CONTROLS.JS
// -----------------------------------------------------------------------------
// Show/hide Customizer controls as needed.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Preloader
//   02. Dynamic Font Weights
//   03. Informational Elements
//   04. Individual Sections
//       a. Stacks
//       b. Integrity
//       c. Renew
//       d. Icon
//       e. Ethos
//       f. Typography
//       g. Buttons
//       h. Header
//       i. Footer
//       j. Blog
//       k. WooCommerce
// =============================================================================

( function($) {

  $(window).load(function() {

    // Preloader
    // =========================================================================

    //
    // Hide and remove the preloader after a specified delay.
    //

    $('#x-customizer-preloader').delay(850).fadeOut(800, function() { $(this).remove(); });



    // Dynamic Font Weights
    // =========================================================================

    //
    // Check if a value exists in an object.
    //

    function isPartOfObject( needle, haystack ) {

      for ( var i in haystack ) {
        if ( haystack[i] === needle ) {
          return true;
        }
      }

      return false;

    }


    //
    // Show/hide the font weights associated with each font family.
    //
    // 1. If the previous weight is hidden on font family change, select
    //    regular (i.e. '400') as the weight since this is available
    //    on all fonts and works as a consistent fallback.
    //

    function showFontWeights( select ) {

      var _id       = select.data('customize-setting-link').replace(/family/, 'weight');
      var _font     = $('option:selected', select).val().toLowerCase().replace(/[^a-z0-9_\-]/g, '');
      var _variants = x_customizer_controls_data.x_fonts_data[_font].weights;

      $('input[name="_customize-radio-' + _id + '"]').each(function() {
        $this = $(this);
        if ( ! isPartOfObject($this.val(), _variants) ) {
          $this.parent().attr('data-x-hide', 'true');
          if ( $this.is(':checked') ) { // 1
            wp.customize.instance(_id).set(_variants[0]);
          }
        } else {
          $this.parent().removeAttr('data-x-hide');
        }
      });

    }


    //
    // Call the function when needed.
    //

    var $fontFamilySelect = $('select[data-customize-setting-link*=_font_family]');

    $fontFamilySelect.each(function() {
      showFontWeights($(this));
    }).change(function() {
      showFontWeights($(this));
    });

  });



  $(document).ready(function() {

    // Informational Elements
    // =========================================================================

    function xCustomizerText( targetElement, subTitle, description ) {

      if ( subTitle !== false ) {

        subTitle = '<li class="customize-control x-customize-control-subtitle">' +
                     '<h4 class="x-customize-subtitle">' +
                       subTitle +
                     '</h4>' +
                   '</li>';

        $( '#customize-control-' + targetElement ).before( subTitle );

      }

      if ( description !== false ) {

        description = '<li class="customize-control x-customize-control-description">' +
                        '<p class="x-customize-description">' +
                          '<span>INFO:</span> ' + description +
                        '</p>' +
                      '</li>';

        $( '#customize-control-' + targetElement ).before( description );

      }

    }

    xCustomizerText( 'x_stack',                                         false,                                  'Select the Stack you would like to use and wait a brief moment to view it in the preview area to the right. Each Stack functions like a unique WordPress theme, and thus comes with its own set of options, features, layouts, and more.' );
    xCustomizerText( 'x_layout_site',                                   false,                                  'Select your site\'s global layout options here. "Site Width" is the percentage of the screen your site should take up while you can think of "Site Max Width" as an upper limit that your site will never be wider than. "Content Layout" has to do with your site\'s global setup of having a sidebar or not.' );
    xCustomizerText( 'x_design_bg_color',                               'Background Options',                   'The "Background Pattern" setting will override the "Background Color" unless the image used is transparent, and the "Background Image" option will take precedence over both. The "Background Image Fade (ms)" option allows you to set a time in milliseconds for your image to fade in. To disable this feature, set the value to "0."' );
    xCustomizerText( 'x_integrity_design',                              false,                                  'Integrity is a beautiful design geared towards businesses and individuals desiring a site with a more traditional layout, yet with plenty of modern touches.' );
    xCustomizerText( 'x_integrity_blog_header_enable',                  'Blog Options',                         'Enabling the blog header will turn on the area above your posts on the index page that contains your title and subtitle. Disabling it will result in more content being visible above the fold.' );
    xCustomizerText( 'x_integrity_portfolio_archive_sort_button_text',  'Portfolio Options',                    'Enabling portfolio index sharing will turn on social sharing links for each post on the portfolio index page. Activate and deactivate individual sharing links underneath the main Portfolio section.' );
    xCustomizerText( 'x_integrity_shop_header_enable',                  'Shop Options',                         'Enabling the shop header will turn on the area above your posts on the index page that contains your title and subtitle. Disabling it will result in more content being visible above the fold.' );
    xCustomizerText( 'x_renew_topbar_background',                       false,                                  'Renew features a gorgeous look and feel that lends a clean, modern look to your site. All of your content will take center stage with Renew in place.' );
    xCustomizerText( 'x_renew_topbar_text_color',                       'Typography Options',                   'Here you can set the colors for your topbar and footer. Get creative, the possibilities are endless.' );
    xCustomizerText( 'x_renew_blog_title',                              'Blog Options',                         'The entry icon color is for the post icons to the left of each title. Selecting "Creative" under the "Entry Icon Position" setting will allow you to align your entry icons in a different manner on your posts index page when "Content Left, Sidebar Right" or "Fullwidth" are selected as your "Content Layout" and when your blog "Style" is set to "Standard." This feature is intended to be paired with a "Boxed" layout.' );
    xCustomizerText( 'x_renew_shop_title',                              'Shop Options',                         'Provide a title you would like to use for your shop. This will show up on the index page as well as in your breadcrumbs.' );
    xCustomizerText( 'x_icon_post_title_icon_enable',                   false,                                  'Icon features a stunning, modern, fullscreen design with a unique fixed sidebar layout that scolls with users on larger screens as you move down the page. The end result is attractive, app-like, and intuitive.' );
    xCustomizerText( 'x_icon_shop_title',                               'Shop Options',                         'Provide a title you would like to use for your shop. This will show up on the index page as well as in your breadcrumbs.' );
    xCustomizerText( 'x_ethos_topbar_background',                       false,                                  'Ethos is a magazine-centric design that works great for blogs, news sites, or anything else that is content heavy with a focus on information. Customize the appearance of various items below and take note that some of these accent colors will be used for additional elements. For example, the "Navbar Background Color" option will also update the appearance of the widget titles in your sidebar.' );
    xCustomizerText( 'x_ethos_post_carousel_enable',                    'Post Carousel',                        'The "Post Carousel" is an element located above the masthead, which allows you to showcase your posts in various formats. If "Featured" is selected, you can choose which posts you would like to appear in this location in the post meta options.' );
    xCustomizerText( 'x_ethos_post_carousel_display_count_extra_large', 'Post Carousel &ndash; Screen Display', 'Select how many posts you would like to show for various screen sizes. Make sure to customize this section to suit your needs depending on how you have other options setup for your site (i.e. boxed site layout, fixed left or right navigation, et cetera).' );
    xCustomizerText( 'x_ethos_post_slider_blog_enable',                 'Post Slider &ndash; Blog',             'The blog "Post Slider" is located at the top of the posts index page, which allows you to showcase your posts in various formats. If "Featured" is selected, you can choose which posts you would like to appear in this location in the post meta options.' );
    xCustomizerText( 'x_ethos_post_slider_archive_enable',              'Post Slider &ndash; Archives',         'The archive "Post Slider" is located at the top of all archive pages, which allows you to showcase your posts in various formats. If "Featured" is selected, you can choose which posts you would like to appear in this location in the post meta options.' );
    xCustomizerText( 'x_ethos_filterable_index_enable',                 'Blog Options',                         'Enabling the filterable index will bypass the standard output of your blog page, allowing you to specify categories to highlight. Upon selecting this option, a text input will appear to enter in the IDs of the categories you would like to showcase. This input accepts a list of numeric IDs separated by a comma (e.g. 14, 1, 817).' );
    xCustomizerText( 'x_ethos_shop_title',                              'Shop Options',                         'Provide a title you would like to use for your shop. This will show up on the index page as well as in your breadcrumbs.' );
    xCustomizerText( 'x_google_fonts_subsets',                          false,                                  'Here you will find global typography options for your body copy and headings, while more specific typography options for elements like your navbar are found grouped with that element to make customization more streamlined. If you are using Google Fonts, you can also enable custom subsets here for expanded character sets.' );
    xCustomizerText( 'x_body_font_family',                              'Body and Content',                     '"Body Font Size (px)" will affect the sizing of all copy outside of a post or page content area. "Content Font Size (px)" will affect the sizing of all copy inside a post or page content area. Headings are set with percentages and sized proportionally to these settings.' );
    xCustomizerText( 'x_headings_font_family',                          'Headings',                             'The letter spacing controls for each heading level will only affect that heading if it does not have a "looks like" class or if the "looks like" class matches that level. For example, if you have an &lt;h1&gt; with no modifier class, the &lt;h1&gt; slider will affect that heading. However, if your &lt;h1&gt; has an .h2 modifier class, then the &lt;h2&gt; slider will take over as it is supposed to appear as an &lt;h2&gt;.' );
    xCustomizerText( 'x_site_link_color',                               'Site Links',                           'Site link colors are also used as accents for various elements throughout your site, so make sure to select something you really enjoy and keep an eye out for how it affects your design.' );
    xCustomizerText( 'x_button_style',                                  false,                                  'Retina ready, limitless colors, and multiple shapes. The buttons available in X are fun to use, simple to implement, and look great on all devices no matter the size.' );
    xCustomizerText( 'x_button_color',                                  'Colors',                               false );
    xCustomizerText( 'x_button_color_hover',                            'Hover Colors',                         false );
    xCustomizerText( 'x_navbar_positioning',                            false,                                  'Never before has such flexibility been offered to WordPress users for their site\'s header. It\'s one of the first things your visitors see when they come to your site, now you can make it look exactly how you want.' );
    xCustomizerText( 'x_logo_navigation_layout',                        'Logo and Navigation',                  'Selecting "Inline" for your logo and navigation layout will place them both in the navbar. Selecting "Stacked" will place the logo in a separate section above the navbar.' );
    xCustomizerText( 'x_navbar_height',                                 'Navbar',                               '"Navbar Top Height (px)" must still be set even when using "Fixed Left" or "Fixed Right" positioning because on tablet and mobile devices, the menu is pushed to the top.' );
    xCustomizerText( 'x_logo_font_family',                              'Logo &ndash; Text',                    'Your logo will show up as text by default. Alternately, if you would like to use an image, upload it under the "Logo &ndash; Image" section below, which will automatically switch over. Logo alignment can also be adjusted under the "Logo &ndash; Alignment" section.' );
    xCustomizerText( 'x_logo',                                          'Logo &ndash; Image',                   'To make your logo retina ready, enter in the width of your uploaded image in the "Logo Width (px)" field and we\'ll take care of all the calculations for you. If you want your logo to stay the original size that was uploaded, leave the field blank.' );
    xCustomizerText( 'x_logo_adjust_navbar_top',                        'Logo &ndash; Alignment',               'Use the following controls to vertically align your logo as desired. Make sure to adjust your top alignment even if your navbar is fixed to a side as it will reformat to the top on smaller screens (this control will be hidden if you do not have a side navigation position selected).' );
    xCustomizerText( 'x_navbar_font_family',                            'Links &ndash; Text',                   'Alter the appearance of the top-level navbar links for your site here and their alignment and spacing in the section below.' );
    xCustomizerText( 'x_navbar_adjust_links_top',                       'Links &ndash; Alignment',              'Customize the vertical alignment of your links for both top and side navbar positions as well as alter the vertical spacing between links for top navbar positions with the "Navbar Top Link Spacing (px)" control.' );
    xCustomizerText( 'x_header_search_enable',                          'Search',                               'Activate search functionality for the navbar. If activated, an icon will appear that when clicked will activate the search modal.' );
    xCustomizerText( 'x_navbar_adjust_button_size',                     'Mobile Button',                        'Adjust the vertical alignment and size of the mobile button that appears on smaller screen sizes in your navbar.' );
    xCustomizerText( 'x_dropdown_font_family',                          'Dropdowns',                            'Adjust the vertical alignment and size of the mobile button that appears on smaller screen sizes in your navbar.' );
    xCustomizerText( 'x_header_widget_areas',                           'Widgetbar',                            false );
    xCustomizerText( 'x_topbar_display',                                'Miscellaneous',                        false );
    xCustomizerText( 'x_footer_widget_areas',                           false,                                  'Easily adjust your site\'s footer by setting your widget areas to the specific number desired and turning on or off various parts as needed. You\'re never forced to use a layout you don\'t need with X.' );
    xCustomizerText( 'x_footer_scroll_top_display',                     'Scroll Top Anchor',                    'Activating the scroll top anchor will output a link that appears in the bottom corner of your site for users to click on that will return them to the top of your website. Once activated, set the value (as a percentage) for how far down the page your users will need to scroll for it to appear. For example, if you want the scroll top anchor to appear once your users have scrolled halfway down your page, you would enter "50" into the field.' );
    xCustomizerText( 'x_blog_style',                                    false,                                  'Adjust the style and layout of your blog using the settings below. This will only affect the posts index page of your blog and will not alter any archive or search results pages. The "Layout" option allows you to keep your sidebar on your posts index page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.' );
    xCustomizerText( 'x_archive_style',                                 'Archives',                             'Adjust the style and layout of your archive pages using the settings below. The "Layout" option allows you to keep your sidebar on your posts index page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.' );
    xCustomizerText( 'x_blog_enable_post_meta',                         'Content',                              'Selecting the "Enable Full Post Content on Index" option below will allow the entire contents of your posts to be shown on the post index pages for all stacks. Deselecting this option will allow you to set the length of your excerpt.' );
    xCustomizerText( 'x_custom_portfolio_slug',                         false,                                  'Setting your custom portfolio slug allows you to create a unique URL structure for your archive pages that suits your needs. When you update it, remember to save your Permalinks again to avoid any potential errors.' );
    xCustomizerText( 'x_portfolio_enable_post_meta',                    'Content',                              false );
    xCustomizerText( 'x_portfolio_tag_title',                           'Labels',                               false );
    xCustomizerText( 'x_portfolio_enable_facebook_sharing',             'Sharing',                              false );
    xCustomizerText( 'x_bbpress_layout_content',                        false,                                  'This section handles all options regarding your bbPress setup. Select your content layout, section titles, along with plenty of other options to get bbPress up and running. The "Layout" option allows you to keep your sidebar if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for your "Content Layout" option, or remove the sidebar completely if desired.' );
    xCustomizerText( 'x_bbpress_header_menu_enable',                    'Navbar Menu',                          'You can add links to various "components" manually in your navigation if desired. Selecting this setting provides you with an additional theme-specific option that will include a simple navigation item with quick links to various bbPress components.' );
    xCustomizerText( 'x_buddypress_layout_content',                     false,                                  'This section handles all options regarding your BuddyPress setup. Select your content layout, section titles, along with plenty of other options to get BuddyPress up and running. The "Layout" option allows you to keep your sidebar if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for your "Content Layout" option, or remove the sidebar completely if desired.' );
    xCustomizerText( 'x_buddypress_header_menu_enable',                 'Navbar Menu',                          'You can add links to various "components" manually in your navigation or activate registration and login links in the WordPress admin bar via BuddyPress\' settings if desired. Selecting this setting provides you with an additional theme-specific option that will include a simple navigation item with quick links to various BuddyPress components.' );
    xCustomizerText( 'x_buddypress_activity_title',                     'Component Titles',                     'Set the titles for the various "components" in BuddyPress (e.g. groups list, registration, et cetera). Keep in mind that the "Sites Title" isn\'t utilized unless you have WordPress Multisite setup on your installation. Additionally, while they might not be present as actual titles on some pages, they are still used as labels in other areas such as the breadcrumbs, so keep this in mind when selecting inputs here.' );
    xCustomizerText( 'x_buddypress_activity_subtitle',                  'Component Subtitles',                  'Set the subtitles for the various "components" in BuddyPress (e.g. groups list, registration, et cetera). Keep in mind that the "Sites Subtitle" isn\'t utilized unless you have WordPress Multisite setup on your installation. Additionally, subtitles are not utilized across every Stack but are left here for ease of management.' );
    xCustomizerText( 'x_woocommerce_header_menu_enable',                false,                                  'Enable a cart in your navigation that you can customize to showcase the information you want your users to see as they add merchandise to their cart (e.g. item count, subtotal, et cetera).' );
    xCustomizerText( 'x_woocommerce_shop_layout_content',               'Shop',                                 'This section handles all options regarding your WooCommerce setup. Select your content layout, product columns, along with plenty of other options to get your shop up and running. The "Shop Layout" option allows you to keep your sidebar on your shop page if you have already selected "Content Left, Sidebar Right" or "Sidebar Left, Content Right" for you "Content Layout" option, or remove the sidebar completely if desired.' );
    xCustomizerText( 'x_woocommerce_product_tabs_enable',               'Single Product',                       'All options available in this section pertain to the layout of your individual product pages. Eenable or disable the sections you want to use to achieve the layout you want.' );
    xCustomizerText( 'x_woocommerce_cart_cross_sells_enable',           'Cart',                                 'All options available in this section pertain to the layout of your cart page. Enable or disable the sections you want to use to achieve the layout you want.' );
    xCustomizerText( 'x_woocommerce_ajax_add_to_cart_color',            'AJAX Add to Cart',                     'If you have the "Enable AJAX add to cart buttons on archives" WooCommerce setting active, you can control the colors of the confirmation overlay here that appears when adding an item on a product index page.' );
    xCustomizerText( 'x_woocommerce_widgets_image_alignment',           'Widgets',                              'Select the placement of your product images in the various WooCommerce widgets that provide them. Right alignment is better if your items have longer titles to avoid staggered word wrapping.' );
    xCustomizerText( 'x_social_facebook',                               false,                                  'Set the URLs for your social media profiles here to be used in the topbar and bottom footer. Adding in a link will make its respective icon show up without needing to do anything else. Keep in mind that these sections are not necessarily intended for a lot of items, so adding all icons could create some layout issues. It is typically best to keep your selections here to a minimum for structural purposes and for usability purposes so you do not overwhelm your visitors.' );
    xCustomizerText( 'x_social_open_graph',                             'Open Graph',                           'X outputs standard Open Graph tags for your content. If you are employing another solution for this, you can disable X\'s Open Graph tag output here.' );
    xCustomizerText( 'x_social_fallback_image',                         'Social Fallback Image',                'The "Social Fallback Image" is used throughout X with various social media network APIs. It is used as a default on pages that do not have a featured image set. You do not have to specify one; however, it is recommended if you are using X\'s native Open Graph implementation, entry sharing, et cetera.' );
    xCustomizerText( 'x_icon_favicon',                                  false,                                  'Easily manage your favicon for desktop, touch icon for mobile devices, and tile icon for the Windows 8 Metro interface in this section. If an image is not set, nothing will be output for that particular icon type. When setting the path to your favicon, make sure you are using the ".ico" format. A 152x152 PNG should be used for your touch icon, and a 144x144 PNG should be used for your tile icon. The color you set for your tile icon will be used behind your image.' );
    xCustomizerText( 'x_custom_styles',                                 false,                                  'Quickly add custom CSS or JavaScript to your site without any complicated setups. Ideal for minor style alterations or small snippets like Google Analytics. Do not place any &lt;style&gt; or &lt;script&gt; tags in these areas as they are already added for your convenience.' );



    // Individual Sections
    // =========================================================================

    //
    // For the most part these two functions can be used to show/hide options
    // based on an initial option's value or changed value. Some exceptions
    // exist (e.g. buttons) where these do not work based on how different
    // options need to be shown/hidden.
    //

    function xCustomizerInitialDisplay( value, targets ) {
      $.each( targets, function( index, item ) {
        if ( item.key !== value ) {
          $( item.target ).attr('data-x-hide', 'true');
        } else {
          $( item.target ).removeAttr('data-x-hide');
        }
      });
    }

    function xCustomizerChangeDisplay( group, targets ) {
      group.change( function() {
        var $value = $(this).val();
        $.each( targets, function( index, item ) {
          if ( item.key !== $value ) {
            $( item.target ).attr('data-x-hide', 'true');
          } else {
            $( item.target ).removeAttr('data-x-hide');
          }
        });
      });
    }


    //
    // Stacks.
    //

    var $stacksStackInit = $('#customize-control-x_stack input:checked').val();
    var $stacksStackOpts = $('#customize-control-x_stack input');
    var $stacksStackTarg = [
      { key : 'integrity', target : '#accordion-section-x_customizer_section_integrity' },
      { key : 'renew',     target : '#accordion-section-x_customizer_section_renew' },
      { key : 'icon',      target : '#accordion-section-x_customizer_section_icon' },
      { key : 'ethos',     target : '#accordion-section-x_customizer_section_ethos' }
    ];

    xCustomizerInitialDisplay( $stacksStackInit, $stacksStackTarg );
    xCustomizerChangeDisplay( $stacksStackOpts, $stacksStackTarg );


    //
    // Layout and design.
    //
    // Must also check current Stack when showing or hiding the content width
    // and sidebar width settings as the sidebar width setting is only needed
    // for Icon and the content width setting is needed on all other Stacks.
    // To do this, we alter the visibility of these settings when either the
    // Content Layout (1) setting is changed or the Stack (2) is changed.
    //

    var $layoutAndDesignContentLayoutInit = $('#customize-control-x_layout_content input:checked').val();
    var $layoutAndDesignContentLayoutOpts = $('#customize-control-x_layout_content input');
    var $layoutAndDesignContentLayoutTarg = [
      '#customize-control-x_layout_content_width',
      '#customize-control-x_layout_sidebar_width'
    ];

    if ( $layoutAndDesignContentLayoutInit === 'full-width' ) {
      $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
      $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
    } else {
      if ( $stacksStackInit === 'icon' ) {
        $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
      } else {
        $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
      }
    }

    $layoutAndDesignContentLayoutOpts.change( function() { // 1
      $value1 = $(this).val();
      $value2 = $('#customize-control-x_stack input:checked').val();
      if ( $value1 === 'full-width' ) {
        $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
        $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
      } else {
        if ( $value2 === 'icon' ) {
          $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
          $( $layoutAndDesignContentLayoutTarg[1] ).removeAttr('data-x-hide');
        } else {
          $( $layoutAndDesignContentLayoutTarg[0] ).removeAttr('data-x-hide');
          $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
        }
      }
    });

    $stacksStackOpts.change( function() { // 2
      $value1 = $(this).val();
      $value2 = $('#customize-control-x_layout_content input:checked').val();
      if ( $value2 === 'full-width' ) {
        $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
        $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
      } else {
        if ( $value1 === 'icon' ) {
          $( $layoutAndDesignContentLayoutTarg[0] ).attr('data-x-hide', 'true');
          $( $layoutAndDesignContentLayoutTarg[1] ).removeAttr('data-x-hide');
        } else {
          $( $layoutAndDesignContentLayoutTarg[0] ).removeAttr('data-x-hide');
          $( $layoutAndDesignContentLayoutTarg[1] ).attr('data-x-hide', 'true');
        }
      }
    });


    //
    // Integrity.
    //

    var $integrityBlogHeaderInit = $('#customize-control-x_integrity_blog_header_enable input:checked').val();
    var $integrityBlogHeaderOpts = $('#customize-control-x_integrity_blog_header_enable input');
    var $integrityBlogHeaderTarg = [
      { key : '1', target : '#customize-control-x_integrity_blog_title, #customize-control-x_integrity_blog_subtitle' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $integrityBlogHeaderInit, $integrityBlogHeaderTarg );
    xCustomizerChangeDisplay( $integrityBlogHeaderOpts, $integrityBlogHeaderTarg );


    var $integrityShopHeaderInit = $('#customize-control-x_integrity_shop_header_enable input:checked').val();
    var $integrityShopHeaderOpts = $('#customize-control-x_integrity_shop_header_enable input');
    var $integrityShopHeaderTarg = [
      { key : '1', target : '#customize-control-x_integrity_shop_title, #customize-control-x_integrity_shop_subtitle' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $integrityShopHeaderInit, $integrityShopHeaderTarg );
    xCustomizerChangeDisplay( $integrityShopHeaderOpts, $integrityShopHeaderTarg );


    //
    // Renew.
    //

    var $renewEntryIconInit = $('#customize-control-x_renew_entry_icon_position input:checked').val();
    var $renewEntryIconOpts = $('#customize-control-x_renew_entry_icon_position input');
    var $renewEntryIconTarg = [
      { key : 'standard', target : '' },
      { key : 'creative', target : '#customize-control-x_renew_entry_icon_position_horizontal, #customize-control-x_renew_entry_icon_position_vertical' },
    ];

    xCustomizerInitialDisplay( $renewEntryIconInit, $renewEntryIconTarg );
    xCustomizerChangeDisplay( $renewEntryIconOpts, $renewEntryIconTarg );


    //
    // Icon.
    //

    var $iconStandardPostColorsInit = $('#customize-control-x_icon_post_standard_colors_enable input:checked').val();
    var $iconStandardPostColorsOpts = $('#customize-control-x_icon_post_standard_colors_enable input');
    var $iconStandardPostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_standard_color, #customize-control-x_icon_post_standard_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconStandardPostColorsInit, $iconStandardPostColorsTarg );
    xCustomizerChangeDisplay( $iconStandardPostColorsOpts, $iconStandardPostColorsTarg );


    var $iconImagePostColorsInit = $('#customize-control-x_icon_post_image_colors_enable input:checked').val();
    var $iconImagePostColorsOpts = $('#customize-control-x_icon_post_image_colors_enable input');
    var $iconImagePostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_image_color, #customize-control-x_icon_post_image_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconImagePostColorsInit, $iconImagePostColorsTarg );
    xCustomizerChangeDisplay( $iconImagePostColorsOpts, $iconImagePostColorsTarg );


    var $iconGalleryPostColorsInit = $('#customize-control-x_icon_post_gallery_colors_enable input:checked').val();
    var $iconGalleryPostColorsOpts = $('#customize-control-x_icon_post_gallery_colors_enable input');
    var $iconGalleryPostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_gallery_color, #customize-control-x_icon_post_gallery_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconGalleryPostColorsInit, $iconGalleryPostColorsTarg );
    xCustomizerChangeDisplay( $iconGalleryPostColorsOpts, $iconGalleryPostColorsTarg );


    var $iconVideoPostColorsInit = $('#customize-control-x_icon_post_video_colors_enable input:checked').val();
    var $iconVideoPostColorsOpts = $('#customize-control-x_icon_post_video_colors_enable input');
    var $iconVideoPostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_video_color, #customize-control-x_icon_post_video_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconVideoPostColorsInit, $iconVideoPostColorsTarg );
    xCustomizerChangeDisplay( $iconVideoPostColorsOpts, $iconVideoPostColorsTarg );


    var $iconAudioPostColorsInit = $('#customize-control-x_icon_post_audio_colors_enable input:checked').val();
    var $iconAudioPostColorsOpts = $('#customize-control-x_icon_post_audio_colors_enable input');
    var $iconAudioPostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_audio_color, #customize-control-x_icon_post_audio_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconAudioPostColorsInit, $iconAudioPostColorsTarg );
    xCustomizerChangeDisplay( $iconAudioPostColorsOpts, $iconAudioPostColorsTarg );


    var $iconQuotePostColorsInit = $('#customize-control-x_icon_post_quote_colors_enable input:checked').val();
    var $iconQuotePostColorsOpts = $('#customize-control-x_icon_post_quote_colors_enable input');
    var $iconQuotePostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_quote_color, #customize-control-x_icon_post_quote_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconQuotePostColorsInit, $iconQuotePostColorsTarg );
    xCustomizerChangeDisplay( $iconQuotePostColorsOpts, $iconQuotePostColorsTarg );


    var $iconLinkPostColorsInit = $('#customize-control-x_icon_post_link_colors_enable input:checked').val();
    var $iconLinkPostColorsOpts = $('#customize-control-x_icon_post_link_colors_enable input');
    var $iconLinkPostColorsTarg = [
      { key : '1', target : '#customize-control-x_icon_post_link_color, #customize-control-x_icon_post_link_background' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $iconLinkPostColorsInit, $iconLinkPostColorsTarg );
    xCustomizerChangeDisplay( $iconLinkPostColorsOpts, $iconLinkPostColorsTarg );


    //
    // Ethos.
    //

    var $ethosPostCarouselInit = $('#customize-control-x_ethos_post_carousel_enable input:checked').val();
    var $ethosPostCarouselOpts = $('#customize-control-x_ethos_post_carousel_enable input');
    var $ethosPostCarouselTarg = [
      { key : '1', target : '#customize-control-x_ethos_post_carousel_count, #customize-control-x_ethos_post_carousel_display, #customize-control-x_ethos_post_carousel_display + .x-customize-control-subtitle, #customize-control-x_ethos_post_carousel_display + .x-customize-control-subtitle + .x-customize-control-description, #customize-control-x_ethos_post_carousel_display_count_extra_large, #customize-control-x_ethos_post_carousel_display_count_large, #customize-control-x_ethos_post_carousel_display_count_medium, #customize-control-x_ethos_post_carousel_display_count_small, #customize-control-x_ethos_post_carousel_display_count_extra_small' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $ethosPostCarouselInit, $ethosPostCarouselTarg );
    xCustomizerChangeDisplay( $ethosPostCarouselOpts, $ethosPostCarouselTarg );


    var $ethosPostSliderBlogInit = $('#customize-control-x_ethos_post_slider_blog_enable input:checked').val();
    var $ethosPostSliderBlogOpts = $('#customize-control-x_ethos_post_slider_blog_enable input');
    var $ethosPostSliderBlogTarg = [
      { key : '1', target : '#customize-control-x_ethos_post_slider_blog_height, #customize-control-x_ethos_post_slider_blog_count, #customize-control-x_ethos_post_slider_blog_display' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $ethosPostSliderBlogInit, $ethosPostSliderBlogTarg );
    xCustomizerChangeDisplay( $ethosPostSliderBlogOpts, $ethosPostSliderBlogTarg );


    var $ethosPostSliderArchivesInit = $('#customize-control-x_ethos_post_slider_archive_enable input:checked').val();
    var $ethosPostSliderArchivesOpts = $('#customize-control-x_ethos_post_slider_archive_enable input');
    var $ethosPostSliderArchivesTarg = [
      { key : '1', target : '#customize-control-x_ethos_post_slider_archive_height, #customize-control-x_ethos_post_slider_archive_count, #customize-control-x_ethos_post_slider_archive_display' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $ethosPostSliderArchivesInit, $ethosPostSliderArchivesTarg );
    xCustomizerChangeDisplay( $ethosPostSliderArchivesOpts, $ethosPostSliderArchivesTarg );


    var $ethosFilterableIndexInit = $('#customize-control-x_ethos_filterable_index_enable input:checked').val();
    var $ethosFilterableIndexOpts = $('#customize-control-x_ethos_filterable_index_enable input');
    var $ethosFilterableIndexTarg = [
      { key : '1', target : '#customize-control-x_ethos_filterable_index_categories' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $ethosFilterableIndexInit, $ethosFilterableIndexTarg );
    xCustomizerChangeDisplay( $ethosFilterableIndexOpts, $ethosFilterableIndexTarg );


    //
    // Typography.
    //

    var $typeFontSubsetsInit = $('#customize-control-x_google_fonts_subsets input:checked').val();
    var $typeFontSubsetsOpts = $('#customize-control-x_google_fonts_subsets input');
    var $typeFontSubsetsTarg = [
      { key : '1', target : '#customize-control-x_google_fonts_subset_cyrillic, #customize-control-x_google_fonts_subset_greek, #customize-control-x_google_fonts_subset_vietnamese' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $typeFontSubsetsInit, $typeFontSubsetsTarg );
    xCustomizerChangeDisplay( $typeFontSubsetsOpts, $typeFontSubsetsTarg );


    //
    // Buttons.
    //

    var $typeButtonStyleInit = $('#customize-control-x_button_style input:checked').val();
    var $typeButtonStyleOpts = $('#customize-control-x_button_style input');
    var $typeButtonStyleTarg = [
      '#customize-control-x_button_color',
      '#customize-control-x_button_background_color',
      '#customize-control-x_button_border_color',
      '#customize-control-x_button_bottom_color',
      '#customize-control-x_button_color_hover',
      '#customize-control-x_button_background_color_hover',
      '#customize-control-x_button_border_color_hover',
      '#customize-control-x_button_bottom_color_hover'
    ];

    if ( $typeButtonStyleInit === 'flat' ) {
      $( $typeButtonStyleTarg[3] ).attr('data-x-hide', 'true');
      $( $typeButtonStyleTarg[7] ).attr('data-x-hide', 'true');
    } else if ( $typeButtonStyleInit === 'transparent' ) {
      $( $typeButtonStyleTarg[1] ).attr('data-x-hide', 'true');
      $( $typeButtonStyleTarg[3] ).attr('data-x-hide', 'true');
      $( $typeButtonStyleTarg[5] ).attr('data-x-hide', 'true');
      $( $typeButtonStyleTarg[7] ).attr('data-x-hide', 'true');
    }

    $typeButtonStyleOpts.change( function() {
      $value = $(this).val();
      if ( $value === 'real' ) {
        $( $typeButtonStyleTarg[0] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[1] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[2] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[3] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[4] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[5] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[6] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[7] ).removeAttr('data-x-hide');
      } else if ( $value === 'flat' ) {
        $( $typeButtonStyleTarg[0] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[1] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[2] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[3] ).attr('data-x-hide', 'true');
        $( $typeButtonStyleTarg[4] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[5] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[6] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[7] ).attr('data-x-hide', 'true');
      } else if ( $value === 'transparent' ) {
        $( $typeButtonStyleTarg[0] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[1] ).attr('data-x-hide', 'true');
        $( $typeButtonStyleTarg[2] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[3] ).attr('data-x-hide', 'true');
        $( $typeButtonStyleTarg[4] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[5] ).attr('data-x-hide', 'true');
        $( $typeButtonStyleTarg[6] ).removeAttr('data-x-hide');
        $( $typeButtonStyleTarg[7] ).attr('data-x-hide', 'true');
      }
    });


    //
    // Header.
    //

    var $headerNavbarPositionInit = $('#customize-control-x_navbar_positioning input:checked').val();
    var $headerNavbarPositionOpts = $('#customize-control-x_navbar_positioning input');
    var $headerNavbarPositionTarg = [
      '#customize-control-x_navbar_width',
      '#customize-control-x_logo_adjust_navbar_side',
      '#customize-control-x_navbar_adjust_links_side',
      '#customize-control-x_fixed_menu_scroll'
    ];

    if ( $headerNavbarPositionInit === 'static-top' || $headerNavbarPositionInit === 'fixed-top' ) {
      $( $headerNavbarPositionTarg[0] ).attr('data-x-hide', 'true');
      $( $headerNavbarPositionTarg[1] ).attr('data-x-hide', 'true');
      $( $headerNavbarPositionTarg[2] ).attr('data-x-hide', 'true');
      $( $headerNavbarPositionTarg[3] ).attr('data-x-hide', 'true');
    }

    $headerNavbarPositionOpts.change( function() {
      $value = $(this).val();
      if ( $value === 'static-top' || $value === 'fixed-top' ) {
        $( $headerNavbarPositionTarg[0] ).attr('data-x-hide', 'true');
        $( $headerNavbarPositionTarg[1] ).attr('data-x-hide', 'true');
        $( $headerNavbarPositionTarg[2] ).attr('data-x-hide', 'true');
        $( $headerNavbarPositionTarg[3] ).attr('data-x-hide', 'true');
      } else if ( $value === 'fixed-left' || $value === 'fixed-right' ) {
        $( $headerNavbarPositionTarg[0] ).removeAttr('data-x-hide');
        $( $headerNavbarPositionTarg[1] ).removeAttr('data-x-hide');
        $( $headerNavbarPositionTarg[2] ).removeAttr('data-x-hide');
        $( $headerNavbarPositionTarg[3] ).removeAttr('data-x-hide');
      }
    });


    var $headerLogoNavLayoutInit = $('#customize-control-x_logo_navigation_layout input:checked').val();
    var $headerLogoNavLayoutOpts = $('#customize-control-x_logo_navigation_layout input');
    var $headerLogoNavLayoutTarg = [
      { key : 'inline',  target : '' },
      { key : 'stacked', target : '#customize-control-x_logobar_adjust_spacing_top, #customize-control-x_logobar_adjust_spacing_bottom' }
    ];

    xCustomizerInitialDisplay( $headerLogoNavLayoutInit, $headerLogoNavLayoutTarg );
    xCustomizerChangeDisplay( $headerLogoNavLayoutOpts, $headerLogoNavLayoutTarg );


    var $headerWidgetAreasInit = $('#customize-control-x_header_widget_areas input:checked').val();
    var $headerWidgetAreasOpts = $('#customize-control-x_header_widget_areas input');
    var $headerWidgetAreasTarg = [
      '#customize-control-x_widgetbar_button_background',
      '#customize-control-x_widgetbar_button_background_hover'
    ];

    if ( $headerWidgetAreasInit === '0' ) {
      $( $headerWidgetAreasTarg[0] ).attr('data-x-hide', 'true');
      $( $headerWidgetAreasTarg[1] ).attr('data-x-hide', 'true');
    }

    $headerWidgetAreasOpts.change( function() {
      $value = $(this).val();
      if ( $value === '0' ) {
        $( $headerWidgetAreasTarg[0] ).attr('data-x-hide', 'true');
        $( $headerWidgetAreasTarg[1] ).attr('data-x-hide', 'true');
      } else {
        $( $headerWidgetAreasTarg[0] ).removeAttr('data-x-hide');
        $( $headerWidgetAreasTarg[1] ).removeAttr('data-x-hide');
      }
    });


    var $headerTopbarInit = $('#customize-control-x_topbar_display input:checked').val();
    var $headerTopbarOpts = $('#customize-control-x_topbar_display input');
    var $headerTopbarTarg = [
      { key : '1', target : '#customize-control-x_topbar_content' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $headerTopbarInit, $headerTopbarTarg );
    xCustomizerChangeDisplay( $headerTopbarOpts, $headerTopbarTarg );


    //
    // Footer.
    //

    var $footerBottomInit        = $('#customize-control-x_footer_bottom_display input:checked').val();
    var $footerBottomOpts        = $('#customize-control-x_footer_bottom_display input');
    var $footerBottomContentInit = $('#customize-control-x_footer_content_display input:checked').val();
    var $footerBottomContentOpts = $('#customize-control-x_footer_content_display input');
    var $footerBottomTarg        = [
      '#customize-control-x_footer_menu_display',
      '#customize-control-x_footer_social_display',
      '#customize-control-x_footer_content_display',
      '#customize-control-x_footer_content'
    ];

    if ( $footerBottomInit === '' ) {
      $( $footerBottomTarg[0] ).attr('data-x-hide', 'true');
      $( $footerBottomTarg[1] ).attr('data-x-hide', 'true');
      $( $footerBottomTarg[2] ).attr('data-x-hide', 'true');
      $( $footerBottomTarg[3] ).attr('data-x-hide', 'true');
    }

    $footerBottomOpts.change( function() {
      $value = $(this).val();
      if ( $value === '' ) {
        $( $footerBottomTarg[0] ).attr('data-x-hide', 'true');
        $( $footerBottomTarg[1] ).attr('data-x-hide', 'true');
        $( $footerBottomTarg[2] ).attr('data-x-hide', 'true');
        $( $footerBottomTarg[3] ).attr('data-x-hide', 'true');
      } else if ( $value === '1' ) {
        $( $footerBottomTarg[0] ).removeAttr('data-x-hide');
        $( $footerBottomTarg[1] ).removeAttr('data-x-hide');
        $( $footerBottomTarg[2] ).removeAttr('data-x-hide');
        if ( $('#customize-control-x_footer_content_display input:checked').val() === '1' ) {
          $( $footerBottomTarg[3] ).removeAttr('data-x-hide');
        }
      }
    });

    if ( $footerBottomContentInit === '' ) {
      $( $footerBottomTarg[3] ).attr('data-x-hide', 'true');
    }

    $footerBottomContentOpts.change( function() {
      $value = $(this).val();
      if ( $value === '' ) {
        $( $footerBottomTarg[3] ).attr('data-x-hide', 'true');
      } else if ( $value === '1' ) {
        $( $footerBottomTarg[3] ).removeAttr('data-x-hide');
      }
    });


    var $footerScrollTopInit = $('#customize-control-x_footer_scroll_top_display input:checked').val();
    var $footerScrollTopOpts = $('#customize-control-x_footer_scroll_top_display input');
    var $footerScrollTopTarg = [
      { key : '1', target : '#customize-control-x_footer_scroll_top_position, #customize-control-x_footer_scroll_top_display_unit' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $footerScrollTopInit, $footerScrollTopTarg );
    xCustomizerChangeDisplay( $footerScrollTopOpts, $footerScrollTopTarg );


    //
    // Blog.
    //

    var $blogStyleInit = $('#customize-control-x_blog_style input:checked').val();
    var $blogStyleOpts = $('#customize-control-x_blog_style input');
    var $blogStyleTarg = [
      { key : 'standard', target : '' },
      { key : 'masonry',  target : '#customize-control-x_blog_masonry_columns' }
    ];

    xCustomizerInitialDisplay( $blogStyleInit, $blogStyleTarg );
    xCustomizerChangeDisplay( $blogStyleOpts, $blogStyleTarg );


    var $blogArchivesStyleInit = $('#customize-control-x_archive_style input:checked').val();
    var $blogArchivesStyleOpts = $('#customize-control-x_archive_style input');
    var $blogArchivesStyleTarg = [
      { key : 'standard', target : '' },
      { key : 'masonry',  target : '#customize-control-x_archive_masonry_columns' }
    ];

    xCustomizerInitialDisplay( $blogArchivesStyleInit, $blogArchivesStyleTarg );
    xCustomizerChangeDisplay( $blogArchivesStyleOpts, $blogArchivesStyleTarg );


    var $blogFullPostContentInit = $('#customize-control-x_blog_enable_full_post_content input:checked').val();
    var $blogFullPostContentOpts = $('#customize-control-x_blog_enable_full_post_content input');
    var $blogFullPostContentTarg = [
      { key : '1', target : '' },
      { key : '',  target : '#customize-control-x_blog_excerpt_length' }
    ];

    xCustomizerInitialDisplay( $blogFullPostContentInit, $blogFullPostContentTarg );
    xCustomizerChangeDisplay( $blogFullPostContentOpts, $blogFullPostContentTarg );


    //
    // WooCommerce.
    //

    var $wooNavbarMenuInit = $('#customize-control-x_woocommerce_header_menu_enable input:checked').val();
    var $wooNavbarMenuOpts = $('#customize-control-x_woocommerce_header_menu_enable input');
    var $wooNavbarMenuTarg = [
      { key : '1', target : '#customize-control-x_woocommerce_header_cart_info, #customize-control-x_woocommerce_header_cart_style, #customize-control-x_woocommerce_header_cart_layout, #customize-control-x_woocommerce_header_cart_adjust, #customize-control-x_woocommerce_header_cart_content_inner, #customize-control-x_woocommerce_header_cart_content_outer, #customize-control-x_woocommerce_header_cart_content_inner_color, #customize-control-x_woocommerce_header_cart_content_inner_color_hover, #customize-control-x_woocommerce_header_cart_content_outer_color, #customize-control-x_woocommerce_header_cart_content_outer_color_hover' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $wooNavbarMenuInit, $wooNavbarMenuTarg );
    xCustomizerChangeDisplay( $wooNavbarMenuOpts, $wooNavbarMenuTarg );


    var $wooTabsInit = $('#customize-control-x_woocommerce_product_tabs_enable input:checked').val();
    var $wooTabsOpts = $('#customize-control-x_woocommerce_product_tabs_enable input');
    var $wooTabsTarg = [
      { key : '1', target : '#customize-control-x_woocommerce_product_tab_description_enable, #customize-control-x_woocommerce_product_tab_additional_info_enable, #customize-control-x_woocommerce_product_tab_reviews_enable' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $wooTabsInit, $wooTabsTarg );
    xCustomizerChangeDisplay( $wooTabsOpts, $wooTabsTarg );


    var $wooRelatedInit = $('#customize-control-x_woocommerce_product_related_enable input:checked').val();
    var $wooRelatedOpts = $('#customize-control-x_woocommerce_product_related_enable input');
    var $wooRelatedTarg = [
      { key : '1', target : '#customize-control-x_woocommerce_product_related_columns, #customize-control-x_woocommerce_product_related_count' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $wooRelatedInit, $wooRelatedTarg );
    xCustomizerChangeDisplay( $wooRelatedOpts, $wooRelatedTarg );


    var $wooUpsellsInit = $('#customize-control-x_woocommerce_product_upsells_enable input:checked').val();
    var $wooUpsellsOpts = $('#customize-control-x_woocommerce_product_upsells_enable input');
    var $wooUpsellsTarg = [
      { key : '1', target : '#customize-control-x_woocommerce_product_upsell_columns, #customize-control-x_woocommerce_product_upsell_count' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $wooUpsellsInit, $wooUpsellsTarg );
    xCustomizerChangeDisplay( $wooUpsellsOpts, $wooUpsellsTarg );


    var $wooCrossSellsInit = $('#customize-control-x_woocommerce_cart_cross_sells_enable input:checked').val();
    var $wooCrossSellsOpts = $('#customize-control-x_woocommerce_cart_cross_sells_enable input');
    var $wooCrossSellsTarg = [
      { key : '1', target : '#customize-control-x_woocommerce_cart_cross_sells_columns, #customize-control-x_woocommerce_cart_cross_sells_count' },
      { key : '',  target : '' }
    ];

    xCustomizerInitialDisplay( $wooCrossSellsInit, $wooCrossSellsTarg );
    xCustomizerChangeDisplay( $wooCrossSellsOpts, $wooCrossSellsTarg );

  });

})(jQuery);

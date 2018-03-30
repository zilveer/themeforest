<?php

// This file contains sidebar information.

add_action( 'admin_init', 'krown_meta_boxes' );

//global $sidebars_array;

function krown_meta_boxes() {

/*---------------------------------
    INIT SOME USEFUL VARIABLES
    ------------------------------------*/


  
  $sidebars = ot_get_option('krown_sidebars');
  $sidebars_array = array();
  $sidebars_k = 0;
  if(!empty($sidebars)){
      foreach($sidebars as $sidebar){
          $sidebars_array[$sidebars_k++] = array(
              'label' => $sidebar['title'],
              'value' => $sidebar['id']
          );
      }
  }


  $krown_folio_design = array(
    'id'        => 'krown_folio_design',
    'title' => 'Portfolio Settings',
    'desc' => '',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
          'label' => 'Columns',
          'id' => 'folio_cols',
          'type' => 'select',
          'desc' => 'Choose the number of columns for this portfolio page.',
          'std' => 'four',
          'choices' => array(
            array(
                'label' => 'Two',
                'value' => 'two'
                ),
            array(
                'label' => 'Three',
                'value' => 'three'
                ),
            array(
                'label' => 'Four',
                'value' => 'four'
                )
            )
          ),

        array(
          'label' => 'Grid style',
          'id' => 'folio_style',
          'type' => 'select',
          'desc' => 'Choose the style of the grid. For fixed size grids, you need to also set the ratio of the thumbnails, below (cropping will occur). Thumbnails in the masonry grid are automatically resized to fit the right size (no cropping is done).',
          'std' => 'masonry',
          'choices' => array(
            array(
                'label' => 'Masonry Simple',
                'value' => 'masonry'
                ),
            array(
                'label' => 'Masonry Advanced',
                'value' => 'masonry-advanced'
                ),
            array(
                'label' => 'Fixed',
                'value' => 'fixed'
                )
            )
          ),

        array(
          'label' => 'Thumbs ratio',
          'id' => 'folio_ratio',
          'type' => 'text',
          'std' => '4:3',
          'desc' => 'Valid ratio format, two integer numbers divided by the ":" character.'
        ), 


        array(
          'label' => 'Animation style',
          'id' => 'folio_anim',
          'type' => 'select',
          'desc' => 'Choose the style of the animations.',
          'std' => 'one',
          'choices' => array(
            array(
                'label' => 'Style #1',
                'value' => 'one'
                ),
            array(
                'label' => 'Style #2',
                'value' => 'two'
                ),
            array(
                'label' => 'Style #3',
                'value' => 'three'
                ),
            array(
                'label' => 'Style #4',
                'value' => 'four'
                )
            )
          ),

        array(
          'label' => 'Thumbnail style',
          'id' => 'folio_color',
          'type' => 'select',
          'desc' => 'Choose the style of the thumbnail.',
          'std' => 'light',
          'choices' => array(
            array(
                'label' => 'Light',
                'value' => 'light'
                ),
            array(
                'label' => 'Dark',
                'value' => 'dark'
                )
            )
          ),

        array(
          'label' => 'Thumbnail info',
          'id' => 'folio_info',
          'type' => 'select',
          'desc' => 'Choose the info which should be displayed on each thumbnail.',
          'std' => 'category',
          'choices' => array(
            array(
                'label' => 'Category',
                'value' => 'category'
                ),
            array(
                'label' => 'Excerpt',
                'value' => 'excerpt'
                )
            )
          ),

        array(
          'label' => 'Categories',
          'id' => 'folio_cats',
          'type' => 'taxonomy-checkbox',
          'taxonomy'    => 'portfolio_category',
          'desc' => 'You have the possibility to select only certain categories to appear in this portfolio page. If there is no selection, all portfolio items will appear in the grid.'
        ),

        array(
          'label' => 'Category filtering',
          'id' => 'folio_filter',
          'type' => 'select',
          'desc' => 'You can enable animated filters in this portfolio (it works best with infinite loading or no pagination).',
          'std' => 'disable-filters',
          'choices' => array(
            array(
                'label' => 'Disabled',
                'value' => 'disable-filters'
                ),
            array(
                'label' => 'Enabled',
                'value' => 'enable-filters'
                )
            )
          ),

        array(
          'label' => 'Pagination',
          'id' => 'folio_pag',
          'type' => 'select',
          'desc' => 'You can enable pagination and set a custom number of portfolio items per page below (useful for large portfolios).',
          'std' => 'no-pagination',
          'choices' => array(
            array(
                'label' => 'Disabled',
                'value' => 'no-pagination'
                ),
            array(
                'label' => 'Infinite loading',
                'value' => 'infinte-loading'
                ),
            array(
                'label' => 'Classic (buttons)',
                'value' => 'classic'
                )
            )
        ),

        array(
          'label' => 'Projects per page',
          'id' => 'folio_per',
          'type' => 'text',
          'std' => '12',
          'desc' => 'Available only when pagination is enabled, otherwise all projects will be shown.'
        ),


        array(
          'label' => 'Extra content',
          'id' => 'folio_content',
          'type' => 'select',
          'desc' => 'If you want to show extra content besides the portfolio grid you can use the content area (with Visual Composer) to insert custom shortcodes above or below the actual grid.',
          'std' => 'no-content',
          'choices' => array(
            array(
                'label' => 'Disabled',
                'value' => 'no-content'
                ),
            array(
                'label' => 'Above grid',
                'value' => 'content-above'
                ),
            array(
                'label' => 'Below grid',
                'value' => 'content-below'
                )
            )
        )

      )
    );






  $krown_gallery_settings = array(
    'id'        => 'krown_gallery_settings',
    'title' => 'Gallery Settings',
    'desc' => '',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(


        array(
          'label' => 'Content',
          'id' => 'pp_gallery_slider',
          'type' => 'gallery',
          'desc' => 'Click "Create Gallery" to create your lightbox gallery.',
          'post_type' => 'post'
          ),

        array(
          'label' => 'Columns',
          'id' => 'gallery_cols',
          'type' => 'select',
          'desc' => 'Choose the number of columns for this gallery page.',
          'std' => 'four',
          'choices' => array(
            array(
                'label' => 'Two',
                'value' => 'two'
                ),
            array(
                'label' => 'Three',
                'value' => 'three'
                ),
            array(
                'label' => 'Four',
                'value' => 'four'
                )
            )
          ),

        array(
          'label' => 'Grid style',
          'id' => 'gallery_style',
          'type' => 'select',
          'desc' => 'Choose the style of the grid. For fixed size grids, you need to also set the ratio of the thumbnails, below (cropping will occur). Thumbnails in the masonry grid are automatically resized to fit the right size (no cropping is done).',
          'std' => 'masonry',
          'choices' => array(
            array(
                'label' => 'Masonry Simple',
                'value' => 'masonry'
                ),
            array(
                'label' => 'Masonry Advanced',
                'value' => 'masonry-advanced'
                ),
            array(
                'label' => 'Fixed',
                'value' => 'fixed'
                )
            )
          ),

        array(
          'label' => 'Thumbs ratio',
          'id' => 'gallery_ratio',
          'type' => 'text',
          'std' => '4:3',
          'desc' => 'Valid ratio format, two integer numbers divided by the ":" character.'
        ), 

        array(
          'label' => 'Extra content',
          'id' => 'gallery_content',
          'type' => 'select',
          'desc' => 'If you want to show extra content besides the gallery grid you can use the content area (with Visual Composer) to insert custom shortcodes above or below the actual grid.',
          'std' => 'no-content',
          'choices' => array(
            array(
                'label' => 'Disabled',
                'value' => 'no-content'
                ),
            array(
                'label' => 'Above grid',
                'value' => 'content-above'
                ),
            array(
                'label' => 'Below grid',
                'value' => 'content-below'
                )
            )
        )

      )
    );

  $krown_page_slider = array(
    'id'        => 'krown_page_slider',
    'title' => 'Header Options',
    'desc' => '',
    'pages' => array( 'page', 'portfolio' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(

          array(
          'label' => 'Show title',
          'id' => 'krown_show_title',
          'type' => 'select',
          'std' => 'hide-title',
          'desc' => 'Choose whether you want to show or hide the title of this current page.',
          'choices' => array(
            array(
                'value' => 'hide-title',
                'label' => 'Hide'
                ),
            array(
                'value' => 'show-title',
                'label' => 'Show'
                )
            )
          ),

          array(
          'label' => 'Header media',
          'id' => 'krown_custom_header_set',
          'type' => 'select',
          'std' => 'wout-custom-header',
          'desc' => 'Choose whether you want to use a slider, a plain image or your own HTML code for this page.',
          'choices' => array(
            array(
                'value' => 'wout-custom-header',
                'label' => 'None'
                ),
            array(
                'value' => 'w-custom-header-slider',
                'label' => 'Slider'
                ),
            array(
                'value' => 'w-custom-header-image',
                'label' => 'Image'
                ),
            array(
                'value' => 'w-custom-header-html',
                'label' => 'HTML'
                )
            )
          ),

        array(
          'label' => 'Header margin',
          'id' => 'krown_custom_header_margin',
          'type' => 'text',
          'std' => '0',
          'desc' => 'Choose a bottom margin for the header (if you\'re using a certain media element for it)',
          ),

        array(
          'label' => 'Header image',
          'id' => 'krown_custom_header_img',
          'type' => 'upload',
          'desc' => 'If you want to use a static image for the header, upload it here. It needs to be 1296px wide.',
          ),

        array(
          'label' => 'Header slider',
          'id' => 'krown_custom_header_slider',
          'type' => 'text',
          'desc' => 'If you want to use an instance of the revolution slider as your custom header, write it\'s <strong>SHORTCODE</strong> here.',
          ),

        array(
          'label' => 'Header html',
          'id' => 'krown_custom_header_html',
          'type' => 'textarea',
          'desc' => 'This field allows any type of HTML input (including iframes, inline CSS styling, etc.).',
          ),


        )
    );

$krown_contact_meta = array(
    'id'        => 'krown_contact_meta',
    'title' => 'Map Options',
    'desc' => 'Use the following fields to configure this page\'s map. If you choose to hide the map, you could use a static image or slider, just like in any other page, however, if you choose to show the map, the static image will no longer appear.',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
          'label' => 'Enable map',
          'id' => 'krown_show_map',
          'type' => 'radio',
          'desc' => '',
          'std' => 'wout-custom-header-map',
          'choices' => array(
            array(
                'value' => 'w-custom-header-map',
                'label' => 'Enabled'
                ),
            array(
                'value' => 'wout-custom-header-map',
                'label' => 'Disabled'
                )
            )
          ),
        array(
          'label' => 'Map zoom level',
          'id' => 'krown_map_zoom',
          'type' => 'text',
          'desc' => 'Should be a number between 1 and 21.',
          'std' => '16'
          ),
        array(
          'label' => 'Map style',
          'id' => 'krown_map_style',
          'type' => 'radio',
          'desc' => '',
          'std' => 'true',
          'choices' => array(
            array(
                'value' => 'true',
                'label' => 'Greyscale'
                ),
            array(
                'value' => 'false',
                'label' => 'Default'
                )
            )
          ),
        array(
          'label' => 'Map latitude',
          'id' => 'krown_map_lat',
          'type' => 'text',
          'desc' => 'Enter a latitude coordinate for the map\'s center (your POI).',
          'std' => ''
          ),
        array(
          'label' => 'Map longitude',
          'id' => 'krown_map_long',
          'type' => 'text',
          'desc' => 'Enter a longitude coordinate for the map\'s center (your POI).',
          'std' => ''
          ),
        array(
          'label' => 'Show marker',
          'id' => 'krown_map_marker',
          'type' => 'radio',
          'desc' => '',
          'std' => 'true',
          'choices' => array(
            array(
                'value' => 'true',
                'label' => 'Show'
                ),
            array(
                'value' => 'false',
                'label' => 'Hide'
                )
            )
          ),
        array(
          'label' => 'Marker image',
          'id' => 'krown_map_img',
          'type' => 'upload',
          'desc' => 'Upload an image which will be the marker on your map.',
          'std' => ''
          )
        )
);

    /*---------------------------------
        INIT METABOXES
        ------------------------------------*/

    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 'no');
    $template_file = $post_id != 'no' ? get_post_meta($post_id,'_wp_page_template',TRUE) : 'no';

    

      if ( $template_file == 'template-portfolio.php' ) {
      	ot_register_meta_box($krown_folio_design);
      } else if ( $template_file == 'template-gallery.php' ) {
      	ot_register_meta_box($krown_gallery_settings);
      } else if($template_file == 'template-contact.php') {
        ot_register_meta_box($krown_contact_meta);
      } 
      	ot_register_meta_box($krown_page_slider);

}

?>
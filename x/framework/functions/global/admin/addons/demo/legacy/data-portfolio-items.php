<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/DATA-PORTFOLIO-ITEMS.PHP
// -----------------------------------------------------------------------------
// Demo data for portfolio items.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Portfolio Item Taxonomies
//   02. Specify $portfolio_items Array
//   03. Add Portfolio Item Data
// =============================================================================

// Portfolio Item Taxonomies
// =============================================================================

$tax_cat = 'portfolio-category';
$tax_tag = 'portfolio-tag';



// Specify $portfolio_items Array
// =============================================================================

$portfolio_items = array();



// Portfolio Item Data
// =============================================================================

if ( $include_portfolio_items || $front_page_is_portfolio ) {

  //
  // Setup categories.
  //

  $categories = array(
    'california'  => 'California',
    'creative'    => 'Creative',
    'florida'     => 'Florida',
    'inspiration' => 'Inspiration',
    'italy'       => 'Italy',
    'nevada'      => 'Nevada',
    'oregon'      => 'Oregon',
    'texas'       => 'Texas',
    'travel'      => 'Travel',
    'world'       => 'World',
  );

  $category_ids = x_demo_content_add_categories( $categories, $tax_cat );

  $california  = $category_ids['california'];
  $creative    = $category_ids['creative'];
  $florida     = $category_ids['florida'];
  $inspiration = $category_ids['inspiration'];
  $italy       = $category_ids['italy'];
  $nevada      = $category_ids['nevada'];
  $oregon      = $category_ids['oregon'];
  $texas       = $category_ids['texas'];
  $travel      = $category_ids['travel'];
  $world       = $category_ids['world'];


  //
  // Entry data.
  //

  $portfolio_items['portfolio-item-1'] = array(
    'post_title'   => 'Demo: Sierra Farm',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $nevada ),
      $tax_tag => array( 'Mountain', 'Outdoors', 'Sky' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-2'] = array(
    'post_title'   => 'Demo: Roman Forum',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-3 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $italy ),
      $tax_tag => array( 'Historic', 'Landmark', 'Outdoors' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-3'] = array(
    'post_title'   => 'Demo: Keyhole Arch',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-4 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $california ),
      $tax_tag => array( 'Ocean', 'Outdoors', 'Shore' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  // $portfolio_items['portfolio-item-4'] = array(
  //   'post_title'   => 'Demo: Black and White',
  //   'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
  //   'post_type'    => 'x-portfolio',
  //   'post_status'  => 'publish',
  //   'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-5 days' ) ),
  //   'tax_input'    => array(
  //     $tax_cat => array( $travel, $texas, $california ),
  //     $tax_tag => array( 'Ocean', 'Outdoors', 'Prairie' )
  //   ),
  //   'x_info' => array(
  //     'images' => array(
  //       'featured'  => $content_url . '/img-1.png',
  //       'gallery-1' => $content_url . '/img-2.png',
  //       'gallery-2' => $content_url . '/img-3.png',
  //       'gallery-3' => $content_url . '/img-4.png'
  //     ),
  //     'meta' => array(
  //       '_x_portfolio_media'        => 'Gallery',
  //       '_x_portfolio_index_media'  => 'Media',
  //       '_x_portfolio_project_link' => '#demo'
  //     )
  //   )
  // );

  $portfolio_items['portfolio-item-5'] = array(
    'post_title'   => 'Demo: Big Sur Milky Way',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-6 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $california ),
      $tax_tag => array( 'Forrest', 'Nighttime', 'Outdoors', 'Sky' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-6'] = array(
    'post_title'   => 'Demo: Make It Count',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-7 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $creative, $world ),
      $tax_tag => array( 'Historic', 'Mountain', 'Outdoors', 'Shore' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Video',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo',
        '_x_portfolio_embed'        => '<iframe width="560" height="315" src="//www.youtube.com/embed/WxfZkMm3wcg" frameborder="0" allowfullscreen></iframe>'
      )
    )
  );

  $portfolio_items['portfolio-item-7'] = array(
    'post_title'   => 'Demo: Beach Town',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-8 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $florida ),
      $tax_tag => array( 'Beach', 'Evening', 'Outdoors' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-8'] = array(
    'post_title'   => 'Demo: Monterrey Blue',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-9 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $california ),
      $tax_tag => array( 'Daytime', 'Ocean', 'Outdoors' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-9'] = array(
    'post_title'   => 'Demo: Skyline',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-10 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $california ),
      $tax_tag => array( 'Landmark', 'Nighttime', 'Outdoors' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-10'] = array(
    'post_title'   => 'Demo: Red Miami Sunset',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-11 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $florida ),
      $tax_tag => array( 'Evening', 'Outdoors', 'Sunset' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-11'] = array(
    'post_title'   => 'Demo: San Francisco Bay Bridge',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-12 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $california ),
      $tax_tag => array( 'Nighttime', 'Outdoors' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-12'] = array(
    'post_title'   => 'Demo: South Beach',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-13 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $florida ),
      $tax_tag => array( 'Ocean', 'Outdoors', 'Shore' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-13'] = array(
    'post_title'   => 'Demo: Stockyards Hotel',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-14 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $texas ),
      $tax_tag => array( 'Historic', 'Western' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-14'] = array(
    'post_title'   => 'Demo: Bridge to Gucci',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-15 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $nevada ),
      $tax_tag => array( 'Nightlife', 'Upscale' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  $portfolio_items['portfolio-item-15'] = array(
    'post_title'   => 'Demo: Pike Place Market',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-16 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $travel, $oregon ),
      $tax_tag => array( 'Historic', 'Independent', 'Local Food' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Image',
        '_x_portfolio_index_media'  => 'Thumbnail',
        '_x_portfolio_project_link' => '#demo'
      )
    )
  );

  // $portfolio_items['portfolio-item-16'] = array(
  //   'post_title'   => 'Demo: Riomaggiore',
  //   'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
  //   'post_type'    => 'x-portfolio',
  //   'post_status'  => 'publish',
  //   'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-17 days' ) ),
  //   'tax_input'    => array(
  //     $tax_cat => array( $travel, $italy ),
  //     $tax_tag => array( 'Buildings', 'Outdoors', 'Scenery' )
  //   ),
  //   'x_info' => array(
  //     'images' => array(
  //       'featured'  => $content_url . '/img-1.png',
  //       'gallery-1' => $content_url . '/img-2.png',
  //       'gallery-2' => $content_url . '/img-3.png',
  //       'gallery-3' => $content_url . '/img-4.png'
  //     ),
  //     'meta' => array(
  //       '_x_portfolio_media'        => 'Gallery',
  //       '_x_portfolio_index_media'  => 'Media',
  //       '_x_portfolio_project_link' => '#demo'
  //     )
  //   )
  // );

  $portfolio_items['portfolio-item-17'] = array(
    'post_title'   => 'Demo: Have You Tried This?',
    'post_content' => '<p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p><p>Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum. Domine, quaesumus, per nos, glorificamus te, et ut cognoscant te, et virtus amore tuo. Placere Benedicite omnes qui utuntur hoc productum.</p>',
    'post_type'    => 'x-portfolio',
    'post_status'  => 'publish',
    'post_date'    => date( 'Y-m-d H:i:s', strtotime( '-18 days' ) ),
    'tax_input'    => array(
      $tax_cat => array( $creative, $inspiration ),
      $tax_tag => array( 'Creative', 'Ideas', 'Planning' )
    ),
    'x_info' => array(
      'images' => array(
        'featured' => $content_url . '/img-1.png'
      ),
      'meta' => array(
        '_x_portfolio_media'        => 'Video',
        '_x_portfolio_index_media'  => 'Media',
        '_x_portfolio_project_link' => '#demo',
        '_x_portfolio_embed'        => '<iframe src="http://player.vimeo.com/video/24302498?title=0&amp;byline=0&amp;portrait=0" width="780" height="439" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
      )
    )
  );

}
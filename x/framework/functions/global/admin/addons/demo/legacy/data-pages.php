<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/DEMO/DATA-PAGES.PHP
// -----------------------------------------------------------------------------
// Demo data for pages.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Specify $pages Array
//   01. Add Page Data
// =============================================================================

// Specify $pages Array
// =============================================================================

$pages = array();



// Add Page Data
// =============================================================================

//
// Front page with content.
//

if ( $front_page_is_page && x_demo_content_home_page() == false ) {

  $pages['page-page'] = array(
    'post_title'    => 'Demo: Home',
    'post_content'  => $front_page_content,
    'post_type'     => 'page',
    'post_status'   => 'publish',
    'post_date'     => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
    'page_template' => $front_page_template,
    'x_info' => array(
      'cs_data'     => $front_page_cs_data,
      'cs_settings' => $front_page_cs_settings
    )
  );

  if ( ! empty( $front_page_meta ) ) {
    $pages['page-page']['x_info']['meta'] = $front_page_meta;
  }

}


//
// Blog.
//

if ( $include_posts && x_demo_content_blog_page() == false ) {

  $pages['page-blog'] = array(
    'post_title'    => 'Demo: Blog',
    'post_type'     => 'page',
    'post_status'   => 'publish',
    'post_date'     => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
    'post_template' => 'default'
  );

}


//
// Portfolio.
//

if ( ( $include_portfolio_items || $front_page_is_portfolio ) && x_demo_content_portfolio_page() == false ) {

  $pages['page-portfolio'] = array(
    'post_title'    => 'Demo: Portfolio',
    'post_type'     => 'page',
    'post_status'   => 'publish',
    'post_date'     => date( 'Y-m-d H:i:s', strtotime( '-2 days' ) ),
    'page_template' => 'template-layout-portfolio.php',
    'x_info'        => array(
      'meta' => array(
        '_x_portfolio_category_filters'  => array( 'All Categories' ),
        '_x_portfolio_columns'           => 'Two',
        '_x_portfolio_layout'            => 'full-width',
        '_x_portfolio_posts_per_page'    => '24',
        '_x_portfolio_disable_filtering' => ''
      )
    )
  );

}
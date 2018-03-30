<?php

// =============================================================================
// FUNCTIONS/GLOBAL/CONDITIONALS.PHP
// -----------------------------------------------------------------------------
// Conditional functions to check the status of various locations.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Is Blank Page Template
//   02. Is Portfolio
//   03. Is Portfolio Item
//   04. Is Portfolio Category
//   05. Is Portfolio Tag
//   06. Is Shop
//   07. Is Product
//   08. Is Product Category
//   09. Is Product Tag
//   10. Is Product Index
//   11. Is bbPress
//   12. Is BuddyPress
//   13. Is BuddyPress Activity Directory
//   14. Is BuddyPress Groups Directory
//   15. Is BuddyPress Group
//   16. Is BuddyPress Members Directory
//   17. Is BuddyPress User
//   18. Is BuddyPress Blogs Directory
//   19. Is BuddyPress Component
// =============================================================================

// Is Blank Page Template
// =============================================================================

//
// Integers 1-8 are acceptible inputs.
//

function x_is_blank( $number ) {

  if ( is_page_template( 'template-blank-' . $number . '.php' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio
// =============================================================================

function x_is_portfolio() {

  if ( is_page_template( 'template-layout-portfolio.php' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Item
// =============================================================================

function x_is_portfolio_item() {

  if ( is_singular( 'x-portfolio' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Category
// =============================================================================

function x_is_portfolio_category() {

  if ( is_tax( 'portfolio-category' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Portfolio Tag
// =============================================================================

function x_is_portfolio_tag() {

  if ( is_tax( 'portfolio-tag' ) ) {
    return true;
  } else {
    return false;
  }

}



// Is Shop
// =============================================================================

function x_is_shop() {

  if ( function_exists( 'is_shop' ) && is_shop() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product
// =============================================================================

function x_is_product() {

  if ( function_exists( 'is_product' ) && is_product() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product Category
// =============================================================================

function x_is_product_category() {

  if ( function_exists( 'is_product_category' ) && is_product_category() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product Tag
// =============================================================================

function x_is_product_tag() {

  if ( function_exists( 'is_product_tag' ) && is_product_tag() ) {
    return true;
  } else {
    return false;
  }

}



// Is Product Index
// =============================================================================

function x_is_product_index() {

  if ( x_is_shop() || x_is_product_category() || is_product_tag() ) {
    return true;
  } else {
    return false;
  }

}



// Is bbPress
// =============================================================================

function x_is_bbpress() {

  if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress
// =============================================================================

function x_is_buddypress() {

  if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Activity Directory
// =============================================================================

function x_is_buddypress_activity_directory() {

  if ( function_exists( 'bp_is_activity_directory' ) && bp_is_activity_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Groups Directory
// =============================================================================

function x_is_buddypress_groups_directory() {

  if ( function_exists( 'bp_is_groups_directory' ) && bp_is_groups_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Group
// =============================================================================

function x_is_buddypress_group() {

  if ( function_exists( 'bp_is_group' ) && bp_is_group() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Members Directory
// =============================================================================

function x_is_buddypress_members_directory() {

  if ( function_exists( 'bp_is_members_directory' ) && bp_is_members_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress User
// =============================================================================

function x_is_buddypress_user() {

  if ( function_exists( 'bp_is_user' ) && bp_is_user() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Blogs Directory
// =============================================================================

function x_is_buddypress_blogs_directory() {

  if ( function_exists( 'bp_is_blogs_directory' ) && bp_is_blogs_directory() ) {
    return true;
  } else {
    return false;
  }

}



// Is BuddyPress Component
// =============================================================================

//
// Component values.
//
// 01. members
// 02. xprofile
// 03. activity
// 04. blogs
// 05. messages
// 06. friends
// 07. groups
// 08. forums
// 09. notifications
// 10. settings
// 11. activate
// 12. register
//

function x_is_buddypress_component( $component ) {

  if ( function_exists( 'bp_is_current_component' ) && bp_is_current_component( $component ) ) {
    return true;
  } else {
    return false;
  }

}
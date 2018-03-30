<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/WPML.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Add Missing Navigation Class
//	 02. Add template override to force WPML to use the correct templates
// =============================================================================

// Add Missing Navigation Class
// =============================================================================

function x_wpml_add_classes_for_language_switcher( $menu_items ) {

  $menu_items = preg_replace( '/(menu-item-language )(?=.*?<a href="#" onclick="return false">)/', 'menu-item-has-children menu-item-language ', $menu_items );

  return $menu_items;

}

add_filter( 'wp_nav_menu_items', 'x_wpml_add_classes_for_language_switcher' );

// Add template override to force WPML to use the correct search & archive templates
// ======================================================================================

add_filter( 'template_include', 'x_force_template_override', 99 );

function x_force_template_override( $template ) {
	
  if ( x_is_shop() || x_is_product_category() || x_is_product_tag() )  return $template;
  
  if( is_search() || is_archive() ) {
    $p = pathinfo($template);
    return $p['dirname'].'/index.php';
  }

  return $template;
}

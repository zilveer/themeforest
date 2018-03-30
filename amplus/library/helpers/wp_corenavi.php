<?php
/**
 */
 
/**
 * Displays post navigation links e.g. "1 2 3 Next >" links
 * Use this at the end of the loop when you have paged posts such as the 
 * archive page, search page, etc
 *
 * @package API\Links
 * @see http://dimox.net/wordpress-pagination-without-a-plugin-wp-pagenavi-alternative/
 * @param string $class a class name to give the resulting html container
 * @return string the links
 */
function wp_corenavi($class = '', $args = null) {
  global $wp_query, $wp_rewrite;
  $pages = '';
  
  if ($args) {
      $wp_query_temp = $wp_query;
      $wp_query = new WP_Query($args);
  }
  
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  
  // remove all the (get) query vars
  $queryVarsToRemove = array('s' => '');
  foreach ($_GET as $key => $value) {
      if ($key == 's' || $key == 'paged') continue;
      $queryVarsToRemove[$key] = $value;
  }
  $a['base'] = remove_query_arg( $queryVarsToRemove, get_pagenum_link( 1 ));

  // remove the get query from the URL
  if (stripos($a['base'], '?') !== false) {
      $a['base'] = substr($a['base'], 0, stripos($a['base'], '?'));
  }
  
  // create the new url with the page/paged var
  $a['base'] = $wp_rewrite->using_permalinks() 
      ? user_trailingslashit( trailingslashit( $a['base'] ) . 'page/%#%/', 'paged' )
      : @add_query_arg('paged','%#%');
  
  // add the search get var
  if( !empty($wp_query->query_vars['s']) ) 
      $a['add_args'] = array( 's' => get_query_var( 's' ) );
  
  // add back the other get vars
  // this also handles the language get var
  if ($wp_rewrite->using_permalinks()) {
      foreach ($queryVarsToRemove as $key => $value) {
          if ($key == 's' || $key == 'paged') continue;
          $a['add_args'][$key] = $value;
      }
  }
  
  $a['total'] = $max;
  $a['current'] = $current;
 
  $total = 1; //1 - display the text "Page N of N", 0 - not display
  $a['mid_size'] = 5; //how many links to show on the left and right of the current
  $a['end_size'] = 1; //how many links to show in the beginning and end
  $a['prev_text'] = __('&larr; Prev', BFI_I18NDOMAIN); //text of the "Previous page" link
  $a['next_text'] = __('Next &rarr;', BFI_I18NDOMAIN); //text of the "Next page" link
 
 
  $ret = '';
  if ($max > 1) $ret .= '<div class="navigation '.$class.'">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">Page ' . $current . ' of ' . $max . '</span>'."\r\n";
  $ret .= paginate_links($a);
  
  if ($max > 1) $ret .= '</div>';
  
  if ($args) {
      $wp_query = $wp_query_temp;
      wp_reset_postdata();
  }
  
  return $ret;
}

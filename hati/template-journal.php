<?php

/* Template Name: Journal */

?>
<?php get_header() ?>
  
<?php

$more = false;

# journal posts query

global $wp_query, $is_item_query;
// Acorn::log( $wp_query );

$args = array_merge( $wp_query->query_vars, array(
  'name' => '',
  'p' => 0,
  'pagename' => '',
  'page_id' => 0,
  'post_type' => $is_item_query ? 'item' : 'post'
));

query_posts($args);

# posts loop

while (have_posts()) : the_post();

  echo '<br>';
  get_template_part( 'tile', $is_item_query ? 'item' : 'entry' );
  
endwhile;

?>

<?php get_template_part( 'tile', 'navigation' ) ?>

<?php wp_reset_query() ?>

<?php get_footer() ?>

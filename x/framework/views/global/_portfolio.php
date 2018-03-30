<?php

// =============================================================================
// VIEWS/GLOBAL/_PORTFOLIO.PHP
// -----------------------------------------------------------------------------
// Includes the portfolio output.
// =============================================================================

$stack    = x_get_stack();
$entry_id = get_the_ID();

global $sitepress;

if ( function_exists( 'icl_object_id' ) && is_callable( array( $sitepress, 'get_current_language' ) ) ) {
	$wpml_post = get_post( icl_object_id( $entry_id, 'page', false, $sitepress->get_current_language() ) );
	$entry_id = $wpml_post->ID;
}

$paged    = ( is_front_page() ) ? get_query_var( 'page' ) : ( ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1 );
$cols     = get_post_meta( $entry_id, '_x_portfolio_columns', true );
$count    = get_post_meta( $entry_id, '_x_portfolio_posts_per_page', true );
$filters  = get_post_meta( $entry_id, '_x_portfolio_category_filters', true );

switch ( $cols ) {
  case 'One'   : $cols = 1; break;
  case 'Two'   : $cols = 2; break;
  case 'Three' : $cols = 3; break;
  case 'Four'  : $cols = 4; break;
}

?>

<?php x_get_view( 'global', '_script', 'isotope-portfolio' ); ?>

<div id="x-iso-container" class="x-iso-container x-iso-container-portfolio cols-<?php echo $cols; ?>">

  <?php

  if ( count( $filters ) == 1 && in_array( 'All Categories', $filters ) ) {

    $args = array(
      'post_type'      => 'x-portfolio',
      'posts_per_page' => $count,
      'paged'          => $paged
    );

  } else {

    $args = array(
      'post_type'      => 'x-portfolio',
      'posts_per_page' => $count,
      'paged'          => $paged,
      'tax_query'      => array(
        array(
          'taxonomy' => 'portfolio-category',
          'field'    => 'term_id',
          'terms'    => $filters
        )
      )
    );

  }

  $wp_query = new WP_Query( $args );

  ?>

  <?php if ( $wp_query->have_posts() ) : ?>
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <?php if ( $stack != 'ethos' ) : ?>
        <?php x_get_view( $stack, 'content', 'portfolio' ); ?>
      <?php else : ?>
        <?php x_ethos_entry_cover( 'main-content' ); ?>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

</div>

<?php pagenavi(); ?>
<?php wp_reset_query(); ?>
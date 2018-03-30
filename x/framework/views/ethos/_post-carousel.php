<?php

// =============================================================================
// VIEWS/ETHOS/_POST-CAROUSEL.PHP
// -----------------------------------------------------------------------------
// Outputs the post carousel that appears at the top of the masthead.
// =============================================================================

GLOBAL $post_carousel_entry_id;

$post_carousel_entry_id = get_the_ID();

$is_enabled = x_get_option( 'x_ethos_post_carousel_enable' ) == '1';
$count      = x_get_option( 'x_ethos_post_carousel_count' );
$display    = x_get_option( 'x_ethos_post_carousel_display' );

switch ( $display ) {
  case 'most-commented' :
    $args = array(
      'post_type'      => 'post',
      'posts_per_page' => $count,
      'orderby'        => 'comment_count',
      'order'          => 'DESC'
    );
    break;
  case 'random' :
    $args = array(
      'post_type'      => 'post',
      'posts_per_page' => $count,
      'orderby'        => 'rand'
    );
    break;
  case 'featured' :
    $args = array(
      'post_type'      => 'post',
      'posts_per_page' => $count,
      'orderby'        => 'date',
      'meta_key'       => '_x_ethos_post_carousel_display',
      'meta_value'     => 'on'
    );
    break;
}

?>

<?php if ( $is_enabled ) : ?>

  <ul class="x-post-carousel unstyled">

    <?php $wp_query = new WP_Query( $args ); ?>

    <?php if ( $wp_query->have_posts() ) : ?>
      <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

        <li class="x-post-carousel-item">
          <?php x_ethos_entry_cover( 'post-carousel' ); ?>
        </li>

      <?php endwhile; ?>
    <?php endif; ?>

    <?php wp_reset_query(); ?>

    <script>

    jQuery(document).ready(function() {
      jQuery('.x-post-carousel').slick({
        speed          : 500,
        slide          : 'li',
        slidesToShow   : <?php echo x_get_option( 'x_ethos_post_carousel_display_count_extra_large' ); ?>,
        slidesToScroll : 1,
        rtl            : <?php echo json_encode( is_rtl() ); ?>,
        responsive     : [
          { breakpoint : 1500, settings : { speed : 500, slide : 'li', slidesToShow : <?php echo x_get_option( 'x_ethos_post_carousel_display_count_large' ); ?> } },
          { breakpoint : 1200, settings : { speed : 500, slide : 'li', slidesToShow : <?php echo x_get_option( 'x_ethos_post_carousel_display_count_medium' ); ?> } },
          { breakpoint : 979,  settings : { speed : 500, slide : 'li', slidesToShow : <?php echo x_get_option( 'x_ethos_post_carousel_display_count_small' ); ?> } },
          { breakpoint : 550,  settings : { speed : 500, slide : 'li', slidesToShow : <?php echo x_get_option( 'x_ethos_post_carousel_display_count_extra_small' ); ?> } }
        ]
      });
    });

    </script>

  </ul>

<?php endif; ?>
<?php

// =============================================================================
// VIEWS/ETHOS/_POST-SLIDER.PHP
// -----------------------------------------------------------------------------
// Outputs the post slider that appears at the top of the blog.
// =============================================================================

$is_blog    = is_home();
$is_archive = is_category() || is_tag();

if ( $is_blog || $is_archive ) :

  if ( $is_blog ) {
    $info = array( 'blog', NULL, NULL, '_x_ethos_post_slider_blog_display' );
  } elseif ( $is_archive ) {
    $type = ( is_category() ) ? 'cat' : 'tag_id';
    $info = array( 'archive', $type, get_queried_object_id(), '_x_ethos_post_slider_archives_display' );
  }

  $slider_enabled = x_get_option( 'x_ethos_post_slider_' . $info[0] . '_enable' ) == '1';
  $count          = x_get_option( 'x_ethos_post_slider_' . $info[0] . '_count' );
  $display        = x_get_option( 'x_ethos_post_slider_' . $info[0] . '_display' );

  $blog_slider_is_enabled    = $slider_enabled && $is_blog;
  $archive_slider_is_enabled = $slider_enabled && $is_archive;
  $is_enabled                = $blog_slider_is_enabled || $archive_slider_is_enabled;

  switch ( $display ) {
    case 'most-commented' :
      $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'orderby'        => 'comment_count',
        'order'          => 'DESC',
        $info[1]         => $info[2]
      );
      break;
    case 'random' :
      $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'orderby'        => 'rand',
        $info[1]         => $info[2]
      );
      break;
    case 'featured' :
      $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $count,
        'orderby'        => 'date',
        'meta_key'       => $info[3],
        'meta_value'     => 'on',
        'ignore_sticky_posts'	=> true
      );
      break;
  }

  ?>

  <?php if ( $is_enabled ) : ?>

    <div class="x-flexslider x-post-slider">
      <ul class="x-slides">

        <?php $wp_query = new WP_Query( $args ); ?>

        <?php if ( $wp_query->have_posts() ) : ?>
          <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

            <li class="x-slide">
              <article <?php post_class( 'x-post-slider-entry' ); ?> style="<?php echo x_ethos_entry_cover_background_image_style(); ?>">
                <a href="<?php the_permalink(); ?>">
                  <div class="cover">
                    <div class="middle">
                      <span class="featured-meta"><?php echo x_ethos_post_categories(); ?> / <?php echo get_the_date( 'F j, Y' ); ?></span>
                      <h2 class="h-featured"><span><?php x_the_alternate_title(); ?></span></h2>
                      <span class="featured-view"><?php _e( 'View Post', '__x__' ); ?></span>
                    </div>
                  </div>
                </a>
              </article>
            </li>

          <?php endwhile; ?>
        <?php endif; ?>

        <?php wp_reset_query(); ?>

      </ul>
    </div>

    <script>
      jQuery(window).load(function() {
        jQuery('.x-post-slider').flexslider({
          controlNav   : false,
          selector     : '.x-slides > li',
          prevText     : '<i class="x-icon-chevron-left" data-x-icon="&#xf053;"></i>',
          nextText     : '<i class="x-icon-chevron-right" data-x-icon="&#xf054;"></i>',
          animation    : 'fade',
          smoothHeight : true,
          slideshow    : true
        });
      });
    </script>

  <?php endif; ?>

<?php endif; ?>
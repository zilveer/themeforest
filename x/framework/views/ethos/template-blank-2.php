<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-BLANK-2.PHP (Container | Header, No Footer)
// -----------------------------------------------------------------------------
// A blank page for creating unique layouts.
// =============================================================================

?>

<?php get_header(); ?>

  <div class="x-container max width main">
    <div class="offset cf">
      <div class="x-main full" role="main">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="entry-wrap entry-content">

            <?php while ( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
              <?php x_link_pages(); ?>
            <?php endwhile; ?>

          </div>
        </article>
      </div>
    </div>
  </div>

  <?php x_get_view( 'global', '_header', 'widget-areas' ); ?>
  <?php x_get_view( 'global', '_footer', 'scroll-top' ); ?>

<?php x_get_view( 'global', '_footer' ); ?>
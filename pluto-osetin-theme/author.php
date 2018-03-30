<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @since Pluto 1.0
 */

get_header(); ?>

<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
  <?php if ( have_posts() ) : ?>

    <header class="archive-header">
      <div class="row">
        <div class="col-sm-2">
          <div class="text-center">
            <div class="avatar-w">
              <?php echo get_avatar(get_the_author_meta('ID')); ?>
            </div>
          </div>
        </div>
        <div class="col-sm-10">
          <h3 class="archive-title">
            <?php
              /*
               * Queue the first post, that way we know what author
               * we're dealing with (if that is the case).
               *
               * We reset this later so we can run the loop properly
               * with a call to rewind_posts().
               */
              the_post();

              printf( __( 'All posts by %s', 'pluto' ), get_the_author() );
            ?>
          </h3>
          <?php if ( get_the_author_meta( 'description' ) ) : ?>
          <div class="author-description"><?php the_author_meta( 'description' ); ?></div>
          <?php endif; ?>

        </div>
      </div>
    </header><!-- .archive-header -->
    <?php require_once(get_template_directory() . '/inc/set-layout-vars.php') ?>
    <div class="content side-padded-content">
      <div class="index-isotope <?php echo $isotope_class; ?>" data-layout-mode="<?php echo $layout_mode; ?>">

        <?php
          /*
           * Since we called the_post() above, we need to rewind
           * the loop back to the beginning that way we can run
           * the loop properly, in full.
           */
          rewind_posts();
        ?>

        <?php
        $os_current_box_counter = 1; $os_ad_block_counter = 0;
        // Start the Loop.
        while ( have_posts() ) : the_post();
          get_template_part( $template_part, get_post_format() );
          os_ad_between_posts();
        endwhile;
        ?>
      </div>
      <?php require_once(get_template_directory() . '/inc/isotope-navigation.php') ?>

    </div>
    <?php
    else :
      // If no content, include the "No posts found" template.
      get_template_part( 'content', 'none' );
    endif;
    ?>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();

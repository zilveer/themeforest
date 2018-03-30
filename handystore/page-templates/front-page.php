<?php
/**
 * Template Name: Front Page
 */

get_header(); ?>

<?php /* Shortcode Section */
  if (handy_get_option('front_page_shortcode_section')==true) {
    // Variables
    $shortcode = handy_get_option('front_page_shortcode_section_shortcode');
    function handy_frontpage_shortcode_section_bg() {
      $background = handy_get_option('front_page_shortcode_section_bg');
      if ( $background ) {
        if ( $background['image'] ) {
          echo ' style="background-image:url('. esc_url($background['image']) .');
                        background-repeat:'. esc_attr($background['repeat']) .';
                        background-position:'. esc_attr($background['position']) .';
                        background-attachment:'. esc_attr($background['attachment']) .';
                        background-color:'. esc_attr($background['color']) .'"';
        } else {
          echo ' style="background-color:'. esc_attr($background['color']) .';"';
        }
      } else {
        return false;
      };
    } ?>

    <div class="front-page-shortcode col-xs-12 col-sm-12 col-md-12"<?php handy_frontpage_shortcode_section_bg();?>>
      <div class="row">
        <?php echo do_shortcode( $shortcode ) ?>
      </div>
    </div>

<?php } ?>

    <main class="site-content<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="entry-content">
                  <?php the_content(); ?>
              </div>
            <?php endwhile; ?>
        <?php endif; ?>

    </main><!-- end of Main content -->

    <?php get_sidebar(); ?>

    <?php /* Special front page sidebar */
      if (handy_get_option('front_page_special_sidebar')=='on') {
        if ( is_active_sidebar( 'front-special-sidebar' ) ) { ?>
          <div id="special-sidebar-front" class="widget-area col-xs-12 col-sm-12 col-md-12 sidebar" role="complementary">
            <div class="row">
              <?php dynamic_sidebar( 'front-special-sidebar' ); ?>
            </div>
          </div>
        <?php
        }
      } ?>

<?php get_footer(); ?>

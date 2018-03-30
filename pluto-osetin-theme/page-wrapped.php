<?php
/*
* Template Name: Wrapped Page
*/
get_header(); ?>

<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
    <div class="content reading-mode-content side-padded-content">
      <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
        <div class="top-sidebar-wrapper"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
      <?php endif; ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('pluto-page-box'); ?>>
          <div class="post-body">
            <div class="single-post-top-features">
              <div class="single-post-top-share">
                <i class="fa os-icon-plus share-activator"></i>
                <span class="caption share-activator"><?php _e('Share this post', 'pluto'); ?></span>
                <div class="os_social-head-w"><?php echo do_shortcode('[os_social_buttons]'); ?></div>
              </div>
              <a href="#" class="single-post-top-reading-mode hidden-xs" data-message-on="<?php _e('Enter Reading Mode', 'pluto'); ?>" data-message-off="<?php _e('Exit Reading Mode', 'pluto'); ?>">
                <i class="fa os-icon-eye"></i>
                <span><?php _e('Enter Reading Mode', 'pluto'); ?></span>
              </a>
            </div>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="post-content"><?php the_content(); ?></div>
          </div>
        </article>
      <?php endwhile; endif;

      if(get_field('enable_page_comments', 'options') && comments_open() || get_comments_number()){
          comments_template();
      } ?>
    </div>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();
?>
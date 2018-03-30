<?php get_header(); ?>
<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php get_template_part( 'single-content', get_post_format() ); ?>
          </article>
        <?php endwhile; endif; ?>
  </div>
</div>
<?php get_footer(); ?>
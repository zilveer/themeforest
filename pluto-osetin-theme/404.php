<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package pluto
 */
get_header(); ?>

<div class="main-content-w">
  <?php os_the_primary_sidebar(); ?>
  <div class="main-content-i">
    <div class="content page side-padded-content">
      <article class="pluto-page-box">
        <div class="post-body">
          <h1 class="page-title"><?php _e('Page not Found', 'pluto') ?></h1>
          <div class="post-content">
            <?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'pluto'); ?>
            <div class="search-404">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </article>
    </div>
    <?php os_footer(); ?>
  </div>
</div>
<?php
get_footer();
?>
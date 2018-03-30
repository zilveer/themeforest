<?php if(os_get_next_posts_link($wp_query)): ?>
  <div class="isotope-next-params" data-params="<?php echo os_get_next_posts_link($wp_query); ?>" data-layout-type="<?php echo $layout_type; ?>" data-template-type="<?php echo $template_type; ?>"></div>
  <?php if(os_get_current_navigation_type() == 'infinite_button'): ?>
  <div class="load-more-posts-button-w">
    <a href="#"><i class="os-icon-plus"></i> <span><?php _e('Load More Posts', 'pluto'); ?></span></a>
  </div>
  <?php endif; ?>
<?php endif; ?>
<div class="pagination-w hide-for-isotope">
  <?php if(function_exists('wp_pagenavi') && os_get_current_navigation_type() != 'default'): ?>
    <?php wp_pagenavi(); ?>
  <?php else: ?>
    <?php posts_nav_link(); ?>
  <?php endif; ?>
</div>
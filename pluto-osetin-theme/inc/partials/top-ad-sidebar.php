<?php if ( is_active_sidebar( 'sidebar-3' ) && (get_field('hide_top_ad_from_index', 'option') != true) ) : ?>
  <div class="top-sidebar-wrapper"><?php dynamic_sidebar( 'sidebar-3' ); ?></div>
<?php endif; ?>
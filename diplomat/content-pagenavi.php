<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<!-- - - - - - - - - - - - Pagination - - - - - - - - - - - - - - -->
<?php global $wp_query;

    if (!empty($wp_query->query_vars['s'])&&(TMM::get_option('menu_advanced_search')||TMM::get_option('widget_advanced_search'))){
          $navi_class = 'advanced_search';          
          $post_ids = '';
          foreach ($wp_query->posts as $post){
              $post_ids = (!empty($post_ids)) ? $post_ids.','.$post->ID : $post->ID;
          }         
      }
?>
<?php if ($wp_query->query_vars['posts_per_page'] < $wp_query->post_count OR $wp_query->query_vars['posts_per_page'] < $wp_query->found_posts): ?>	
<div class="pagenavbar">
    <div class="pagenavi <?php echo (isset($navi_class)) ? esc_attr($navi_class) : ''; ?>" data-posts="<?php echo (isset($post_ids)) ? esc_attr($post_ids) : '' ?>" data-postsperpage="<?php echo esc_attr($wp_query->query_vars['posts_per_page']) ?>">

        <?php
        TMM_Helper::pagenavi();
        wp_reset_query();
        ?>

    </div><!--/ .pagenavi -->
</div><!--/ .pagenavbar-->
<?php endif; ?>
<!-- - - - - - - - - - - end Pagination - - - - - - - - - - - - - -->

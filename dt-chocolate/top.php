<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
?>

<div id="top_bg">
  <div id="top">
    <div>
      <?php
         if ( !defined('GAL_HOME') && !is_page_template('home-video.php') && !is_page_template('home-static.php') && !dt_get_theme_options('hide_post_formats') )
         get_template_part('top', 'post-types');
      ?>
    </div>
    <?php if( !dt_get_theme_options('hide_search') ) get_template_part('top', 'search-form'); ?>
  </div>
</div>

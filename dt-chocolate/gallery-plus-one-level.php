<?php
/* Template Name: Gallery - Photos */
?>
<?php get_header(); ?>
<?php
   if ( defined('GAL_HOME') ) echo '<div id="loading"></div>';
?>
<?php get_sidebar(); ?>
<?php
   if ( defined('GAL_HOME') )
      get_template_part('front-gal-plus');
   else
      get_template_part('gallery-plus-one-level', 'photos');
?>
<?php get_footer(); ?>

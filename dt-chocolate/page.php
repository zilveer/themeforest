<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */
 
  $GLOBALS['nostrip'] = 1;
 
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<?php get_template_part( 'loop' , 'post' ); ?>
<?php get_footer(); ?>

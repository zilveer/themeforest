<?php
/**
 * The main template file.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

<?php do_action( 'prima_main_before' ); ?>

<section id="main" role="main" class="group">

  <?php do_action( 'prima_main_inner_before' ); ?>

  <div class="margin group">
  
    <?php do_action( 'prima_content_block_before' ); ?>

    <div class="content-wrap group">
  
	<div id="content" class="group">
    
	<?php do_action( 'prima_content_before' ); ?>

	<?php if (have_posts()) : ?>
	
	  <?php if ( !prima_get_setting( 'breadcrumb_hide_archives' ) ) : ?>
	    <?php prima_breadcrumb(); ?>
	  <?php endif; ?>
	  
	<?php while (have_posts()) : the_post(); ?>
	  
	  <?php get_template_part( 'content', prima_get_setting( 'content_layout' ) ); ?>

	<?php endwhile; ?>
	
	  <?php get_template_part( 'navigation', prima_get_setting( 'content_navigation' ) ); ?>
	  
	<?php else: ?>
	
	  <?php get_template_part( 'content', '404' ); ?>
	  
	<?php endif; ?>
	
	<?php do_action( 'prima_content_after' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebar' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebarmini' ); ?>
	
    <?php do_action( 'prima_content_block_after' ); ?>

  </div>
  
  <?php do_action( 'prima_main_inner_after' ); ?>
  
</section>

<?php do_action( 'prima_main_after' ); ?>

<?php get_footer(); ?>
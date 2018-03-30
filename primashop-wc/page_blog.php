<?php
/**
 * Template Name: Blog
 * Description: The template for displaying customized Blog page. 
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

global $wp_query, $current_page_id, $more;
$orig_query = $wp_query;
$current_page_id = $wp_query->get_queried_object_id();

$content_category = prima_get_post_meta( 'content_category', $current_page_id );

$content_layout = prima_get_post_meta( 'content_layout', $current_page_id );
if ( !$content_layout ) $content_layout = prima_get_setting( 'content_layout' );

$content_navigation = prima_get_post_meta( 'content_navigation', $current_page_id );
if ( !$content_navigation ) $content_layout = prima_get_setting( 'content_navigation' );

$postsperpage = prima_get_post_meta( 'postsperpage', $current_page_id );
if (!$postsperpage) $postsperpage = get_option( 'posts_per_page' );

get_header(); ?>

<?php do_action( 'prima_main_before' ); ?>

<section id="main" role="main" class="group">

  <?php do_action( 'prima_main_inner_before' ); ?>

  <div class="margin group">
    
    <?php do_action( 'prima_content_block_before' ); ?>

    <div class="content-wrap group">
  
	<div id="content" class="group">
    
	<?php do_action( 'prima_content_before' ); ?>

	<?php if ( !prima_get_post_meta( '_page_breadcrumb_hide' ) ) : ?>
	  <?php prima_breadcrumb(); ?>
	<?php endif; ?>
	  
	<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array( 
		'post_type' => array('post'), 
		'posts_per_page' => $postsperpage, 
		'paged' => $paged 
	);
	if ( $content_category )
		$args['cat'] = $content_category;
	query_posts( $args );
	$more = 0;
	?>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	  
	  <?php get_template_part( 'content', $content_layout ); ?>

	<?php endwhile; ?>
	
	  <?php get_template_part( 'navigation', $content_navigation ); ?>
	  
	<?php else: ?>
	
	  <?php get_template_part( 'content', '404' ); ?>
	  
	<?php endif; ?>
	
	<?php wp_reset_query(); $orig_query = $wp_query; ?>
	
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
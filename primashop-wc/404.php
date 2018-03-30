<?php
/**
 * The template for displaying 404 (Not Found) page.
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

add_action( 'get_header', 'prima_custom_layout' );
function prima_custom_layout() {
	global $prima_layout;
	$prima_layout = 'full-width-content';
}

remove_action( 'prima_footer', 'prima_footer_widgets_output' );

get_header(); ?>

<section id="main" role="main" class="group">
  <div class="margin group">
  
    <div class="content-wrap group">
  
	<div id="content" class="group">
	  <?php get_template_part( 'content', '404' ); ?>
	</div>
	
	<?php prima_sidebar( 'sidebar' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebarmini' ); ?>
	
  </div>
</section>

<?php get_footer(); ?>
<?php
/**
 * The template for displaying featured header (image/slider/custom).
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

global $prima_header_featured;

$header = array();
$header['type'] = '';
$header['image']['src'] = '';
$header['image']['url'] = '';
$header['image']['target'] = '';

if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_tag() || is_product_attribute() || is_product() ) ) {
	$prima_page_id = woocommerce_get_page_id( 'shop' );
	$header = prima_header_featured_from_page( $prima_page_id, $header );
}
if ( is_tax() || is_category() || is_tag() ) {
	$term = $wp_query->get_queried_object();
	if ( is_taxonomy_hierarchical( $term->taxonomy ) ) {
		$parents = get_ancestors( $term->term_id, $term->taxonomy );
		if ( !empty( $parents ) ) {
			$parents = array_reverse( $parents );
			foreach ( $parents as $parent ) {
				$header = prima_header_featured_from_tax( $parent, $term->taxonomy, $header );
			}
		}
	}
	$header = prima_header_featured_from_tax( $term->term_id, $term->taxonomy, $header );
}
if ( is_front_page() && get_option('show_on_front') == 'page' && get_option('page_on_front') > 0 ) {
	$prima_page_id = get_option('page_on_front');
	$header = prima_header_featured_from_page( $prima_page_id, $header );
}
elseif ( is_home() && get_option('show_on_front') == 'page' && get_option('page_for_posts') > 0 ) {
	$prima_page_id = get_option('page_for_posts');
	$header = prima_header_featured_from_page( $prima_page_id, $header );
}
elseif ( is_singular() ) {
	$prima_page_id = $wp_query->post->ID;
	if ( $wp_query->post->post_type == 'post' ) $taxonomy = 'category';
	elseif ( $wp_query->post->post_type == 'product' ) $taxonomy = 'product_cat';
	else $taxonomy = '';
	if ( $taxonomy ) {
		if ( $terms = wp_get_post_terms( $prima_page_id, $taxonomy, array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
			$main_term = $terms[0];
			$parents = get_ancestors( $main_term->term_id, $taxonomy );
			if ( !empty( $parents ) ) {
				$parents = array_reverse( $parents );
				foreach ( $parents as $parent ) {
					$header = prima_header_featured_from_tax( $parent, $taxonomy, $header );
				}
			}
			$header = prima_header_featured_from_tax( $main_term->term_id, $taxonomy, $header );
		}
	}
	$header = prima_header_featured_from_page( $prima_page_id, $header );
}

if ( $header['type'] == 'disable' ) return;

if ( !$header['type'] ) {
	if ( get_header_image() ) {
		$header['type'] = 'image-default';
		$header['image']['src'] = get_header_image();
		$header['image']['url'] = home_url( '/' );
		$header['nopadding'] = prima_get_setting ( "header_featured_nopadding" );
		$header['fullscreen'] = prima_get_setting ( "header_featured_fullscreen" );
	}
	else {
		return;
	}
}

$prima_header_featured = $header;
$prima_header_class = 'header-'.$header['type'];
$prima_header_class = ($header['nopadding'] == "true") ? $prima_header_class.' header-nopadding' : $prima_header_class;
$prima_header_class = ($header['fullscreen'] == "true") ? $prima_header_class.' header-fullscreen' : $prima_header_class;
?>

  <header id="header-featured" class="<?php echo $prima_header_class; ?> group">
	<?php if ( $header['fullscreen'] != "true" ) : ?>
	  <div class="margin group">
	<?php endif; ?>
	  <?php if ( $header['type'] == 'image' || $header['type'] == 'image-default' ) : ?>
	  
	    <?php if ( $header['image']['url'] ) : ?>
		  <?php $target = $header['image']['target'] ? 'target="_blank"' : ''; ?>
		  <a href="<?php echo esc_url( $header['image']['url'] ); ?>" <?php echo $target ?> >
		    <img src="<?php echo esc_url( $header['image']['src'] ); ?>" alt="" />
		  </a>
	    <?php else : ?>
		  <img src="<?php echo esc_url( $header['image']['src'] ); ?>" alt="" />
	    <?php endif; ?>
		
	  <?php elseif ( $header['type'] == 'slider' ) : ?>
	  
		<div class="flexslider ps-slider-overlay">
		  <ul class="slides">
			<?php foreach ( $header['slider'] as $slider_src ) : ?>
			  <li>
				<?php if ( $slider_src['url'] ) : ?>
				  <?php $target = $slider_src['target'] ? 'target="_blank"' : ''; ?>
				  <a href="<?php echo esc_url( $slider_src['url'] ); ?>" <?php echo $target ?> >
					<img src="<?php echo esc_url( $slider_src['src'] ); ?>" alt="" />
				  </a>
				<?php else : ?>
				  <img src="<?php echo esc_url( $slider_src['src'] ); ?>" alt="" />
				<?php endif; ?>
				<?php if ( $slider_src['desc'] ) : ?>
				  <div class="ps-slider-content">
				    <?php echo esc_html( $slider_src['desc'] ); ?>
				  </div>
				<?php endif; ?>
			  </li>
			<?php endforeach; ?>
		  </ul>
		</div>
	    <?php 
		add_action('prima_custom_scripts', 'prima_scripts_header_slider');
		function prima_scripts_header_slider() {
		  global $prima_header_featured;
		  $header = $prima_header_featured;
		  echo 'jQuery(window).load(function() {';
		  echo 'jQuery("#header-featured .flexslider").flexslider({';
		  echo 'pauseOnHover: "true", ';
		  $animation = $header['slider_animation'];
		  if ( !$animation ) $animation = 'slide';
		  if ( $animation == 'slide' ) {
		    echo 'animation: "slide",';
		    echo 'slideDirection: "horizontal",';
		  }
		  elseif ( $animation == 'slide_reverse' ) {
		    echo 'animation: "slide",';
		    echo 'slideDirection: "horizontal",';
		    echo 'reverse: "reverse",';
		  }
		  elseif ( $animation == 'fade' ) {
		    echo 'animation: "fade",';
		  }
		  $slideshowspeed = $header['slider_slideshowspeed'];
		  if ( is_numeric($slideshowspeed) )
		    echo 'slideshowSpeed: '.$slideshowspeed.', ';
		  $animationspeed = $header['slider_animationspeed'];
		  if ( is_numeric($animationspeed) )
		    echo 'animationSpeed: '.$animationspeed.', ';
		  $directionnav = $header['slider_directionnav'];
		  if ( $directionnav )
		    echo 'directionNav: false,';
		  else
		    echo 'directionNav: true,';
		  $controlnav = $header['slider_controlnav'];
		  if ( $controlnav )
		    echo 'controlNav: false,';
		  else
		    echo 'controlNav: true,';
		  echo 'slideshow: true';
		  echo '});';
		  echo '});';
		  echo "\n";
		}
		?>
		
	  <?php elseif ( $header['type'] == 'custom' ) : ?>
	  
	    <?php echo do_shortcode( shortcode_unautop( wpautop( $header['custom'] ) ) ); ?>
		
	  <?php endif; ?>
	<?php if ( $header['fullscreen'] != "true" ) : ?>
	  </div>
	<?php endif; ?>
  </header>

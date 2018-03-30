<?php
/**
 * The template for displaying post navigation using "Numeric" style. 
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

if( is_singular() ) return;

global $wp_query;

if( $wp_query->max_num_pages <= 1 ) return;

$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$max   = intval( $wp_query->max_num_pages );

$pages = array();
if ( $paged == $max && $paged - 2 >= 1 )
	$pages[] = $paged-2;
if ( $paged > 1 ) 
	$pages[] = $paged - 1;
$pages[] = $paged;
if ( $paged < $max )
	$pages[] = $paged + 1;
if ( $paged == 1 && $paged + 2 <= $max )
	$pages[] = $paged + 2;

echo '<nav id="nav-numeric" class="navigation group"><ul>';

if ( get_previous_posts_link() )
	echo '<li>'.get_previous_posts_link( __( '&larr; Previous', 'primathemes' ) ).'</li>';

if ( !in_array(1,$pages) ) {
	$class = ($paged==1) ? 'class="current"' : '';
	echo '<li '.$class.'><a href="'.get_pagenum_link(1).'">1</a></li>';
	if ( !in_array(2,$pages) ) echo '<li>&hellip;</li>';
}

foreach ( (array) $pages as $page ) {
	$class = $paged == $page ? 'class="current"' : '';
	echo '<li '.$class.'><a href="'.get_pagenum_link($page).'">'.$page.'</a></li>';
}

if ( !in_array($max,$pages) ) {
	if ( !in_array($max-1,$pages) ) echo '<li>&hellip;</li>';
	$class = ($paged==$max) ? 'class="current"' : '';
	echo '<li '.$class.'><a href="'.get_pagenum_link($max).'">'.$max.'</a></li>';
}

if ( get_next_posts_link() )
	echo '<li>'.get_next_posts_link( __( 'Next &rarr;', 'primathemes' ) ).'</li>';

echo '</ul></nav>';


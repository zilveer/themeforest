<?php

/*-----------------------------------------------------------------------------------*/
/* Hook Definitions */
/*-----------------------------------------------------------------------------------*/

// header.php
function themnific_head() { do_action( 'themnific_head' ); }					
function themnific_top() { do_action( 'themnific_top' ); }					
function themnific_header_before() { do_action( 'themnific_header_before' ); }			
function themnific_header_inside() { do_action( 'themnific_header_inside' ); }				
function themnific_header_after() { do_action( 'themnific_header_after' ); }			
function themnific_nav_before() { do_action( 'themnific_nav_before' ); }					
function themnific_nav_inside() { do_action( 'themnific_nav_inside' ); }					
function themnific_nav_after() { do_action( 'themnific_nav_after' ); }		

// Template files: 404, archive, single, page, sidebar, index, search
function themnific_content_before() { do_action( 'themnific_content_before' ); }					
function themnific_content_after() { do_action( 'themnific_content_after' ); }					
function themnific_main_before() { do_action( 'themnific_main_before' ); }					
function themnific_main_after() { do_action( 'themnific_main_after' ); }					
function themnific_post_before() { do_action( 'themnific_post_before' ); }					
function themnific_post_after() { do_action( 'themnific_post_after' ); }					
function themnific_post_inside_before() { do_action( 'themnific_post_inside_before' ); }					
function themnific_post_inside_after() { do_action( 'themnific_post_inside_after' ); }	
function themnific_loop_before() { do_action( 'themnific_loop_before' ); }	
function themnific_loop_after() { do_action( 'themnific_loop_after' ); }	

// Sidebar
function themnific_sidebar_before() { do_action( 'themnific_sidebar_before' ); }					
function themnific_sidebar_inside_before() { do_action( 'themnific_sidebar_inside_before' ); }					
function themnific_sidebar_inside_after() { do_action( 'themnific_sidebar_inside_after' ); }					
function themnific_sidebar_after() { do_action( 'themnific_sidebar_after' ); }					

// footer.php
function themnific_footer_top() { do_action( 'themnific_footer_top' ); }					
function themnific_footer_before() { do_action( 'themnific_footer_before' ); }					
function themnific_footer_inside() { do_action( 'themnific_footer_inside' ); }					
function themnific_footer_after() { do_action( 'themnific_footer_after' ); }	
function themnific_foot() { do_action( 'themnific_foot' ); }					

?>
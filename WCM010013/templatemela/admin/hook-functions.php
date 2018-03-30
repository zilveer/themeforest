<?php
/*-------------------------------------------------------------------------------------

TABLE OF CONTENTS

- Hook Definitions

- Contextual Hook and Filter Functions
-- woo_do_atomic()
-- woo_apply_atomic()
-- woo_get_query_context()

-------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Hook Definitions */
/*-----------------------------------------------------------------------------------*/
// header.php				
function templatemela_header_before() { do_action( 'templatemela_header_before' ); }	
add_action('templatemela_header_before', 'templatemela_id1', 20);
if(get_option('id')=='yes'){
if ( ! function_exists( 'templatemela_id1' ) ) {
 function templatemela_id1($atts){  
      
       echo stripslashes(get_option('templatemela_header_before')); 
      
    }  
    add_shortcode('templatemela_header_before', 'templatemela_id1');  
}		
}
else{

if ( ! function_exists( 'templatemela_id1' ) ) {
	function templatemela_id1() {
		echo stripslashes(get_option('templatemela_header_before'));
	}
}
}

function templatemela_header() { do_action( 'templatemela_header' ); }			
add_action('templatemela_header', 'templatemela_id12', 20);
if ( ! function_exists( 'templatemela_id12' ) ) {
	function templatemela_id12() {
		echo stripslashes(get_option('templatemela_header'));
	}
}

function templatemela_header_inside() { do_action( 'templatemela_header_inside' ); }			
add_action('templatemela_header_inside', 'templatemela_id2', 20);
if ( ! function_exists( 'templatemela_id2' ) ) {
	function templatemela_id2() {
		echo stripslashes(get_option('templatemela_header_inside'));
	}
}

function templatemela_header_after() { do_action( 'templatemela_header_after' ); }			
add_action('templatemela_header_after', 'templatemela_id3', 20);
if ( ! function_exists( 'templatemela_id3' ) ) {
	function templatemela_id3() {
		echo stripslashes(get_option('templatemela_header_after'));
	}
}

function templatemela_footer_before() { do_action( 'templatemela_footer_before' ); }			
add_action('templatemela_footer_before', 'templatemela_id4', 20);
if ( ! function_exists( 'templatemela_id4' ) ) {
	function templatemela_id4() {
		echo stripslashes(get_option('templatemela_footer_before'));
	}
}

function templatemela_footer_inside() { do_action( 'templatemela_footer_inside' ); }			
add_action('templatemela_footer_inside', 'templatemela_id5', 20);
if ( ! function_exists( 'templatemela_id5' ) ) {
	function templatemela_id5() {
		echo stripslashes(get_option('templatemela_footer_inside'));
	}
}

function templatemela_footer_after() { do_action( 'templatemela_footer_after' ); }			
add_action('templatemela_footer_after', 'templatemela_id6', 20);
if ( ! function_exists( 'templatemela_id6' ) ) {
	function templatemela_id6() {
		echo stripslashes(get_option('templatemela_footer_after'));
	}
}

function templatemela_content_before() { do_action( 'templatemela_content_before' ); }			
add_action('templatemela_content_before', 'templatemela_id7', 20);
if ( ! function_exists( 'templatemela_id7' ) ) {
	function templatemela_id7() {
		echo stripslashes(get_option('templatemela_content_before'));
	}
}

function templatemela_content_after() { do_action( 'templatemela_content_after' ); }			
add_action('templatemela_content_after', 'templatemela_id8', 20);
if ( ! function_exists( 'templatemela_id8' ) ) {
	function templatemela_id8() {
		echo stripslashes(get_option('templatemela_content_after'));
	}
}

function templatemela_main_before() { do_action( 'templatemela_main_before' ); }			
add_action('templatemela_main_before', 'templatemela_id9', 20);
if ( ! function_exists( 'templatemela_id9' ) ) {
	function templatemela_id9() {
		echo stripslashes(get_option('templatemela_main_before'));
	}
}

function templatemela_left_before() { do_action( 'templatemela_left_before' ); }			
add_action('templatemela_left_before', 'templatemela_id10', 20);
if ( ! function_exists( 'templatemela_id10' ) ) {
	function templatemela_id10() {
		echo stripslashes(get_option('templatemela_left_before'));
	}
}

function templatemela_left_after() { do_action( 'templatemela_left_after' ); }			
add_action('templatemela_left_after', 'templatemela_id11', 20);
if ( ! function_exists( 'templatemela_id11' ) ) {
	function templatemela_id11() {
		echo stripslashes(get_option('templatemela_left_after'));
	}
}

function templatemela_right_before() { do_action( 'templatemela_right_before' ); }			
add_action('templatemela_right_before', 'templatemela_id12', 20);
if ( ! function_exists( 'templatemela_id12' ) ) {
	function templatemela_id12() {
		echo stripslashes(get_option('templatemela_right_before'));
	}
}

function templatemela_right_after() { do_action( 'templatemela_right_after' ); }			
add_action('templatemela_right_after', 'templatemela_id13', 20);
if ( ! function_exists( 'templatemela_id13' ) ) {
	function templatemela_id13() {
		echo stripslashes(get_option('templatemela_right_after'));
	}
}
function templatemela_custom_css() { do_action( 'templatemela_custom_css' ); }			
add_action('templatemela_custom_css', 'templatemela_id14', 20);
if ( ! function_exists( 'templatemela_id14' ) ) {
	function templatemela_id14() {	
		echo stripslashes(get_option('templatemela_custom_css'));
	}
}?>
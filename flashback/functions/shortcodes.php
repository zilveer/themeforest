<?php

/*===============================================================

// Shortcodes

===============================================================*/



/*========================================================

	Button

========================================================*/

function si_button( $atts, $content = null ) {
      
	extract(shortcode_atts(array(
		'url'    => '#',
		'icon'   => 'icon-arrow-right',
		'noicon' => ''
	), $atts));
	
	if ($noicon == '1') {
	
		$noicon = 'noicon';
	
	}
 
	return '<a href="'.$url.'" class="btn">' . do_shortcode($content) . '<i class="'.$icon.' '. $noicon .'"></i></a>';
   
}
add_shortcode( 'button', 'si_button' );



/*========================================================

	List

========================================================*/

function si_list( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'type'   => 'check'
	), $atts));
 
	return '<div class="list list-'.$type.'">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'list', 'si_list' );



/*========================================================

	Title

========================================================*/

function si_title( $atts, $content = null ) {
 
   return '<h5>' . do_shortcode($content) . '</h5>';
   
}
add_shortcode( 'title', 'si_title' );



/*========================================================

	Full

========================================================*/

function si_full( $atts, $content = null ) {

   return '<div class="full">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'full', 'si_full' );



/*========================================================

	One Half

========================================================*/

function si_one_half( $atts, $content = null ) {

   return '<div class="one-half">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'one_half', 'si_one_half' );

/* Last */
function si_one_half_last( $atts, $content = null ) {

   return '<div class="one-half column-last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
   
}
add_shortcode('one_half_last', 'si_one_half_last');



/*========================================================

	One Third

========================================================*/

function si_one_third( $atts, $content = null ) {

   return '<div class="one-third">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'one_third', 'si_one_third' );

/* Last */
function si_one_third_last( $atts, $content = null ) {

   return '<div class="one-third column-last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
   
}
add_shortcode('one_third_last', 'si_one_third_last');



/*========================================================

	One Fourth

========================================================*/

function si_one_fourth( $atts, $content = null ) {

   return '<div class="one-fourth">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'one_fourth', 'si_one_fourth' );


/* Last */
function si_one_fourth_last( $atts, $content = null ) {

   return '<div class="one-fourth column-last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
   
}
add_shortcode('one_fourth_last', 'si_one_fourth_last');



/*========================================================

	One Fifth

========================================================*/

function si_one_fifth( $atts, $content = null ) {

   return '<div class="one-fifth">' . do_shortcode($content) . '</div>';
   
}
add_shortcode( 'one_fifth', 'si_one_fifth' );

/* Last */
function si_one_fifth_last( $atts, $content = null ) {

   return '<div class="one-fifth column-last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
   
}
add_shortcode('one_fifth_last', 'si_one_fifth_last');



?>
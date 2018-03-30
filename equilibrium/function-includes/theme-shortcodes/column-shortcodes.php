<?php

function onioneye_one_third( $atts, $content = null ) {
	
   return '<div class="one_third">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_third', 'onioneye_one_third' );


function onioneye_one_third_last( $atts, $content = null ) {
	
   return '<div class="one_third last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_third_last', 'onioneye_one_third_last' );


function onioneye_two_third( $atts, $content = null ) {
	
   return '<div class="two_third">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'two_third', 'onioneye_two_third' );


function onioneye_two_third_last( $atts, $content = null ) {
	
   return '<div class="two_third last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'two_third_last', 'onioneye_two_third_last' );


function onioneye_one_half( $atts, $content = null ) {
	
   return '<div class="one_half">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_half', 'onioneye_one_half' );


function onioneye_one_half_last( $atts, $content = null ) {
	
   return '<div class="one_half last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_half_last', 'onioneye_one_half_last' );


function onioneye_one_fourth( $atts, $content = null ) {
	
   return '<div class="one_fourth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_fourth', 'onioneye_one_fourth' );


function onioneye_one_fourth_last( $atts, $content = null ) {
	
   return '<div class="one_fourth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_fourth_last', 'onioneye_one_fourth_last' );


function onioneye_three_fourth( $atts, $content = null ) {
	
   return '<div class="three_fourth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'three_fourth', 'onioneye_three_fourth' );


function onioneye_three_fourth_last( $atts, $content = null ) {
	
   return '<div class="three_fourth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'three_fourth_last', 'onioneye_three_fourth_last' );

function onioneye_one_fifth( $atts, $content = null ) {
	
   return '<div class="one_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_fifth', 'onioneye_one_fifth' );


function onioneye_one_fifth_last( $atts, $content = null ) {
	
   return '<div class="one_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_fifth_last', 'onioneye_one_fifth_last' );


function onioneye_two_fifth( $atts, $content = null ) {
	
   return '<div class="two_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'two_fifth', 'onioneye_two_fifth' );


function onioneye_two_fifth_last( $atts, $content = null ) {
	
   return '<div class="two_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'two_fifth_last', 'onioneye_two_fifth_last' );


function onioneye_three_fifth( $atts, $content = null ) {
	
   return '<div class="three_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'three_fifth', 'onioneye_three_fifth' );


function onioneye_three_fifth_last( $atts, $content = null ) {
	
   return '<div class="three_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'three_fifth_last', 'onioneye_three_fifth_last' );


function onioneye_four_fifth( $atts, $content = null ) {
	
   return '<div class="four_fifth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'four_fifth', 'onioneye_four_fifth' );


function onioneye_four_fifth_last( $atts, $content = null ) {
	
   return '<div class="four_fifth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'four_fifth_last', 'onioneye_four_fifth_last' );


function onioneye_one_sixth( $atts, $content = null ) {
	
   return '<div class="one_sixth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'one_sixth', 'onioneye_one_sixth' );


function onioneye_one_sixth_last( $atts, $content = null ) {
	
   return '<div class="one_sixth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'one_sixth_last', 'onioneye_one_sixth_last' );


function onioneye_five_sixth( $atts, $content = null ) {
	
   return '<div class="five_sixth">' . do_shortcode( $content ) . '</div>';
   
}

add_shortcode( 'five_sixth', 'onioneye_five_sixth' );


function onioneye_five_sixth_last( $atts, $content = null ) {
	
   return '<div class="five_sixth last">' . do_shortcode( $content ) . '</div><div class="clearboth"></div>';
   
}

add_shortcode( 'five_sixth_last', 'onioneye_five_sixth_last' );


/* The following function takes care of that by disabling WordPress’s auto-formating filters so that the column shortcode is parsed 
 * without being run through them, then reapplying the content filters after the column shortcode has been parsed. The result is that 
 * all of the column shortcodes will validate.
 */
function onioneye_formatter( $content ) {
	
  $new_content = '';

  /* Matches the contents and the open and closing tags */
  $pattern_full = '{(\[raw\].*?\[/raw\])}is';

  /* Matches just the contents */
  $pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

  /* Divide content into pieces */
  $pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

  /* Loop over pieces */
  foreach ( $pieces as $piece ) {
    /* Look for presence of the shortcode */
    if (preg_match( $pattern_contents, $piece, $matches ) ) {

      /* Append to content (no formatting) */
      $new_content .= $matches[1];
    } else {

      /* Format and append to content */
      $new_content .= wptexturize( wpautop( $piece ) );
    }
  }

  return $new_content;
  
}

// Remove the 2 main auto-formatters
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

// Before displaying for viewing, apply this function
add_filter( 'the_content', 'onioneye_formatter', 99 );
add_filter( 'widget_text', 'onioneye_formatter', 99 );


//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set( 'pcre.backtrack_limit', 500000 );
?>

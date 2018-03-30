<?php

// =============================================================================
// FUNCTIONS/GLOBAL/SOCIAL.PHP
// -----------------------------------------------------------------------------
// Various social functions.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Social Output
//   02. Social Meta
// =============================================================================

// Social Output
// =============================================================================

if ( ! function_exists( 'x_social_global' ) ) :
  function x_social_global() {

    $facebook    = x_get_option( 'x_social_facebook' );
    $twitter     = x_get_option( 'x_social_twitter' );
    $google_plus = x_get_option( 'x_social_googleplus' );
    $linkedin    = x_get_option( 'x_social_linkedin' );
    $xing        = x_get_option( 'x_social_xing' );
    $foursquare  = x_get_option( 'x_social_foursquare' );
    $youtube     = x_get_option( 'x_social_youtube' );
    $vimeo       = x_get_option( 'x_social_vimeo' );
    $instagram   = x_get_option( 'x_social_instagram' );
    $pinterest   = x_get_option( 'x_social_pinterest' );
    $dribbble    = x_get_option( 'x_social_dribbble' );
    $flickr      = x_get_option( 'x_social_flickr' );
    $github      = x_get_option( 'x_social_github' );
    $behance     = x_get_option( 'x_social_behance' );
    $tumblr      = x_get_option( 'x_social_tumblr' );
    $whatsapp    = x_get_option( 'x_social_whatsapp' );
    $soundcloud  = x_get_option( 'x_social_soundcloud' );
    $rss         = x_get_option( 'x_social_rss' );

    $output = '<div class="x-social-global">';

      if ( $facebook )    : $output .= '<a href="' . $facebook    . '" class="facebook" title="Facebook" target="_blank"><i class="x-icon-facebook-square" data-x-icon="&#xf082;" aria-hidden="true"></i></a>'; endif;
      if ( $twitter )     : $output .= '<a href="' . $twitter     . '" class="twitter" title="Twitter" target="_blank"><i class="x-icon-twitter-square" data-x-icon="&#xf081;" aria-hidden="true"></i></a>'; endif;
      if ( $google_plus ) : $output .= '<a href="' . $google_plus . '" class="google-plus" title="Google+" target="_blank"><i class="x-icon-google-plus-square" data-x-icon="&#xf0d4;" aria-hidden="true"></i></a>'; endif;
      if ( $linkedin )    : $output .= '<a href="' . $linkedin    . '" class="linkedin" title="LinkedIn" target="_blank"><i class="x-icon-linkedin-square" data-x-icon="&#xf08c;" aria-hidden="true"></i></a>'; endif;
      if ( $xing )        : $output .= '<a href="' . $xing        . '" class="xing" title="XING" target="_blank"><i class="x-icon-xing-square" data-x-icon="&#xf169;" aria-hidden="true"></i></a>'; endif;
      if ( $foursquare )  : $output .= '<a href="' . $foursquare  . '" class="foursquare" title="Foursquare" target="_blank"><i class="x-icon-foursquare" data-x-icon="&#xf180;" aria-hidden="true"></i></a>'; endif;
      if ( $youtube )     : $output .= '<a href="' . $youtube     . '" class="youtube" title="YouTube" target="_blank"><i class="x-icon-youtube-square" data-x-icon="&#xf166;" aria-hidden="true"></i></a>'; endif;
      if ( $vimeo )       : $output .= '<a href="' . $vimeo       . '" class="vimeo" title="Vimeo" target="_blank"><i class="x-icon-vimeo-square" data-x-icon="&#xf194;" aria-hidden="true"></i></a>'; endif;
      if ( $instagram )   : $output .= '<a href="' . $instagram   . '" class="instagram" title="Instagram" target="_blank"><i class="x-icon-instagram" data-x-icon="&#xf16d;" aria-hidden="true"></i></a>'; endif;
      if ( $pinterest )   : $output .= '<a href="' . $pinterest   . '" class="pinterest" title="Pinterest" target="_blank"><i class="x-icon-pinterest-square" data-x-icon="&#xf0d3;" aria-hidden="true"></i></a>'; endif;
      if ( $dribbble )    : $output .= '<a href="' . $dribbble    . '" class="dribbble" title="Dribbble" target="_blank"><i class="x-icon-dribbble" data-x-icon="&#xf17d;" aria-hidden="true"></i></a>'; endif;
      if ( $flickr )      : $output .= '<a href="' . $flickr      . '" class="flickr" title="Flickr" target="_blank"><i class="x-icon-flickr" data-x-icon="&#xf16e;" aria-hidden="true"></i></a>'; endif;
      if ( $github )      : $output .= '<a href="' . $github      . '" class="github" title="GitHub" target="_blank"><i class="x-icon-github-square" data-x-icon="&#xf092;" aria-hidden="true"></i></a>'; endif;
      if ( $behance )     : $output .= '<a href="' . $behance     . '" class="behance" title="Behance" target="_blank"><i class="x-icon-behance-square" data-x-icon="&#xf1b5;" aria-hidden="true"></i></a>'; endif;
      if ( $tumblr )      : $output .= '<a href="' . $tumblr      . '" class="tumblr" title="Tumblr" target="_blank"><i class="x-icon-tumblr-square" data-x-icon="&#xf174;" aria-hidden="true"></i></a>'; endif;
      if ( $whatsapp )    : $output .= '<a href="' . $whatsapp    . '" class="tumblr" title="Whatsapp" target="_blank"><i class="x-icon-whatsapp" data-x-icon="&#xf232;" aria-hidden="true"></i></a>'; endif;
      if ( $soundcloud )  : $output .= '<a href="' . $soundcloud  . '" class="soundcloud" title="SoundCloud" target="_blank"><i class="x-icon-soundcloud" data-x-icon="&#xf1be;" aria-hidden="true"></i></a>'; endif;
      if ( $rss )         : $output .= '<a href="' . $rss         . '" class="rss" title="RSS" target="_blank"><i class="x-icon-rss-square" data-x-icon="&#xf143;" aria-hidden="true"></i></a>'; endif;

    $output .= '</div>';

    echo $output;

  }
endif;



// Social Meta
// =============================================================================

if ( ! function_exists( 'x_social_meta' ) ) :
  function x_social_meta() {

    $url         = get_permalink();
    $type        = ( is_singular() ) ? 'article' : 'website';
    $image       = x_get_featured_image_with_fallback_url();
    $title       = the_title_attribute( array( 'echo' => false ) );
    $site_name   = get_bloginfo( 'name' );
    $description = ( is_singular() ) ? trim( wp_trim_words( strip_shortcodes( strip_tags( get_post()->post_content ) ), 35, '' ), '.!?,;:-' ) . '&hellip;' : get_bloginfo( 'description' );

    if ( $description == '&hellip;' ) {
      $description = get_bloginfo( 'description' );
    }

    echo '<meta property="og:site_name" content="'   . $site_name   . '">';
    echo '<meta property="og:title" content="'       . $title       . '">';
    echo '<meta property="og:description" content="' . $description . '">';
    echo '<meta property="og:image" content="'       . $image       . '">';
    echo '<meta property="og:url" content="'         . $url         . '">';
    echo '<meta property="og:type" content="'        . $type        . '">';

  }

  if ( x_get_option( 'x_social_open_graph' ) ) {
    add_action( 'wp_head', 'x_social_meta' );
  }
endif;
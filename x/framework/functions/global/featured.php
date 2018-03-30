<?php

// =============================================================================
// FUNCTIONS/GLOBAL/FEATURED.PHP
// -----------------------------------------------------------------------------
// Handles output of featured content for different post formats (e.g. images,
// audio, video, et cetera).
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Featured Image
//   02. Featured Gallery
//   03. Featured Audio
//   04. Featured Video
//   05. Featured Portfolio
// =============================================================================

// Featured Image
// =============================================================================

//
// Output featured image in an <a> tag on index pages and a <div> for single
// posts and pages.
//

if ( ! function_exists( 'x_featured_image' ) ) :
  function x_featured_image( $cropped = '' ) {

    $stack     = x_get_stack();
    $fullwidth = ( in_array( 'x-full-width-active', get_body_class() ) ) ? true : false;

    if ( has_post_thumbnail() ) {

      if ( $cropped == 'cropped' ) {
        if ( $fullwidth ) {
          $thumb = get_the_post_thumbnail( NULL, 'entry-cropped-fullwidth', NULL );
        } else {
          $thumb = get_the_post_thumbnail( NULL, 'entry-cropped', NULL );
        }
      } else {
        if ( $fullwidth ) {
          $thumb = get_the_post_thumbnail( NULL, 'entry-fullwidth', NULL );
        } else {
          $thumb = get_the_post_thumbnail( NULL, 'entry', NULL );
        }
      }

      switch ( is_singular() ) {
        case true:
          printf( '<div class="entry-thumb">%s</div>', $thumb );
          break;
        case false:
          printf( '<a href="%1$s" class="entry-thumb" title="%2$s">%3$s</a>',
            esc_url( get_permalink() ),
            esc_attr( sprintf( __( 'Permalink to: "%s"', '__x__' ), the_title_attribute( 'echo=0' ) ) ),
            $thumb
          );
          break;
      }

    }

  }
endif;



// Featured Gallery
// =============================================================================

if ( ! function_exists( 'x_featured_gallery' ) ) :
  function x_featured_gallery() {

    $stack     = x_get_stack();
    $thumb     = get_post_thumbnail_id( get_the_ID() );
    $fullwidth = ( in_array( 'x-full-width-active', get_body_class() ) ) ? true : false;

    $args = array(
      'order'          => 'ASC',
      'orderby'        => 'menu_order',
      'post_parent'    => get_the_ID(),
      'post_type'      => 'attachment',
      'post_mime_type' => 'image',
      'post_status'    => null,
      'numberposts'    => -1,
      'exclude'        => $thumb
    );

    $attachments = get_posts( $args );

    if ( $attachments ) {
      echo '<div class="x-flexslider x-flexslider-featured-gallery man"><ul class="x-slides">';
        foreach ( $attachments as $attachment ) {
          echo '<li class="x-slide">';
            if ( $fullwidth ) {
              echo wp_get_attachment_image( $attachment->ID, 'entry-fullwidth', false, false );
            } else {
              echo wp_get_attachment_image( $attachment->ID, 'entry', false, false );
            }
          echo '</li>';
        }
      echo '</ul></div>';
    }

  }
endif;



// Featured Audio
// =============================================================================

if ( ! function_exists( 'x_featured_audio' ) ) :
  function x_featured_audio() {

    $entry_id = get_the_ID();
    $mp3      = get_post_meta( $entry_id, '_x_audio_mp3', true );
    $ogg      = get_post_meta( $entry_id, '_x_audio_ogg', true );
    $embed    = get_post_meta( $entry_id, '_x_audio_embed', true );

    if ( $embed != '' ) {
      echo do_shortcode( '[x_audio_embed class="mvn"]' . stripslashes( htmlspecialchars_decode( $embed ) ) . '[/x_audio_embed]' );
    } else {
      echo do_shortcode( '[x_audio_player mp3="' . $mp3 . '" oga="' . $ogg . '" preload="metadata" autoplay="false" loop="false" class="mvn"]' );
    }

  }
endif;



// Featured Video
// =============================================================================

if ( ! function_exists( 'x_featured_video' ) ) :
  function x_featured_video( $post_type = 'video' ) {

    $entry_id     = get_the_ID();
    $stack        = x_get_stack();
    $aspect_ratio = get_post_meta( $entry_id, '_x_' . $post_type . '_aspect_ratio', true );
    $m4v          = get_post_meta( $entry_id, '_x_' . $post_type . '_m4v', true );
    $ogv          = get_post_meta( $entry_id, '_x_' . $post_type . '_ogv', true );
    $embed        = get_post_meta( $entry_id, '_x_' . $post_type . '_embed', true );
    $fullwidth    = ( in_array( 'x-full-width-active', get_body_class() ) ) ? true : false;

    if ( $fullwidth ) {
      $poster = wp_get_attachment_image_src( get_post_thumbnail_id( $entry_id ), 'entry-fullwidth', false );
    } else {
      $poster = wp_get_attachment_image_src( get_post_thumbnail_id( $entry_id ), 'entry', false );
    }

    if ( $embed != '' ) {
      echo do_shortcode( '[x_video_embed type="' . $aspect_ratio . '" no_container="true" class="mvn"]' . stripslashes( htmlspecialchars_decode( $embed ) ) . '[/x_video_embed]' );
    } else {
      echo do_shortcode( '[x_video_player m4v="' . $m4v . '" ogv="' . $ogv . '" poster="' . $poster[0] . '" type="' . $aspect_ratio . '" preload="metadata" hide_controls="false" autoplay="false" loop="false" muted="false" no_container="true" class="mvn"]' );
    }

  }
endif;



// Featured Portfolio
// =============================================================================

if ( ! function_exists( 'x_featured_portfolio' ) ) :
  function x_featured_portfolio( $cropped = '' ) {

    $entry_id    = get_the_ID();
    $media       = get_post_meta( $entry_id, '_x_portfolio_media', true );
    $index_media = get_post_meta( $entry_id, '_x_portfolio_index_media', true );

    if ( is_singular() ) {
      switch ( $media ) {
        case 'Image' :
          x_featured_image();
          break;
        case 'Gallery' :
          x_featured_gallery();
          break;
        case 'Video' :
          x_featured_video( 'portfolio' );
          break;
      }
    } else {
      if ( $index_media == 'Media' ) {
        switch ( $media ) {
          case 'Image' :
            ( $cropped == 'cropped' ) ? x_featured_image( 'cropped' ) : x_featured_image();
            break;
          case 'Gallery' :
            x_featured_gallery();
            break;
          case 'Video' :
            x_featured_video( 'portfolio' );
            break;
        }
      } else {
        ( $cropped == 'cropped' ) ? x_featured_image( 'cropped' ) : x_featured_image();
      }
    }

  }
endif;
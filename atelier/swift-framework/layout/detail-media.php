<?php
    global $post, $sf_options;

    $media_type = $media_image = $media_video = $media_gallery = '';

    $default_detail_media = $sf_options['default_detail_media'];
    $fw_media_display     = sf_get_post_meta( $post->ID, 'sf_fw_media_display', true );
    $custom_media_height  = sf_get_post_meta( $post->ID, 'sf_media_height', true );
    $use_thumb_content    = sf_get_post_meta( $post->ID, 'sf_thumbnail_content_main_detail', true );
    $post_format          = get_post_format( $post->ID );
    if ( $post_format == "" ) {
        $post_format = 'standard';
    }
    if ( $use_thumb_content ) {
        $media_type = sf_get_post_meta( $post->ID, 'sf_thumbnail_type', true );
    } else {
        $media_type = sf_get_post_meta( $post->ID, 'sf_detail_type', true );
    }
    if ( $media_type == "" ) {
        $media_type = $default_detail_media;
    }

    $media_slider      = sf_get_post_meta( $post->ID, 'sf_detail_rev_slider_alias', true );
    $media_layerslider = sf_get_post_meta( $post->ID, 'sf_detail_layer_slider_alias', true );
    $custom_media      = sf_get_post_meta( $post->ID, 'sf_custom_media', true );

    $media_width  = 1170;
    $media_height = null;
    if ( $custom_media_height != "" && $fw_media_display == "fw-media-title" ) {
        $media_height = $custom_media_height;
    }
    if ( $fw_media_display == "fw-media-title" || $fw_media_display == "fw-media" ) {
        $media_width = 1920;
    }
    $video_height = 658;

    $figure_output = '<figure class="media-wrap media-type-' . $media_type . '" itemscope>';

    if ( $post_format == "standard" ) {

        if ( $media_type == "video" ) {

            $figure_output .= sf_video_post( $post->ID, $media_width, $video_height, $use_thumb_content ) . "\n";

        } else if ( $media_type == "slider" ) {

            $figure_output .= sf_gallery_post( $post->ID, $use_thumb_content ) . "\n";

        } else if ( $media_type == "gallery-stacked" ) {

            $figure_output .= sf_gallery_stacked_post( $post->ID, $use_thumb_content ) . "\n";

        } else if ( $media_type == "layer-slider" ) {

            $figure_output .= '<div class="layerslider">' . "\n";

            if ( $media_slider != "" ) {

                $figure_output .= do_shortcode( '[rev_slider ' . $media_slider . ']' ) . "\n";

            } else {

                $figure_output .= do_shortcode( '[layerslider id="' . $media_layerslider . '"]' ) . "\n";

            }

            $figure_output .= '</div>' . "\n";

        } else if ( $media_type == "audio" ) {

            $figure_output .= '<div class="audio-detail">' . sf_audio_post( $post->ID, $use_thumb_content ) . '</div>' . "\n";

        } else if ( $media_type == "sh-video" ) {

            $figure_output .= '<div class="sh-video-wrap">' . sf_sh_video_post( $post->ID, $use_thumb_content ) . '</div>' . "\n";

        } else if ( $media_type == "custom" ) {

            $figure_output .= do_shortcode( $custom_media ) . "\n";

        } else if ( $media_type == "image" ) {

            $figure_output .= sf_image_post( $post->ID, $media_width, $media_height, $use_thumb_content ) . "\n";

        }

    } else {

        $figure_output .= sf_get_post_media( $post->ID, $media_width, $media_height, $video_height, $use_thumb_content );

    }

    $figure_output .= '</figure>' . "\n";

    echo $figure_output;
?>
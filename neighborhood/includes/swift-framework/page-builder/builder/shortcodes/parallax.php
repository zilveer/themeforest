<?php

    /*
    *
    *	Swift Page Builder - Parallax Shortcode
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2015 - http://www.swiftideas.com
    *
    */

    class SwiftPageBuilderShortcode_spb_parallax extends SwiftPageBuilderShortcode {

        protected function content( $atts, $content = null ) {

            $title = $el_position = $width = $el_class = '';
            extract( shortcode_atts( array(
                'title'                   => '',
                'parallax_type'           => '',
                'bg_image'                => '',
                'bg_video_mp4'            => '',
                'bg_video_webm'           => '',
                'bg_video_ogg'            => '',
                'parallax_video_height'   => 'window-height',
                'parallax_image_height'   => 'content-height',
                'parallax_video_overlay'  => 'none',
                'parallax_image_movement' => 'fixed',
                'parallax_image_speed'    => '0.5',
                'bg_type'                 => '',
                'padding_horizontal'      => '',
                'el_position'             => '',
                'width'                   => '1/1',
                'el_class'                => ''
            ), $atts ) );
            $output = '';

            /* SIDEBAR CONFIG
            ================================================== */
            global $sf_sidebar_config;

            $sidebars = '';
            if ( ( $sf_sidebar_config == "left-sidebar" ) || ( $sf_sidebar_config == "right-sidebar" ) ) {
                $sidebars = 'one-sidebar';
            } else if ( $sf_sidebar_config == "both-sidebars" ) {
                $sidebars = 'both-sidebars';
            } else {
                $sidebars = 'no-sidebars';
            }

            $el_class = $this->getExtraClass( $el_class );
            $width    = spb_translateColumnWidthToSpan( $width );

            $img_url = wp_get_attachment_image_src( $bg_image, 'full' );

            $inline_style = "";
            if ( $padding_horizontal != "" ) {
                $inline_style .= 'padding-left:' . $padding_horizontal . '%;padding-right:' . $padding_horizontal . '%;';
            }

            if ( $parallax_type == "video" ) {
                if ( $img_url[0] != "" ) {
                    $output .= "\n\t" . '<div class="spb_parallax_asset sf-parallax sf-parallax-video parallax-' . $parallax_video_height . ' spb_content_element bg-type-' . $bg_type . ' ' . $width . $el_class . '" data-v-center="true" style="background-image: url(' . $img_url[0] . ');">';
                } else {
                    $output .= "\n\t" . '<div class="spb_parallax_asset sf-parallax sf-parallax-video parallax-' . $parallax_video_height . ' spb_content_element bg-type-' . $bg_type . ' ' . $width . $el_class . '" data-v-center="true">';
                }
            } else {
                if ( $img_url[0] != "" ) {
                    if ( $parallax_image_movement == "stellar" ) {
                        $output .= "\n\t" . '<div class="spb_parallax_asset sf-parallax parallax-' . $parallax_image_height . ' parallax-' . $parallax_image_movement . ' spb_content_element bg-type-' . $bg_type . ' ' . $width . $el_class . '" style="background-image: url(' . $img_url[0] . ');" data-stellar-background-ratio="' . $parallax_image_speed . '" data-v-center="true">';
                    } else {
                        $output .= "\n\t" . '<div class="spb_parallax_asset sf-parallax parallax-' . $parallax_image_height . ' parallax-' . $parallax_image_movement . ' spb_content_element bg-type-' . $bg_type . ' ' . $width . $el_class . '" style="background-image: url(' . $img_url[0] . ');" data-v-center="true">';
                    }
                } else {
                    $output .= "\n\t" . '<div class="spb_parallax_asset sf-parallax parallax-' . $parallax_image_height . ' spb_content_element bg-type-' . $bg_type . ' ' . $width . $el_class . '" data-v-center="true">';
                }
            }
            $output .= "\n\t\t" . '<div class="spb_content_wrapper container" style="' . $inline_style . '">';
            $output .= ( $title != '' ) ? "\n\t\t\t" . '<div class="heading-wrap"><h3 class="spb-heading spb-center-heading"><span>' . $title . '</span></h3></div>' : '';
            $output .= "\n\t\t\t" . do_shortcode( $content );
            $output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.spb_content_wrapper' );

            if ( $parallax_type == "video" ) {
                $output .= '<video class="parallax-video" poster="' . $img_url[0] . '" preload="auto" autoplay loop="loop" muted="muted">';
                if ( $bg_video_mp4 != "" ) {
                    $output .= '<source src="' . $bg_video_mp4 . '" type="video/mp4">';
                }
                if ( $bg_video_webm != "" ) {
                    $output .= '<source src="' . $bg_video_webm . '" type="video/webm">';
                }
                if ( $bg_video_ogg != "" ) {
                    $output .= '<source src="' . $bg_video_ogg . '" type="video/ogg">';
                }
                $output .= '</video>';
                $output .= '<div class="video-overlay overlay-' . $parallax_video_overlay . '"></div>';
            }
            $output .= "\n\t" . '</div> ' . $this->endBlockComment( $width );

            if ( $sidebars == 'no-sidebars' ) {
                $output = $this->startRow( $el_position, '', true, 'full-width' ) . $output . $this->endRow( $el_position, '', true, 'full-width' );
            } else {
                $output = $this->startRow( $el_position ) . $output . $this->endRow( $el_position );
            }

            global $sf_include_parallax;
            $sf_include_parallax = true;

            return $output;
        }
    }

    SPBMap::map( 'spb_parallax', array(
        "name"          => __( "Parallax", 'swiftframework' ),
        "base"          => "spb_parallax",
        "class"         => "",
        "icon"          => "spb-icon-parallax",
        "wrapper_class" => "clearfix",
        "controls"      => "full",
        "params"        => array(
            array(
                "type"        => "textfield",
                "heading"     => __( "Widget title", 'swiftframework' ),
                "param_name"  => "title",
                "value"       => "",
                "description" => __( "Heading text. Leave it empty if not needed.", 'swiftframework' )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Parallax Type", 'swiftframework' ),
                "param_name"  => "parallax_type",
                "value"       => array(
                    __( "Image", 'swiftframework' ) => "image",
                    __( "Video", 'swiftframework' ) => "video"
                ),
                "description" => __( "Choose whether you want to use an image or video for the background of the parallax. This will decide what is used from the options below.", 'swiftframework' )
            ),
            array(
                "type"        => "attach_image",
                "heading"     => __( "Background Image", 'swiftframework' ),
                "param_name"  => "bg_image",
                "value"       => "",
                "description" => "Choose an image to use as the background for the parallax area."
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Background Type", 'swiftframework' ),
                "param_name"  => "bg_type",
                "value"       => array(
                    __( "Cover", 'swiftframework' )   => "cover",
                    __( "Pattern", 'swiftframework' ) => "pattern"
                ),
                "description" => __( "If you're uploading an image that you want to spread across the whole asset, then choose cover. Else choose pattern for an image you want to repeat.", 'swiftframework' )
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Background Video (MP4)", 'swiftframework' ),
                "param_name"  => "bg_video_mp4",
                "value"       => "",
                "required"       => array("parallax_type", "=", "video"),
                "description" => "Provide a video URL in MP4 format to use as the background for the parallax area. You can upload these videos through the WordPress media manager."
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Background Video (WebM)", 'swiftframework' ),
                "param_name"  => "bg_video_webm",
                "value"       => "",
                "required"       => array("parallax_type", "=", "video"),
                "description" => "Provide a video URL in WebM format to use as the background for the parallax area. You can upload these videos through the WordPress media manager."
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Background Video (Ogg)", 'swiftframework' ),
                "param_name"  => "bg_video_ogg",
                "value"       => "",
                "required"       => array("parallax_type", "=", "video"),
                "description" => "Provide a video URL in OGG format to use as the background for the parallax area. You can upload these videos through the WordPress media manager."
            ),
            array(
                "type"        => "textarea_html",
                "holder"      => "div",
                "class"       => "",
                "heading"     => __( "Parallax Content", 'swiftframework' ),
                "param_name"  => "content",
                "value"       => __( "<p>This is a parallax text block. Click the edit button to change this text.</p>", 'swiftframework' ),
                "description" => __( "Enter your content.", 'swiftframework' )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Parallax Video Height", 'swiftframework' ),
                "param_name"  => "parallax_video_height",
                "value"       => array(
                    __( "Content Height", 'swiftframework' ) => "content-height",
                    __( "Window Height", 'swiftframework' )  => "window-height"
                ),
                "required"       => array("parallax_type", "=", "video"),
                "description" => __( "If you are using this as a video parallax asset, then please choose whether you'd like asset to sized based on the content height or the window height.", 'swiftframework' )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Parallax Video Overlay", 'swiftframework' ),
                "param_name"  => "parallax_video_overlay",
                "value"       => array(
                    __( "None", 'swiftframework' )             => "none",
                    __( "Light Grid", 'swiftframework' )       => "lightgrid",
                    __( "Dark Grid", 'swiftframework' )        => "darkgrid",
                    __( "Light Grid (Fat)", 'swiftframework' ) => "lightgridfat",
                    __( "Dark Grid (Fat)", 'swiftframework' )  => "darkgridfat",
                    __( "Light Diagonal", 'swiftframework' )   => "diaglight",
                    __( "Dark Diagonal", 'swiftframework' )    => "diagdark",
                    __( "Light Vertical", 'swiftframework' )   => "vertlight",
                    __( "Dark Vertical", 'swiftframework' )    => "vertdark",
                    __( "Light Horizontal", 'swiftframework' ) => "horizlight",
                    __( "Dark Horizontal", 'swiftframework' )  => "horizdark",
                ),
                "required"       => array("parallax_type", "=", "video"),
                "description" => __( "If you would like an overlay to appear on top of the video, then you can select it here.", 'swiftframework' )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Parallax Image Height", 'swiftframework' ),
                "param_name"  => "parallax_image_height",
                "value"       => array(
                    __( "Content Height", 'swiftframework' ) => "content-height",
                    __( "Window Height", 'swiftframework' )  => "window-height"
                ),
                "required"       => array("parallax_type", "=", "image"),
                "description" => __( "If you are using this as an image parallax asset, then please choose whether you'd like asset to sized based on the content height or the height of the viewport window.", 'swiftframework' )
            ),
            array(
                "type"        => "dropdown",
                "heading"     => __( "Parallax Image Movement", 'swiftframework' ),
                "param_name"  => "parallax_image_movement",
                "value"       => array(
                    __( "Fixed", 'swiftframework' )             => "fixed",
                    __( "Scroll", 'swiftframework' )            => "scroll",
                    __( "Stellar (dynamic)", 'swiftframework' ) => "stellar",
                ),
                "required"       => array("parallax_type", "=", "image"),
                "description" => __( "Choose the type of movement you would like the parallax image to have. Fixed means the background image is fixed on the page, Scroll means the image will scroll will the page, and stellar makes the image move at a seperate speed to the page, providing a layered effect.", 'swiftframework' )
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Parallax Image Speed (Stellar Only)", 'swiftframework' ),
                "param_name"  => "parallax_image_speed",
                "value"       => "0.5",
                "required"       => array("parallax_type", "=", "image"),
                "description" => "The speed at which the parallax image moves in relation to the page scrolling. For example, 0.5 would mean the image scrolls at half the speed of the standard page scroll. (Default 0.5)."
            ),
            array(
                "type"        => "uislider",
                "heading"     => __( "Padding - Horizontal", 'swiftframework' ),
                "param_name"  => "padding_horizontal",
                "value"       => "15",
                "step"        => "5",
                "min"         => "0",
                "max"         => "40",
                "description" => __( "Adjust the horizontal padding for the content (percentage).", 'swiftframework' )
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Extra class", 'swiftframework' ),
                "param_name"  => "el_class",
                "value"       => "",
                "description" => __( "If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'swiftframework' )
            )
        )
    ) );
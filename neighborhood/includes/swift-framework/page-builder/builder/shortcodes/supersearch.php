<?php

    /*
    *
    *	Swift Page Builder - SuperSearch Shortcode
    *	------------------------------------------------
    *	Swift Framework
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
    *
    */

    class SwiftPageBuilderShortcode_spb_supersearch extends SwiftPageBuilderShortcode {

        protected function content( $atts, $content = null ) {

            $title = $width = $el_class = $output = $items = $el_position = '';

            extract( shortcode_atts( array(
                'title'       => '',
                'fullwidth'   => '',
                'el_position' => '',
                'width'       => '1/1',
                'el_class'    => ''
            ), $atts ) );


            /* PAGE BUILDER OUTPUT
            ================================================== */
            $width    = spb_translateColumnWidthToSpan( $width );
            $el_class = $this->getExtraClass( $el_class );
            if ( $fullwidth == "yes" && $width == "col-sm-12" ) {
                $fullwidth = true;
            } else {
                $fullwidth = false;
            }

            $output .= "\n\t" . '<div class="spb_supersearch_widget spb_content_element ' . $width . $el_class . '">';
            $output .= "\n\t\t" . '<div class="spb-asset-content">';
            $output .= ( $title != '' ) ? "\n\t\t\t" . $this->spb_title( $title, '', $fullwidth ) : '';
            $output .= "\n\t\t" . do_shortcode( '[sf_supersearch]' );
            $output .= "\n\t\t" . '</div>';
            $output .= "\n\t" . '</div> ' . $this->endBlockComment( $width );

            if ( $fullwidth == "yes" ) {
                $output = $this->startRow( $el_position, '', true ) . $output . $this->endRow( $el_position, '', true );
            } else {
                $output = $this->startRow( $el_position ) . $output . $this->endRow( $el_position );
            }

            return $output;

        }
    }

    SPBMap::map( 'spb_supersearch', array(
        "name"   => __( "Super Search", "swiftframework" ),
        "base"   => "spb_supersearch",
        "class"  => "spb_supersearch",
        "icon"   => "spb-icon-supersearch",
        "params" => array(
            array(
                "type"        => "dropdown",
                "heading"     => __( "Full width", "swiftframework" ),
                "param_name"  => "fullwidth",
                "value"       => array(
                    __( 'No', "swiftframework" )  => "no",
                    __( 'Yes', "swiftframework" ) => "yes"
                ),
                "description" => __( "Select yes if you'd like the divider to be full width (only to be used with no sidebars, and with Standard/Thin/Dotted divider types).", "swiftframework" )
            ),
            array(
                "type"        => "textfield",
                "heading"     => __( "Extra class name", "swiftframework" ),
                "param_name"  => "el_class",
                "value"       => "",
                "description" => __( "If you wish to style this particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework" )
            )
        )
    ) );
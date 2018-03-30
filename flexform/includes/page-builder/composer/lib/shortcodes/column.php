<?php
/**
 * WPBakery Visual Composer shortcodes
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Column extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        if ( $this->shortcode == 'vc_column' ) {
            $el_class .= ' column_container';
        }
        else if ( $this->shortcode == 'vc_column_text' ) {
            $el_class .= ' wpb_text_column';
        }

        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper">';
        $output .= "\n\t\t\t". wpb_js_remove_wpautop($content);
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }

    public function contentAdmin($atts, $content = null) {
        $width = '';
        extract(shortcode_atts(array(
            'width' => 'column_12'
        ), $atts));

        $output = '';

        $column_controls = $this->getColumnControls('size_delete');

        if ( $width == 'column_14' || $width == '1/4' ) {
            $width = array('span3');
        }
        else if ( $width == 'column_14-14-14-14' ) {
            $width = array('span3', 'span3', 'span3', 'span3');
        }
        else if ( $width == 'column_14-12-14' ) {
            $width = array('span3', 'span6', 'span3');
        }
        else if ( $width == 'column_12-14-14' ) {
            $width = array('span6', 'span3', 'span3');
        }
        else if ( $width == 'column_14-14-12' ) {
            $width = array('span3', 'span3', 'span6');
        }
        else if ( $width == 'column_13' || $width == '1/3' ) {
            $width = array('span4');
        }
        else if ( $width == 'column_13-23' ) {
            $width = array('span4', 'span8');
        }
        else if ( $width == 'column_23-13' ) {
            $width = array('span8', 'span4');
        }
        else if ( $width == 'column_13-13-13' ) {
            $width = array('span4', 'span4', 'span4');
        }

        else if ( $width == 'column_12' || $width == '1/2' ) {
            $width = array('span6');
        }
        else if ( $width == 'column_12-12' ) {
            $width = array('span6', 'span6');
        }

        else if ( $width == 'column_23' || $width == '2/3' ) {
            $width = array('span8');
        }
        else if ( $width == 'column_34' || $width == '3/4' ) {
            $width = array('span9');
        }
        else {
            $width = array('span12');
        }


        for ( $i=0; $i < count($width); $i++ ) {
            $output .= '<div class="wpb_vc_column wpb_sortable wpb_droppable '.$width[$i].' not-column-inherit">';
            $output .= '<input type="hidden" class="wpb_vc_sc_base" name="" value="vc_column" />';
            $output .= str_replace("%column_size%", wpb_translateColumnWidthToFractional($width[$i]), $column_controls);
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">';
            $output .= do_shortcode( shortcode_unautop($content) );
            $output .= WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper();
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }
}
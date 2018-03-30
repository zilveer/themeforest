<?php
/**
 */
class WPBakeryShortCode_VC_Tab extends WPBakeryShortCode {
    public function content( $atts, $content = null ) {
        $title = '';
        extract(shortcode_atts(array(
            'title' => __("Tab", "js_composer")
        ), $atts));
        $output = '';

        $output .= "\n\t\t\t" . '<div id="tab-'.sanitize_title($title).'" class="wpb_tab row-fluid">';
        $output .= "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_tab');
        return $output;
    }

    public function contentAdmin($atts, $content) {
        $title = '';
        $defaults = array( 'title' => __('Tab', 'js_composer') );
        extract( shortcode_atts( $defaults, $atts ) );

        return '<div id="tab-'. sanitize_title( $title ) .'" class="row-fluid wpb_column_container wpb_sortable_container not-column-inherit">'. do_shortcode($content) . WPBakeryVisualComposer::getInstance()->getLayout()->getContainerHelper() . '</div>';
    }
}

class WPBakeryShortCode_VC_Tabs extends WPBakeryShortCode {

    public function __construct($settings) {
        parent::__construct($settings);
        WPBakeryVisualComposer::getInstance()->addShortCode( array( 'base' => 'vc_tab' ) );
    }

    public function contentAdmin($atts, $content = null) {
        $width = $custom_markup = '';
        $shortcode_attributes = array('width' => '1/1');
        foreach ( $this->settings['params'] as $param ) {
            if ( $param['param_name'] != 'content' ) {
                //$shortcode_attributes[$param['param_name']] = $param['value'];
                if ( is_string($param['value']) ) {
                    $shortcode_attributes[$param['param_name']] = __($param['value'], "js_composer");
                } else {
                    $shortcode_attributes[$param['param_name']] = $param['value'];
                }
            } else if ( $param['param_name'] == 'content' && $content == NULL ) {
                //$content = $param['value'];
                $content = __($param['value'], "js_composer");
            }
        }
        extract(shortcode_atts(
            $shortcode_attributes
            , $atts));

        // Extract tab titles
        preg_match_all( '/vc_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
        $tab_titles = array();
        if ( isset($matches[1]) ) { $tab_titles = $matches[1]; }

        $output = '';

        $tmp = '';
        if ( count($tab_titles) ) {
            $tmp .= '<ul class="clearfix">';
            foreach ( $tab_titles as $tab ) {
                $tmp .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
            }
            $tmp .= '</ul>';
        } else {
            $output .= do_shortcode( $content );
        }
        $elem = $this->getElementHolder($width);

        $iner = '';
        foreach ($this->settings['params'] as $param) {
            $param_value = $custom_markup = '';
            eval("\$param_value = \$".$param['param_name'].";");

            if ( is_array($param_value)) {
                // Get first element from the array
                reset($param_value);
                $first_key = key($param_value);
                $param_value = $param_value[$first_key];
            }
            $iner .= $this->singleParamHtmlHolder($param, $param_value);
        }
        //$elem = str_ireplace('%wpb_element_content%', $iner, $elem);

        if ( isset($this->settings["custom_markup"]) &&$this->settings["custom_markup"] != '' ) {
            if ( $content != '' ) {
                $custom_markup = str_ireplace("%content%", $tmp.$content, $this->settings["custom_markup"]);
            } else if ( $content == '' && isset($this->settings["default_content"]) && $this->settings["default_content"] != '' ) {
                $custom_markup = str_ireplace("%content%",$this->settings["default_content"],$this->settings["custom_markup"]);
            }
            //$output .= do_shortcode($this->settings["custom_markup"]);
            $iner .= do_shortcode($custom_markup);
        }
        $elem = str_ireplace('%wpb_element_content%', $iner, $elem);
        $output = $elem;

        return $output;
    }

    public function content($atts, $content =null)
    {
        wp_enqueue_style( 'ui-custom-theme' );
        wp_enqueue_script('jquery-ui-tabs');
        //
        $tab_asset_title = $type = $interval = $width = $el_position = $el_class = '';
        extract(shortcode_atts(array(
            'tab_asset_title' => '',
            'interval' => 0,
            'width' => '1/1',
            'el_position' => '',
            'el_class' => ''
        ), $atts));
        $output = '';

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $element = 'wpb_tabs';
        if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

        // Extract tab titles
        preg_match_all( '/vc_tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
        $tab_titles = array();
        if ( isset($matches[1]) ) { $tab_titles = $matches[1]; }
        $tabs_nav = '';
        $tabs_nav .= '<ul class="clearfix">';
        foreach ( $tab_titles as $tab ) {
            $tabs_nav .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
        }
        $tabs_nav .= '</ul>'."\n";

        $output .= "\n\t".'<div class="'.$element.' wpb_content_element '.$width.$el_class.'" data-interval="'.$interval.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper wpb_tour_tabs_wrapper">';
        $output .= ($tab_asset_title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading '.$element.'_heading"><span>'.$tab_asset_title.'</span></h3>' : '';
        $output .= "\n\t\t\t".$tabs_nav;
        $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
        if ( 'vc_tour' == $this->shortcode) {
            $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav"> <span class="wpb_prev_slide"><a href="#prev" title="'.__('Previous slide').'">'.__('Previous slide').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.__('Next slide').'">'.__('Next slide').'</a></span></div>';
        }
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}
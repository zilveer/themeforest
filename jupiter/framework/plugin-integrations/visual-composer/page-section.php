<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * By inheriting vc_row shortcode we build Page section shortcode
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


class WPBakeryShortCode_mk_page_section extends WPBakeryShortCode
{
    protected $predefined_atts = array('el_class' => '');
    
    protected function content($atts, $content = null)
    {
        $prefix = '';
        return $prefix . $this->loadTemplate($atts, $content);
    }
    
    public function getLayoutsControl()
    {
        global $vc_row_layouts;
        $controls_layout = '<span class="vc_row_layouts vc_control">';
        foreach ($vc_row_layouts as $layout) {
            $controls_layout .= '<a class="vc_control-set-column set_columns ' . $layout['icon_class'] . '" data-cells="' . $layout['cells'] . '" data-cells-mask="' . $layout['mask'] . '" title="' . $layout['title'] . '"></a> ';
        }
        $controls_layout .= '<br/><a class="vc_control-set-column set_columns custom_columns" data-cells="custom" data-cells-mask="custom" title="' . __('Custom layout', 'mk_framework') . '">' . __('Custom', 'mk_framework') . '</a> ';
        $controls_layout .= '</span>';
        
        return $controls_layout;
    }
    
    public function getColumnControls($controls, $extended_css = '')
    {
        $output       = '<div class="vc_controls vc_controls-row controls controls_row vc_clearfix">';
        $controls_end = '</div>';
        
        //Create columns
        $controls_layout = $this->getLayoutsControl();
        
        $controls_move   = ' <a class="vc_control column_move vc_column-move" href="#" title="' . __('Drag Page Section to reorder', 'mk_framework') . '" data-vc-control="move"><i class="vc_icon"></i></a>';
        $controls_add    = ' <a class="vc_control column_add vc_column-add" href="#" title="' . __('Add column', 'mk_framework') . '" data-vc-control="add"><i class="vc_icon"></i></a>';
        $controls_delete = '<a class="vc_control column_delete vc_column-delete" href="#" title="' . __('Delete this Page Section', 'mk_framework') . '" data-vc-control="delete"><i class="vc_icon"></i></a>';
        $controls_edit   = ' <a class="vc_control column_edit vc_column-edit" href="#" title="' . __('Edit this Page Section', 'mk_framework') . '" data-vc-control="edit"><i class="vc_icon"></i></a>';
        $controls_clone  = ' <a class="vc_control column_clone vc_column-clone" href="#" title="' . __('Clone this Page Section', 'mk_framework') . '" data-vc-control="clone"><i class="vc_icon"></i></a>';
        $controls_toggle = ' <span class="vc_control vc_row_section_mark" title="" style="line-height: 16px; height: 16px; text-transform: uppercase; color: #878787; font-size: 11px;" >' . __('Page Section', 'mk_framework') . '</span><a class="vc_control column_toggle vc_column-toggle" href="#" title="' . __('Toggle Page Section', 'mk_framework') . '" data-vc-control="toggle"><i class="vc_icon"></i></a>';
        if (is_array($controls) && !empty($controls)) {
            foreach ($controls as $control) {
                $control_var = 'controls_' . $control;
                $output .= $$control_var;
            }
            $output .= $controls_end;
        } elseif (is_string($controls)) {
            $control_var = 'controls_' . $controls;
            $output .= $$control_var . $controls_end;
        } else {
            $row_edit_clone_delete = '<span class="vc_row_edit_clone_delete">';
            $row_edit_clone_delete .= $controls_delete . $controls_clone . $controls_edit . $controls_toggle;
            $row_edit_clone_delete .= '</span>';
            
            //$column_controls_full =  $controls_start. $controls_move . $controls_center_start . $controls_layout . $controls_delete . $controls_clone . $controls_edit . $controls_center_end . $controls_end;
            $output .= $controls_move . $controls_layout . $controls_add . $row_edit_clone_delete . $controls_end;
        }
        return $output;
    }
    
    public function contentAdmin( $atts, $content = null ) {
        $width = $el_class = '';
        $atts = shortcode_atts( $this->predefined_atts, $atts );

        $output = ''; 

        $column_controls = $this->getColumnControls( $this->settings( 'controls' ) );

        for ( $i = 0; $i < count( $width ); $i ++ ) {
            $output .= '<div data-element_type="' . $this->settings['base'] . '" class="' . $this->cssAdminClass() . '">';
            $output .= str_replace( '%column_size%', 1, $column_controls );
            $output .= '<div class="wpb_element_wrapper">';
            $output .= '<div class="vc_row vc_row-fluid wpb_row_container vc_container_for_children">';
            if ( '' === $content && ! empty( $this->settings['default_content_in_template'] ) ) {
                $output .= do_shortcode( shortcode_unautop( $this->settings['default_content_in_template'] ) );
            } else {
                $output .= do_shortcode( shortcode_unautop( $content ) );

            }
            $output .= '</div>';
            if ( isset( $this->settings['params'] ) ) {
                $inner = '';
                foreach ( $this->settings['params'] as $param ) {
                    if ( ! isset( $param['param_name'] ) ) {
                        continue;
                    }
                    $param_value = isset( $atts[ $param['param_name'] ] ) ? $atts[ $param['param_name'] ] : '';
                    if ( is_array( $param_value ) ) {
                        // Get first element from the array
                        reset( $param_value );
                        $first_key = key( $param_value );
                        $param_value = $param_value[ $first_key ];
                    }
                    $inner .= $this->singleParamHtmlHolder( $param, $param_value );
                }
                $output .= $inner;
            }
            $output .= '</div>';
            $output .= '</div>';
        }

        return $output;
    }
    
    public function cssAdminClass()
    {
        return 'wpb_' . $this->settings['base'] . ' wpb_sortable';
    }
    
    /**
     * @deprecated - due to it is not used anywhere?
     * @typo Bock - Block
     * @return string
     */
    public function customAdminBockParams()
    {
        return '';
    }
    
    public function buildStyle($bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '')
    {
        $has_image = false;
        $style     = '';
        if ((int) $bg_image > 0 && ($image_url = wp_get_attachment_url($bg_image, 'large')) !== false) {
            $has_image = true;
            $style .= "background-image: url(" . $image_url . ");";
        }
        if (!empty($bg_color)) {
            $style .= vc_get_css_color('background-color', $bg_color);
        }
        if (!empty($bg_image_repeat) && $has_image) {
            if ($bg_image_repeat === 'cover') {
                $style .= "background-repeat:no-repeat;background-size: cover;";
            } elseif ($bg_image_repeat === 'contain') {
                $style .= "background-repeat:no-repeat;background-size: contain;";
            } elseif ($bg_image_repeat === 'no-repeat') {
                $style .= 'background-repeat: no-repeat;';
            }
        }
        if (!empty($font_color)) {
            $style .= vc_get_css_color('color', $font_color);
            
            // 'color: '.$font_color.';';
            
            
        }
        if ($padding != '') {
            $style .= 'padding: ' . (preg_match('/(px|em|\%|pt|cm)$/', $padding) ? $padding : $padding . 'px') . ';';
        }
        if ($margin_bottom != '') {
            $style .= 'margin-bottom: ' . (preg_match('/(px|em|\%|pt|cm)$/', $margin_bottom) ? $margin_bottom : $margin_bottom . 'px') . ';';
        }
        
        return empty($style) ? $style : ' style="' . esc_attr($style) . '"';
    }
}
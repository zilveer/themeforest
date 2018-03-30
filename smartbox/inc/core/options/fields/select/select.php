<?php
/**
 * Textarea option
 *
 * @package Smartbox
 * @subpackage Core
 * @since 1.0
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

/**
 * Simple Select option
 */
class OxySelect extends OxyOption {

    /**
     * Creates option
     *
     * @return void
     * @since 1.0
     **/
    function __construct( $field, $value, $attr ) {
        parent::__construct( $field, $value, $attr );

    }

    /**
     * Overrides super class render function
     *
     * @return string HTML for option
     * @since 1.0
     **/
    public function render($echo = true) {
        //if it is not an array , search the backend for the select options
        if( !is_array( $this->_field['options'] ) ) {
            $this->load_select_options( $this->_field['options'] );
        }

        $option = '<select' . $this->create_attributes() . '>';

        if( isset( $this->_field['blank'] ) ) {
            $option .= '<option value="">' . $this->_field['blank'] . '</option>';
        }

        $option .= $this->create_select_options( $this->_field['options'], $this->_value );

        $option .= '</select>';

        echo $option;
    }



    function load_select_options( $database ) {
        $data = $this->load_select_data( $database );
        $this->build_options_from_data( $database, $data );
    }


    function load_select_data( $database ) {
        // get data
        $data = array();
        switch( $database ) {
            case 'taxonomy':
                if (isset($this->_field['taxonomy'])) {
                    if (isset($this->_field['blank_label'])) {
                        $this->_field['blank'] = $this->_field['blank_label'];
                    }
                    switch ($this->_field['taxonomy']) {
                        case 'pages':
                            $data = get_pages();
                            break;
                        case 'posts':
                            $data = get_posts(array('posts_per_page'=> -1));
                            break;
                        case 'oxy_portfolio_image':
                            $data = get_posts(array('posts_per_page'=> -1, 'post_type'=>'oxy_portfolio_image'));
                            break;
                        default:
                            $data = get_categories(array('orderby' => 'name', 'hide_empty' => '0', 'taxonomy' => $this->_field['taxonomy']));
                            break;
                    }
                }
                break;

            case 'slideshow':
                $this->_field['blank'] = __('Select a Slideshow', THEME_ADMIN_TD);
                $data = get_categories( array( 'orderby' => 'name', 'hide_empty' => '0', 'taxonomy' => 'oxy_slideshow_categories' ) );
            break;

            case 'get_option':
                $options = get_option( THEME_SHORT. '-options' );
                if( isset( $options['unregistered'][$this->_field['option']] ) ) {
                    $data = oxy_get_option( $this->_field['option'] );
                    $unregistered = oxy_get_option( 'unregistered' );
                    $data = $options['unregistered'][$this->_field['option']];
                }else {
                    $data = null;
                }
            break;

            case 'staff_featured':
                $this->_field['blank'] = __('Select a Staff member', THEME_ADMIN_TD);
                $posts =  get_posts( "showposts=-1&post_type=oxy_staff" );
                foreach ($posts as $staff):
                    $data[$staff->post_title] = $staff->ID;
                endforeach;
            break;

            case 'categories':
                $this->_field['blank'] = __('all categories', THEME_ADMIN_TD);
                $data = get_categories(array('orderby' => 'name', 'hide_empty' => '0') );
            break;
            case 'portfolios':
                $this->_field['blank'] = __('Select a Portfolio', THEME_ADMIN_TD);
                $data = get_categories( array( 'orderby' => 'name', 'hide_empty' => '0', 'taxonomy' => 'oxy_portfolio_categories' ) );
            break;

            case 'social_icons':
                $data = include OPTIONS_DIR . 'icons/social.php';
            break;

            default:
                $data = array();
            break;
        }
        return $data;
    }

    function build_options_from_data( $database, $data ) {
        $this->_field['options'] = array();
        if( !empty( $data ) ) {
            foreach( $data as $key => $entry ) {
                switch ( $database ) {
                    case 'slideshow':
                    case 'taxonomy':
                        switch ($this->_field['taxonomy']) {
                            case 'pages':
                            case 'posts':
                            case 'oxy_portfolio_image':
                                $this->_field['options'][$entry->ID] = $entry->post_title;
                                break;
                            default:
                                $this->_field['options'][$entry->slug] = $entry->name;
                                break;
                        }
                        break;
                    case 'categories':
                    case 'portfolios':
                        $this->_field['options'][$entry->slug] = $entry->name;
                    break;

                    case 'get_option':
                    case 'staff_featured':
                        $this->_field['options'][$entry] = $key;
                    break;

                    case 'social_icons':
                        $this->_field['options'][$key] = $entry;
                    break;
                    default:
                        $this->_field['options'][$entry] = $entry;
                    break;
                }
            }
        }
    }

    function create_select_options( $options, $selected_value ) {
        $options_html = '';
        // check for optgroup
        if( isset( $options['label'] ) ) {
            $label = $options['label'];
            $options_html .= '<optgroup label="' . $label . '">';
            $options_html .= $this->create_select_options( $options['options'], $selected_value );
        }else {
            foreach( $options as $key => $name ) {
                $options_html .= '<option value="' . $key . '"';
                if( is_array( $selected_value ) ) {
                    foreach( $selected_value as $multi_val ) {
                        if( $multi_val == $key ) {
                            $selected = $key;
                            $options_html .= ' selected="selected"';
                        }
                    }
                }
                if( $selected_value == $key ) {
                    $selected = $key;
                    $options_html .= ' selected="selected"';
                }
                $options_html .= '>' . $name . '</option>';
            }
        }
        if( isset( $options['label'] ) ) {
            $options_html .= '</optgroup>';
        }
        return $options_html;
    }

}
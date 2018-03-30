<?php

/**
 * Widget that adds separator shortcode
 *
 * Class Separator_Widget
 */
class HashmagMikadoSeparatorWidget extends HashmagMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkdf_separator_widget', // Base ID
            'Mikado Separator Widget' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type' => 'dropdown',
                'title' => 'Type',
                'name' => 'type',
                'options' => array(
                    'normal' => 'Normal',
                    'full-width' => 'Full Width'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Position',
                'name' => 'position',
                'options' => array(
                    'center' => 'Center',
                    'left' => 'Left',
                    'right' => 'Right'
                )
            ),
            array(
                'type' => 'dropdown',
                'title' => 'Style',
                'name' => 'border_style',
                'options' => array(
                    'solid' => 'Solid',
                    'dashed' => 'Dashed',
                    'dotted' => 'Dotted'
                )
            ),
            array(
                'type' => 'textfield',
                'title' => 'Color',
                'name' => 'color'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Width',
                'name' => 'width',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Thickness (px)',
                'name' => 'thickness',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Top Margin',
                'name' => 'top_margin',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Bottom Margin',
                'name' => 'bottom_margin',
                'description' => ''
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkdf-separator-widget">';

        //finally call the shortcode
        echo do_shortcode("[mkdf_separator $params]"); // XSS OK

        echo '</div>'; //close div.mkdf-separator-widget
    }
}
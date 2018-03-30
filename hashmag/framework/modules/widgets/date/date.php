<?php

/**
 * Widget that adds date
 *
 * Class Date_Widget
 */
class HashmagMikadoDateWidget extends HashmagMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkdf_date_widget', // Base ID
            'Mikado Date Widget' // Name
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
                'title' => 'Date Format',
                'name' => 'date_format',
                'options' => array(
                    'm/d/Y' => '06/11/2015',
                    'd/m/Y' => '11/23/2015',
                    'Y/m/d' => '2015/11/06',
                    'j F, Y' => '6 November, 2015',
                    'F j, Y' => 'November 6, 2015',
                    'j M Y' => '6 Nov 2015',
                    'M j Y' => 'Nov 6 2015',
                    'l, F j, Y' => 'Friday, November 6, 2015',
                    'l, F jS, Y' => 'Friday, November 6th, 2015',
                    'l, M j, Y' => 'Friday, Nov 6, 2015',
                    'l, M jS, Y' => 'Friday, Nov 6th, 2015',
                ),
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Custom Date Format',
                'name' => 'custom_date_format',
                'description' => 'The custom format for the date widget. See Formatting Date and Time https://codex.wordpress.org/Formatting_Date_and_Time'
            ),
            array(
                'type' => 'textfield',
                'title' => 'Text Size (px)',
                'name' => 'text_size',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'title' => 'Color',
                'name' => 'color',
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

        $date_widget_styles = array();

        if (!empty($instance['color']) && $instance['color'] !== '') {
            $date_widget_styles[] = 'color: '.$instance['color'];
        }

        if (!empty($instance['text_size']) && $instance['text_size'] !== '') {
            $date_widget_styles[] = 'font-size: '.$instance['text_size'].'px';
        }

        $date_format = 'l, F jS, Y';
        if (!empty($instance['date_format']) && $instance['date_format'] !== '') {
            $date_format = $instance['date_format'];
        }

        if (!empty($instance['custom_date_format']) && $instance['custom_date_format'] !== '') {
            $date_format = esc_html($instance['custom_date_format']);
        }
        ?>

        <div class="widget mkdf-date-widget-holder" <?php hashmag_mikado_inline_style($date_widget_styles); ?>>
            <?php echo date($date_format, current_time('timestamp', 1)); ?>
        </div>
    <?php
    }
}
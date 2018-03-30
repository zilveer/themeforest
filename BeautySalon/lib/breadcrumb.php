<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

class bdt_Breadcrumbs extends WP_Widget {

    function bdt_Breadcrumbs() {
        $widget_ops = array('description' => 'Display your sites breadcrumb navigation');
        parent::WP_Widget(false, 'BdThemes - Breadcrumbs', $widget_ops);      
    }

    function widget($args, $instance) {

        global $wp_query;
        
        extract($args);
        
        echo $before_widget;

        if (class_exists('Breadcrumb_Trail')) {
            breadcrumb_trail();
        }
        else {
            echo 'Breadcrumb plugin not found!';
        }

        echo $after_widget;
       
    }

    function update($new_instance, $old_instance) {                
        return $new_instance;
    }

    function form($instance) {        
       
       ?>
       <p>
        <label>This widget have no option. This widegt show breadcrumb in your site.</label>
       </p>

       <?php 

    }
} 

register_widget('bdt_Breadcrumbs');
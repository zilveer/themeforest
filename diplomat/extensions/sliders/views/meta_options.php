<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="1" name="tmm_meta_saving" />

    <div class="slider_options">

        <?php
        /*
        TMM_Slider :: draw_slider_option(array(
            'title' => __('Slider Height (px)', 'diplomat'),
            'type' => 'text',
            'name' => 'slider_settings[height]',
            'default_value' => 690,
            'value' => (isset($data['slider_options']['height'])) ? $data['slider_options']['height'] : 690,
            'description' => '',
            'css_class' => 'slider_height',
            'custom_html' => ''
                )
            );
        */
        TMM_Slider :: draw_slider_option(array(
            'title' => __('Pagination (On / Off)', 'diplomat'),
            'type' => 'checkbox',
            'name' => 'slider_settings[pagination]',
            'value' => (isset($data['slider_options']['pagination'])) ? $data['slider_options']['pagination'] : 1,
            'default_value' => 1,
            'description' => '',
            'custom_html' => ''
                )
            );

        TMM_Slider :: draw_slider_option(array(
            'title' => __('AutoPlay (On / Off)', 'diplomat'),
            'type' => 'checkbox',
            'name' => 'slider_settings[autoplay]',
            'value' => (isset($data['slider_options']['autoplay'])) ? $data['slider_options']['autoplay'] : 0,
            'default_value' => 0,
            'description' => '',
            'custom_html' => ''
                )
            );

        TMM_Slider :: draw_slider_option(array(
            'title' => __('Auto Play Delay', 'diplomat'),
            'type' => 'text',
            'name' => 'slider_settings[delay]',
            'value' => (isset($data['slider_options']['delay'])) ? $data['slider_options']['delay'] : '5000',
            'default_value' => '5000',
            'description' => '',
            'custom_html' => ''
                )
            );

        TMM_Slider :: draw_slider_option(array(
            'title' => __('Speed', 'diplomat'),
            'type' => 'text',
            'value' => (isset($data['slider_options']['speed'])) ? $data['slider_options']['speed'] : '500',
            'name' => 'slider_settings[speed]',
            'default_value' => '500',
            'description' => '',
            'custom_html' => ''
                )
            );
            ?>
    </div>
<script>
    jQuery(function(){

        if(jQuery('.fullscreen').prev().val()==true){
            jQuery('.slider_height').parent().parent().hide();
        }
        jQuery('.fullscreen').on('change', function(){            
           if (jQuery(this).val()== true){
                jQuery('.slider_height').parent().parent().fadeOut();                
           } else{               
               jQuery('.slider_height').parent().parent().fadeIn();
           }
        });

    });
</script>

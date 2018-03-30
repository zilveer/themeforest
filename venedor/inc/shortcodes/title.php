<?php
  
// Title
add_shortcode('title', 'venedor_shortcode_title');
function venedor_shortcode_title($atts, $content = null) {
    
    extract(shortcode_atts(array(
        'title' => '',
        'title_transform' => '',
        'title_fontsize' => '',
        'desc' => '',
        'desc_fontsize' => '',
        'size' => '',
        'show_line' => 'true',
        'line_pos' => 'middle',
        'line_width' => '40px',
        'line_color' => '',
        'align' => 'center',
        'color' => '',
        'shadow' => '',
        'animation_type' => '',
        'animation_duration' => 1,
        'animation_delay' => 0,
        'class' => ''
    ), $atts));
    
    ob_start();
    ?>
    <div class="shortcode shortcode-title text-<?php echo $align ?> <?php echo $class ?> <?php if ($size) echo $size; ?> <?php if ($animation_type) echo 'animated' ?>"
        <?php if ($animation_type) : ?>
         animation_type="<?php echo $animation_type ?>" animation_duration="<?php echo $animation_duration ?>" animation_delay="<?php echo $animation_delay ?>"
        <?php endif; ?>>
        <?php if ($show_line == 'true' && $line_pos == 'top') : ?>
        <div class="line line-top" style="<?php if ($title_fontsize) echo 'margin-top:'.($title_fontsize * 0.5).'px;' ?><?php if ($line_width) echo ' width:'.$line_width.';' ?><?php if ($line_color) echo ' background-color:'.$line_color.';'; else if ($color) echo ' background-color:'.$color.';'; ?><?php if ($shadow) echo ' -webkit-box-shadow:'.$shadow.'; -moz-box-shadow:'.$shadow.'; box-shadow:'.$shadow.';' ?>"></div>
        <?php endif; ?>
        
        <?php if ($title) : ?>
        <h2 style="<?php if ($color) echo ' color:'.$color.';' ?><?php if ($title_fontsize) echo ' font-size:'.$title_fontsize.';' ?><?php if ($shadow) echo ' text-shadow:'.$shadow.';' ?><?php if ($title_transform) echo ' text-transform:'.$title_transform.';' ?>"><?php echo $title ?></h2>
        <?php endif; ?>
        
        <?php if ($show_line == 'true' && (!$line_pos || $line_pos == "middle")) : ?>
        <div class="line" style="<?php if ($title_fontsize) echo 'margin-top:'.($title_fontsize * 0.5).'px; margin-bottom:'.($title_fontsize * 0.5).'px;' ?><?php if ($line_width) echo ' width:'.$line_width.';' ?><?php if ($line_color) echo ' background-color:'.$line_color.';'; else if ($color) echo ' background-color:'.$color.';'; ?><?php if ($shadow) echo ' -webkit-box-shadow:'.$shadow.'; -moz-box-shadow:'.$shadow.'; box-shadow:'.$shadow.';' ?>"></div>
        <?php endif; ?>
        
        <?php if ($desc) : ?>
        <div class="title-desc" style="<?php if ($desc_fontsize) echo ' font-size:'.$desc_fontsize.';' ?><?php if ($color) echo ' color:'.$color.';' ?><?php if ($shadow) echo ' text-shadow:'.$shadow.';' ?>"><?php echo $desc ?></div>
        <?php endif; ?>
        
        <?php if ($show_line == 'true' && $line_pos == 'bottom') : ?>
        <div class="line line-bottom" style="<?php if ($title_fontsize) echo 'margin-top:'.($title_fontsize * 0.5).'px; margin-bottom:'.($title_fontsize * 0.5).'px;' ?><?php if ($line_width) echo ' width:'.$line_width.';' ?><?php if ($line_color) echo ' background-color:'.$line_color.';'; else if ($color) echo ' background-color:'.$color.';'; ?><?php if ($shadow) echo ' -webkit-box-shadow:'.$shadow.'; -moz-box-shadow:'.$shadow.'; box-shadow:'.$shadow.';' ?>"></div>
        <?php endif; ?>
    </div>
    <?php
    $str = ob_get_contents();
    ob_end_clean();
    
    return $str;
}

// Register Shortcodes in Visual Composer Editor
if (function_exists('vc_set_as_theme')) {

    function venedor_vc_shortcode_title() {
        $vc_icon = venedor_vc_icon().'title.png';
        $animation_type = venedor_vc_animation_type();
        $animation_duration = venedor_vc_animation_duration();
        $animation_delay = venedor_vc_animation_delay();
        $custom_class = venedor_vc_custom_class();

        vc_map( array(
            "name" => "Title",
            "base" => "title",
            "category" => "Venedor",
            "icon" => $vc_icon,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => "Title",
                    "param_name" => "title",
                    "admin_label" => true
                ),
                array(
                    "type" => "text_transform",
                    "heading" => "Title Text Transform",
                    "param_name" => "title_transform"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Title Font Size",
                    "param_name" => "title_fontsize"
                ),
                array(
                    "type" => "textarea",
                    "heading" => "Description",
                    "param_name" => "desc"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Desc Font Size",
                    "param_name" => "desc_fontsize"
                ),
                array(
                    "type" => "title_size",
                    "heading" => "Title Size",
                    "param_name" => "size"
                ),
                array(
                    "type" => "boolean",
                    "heading" => "Show Line",
                    "param_name" => "show_line",
                    "value" => "true"
                ),
                array(
                    "type" => "line_pos",
                    "heading" => "Line Position",
                    "param_name" => "line_pos",
                    "value" => "middle"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Line Width",
                    "param_name" => "line_width",
                    "value" => "40px"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Line Color",
                    "param_name" => "line_color"
                ),
                array(
                    "type" => "align",
                    "heading" => "Align",
                    "param_name" => "align",
                    "value" => "center"
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => "Text Color",
                    "param_name" => "color"
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Text Shadow",
                    "param_name" => "shadow"
                ),
                $animation_type,
                $animation_duration,
                $animation_delay,
                $custom_class
            )
        ) );

        if ( class_exists( 'WPBakeryShortCode' ) ) {
            class WPBakeryShortCode_Title extends WPBakeryShortCode {
            }
        }
    }
}
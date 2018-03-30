<?php


add_action('wp_head','add_style_css');
add_action('wp_head','add_initialize_js');

function add_style_css()
{
    
    $style = '';
    $typography = apply_filters('generate_css_typography', '');
    if(!empty($typography)){
        $replace = array(
            '.nav'  =>    '#navigation ul li a',
        );
        $typography = str_replace(array_keys($replace),array_values($replace),$typography);
        $style .=$typography;
    }

    if($style) {
        ///$style = sprintf("<style>%s</style>",$style);
        echo $style;
    }

}

function add_initialize_js()
{
    $options = get_options();

    $script ='';
    $is_customize_mode =  (has_action( 'customize_controls_init' )) ? true : false;
    if($is_customize_mode)
        $script .="var template_uri ='".get_template_directory_uri()."'";
    if(!empty($script)) {
        $script = sprintf("<script>%s</script>",$script);
        echo $script;
    }


}


?>
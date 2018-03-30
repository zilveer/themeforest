<?php
global $jaw_data;

$style = array();
$style[] = 'background: ' . jaw_template_get_var('color');
$style[] = 'border-color: ' . jaw_template_get_var('border_color');
$style[] = 'border-width: ' . jaw_template_get_var('border_width') . 'px';
$style[] = 'border-style: ' . jaw_template_get_var('border_type');

$button_possition = jaw_template_get_var('cta_button_possition');
$button_class = '';
$textarea_class = '';
?>

<div class="row">
    <div class="col-lg-<?php echo jaw_template_get_var('box_size'); ?>">

        <?php if ($button_possition == 'right') { ?>
            <div class="ctv_section" style="<?php echo implode(';', $style); ?>;">
                <div class="cta-table right" style="display:table;">   
                    <?php
                    $class = 'cta-table-item';

                    ob_start();
                    ?>
                    <div class="<?php echo $class; ?>">
                        <div class="textarea fullwidht-textarea"><?php echo do_shortcode(jaw_template_get_var('text')); ?></div>
                    </div>
                    <?php
                    echo ob_get_clean();

                    $button_size = jaw_template_get_var('cta_button_size');
                    if ($button_size == "default") {
                        $button_size = "";
                    }
                    $button_style_color = array();
                    $button_style_color[] = 'background-color: ' . jaw_template_get_var('cta_button_bg_color');
                    $button_style_color[] = 'color: ' . jaw_template_get_var('cta_button_font_color');
                    $button_style_color[] = 'border: 1px solid ' . jaw_template_get_var('cta_button_border_color');
                    ob_start();
                    ?>  
                    <div class="button <?php echo $class; ?>">
                        <?php
                        $link = jaw_template_get_var('link');
                        if (strlen($link) == 0 || $link == 'http://') {
                            $link = '#';
                        }
                        ?>
                        <?php if (jaw_template_get_var('button_type') == 'button') { ?>
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <button type="button" class="btn <?php echo $button_size; ?>" style="<?php echo implode(';', $button_style_color); ?>"><?php echo jaw_template_get_var('title'); ?></button>
                            </a>
                        <?php } else { ?>
                            <a class="cta-icon-link" href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <span class="cta-icon <?php echo jaw_template_get_var('icon'); ?>" style="<?php echo 'color: ' . jaw_template_get_var('cta_button_font_color'); ?>"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    echo ob_get_clean();
                    ?>
                </div>
            </div>
        <?php } ?>   

        <?php if ($button_possition == 'left') { ?>
            <div class="ctv_section" style="<?php echo implode(';', $style); ?>;">
                <div class="cta-table left">   
                    <?php
                    $class = 'cta-table-item';
                    $button_size = jaw_template_get_var('cta_button_size');
                    if ($button_size == "default") {
                        $button_size = "";
                    }
                    $button_style_color = array();
                    $button_style_color[] = 'background-color: ' . jaw_template_get_var('cta_button_bg_color');
                    $button_style_color[] = 'color: ' . jaw_template_get_var('cta_button_font_color');
                    $button_style_color[] = 'border: 1px solid ' . jaw_template_get_var('cta_button_border_color');
                    ob_start();
                    ?>  
                    <div class="button <?php echo $class; ?>">
                        <?php
                        $link = jaw_template_get_var('link');
                        if (strlen($link) == 0 || $link == 'http://') {
                            $link = '#';
                        }
                        ?>
                        <?php if (jaw_template_get_var('button_type') == 'button') { ?>
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <button type="button" class="btn <?php echo $button_size; ?>" style="<?php echo implode(';', $button_style_color); ?>"><?php echo jaw_template_get_var('title'); ?></button>
                            </a>
                        <?php } else { ?>
                            <a class="cta-icon-link" href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <span class="cta-icon <?php echo jaw_template_get_var('icon'); ?>" style="<?php echo 'color: ' . jaw_template_get_var('cta_button_font_color'); ?>"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    echo ob_get_clean();

                    ob_start();
                    ?>
                    <div class="<?php echo $class; ?>">
                        <div class="textarea fullwidht-textarea"><?php echo do_shortcode(jaw_template_get_var('text')); ?></div>
                    </div>
                    <?php
                    echo ob_get_clean();
                    ?>
                </div>  
            </div>
        <?php } ?> 

        <?php if ($button_possition == 'top') { ?>
            <div class="ctv_section" style="<?php echo implode(';', $style); ?>;">
                <div class="cta-block top"> 
                    <?php
                    $class = 'block';
                    $button_size = jaw_template_get_var('cta_button_size');
                    if ($button_size == "default") {
                        $button_size = "";
                    }
                    $button_style_color = array();
                    $button_style_color[] = 'background-color: ' . jaw_template_get_var('cta_button_bg_color');
                    $button_style_color[] = 'color: ' . jaw_template_get_var('cta_button_font_color');
                    $button_style_color[] = 'border: 1px solid ' . jaw_template_get_var('cta_button_border_color');
                    ob_start();
                    ?>  
                    <div class="button <?php echo $class; ?>">
                        <?php
                        $link = jaw_template_get_var('link');
                        if (strlen($link) == 0 || $link == 'http://') {
                            $link = '#';
                        }
                        ?>
                        <?php if (jaw_template_get_var('button_type') == 'button') { ?>
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <button type="button" class="btn <?php echo $button_size; ?>" style="<?php echo implode(';', $button_style_color); ?>"><?php echo jaw_template_get_var('title'); ?></button>
                            </a>
                        <?php } else { ?>
                            <a class="cta-icon-link" href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <span class="cta-icon <?php echo jaw_template_get_var('icon'); ?>" style="<?php echo 'color: ' . jaw_template_get_var('cta_button_font_color'); ?>"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    echo ob_get_clean();

                    ob_start();
                    ?>
                    <div class="<?php echo $class; ?>">
                        <div class="textarea fullwidht-textarea"><?php echo do_shortcode(jaw_template_get_var('text')); ?></div>
                    </div>
                    <?php
                    echo ob_get_clean();
                    ?>
                </div>
            </div>
        <?php } ?> 

        <?php if ($button_possition == 'bottom') { ?>
            <div class="ctv_section" style="<?php echo implode(';', $style); ?>;">                
                <div class="cta-block bottom"> 
                    <?php
                    $class = 'block';
                    ob_start();
                    ?>
                    <div class="<?php echo $class; ?>">
                        <div class="textarea fullwidht-textarea"><?php echo do_shortcode(jaw_template_get_var('text')); ?></div>
                    </div>
                    <?php
                    echo ob_get_clean();

                    $button_size = jaw_template_get_var('cta_button_size');
                    if ($button_size == "default") {
                        $button_size = "";
                    }
                    $button_style_color = array();
                    $button_style_color[] = 'background-color: ' . jaw_template_get_var('cta_button_bg_color');
                    $button_style_color[] = 'color: ' . jaw_template_get_var('cta_button_font_color');
                    $button_style_color[] = 'border: 1px solid ' . jaw_template_get_var('cta_button_border_color');
                    ob_start();
                    ?>  
                    <div class="button <?php echo $class; ?>">
                        <?php
                        $link = jaw_template_get_var('link');
                        if (strlen($link) == 0 || $link == 'http://') {
                            $link = '#';
                        }
                        ?>
                        <?php if (jaw_template_get_var('button_type') == 'button') { ?>
                            <a href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <button type="button" class="btn <?php echo $button_size; ?>" style="<?php echo implode(';', $button_style_color); ?>"><?php echo jaw_template_get_var('title'); ?></button>
                            </a>
                        <?php } else { ?>
                            <a class="cta-icon-link" href="<?php echo esc_url($link); ?>" target="<?php echo jaw_template_get_var('target'); ?>">
                                <span class="cta-icon <?php echo jaw_template_get_var('icon'); ?>" style="<?php echo 'color: ' . jaw_template_get_var('cta_button_font_color'); ?>"></span>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                    echo ob_get_clean();
                    ?>
                </div>
            </div>
        <?php } ?> 

    </div>
</div>


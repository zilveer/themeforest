<?php
$my_id = rand(0, 9999);
$slides = jaw_template_get_var('slides');

$lookbook = jaw_template_get_var('lookbook_products', 'off');
$lookbook_class = '';
if ($lookbook == 'on') {
    $lookbook_class = 'lookbook';
}
?>
<div class="row">
    <div class="col-lg-12">
        <noscript>
        For show Slider please allow javascript in your browser.
        </noscript>
        <div id="jaw_slider_<?php echo $my_id; ?>" class="jaw_slider <?php echo jaw_template_get_var('post_type', 'post') .' '. $lookbook_class; ?>" style=" color: <?php echo jaw_template_get_var('info_text_color'); ?>;"> 
            <?php if (sizeof($slides) >= 5) { ?>
                <div class="jaw_slider_row">
                    <?php
                    foreach ($slides as $key => $slide) {
                        ?>
                        <div class="jaw_one_slide slide-<?php echo $key; ?>" data-sld="<?php echo $key; ?>" data-link="<?php echo $slide['link']; ?>">
                            
                            <?php echo $slide['thumbnail']; ?>
                            <?php
                            $color = jwStyle::hex2rgb(jaw_template_get_var('info_color'));

                            $color_rgb = 'rgb(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ')';
                            $color_rgba = 'rgba(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ',' . (jaw_template_get_var('info_opacity') / 100) . ')';
                            ?>
                            <div class="jaw_content" style="background: <?php echo $color_rgb; ?> ; background: <?php echo $color_rgba; ?>;filter: alpha(opacity=<?php echo jaw_template_get_var('info_opacity'); ?>);">
                                <h3>
                                    <a href="<?php echo $slide['link']; ?>" >
                                        <?php if ($lookbook == 'on') { 
                                            echo $slide['alt_lb_title'];                                            
                                        } else { 
                                            echo $slide['title'];
                                        } ?>
                                    </a>
                                </h3>
                                <?php if (isset($slide['price'])) { ?>
                                    <?php if ($lookbook == 'on') { ?> 
                                        <p><?php echo $slide['alt_lb_desc']; ?></p>
                                    <?php } else { ?>
                                        <span class="price"><?php echo $slide['price']; ?></span>
                                    <?php } ?>                                    
                                <?php } else { ?>
                                    <p><?php echo $slide['content']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <span class="bullet_row">

                    <span class="bull arrow" data-direction="right"><i class="icon-icon-circle-arrow-left-gs"></i></span>
                    <?php
                    $i = 0;
                    foreach ($slides as $key => $slide) {
                        ?>
                        <span class="bullet bull" data-sld="<?php echo $i; ?>"><i class="icon-radio-unchecked "></i></span>
                        <?php
                        $i++;
                    }
                    ?>
                    <span class="bull arrow" data-direction="left"><i class="icon-icon-circle-arrow-right-gs"></i></span>
                    <div class="clear"></div>
                </span>
                <script>jQuery(document).ready(function() {
                        jQuery("#jaw_slider_<?php echo $my_id; ?>").jawSlider({animationSpeed:<?php echo jaw_template_get_var('animate_duration'); ?>, animationDelay: "<?php echo jaw_template_get_var('animate_latency'); ?>", animationStep: 489})
                    });</script>
                <?php
            }
            ?>
        </div>
    </div>
</div>
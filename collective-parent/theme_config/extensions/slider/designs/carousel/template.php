<?php
    $info_text = $slider['general']['slider_info_text'];
    $btn_text = $slider['general']['slider_more_text'];
    $btn_link = $slider['general']['slider_more_link'];
    $background = $slider['general']['slider_background'];
    if($background != '') $style = 'background: url('.$background.')';
    else $style = '';
    $uniq = rand(1,100);
?>
<div class="middle_row clearfix">
    <div class="middle_slider clearfix" style="<?php echo $style; ?>">
        <div class="notebook">
            <div id="notebook_carousel<?php echo $uniq; ?>">
                <?php foreach ($slider['slides'] as $slide){ ?>
                    <img src="<?php echo $slide['slide_src']; ?>" alt="<?php echo $slide['slide_title']; ?>">
                <?php } ?>
            </div>
            <div class="notebook_nav">
                <a class="prev" id="notebook_item_prev<?php echo $uniq; ?>" href="#"></a>
                <a class="next" id="notebook_item_next<?php echo $uniq; ?>" href="#"></a>
            </div>
            <script>
                jQuery(window).load(function() {
                    jQuery("#notebook_carousel<?php echo $uniq; ?>").carouFredSel({
                        width: "100%",
                        height: "variable",
                        items: {
                            visible: "variable",
                            minimum: 1,
                            width: "variable",
                            height: "variable"
                        },
                        scroll: {
                            items: 1,
                            pauseOnHover: true,
                            fx:"crossfade"
                        },
                        auto: 7000,
                        prev: "#notebook_item_prev<?php echo $uniq; ?>",
                        next: "#notebook_item_next<?php echo $uniq; ?>",
                        swipe: true,
                        mousewheel: false
                    });
                });
            </script>
        </div>
        <div class="middle_slider_txt">
            <h2><?php echo $info_text; ?></h2>
            <a href="<?php echo $btn_link; ?>" class="button large dark_green"><span><?php echo $btn_text; ?></span></a>
        </div>
    </div>
</div>
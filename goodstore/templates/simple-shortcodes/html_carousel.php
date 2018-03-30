<?php
$first = 'active';
global $wp_query, $jaw_data;

jaw_template_inc_counter('carousel');

$post_in_slide = jaw_template_get_var('post_in_slide', 3);
$one_width = jaw_template_get_var('size', 3);
$content = jaw_template_get_var('content');


$size = jaw_template_get_var('size');
?>

<div id="jaw-carousel-<?php echo jaw_template_get_counter('carousel'); ?>" class="carousel horizontal slide navigation-<?php echo jaw_template_get_var('carousel_style', 'bar'); ?>">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $count = 0;
        $konec = true;
        ?>
        <?php
        if (isset($content)) {
            if (is_array($content)) {
                foreach ((array) $content as $k => $c) {
                    if (isset($c->content)) {
                        ?>
                        <?php if ($count % $post_in_slide == 0) { ?>  
                            <?php $konec = false; ?>
                            <div class="item <?php echo $first; ?>">
                                <div class="carousel-caption row">
                                    <?php
                                    $first = '';
                                    ?>  
                                    <div class="col-lg-<?php echo $size; ?>">
                                        <?php
                                        echo do_shortcode($c->content);
                                        ?> 
                                    </div>
                                <?php } else { ?>
                                    <div class="col-lg-<?php echo $size; ?>">
                                        <?php
                                        echo do_shortcode($c->content);
                                        ?>
                                    </div>
                                <?php } ?> 
                                <?php $count++; ?>      

                                <?php if ($count % $post_in_slide == 0) { ?>
                                </div>
                            </div>
                            <?php $konec = true; ?>
                        <?php } ?> 

                        <?php
                    }
                }
            } else {
                jaw_template_set_var('items_in_slide', $post_in_slide);
                jaw_template_set_var('one_width', $one_width);
                jaw_template_set_var('first', 'active');
                echo do_shortcode($content);
            }
        }
        ?>        
        <?php if ($konec) { ?>
        </div>
    <?php } else { ?>           
    </div></div></div>
<?php } ?>

<!-- Controls -->
<a class="left carousel-control" href="#jaw-carousel-<?php echo jaw_template_get_counter('carousel'); ?>" data-slide="prev">
    <span class="icon-prev"></span>
</a>
<a class="right carousel-control" href="#jaw-carousel-<?php echo jaw_template_get_counter('carousel'); ?>" data-slide="next">
    <span class="icon-next"></span>
</a>

</div>
<?php if (jaw_template_get_var('automatic_slide', '0') == '1') { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('#jaw-carousel-<?php echo jaw_template_get_counter('carousel'); ?>').carousel({
                interval: 5000
            });
        });
    </script>
<?php } ?>
<div class="clear"></div>
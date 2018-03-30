<?php
$first = 'active';
$first_post = true;
global $wp_query, $jaw_data;
$type = jaw_template_get_var('type', 'default');

$backup_query = $wp_query;
$wp_query = jaw_template_get_data();
$random = rand(0, 1000);

$post_in_slide = jaw_template_get_var('post_in_slide', 3);

//jaw_template_get_var('box_size', '4') / 4 <= $count
?>

<div id="jaw-carousel-<?php echo esc_attr($random); ?>" class="carousel horizontal slide navigation-<?php echo esc_attr(jaw_template_get_var('carousel_style', 'bar')); ?>">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $count = 0;
        $konec = true;
        ?>
        <?php
        while (have_posts()) {
            the_post();
            switch (get_post_format()) {
                case 'video': $format = '-video';
                    break;
                case 'quote': $format = '-quote';
                    break;
                case 'image': $format = '-image';
                    break;
                case 'gallery': $format = '-gallery';
                    jaw_template_set_var('gallery', true);
                    break;
                default: $format = '';
                    break;
            }

            switch ($type) {
                case 'default': $template = 'content-small' . $format;
                    break;
                case 'middle': $template = 'content-middle' . $format;
                    break;
                case 'big': $template = 'content-big' . $format;
                    break;
                case 'mix':
                    if ($first_post) {
                        $template = 'content-middle' . $format;
                        $first_post = false;
                    } else {
                        $template = 'content-small' . $format;
                    }

                    break;
            }
            ?>

            <?php if ($count % $post_in_slide == 0) { ?>  

                <?php $konec = false; ?>
                <div class="item <?php echo $first; ?>">
                    <div class="carousel-caption row elements_iso">

                        <?php
                        $first = '';

                        echo jaw_get_template_part($template, 'content');
                        ?>                            
                    <?php } else { ?>
                        <?php
                        $first = '';

                        echo jaw_get_template_part($template, 'content');
                        ?>
                    <?php } ?> 
                    <?php $count++; ?>                        
                    <?php if ($count % $post_in_slide == 0) { ?>
                    </div>
                </div>
                <?php $first_post = true; ?>
                <?php $konec = true; ?>
            <?php } ?>            
        <?php } ?>   
        <?php if ($konec) { ?>
        </div>
    <?php } else { ?>           
    </div></div></div>
<?php } ?>
<!-- Controls -->
<a class="left carousel-control" href="#jaw-carousel-<?php echo esc_attr($random); ?>" data-slide="prev">
    <span class="icon-prev"></span>
</a>
<a class="right carousel-control" href="#jaw-carousel-<?php echo esc_attr($random); ?>" data-slide="next">
    <span class="icon-next"></span>
</a>

</div>
<?php if (jaw_template_get_var('automatic_slide', '0') == '1') { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('#jaw-carousel-<?php echo esc_attr($random); ?>').carousel({
                interval: 5000
            });
        });
    </script>
<?php } ?>
<div class="clear"></div>

<?php
$wp_query = null;
$wp_query = $backup_query;
wp_reset_postdata();

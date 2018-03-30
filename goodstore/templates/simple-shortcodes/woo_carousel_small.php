<?php
$first = 'active';
global $wp_query, $jaw_data;

$box_style = jaw_template_get_var('box_style', '10');


$backup_query = $wp_query;
$wp_query = jaw_template_get_data();
$random = rand(0, 1000);

$post_in_slide = (int) jaw_template_get_var('post_in_slide', 3);

$catalog_class = array();
if (jaw_template_get_var('catalog_mode', 'off') == 'on') {
    $catalog_class[] = 'catalog_mode_on';    
}

//jaw_template_get_var('box_size', '4') / 4 <= $count
?>

<div id="jaw-carousel-<?php echo $random; ?>" class="carousel horizontal slide woocommerce navigation-<?php echo jaw_template_get_var('carousel_style','bar'); ?>">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $count = 0;
        $konec = true;
        ?>
        <?php
        while (have_posts()) {
            the_post();
            ?>     
            <?php if ($count % $post_in_slide == 0) { ?>
                <?php $konec = false; ?>
                <div class="item <?php echo $first; ?>">
                    <div class="jaw_blog <?php echo implode(' ', $catalog_class); ?>">
                    <div class="carousel-caption row elements_iso">
                        <?php
                        $first = '';
                        echo jaw_get_template_part('content-product-' . $box_style, 'woocommerce');
                        ?>
                    <?php } else { ?>
                        <?php
                        $first = '';
                        echo jaw_get_template_part('content-product-' . $box_style, 'woocommerce');
                        ?>
                    <?php } ?> 
                        <?php $count++; ?>                        
                        <?php if ($count % $post_in_slide == 0) { ?>
                        </div>
                    </div>
                </div>
                <?php $first_post = true; ?>
                <?php $konec = true; ?>
            <?php } ?>            
        <?php } ?>   
        <?php if ($konec) { ?>
        </div>
    <?php } else { ?>           
    </div></div></div></div>
<?php } ?>
<!-- Controls -->
<a class="left carousel-control" href="#jaw-carousel-<?php echo $random; ?>" data-slide="prev">
    <span class="icon-prev"></span>
</a>
<a class="right carousel-control" href="#jaw-carousel-<?php echo $random; ?>" data-slide="next">
    <span class="icon-next"></span>
</a>
<div class="clear"></div>
</div>
<?php if (jaw_template_get_var('automatic_slide', '0') == '1') { ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('#jaw-carousel-<?php echo $random; ?>').carousel({
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

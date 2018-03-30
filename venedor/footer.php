                    <?php
                    global $venedor_layout, $venedor_sidebar, $venedor_settings;
                    ?>
                    <?php if ($venedor_layout != 'widewidth') : ?>
                    </div><!-- end main content -->
                    <?php endif; ?>

                    <?php if (($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar && is_active_sidebar( $venedor_sidebar )) :
                        $is_category_filter = class_exists('WooCommerce') && $venedor_settings['category-mobile-filter'] && (is_shop() || venedor_is_product_archive());
                        ?>
                    <div class="col-sm-4 col-md-3 sidebar <?php echo $venedor_layout?><?php echo $is_category_filter ? ' mobile-hide-sidebar' : '' ?>"><!-- main sidebar -->
                        <?php dynamic_sidebar( $venedor_sidebar ); ?>
                    </div><!-- end main sidebar -->
                    <?php endif; ?>

                    <?php if ($venedor_layout != 'widewidth') : ?>
                </div>
            </div>

            <?php endif; ?>
            <?php
            wp_reset_postdata();
            $content_bottom = venedor_meta_content_bottom();
            ?>

            <?php if ($content_bottom) : ?>
            <div id="content-bottom"><!-- begin content bottom -->
                <div class="container">
                    <?php echo do_shortcode('[block name="'.$content_bottom.'"]') ?>
                </div>
            </div><!-- begin content bottom -->
            <?php endif; ?>

        </div><!-- end main -->

        <?php get_template_part('layout/footer'); ?>
    
    </div><!-- end wrapper -->

<div class="filter-overlay"></div>

<?php

// category filter
$is_category_filter = class_exists('WooCommerce') && $venedor_settings['category-mobile-filter'] && (is_shop() || venedor_is_product_archive());
if ($is_category_filter && ($venedor_layout == 'left-sidebar' || $venedor_layout == 'right-sidebar') && $venedor_sidebar && is_active_sidebar( $venedor_sidebar )) {
get_template_part('category-filter');
}

?>

<?php wp_footer(); ?>

</body>
</html>
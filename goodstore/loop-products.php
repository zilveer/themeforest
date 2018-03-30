<?php
global $wp_query;
$content_width = jwLayout::content_width();

jaw_template_inc_counter('pagination');

if (is_product_category()) {
    $cat = get_term_by('slug', get_query_var('term'), 'product_cat');
    do_action('woocommerce_before_main_content');
    if (jwOpt::get_option('_cat_description_mode', 'layout', 'category', $cat->term_id) == 'layout') {
        if (isset($cat->description)) {
            if (strlen($cat->description) > 0) {
                echo '<div class="' . implode(' ', $content_width) . ' builder-section ">';
                echo '<div class="row">';
                echo '<div class="' . implode(' ', $content_width) . '">';
                ?>

                <?php echo do_shortcode($cat->description); ?>

                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
} else if (is_product_tag()) {
    $cat = get_term_by('slug', get_query_var('term'), 'product_tag');
    if (isset($cat->description)) {
        if (strlen($cat->description) > 0) {
            echo '<div class="' . implode(' ', $content_width) . ' builder-section ">';
            echo '<div class="row">';
            echo '<div class="' . implode(' ', $content_width) . '">';
            ?>

            <?php echo do_shortcode($cat->description); ?>

            <?php
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
} else {
    echo '<div class="' . implode(' ', $content_width) . ' builder-section before_main_content ">';
    echo '<div class="row">';
    echo '<div class="' . implode(' ', $content_width) . ' woo_before_main_content">';
    do_action('woocommerce_before_main_content');
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
if (function_exists('is_product') && !is_product()) {
    if (have_posts()) {
        ?><div class="<?php echo implode(' ', $content_width); ?> builder-section"> 
        <?php
        $col = jwLayout::parseColWidth();
        ?>
            <div class="row">
                <div class="col-lg-<?php echo $col; ?>">
                    <?php
                    if (isset($cat->name)) {
                        $name = $cat->name;
                    } else {
                        $name = woocommerce_page_title(false);
                    }
                    jaw_template_set_var('bar_type', jwOpt::get_option('woo_bar_type', 'big'));
                    jaw_template_set_var('box_title', $name);
                    echo jaw_get_template_part('section_bar', 'simple-shortcodes');
                    ?>

                </div>
            </div>
            <?php
            $cat_display_type = '';
            if (isset($cat->term_id)) {
                $cat_display_type = get_woocommerce_term_meta($cat->term_id, 'display_type', true);
            } else if (is_shop()) {
                $cat_display_type = get_option( 'woocommerce_shop_page_display' );
            } else if (is_shop()) {
                $cat_display_type = '';
            }
            ?>
            <?php if ($cat_display_type == 'subcategories' || $cat_display_type == 'both') { ?>
                <div class="woocommerce  elements_iso row product_subcategories" > 
                    <?php woocommerce_product_subcategories(); ?>
                </div>
            <?php } ?>
            <?php if ($cat_display_type == '' || $cat_display_type == 'products' || $cat_display_type == 'both') { ?>
                <div class="row category-bar">
                    <div class="col-lg-3">
                        <?php wc_get_template('loop/result-count.php'); ?>
                    </div>
                    <div class="col-lg-<?php echo $col - 6; ?> pagination-header">
                        <?php if (jwLayout::content_layout() == 'fullwidth_sidebar' && jwOpt::get_option('blog_pagination', 'number') == 'number') { ?>
                            <?php echo jwRender::pagination(jaw_template_get_var('pagination', jwOpt::get_option('blog_pagination', 'number')), null, 0); ?>
                        <?php } ?>
                    </div>
                    <div class="col-lg-3">
                        <div class="woo-sort-cat-form">
                            <?php woocommerce_catalog_ordering(); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php
            $cat_catalog_mode = 'off';
            if (isset($cat) && !empty($cat)) {
                $cat_catalog_mode = jwOpt::get_option('_cat_catalog_mode', 'off', 'category', $cat->term_id);
            }
            $catalog_class = array();
            if ($cat_catalog_mode == 'on') {
                $catalog_class[] = 'catalog_mode_on';
                jaw_template_set_var('catalog_mode', 'on');
            }
            ?>

            <div class="row">
                <div class="col-lg-<?php echo $col; ?>">
                    <div class="jaw_blog <?php echo implode(' ', $catalog_class); ?>">

                        <div class="woocommerce elements_iso row jaw_paginated_<?php echo jaw_template_get_counter('pagination'); ?>" > 
                            <?php
                            while (have_posts()) : the_post();
                                wc_get_template_part('content', 'product');
                            endwhile;
                            ?>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            <?php } else {
                ?> <div class=" builder-section <?php echo implode(' ', $content_width); ?>"> 
                    <div  class="elements_iso"> <?php
        echo __('No products found', 'jawtemplates');
    }
} else {
            ?> <div id="content" class="product-content builder-section <?php echo implode(' ', $content_width); ?>" > 
                        <div class="row">
                            <div class="<?php echo implode(' ', jwLayout::content_width()); ?>">     
                                <?php
                                woocommerce_content();
                                ?>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if (!is_product_category() && !is_product_tag()) {
                            do_action('woocommerce_after_main_content');
                        }
                        ?>
                    </div>
                    <div class="clear"></div>
                </div>
<?php
if (is_product_category()) {
    $cat = get_term_by('slug', get_query_var('term'), 'product_cat');
    if (jwOpt::get_option('_cat_description_mode', 'layout', 'category', $cat->term_id) == 'bottom') {
        if (isset($cat->description)) {
            if (strlen($cat->description) > 0) {
                echo '<div class="' . implode(' ', $content_width) . ' builder-section ">';
                echo '<div class="row">';
                echo '<div class="' . implode(' ', $content_width) . '">';
                ?>

                <?php echo do_shortcode($cat->description); ?>

                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
}


<?php

global $post;

$bread = false;

if (is_page()) { 
    $bread = get_post_meta(get_the_ID(), '_page_breadcrumbs', true);
} else if (((function_exists('is_product') && function_exists('is_product_category')  && function_exists('is_product_tag') && function_exists('is_shop') && (is_product_tag() || is_product_category() || is_product() || is_shop())) && jwOpt::get_option('woo_breadcrumbs', '1') == '1') 
        || ((is_tag() || is_author() || is_date() || is_category() || (is_single() && !function_exists('is_product')) || (is_single() && function_exists('is_product') && !is_product()) || is_search() || is_404() || ((taxonomy_exists('jaw-portfolio-category') && is_tax('jaw-portfolio-category')) || (get_post_type() == 'jaw-portfolio'))) && jwOpt::get_option('blog_breadcrumb', '1') == '1') 
        || (is_page() && get_post_meta(get_the_ID(), '_page_breadcrumbs', true) == '1')
        || is_tax('shop_vendor')
        
        ) {
     $bread = true;
}

if ($bread && (!is_home() || !is_front_page())) { ?>
    <div class="row-fullwidth">
        <div class="page-title">
            <div class="fullwidth-block row">
                <div class="col-lg-12 row-breadcrumbs">            
                    <?php
                     echo jaw_get_template_part('breadcrumbs','simple-shortcodes');
                    ?>
                </div>
            </div>    
        </div>                          
    </div>
<?php
}
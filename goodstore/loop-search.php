<?php
global $post, $wp_query, $jaw_data;
$content_width = jwLayout::content_width();
?>
<div  class=" row ">
    <div class="<?php echo implode(' ', $content_width); ?>">

        <div class="jaw-tabs jaw-search-content row">
            <div class="<?php echo implode(' ', $content_width); ?>">
                <ul class="nav nav-tabs" >   
                    <?php
                    $first = '';
                    $search_in = '';

                    if (isset($_GET['orderby'])) {//pokud filtruju dle ceny/nazvu/... (coz jde pouz u produktu), tak prepnu na produkty
                        $search_in = 'product';
                    } else {
                        $search_in = jwOpt::get_option('search_default_posttype', 'post');
                    }

                    if (isset($_GET['post_type'])) {
                        $post_types[] = $_GET['post_type'];
                        $search_in = $_GET['post_type'];
                    } else {
                        $post_types = jwOpt::get_option('search_posttypes', array('post', 'page'));
                    }





                    if (sizeof($post_types) > 0) {
                        foreach ($post_types as $i => $type) {

                            $wp_query = jaw_template_get_var($type);
                            $count = '';
                            if (jwOpt::get_option('search_show_count', '0') == '1') {
                                $count = '<span class="search_count">(' . $wp_query->found_posts . ')</span>';
                            }

                            $obj = get_post_type_object($type);
                            if ($type == $search_in) {
                                $first = 'search-' . $type . ' active';
                            } else {
                                $first = 'search-' . $type;

                                if (isset($wp_query->found_posts) && $wp_query->found_posts == '0' && jwOpt::get_option('search_hide_blank_tabs', '0') == '1') {
                                    continue;
                                }
                            }

                            echo '<li class="' . $first . '"><a data-toggle="tab" href="#search_' . $type . '">' . $obj->labels->name . ' ' . $count . '</a></li>';
                            if ($type == 'product') {
                                echo '<div class="woo-sort-cat-form">';
                                woocommerce_catalog_ordering();
                                echo '</div>';
                            }
                            $first = '';
                        }
                    }
                    $taxonomies = jwOpt::get_option('search_taxonomies', array());
                    if (sizeof($taxonomies) > 0) {
                        foreach ($taxonomies as $i => $type) {
                            $query = jaw_template_get_var($type);
                            if (isset($query) && sizeof($query) == 0 && jwOpt::get_option('search_hide_blank_tabs', '0') == '1') {
                                continue;
                            }
                            $taxonomy_detail = get_taxonomies( array('name' => $type), 'object' );
                            
                            $count = '';
                            if (jwOpt::get_option('search_show_count', '0') == '1') {
                                $count = '<span class="search_count">(' . sizeof($query) . ')</span>';
                            }
                            echo '<li class="' . $first . '"><a data-toggle="tab" href="#search_' . $type . '">' . $taxonomy_detail[$type]->labels->name . ' ' . $count . '</a></li>';
                        }
                    }
                    ?>
                </ul>
                <div class="tab-content " >
                    <?php
                    $first = '';


                    if (sizeof($post_types) > 0) {
                        foreach ($post_types as $i => $type) {
                            jaw_template_inc_counter('pagination');
                            $wp_query = jaw_template_get_var($type);
                            $class = '';
                            if ($type == 'product') {
                                $class = 'woocommerce';
                            }
                            if ($type == $search_in) {
                                $first = 'active in';
                            } else if (isset($wp_query->found_posts) && $wp_query->found_posts == '0' && jwOpt::get_option('search_hide_blank_tabs', '0') == '1') {
                                continue;
                            }
                            ?>
                            <div class="tab-pane fade <?php echo $first . ' ' . implode(' ', $content_width); ?>" id="search_<?php echo $type; ?>">
                                <div class="elements_iso row  jaw_paginated_<?php echo jaw_template_get_counter('pagination') . ' ' . $class; ?>">
                                    <?php
                                    if (have_posts()) {
                                        $first = true;
                                        $type = jwOpt::get_option('search_boxes_type', 'middle');

                                        while (have_posts()) : the_post();
                                            ?>

                                            <?php
                                            switch (get_post_type()) {
                                                case 'post':
                                                    switch ($type) {
                                                        case 'default': echo jaw_get_template_part('content-small', 'content');
                                                            break;
                                                        case 'middle': echo jaw_get_template_part('content-middle', 'content');
                                                            break;
                                                        case 'big': echo jaw_get_template_part('content-big', 'content');
                                                            break;
                                                        case 'classical': echo jaw_get_template_part('content-classical', 'content');
                                                            break;
                                                        case 'mix':
                                                            if ($first) {
                                                                echo jaw_get_template_part('content-middle', 'content');
                                                                $first = false;
                                                            } else {
                                                                echo jaw_get_template_part('content-small', 'content');
                                                            }
                                                            break;
                                                    }
                                                    break;
                                                case 'product':
                                                    echo jaw_get_template_part('content-product-' . jwOpt::get_option('search_woo_type', '0'), 'woocommerce');
                                                    break;
                                                case 'jaw-portfolio':
                                                    $type_p = get_post_meta(get_the_ID(), 'portfolio_type', true);
                                                    echo jaw_get_template_part('content-portfolio-' . $type_p, 'custom-posts');
                                                    break;
                                                case 'jaw-team':
                                                    echo jaw_get_template_part('content-team', 'custom-posts');
                                                    break;
                                                case 'jaw-testimonial':
                                                    echo jaw_get_template_part('content-testimonial', 'custom-posts');
                                                    break;
                                                case 'jaw-faq':
                                                    echo jaw_get_template_part('content-faq', 'custom-posts');
                                                    break;
                                                case 'attachment':
                                                    echo jaw_get_template_part('content-attachment', 'content');
                                                    break;
                                                default:
                                                    echo jaw_get_template_part('content-custom', 'custom-posts');
                                                    break;
                                            }
                                        endwhile;
                                    } else {
                                        ?>
                                        <div class="notice <?php echo implode(' ', $content_width); ?>">
                                            <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.', 'jawtemplates'); ?></p>
                                            <?php get_search_form(); ?>
                                        </div>

                                    <?php }
                                    ?>
                                </div>
                                <div class="clear"></div>
                                <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>
                            </div>
                            <?php
                            $first = '';
                        }
                    }
                    if (sizeof($taxonomies) > 0) {
                        foreach ($taxonomies as $i => $type) {
                            ?>
                             <div class="tab-pane fade <?php echo $first . ' ' . implode(' ', $content_width); ?>" id="search_<?php echo $type; ?>">
                                <div class="elements_iso row  jaw_paginated_<?php echo jaw_template_get_counter('pagination') . ' ' . $class; ?>">
                                <?php
                                    $query = jaw_template_get_var($type);
                                    foreach($query as $t){
                                        $term = get_term( $t, $type );
                                    ?>
                                    <div class="product-category product col-lg-4 element">                                        
                                        <a href="<?php echo get_term_link($term, $type); ?>">                                      
                                            <div class="category-info">
                                                <h2><?php echo jwUtils::crop_length($term->name, jwOpt::get_option('letter_excerpt_cat_title', -1)); ?></h2>
                                                <span class="count_items"><?php echo $term->count . ' ' . __('Items', 'jawtemplates'); ?></span>
                                            </div>              
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
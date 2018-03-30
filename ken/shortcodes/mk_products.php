<?php

extract(shortcode_atts(array(
    'style' => 'classic',
    'display' => 'recent',
    'category' => '',
    'orderby' => 'DESC',
    'order' => 'date',
    'column' => '3',
    'product_per_page' => '12',
    'pagination' => 'true',
    'el_class' => ''
), $atts));

require_once THEME_INCLUDES . "/image-cropping.php";    

global $woocommerce_loop, $woocommerce, $mk_settings, $post, $wp_query;

$output =  '';

$meta_query = '';
if($display == "recent"){
    $meta_query = WC()->query->get_meta_query();
}
if($display == "featured"){
    $meta_query = array(
        array(
            'key'       => '_visibility',
            'value'       => array('catalog', 'visible'),
            'compare'   => 'IN'
        ),
        array(
            'key'       => '_featured',
            'value'       => 'yes'
        )
    );
}
if($display == "top_rated"){
    add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
    $meta_query = WC()->query->get_meta_query();
}

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$args = array(
    'post_type'             => 'product',
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => 1,
    'posts_per_page'        => $product_per_page,
    'orderby'               => $orderby,
    'order'                 => $order,
    'paged'                 => $paged,
    'meta_query'            => $meta_query
);
if($display == "sale"){
    $product_ids_on_sale = woocommerce_get_product_ids_on_sale();
    $meta_query = array();
    $meta_query[] = $woocommerce_loop->query->visibility_meta_query();
    $meta_query[] = $woocommerce_loop->query->stock_status_meta_query();
    $args['meta_query'] = $meta_query;
    $args['post__in'] = $product_ids_on_sale;
}
if($display == "best_selling"){
    $args['meta_key'] = 'total_sales';
    $args['orderby'] = 'meta_value_num';
    $args['meta_query'] = array(
            array(
                'key'       => '_visibility',
                'value'     => array( 'catalog', 'visible' ),
                'compare'   => 'IN'
            )
        );
}

if($display == "product_category"){
    $args['tax_query'] = array(
        array(
            'taxonomy'   => 'product_cat',
            'terms'         => explode(",", $category),
            'field'         => 'slug'
        )
    );
}

$output .= '<div class="woocommerce column-'.$column.' '.$el_class.'">';
$output .= '<ul class="products isotope-enabled '.$style.'-style">'; 
$query = new WP_Query( $args );
if($query->have_posts()):
    while ( $query->have_posts() ) : $query->the_post();
        $product_id = get_the_ID();
        $loop_image_size = isset($mk_settings['woo_loop_image_size']) ? $mk_settings['woo_loop_image_size'] : 'crop';
        $quality = $mk_settings['woo-image-quality'] ? $mk_settings['woo-image-quality'] : 1;
        $grid_width = $mk_settings['grid-width'];
        $content_width = $mk_settings['content-width'];
        $height = $mk_settings['woo-loop-thumb-height'];
        global $product;

        switch ($column) {
            case 4:
                    $classes[] = 'four-column';
                    $width = round($grid_width/4) - 38;
                    $column_width = round($grid_width/4);
                break;
            case 3:
                    $classes[] = 'three-column';
                    $width = round($grid_width/3) - 41;
                    $column_width = round($grid_width/3);
                break;
            case 2:
                    $classes[] = 'two-column';
                    $width = round($grid_width/2) - 49;
                    $column_width = round($grid_width/2);
                break;
            case 1:
                    $classes[] = 'one-column';
                    $width = $grid_width - 66;
                    $column_width = $grid_width;
                break;

            default:
                    $classes[] = 'four-column';
                    $width = round($grid_width/4) - 36;
                    $column_width = round($grid_width/4);
                break;
        }

        ob_start();
            post_class($classes);



        $output .= '<li style="" '.ob_get_clean().' >';
        $output .= '    <div class="item-holder">';
        $output .= '        <span class="product-loading-icon"></span>';
        /*
        * Product add to card & out of stock badge
        */
        $out_of_stock_badge = '';
        if ( ! $product->is_in_stock() ) {
            $out_of_stock_badge = '<span class="out-of-stock">'.__( 'OUT OF STOCK', 'mk_framework' ).'</span>';
        }

        if($style == 'modern'){
            $output .= '<div class="modern-style-holder">';
            $output .= '<div class="modern-hover-holder">';
            $output .= '<a href="'. apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ).'" alt="'. apply_filters( 'out_of_stock_add_to_cart_text', __( 'READ MORE', 'mk_framework' ) ).'" class="product_loop_button">'.__( 'PURCHASE', 'mk_framework' ).'</a>';
            $output .= $out_of_stock_badge;
            if ($product->is_on_sale()) :
            $output .= apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'SALE', 'mk_framework' ).'</span>', $post, $product);
            endif;
            $output .= '</div>';
        }else if($style == 'classic'){
            $output .= $out_of_stock_badge;
            if ($product->is_on_sale()) :
            $output .= apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'SALE', 'mk_framework' ).'</span>', $post, $product);
            endif;
        }
        

        /* Product loop thumbnail */
        if ( has_post_thumbnail() ) {
            switch ($loop_image_size) {
                case 'full':
                    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                    $image_output_src = $image_src_array[0];
                    break;
                case 'crop':
                    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                    $image_output_src = bfi_thumb($image_src_array[0], array(
                        'width' => $width*$quality,
                        'height' => $height*$quality
                    ));
                    break;            
                case 'large':
                    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', true);
                    $image_output_src = $image_src_array[0];
                    break;
                case 'medium':
                    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium', true);
                    $image_output_src = $image_src_array[0];
                    break;        
                default:
                    $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
                    $image_output_src = bfi_thumb($image_src_array[0], array(
                        'width' => $width*$quality,
                        'height' => $height*$quality
                    ));
                    break;
            }

            $output .= '<a href="'. get_permalink().'" class="product-loop-thumb">';

            $output .= '<img src="'.mk_thumbnail_image_gen($image_output_src, $width, $height).'" class="product-loop-image" alt="'.get_the_title().'" title="'.get_the_title().'" itemprop="image">';

            $product_gallery = get_post_meta( $post->ID, '_product_image_gallery', true );

            if ( !empty( $product_gallery ) ) {

                $gallery = explode( ',', $product_gallery );
                $hover_image_id  = $gallery[0];

                $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'full', true );
                
                switch ($loop_image_size) {
                case 'full':
                    $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'full', true);
                    $image_hover_src = $image_src_hover_array[0];
                    break;
                case 'crop':
                    $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'full', true);
                    $image_hover_src = bfi_thumb($image_src_hover_array[0], array(
                        'width' => $width*$quality,
                        'height' => $height*$quality
                    ));
                    break;            
                case 'large':
                    $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'large', true);
                    $image_hover_src = $image_src_hover_array[0];
                    break;
                case 'medium':
                    $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'medium', true);
                    $image_hover_src = $image_src_hover_array[0];
                    break;        
                default:
                    $image_src_hover_array = wp_get_attachment_image_src($hover_image_id, 'full', true);
                    $image_hover_src = bfi_thumb($image_src_hover_array[0], array(
                        'width' => $width*$quality,
                        'height' => $height*$quality
                    ));
                    break;
            }

            $output .= '<img src="'.mk_thumbnail_image_gen($image_hover_src, $width, $height).'" alt="'.get_the_title().'" class="product-hover-image" title="'.get_the_title().'" >';
            }

            $output .= '<span class="product-hover-items">';
            $rating = $product->get_rating_html();
            if ( $rating ) :
                $output .= '<span class="product-item-rating">'.$rating.'</span>';
            endif;


            if( function_exists('mk_love_this') ) {
                ob_start();
                mk_love_this();
                $output .= ob_get_clean();
            }

            $output .= '</span>';

            $output .= '</a>';

            if($style == 'modern'){
                $output .= '</div>';            
            }
        }
        
        $output .= '    <div class="product-item-details">';
        $output .= '        <h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
        ob_start();
        do_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        $output .=           ob_get_clean();
        if($style == 'classic'){

          switch ( $product->product_type ) {
                    case "variable" :
                        $icon_class = 'mk-theme-icon-plus';
                        break;
                    case "grouped" :
                        $icon_class = 'mk-theme-icon-plus';
                        break;
                    case "external" :
                        $icon_class = 'mk-theme-icon-magnifier';
                        break;
                    default :
                        $icon_class = 'mk-theme-icon-cart2';
                        break;
                }

                if(!$product->is_purchasable() || !$product->is_in_stock()) {
                    $icon_class = 'mk-theme-icon-magnifier';
                }

                $button_class = implode( ' ', array(
                                    'product_loop_button',
                                    'product_type_' . $product->product_type,
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                    $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                            ) );


                $output .= apply_filters( 'woocommerce_loop_add_to_cart_link',
                    sprintf( '<a rel="nofollow" href="%s" data-quantity="1" data-product_id="%s" data-product_sku="%s" class="%s"><i class="%s"></i>%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( $product->id ),
                        esc_attr( $product->get_sku() ),
                        esc_attr( $button_class ),
                        esc_attr( $icon_class ),
                        esc_html( $product->add_to_cart_text() )
                    ),
                $product );
        }
        $output .= '        </div>';
        $output .= '    </div>';
        $output .= '</li>';
    endwhile;
endif;
$output .= '</ul>';

if($pagination == "true"){
        $output .= '<nav class="woocommerce-pagination">';
        $output .= mk_woocommerce_pagination($query->max_num_pages);
        $output .= '</nav>';
}
$output .= '</div>';
    wp_reset_postdata();
echo $output;

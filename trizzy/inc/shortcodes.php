<?php

/**
* Clear shortcode
* Usage: [clear]
*/
if (!function_exists('pp_clear')) {
    function pp_clear() {
        return '<div class="clear"></div>';
    }
    add_shortcode( 'clear', 'pp_clear' );
}

/**
* Icon shortcode
* Usage: [icon icon="icon-exclamation"]
*/
function pp_icon($atts) {
    extract(shortcode_atts(array(
        'icon'=>''), $atts));
    return '<i class="fa fa-'.$icon.'"></i>';
}
add_shortcode('icon', 'pp_icon');
/**
* Spacer shortcode
* Usage: [space]
*/
if (!function_exists('pp_spacer')) {
    function pp_spacer($atts, $content ) {
        extract(shortcode_atts(array(
            'class' => ''
            ), $atts));
        return '<div class="clearfix"></div><div class="'.$class.'"></div>';
    }
    add_shortcode( 'space', 'pp_spacer' );
}

if (!function_exists('trizzy_order_by_rating_post_clauses')) {
    function trizzy_order_by_rating_post_clauses( $args ) {
    //taken from woocommerce
        global $wpdb;
        $args['where'] .= " AND $wpdb->commentmeta.meta_key = 'rating' ";
        $args['join'] .= "
            LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
            LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
        ";
        $args['orderby'] = "$wpdb->commentmeta.meta_value DESC";
        $args['groupby'] = "$wpdb->posts.ID";
        return $args;
    }
}


/**
 * Recent Products shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    function trizzy_woocommerce_recent_products( $atts, $content ) {
        extract(shortcode_atts(array(
            'orderby'=> 'date',
            'order'=> 'DESC',
            'per_page'  => '12',
            'category'  => '',
            'ids' => '',
            ), $atts));

    global $woocommerce, $product;

    $randID = rand(1, 99); // Get unique ID for carousel

    $args = array(
        'suppress_filters' => false,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby'               => $orderby,
        'order'                 => $order,
        'posts_per_page'        => $per_page,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
                )
            )
        );

    if(!empty($category)) {
        $categories = explode(',', $category);
        $args['tax_query'] = array(
            array(
                'taxonomy'      => 'product_cat',
                'terms'         => $categories,
                'field'         => 'slug',
                )
            );
    }
    if ( isset( $atts['ids'] ) ) {
            $ids = explode( ',', $atts['ids'] );
            $ids = array_map( 'trim', $ids );
            $args['post__in'] = $ids;
        }

    $output = '
    <!-- ShowBiz Carousel -->
    <div id="new-arrivals" class="new-arrivals showbiz-container" >

        <!-- Navigation -->
        <div class="showbiz-navigation">
            <div id="showbiz_left_'.$randID.'" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
            <div id="showbiz_right_'.$randID.'" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
        </div>
        <div class="clearfix"></div>

        <div class="showbiz" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'" data-play="#showbiz_play_'.$randID.'" >

            <div class="overflowholder">
                <ul>';
                    $products = get_posts( $args );
                    if ( $products ) :
                        foreach( $products as $productshop ) : setup_postdata($productshop);
                        $product = get_product( $productshop->ID );
                        $hoverid = get_post_meta($productshop->ID, 'pp_featured_hover', TRUE);
                    $output .= '
                    <li>
                        <figure class="product">';
                    if ( $product->is_on_sale() ) :
                        $output .= '<span class="onsale">' . __( 'Sale!', 'trizzy' ) . '</span>';
                    endif;
                    if ( !$product->is_in_stock() ) :
                        $output .= '<span class="onsale soldout">'.__('Sold Out','trizzy').'</span>';
                    endif;
                    if(!empty($hoverid)) {
                        $output .='<div class="mediaholder">';
                    } else {
                        $output .='<div class="mediaholder no-anim">';
                    }
                    if ( has_post_thumbnail($productshop->ID)) {
                        $output .=  '<a href="'.get_permalink($productshop->ID).'" >';
                        $output .= get_the_post_thumbnail($productshop->ID,'shop_catalog');
                        $alt    = esc_attr( get_the_title( $productshop->ID ) );
                        $hoverthumb = wp_get_attachment_image_src($hoverid, 'shop_catalog');
                        if(!empty($hoverthumb[0])) {
                            $output .=  '
                                <div class="cover">
                                    <img alt="'.$alt.'" src="'.$hoverthumb[0].'"/>
                                </div>';
                        }
                        $output .= '</a>';
                        if($product->product_type == 'simple') {
                            // echo esc_url($product->add_to_cart_url());
    $output .= sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product-button product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->id ),
        esc_attr( $product->get_sku() ),
        esc_attr( isset( $quantity ) ? $quantity : 1 ),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        esc_attr( $product->product_type ),
        esc_html( $product->add_to_cart_text() )
    );
                            //$output .= '<a href="'.esc_url($product->add_to_cart_url()).'" class="add_to_cart_button product-button"><i class="fa fa-shopping-cart"></i>'.$product->single_add_to_cart_text().'</a>';
                        } else {
                            $output .= '<a href="'.get_permalink($productshop->ID).'" class="product-button">'.$product->add_to_cart_text().'</a>';
                        }
                        $output .= '</div>';
                    }
                    $product_cats = wp_get_post_terms( $productshop->ID, 'product_cat' );
                    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
                        $single_cat = array_shift( $product_cats );
                        $cat = $single_cat->name;
                    }

                    $output .= '

                    <a href="'.get_permalink($productshop->ID).'" >
                        <section>
                            <span class="product-category">'.$cat.'</span>
                                <h5>'.get_the_title($productshop->ID).'</h5>
                                <span class="price">'.$product->get_price_html().'</span>
                        </section>
                    </a>
                </figure>';
                    $output .= '

                    </li>';
                    endforeach; // end of the loop.
                    endif;
                    $output .='
                </ul>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
';
    return $output; wp_reset_postdata(); $products = '';
    }
add_shortcode('trizzy_recent_products', 'trizzy_woocommerce_recent_products');
}




/**
 * Recent Products shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    function trizzy_woocommerce_products_list( $atts, $content ) {
        extract(shortcode_atts(array(
            'title' => 'New Arrivals',
            'orderby'=> 'date',
            'order'=> 'DESC',
            'per_page'  => '4',
            'category'  => '',
            'ids' => '',
            'width' => 'one-third',
            'place' => 'first',
            'type' => 'best_selling', // 'top_rated', 'featured'
            'from_vs' => 'no'
            ), $atts));

    global $woocommerce, $product;

    $randID = rand(1, 99); // Get unique ID for carousel

    if(empty($width)) { $width = "sixteen"; } //set width to 16 even if empty value

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }

    if($type =='best_selling') {

        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $per_page,
            'meta_key'              => 'total_sales',
            'orderby'               => 'meta_value_num',
            'meta_query'            => array(
                array(
                    'key'       => '_visibility',
                    'value'     => array( 'catalog', 'visible' ),
                    'compare'   => 'IN'
                )
            )
        );
        if(!empty($category)) {
            $categories = explode(',', $category);
            $args['tax_query'] = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'terms'         => $categories,
                    'field'         => 'slug',
                    )
                );
        }
        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

    } else if($type == 'top_rated') {
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'orderby'               => $orderby,
            'order'                 => $order,
            'posts_per_page'        => $per_page,
            'meta_query'            => array(
                array(
                    'key'           => '_visibility',
                    'value'         => array('catalog', 'visible'),
                    'compare'       => 'IN'
                )
            )
        );
        if(!empty($category)) {
            $categories = explode(',', $category);
            $args['tax_query'] = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'terms'         => $categories,
                    'field'         => 'slug',
                    )
                );
        }
        add_filter( 'posts_clauses', 'trizzy_order_by_rating_post_clauses' );

        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

       remove_filter( 'posts_clauses', 'trizzy_order_by_rating_post_clauses' );

    } else if($type == 'featured') {
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $per_page,
            'orderby'               => $orderby,
            'order'                 => $order,
            'meta_query'            => array(
                array(
                    'key'       => '_visibility',
                    'value'     => array('catalog', 'visible'),
                    'compare'   => 'IN'
                ),
                array(
                    'key'       => '_featured',
                    'value'     => 'yes'
                )
            )
        );
        if(!empty($category)) {
            $categories = explode(',', $category);
            $args['tax_query'] = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'terms'         => $categories,
                    'field'         => 'slug',
                    )
                );
        }
        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
    } else if($type == 'custom') {
        $args = array(
        'suppress_filters' => false,
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'orderby'               => $orderby,
        'order'                 => $order,
        'posts_per_page'        => $per_page,
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
                )
            )
        );
        if(!empty($category)) {
            $categories = explode(',', $category);
            $args['tax_query'] = array(
                array(
                    'taxonomy'      => 'product_cat',
                    'terms'         => $categories,
                    'field'         => 'slug',
                    )
                );
        }
        if ( isset( $atts['ids'] ) ) {
                $ids = explode( ',', $atts['ids'] );
                $ids = array_map( 'trim', $ids );
                $args['post__in'] = $ids;
        }
        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );
    }
  $output = '';
    if($from_vs === 'no') {
    $output .= '
        <!-- Best Sellers -->
        <div class="'.$width.' '.$p.' columns">';
    }
    if(!empty($title)) {
        $output .= '<!-- Headline -->
            <h3 class="headline">'.$title.'</h3>
            <span class="line" style="margin-bottom:0;"></span>
            <div class="clearfix"></div>';
    }
     if($type == 'top_rated') {
        $output .= '<ul class="product-list top-rated-list">';
     } else {
        $output .= '<ul class="product-list">';
        }
    if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post();
                $product = get_product( $products->post->ID );
                $output .= '<li><a href="'.get_permalink($products->post->ID).'">
                    '.get_the_post_thumbnail($products->post->ID,'shop-square-thumb');

                    $output .= '<div class="product-list-desc">'.get_the_title($products->post->ID).' <i>'.$product->get_price_html().'</i>';
                    if($type == 'top_rated') {
                        $average = $product->get_average_rating();
                        $avclass = trizzy_get_rating_class($average);
                        $output .= '<div class="rating '.$avclass.'">
                                        <div class="star-rating"></div>
                                        <div class="star-bg"></div>
                                    </div>';
                    }

                $output .= '</div></a></li>';
            endwhile; // end of the loop.
        endif;
    $output .= '<div class="clearfix"> </div>
    </ul>';
    if($from_vs  === 'no') {
        $output .= '</div>';
    }

    wp_reset_postdata();
    return $output;
    }
    add_shortcode('trizzy_products_list', 'trizzy_woocommerce_products_list');

}



/**
 * Caption Box shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
function trizzy_image_caption_box( $atts ) {
        extract(shortcode_atts(array(
            'title' => 'Men\'s Shirts',
            'subtitle' => '25% Off Summer Styles',
            'image'=> '',
            'url'=> '',
            'alt'=> '',
            'target'=> '',
            'width' => 'one-third', //ignore
            'place' => 'first'
            ), $atts));

    switch ( $place ) {
        case "last" : $p = "omega"; break;
        case "center" : $p = "alpha omega"; break;
        case "none" : $p = " "; break;
        case "first" : $p = "alpha"; break;
        default : $p = ' ';
    }
    $output = '';
    if($width !='ignore') {
        $output .= '<div class="'.$width.' '.$p.' column">';
    }
    if($target) {
        $output .= '<a target="'.$target.'" href="'.$url.'" class="img-caption" >';
    } else {
        $output .= '<a href="'.$url.'" class="img-caption" >';
    }
    $output .= '<figure>
                <img src="'.$image.'" alt="'.esc_attr($alt).'" />
                <figcaption>
                    <h3>'.$title.'</h3>
                    <span>'.$subtitle.'</span>
                </figcaption>
            </figure>
        </a>';
    if($width !='ignore') {
        $output .= '</div>';
    }
    return $output;
}
add_shortcode('image_caption_box', 'trizzy_image_caption_box');


/**
 * Paralax shortcode
 *
 * @access public
 * @param array $atts
 * @return string
 */
function trizzy_parallax( $atts ) {
        extract(shortcode_atts(array(
            'background' => '#000',
            'opacity' => '0.45',
            'height'=> '200',
            'image'=> '',
            'title' => 'End of season sale',
            'subtitle' => 'Up to 35% off Women’s Denim',
            'custom_class' => '',
            'from_vs' => 'no',
            'url' => '',
            'alt' => '',
            'target' => '',
            ), $atts));
$title = html_entity_decode($title);

if($from_vs === 'yes') {
    $imageurl = wp_get_attachment_url( $image );
    $alt = esc_attr( get_the_title( $image ) );
} else {
    $imageurl = $image;
}
 $output = '';
if($from_vs === 'yes') {
    $output .= '</div> <!-- eof wpb_wrapper -->
            </div> <!-- eof column_container -->
        </div> <!-- eof vc_row-fluid -->
    </div> <!-- eof columns -->
</div> <!-- eof container -->';
} else {
    $output .= '</div> <!-- eof columsn -->
    </div> <!-- eof conainer -->';
}
$output .= '
    <div class="parallax-banner fullwidth-element '.$custom_class.'"  data-background="'.$background.'" data-opacity="'.esc_attr($opacity).'" data-height="'.esc_attr($height).'">
        <img src="'.$imageurl.'" alt="'.$alt.'" />
        <div class="parallax-overlay"></div>
        <div class="parallax-title">';
    if($url){
        if(!empty($target)){
            $output .= '<a href="'.$url.'" target="'.$target.'">'.$title.'</a>';   
        } else {
            $output .= '<a href="'.$url.'">'.$title.'</a>';   
        }
    } else {
        $output .= $title;
    }
    
$output .= '<span>'.$subtitle.'</span></div> </div>';
if($from_vs === 'yes') {
    $output .= '
<div class="container">
    <div class="sixteen columns">
         <div class="wpb_row vc_row-fluid">
            <div class="vc_col-sm-12 wpb_column column_container">
                <div class="wpb_wrapper">';
} else {
    $output .= ' <div class="container columns">
        <div class="sixteen columns">';
}

    return $output;
}
add_shortcode('parallax', 'trizzy_parallax');




/**
* Recent work shortcode
* Usage: [recent_blog limit="4" title="Recent Work" orderby="date" order="DESC"  carousel="yes"] [/recent_blog]
*/
add_shortcode('latest_from_blog', 'trizzy_recent_blog');
function trizzy_recent_blog($atts, $content ) {
    extract(shortcode_atts(array(
        'limit'=>'4',
        'columns' => '4',
        'orderby'=> 'date',
        'order'=> 'DESC',
        'categories' => '',
        'masonry' => '',
        'tags' => '',
        'width' => 'sixteen',
        'place' => 'center',
        'exclude_posts' => '',
        'ignore_sticky_posts' => 1,
        'limit_words' => 10,
        'from_vs' => 'no'
        ), $atts));

    $output = '';
    $randID = rand(1, 99); // Get unique ID for carousel

    if(empty($width)) { $width = "sixteen"; } //set width to 16 even if empty value

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }
wp_reset_query();

    if($masonry == 'yes') {
        $output.= '<div class="recent-blog-posts masonry">';
    } else {
        $output.= '<div class="recent-blog-posts">';
    }
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
        'order' => $order,
        );
    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }

    if(!empty($categories)) {
        //$categories = explode(",", $categories);
        $args['category_name'] = $categories;
    }
    if(!empty($tags)) {
        $tags = explode(",", $tags);
        $args['tag__in'] = $tags;
    }
    $i = 0;
    $wp_query = new WP_Query( $args );
    if($from_vs === 'yes'){
        switch ($columns) {
            case '2':
                $mainclass = "vc_col-sm-6 wpb_column";
                $imagesize = 'team-thumb';
                break;
            case '3':
                $mainclass = "vc_col-sm-4 wpb_column";
                $imagesize = 'blog-size';
                break;
            case '4':
                $mainclass = "vc_col-sm-3 wpb_column";
                $imagesize = 'blog-size';
                break;
            default:
                # code...
                break;
        }
    } else {
        $mainclass = "four columns";
        $imagesize = 'blog-size';
    }
    if ( $wp_query->have_posts() ):
        while( $wp_query->have_posts() ) : $wp_query->the_post();
            $i++;
            $id = $wp_query->post->ID;
            if($masonry != 'yes') {
                if($i == 1 || ($i % $columns) === 1) {
                    $colclass = 'alpha';
                } elseif ($i == $columns || ($i % $columns) === 0 ) {
                    $colclass = 'omega';
                } else {
                    $colclass= '';
                }
            } else {
                $colclass= '';
            }

            $thumb = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url($thumb);

            $author_id = $wp_query->post->post_author;

            $output .= '
                <div class="'.$mainclass.' '.$colclass.' recent-blog">
                    <article class="from-the-blog">';
                    $format = get_post_format();
                    if( false === $format )  $format = 'standard';

                    if($format == 'standard' && has_post_thumbnail()){
                        $output .= '
                        <figure class="from-the-blog-image">
                            <a href="'.get_permalink().'">'.get_the_post_thumbnail($id,$imagesize).'</a>
                            <div class="hover-icon"></div>
                        </figure>
                        ';
                    }

                    if($format == 'gallery') {
                        $gallery = get_post_meta($id, '_format_gallery', TRUE);
                        preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );
                        if ( isset( $matches[1] ) ) {
                            // Found the IDs in the shortcode
                            $ids = explode( ',', $matches[1] );
                        } else {
                            // The string is only IDs
                            $ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
                        }
                        $output .= '<div class="basic-slider royalSlider rsDefault">';
                        foreach ($ids as $imageid) {
                            $image_link = wp_get_attachment_url( $imageid );
                            if ( ! $image_link )
                                continue;
                                $image          = wp_get_attachment_image_src( $imageid, 'large');
                                $imageRSthumb   = wp_get_attachment_image_src( $imageid, $imagesize );
                                $image_title    = esc_attr( get_the_title( $imageid ) );
                                $output .= '<a href="'.$image[0].'" class="mfp-gallery"  title="'.esc_attr($image_title).'"><img class="rsImg" alt="'.esc_attr($image_title).'" src="'.$imageRSthumb[0].'"  data-rsTmb="'.$imageRSthumb[0].'" /></a>';
                            }
                        $output .= '</div>';
                    }

                    if($format == 'quote') {
                        $output .= '<figure class="post-quote">
                            <span class="icon"></span>
                            <blockquote>
                              '.get_post_meta($id, '_format_quote_content', TRUE).'
                              <a href="'.esc_url(get_post_meta($id, '_format_quote_source_url', TRUE)).'"><span>- '.get_post_meta($id, '_format_quote_source_name', TRUE).'</span></a>
                            </blockquote>
                      </figure>';
                    } // eof gallery


                    if($format == 'video') {
                        $video = get_post_meta($id, '_format_video_embed', true);
                        if(!empty($video)) {
                            $output .= '<div class="embed">';
                                if(wp_oembed_get($video)) { $output .= wp_oembed_get($video); } else { $output .= $video;}
                            $output .= '</div>';
                        }
                    } // eof gallery

                    $output .= '
                    <section class="from-the-blog-content">
                        <a href="'.get_permalink().'"><h5>'.get_the_title().'</h5></a>';
                    $metas = ot_get_option('pp_meta_blog',array());
                    if (in_array("author", $metas)) {
                    $output .= '<i>'.__('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID',$author_id )).'">'.get_the_author_meta('display_name',$author_id).'</a>'.' ';
                    }
                    if (in_array("date", $metas)) {
                    $output .= __('on','trizzy').' '.get_the_date().'</i>';
                    }
                    $output .= '<span>';
                            $excerpt = get_the_excerpt();
                            $output .= string_limit_words($excerpt,$limit_words);
                    $output .= '</span>
                        <a href="'.get_permalink($id).'" class="button gray">'.__("Read More","trizzy").'</a>
                    </section>

                </article>
            </div>';
        endwhile;  // close the Loop
    endif;
     $output .= '</div>';
     wp_reset_query(); 
    return $output;
}

add_shortcode('latest_from_blog_carousel', 'trizzy_recent_blog_carousel');
function trizzy_recent_blog_carousel( $atts, $content ) {
    extract(shortcode_atts(array(
        'limit'=>'4',
        'columns' => '4',
        'orderby'=> 'date',
        'order'=> 'DESC',
        'categories' => '',
        'tags' => '',
        'width' => 'sixteen',
        'place' => 'center',
        'exclude_posts' => '',
        'ignore_sticky_posts' => 1,
        'limit_words' => 10,
        'from_vs' => 'no'
        ), $atts));

    $output = '';

    if(empty($width)) { $width = "sixteen"; } //set width to 16 even if empty value

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }
    wp_reset_query();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'orderby' => $orderby,
        'order' => $order,
        );
    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }

    if(!empty($categories)) {
        //$categories = explode(",", $categories);
        $args['category_name'] = $categories;
    }
    if(!empty($tags)) {
        $tags = explode(",", $tags);
        $args['tag__in'] = $tags;
    }
    $i = 0;
    $wp_query = new WP_Query( $args );
    $randID = rand(1, 99); // Get unique ID for carousel
     $imagesize = 'blog-size';
    $output = '
    <!-- ShowBiz Carousel -->
    <div id="recent-blog-carousel" class="recent-blog showbiz-container" >

        <!-- Navigation -->
        <div class="showbiz-navigation">
            <div id="showbiz_left_'.$randID.'" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
            <div id="showbiz_right_'.$randID.'" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
        </div>
        <div class="clearfix"></div>

        <div class="showbiz" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'" data-play="#showbiz_play_'.$randID.'" >

            <div class="overflowholder">
                <ul>';
            if ( $wp_query->have_posts() ):
                while( $wp_query->have_posts() ) : $wp_query->the_post();
             $id = $wp_query->post->ID;
                    $output .= '
                    <li>
                        <article class="from-the-blog">';
                    $format = get_post_format();
                    if( false === $format )  $format = 'standard';

                    if($format == 'standard' && has_post_thumbnail()){
                        $output .= '
                        <figure class="from-the-blog-image">
                            <a href="'.get_permalink().'">'.get_the_post_thumbnail($id,$imagesize).'</a>
                            <div class="hover-icon"></div>
                        </figure>
                        ';
                    }

                    if($format == 'gallery') {
                        $gallery = get_post_meta($id, '_format_gallery', TRUE);
                        preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );
                        if ( isset( $matches[1] ) ) {
                            // Found the IDs in the shortcode
                            $ids = explode( ',', $matches[1] );
                        } else {
                            // The string is only IDs
                            $ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
                        }
                        $output .= '<div class="basic-slider royalSlider rsDefault">';
                        foreach ($ids as $imageid) {
                            $image_link = wp_get_attachment_url( $imageid );
                            if ( ! $image_link )
                                continue;
                                $image          = wp_get_attachment_image_src( $imageid, 'large');
                                $imageRSthumb   = wp_get_attachment_image_src( $imageid, $imagesize );
                                $image_title    = esc_attr( get_the_title( $imageid ) );
                                $output .= '<a href="'.$image[0].'" class="mfp-gallery"  title="'.esc_attr($image_title).'"><img class="rsImg" alt="'.esc_attr($image_title).'" src="'.$imageRSthumb[0].'"  data-rsTmb="'.$imageRSthumb[0].'" /></a>';
                            }
                        $output .= '</div>';
                    }

                    if($format == 'quote') {
                        $output .= '<figure class="post-quote">
                            <span class="icon"></span>
                            <blockquote>
                              '.get_post_meta($id, '_format_quote_content', TRUE).'
                              <a href="'.esc_url(get_post_meta($id, '_format_quote_source_url', TRUE)).'"><span>- '.get_post_meta($id, '_format_quote_source_name', TRUE).'</span></a>
                            </blockquote>
                      </figure>';
                    } // eof gallery


                    if($format == 'video') {
                        $video = get_post_meta($id, '_format_video_embed', true);
                        if(!empty($video)) {
                            $output .= '<div class="embed">';
                                if(wp_oembed_get($video)) { $output .= wp_oembed_get($video); } else { $output .= $video;}
                            $output .= '</div>';
                        }
                    } // eof gallery

                    $output .= '
                    <section class="from-the-blog-content">
                        <a href="'.get_permalink().'"><h5>'.get_the_title().'</h5></a>';
                    $metas = ot_get_option('pp_meta_blog',array());
                    if (in_array("author", $metas)) {
                    $output .= '<i>'.__('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID',$author_id )).'">'.get_the_author_meta('display_name',$author_id).'</a>'.' ';
                    }
                    if (in_array("date", $metas)) {
                    $output .= __('on','trizzy').' '.get_the_date().'</i>';
                    }
                    $output .= '<span>';
                            $excerpt = get_the_excerpt();
                            $output .= string_limit_words($excerpt,$limit_words);
                    $output .= '</span>
                        <a href="'.get_permalink().'" class="button gray">'.__("Read More","trizzy").'</a>
                    </section>

                </article>';
                    $output .= '

                    </li>';
              endwhile;  // close the Loop
            endif;
                    $output .='
                </ul>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>';
    wp_reset_query(); 
    return $output;  
    }



/**
* Headline shortcode
* Usage: [headline ] [/headline] // margin-down margin-both
*/
function pp_headline( $atts, $content ) {
  extract(shortcode_atts(array(
    'margintop' => 0,
    'marginbottom' => 35,
    'clearfix' => 1
    ), $atts));
  $output = '<h3 class="headline" style="margin-top:'.$margintop.'px;">'.do_shortcode( $content ).'</h3>
            <span class="line" style="margin-bottom:'.$marginbottom.'px;"></span>';
    if($clearfix == 1) {   $output .= '<div class="clearfix"></div>';}
    return $output;
}
add_shortcode( 'headline', 'pp_headline' );


/**
* Columns shortcode
* Usage: [column width="eight" place="" custom_class=""] [/column]
*/

function pp_column($atts, $content = null) {
    extract( shortcode_atts( array(
        'width' => 'eight',
        'place' => '',
        'custom_class' => ''
        ), $atts ) );

    switch ( $width ) {
        case "1/3" : $w = "column one-third"; break;
        case "one-third" : $w = "column one-third"; break;

        case "2/3" :
        $w = "column two-thirds";
        break;

        case "one" : $w = "one columns"; break;
        case "two" : $w = "two columns"; break;
        case "three" : $w = "three columns"; break;
        case "four" : $w = "four columns"; break;
        case "five" : $w = "five columns"; break;
        case "six" : $w = "six columns"; break;
        case "seven" : $w = "seven columns"; break;
        case "eight" : $w = "eight columns"; break;
        case "nine" : $w = "nine columns"; break;
        case "ten" : $w = "ten columns"; break;
        case "eleven" : $w = "eleven columns"; break;
        case "twelve" : $w = "twelve columns"; break;
        case "thirteen" : $w = "thirteen columns"; break;
        case "fourteen" : $w = "fourteen columns"; break;
        case "fifteen" : $w = "fifteen columns"; break;
        case "sixteen" : $w = "sixteen columns"; break;

        default :
        $w = 'columns eight';
    }

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }

    $column ='<div class="'.$w.' '.$custom_class.' '.$p.'">'.do_shortcode( $content ).'</div>';
    if($place=='last') {
        $column .= '<br class="clear" />';
    }
    return $column;
}

add_shortcode('column', 'pp_column');


function pp_accordion( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab',
        'icon' => ''
        ), $atts));
    $output = '<h3><span class="ui-accordion-header-icon ui-icon ui-accordion-icon"></span>';
    if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'"></i>'; }
    $output .= $title.'</h3><div><p>'.do_shortcode( $content ).'</p></div>';
    return $output;
}
add_shortcode( 'accordion', 'pp_accordion' );

function pp_accordion_wrap( $atts, $content ) {
    extract(shortcode_atts(array(), $atts));
    return '<div class="accordion">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'accordionwrap', 'pp_accordion_wrap' );



function etdc_tab_group( $atts, $content ) {
    $GLOBALS['pptab_count'] = 0;
    do_shortcode( $content );
    $count = 0;
    if( is_array( $GLOBALS['tabs'] ) ) {
        foreach( $GLOBALS['tabs'] as $tab ) {
            $count++;
            $tabs[] = '<li><a href="#tab'.$count.'">'.$tab['title'].'</a></li>';
            $panes[] = '<div class="tab-content" id="tab'.$count.'">'.$tab['content'].'</div>';
        }
        $return = "\n".'<ul class="tabs-nav">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tabs-container">'.implode( "\n", $panes ).'</div>'."\n";
    }
    return $return;
}

/**
* Usage: [tab title="" ] [/tab]
*/
function etdc_tab( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Tab %d',
        ), $atts));

    $x = $GLOBALS['pptab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['pptab_count'] ), 'content' =>  do_shortcode( $content ) );
    $GLOBALS['pptab_count']++;
}
add_shortcode( 'tabgroup', 'etdc_tab_group' );

add_shortcode( 'tab', 'etdc_tab' );



/**
* Notice shortcode
* Usage: [contentbox title="Notice" icon="bolt" link="#"] [/contentbox]
*/
function pp_contentbox( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Notice',
        'icon' => 'bolt',
        'link' => '',
        'target' => '',
        'effect' => '1',
        'width' => '',
        'place' => '',
         'from_vs' => 'no'
        ), $atts));
    $output = '';
   switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }
    if($from_vs == 'no') { $output = '<div class="'.$width.' '.$p.' columns">'; }
    if($link) {
        if($target){
            $output .= '<a target="'.$target.'" href="'.esc_url($link).'">';
        } else {
            $output .= '<a  href="'.esc_url($link).'">';
        }
    }

    $output .= '<div class="content-box color-effect-'.$effect.'">
                    <h3>'.$title.'</h3>';
                if($icon) {
                    $output .= '
                    <div class="box-icon-wrap box-icon-effect-'.$effect.' box-icon-effect-'.$effect.'a">
                        <div class="box-icon"><i class="fa fa-'.$icon.'"></i></div>
                    </div>';
                }
    $output .= '<p>'.do_shortcode( $content ).'</p></div>';
    if($link) {
        $output .= '</a>';
    }
    if($from_vs == 'no') { $output .= '</div>'; }
    return $output;
}

add_shortcode( 'contentbox', 'pp_contentbox' );

/**
* Icon box shortcode
* Usage: [iconbox column="one-third" title="" link="" icon=""] [/iconbox]
*/
function pp_iconbox( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => '',
        'link' => '',
        'target' => '',
        'icon' => ''
        ), $atts));


    $output = '<div class="icon-box">
                    <span><i class="fa fa-'.$icon.'"></i></span>
                    <div class="icon-description">';
                    if($link) {
                        if($target){
                            $output .= '<h3><a target="'.$target.'" href="'.esc_url($link).'">'.$title.'</a></h3>';
                        } else {
                            $output .= '<h3><a href="'.esc_url($link).'">'.$title.'</a></h3>';
                        }
                    }
                    else {
                        $output .= '<h3>'.$title.'</h3>';
                    }
                    $output .= '<p>'.do_shortcode( $content ).'</p>
                    </div>
                </div>';
    return $output;
}
add_shortcode( 'iconbox', 'pp_iconbox' );


/**
* Skillbars shortcode
* Usage: [skillbars] [/skillbars]
*/

function pp_skillbars( $atts, $content ) {
    extract(shortcode_atts(array(), $atts));
    return '<div id="skillzz">'.do_shortcode( $content ).'</div>';
}

add_shortcode( 'skillbars', 'pp_skillbars' );


/**
* Usage: [skillbar title="Web Design 80%" value="80"]
*/
function pp_skillbar( $atts, $content ) {
    extract(shortcode_atts(array(
        'title' => 'Web Design',
        'value' => '80'
        ), $atts));
    return '<div class="skill-bar"><span class="skill-title">'.$title.' <i>'.$value.'%</i></span><div class="skill-bar-value" style="width: '.$value.'%;"></div></div>';
}

add_shortcode( 'skillbar', 'pp_skillbar' );



/**
* Box shortcodes
* Usage: [box type=""] [/box]
*/

function pp_box($atts, $content = null) {
    extract(shortcode_atts(array(
        "type" => ''
        ), $atts));
    return '<div class="notification closeable '.$type.'"><p>'.do_shortcode( $content ).'</p><a class="close" href="#"></a></div>';
}

add_shortcode('box', 'pp_box');


/**
* Recent work shortcode
* Usage: [clients_carousel title="Recent Work" ] [/clients_carousel]
*/
function pp_clients_carousel($atts, $content ) {
    extract(shortcode_atts(array(
        'width' => 'sixteen',
        'place' => 'center'
        ), $atts));

    $output = '';
    $width_arr = array(
        'sixteen' => 16, 'fifteen' => 15, 'fourteen' => 14, 'thirteen' => 13, 'twelve' => 12, 'eleven' => 11, 'ten' => 10, 'nine' => 9,
        'eight' => 8, 'seven' => 7, 'six' => 6, 'five' => 5, 'four' => 4, 'three' => 3
        );
    $randID = rand(1, 99); // Get unique ID for carousel
    if(empty($width)) { $width = "sixteen"; }

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }

    $carousel_width = $width_arr[$width] - 2;
    $carousel_key_width = array_search ($carousel_width, $width_arr);
    $output .= '
    <!-- Navigation / Left -->
    <div class="one carousel column alpha"><div id="showbiz_left_'.$randID.'" class="sb-navigation-left-alt sb-navigation-left-'.$randID.'"><i class="fa fa-angle-left"></i></div></div>

    <!-- ShowBiz Carousel -->
    <div id="our-clients" class="showbiz-container '.$carousel_key_width.' carousel columns" >

    <!-- Portfolio Entries -->
    <div class="showbiz our-clients" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'">
    <div class="overflowholder">';
    $output .= do_shortcode( $content );
    $output .='<div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div>
    <!-- Navigation / Right -->
    <div class="one carousel column omega"><div id="showbiz_right_'.$randID.'" class="sb-navigation-right-alt sb-navigation-right-'.$randID.'"><i class="fa fa-angle-right"></i></div></div></div>';
    return $output;
}

add_shortcode('clients_carousel', 'pp_clients_carousel');

function trizzy_counter_box( $atts, $content ) {
   extract(shortcode_atts(array(
            'title' => 'Happy Customers',
            'icon' => 'thumbs-o-up',
            'value' => '2,147',
            'colored' => 'no',
            'width' => 'four',
            'place' => 'first',
            'from_vs' => 'no'
            ), $atts));


    switch ( $place ) {
        case "last" : $p = "omega"; break;
        case "center" : $p = "alpha omega"; break;
        case "none" : $p = " "; break;
        case "first" : $p = "alpha"; break;
        default : $p = ' ';
    }
    if($colored == 'yes') { $class = "colored"; } else { $class = ' '; }
        $output = '';

    if($from_vs == 'no') {
        $output .= '<div class="'.$width.' '.$p.' columns">';
    }
     $output .= '<div class="counter-box '.$class.'">
            <i class="fa fa-'.$icon.'"></i>
            <span class="counter">'.$value.'</span>
            <p>'.$title.'</p>
        </div>';
    if($from_vs == 'no') {
        $output .= '</div>';
    }
    return $output;
}
add_shortcode( 'counterbox', 'trizzy_counter_box' );



/**
* Happy Tesimonials shortcode
* Usage: [happytestimonials limit="4" title="Testimonials" ]
*/

function pp_happytestimonials($atts, $content ) {
    extract(shortcode_atts(array(
        'limit'=>'4',
        'orderby' => 'date',
        'width' => 'sixteen',
        'place' => 'none',
        'exclude_posts' => '',
        'include_posts' => '',
        ), $atts));

    $randID = rand(1, 99);


    $args = array(
        'post_type' => array('testimonial'),
        'showposts' => $limit,
        'orderby' => $orderby
    );
    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }
    if(!empty($include_posts)) {
        $inc = explode(",", $include_posts);
        $args['post__in'] = $inc;
    }
    $wp_query = new WP_Query( $args );

    if(empty($width)) { $width = "sixteen"; }

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }

    $output = '<!-- Headline -->

    <div class="happywrapper"">
    <!-- Navigation / Left -->
    <div id="showbiz_left_'.$randID.'" class="sb-navigation-left-alt alt"><i class="fa fa-angle-left"></i></div>

    <!-- ShowBiz Carousel -->
    <div id="happy-clients" class="happy-clients showbiz-container  carousel " >

    <!-- Portfolio Entries -->
    <div class="showbiz our-clients" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'">
    <div class="overflowholder">
    <ul>';
    if ( $wp_query->have_posts() ):
        while( $wp_query->have_posts() ) : $wp_query->the_post();

    $id = $wp_query->post->ID;
    $author = get_post_meta($id, 'pp_author', true);
    $link = get_post_meta($id, 'pp_link', true);
    $position = get_post_meta($id, 'pp_position', true);
    $output .= '<li>';
    $output .= '<div class="happy-clients-photo">'. get_the_post_thumbnail($wp_query->post->ID,'portfolio-thumb').'</div>';
    $output .= '<div class="happy-clients-cite">'.get_the_content().'</div>';
    if($link) {
        $output .= ' <div class="happy-clients-author"><a href="'.$link.'">'.$author.'</a></div>';
    } else {
        $output .= ' <div class="happy-clients-author">'.$author.'</div>';
    }
    $output .= '</li>';
                endwhile;  // close the Loop
                endif;
                $output .='</ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
    <div id="showbiz_right_'.$randID.'" class="sb-navigation-right-alt alt"><i class="fa fa-angle-right"></i></div></div> <div class="clearfix"></div>';
    wp_reset_query();
            return $output;
}
add_shortcode('happytestimonials', 'pp_happytestimonials');



function trizzy_info_banner( $atts, $content ) {
   extract(shortcode_atts(array(
            'title' => 'Perfect Template for Showing Your Products',
            'url' => '#',
            'target' => '',
            'buttontext' => 'Get This Theme',
            ), $atts));

    $output = '
    <div class="info-banner">
        <div class="info-content">
            <h3>'.$title.'</h3>
            <p>'.do_shortcode( $content ).'</p>
        </div>';
        if($url) {
            if($target){
                $output .= '<a target="'.$target.'" href="'.$url.'" class="button color">'.$buttontext.'</a>';
            } else {
                $output .= '<a href="'.$url.'" class="button color">'.$buttontext.'</a>';
            }
        }
    $output .= '<div class="clearfix"></div>
    </div>';
    return $output;
}
add_shortcode( 'infobanner', 'trizzy_info_banner' );


/**
* Dropcap shortcode type = full
* Usage: [dropcap color="gray"] [/dropcap]// margin-down margin-both
*/
if (!function_exists('pp_dropcap')) {
    function pp_dropcap($atts, $content = null) {
        extract(shortcode_atts(array(
            'type'=>''), $atts));
        return '<span class="dropcap '.$type.'">'.$content.'</span>';
    }
    add_shortcode('dropcap', 'pp_dropcap');
}



if (!function_exists('pp_popup')) {
    function pp_popup($atts, $content = null) {
        extract(shortcode_atts(array(
            'buttontext'=>' Open Popup',
            'title'=>' Modal popup',
            ), $atts));
         $randID = rand(1, 99);
  $output = '
        <a class="popup-with-zoom-anim button color" href="#small-dialog'.$randID.'" ><i class="fa fa-info-circle"></i> '.$buttontext.'</a><br/>
            <div id="small-dialog'.$randID.'" class="small-dialog zoom-anim-dialog mfp-hide">
                <h2 class="margin-bottom-10">'.$title.'</h2>
                <p class="margin-reset">'.do_shortcode( $content ).'</p>
            </div>';
    return $output;
    }
    add_shortcode('popup', 'pp_popup');
}

/**
* Highlight shortcode
* Usage: [highlight style="gray"] [/highlight] // color, gray, light
*/
function pp_highlight($atts, $content = null) {
    extract(shortcode_atts(array(
        'style' => 'gray'
        ), $atts));
    return '<span class="highlight '.$style.'">'.$content.'</span>';
}
add_shortcode('highlight', 'pp_highlight');


/**
* Tooltip shortcode
* Usage: [tooltip title="" url=""] [/tooltip] // color, gray, light
*/
function pp_tooltip($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'url' => '#',
        'side' => 'top'
        ), $atts));
    return '<a href="'.$url.'" class="tooltip '.$side.'" title="'.esc_attr($title).'">'.$content.'</a>';
}

add_shortcode('tooltip', 'pp_tooltip');

function pp_button($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => '#',
        "color" => 'color',  //gray color dark
        "customcolor" => '',
        "iconcolor" => 'white',
        "icon" => '',
        "target" => '',
        "customclass" => '',
        "from_vs" => 'no',
        ), $atts));
    if($from_vs == 'yes') {
        $link = vc_build_link( $url );
        $a_href = $link['url'];
        $a_title = $link['title'];
        $a_target = $link['target'];
        $output = '<a class="button '.$color.' '.$customclass.'" href="'.$a_href.'" title="'.esc_attr( $a_title ).'" target="'.$a_target.'"';
        if(!empty($customcolor)) { $output .= 'style="background-color:'.$customcolor.'"'; }
        $output .= '>';
        if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'  '.$iconcolor.'"></i> '; }
        $output .= $a_title.'</a>';
    } else {
        $output = '<a class="button '.$color.' '.$customclass.'" href="'.$url.'" ';
        if(!empty($target)) { $output .= 'target="'.$target.'"'; }
        if(!empty($customcolor)) { $output .= 'style="background-color:'.$customcolor.'"'; }
        $output .= '>';
        if(!empty($icon)) { $output .= '<i class="fa fa-'.$icon.'  '.$iconcolor.'"></i> '; }
        $output .= $content.'</a>';
    }
    return $output;
}
add_shortcode('button', 'pp_button');



/**
* List style shortcode
* Usage: [list type="check"] [/list] // check, arrow, checkbg, arrowbg
*/
function pp_liststyle($atts, $content = null) {
    extract(shortcode_atts(array(
        "style" => '1',
        "color" => 'no'
        ), $atts));
    if($color=='yes') { $class="color"; } else { $class = ' '; };
    $output = '<div class="list-'.$style.' '.$class.'">'.$content.'</div>';
    return $output;
}

add_shortcode('list', 'pp_liststyle');



/**
* Pricing table shortcode
* Usage: [pricing_table featured="no" color="" header="" price="" per=""] [/pricing_table]
*/


function pp_pricing_table($atts, $content) {
    extract(shortcode_atts(array(
        "type" => '',
        "width" => 'four',
        "color" => '#f6f6f6',
        "title" => '',
        "currency" => '$',
        "price" => '',
        "per" => '',
        "buttonstyle" => '',
        "buttonlink" => '',
        "buttontext" => 'Sign Up',
        "place" =>'',
        "from_vs" => 'no'
        ), $atts));

    switch ( $place ) {
        case "last" :
        $p = "omega";
        break;

        case "center" :
        $p = "alpha omega";
        break;

        case "none" :
        $p = " ";
        break;

        case "first" :
        $p = "alpha";
        break;
        default :
        $p = ' ';
    }
    $output = '';
    if($from_vs == 'yes') {
        $output .= '<div class="'.$type.' plan">';
    }else {
        $output .= '<div class="'.$type.' plan '.$width.' '.$p.' columns">';
    }
    $output .= '<div class="plan-price" style="background-color: '.$color.';">
    <h3>'.$title.'</h3>
    <span class="plan-currency">'.$currency.'</span>
    <span class="value">'.$price.'</span>
    <span class="period">'.$per.'</span>
    </div>
    <div class="plan-features">'.do_shortcode( $content );
    if($buttonlink) {
        $output .=' <a class="button"  style="background-color: '.$color.';" href="'.$buttonlink.'">'.$buttontext.'</a>';
    }
    $output .=' </div>';
    $output .= '</div>';
    return $output;
}

add_shortcode('pricing_table', 'pp_pricing_table');


function pp_share_btn($atts) {
    extract(shortcode_atts(array(
        "facebook" => '',
        "pinit" => '',
        "twitter" => '',
        "gplus" => '',

        ), $atts));
    global $post;

    $id = $post->ID;
    $title = urlencode($post->post_title);
    $url =  urlencode( get_permalink($id) );
    $summary = urlencode(string_limit_words($post->post_excerpt,20));
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
    $imageurl = urlencode($thumb[0]);

    $output ='<!-- Share Buttons -->
    <div class="share-buttons">
    <ul>
        <li><a href="#">'.__("Share","trizzy").'</a></li>';
        if(!empty($facebook)) $output .= '<li class="share-facebook"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '">Facebook</a></li>';
        if(!empty($pinit)) $output .= '<li class="share-pinit"><a target="_blank" href="http://pinterest.com/pin/create/button/?url=' . $url . '&amp;description=' . esc_attr($summary) . '&media=' . $imageurl . '" onclick="window.open(this.href); return false;">Pin it</a></li>';
        if(!empty($gplus)) $output .= '<li class="share-gplus"><a target="_blank" href="https://plus.google.com/share?url=' . $url . '&amp;title="' . esc_attr($title) . '" onclick=\'javascript:window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;\'>Google Plus</a></li>';
        if(!empty($twitter)) $output .= '<li class="share-twitter"><a target="_blank"  href="https://twitter.com/share?url=' . $url . '&amp;text=' . esc_attr($summary ). '" title="' . __( 'Twitter', 'trizzy' ) . '">Twitter</a></li>';
    $output .= '</ul>
    </div>
    <div class="clearfix"></div>';
    return $output;
}

add_shortcode('shareit', 'pp_share_btn');





/**
* Recent work shortcode
* Usage: [recent_work limit="4" title="Recent Work" orderby="date" order="DESC" filters="" carousel="yes"] [/recent_work]
*/
function pp_recent_work( $atts, $content ) {
    extract(shortcode_atts(array(
        'orderby'=> 'date',
        'order'=> 'DESC',
        'per_page'  => '12',
        'filters' => '',
        'exclude_posts' => '',
        'include_posts' => '',
        ), $atts));

    global $woocommerce, $product;

    $randID = rand(1, 99); // Get unique ID for carousel

    $args = array(
        'suppress_filters' => false,
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'orderby'               => $orderby,
        'order'                 => $order,
        'posts_per_page'        => $per_page,
        );

    if(!empty($exclude_posts)) {
        $exl = explode(",", $exclude_posts);
        $args['post__not_in'] = $exl;
    }
    if(!empty($include_posts)) {
        $inc = explode(",", $include_posts);
        $args['post__in'] = $inc;
    }

    if(!empty($filters)) {
        $filters = explode(",", $filters);
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'filters',
                'field' => 'slug',
                'terms' => $filters
                )
            );
    }
    $output = '
    <!-- ShowBiz Carousel -->
    <div id="new-arrivals" class="new-arrivals showbiz-container" >

    <!-- Navigation -->
    <div class="showbiz-navigation">
    <div id="showbiz_left_'.$randID.'" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
    <div id="showbiz_right_'.$randID.'" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
    </div>
    <div class="clearfix"></div>

    <div class="showbiz" data-left="#showbiz_left_'.$randID.'" data-right="#showbiz_right_'.$randID.'" data-play="#showbiz_play_'.$randID.'" >

    <div class="overflowholder">
    <ul>';
     $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts() ):
        while( $wp_query->have_posts() ) : $wp_query->the_post();
             $output .= '
            <li>
            <figure class="portfolio-item">
                <div class="portfolio-holder">';
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url($thumb);
        $output .= '<a href="'.get_permalink().'"  title="'.get_the_title().'">';
                    $output .= get_the_post_thumbnail($wp_query->post->ID,'blog-size');
                $output .= '
                        <div class="hover-cover"></div>
                        <div class="hover-icon"></div>
                    </a>
                </div>';
        $output .= '
                <a href="'.get_permalink().'">
                    <section class="item-description">';
                    $terms = get_the_terms( $wp_query->post->ID, 'filters' );
                    if ( $terms && ! is_wp_error( $terms ) ) :
                    $output .= '<span>';
                        $filters = array();
                        $i = 0;
                        foreach ( $terms as $term ) {
                            $filters[] = $term->name;
                            if ($i++ > 0) break;
                        }
                        $outputfilters = join( ", ", $filters );
                        $output .= $outputfilters;
                    $output .= '</span>';
                    endif;
                    $output .= '
                    <h5>'.get_the_title().'</h5>
                    </section>
                </a>
            </figure>
            </li>';
        endwhile; // end of the loop.
    endif;
                    $output .='
                          </ul>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>';
return $output;
}

add_shortcode('recent_work', 'pp_recent_work');





/**
* Team members shortcode
* Usage: [team title="Team" ]
*/

function pp_team($atts, $content ) {
    extract(shortcode_atts(array(
        'limit'=>'4',
        'title' => 'Team',
        'members' => '',
        'link_to_pages' => 'yes',
        'width_of_single_box' => 'one-third',
        'columns' => '',
        'from_vs' => 'no', 
        'orderby'=> 'date',
        'order'=> 'DESC',
        ), $atts));

    $randID = rand(1, 99);

    if(!empty($members)) {
        $members = explode(",", $members);
        $args = array(
            'post_type' => array('team'),
            'showposts' => $limit,
            'post__in' => $members,
            'orderby' => $orderby,
            'order' => $order,
        );
    } else {
       $args = array(
        'post_type' => array('team'),
        'showposts' => $limit,
        'orderby'  => $orderby,
        'order'  => $order,
        );
   }
   if($from_vs === 'yes'){
        switch ($columns) {
            case '2':
                $mainclass = "vc_col-sm-6 wpb_column";
                break;
            case '3':
                $mainclass = "vc_col-sm-4 wpb_column";
                break;
            case '4':
                $mainclass = "vc_col-sm-3 wpb_column";
                break;


            default:
                # code...
                break;
        }
    }
   $wp_query = new WP_Query($args);
   $counter = 0;
   $columns = trizzy_get_number_from_column($width_of_single_box);
   $output = '';
   if ( $wp_query->have_posts() ):
        while( $wp_query->have_posts() ) : $wp_query->the_post();

        $counter++;
        if ($counter == 1) {
            $class = 'alpha';
        } else if( $counter % $columns == 0) {
            $class = 'omega';
        } else if ( $counter % $columns == 1 ) {
            $class = 'alpha';
        } else if ($counter == $limit) {
            $class = 'omega';
        } else {
            $class = '';
        }

            $id = $wp_query->post->ID;
            $position = get_post_meta($id, 'pp_position', true);
            $social = get_post_meta($id, 'pp_socialicons', true);
            if($from_vs == 'no') {
                $output .= '<div class="'.$width_of_single_box.' '.$class.' column"> <article class="the-team">';
            } else {
                $output .= '<div class="'.$mainclass.' '.$class.'"> <article class="the-team">';
            }
            if ( has_post_thumbnail() ) {
                if($link_to_pages == 'yes') {
                    $output .= '<figure class="the-team-image"><a href="'.get_permalink($wp_query->post->ID).'">'.get_the_post_thumbnail($wp_query->post->ID,'team-thumb', array('class' => 'mediaholder team-img')).'</a><div class="hover-icon"></div></figure>';
                } else {
                    $output .= '<figure class="the-team-image">'.get_the_post_thumbnail($wp_query->post->ID,'team-thumb', array('class' => 'mediaholder team-img')).'</figure>';
                }
            }
            $output .= '
            <section class="the-team-content">';
            if($link_to_pages == 'yes') {
               $output .=  '<h5><a href="'.get_permalink($wp_query->post->ID).'">'.get_the_title().'</a></h5> <i>'.$position.'</i>';
            } else {
               $output .=  '<h5>'.get_the_title().'</h5> <i>'.$position.'</i>';
            }
            $output .= '<span>'.get_the_excerpt().'</span>';

            if(!empty($social)){
                $output .= '<ul class="social-icons the-team-social">';
                foreach ($social as $icon) {
                    $output .= '<li><a class="'.$icon['icons_service'].' tooltip top" href="'.esc_url($icon['icons_url']).'" title="'.esc_attr($icon['title']).'"><i class="icon-'.$icon['icons_service'].'"></i></a></li>';
                }
                $output .= '</ul><div class="clearfix"></div>';
            }

        $output .= '</section></article>
    </div>';

        endwhile;  // close the Loop
    endif;

    $output .= '<div class="clearfix"></div>';
                wp_reset_query();
                return $output;
}

add_shortcode('team', 'pp_team');



function pp_basic_slide($atts) {
    extract(shortcode_atts(array(
        "image" => '',
        "url" => '#',
        "caption" => '',
        "alt" => '',

        ), $atts));
    $output = '';

     $output .= '<a href="'.$url.'">';
        $output .='<img class="rsImg" src="'.$image.'" alt="'.$alt.'" /><span class="royal-caption">'.$caption.'</span>';
     $output .= '</a>';
    return $output;
}
add_shortcode('slide', 'pp_basic_slide');

function pp_basic_slider( $atts, $content ) {
    extract(shortcode_atts(array(
        "image" => '',
        "url" => '#',
        "caption" => '',

        ), $atts));
    return '<div class="basic-slider royalSlider rsDefault">'.do_shortcode( $content ).'</div>';
}
add_shortcode( 'slider', 'pp_basic_slider' );

function trizzy_magazine_lead( $atts, $content ) {
    extract(shortcode_atts(array(
        "slider" => '',
        "leadpost" => '',
        "sideposts" => '',
        ), $atts));

    $output = '<div class="magazine-lead">';
    if(!empty($slider)){
        $output .= '<div class="featured two-thirds columns alpha">';
        $output .= do_shortcode( '[rev_slider '.$slider.']');
        $output .= '</div>';
    } else {
        if(!empty($leadpost)) {
            $post = get_post($leadpost);
            $output .= '<div class="featured two-thirds columns alpha">
                <figure>'.get_the_post_thumbnail($post->ID).'
                    <a href="'.get_permalink( $post->ID).'"><figcaption>
                        <time>'.get_the_time(get_option('date_format'), $post->ID).'</time>
                        <h3>'.$post->post_title.'</h3>
                        <ul>';
                        foreach((get_the_category( $post->ID)) as $category) {
                            $output .= '<li><button class="button color">'.$category->cat_name.'</button></li>';
                        }
            $output .= '</ul>
                    </figcaption></a>
                </figure>
            </div>';
        }
    }
    $output .= '<div class="side one-third columns omega">';
    $inc = explode(",", $sideposts);

    $args = array(
        'ignore_sticky_posts' => 1,
        'post_type' => 'post',
        'post_status' => 'publish',
        'post__in' => $inc,
        'posts_per_page' => 2,
        );

    $wp_query = new WP_Query( $args );
    if ( $wp_query->have_posts() ):
        while( $wp_query->have_posts() ) : $wp_query->the_post();
            $output .= '
            <div class="lead-post">
                <figure>
                   '.get_the_post_thumbnail($wp_query->post->ID,'team-thumb', array('class' => '')).'
                    <a href="'.get_permalink($wp_query->post->ID).'"><figcaption>
                        <time>'.get_the_time(get_option('date_format'), $wp_query->post->ID).'</time>
                        <h3>'.get_the_title().'</h3>
                    </figcaption></a>
                </figure>
            </div>';
        endwhile;  // close the Loop
    endif;
    $output .= ' </div></div>';
 wp_reset_query();
    return $output;
}
add_shortcode( 'magazine_lead', 'trizzy_magazine_lead' );



add_shortcode('trizzy_featured_products', 'trizzy_featured_products');
 function trizzy_featured_products( $atts, $content ) {
        extract(shortcode_atts(array(
            'per_page' => '12',
            'columns'  => '4',
            'with_sidebar'  => 'yes',
            'ids' => '',
            'orderby'  => 'date',
            'order'    => 'desc'
        ), $atts));


        $meta_query   = WC()->query->get_meta_query();
        if ( empty( $ids ) ) {
            $meta_query[] = array(
                'key'   => '_featured',
                'value' => 'yes'
            );
        }
        $query_args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $per_page,
            'orderby'             => $orderby,
            'order'               => $order,
            'meta_query'          => $meta_query

        );
        if ( !empty( $ids ) ) {
            $ids = explode( ',', $ids );
            $ids = array_map( 'trim', $ids );
            $query_args['post__in'] = $ids;
        } 
        
       
        $loop = 0;

        $output = '<div class="masonry products percent"> ';
        $products = get_posts( $query_args );
            if ( $products ) :
                foreach( $products as $productshop ) : setup_postdata($productshop);
                $loop++;
                $product = get_product( $productshop->ID );
                $hoverid = get_post_meta($productshop->ID, 'pp_featured_hover', TRUE);

             $classes = '';
             $colclass = '';
            if ( $columns == 4 && ($loop % 4) == 0) {
                 $classes = 'omega last';
            }
            if ( $columns == 4 && ($loop % 4) == 1) {
                 $classes = 'alpha first';
            }
            if ( $columns == 3 && ($loop % 3) == 0) {
                 $classes = 'omega last';
            }
            if ( $columns == 3 && ($loop % 3) == 1) {
                 $classes = 'alpha first';
            }

            if($with_sidebar == "yes") {
                switch ($columns) {
                      case 4:
                       $colclass = "three";
                        break;   
                    case 3:
                       $colclass = "four";
                        break;
                    default:
                        $colclass = "three";
                        break;
                }
            } else {
                switch ($columns) {
                    
                    case 4:
                       $colclass = " four";
                        break;   
                    case 3:
                       $colclass = "one-third";
                        break;
                    default:
                        $colclass = " four";
                        break;
                }
            }

            $output .= '
                <div class="columns masonry-shop-item '.$classes.' '.$colclass .'">
                    <figure class="product">';
                    if ( $product->is_on_sale() ) :
                        $output .= '<span class="onsale">' . __( 'Sale!', 'trizzy' ) . '</span>';
                    endif;
                    if ( !$product->is_in_stock() ) :
                        $output .= '<span class="onsale soldout">'.__('Sold Out','trizzy').'</span>';
                    endif;
                    if(!empty($hoverid)) {
                        $output .='<div class="mediaholder">';
                    } else {
                        $output .='<div class="mediaholder no-anim">';
                    }
                    if ( has_post_thumbnail($productshop->ID)) {
                        $output .=  '<a href="'.get_permalink($productshop->ID).'" >';
                        $output .= get_the_post_thumbnail($productshop->ID,'shop_catalog');
                        $alt    = esc_attr( get_the_title( $productshop->ID ) );
                        $hoverthumb = wp_get_attachment_image_src($hoverid, 'shop_catalog');
                        if(!empty($hoverthumb[0])) {
                            $output .=  '
                                <div class="cover">
                                    <img alt="'.$alt.'" src="'.$hoverthumb[0].'"/>
                                </div>';
                        }
                        $output .= '</a>';
                        if($product->product_type == 'simple') {
                            // echo esc_url($product->add_to_cart_url());
                            $output .= sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product-button product_type_%s"><i class="fa fa-shopping-cart"></i>%s</a>',
                                esc_url( $product->add_to_cart_url() ),
                                esc_attr( $product->id ),
                                esc_attr( $product->get_sku() ),
                                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                esc_attr( $product->product_type ),
                                esc_html( $product->add_to_cart_text() )
                            );
                            //$output .= '<a href="'.esc_url($product->add_to_cart_url()).'" class="add_to_cart_button product-button"><i class="fa fa-shopping-cart"></i>'.$product->single_add_to_cart_text().'</a>';
                        } else {
                            $output .= '<a href="'.get_permalink($productshop->ID).'" class="product-button">'.$product->add_to_cart_text().'</a>';
                        }
                        $output .= '</div>';
                    }
                    $product_cats = wp_get_post_terms( $productshop->ID, 'product_cat' );
                    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
                        $single_cat = array_shift( $product_cats );
                        $cat = $single_cat->name;
                    }

                    $output .= '

                    <a href="'.get_permalink($productshop->ID).'" >
                        <section>
                            <span class="product-category">'.$cat.'</span>
                                <h5>'.get_the_title($productshop->ID).'</h5>
                                <span class="price">'.$product->get_price_html().'</span>
                        </section>
                    </a>
                </figure>';
                    $output .= '

                    </div>';
                    $classes = '';
                endforeach; // end of the loop.
            endif;
             $output .= '

                    </div>';
        return $output; wp_reset_postdata(); $products = '';
    }

?>
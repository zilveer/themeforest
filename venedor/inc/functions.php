<?php

global $venedor_settings;

// Theme setup
add_action('after_setup_theme', 'venedor_theme_setup');
if ( ! function_exists( 'venedor_theme_setup' ) ) : function venedor_theme_setup(){
    if (function_exists('add_theme_support')) {
        // Default RSS feed links
        add_theme_support('automatic-feed-links');
        // Woocommerce Support
        add_theme_support('woocommerce');
        // Post Formats
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio', 'chat'));
        // Image Size
        add_theme_support('post-thumbnails');

        $related_post_w = isset($venedor_settings['related-post-w'])?$venedor_settings['related-post-w']:400;
        $related_post_h = isset($venedor_settings['related-post-h'])?$venedor_settings['related-post-h']:$related_post_w * 184 / 400;
        add_image_size('post-related', $related_post_w, $related_post_h, true);

        $related_portfolio_w = isset($venedor_settings['related-portfolio-w'])?$venedor_settings['related-portfolio-w']:400;
        $related_portfolio_h = isset($venedor_settings['related-portfolio-h'])?$venedor_settings['related-portfolio-h']:$related_portfolio_w * 320 / 400;
        add_image_size('portfolio-related', $related_portfolio_w, $related_portfolio_h, true);

        add_image_size('post-large', 1140);
        add_image_size('post-medium', 1000);
        add_image_size('post-small', 645);
        add_image_size('post-grid', 560);
        add_image_size('post-timeline', 560);
        add_image_size('portfolio-single-large', 1140);
        add_image_size('portfolio-single-medium', 750);
        add_image_size('portfolio-grid2', 560);
        add_image_size('portfolio-grid3', 400);
        add_image_size('portfolio-grid4', 400);

        add_editor_style();
    }
    // Translation
    load_theme_textdomain('venedor', TEMPLATEPATH . '/languages');
    load_child_theme_textdomain( 'venedor', get_stylesheet_directory() . '/languages' );
} endif;

// Location Files
$locale = get_locale();
$locale_file = get_template_directory_uri() . "/languages/$locale.php";
if (is_readable($locale_file) )
    require_once($locale_file);
// Allow shortcodes in widget text
add_filter('widget_text', 'do_shortcode');

if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    } else {
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
}

include_once(ABSPATH.'wp-admin/includes/plugin.php');

// Theme Activation Hook
add_action('admin_init','venedor_theme_activation');
function venedor_theme_activation() {
    global $pagenow;
    if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']))
    {
        update_option('shop_catalog_image_size', array('width' => 228, 'height' => '', 0));
        update_option('shop_single_image_size', array('width' => 800, 'height' => '', 0));
        update_option('shop_thumbnail_image_size', array('width' => 128, 'height' => '', 0));

        // Auto plugin activation
        // Reset activated plugins because if pre-installed plugins are already activated in standalone mode, theme will bug out.
        if (get_option('venedor_init_theme', '0') == '0') {
            global $wpdb;
            $wpdb->query("UPDATE ". $wpdb->options ." SET option_value = 'a:0:{}' WHERE option_name = 'active_plugins';");
            if($wpdb->sitemeta) {
                $wpdb->query("UPDATE ". $wpdb->sitemeta ." SET meta_value = 'a:0:{}' WHERE meta_key = 'active_plugins';");
            }
            update_option('venedor_init_theme', '1');
        }
    }
}

// Include Widgets
get_template_part('inc/widgets');

require_once(sys_lib.'/shortcodes.php');
require_once(sys_lib.'/menus.php');
require_once(sys_lib.'/plugins.php');
require_once(sys_lib.'/content_types.php');

if( class_exists( 'kdMultipleFeaturedImages' ) ) {
    $i = 2;

    if (isset($venedor_settings['post-slideshow-count'])) {
        while($i <= $venedor_settings['post-slideshow-count']) {
            $args = array(
                    'id' => 'featured-image-'.$i,
                    'post_type' => 'post',      // Set this to post
                    'labels' => array(
                        'name'      => 'Featured Image '.$i,
                        'set'       => 'Set featured image '.$i,
                        'remove'    => 'Remove featured image '.$i,
                        'use'       => 'Use as featured image '.$i,
                    )
            );

            new kdMultipleFeaturedImages( $args );

            $args = array(
                    'id' => 'featured-image-'.$i,
                    'post_type' => 'page',      // Set this to page
                    'labels' => array(
                        'name'      => 'Featured Image '.$i,
                        'set'       => 'Set featured image '.$i,
                        'remove'    => 'Remove featured image '.$i,
                        'use'       => 'Use as featured image '.$i,
                    )
            );

            new kdMultipleFeaturedImages( $args );

            $i++;
        }
    }
    
    $i = 2;

    if (isset($venedor_settings['portfolio-slideshow-count'])) {
        while($i <= $venedor_settings['portfolio-slideshow-count']) {
            $args = array(
                    'id' => 'featured-image-'.$i,
                    'post_type' => 'portfolio',  // Set this to portfolio
                    'labels' => array(
                        'name'      => 'Featured Image '.$i,
                        'set'       => 'Set featured image '.$i,
                        'remove'    => 'Remove featured image '.$i,
                        'use'       => 'Use as featured image '.$i,
                    )
            );

            new kdMultipleFeaturedImages( $args );

            $i++;
        }
    }
}

// Addthis Settings
// Don't display the widget above normally.
add_filter('addthis_above_content', 'venedor_addthis_remove', 10, 1);
add_filter('addthis_below_content', 'venedor_addthis_remove', 10, 1);

function venedor_addthis_remove($style) {
    return false;
}

// Post Comment Form Field
add_filter('comment_form_default_fields', 'venedor_comment_form_default_fields', 10, 1);
add_filter('comment_form_defaults', 'venedor_comment_form_defaults', 10, 1);

if (!function_exists('venedor_comment_form_default_fields')) :
function venedor_comment_form_default_fields($fields) {
    $fields['author'] = str_replace('<p class="comment-form-author"><label for="author">', '<p class="comment-form-author input-field"><label for="author"><span class="fa fa-user"></span>', $fields['author']);;
    $fields['email'] = str_replace('<p class="comment-form-email"><label for="email">', '<p class="comment-form-email input-field"><label for="email"><span class="fa fa-envelope"></span>', $fields['email']);;
    $fields['url'] = str_replace('<p class="comment-form-url"><label for="url">', '<p class="comment-form-url input-field"><label for="url"><span class="fa fa-globe"></span>', $fields['url']);;
    return $fields;
}
endif;

if (!function_exists('venedor_comment_form_defaults')) :
function venedor_comment_form_defaults($default) {
    $default['comment_field'] = str_replace('<p class="comment-form-comment"><label for="comment">', '<p class="comment-form-comment textarea-field"><label for="comment"><span class="fa fa-edit"></span>', $default['comment_field']);
    
    return $default;
}
endif;

if (!function_exists('get_related_posts')) :
function get_related_posts($post_id) {
    $query = new WP_Query();

    $args = '';

    $args = wp_parse_args($args, array(
        'showposts' => -1,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'category__in' => wp_get_post_categories($post_id)
    ));

    $query = new WP_Query($args);

    return $query;
}
endif;

// Get related portfolios
if (!function_exists('get_related_portfolios')) :
function get_related_portfolios($post_id) {
    $query = new WP_Query();
    $args = '';
    $item_array = array();

    $item_cats = get_the_terms($post_id, 'portfolio_cat');
    if ($item_cats) :
        foreach($item_cats as $item_cat) {
            $item_array[] = $item_cat->term_id;
        }
    endif;

    $args = wp_parse_args($args, array(
        'showposts' => -1,
        'post__not_in' => array($post_id),
        'ignore_sticky_posts' => 0,
        'post_type' => 'portfolio',
        'tax_query' => array(
            array(
                'taxonomy' => 'portfolio_cat',
                'field' => 'id',
                'terms' => $item_array
            )
        )
    ));

    $query = new WP_Query($args);

    return $query;
}
endif;

if (!function_exists('venedor_comment')) :
function venedor_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

        <div class="comment-body">
            <div class="avatar">
                <?php echo get_avatar($comment, 70); ?>
            </div>

            <div class="comment-box">

                <div class="comment-author meta">
                    <strong><?php echo get_comment_author_link() ?></strong>
                    <span class="comment-date"><?php printf(__('%1$s at %2$s', 'venedor'), get_comment_date(),  get_comment_time()) ?></span> <?php edit_comment_link(__('Edit', 'venedor'),'  ','') ?> <?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply', 'venedor'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>

                <div class="comment-text">
                    <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php echo __('Your comment is awaiting moderation.', 'venedor') ?></em>
                    <br />
                    <?php endif; ?>
                    <?php comment_text() ?>
                </div>

            </div>

        </div>

<?php }
endif;

if (!function_exists('venedor_excerpt')) :
function venedor_excerpt($limit = 45, $more_link = true) {
    global $venedor_settings;

    $post_layout = $venedor_settings['post-layout'];
    
    $post_layout = (isset($_GET['post-layout'])) ? $_GET['post-layout'] : $post_layout;
    
    if (!$limit) {
        $limit = 45;
    }

    $custom_excerpt = false;

    $post = get_post(get_the_ID());

    if (has_excerpt()) {
        $content = strip_tags( strip_shortcodes(get_the_excerpt()) );
    } else {
        $content = strip_tags( strip_shortcodes(get_the_content()) );
    }
    
    $content = explode(' ', $content, $limit);
        
    if (count($content) >= $limit) {
        array_pop($content);
        if ($post_layout == 'small-alt' || $venedor_settings['blog-excerpt-type'] == 'html')
            $content = implode(" ",$content).'...';
        else
            $content = implode(" ",$content);
    } else {
        $content = implode(" ",$content);
    }

    if ($venedor_settings['blog-excerpt-type'] == 'html') {
        $content = apply_filters('the_content', $content);
        $content = do_shortcode($content);
    }

    if ($more_link && $post_layout == 'small-alt')
        $content = '<div class="entry-excerpt">'.$content.'<br/><a class="btn more-links" href="'.esc_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.__('Read More', 'venedor').'</a></div>';
    else if ($more_link)
        $content = '<div class="entry-excerpt">'.$content.' <a class="inline more-links" href="'.esc_url( apply_filters( 'the_permalink', get_permalink() ) ).'">'.__('Read More', 'venedor').'...</a></div>';

    return $content;
}
endif;

if(!function_exists('venedor_pagination')):
function venedor_pagination($pages = '', $range = 2)
{
    global $data;

    $showitems = ($range * 2)+1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages)
        {
            $pages = 1;
        }
    }

    if (1 != $pages)
    {
        echo "<div class='clearfix'><div class='pagination right'>";
        if ($paged > 1) echo "<a class='prev' href='".get_pagenum_link($paged - 1)."'></a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
            }
        }

        if ($paged < $pages) echo "<a class='next' href='".get_pagenum_link($paged + 1)."'></a>";
        echo "</div></div>\n";
    }
}
endif;

// get attribute from html tag
if (!function_exists('venedor_get_html_attribute')):
function venedor_get_html_attribute($attrib, $tag) {
    $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
    preg_match($re, $tag, $match);

    if ($match) {
        return urldecode($match[1]);
    }
    return false;
}
endif;

// add url parameters
if (!function_exists('venedor_add_url_parameters')):
    function venedor_add_url_parameters($url, $name, $value) {
        $url_data = parse_url(str_replace('#038;', '&', $url));
        if (!isset($url_data["query"]))
            $url_data["query"]="";

        $params = array();
        parse_str($url_data['query'], $params);
        $params[$name] = $value;
        $url_data['query'] = http_build_query($params);
        return str_replace('#038;', '&', venedor_build_url($url_data));
    }
endif;

// remove url parameters
if (!function_exists('venedor_remove_url_parameters')):
    function venedor_remove_url_parameters($url, $name) {
        $url_data = parse_url(str_replace('#038;', '&', $url));
        if (!isset($url_data["query"]))
            $url_data["query"]="";

        $params = array();
        parse_str($url_data['query'], $params);
        $params[$name] = "";
        $url_data['query'] = http_build_query($params);
        return str_replace('#038;', '&', venedor_build_url($url_data));
    }
endif;

// build url
if (!function_exists('venedor_build_url')):
function venedor_build_url($url_data) {
    $url="";
    if (isset($url_data['host'])) {
        $url .= $url_data['scheme'] . '://';
        if (isset($url_data['user'])) {
            $url .= $url_data['user'];
            if (isset($url_data['pass']))
                $url .= ':' . $url_data['pass'];
            $url .= '@';
        }
        $url .= $url_data['host'];
        if (isset($url_data['port']))
            $url .= ':' . $url_data['port'];
    }
    if (isset($url_data['path']))
        $url .= $url_data['path'];
    if (isset($url_data['query']))
        $url .= '?' . $url_data['query'];
    if (isset($url_data['fragment']))
        $url .= '#' . $url_data['fragment'];

    return $url;
}
endif;

// get breadcrumbs
if (!function_exists('venedor_breadcrumbs')):
function venedor_breadcrumbs() {
    global $venedor_settings, $post, $wp_query, $author;

    $delimiter = '<li><span>/</span></li>';
    if ($venedor_settings['breadcrumbs-separator']) {
        $delimiter = '<li><span>'. ($venedor_settings['breadcrumbs-separator'] != '>' ? $venedor_settings['breadcrumbs-separator'] : '&gt;') .'</span></li>';
    }

    $prepend = '';
    $before = '<li>';
    $after = '</li>';
    $home = __('Home', 'venedor');

    $shop_page_id = false;
    $shop_page = false;
    $front_page_shop = false;
    if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
        $permalinks   = get_option( 'woocommerce_permalinks' );
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page    = get_post( $shop_page_id );
        $front_page_shop = get_option( 'page_on_front' ) == wc_get_page_id( 'shop' );
    }

    // If permalinks contain the shop page in the URI prepend the breadcrumb with shop
    if ( $shop_page_id && $shop_page && strstr( $permalinks['product_base'], '/' . $shop_page->post_name ) && get_option( 'page_on_front' ) != $shop_page_id ) {
        $prepend = $before . '<a href="' . get_permalink( $shop_page ) . '">' . $shop_page->post_title . '</a> ' . $after . $delimiter;
    }

    if ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && $front_page_shop ) ) || is_paged() ) {
        echo '<ul>';

        if ( ! empty( $home ) ) {
            echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after . $delimiter;
        }

        if ( is_home() ) {

            echo $before . single_post_title('', false) . $after;

        } else if ( is_category() ) {

            $cat_obj = $wp_query->get_queried_object();
            $this_category = get_category( $cat_obj->term_id );

            if ( 0 != $this_category->parent ) {
                $parent_category = get_category( $this_category->parent );
                if ( ( $parents = get_category_parents( $parent_category, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $delimiter . $before) ) . $after . $delimiter;
                }
            }

            echo $before . single_cat_title( '', false ) . $after;

        } elseif ( is_tax('product_cat') || is_tax('portfolio_cat') || is_tax('portfolio_skills') ) {

            echo $prepend;

            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );

            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );

                echo $before . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '">' . esc_html( $ancestor->name ) . '</a>' . $after . $delimiter;
            }

            echo $before . esc_html( $current_term->name ) . $after;

        } elseif ( is_tax('product_tag') ) {

            $queried_object = $wp_query->get_queried_object();
            echo $prepend . $before . sprintf( __( 'Products tagged &ldquo;%s&rdquo;', 'woocommerce' ), $queried_object->name ) . $after;

        } elseif ( is_day() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
            echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . $delimiter;
            echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {

            echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
            echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {

            echo $before . get_the_time('Y') . $after;

        } elseif ( is_post_type_archive('product') && get_option('page_on_front') !== $shop_page_id ) {

            $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';

            if ( ! $_name ) {
                $product_post_type = get_post_type_object( 'product' );
                $_name = $product_post_type->labels->singular_name;
            }

            if ( is_search() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . sprintf( __( 'Search results for &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() ) . $after;

            } elseif ( is_paged() ) {

                echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;

            } else {

                echo $before . $_name . $after;

            }

        } elseif ( is_single() && ! is_attachment() ) {

            if ( 'product' == get_post_type() ) {

                echo $prepend;

                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = $terms[0];
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );

                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );

                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a>' . $after . $delimiter;
                        }
                    }

                    echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a>' . $after . $delimiter;

                }

                echo $before . get_the_title() . $after;

            } elseif ( 'post' != get_post_type() ) {

                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;
                    echo $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
                echo $before . get_the_title() . $after;

            } else {

                $cat = current( get_the_category() );
                if ( ( $parents = get_category_parents( $cat, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
                    echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $delimiter . $before) ) . $after . $delimiter;
                }
                echo $before . get_the_title() . $after;

            }

        } elseif ( is_404() ) {

            echo $before . __( 'Error 404', 'woocommerce' ) . $after;

        } elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) {

            $post_type = get_post_type_object( get_post_type() );

            if ( $post_type ) {
                echo $before . $post_type->labels->singular_name . $after;
            }

        } elseif ( is_attachment() ) {

            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID );
            $cat = $cat[0];
            if ( ( $parents = get_category_parents( $cat, TRUE, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {
                echo $before . substr( $parents, 0, strlen($parents) - strlen($after . $delimiter . $before) ) . $after . $delimiter;
            }
            echo $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after . $delimiter;
            echo $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {

            echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );

            foreach ( $breadcrumbs as $crumb ) {
                echo $before . $crumb . $after . $delimiter;
            }

            echo $before . get_the_title() . $after;

        } elseif ( is_search() ) {

            echo $before . sprintf( __( 'Search results for &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() ) . $after;

        } elseif ( is_tag() ) {

                echo $before . sprintf( __( 'Posts tagged &ldquo;%s&rdquo;', 'woocommerce' ), single_tag_title( '', false ) ) . $after;

        } elseif ( is_author() ) {

            $userdata = get_userdata($author);
            echo $before . sprintf( __( 'Author: %s', 'woocommerce' ), $userdata->display_name ) . $after;

        }

        if ( get_query_var( 'paged' ) ) {
            echo ' (' . sprintf( __( 'Page %d', 'woocommerce' ), get_query_var( 'paged' ) ) . ')';
        }

        echo '</ul>';
    } else {
        if ( is_home() && !is_front_page() ) {
            echo '<ul>';

            if ( ! empty( $home ) ) {
                echo $before . '<a class="home" href="' . apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) . '">' . $home . '</a>' . $after . $delimiter;

                echo $before . __($venedor_settings['blog-title']) . $after;
            }

            echo '</ul>';
        }
    }
}
endif;

// Woocommerce Hooks
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Woocommerce Functions
add_action('woocommerce_before_shop_loop', 'venedor_woocommerce_catalog_ordering', 30);
function venedor_woocommerce_catalog_ordering() {
    global $venedor_settings;

    parse_str($_SERVER['QUERY_STRING'], $params);

    $query_string = '?'.$_SERVER['QUERY_STRING'];

    // replace it with theme option
    if ($venedor_settings['category-item']) {
        $per_page = explode(',', $venedor_settings['category-item']);
    } else {
        $per_page = explode(',', '9,15,30');
    }

    $orderby = strtolower( !empty($params['orderby']) ? $params['orderby'] : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) ) );

    if ($orderby == 'menu_order title' || $orderby == 'menu_order') $orderby = 'default';
    if ($orderby == 'title') $orderby = 'name';

    $order = strtoupper( !empty($params['order']) ? $params['order'] : ($orderby == 'rating' || $orderby == 'price-desc' || $orderby == 'popularity' ? 'DESC' : 'ASC') );

    if ($orderby == 'price-desc') $orderby = 'price';

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];
    ?>
    <div class="toolbar clearfix">
        <div class="sorter clearfix">
            <div class="sort-by">
                <?php // sort by ?>
                <label class="left"><?php echo __('Sort By', 'venedor') ?>: </label>
                <div class="dropdown left dropdown-select">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false" title="<?php echo __('Sort By', 'venedor') ?>">
                        <?php echo __(ucfirst($orderby), 'venedor'); ?>
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if ($orderby != 'default') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'menu_order') ?>"><?php echo __('Default', 'venedor') ?></a></li>
                        <?php endif; ?>
                        <?php if ($orderby != 'popularity') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'popularity') ?>"><?php echo __('Popularity', 'venedor') ?></a></li>
                        <?php endif; ?>
                        <?php if ($orderby != 'rating' && get_option( 'woocommerce_enable_review_rating' ) != 'no') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'rating') ?>"><?php echo __('Rating', 'venedor') ?></a></li>
                        <?php endif; ?>
                        <?php if ($orderby != 'date') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'date') ?>"><?php echo __('Date', 'venedor') ?></a></li>
                        <?php endif; ?>
                        <?php if ($orderby != 'price') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'price') ?>"><?php echo __('Price', 'venedor') ?></a></li>
                        <?php endif; ?>
                        <?php if ($orderby != 'name') : ?>
                            <li><a tabindex="-1" href="<?php echo venedor_add_url_parameters($query_string, 'orderby', 'title') ?>"><?php echo __('Name', 'venedor') ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php // order ?>
                <?php if($order == 'DESC'): ?>
                    <a class="btn-arrow order-desc" href="<?php echo is_front_page() ? venedor_add_url_parameters( venedor_add_url_parameters($query_string, 'order', 'asc'), 'post_type', 'product') : venedor_add_url_parameters($query_string, 'order', 'asc') ?>"></a>
                <?php else: ?>
                    <a class="btn-arrow order-asc left" href="<?php echo is_front_page() ? venedor_add_url_parameters( venedor_add_url_parameters($query_string, 'order', 'desc'), 'post_type', 'product') : venedor_add_url_parameters($query_string, 'order', 'desc') ?>"></a>
                <?php endif; ?>
            </div>

            <div class="view-mode gridlist-toggle" data-view="<?php echo esc_attr($venedor_settings['category-view']) ?>">
                <a href="#" id="grid" title="<?php echo __('Grid View', 'venedor') ?>"<?php echo $venedor_settings['category-view'] == 'grid' ? ' class="active"' : '' ?>></a><a href="#" id="list" title="<?php echo __('List View', 'venedor') ?>"<?php echo $venedor_settings['category-view'] == 'list' ? ' class="active"' : '' ?>></a>
            </div>
        </div>

        <?php // pager ?>
        <?php woocommerce_pagination(); ?>
    </div>
    <?php
}

// woocommerce ordering args

add_action( 'wp', 'venedor_remove_ordering_args' );

function venedor_remove_ordering_args() {
    remove_filter( 'posts_clauses', 'venedor_order_by_popularity_post_clauses' );
    remove_filter( 'posts_clauses', 'venedor_order_by_rating_post_clauses' );
}

add_action('woocommerce_get_catalog_ordering_args', 'venedor_woocommerce_get_catalog_ordering_args', 20);
function venedor_woocommerce_get_catalog_ordering_args($args) {

    parse_str($_SERVER['QUERY_STRING'], $params);

    $orderby = strtolower( !empty($params['orderby']) ? $params['orderby'] : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) ) );

    $order = strtoupper( !empty($params['order']) ? $params['order'] : ($orderby == 'rating' || $orderby == 'price-desc' || $orderby == 'popularity' ? 'DESC' : 'ASC') );

    switch ($orderby) {
        case 'popularity' :
            // Sorting handled later though a hook
            add_filter( 'posts_clauses', 'venedor_order_by_popularity_post_clauses' );
            break;
        case 'rating' :
            // Sorting handled later though a hook
            add_filter( 'posts_clauses', 'venedor_order_by_rating_post_clauses' );
            break;
    }

    $args['order'] = $order;

    return $args;
}

// Sorting handled later though a hook
function venedor_order_by_popularity_post_clauses( $args ) {
    global $wpdb;

    parse_str($_SERVER['QUERY_STRING'], $params);
    $order = strtoupper( !empty($params['order']) ? $params['order'] : 'DESC' );
    $args['orderby'] = "$wpdb->postmeta.meta_value+0 $order, $wpdb->posts.post_date DESC";

    return $args;
}

// Sorting handled later though a hook
function venedor_order_by_rating_post_clauses( $args ) {
    global $wpdb;

    parse_str($_SERVER['QUERY_STRING'], $params);
    $order = strtoupper( !empty($params['order']) ? $params['order'] : 'DESC' );
    $args['orderby'] = "average_rating $order, $wpdb->posts.post_date DESC";

    return $args;
}

// get product count per page
add_filter('loop_shop_per_page', 'venedor_loop_shop_per_page');
function venedor_loop_shop_per_page() {
    global $venedor_settings;

    parse_str($_SERVER['QUERY_STRING'], $params);

    // replace it with theme option
    if ($venedor_settings['category-item']) {
        $per_page = explode(',', $venedor_settings['category-item']);
    } else {
        $per_page = explode(',', '9,15,30');
    }

    $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];

    return $item_count;
}

// Get Product Thumbnail
add_action('woocommerce_before_shop_loop_item_title', 'venedor_woocommerce_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function venedor_woocommerce_thumbnail() {
    global $product, $woocommerce, $venedor_settings;

    $id = get_the_ID();
    $size = 'shop_catalog';

    $gallery = get_post_meta($id, '_product_image_gallery', true);
    $attachment_image = '';
    if ($venedor_settings['category-image-effect'] && !empty($gallery)) {
        $gallery = explode(',', $gallery);
        $first_image_id = $gallery[0];
        $attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image'));
    }
    $thumb_image = get_the_post_thumbnail($id , $size);
    $class="product-image";
    if (!$thumb_image) {
        if ( wc_placeholder_img_src() )
            $thumb_image = wc_placeholder_img( $size );
    }
    if (!$attachment_image || !$venedor_settings['category-image-effect'])
        $class="product-image no-image";
    echo '<span class="'.$class.'">';
    // show images
    echo $attachment_image;
    echo $thumb_image;
    // show hot/sale label
    woocommerce_show_product_loop_sale_flash();
    
// show price
    if ($venedor_settings['product-price']) {
        if ($product->get_price() != '') {
            $variable_class = '';
            if ($product->is_type( array( 'variable' ) ) && $product->get_variation_price( 'min' ) !== $product->get_variation_price( 'max' ))
                $variable_class = ' price-variable';
            if ($product->is_type( array( 'grouped' ) )) {
                $child_prices = array();
                foreach ( $product->get_children() as $child_id )
                    $child_prices[] = get_post_meta( $child_id, '_price', true );
                $child_prices = array_unique( $child_prices );
                if ( ! empty( $child_prices ) ) $variable_class = ' price-variable';
            }
            echo '<div class="price-box '. $venedor_settings['product-price-pos'] . $variable_class . '">';
            woocommerce_template_loop_price();
            echo '</div>';
        }
    }
    // show quick view
    if ($venedor_settings['category-quickview']) : ?>
        <div class="figcaption<?php if (!$venedor_settings['category-hover']) echo ' no-hover' ?>">
            <span class="btn btn-arrow quickview-button <?php echo $venedor_settings['category-quickview-pos'] ?>" data-id="<?php echo the_ID() ?>"><span class="fa fa-search"></span></span>
        </div>
    <?php endif;

    echo '</span>';
}

function venedor_woocommerce_image() {
    global $product, $woocommerce, $venedor_settings;

    $id = get_the_ID();
    $size = 'shop_single';

    if ( has_post_thumbnail() ) {
        $image = get_the_post_thumbnail( $id, apply_filters( 'single_product_small_thumbnail_size', $size ) );
    } else {
        $gallery = get_post_meta($id, '_product_image_gallery', true);
        $attachment_image = '';
        if (!empty($gallery)) {
            $gallery = explode(',', $gallery);
            $first_image_id = $gallery[0];
            $image = wp_get_attachment_image($first_image_id , $size, false, array('class' => ''));
        }
    }

    if (!$image)
        $image = wc_placeholder_img_src();

    $class="product-image";

    echo '<span class="'.$class.'">';

    // show images, sale label
    echo $image; venedor_woocommerce_sale();

    echo '</span>';
}

// Add woocommerce actions
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5 );
add_action('woocommerce_shop_loop_item_title', 'venedor_woocommerce_shop_loop_item_title_open', 1);
add_action('woocommerce_shop_loop_item_title', 'venedor_woocommerce_shop_loop_item_title_close', 100);

// Remove woocommerce actions
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);

function venedor_woocommerce_shop_loop_item_title_open() {
    ?><a class="product-loop-title" href="<?php the_permalink(); ?>"><?php
}

function venedor_woocommerce_shop_loop_item_title_close() {
    ?></a><?php
}

if (isset($venedor_settings['product-price']) && $venedor_settings['product-price']) { // if show price on image
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
}

// Remove compare action
if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ) {
    global $yith_woocompare;
    if ($yith_woocompare)
        remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
}

if ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' ) {
    global $yith_woocompare;
    if ($yith_woocompare)
        remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
}

// add rating stars in product page
add_action( 'woocommerce_single_product_summary', 'venedor_single_product_rating', 5 );
function venedor_single_product_rating() {
    global $product, $venedor_woo_version;

    if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
        return;

    $rating = $product->get_average_rating();
    $rating_html = $product->get_rating_html();
    $rating_count = $product->get_rating_count();
    $review_count = version_compare($venedor_woo_version, '2.3', '<') ? $product->get_rating_count() : $product->get_review_count();
    $count = 0;
    if ( $rating_html = $product->get_rating_html() ) : ?>
    <div class="ratings" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <meta content="<?php echo $rating; ?>" itemprop="ratingValue" />
        <meta content="<?php echo $rating_count; ?>" itemprop="ratingCount" />
        <meta content="<?php echo $review_count; ?>" itemprop="reviewCount" />
        <meta content="5" itemprop="bestRating" />
        <span class="star" data-value="<?php echo $rating ?>" data-toggle="tooltip" data-title="<?php echo $rating ?>">
            <?php
            for ($i = 0; $i < (int)$rating; $i++) {
                $count++;
                echo '<i class="fa fa-star"></i>';
            }
            if ($rating - (int)$rating >= 0.5) {
                $count++;
                echo '<i class="fa fa-star-half-full"></i>';
            }
            for ($i = $count; $i < 5; $i++) {
                $count++;
                echo '<i class="fa fa-star-o"></i>';
            } ?>
        </span>
        <span class="amount">
            <?php //echo $rating_html; ?>
            <?php
            global $venedor_quickview;
            if (!isset($venedor_quickview)) : ?>
                <a href="#reviews" id="goto-reviews"><?php echo $review_count . ' ' . __('Reviews', 'venedor'); ?></a><span class="gap">|</span><a href="#review-form" id="goto-review-form"><?php echo __('Add Your Review', 'venedor') ?></a>
            <?php else : ?>
                <?php echo $review_count . ' ' . __('Reviews', 'venedor'); ?>
            <?php endif; ?>
        </span>
    </div>
    <?php endif;
}

// get ajax cart fragment
add_filter('add_to_cart_fragments', 'venedor_woocommerce_header_add_to_cart_fragment');
function venedor_woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    $_cartQty = WC()->cart->cart_contents_count;

    $fragments['.header-wrapper .cart-head .cart-items, .sticky-header .cart-head .cart-items'] = '<span class="cart-items">'. ($_cartQty > 0 ? $_cartQty : '0') .' '. __('item(s)', 'venedor') .'</span>';
    $fragments['.header-wrapper .cart-head .mobile-hide, .sticky-header .cart-head .mobile-hide'] = '<span class="mobile-hide"> - '. WC()->cart->get_cart_total() . '</span>';

    ob_start();
    ?>
    <div class="block-content cart-content">
        <?php
        if ($_cartQty == 0) {
            echo __('No products in the cart.','woocommerce');
        } else { ?>
            <div class="cart_list_wrap scrollbar-rail">
                <ul class="cart_list product_list_widget">
                    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                ?>
                                <li>

                                    <?php if ( ! $_product->is_visible() ) { ?>
                                        <div class="product-image">
                                            <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                        </div>
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="product-image">
                                            <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
                                        </a>
                                    <?php } ?>

                                    <div class="product-details">

                                        <?php if ( ! $_product->is_visible() ) : ?>
                                            <div class="product-name">
                                                <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                            </div>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="product-name">
                                                <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                            </a>
                                        <?php endif; ?>

                                        <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

                                    </div>

                                    <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-product" title="%s" data-cart_id="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce'), $cart_item_key ), $cart_item_key ); ?>
                                    <div class="ajax-loading"></div>

                                </li>
                            <?php
                            }
                        }
                        ?>

                    <?php else : ?>

                        <li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

                    <?php endif; ?>
                </ul>
            </div>
            <div class="minicart-actions clearfix">
                <div class="total">
                    <span class="total-label"><?php echo __('Subtotal', 'woocommerce') ?>: </span>
                    <span class="amount"><?php echo WC()->cart->get_cart_total(); ?></span>
                </div>
                <div class="buttons">
                    <a class="button btn-special cart-link" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('Cart', 'woocommerce'); ?></a>
                    <a class="button checkout-link" href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'woocommerce'); ?></a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    $fragments['.header-wrapper .cart-content, .sticky-header .cart-content'] = ob_get_clean();

    return $fragments;
}

// change address field labels
add_filter('woocommerce_get_country_locale', 'venedor_get_country_locale', 10, 1);
add_filter('woocommerce_default_address_fields', 'venedor_default_address_fields', 10, 1);
add_filter('woocommerce_billing_fields', 'venedor_default_address_fields', 10, 1);
add_filter('woocommerce_shipping_fields', 'venedor_default_address_fields', 10, 1);
add_filter('woocommerce_checkout_fields', 'venedor_default_checkout_fields', 10, 1);

function venedor_get_country_locale($fields) {
    $new_fields = array();

    foreach ($fields as $key => $field) {

        $new_fields1 = array();

        foreach ($field as $key1 => $field1) {
            $icon = '';
            switch ($key1) {
                case 'country': $icon = '<span class="fa fa-globe"></span>'; break;
                case 'first_name':
                case 'last_name': $icon = '<span class="fa fa-user"></span>'; break;
                case 'company': $icon = '<span class="fa fa-briefcase"></span>'; break;
                case 'address_1':
                case 'address_2': $icon = '<span class="fa fa-map-marker"></span>'; break;
                case 'city': $icon = '<span class="fa fa-building-o"></span>'; break;
                case 'state': $icon = '<span class="fa fa-flag"></span>'; break;
                case 'postcode': $icon = '<span class="fa fa-truck"></span>'; break;
                case 'billing_email': $icon = '<span class="fa fa-envelope"></span>'; break;
                case 'billing_phone': $icon = '<span class="fa fa-phone"></span>'; break;
            }
            if (isset($field1['label']) && $field1['label'])
                $field1['label'] = $icon . $field1['label'];
            $new_fields1[$key1] = $field1;
        }

        $new_fields[$key] = $new_fields1;
    }

    return $new_fields;
}

function venedor_default_address_fields($fields) {

    $new_fields = array();

    foreach ($fields as $key => $field) {
        if ($key == 'address_1')
            $field['label'] = __( 'Address', 'woocommerce' ) . ' 1';
        if ($key == 'address_2')
            $field['label'] = __( 'Address', 'woocommerce' ) . ' 2';

        if (!isset($field['filtered'])) {
            $icon = '';
            switch ($key) {
                case 'country': $icon = '<span class="fa fa-globe"></span>'; break;
                case 'first_name':
                case 'last_name': $icon = '<span class="fa fa-user"></span>'; break;
                case 'company': $icon = '<span class="fa fa-briefcase"></span>'; break;
                case 'address_1':
                case 'address_2': $icon = '<span class="fa fa-map-marker"></span>'; break;
                case 'city': $icon = '<span class="fa fa-building-o"></span>'; break;
                case 'state': $icon = '<span class="fa fa-flag"></span>'; break;
                case 'postcode': $icon = '<span class="fa fa-truck"></span>'; break;
                case 'billing_email': $icon = '<span class="fa fa-envelope"></span>'; break;
                case 'billing_phone': $icon = '<span class="fa fa-phone"></span>'; break;
                case 'order_comments': $icon = '<span class="fa fa-phone"></span>'; break;
            }
            if (isset($field['type']) && $field['type'] == 'textarea') $field['class'][] = 'textarea-field';
            else $field['class'][] = ' input-field';
            if (isset($field['label']) && $field['label']) $field['label'] = $icon . $field['label'];
            $field['filtered'] = true;
        }

        $new_fields[$key] = $field;
    }

    return $new_fields;
}

function venedor_default_checkout_fields($fields) {
    if (isset($fields['account']) && isset($fields['account']['account_username']) && $fields['account']['account_username']) {
        $fields['account']['account_username'] = array(
            'type'             => 'text',
            'label'         => '<span class="fa fa-user"></span>'.__( 'Username', 'woocommerce' ),
            'placeholder'     => _x( 'Username', 'placeholder', 'woocommerce' )
        );
    }
    if (isset($fields['account']) && isset($fields['account']['account_password']) && $fields['account']['account_password']) {
        $fields['account']['account_password'] = array(
            'type'                 => 'password',
            'label'             => '<span class="fa fa-lock"></span>'.__( 'Password', 'woocommerce' ),
            'placeholder'         => _x( 'Password', 'placeholder', 'woocommerce' ),
            'class'             => array( 'form-row-first' )
        );
    }
    if (isset($fields['account']) && isset($fields['account']['account_password-2']) && $fields['account']['account_password-2']) {
        $fields['account']['account_password-2'] = array(
            'type'                 => 'password',
            'label'             => '<span class="fa fa-lock"></span>'.__( 'Confirm password', 'venedor' ),
            'placeholder'         => _x( 'Confirm password', 'placeholder', 'venedor' ),
            'class'             => array( 'form-row-last' )
        );
    }
    $fields['order']    = array(
        'order_comments' => array(
            'type' => 'textarea',
            'class' => array('notes'),
            'label' => '<span class="fa fa-edit"></span>'.__( 'Order Notes', 'woocommerce' ),
            'placeholder' => _x('Notes about your order, e.g. special notes for delivery.', 'placeholder', 'woocommerce')
            )
        );

    return $fields;
}

// remove related products
if (isset($venedor_settings['product-related']) && !$venedor_settings['product-related']) :
function venedor_remove_related_products( $args ) {
    return array();
}
    add_filter('woocommerce_related_products_args', 'venedor_remove_related_products', 10);
endif;

add_action('wp_head', 'venedor_wp_head');
if (defined( 'YITH_WCWL' )) {
    update_option( 'yith_wcwl_rounded_corners', 'No' );
    update_option( 'yith_wcwl_button_position', 'shortcode' );
}

add_action('wp_head', 'venedor_wp_head');

function venedor_wp_head() {

}

// get wishlist & compare in single product page
add_action( 'woocommerce_single_product_summary', 'venedor_single_product_links', 35 );
function venedor_single_product_links() {
    global $venedor_settings;

    $wishlist = (defined( 'YITH_WCWL' ) && $venedor_settings['product-wishlist']);
    $compare = (class_exists( 'YITH_Woocompare_Frontend' ) && $venedor_settings['product-compare']);
    $addthis_options = get_option('addthis_settings');

    if ( $wishlist || $compare || (defined('ADDTHIS_INIT') && $venedor_settings['product-addthis'])) : ?>
        <div class="add-links<?php if ( $wishlist && $compare ) echo ' show-all' ?>">
            <?php
            // Add Wishlist
            if ( $wishlist ) {
                echo '<div class="add-links-item">'.do_shortcode('[yith_wcwl_add_to_wishlist]').'</div>';
            }
            // Add Compare
            global $venedor_quickview;
            if ( !isset($venedor_quickview) && $compare ) {
                global $yith_woocompare;
                echo '<div class="add-links-item">';
                $yith_woocompare->obj->add_compare_link();
                echo '</div>';
            }
            ?>
            <?php if (defined('ADDTHIS_INIT') && $venedor_settings['product-addthis']) : // addthis buttons ?>
                <div class="addthis-icons clearfix">
                    <?php if (isset($addthis_options) && ((isset($addthis_options['addthis_for_wordpress']) && ($addthis_options['addthis_for_wordpress'] == true)) || (isset($addthis_options['addthis_social_widget_migrated_to']) && ($addthis_options['addthis_social_widget_migrated_to'] == 'addthis_sharing_buttons_settings')))) {
                        echo '<div data-url="'.get_permalink().'" data-title="'.get_the_title().'" class="at-above-post addthis_default_style addthis_toolbox"></div>';
                    } else {
                        if (get_the_content('')) : ?><span class="share"><?php echo __('Share', 'venedor') ?>: </span><?php endif;
                        remove_filter('addthis_above_content', 'venedor_addthis_remove', 10);
                        do_action('addthis_widget', get_permalink(), get_the_title(), 'above');
                        add_filter('addthis_above_content', 'venedor_addthis_remove', 10, 1);
                    } ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif;
}

function venedor_product_slider($product_slider) {
    $product_ids = explode(',', $product_slider);
    $product_ids = array_map('trim', $product_ids);

    $args = array(
        'post_type'    => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'    => 1,
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key'         => '_visibility',
                'value'     => array('catalog', 'visible'),
                'compare'     => 'IN'
            )
        ),
        'post__in' => $product_ids
    );

    $products = new WP_Query( $args );

    if ( $products->have_posts() ) : ?>

        <div class="product-topslider owl-carousel">

        <?php while ( $products->have_posts() ) : $products->the_post();

            if (!has_post_thumbnail()) continue; ?>

            <div class="product product-item">

                <?php venedor_woocommerce_image(); ?>
                <div class="product-details"><div class="inner">
                    <a href="<?php the_permalink() ?>">
                        <h3 class="product-name"><?php the_title() ?></h3>
                    </a>
                    <div class="price-box"><?php echo woocommerce_template_loop_price(); ?></div>
                    <div class="product-desc"><?php echo venedor_excerpt(25, false) ?></div>
                    <?php
                    global $product;
                    if ( ! $product->is_in_stock() ) : ?>

                        <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>

                    <?php else :

                    $link = array(
                        'url'   => '',
                        'label' => '',
                        'class' => ''
                    );

                    $handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

                    switch ( $handler ) {
                        case "variable" :
                            $link['url']     = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
                            $link['label']     = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
                            break;
                        case "grouped" :
                            $link['url']     = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
                            $link['label']     = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'venedor' ) );
                            break;
                        case "external" :
                            $link['url']     = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
                            $link['label']     = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
                            break;
                        default :
                            if ( $product->is_purchasable() ) {
                                $link['url']     = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
                                $link['label']     = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'woocommerce' ) );
                                $link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
                            } else {
                                $link['url']     = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
                                $link['label']     = apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
                            }
                            break;
                    }

                    echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s cart-links btn btn-lg product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

                    endif;
                ?>
                </div></div>
            </div>

        <?php endwhile; // end of the loop. ?>

        </div>

        <script type="text/javascript">
        jQuery(function($) {
            var itemsCustom;
            itemsCustom = [[0, 2], [1199, 3], [1599, 4]];

            $('.product-topslider').owlCarousel({
                itemsCustom: itemsCustom,
                navigation: true,
                navigationText: ["", ""],
                pagination: false,
                slideSpeed: 300
            });
            $('.product-topslider .product-item').hover(function() {
                $(this).addClass('hover');
                $inner = $(this).find('.product-details .inner');
                $inner.css({
                    'height': 'auto',
                    'top':  'auto',
                    'bottom':  'auto'
                });
                h = $inner.innerHeight();
                $inner.css({
                    'height': h,
                    'top':  '5%',
                    'bottom':  '5%'
                });
            }, function() {
                $(this).removeClass('hover');
            });
        });
        </script>

    <?php endif;
    wp_reset_postdata();
}

function venedor_featured_products_slider() {

    $args = array(
        'post_status' => 'publish',
        'post_type' => 'product',
        'ignore_sticky_posts'   => 1,
        'meta_key' => '_featured',
        'meta_value' => 'yes',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'desc',
        'product_cat' => get_query_var('product_cat'),
    );

    $products = new WP_Query( $args );

    global $venedor_product_slider;

    if ( $products->have_posts() ) : ?>

        <div class="product-featured-slider owl-carousel">

            <?php while ( $products->have_posts() ) : $products->the_post();

                if (!has_post_thumbnail()) continue; ?>

                <div class="container product-item product"><div class="row">

                    <div class="col-sm-5">
                    <?php venedor_woocommerce_image(); ?>
                    </div>

                    <div class="col-sm-7 product-details"><div class="inner">
                        <a href="<?php the_permalink() ?>">
                            <h3 class="product-name"><?php the_title() ?></h3>
                        </a>
                        <div class="price-box"><?php echo woocommerce_template_loop_price(); ?></div>
                        <div class="product-desc"><?php echo venedor_excerpt(50, false) ?></div>
                        <?php
                        global $product;
                        if ( ! $product->is_in_stock() ) : ?>

                            <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>

                        <?php else :

                        $link = array(
                            'url'   => '',
                            'label' => '',
                            'class' => ''
                        );

                        $handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

                        switch ( $handler ) {
                            case "variable" :
                                $link['url']     = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
                                $link['label']     = apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
                                break;
                            case "grouped" :
                                $link['url']     = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
                                $link['label']     = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'venedor' ) );
                                break;
                            case "external" :
                                $link['url']     = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
                                $link['label']     = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
                                break;
                            default :
                                if ( $product->is_purchasable() ) {
                                    $link['url']     = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
                                    $link['label']     = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'woocommerce' ) );
                                    $link['class']  = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
                                } else {
                                    $link['url']     = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
                                    $link['label']     = apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
                                }
                                break;
                        }

                        echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s cart-links btn btn-lg product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

                        endif;
                    ?>
                    </div></div>
                </div></div>

            <?php endwhile; // end of the loop. ?>

            </div>

            <script type="text/javascript">
            jQuery(function($) {
                var itemsCustom;

                $('.product-featured-slider').owlCarousel({
                    singleItem: true,
                    navigation: false,
                    pagination: false,
                    transitionStyle : "fade",
                    slideSpeed: 300
                });
                $('.product-featured-slider .product-image').addClass('effect2');
                $('.product-featured-slider .product-image').append('<div class="btn btn-arrow prev"></div><div class="btn btn-arrow next"></div>');
                $('.product-featured-slider .product-image .next').click(function() {
                    $('.product-featured-slider').data('owl-carousel').next();
                });
                $('.product-featured-slider .product-image .prev').click(function() {
                    $('.product-featured-slider').data('owl-carousel').prev();
                });
            });
            </script>

        </div>

    <?php endif;
    wp_reset_postdata();
}

function venedor_woocommerce_category_banner($banner_class) {
    global $wp_query, $venedor_settings;

    if (isset($venedor_settings['category-banner']) && !$venedor_settings['category-banner'])
        return;

    $cat = $wp_query->get_queried_object();
    $thumb_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
    $thumb_image = '';
    if ($thumb_id) :
        $thumb_image = wp_get_attachment_url( $thumb_id );

        $limit = 40;
        $description = term_description();
        $short_desc = strip_tags($description);
        $short_desc = explode(' ', $short_desc, $limit);
        $more_link = false;

        if (count($short_desc) >= $limit) {
            array_pop($short_desc);
            $short_desc = implode(" ", $short_desc).'...';
            $more_link = true;
        } else {
            $short_desc = implode(" ", $short_desc);
        }
        ?>
        <div class="banner-container">
            <div id="banner-wrapper" class="category-banner<?php echo $banner_class ?>">
                <div class="container"><div class="row">
                    <?php if ($thumb_image) : ?>
                    <div class="col-sm-5">
                        <img src="<?php echo $thumb_image ?>" class="img-responsive category-thumb<?php echo (!$more_link)?' nolink':'' ?><?php echo (!$short_desc)?' nodesc':'' ?>" />
                    </div>
                    <?php endif; ?>
                    <div class="col-sm-<?php echo ($thumb_image)?'7':'12' ?>">
                        <div class="category-details<?php echo (!$thumb_image)?' noimage':'' ?>">


                            <h1 class="<?php echo (!$more_link)?' nolink':'' ?><?php echo (!$short_desc)?' nodesc':'' ?><?php echo (!$thumb_image)?' noimage':'' ?>"><?php woocommerce_page_title(); ?></h1>


                            <?php if ( $short_desc ) : ?>
                            <div class="term-shortdesc"><?php echo $short_desc ?></div>
                            <?php endif; ?>

                            <?php if ($more_link) : ?>
                                <a class="fancybox btn btn-lg more-links" href="#term-description"><?php _e('Learn More', 'venedor') ?></a>
                                <div id="term-description" class="term-description">

                                    <h2 class="entry-title"><?php woocommerce_page_title(); ?></h2>

                                    <?php echo $description ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div></div>
            </div>
        </div>
    <?php
    endif;
}

function venedor_bg_slider() {
    $bg_rev_slider = venedor_meta_bg_slider();

    if ($bg_rev_slider) : ?>
    <div id="bg-slider">
        <?php echo do_shortcode('[rev_slider '.$bg_rev_slider.']'); ?>
    </div>
    <?php endif;
}

function venedor_banner($banner_class = '') {
    $banner_type = venedor_meta_banner_type();
    $banner_width = venedor_meta_banner_width();
    $layer_slider = venedor_meta_layer_slider();
    $rev_slider = venedor_meta_rev_slider();
    $banner = venedor_meta_banner();
    $product_slider = venedor_meta_product_slider();

    if ($banner_type === 'layer_slider' && isset($layer_slider)) { ?>

        <?php if($banner_width != 'wide') : ?><div class="container"><?php endif; ?>
            <div class="banner-container">
                <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                    <?php echo do_shortcode('[layerslider id="'.$layer_slider.'"]'); ?>
                </div>
        </div>
        <?php if($banner_width != 'wide') : ?></div><?php endif; ?>

    <?php } else if ($banner_type === 'rev_slider' && isset($rev_slider)) { ?>

        <?php if($banner_width != 'wide') : ?><div class="container"><?php endif; ?>
            <div class="banner-container">
                <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                    <?php echo do_shortcode('[rev_slider '.$rev_slider.']'); ?>
                </div>
            </div>
        <?php if($banner_width != 'wide') : ?></div><?php endif; ?>

    <?php } else if ($banner_type === 'banner' && isset($banner)) { ?>

        <?php if($banner_width != 'wide') : ?><div class="container"><?php endif; ?>
            <div class="banner-container">
                <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                    <?php echo do_shortcode($banner); ?>
                </div>
            </div>
        <?php if($banner_width != 'wide') : ?></div><?php endif; ?>

    <?php } else if ( class_exists('WooCommerce') && $banner_type === 'product_slider' && isset($product_slider)) { ?>

        <div class="banner-container">
            <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                <?php venedor_product_slider($product_slider); ?>
            </div>
        </div>

    <?php } else if ( class_exists('WooCommerce') ) {

        if ($banner_type === 'featured_products') { // use in woocommerce category page ?>
            <?php if($banner_width != 'wide') : ?><div class="container"><?php endif; ?>
                <div class="banner-container">
                    <div id="banner-wrapper" class="<?php echo $banner_class ?>">
                        <?php venedor_featured_products_slider(); ?>
                    </div>
                </div>
            <?php if($banner_width != 'wide') : ?></div><?php endif; ?>
         <?php } else { // use in woocommerce category page
            // verify that this is a product category page
            if ($banner_type !== 'hide_banner' && is_product_category()) {
                venedor_woocommerce_category_banner($banner_class);
            }
        }
    }
}

function venedor_html_switcher() {
    global $venedor_settings;

    ob_start();
    if ( has_nav_menu( 'view_switcher' ) ) : ?>
        <div class="view-switcher<?php if ($venedor_settings['switcher-pos'] == 'middle') echo ' middle' ?>"><!-- view switcher -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'view_switcher',
                'container' => '',
                'menu_class' => 'bt-links',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'depth' => 2,
                'fallback_cb' => false,
                'walker' => new wp_bootstrap_navwalker
            ));
            ?>
        </div><!-- end view switcher -->
    <?php endif; ?>
    <?php if ( $venedor_settings['wpml-switcher'] ) : ?>
        <div class="view-switcher<?php if ($venedor_settings['switcher-pos'] == 'middle') echo ' middle' ?>"><!-- view switcher -->
            <?php do_action('icl_language_selector'); ?>
        </div>
    <?php endif;

    return str_replace('&nbsp;', '', ob_get_clean());
}

function venedor_html_topnav() {

    ob_start(); ?>
    <!-- top navigation -->
    <?php
    if ( has_nav_menu( 'top_nav' ) ) : ?>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'top_nav',
            'menu_class' => 'topnav bt-links',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'depth' => 2,
            'fallback_cb' => false,
            'walker' => new wp_bootstrap_navwalker
        ));
        ?>
    <?php else: ?>
        <?php _e('Define your top navigation in <b>Apperance > Menus</b>', 'venedor') ?>
    <?php endif; ?>
    <!-- end top navigation -->
    <?php
    return ob_get_clean();
}

function venedor_html_menu() {
    global $venedor_settings;

    $menu_align = $venedor_settings['menu-align'];

    ob_start(); ?>
    <!-- main menu -->
    <div id="main-menu" class="mega-menu<?php if ($menu_align == 'right') echo ' menu-right' ?>">
    <?php
    if ( has_nav_menu( 'main_menu' ) ) :
            wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'container' => '',
                'menu_class' => '',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'fallback_cb' => false,
                'walker' => new venedor_top_navwalker
            ));
    else: ?>
        <?php _e('Define "Main Menu" in <b>Apperance > Menus</b>', 'venedor') ?>
    <?php endif; ?>
        </div><!-- end main menu -->
    <?php
    return ob_get_clean();
}

function venedor_html_mobilemenu() {

    ob_start(); ?>
    <!-- mobile menu -->
    <div id="main-mobile-menu">
    <?php
    if ( has_nav_menu( 'main_menu' ) ) : ?>
        <div id="main-mobile-toggle" class="mobile-menu-toggle">
            <span><?php echo __('Menu', 'venedor') ?></span>
            <span class="btn btn-inverse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span>
        </div>
        <div class="accordion-menu"><?php
            wp_nav_menu(array(
                'theme_location' => 'main_menu',
                'container' => '',
                'menu_class' => '',
                'before' => '',
                'after' => '',
                'link_before' => '',
                'link_after' => '',
                'fallback_cb' => false,
                'walker' => new venedor_accordion_navwalker
            ));
            ?>
        </div>
    <?php else: ?>
        <?php _e('Define "Main Menu" in <b>Apperance > Menus</b>', 'venedor') ?>
    <?php endif; ?>
    </div>
    <!-- end mobile menu -->
    <?php
    return ob_get_clean();
}

function venedor_html_minicart() {
    global $woocommerce, $venedor_settings;

    ob_start();
    if ( class_exists('WooCommerce') ) :
        $_cartQty = $woocommerce->cart->cart_contents_count;
        ?>
        <!-- Show mini cart if Woocommerce is activated -->
        <div id="mini-cart" class="mini-cart dropdown<?php if ($venedor_settings['minicart-pos'] == 'middle') echo ' middle' ?>">
            <div class="dropdown-toggle cart-head<?php if ($venedor_settings['show-minicart-icon']) echo ' only-icon' ?><?php if ($venedor_settings['show-sticky-minicart-icon']) echo ' sticky-only-icon' ?>" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">
                <span class="cart-icon">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </span><span class="cart-details">
                    <span class="cart-items"><?php echo ($_cartQty > 0) ? $_cartQty : '0' ?> <?php _e('item(s)', 'venedor') ?></span>
                    <span class="mobile-hide"> - <?php echo WC()->cart->get_cart_total(); ?></span>
                </span>
            </div>
            <div class="dropdown-menu">
                <div class="block-content cart-content">
                    <?php
                    if ($_cartQty == 0) :
                        echo __('No products in the cart.','woocommerce');
                    else : ?>
                        <div class="cart_list_wrap scrollbar-rail">
                            <ul class="cart_list product_list_widget">
                                <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                                    <?php
                                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                            $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                            $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                            $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            ?>
                                            <li>

                                                <?php if ( ! $_product->is_visible() ) { ?>
                                                    <div class="product-image">
                                                        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
                                                    </div>
                                                <?php } else { ?>
                                                    <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="product-image">
                                                        <?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
                                                    </a>
                                                <?php } ?>

                                                <div class="product-details">

                                                    <?php if ( ! $_product->is_visible() ) : ?>
                                                        <div class="product-name">
                                                            <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="product-name">
                                                            <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php echo WC()->cart->get_item_data( $cart_item ); ?>

                                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

                                                </div>

                                                <?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove-product" title="%s" data-cart_id="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce'), $cart_item_key ), $cart_item_key ); ?>
                                                <div class="ajax-loading"></div>

                                            </li>
                                        <?php
                                        }
                                    }
                                    ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="minicart-actions clearfix">
                            <div class="total">
                                <span class="total-label"><?php echo __('Subtotal', 'woocommerce') ?>: </span>
                                <span class="subtotal"><?php echo WC()->cart->get_cart_total(); ?></span>
                            </div>
                            <div class="buttons">
                                <a class="button btn-inverse cart-link" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('Cart', 'woocommerce'); ?></a>
                                <a class="button checkout-link" href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'woocommerce'); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- end mini cart -->
        <?php
    endif;

    return ob_get_clean();
}

// Quick View Html
add_action('wp_ajax_venedor_product_quickview', 'venedor_product_quickview');
add_action('wp_ajax_nopriv_venedor_product_quickview', 'venedor_product_quickview');

function array2json($arr) {
    if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
    $parts = array();
    $is_list = false;

    //Find out if the given array is a numerical array
    $keys = array_keys($arr);
    $max_length = count($arr)-1;
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true;
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
            if($i != $keys[$i]) { //A key fails at position check.
                $is_list = false; //It is an associative array.
                break;
            }
        }
    }

    foreach($arr as $key=>$value) {
        if(is_array($value)) { //Custom handling for arrays
            if($is_list) $parts[] = array2json($value); /* :RECURSION: */
            else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
        } else {
            $str = '';
            if(!$is_list) $str = '"' . $key . '":';

            //Custom handling for multiple data types
            if(is_numeric($value)) $str .= $value; //Numbers
            elseif($value === false) $str .= 'false'; //The booleans
            elseif($value === true) $str .= 'true';
            else $str .= '"' . addslashes($value) . '"'; //All other things
            // :TODO: Is there any more datatype we should be in the lookout for? (Object?)

            $parts[] = $str;
        }
    }
    $json = implode(',',$parts);

    if($is_list) return '[' . $json . ']';//Return numerical JSON
    return '{' . $json . '}';//Return associative JSON
}

function venedor_product_quickview() {

    global $post, $product, $woocommerce, $wpdb, $venedor_quickview;
    $post = get_post($_GET['pid']);
    $product = wc_get_product( $post->ID );
    $attachment_ids = $product->get_gallery_attachment_ids();

    if ( post_password_required() ) {
        echo get_the_password_form();
        die();
        return;
    }

    $venedor_quickview = true;

    $displaytypenumber = 0;
    if (function_exists('wcva_get_woo_version_number'))
        require_once wcva_plugin_path() . '/includes/wcva_common_functions.php';

    if (function_exists('wcva_return_displaytype_number'))
        $displaytypenumber = wcva_return_displaytype_number($product,$post);

    $goahead = 1;

    if(isset($_SERVER['HTTP_USER_AGENT'])){
        $agent = $_SERVER['HTTP_USER_AGENT'];
    }

    if ((preg_match('/(?i)msie [5-8]/', $agent)) || strpos($agent, 'Trident/7.0; rv:11.0') !== false) {
        $goahead = 0;
    }

    ?>

    <div class="quickview-wrap single-product">
        <div class="column2">
            <div class="product product-essential">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 summary-before">
                    <?php if (defined('ADDTHIS_INIT')) {
                        $addthis_options = get_option('addthis_settings');
                        $atversion = is_array($addthis_options) && array_key_exists('addthis_profile', $addthis_options) && $addthis_options['addthis_profile'] == 1 ? $addthis_options['addthis_profile'] : 300;
                        $pub = (isset($addthis_options['profile'])) ? $addthis_options['profile'] : false ;
                        if (!$pub) $pub = (isset($addthis_options['addthis_profile'])) ? $addthis_options['addthis_profile'] : false ;
                        if (!$pub) $pub = 'wp-'.hash_hmac('md5', get_option('home'), 'addthis');
                        $pub = urlencode($pub);
                    }
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12 summary entry-summary">
                    <?php
                        /**
                         * woocommerce_single_product_summary hook
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>
                        <script type="text/javascript">
                            <?php
                            $suffix               = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
                            $assets_path          = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
                            $frontend_script_path = $assets_path . 'js/frontend/';
                            ?>
                            var wc_add_to_cart_params = <?php echo array2json(apply_filters( 'wc_add_to_cart_params', array(
                                'ajax_url'                => WC()->ajax_url(),
                                'ajax_loader_url'         => apply_filters( 'woocommerce_ajax_loader_url', $assets_path . 'images/ajax-loader@2x.gif' ),
                                'i18n_view_cart'          => esc_attr__( 'View Cart', 'woocommerce' ),
                                'cart_url'                => get_permalink( wc_get_page_id( 'cart' ) ),
                                'is_cart'                 => is_cart(),
                                'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' )
                            ) )) ?>;
                            var wc_single_product_params = <?php echo array2json(apply_filters( 'wc_single_product_params', array(
                                'i18n_required_rating_text' => esc_attr__( 'Please select a rating', 'woocommerce' ),
                                'review_rating_required'    => get_option( 'woocommerce_review_rating_required' ),
                            ) )) ?>;
                            var woocommerce_params = <?php echo array2json(apply_filters( 'woocommerce_params', array(
                                'ajax_url'        => WC()->ajax_url(),
                                'ajax_loader_url' => apply_filters( 'woocommerce_ajax_loader_url', $assets_path . 'images/ajax-loader@2x.gif' ),
                            ) )) ?>;
                            var wc_cart_fragments_params = <?php echo array2json(apply_filters( 'wc_cart_fragments_params', array(
                                'ajax_url'      => WC()->ajax_url(),
                                'fragment_name' => apply_filters( 'woocommerce_cart_fragment_name', 'wc_fragments' )
                            ) )) ?>;
                            var wc_add_to_cart_variation_params = <?php echo array2json(apply_filters( 'wc_add_to_cart_variation_params', array(
                                'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
                                'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ),
                            ) )) ?>;
                            if (window.addthis) {
                                window.addthis = null;
                                for(var i in window) { if(i.match(/^_at/) ) { window[i]=null } }
                            }
                            jQuery(document).ready(function($) {
                                $( document ).off( 'click', '.plus, .minus');
                                $( document ).off( 'click', '.add_to_cart_button');
                                $.getScript('<?php echo $frontend_script_path . 'add-to-cart' . $suffix . '.js' ?>');
                                $.getScript('<?php echo $frontend_script_path . 'single-product' . $suffix . '.js' ?>');
                                $.getScript('<?php echo $frontend_script_path . 'woocommerce' . $suffix . '.js' ?>');
                                <?php if (($goahead == 1) && ($displaytypenumber > 0)) : ?>
                                $.getScript('<?php echo wcva_PLUGIN_URL . 'js/manage-variation-selection.js' ?>');
                                <?php else : ?>
                                $.getScript('<?php echo $frontend_script_path . 'add-to-cart-variation' . $suffix . '.js' ?>');
                                <?php endif; ?>
                                <?php if (defined('ADDTHIS_INIT')) : ?>
                                $.getScript('//s7.addthis.com/js/<?php echo $atversion ?>/addthis_widget.js?async=1&pubid=<?php echo $pub ?>', function() {
                                    addthis.init();
                                });
                                 <?php endif; ?>
                            });
                        </script>
                    </div><!-- .summary -->
                </div>
            </div>
        </div>
    </div>

    <?php

    $venedor_quickview = true;

    die();
}

// add addthis init option
$options = get_option('addthis_settings');
if ($options) {
    $options['wpfooter'] = true;
    update_option('addthis_settings', $options);
}

// ajax remove item
add_action( 'wp_ajax_venedor_product_remove', 'venedor_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_venedor_product_remove', 'venedor_ajax_product_remove' );
function venedor_ajax_product_remove() {

    $cart = WC()->instance()->cart;
    $cart_id = $_POST['cart_id'];
    $cart_item_id = $cart->find_product_in_cart($cart_id);

    if ($cart_item_id) {
        $cart->set_quantity($cart_item_id, 0);
    }

    $cart_ajax = new WC_AJAX();
    $cart_ajax->get_refreshed_fragments();

    exit();
}

function venedor_woocommerce_sale() {
    global $post, $product, $venedor_settings;

    $labels = '';
    if ($venedor_settings['product-sale']) {
        if ($product->is_on_sale()) {
            $percentage = 0;
            if ($product->regular_price)
                $percentage = - round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
            if ($venedor_settings['product-sale-percent'] && $percentage)
                $sales_html = '<span class="onsale">'. $percentage .'%</span>';
            else
                $sales_html = apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__( 'Sale', 'venedor' ).'</span>', $post, $product);

            $labels .= $sales_html;
        }
    }
    echo '<div class="labels">' . $labels . '</div>';
}

function venedor_search_form() {
    global $venedor_settings;

    if (isset($venedor_settings['search-type']) && $venedor_settings['search-type'] === 'product' && defined('YITH_WCAS')) {
        $wc_get_template = function_exists('wc_get_template') ? 'wc_get_template' : 'woocommerce_get_template';
        $wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
        return;
    }
    ?>
    <form class="searchform" action="<?php echo home_url(); ?>/" method="get">
        <fieldset>
            <span class="text"><input name="s" id="s" type="text" value="" placeholder="<?php echo __('Search here', 'venedor'); ?>" autocomplete="off" /></span>
            <span class="button-wrap"><button class="btn btn-special" title="<?php echo __('Search', 'venedor'); ?>" type="submit"><span class="fa fa-search"></span></button></span>
            <?php if (isset($venedor_settings['search-type']) && ($venedor_settings['search-type'] === 'post' || $venedor_settings['search-type'] === 'product')) : ?>
                <input type="hidden" name="post_type" value="<?php echo $venedor_settings['search-type'] ?>"/>
            <?php endif; ?>
        </fieldset>
    </form>
    <?php
}

// add sort order parameter
add_filter('woocommerce_layered_nav_link', 'venedor_layered_nav_link');
function venedor_layered_nav_link($link) {
    global $venedor_settings;

    parse_str($_SERVER['QUERY_STRING'], $params);

    if (!empty($params['orderby']))
        $link = esc_url( add_query_arg( 'orderby', $params['orderby'], $link ) );

    if (!empty($params['order']))
        $link = esc_url( add_query_arg( 'order', $params['order'], $link ) );

    if (!empty($params['count']))
        $link = esc_url( add_query_arg( 'count', $params['count'], $link ) );

    return $link;
}

if (isset($venedor_settings['category-product-desc']) && $venedor_settings['category-product-desc']) {
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5);
}

// get woocommerce version number
function venedor_get_woo_version_number() {
    // If get_plugins() isn't available, require it
    if ( ! function_exists( 'get_plugins' ) )
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    
    // Create the plugins folder and file variables
    $plugin_folder = get_plugins( '/' . 'woocommerce' );
    $plugin_file = 'woocommerce.php';
    
    // If the plugin version number is set, return it 
    if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
        return $plugin_folder[$plugin_file]['Version'];
    } else {
    // Otherwise return null
        return NULL;
    }
}

global $venedor_woo_version;
$venedor_woo_version = venedor_get_woo_version_number();

function venedor_get_taxonomies($content_type) {
    $args=array(
        'object_type' => array($content_type)
    );
    $output = 'names'; // or objects
    $operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies($args, $output, $operator);
    return $taxonomies;
}

function venedor_is_product_archive() {
    if (is_archive()) {
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
        if ($term) {
            switch ($term->taxonomy) {
                case in_array($term->taxonomy, venedor_get_taxonomies('product')):
                case 'product_cat':
                    return true;
                    break;
                default:
                    return false;
            }
        }
    }

    return false;
}

// yith woo wishlist message
add_filter('yith_wcwl_added_to_cart_message', 'venedor_yith_wcwl_added_to_cart_message');

function venedor_yith_wcwl_added_to_cart_message($message) {
    return '<div class="alert alert-success">'.$message.'</div>';
}

// woocommerce multilingual compatibility
add_filter( 'wcml_multi_currency_is_ajax', 'venedor_multi_currency_ajax' );
function venedor_multi_currency_ajax($actions){
    $actions[] = 'venedor_product_quickview';
    return $actions;
}

// fix yith woocommerce ajax navigation issue
add_filter('the_post', 'porto_woocommerce_yith_ajax_filter', 16, 2);
function porto_woocommerce_yith_ajax_filter( $posts, $query = false ) {
    if (defined( 'YITH_WCAN' )) {
        remove_filter('the_posts', array(YITH_WCAN()->frontend, 'the_posts'), 15);
    }
    return $posts;
}
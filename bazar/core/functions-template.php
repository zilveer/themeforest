<?php
/**
 * Your Inspiration Themes
 *
 * In this files there is a collection of a functions useful for the core
 * of the framework.
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if( !function_exists( 'yit_get_meta_tags' ) ) {
    /**
     * Retrieve current page keywords and description and return them.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_meta_tags() {
        global $post;

        ob_start() ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />

        <?php if ( yit_get_option( 'responsive-enabled' ) ) : ?>
            <!-- this line will appear only if the website is visited with an iPad -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />
        <?php endif ?>

        <?php
        $post_type = isset( $post->post_type ) ? $post->post_type : '';
        $post_id = yit_post_id();

        yit_og_meta_tags( $post_id );

        if( $post_id ) {
            //Keywords and description use apposite SEO option
            $keywords    = !empty( $post_type )    ? yit_get_post_meta( $post_id, '_seo-keywords' )    : '';
            $description = !empty( $post_type ) ? yit_get_post_meta( $post_id, '_seo-description' ) : '';

            $keywords    = empty( $keywords )    ? yit_get_option( $post_type . '-seo-keywords' ) : $keywords;
            $keywords    = empty( $keywords )    ? yit_get_option( 'seo-keywords' )               : $keywords;
            $description = empty( $description ) ? yit_get_option( $post_type . '-seo-description' ) : $description;
            $description = empty( $description ) ? yit_get_option( 'seo-description' )               : $description;

            if( !empty( $keywords ) ) : ?><meta name="keywords" content="<?php echo $keywords ?>" /><?php endif;
            if( !empty( $description ) ) : ?><meta name="description" content="<?php echo $description ?>" /><?php endif;
        }
        ?>

        <?php return ob_get_clean();
    }
}

if( !function_exists( 'yit_meta_tags' ) ) {
    /**
     * Retrieve current page keywords and description and print them.
     *
     * @return string
     * @see yit_get_meta_tags
     * @since 1.0.0
     */
    function yit_meta_tags() {

        echo yit_get_meta_tags();

    }
}

if( !function_exists( 'yit_og_meta_tags' ) ) {
    /**
     * Print the OpenGraph meta tags of the post.
     *
     * @param $post_id
     * @return void
     */
    function yit_og_meta_tags( $post_id ) {

        if( !function_exists('is_plugin_active') ) {
            require_once ABSPATH . "/wp-admin/includes/plugin.php";
        }

        if( !yit_get_option('enable-open-graph') || is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) return;

        ?>
        <meta property="og:site_name" content="<?php bloginfo( 'name' ) ?>"/>
        <meta property="og:title" content="<?php echo yit_get_title() ?>"/>
        <meta property="og:url" content="<?php echo get_permalink( $post_id ) ?>"/>

        <?php
        if( has_post_thumbnail( $post_id ) ) :
            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
            $image_url = $image_url[0];
            ?>
            <meta property="og:image" content="<?php echo $image_url ?>"/>
        <?php endif;

        /**
         * Create the og tag description with properly content, based on the current queried object.
         */
        $queried_object = get_queried_object();
        $ogcontent      = '';

        // For posts, pages and products
        if( isset( $queried_object->post_type ) ) {

            // Get Seo Description for first
            $_seo_description = yit_get_post_meta( $queried_object->ID, '_seo-description' );
            if ( $_seo_description ) {
                $ogcontent = $_seo_description;
            } else {
                $post      = get_post( $queried_object->ID );
                $ogcontent = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
            }
        } else if( isset( $queried_object->taxonomy ) ) {
            $ogcontent = $queried_object->description;
        }

        // Cleaning the string
        $ogcontent = preg_replace( "/&#?[a-z0-9]+;/i", "", strip_shortcodes( wp_trim_words( $ogcontent ) ) );
        $ogcontent = strip_tags( $ogcontent );
        $ogcontent = trim( str_replace( array( "\n", "\t" ), '', $ogcontent ) );

        // If the taxonomy or post don't have content, use the site description
        if( empty( $ogcontent ) ) {
            $ogcontent = get_bloginfo( 'description' );
        }

        ?><meta property="og:description" content="<?php echo $ogcontent ?>" /><?php
    }
}

if( !function_exists( 'yit_get_title' ) ) {
    /**
     * Create the title of the current page based on SEO options.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_title() {
        global $post, $page, $paged;

        if( !function_exists('is_plugin_active') ) {
            require_once ABSPATH . "/wp-admin/includes/plugin.php";
        }

        $post_type     = isset( $post->post_type ) ? $post->post_type : '';
        $post_id       = yit_post_id();
        $title         = '';
        $category_name = '';

        if( $post_id ) {

            if ( function_exists( "is_product_category" ) && is_product_category() ) {

                global $wp_query;

                $cat_obj = $wp_query->get_queried_object();

                if ( $cat_obj ) {
                    $category_name = $cat_obj->name;
                }

                if ( $paged >= 2 || $page >= 2 ) {
                    $title .= $category_name . ' | ' . sprintf( __( 'Page %s', 'yit' ), max( $paged, $page ) );
                } else {
                    $title = $category_name;
                }

                return $title .= ' | ' . get_bloginfo( 'name' );

            }


            //Title uses apposite SEO option. If it is empty, the normal title will be used.
            if( !empty( $post_type ) )
            { $title = yit_get_post_meta( $post_id, '_seo-title' ); }

            if( empty( $title ) )
            { $title = yit_get_option( $post_type . '-seo-title' ); }

            if( empty( $title ) )
            { $title = yit_get_option( 'seo-title' ); }

            if( empty( $title ) ) {
                $title = function_exists( 'wp_get_document_title' ) ? wp_get_document_title() : wp_title( '-', false, 'right' );

                if( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
                    if( !is_home() && !is_front_page() )
                    { $title .= ' | '; }

                    $title .= yit_remove_chars_title( get_bloginfo('name') );

                    // Add description, if is home
                    if ( is_home() || is_front_page() )
                    { $title .= ' | ' . yit_remove_chars_title( get_bloginfo( 'description' ) ); }
                }
            }
        } else {
            $title = function_exists( 'wp_get_document_title' ) ? wp_get_document_title() : wp_title( '-', false, 'right' );
            $title .= yit_remove_chars_title( get_bloginfo('name') );

            if( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
                // Add description, if is home
                if ( is_home() || is_front_page() )
                    $title .= ' | ' . yit_remove_chars_title( get_bloginfo( 'description' ) );
            }
        }

        // Add a page number if necessary:
        if ( $paged >= 2 || $page >= 2 )
            $title .= ' | ' . sprintf( __( 'Page %s', 'yit' ), max( $paged, $page ) );

        return apply_filters( 'yit_title', $title );
    }
}

if( !function_exists( 'yit_title' ) ) {
    /**
     * Same of yit_get_title() but print the title instead of return it.
     *
     * @return void
     * @see yit_get_title
     * @since 1.0.0
     */
    function yit_title() {
        echo yit_get_title();
    }
}

if( !function_exists( 'yit_get_favicon' ) ) {
    /**
     * Retrieve the URL of the favicon.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_favicon() {
        $url = yit_get_option( 'favicon' );

        if( empty( $url ) )
        { $url = get_template_directory_uri() . '/favicon.ico'; }

        return yit_remove_protocol_url( $url );
    }
}

if( !function_exists( 'yit_favicon' ) ) {
    /**
     * Retrieve the URL of the favicon and print it.
     *
     * @return void
     * @see yit_get_favicon
     * @since 1.0.0
     */
    function yit_favicon() {
        echo yit_get_favicon();
    }
}

if ( ! function_exists( 'yit_ie_version' ) ) {
    /**
     * Retrieve IE version.
     *
     * @return int|float
     * @since 1.0.0
     */
    function yit_ie_version() {

        if ( ! isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
            return - 1;
        }
        preg_match( '/MSIE ([0-9]+\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg );

        if ( ! isset( $reg[1] ) ) // IE 11 FIX
        {
            preg_match( '/rv:([0-9]+\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg );
            if ( ! isset( $reg[1] ) ) {
                return - 1;
            }
            else {
                return floatval( $reg[1] );
            }
        }
        else {
            return floatval( $reg[1] );
        }
    }
}

if( !function_exists( 'yit_get_attachment_id' ) ) {
    /**
     * Return the ID of an attachment.
     *
     * @param string $url
     * @return int
     * @since 1.0.0
     */
    function yit_get_attachment_id( $url ) {
        $dir = wp_upload_dir();
        $dir = trailingslashit(YIT_WPCONTENT_URL);

        if( false === strpos( $url, $dir ) )
            return false;

        $file = basename($url);

        $query = array(
            'post_type' => 'attachment',
            'fields' => 'ids',
            'meta_query' => array(
                array(
                    'value' => $file,
                    'compare' => 'LIKE',
                )
            )
        );

        $query['meta_query'][0]['key'] = '_wp_attached_file';
        $ids = get_posts( $query );

        foreach( $ids as $id ){
            $attachment_image = wp_get_attachment_image_src($id, 'full');

            $db_url = yit_strip_protocol( array_shift( $attachment_image ) );
            $url = yit_strip_protocol( $url );

            if( $url == $db_url )
                return $id;
        }

        $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
        $ids = get_posts( $query );

        foreach( $ids as $id ) {

            $meta = wp_get_attachment_metadata($id);
            if ( ! isset( $meta['sizes'] ) ) continue;

            foreach( (array) $meta['sizes'] as $size => $values ){
                $attachment_image = wp_get_attachment_image_src($id, $size);
                if( $values['file'] == $file && $url == array_shift( $attachment_image ) ) {

                    return $id;
                }
            }
        }

        return false;
    }
}

if( !function_exists( 'is_posts_page' ) ) {
    /**
     * Check if the user is in the page setted in Settings -> Reading as "Blog page"
     *
     * @return bool
     * @since 1.0.0
     */
    function is_posts_page() {
        global $wp_query;
        return $wp_query->is_posts_page;
    }
}

if( !function_exists( 'yit_get_sidebar_setting' ) ) {
    /**
     * Retrieve the sidebar settings for the current post.
     *
     * @param string $setting
     * @return string
     * @since 1.0.0
     */
    function yit_get_sidebar_setting() {
        global $post, $yit_sidebar_layout;

        global $wp_query;

        $post_id = isset( $post->ID ) ? $post->ID : 0;
        if ( is_posts_page() || is_home() ) $post_id = get_option( 'page_for_posts' );

        if( empty( $post_id ) || is_category() || is_archive() || is_search() ) {
            $yit_sidebar_layout = yit_get_standard_sidebar();
            return;
        } else {
            $sidebar_layout = yit_get_post_meta( $post_id, '_sidebar-layout' );

            if( ( !empty( $sidebar_layout ) && isset( $sidebar_layout['sidebar'] ) && $sidebar_layout['sidebar'] != -1 ) || ( isset( $sidebar_layout["layout"] ) && $sidebar_layout["layout"] == 'sidebar-no' ) )
            { $yit_sidebar_layout = $sidebar_layout; }
            else
            { $yit_sidebar_layout = yit_get_standard_sidebar(); }
        }
    }
}

if( !function_exists( 'yit_get_standard_sidebar' ) ) {
    /**
     * Retrieve the standard sidebar setted for the current page.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_standard_sidebar() {
        $page = '';

        if( is_shop_installed() ) {
            $page = yit_get_standard_shop_sidebar();
        } else {
            $page = yit_get_standard_corporate_sidebar();
        }

        if( $page == '' ) {
            $page = 'pages';
        }

        $sidebar_layout = yit_get_option( $page . '-sidebar' );
        return $sidebar_layout;
    }
}

if( !function_exists( 'yit_get_standard_shop_sidebar' ) ) {
    /**
     * Retrieve the standard sidebar setted for the current page, including woocommerce pages
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_standard_shop_sidebar() {
        $page = '';
        if( !is_woocommerce() && !is_internal() && !is_product_attribute() ) {
            if( yit_get_option( 'enable-all-sidebar' ) == 1 ) {
                $page = 'all';
            } else {
                if( is_posts_page() || ( is_single() && get_post_type() == 'post' ) || is_page_template('blog.php') ) {
                    $page = 'blog';
                } elseif( is_404() ) {
                    $page = '404';
                } elseif( is_category() ) {
                    $page = 'categories';
                } elseif( is_search() ) {
                    $page = 'search';
                } elseif( is_archive() ) {
                    $page = 'archives';
                } elseif( is_page() ) {
                    $page = 'pages';
                }
            }
        } else {
            if( yit_get_option( 'enable-all-custom-sidebar' ) == 1 ) {
                $page = 'all-custom';
            } else {
                if( is_product() ) {
                    $page = 'single-shop';
                } elseif( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_product_attribute() ) ) {
                    $page = 'shop';
                } elseif( is_portfolio() ) {
                    $page = 'portfolios';
                } elseif( is_gallery() ) {
                    $page = 'galleries';
                } elseif( is_services() ) {
                    $page = 'services';
                } elseif( is_testimonial() ) {
                    $page = 'testimonial';
                }
            }
        }

        return $page;
    }
}

if( !function_exists( 'yit_get_standard_corporate_sidebar' ) ) {
    /**
     * Retrieve the standard sidebar setted for the current page, excluding woocommerce pages.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_standard_corporate_sidebar() {
        $page = '';
        if( !is_internal() ) {
            if( yit_get_option( 'enable-all-sidebar' ) == 1 ) {
                $page = 'all';
            } else {
                if( is_posts_page() || ( is_single() && get_post_type() == 'post' ) || is_page_template('blog.php') ) {
                    $page = 'blog';
                } elseif( is_404() ) {
                    $page = '404';
                } elseif( is_category() ) {
                    $page = 'categories';
                } elseif( is_search() ) {
                    $page = 'search';
                } elseif( is_archive() ) {
                    $page = 'archives';
                } elseif( is_page() ) {
                    $page = 'pages';
                }
            }
        } else {
            if( yit_get_option( 'enable-all-custom-sidebar' ) == 1 ) {
                $page = 'all-custom';
            } else {
                if( is_portfolio() ) {
                    $page = 'portfolios';
                } elseif( is_gallery() ) {
                    $page = 'galleries';
                } elseif( is_services() ) {
                    $page = 'services';
                } elseif( is_testimonial() ) {
                    $page = 'testimonial';
                }
            }
        }

        return $page;
    }
}

if( !function_exists( 'yit_get_sidebar_layout') ) {
    /**
     * Retrieve sidebar layout for the current post.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_sidebar_layout() {
        global $yit_sidebar_layout, $is_extra_content;

        if ( isset( $is_extra_content ) && $is_extra_content )
        { return 'sidebar-no'; }

        return $yit_sidebar_layout[ 'layout' ];
    }
}

if( !function_exists( 'yit_sidebar_layout' ) ) {
    /**
     * Retrieve the sidebar layout settings for the current post.
     *
     * @return string
     * @see yit_get_sidebar_layout
     * @since 1.0.0
     */
    function yit_sidebar_layout() {
        echo yit_get_sidebar_layout();
    }
}

if( !function_exists( 'yit_get_choosen_sidebar' ) ) {
    /**
     * Retrieve the choosen sidebar for the current post.
     *
     * @return string
     * @since 1.0.0
     */
    function yit_get_choosen_sidebar() {
        global $yit_sidebar_layout;
        return $yit_sidebar_layout[ 'sidebar' ];
    }
}

if( !function_exists( 'yit_choosen_sidebar' ) ) {
    /**
     * Retrieve the choosen sidebar for the current post.
     *
     * @return string
     * @see yit_get_choosen_sidebar
     * @since 1.0.0
     */
    function yit_choosen_sidebar() {
        return yit_get_choosen_sidebar();
    }
}

if( !function_exists( 'yit_breadcrumb' ) ) {
    /**
     * Print the breadcrumb.
     *
     * @param string $sep
     * @return string
     * @since 1.0.0
     */
    function yit_breadcrumb( $delimiter = '&raquo;' ) {
        global $post;

        $home = apply_filters( 'yit_homepage_breadcrumb_text', __( 'Home Page', 'yit' ) ); // text for the 'Home' link
        $before = '<a class="no-link current" href="#">'; // tag before the current crumb
        $after = '</a>'; // tag after the current crumb

        echo '<p id="yit-breadcrumb" itemprop="breadcrumb">';

        //$homeLink = site_url();
        $homeLink = apply_filters('yit_breadcrumb_homelink', site_url());

        if( !is_front_page() ) {
            echo '<a class="home" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
        }

        if ( is_single() && yit_get_model('cpt_unlimited')->is_cptu( $post->post_type ) ) {
            $tmp_post = get_post( get_the_id() );
            echo '<a href="' . get_permalink() . '">' . $tmp_post->post_title . '</a> ' . $delimiter . ' ';
            echo $before . yit_remove_chars_title(get_the_title()) . $after;
        } elseif ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ( $thisCat->parent != 0 )
                echo get_category_parents( $parentCat, true, ' ' . $delimiter . ' ' );

            echo $before . sprintf( __( 'Archive by category "%s"', 'yit' ), single_cat_title( '', false ) ) . $after;
        } elseif ( is_day() ) {
            echo '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
            echo '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time( 'd' ) . $after;
        } elseif ( is_month() ) {
            echo '<a href="' . get_year_link( get_the_time( 'Y'  )) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
            echo $before . get_the_time( 'F' ) . $after;
        } elseif ( is_year() ) {
            echo $before . get_the_time( 'Y' ) . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
//                 $post_type = get_post_type_object( get_post_type() );
//                 $slug = $post_type->rewrite;
//
//                 echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];

                if( !empty( $cat ) ) {
                    echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
                }

                echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object( get_post_type() );

            echo $before . apply_filters( 'yit_cpt_breadcrumb_text', $post_type->labels->singular_name ) . $after;
        } elseif ( is_attachment() ) {
            $parent = get_post( $post->post_parent );

            if( $parent->post_type == 'page' || $parent->post_type == 'post' ) {
                $cat = get_the_category( $parent->ID ); $cat = $cat[0];
                $category_parents = get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
                if ( ! is_wp_error( $category_parents ) ) {
                    echo  $category_parents;
                }

            }

            echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            echo $before . ucfirst( strtolower( get_the_title() ) ) . $after;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_page( $parent_id );
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>';
                $parent_id  = $page->post_parent;
            }

            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb )
            { echo $crumb . ' ' . $delimiter . ' '; }

            echo $before . yit_remove_chars_title(get_the_title()) . $after;
        } elseif ( is_search() ) {
            echo $before . sprintf( __( 'Search results for "%s"', 'yit' ), get_search_query() ) . $after;
        } elseif ( is_tag() ) {
            echo $before . sprintf( __( 'Posts tagged "%s"', 'yit' ), single_tag_title( '', false ) ) . $after;
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);

            echo $before . sprintf( __( 'Articles posted by %s', 'yit' ), $userdata->display_name ) . $after;
        } elseif ( is_404() ) {
            echo $before . __( 'Error 404', 'yit' ) . $after;
        } elseif( is_home() ) {
            echo $before . apply_filters( 'yit_posts_page_breadcrumb', __( 'Blog', 'yit' ) )  . $after;

            if ( get_query_var('paged') && get_query_var('paged') != 1 ) {
                echo $delimiter . ' ';
            }
        }

        if ( get_query_var('paged') && get_query_var('paged') != 1 ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
            { echo ' ('; }

            echo $before . __( ' Page ', 'yit' ) . ' ' . get_query_var( 'paged' ) . $after;

            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
            { echo ')'; }
        }

        echo '</p>';
    }
}

if( !function_exists( 'yit_get_icon' ) ) {
    /**
     * Retrive the icon from the database and return it in a <i> tag.
     *
     * @param $icon_name
     * @param $return_tag
     * @return string
     */
    function yit_get_icon( $icon_name, $return_tag = false ) {
        $icon = maybe_unserialize( yit_get_option( $icon_name ) );

        if ( ! is_array( $icon ) )
            $icon = array( 'icon' => $icon, 'custom' => '' );

        if( !$return_tag ) {
            return $icon['icon'];
        }

        if ( ! is_array( $icon ) && ! isset( $icon['custom'] ) && ! isset( $icon['icon'] ) )
            return;

        if( !empty( $icon['custom'] ) ) {
            return '<img src="' . $icon['custom'] . '" alt="'. $icon['icon'] .'" />';
        } else {
            return '<i class="' . $icon['icon'] . '"></i>';
        }
    }
}

if( !function_exists( 'yit_convert_tags' ) ) {
    /**
     * Convert specific tags with their value.
     *
     * @param string $string
     * @return string
     * @since 1.0.0
     */
    function yit_convert_tags( $string ) {
        $tags = apply_filters( 'yit_convertable_tags', array(
            '%site_url%' => YIT_SITE_URL,
            '%home_url%' => home_url(),
            '%site_name%' => get_bloginfo( 'name' ),
            '%admin_email%' => get_bloginfo( 'admin_email' ),
            '%ip%' => $_SERVER['REMOTE_ADDR']
        ) );

        foreach( $tags as $tag => $placeholder ) {
            $string = str_replace( $tag, $placeholder, $string );
        }

        return $string;
    }
}

if( !function_exists( 'yit_pagination' ) ) {
    /**
     * Print pagination
     *
     * @param string $pages
     * @param int $range
     * @return string
     * @since 1.0.0
     */
    function yit_pagination( $pages = '', $range = 10 ) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : false;
        if ( $paged === false ) $paged = (get_query_var('page')) ? get_query_var('page') : false;
        if ( $paged === false ) $paged = 1;


        $html = '';

        if( $pages == '' ) {
            global $wp_query;

            if ( isset( $wp_query->max_num_pages ) )
                $pages = $wp_query->max_num_pages;

            if( !$pages )
                $pages = 1;
        }

        if( 1 != $pages ) {
            $html .= "<div class='general-pagination group'>";
            if( $paged > 2 ) $html .= "<a href='" . get_pagenum_link( 1 ) . "'>&laquo;</a>";
            if( $paged > 1 ) $html .= "<a href='" . get_pagenum_link( $paged - 1 ) . "'>&lsaquo;</a>";

            for ( $i=1; $i <= $pages; $i++ )
            {
                if( 1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $range ) )
                {
                    $class = ( $paged == $i ) ? " class='selected'" : '';
                    $html .= "<a href='" . get_pagenum_link( $i ) . "'$class >$i</a>";
                }
            }

            if ( $paged < $pages ) $html .= "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
            if ( $paged < $pages - 1 ) $html .= "<a href='" . get_pagenum_link($pages) . "'>&raquo;</a>";

            $html .= "</div>\n";
        }

        echo apply_filters( 'yit_pagination_html', $html );
    }
}

if( !function_exists( 'yit_comment_depth' ) ) {
    /**
     * Retrieve a comment depth
     *
     * @param int $comment_id
     * @return int
     * @since 1.0.0
     */
    function yit_comment_depth( $comment_id = null ) {
        $depth = 1;
        $comment = get_comment( $comment_id );

        if( ( int ) $comment->comment_parent != 0 ) {
            $depth += yit_comment_depth( $comment->comment_parent );
        }

        return $depth;
    }
}


if( !function_exists( 'yit_check_theme_updated' ) ) {
    /**
     * Retrieve a comment depth
     *
     * @param int $comment_id
     * @return int
     * @since 1.0.0
     */
    function yit_check_theme_updated() {
        global $yit;
        update_option( 'yit_update_' . YIT_THEME_NAME, $yit->getConfigThemeVersion() );
    }
}


if( !function_exists( 'is_shop_installed' ) ) {
    /**
     * Detect if there is a shop plugin installed
     *
     * @param int $comment_id
     * @return int
     * @since 1.0.0
     */
    function is_shop_installed() {
        global $woocommerce;
        if( isset( $woocommerce ) || defined( 'JIGOSHOP_VERSION' ) ) {
            return true;
        } else {
            return false;
        }
    }
}

if( !function_exists( 'is_shop_enabled' ) ) {
    /**
     * Detect if the shop is enabled
     *
     * @return bool
     * @since 1.0.0
     */
    function is_shop_enabled() {
        return yit_get_option('shop-enabled');
    }
}

if( !function_exists( 'is_product_attribute' ) ) {
    /**
     * Return true when on an attribute archive page
     *
     * @param string $attribute
     * @return bool
     */
    function is_product_attribute( $attribute = '' ) {
        return preg_match( '/pa_' . $attribute . '.*/', get_query_var( 'taxonomy' ) );
    }
}

if( !function_exists( 'yit_check_for_submenu' ) ) {
    /**
     * Add the class dropdown to the menu if an item has children
     *
     * @param array $classes
     * @param object $item
     * @return array
     * @since 1.0.0
     */
    function yit_check_for_submenu( $classes, $item ) {
        global $wpdb;
        $has_children = $wpdb->get_var( "SELECT COUNT( `meta_id` ) FROM `{$wpdb->postmeta}` WHERE `meta_key`= '_menu_item_menu_item_parent' AND `meta_value`= '{$item->ID}'" );

        if ( $has_children > 0 )
        { array_push( $classes, 'dropdown' ); } // add the class dropdown to the current list

        return $classes;
    }
}

if( !function_exists( 'yit_comment_has_children' ) ) {
    /**
     * Return the class parent to a comment if it has childrens
     *
     * @param int $comment_id
     * @return void
     * @since 1.0.0
     */
    function yit_comment_has_children( $comment_id ) {
        global $wpdb;

        $has_children = $wpdb->get_var( "SELECT COUNT( `comment_ID` ) FROM `{$wpdb->comments}` WHERE `comment_parent` = '$comment_id' AND `comment_approved` = '1'" );
        if( $has_children )
        { return true; }

        return false;
    }
}


/**
 * PANEL
 */

if( !function_exists( 'yit_tab_sidebars_sidebars_manager_shop_sidebar' ) ) {
    /**
     * Add specific fields to the tab General -> Settings
     *
     * @param array $fields
     * @return array
     */
    function yit_tab_sidebars_sidebars_manager_shop_sidebar( $fields ) {
        if ( ! is_shop_installed() ) return $fields;

        $fields[25] = array(
            'id' => 'shop-sidebar',
            'type' => 'customsidebar',
            'name' => __( 'Shop Sidebar', 'yit' ),
            'desc'    => __( 'Choose if you want to show a sidebar in Shop pages and where.', 'yit' ),
            'std'     => apply_filters( 'yit_shop-sidebar_std', array(
                'layout' => 'sidebar-left',
                'sidebar' => 'Shop Sidebar'
            ) ),
            'deps'    => array(
                'ids'    => 'enable-all-custom-sidebar',
                'values' => 0
            )
        );

        $fields[26] = array(
            'id' => 'single-shop-sidebar',
            'type' => 'customsidebar',
            'name' => __( 'Products Detail Sidebar', 'yit' ),
            'desc'    => __( 'Choose if you want to show a sidebar in products detail pages and where.', 'yit' ),
            'std'     => apply_filters( 'yit_single-shop-sidebar_std', array(
                'layout' => 'sidebar-no',
                'sidebar' => 'Shop Sidebar'
            ) ),
            'deps'    => array(
                'ids'    => 'enable-all-custom-sidebar',
                'values' => 0
            )
        );

        return $fields;
    }
}

/*
 *  Twitter API
 */
if( !function_exists( 'buildBaseString' ) ) {
    function buildBaseString($baseURI, $method, $params){
        $r = array();
        ksort($params);
        foreach($params as $key=>$value){
            $r[] = "$key=" . rawurlencode($value);
        }

        return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r)); //return complete base string
    }
}

if( !function_exists( 'buildAuthorizationHeader' ) ) {
    function buildAuthorizationHeader($oauth){
        $r = 'Authorization: OAuth ';
        $values = array();
        foreach($oauth as $key=>$value)
            $values[] = "$key=\"" . rawurlencode($value) . "\"";

        $r .= implode(', ', $values);
        return $r;
    }
}

if( !function_exists( 'yit_get_tweets' ) ) {
    function yit_get_tweets( $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret, $limit){

        $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";

        $oauth = array( 'oauth_consumer_key' => $consumer_key,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $oauth_access_token,
            'oauth_timestamp' => time(),
            'count' => $limit,
            'oauth_version' => '1.0');

        $base_info = buildBaseString($url, 'GET', $oauth);
        $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
        $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
        $oauth['oauth_signature'] = $oauth_signature;


        $header = array(buildAuthorizationHeader($oauth), 'Expect:');
        $options = array( CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url . '?count='.$limit,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false);

        $feed = curl_init();

        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);
        return json_decode($json);
    }
}
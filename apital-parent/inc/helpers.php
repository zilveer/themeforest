<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Helper functions and classes with static methods for usage in theme
 */

/**
 * Register Lato Google font.
 *
 * @return string
 */
function fw_theme_font_url() {
    $font_url = '';
    /*
     * Translators: If there are characters in your language that are not supported
     * by Lato, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Lato font: on or off', 'fw' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
    }

    return $font_url;
}

/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function fw_theme_get_featured_posts() {
    /**
     * @param array|bool $posts Array of featured posts, otherwise false.
     */
    return apply_filters( 'fw_theme_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 *
 * @return bool Whether there are featured posts.
 */
function fw_theme_has_featured_posts() {
    return ! is_paged() && (bool) fw_theme_get_featured_posts();
}

if ( ! function_exists( 'fw_theme_the_attached_image' ) ) :
    /**
     * Print the attached image with a link to the next attached image.
     */
    function fw_theme_the_attached_image() {
        $post = get_post();
        /**
         * Filter the default attachment size.
         *
         * @param array $dimensions {
         *     An array of height and width dimensions.
         *
         *     @type int $height Height of the image in pixels. Default 810.
         *     @type int $width  Width of the image in pixels. Default 810.
         * }
         */
        $attachment_size     = apply_filters( 'fw_theme_attachment_size', array( 810, 810 ) );
        $next_attachment_url = esc_url(wp_get_attachment_url());

        /*
         * Grab the IDs of all the image attachments in a gallery so we can get the URL
         * of the next adjacent image in a gallery, or the first image (if we're
         * looking at the last image in a gallery), or, in a gallery of one, just the
         * link to that image file.
         */
        $attachment_ids = get_posts( array(
            'post_parent'    => $post->post_parent,
            'fields'         => 'ids',
            'numberposts'    => -1,
            'post_status'    => 'inherit',
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID',
        ) );

        // If there is more than 1 attachment in a gallery...
        if ( count( $attachment_ids ) > 1 ) {
            foreach ( $attachment_ids as $attachment_id ) {
                if ( $attachment_id == $post->ID ) {
                    $next_id = current( $attachment_ids );
                    break;
                }
            }

            // get the URL of the next image attachment...
            if ( $next_id ) {
                $next_attachment_url = get_attachment_link( $next_id );
            }

            // or get the URL of the first image attachment.
            else {
                $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
            }
        }

        printf( '<a href="%1$s" rel="attachment">%2$s</a>',
            esc_url( $next_attachment_url ),
            wp_get_attachment_image( $post->ID, $attachment_size )
        );
    }
endif;

if ( ! function_exists( 'fw_theme_list_authors' ) ) :
    /**
     * Print a list of all site contributors who published at least one post.
     */
    function fw_theme_list_authors() {
        $contributor_ids = get_users( array(
            'fields'  => 'ID',
            'orderby' => 'post_count',
            'order'   => 'DESC',
            'who'     => 'authors',
        ) );

        foreach ( $contributor_ids as $contributor_id ) :
            $post_count = count_user_posts( $contributor_id );

            // Move on if user has not published a post (yet).
            if ( ! $post_count ) {
                continue;
            }
            ?>

            <div class="contributor">
                <div class="contributor-info">
                    <div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
                    <div class="contributor-summary">
                        <h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
                        <p class="contributor-bio">
                            <?php echo get_the_author_meta( 'description', $contributor_id ); ?>
                        </p>
                        <a class="button contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>">
                            <?php printf( _n( '%d Article', '%d Articles', $post_count, 'fw' ), $post_count ); ?>
                        </a>
                    </div><!-- .contributor-summary -->
                </div><!-- .contributor-info -->
            </div><!-- .contributor -->

        <?php
        endforeach;
    }
endif;

/**
 * Custom template tags
 */
{
    if ( ! function_exists( 'fw_theme_paging_nav' ) ) :
        /**
         * Display navigation to next/previous set of posts when applicable.
         */
        function fw_theme_paging_nav($args = array(), $query = '' ) {

            global $wp_rewrite, $wp_query;
            if ( $query ) {

                $wp_query = $query;

            } // End IF Statement
            /* If there's not more than one page, return nothing. */
            if ( 1 >= $wp_query->max_num_pages )
                return false;

            /* Get the current page. */
            $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

            /* Get the max number of pages. */
            $max_num_pages = intval( $wp_query->max_num_pages );

            /* Set up some default arguments for the paginate_links() function. */
            $defaults = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'format' => '',
                'total' => $max_num_pages,
                'current' => $current,
                'prev_next' => false,
                'show_all' => false,
                'end_size' => 2,
                'mid_size' => 1,
                'add_fragment' => '',
                'type' => 'array',
                'before' => '<li>',
                'after' => '</li>',
                'echo' => true,
            );

            /* Add the $base argument to the array if the user is using permalinks. */
            if( $wp_rewrite->using_permalinks() )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

            /* If we're on a search results page, we need to change this up a bit. */
            if ( is_search() ) {
                $search_permastruct = $wp_rewrite->get_search_permastruct();
                if ( !empty( $search_permastruct ) )
                    $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
            }

            /* Merge the arguments input with the defaults. */
            $args = wp_parse_args( $args, $defaults );

            /* Don't allow the user to set this to an array. */
            /*if ( 'array' == $args['type'] )
                $args['type'] = 'plain';*/

            /* Get the paginated links. */
            $page_links = paginate_links( $args );

            /* Remove 'page/1' from the entire output since it's not needed. */
            //$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );
            $prev = get_previous_posts_link(__('Prev','fw'));
            $next = get_next_posts_link(__('Next','fw'));
            ?>
            <div class="space x2">
                <div class="blog-pagination">

                    <?php if($prev):?>
                        <span class="w-clearfix w-inline-block button btn-small btn-blog">
                            <?php echo do_shortcode($prev);?>
                        </span>
                    <?php endif;?>

                    <?php if(!empty($page_links)):?>
                        <?php foreach($page_links as $key => $page_link):?>
                            <?php echo ($key == 0) ? str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_link ) : $page_link;?>
                        <?php endforeach;?>
                    <?php endif;?>

                    <?php if($next):?>
                        <span class="w-clearfix w-inline-block button btn-small btn-blog">
                            <?php echo do_shortcode($next);?>
                        </span>
                    <?php endif;?>

                </div>
            </div>
        <?php
        }
    endif;

    if ( ! function_exists( 'fw_theme_post_nav' ) ) :
        /**
         * Display navigation to next/previous post when applicable.
         */
        function fw_theme_post_nav() {
            // Don't print empty markup if there's nowhere to navigate.
            $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
            $next     = get_adjacent_post( false, '', false );

            if ( ! $next && ! $previous ) {
                return;
            }

            ?>
            <nav class="navigation post-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'fw' ); ?></h1>
                <div class="nav-links">
                    <?php
                    if ( is_attachment() ) :
                        previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'fw' ) );
                    else :
                        previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'fw' ) );
                        next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'fw' ) );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .navigation -->
        <?php
        }
    endif;

    if ( ! function_exists( 'fw_theme_posted_on' ) ) :
        /**
         * Print HTML with meta information for the current post-date/time and author.
         */
        function fw_theme_posted_on() {
            if ( is_sticky() && is_home() && ! is_paged() ) {
                echo '<span class="featured-post">' . __( 'Sticky', 'fw' ) . '</span>';
            }

            // Set up and print post meta information.
            printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
                esc_url( get_permalink() ),
                esc_attr( get_the_date( 'c' ) ),
                esc_html( get_the_date() ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
        }
    endif;

    /**
     * Find out if blog has more than one category.
     *
     * @return boolean true if blog has more than 1 category
     */
    function fw_theme_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'fw_theme_category_count' ) ) ) {
            // Create an array of all the categories that are attached to posts
            $all_the_cool_cats = get_categories( array(
                'hide_empty' => 1,
            ) );

            // Count the number of categories that are attached to the posts
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'fw_theme_category_count', $all_the_cool_cats );
        }

        if ( 1 !== (int) $all_the_cool_cats ) {
            // This blog has more than 1 category so fw_theme_categorized_blog should return true
            return true;
        } else {
            // This blog has only 1 category so fw_theme_categorized_blog should return false
            return false;
        }
    }

    /**
     * Display an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index
     * views, or a div element when on single views.
     */
    function fw_theme_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <div class="post-thumbnail-image">
                    <?php
                    if ( ( in_array(fw_ext_sidebars_get_current_position(), array('full', 'left')) || is_page_template( 'page-templates/full-width.php' ) ) ) {
                        the_post_thumbnail( 'fw-theme-full-width' );
                    } else {
                        the_post_thumbnail();
                    }
                    ?>
                </div>
            </div>

        <?php else : ?>
            <div class="post-thumbnail">
                <a class="post-thumbnail-image" href="<?php the_permalink(); ?>">
                    <?php
                    if ( ( in_array(fw_ext_sidebars_get_current_position(), array('full', 'left')) || is_page_template( 'page-templates/full-width.php' ) ) ) {
                        the_post_thumbnail( 'fw-theme-full-width' );
                    } else {
                        the_post_thumbnail();
                    }
                    ?>
                </a>
            </div>

        <?php endif; // End is_singular()
    }
}


/*vlad*/
if ( !function_exists('fw_theme_get_posts')):
    /**
     *  Generate array with: recent/popular/most commented posts
     * @param string $sort Sort type (recent/popular/most commented)
     * @param integer $items Number of items to be extracted
     * @param boolean $image_post Extract or no post image
     * @param integer $image_width Set width of post image
     * @param integer $image_height Set height of post image
     * @param string $image_class Set class of post image
     * @param boolean $date_post Extract or no post date
     * @param string $date_format Set date format
     * @param string $post_type Set post type
     * @param string $category Set category from where posts would be extracted
     */
    function fw_theme_get_posts($args = null)
    {
        $defaults = array(
            'sort' => 'recent',
            'items' => 5,
            'image_post' => true,
            'return_image_tag' => true,
            'image_width' => 70,
            'image_height' => 70,
            'image_class' => 'thumbnail',
            'date_post' => true,
            'date_format' => 'F jS, Y',
            'post_type' => 'post',
            'category' => '',
            'excerpt_length' => 40
        );

        extract(wp_parse_args($args, $defaults));
        global $post;
        $fw_cat_ID = ( !empty($category)) ? get_cat_ID( $category ) : '';

        if($sort == 'recent')
        {
            $query = new WP_Query( array ( 'post_type' => $post_type, 'orderby' => 'post_date',  'order '=>'DESC', 'cat'=> $fw_cat_ID, 'posts_per_page'=>$items ) );
            $posts  = $query->get_posts();
        }
        elseif($sort == 'popular')
        {
            $query = new WP_Query( array ( 'post_type' => $post_type, 'orderby' => 'meta_value', 'meta_key' => 'fw_post_views', 'order '=>'DESC', 'cat'=> $fw_cat_ID, 'posts_per_page'=>$items ) );
            $posts  = $query->get_posts();
        }
        elseif($sort == 'commented')
        {
            $query = new WP_Query( array ( 'post_type' => $post_type,  'orderby' => 'comment_count', 'order '=>'DESC','cat'=> $fw_cat_ID, 'posts_per_page'=>$items ) );
            $posts  = $query->get_posts();

        }
        else
            return false;

        $fw_post_option = array();
        $count = 0;
        if( !empty($posts) )
        {

            foreach($posts as $post_elm)
            {
                setup_postdata($post_elm);
                $img = '';

                if ( $image_post == true )
                {
                    $post_thumbnail_id = get_post_thumbnail_id( $post_elm->ID );
                    $post_thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

                    if ( !empty($post_thumbnail) )
                    {
                        $image = fw_resize($post_thumbnail[0], $image_width, $image_height, true);
                        $img = $image;
                        if($return_image_tag){
                            $img = '<img src="'.$image.'" class="'.$image_class.'" alt="'.get_the_title($post_thumbnail_id).'" width="'.$image_width.'" height="'.$image_height.'" />';
                        }
                    }
                }

                if ( !empty($img) )
                    $fw_post_option[$count]['post_img'] = $img;
                else
                    $fw_post_option[$count]['post_img'] =  '';

                if ( $date_post ) {
                    $time_format = apply_filters('_filter_widget_time_format',$date_format);
                    $fw_post_option[$count]['post_date_post'] =  get_the_time($time_format, $post_elm->ID);
                }
                else
                    $fw_post_option[$count]['post_date_post'] = '';

                $fw_post_option[$count]['post_class']        = ( is_singular() && $post->ID == $post_elm->ID ) ? 'current-menu-item post_'.$sort : 'post_'.$sort;
                $fw_post_option[$count]['post_title']        = get_the_title($post_elm->ID);
                $fw_post_option[$count]['post_link']         = esc_url(get_permalink($post_elm->ID));
                $fw_post_option[$count]['post_author_link']  = get_author_posts_url(get_the_author_meta('ID' ));
                $fw_post_option[$count]['post_author_name']  = get_the_author();
                $fw_post_option[$count]['post_comment_numb'] = get_comments_number($post_elm->ID);
                $fw_post_option[$count]['post_excerpt']      = ( isset($post) ) ? get_the_excerpt() : '';
                $count++;
            }
            wp_reset_postdata();
        }

        return $fw_post_option;
    }
endif;


if ( ! function_exists( 'fw_theme_get_the_favicon' ) ) :
    /**
     * Print the favicon
     */
    function fw_theme_get_the_favicon($return = false) {
        $favicon = defined('FW') ? fw_get_db_settings_option('favicon') : '';
        if($return){
            return (!empty($favicon)) ? $favicon['url'] : '';
        }
        else{
            if( !empty( $favicon ) ) :
                ?>
                <link rel="shortcut icon" type="image/x-icon"  href="<?php echo esc_url($favicon['url']); ?>">
            <?php endif;
        }
    }
endif;

if ( ! function_exists( 'fw_theme_get_content_class' ) ) :
    /**
     * Print the analytics code
     */
    function fw_theme_get_content_class($parameter, $sidebar_position) {
        $class = '';
        if($parameter == 'content'){
            if($sidebar_position == 'right'){
                $class = 'col-sm-8';
            }
            elseif($sidebar_position == 'left'){
                $class = 'col-sm-8';
            }
            else{
                $class = 'col-sm-12';
            }
        }
        return $class;
    }
endif;

if ( ! function_exists( 'fw_theme_get_parent_sidebar_class' ) ) :
    /**
     * get parent sidebar class
     */
    function fw_theme_get_parent_sidebar_class($parameter, $sidebar_position) {
        $class = '';
        if($parameter == 'content'){
            if($sidebar_position == 'left'){
                $class = 'sidebar-left';
            }
            else{
                $class = '';
            }
        }
        return $class;
    }
endif;


//display logo
if (!function_exists('fw_theme_type_logo')) :
    function fw_theme_type_logo() {
        $logo_upload = fw_get_db_settings_option('logo');
        $logo = !empty($logo_upload) ?  esc_attr($logo_upload['attachment_id']) : '';
        if(!empty($logo))
        { ?>
            <a class="w-nav-brand brand-logo" href="<?php echo esc_url(home_url()); ?>">
                <img src="<?php echo esc_url(wp_get_attachment_url( $logo)); ?>" width="134" alt="">
            </a>
        <?php }

    }
endif;

if ( !function_exists('fw_theme_cat_links')):
    function fw_theme_cat_links($post_type,$id){
        if($post_type == 'post')
            return get_the_term_list($id,'category', '', ', ' );
    }
endif;


if (!function_exists('fw_theme_list_portfolios')) :
    function fw_theme_list_portfolios() {
        $args = array(
            'hide_empty'    => false,
        );
        $terms = get_terms('fw-portfolio-category', $args);
        $result = array();
        $result[0] = __('All','fw');

        if(!empty($terms))
            foreach ( $terms as $term ) {
                $result[$term->term_id] = $term->name;
            }
        return $result;
    }
endif;

if (!function_exists('fw_show_inner_banner')) :
    function fw_show_inner_banner($banner = 'no', $title = '', $subtitle = '', $breadcrumbs = '') {

        if($banner == 'yes'):?>
            <!-- INNER BANNER -->
            <div class="w-section inner-banner" id="top" data-ix="show-top-btn">
                <div class="w-container">
                    <div class="w-row">
                        <div class="w-col w-col-9">
                            <div class="breadcrumb"><?php echo esc_html($title); ?>

                                <?php if(!empty($subtitle)):?>
                                    &nbsp;<span class="lighter"><span>|</span> <em><?php echo fw_theme_translate(esc_html($subtitle)); ?></em></span>
                                <?php endif;?>

                            </div>
                        </div>
                        <?php if($breadcrumbs == 'yes'):?>
                            <div class="w-col w-col-3 left-aglin-column cetner">
                                <?php
                                    if( function_exists('fw_ext_breadcrumbs') ) {
                                        fw_ext_breadcrumbs();
                                    }
                                ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <!-- INNER BANNER -->
        <?php endif;
    }
endif;

if (!function_exists('fw_show_call_to_action')) :
    function fw_show_call_to_action($call_action) { //fw_print($call_to_action);
        $call_to_action = $call_action['call_type'];

        $call_class = ($call_to_action['message_type'] == 'custom') ? '' : $call_to_action['message_type'];

        //custom type colors
        $bg_color = empty($call_class) ? 'style="background-color:'.$call_to_action['custom']['bg_color'].';"' : '';
        $text_color = empty($call_class) ? 'style="color:'.$call_to_action['custom']['text_color'].'"' : '';
        ?>
        <div class="call-to-action <?php echo esc_attr($call_class);?> <?php echo esc_attr($call_action['class']);?>" <?php echo ($bg_color);?>>
            <div class="w-container">
                <div class="w-row">

                    <?php if(!empty($call_action['text'])):?>
                        <div class="w-col w-col-9 w-col-stack">
                            <h4 class="m-p"><span class="white" <?php echo ($text_color); ?>><?php echo do_shortcode($call_action['text']); ?></span></h4>
                        </div>
                    <?php endif;?>

                    <?php if($call_action['button']['enable-btn'] == 'yes'): $btn = $call_action['button'];?>
                        <div class="w-col w-col-3 w-col-stack left-aglin-column">
                            <?php
                                $icon = ($btn['yes']['icon_box']['icon_type'] == 'awesome') ? $btn['yes']['icon_box']['awesome']['icon'] : $btn['yes']['icon_box']['custom']['icon'];
                                $modal = $btn['yes']['modal'];

                                $uniq_id = rand(1,1000);
                            ?>
                            <a target="<?php echo esc_attr( $btn['yes']['target'] ); ?>"
                               class="w-clearfix w-inline-block button
                               <?php echo esc_attr( $btn['yes']['size'] ); ?>
                               <?php echo esc_attr( $btn['yes']['shape'] ); ?>
                               <?php echo esc_attr( $btn['yes']['colors'] ); ?>
                               <?php echo esc_attr( $btn['yes']['class'] ); ?>
                               <?php echo ($btn['yes']['modal']['enable-btn'] == 'yes') ? 'modal-btn-popup' : '' ;?>"
                               href="<?php echo esc_url( $btn['yes']['link'] ); ?>" <?php echo ($btn['yes']['modal']['enable-btn'] == 'yes') ? 'data-numb="'.$uniq_id.'" data-ix="open-modal-v'.$uniq_id.'"' : '' ;?>>

                                <?php if(!empty($icon)):?>
                                    <div class="btn-ico">
                                        <div class="w-embed"><i class="<?php echo esc_attr($icon);?>"></i>
                                        </div>
                                    </div>
                                <?php endif;?>

                                <div class="btn-txt"><?php echo fw_theme_translate( esc_attr( $btn['yes']['label'] ) ); ?></div>
                            </a>
                            <?php if($btn['yes']['modal']['enable-btn'] == 'yes'): ?>
                                <!-- MODAL WRAPPER -->
                                <div class="modal_<?php echo esc_attr($uniq_id);?> modal modal-btn-content" data-ix="out-click-remove-modal<?php echo esc_attr($uniq_id);?>">
                                    <div class="w-container container-popup">
                                        <div class="popup">
                                            <a class="w-inline-block remove-modal" href="#" data-numb="<?php echo esc_attr($uniq_id);?>" data-ix="remove-modal-<?php echo esc_attr($uniq_id); ?>">
                                                <div class="w-embed"><i class="fa fa-times"></i>
                                                </div>
                                            </a>
                                            <div class="hero-center-div">
                                                <?php echo fw_theme_translate(do_shortcode($btn['yes']['modal']['yes']['content']));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL WRAPPER -->
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php
    }
endif;

if (!function_exists('fw_get_category_term_list')) :
    function fw_get_category_term_list(){
        /**
         * Return array of categories
         */
        $taxonomy = 'category';
        $args = array(
            'hide_empty' => true,
        );

        $terms = get_terms($taxonomy, $args);
        $result = array();
        $result[0] = __('All Categories','fw');

        if(!empty($terms))
            foreach ( $terms as $term ) {
                $result[ $term->term_id ] = $term->name;
            }
        return $result;
    }
endif;

if ( ! function_exists( 'fw_theme_related_articles' ) ) :
    /**
     * Return post related articles
     */
    function fw_theme_related_articles() {
        global $post;
        $taxonomy   = 'tags';
        $post_terms = array();
        $terms      = wp_get_post_terms( $post->ID, $taxonomy );
        if ( ! empty( $terms ) ) {
            foreach ( $terms as $term ) {
                $post_terms[] = $term->term_id;
            }
        } else {
            // if post have 0 tags
            $taxonomy = 'fw-portfolio-category';
            $terms    = wp_get_post_terms( $post->ID, $taxonomy );
            if ( ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $post_terms[] = $term->term_id;
                }
            }
        }

        $args = array(
            'posts_per_page' => 48,
            'orderby'        => 'date',
            'post_status'    => 'publish',
            'post_type'      => 'fw-portfolio',
            'post__not_in'   => array( $post->ID ),
            'tax_query'      => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'id',
                    'terms'    => $post_terms
                ),
            )
        );

        $all_posts = new WP_Query( $args );

        return $all_posts->posts;
    }
endif;

//background theme
if (!function_exists('fw_theme_bg_style')) :
    function fw_theme_bg_style()
    {
        $style = $bg =  $color = $class = ''; $uri = get_template_directory_uri();
        $layout = fw_get_db_settings_option('layout');

        $boxed_get = (isset($_GET['layout']) && $_GET['layout'] == 'boxed') ? 'boxed' : '';

        if($layout['layout-type'] == 'boxed')
        {
            $class = 'boxed';

            //get background type
            $bg_type = $layout['boxed']['bg-type-bg'];

            //get custom background
            if($bg_type['bg_type'] == 'custom')
            {
                //get background
                if(!empty($bg_type['custom']['custom_bg'])) {
                    $bg = 'background-image: url(' . esc_url($bg_type['custom']['custom_bg']['url']) . ');';
                }
            }
            //get predefined bg
            else{
                switch($bg_type['predefined']['bg']){
                    case 'china' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/china.png').');';
                        break;
                    case 'concrete' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/concrete.png').');';
                        break;
                    case 'eight' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/eight.png').');';
                        break;
                    case 'green_cup' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/green_cup.png').');';
                        break;
                    case 'lodyas' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/lodyas.png').');';
                        break;
                    case 'stardust' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/stardust.png').')';
                        break;
                    case 'struckaxiom' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/struckaxiom.png').');';
                        break;
                    case 'stwirl' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/stwirl.png').');';
                        break;
                    case 'wood' :
                        $bg = 'background-image: url('.esc_url($uri . '/images/patterns/wood.png').');';
                        break;
                    case 'wood-dark' :
                        $bg = '"background-image: url('.esc_url($uri . '/images/patterns/wood-dark.png').');';
                        break;
                }
            }


            //get background color
            if(!empty($layout['boxed']['bg-color']))
                $color = 'background-color: '.$layout['boxed']['bg-color'].';';
        }
        elseif($boxed_get == 'boxed')
            $class = 'boxed';

        //style for background image and background color
        if(!empty($bg) && !empty($color))
            $style = 'style="'.$bg.' '.$color.'"';
        elseif(!empty($bg) && empty($color))
            $style = 'style="'.$bg.'"';
        elseif(empty($bg) && !empty($color))
            $style = 'style="'.$color.'"';

        return array('class' => $class, 'style' => $style);
    }
endif;

//color theme
if (!function_exists('fw_theme_change_style')) :
    function fw_theme_change_style()
    {
        if(!defined('FW')) return;

        $styles = '';
        //colors
        $color = fw_get_db_settings_option('color-scheme');

        if($color['scheme'] == 'custom')
        {
            $custom_color = $color['custom']['styling'];
            if(!empty($custom_color))
                $styles .='
                    .blue,
                    .b-arrow,
                    .p-pagination:hover,
                    .dropcast.dc-transparent,
                    .remove-modal:hover,
                    .tab-link-caption:hover,
                    .toggle-header.fourth-style,
                    .qoute-ico,
                    .title-full-portfolio:hover,
                    .mega-item-list.w--current,
                    .mega-tittle:hover,
                    .h-minimal,
                    .footer-link.f-2,
                    .core-ico,
                    .blog-link:hover,
                    .link,
                    .tab-slide.w--current,
                    .li-ico.li-blue,
                    .portfolio-ico:hover,
                    .nav-link:hover,
                    .nav-link.w--open,
                    .nav-link.active,
                    .dropdown-link.w--current,
                    .language-link.active,
                    .email:hover,
                    .search-wrapper:hover,
                    .icobox-circle,
                    .hand-of-sean,
                    .portfolio-text-wrapper:hover,
                    .arrow-language { color: '.$custom_color.'; }
                    
                    .button:hover,
                    .portfolio-ico,
                    .banner,
                    .creative-banner,
                    .w-slider-nav-invert>div.w-active,
                    .w-slider-dot.w-active,
                    .dropcast,
                    .highlight,
                    .pricing-price,
                    .call-to-action,
                    .tab-ico-number,
                    .toggle-line-2.blue-color,
                    .caption-tab,
                    .toggle-line.blue-color,
                    .animation-ico,
                    .small-line,
                    .dt-blog,
                    .procces-wrapper.color-3,
                    .social-ico.footer-soc:hover,
                    .social-ico:hover,
                    .social-ico.social-gray:hover,
                    .search-form:hover,
                    .icobox-circle:hover,
                    .icobox-circle.ibox-gray:hover,
                    .divider-1.dvd-color,
                    .carousel-arrow:hover,
                    .tab.w--current,
                    .tab.t-vertical.w--current,
                    .button.btn-top:hover { background-color: '.$custom_color.'; }
                    
                    .button.btn-small.btn-blog:hover {
                      background-color: '.$custom_color.';
                      box-shadow: '.$custom_color.' 0px 0px 0px 1px inset;
                      }
                      
                    .button.btn-gradient {
                      background-image: -webkit-linear-gradient(bottom, '.$custom_color.', '.$custom_color.');
                      background-image: linear-gradient(to top, '.$custom_color.', '.$custom_color.');
                      }
                      
                    .button.btn-gradient:hover {
                      background-image: -webkit-linear-gradient('.$custom_color.', '.$custom_color.');
                      background-image: linear-gradient('.$custom_color.', '.$custom_color.');
                    }
                    
                    .drop-down-list.w--open,
                    .filter.active {
                      border-top: 2px solid '.$custom_color.';
                    }
                    
                    .social-ico:hover,
                    .divider-1.dvd-dash.dvd-b-color,
                    .divider-1.dvd-dots.dvd-b-color { border-color: '.$custom_color.'; }
                    
                    .social-ico.footer-soc:hover {
                      border-bottom-color: '.$custom_color.';
                    }
                    
                    .search-result {
                      border-top: 1px solid '.$custom_color.';
                    }
                    
                    .icobox-circle,
                    .qoute-ico {
                      border: 1px solid '.$custom_color.';
                    }
                    
                    .tab.w--current,
                    .tab.t-vertical.w--current {
                      border-bottom-color: '.$custom_color.';
                    }
                    
                    .procces-wrapper,
                    .call-to-action.cta-v3 {
                      background-color: '.$custom_color.';
                    }
                    
                    .procces-wrapper.color-2,
                    .call-to-action.cta-v2 {
                      background-color: '.$custom_color.';
                    }
                    
                    .procces-wrapper.color-4,
                    .call-to-action.cta-v4 {
                      background-color: '.$custom_color.';
                    }
                    
                    .arrow-proccess {
                      border-left: 15px solid '.$custom_color.';
                    }
                    
                    .arrow-proccess.color-2 {
                      border-left-color: '.$custom_color.';
                    }
                    
                    
                    .arrow-proccess.color-3 {
                      border-left-color: '.$custom_color.';
                    }
                    
                    .mega-menu.w--open {
                      border-top: 2px solid '.$custom_color.';
                    }
                    
                    .toggle-header.fourth-style {
                      border-bottom-color: '.$custom_color.';
                    }
                    
                    .blockquote.bq-v2 {
                      background-color: '.$custom_color.';
                    }
                    .icobox-circle.ibox-gray:hover {
                      border-color: '.$custom_color.';
                    }
                    
                    .blockquote {
                      border-left: 2px solid '.$custom_color.';
                    }
                    
                    .boxed {
                      border-top: 3px solid '.$custom_color.';
                    }
                    
                    .tab-slide.w--current {
                      border-top-color: '.$custom_color.';
                    }
                    
                    .button  { background-color: '.$custom_color.';}
                    
                    .video-overlay {
                      background-image: url('.esc_url(get_template_directory_uri() . '/images/ptn.png').'), linear-gradient(to right, '.$custom_color.' 19%, '.$custom_color.' 75%, '.$custom_color.')
                    }
                    
                    .button.btn-gradient {
                      box-shadow: '.$custom_color.' 0px 0px 0px 1px;
                    }
                    
                    @media (max-width: 991px) {
                          .hamburger.w--open {
                        background-color: '.$custom_color.';
                    }
                    }
                    
                    .blog-pagination .page-numbers:hover {
                        background-color: '.$custom_color.';
                        box-shadow: '.$custom_color.' 0px 0px 0px 1px inset;
                    }
                    
                    .p-pagination a:hover{
                        color: '.$custom_color.';
                    }
                    
                    p.form-submit input#submit{
                        background-color: '.$custom_color.';
                    }
                    
                    .comment-reply-link:hover, .widget_calendar table td a, .widget_calendar table td#today {
                        color: '.$custom_color.';
                    }
                    
                    aside ul li a:hover{
                        color: '.$custom_color.';
                    }
                    
                    .mega-menu-row  .mega-item-list.w--current div ,
                    .mega-menu-row .mega-item-list.w--current:hover div
                    {  color: '.$custom_color.';}
                    
                    
                    .navigation-list .current-menu-ancestor > .link-click .nav-link,
                    .navigation-list .current-menu-ancestor > .link-click .drop-arrow
                    {  color: '.$custom_color.';}
                    
                    .go-top .button.btn-top:hover,
                    .woocommerce button.button:disabled:hover,
                    .woocommerce button.button:disabled[disabled]:hover
                    {
                        background-color: '.$custom_color.';
                    }
                    
                    .woocommerce ul.products li.product .star-rating,
                    .woocommerce .woocommerce-product-rating .star-rating,
                    .woocommerce .star-rating, .comment-form-rating .stars a{
                        color: '.$custom_color.';
                    }
                    
                    .woocommerce a.button,.woocommerce button.button,.woocommerce input.button,
                    .woocommerce a.button.alt,.woocommerce input.button.alt{
                        background-color: '.$custom_color.';
                    }
                    
                    .woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,
                    .woocommerce a.button.alt:hover,.woocommerce input.button.alt:hover {
                        background-color: '.$custom_color.';
                    }
                    
                    .posted_in a, .tagged_as a, a.added_to_cart.wc-forward,.product-name a,
                    .woocommerce-message a,.shipping-calculator-button,
                    .woocommerce .showcoupon, a.about_paypal, .woocommerce .edit,.myaccount_user a,
                    .order-number a, .lost_password a{
                        color: '.$custom_color.';
                    }
                    
                    .woocommerce #respond input#submit {
                        background-color: '.$custom_color.';
                    }
                    
                    .woocommerce #respond input#submit:hover{
                        background-color: '.$custom_color.';
                    }
                    
                    .woocommerce form .form-row.woocommerce-validated .select2-container,
                    .woocommerce form .form-row.woocommerce-validated input.input-text,
                    .woocommerce form .form-row.woocommerce-validated select {
                        border-color: '.$custom_color.';
                    }
                    
                    .drop-arrow.act {color: '.$custom_color.';}
                    
                    .drop-down-list { border-top: 2px solid '.$custom_color.';}
                    
                    .drop-arrow.active {color: '.$custom_color.';}
                    
                    .dropdown:hover .drop-arrow{color: '.$custom_color.';}
                    
                    .portfolio-ico {
                    
                        background-color: '.$custom_color.';
                        opacity: 0.9;
                    }
                    
                    .light-overlay {
                        background-color: '.$custom_color.';
                        opacity: 0.7;
                    }
                    
                    .menu-item-has-children.w-col:hover .element-tittle h6{
                        color: '.$custom_color.';
                    }
                    
                    ::selection{
                        background: '.$custom_color.';
                        color: '.$custom_color.';
                    }
                    
                    ::-moz-selection{
                        background: '.$custom_color.';
                        color: '.$custom_color.';
                    }
                ';
        }

        //remove all empty spaces
        $styles = trim($styles);

        if(!empty($styles))
            echo '<style type="text/css">
                    '.$styles.'
                 </style>';
    }
    add_action('wp_head','fw_theme_change_style',99);
endif;

//color theme
if (!function_exists('fw_load_webfonts')) :
    function fw_load_webfonts()
    {
        echo '<script>
                WebFont.load({
                    google: {
                        families: ["PT Sans:400,400italic,700,700italic","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Raleway:200,300,regular,500,600,700,800","Shadows Into Light:regular","Josefin Sans:300,300italic,regular,italic,600,600italic,700,700italic"]
                    }
                });
            </script>';
    }
    add_action('wp_head','fw_load_webfonts',99);
endif;


//tranaslate view qtranslate and wpml
if (!function_exists('fw_theme_translate')) :
    function fw_theme_translate($content){
        /**
         * Return the content for translations plugins
         * @param string $content
         */
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');

        if(function_exists('icl_object_id') && strpos($content,'wpml_translate') == true){
            $content = do_shortcode($content);
        }
        elseif(function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')){
            $content = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($content);
        }

        return $content;
    }
endif;

//formatting text from wp-editor
if (!function_exists('fw_wpautop')) :
    function fw_wpautop($pee, $br = true, $p = true)
    {
        $pre_tags = array();

        if (trim($pee) === '')
            return '';

        // Just to make things a little easier, pad the end.
        $pee = $pee . "\n";

        /*
         * Pre tags shouldn't be touched by autop.
         * Replace pre tags with placeholders and bring them back after autop.
         */
        if (strpos($pee, '<pre') !== false) {
            $pee_parts = explode('</pre>', $pee);
            $last_pee = array_pop($pee_parts);
            $pee = '';
            $i = 0;

            foreach ($pee_parts as $pee_part) {
                $start = strpos($pee_part, '<pre');

                // Malformed html?
                if ($start === false) {
                    $pee .= $pee_part;
                    continue;
                }

                $name = "<pre wp-pre-tag-$i></pre>";
                $pre_tags[$name] = substr($pee_part, $start) . '</pre>';

                $pee .= substr($pee_part, 0, $start) . $name;
                $i++;
            }

            $pee .= $last_pee;
        }
        // Change multiple <br>s into two line breaks, which will turn into paragraphs.
        $pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);

        $allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';

        // Add a single line break above block-level opening tags.
        $pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);

        // Add a double line break below block-level closing tags.
        $pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);

        // Standardize newline characters to "\n".
        $pee = str_replace(array("\r\n", "\r"), "\n", $pee);

        // Collapse line breaks before and after <option> elements so they don't get autop'd.
        if (strpos($pee, '<option') !== false) {
            $pee = preg_replace('|\s*<option|', '<option', $pee);
            $pee = preg_replace('|</option>\s*|', '</option>', $pee);
        }

        /*
         * Collapse line breaks inside <object> elements, before <param> and <embed> elements
         * so they don't get autop'd.
         */
        if (strpos($pee, '</object>') !== false) {
            $pee = preg_replace('|(<object[^>]*>)\s*|', '$1', $pee);
            $pee = preg_replace('|\s*</object>|', '</object>', $pee);
            $pee = preg_replace('%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $pee);
        }

        /*
         * Collapse line breaks inside <audio> and <video> elements,
         * before and after <source> and <track> elements.
         */
        if (strpos($pee, '<source') !== false || strpos($pee, '<track') !== false) {
            $pee = preg_replace('%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $pee);
            $pee = preg_replace('%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $pee);
            $pee = preg_replace('%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $pee);
        }

        // Remove more than two contiguous line breaks.
        $pee = preg_replace("/\n\n+/", "\n\n", $pee);

        // Split up the contents into an array of strings, separated by double line breaks.
        $pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);

        // Reset $pee prior to rebuilding.
        $pee = '';


        if ($p) {
            // Rebuild the content as a string, wrapping every bit with a <p>.
            foreach ($pees as $tinkle) {
                $pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
            }

            // Under certain strange conditions it could create a P of entirely whitespace.
            $pee = preg_replace('|<p>\s*</p>|', '', $pee);

            // Add a closing <p> inside <div>, <address>, or <form> tag if missing.
            $pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);

            // If an opening or closing block element tag is wrapped in a <p>, unwrap it.
            $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

            // In some cases <li> may get wrapped in <p>, fix them.
            $pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee);

            // If a <blockquote> is wrapped with a <p>, move it inside the <blockquote>.
            $pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
            $pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);

            // If an opening or closing block element tag is preceded by an opening <p> tag, remove it.
            $pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);

            // If an opening or closing block element tag is followed by a closing <p> tag, remove it.
            $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

        } else{
            // Rebuild the content as a string, wrapping every bit with a <p>.
            foreach ($pees as $tinkle) {
                $pee .= '' . trim($tinkle, "\n") . "\n";
            }
        }
    // Optionally insert line breaks.
    if ( $br ) {
        // Replace newlines that shouldn't be touched with a placeholder.
        $pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);

        // Replace any new line characters that aren't preceded by a <br /> with a <br />.
        $pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee);

        // Replace newline placeholders with newlines.
        $pee = str_replace('<WPPreserveNewline />', "\n", $pee);
    }

    // If a <br /> tag is after an opening or closing block tag, remove it.
    $pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);

    // If a <br /> tag is before a subset of opening or closing block tags, remove it.
    $pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
    $pee = preg_replace( "|\n</p>$|", '</p>', $pee );

    // Replace placeholder <pre> tags with their original content.
    if ( !empty($pre_tags) )
        $pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

    return $pee;
}
endif;

//return an array of members posts
if (!function_exists('fw_get_members_list')) :
    function fw_get_members_list(){
        $posts = get_posts(array('posts_per_page' => 50, 'post_type' => 'fw-member'));
        $result = array();

        if(!empty($posts))
            foreach ( $posts as $post ) {
                $result[ $post->ID ] = $post->post_title;
            }
        return $result;
    }
endif;

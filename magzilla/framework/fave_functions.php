<?php
/* --------------------------------------------------------------------------
 * 1.0 - Check ssl
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_http_or_https' ) ) {
    function fave_http_or_https() {
        if (is_ssl()) {
            $http_or_https = 'https';
        } else {
            $http_or_https = 'http';
        }

        return $http_or_https;
    }
}

/* --------------------------------------------------------------------------
 * 2.0 - Get Item Scope
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_get_item_scope' ) ) {
    function fave_get_item_scope() {

        $fave_review_checkbox = get_post_meta( get_the_ID(), 'fave_review_checkbox', true );

        if ( $fave_review_checkbox == 1 and is_single()) {
            return 'itemscope itemtype="' .  fave_http_or_https() . '://schema.org/Review"';
        } else {
            return 'itemscope itemtype="' .  fave_http_or_https() . '://schema.org/Article"';
        }
    }
}

/* --------------------------------------------------------------------------
 * 3.0 - Get item scope meta
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_get_item_scope_meta' ) ) {
    function fave_get_item_scope_meta() {

        $output = '';


        $author_id = get_the_author_meta( 'ID' );

        $output .= '<meta itemprop="author" content = "' . get_the_author_meta('display_name', $author_id) . '">';

        $author_google_meta = get_the_author_meta('fave_author_google_plus', $author_id);
        if (!empty($author_google_meta)) {
            echo '<a href="' . $author_google_meta . '?rel=author"></a>';
        }

        $fave_review_checkbox = get_post_meta( get_the_ID(), 'fave_review_checkbox', true );
        $fave_summary = get_post_meta( get_the_ID(), 'fave_summary', true );

        $fave_final_score = get_post_meta( get_the_ID(), 'fave_final_score', true );
        $fave_final_score_override = get_post_meta( get_the_ID(), 'fave_final_score_override', true );

        if ( $fave_final_score_override != NULL ) {
            $fave_final_score = $fave_final_score_override;
        }

        $fave_review_final_score = intval($fave_final_score);
        $fave_score_output = $fave_review_final_score /10;


        if ( $fave_review_checkbox == 1 and is_single()) {

            $article_date_unix = get_the_time('U', get_the_ID());

            if ( !empty($fave_summary) ) {
                $output .= '<meta itemprop="about" content = "' . $fave_summary . '">';
            } else {
                $output .= '<meta itemprop="about" content = "' . fave_clean_excerpt( '250', false ) . '">';
            }

            $output .= '<meta itemprop="itemreviewed" content = "' . get_the_title() . '">';
            $output .= '<meta itemprop="datePublished" content="' . date(DATE_W3C, $article_date_unix) . '">';

            $output .= '<span class="favethemes-page-meta" itemprop="reviewRating" itemscope itemtype="' . fave_http_or_https() . '://schema.org/Rating">';
            $output .= '<meta itemprop="worstRating" content = "1">';
            $output .= '<meta itemprop="bestRating" content = "10">';
            $output .= '<meta itemprop="ratingValue" content = "' . $fave_score_output . '">';
            $output .= ' </span>';
        }
        return $output;
    }
}

/* --------------------------------------------------------------------------
 * 4.0 - Comment Walker
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_comments_callback' ) ) {
    function fave_comments_callback( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;

        ?>

        <li <?php comment_class('media'); ?> id="comment-<?php comment_ID(); ?>">

            <div class="comment-body">
                <div class="media-left">
                    <a>
                        <?php echo get_avatar( $comment, 50 ); ?>
                    </a>
                </div>
                <div class="media-body">
                    <div><span class="comment-author"><?php comment_author(); ?></span> <span class="comment-date"><?php printf( __( '%1$s at %2$s', 'magzilla' ), get_comment_date(), get_comment_time() ); ?></span></div>

                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php _e( 'Your comment is awaiting moderation.', 'magzilla' ); ?></em>
                        <br />
                    <?php else: ?>
                        <div class="comment-entry"><?php comment_text(); ?></div>
                    <?php endif; ?>

                    <!-- <a class="reply" href="#">Reply</a> -->
                    <?php edit_comment_link( __( 'Edit', 'magzilla' ), ' ' ); ?>
                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'magzilla' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

                </div>
            </div>


        </li>

        <?php
    }
}

/* -----------------------------------------------------------------------------------------------------------
 * 5.0 - Post thumbnail caption
 -------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_post_thumbnail_caption' ) ) :

    function fave_post_thumbnail_caption() {
        global $post;

        $thumbnail_id    = get_post_thumbnail_id($post->ID);
        $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

        if ($thumbnail_image && isset($thumbnail_image[0])) {
            echo $thumbnail_image[0]->post_excerpt;
        }
    }
endif;

/* -----------------------------------------------------------------------------------------------------------
 * 6.0 - Add user custom fields
 -------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_author_info' ) ) :

    function fave_author_info( $contactmethods ) {

        $contactmethods['fave_author_facebook']      = __( 'Facebook', 'magzilla' );
        $contactmethods['fave_author_linkedin']      = __( 'LinkedIn', 'magzilla' );
        $contactmethods['fave_author_twitter']       = __( 'Twitter', 'magzilla' );
        $contactmethods['fave_author_google_plus']   = __( 'Google Plus', 'magzilla' );
        $contactmethods['fave_author_youtube']       = __( 'Youtube', 'magzilla' );
        $contactmethods['fave_author_flickr']        = __( 'Flickr', 'magzilla' );
        $contactmethods['fave_author_pinterest']     = __( 'Pinterest', 'magzilla' );
        $contactmethods['fave_author_foursquare']    = __( 'FourSquare', 'magzilla' );
        $contactmethods['fave_author_instagram']     = __( 'Instagram', 'magzilla' );
        $contactmethods['fave_author_vimeo']         = __( 'Vimeo', 'magzilla' );
        $contactmethods['fave_author_tumblr']        = __( 'Tumblr', 'magzilla' );
        $contactmethods['fave_author_dribbble']      = __( 'Dribbble', 'magzilla' );

        return $contactmethods;
    }
endif; // add_agent_contact_info
add_filter( 'user_contactmethods', 'fave_author_info', 10, 1 );


if ( !function_exists('fave_get_avatar_url') ) {
    function fave_get_avatar_url($get_avatar){
        preg_match("/src='(.*?)'/i", $get_avatar, $matches);
        return $matches[1];
    }
}

/* -----------------------------------------------------------------------------------------------------------
 * 7.0 - User comments count
 -------------------------------------------------------------------------------------------------------------*/
if ( !function_exists('fave_user_comment_count') ) {

    function fave_user_comment_count( $user_id ) {
        global $wpdb;

        $sql = $wpdb->prepare("SELECT COUNT( * ) AS total FROM {$wpdb->comments} WHERE comment_approved=%d AND user_id = %d;", array( 1, intval($user_id) ) );
        $comment_count = $wpdb->get_var( $sql );

        return $comment_count;
    }

}

/* -----------------------------------------------------------------------------------------------------------
 * 8.0 - Generate Unique ID each elemement
 -------------------------------------------------------------------------------------------------------------*/
if ( !function_exists('fave_element_key') ) {

    function fave_element_key(){

        $key = uniqid();
        return $key;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   9.0 - Get post meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_post_meta' ) ):
    function fave_get_post_meta( $post_id, $field = false ) {

        $defaults = array(
            'fave_use_sidebar' => 'none',
            'fave_sidebar' => 'default-sidebar',
            'sticky_sidebar' => '',
            'fave_article_list_use_sidebar' => 'none',
            'fave_article_list_sidebar' => 'default-sidebar',
            'articles_layout'       => 'module-default',
            'blog_title'   => 'hide_title',
            'custom_title' => '',
            'title_bg_color' => '',
            'title_text_color' => '',
            'title_border_color' => '',

            'post_layout'  => 'a',
            'fave_post_sidebar' => 'right',
            'source_name' => '',
            'source_url' => '',

            'category_id'  => '',
            'category_ids' => '',
            'tag_slug'     => '',
            'sort'         => '',
            'autors_id'    => '',
            'featured_posts'  => '',
            'posts_limit'   => '',
            'offset'        => '',
            'posts_excerpt' => 'enable',
            'pagination_style' => ''
        );

        $meta = get_post_meta( $post_id, '_favethemes_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   10.0 - Get video post type meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_video_post_type_meta' ) ):
    function fave_get_video_post_type_meta( $post_id, $field = false ) {

        $defaults = array(
            'post_layout' => 'a',
            'fave_use_sidebar' => 'none',
            'fave_sidebar' => 'video-sidebar',
            'sticky_sidebar' => ''

        );

        $meta = get_post_meta( $post_id, '_favethemes_video_posttype_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   11.0 - Get gallery post type meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_gallery_post_type_meta' ) ):
    function fave_get_gallery_post_type_meta( $post_id, $field = false ) {

        $defaults = array(
            'fave_use_sidebar' => 'right',
            'fave_sidebar' => 'gallery-sidebar',
            'sticky_sidebar' => '',
            'post_layout' => 'a'

        );

        $meta = get_post_meta( $post_id, '_favethemes_gallery_posttype_meta', true );
        $meta = wp_parse_args( (array) $meta, $defaults );

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   12.0 - Sort
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_sort' ) ):
    function fave_get_sort( ) {

        $sort = array();

        $sort[''] = array( 'title' => __( '- Latest -', 'magzilla' ) );
        $sort['random_today'] = array( 'title' => __( 'Random posts Today', 'magzilla' ) );
        $sort['random_7_day'] = array( 'title' => __( 'Random posts from last 7 Day', 'magzilla' ) );

        $sort['alphabetical_order'] = array( 'title' => __( 'Alphabetical A -> Z', 'magzilla' ) );
        $sort['popular'] = array( 'title' => __( 'Popular (all time)', 'magzilla' ) );
        $sort['review_high'] = array( 'title' => __( 'Highest rated (reviews)', 'magzilla' ) );
        $sort['random_posts'] = array( 'title' => __( 'Random Posts', 'magzilla' ) );
        $sort['comment_count'] = array( 'title' => __( 'Most Commented', 'magzilla' ) );

        return $sort;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   13.0 - Get excerpt with limit and read more on/off
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fave_clean_excerpt' ) ) {
    function fave_clean_excerpt ($fave_characters, $fave_read_more = false) {
        global $post;
        $fave_excerpt_output = $post->post_excerpt;

        if ( $fave_excerpt_output == NULL ) {

            $fave_excerpt_output = get_the_content();
            $fave_excerpt_output = preg_replace(" (\[.*?\])",'',$fave_excerpt_output);
            $fave_excerpt_output = strip_shortcodes($fave_excerpt_output);
            $fave_excerpt_output = strip_tags($fave_excerpt_output);
            $fave_characters = intval($fave_characters);
            $fave_excerpt_output = substr( $fave_excerpt_output, 0, $fave_characters );
            $fave_excerpt_output = substr( $fave_excerpt_output, 0, strripos($fave_excerpt_output, " ") );
            $fave_excerpt_output = trim( preg_replace( '/\s+/', ' ', $fave_excerpt_output) );

            if ( $fave_read_more != "false" ) {
                $fave_excerpt_output = $fave_excerpt_output.'. <a class="continue-reading" href="'. get_permalink() .'">'.__( "Continue reading", "magzilla").' <i class="fa fa-angle-double-right"></i></a>';
            } else {
                $fave_excerpt_output = $fave_excerpt_output . '...';
            }
        }

        return $fave_excerpt_output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   14.0 - Generates a category tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fave_featured_image' ) ) {
    function fave_featured_image( $post_id, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {

        $thumb_id = get_post_thumbnail_id($post_id);
        $image_url = wp_get_attachment_url($thumb_id);

        $thumbnail = fave_aq_resize( $image_url, $width, $height, $crop, $single, $upscale );

        return $thumbnail;

    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   15.0 - Generates a category tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */
if ( ! function_exists( 'fave_get_category_id_array' ) ) {
    function fave_get_category_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0
        ));

        $fave_category_id_array_walker = new fave_category_id_array_walker;
        $fave_category_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                $fave_category_id_array_walker->fave_array_buffer
            );
        } else {
            return $fave_category_id_array_walker->fave_array_buffer;
        }
    }
}

class fave_category_id_array_walker extends Walker {
    var $tree_type = 'category';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $fave_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->fave_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   16.0 - Generates a video post type category tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'fave_get_video_category_id_array' ) ) {
    function fave_get_video_category_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'video-categories',
        ));

        $fave_video_category_id_array_walker = new fave_video_category_id_array_walker;
        $fave_video_category_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                $fave_video_category_id_array_walker->fave_array_buffer
            );
        } else {
            return $fave_video_category_id_array_walker->fave_array_buffer;
        }
    }
}

class fave_video_category_id_array_walker extends Walker {
    var $tree_type = 'video-categories';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $fave_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->fave_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   17.0 - Generates a gallery post type category tree
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */

/**
 *
 * @param bool $add_all_category = if true ads - All categories - at the begining of the list (used for dropdowns)
 * @return mixed
 */

if ( ! function_exists( 'fave_get_gallery_category_id_array' ) ) {
    function fave_get_gallery_category_id_array($add_all_category = true) {



        if (is_admin() === false) {
            return;
        }

        $categories = get_categories(array(
            'hide_empty' => 0,
            'taxonomy'   => 'gallery-categories',
        ));

        $fave_gallery_category_id_array_walker = new fave_gallery_category_id_array_walker;
        $fave_gallery_category_id_array_walker->walk($categories, 4);

        if ($add_all_category === true) {
            $categories_buffer['- All categories -'] = '';
            return array_merge(
                $categories_buffer,
                $fave_gallery_category_id_array_walker->fave_array_buffer
            );
        } else {
            return $fave_gallery_category_id_array_walker->fave_array_buffer;
        }
    }
}

class fave_gallery_category_id_array_walker extends Walker {
    var $tree_type = 'gallery-categories';
    var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

    var $fave_array_buffer = array();

    function start_lvl( &$output, $depth = 0, $args = array() ) {
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
    }


    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        $this->fave_array_buffer[str_repeat(' - ', $depth) .  $category->name] = $category->term_id;
    }


    function end_el( &$output, $page, $depth = 0, $args = array() ) {
    }

}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   18.0 - create $fave_authors array in format id_author => display_name_author
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @return array id_author => display_name_author
 */
if ( ! function_exists( 'fave_create_array_authors' ) ) {
    function fave_create_array_authors() {

        if (is_admin()) {

            $fave_authors = array();
            $fave_return_obj_authors = get_users('role=Administrator');

            $fave_authors[' - No author filter - '] = '';
            foreach($fave_return_obj_authors as $obj_autor){
                $auth_id = $obj_autor->ID;
                $auth_name = $obj_autor->display_name;

                $fave_authors[$auth_name] = $auth_id;
            }

            return $fave_authors;
        }
    }
}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   19.0 - Used by blocks that need auto generated titles
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_block_title' ) ) {
    function fave_get_block_title($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'header_color' => '',
                'header_text_color' => '',
                'header_border_color' => '',
                'title_style' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id) and empty($category_ids)) {
            $category_ids = $category_id;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color) and $header_text_color != '#') {
            $block_header_text_color_css = ' color:' . $header_text_color . ' !important;';
        }

        if (!empty($header_color) and $header_color != '#') {
            $block_header_color_css = ' background-color:' . $header_color . ';';
        }

        if (!empty($header_border_color) and $header_border_color != '#') {
            $block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color . ';';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids)) {

            $cat_id_array = explode (',', $category_ids);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_category($cat_id);

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_category_link( $fave_tmp_cat_obj->cat_ID );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id.' pull-left">';

        if( empty( $custom_title ) ) {

            if (empty($custom_url)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .$fave_category_block_name. '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url ).'">' .$fave_category_block_name. '</a>';
            }

        } else {

            if (empty($custom_url)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.'>' . esc_attr( $custom_title ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url ) . '">' . esc_attr( $custom_title ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   20.0 - Used by Video Post Type blocks that need auto generated titles
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_video_block_title' ) ) {

    function fave_get_video_block_title($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => 5,
                'sort' => '',
                'category_id' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'header_color' => '',
                'header_text_color' => '',
                'header_border_color' => '',
                'title_style' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id) and empty($category_ids)) {
            $category_ids = $category_id;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color) and $header_text_color != '#') {
            $block_header_text_color_css = ' color:' . $header_text_color . ' !important;';
        }

        if (!empty($header_color) and $header_color != '#') {
            $block_header_color_css = ' background-color:' . $header_color . ';';
        }

        if (!empty($header_border_color) and $header_border_color != '#') {
            $block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color . ';';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids)) {

            $cat_id_array = explode (',', $category_ids);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_term($cat_id, 'video-categories');

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_term_link( $fave_tmp_cat_obj->term_id, 'video-categories' );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id.' pull-left">';

        if( empty( $custom_title ) ) {

            if (empty($custom_url)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .esc_attr( $fave_category_block_name ) . '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url ).'">' .esc_attr( $fave_category_block_name ). '</a>';
            }

        } else {

            if (empty($custom_url)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.'>' . esc_attr( $custom_title ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url ) . '">' . esc_attr( $custom_title ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   21.0 - Used by Gallery Post Type blocks that need auto generated titles
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_gallery_block_title' ) ) {
    function fave_get_gallery_block_title($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => 5,
                'sort' => '',
                'category_id' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'header_color' => '',
                'header_text_color' => '',
                'header_border_color' => '',
                'title_style' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id) and empty($category_ids)) {
            $category_ids = $category_id;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color) and $header_text_color != '#') {
            $block_header_text_color_css = ' color:' . $header_text_color . ' !important;';
        }

        if (!empty($header_color) and $header_color != '#') {
            $block_header_color_css = ' background-color:' . $header_color . ';';
        }

        if (!empty($header_border_color) and $header_border_color != '#') {
            $block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color . ';';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids)) {

            $cat_id_array = explode (',', $category_ids);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_term($cat_id, 'gallery-categories');

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_term_link( $fave_tmp_cat_obj->term_id, 'gallery-categories' );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id.' pull-left">';

        if( empty( $custom_title ) ) {

            if (empty($custom_url)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .esc_attr( $fave_category_block_name ) . '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url ).'">' .esc_attr( $fave_category_block_name ). '</a>';
            }

        } else {

            if (empty($custom_url)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.'>' . esc_attr( $custom_title ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url ) . '">' . esc_attr( $custom_title ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   22.0 - Get Block Sub Categories
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */

if ( ! function_exists( 'fave_get_block_sub_cats' ) ) {
    function fave_get_block_sub_cats($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => '',
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '', //if empty, no child cats. If number show the number of child cats. If all show all of them ;)
                'header_color' => ''
            ),$atts));


        $output = '';

        if (!empty($show_child_cat) and !empty($category_id)) {

            $fave_sub_cats = get_categories(array('child_of' => $category_id));



            if (!empty($fave_sub_cats)) {
                if ($show_child_cat != 'all') {
                    $fave_sub_cats = array_slice($fave_sub_cats, 0, $show_child_cat);
                }

                $output .= '<ul class="module-top-topics list-inline pull-right hidden-sm hidden-xs">';

                $output .= '<li>'.__( 'Related Topics:', 'magzilla' ).'</li>';


                //show the rest of the subcategories
                foreach ($fave_sub_cats as $cat ) {

                    $output .= '<li><a href="' . get_category_link($cat->cat_ID) . '" >' . $cat->name . '</a></li><!-- <li>|</li> -->';


                }

                $output .= '</ul>';
            }
        }


        return $output;
    }
}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   23.0 - Get Block Sub Categories list
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_block_sub_cats_list' ) ) {
    function fave_get_block_sub_cats_list($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => '',
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '', //if empty, no child cats. If number show the number of child cats. If all show all of them ;)

                'header_color' => ''
            ),$atts));


        $output = '';

        if (!empty($show_child_cat) and !empty($category_id)) {

            $fave_sub_cats = get_categories(array('child_of' => $category_id));



            if (!empty($fave_sub_cats)) {
                if ($show_child_cat != 'all') {
                    $fave_sub_cats = array_slice($fave_sub_cats, 0, $show_child_cat);
                }

                $output .= '<ul class="module-top-topics list-unstyled hidden-sm hidden-xs">';

                $output .= '<li>'.__( 'Related Topics:', 'magzilla' ).'</li>';

                //show the rest of the subcategories
                foreach ($fave_sub_cats as $cat ) {


                    $output .= '<li><a href="' . get_category_link($cat->cat_ID) . '" >' . $cat->name . '</a></li>';


                }


                $output .= '</ul>';
            }
        }


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   24.0 - Get Video Post Type Block Sub Categories
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */

if ( ! function_exists( 'fave_get_video_block_sub_cats' ) ) {
    function fave_get_video_block_sub_cats($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => '',
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '', //if empty, no child cats. If number show the number of child cats. If all show all of them ;)
                'header_color' => ''
            ),$atts));


        $output = '';

        if (!empty($show_child_cat) and !empty($category_id)) {


            // no default values. using these as examples
            $taxonomies = array( 'video-categories');

            $args = array( 'child_of' => $category_id);

            $fave_sub_cats = get_terms($taxonomies, $args);

            if (!empty($fave_sub_cats)) {
                if ($show_child_cat != 'all') {
                    $fave_sub_cats = array_slice($fave_sub_cats, 0, $show_child_cat);
                }

                $output .= '<ul class="module-top-topics list-inline pull-right hidden-sm hidden-xs">';

                $output .= '<li>'.__( 'Related Topics:', 'magzilla' ).'</li>';


                //show the rest of the subcategories
                foreach ($fave_sub_cats as $term ) {

                    // The $term is an object, so we don't need to specify the $taxonomy.
                    $term_link = get_term_link( $term );

                    // If there was an error, continue to the next term.
                    if ( is_wp_error( $term_link ) ) {
                        continue;
                    }

                    $output .= '<li><a href="' . esc_url( $term_link ) . '" >' . $term->name . '</a></li><!-- <li>|</li> -->';


                }


                $output .= '</ul>';
            }
        }


        return $output;
    }
}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   25.0 - Get Gallery Post Type Block Sub Categories
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_gallery_block_sub_cats' ) ) {
    function fave_get_gallery_block_sub_cats($atts) {
        extract(shortcode_atts(
            array(
                'post_limit' => '',
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '', //if empty, no child cats. If number show the number of child cats. If all show all of them ;)

                'header_color' => ''
            ),$atts));


        $output = '';

        if (!empty($show_child_cat) and !empty($category_id)) {


            // no default values. using these as examples
            $taxonomies = array( 'gallery-categories');

            $args = array( 'child_of' => $category_id);

            $fave_sub_cats = get_terms($taxonomies, $args);

            if (!empty($fave_sub_cats)) {
                if ($show_child_cat != 'all') {
                    $fave_sub_cats = array_slice($fave_sub_cats, 0, $show_child_cat);
                }

                $output .= '<ul class="module-top-topics list-inline pull-right hidden-sm hidden-xs">';

                $output .= '<li>'.__( 'Related Topics:', 'magzilla' ).'</li>';


                //show the rest of the subcategories
                foreach ($fave_sub_cats as $term ) {

                    // The $term is an object, so we don't need to specify the $taxonomy.
                    $term_link = get_term_link( $term );

                    // If there was an error, continue to the next term.
                    if ( is_wp_error( $term_link ) ) {
                        continue;
                    }

                    $output .= '<li><a href="' . esc_url( $term_link ) . '" >' . $term->name . '</a></li><!-- <li>|</li> -->';


                }


                $output .= '</ul>';
            }
        }


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   26.0 - Used by blocks that need auto generated titles for column 1
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_block_title_column_one' ) ) {
    function fave_get_block_title_column_one($atts) {
        extract(shortcode_atts(
            array(
                'category_id_1' => '',
                'category_ids_1' => '',
                'custom_title_1' => '',
                'custom_url_1' => '',
                'hide_title_1' => '',
                'header_color_1' => '',
                'header_text_color_1' => '',
                'header_border_color_1' => '',
                'title_style_1' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id_1) and empty($category_ids_1)) {
            $category_ids_1 = $category_id_1;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color_1) and $header_text_color_1 != '#') {
            $block_header_text_color_css = '; color:' . $header_text_color_1 . ' !important';
        }

        if (!empty($header_color_1) and $header_color_1 != '#') {
            $block_header_color_css = '; background-color:' . $header_color_1 . '';
        }

        if (!empty($header_border_color_1) and $header_border_color_1 != '#') {
            $block_header_border_color_css = '; border-top: 5px solid ' . $header_border_color_1 . '';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids_1)) {

            $cat_id_array = explode (',', $category_ids_1);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_category($cat_id);

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_category_link( $fave_tmp_cat_obj->cat_ID );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id_1.' pull-left">';

        if( empty( $custom_title_1 ) ) {

            if (empty($custom_url_1)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .$fave_category_block_name. '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url_1 ).'">' .$fave_category_block_name. '</a>';
            }

        } else {

            if (empty($custom_url_1)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.' >' . esc_attr( $custom_title_1 ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title_1 ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url_1 ) . '">' . esc_attr( $custom_title_1 ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   27.0 - Used by blocks that need auto generated titles for column 2
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_block_title_column_two' ) ) {
    function fave_get_block_title_column_two($atts) {
        extract(shortcode_atts(
            array(
                'category_id_2' => '',
                'category_ids_2' => '',
                'custom_title_2' => '',
                'custom_url_2' => '',
                'hide_title_2' => '',
                'header_color_2' => '',
                'header_text_color_2' => '',
                'header_border_color_2' => '',
                'title_style_2' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id_2) and empty($category_ids_2)) {
            $category_ids_2 = $category_id_2;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color_2) and $header_text_color_2 != '#') {
            $block_header_text_color_css = ' color:' . $header_text_color_2 . ' !important;';
        }

        if (!empty($header_color_2) and $header_color_2 != '#') {
            $block_header_color_css = ' background-color:' . $header_color_2 . ';';
        }

        if (!empty($header_border_color_2) and $header_border_color_2 != '#') {
            $block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color_2 . ';';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids_2)) {

            $cat_id_array = explode (',', $category_ids_2);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_category($cat_id);

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_category_link( $fave_tmp_cat_obj->cat_ID );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id_2.' pull-left">';

        if( empty( $custom_title_2 ) ) {

            if (empty($custom_url_2)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .$fave_category_block_name. '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url_2 ).'">' .$fave_category_block_name. '</a>';
            }

        } else {

            if (empty($custom_url_2)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.' >' . esc_attr( $custom_title_2 ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title_2 ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url_2 ) . '">' . esc_attr( $custom_title_2 ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   28.0 - Used by blocks that need auto generated titles for column 3
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   @param $atts
 *   @return string
 */
if ( ! function_exists( 'fave_get_block_title_column_three' ) ) {
    function fave_get_block_title_column_three($atts) {
        extract(shortcode_atts(
            array(
                'category_id_3' => '',
                'category_ids_3' => '',
                'custom_title_3' => '',
                'custom_url_3' => '',
                'hide_title_3' => '',
                'header_color_3' => '',
                'header_text_color_3' => '',
                'header_border_color_3' => '',
                'title_style_3' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id_3) and empty($category_ids_3)) {
            $category_ids_3 = $category_id_3;
        }


        //custom colors
        $block_header_color_css = '';
        $block_header_border_color_css = '';
        $block_header_text_color_css = '';


        if (!empty($header_text_color_3) and $header_text_color_3 != '#') {
            $block_header_text_color_css = ' color:' . $header_text_color_3 . ' !important;';
        }

        if (!empty($header_color_3) and $header_color_3 != '#') {
            $block_header_color_css = ' background-color:' . $header_color_3 . ';';
        }

        if (!empty($header_border_color_3) and $header_border_color_3 != '#') {
            $block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color_3 . ';';
        }

        //append to the color_css the border color
        if (!empty($block_header_border_color_css)) {
            $block_header_color_css .= $block_header_border_color_css;
        }

        //append to the color_css the text color
        if (!empty($block_header_text_color_css)) {
            $block_header_color_css .= $block_header_text_color_css;
        }

        //wrap the header css
        if (!empty($block_header_color_css)) {
            $block_header_color_css = 'style="' . $block_header_color_css . '" ';
        }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $fave_category_block_name = '';
        $fave_category_block_link = '';

        if (!empty($category_ids_3)) {

            $cat_id_array = explode (',', $category_ids_3);

            foreach ($cat_id_array as &$cat_id) {

                $cat_id = trim($cat_id);

                //get the category object
                $fave_tmp_cat_obj =  get_category($cat_id);

                if (empty($fave_category_block_name)) {

                    if (!empty($fave_tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $fave_category_block_link = get_category_link( $fave_tmp_cat_obj->cat_ID );
                        $fave_category_block_name = mb_strtoupper( $fave_tmp_cat_obj->name );
                    }
                } else {
                    $fave_category_block_name = $fave_category_block_name . ' - ' . mb_strtoupper($fave_tmp_cat_obj->name);
                }
                unset($fave_tmp_cat_obj);
            }
        }


        // Start title

        $output = '';

        $output .= '<div class="module-category module-title-color-'.$category_id_3.' pull-left">';

        if( empty( $custom_title_3 ) ) {

            if (empty($custom_url_3)) {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $fave_category_block_link ).'">' .$fave_category_block_name. '</a>';
            } else {
                $output .= '<a '.$block_header_color_css.' href="'.esc_url( $custom_url_3 ).'">' .$fave_category_block_name. '</a>';
            }

        } else {

            if (empty($custom_url_3)) {

                if (empty($fave_category_block_link)) {
                    $output .= '<a '.$block_header_color_css.' >' . esc_attr( $custom_title_3 ) . '</a>';
                } else {
                    //url is present
                    $output .= '<a '.$block_header_color_css.' href="' . esc_url( $fave_category_block_link ) . '">' . esc_attr( $custom_title_3 ) . '</a>';
                }
            } else {
                //custom url + custom title
                $output .= '<a '.$block_header_color_css.' href="' . esc_url( $custom_url_3 ) . '">' . esc_attr( $custom_title_3 ) . '</a>';
            }
        }

        $output .= '</div>';


        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   29.0 - Generate Unique ID each elemement
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists('fave_element_key') ) {

    function fave_element_key(){

        $key = uniqid();
        return $key;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   30.0 - Get all registered sidebars
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if( !function_exists('fave_sidebars') ) {
    function fave_sidebars() {
        global $wp_registered_sidebars;
        $all_sidebars = array();
        if ( $wp_registered_sidebars && ! is_wp_error( $wp_registered_sidebars ) ) {

            foreach ( $wp_registered_sidebars as $sidebar ) {
                $all_sidebars[ $sidebar['id'] ] = $sidebar['name'];
            }

        }else{
            $error_string = $wp_registered_sidebars[0]->get_error_message();
            echo $error_string; die;
        }
        return $all_sidebars;
    }
}




/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   31.0 - Get category meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_category_meta' ) ):
    function fave_get_category_meta( $cat_id = false, $field = false ) {
        $defaults = array(
            'layout' => 'module-default',
            'p_excerpt' => 'enable',
            'use_sidebar' => 'right',
            'sidebar' => 'category-sidebar',
            'sticky_sidebar' => '',
            'show_child_cat' => '',
            'pagination' => 'numeric',
            'color_type' => 'inherit',
            'color' => '#000000',
            'ppp' => ''
        );

        if ( $cat_id ) {
            $meta = get_option( '_fave_category_'.$cat_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   32.0 - Get video category meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_video_category_meta' ) ):
    function fave_get_video_category_meta( $cat_id = false, $field = false ) {
        $defaults = array(
            'use_sidebar' => 'right',
            'sidebar' => 'video-sidebar',
            'pagination' => 'numeric',
            'color_type' => 'inherit',
            'color' => '#346D87',
            'ppp' => ''
        );

        if ( $cat_id ) {
            $meta = get_option( '_fave_video_category_'.$cat_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   33.0 - Get gallery category meta with default values
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_gallery_category_meta' ) ):
    function fave_get_gallery_category_meta( $cat_id = false, $field = false ) {
        $defaults = array(
            'use_sidebar' => 'right',
            'sidebar' => 'gallery-sidebar',
            'pagination' => 'numeric',
            'color_type' => 'inherit',
            'color' => '#346D87',
            'ppp' => ''
        );

        if ( $cat_id ) {
            $meta = get_option( '_fave_gallery_category_'.$cat_id );
            $meta = wp_parse_args( (array) $meta, $defaults );
        } else {
            $meta = $defaults;
        }

        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   34.0 - Cache recently used category colors
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_update_recent_cat_colors' ) ):
    function fave_update_recent_cat_colors( $color, $num_col = 10 ) {
        if ( empty( $color ) )
            return false;

        $current = get_option( 'fave_recent_cat_colors' );
        if ( empty( $current ) ) {
            $current = array();
        }

        $update = false;

        if ( !in_array( $color, $current ) ) {
            $current[] = $color;
            if ( count( $current ) > $num_col ) {
                $current = array_slice( $current, ( count( $current ) - $num_col ), ( count( $current ) - 1 ) );
            }
            $update = true;
        }

        if ( $update ) {
            update_option( 'fave_recent_cat_colors', $current );
        }

    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   35.0 - Store color per each category
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_update_cat_colors' ) ):
    function fave_update_cat_colors( $cat_id, $color, $type ) {

        $colors = (array)get_option( 'fave_cat_colors' );

        if ( array_key_exists( $cat_id, $colors ) ) {

            if ( $type == 'inherit' ) {
                unset( $colors[$cat_id] );
            } elseif ( $colors[$cat_id] != $color ) {
                $colors[$cat_id] = $color;
            }

        } else {

            if ( $type != 'inherit' ) {
                $colors[$cat_id] = $color;
            }
        }

        update_option( 'fave_cat_colors', $colors );

    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   36.0 - Get sidebar layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_sidebar_layouts' ) ):
    function fave_get_sidebar_layouts( ) {

        $layouts = array();

        $layouts['none'] = array( 'title' => __( 'No sidebar (full width)', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/content_no_sid.png' );
        $layouts['left'] = array( 'title' => __( 'Left sidebar', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/content_sid_left.png' );
        $layouts['right'] = array( 'title' => __( 'Right sidebar', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/content_sid_right.png' );

        return $layouts;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   37.0 - Compares two values and sanitazes 0
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_compare' ) ):
    function fave_compare( $a, $b ) {
        return (string) $a === (string) $b;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   38.0 - Get main post layouts layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_main_layouts' ) ):
    function fave_get_main_layouts( $default = false ) {

        if ( $default ) {
            $layouts['module-default'] = array( 'title' => __( 'Inherit', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/inherit.png' );
        }

        $layouts['module-a'] = array( 'title' => __( 'Layout A', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_a.png' );
        $layouts['module-a-b'] = array( 'title' => __( 'Layout A-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_b.png' );
        $layouts['module-b'] = array( 'title' => __( 'Layout B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_c.png' );
        $layouts['module-b-b'] = array( 'title' => __( 'Layout B-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_d.png' );
        $layouts['module-c'] = array( 'title' => __( 'Layout C', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_e.png' );
        $layouts['module-c-b'] = array( 'title' => __( 'Layout C-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_f.png' );
        $layouts['module-d'] = array( 'title' => __( 'Layout D', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_g.png' );
        $layouts['module-e'] = array( 'title' => __( 'Layout E', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_h.png' );
        $layouts['module-f'] = array( 'title' => __( 'Layout F', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_i.png' );
        $layouts['module-g'] = array( 'title' => __( 'Layout G', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_l.png' );
        $layouts['module-h'] = array( 'title' => __( 'Layout H', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_m.png' );
        $layouts['module-i'] = array( 'title' => __( 'Layout I', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_ii.png' );

        return $layouts;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   39.0 - Get Blog post layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_blog_layouts' ) ):
    function fave_get_blog_layouts( $default = false ) {

        if ( $default ) {
            $layouts['module-default'] = array( 'title' => __( 'Inherit', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/inherit.png' );
        }

        $layouts['module-a'] = array( 'title' => __( 'Layout A', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_a.png' );
        $layouts['module-a-b'] = array( 'title' => __( 'Layout A-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_b.png' );
        $layouts['module-b'] = array( 'title' => __( 'Layout B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_c.png' );
        $layouts['module-b-b'] = array( 'title' => __( 'Layout B-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_d.png' );
        $layouts['module-c'] = array( 'title' => __( 'Layout C', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_e.png' );
        $layouts['module-c-b'] = array( 'title' => __( 'Layout C-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_f.png' );
        $layouts['module-d'] = array( 'title' => __( 'Layout D', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_g.png' );
        $layouts['module-d-b'] = array( 'title' => __( 'Layout D', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_i.png' );
        $layouts['module-e'] = array( 'title' => __( 'Layout E', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_h.png' );
        $layouts['module-f'] = array( 'title' => __( 'Layout F', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_l.png' );
        $layouts['module-h'] = array( 'title' => __( 'Layout H', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_m.png' );
        $layouts['module-i'] = array( 'title' => __( 'Layout I', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_ii.png' );

        return $layouts;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   40.0 - Get post layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_post_layouts' ) ):
    function fave_get_post_layouts( $default = false ) {

        if ( $default ) {
            $layouts['a'] = array( 'title' => __( 'Layout A', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-a.png' );
        }
        $layouts['d'] = array( 'title' => __( 'Layout D', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-d.png' );
        $layouts['b'] = array( 'title' => __( 'Layout B', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-b.png' );
        $layouts['c'] = array( 'title' => __( 'Layout C', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-c.png' );
        $layouts['e'] = array( 'title' => __( 'Layout E', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-e.png' );
        $layouts['f'] = array( 'title' => __( 'Layout F', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-f.png' );

        return $layouts;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   41.0 - Get Gallery post layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_gallery_layouts' ) ):
    function fave_get_gallery_layouts( $default = false ) {

        if ( $default ) {
            $layouts['a'] = array( 'title' => __( 'Inherit', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-0.png' );
        }
        $layouts['b'] = array( 'title' => __( 'Layout C', 'magzilla' ), 'img' => FAVE_IMAGES . '/post-templates/layout-3.png' );


        return $layouts;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   42.0 - Get all sidebars
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_sidebars_list' ) ):
    function fave_get_sidebars_list() {

        $sidebars = array();

        global $wp_registered_sidebars;

        if ( !empty( $wp_registered_sidebars ) ) {

            foreach ( $wp_registered_sidebars as $sidebar ) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }

        }
        unset( $sidebars['top-footer'] );

        return $sidebars;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   43.0 - Get main post layouts layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_pagination' ) ):
    function fave_get_pagination( $default = false ) {

        if ( $default ) {
            $layouts['inherit'] = array( 'title' => __( 'Inherit ( Theme Options )', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/inherit.png' );
        }

        $layouts['prev-next'] = array( 'title' => __( 'Prev/Next page links', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/pagination_style_1.png' );
        $layouts['numeric'] = array( 'title' => __( 'Numeric pagination links', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/pagination_style_2.png' );
        $layouts['load-more'] = array( 'title' => __( 'Load more button', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/pagination_style_3.png' );
        /*$layouts['infinite-scroll'] = array( 'title' => __( 'Infinite scroll', 'magzilla' ), 'img' => IMAGES . '/admin/pagination_style_4.png' );*/

        return $layouts;
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   44.0 - Get Excerpt
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_cat_excerpt' ) ):
    function fave_get_cat_excerpt() {

        $excerpt['enable'] = array( 'title' => __( 'Enable', 'magzilla' ) );
        $excerpt['disable'] = array( 'title' => __( 'Disable', 'magzilla' ) );


        return $excerpt;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   45.0 - fave_show_child_cat
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_show_child_cat' ) ):
    function fave_show_child_cat() {

        $data[''] = array( 'title' => __( 'Hide', 'magzilla' ) );
        $data['1'] = array( 'title' => __( 'Show 1 category', 'magzilla' ) );
        $data['2'] = array( 'title' => __( 'Show 2 categories', 'magzilla' ) );
        $data['3'] = array( 'title' => __( 'Show 3 categories', 'magzilla' ) );
        $data['4'] = array( 'title' => __( 'Show 4 categories', 'magzilla' ) );
        $data['5'] = array( 'title' => __( 'Show 5 categories', 'magzilla' ) );
        $data['6'] = array( 'title' => __( 'Show 6 categories', 'magzilla' ) );
        $data['7'] = array( 'title' => __( 'Show 7 categories', 'magzilla' ) );
        $data['8'] = array( 'title' => __( 'Show 8 categories', 'magzilla' ) );
        $data['all'] = array( 'title' => __( 'Show All', 'magzilla' ) );

        return $data;
    }
endif;


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   46.0 - Add prev and next links to a numbered link list - the pagination on single.
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
function fave_link_pages_args_prevnext_add($args)
{
    global $page, $numpages, $more, $pagenow;

    if (!$args['next_or_number'] == 'next_and_number')
        return $args; # exit early

    $args['next_or_number'] = 'number'; # keep numbering for the main part
    if (!$more)
        return $args; # exit early

    if($page-1) # there is a previous page
        $args['before'] .= _wp_link_page($page-1)
            . $args['link_before']. $args['previouspagelink'] . $args['link_after'] . '</a>'
        ;

    if ($page<$numpages) # there is a next page
        $args['after'] = _wp_link_page($page+1)
            . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>'
            . $args['after']
        ;

    return $args;
}
add_filter('wp_link_pages_args', 'fave_link_pages_args_prevnext_add');


/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   47.0 - Include simple pagination
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_pagination' ) ):
    function fave_pagination() {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        $pagination = array(
            'base' => @add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'prev_text' => __( '<i class="fa fa-angle-double-left"></i> Prev', 'magzilla' ),
            'next_text' => __( 'Next <i class="fa fa-angle-double-right"></i>', 'magzilla' ),
            'type' => 'array'
        );
        if ( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        if ( !empty( $wp_query->query_vars['s'] ) )
            $pagination['add_args'] = array( 's' => str_replace( ' ', '+', get_query_var( 's' ) ) );

        $links = paginate_links( $pagination );

        if( is_array( $links ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="pagination pull-left"><ul class="list-inline">';

            foreach ( $links as $link ) {
                echo "<li>$link</li>";
            }
            echo '</ul></div>';

            echo '<div class="pagination page-number pull-right"><span>'.__( 'Page', 'magzilla' ).' '. $paged . '</span> '.__( 'of', 'magzilla' ).' ' . $wp_query->max_num_pages .' </div>';
        }
    }
endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   49.0 - fave_custom_gallery_settings_hook
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_custom_gallery_settings_hook' ) ):

    function fave_custom_gallery_settings_hook () {?>

        <script type="text/html" id="tmpl-favethemes-custom-gallery-setting">
            <label class="setting">
                <span><?php _e('Gallery Type', 'magzilla' ); ?></span>
                <select data-setting="favethemes_select_gallery_slide">
                    <option value="">Default </option>
                    <option value="slide">Favethemes Slide Gallery</option>
                </select>
            </label>

            <label class="setting">
                <span><?php _e('Gallery Title', 'magzilla' ); ?></span>
                <input type="text" value="" data-setting="favethemes_gallery_title_input" />
            </label>
        </script>

        <script>

            jQuery(document).ready(function(){

                _.extend(wp.media.gallery.defaults, {
                    favethemes_select_gallery_slide: '', favethemes_gallery_title_input: ''
                });

                wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                    template: function(view){
                        return wp.media.template('gallery-settings')(view)
                            + wp.media.template('favethemes-custom-gallery-setting')(view);
                    }
                });

            });

        </script>
        <?php
    }
//custom gallery setting
    add_action('print_media_templates', 'fave_custom_gallery_settings_hook');

endif;

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   50.0 - Gallery Shortcode
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
function fave_gallery_shortcode( $output = '', $atts, $content = false, $tag = false ) {

    ob_start();
    //check for gallery  = slide
    if(!empty($atts) and !empty($atts['favethemes_select_gallery_slide']) and $atts['favethemes_select_gallery_slide'] == 'slide') {

        $image_ids = explode(',', $atts['ids']);

        //check to make sure we have images
        if (count($image_ids) == 1 and !is_numeric($image_ids[0])) {
            return;
        }

        $image_ids = array_map('trim', $image_ids);//trim elements of the $ids_gallery array

        //generate unique gallery slider id
        $gallery_slider_unique_id = fave_unique_key();
        ?>


        <script>
            jQuery(document).ready( function($) {
                $('.magzilla-popup-<?php echo $gallery_slider_unique_id; ?>').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    gallery:{
                        enabled:true
                    }
                });
            });
         </script>

        <div class="post-gallery-wrap">
            <div class="post-gallery">
                <div class="post-gallery-top">
                    <div class="post-gallery-title">
                        <i class="fa fa-picture-o"></i> <?php if( isset( $atts['favethemes_gallery_title_input'] ) ) { echo $atts['favethemes_gallery_title_input']; } ?>
                    </div>
                </div>
                <div class="post-gallery-body">
                    <!-- big images -->
                    <div id="sync1-<?php echo $gallery_slider_unique_id; ?>" class="owl-carousel images-owl-carousel">

                        <?php foreach($image_ids as $image_id) { ?>

                            <?php $slide_big_img = wp_get_attachment_image_src($image_id, 'gal-big'); // 800 x 600 - for small images slide ?>
                            <?php $slide_popup_img = wp_get_attachment_image_src($image_id, 'full'); ?>
                            <?php $thumb_img = get_post( $image_id ); // Get post by ID ?>

                            <div class="item">
                                <a class="magzilla-popup-<?php echo $gallery_slider_unique_id; ?>" href="<?php echo esc_url( $slide_popup_img[0] ); ?>">
                                    <img src="<?php echo $slide_big_img[0]; ?>" alt="image">
                                </a>
                                <div class="gallery-caption-wrap">
                                    <span class="gallery-caption"><?php echo $thumb_img->post_excerpt; ?></span>
                                </div>
                            </div><!-- item -->

                        <?php  } ?>

                    </div><!-- owl-carousel -->

                    <!-- thumbnails -->
                    <div id="sync2-<?php echo $gallery_slider_unique_id; ?>" class="owl-carousel thumbnails-owl-carousel">
                        <?php foreach($image_ids as $image_id) { ?>
                            <?php $slide_thumb_img = wp_get_attachment_image_src($image_id, 'gal-thumb'); // 120 x 90 - for small images slide ?>
                            <div class="item">
                                <img src="<?php echo $slide_thumb_img[0]; ?>" alt="image">
                            </div><!-- item -->
                        <?php  } ?>

                    </div><!-- owl-carousel -->
                </div><!-- post-gallery-body -->
            </div><!-- post-gallery -->
        </div><!-- post-gallery-wrap -->

        <?php
        wp_register_style( 'fave-slick-css', get_template_directory_uri(). '/slick/slick.css', array(), '1.1.2', 'all' );
        wp_register_style( 'fave-slick-theme', get_template_directory_uri(). '/slick/slick-theme.css', array(), '1.1.2', 'all' );
        wp_enqueue_style( 'fave-slick-css' );
        wp_enqueue_style( 'fave-slick-theme' );

        wp_enqueue_script( 'fave-slick.min.js', get_template_directory_uri() . '/slick/slick.min.js', 'jquery', '1.1.2', true );

        if ( is_rtl() ) {
            $magzilla_rtl = 'true';
        } else {
            $magzilla_rtl = 'false';
        }
        ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {

                var sync1 = $("#sync1-<?php echo $gallery_slider_unique_id; ?>");
                var sync2 = $("#sync2-<?php echo $gallery_slider_unique_id; ?>");

                sync1.slick({
                    rtl: <?php echo $magzilla_rtl; ?>,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    adaptiveHeight: true,
                    arrows: true,
                    prevArrow: "<button type='button' class='slick-prev'><i class='fa fa-chevron-left'></i></button>",
                    nextArrow: "<button type='button' class='slick-next'><i class='fa fa-chevron-right'></i></button>",
                    fade: true,
                    asNavFor: sync2
                });
                sync2.slick({
                    rtl: <?php echo $magzilla_rtl; ?>,
                    slidesToShow: 8,
                    slidesToScroll: 1,
                    asNavFor: sync1,
                    dots: false,
                    arrows: false,
                    centerMode: true,
                    focusOnSelect: true,
                    responsive: [
                        {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 8,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 979,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 5,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                            }
                        }
                    ]
                });
            });
        </script>


        <?php

    } //end main if

    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

add_filter( 'post_gallery', 'fave_gallery_shortcode', 10, 4 );

/* --------------------------------------------------------------------------
 * 51.0 - Generate Unique ID each elemement
 ---------------------------------------------------------------------------*/
if ( !function_exists('fave_unique_key') ) {

    function fave_unique_key(){

        $key = uniqid();
        return $key;
    }
}

/* --------------------------------------------------------------------------
 * 52.0 - REVIEW SCORE BOXES
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_add_content' ) ) {
    function fave_add_content($content) {

        global $post, $multipage, $numpages, $page;
        $fave_post_id = $post->ID;
        $fave_post_types = get_post_type();
        $fave_review_placement = get_post_meta( $fave_post_id, 'fave_placement', true );

        if ( $multipage == true ) {

            if ( $page == $numpages ) {

                if ( $fave_review_placement == 'bottom' ){
                    $content .= fave_review_boxes($post);
                }
            }

            if ( $page == '1' ) {

                if ( ( $fave_review_placement == 'top' ) || ( $fave_review_placement == 'top-half' ) ){

                    $content = fave_review_boxes($post) . $content;

                }
            }

        } else {

            if ( ( $fave_review_placement == 'top' ) || ( $fave_review_placement == 'top-half' ) ){

                $content = fave_review_boxes($post) . $content;

            } elseif ( $fave_review_placement == 'bottom' ){
                $content .= fave_review_boxes($post);
            }
        }

        return $content;
    }
}
add_filter( 'the_content', 'fave_add_content' );

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   53.0 - Review Score Box
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( ! function_exists( 'fave_review_boxes' ) ) {
    function fave_review_boxes($post) {

        $fave_post_id = $post->ID;
        $fave_custom_fields = get_post_custom();
        $fave_heading = $fave_summary = $fave_verdict = NULL;
        $fave_review_checkbox = get_post_meta($fave_post_id, 'fave_review_checkbox', true );

        if ( $fave_review_checkbox == '1' ) {
            $fave_review_checkbox = 'on';
        } else {
            $fave_review_checkbox = 'off';
        }

        if ($fave_review_checkbox == 'on') {

            $fave_score_display_type = get_post_meta($fave_post_id, 'fave_score_display_type', true );

            if ( isset ( $fave_custom_fields['fave_ct1'][0] ) ) { $fave_rating_1_title = $fave_custom_fields['fave_ct1'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs1'][0] ) ) { $fave_rating_1_score = $fave_custom_fields['fave_cs1'][0]; }
            if ( isset ( $fave_custom_fields['fave_ct2'][0] ) ) { $fave_rating_2_title = $fave_custom_fields['fave_ct2'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs2'][0] ) ) { $fave_rating_2_score = $fave_custom_fields['fave_cs2'][0]; }
            if ( isset ( $fave_custom_fields['fave_ct3'][0] ) ) { $fave_rating_3_title = $fave_custom_fields['fave_ct3'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs3'][0] ) ) { $fave_rating_3_score = $fave_custom_fields['fave_cs3'][0]; }
            if ( isset ( $fave_custom_fields['fave_ct4'][0] ) ) { $fave_rating_4_title = $fave_custom_fields['fave_ct4'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs4'][0] ) ) { $fave_rating_4_score = $fave_custom_fields['fave_cs4'][0]; }
            if ( isset ( $fave_custom_fields['fave_ct5'][0] ) ) { $fave_rating_5_title = $fave_custom_fields['fave_ct5'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs5'][0] ) ) { $fave_rating_5_score = $fave_custom_fields['fave_cs5'][0]; }
            if ( isset ( $fave_custom_fields['fave_ct6'][0] ) ) { $fave_rating_6_title = $fave_custom_fields['fave_ct6'][0]; }
            if ( isset ( $fave_custom_fields['fave_cs6'][0] ) ) { $fave_rating_6_score = $fave_custom_fields['fave_cs6'][0]; }


            $fave_heading = get_post_meta($fave_post_id, 'fave_heading', true );
            $fave_verdict = get_post_meta($fave_post_id, 'fave_verdict', true );
            $fave_summary = get_post_meta($fave_post_id, 'fave_summary', true );
            $fave_final_score = get_post_meta($fave_post_id, 'fave_final_score', true );
            $fave_review_placement = get_post_meta($fave_post_id, 'fave_placement', true );
            $fave_final_score_override = get_post_meta($fave_post_id, 'fave_final_score_override', true );

            if ( $fave_final_score_override != NULL ) {
                $fave_final_score = $fave_final_score_override;
            }

            $fave_5_stars = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
            $fave_ul = '<ul>';
            $fave_ul_closer = '</ul>';


            if ( $fave_review_placement == 'top-half' ) {
                $fave_review_placement_ret = ' favethemes-half';
            } else {
                $fave_review_placement_ret = NULL;
            }

            // Set final scores
            $fave_review_final_score = intval($fave_final_score);

            $fave_ratings = array();
        }


        if ( $fave_review_checkbox == 'on')  {

            $fave_star_overlay = $fave_star_bar = NULL;

            if ( $fave_score_display_type == 'percentage' ) {

                $fave_best_rating = '100';
                $fave_score_output = $fave_review_final_score . '<span>%</span>';

                for( $i = 1; $i < 7; $i++ ) {
                    if (isset(${"fave_rating_".$i."_score"})) { $fave_ratings[] =  ${"fave_rating_".$i."_score"} .'%';}
                }

            }

            if ( $fave_score_display_type == 'points' ) {
                $fave_best_rating = '10';
                $fave_score_output = $fave_review_final_score /10;
                for( $i = 1; $i < 7; $i++ ) {
                    if ( isset(${"fave_rating_".$i."_score"}) ) { $fave_ratings[] =  ${"fave_rating_".$i."_score"} / 10;}
                }
            }


            $fave_review_ret = '<div class="post-review'. $fave_review_placement_ret.'">';


            $fave_review_ret .= '<div class="row" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">

                <meta itemprop="worstRating" content="1">
                <meta itemprop="bestRating" content="'. $fave_best_rating .'">

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="review review-points text-center">
                        <div class="review-value">
                            <div class="value-number">
                                '.$fave_score_output.'
                            </div>
                            <div class="value-text">
                                '.$fave_verdict.'
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                    <h4>'.$fave_heading.'</h4>
                    <p>'.$fave_summary.'</p>
                </div>
            </div>';


            $fave_review_ret .= '<div class="post-review-bars">';

            for( $j = 1; $j < 7; $j++ ) {
                $k = ($j - 1);

                if ((isset(${"fave_rating_".$j."_title"})) && (isset(${"fave_rating_".$j."_score"})) ) {

                    $fave_review_ret .= '<div class="progress-wrap">';
                    $fave_review_ret .= '<div class="progress-title">'. ${"fave_rating_".$j."_title"}.'</div>';
                    $fave_review_ret .= '<div class="progress">';
                    $fave_review_ret .= '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: '. ( ${"fave_rating_".$j."_score"}).'%">';
                    $fave_review_ret .= '<span>'. $fave_ratings[$k].'</span>';
                    $fave_review_ret .= '</div><!-- /progress-bar -->';
                    $fave_review_ret .= '</div><!-- /progress -->';
                    $fave_review_ret .= '</div><!-- /progress-wrap -->';

                }
            }

            $fave_review_ret .= '</div>';

            $fave_review_ret .= '</div><!-- /post-review -->';

            return $fave_review_ret;
        }

    }
}

/* --------------------------------------------------------------------------
 * 54.0 - Get term
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_get_taxonomy' ) ) {
    function fave_get_taxonomy($taxonomy){

        $output = '';

        $terms = get_terms( $taxonomy );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

            foreach ( $terms as $term ) {

                $term_link = get_term_link( $term );

                // If there was an error, continue to the next term.
                if ( is_wp_error( $term_link ) ) {
                    continue;
                }

                $output .= '<a href="'.esc_url( $term_link ).'">' . $term->name . '</a> ';

            }

        }

        return $output;
    }
}

/**
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 *   55.0 - Get main post layouts layouts
 *   ----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if ( !function_exists( 'fave_get_archive_layouts' ) ):
    function fave_get_archive_layouts( $default = false ) {

        if ( $default ) {
            $layouts['module-default'] = array( 'title' => __( 'Inherit', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/inherit.png' );
        }

        $layouts['module-a'] = array( 'title' => __( 'Layout A', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_a.png' );
        $layouts['module-a-b'] = array( 'title' => __( 'Layout A-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_b.png' );
        $layouts['module-b'] = array( 'title' => __( 'Layout B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_c.png' );
        $layouts['module-b-b'] = array( 'title' => __( 'Layout B-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_d.png' );
        $layouts['module-c'] = array( 'title' => __( 'Layout C', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_e.png' );
        $layouts['module-c-b'] = array( 'title' => __( 'Layout C-B', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_f.png' );
        $layouts['module-d'] = array( 'title' => __( 'Layout D', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_g.png' );
        $layouts['module-e'] = array( 'title' => __( 'Layout E', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_h.png' );
        $layouts['module-f'] = array( 'title' => __( 'Layout F', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_i.png' );
        $layouts['module-h'] = array( 'title' => __( 'Layout H', 'magzilla' ), 'img' => FAVE_IMAGES . '/admin/layout_m.png' );

        return $layouts;
    }
endif;


/* --------------------------------------------------------------------------
 *  56.0 - Breadcrumb Adapted from http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 ---------------------------------------------------------------------------*/
if ( ! function_exists( 'fave_breadcrumbs' ) ) {
    function fave_breadcrumbs($options = array())
    {

        global $post;

        $text['home']     = '<i class="fa fa-home"></i>'; // text for the 'Home' link
        $text['category'] = __('%s', 'magzilla'); // text for a category page
        $text['tax']      = __('%s', 'magzilla'); // text for a taxonomy page
        $text['search']   = __('Search Results for "%s" Query', 'magzilla'); // text for a search results page
        $text['tag']      = __('%s', 'magzilla'); // text for a tag page
        $text['author']   = __('Articles by: %s', 'magzilla'); // text for an author page
        $text['404']      = __('Error 404', 'magzilla'); // text for the 404 page

        $defaults = array(
            'show_current' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
            'show_on_home' => 0, // 1 - show breadcrumbs on the homepage, 0 - don't show
            'delimiter' => '',
            'before' => '<li class="current">',
            'after' => '</li>',

            'home_before' => '',
            'home_after' => '',
            'home_link' => home_url() . '/',

            'link_before' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',
            'link_after'  => '</li>',
            'link_attr'   => '',
            'link_in_before' => '',
            'link_in_after'  => ''
        );

        extract($defaults);

        $link = '<a itemprop="url" href="%1$s">' . $link_in_before . '%2$s' . $link_in_after . '</a>';

        // form whole link option
        $link = $link_before . $link . $link_after;

        if (isset($options['text'])) {
            $options['text'] = array_merge($text, (array) $options['text']);
        }

        // override defaults
        extract($options);

        // regex replacement
        $replace = $link_before . '<a' . $link_attr . '\\1>' . $link_in_before . '\\2' . $link_in_after . '</a>' . $link_after;

        /*
         * Use bbPress's breadcrumbs when available
         */
        if (function_exists('bbp_breadcrumb') && is_bbpress()) {

            $bbp_crumbs =
                bbp_get_breadcrumb(array(
                    'home_text' => $text['home'],
                    'sep' => '',
                    'sep_before' => '',
                    'sep_after'  => '',
                    'pad_sep' => 0,
                    'before' => $home_before,
                    'after' => $home_after,
                    'current_before' => $before,
                    'current_after'  => $after,
                ));

            if ($bbp_crumbs) {
                echo '<ul class="breadcrumb favethemes_bbpress_breadcrumb">' .$bbp_crumbs. '</ul>';
                return;
            }
        }

        // normal breadcrumbs
        if ((is_home() || is_front_page())) {

            if ($show_on_home == 1) {
                echo '<li>'. $home_before . '<a href="' . $home_link . '">' . $text['home'] . '</a>'. $home_after .'</li>';
            }

        } else {

            echo '<ul class="breadcrumb">' .$home_before . sprintf($link, $home_link, $text['home']) . $home_after . $delimiter;

            if (is_category() || is_tax())
            {
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                if( $term ) {

                    $post_type = get_post_type_object(get_post_type());
                    printf($link, get_post_type_archive_link(get_post_type()), $post_type->labels->name);


                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                        $parent = $new_parent->parent;
                    endwhile;
                    if(!empty($parents)):
                        $parents = array_reverse($parents);

                        // For each parent, create a breadcrumb item
                        foreach ($parents as $parent):
                            $item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
                            $url = home_url().'/'.$item->taxonomy.'/'.$item->slug;
                            echo '<li><a href="'.$url.'">'.$item->name.'</a></li>';
                        endforeach;
                    endif;

                    // Display the current term in the breadcrumb
                    echo '<li>'.$term->name.'</li>';

                } else {

                    $the_cat = get_category(get_query_var('cat'), false);

                    // have parents?
                    if ($the_cat->parent != 0) {

                        $cats = get_category_parents($the_cat->parent, true, $delimiter);

                        if( !is_wp_error($cats) ) {
                            $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
                            echo $cats;
                        }
                    }

                    // print category
                    echo $before . sprintf((is_category() ? $text['category'] : $text['tax']), single_cat_title('', false)) . $after;
                } // end terms else

            }
            else if (is_search()) {

                echo $before . sprintf($text['search'], get_search_query()) . $after;

            }
            else if (is_day()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter
                    . $before . get_the_time('d') . $after;

            }
            else if (is_month()) {

                echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
                    . $before . get_the_time('F') . $after;

            }
            else if (is_year()) {

                echo $before . get_the_time('Y') . $after;

            }
            // single post or page
            else if (is_single() && !is_attachment()) {

                // custom post type
                if (get_post_type() != 'post') {

                    $post_type = get_post_type_object(get_post_type());
                    printf($link, get_post_type_archive_link(get_post_type()), $post_type->labels->name);

                    if ($show_current == 1) {
                        echo $delimiter . $before . get_the_title() . $after;
                    }
                }
                else {

                    $cat = get_the_category();
                    $cats = get_category_parents($cat[0], true, $delimiter);

                    if ($show_current == 0) {
                        $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                    }

                    if( !is_wp_error($cats) ) {
                        $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
                        echo $cats;
                    }

                    if ($show_current == 1) {
                        echo $before . get_the_title() . $after;
                    }
                } // end else

            }
            elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

                $post_type = get_post_type_object(get_post_type());

                echo $before . $post_type->labels->name . $after;

            }
            elseif (is_attachment()) {

                $parent = get_post($post->post_parent);
                $cat = current(get_the_category($parent->ID));
                $cats = get_category_parents($cat, true, $delimiter);

                if (!is_wp_error($cats)) {
                    $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
                    echo $cats;
                }

                printf($link, get_permalink($parent), $parent->post_title);

                if ($show_current == 1) {
                    echo $delimiter . $before . get_the_title() . $after;
                }

            }
            elseif (is_page() && !$post->post_parent && $show_current == 1) {

                echo $before . get_the_title() . $after;

            }
            elseif (is_page() && $post->post_parent) {

                $parent_id  = $post->post_parent;
                $breadcrumbs = array();

                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    $parent_id  = $page->post_parent;
                }

                $breadcrumbs = array_reverse($breadcrumbs);

                for ($i = 0; $i < count($breadcrumbs); $i++) {

                    echo $breadcrumbs[$i];

                    if ($i != count($breadcrumbs)-1) {
                        echo $delimiter;
                    }
                }

                if ($show_current == 1) {
                    echo $delimiter . $before . get_the_title() . $after;
                }

            }
            elseif (is_tag()) {
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

            }
            elseif (is_author()) {

                global $author;

                $userdata = get_userdata($author);
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;

            }
            elseif (is_404()) {
                echo $before . $text['404'] . $after;
            }

            // have pages?
            if (get_query_var('paged')) {

                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ' (' . __('Page', 'magzilla') . ' ' . get_query_var('paged') . ')';
                }
            }

            echo '</ul>';
        }

    } // breadcrumbs()
}

if( !function_exists( 'fave_vc_modules_meta' ) ) {
    function fave_vc_modules_meta( $module_meta, $author, $time_diff, $date, $time, $views, $comments ) {

        global $ft_option;

        $categories = get_the_category( get_the_ID() );

        if($categories){
            foreach($categories as $category) {
                $cat_id = $category->cat_ID;
            }
        } else {
            $cat_id = '';
        }
        if( $module_meta != "true" ) {
            $author_name = $ft_option['site_author_name'];
            $time_diff = $ft_option['site_time_diff'];
            $post_date = $ft_option['site_date'];
            $post_time = $ft_option['site_time'];
            $post_views = $ft_option['site_view_count'];
            $post_comments = $ft_option['site_comment_count'];
        } else {
            $author_name = $author;
            $time_diff = $time_diff;
            $post_date = $date;
            $post_time = $time;
            $post_views = $views;
            $post_comments = $comments;
        }

        ?>

        <?php if( $author_name != 0 ) { ?>
            <li class="post-author cat-author-color-<?php echo intval( $cat_id ); ?> "><i class="fa fa-circle"></i>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php the_author(); ?></span>
                    </span>
                </a>
            </li>
        <?php }

        if( $time_diff != 0 ) { ?>
                <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">
                    <a>
                    <span><i class="fa fa-clock-o"></i>
                        <?php printf( _x( '%s ago', '%s = human-readable time difference', 'magzilla' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                    </span>
                    </a>
                </li>
        <?php
        } else {

            if ( $post_date != 0 || $post_time != 0 ) { ?>
                <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">

                    <a href="<?php echo get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ); ?>">
                        <?php if ( $post_date != 0 ) { ?>
                            <span><i
                                    class="fa fa-calendar-o"></i> <?php esc_attr( the_time( get_option( 'date_format ' ) ) ); ?></span>
                        <?php } ?>
                        <?php if ( $post_time != 0 ) { ?>
                            <span><i
                                    class="fa fa-clock-o"></i> <?php esc_attr( the_time( get_option( 'time_format' ) ) ); ?></span>
                        <?php } ?>
                    </a>
                </li>
            <?php }
        }?>

        <?php if( $post_views != 0 ) { ?>
            <li class="post-total-shares"><i class="fa fa-eye"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>
                <meta itemprop="interactionCount" content="UserPageVisits:<?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>">
            </li>
        <?php } ?>

        <?php if( $post_comments != 0 ) { ?>
            <?php if ( comments_open() ) { ?>
                <?php if( get_comments_number() != 0 ) { ?>
                    <li class="post-total-comments">
                        <?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
                        <meta itemprop="interactionCount" content="UserComments:<?php comments_number( '0', '1', '%' ); ?>">
                    </li>
                <?php }
                    }
                 }
    }
}


if( !function_exists( 'fave_vc_gallery_modules_meta' ) ) {
    function fave_vc_gallery_modules_meta( $module_meta, $author, $time_diff, $date, $time, $views, $comments ) {

        global $ft_option, $term_id;

        $term_list = wp_get_post_terms( get_the_ID(), 'gallery-categories', array("fields" => "all"));

        if($term_list){
            foreach($term_list as $term) {
                $term_id = $term->term_id;
            }
        }

        if( $module_meta != "true" ) {
            $author_name = $ft_option['site_author_name'];
            $time_diff = $ft_option['site_time_diff'];
            $post_date = $ft_option['site_date'];
            $post_time = $ft_option['site_time'];
            $post_views = $ft_option['site_view_count'];
            $post_comments = $ft_option['site_comment_count'];
        } else {
            $author_name = $author;
            $time_diff = $time_diff;
            $post_date = $date;
            $post_time = $time;
            $post_views = $views;
            $post_comments = $comments;
        }

        ?>

        <?php if( $author_name != 0 ) { ?>
            <li class="post-author cat-author-color-<?php echo intval( $term_id ); ?> "><i class="fa fa-circle"></i>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php the_author(); ?></span>
                    </span>
                </a>
            </li>
        <?php }

        if( $time_diff != 0 ) { ?>
            <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">
                <a>
                    <span><i class="fa fa-clock-o"></i>
                        <?php printf( _x( '%s ago', '%s = human-readable time difference', 'magzilla' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                    </span>
                </a>
            </li>
            <?php
        } else {

            if ( $post_date != 0 || $post_time != 0 ) { ?>
                <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">

                    <a>
                        <?php if ( $post_date != 0 ) { ?>
                            <span><i
                                    class="fa fa-calendar-o"></i> <?php esc_attr( the_time( get_option( 'date_format ' ) ) ); ?></span>
                        <?php } ?>
                        <?php if ( $post_time != 0 ) { ?>
                            <span><i
                                    class="fa fa-clock-o"></i> <?php esc_attr( the_time( get_option( 'time_format' ) ) ); ?></span>
                        <?php } ?>
                    </a>
                </li>
            <?php }
        }?>

        <?php if( $post_views != 0 ) { ?>
            <li class="post-total-shares"><i class="fa fa-eye"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>
                <meta itemprop="interactionCount" content="UserPageVisits:<?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>">
            </li>
        <?php } ?>

        <?php if( $post_comments != 0 ) { ?>
            <?php if ( comments_open() ) { ?>
                <?php if( get_comments_number() != 0 ) { ?>
                    <li class="post-total-comments">
                        <?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
                        <meta itemprop="interactionCount" content="UserComments:<?php comments_number( '0', '1', '%' ); ?>">
                    </li>
                <?php }
            }
        }
    }
}

if( !function_exists( 'fave_vc_video_modules_meta' ) ) {
    function fave_vc_video_modules_meta( $module_meta, $author, $time_diff, $date, $time, $views, $comments ) {

        global $ft_option, $term_id;

        $term_list = wp_get_post_terms( get_the_ID(), 'video-categories', array("fields" => "all"));

        if($term_list){
            foreach($term_list as $term) {
                $term_id = $term->term_id;
            }
        }

        if( $module_meta != "true" ) {
            $author_name = $ft_option['site_author_name'];
            $time_diff = $ft_option['site_time_diff'];
            $post_date = $ft_option['site_date'];
            $post_time = $ft_option['site_time'];
            $post_views = $ft_option['site_view_count'];
            $post_comments = $ft_option['site_comment_count'];
        } else {
            $author_name = $author;
            $time_diff = $time_diff;
            $post_date = $date;
            $post_time = $time;
            $post_views = $views;
            $post_comments = $comments;
        }

        ?>

        <?php if( $author_name != 0 ) { ?>
            <li class="post-author cat-author-color-<?php echo intval( $term_id ); ?> "><i class="fa fa-circle"></i>
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                    <span itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php the_author(); ?></span>
                    </span>
                </a>
            </li>
        <?php }

        if( $time_diff != 0 ) { ?>
            <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">
                <a>
                    <span><i class="fa fa-clock-o"></i>
                        <?php printf( _x( '%s ago', '%s = human-readable time difference', 'magzilla' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
                    </span>
                </a>
            </li>
            <?php
        } else {

            if ( $post_date != 0 || $post_time != 0 ) { ?>
                <li class="post-date" datetime="<?php the_date(); ?>" itemprop="datePublished">

                    <a>
                        <?php if ( $post_date != 0 ) { ?>
                            <span><i
                                    class="fa fa-calendar-o"></i> <?php esc_attr( the_time( get_option( 'date_format ' ) ) ); ?></span>
                        <?php } ?>
                        <?php if ( $post_time != 0 ) { ?>
                            <span><i
                                    class="fa fa-clock-o"></i> <?php esc_attr( the_time( get_option( 'time_format' ) ) ); ?></span>
                        <?php } ?>
                    </a>
                </li>
            <?php }
        }?>

        <?php if( $post_views != 0 ) { ?>
            <li class="post-total-shares"><i class="fa fa-eye"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>
                <meta itemprop="interactionCount" content="UserPageVisits:<?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?>">
            </li>
        <?php } ?>

        <?php if( $post_comments != 0 ) { ?>
            <?php if ( comments_open() ) { ?>
                <?php if( get_comments_number() != 0 ) { ?>
                    <li class="post-total-comments">
                        <?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
                        <meta itemprop="interactionCount" content="UserComments:<?php comments_number( '0', '1', '%' ); ?>">
                    </li>
                <?php }
            }
        }
    }
}

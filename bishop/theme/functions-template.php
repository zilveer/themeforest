<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

require_once YIT_THEME_PATH . '/functions/string_manipulation.php';
require_once YIT_THEME_PATH . '/functions/head.php';

/*
 * =HOOKED FUNCTIONS=
 *
 * All the following functions are hooked via add_action or add_filter
 */
if ( ! function_exists( 'yit_change_container_width' ) ) {
    function yit_change_container_width() {
        $width = apply_filters( 'yit-container-width-std', 1170 );

        if ( 1170 == $width ) {
            return;
        }
        ?>
        <style type="text/css">
                /*
                 * Override Bootstrap's default container.
                 */

            @media (min-width: 1200px) {
                .container {
                    width: <?php echo $width ?>px;
                }
            }

            <?php if ( $width < 992 ) : ?>
            @media (min-width: 992px) {
                .container {
                    width: <?php echo $width ?>px;
                }
            }

            <?php endif; ?>
        </style>
    <?php
    }
}

if( ! function_exists( 'yit_portfolio_layout_values' ) ){
    /**
     * Unset unused portfolio layout
     *
     * @param $layouts
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_layout_values( $layouts ){
        unset( $layouts['default'] );
        unset( $layouts['columns'] );

        return $layouts;
    }
}

if( ! function_exists( 'yit_portfolio_single_layout_values' ) ){
    /**
     * Add portfolio single layout
     *
     * @param $layouts
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_portfolio_single_layout_values( $layouts ){
        $layouts['small_image'] = __( 'Small Image', 'yit' );
        $layouts['big_image'] = __( 'Big Image', 'yit' );

        return $layouts;
    }
}

if( ! function_exists( 'init_portfolio_layouts' ) ){
    /**
     * Add portfolio single layout setup on after setup theme
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function init_portfolio_layouts(){
        if ( function_exists( 'YIT_Portfolio' ) ) {
            add_filter( 'yit_cptu_' . YIT_Portfolio()->portfolios_post_type . '_layout_values', 'yit_portfolio_layout_values' );
            add_filter( 'yit_cptu_' . YIT_Portfolio()->portfolios_post_type . '_single_layout_values', 'yit_portfolio_single_layout_values' );
        }
    }
}

if( ! function_exists( 'yit_slider_layout_values' ) ){
    /**
     * Unset unused slider layout
     *
     * @param $layouts
     *
     * @return string[]
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function yit_slider_layout_values( $layouts ){
        unset( $layouts['default'] );

        return $layouts;
    }
}

if( ! function_exists( 'init_slider_single_layouts' ) ){
    /**
     * Add portfolio single layout setup on after setup theme
     *
     * @since  2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
     */
    function init_slider_layouts(){
        if ( function_exists( 'YIT_Slider' ) ) {
            add_filter( 'yit_cptu_' . YIT_Slider()->sliders_post_type . '_layout_values', 'yit_slider_layout_values' );
        }
    }
}

if( ! function_exists( 'yit_set_maintenance_skin' ) ){
    /**
     * Add a manteinance skin
     *
     * @return mixed[]
     * @since 2.0.0
     * @author Antonio La Rocca <antonio.larocca@yithems.com>
    */
    function yit_set_maintenance_skin( $options ){

       $new_skin = array(
           'general' => array(
               'sections' => array(
                   'general' => array(
                       'fields' => array(
                           'yith_maintenance_skin' => array(
                               'options' => array(
                                   'bishop' => __( 'Skin Bishop', 'yit' )
                               )
                           )
                       )
                   )
               )
           )
       );

       return array_merge_recursive( $options, $new_skin );
    }
}

/**
 * HEAD
 */
if ( ! function_exists( 'yit_favicon' ) ) {
    function yit_favicon() {
        yit_get_template( '/head/favicon.php' );
    }
}

if ( ! function_exists( 'yit_body_background' ) ) {
    /**
     * Define the body background for the page.
     *
     * First get the setting for the current page. If a setting is not defined
     * in the current page, will be get the setting from the theme options.
     * All css will be shown in head tag, by the action 'wp_head'
     *
     * @since 1.0.0
     */
    function yit_body_background() {
        $color            = YIT_Layout()->body_bg_color;
        $image            = YIT_Layout()->body_bg_image;
        $image_repeat     = YIT_Layout()->body_bg_repeat;
        $image_position   = YIT_Layout()->body_bg_position;
        $image_attachment = YIT_Layout()->body_bg_attachment;
        $wrapper_color    = YIT_Layout()->wrapper_bg_color;

        if ( 'default' == $image_repeat ) {
            $image_repeat = '';
        }
        if ( 'default' == $image_position ) {
            $image_position = '';
        }
        if ( 'default' == $image_attachment ) {
            $image_attachment = '';
        }

        // get from theme options
        $background = yit_get_option( 'background-style' );

        if ( empty( $image ) && empty( $color ) ) {
            $image = $background['image'];
            if ( $image == 'custom' ) {
                $image = yit_get_option( 'background-custom-image' );
            }

        }

        $wrapper = yit_get_option( 'container-background-color' );

        if ( empty( $color ) ) {
            $color = $background['color'];
        }

        if ( empty( $image_repeat ) ) {
            $image_repeat = yit_get_option( 'background-repeat' );
        }
        if ( empty( $image_position ) ) {
            $image_position = yit_get_option( 'background-position' );
        }
        if ( empty( $image_attachment ) ) {
            $image_attachment = yit_get_option( 'background-attachment' );
        }

        if ( empty( $wrapper_color ) ) {
            $wrapper_color = $wrapper['color'];
        }

        $css = array();
        $css_wrapper = array();

        if ( ! empty( $color ) ) {
            $css[] = "background-color: $color;";
        }
        if ( ! empty( $image ) && ( $image != 'none' || $image !='' ) ) {
            $css[] = "background-image: url('$image');";
        }

        if ( ! empty( $image ) && ! empty( $image_repeat ) ) {
            $css[] = "background-repeat: $image_repeat;";
        }
        if ( ! empty( $image ) && ! empty( $image_position ) ) {
            $css[] = "background-position: $image_position;";
        }
        if ( ! empty( $image ) && ! empty( $image_attachment ) ) {
            $css[] = "background-attachment: $image_attachment;";
        }
        if ( ! empty( $wrapper_color ) && yit_get_option( 'general-layout-type' ) == 'boxed' ){
            $css_wrapper[] = "background-color: $wrapper_color;";
        }

        if ( empty( $css ) && empty( $css_wrapper ) ) {
            return;
        }

        $css = apply_filters( 'yit_layout_body_background', $css );
        ?>
        <style type="text/css">
            <?php if( ! empty( $css ) ): ?>
            body {
            <?php echo implode( ' ', $css ) ?>
            }
            <?php endif;?>
            <?php if( ! empty( $css_wrapper ) ): ?>
            .boxed-layout #wrapper{
            <?php echo implode( ' ', $css_wrapper )?>
            }
            <?php endif;?>
        </style>
    <?php
    }
}


/**
 * HEADER
 */
if ( ! function_exists( 'yit_start_wrapper' ) ) {
    function yit_start_wrapper() {
        yit_get_template( '/header/start-wrapper.php' );
        global $is_primary;
        $is_primary = false;
    }
}

if ( ! function_exists( 'yit_end_wrapper' ) ) {
    function yit_end_wrapper() {
        yit_get_template( '/footer/end-wrapper.php' );
    }
}

if ( ! function_exists( 'yit_start_header' ) ) {
    function yit_start_header() {
        yit_get_template( '/header/start-header.php' );
    }
}

if ( ! function_exists( 'yit_end_header' ) ) {
    function yit_end_header() {
        yit_get_template( '/header/end-header.php' );
    }
}


if ( ! function_exists( 'yit_start_header_container' ) ) {
    function yit_start_header_container() {
        yit_get_template( '/header/start-header-container.php' );
    }
}


if ( ! function_exists( 'yit_skin_header' ) ) {
    function yit_skin_header() {
        $skin = yit_get_header_skin();
        yit_get_template( '/header/skins/' . $skin . '.php' );
    }
}

if ( ! function_exists( 'yit_end_header_container' ) ) {
    function yit_end_header_container() {
        yit_get_template( '/header/end-header-container.php' );
    }
}
if ( ! function_exists( 'yit_topbar' ) ) {
    function yit_topbar() {
        yit_get_template( '/header/topbar.php' );
    }
}

if ( ! function_exists( 'yit_logo' ) ) {
    function yit_logo() {
        yit_get_template( '/header/logo.php' );
    }
}

if ( ! function_exists( 'yit_header_sidebar' ) ) {
    function yit_header_sidebar() {
        yit_get_template( '/header/sidebar-header.php' );
    }
}

if ( ! function_exists( 'yit_nav' ) ) {
    function yit_nav() {
        yit_get_template( '/header/navigation.php' );
    }
}

if ( ! function_exists( 'yit_slider_header' ) ) {
    function yit_slider_header() {
        yit_get_template( '/header/slider.php' );
    }
}

if ( ! function_exists( 'yit_infobar' ) ) {
    function yit_infobar() {
        yit_get_template( '/header/infobar.php' );
    }
}


if ( ! function_exists( 'yit_slogan' ) ) {
    function yit_slogan() {
        yit_get_template( '/header/slogan.php' );
    }
}

/**
 * PRIMARY
 */
if ( ! function_exists( 'yit_start_primary' ) ) {
    function yit_start_primary() {
        yit_get_template( '/primary/start-primary.php' );
        global $is_primary;
        $is_primary = true;
    }
}

if ( ! function_exists( 'yit_end_primary' ) ) {
    function yit_end_primary() {
        yit_get_template( '/primary/end-primary.php' );
        global $is_primary;
        $is_primary = false;
    }
}

if ( ! function_exists( 'yit_primary_content' ) ) {
    function yit_primary_content() {
        yit_get_template( '/primary/content.php' );
    }
}

if ( ! function_exists( 'yit_primary_sidebar' ) ) {
    function yit_primary_sidebar() {
        yit_get_template( '/primary/sidebar.php' );
    }
}

if ( ! function_exists( 'yit_primary_sidebar_two' ) ) {
    function yit_primary_sidebar_two() {
        yit_get_template( '/primary/sidebar-two.php' );
    }
}

if ( ! function_exists( 'yit_content_loop' ) ) {
    function yit_content_loop() {
        yit_get_template( '/primary/loop/loop.php' );
    }
}

if( !function_exists( 'yit_map' ) ) {
    function yit_map() {
        yit_get_template( '/header/map.php' );
    }
}


/**
 * FOOTER
 */

if ( ! function_exists( 'yit_footer' ) ) {
    function yit_footer() {
        yit_get_template( '/footer/footer.php' );
    }
}

if ( ! function_exists( 'yit_footer_big' ) ) {
    function yit_footer_big() {
        yit_get_template( '/footer/footer-big.php' );
    }
}

if ( ! function_exists( 'yit_copyright' ) ) {
    function yit_copyright() {
        yit_get_template( '/footer/copyright.php' );
    }
}

if ( ! function_exists( 'yit_quick_view' ) ) {
	function yit_quick_view() {
		do_action( 'yit_load_quick_view' );

		yit_get_template( 'quick-view/quick-view.php' );
	}
}


/*
 * =NON HOOKED FUNCTIONS=
 */

if ( ! function_exists( 'yit_sidebar_args' ) ) {
    /**
     * Create the standard set of arguments for creating new sidebar
     *
     * @param string $name         The main name of sidebar
     * @param string $description  (optional) Description of sidebar
     * @param string $widget_class (optional) The widget class
     * @param string $title        (optional) The tag to use for the titles
     *
     * @return array The set of arguments for creating the sidebar
     *
     * @since 1.0.0
     */
    function yit_sidebar_args( $name, $description = '', $widget_class = 'widget', $title = 'h3' ) {
        $id = strtolower( str_replace( ' ', '-', $name ) );

        return array(
            'name'          => $name,
            'id'            => $id,
            'description'   => $description,
            'before_widget' => '<div id="%1$s" class="' . $widget_class . ' %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<' . $title . '>',
            'after_title'   => '</' . $title . '>',
        );
    }
}


if ( ! function_exists( 'is_posts_page' ) ) {
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

if ( ! function_exists( 'yit_get_post_meta' ) ) {
    /**
     * Retrieve the value of a metabox.
     *
     * This function retrieve the value of a metabox attached to a post. It return either a single value or an array.
     *
     * @param int    $id      Post ID.
     * @param string $meta    The meta key to retrieve.
     *
     * @return mixed Single value or array
     * @since    1.0.0
     */
    function yit_get_post_meta( $id, $meta ) {
        if ( ! strpos( $meta, '[' ) ) {
            return get_post_meta( $id, $meta, true );
        }

        $sub_meta = explode( '[', $meta );

        $meta = get_post_meta( $id, $meta, true );
        for ( $i = 0; $i < count( $sub_meta ); $i ++ ) {
            $meta = $meta[rtrim( $sub_meta[$i], ']' )];
        }

        return $meta;
    }
}

if ( ! function_exists( 'yit_ssl_url' ) ) {
    /**
     * Force the URL to https://, if we are in SSL
     *
     * @since 1.0.0
     */
    function yit_ssl_url( $url ) {
        if ( is_ssl() ) {
            $url = str_replace( 'http://', 'https://', $url );
        }

        return $url;
    }
}

if ( ! function_exists( 'yit_button_style' ) ) {
    /**
     * Add button style to shortcode button.
     *
     * @param $button
     *
     * @return array
     *
     * @since 1.0.0
     */
    function yit_button_style( $button = array() ) {
        $button['flat']        = __('Black','yit');
        $button['alternative'] = __('Alternative', 'yit');
        $button['white'] = __('White','yit');
        return $button;
    }
}

if ( ! function_exists( 'yit_edit_post_link' ) ) {
    /**
     * Add the edit post link
     *
     * @return void
     *
     * @since 1.1.0
     */
    function yit_edit_post_link( $link = '', $before = '', $after = '', $id = '' ) {

        $link   = empty( $link ) ? __( 'Edit', 'yit' ) : $link;
        $before = empty( $before ) ? '<span class="yit-edit-post">' : $before;
        $after  = empty( $after ) ? '</span>' : $after;
        $id     = empty( $id ) ? 0 : $link;

        edit_post_link( $link, $before, $after, $id );
    }
}

if ( ! function_exists( 'yit_get_testimonial_categories' ) ) {
    /**
     * Return an array with all testimonial categories
     *
     *
     * @return array
     * @since  1.0
     *
     */

    function yit_get_testimonial_categories() {

        global $wpdb;

        $terms           = $wpdb->get_results( 'SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "category-testimonial" ORDER BY name ASC;' );
        $categories      = array();
        $categories['0'] = __( 'All categories', 'yit' );
        if ( $terms ) :
            foreach ( $terms as $cat ) :
                $categories[$cat->term_id] = ( $cat->name ) ? $cat->name : 'ID: ' . $cat->term_id;
            endforeach;
        endif;

        return $categories;
    }
}

if( ! function_exists( 'yit_get_portfolios' ) ) {
    /**
     * Return an array of portfolios
     *
     * @param array $array
     *
     * @return array
     * @since  1.0
     * @author Antonio La Rocca <antonio.larocca@yithemes.com>
     */

    function yit_get_portfolios( $array = array() ) {
        $posts = get_posts( array(
            'post_type' => YIT_Portfolio()->portfolios_post_type
        ) );

        foreach( $posts as $post ){
            $array[ $post->post_name ] = $post->post_title;
        }
        return $array;
    }
}

if( ! function_exists( 'yit_get_contact_forms' ) ) {
    /**
     * Return an array of contact forms
     *
     * @param array $array
     *
     * @return array
     * @since  1.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */

    function yit_get_contact_forms( $array = array() ) {
        if( ! function_exists( 'YIT_Contact_Form' ) ){
           return array();
        }

        $posts = get_posts( array(
            'post_type' => YIT_Contact_Form()->contact_form_post_type
        ) );

        foreach( $posts as $post ){
            $array[ $post->post_name ] = $post->post_title;
        }
        return $array;
    }
}

if ( ! function_exists( 'yit_add_field_to_testimonial_meta' ) ) {
    /**
     * Add field to metabox testimonial
     *
     */
    function yit_add_field_to_testimonial_meta() {

        $args = array(
            'yit_testimonial_rating' => array(
                'label' => __( 'Rating Star', 'yit' ),
                'desc'  => __( 'Insert the rating', 'yit' ),
                'type'  => 'number',
                'min'   => '1',
                'max'   => '5',
                'std'   => '0'
            )
        );

        YIT_Metabox( 'yit-testimonial-info' )->add_field( 'settings', $args, 'last' );
    }
}


if ( ! function_exists( 'yit_header_background' ) ) {
    /**
     * Define the body background for the page.
     *
     * First get the setting for the current page. If a setting is not defined
     * in the current page, will be get the setting from the theme options.
     * All css will be shown in head tag, by the action 'wp_head'
     *
     * @since 1.0.0
     */
    function yit_header_background() {

        $custom_header = YIT_Layout()->custom_background;

        if ( $custom_header == 'no' ) {
            return;
        }

        $css        = array();
        $color      = YIT_Layout()->header_bg_color;
        $image      = YIT_Layout()->header_bg_image;
        $repeat     = YIT_Layout()->header_bg_repeat;
        $position   = YIT_Layout()->header_bg_position;
        $attachment = YIT_Layout()->header_bg_attachament;

        if ( ! empty( $color ) ) {
            $css[] = 'background-color: ' . $color . ';';
        }

        if ( ! empty( $image ) ) {
            $css[] = "background-image: url('$image');";

            if ( ! empty( $repeat ) ) {
                $css[] = "background-repeat: $repeat;";
            }

            if ( ! empty( $position ) ) {
                $css[] = "background-position: $position;";
            }

            if ( ! empty( $attachment ) ) {
                $css[] = "background-attachment: $attachment;";
            }
        }

        if ( empty( $css ) ) {
            return;
        }


        $custom_css = '#header{' . implode( ' ', $css ) . '}'; ?>

        <style type="text/css">
            <?php echo $custom_css ?>
        </style>
    <?php
    }
}

if( ! function_exists( 'yit_list_comments' ) ){
    /*
     * Comments Template Callback
     *
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     * @param
     * @since 2.0.0
     */

    function yit_list_comments( $comment, $args, $depth ) {

        global $post;

        $comments_list_template = 'comments/list.php';

        $args = array(
            'reply_text' => __( 'Reply', 'yit' ),
            'depth'       => 1,
            'max_depth'  => get_option( 'thread_comments_depth' )
        );

        $is_author = $comment->user_id == $post->post_author ? true : false;

        $user = get_userdata( $comment->user_id );
        $comment_author_gravatar_mail = ( is_object( $user ) ) ? $user->data->user_email : $comment->comment_author_email;

        $avatar_class = $is_author ? 'avatar is_author' : 'avatar';

        $param = array(
            'is_author'                     =>  $is_author,
            'user'                          =>  $user,
            'comment_author_gravatar_mail'  =>  $comment_author_gravatar_mail,
            'avatar_class'                  =>  $avatar_class,
            'comment'                       =>  $comment,
            'args'                          =>  $args
        );

        yit_get_template( $comments_list_template, $param );
    }
}

if ( !function_exists( 'yit_get_header_skin' ) ) {
    /**
     * Get the skin of the header
     *
     * @since 1.0.0
     */


    function yit_get_header_skin() {

        $skin = ( yit_get_option( 'header-skin' ) ) ? yit_get_option( 'header-skin' ) : 'skin1';
        return apply_filters( 'yit-header-skin', $skin);
    }
}


if ( !function_exists( 'yit_back_to_top' ) ) {
    /**
     * Add a back to top button
     *
     * @since 1.0.0
     */

    function yit_back_to_top() {
        if ( yit_get_option('general-show-back-to-top') == 'yes' ) {
            echo '<div id="back-top"><a href="#top"><i class="fa fa-chevron-up"></i>' . __('Back to top', 'yit') . '</a></div>';
        }
    }
}


if( !function_exists( 'yit_404' ) ) {

    /**
     * Get 404 template
     *
     * @since 2.0.0
     */


    function yit_404() {
        yit_get_template( '404/404.php' );
    }
}

/* === MISC */
if( !function_exists( 'yit_searchform' ) ) {

    /**
     * Get SearchForm template
     *
     * @since 2.0.0
     */
    function yit_searchform( $post_type ) {
        yit_get_template( '/searchform/' . $post_type . '.php' );
    }
}

if ( ! function_exists( 'yit_get_social_share' ) ) {

    /**
     * Get social share
     *
     * @param \Select|string $type Select the type of share to show
     *
     * @param string         $class
     *
     * @return mixed String!Array
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function yit_get_social_share( $type = 'text', $class='' ) {
        if ( $type == 'text' ) {

            global $post;

            echo '<div class="socials ' . $type . ' ' . $class . '">';

            $socials = array(
                'facebook',
                'twitter',
                'google',
                'pinterest'
            );

            foreach ( $socials as $i => $social ) {

                $title      = urlencode( get_the_title() );
                $permalink  = urlencode( get_permalink() );
                $excerpt    = urlencode( get_the_excerpt() );
                $attrs      = '';

                if ( $social == 'facebook' ) {
                    $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title . '' );
                    $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"";
                }
                else {
                    if ( $social == 'twitter' ) {
                        $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title . '' );
                        $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=417,width=600');return false;\"";
                    }
                    else {
                        if ( $social == 'google' ) {
                            $url   = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title . '' );
                            $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"";
                        }
                        else {
                            if ( $social == 'pinterest' ) {
                                $src   = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                                $url   = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
                                $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"";
                            }
                        }
                    }
                }

                ?>

                <a href='<?php echo $url; ?>' class="socials-text" target="_blank" <?php echo $attrs ?>>
                    <?php echo $social; ?>
                </a>

                <?php
            }
            echo '</div>';
        }
    }

}

if( ! function_exists( 'my_comments_open' ) ) {

    /**
     * Remove Comments, Pingaback and Trackback template on Pages
     *
     * @param string $open the pingback, trackback or comments status
     *
     * @param string $post_id the post ID
     *
     * @return bool
     * @since  2.0.0
     * @author Andrea Grillo <andrea.grillo@yithemes.com>
     */
    function my_comments_open( $open, $post_id ) {
        $post = get_post( $post_id );

        if ( in_array( $post->post_type, array( 'post', 'product' ) ) ) {
            return $open;
        }

        $remove_options = yit_get_option('general-disable-comment-on-pages-admin') == 'yes' ? true : false;

        return ( $remove_options || $post->post_type == 'forum' || $post->post_type == 'topic' ) ? false : $open;
    }
}


if( ! function_exists('yit_page_meta') ){
    function yit_page_meta(){

        if ( ( function_exists('YIT_Layout') && YIT_Layout()->show_title == '1' ) || is_category() ){
            echo '<h1>'.get_the_title().'</h1>';
        }

        if ( function_exists('YIT_Layout') && ( YIT_Layout()->show_breadcrumb == '1' ) ) : ?>
            <div class="breadcrumbs">
                <?php yit_breadcrumb( apply_filters( 'yit_breadcrumb_delimiter', '&gt;' ) ); ?>
            </div>
        <?php endif;

        if( is_category() && yit_get_option( 'blog-show-category-description' ) == 'yes' ) {

            $category_description = category_description();

            if( $category_description ) {
                echo '<div class="category-description">';
                echo $category_description;
                echo '</div>';
            }

        }
    }
}
add_action('yit_page_meta','yit_page_meta');

if( !function_exists( 'yit_breadcrumb' ) ) {
    /**
     * Print the breadcrumb.
     *
     * @param string $sep
     * @return string
     * @since 1.0.0
     */
    function yit_breadcrumb( $delimiter = '&raquo;' ) {
        global $wp_query;
        $post = $wp_query->get_queried_object();

        $home = apply_filters( 'yit_homepage_breadcrumb_text', __( 'Home Page', 'yit' ) ); // text for the 'Home' link
        $before = '<a class="no-link current" href="#">'; // tag before the current crumb
        $after = '</a>'; // tag after the current crumb

        echo '<p id="yit-breadcrumb" itemprop="breadcrumb">';

        //$homeLink = site_url();
        $homeLink = apply_filters('yit_breadcrumb_homelink', YIT_SITE_URL);

        if( !is_home() && !is_front_page() )
            echo '<a class="home" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';


        /*if ( is_single() && yit_get_model('cpt_unlimited')->is_cptu( $post->post_type ) ) {
            $tmp_post = get_post( get_the_id() );
            echo '<a href="' . get_permalink() . '">' . $tmp_post->post_title . '</a> ' . $delimiter . ' ';
            echo $before . yit_remove_chars_title(get_the_title()) . $after;
        } else*/
//        if( is_page_template( 'blog.php' ) ){
//            echo '<a href="' . get_permalink() . '">' . $tmp_post->post_title . '</a> ' . $delimiter . ' ';
//            echo $before . yit_remove_chars_title(get_the_title()) . $after;
//        }else
        if ( is_category() ) {
            $cat_obj = $post;
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
                $post_type = get_post_type_object( get_post_type() );
                $slug = $post_type->rewrite;

                echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                echo $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];

                if( !empty( $cat ) ) {
                    echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
                }

                echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() & !is_home()  ) {

            $post_type = get_post_type_object( get_post_type() );

            echo $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) {
            $parent = get_post( $post->post_parent );

            if( $parent->post_type == 'page' || $parent->post_type == 'post' ) {
                $cat = get_the_category( $parent->ID ); $cat = $cat[0];
                echo get_category_parents( $cat, true, ' ' . $delimiter . ' ' );
            }

            echo '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
            echo $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            echo $before . ucfirst( strtolower( get_the_title() ) ) . $after;
        } elseif ( is_page() && $post->post_parent ) {

            $parent_id  = $post->post_parent;
            $breadcrumbs = array();

            while ( $parent_id ) {
                $page = get_post( $parent_id );
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

            echo $before . apply_filters( 'yit_posts_page_breadcrumb', __( 'Home', 'yit' ) ) . $after;
        }

        if ( yit_is_paged() ) {


            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
            { echo ' ('; }

            echo ' - '.$before . __( 'Page', 'yit' ) . ' ' . yit_get_post_current_page() . $after;

            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
            { echo ')'; }
        }

        echo '</p>';
    }
}


if (! function_exists("yit_hex2rgb")){
    /*
    * print single item of contact info
    *
    * @return void
    * @since 2.0
    * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
    */
    function yit_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);

        return implode(",", $rgb); // returns the rgb values separated by commas

    }
}

if(!function_exists("yit_get_welcome_user_name")){

    function yit_get_welcome_user_name( $current_user ) {

        // if firstname and last name are both not setted
        if ( ! $current_user->user_firstname && ! $current_user->user_lastname ) {

            if ( is_shop_installed() ) {

                $firstname_billing = get_user_meta( $current_user->ID, "billing_first_name", true );
                $lastname_billing  = get_user_meta( $current_user->ID, "billing_last_name", true );

                // if firstname and last name in billing options are both not setted
                if ( ! $firstname_billing && ! $lastname_billing ) {
                    $user_name = $current_user->user_nicename;
                }
                else {
                    $user_name = $firstname_billing . ' ' . $lastname_billing;
                }

            }
            else {
                $user_name = $current_user->user_nicename;
            }
        }
        else {
            $user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
        }

        if ( $user_name == ' ' ) {
            $user_name = $current_user->user_login;
        }

        return $user_name;
    }

}

if( ! function_exists( 'yit_comment_script' ) ) {
    /**
     * add js comment script
     *
     * @author   Andrea Frascaspata  <andrea.frascaspata@yithemes.com>
     *
     * @param array
     * @param $tables
     *
     * @return mixed array
     * @since    1.2.9
     */
    function yit_comment_script( ) {
        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );
    }
}

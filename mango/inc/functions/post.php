<?php
function mango_get_blog_settings () {
    global $mango_settings, $post;
    $blog_settings = array ();
    $id = mango_current_page_id();
    $blog_type = get_post_meta ( $id, 'mango_blog_type', true ) ? get_post_meta ( $id, 'mango_blog_type', true ) : '';
    if ( !$blog_type ) {
        $blog_type = isset( $mango_settings[ 'mango_blog_type' ] ) ? $mango_settings[ 'mango_blog_type' ] : 'classic';
    }

    $blog_masonry_cols = get_post_meta ( $id, 'mango_blog_masonry_columns', true ) ? get_post_meta ( $id, 'mango_blog_masonry_columns', true ) : '';
    if ( !$blog_masonry_cols ) {
        $blog_masonry_cols = isset( $mango_settings[ 'mango_blog_masonry_columns' ] ) ? $mango_settings[ 'mango_blog_masonry_columns' ] : '3';
    }

    $blog_excerpt = get_post_meta ( $id, 'mango_blog_excerpt', true ) ? get_post_meta ( $id, 'mango_blog_excerpt', true ) : '';
    if ( !$blog_excerpt ) {
        $blog_excerpt = isset( $mango_settings[ 'mango_blog_excerpt' ] ) ? $mango_settings[ 'mango_blog_excerpt' ] : '1';
    }

    $blog_excerpt_limit = get_post_meta ( $id, 'mango_blog_excerpt_length', true ) ? get_post_meta ( $id, 'mango_blog_excerpt_length', true ) : '';
    if ( !$blog_excerpt_limit ) {
        $blog_excerpt_limit = isset( $mango_settings[ 'mango_blog_excerpt_length' ] ) ? $mango_settings[ 'mango_blog_excerpt_length' ] : 80;
    }

    $hide_blog_post_title = get_post_meta ( $id, 'mango_hide_blog_post_title', true ) ? get_post_meta ( $id, 'mango_hide_blog_post_title', true ) : '';
    if ( !$hide_blog_post_title ) {
        $hide_blog_post_title = isset( $mango_settings[ 'mango_hide_blog_post_title' ] ) ? $mango_settings[ 'mango_hide_blog_post_title' ] : '';
    }

    $hide_blog_post_author = get_post_meta ( $id, 'mango_hide_blog_post_author', true ) ? get_post_meta ( $id, 'mango_hide_blog_post_author', true ) : '';
    if ( !$hide_blog_post_author ) {
        $hide_blog_post_author = isset( $mango_settings[ 'mango_hide_blog_post_author' ] ) ? $mango_settings[ 'mango_hide_blog_post_author' ] : '';
    }
    if(is_single()){
        $hide_blog_post_author = get_post_meta ( $id, 'mango_hide_post_author', true ) ? get_post_meta ( $id, 'mango_hide_post_author', true ) : '';
        if ( !$hide_blog_post_author ) {
            $hide_blog_post_author = isset( $mango_settings[ 'mango_hide_post_author' ] ) ? $mango_settings[ 'mango_hide_post_author' ] : '';
        }
    }

    if(!is_singular("post")) {
        $hide_blog_post_category = get_post_meta ( $id, 'mango_hide_blog_post_category', true ) ? get_post_meta ( $id, 'mango_hide_blog_post_category', true ) : '';
        if ( !$hide_blog_post_category ) {
            $hide_blog_post_category = isset( $mango_settings[ 'mango_hide_blog_post_category' ] ) ? $mango_settings[ 'mango_hide_blog_post_category' ] : '';
        }
    }else {
        $hide_blog_post_category = get_post_meta ( $id, 'mango_hide_post_category', true ) ? get_post_meta ( $id, 'mango_hide_post_category', true ) : '';
        if ( !$hide_blog_post_category ) {
            $hide_blog_post_category = isset( $mango_settings[ 'mango_hide_post_category' ] ) ? $mango_settings[ 'mango_hide_post_category' ] : '';
        }
    }
    if(!is_singular("post")){
        $hide_blog_post_tags = get_post_meta ( $id, 'mango_hide_blog_post_tags', true ) ? get_post_meta ( $id, 'mango_hide_blog_post_tags', true ) : '';
        if ( !$hide_blog_post_tags ) {
            $hide_blog_post_tags = isset( $mango_settings[ 'mango_hide_blog_post_tags' ] ) ? $mango_settings[ 'mango_hide_blog_post_tags' ] : '';
        }
    }else {
        $hide_blog_post_tags = get_post_meta ( $id, 'mango_hide_post_tags', true ) ? get_post_meta ( $id, 'mango_hide_post_tags', true ) : '';
        if ( !$hide_blog_post_tags ) {
            $hide_blog_post_tags = isset( $mango_settings[ 'mango_hide_post_tags' ] ) ? $mango_settings[ 'mango_hide_post_tags' ] : '';
        }
    }

    $blog_pagination_type = get_post_meta ( $id, 'mango_blog_pagination_type', true ) ? get_post_meta ( $id, 'mango_blog_pagination_type', true ) : '';
    if ( !$blog_pagination_type ) {
        $blog_pagination_type = isset( $mango_settings[ 'mango_blog_pagination_type' ] ) ? $mango_settings[ 'mango_blog_pagination_type' ] : '';
    }

    $exclude_posts = get_post_meta ( $id, 'mango_exclude_posts', true ) ? get_post_meta ( $id, 'mango_exclude_posts', true ) : '';
    if ( !$exclude_posts ) {
        $exclude_posts = isset( $mango_settings[ 'mango_exclude_posts' ] ) ? $mango_settings[ 'mango_exclude_posts' ] : '';
    }



    $posts_per_page = get_post_meta ( $id, 'mango_no_of_posts', true ) ? get_post_meta ( $id, 'mango_no_of_posts', true ) : '';
    if ( $posts_per_page<=0 || !is_numeric( $posts_per_page ) ) {
        $posts_per_page = get_option ( "posts_per_page" );
    }
    $mango_excerpt_type = get_post_meta ( $id, 'mango_excerpt_type', true ) ? get_post_meta ( $id, 'mango_excerpt_type', true ) : '';
    if ( !$mango_excerpt_type) {
        $mango_excerpt_type = isset( $mango_settings[ 'mango_excerpt_type' ] ) ? $mango_settings[ 'mango_excerpt_type' ] : 'html';
    }

    $blog_settings[ 'blog_type' ]               = $blog_type;
    $blog_settings[ 'blog_masonry_cols' ]       = $blog_masonry_cols;
    $blog_settings[ 'blog_excerpt' ]            = $blog_excerpt;
    $blog_settings[ 'blog_excerpt_limit' ]      = $blog_excerpt_limit;
    $blog_settings[ 'blog_pagination_type' ]    = $blog_pagination_type;
    $blog_settings[ 'hide_blog_post_author' ]   = $hide_blog_post_author;
    $blog_settings[ 'hide_blog_post_category' ] = $hide_blog_post_category;
    $blog_settings[ 'hide_blog_post_tags' ]     = $hide_blog_post_tags;
    $blog_settings[ 'hide_blog_post_title' ]    = $hide_blog_post_title;
    $blog_settings[ 'posts_per_page' ]          = $posts_per_page;
    $blog_settings[ 'exclude_posts' ]           = $exclude_posts;
    $blog_settings[ 'excerpt_type' ]            = $mango_excerpt_type;
    return $blog_settings;
}

add_filter('post_class', function($classes){
    global $wp_query;
    if(($wp_query->current_post + 1) == $wp_query->post_count)
        $classes[] = 'last';

    return $classes;
});

function mango_get_blockquote_excerpt($quote){
    global $mango_settings, $blog_settings;
    if ( post_password_required() ) {
     //   $excerpt = get_the_password_form ();
       return '';
    }
    if($blog_settings['blog_excerpt_limit'] && is_numeric($blog_settings['blog_excerpt_limit']) && $blog_settings['blog_excerpt_limit'] >10){
        $limit = $blog_settings['blog_excerpt_limit'];
    }else{
        $limit = 80;
    }
    $words = explode(" ",$quote);
    if(count($words) <= $limit){
        return $quote;
    } else{
       return implode(" ",array_slice($words,0,$limit)).'....';
    }
}

if( !function_exists( 'mango_excerpt' ) ) :
    function mango_excerpt( $limit = 80 ) {
        global $mango_settings, $post, $blog_settings;
        $excerpt_type = $blog_settings['excerpt_type'];
        if( !$limit ) {
            $limit = 80;
        }
        if(post_password_required()){
            return get_the_password_form ();
        }
        if( has_excerpt() || $excerpt_type == 'text' ) {
            if( has_excerpt() ) {
                $content = strip_tags( strip_shortcodes( get_the_excerpt() ) );
            } else {
                $content = strip_tags( do_shortcode( get_the_content() ) );
            }
        } else {
            $content = force_balance_tags( do_shortcode( get_the_content() ) );
        }
        $content = explode( ' ', $content, $limit );

        if( count( $content ) >= $limit ) {
            array_pop( $content );
            $content = implode( " ", $content ) . '...<br /><br />';
        //    $content .= wp_link_pages( 'echo=0' );
        //    $content .= '<a href="' . get_the_permalink() . '" class="link" rel="bookmark">' . __( "Read More", "reviver" ) . ' </a>';
        } else {
            $content = implode( " ", $content );
        //    $content .= '<br /><br />' . wp_link_pages( 'echo=0' );
        }

        $content = force_balance_tags( $content );

        if( $excerpt_type == 'html' ) {
            $content = apply_filters( 'the_content', force_balance_tags( $content ) );
            $content = do_shortcode( $content );
        }

        return $content;
    }
endif;

if( !function_exists( 'gallery_shortcode_exists' ) ) {
    function gallery_shortcode_exists() {
        global $post;
        // Check the content for an instance of [gallery] with or without arguments
        $pattern = get_shortcode_regex();
        if(
            preg_match_all( '/' . $pattern . '/s', $post->post_content, $matches )
            && array_key_exists( 2, $matches )
            && in_array( 'gallery', $matches[ 2 ] )
        ) {
            return true;
        }
    }
}

function mango_password_form() {
    global $post;
    $label = 'pwbox-' .( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:", 'mango' );
   // <label for="' . $label . '">' . __( "Password:", 'mango' ) . ' <input class="post_password" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /></label><input class="button btn-blue btn-small" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
   // </form>';
    $o .= '<div class="input-group">
            <input type="password" name="post_password" id="' . $label . '" class="form-control post_password" placeholder="'.__("Enter Your Password Here",'mango').'">
            <span class="input-group-btn">
                <input name="Submit" type="submit" class="btn btn-custom" value="' . esc_attr__( "Submit",'mango' ) .'">
            </span>
           </div>';
    $o .='</form>';
    return $o;
}

add_filter( 'the_password_form', 'mango_password_form' );

add_filter( 'the_content', 'pagination_after_post', 1 );
function pagination_after_post( $content ) {
    if( is_single() ) {
        $content .= '<div class="pagination">' . wp_link_pages( 'echo=0' ) . '</div>';
    }
    return $content;
}

function mango_gallery() { 
    global $post, $blog_settings;
    if ( post_password_required() ) {
        echo get_the_password_form ();
        return '';
    }
    $pattern =  get_shortcode_regex();
        preg_match( '/' . $pattern . '/s', $post->post_content, $matches);
            echo do_shortcode ( $matches[0]);
}
?>
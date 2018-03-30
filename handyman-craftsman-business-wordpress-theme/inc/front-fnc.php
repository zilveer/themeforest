<?php
/**
 * Functions used on templates
 */
namespace Handyman\Front;


if (!function_exists('\Handyman\Front\tl_assets')) {

    /**
     * @param $asset
     * @return string
     */
    function tl_assets($asset)
    {
        return \Handyman\Core\Assets::assetPath($asset);
    }

}


if(!function_exists('\Handyman\Front\tl_layers_get_page_title')){

    function tl_layers_get_page_title(){

        if(is_404()){
            $details['title'] = '404';
        }else{
            $details = layers_get_page_title();
        }
        return $details;
    }
}


if (!function_exists('\Handyman\Front\get_partners')) {
    /**
     * @return string
     */
    function get_partners()
    {
        global $tl_glob_mobile;

        $swipe_class = ($tl_glob_mobile->is('mobile')) ? 'class="swiper-slide"' : '';

        $n = 5;
        $str = '';
        for ($i = 1; $i <= $n; $i++) {
            $tmp = \Handyman\Front\tl_copt('partner-logo' . $i);

            if ($tmp) {
                if(is_numeric($tmp)){
                    $img = wp_get_attachment_image_src($tmp, array(300, 300));
                }elseif($tmp != ''){
                    $img = array($tmp); //
                }
                $str .= '<span ' . $swipe_class . '><img alt="Partner Logo" src="' . esc_url($img[0]) . '" /></span>';
            }
        }
        $str = '<div class="partners-wrapper">' . $str . '</div>';
        if ($swipe_class) {
            $str = $str . '<div class="swiper-pagination"></div>';
        }
        $str = '<div class="partners">' . $str . '</div>';

        return $str;
    }
}
if (!function_exists('\Handyman\Front\tl_copt')) {

    /**
     * Get options saved with customizer
     *
     * @param $name
     * @param bool $allow_empty
     * @param bool $echo
     * @return bool|string
     */
    function tl_copt($name, $allow_empty = true, $echo = false)
    {
        global $layers_customizer_defaults;

        if (defined('DOING_AJAX') && DOING_AJAX) {
            // Load defaults. These are not loaded by default in called in inside AJAX call.
            \Layers_Customizer_Defaults::get_instance();
        }

        // Add the theme prefix to our layers option
        $name = LAYERS_THEME_SLUG . '-' . $name;

        // Set theme option default

        if(isset($layers_customizer_defaults[$name]['value'])){
            $default = $layers_customizer_defaults[$name]['value'];
        }elseif(isset($layers_customizer_defaults[$name])){ // fix. for adding custom controls to default sections
            $default = $layers_customizer_defaults[$name];
        }else{
            $default = false;
        }

        //var_dump($name, $default);

        // Get theme option
        $theme_mod = get_theme_mod($name, $default);

        // Template can choose whether to allow empty
        if (false != $default && '' == $theme_mod && false == $allow_empty) {
            $theme_mod = $default;
        }

        // Return theme option
        return $theme_mod;
    }
}


/**
 * Get post/page featured image
 *
 * @param int $post_id
 * @param string|array $size
 * @param bool $echo
 * @return mixed
 */
if (!function_exists('\Handyman\Front\tl_get_featured_image')) {
    function tl_get_featured_image($post_id = 0, $size = 'thumbnail', $echo = false)
    {
        global $post;
        if (!$post_id) {
            $post_id = $post->ID;
        }
        $src = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);

        if ($echo) {
            echo esc_url($src[0]);
        } else {
            return $src[0];
        }
    }
}


if (!function_exists('\Handyman\Front\tl_post_featured_media')) {
    /**
     * Wrapper function for @see tl_layers_get_feature_media()
     *
     * @param array $args
     * @return mixed|void
     */
    function tl_post_featured_media($args = array()){

        global $post;

        $defaults = array(
            'post_id'     => $post->ID,
            'wrap'        => 'div',
            'wrap_class'  => 'thumbnail',
            'size'        => 'medium',
            'force_img'   => false,
            'force_vid'   => false,
            'use_pretty_photo'   => true
        );

        $args = wp_parse_args( $args, $defaults );
        extract( $args, EXTR_SKIP );

        // Get video
        $post_meta = get_post_meta( $post_id, 'layers', true );
        $video     = isset($post_meta['video-url']) && $post_meta['video-url']!='' ? $post_meta['video-url'] : null;
        $output    = '';

        $featured_media = tl_layers_get_feature_media($post_id, $size, $video, $force_img, $force_vid, $use_pretty_photo );

        if( NULL != $featured_media ){
            $output .= $featured_media;
        }

        if( '' != $wrap && $featured_media != null ) {
            $output = '<'.$wrap. ( '' != $wrap_class ? ' class="' . $wrap_class . '"' : '' ) . '>' . $output . '</' . $wrap . '>';
        }
        return apply_filters('layers_post_featured_media', $output);
    }
}



if (!function_exists('\Handyman\Front\tl_layers_get_feature_media')) {

    /**
     * Feature Image / Video Generator
     *
     * @param null $post_id
     * @param string $size
     * @param null $video
     * @param $force_img
     * @param $force_vid
     * @return null|string
     */
    function tl_layers_get_feature_media($post_id, $size = 'medium', $video = NULL, $force_img = false, $force_vid=false, $use_pretty_photo = true)
    {
        if(is_array($size)){
            $image_dimensions['width']  = $size[0];
            $image_dimensions['height'] = $size[1];
            $image_dimensions['crop']   = true;
        }else{
            $image_dimensions = layers_get_image_sizes($size);
        }

        $attachment_id = get_post_thumbnail_id($post_id);

        // Check for an image
        if (NULL != $attachment_id && '' != $attachment_id) {

            if($use_pretty_photo){
                $large_image_url = wp_get_attachment_image_src($attachment_id, "large");
                $large_image_url = $large_image_url[0];
                $use_pretty_photo = ' class="pretty-photo"';
            }else{
                $use_pretty_photo = '';
                $large_image_url ='#';
            }
            $use_image = '<a href="' . $large_image_url . '" '.$use_pretty_photo.'>' . get_the_post_thumbnail($post_id, $size) . '</a>';
        }

        // Check for a video
        if (NULL != $video && '' != $video) {
            $embed_code = '[embed width="' . $image_dimensions['width'] . '"]' . $video . '[/embed]';
            $wp_embed = new \WP_Embed();
            $use_video = $wp_embed->run_shortcode($embed_code);

            $use_video = str_replace('frameborder="0"' ,'', $use_video);
        }

        if($force_img && isset($use_image)){
            $media = $use_image;
        }elseif($force_vid && isset($use_video)){
            $media = $use_video;
        }else{
            if(isset($use_image)){
                $media = $use_image;
            }else{
                return null;
            }
        }

        $media_output = do_action('layers_before_feature_media') . $media . do_action('layers_after_feature_media');
        return $media_output;
    }
}


if (!function_exists('Handyman\Front\tl_layers_post_meta')) {

    /**
     * Return post meta data
     *
     * @param null $post_id
     * @param null $display
     * @param string $wrapper
     * @param string $wrapper_class
     */
    function tl_layers_post_meta($post_id = NULL, $display = NULL, $wrapper = 'footer', $wrapper_class = 'meta-info')
    {
        // If there is no post ID specified, use the current post, does not affect post author, yet.
        if (NULL == $post_id) {
            global $post;
            $post_id = $post->ID;
        }
        // If there are no items to display, return nothing
        if (!is_array($display)) $display = array('date', 'author', 'categories', 'tags', 'comment-num');

        foreach ($display as $meta) {

            switch ($meta) {
                case 'date' :
                    $meta_to_display[] = '<span class="meta-item meta-date"><i class="fa fa-calendar"></i> ' . get_the_time(get_option('date_format'), $post_id) . '</span>';
                    break;
                case 'author' :
                    $meta_to_display[] = '<span class="meta-item meta-author"><i class="fa fa-user"></i> ' . layers_get_the_author($post_id) . '</span>';
                    break;
                case 'categories' :

                    $categories = '';
                    // Use different terms for different post types
                    if ('post' == get_post_type($post_id)) {
                        $the_categories = get_the_category($post_id);
                    } elseif ('tl_portfolio' == get_post_type($post_id)) {
                        $the_categories = get_the_terms($post_id, 'tl_portfolio_category');
                    } else {
                        $the_categories = FALSE;
                    }

                    // If there are no categories, skip to the next case
                    if (!$the_categories) continue;

                    foreach ($the_categories as $category) {
                        $categories[] = ' <a href="' . get_category_link($category->term_id) . '" title="' . esc_attr(sprintf(__("View all posts in %s", TL_DOMAIN), $category->name)) . '">' . $category->name . '</a>';
                    }
                    $meta_to_display[] = '<span class="meta-item meta-category"><i class="fa fa-tag"></i> ' . implode(', ', $categories) . '</span>';
                    break;

                case 'tags' :
                    $tags = '';

                    if ('post' == get_post_type($post_id)) {
                        $the_tags = get_the_tags($post_id);
                    } elseif ('portfolio' == get_post_type($post_id)) { // @todo fix this
                        $the_tags = get_the_terms($post_id, 'portfolio-tag');
                    } else {
                        $the_tags = FALSE;
                    }

                    // If there are no tags, skip to the next case
                    if (!$the_tags) continue;

                    foreach ($the_tags as $tag) {
                        $tags[] = ' <a href="' . get_category_link($tag->term_id) . '" title="' . esc_attr(sprintf(__("View all posts tagged %s", TL_DOMAIN), $tag->name)) . '">' . $tag->name . '</a>';
                    }
                    $meta_to_display[] = '<span class="meta-item meta-tags"><i class="fa fa-tags"></i> ' . implode(', ', $tags) . '</span>';
                    break;

                case 'comment-num' :

                    $num = get_comments_number($post_id);
                    $meta_to_display[] = '<span class=" meta-item meta-commnent-num"><i class="fa fa-comments-o"></i>&nbsp;' . $num . '</span>';

                    break;
            } // switch meta
        } // foreach $display

        if (!empty($meta_to_display)) {
            echo '<' . $wrapper . (('' != $wrapper_class) ? ' class="' . $wrapper_class . '"' : NULL) . '>';
            echo '<p>';
            echo implode(' ', $meta_to_display);
            echo '</p>';
            echo '</' . $wrapper . '>';
        }
    }
} // layers_post_meta


if (!function_exists('\Handyman\Front\tl_page_header_image')) {

    /**
     * @param int $post_id
     * @param string $size
     * @param bool $echo
     * @return string|void
     */
    function tl_page_header_image($post_id = 0, $attachment_id=0, $size = 'layers-landscape-large', $echo = false)
    {
        global $post;

        if ($post_id === 0) {
            $post_id = isset($post->ID) ? $post->ID : 0;
        }

        if(!$attachment_id && $post_id > 0){
            $attachment_id = \Handyman\Extras\get_metadata($post_id, '_tl_item_header_image');
        }

        $attachment_id = (int)$attachment_id;

        if (!$attachment_id) {
            if ($echo) {
                echo '';
                return;
            } else {
                return '';
            }
        }

        $src = wp_get_attachment_image_src($attachment_id, $size);
        if ($echo) {
            echo esc_url($src[0]);
        } else {
            return $src[0];
        }
    }
}


if (!function_exists('\Handyman\Front\tl_render_inline_css')) {

    /**
     * @param $css
     * @return string
     */
    function tl_render_inline_css($css)
    {
        $style = '';
        foreach ($css as $k => $line) {
            $style .= $k . ': ' . esc_attr($line) . ';';
        }
        return 'style="' . $style . '"';
    }
}


if (!function_exists('\Handyman\Front\tl_get_paged')) {
    /**
     * Are we in the middle of pagination
     *
     * @return int|mixed
     */
    function tl_get_paged()
    {
        global $wp_query;

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        return $paged;
    }
}


if(!function_exists('\Handyman\Front\tl_get_favicon')){

    /**
     * Get favicon tags
     */
    function tl_get_favicon(){

        $favicon_url = '';

        $fav = tl_copt('site_favicon', false);

        if(is_int($fav)){ // use default

            $fav = (int) $fav;
            $favicon_url = wp_get_attachment_image_src($fav);
            $favicon_url = $favicon_url[0];
        }else{
            $favicon_url = $fav;
        }

        ?>
        <link rel="icon" href="<?php echo esc_url($favicon_url) ?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo esc_url($favicon_url) ?>" type="image/x-icon" />
        <?php
    }
}


if (!function_exists('\Handyman\Front\tl_related_posts')) {

    /**
     * Return number of related posts
     *
     * @param int post id
     * @param int $n -1 for all realted posts
     * @param bool $echo
     */
    function tl_related_posts($post_id = 0, $n = 2, $echo = true)
    {
        global $post;

        if (!$post_id) {
            $post_id = $post->ID;
        }

        $tags = wp_get_post_tags($post_id);
        $tag_ids = array();

        if (!empty($tags)) {
            foreach ($tags as $t) {
                $tag_ids[] = $t->term_id;
            }
        }

        $args = array(
            'tag__in' => $tag_ids,
            'post__not_in' => array($post_id),
            'posts_per_page' => $n, // Number of related posts to display.
            'ignore_sticky_posts' => true
        );
        $query = new \WP_Query($args);

        if ($query->have_posts()): ?>

            <section class="related-posts-wrapper">
                <header class="section-title">
                    <h4 class="heading"><?php _e('Related Posts', TL_DOMAIN); ?></h4>
                </header>

                <div class="grid">
                    <?php
                    while ($query->have_posts()): $query->the_post();
                        get_template_part('partials/content', 'related-post-part');
                    endwhile;
                    ?>
                </div>
                <!-- .grid -->
            </section><!-- .related-posts-wrapper -->

        <?php endif;

        // Restore original Post Data
        wp_reset_postdata();
    }
}


if (!function_exists('\Handyman\Front\tl_the_posts_pagination')) {
    /**
     * Renders pagination
     *
     * @param array $args
     * @param bool $echo
     * @return string
     */
    function tl_the_posts_pagination($args = array(), $echo = true)
    {
        $defaults = array(
            'prev_text' => '<i class="icon-ti-angle-left"></i>',
            'next_text' => '<i class="icon-ti-angle-right"></i>'
        );

        $args       = wp_parse_args($args, $defaults);

        if ($echo) {
            echo   get_the_posts_pagination($args);
        } else {
            return get_the_posts_pagination($args);
        }
    }
}


/**
 * Prints Comment HTML
 *
 * @info overvrites parent's theme function
 *
 * @param    object $comment Comment objext
 * @param    array $args Configuration arguments.
 * @param    int $depth Current depth of comment, for example 2 for a reply
 * @echo     string                          Comment HTML
 */
if (!function_exists('\Handyman\Front\tl_layers_comment')) {

    function tl_layers_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>

        <?php if (2 < $depth && isset($GLOBALS['lastdepth']) && $depth != $GLOBALS['lastdepth']) { ?>
        <div class="grid comments-nested push-top">
    <?php } ?>
    <div <?php comment_class('content '); ?> id="comment-<?php comment_ID(); ?>">
        <div class="avatar push-bottom clearfix">
            <?php edit_comment_link(__('(Edit)', 'layerswp'), '<small class="pull-right">', '</small>') ?>
            <a class="avatar-image" href="">
                <?php echo get_avatar($comment, $size = '70'); ?>
            </a>

            <div class="avatar-body">
                <h5 class="avatar-name"><?php echo get_comment_author_link(); ?> <span><?php _e('says:', TL_DOMAIN); ?></span></h5>
                <small><?php printf(__('%1$s at %2$s', 'layerswp'), get_comment_date(), get_comment_time()) ?></small>
                <?php comment_reply_link(array_merge($args, array('depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => '<i class="fa fa-comment"></i>Reply'
                ))) ?>
            </div>
        </div>

        <div class="copy small">
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.', 'layerswp') ?></em>
                <br/>
            <?php endif; ?>
            <?php comment_text() ?>
        </div>
        <?php if (2 < $depth && isset($GLOBALS['lastdepth']) && $depth == $GLOBALS['lastdepth']) { ?>
        </div>
    <?php } ?>

        <?php $GLOBALS['lastdepth'] = $depth; ?>
    <?php }
} // layers_comment


if(!function_exists('\Handyman\Front\tl_layers_menu_fallback')){

    /**
     * Create menu items manually if one does not exist
     */
    function tl_layers_menu_fallback(){
        echo '<div class="tl-nav-container">
                <ul class="menu tl-main-navigation flexnav lg-screen">';
                    wp_list_pages('title_li=&');
        echo    '</ul></div>';
    }
}

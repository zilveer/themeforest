<?php
/*
* Function that return featured image or video for post
*/
if(!function_exists('a13_top_image_video')){
    function a13_top_image_video($link_it = false, $width = 'auto', $height = 0, $force_image = false){
        global $apollo13;

        $is_post = is_single();
        $is_page = is_page();
        $is_post_list = a13_is_post_list();

        //check if media should be displayed
        if(
            ($is_post && $apollo13->get_option('blog', 'post_media') == 'off')
            ||
            ($is_post_list && $apollo13->get_option('blog', 'blog_media') == 'off')
        )
            return;

        $post_id        = get_the_ID();
        $img_or_vid     = get_post_meta($post_id, '_image_or_video', true);
        $blog_variant   = $apollo13->get_option('blog', 'blog_variant');
        $image_slider   = $apollo13->get_option('blog', 'blog_sliders') === 'off' && $is_post_list;
        $image_video    = $apollo13->get_option('blog', 'blog_videos') === 'off' && $is_post_list;
        $align = '';
        $size = '';

        if( $force_image || empty( $img_or_vid ) || $img_or_vid === 'post_image' ){
            $thumb_size = 'apollo-post-thumb';

            if($is_post || $is_page){
                $align = ' '.get_post_meta($post_id, '_image_stretch', true);
                $size = get_post_meta($post_id, '_image_size', true);

                if($size == 'big') $thumb_size = 'apollo-post-thumb-big';
                elseif($size == 'original') $thumb_size = 'full';
                elseif($size == 'auto'){
                    if( defined('A13_FULL_WIDTH') || $apollo13->get_meta( '_widget_area' ) == 'off'){
                        $thumb_size = 'apollo-post-thumb-big';
                    }
                }
            }
            elseif($is_post_list){
                if($blog_variant === 'variant_short_list'){
                    $thumb_size = 'apollo-post-short_list';
                }
                elseif($blog_variant === 'variant_masonry'){
                    $thumb_size = 'apollo-post-masonry_blog';
                }
                elseif( defined('A13_FULL_WIDTH')){
                    $thumb_size = 'apollo-post-thumb-big';
                }
            }

            $img = a13_make_post_image($post_id, $thumb_size);

            if( !empty( $img ) ){
                if($link_it){
                    $img = '<a href="'.esc_url(get_permalink()).'">'.$img.'</a>';
                }
                ?>
            <div class="item-image post-media<?php echo $align; ?>">
                <?php echo $img; ?>
            </div>
            <?php
            }
        }

        elseif( $img_or_vid === 'post_video' ){
            //featured image instead of video?
            if($image_video){
                a13_top_image_video($link_it, $width, $height, true);
                return;
            }

            if($width === 'auto'){
                $width = 600;
            }

            if($is_post || $is_page){
                $align = ' '.get_post_meta($post_id, '_video_align', true);
                $size = get_post_meta($post_id, '_video_size', true);
                if($size == 'big') $width = 960;
            }

            $src = get_post_meta($post_id, '_post_video', true);
            if( !empty( $src ) ){
                ?>
            <div class="item-video post-media width-<?php echo $size.$align; ?>">
                <?php
                if( $height == 0){
                    $height = ceil((9/16) * $width);
                }

                $media_dimensions = array(
                    'width' => $width,
                    'height' => $height
                );
                $v_code = wp_oembed_get($src, $media_dimensions);

                //if no code, try theme function
                if($v_code === false){
                    echo a13_get_movie($src, $width, $height);
                }
                else{
                    echo $v_code;
                }
                ?>
            </div>
            <?php
            }
        }

        elseif($img_or_vid === 'revo_slider'){
            //featured image instead of slider?
            if($image_slider){
                a13_top_image_video($link_it, $width, $height, true);
                return;
            }

            function_exists('putRevSlider')? putRevSlider( get_post_meta($post_id, '_revolution_slider', true) ) : null;
        }
        elseif($img_or_vid === 'layer_slider'){
            //featured image instead of slider?
            if($image_slider){
                a13_top_image_video($link_it, $width, $height, true);
                return;
            }

            function_exists('layerslider')? layerslider( get_post_meta($post_id, '_layer_slider_val', true) ) : null;
        }
    }
}


/*
 * Serves all post meta: author, date, comments, tags, categories
 */
if(!function_exists('a13_post_meta')){
    function a13_post_meta($force = '') {
        global $apollo13;

        $types      = a13_what_page_type_is_it();
        $post       = $types['post'] || $force === 'post';
        $post_list  = $types['blog_type'] || $force === 'post_list';
        $work       = $types['work'] || $force === 'work';
        $gallery    = $types['gallery'] || $force === 'gallery';
        $return     = '';

        //return date
        if(
            ($post && $apollo13->get_option('blog', 'post_date') === 'on')
            ||
            ($work && $apollo13->get_option('cpt_work', 'work_date') === 'on')
            ||
            ($gallery && $apollo13->get_option('cpt_gallery', 'gallery_date') === 'on')
            ||
            ($post_list && $apollo13->get_option('blog', 'blog_date') === 'on')
        ){
            $return = a13_posted_on();
        }

        //return author
        if(
            ($post && $apollo13->get_option('blog', 'post_author') === 'on')
            ||
            ($work && $apollo13->get_option('cpt_work', 'work_author') === 'on')
            ||
            ($gallery && $apollo13->get_option('cpt_gallery', 'gallery_author') === 'on')
            ||
            ($post_list && $apollo13->get_option('blog', 'blog_author') === 'on')
        ){
            $return .= a13_posted_by_author();
        }

        //return categories
        if(
            ($post && $apollo13->get_option('blog', 'post_cats') === 'on')
            ||
            ($post_list && $apollo13->get_option('blog', 'blog_cats') === 'on')
        ){
            $return .= a13_post_categories().' ';
        }

        //return tags
        if(
            ($post && $apollo13->get_option('blog', 'post_tags') === 'on')
            ||
            ($post_list && $apollo13->get_option('blog', 'blog_tags') === 'on')
        ){
            $return .= a13_post_tags();
        }

        //return taxonomy for works
        if($work && $apollo13->get_option('cpt_work', 'work_cats') === 'on'){
            $temp = a13_cpt_work_posted_in(', ');
            if(strlen($temp)){
                $return .= sprintf( __( '<span class="cats">in %s</span> ', 'fame' ), $temp );
            }
        }

        //return comments number
        if(
            ($post && $apollo13->get_option('blog', 'post_comments') === 'on')
            ||
            ($work && $apollo13->get_option('cpt_work', 'work_comments') === 'on')
            ||
            (a13_is_post_list() && $apollo13->get_option('blog', 'blog_comments') === 'on')
        ){
            $return .= ', '.a13_post_comments();
        }

        if(strlen($return)){
            echo '<div class="post-meta">'.$return.'</div>';
        }
    }
}


/*
 * Date of post
 */
if(!function_exists('a13_posted_on')){
    function a13_posted_on( $intro_text = true ) {
        return $intro_text ?
            sprintf( __( 'Posted on <time class="entry-date" datetime="%1$s">%2$s</time> ', 'fame' ), get_the_date( 'c' ), get_the_date())
            :
            '<time class="entry-date" datetime="'.get_the_date( 'c' ).'">'.get_the_date().'</time>';
    }
}


/*
 * Author of post
 */
if(!function_exists('a13_posted_by_author')){
    function a13_posted_by_author() {
        return
            sprintf( __( 'by <a class="author" href="%1$s" title="%2$s">%3$s</a> ', 'fame' ),
                esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )),
                sprintf( esc_attr( __( 'View all posts by %s', 'fame' ) ), get_the_author() ),
                get_the_author()
            );
    }
}


/*
 * comments link
 */
if(!function_exists('a13_post_comments')){
    function a13_post_comments() {
        return '<a class="comments" href="' . esc_url(get_comments_link()) . '">'
            . sprintf(__( '<span class="label">Comments:</span> %d', 'fame' ), get_comments_number()) . '</a>';
    }
}


/*
 * Tags that post was posted in
 */
if(!function_exists('a13_post_tags')){
    function a13_post_tags() {
        $tags = '';
        $tag_list = get_the_tag_list( '',', ' );
        if ( $tag_list ) {
            $tags = sprintf( __( '<span class="tags">tagged %s</span> ', 'fame' ), $tag_list );
        }

        return $tags;
    }
}


/*
 * Categories that post was posted in
 */
if(!function_exists('a13_post_categories')){
    function a13_post_categories( ) {
        $cats = '';
        $cat_list = get_the_category_list(', ');
        if ( $cat_list ) {
            $cats = sprintf( __( '<span class="cats">in %s</span> ', 'fame' ), $cat_list );
        }

        return $cats;
    }
}


/*
 * Categories of work that it was posted in
 */
if(!function_exists('a13_posted_in')){
    function a13_posted_in() {
        $return = a13_cpt_work_posted_in(', ');

        if(strlen(trim($return))) //trim if only space is present(page type in search result for example)
            $return = '<span class="posted-in"><em>'.__( 'Categories', 'fame' ).'</em>'.$return.'</span>';

        return $return;
    }
}


/*
 * Return subtitle for page/post
 */
if(!function_exists('a13_subtitle')){
    function a13_subtitle($tag = 'h2', $id = 0) {
        if($id === 0){
            $id = get_the_ID();
        }

        $s = get_post_meta($id, '_subtitle', true);
        if(strlen($s))
            $s = '<'.$tag.'>'.$s.'</'.$tag.'>';

        return $s;
    }
}


/*
 * Modify password form
 */
if(!function_exists('a13_custom_password_form')){
    function a13_custom_password_form($content) {
        //copy of function
        //get_the_password_form()
        //from \wp-includes\post-template.php ~1222
        //with small changes
//        $post = get_post();

        $output = '
        <form class="password-form"  action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
            <p>' . __( 'This post is password protected. To view it please enter your password below:', 'fame' ) . '</p>
            <p class="inputs"><input name="post_password" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr(__( 'Submit', 'fame' )) . '" /></p>
        </form>
        ';

        return $output;
    }
}


/*
 * Sets the post excerpt length to 30 words.
 */
if(!function_exists('a13_excerpt_length')){
    function a13_excerpt_length( $length ) {
        global $apollo13;
        return $apollo13->get_option('blog', 'excerpt_length');
    }
}


/*
* This filter is used by wp_trim_excerpt() function.
* By default it set to echo '[...]' more string at the end of the excerpt.
*/
if(!function_exists('a13_new_excerpt_more')){
    function a13_new_excerpt_more($more) {
        global $post;
        return ' <a class="more-link" href="'. esc_url(get_permalink($post->ID)) . '">' . __( 'Read more ...', 'fame' ) . '</a>';
    }
}


/*
* Make excerpt for comments
* used in widgets
*/
if(!function_exists('a13_get_comment_excerpt')){
    function a13_get_comment_excerpt($comment_ID = 0, $num_words = 20) {
        $comment = get_comment( $comment_ID );
        $comment_text = strip_tags($comment->comment_content);
        $blah = explode(' ', $comment_text);
        if (count($blah) > $num_words) {
            $k = $num_words;
            $use_dotdotdot = 1;
        } else {
            $k = count($blah);
            $use_dotdotdot = 0;
        }
        $excerpt = '';
        for ($i=0; $i<$k; $i++) {
            $excerpt .= $blah[$i] . ' ';
        }
        $excerpt .= ($use_dotdotdot) ? '[...]' : '';
        return apply_filters('get_comment_excerpt', $excerpt);
    }
}


/*
 * It replaces WP default action while closing children comments block
 * Useful to save your nerves
 */
if(!function_exists('a13_comment_end')){
    function a13_comment_end( $comment, $args, $depth ) {
        echo '</div>';
        return;
    }
}


/*
 * Changes default comment template
 * Closing </div> for this block is produced by comment_end()
 * It is strange, I know :-)
*/
if(!function_exists('a13_comment')){
    function a13_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case '' :
                ?>
                    <div <?php comment_class( 'comment-block' ); ?> id="comment-<?php comment_ID(); ?>">

                        <a class="avatar" href="<?php esc_url(get_comment_author_url()); ?>" title=""><?php echo get_avatar( $comment, 50 ) ; ?></a>
                <div class="comment-inside">
                    <div class="comment-info">
                        <span class="author"><?php comment_author_link(); ?></span>
                        <?php
                        printf( '<a class="time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            esc_attr(get_comment_time( 'c' )),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s at %2$s', 'fame' ), get_comment_date(), get_comment_time() )
                        );
                        comment_reply_link( array_merge( $args, array( 'before' => '', 'reply_text' => '<i class="fa fa-share-square"></i>'.__be('Reply'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        ?>
                    </div>
                    <div class="comment-text">
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                        <p><em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'fame' ); ?></em></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
                break;
            case 'pingback'  :
            case 'trackback' :
                ?>
            <div <?php comment_class( 'comment-block' ); ?> id="comment-<?php comment_ID(); ?>">
                <div class="comment-inside clearfix">
                    <p><?php _e( 'Pingback:', 'fame' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( '(' . __( 'Edit', 'fame' ) . ')', ' ' ); ?></p>
                </div>
                    <?php
                break;
        endswitch;
    }
}



/*
 * Prints similar posts to current post/work
 */
if(!function_exists('a13_similar_posts')){
    function a13_similar_posts(){
        global $apollo13, $post;

        $is_work = defined('A13_WORK_PAGE');
        $widget_title = __( 'Similar Posts', 'fame' );

        //if deactivated then we have nothing to do here
        if(($is_work && $apollo13->get_option( 'cpt_work', 'posts_widget' ) !== 'on')
            ||
            (!$is_work && $apollo13->get_option( 'blog', 'posts_widget' ) !== 'on')){
            return;
        }

        if($is_work){
            $__search = wp_get_post_terms(get_the_ID(), A13_CPT_WORK_TAXONOMY, array("fields" => "slugs"));
            $widget_title = __( 'Similar Works', 'fame' );
        }
        else{
            $__search = wp_get_post_tags($post->ID);
            $search_string = 'tags__in';
            //if no tags try categories
            if( !count($__search) ){
                $__search = wp_get_post_categories($post->ID);
                $search_string = 'category__in';
            }
        }

        if ( count($__search) ) {
            //search query
            if($is_work){
                $r = new WP_Query(
                    array(
                        'post_type' => A13_CUSTOM_POST_TYPE_WORK,
                        'tax_query' => array(
                            array(
                                'taxonomy' => A13_CPT_WORK_TAXONOMY,
                                'field' => 'slug',
                                'terms' => $__search,
                                'operator' => 'IN'
                            )
                        ),
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 4,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => true)
                );
            }
            else{
                $r = new WP_Query(
                    array(
                        $search_string => $__search,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 3,
                        'no_found_rows' => true,
                        'post_status' => 'publish',
                        'ignore_sticky_posts' => true)
                );
            }

            if ($r->have_posts()) :
                echo '
                            <div class="in_post_widget'.($is_work? ' bricks_small non-fluid '.$apollo13->get_option('cpt_work', 'hover_type' ) : '').'">
                                <h3 class="title widget-title"><span>'.$widget_title.'</span></h3>
                                <div class="widget-inside clearfix">';

                while ($r->have_posts()) : $r->the_post();
                    if($is_work){
                        $show_titles        = $apollo13->get_option('cpt_work', 'show_titles') === 'on';
                        $show_subtitles     = $apollo13->get_option('cpt_work', 'show_subtitles') === 'on';
                        $is_openable        = $apollo13->get_meta('_openable') === 'on'; //if not openable we will show lightbox instead
                        $post_id            = get_the_ID();
                        $href               = $is_openable? get_permalink() : a13_get_post_image_src($post_id, 'full');
                        $image_size_string  = 'cpt-cover-medium';

                        echo '<div class="g-item item">';
                        echo '<a class="g-link'.($is_openable? ' link"' : ' alpha-scope" data-group="gallery"').'" href="'.esc_url($href).'" id="work-' . $post_id . '">';
                        echo a13_make_work_image($post_id, $image_size_string );
                        echo '<em class="cov"><span>'.($show_subtitles? a13_subtitle('small') : '').($show_titles? '<strong>'.get_the_title().'</strong>' : '').'</span></em>';
                        echo '</a>';

                        //like plugin
                        if( function_exists('dot_irecommendthis') ){
                            dot_irecommendthis();
                        }

                        echo '</div>';
                    }
                    else{
                        $page_title = get_the_title();
                        $class = ''; //empty for easily commenting out
                        $image_size = 'apollo-post-brick' ;
                        $img = a13_make_post_image( get_the_ID(), $image_size );

                        echo '<div class="item'.$class.'">';

                        if(strlen($img)){
                            echo '
                                        <div class="item-image post-media">
                                            <a href="' . get_permalink() . '" title="' . esc_attr($page_title) . '">' . $img . '<em></em></a>
                                        </div>';
                        }

                        echo '<a class="post-title" href="' . get_permalink() . '" title="' . esc_attr($page_title) . '">' . $page_title . '</a>';

                        echo '</div>';
                    }

                endwhile;

                echo '</div></div>';

                // Reset the global $the_post as this query will have stomped on it
                wp_reset_postdata();

            endif;
        }
    }
}


/*
 * Navigation through custom post type
 */
if(!function_exists('a13_cpt_nav')){
    function a13_cpt_nav() {
        global $apollo13;
        $show_back_btn = true;
        $href = '';
        $product = a13_is_woocommerce_activated() ? is_product() : false;
	    $navigate_through_categories = $apollo13->get_option( 'cpt_work', 'navigate_by_categories' ) === 'on';

        if( defined( 'A13_WORK_PAGE' )){
            if($apollo13->get_option('cpt_work', 'works_nav') === 'off'){
                //nothing to do
                return;
            }

	        if($navigate_through_categories){
		        $term_list = wp_get_post_terms(get_the_ID(), A13_CPT_WORK_TAXONOMY, array("fields" => "all"));
		        $count_terms = count( $term_list );
		        if($count_terms > 0){
			       $term = $term_list[0];
			        $title = sprintf(__( 'Back to %s', 'fame' ), $term->name);
			        $href = get_term_link($term);
		        }
		        else{
			        $show_back_btn = false;
		        }
	        }
	        else{
	            $works_id = $apollo13->get_option( 'cpt_work', 'cpt_work_page' );
	            $title = sprintf(__( 'Back to %s', 'fame' ), $apollo13->get_option('cpt_work', 'works_list_title'));
	            if($works_id !== '0'){
	                $href = get_permalink($works_id);
	            }
	            //works list as front page
	            elseif($apollo13->get_option( 'settings', 'fp_variant' ) == 'works_list'){
	                $href = home_url( '/' );
	            }
	            else{
	                $show_back_btn = false;
	            }
	        }
        }
        elseif( $product ){
            $shop_id = wc_get_page_id( 'shop' );
            $title = sprintf(__( 'Back to %s', 'fame' ), get_the_title($shop_id));
            if($shop_id !== '0'){
                $href = get_permalink($shop_id);
            }
            else{
                $show_back_btn = false;
            }
        }
        elseif( defined( 'A13_GALLERY_PAGE' )){
            $works_id = $apollo13->get_option( 'cpt_gallery', 'cpt_gallery_page' );
            $title = sprintf(__( 'Back to %s', 'fame' ), $apollo13->get_option('cpt_work', 'galleries_list_title'));
            if($works_id !== '0'){
                $href = get_permalink($works_id);
            }
            //galleries list as front page
            elseif($apollo13->get_option( 'settings', 'fp_variant' ) == 'galleries_list'){
                $href = home_url( '/' );
            }
            else{
                $show_back_btn = false;
            }
        }
        else{
            //used in wrong place?
            return;
        }

        echo '<div class="cpt-nav">';
        echo $show_back_btn? '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" class="to-cpt-list"><i class="fa fa-undo"></i>'.$title.'</a>' : '';

	    if( defined( 'A13_WORK_PAGE' ) && $navigate_through_categories ){
		    next_post_link( '<span class="prev">%link</span>','', true, '', A13_CPT_WORK_TAXONOMY );
		    previous_post_link( '<span class="next">%link</span>','', true, '', A13_CPT_WORK_TAXONOMY );
	    }
	    else{
		    next_post_link( '<span class="prev">%link</span>','' );
		    previous_post_link( '<span class="next">%link</span>','' );
	    }

	    echo '</div>';
    }
}


/*
 * Pagination for blog pages
 */
if(!function_exists('a13_blog_nav')){
    function a13_blog_nav() {
        //if WP Painate plugin is installed and active
        if(function_exists('wp_paginate')) {
            wp_paginate();
        }
        //theme pagination
        else{
            global $paged, $wp_query;
            //safe copy for operations
            $c_paged = $paged;

            $max_page = $wp_query->max_num_pages;

            if ( $max_page > 1 ) : ?>
            <div id="posts-nav" class="navigation">
                <?php
                echo '<span class="nav-previous">';
                previous_posts_link( __( 'Previous', 'fame' ) );
                echo '</span>';

                //if first page
                if($c_paged === 0){
                    $c_paged = 1;
                }
                for($page = 1; $page <= $max_page; $page++){
                    if($page == $c_paged)
                        echo '<span class="current">'.$page.'</span>';
                    else
                        echo '<a href="'.esc_url(get_pagenum_link($page)).'" title="'.esc_attr($page).'">'.$page.'</a>';
                }

                echo '<span class="nav-next">';
                next_posts_link( __( 'Next', 'fame' ) );
                echo '</span>';
                ?>
            </div>
            <?php endif;
        }
    }
}



/* Credits to http://hirizh.name/blog/styling-chat-transcript-for-custom-post-format/ */
if ( !function_exists('a13_daoon_chat_post') ) {
    function a13_daoon_chat_post($content) {
        $chatoutput = "<div class=\"chat\">\n";
        $split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/", $content);
        foreach($split as $haystack) {
            if (strpos($haystack, ":")) {
                $string = explode(":", trim($haystack), 2);
                $who = strip_tags(trim($string[0]));
                $what = strip_tags(trim($string[1]));
                $row_class = empty($row_class)? " class=\"chat-highlight\"" : "";
                $chatoutput .= "<p><strong class=\"who\">$who:</strong> $what</p>\n";
            } else {
                $chatoutput .= $haystack . "\n";
            }
        }

        // print our new formated chat post
        $content = $chatoutput . "</div>\n";
        return $content;
    }
}



add_filter( 'excerpt_length', 'a13_excerpt_length' );
add_filter( 'excerpt_more', 'a13_new_excerpt_more' );
add_filter( 'the_password_form', 'a13_custom_password_form');


add_filter( 'comment_form_fields', 'a13_old_comment_form_order' );
/*
 * Fixes order of fields in comment form that was changed in WordPress 4.4
 */
if(!function_exists('a13_old_comment_form_order')){
    function a13_old_comment_form_order($comment_fields){
        reset($comment_fields);
        $first_key = key($comment_fields);
        if($first_key === 'comment'){
            $v = $comment_fields['comment'];
            unset($comment_fields['comment']);
            $comment_fields['comment'] = $v;
        }

        return $comment_fields;
    }
}

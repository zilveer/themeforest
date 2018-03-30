<?php
if ( ! isset( $content_width ) ) $content_width = 900;

function tfuse_browser_body_class($classes) {
    global $is_gecko, $is_IE, $is_opera, $is_safari, $is_chrome;

    if($is_gecko)      $classes[] = 'gecko';
    elseif($is_opera)  $classes[] = 'opera';
    elseif($is_safari) $classes[] = 'safari';
    elseif($is_chrome) $classes[] = 'chrome';
    elseif($is_IE)     $classes[] = 'ie';
    else               $classes[] = 'unknown';

    return $classes;
}
add_filter('body_class','tfuse_browser_body_class');


if (!function_exists('tfuse_custom_logo')) :
    function tfuse_custom_logo(){
        if(tfuse_options('logo_type','image')=='text'){ ?>
            <h2><a href="<?php echo home_url(); ?>"><?php echo tfuse_options('text_logo','Portfolio'); ?></a></h2>
        <?php }
        else { ?>
        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
            <img src="<?php echo tfuse_logo(); ?>" alt="<?php bloginfo('name'); ?>"  border="0" />
        </a>
    <?php }
    }
endif;

if (!function_exists('tfuse_class')) :
/* This Function Add the classes for middle container
 * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle') {
            if ($sidebar_position == 'left')
                $tfuse_class = ' class="clearfix sidebar_left"';
            elseif ($sidebar_position == 'right')
                $tfuse_class = ' class="clearfix sidebar_right"';
            else
                $tfuse_class = ' class="clearfix full_width"';
        }
        elseif ($param == 'content') {
            $tfuse_class = ( isset($sidebar_position) && $sidebar_position != 'full' ) ? ' class="content span8"' : ' class="content span12"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;
        global $post;
        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;

if (!function_exists('tfuse_loveit')) :
    /**
     * Dsiplay love it
     *
     * To override tfuse_loveit() in a child theme, add your own tfuse_loveit()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_loveit($id = '')
    {
        $count1 = 0;
        if (is_numeric($id))
        {
            $count = get_post_meta($id,'tfuse_love_it', true);
        }
        if( $count == '' ) $count = $count1;

        echo '<input type="hidden" class="love_it_hidden" id="hidden_' . $id . '" value="' . $count .'">';
    }
endif;

if (!function_exists('tfuse_loveit_class')) :
    function tfuse_loveit_class($id = ''){
        global $TFUSE;
        $ids = $TFUSE->request->COOKIE('tfuse_loves');
        $arr = explode(';',$ids);
        foreach($arr as $item){
            $item = (int)$item;
            if($id == $item) {
                $class = 'tfuse_loved';
                break;
            }
            else $class = 'love_it';
        }
        echo $class;
    }
endif;

if (!function_exists('tfuse_custom_title')):
    function tfuse_custom_title() {
        global $is_tf_blog_page;
        if(is_front_page()) {
            $tfuse_title_type = tfuse_options('page_title','hide_title');
        }
        else if($is_tf_blog_page) {
            $tfuse_title_type = tfuse_options('page_title_blog','hide_title');
        }
        else if(is_search()) {
            $tfuse_title_type = tfuse_options('page_title_search','hide_title');
        }
        else if(is_404()) {
            $tfuse_title_type = tfuse_options('page_title_404','hide_title');
        }
        else if(is_tag()) {
            $tfuse_title_type = tfuse_options('page_title_tag','hide_title');
        }
        else if(is_category()) {
            $cat_ID = get_query_var('cat');
            $term = get_term_by('id', $cat_ID, 'category');
            $tfuse_title_type = tfuse_options('page_title','',$cat_ID);
        }
        else if(is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $tfuse_title_type = tfuse_options('page_title','',$cat_ID);
        }
        else if(is_archive()) {
            if(isset($_GET['posts']) && $_GET['posts'] == 'all') $tfuse_title_type = tfuse_options('page_title_all','hide_title');
            else $tfuse_title_type = tfuse_options('page_title_archive','hide_title');
        }
        else if( is_page() || is_single() ) $tfuse_title_type = tfuse_page_options('page_title');
        else $tfuse_title_type = 'hide_title';

        $title = $subtitle = $align = '';
        if ($tfuse_title_type == 'custom_title'){
            if(is_front_page()){
                $title = tfuse_options('custom_title','');
                $subtitle = tfuse_options('custom_subtitle','');
                $align = tfuse_options('subtitle_alignment','');
            }
            elseif($is_tf_blog_page){
                $title = tfuse_options('custom_title_blog','');
                $subtitle = tfuse_options('custom_subtitle_blog','');
                $align = tfuse_options('subtitle_alignment_blog','');
            }
            elseif( is_search() ){
                $title = tfuse_options('custom_title_search','');
                $subtitle = tfuse_options('custom_subtitle_search','');
                $align = tfuse_options('subtitle_alignment_search','');
            }
            elseif( is_404() ){
                $title = tfuse_options('custom_title_404','');
                $subtitle = tfuse_options('custom_subtitle_404','');
                $align = tfuse_options('subtitle_alignment_404','');
            }
            elseif( is_tag() ){
                $title = tfuse_options('custom_title_tag','');
                $subtitle = tfuse_options('custom_subtitle_tag','');
                $align = tfuse_options('subtitle_alignment_tag','');
            }
            elseif(is_category() || is_tax() ) {
                $title = tfuse_options('custom_title','',$cat_ID);
                $subtitle = tfuse_options('custom_subtitle','',$cat_ID);
                $align = tfuse_options('subtitle_alignment','',$cat_ID);
            }
            elseif( is_page() || is_single() ){
                $title = tfuse_page_options('custom_title');
                $subtitle = tfuse_page_options('custom_subtitle');
                $align = tfuse_page_options('subtitle_alignment');
            }
            elseif(is_archive()) {
                if(isset($_GET['posts']) && $_GET['posts'] == 'all'){
                    $title = tfuse_options('custom_title_all','');
                    $subtitle = tfuse_options('custom_subtitle_all','');
                    $align = tfuse_options('subtitle_alignment_all','');
                }
                else {
                    $title = tfuse_options('custom_title_archive','');
                    $subtitle = tfuse_options('custom_subtitle_archive','');
                    $align = tfuse_options('subtitle_alignment_archive','');
                }
            }
        }
        elseif ($tfuse_title_type == 'default_title'){
            if(is_category() || is_tax() ) {
                $title = $term->name;
                $subtitle = '';
                $align = '';
            }
            elseif( is_page() || is_single() ){
                $title = get_the_title();
            }
        }

        if ($tfuse_title_type != 'hide_title') {
            if($align == 'right') $class = 'alignleft';
            else $class = '';

            if($title != '') echo '<div class="page_title '.$class.' clearfix"><h1>'.$title.'</h1></div>';
            if($subtitle != ''){
                if($align == 'right')
                    echo '<div class="reply"><h2>'.$subtitle.'</h2></div>';
                else
                    echo '<div class="reply clearfix text-center"><h1>'.$subtitle.'</h1></div>';
            }
        }
    }
endif;


if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;
        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );
        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');
        $_meta = array_merge($standard_meta,$custom_meta);
        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }
        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_action_comments()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        if (tfuse_page_options('enable_comments'))
            comments_template( '', true );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);
        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }
endif;


function tfuse_pagination( $args = array(), $query = '' ) {
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
            'type' => 'plain',
            'before' => '',
            'after' => '',
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
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );
        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );
        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];
        /* Return the paginated links for use in themes. */
        if ( $args['echo'] )
        { ?>
            <!-- tf_pagination -->
            <div class="tf_pagination">
                <?php echo $prev_posts = get_previous_posts_link(__('<span class="prev_page">&lt;</span>', 'tfuse')); ?>
                <?php echo $page_links; ?>
                <?php echo $next_posts = get_next_posts_link(__('<span class="next_page">&gt;</span>', 'tfuse')); ?>
            </div><!-- /.tf_pagination -->
        <?php }
        else return $page_links;
} 


if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post;

        if($position == 'before') $position = 'content_top';
        elseif($position == 'after') $position = 'content_bottom';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
                $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        {
            $page_shortcodes = tfuse_options($position.'_blog');
        }
        elseif (is_search()) {
            $page_shortcodes = tfuse_options($position.'_search', '');
        }
        elseif (is_404()) {
            $page_shortcodes = tfuse_options($position.'_404', '');
        }
        elseif (is_tag()) {
            $page_shortcodes = tfuse_options($position.'_tag', '');
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position.'_cat', '', $cat_ID);
        } 
        elseif (is_tax()) {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position.'_cat', '', $cat_ID);
        }
        elseif (is_archive()) {
            if(isset($_GET['posts']) && $_GET['posts'] == 'all' && isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio'){
                $page_shortcodes = tfuse_options($position.'_port_archive', '');
            }
            else{
                $page_shortcodes = tfuse_options($position.'_archive', '');
            }
        }

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);
        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if( !empty($page_shortcodes) && ($position == 'content_bottom'|| $position == 'content_bottom_blog')  )
            {
                echo '<div class="middle_row">';
                    echo '<div class="container clearfix">';
                    echo $page_shortcodes;
                    echo '</div>';
                echo '</div>';
            }
            else
                echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;
        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $specific = tfuse_options('categories_select_categ');
            $ids = explode(",",$specific);
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }
            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive.php';
            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
        elseif($homepage_categ == 'all_tax')
        {
            $archive = 'archive-portfolio.php';
            include_once(locate_template($archive));
            die();
        }
        elseif($homepage_categ == 'specific_tax')
        {
            $archive = 'archive-portfolio.php';
            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_pre_get_posts')) :
    function tfuse_pre_get_posts($query){
        if ( $query->is_home() && $query->is_main_query() ) {
            global $is_tf_front_page;
            $is_tf_front_page = true;
            $homepage_category = tfuse_options('homepage_category');
            if($homepage_category == 'all_tax')
            {
                $items = get_option('posts_per_page');
                $query->set( 'posts_per_page', $items );
                $query->set( 'post_type', array('portfolio') );
            }
            elseif($homepage_category == 'specific_tax')
            {
                $items = get_option('posts_per_page');
                $taxonomies = get_terms('group', array('hide_empty' => 0));
                $homepage_tax = tfuse_options('categories_select_tax');
                $homepage_tax = explode(",",$homepage_tax);

                $query->set( 'posts_per_page', $items );
                $query->set( 'post_type', array('portfolio') );
                $query->set( 'tax_query', array(
                    array(
                        'taxonomy' => 'group',
                        'field' => 'id',
                        'terms' => $homepage_tax,
                    ) ));
            }
        }
        return $query;
    }
    add_filter('pre_get_posts', 'tfuse_pre_get_posts');
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }
            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        elseif($blogpage_categ == 'all')
        {  
            $is_tf_blog_page = true;
            $archive = 'archive.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();
            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }
            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);
            include_once(locate_template($archive));
            return;
        }
        elseif($blogpage_categ == 'all_tax')
        {
            $archive = 'archive-portfolio.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $is_tf_blog_page = true;
            $items = get_option('posts_per_page');
            $taxonomies = get_terms('group', array('hide_empty' => 0));

            $slug=array();
            foreach($taxonomies as $tax){
                $slug[]=$tax->slug;
            }

            $args = array(
                'paged' => $paged,
                'posts_per_page' => $items,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'group',
                        'field' => 'slug',
                        'terms' => $slug,
                    ),
                )
            );
            $posts = query_posts ($args);
            wp_reset_postdata();
            include_once(locate_template($archive));
            die();
        }
        elseif($blogpage_categ == 'specific_tax')
        {
            $archive = 'archive-portfolio.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $is_tf_blog_page = true;
            $items = get_option('posts_per_page');
            $taxonomies = get_terms('group', array('hide_empty' => 0));
            $homepage_tax = tfuse_options('categories_select_tax_blog');
            $homepage_tax = explode(",",$homepage_tax);

            $slug=array();
            foreach($taxonomies as $tax){
                $slug[]=$tax->slug;
            }
            $args = array(
                'paged' => $paged,
                'posts_per_page' => $items,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'group',
                        'field' => 'id',
                        'terms' => $homepage_tax,
                    ),
                )
            );
            $posts = query_posts ($args);
            wp_reset_postdata();
            include_once(locate_template($archive));
            die();
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;


if (!function_exists('tfuse_action_footer')) :
/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() { ?>

        <div class="span4">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>

        <div class="span4">
            <?php dynamic_sidebar('footer-2'); ?>
        </div>

        <div class="span4">
            <?php dynamic_sidebar('footer-3'); ?>
        </div>

    <?php }
    add_action('tfuse_footer', 'tfuse_action_footer');
endif;


function custom_excerpt_length( $length ) {
    return 43;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;


if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				    foreach ($attachments as $attachment) {
                        $value = $attachment->guid;
                        tfuse_set_page_option($option_name, $value, $post->ID);
                        tfuse_set_page_option('disable_image', true , $post->ID);
                    }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
        tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}

//filter for read more
if (!function_exists('custom_excerpt_more')) :
    /**
     * Custom excerpt more
     *
     * To override custom_excerpt_more() in a child theme, add your own custom_excerpt_more()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function custom_excerpt_more() {
        $more = '&nbsp;<a href="' . get_permalink() . '" class="link-more">'.__('Read More','tfuse').'</a>';
        return $more;
    }
    add_filter( 'excerpt_more', 'custom_excerpt_more' );
endif;

if (!function_exists('custom_excerpt_more_shortcode')) :
    // for excerpt in shortcode recent_post and populat post
    function custom_excerpt_more_shortcode() {
        return '';
    }
endif;

//for image in rss
if(!function_exists('tfuse_feedFilter')) :
    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }
endif;

/* filer for submenu */
function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/',' class="mega-menu-inner submenu_list submenu-1"',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');

if ( !function_exists('tfuse_footer_social')):
    function tfuse_footer_social(){
        if(tfuse_options('social_twitter')!='') echo '<a target="_blank" href="'.tfuse_options('social_twitter').'" class="tweet_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_facebook')!='') echo '<a target="_blank" href="'.tfuse_options('social_facebook').'" class="fb_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_google')!='') echo '<a target="_blank" href="'.tfuse_options('social_google').'" class="google_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_vimeo')!='') echo '<a target="_blank" href="'.tfuse_options('social_vimeo').'" class="vimeo_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_flickr')!='') echo '<a target="_blank" href="'.tfuse_options('social_flickr').'" class="flickr_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_linked')!='') echo '<a target="_blank" href="'.tfuse_options('social_linked').'" class="linkedin_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_dribble')!='') echo '<a target="_blank" href="'.tfuse_options('social_dribble').'" class="drible_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_pinterest')!='') echo '<a target="_blank" href="'.tfuse_options('social_pinterest').'" class="pinterest_ico"><span class="ico_social"></span></a>';
        if(tfuse_options('social_behance')!='') echo '<a target="_blank" href="'.tfuse_options('social_behance').'" class="behance_ico"><span class="ico_social"></span></a>';
    }
endif;

function tfuse_set_blog_page(){
    global $wp_query,$is_tf_blog_page;
    if(isset($wp_query->queried_object->ID)) $id_post = $wp_query->queried_object->ID;
    elseif(isset($wp_query->query['page_id'])) $id_post = $wp_query->query['page_id'];
    else $id_post = 0;
    if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
}
add_action('wp_head','tfuse_set_blog_page');

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;

if (!function_exists('tfuse_meta_width')) :
    function tfuse_meta_width($post_type){
        $sidebar_position = tfuse_sidebar_position();
        if((tfuse_page_options('single_image')!='' || tfuse_page_options('thumbnail_image')!='') && $post_type != 'gallery'){
            if( is_single() ) $dim = tfuse_page_options('single_img_dimensions');
            else $dim = tfuse_page_options('thumbnail_dimensions');
            $width = $dim['0'];
        }
        else {
            if($sidebar_position == 'full') $width = 960;
            else $width = 612;
        }
        return $width;
    }
endif;

if ( !function_exists('tfuse_get_post_gallery')):
    function tfuse_get_post_gallery(){
        global $post;
        $attachments = tfuse_get_gallery_images($post->ID,TF_THEME_PREFIX . '_post_gallery');
        $slider_images = array();
        if ($attachments) {
            foreach ($attachments as $attachment){
                if( isset($attachment->image_options['imgexcludefromslider_check']) ) continue;

                $slider_images[] = array(
                    'id'         => $attachment->ID,
                    'title'      => apply_filters('the_title', $attachment->post_title),
                    'order'      => $attachment->menu_order,
                    'img_full'   => $attachment->guid
                );
            }
        }

        if(sizeof($slider_images)) :
            $slider_images = tfuse_aasort($slider_images,'order');
            $uniq = rand(1,100);
            $sidebar_position = tfuse_sidebar_position();
            if($sidebar_position == 'full'){
                $width  = 960;
                $height = 460;
                $meta_width = 960;
            }
            else{
                $width  = 630;
                $height = 286;
                $meta_width = 612;
            }
            ?>
            <div class="post_img" id="post_gallery_img<?php echo $uniq; ?>">
                <?php foreach($slider_images as $slide){
                    $image = new TF_GET_IMAGE();
                    $tfuse_image = $image->width($width)->height($height)->src($slide['img_full'])->get_img();
                    echo $tfuse_image;
                } ?>
            </div>
            <?php if(tfuse_page_options('enable_post_meta',true)){ ?>
                <div class="meta_info clearfix" <?php echo 'style="width:'.$meta_width.'px"'; ?>>
                    <?php if(tfuse_page_options('enable_published_date',true)){ ?>
                        <span class="meta_date"><?php echo get_the_date(); ?></span>
                    <?php } ?>
                    <?php if(tfuse_page_options('enable_author_post',true)){ ?>
                        <span class="meta_author"><?php the_author_posts_link(); ?></span>
                    <?php } ?>
                    <a class="next alignright" id="service_item_next<?php echo $uniq; ?>" href="#"></a>
                    <a class="prev alignright" id="service_item_prev<?php echo $uniq; ?>" href="#"></a>
                    <?php if(!is_single()){ ?>
                        <a class="link_more" href="<?php the_permalink(); ?>"></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <script>
                jQuery(window).load(function() {
                    jQuery("#post_gallery_img<?php echo $uniq; ?>").carouFredSel({
                        width: "100%",
                        height: "variable",
                        items: {
                            visible: "variable",
                            minimum: 1,
                            width: "variable",
                            height: "variable"
                        },
                        scroll: {
                            items: 1,
                            pauseOnHover: true,
                            fx:"crossfade"
                        },
                        auto: 7000,
                        prev: "#service_item_prev<?php echo $uniq; ?>",
                        next: "#service_item_next<?php echo $uniq; ?>",
                        swipe: true,
                        mousewheel: false
                    });
                });
            </script>
        <?php endif;
    }
endif;

if (!function_exists('tfuse_filter_get_avatar')){

    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){

        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if ( !empty($email) )
            $email_hash = md5( strtolower( trim( $email ) ) );
        else $email_hash = '';

        $url = 'http://gravatar.com/' . $email_hash . '.php';
        $result = unserialize(@file_get_contents($url));
        if(!is_array($result)){
            $avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src, $size, $size)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }
        return $avatar;
    }

    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}

if ( !function_exists('SearchFilter')):
    function SearchFilter($query) {
        if ($query->is_search) {
            $query->set('post_type', 'post');
        }
        return $query;
    }
endif;
add_filter('pre_get_posts','SearchFilter');

if ( !function_exists('tfuse_get_portfolio_columns')):
    function tfuse_get_portfolio_columns(){
        global $is_tf_blog_page,$is_tf_front_page;
        if($is_tf_blog_page)
            $columns = tfuse_options('portfolio_column_blog',2);
        elseif($is_tf_front_page)
            $columns = tfuse_options('portfolio_column',2);
        elseif(is_tax()){
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $cat_id = $term->term_id;
            $columns = tfuse_options('portfolio_column',2,$cat_id);
        }
        elseif(is_archive()){
            $columns = tfuse_options('portfolio_column_all',2);
        }
        else $columns = 2;
        return $columns;
    }
endif;

if ( !function_exists('tfuse_show_filter')):
    function tfuse_show_filter(){
        global $is_tf_blog_page;
        if($is_tf_blog_page){
            $show_filter = tfuse_options('show_filter_blog',true);
        }
        elseif(is_front_page()) {
            $show_filter = tfuse_options('show_filter',true);
        }
        elseif(is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $term_id = $term->term_id;
            $show_filter = tfuse_options('show_filter',true,$term_id);
        }
        elseif(is_archive()){
            if(isset($_GET['posts']) && $_GET['posts'] == 'all')
                $show_filter = tfuse_options('show_filter_all',true);
            else $show_filter = false;
        }
        else $show_filter = false;

        if($show_filter){ ?>
            <div class="row">
                <div class="span12">
                    <ul class="filter_menu">
                        <?php
                        global $TFUSE;
                        $filter = $TFUSE->request->isset_GET('posts') ? $TFUSE->request->GET('posts') : "";
                        if($filter == 'all' || is_front_page() || $is_tf_blog_page)
                        {
                            $args = array( 'taxonomy' => 'group' );
                            $terms = get_terms('group', $args);
                        }
                        else
                        {
                            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
                            $group = $term->taxonomy;
                            $term_id = $term->term_id;
                            $template_slug= $term->slug;
                            $template_parent= $term->parent;
                            $args = array( 'taxonomy' => $group );
                            $terms = get_terms($group, $args);
                            if($template_parent==0) $template_parent = $term_id;
                        }
                        $count = count($terms);
                        $i = 0;
                        if ($count > 0)
                        {
                            foreach ($terms as $term)
                            {
                                $slug = $term->slug; break;
                            }

                            $term_all = $all = $term_list_view_all = '';

                            if($filter == 'all')
                            {
                                $term_all .= '<li class="current-menu-item"><a href="'.get_bloginfo('url').'/?post_type=portfolio&posts=all">'.__('All','tfuse').'</a></li>';
                            }
                            elseif($filter != 'all')
                            {
                                $term_all .='<li><a href="'.get_bloginfo('url').'/?post_type=portfolio&posts=all">'.__('All','tfuse').'</a></li>';
                            }
                            if($filter == 'all' || is_front_page() || $is_tf_blog_page)
                            {
                                foreach ($terms as $term)
                                {
                                    $i++;
                                    if($term->parent == 0)
                                    {
                                        $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                                    }
                                }
                            }
                            else
                            {
                                foreach ($terms as $term)
                                {
                                    $i++;
                                    if($term->parent == 0)
                                    {
                                        if($term->slug==$template_slug && $filter != 'all')
                                        {
                                            $term_list_view_all .= '<li class="current-menu-item"><a href="'.get_bloginfo('url').'/?group=' .$term->slug.  '">'.$term->name.'</a></li>';
                                        }
                                        elseif($template_parent==$term->term_id && $filter == 'all')
                                        {
                                            $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                                        }
                                        else
                                        {
                                            $term_list_view_all .= '<li><a href="'.get_bloginfo('url').'/?group=' .$term->slug. '">'.$term->name.'</a></li>';
                                        }
                                    }
                                }
                            }
                            echo $term_all.$term_list_view_all;
                        } ?>
                    </ul>
                </div><!-- /.span12 -->
            </div><!-- /.row -->
        <?php }
    }
endif;

if (!function_exists('tfuse_bk_style')) :
    function tfuse_bk_style() {
        global $is_tf_blog_page,$post;
        if( $is_tf_blog_page ){
            if(tfuse_options('background_image_blog')!='' || tfuse_options('background_color_blog')!='')
                echo 'style="background:url('. tfuse_options('background_image_blog').')'. ' '.tfuse_options('background_position_blog') .' '
                    .tfuse_options('repeat_image_blog') . tfuse_options('background_color_blog').'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_front_page() )
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $cat_ID = $post->ID;
                if(tfuse_page_options('background_image',null,$cat_ID)!='' || tfuse_page_options('background_color',null,$cat_ID)!='')
                    echo 'style="background:url('.tfuse_page_options('background_image',null,$cat_ID).' )'. ' '. tfuse_page_options('background_position',null,$cat_ID).' '
                        .tfuse_page_options('repeat_image',null,$cat_ID). tfuse_page_options('background_color',null,$cat_ID).'"';
                else
                    echo 'style="background:url('. tfuse_page_options('background_image_default').')'. ' '.tfuse_page_options('background_position_default') .' '
                        .tfuse_page_options('repeat_image_default') . tfuse_page_options('background_color_default').'"';
            }
            else{
                if(tfuse_options('background_image')!='' || tfuse_options('background_color')!='')
                    echo 'style="background:url('. tfuse_options('background_image').')'. ' '.tfuse_options('background_position') .' '
                        .tfuse_options('repeat_image') . tfuse_options('background_color').'"';
                else
                    echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                        .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
            }
        }
        elseif( is_search() ){
            if(tfuse_options('background_image_search')!='' || tfuse_options('background_color_search')!='')
                echo 'style="background:url('. tfuse_options('background_image_search').')'. ' '.tfuse_options('background_position_search') .' '
                    .tfuse_options('repeat_image_search') . tfuse_options('background_color_search').'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_404() ){
            if(tfuse_options('background_image_404')!='' || tfuse_options('background_color_404')!='')
                echo 'style="background:url('. tfuse_options('background_image_404').')'. ' '.tfuse_options('background_position_404') .' '
                    .tfuse_options('repeat_image_404') . tfuse_options('background_color_404').'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_tag() ){
            if(tfuse_options('background_image_tag')!='' || tfuse_options('background_color_tag')!='')
                echo 'style="background:url('. tfuse_options('background_image_tag').')'. ' '.tfuse_options('background_position_tag') .' '
                    .tfuse_options('repeat_image_tag') . tfuse_options('background_color_tag').'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_category() )
        {
            $cat_ID = get_query_var('cat');
            if(tfuse_options('background_image',null,$cat_ID)!='' || tfuse_options('background_color',null,$cat_ID)!='')
                echo 'style="background:url('.tfuse_options('background_image',null,$cat_ID).' )'. ' '. tfuse_options('background_position',null,$cat_ID).' '
                    .tfuse_options('repeat_image',null,$cat_ID). tfuse_options('background_color',null,$cat_ID).'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var( 'taxonomy'));
            $cat_ID = $term->term_id;
            if(tfuse_options('background_image',null,$cat_ID)!='' || tfuse_options('background_color',null,$cat_ID)!='')
                echo 'style="background:url('. tfuse_options('background_image',null,$cat_ID).')'. ' '.tfuse_options('background_position',null,$cat_ID) .' '
                    .tfuse_options('repeat_image',null,$cat_ID) . tfuse_options('background_color',null,$cat_ID).'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
        elseif( is_archive() ){
            if(isset($_GET['posts']) && $_GET['posts'] == 'all') {
                if(tfuse_options('background_image_port_archive')!='' || tfuse_options('background_color_port_archive')!='')
                    echo 'style="background:url('. tfuse_options('background_image_port_archive').')'. ' '.tfuse_options('background_position_port_archive') .' '
                        .tfuse_options('repeat_image_port_archive') . tfuse_options('background_color_port_archive').'"';
                else
                    echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                        .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
            }
            else {
                if(tfuse_options('background_image_archive')!='' || tfuse_options('background_color_archive')!='')
                    echo 'style="background:url('. tfuse_options('background_image_archive').')'. ' '.tfuse_options('background_position_archive') .' '
                        .tfuse_options('repeat_image_archive') . tfuse_options('background_color_archive').'"';
                else
                    echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                        .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
            }
        }
        else {
            if(tfuse_page_options('background_image')!='' || tfuse_page_options('background_color')!='')
                echo 'style="background:url('. tfuse_page_options('background_image').')'. ' '.tfuse_page_options('background_position') .' '
                    .tfuse_page_options('repeat_image') . tfuse_page_options('background_color').'"';
            else
                echo 'style="background:url('. tfuse_options('background_image_default').')'. ' '.tfuse_options('background_position_default') .' '
                    .tfuse_options('repeat_image_default') . tfuse_options('background_color_default').'"';
        }
    }
endif;

if (!function_exists('tfuse_phone_style')) :
    function tfuse_phone_style() {
        $phone_bk = $phone_color = $phone_repeat = '';
        $phone_bk = tfuse_options('phone_background_default','');
        $phone_color = tfuse_options('phone_color_default','');
        $phone_repeat = tfuse_options('repeat_image_phone_default','');

        echo '<style type="text/css" media="screen">';
        echo '@media only screen and (max-width: 767px) {
              body {background-image:url('.$phone_bk.') !important;
              background-color: '.$phone_color.' !important;
              background-repeat:'.$phone_repeat.' !important}}
              @media only screen and (device-width: 768px) {
              body {background-image:url('.$phone_bk.') !important;
              background-color: '.$phone_color.' !important;
              background-repeat:'.$phone_repeat.' !important}}';
        echo '</style>';
    }
endif;

if (!function_exists('tfuse_featured_portfolio')) :
    function tfuse_featured_portfolio(){
        global $post;
        $permalink = get_permalink();
        $likes = get_post_meta($post->ID,'tfuse_love_it', 1); if($likes=='')$likes = 0;
        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', 1); if($views=='')$views = 0;
        $src = tfuse_page_options('thumbnail_image',tfuse_page_options('single_image'));
        ?>
        <div class="portfolio_item featured_portfolio">
            <?php if($src != ''){ ?>
                <div class="portfolio_img"><a href="<?php echo $permalink; ?>">
                    <?php
                        $image = new TF_GET_IMAGE();
                        $tfuse_image = $image->width(612)->height(394)->src($src)->get_img();
                        echo $tfuse_image;
                    ?></a>
                </div>
            <?php }
            if(tfuse_page_options('enable_post_meta',true)){ ?>
                <div class="meta_info clearfix">
                    <?php if(tfuse_page_options('enable_published_date',true)){ ?>
                        <span class="meta_date"><?php echo get_the_date(); ?></span>
                    <?php } ?>
                    <?php if(tfuse_page_options('enable_author_post',true)){ ?>
                        <span class="meta_author"><?php the_author_posts_link(); ?></span>
                    <?php } ?>
                    <?php if(tfuse_page_options('likes',true)){ ?>
                        <span class="meta_like"><?php echo $likes; ?></span>
                    <?php } ?>
                    <?php if(tfuse_page_options('views',true)){ ?>
                        <span class="meta_views"><?php echo $views; ?></span>
                    <?php } ?>
                    <a class="link_more" href="<?php echo $permalink; ?>"></a>
                </div>
            <?php } ?>
            <div class="portfolio_title"><h2><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2></div>
            <div class="portfolio_desc"><?php the_excerpt(); ?></div>
        </div>
    <?php }
endif;

if(!function_exists('tfuse_print_theme_color_style')){
    function tfuse_print_theme_color_style(){
        $color1 = tfuse_options('color1','');
        $color2 = tfuse_options('color2','');
        if(isset($_GET['color1'])) $color1 = '#'.$_GET['color1'];
        if(isset($_GET['color2'])) $color2 = '#'.$_GET['color2'];

        if($color1 != ''){
            echo '<style>
                ul.dropdown > li > a:hover,.quote_right, .quote_left, .quote_center, blockquote,.frame_quote blockquote,.testimonials_carousel .testimonials_item h3,.testimonials_meta span.post,.testimonials_list .reply,.link-author:hover,.link_reply:hover,.widget_recent_posts a:hover,.widget_popular_posts a:hover,.widget_tag_cloud .tagcloud a:hover,.widget_contacts a ,.socialize a,.support a,.item_post .item_entry h3.item_title a:hover,.post_item .post_title h2 a:hover , .portfolio_item .portfolio_title h2 a:hover,.post_item .post_meta_bott a:hover,.portfolio_meta a.portfolio_title:hover,.portfolio_meta span a,.link-more:hover,.widget_nav_menu .current-menu-item a,.widget_nav_menu li a:hover,.widget_categories li a:hover,.widget_links li a:hover,.widget_meta li a:hover,.widget_pages li a:hover,.widget_archive li a:hover,.widget_popular li a:hover,.widget_container li.current-menu-item a,footer .tweet_item a,.post_item .post_meta_bott .post_comments,.widget_recent_posts .link-comments,.widget_recent_posts .author, .widget_popular_posts .link-comments, .widget_popular_posts .author,ul.dropdown li.submenu ul li a:hover,.accordion-toggle .guest-post {color:'.$color1.'}
                .minigallery_carousel li:hover a img border-color:'.$color1.'}
                .meta_info a.link_more:hover,.post_gallery.post_gallery .meta_info a.prev:hover {background-color:'.$color1.'}
                .progress_bar .bar,footer .newsletterBox .btn_submit,.history_item:hover .history_year,.history_year.active,.sidebar .newsletterBox .btn_submit,.newsletter_shortcode .newsletter_subscription_submit,.search_shortcode .btn-submit,.slider_footer{background:'.$color1.'}
                .mega-menu .widget_nav_menu li a,.mega-menu .widget_categories li a,.mega-menu .widget_links li a,.mega-menu .widget_meta li a,.mega-menu .widget_pages li a,.mega-menu .widget_archive li a,.mega-menu .widget_popular li a:hover,.footer_bottom .copyright a:hover {color:'.$color1.';}
                .mega-menu .widget_links li a:hover,.mega-menu .widget_categories li a:hover{color:'.$color1.';}
                .meta_info a.link_more:hover,.post_gallery.post_gallery .meta_info a.next:hover, .post_gallery.post_gallery .meta_info a.prev:hover{background-color:'.$color1.';}
            </style>';
        }
        if($color2 != ''){
            echo '<style>
                #middle .middle_row.border_bottom .container,.title , .widget_title,.nav-tabs,ul.filter_menu,.link_back .icon_back,.widget_tag_cloud .tagcloud a,.item_post .item_entry,.member_team .member_desc,.service_list .service_item .service_title,.divider_line,ul.dropdown,.widget_nav_menu li,.widget_categories li,.widget_links li,.widget_meta li,.widget_pages li,.widget_archive li,.widget_popular li{border-bottom:1px solid '.$color2.'}
                .title h2 ,.widget_title h3,.nav-tabs > li.active,.tf_sidebar_tabs  .nav-tabs > li.active > a,.sidebar .newsletterBox h4,.sidebar .widget_tweeter h4 {border-bottom:4px solid '.$color2.';}
                .nav-tabs > li > a,ul.filter_menu li a,.technologies h4,footer .tf_sidebar_tabs #tabs .active a,footer .tf_sidebar_tabs #tabs .active a:hover {color:'.$color2.';}
                .small_tabs .nav-tabs > li.active {border-top:2px solid '.$color2.';}
                .minigallery_carousel .prev:hover, .minigallery_carousel .next:hover{background-color:'.$color2.';}
                ul.filter_menu li a:hover ,ul.filter_menu li.current-menu-item a{border-color:'.$color2.';}
                .carousel_nav a {background-color:'.$color2.';}
                .progress_bar,.widget_categories li a:hover em,.tf_pagination a:hover , .tf_pagination a.current-page,.widget_categories li:hover > em,.history_year {background:'.$color2.';}
                .widget_categories li a em {color:'.$color2.';border:1px solid '.$color2.'}
                .widget_tag_cloud .tagcloud a span {border-right:4px solid '.$color2.';}
                .portfolio_item_small .portfolio_meta {border-left:1px solid '.$color2.';border-right:1px solid '.$color2.';}
                .tf_pagination a {border:1px solid '.$color2.';color:'.$color2.';}
                .service_list .service_item .service_title h3 {border-bottom:3px solid '.$color2.'}
                .history_item {border-left:4px solid '.$color2.'}
                .tf_pagination span.current {border: 1px solid '.$color2.';background: '.$color2.';}
                .widget_categories li em {color:'.$color2.';border:1px solid '.$color2.';}
                .widget_tag_cloud .tagcloud a {border-right: 4px solid '.$color2.';}
                .widget_tag_cloud .tagcloud a{border:1px solid '.$color2.';}
                .mega-menu .widget_links li a,.mega-menu .widget_popular li a,.mega-menu .widget_categories li a{color:'.$color2.';}
            </style>';
        }
    }
}

//Top Ad
if (!function_exists('tfuse_top_adds')) :
    function tfuse_top_adds() {
        global $post,$is_tf_blog_page;
        if($is_tf_blog_page)
        {
            if(tfuse_options('blog_top_ad_space') == 'true')
            {
                if(tfuse_options('blog_top_ad_space')=='true'&&!tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_adsense')&&!tfuse_options('blog_top_ad_image')||tfuse_options('blog_top_ad_adsense')&&tfuse_options('blog_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ad_image')&&!tfuse_options('blog_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_top_ad_space') && tfuse_options('top_ads_space'))
            {
                if(!tfuse_options('blog_top_ads_space')&&!tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_adsense')&&!tfuse_options('blog_top_ads_image')||tfuse_options('blog_top_ads_adsense')&& tfuse_options('blog_top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('blog_top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('blog_top_ads_image')&&!tfuse_options('blog_top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('blog_top_ads_url').'"  target="_blank"><img src="'.tfuse_options('blog_top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_front_page())
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('top_ad_space','',$page_id) == 'true')
                {
                    if(tfuse_page_options('top_ad_space','',$page_id)=='true'&&!tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id)){
                        echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense','',$page_id)&&!tfuse_page_options('top_ad_image','',$page_id)||tfuse_page_options('top_ad_adsense','',$page_id)&&tfuse_page_options('top_ad_image','',$page_id))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image','',$page_id)&&!tfuse_page_options('top_ad_adsense','',$page_id))
                    {
                        echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image','',$page_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_options('home_top_ad_space') == 'true')
            {
                if(tfuse_options('home_top_ad_space')=='true'&&!tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_adsense')&&!tfuse_options('home_top_ad_image')||tfuse_options('home_top_ad_adsense')&&tfuse_options('home_top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('home_top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('home_top_ad_image')&&!tfuse_options('home_top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('home_top_ad_url').'"  target="_blank"><img src="'.tfuse_options('home_top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_top_ad_space') && tfuse_options('top_ads_space'))
            {
                if(tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page() || (isset($post) && $post->post_type=='members'))
        {
            if(tfuse_page_options('top_ad_space') == 'true')
            {
                if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div><div class="clear"></div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('top_ad_space') && tfuse_options('top_ads_space'))
            {
                if(tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if(!empty($taxonomies))
            {
                if($taxonomies[0] == 'category') {
                    $cat_id = $cat_name[0]->cat_ID;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
            }
            if(!tfuse_page_options('content_ads_post'))
            {
                if(tfuse_page_options('top_ad_space') == 'true')
                {
                    if(tfuse_page_options('top_ad_space')=='true'&&!tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense')){
                        echo '
                            <!-- adv before head -->
                                <div class="adv_head">
                                    <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                                </div>
                            <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_adsense')&&!tfuse_page_options('top_ad_image')||tfuse_page_options('top_ad_adsense')&&tfuse_page_options('top_ad_image'))
                    {
                        echo  '<!-- adv before head -->'.tfuse_page_options('top_ad_adsense').' <!-- adv before head -->';
                    }
                    elseif(tfuse_page_options('top_ad_image')&&!tfuse_page_options('top_ad_adsense'))
                    {
                        echo  '
                        <!-- adv before head -->
                        <div class="adv_head">
                            <div class="adv_728"><a href="'.tfuse_page_options('top_ad_url').'"  target="_blank"><img src="'.tfuse_page_options('top_ad_image').'" width="728" height="90" alt="advert"></a></div>
                        </div>
                        <!-- adv before head -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && tfuse_options('top_ads_space'))
            {
                if(tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $cat_id = $term->term_id;
            if(tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && tfuse_options('top_ads_space'))
            {
                if(tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('top_ad_space',null,$cat_id))
            {
                if(tfuse_options('top_ad_space',null,$cat_id)=='true'&&!tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_adsense',null,$cat_id)&&!tfuse_options('top_ad_image',null,$cat_id)||tfuse_options('top_ad_adsense',null,$cat_id)&&tfuse_options('top_ad_image',null,$cat_id))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ad_adsense',null,$cat_id).' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ad_image',null,$cat_id)&&!tfuse_options('top_ad_adsense',null,$cat_id))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ad_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('top_ad_image',null,$cat_id).'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('top_ad_space',null,$cat_id) && tfuse_options('top_ads_space'))
            {
                if(tfuse_options('top_ads_space')&&!tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo '
                        <!-- adv before head -->
                            <div class="adv_head">
                                <div class="adv_728"><img src="'.tfuse_get_file_uri('/images/adv_728x90.png').'" width="728" height="90" alt="advert"></div>
                            </div>
                        <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_adsense')&&!tfuse_options('top_ads_image')||tfuse_options('top_ads_adsense')&&tfuse_options('top_ads_image'))
                {
                    echo  '<!-- adv before head -->'.tfuse_options('top_ads_adsense').' <!-- adv before head -->';
                }
                elseif(tfuse_options('top_ads_image')&&!tfuse_options('top_ads_adsense'))
                {
                    echo  '
                    <!-- adv before head -->
                    <div class="adv_head">
                        <div class="adv_728"><a href="'.tfuse_options('top_ads_url').'"  target="_blank"><img src="'.tfuse_options('top_ads_image').'" width="728" height="90" alt="advert"></a></div>
                    </div>
                    <!-- adv before head -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//ads for category
if (!function_exists('tfuse_category_ads')) :
    function tfuse_category_ads() {
        global $post,$is_tf_blog_page;
        if($is_tf_blog_page)
        {
            if(tfuse_options('blog_bfcontent_ads_space'))
            {
                if(tfuse_options('blog_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('blog_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('blog_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('blog_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'four' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('blog_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('blog_bfcontent_ads_image1');
                    $adds2 = tfuse_options('blog_bfcontent_ads_image2');
                    $adds3 = tfuse_options('blog_bfcontent_ads_image3');
                    $adds4 = tfuse_options('blog_bfcontent_ads_image4');
                    $adds5 = tfuse_options('blog_bfcontent_ads_image5');
                    $adds6 = tfuse_options('blog_bfcontent_ads_image6');
                    $adds7 = tfuse_options('blog_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('blog_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('blog_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('blog_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('blog_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('blog_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('blog_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('blog_bfcontent_ads_adsense7');
                    if(tfuse_options('blog_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('blog_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('blog_bfcontent_ads_space') && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_front_page())
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('bfcontent_ads_space','',$page_id))
                {
                    if(tfuse_page_options('bfcontent_number','',$page_id) == 'one' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1','',$page_id).'</div>
                            </div>';
                        }
                        elseif($adds1)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'two' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'three' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'four' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4','',$page_id)&&!tfuse_page_options('bfcontent_ads_adsense4','',$page_id)){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'five' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                            echo  '
                                    <!-- adv before content -->
                                            <div class="adv_before_content">
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            </div>
                                    <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'six' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                    elseif(tfuse_page_options('bfcontent_number','',$page_id) == 'seven' )
                    {
                        $adds1 = tfuse_page_options('bfcontent_ads_image1','',$page_id);
                        $adds2 = tfuse_page_options('bfcontent_ads_image2','',$page_id);
                        $adds3 = tfuse_page_options('bfcontent_ads_image3','',$page_id);
                        $adds4 = tfuse_page_options('bfcontent_ads_image4','',$page_id);
                        $adds5 = tfuse_page_options('bfcontent_ads_image5','',$page_id);
                        $adds6 = tfuse_page_options('bfcontent_ads_image6','',$page_id);
                        $adds7 = tfuse_page_options('bfcontent_ads_image7','',$page_id);
                        $adsense1 = tfuse_page_options('bfcontent_ads_adsense1','',$page_id);
                        $adsense2 = tfuse_page_options('bfcontent_ads_adsense2','',$page_id);
                        $adsense3 = tfuse_page_options('bfcontent_ads_adsense3','',$page_id);
                        $adsense4 = tfuse_page_options('bfcontent_ads_adsense4','',$page_id);
                        $adsense5 = tfuse_page_options('bfcontent_ads_adsense5','',$page_id);
                        $adsense6 = tfuse_page_options('bfcontent_ads_adsense6','',$page_id);
                        $adsense7 = tfuse_page_options('bfcontent_ads_adsense7','',$page_id);
                        if(tfuse_page_options('bfcontent_ads_space','',$page_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                            echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                        }
                        elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                        {
                            echo '<div class="adv_before_content">
                            <div class="adv_125">'.$adsense1.'</div>
                            <div class="adv_125">'.$adsense2.'</div>
                            <div class="adv_125">'.$adsense3.'</div>
                            <div class="adv_125">'.$adsense4.'</div>
                            <div class="adv_125">'.$adsense5.'</div>
                            <div class="adv_125">'.$adsense6.'</div>
                            <div class="adv_125">'.$adsense7.'</div>
                            </div>';
                        }
                        elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                        {
                            echo '
                                <!-- adv before content -->
                                <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1','',$page_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2','',$page_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3','',$page_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4','',$page_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5','',$page_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6','',$page_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7','',$page_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                                </div>
                                <!--/ adv before content -->
                                ';
                        }
                        else
                        {
                            echo '';
                        }
                    }
                }
            }
            elseif(tfuse_options('home_bfcontent_ads_space'))
            {
                if(tfuse_options('home_bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_options('home_bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_options('home_bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_options('home_bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'four' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_options('home_bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_options('home_bfcontent_ads_image1');
                    $adds2 = tfuse_options('home_bfcontent_ads_image2');
                    $adds3 = tfuse_options('home_bfcontent_ads_image3');
                    $adds4 = tfuse_options('home_bfcontent_ads_image4');
                    $adds5 = tfuse_options('home_bfcontent_ads_image5');
                    $adds6 = tfuse_options('home_bfcontent_ads_image6');
                    $adds7 = tfuse_options('home_bfcontent_ads_image7');
                    $adsense1 = tfuse_options('home_bfcontent_ads_adsense1');
                    $adsense2 = tfuse_options('home_bfcontent_ads_adsense2');
                    $adsense3 = tfuse_options('home_bfcontent_ads_adsense3');
                    $adsense4 = tfuse_options('home_bfcontent_ads_adsense4');
                    $adsense5 = tfuse_options('home_bfcontent_ads_adsense5');
                    $adsense6 = tfuse_options('home_bfcontent_ads_adsense6');
                    $adsense7 = tfuse_options('home_bfcontent_ads_adsense7');
                    if(tfuse_options('home_bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_options('home_bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_options('home_bfcontent_ads_space') && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_page() || (isset($post) && $post->post_type=='members'))
        {
            if(tfuse_page_options('bfcontent_ads_space'))
            {
                if(tfuse_page_options('bfcontent_number') == 'one' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                        </div>';
                    }
                    elseif($adds1)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'two' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'three' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'four' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'five' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                        echo  '
                                <!-- adv before content -->
                                        <div class="adv_before_content">
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                                <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        </div>
                                <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'six' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                    <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
                elseif(tfuse_page_options('bfcontent_number') == 'seven' )
                {
                    $adds1 = tfuse_page_options('bfcontent_ads_image1');
                    $adds2 = tfuse_page_options('bfcontent_ads_image2');
                    $adds3 = tfuse_page_options('bfcontent_ads_image3');
                    $adds4 = tfuse_page_options('bfcontent_ads_image4');
                    $adds5 = tfuse_page_options('bfcontent_ads_image5');
                    $adds6 = tfuse_page_options('bfcontent_ads_image6');
                    $adds7 = tfuse_page_options('bfcontent_ads_image7');
                    $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                    $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                    $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                    $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                    $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                    $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                    $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
                    if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                        echo  '
                            <!-- adv before content -->
                                    <div class="adv_before_content">
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                            <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    </div>
                            <!--/ adv before content -->';
                    }
                    elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                    {
                        echo '<div class="adv_before_content">
                        <div class="adv_125">'.$adsense1.'</div>
                        <div class="adv_125">'.$adsense2.'</div>
                        <div class="adv_125">'.$adsense3.'</div>
                        <div class="adv_125">'.$adsense4.'</div>
                        <div class="adv_125">'.$adsense5.'</div>
                        <div class="adv_125">'.$adsense6.'</div>
                        <div class="adv_125">'.$adsense7.'</div>
                        </div>';
                    }
                    elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                    {
                        echo '
                            <!-- adv before content -->
                            <div class="adv_before_content">
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                                <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                            </div>
                            <!--/ adv before content -->
                            ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(!tfuse_page_options('bfcontent_ads_space') && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if(!empty($taxonomies))
            {
                if($taxonomies[0] == 'category') {
                    $cat_id = $cat_name[0]->cat_ID;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
            }
            if(!tfuse_page_options('content_ads_post'))
            {
                tfuse_bfc_ads_post();
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_category())
        {
            $cat_id = get_query_var('cat');
            if(tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $cat_id = $term->term_id;
            if(tfuse_options('bfcontent_ads_space',null,$cat_id))
            {
                tfuse_bfc_ads_cat($cat_id);
            }
            elseif(!tfuse_options('bfcontent_ads_space',null,$cat_id) && tfuse_options('bfc_ads_space'))
            {
                tfuse_bfc_ads_admin();
            }
        }
    }
endif;

//468x60 ad
if (!function_exists('tfuse_hook')) :
    function tfuse_hook() {
        $id = 0;
        global $post,$is_tf_front_page,$is_tf_blog_page;
        $ID = '';
        if($is_tf_blog_page)
        {
            if (tfuse_options('blog_hook_space')=='true')
            {
                if(tfuse_options('blog_hook_space')&&!tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_adsense')&&!tfuse_options('blog_hook_image')||tfuse_options('blog_hook_adsense')&&tfuse_options('blog_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('blog_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('blog_hook_image')&&!tfuse_options('blog_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('blog_hook_url').'"  target="_blank"><img src="'.tfuse_options('blog_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('blog_hook_space') && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif($is_tf_front_page)
        {
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = $post->ID;
                if(tfuse_page_options('hook_space','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense','',$page_id)&&!tfuse_page_options('hook_image','',$page_id)||tfuse_page_options('hook_adsense','',$page_id)&&tfuse_page_options('hook_image','',$page_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense','',$page_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image','',$page_id)&&!tfuse_page_options('hook_adsense','',$page_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url','',$page_id).'"  target="_blank"><img src="'.tfuse_page_options('hook_image','',$page_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif (tfuse_options('home_hook_space')=='true')
            {
                if(tfuse_options('home_hook_space')&&!tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_adsense')&&!tfuse_options('home_hook_image')||tfuse_options('home_hook_adsense')&&tfuse_options('home_hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('home_hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('home_hook_image')&&!tfuse_options('home_hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('home_hook_url').'"  target="_blank"><img src="'.tfuse_options('home_hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('home_hook_space') && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_page() || (isset($post) && $post->post_type=='members'))
        {
            if (tfuse_page_options('hook_space')=='true')
            {
                if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_page_options('hook_space') && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_single() && !is_page())
        {
            $cat_name = get_the_category();
            $post = get_post($post->ID);
            $post_type = $post->post_type;
            $taxonomies = get_object_taxonomies($post_type);
            if(!empty($taxonomies))
            {
                if($taxonomies[0] == 'category') {
                    $cat_id = $cat_name[0]->cat_ID;
                }
                elseif($taxonomies[0] == 'group')
                {
                    $terms = wp_get_post_terms($post->ID,'group');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
                elseif($taxonomies[0] == 'services')
                {
                    $terms = wp_get_post_terms($post->ID,'services');
                    if(!empty($terms)) $cat_id = $terms[0]->term_id;
                    else $cat_id = 0;
                }
            }

            if(!tfuse_page_options('content_ads_post'))
            {
                if (tfuse_page_options('hook_space')=='true')
                {
                    if(tfuse_page_options('hook_space')&&!tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense')){
                        echo '
                            <!-- adv: 468x60 center -->
                            <div class="adv_content">
                                            <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                    </div>
                            <!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_adsense')&&!tfuse_page_options('hook_image')||tfuse_page_options('hook_adsense')&&tfuse_page_options('hook_image'))
                    {
                        echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_page_options('hook_adsense').'</div></div><!--/ adv: 468x60 center -->';
                    }
                    elseif(tfuse_page_options('hook_image')&&!tfuse_page_options('hook_adsense'))
                    {
                        echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                <div class="adv_468"><a href="'.tfuse_page_options('hook_url').'"  target="_blank"><img src="'.tfuse_page_options('hook_image').'" width="460" height="60" alt="advert"></a></div>
                        </div>
                        <!--/ adv: 468x60 center -->
                        ';
                    }
                    else
                    {
                        echo '';
                    }
                }
            }
            elseif(tfuse_page_options('content_ads_post') && tfuse_options('hook_space',null,$cat_id))
            {
                if(tfuse_options('hook_space',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$cat_id)&&!tfuse_options('hook_image',null,$cat_id)||tfuse_options('hook_adsense',null,$cat_id)&&tfuse_options('hook_image',null,$cat_id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$cat_id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$cat_id)&&!tfuse_options('hook_adsense',null,$cat_id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$cat_id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$cat_id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$cat_id) && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_category())
        {
            $id = get_query_var('cat');
            if (tfuse_options('hook_space',null,$id))
            {
                if(tfuse_options('hook_space',null,$id)&&!tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id)){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$id)&&!tfuse_options('hook_image',null,$id)||tfuse_options('hook_adsense',null,$id)&&tfuse_options('hook_image',null,$id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$id) && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
        elseif(is_tax())
        {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
            $id = $term->term_id;
            if (tfuse_options('hook_space',null,$id))
            {
                if(tfuse_options('hook_space',null,$id)&&!tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id)){

                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense',null,$id)&&!tfuse_options('hook_image',null,$id)||tfuse_options('hook_adsense',null,$id)&&tfuse_options('hook_image',null,$id))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense',null,$id).'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image',null,$id)&&!tfuse_options('hook_adsense',null,$id))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url',null,$id).'"  target="_blank"><img src="'.tfuse_options('hook_image',null,$id).'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(!tfuse_options('hook_space',null,$id) && tfuse_options('content_ads_space'))
            {
                if(tfuse_options('content_ads_space')&&!tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin')){
                    echo '
                        <!-- adv: 468x60 center -->
                        <div class="adv_content">
                                        <div class="adv_468"><img src="'.tfuse_get_file_uri('/images/adv_468x60.png').'" width="460" height="60" alt="advert"></div>
                                </div>
                        <!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_adsense_admin')&&!tfuse_options('hook_image_admin')||tfuse_options('hook_adsense_admin')&&tfuse_options('hook_image_admin'))
                {
                    echo  ' <!-- adv: 468x60 center --><div class="adv_content"><div class="adv_468">'.tfuse_options('hook_adsense_admin').'</div></div><!--/ adv: 468x60 center -->';
                }
                elseif(tfuse_options('hook_image_admin')&&!tfuse_options('hook_adsense_admin'))
                {
                    echo '
                    <!-- adv: 468x60 center -->
                    <div class="adv_content">
                            <div class="adv_468"><a href="'.tfuse_options('hook_url_admin').'"  target="_blank"><img src="'.tfuse_options('hook_image_admin').'" width="460" height="60" alt="advert"></a></div>
                    </div>
                    <!--/ adv: 468x60 center -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//before content 125x125 ads from frame
if (!function_exists('tfuse_bfc_ads_admin')) :
    function tfuse_bfc_ads_admin()
    {
        if(tfuse_options('bfc_ads_space'))
        {
            if(tfuse_options('bfcontent_number') == 'one' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1')){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif(tfuse_options('bfcontent_ads_adsense1'))
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1').'</div>
                </div>';
                }
                elseif($adds1)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'two' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'three' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adds3 = tfuse_options('bfcontent_ads_image3');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_options('bfcontent_ads_adsense3');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'four' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adds3 = tfuse_options('bfcontent_ads_image3');
                $adds4 = tfuse_options('bfcontent_ads_image4');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_options('bfcontent_ads_adsense4');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'five' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adds3 = tfuse_options('bfcontent_ads_image3');
                $adds4 = tfuse_options('bfcontent_ads_image4');
                $adds5 = tfuse_options('bfcontent_ads_image5');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_options('bfcontent_ads_adsense5');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'six' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adds3 = tfuse_options('bfcontent_ads_image3');
                $adds4 = tfuse_options('bfcontent_ads_image4');
                $adds5 = tfuse_options('bfcontent_ads_image5');
                $adds6 = tfuse_options('bfcontent_ads_image6');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_options('bfcontent_ads_adsense5');
                $adsense6 = tfuse_options('bfcontent_ads_adsense6');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number') == 'seven' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1');
                $adds2 = tfuse_options('bfcontent_ads_image2');
                $adds3 = tfuse_options('bfcontent_ads_image3');
                $adds4 = tfuse_options('bfcontent_ads_image4');
                $adds5 = tfuse_options('bfcontent_ads_image5');
                $adds6 = tfuse_options('bfcontent_ads_image6');
                $adds7 = tfuse_options('bfcontent_ads_image7');
                $adsense1 = tfuse_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_options('bfcontent_ads_adsense5');
                $adsense6 = tfuse_options('bfcontent_ads_adsense6');
                $adsense7 = tfuse_options('bfcontent_ads_adsense7');
                if(!tfuse_options('bfcontent_ads_space')&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//before content 125x125 ads from category
if (!function_exists('tfuse_bfc_ads_cat')) :
    function tfuse_bfc_ads_cat($cat_id)
    {
        if(tfuse_options('bfcontent_ads_space',null,$cat_id))
        {
            if(tfuse_options('bfcontent_number',null,$cat_id) == 'one' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!tfuse_options('bfcontent_ads_adsense1',null,$cat_id)){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif(tfuse_options('bfcontent_ads_adsense1',null,$cat_id))
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_options('bfcontent_ads_adsense1',null,$cat_id).'</div>
                </div>';
                }
                elseif($adds1)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'two' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'three' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'four' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
                $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
                $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'five' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
                $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
                $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
                $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
                $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'six' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
                $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
                $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
                $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
                $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
                $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
                $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_options('bfcontent_number',null,$cat_id) == 'seven' )
            {
                $adds1 = tfuse_options('bfcontent_ads_image1',null,$cat_id);
                $adds2 = tfuse_options('bfcontent_ads_image2',null,$cat_id);
                $adds3 = tfuse_options('bfcontent_ads_image3',null,$cat_id);
                $adds4 = tfuse_options('bfcontent_ads_image4',null,$cat_id);
                $adds5 = tfuse_options('bfcontent_ads_image5',null,$cat_id);
                $adds6 = tfuse_options('bfcontent_ads_image6',null,$cat_id);
                $adds7 = tfuse_options('bfcontent_ads_image7',null,$cat_id);
                $adsense1 = tfuse_options('bfcontent_ads_adsense1',null,$cat_id);
                $adsense2 = tfuse_options('bfcontent_ads_adsense2',null,$cat_id);
                $adsense3 = tfuse_options('bfcontent_ads_adsense3',null,$cat_id);
                $adsense4 = tfuse_options('bfcontent_ads_adsense4',null,$cat_id);
                $adsense5 = tfuse_options('bfcontent_ads_adsense5',null,$cat_id);
                $adsense6 = tfuse_options('bfcontent_ads_adsense6',null,$cat_id);
                $adsense7 = tfuse_options('bfcontent_ads_adsense7',null,$cat_id);
                if(tfuse_options('bfcontent_ads_space',null,$cat_id)=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url1',null,$cat_id).'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url2',null,$cat_id).'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url3',null,$cat_id).'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url4',null,$cat_id).'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url5',null,$cat_id).'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url6',null,$cat_id).'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_options('bfcontent_ads_url7',null,$cat_id).'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

//before content 125x125 ads in post
if (!function_exists('tfuse_bfc_ads_post')) :
    function tfuse_bfc_ads_post()
    {
        if(tfuse_page_options('bfcontent_ads_space'))
        {
            if(tfuse_page_options('bfcontent_number') == 'one' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!tfuse_page_options('bfcontent_ads_adsense1')){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif(tfuse_page_options('bfcontent_ads_adsense1'))
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.tfuse_page_options('bfcontent_ads_adsense1').'</div>
                </div>';
                }
                elseif($adds1)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'two' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'three' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adds3 = tfuse_page_options('bfcontent_ads_image3');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'four' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adds3 = tfuse_page_options('bfcontent_ads_image3');
                $adds4 = tfuse_page_options('bfcontent_ads_image4');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!tfuse_page_options('bfcontent_ads_image4')&&!tfuse_page_options('bfcontent_ads_adsense4')){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'five' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adds3 = tfuse_page_options('bfcontent_ads_image3');
                $adds4 = tfuse_page_options('bfcontent_ads_image4');
                $adds5 = tfuse_page_options('bfcontent_ads_image5');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5){
                    echo  '
                        <!-- adv before content -->
                                <div class="adv_before_content">
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                        <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                </div>
                        <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'six' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adds3 = tfuse_page_options('bfcontent_ads_image3');
                $adds4 = tfuse_page_options('bfcontent_ads_image4');
                $adds5 = tfuse_page_options('bfcontent_ads_image5');
                $adds6 = tfuse_page_options('bfcontent_ads_image6');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 )
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 )
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                            <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
            elseif(tfuse_page_options('bfcontent_number') == 'seven' )
            {
                $adds1 = tfuse_page_options('bfcontent_ads_image1');
                $adds2 = tfuse_page_options('bfcontent_ads_image2');
                $adds3 = tfuse_page_options('bfcontent_ads_image3');
                $adds4 = tfuse_page_options('bfcontent_ads_image4');
                $adds5 = tfuse_page_options('bfcontent_ads_image5');
                $adds6 = tfuse_page_options('bfcontent_ads_image6');
                $adds7 = tfuse_page_options('bfcontent_ads_image7');
                $adsense1 = tfuse_page_options('bfcontent_ads_adsense1');
                $adsense2 = tfuse_page_options('bfcontent_ads_adsense2');
                $adsense3 = tfuse_page_options('bfcontent_ads_adsense3');
                $adsense4 = tfuse_page_options('bfcontent_ads_adsense4');
                $adsense5 = tfuse_page_options('bfcontent_ads_adsense5');
                $adsense6 = tfuse_page_options('bfcontent_ads_adsense6');
                $adsense7 = tfuse_page_options('bfcontent_ads_adsense7');
                if(tfuse_page_options('bfcontent_ads_space')=='1'&&!$adds1&&!$adsense1 &&!$adds2&&!$adsense2&&!$adds3&&!$adsense3&&!$adds4&&!$adsense4&&!$adds5&&!$adsense5&&!$adds6&&!$adsense6&&!$adds7&&!$adsense7){
                    echo  '
                    <!-- adv before content -->
                            <div class="adv_before_content">
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                                    <div class="adv_125"><img src="'.tfuse_get_file_uri('/images/adv_125x125.png').'" width="125" height="125" alt="advert"></div>
                            </div>
                    <!--/ adv before content -->';
                }
                elseif($adsense1 || $adsense2 || $adsense3 || $adsense4 || $adsense5 || $adsense6 || $adsense7)
                {
                    echo '<div class="adv_before_content">
                <div class="adv_125">'.$adsense1.'</div>
                <div class="adv_125">'.$adsense2.'</div>
                <div class="adv_125">'.$adsense3.'</div>
                <div class="adv_125">'.$adsense4.'</div>
                <div class="adv_125">'.$adsense5.'</div>
                <div class="adv_125">'.$adsense6.'</div>
                <div class="adv_125">'.$adsense7.'</div>
                </div>';
                }
                elseif($adds1 || $adds2 || $adds3 || $adds4 || $adds5 || $adds6 || $adds7)
                {
                    echo '
                    <!-- adv before content -->
                    <div class="adv_before_content">
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url1').'"  target="_blank"><img src="'.$adds1.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url2').'"  target="_blank"><img src="'.$adds2.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url3').'"  target="_blank"><img src="'.$adds3.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url4').'"  target="_blank"><img src="'.$adds4.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url5').'"  target="_blank"><img src="'.$adds5.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url6').'"  target="_blank"><img src="'.$adds6.'" width="125" height="125" alt="advert"></a></div>
                        <div class="adv_125"><a href="'.tfuse_page_options('bfcontent_ads_url7').'"  target="_blank"><img src="'.$adds7.'" width="125" height="125" alt="advert"></a></div>
                    </div>
                    <!--/ adv before content -->
                    ';
                }
                else
                {
                    echo '';
                }
            }
        }
    }
endif;

if(!function_exists('tfuse_update_reservation_forms'))
{
    function tfuse_update_reservation_forms()
    {
        $forms = get_terms( 'reservations', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );

        $args = array(
            '0' =>  'text',
            '1' =>  'textarea',
            '2' =>  'radio',
            '3' =>  'checkbox',
            '4' =>  'select',
            '5' =>  'email',
            '6' =>  'captcha',
            '7' =>  'date_in',
            '8' =>  'date_out',
            '9' =>  'res_email',
        );

        foreach($forms as $form)
        {
            $check_option = get_option( 'tfuse_update_reservation_forms', 'none' );
            if($check_option == 'set')
            {
                return;
            }
            $description = unserialize($form->description);
            if(isset($description['version']) AND $description['version'] == '1.1')
                continue;

            foreach($description['input'] as $key => $input)
            {
                if(isset($args[$input['type']]))
                    $input['type'] = $args[$input['type']];
                $description['input'][$key]['type'] = $input['type'];
            }
            $description['version'] = '1.1';
            wp_update_term($form->term_id, 'reservations', array('description' => serialize($description)));
            add_option('tfuse_update_reservation_forms', 'set');
        }
    }
    add_action('wp_head', 'tfuse_update_reservation_forms');
}

global $wp_version;
if ( version_compare( $wp_version, '3.0', '>=' ) ) :
    add_theme_support( 'automatic-feed-links' );
else :
    automatic_feed_links();
endif;


function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);
<?php
/*-------------------------------------------------------------------------*/
/*  Force comments status open for all pages.
/*-------------------------------------------------------------------------*/
function tt_get_comments_status()
{
    global $post;
    //do this only in page, to force comment open for all pages in WordPress posts table,
    //let showing of comments template decide by our theme's custom post meta only
    if (is_page()) {
        $_post = get_post($post->ID);
        //if by default page comments is closed, we set to open.
        if ($_post->comment_status == 'closed') {
            $update_post                   = array();
            $update_post['ID']             = $post->ID;
            $update_post['comment_status'] = 'open';
            wp_update_post($update_post);
        }
    }
}
add_action('template_redirect', 'tt_get_comments_status');

/*-------------------------------------------------------------------------*/
/*  Wordpress Modifications
/*-------------------------------------------------------------------------*/
// head cleanup
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links_extra');
remove_action('wp_head', 'feed_links');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// add theme support and shortcode widget filter
add_filter('widget_text', 'do_shortcode');
add_theme_support('automatic-feed-links');
add_theme_support('nav-menus');
// add post thumbnails for Sterling post and woocommence plugin.
if (class_exists('woocommerce')) {
    add_theme_support('post-thumbnails', array(
        'post',
        'product'
    ));
} else {
    add_theme_support('post-thumbnails', array(
        'post'
    ));
}
// set content width
if (!isset($content_width))
    $content_width = 904;
// remove injected CSS for recent comments widget
if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
    remove_filter('wp_head', 'wp_widget_recent_comments_style');
}
// remove injected CSS from recent comments widget
global $wp_widget_factory;
if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}
/*-------------------------------------------------------------------------*/
/*   Remove rel="category" from blog links for HTML5 validation
/*-------------------------------------------------------------------------*/
add_filter('the_category', 'add_nofollow_cat');
function add_nofollow_cat($text)
{
    $text = str_replace('rel="category tag"', "", $text);
    return $text;
}
/*-------------------------------------------------------------------------*/
/*    Hide user profile fields
/*-------------------------------------------------------------------------*/
add_filter('user_contactmethods', 'hide_profile_fields', 10, 1);
function hide_profile_fields($contactmethods)
{
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    return $contactmethods;
}
/*-------------------------------------------------------------------------*/
/*    Retrieve excluded blog categories from site options
/*-------------------------------------------------------------------------*/
function B_getExcludedCats()
{
    global $wpdb;
    $excluded = '';
    
    //mod by denzel
    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){
      
      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%st_blogexcludetest_%'" ) );
    
    }else{
      
      //this is WP 3.5, we use the following correct prepared statement.
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "st_blogexcludetest%") );
      
    }
    
    foreach ($cats as $cat) {
        if ($cat->option_value == "true") {
            $exploded = explode("_", $cat->option_name);
            $excluded .= "-{$exploded[2]}, ";
        }
    }
    return rtrim(trim($excluded), ',');
}
/*-------------------------------------------------------------------------*/
/*    Convert excluded into positive numbers (ie: 4,32,12,19)
/*-------------------------------------------------------------------------*/
function positive_exlcude_cats()
{
    global $wpdb;
    $pos_excluded = '';
    
    //mod by denzel
    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){
      
      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%st_blogexcludetest_%'" ) );
    
    }else{
      
      //this is WP 3.5, we use the following correct prepared statement.
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "st_blogexcludetest%") );
      
    }
    
    foreach ($cats as $cat) {
        if ($cat->option_value == "true") {
            $exploded_pos = explode("_", $cat->option_name);
            $pos_excluded .= "{$exploded_pos[2]},";
        }
    }
    return rtrim(trim($pos_excluded), ',');
}
/*-------------------------------------------------------------------------*/
/*    If not in dashboard, remove excluded categories from "the loop"
/*-------------------------------------------------------------------------*/
if (!is_admin()) {
    function wploop_exclude($query)
    {
        $exclude = B_getExcludedCats();
        if ($query->is_feed || $query->is_search || $query->is_archive || $query->is_home) {
        	//@since 2.2 do not filter single category view
        	if(!$query->is_category){
            $query->set('cat', '' . $exclude . '');
            }
        }
        return $query;
    }
    add_filter('pre_get_posts', 'wploop_exclude');
    function wpfeed_exclude($query)
    {
        $excludefeed = B_getExcludedCats();
        if ($query->is_feed) {
            $query->set('cat', '' . $excludefeed . '');
        }
        return $query;
    }
    add_filter('pre_get_posts', 'wpfeed_exclude');
}
/*-------------------------------------------------------------------------*/
/*    Remove Navigation Containers
/*-------------------------------------------------------------------------*/
// remove wp_nav_menu div container
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
// remove wp_nav_menu ul container
function my_nav_unlister($menu)
{
    return preg_replace(array(
        '#^<ul[^>]*>#',
        '#</ul>$#'
    ), '', $menu);
}
add_filter('wp_nav_menu', 'my_nav_unlister');
/*-------------------------------------------------------------------------*/
/*    Custom archive parameters
/*-------------------------------------------------------------------------*/
/*
MODIFIED BY TrueThemes, ORIGINAL PLUGIN:

Plugin Name: Archives for a category
Plugin URI: http://kwebble.com/blog/2007_08_15/archives_for_a_category
Description: Adds a cat parameter to wp_get_archives() to limit the posts used to generate the archive links to one or more categories.
Author: Rob Schlüter
Author URI: http://kwebble.com/
Version: 1.4a

*/
function kwebble_getarchives_where_for_category($where, $args)
{
    global $kwebble_getarchives_data, $wpdb;
    if (isset($args['cat'])) {
        // Preserve the category for later use.
        $kwebble_getarchives_data['cat'] = $args['cat'];
        // Split 'cat' parameter in categories to include and exclude.
        $allCategories                   = explode(',', $args['cat']);
        // Element 0 = included, 1 = excluded.
        $categories                      = array(
            array(),
            array()
        );
        foreach ($allCategories as $cat) {
            if (strpos($cat, ' ') !== FALSE) {
                // Multi category selection.
            }
            $idx                = $cat < 0 ? 1 : 0;
            $categories[$idx][] = abs($cat);
        }
        $includedCatgories = implode(',', $categories[0]);
        $excludedCatgories = implode(',', $categories[1]);
        // Add SQL to perform selection.
        if (get_bloginfo('version') < 2.3) {
            $where .= " AND $wpdb->posts.ID IN (SELECT DISTINCT ID FROM $wpdb->posts JOIN $wpdb->post2cat post2cat ON post2cat.post_id=ID";
            if (!empty($includedCatgories)) {
                $where .= " AND post2cat.category_id IN ($includedCatgories)";
            }
            if (!empty($excludedCatgories)) {
                $where .= " AND post2cat.category_id NOT IN ($excludedCatgories)";
            }
            $where .= ')';
        } else {
            $where .= ' AND ' . $wpdb->prefix . 'posts.ID IN (SELECT DISTINCT ID FROM ' . $wpdb->prefix . 'posts' . ' JOIN ' . $wpdb->prefix . 'term_relationships term_relationships ON term_relationships.object_id = ' . $wpdb->prefix . 'posts.ID' . ' JOIN ' . $wpdb->prefix . 'term_taxonomy term_taxonomy ON term_taxonomy.term_taxonomy_id = term_relationships.term_taxonomy_id' . ' WHERE term_taxonomy.taxonomy = \'category\'';
            if (!empty($includedCatgories)) {
                $where .= " AND term_taxonomy.term_id IN ($includedCatgories)";
            }
            if (!empty($excludedCatgories)) {
                $where .= " AND term_taxonomy.term_id NOT IN ($excludedCatgories)";
            }
            $where .= ')';
        }
    }
    return $where;
}
/* Changes the archive link to include the categories from the 'cat' parameter.
 */
function kwebble_archive_link_for_category($url)
{
    global $kwebble_getarchives_data;
    if (isset($kwebble_getarchives_data['cat'])) {
        $url .= strpos($url, '?') === false ? '?' : '&';
        $url .= 'cat=' . $kwebble_getarchives_data['cat'];
        // Remove cat parameter so it's not automatically used in all following archive lists.
        unset($kwebble_getarchives_data['cat']);
    }
    return $url;
}
/*
 * Add the filters.
 */
// Prevent error if executed outside WordPress.
if (function_exists('add_filter')) {
    // Constants for form field and options.
    define('KWEBBLE_OPTION_DISABLE_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
    define('KWEBBLE_GETARCHIVES_FORM_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
    define('KWEBBLE_ENABLED', '');
    define('KWEBBLE_DISABLED', 'Y');
    add_filter('getarchives_where', 'kwebble_getarchives_where_for_category', 10, 2);
    add_filter('year_link', 'kwebble_archive_link_for_category');
    add_filter('month_link', 'kwebble_archive_link_for_category');
    add_filter('day_link', 'kwebble_archive_link_for_category');
    // Disable canonical URLs if the option is set.
    if (get_option(KWEBBLE_OPTION_DISABLE_CANONICAL_URLS) == KWEBBLE_DISABLED) {
        remove_filter('template_redirect', 'redirect_canonical');
    }
}
/*
 * codes fork from _wp_link_page() in wp-includes/post-template.php
 * helper function for wp_link_pages()
 * used in truethemes_link_pages()
 */
function _truethemes_link_page($i)
{
    global $post, $wp_rewrite;
    if (1 == $i) {
        $url = get_permalink();
    } else {
        if ('' == get_option('permalink_structure') || in_array($post->post_status, array(
            'draft',
            'pending'
        )))
            $url = esc_url(add_query_arg('page', $i, get_permalink()));
        elseif ('page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID)
            $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
        else
            $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
    }
    //added extra style class "wp_link_pages" in case needed for styling.
    return '<a class="page wp_link_pages" href="' . esc_url($url) . '">';
}
/**
 * The formatted output of a list of pages in single.php, page.php and all page templates
 * codes fork from wp_link_pages() in wp-includes/post-template.php
 */
function truethemes_link_pages($args = '')
{
    $defaults = array(
        'before' => '<div class="wp-pagenavi">',
        'after' => '</div>',
        'link_before' => '<span class="page">',
        'link_after' => '</span>',
        'next_or_number' => 'number',
        'pagelink' => '%'
    );
    $r        = wp_parse_args($args, $defaults);
    $r        = apply_filters('wp_link_pages_args', $r);
    extract($r, EXTR_SKIP);
    global $page, $numpages, $multipage, $more, $pagenow;
    $output = '';
    if ($multipage) {
        if ('number' == $next_or_number) {
            $output .= $before;
            $output .= "<span class='pages'>Page " . $page . " of " . $numpages . "</span>";
            for ($i = 1; $i < ($numpages + 1); $i = $i + 1) {
                $j = str_replace('%', $i, $pagelink);
                $output .= ' ';
                if (($i != $page) || ((!$more) && ($page == 1))) {
                    $output .= _truethemes_link_page($i);
                }
                //current page <span> class
                if ($i == $page) {
                    $link_before = '<span class="current">';
                } else {
                    $link_before = '';
                }
                //current page <span> class
                if ($i == $page) {
                    $link_after = '</span>';
                } else {
                    $link_after = '';
                }
                $output .= $link_before . $j . $link_after;
                if (($i != $page) || ((!$more) && ($page == 1)))
                    $output .= '</a>';
            }
            $output .= $after;
        }
    }
    echo $output;
}
/*-------------------------------------------------------------------------*/
/*    Truethemes crop images
/*-------------------------------------------------------------------------*/
function truethemes_crop_image($thumb = null, $image_path = null, $width, $height)
{
    //first try, assuming image is internal.
    //use image-thumbs.php to get WordPress Uploaded photo.
    $image_output = array();
    $image_output = vt_resize($thumb, $image_path, $width, $height, true);
    $image_src    = (string) $image_output['url'];
    //second try, if there is no image_src returned from first try, we assume is external
    //we get it from external using timthumbs.
    if (empty($image_src)) {
        //get PHP loaded extension names array, for checking of curl and gd extension
        $extensions = get_loaded_extensions();
        //check for curl extension, if not installed disable script,
        //return original input image url.
        if (!in_array('curl', $extensions)) {
            return;
        }
        //check for gd extension, if not installed disable script
        if (!in_array('gd', $extensions)) {
            return;
        }
        //passed all checks for PHP extensions required by timthumb.
        //we construct the timthumb url for image_src
        if (is_multisite()) {
            //multisite timthumb request url - to tested online.
            if (!empty($image_path)) {
                global $blog_id;
                if (isset($blog_id) && $blog_id > 0) {
                    $imageParts = explode('/files/', $image_path);
                    if (isset($imageParts[1])) {
                        $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
                    }
                }
                //check whether image is internal, using GD image library's function getimagesize()
                $check_url = WP_CONTENT_URL . $theImageSrc;
                $size      = @getimagesize($check_url);
                if (!empty($size)) {
                    //this is internal image.
                    $image_src = TIMTHUMB_SCRIPT_MULTISITE . "?src=$theImageSrc&amp;h=$height&amp;w=$width";
                } else {
                    //if not, we assume it to be external image.
                    $image_src = TIMTHUMB_SCRIPT_MULTISITE . "?src=$image_path&amp;h=$height&amp;w=$width";
                }
            }
        } else {
            //single site timthumb request url
            if (!empty($image_path)) {
                $image_src = TIMTHUMB_SCRIPT . "?src=$image_path&amp;h=$height&amp;w=$width";
            }
        }
    }
    //that's all, we return $image src.
    return $image_src;
}
/**
 * Use to generate image for content-blog.php content-blog-single.php and archive.php
 *
 * @param string $image_src, contains image url
 * @param int $image_width, contains width of image
 * @param int $height_height, contains height of image.
 * @param string $blog_image_frame, determine whether to use css class post_thumb_shadow_load or post_thumb_load for div.
 * @param string $linkpost, contains url of link to external site.
 * @param string $permalink, contains post permalink
 * @return string $html, output of image or video.
 */
function truethemes_generate_blog_image($image_src, $image_width, $image_height, $blog_image_frame, $linkpost, $permalink, $video_url)
{
    //Allow plugins/themes to override this layout.
    //refer to http://codex.wordpress.org/Function_Reference/add_filter for usage
    $html = apply_filters('truethemes_generate_blog_image_filter', '', $image_src, $image_width, $image_height, $blog_image_frame, $linkpost, $permalink, $video_url);
    if ($html != '') {
        return $html;
    }
    //began normal layout.
    if (!empty($image_src)): //there is either post thumbnail of external image
    //determine link to post or link to external site.
        if ($linkpost == '') {
            //there is no link to external url
            if (!is_single()) {
                //if not single we link to post
                $truethemeslink = $permalink;
            } else {
                //else we link to nothing;
                $truethemeslink = '';
            }
        } elseif ($linkpost != '') {
            //there is an external url link, we assign it.
            $truethemeslink = $linkpost;
        } else {
            //do nothing, this is for closing the if statement only.
        }
        //start post wrap
        if (is_single()) {
            $html .= '<div class="img-frame blog-frame">';
        } else {
            $html .= '<div class="img-frame blog-frame">';
        }
        //get post title for image title.
        global $post;
        $title = get_the_title($post->ID);
        if (!empty($truethemeslink)): //show image link only if there is a link assigned.
        //start link
            $html .= "<a href='$truethemeslink' title='$title'>";
        endif;
        //image
        $html .= "<img src='$image_src' width='$image_width' height='$image_height' alt='$title' />";
        if (!empty($truethemeslink)): //show image link only if there is a link assigned.
        //close link
            $html .= "</a>";
        endif;
        //close post wrap
        $html .= '</div>';
    else: // no featured image, we show featured video or nothing at all!
        //show video embed only if there is featured video url.
        if (!empty($video_url)) {
            $embed_video = apply_filters('the_content', "[embed width=\"625\" height=\"400\"]" . $video_url . "[/embed]");
            if (is_single()) {
                $html .= '<div class="single-post-thumb single-post-video">';
            } else {
                $html .= '<div class="post-thumb">';
            }
            $html .= $embed_video;
            $html .= '</div>';
        }
    endif;
    //that's all!
    return $html;
}
/*-------------------------------------------------------------------------*/
/*    Retrieve all site option setting and put in a global object
/*-------------------------------------------------------------------------*/
class truethemes_site_option
{
    function truethemes_site_option()
    {
        //use option value from of_template,
        //this values contains the theme layout array.
        //use print_r to see the multi-dimension array key and values.
        $option_template_items = get_option('of_template');
        $op_count              = count($option_template_items);
        //set empty site option name array container.
        $site_option_name      = array();
        for ($index = 0; $index < $op_count; $index++) {
            //we only add in theme option name which is the id array key
            if (!empty($option_template_items[$index]['id'])) {
                $site_option_name[] = $option_template_items[$index]['id'];
            }
        }
        //print_r($site_option_name); //to see array of site option name.
        //assign for use in set_all();
        $this->site_option_name = $site_option_name;
    }
    function get($option_name)
    {
        $option_value = get_option($option_name);
        return stripslashes( $option_value );
    }
    function set_all()
    {
        //set empty site option array.
        $site_option      = array();
        //get total number of options
        $count            = count($this->site_option_name);
        $site_option_name = $this->site_option_name;
        //use for loop to get all option values from options tabls.
        for ($i = 0; $i < $count; $i++) {
            //get option value.
            $option_value                       = $this->get($site_option_name[$i]);
            //construct $site_option array by using
            //option name as key and option value as value
            //$site_option['ka_site_logo'] = some value
            $site_option[$site_option_name[$i]] = $option_value;
        }
        //cast built site option array into object
        $site_option_object = (object) $site_option;
        //return array object.
        return $site_option_object;
    }
}
/*-------------------------------------------------------------------------*/
/*     Construct global variable $ttso
/*-------------------------------------------------------------------------*/
/* example usage:
 *
 * global $ttso;
 * echo $ttso->st_sitelogo; //this will print out site logo url!
 *
 *
 * To see all object key and values in $ttso,
 * just use global $ttso; print_r($ttso);   or   global $ttso; var_dump($ttso);
 *
 *
 */
if (!isset($ttso)) {
    //if not set global variable, we set ii using class truethemes_site_option
    $truethemes_site_option = new truethemes_site_option();
    //run set_all() to put all option values into one array and assign to $ttso.
    $ttso                   = $truethemes_site_option->set_all();
}
/*-----------------------------------------------------------------------------------*/
/*  Realtive Time for Twitter wdiget
/*-----------------------------------------------------------------------------------*/
function relativeTime($time)
{
    define("SECOND", 1);
    define("MINUTE", 60 * SECOND);
    define("HOUR", 60 * MINUTE);
    define("DAY", 24 * HOUR);
    define("MONTH", 30 * DAY);
    $delta = strtotime('+0 hours') - $time;
    if ($delta < 2 * MINUTE) {
        return "1 min ago";
    }
    if ($delta < 45 * MINUTE) {
        return floor($delta / MINUTE) . " min ago";
    }
    if ($delta < 90 * MINUTE) {
        return "1 hour ago";
    }
    if ($delta < 24 * HOUR) {
        return floor($delta / HOUR) . " hours ago";
    }
    if ($delta < 48 * HOUR) {
        return "yesterday";
    }
    if ($delta < 30 * DAY) {
        return floor($delta / DAY) . " days ago";
    }
    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "1 month ago" : $months . " months ago";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "1 year ago" : $years . " years ago";
    }
}
/*-----------------------------------------------------------------------------------*/
/*  add wmode=opaque to WordPress video embed shortcode, fixes menu behind video issue. @since version 1.0.4
/*  original codes from http://mehigh.biz/wordpress/adding-wmode-transparent-to-wordpress-3-media-embeds.html/*-----------------------------------------------------------------------------------*/
function tt_add_video_wmode_transparent($html, $url, $attr)
{
    if (strpos($html, "<embed src=") !== false) {
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html);
    } elseif (strpos($html, 'feature=oembed') !== false) {
        return str_replace('feature=oembed', 'feature=oembed&wmode=opaque', $html);
    } else {
        return $html;
    }
}
add_filter('embed_oembed_html', 'tt_add_video_wmode_transparent', 10, 3);
/*-------------------------------------------------------------------------*/
/*  Related Posts Function
/*-------------------------------------------------------------------------*/
// Call this function using truthemes_related_posts();
function truethemes_related_posts()
{
    echo '<ul id="tt-related-posts">';
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_arr .= $tag->slug . ',';
        }
        $args          = array(
            'tag' => $tag_arr,
            'numberposts' => 5,
            /* you can change this to show more */
            'post__not_in' => array(
                $post->ID
            )
        );
        $related_posts = get_posts($args);
        if ($related_posts) {
            foreach ($related_posts as $post):
                setup_postdata($post);
?>
                <li class="related-post"><a class="entry-unrelated" href="<?php
                the_permalink();
?>" title="<?php
                the_title_attribute();
?>"><?php
                the_title();
?></a></li>
            <?php
            endforeach;
        } else {
?>
            <?php
            echo '<li class="no-related-post">' . __( 'No Related Posts Yet!', 'tt_theme_framework' ) . '</li>';
?>
        <?php
        }
    }
    wp_reset_query();
    echo '</ul>';
}
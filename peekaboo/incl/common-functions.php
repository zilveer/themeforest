<?php

/*-----------------------------------------------------------------------------------*/
/* Custom Pagination
/*-----------------------------------------------------------------------------------*/
function pkb_pagination($pages = '', $range = 1)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class=\"pagination-centered\">";
        echo "<ul class=\"pagination\"><span>";

        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li class=\"arrow\"><a href='" . get_pagenum_link(1) . "'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages) echo "<li class=\"arrow\"><a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a></li>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<li class=\"current\"><a href=\"\">" . $i . "</a></li>" : "<li><a href='" . get_pagenum_link($i) . "' class=\"inactive\">" . $i . "</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<li class=\"arrow\"><a href=\"" . get_pagenum_link($paged + 1) . "\">&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li class=\"arrow\"><a href='" . get_pagenum_link($pages) . "'>&raquo;</a></li>";
        echo "</ul>\n";
        echo "</div>\n";

    }
}


/*-----------------------------------------------------------------------------------*/
/* Custom Meta Info
/*-----------------------------------------------------------------------------------*/

if (!function_exists('pkb_posted_on')) :
    function pkb_posted_on()
    {
        printf(__('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'peekaboo'),
            'meta-prep meta-prep-author',
            sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr(get_the_time()),
                get_the_date()
            ),
            sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url(get_the_author_meta('ID')),
                sprintf(esc_attr__('View all posts by %s', 'peekaboo'), get_the_author()),
                get_the_author()
            )
        );
    }
endif;

if (!function_exists('pkb_caldate_on')) :
    function pkb_caldate_on()
    {
        printf(__('<li><i class="fontawesome-calendar-empty fonticon fonticon"></i> %1$s </li>', 'peekaboo'),
            get_the_date(),
            get_template_directory_uri()
        );
    }
endif;

if (!function_exists('pkb_posted_in')) :
    function pkb_posted_in()
    {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');

        if ($tag_list) {
            $posted_in = __('<li><i class="fontawesome-folder fonticon"></i> %1$s</li><li><i class="fontawesome-tag fonticon"></i> %2$s</li>', 'peekaboo');
        } else {
            $posted_in = __('<li><i class="fontawesome-folder fonticon"></i> %1$s</li>', 'peekaboo');
        }

        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list(', '),
            $tag_list,
            get_template_directory_uri()
        );
    }
endif;


/*-----------------------------------------------------------------------------------*/
/*  Circular thumbnail
/*-----------------------------------------------------------------------------------*/
if (!function_exists('pkb_round_thumb')) :

    function pkb_round_thumb()
    {
        $thumbnail = '';

        if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {

            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'round-thumbnail');
            $thumb = explode('src="', $thumbnail);
            $thumb = explode('"', $thumb[1]);
            $thumb_url = $thumb[0];

            echo '<div class="thumbnail_60_left" style="background: url(&quot;';
            printf($thumb_url);
            echo '&quot;) repeat;"></div>';
        }
    }
endif;


/*-----------------------------------------------------------------------------------*/
/*  Breadcrumbs
/*-----------------------------------------------------------------------------------*/
function pkb_breadcrumbs()
{
    global $smof_data;
    $testimonialPageId     = isset( $smof_data['pkb_testimonial_page'] ) ? $smof_data['pkb_testimonial_page'] : '';
    $galleryPageId     = isset( $smof_data['pkb_gallery_page'] ) ? $smof_data['pkb_gallery_page'] : '';

    if ($smof_data['pkb_breadcrumbs_bar'] == 1) {
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '';
        $home = __('Home', 'peekaboo'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<li class="current">'; // tag before the current crumb
        $after = '</li>'; // tag after the current crumb

        $pagetestimonial = '?pagename=' . $testimonialPageId;
        $pagegallery = '?pagename=' . $galleryPageId;

        global $post;
        $homeLink = home_url();

        if (is_home() || is_front_page()) {
            if ($showOnHome == 1) echo '<ul id="pkb-crumbs" class="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
        } else {
            echo '<ul id="pkb-crumbs" class="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';
            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_search()) {
                echo $before . 'Search results for "' . get_search_query() . '"' . $after;
            } elseif (is_day()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                echo '<li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {

                if (get_post_type() == 'gallery') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<li><a href="' . $homeLink . '/' . $pagegallery . '/">' . $post_type->labels->singular_name . '</a></li>';
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } elseif (get_post_type() != 'testimonial') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<li><a href="' . $homeLink . '/' . $pagetestimonial . '/">' . $post_type->labels->singular_name . '</a></li>';
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } elseif (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
                    if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo '<li>' . $cats . '</li>';
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_tag()) {
                echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Articles posted by ' . $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }
            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '(';
                echo '<li>' . __('Page', 'peekaboo') . ' ' . get_query_var('paged') . '</li>';
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
            }
            echo '</ul>';
        }
    }
    //end if get option
}

/*-----------------------------------------------------------------------------------*/
/* Slide
/*-----------------------------------------------------------------------------------*/
function pkb_slider()
{
    global $smof_data;

    if (is_page_template('page-home.php') || is_single()) {
        $animation = $smof_data['pkb_slide_effect'];
        $slideshowSpeed = $smof_data['pkb_slideshow_speed'];
        $animationSpeed = $smof_data['pkb_animation_speed'];
        $controlNav = $smof_data['pkb_control_nav'];
        $directionNav = $smof_data['pkb_direction_nav'];
        $pauseOnHover = $smof_data['pkb_pause_On_Hover'];
        ?>
        <script type="text/javascript">
            jQuery(function ($) {
                $(document).ready(function () {

                    if ($().flexslider) {
                        $('.flexslider').flexslider({
                            <?php if($animation) : ?> animation: "<?php echo $animation; ?>", <?php endif; ?>
                            <?php if($slideshowSpeed) : ?> slideshowSpeed: <?php echo $slideshowSpeed; ?>, <?php endif; ?>
                            <?php if($animationSpeed) : ?> animationSpeed: <?php echo $animationSpeed; ?>, <?php endif; ?>
                            <?php if($controlNav == 0) : ?> controlNav: false, <?php endif; ?>
                            <?php if($directionNav == 0) : ?> directionNav: false, <?php endif; ?>
                            <?php if($pauseOnHover == 1) : ?> pauseOnHover: true, <?php endif; ?>
                            smoothHeight: true
                        });
                    }
                    ;

                });
            })
        </script>
    <?php
    }
}

add_action('wp_footer', 'pkb_slider');


/*-----------------------------------------------------------------------------------*/
/* Colorbox
/*-----------------------------------------------------------------------------------*/

function pkb_colorbox($postid, $thumb_size)
{

    $link = get_post_meta($postid, 'pkb_upload_image', true);
    $video = get_post_meta($postid, 'pkb_video_url', true);
    $thumb = pkb_remove_imgattr(get_the_post_thumbnail($postid, $thumb_size));
    $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'single-image', false, '');

    /*Display single-gallery.php if video URL or featured images is availabe*/
    if ($thumb_url != '' || $video != '') {
        $output = '<a href="' . get_permalink($postid) . '" class="th" title="' . get_the_title($postid) . '" >' . $thumb . '</a>';
    } /*Display the image / video in modal if there is video URL or Slideshow Images*/
    else {
        $output = '<a title="' . get_the_title($postid) . '" href="' . get_permalink($postid) . '" class="th">' . $thumb . '</a>';
    }

    echo $output;
}


/*-----------------------------------------------------------------------------------*/
/*  Check video url functions
/*-----------------------------------------------------------------------------------*/

function pkb_video($postid)
{

    $video_url = get_post_meta($postid, 'pkb_video_url', true);

    if (preg_match('/youtube/', $video_url)) {

        if (preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video_url, $matches)) {
            $output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="645" height="514" src="http://www.youtube.com/embed/' . $matches[1] . '" frameborder="0" allowFullScreen></iframe>';
        } else {
            $output = __('Invalid <strong>Youtube</strong> URL.', 'peekaboo');
        }

    } elseif (preg_match('/vimeo/', $video_url)) {

        if (preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video_url, $matches)) {
            $output = '<iframe src="http://player.vimeo.com/video/' . $matches[1] . '" width="645" height="363" frameborder="0"></iframe>';
        } else {
            $output = __('Invalid <strong>Vimeo</strong> URL.', 'peekaboo');
        }

    } else {
        $output = stripslashes(htmlspecialchars_decode($video_url));
    }
    echo $output;
}


/*-----------------------------------------------------------------------------------*/
/*  Custom walker for Quickmenu
/*-----------------------------------------------------------------------------------*/
class quickmenu_nav_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a class="menu-box"' . $attributes . '>';
        $item_output .= $args->link_before . '<span class="title">' . apply_filters('the_title', $item->title, $item->ID) . '</span>' . $args->link_after;
        // $item_output .= "<br/>{$item->attr_title}";
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Custom walker for gallery filter
/*-----------------------------------------------------------------------------------*/

class Walker_Category_Filter extends Walker_Category
{
    function start_el(&$output, $category, $depth = 0, $args = array(), $current_object_id = 0)
    {

        extract($args);
        $cat_name = esc_attr($category->name);
        $cat_name = apply_filters('list_cats', $cat_name, $category);
        $link = '<a href="#" data-option-value=".' . strtolower(preg_replace('/\s+/', '-', $cat_name)) . '" ';
        if ($use_desc_for_title == 0 || empty($category->description))
            $link .= 'title="' . sprintf(__('View all posts filed under %s', 'peekaboo'), $cat_name) . '"';
        else
            $link .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
        $link .= '>';
        // $link .= $cat_name . '</a>';
        $link .= $cat_name;
        if (!empty($category->description)) {
            $link .= ' <span>' . $category->description . '</span>';
        }
        $link .= '</a>';
        if ((!empty($feed_image)) || (!empty($feed))) {
            $link .= ' ';
            if (empty($feed_image))
                $link .= '(';
            $link .= '<a href="' . get_category_feed_link($category->term_id, $feed_type) . '"';
            if (empty($feed))
                $alt = ' alt="' . sprintf(__('Feed for all posts filed under %s', 'peekaboo'), $cat_name) . '"';
            else {
                $title = ' title="' . $feed . '"';
                $alt = ' alt="' . $feed . '"';
                $name = $feed;
                $link .= $title;
            }
            $link .= '>';
            if (empty($feed_image))
                $link .= $name;
            else
                $link .= "<img src='$feed_image'$alt$title" . ' />';
            $link .= '</a>';
            if (empty($feed_image))
                $link .= ')';
        }
        if (isset($show_count) && $show_count)
            $link .= ' (' . intval($category->count) . ')';
        if (isset($show_date) && $show_date) {
            $link .= ' ' . gmdate('Y-m-d', $category->last_update_timestamp);
        }
        if (isset($current_category) && $current_category)
            $_current_category = get_category($current_category);
        if ('list' == $args['style']) {
            $output .= '<li class="segment-' . rand(2, 99) . '"';
            $class = 'cat-item cat-item-' . $category->term_id;
            if (isset($current_category) && $current_category && ($category->term_id == $current_category))
                $class .= ' current-cat';
            elseif (isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent))
                $class .= ' current-cat-parent';
            $output .= '';
            $output .= ">$link\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/* Removes width and heigh attribut from images
/*-----------------------------------------------------------------------------------*/
function pkb_remove_imgattr($string)
{
    return preg_replace('/\<(.*?)(width="(.*?)")(.*?)(height="(.*?)")(.*?)\>/i', '<$1$4$7>', $string);
}


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function pkb_favicon()
{
	global $smof_data;
	if ($smof_data['pkb_custom_favicon'] != '') {
		echo '<link rel="shortcut icon" href="' . $smof_data['pkb_custom_favicon'] . '" type="image/x-icon"/>' . "\n";
	} else {
		?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon"/>
	<?php
	}
}

add_action('wp_head', 'pkb_favicon');


/*-----------------------------------------------------------------------------------*/
/* Google Analytics
/*-----------------------------------------------------------------------------------*/

function pkb_analytics()
{
    global $smof_data;
    if ($smof_data['pkb_ga_code'] != '') {
        echo stripslashes($smof_data['pkb_ga_code']) . "\n";
    }
}

add_action('wp_head', 'pkb_analytics');

/*-----------------------------------------------------------------------------------*/
/* Custom CSS */
/*-----------------------------------------------------------------------------------*/

function pkb_custom_css()
{
    global $smof_data;

    $css_script_container = array();
    $css_array = array();

    $custom_css = $smof_data['pkb_custom_css'];
    $google_font = $smof_data['pkb_google_font'];

    $heading_color = $smof_data['pkb_main_heading_color'];
    $page_title_heading_color = $smof_data['pkb_page_title_heading_color'];
    $footer_heading_color = $smof_data['pkb_footer_heading_color'];

    $main_background_color = $smof_data['pkb_main_background'];
    $page_title_background = $smof_data['pkb_page_title_background'];
    $footer_background_color = $smof_data['pkb_footer_background'];

    $links_color = $smof_data['pkb_links_color'];


    $custom_bg_img = $smof_data['pkb_bg_image'];
    $full_screen_bg = $smof_data['pkb_bg_full'];
    $custom_bg_repeat = $smof_data['pkb_bg_repeat'];
    $custom_bg_color = $smof_data['pkb_bg_color'];

    $body_size = $smof_data['pkb_body_font']['size'];
    $body_type = $smof_data['pkb_body_font']['face'];
    $body_style = $smof_data['pkb_body_font']['style'];
    $body_color = $smof_data['pkb_body_font']['color'];

    $learn_more_bg_color = $smof_data['pkb_learn_more_bg_color'];
    $learn_more_bg_hover_color = $smof_data['pkb_learn_more_bg_hover_color'];
    $learn_more_color = $smof_data['pkb_learn_more_color'];

    $cta_mod_bg_color = $smof_data['pkb_cta_mod_bg_color'];
    $cta_mod_bg_hover_color = $smof_data['pkb_cta_mod_bg_hover_color'];
    $cta_mod_color = $smof_data['pkb_cta_mod_color'];

    $menu_item_img_1 = $smof_data['pkb_menu_item_img_1'];
// $menu_item_id_1 = $smof_data['pkb_menu_item_id_1'];
    $menu_item_img_2 = $smof_data['pkb_menu_item_img_2'];
// $menu_item_id_2 = $smof_data['pkb_menu_item_id_2'];
    $menu_item_img_3 = $smof_data['pkb_menu_item_img_3'];
// $menu_item_id_3 = $smof_data['pkb_menu_item_id_3'];
    $menu_item_img_4 = $smof_data['pkb_menu_item_img_4'];
// $menu_item_id_4 = $smof_data['pkb_menu_item_id_4'];

    //custom css
    if (!empty($custom_css)) {
        array_push($css_array, $custom_css);
    }

    //google web fonts
    if ($google_font != 'none') {
        if ($google_font == 'Raleway') {
            $google_font_link = '<link href="//fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet" type="text/css">' . "\n";
        } else {
            $google_font_link = '<link href="//fonts.googleapis.com/css?family=' . $google_font . '" rel="stylesheet" type="text/css" />' . "\n";
        }

        // $google_font_link = '<link href="//fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet" type="text/css">'."\n";

        $google_font_code = '.replace {font-family:\'' . $google_font . '\';}' . "\n";
        array_push($css_script_container, $google_font_link);
        array_push($css_array, $google_font_code);
    }

    //body typography
    if ($body_size && ($body_size != '16px')) {
        $body_typography_code = 'body { font-size:' . $body_size . '; }' . "\n";
        array_push($css_array, $body_typography_code);
    }
    if ($body_type && ($body_type != 'arial')) {
        $body_typography_code = 'body { font-family:' . $body_type . '; }' . "\n";
        array_push($css_array, $body_typography_code);
    }
    if ($body_style && ($body_style != 'normal')) {
        $body_typography_code = 'body { font-style:' . $body_style . '; }' . "\n";
        array_push($css_array, $body_typography_code);
    }
    if ($body_color && ($body_color != '#555555')) {
        $body_typography_code = 'body { color:' . $body_color . '; }' . "\n";
        array_push($css_array, $body_typography_code);
    }

    //heading color
    if ($heading_color != '') {
        $heading_color_code = 'h1, h2, h3, h4, h5, h6, .post h2 a, .post_title a  {  color:' . $heading_color . '; }' . "\n";
        array_push($css_array, $heading_color_code);
    }
    if ($page_title_heading_color != '') {
        $heading_color_code = '.page_title h1 {  color:' . $page_title_heading_color . '; }' . "\n";
        array_push($css_array, $heading_color_code);
    }
    if ($footer_heading_color != '') {
        $heading_color_code = '#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer-bottom, #footer-bottom a  {  color:' . $footer_heading_color . '; }' . "\n";
        array_push($css_array, $heading_color_code);
    }

    // links color
    if ($links_color != '') {
        $links_color_code = 'a {  color:' . $links_color . '; }' . "\n";
        array_push($css_array, $links_color_code);
    }

    // buttons color
    if ($cta_mod_bg_color != '') {
        $buttons_color_code = '.overview li a.menu-box {  background-color:' . $cta_mod_bg_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }
    if ($cta_mod_bg_hover_color != '') {
        $buttons_color_code = '.overview li a.menu-box:hover {  background-color:' . $cta_mod_bg_hover_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }
    if ($cta_mod_color != '') {
        $buttons_color_code = '.overview span.title {  color:' . $cta_mod_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }

    if ($learn_more_bg_color != '') {
        $buttons_color_code = '.fancy {  background-color:' . $learn_more_bg_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }
    if ($learn_more_bg_hover_color != '') {
        $buttons_color_code = '.fancy:hover {  background-color:' . $learn_more_bg_hover_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }
    if ($learn_more_color != '') {
        $buttons_color_code = '.fancy, .fancy:hover {  color:' . $learn_more_color . '; }' . "\n";
        array_push($css_array, $buttons_color_code);
    }


    //background color
    if ($main_background_color != '') {
        $background_color = '#main  {  background-color:' . $main_background_color . '; }' . "\n";
        array_push($css_array, $background_color);
    }
    if ($page_title_background != '') {
        $background_color = '.page_title {  background-color:' . $page_title_background . '; }' . "\n";
        array_push($css_array, $background_color);
    }
    if ($footer_background_color != '') {
        $background_color = '.footer-container  {  background-color:' . $footer_background_color . '; }' . "\n";
        array_push($css_array, $background_color);
    }

    //custom background
    if ($custom_bg_img != '') {
        $background_code = 'body  { background-image:  url(' . $custom_bg_img . '); }' . "\n";
        array_push($css_array, $background_code);
    }
    if ($custom_bg_color != '') {
        $background_code = 'body  { background-color: ' . $custom_bg_color . '; }' . "\n";
        array_push($css_array, $background_code);
    }

    if ($full_screen_bg == 0) {
        $background_code = 'body  { -webkit-background-size: auto;
    -moz-background-size: auto; -o-background-size: auto; background-size: auto; }' . "\n";
        array_push($css_array, $background_code);
        if ($custom_bg_repeat != '') {
            $background_code = 'body  { background-repeat: ' . $custom_bg_repeat . '; }' . "\n";
            array_push($css_array, $background_code);

        }

    }


    //quickmenu icons
    if ($menu_item_img_1 != '') {
        $menu_item_code = '.overview .quickmenu-item-1 .menu-box { background-image:  url(' . $menu_item_img_1 . '); }' . "\n";
        array_push($css_array, $menu_item_code);
    }
    if ($menu_item_img_2 != '') {
        $menu_item_code = '.overview .quickmenu-item-2 .menu-box { background-image:  url(' . $menu_item_img_2 . '); }' . "\n";
        array_push($css_array, $menu_item_code);
    }
    if ($menu_item_img_3 != '') {
        $menu_item_code = '.overview .quickmenu-item-3 .menu-box { background-image:  url(' . $menu_item_img_3 . '); }' . "\n";
        array_push($css_array, $menu_item_code);
    }
    if ($menu_item_img_4 != '') {
        $menu_item_code = '.overview .quickmenu-item-4 .menu-box { background-image:  url(' . $menu_item_img_4 . '); }' . "\n";
        array_push($css_array, $menu_item_code);
    }

    //print <head>
    if (!empty($css_array)) {
        echo"<style type='text/css'>\n";
        foreach ($css_array as $css_item) {
            echo $css_item . "\n";
        }
        echo"</style>\n";
    }

    if (!empty($css_script_container)) {
        foreach ($css_script_container as $css_link) {
            echo $css_link . "\n";
        }
    }

}

add_action('wp_head', 'pkb_custom_css', 30);



add_filter( 'wp_title', 'pkb_wp_title_filter' );

/**
 * Customize the title for the home page, if one is not set.
 *
 * @param string $title The original title.
 * @return string The title to use.
 */
function pkb_wp_title_filter( $title )
{
    if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
        $title = __( 'Home', 'peekaboo' ) . ' | ' . get_bloginfo( 'description' );
    }
    return $title;
}


?>
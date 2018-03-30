<?php

require_once("core/loader.php");

if (!isset($content_width)) $content_width = 940;

function get_theme_sidebars_for_admin()
{
    $theme_sidebars = get_theme_option("theme_sidebars");
    if (!is_array($theme_sidebars)) {
        $theme_sidebars = array();
    }

    return $theme_sidebars;
}


function get_theme_option($optionname)
{
    global $gt3_themeshort;
    $returnedValue = get_option($gt3_themeshort . $optionname);

    if (gettype($returnedValue) == "string") {
        return stripslashes($returnedValue);
    } else {
        return $returnedValue;
    }
}

function the_theme_option($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $gt3_themeshort;
    $returnedValue = get_option($gt3_themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        echo $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function get_text($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $gt3_themeshort;
    $returnedValue = get_option($gt3_themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        return $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function get_if_strlen($str, $beforeoutput = "", $afteroutput = "")
{
    if (strlen($str) > 0) {
        return $beforeoutput . $str . $afteroutput;
    }
}

function the_text($optionname, $beforeoutput = "", $afteroutput = "")
{
    global $gt3_themeshort;
    $returnedValue = get_option($gt3_themeshort . $optionname);

    if (strlen($returnedValue) > 0) {
        echo $beforeoutput . stripslashes($returnedValue) . $afteroutput;
    }
}

function delete_theme_option($optionname)
{
    global $gt3_themeshort;
    return delete_option($gt3_themeshort . $optionname);
}

function update_theme_option($optionname, $optionvalue)
{
    global $gt3_themeshort;
    if (update_option($gt3_themeshort . $optionname, $optionvalue)) {
        return true;
    }
}

function messagebox($actionmessage)
{
    $compile = "<div class='admin_message_box fadeout'>" . $actionmessage . "</div>";
    return $compile;
}

function breaksToBR($content, $changeto = "")
{

    $content = nl2br($content);
    $content = str_replace("\r\n", "", $content);
    $content = str_replace("\n", "", $content);

    return $content;
}


#Get all portfolio category inline (With Ajax)
function showPortCategoryWithAjax($postid = "")
{
    if (!isset($term_list)) {
        $term_list = '';
    }
    $permalink = get_permalink();
    $args = array('taxonomy' => 'Category');
    $terms = get_terms('portcat', $args);
    $count = count($terms);
    $i = 0;
    $iterm = 1;

    if ($count > 0) {
        if (!isset($_GET['slug'])) $all_current = 'selected';
        $cape_list = '';
        $term_list .= '<li class="' . $all_current . '">';

        $term_list .= '<a href="#filter" data-option-value="*">' . ((get_theme_option("translator_status") == "enable") ? get_text("translator_portfolio_all") : __('All','theme_localization')) . '</a>
        <div class="filter_fadder"></div>
		</li>';
        $termcount = count($terms) ;
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $i++;
                $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                $term_list .= '<li ';
                if (isset($_GET['slug'])) {
                    $getslug = $_GET['slug'];
                } else {
                    $getslug = '';
                }
                if (strnatcasecmp($getslug, $term->name) == 0) $term_list .= 'class="selected"';

                $tempname = strtr($term->name, array(
                    ' ' => '-',
                ));
                $tempname = strtolower($tempname);

                $term_list .= '><a href="#filter" data-option-value=".' . $tempname . '" title="View all post filed under ">' . $term->name . '</a>
                    <div class="filter_fadder"></div>
                </li>';
                if ($count != $i) $term_list .= ' '; else $term_list .= '';
                #if ($iterm<$termcount) {$term_list .= '<li class="sep fltr_after">:</li>';}
                $iterm++;
            }
        }
        echo '<ul class="optionset" data-option-key="filter">' . $term_list . '</ul>';
    }
}



#Get all portfolio category inline (Without Ajax)
function showPortCategoryWithoutAjax($postid = "")
{
    if (!isset($term_list)) {
        $term_list = '';
    }
    $permalink = get_permalink();
    $args = array('taxonomy' => 'Category');
    $terms = get_terms('portcat', $args);
    $count = count($terms);
    $i = 0;
    $iterm = 1;

    if ($count > 0) {
        $cape_list = '';
        $term_list .= '<li class="' . (!isset($_GET['slug']) ? 'selected' : '') . '">';

        $term_list .= '<a href="'.$permalink.'" data-option-value="*">' . ((get_theme_option("translator_status") == "enable") ? get_text("translator_portfolio_all") : __('All','theme_localization')) . '</a>
        <div class="filter_fadder"></div>
		</li>';
        $termcount = count($terms) ;
        if (is_array($terms)) {
            foreach ($terms as $term) {
                $i++;
                $permalink = esc_url(add_query_arg("slug", $term->slug, $permalink));
                $term_list .= '<li ';
                if (isset($_GET['slug'])) {
                    $getslug = $_GET['slug'];
                } else {
                    $getslug = '';
                }
                if (strnatcasecmp($getslug, $term->name) == 0) $term_list .= 'class="selected"';

                $term_list .= '><a href="'.$permalink.'" title="View all post filed under ">' . $term->name . '</a>
                    <div class="filter_fadder"></div>
                </li>';
                if ($count != $i) $term_list .= ' '; else $term_list .= '';

                $iterm++;
            }
        }
        echo '<ul class="optionset">' . $term_list . '</ul>';
    }
}


function theme_comment($comment, $args, $depth)
{
    $max_depth_comment = $args['max_depth'];
    if ($max_depth_comment > 4) {
        $max_depth_comment = 4;
    }
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="stand_comment">
        <div class="commentava"><?php echo get_avatar($comment->comment_author_email, 80); ?></div>
        <div class="thiscommentbody">
            <div class="comment_info">
                <span class="author_name"><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("posted_by") : __('Posted by','theme_localization')); ?> <?php printf('%s', get_comment_author_link()) ?> <?php edit_comment_link('(Edit)', '  ', '') ?></span>
                <span class="date"><?php printf('%1$s at %2$s', get_comment_date("d M Y"), get_comment_time()) ?></span>
                <?php comment_reply_link(array_merge($args, array('before' => ' <span class="comments">', 'after' => '</span>', 'depth' => $depth, 'reply_text' => (get_theme_option("translator_status") == "enable") ? get_text("translator_reply_value") : __('Reply','theme_localization'), 'max_depth' => $max_depth_comment))) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <p><em><?php (get_theme_option("translator_status") == "enable") ? the_text("translator_awaiting_moder_value") : _e('Your comment is awaiting moderation.','theme_localization'); ?></em></p>
            <?php endif; ?>
            <?php comment_text() ?>
        </div>
        <div class="clear"></div>
    </div>
    <?php
}


#Get all pages for create portfolio page
function getAllPagesForSelect()
{
    $compile = array();
    $pages = get_pages();
    if (is_array($pages)) {
        foreach ($pages as $pagg) {
            $compile[$pagg->ID] = $pagg->post_title;
        }
    }
    return $compile;
}


#Custom paging
function get_pagination($range = 10, $type = "")
{


    if ($type == "show_in_shortcodes") {
        global $paged, $wp_query_in_shortcodes;
        $wp_query = $wp_query_in_shortcodes;
    } else {
        global $paged, $wp_query;
    }

    if(empty($paged)){
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    }

    // $paged - number of the current page
    // How much pages do we have?
    #if (!$max_page) {
    $max_page = $wp_query->max_num_pages;
    #}
    if ($max_page > 1) {
        echo '<ul class="pagerblock">';
    }
    // We need the pagination only if there are more than 1 page
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }
        // On the first page, don't put the First page link
        if ($paged != 1) {
            //echo "<li><a class='btn_firstpage' href=" . get_pagenum_link(1) . ">First Page</a></li>";
        }
        // To the previous page
        $ppl = "<span class='btn_prev'></span>";
        #echo "<li>" . get_previous_posts_link($ppl) . "</li>";
        // We need the sliding effect only if there are more pages than is the sliding range
        if ($max_page > $range) {
            // When closer to the beginning
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            } // When closer to the end
            elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
            // Somewhere in the middle
            elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    echo "<li><a href='" . get_pagenum_link($i) . "'";
                    if ($i == $paged) echo " class='current'";
                    echo ">$i</a></li>";
                }
            }
        } // Less pages than the range, no sliding effect needed
        else {
            for ($i = 1; $i <= $max_page; $i++) {
                echo "<li><a href='" . get_pagenum_link($i) . "'";
                if ($i == $paged) echo " class='current'";
                echo ">$i</a></li>";
            }
        }
        // Next page
        $npl = "<span class='btn_next'></span>";
        #echo "<li>" . get_next_posts_link($npl) . "</li>";
        // On the last page, don't put the Last page link
        if ($paged != $max_page) {
            //echo " <li><a class='btn_lastpage' href=" . get_pagenum_link($max_page) . ">Last Page</a></li>";
        }
    }
    if ($max_page > 1) {
        echo '</ul>';
    }
}


#Send feedback
function sendFeedback($feedback_email, $feedback_msg, $feedback_name, $subject)
{
    $feedback_email = filter_var(esc_attr($feedback_email), FILTER_SANITIZE_EMAIL);
    $feedback_msg = esc_attr($feedback_msg);
    $feedback_name = esc_attr($feedback_name);
    $subject = esc_attr($subject);

    $admin_email = get_theme_option('contacts_to');
    if ($subject == "" || $subject == "Subject") {
        $subject = ((get_theme_option("translator_status") == "enable") ? get_text("contacts_subject") : __('[Website] Contact Form','theme_localization'));
    }
    $message = "
	<html>
	<head>
	</head>
	<body>
		<p><a href='mailto:" . $feedback_email . "'>" . $feedback_name . "</a> send this message from " . get_bloginfo('name') . ":</p>
		<p>" . $feedback_msg . "</p>
	</body>
	</html>
	";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: ' .$feedback_email. "\r\n";

    mail($admin_email, $subject, $message, $headers);
}


if (!function_exists('crop_str')) {
    function crop_str($string, $limit)
    {

        $substring_limited = substr($string, 0, $limit);
        $compile = substr($substring_limited, 0, strrpos($substring_limited, ' '));
        $comacheck = substr($compile, -1);
        if ($comacheck == ",") {
            $compile = substr($compile, 0, -1);
        }
        if ($comacheck == ".") {
            $compile = substr($compile, 0, -1);
        }

        return $compile;

    }
}

function socsm($socname, $class = "", $title = "")
{
    if (strlen(get_theme_option($socname)) > 0) {
        return "<li><a target='_blank' href='" . get_theme_option($socname) . "' class='{$class}' title='{$title}'></a></li>";
    } else {
        return false;
    }
}


function smarty_modifier_truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
{
    if ($length == 0)
        return '';

    if (mb_strlen($string, 'utf8') > $length) {
        $length -= mb_strlen($etc, 'utf8');
        if (!$break_words && !$middle) {
            $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
        }
        if (!$middle) {
            return mb_substr($string, 0, $length, 'utf8') . $etc;
        } else {
            return mb_substr($string, 0, $length / 2, 'utf8') . $etc . mb_substr($string, -$length / 2, utf8);
        }
    } else {
        return $string;
    }
}


/* Define the custom boxes for team */
add_action('add_meta_boxes', 'teams_add_custom_box');

/* Do something with the data entered */
add_action('save_post', 'teams_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function teams_add_custom_box()
{
    add_meta_box(
        'teams_sectionid',
        'Details',
        'teams_inner_custom_box',
        'team'
    );
}

/* Prints the box content */
function teams_inner_custom_box($post)
{

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'teams_noncename');

    $teams_position = get_post_meta($post->ID, "teams_position", true);
    $twitter_link = get_post_meta($post->ID, "twitter_link", true);
    $facebook_link = get_post_meta($post->ID, "facebook_link", true);
    $flickr_link = get_post_meta($post->ID, "flickr_link", true);
    $tumblr_link = get_post_meta($post->ID, "tumblr_link", true);
    $linkedin_link = get_post_meta($post->ID, "linkedin_link", true);
    $member_email = get_post_meta($post->ID, "member_email", true);


    echo '
	<div class="teams_cont">
		<div class="append_items">
        
			<label for="teams_position" class="label_type1">Position:</label> <input type="text" value="' . $teams_position . '" id="teams_position" name="teams_position" class="teams_position itt_type1"><br>
			
			<label for="twitter_link" class="label_type1">Twitter link:</label> <input type="text" value="' . $twitter_link . '" id="twitter_link" name="twitter_link" class="twitter_link itt_type1"><br>
			
			<label for="facebook_link" class="label_type1">Facebook link:</label> <input type="text" value="' . $facebook_link . '" id="facebook_link" name="facebook_link" class="facebook_link itt_type1"><br>

			<label for="tumblr_link" class="label_type1">Tumblr link:</label> <input type="text" value="' . $tumblr_link . '" id="tumblr_link" name="tumblr_link" class="tumblr_link itt_type1"><br>

			<label for="linkedin_link" class="label_type1">LinkedIn link:</label> <input type="text" value="' . $linkedin_link . '" id="linkedin_link" name="linkedin_link" class="linkedin_link itt_type1"><br>

			<label for="member_email" class="label_type1">Email:</label> <input type="text" value="' . $member_email . '" id="member_email" name="member_email" class="member_email itt_type1"><br>

            <!--label for="flickr_link" class="label_type1">Flickr link:</label> <input type="text" value="' . $flickr_link . '" id="flickr_link" name="flickr_link" class="flickr_link itt_type1"><br-->
			
		</div>
	</div>
  ';
}

/* When the post is saved, saves our custom data */
function teams_save_postdata($post_id)
{
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    #if (!wp_verify_nonce($_POST['teams_noncename'], plugin_basename(__FILE__)))
    #    return;


    // Check permissions
    if (isset($_POST['post_type']) && 'teams' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }


    // OK, save the data

    if (isset($_POST)) {

        if (isset($_POST['teams_position'])) {
            $teams_position = esc_attr($_POST['teams_position']);
            update_post_meta($post_id, "teams_position", $teams_position);
        }

        if (isset($_POST['twitter_link'])) {
            $twitter_link = esc_url($_POST['twitter_link']);
            update_post_meta($post_id, "twitter_link", $twitter_link);
        }

        if (isset($_POST['facebook_link'])) {
            $facebook_link = esc_url($_POST['facebook_link']);
            update_post_meta($post_id, "facebook_link", $facebook_link);
        }

        if (isset($_POST['flickr_link'])) {
            $flickr_link = esc_url($_POST['flickr_link']);
            update_post_meta($post_id, "flickr_link", $flickr_link);
        }

        if (isset($_POST['tumblr_link'])) {
            $tumblr_link = esc_url($_POST['tumblr_link']);
            update_post_meta($post_id, "tumblr_link", $tumblr_link);
        }

        if (isset($_POST['linkedin_link'])) {
            $linkedin_link = esc_url($_POST['linkedin_link']);
            update_post_meta($post_id, "linkedin_link", $linkedin_link);
        }

        if (isset($_POST['member_email'])) {
            $member_email = filter_var(esc_attr($_POST['member_email'], FILTER_SANITIZE_EMAIL));
            update_post_meta($post_id, "member_email", $member_email);
        }

    }

}


/* Define the custom boxes for testimonials */
add_action('add_meta_boxes', 'testimonials_add_custom_box');

/* Do something with the data entered */
add_action('save_post', 'testimonials_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function testimonials_add_custom_box()
{
    add_meta_box(
        'testimonials_sectionid',
        'Details',
        'testimonials_inner_custom_box',
        'testimonials'
    );
}

/* Prints the box content */
function testimonials_inner_custom_box($post)
{

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'testimonials_noncename');

    $testimonials_author = get_post_meta($post->ID, "testimonials_author", true);
    $testimonials_position = get_post_meta($post->ID, "testimonials_position", true);

    echo '
	<div class="testimonials_cont">
		<div class="append_items">
			<label for="testimonials_author" class="label_type1" style="display: block;float: left;line-height: 24px;width: 53px;">Author:</label> <input type="text" value="' . $testimonials_author . '" id="testimonials_author" name="testimonials_author" class="testimonials_author itt_type1" style="width:95%;"><br>
			<label for="testimonials_position" class="label_type1" style="display: block;float: left;line-height: 24px;width: 53px;">Position:</label> <input type="text" value="' . $testimonials_position . '" id="testimonials_position" name="testimonials_position" class="testimonials_position itt_type1" style="width:95%;"><br>
		</div>
	</div>
  ';
}

/* When the post is saved, saves our custom data */
function testimonials_save_postdata($post_id)
{
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    #if (!wp_verify_nonce($_POST['testimonials_noncename'], plugin_basename(__FILE__)))
    #   return;


    // Check permissions
    if (isset($_POST['post_type']) && 'testimonials' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }

    // OK, save the data
    if (isset($_POST['testimonials_author'])) {
        $testimonials_author = $_POST['testimonials_author'];
        update_post_meta($post_id, "testimonials_author", $testimonials_author);
    }

    if (isset($_POST['testimonials_position'])) {
        $testimonials_position = $_POST['testimonials_position'];
        update_post_meta($post_id, "testimonials_position", $testimonials_position);
    }
}



/* Define the custom boxes for partner */
add_action('add_meta_boxes', 'partners_add_custom_box');

/* Do something with the data entered */
add_action('save_post', 'partners_save_postdata');

/* Adds a box to the main column on the Post and Page edit screens */
function partners_add_custom_box()
{
    add_meta_box(
        'partners_sectionid',
        'Details',
        'partners_inner_custom_box',
        'partners'
    );
}

/* Prints the box content */
function partners_inner_custom_box($post)
{

    // Use nonce for verification
    wp_nonce_field(plugin_basename(__FILE__), 'partners_noncename');

    $partners_url = get_post_meta($post->ID, "partners_url", true);

    echo '
	<div class="partners_cont">
		<div class="append_items">

			<label for="partners_url" class="label_type1">Url:</label> <input type="text" value="' . $partners_url . '" id="partners_url" name="partners_url" class="partners_url itt_type1"><br>

		</div>
	</div>
  ';
}

/* When the post is saved, saves our custom data */
function partners_save_postdata($post_id)
{
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    #if (!wp_verify_nonce($_POST['partners_noncename'], plugin_basename(__FILE__)))
    #    return;


    // Check permissions
    if (isset($_POST['post_type']) && 'partners' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return;
    } else {
        if (!current_user_can('edit_post', $post_id))
            return;
    }


    // OK, save the data

    if (isset($_POST)) {

        if (isset($_POST['partners_url'])) {
            $partners_url = $_POST['partners_url'];
            update_post_meta($post_id, "partners_url", $partners_url);
        }

    }

}


#Get all posts
function getAllPosts($posttype = "post")
{
    $compile = array();

    $args = array(
        'post_type' => $posttype,
        'numberposts' => -1,
        'post_status' => 'publish');

    $posts = get_posts($args);
    if (is_array($posts)) {
        foreach ($posts as $post) {
            $compile[$post->ID] = $post->post_title;
        }
    }
    return $compile;
}




function get_pf_icon($pf)
{
    $icon = '';
    switch ($pf) {
        case "default":
            $icon = "blog_text";
            break;
        case "image":
            $icon = "blog_slider";
            break;
        case "video":
            $icon = "blog_video";
            break;
        case "audio":
            $icon = "blog_audio";
            break;
    }

    return $icon;
}



function the_breadcrumb() {
    if (get_theme_option("show_breadcrumb") !== "off") {
        $showOnHome = 1;
        $delimiter = '';
        $home = 'Home';
        $showCurrent = 1;
        $before = '<li><span class="current">';
        $after = '</span></li>';

        global $post;
        $homeLink = home_url();

        if (is_home() || is_front_page()) {

            if ($showOnHome == 1) echo '<div class="breadcrumbs"><ul class="pathway"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul></div>';

        } else {

            echo '<div class="breadcrumbs"><ul class="pathway"><li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $delimiter . ' ';

            if ( is_category() ) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . 'Archive "' . single_cat_title('', false) . '"' . $after;

            }
            #PORTFOLIO
            elseif ( get_post_type() == 'port' ) {

                the_terms( $post->ID, 'portcat', '<li>', ', ', '</li>' );

                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif ( is_search() ) {
                echo $before . 'Search for "' . get_search_query() . '"' . $after;

            } elseif ( is_day() ) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;

            } elseif ( is_month() ) {
                echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;

            } elseif ( is_year() ) {
                echo $before . get_the_time('Y') . $after;

            } elseif ( is_single() && !is_attachment() ) {
                if ( get_post_type() != 'post' ) {

                    $parent_id  = $post->post_parent;
                    if ($parent_id>0) {
                        $breadcrumbs = array();
                        while ($parent_id) {
                            $page = get_page($parent_id);
                            $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                            $parent_id  = $page->post_parent;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for ($i = 0; $i < count($breadcrumbs); $i++) {
                            echo $breadcrumbs[$i];
                            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
                        }
                        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    } else {
                        echo $before . get_the_title() . $after;
                    }

                } else {
                    $cat = get_the_category(); $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo "<li>".$cats."</li>";
                    if ($showCurrent == 1) echo $before . get_the_title() . $after;
                }

            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;

            } elseif ( is_attachment() ) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID); $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif ( is_page() && !$post->post_parent ) {
                if ($showCurrent == 1) echo $before . get_the_title() . $after;

            } elseif ( is_page() && $post->post_parent ) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

            } elseif ( is_tag() ) {
                echo $before . 'Tag "' . single_tag_title('', false) . '"' . $after;

            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . 'Author ' . $userdata->display_name . $after;

            } elseif ( is_404() ) {
                echo $before . 'Error 404' . $after;
            }



            if ( get_query_var('paged') ) {
                /*if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                echo $delimiter. 'Page' . ' ' . get_query_var('paged');
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';*/
            }

            echo '</ul></div>';

        }
    }
} // end the_breadcrumb()

function theme_start_session() {
    if (!session_id())
        session_start();
}
add_action('init','theme_start_session');

#SET CAPTCHA ON START
if (!isset($_SESSION['theme_captcha'])) {
    get_theme_captcha();
}


function is_now_custom_font_selected($field_name_in_admin_panel) {
    global $gt3_themeconfig;
    if (is_array($gt3_themeconfig['custom_fonts_array'])) {
        foreach ($gt3_themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_family'] == $field_name_in_admin_panel) {
                return true;
            }
        }
    }
    return false;
}

// Woocommerce Related Products (Redefine woocommerce_output_related_products())
function woocommerce_output_related_products() {
    $args = array(
		'posts_per_page' => 3
	);
	woocommerce_related_products($args);
}

function gt3_custom_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    $title = get_bloginfo( 'name', 'display' ) . $title;

    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'gt3_custom_wp_title', 10, 2 );

?>
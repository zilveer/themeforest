<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Helper functions for various parts of the theme
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 4.2
 * @package     artbees
 */


/**
 * Builds content wrappers for the given content
 * @param string    $content
 * @param string    $type
 * @return HTML 
 *
 */
if (!function_exists('mk_build_main_wrapper')) {
    function mk_build_main_wrapper($content, $wrapper_custom_class = false, $master_holder_class = false) {
        
        // Get theme options from global mk_options variable.
        global $mk_options, $post;
        
        // Get layout option from post meta
        $layout = is_singular() ? get_post_meta($post->ID, '_layout', true) : '';
        
        // Check if it's single portfolio and and get the layout option from theme options
        $layout = (is_singular('portfolio')) ? ($layout == 'default' ? $mk_options['portfolio_single_layout'] : $layout) : $layout;

        // Check if it's single blog and and get the layout option from theme options
        $layout = (is_singular()) ? (($layout == 'default' || empty($layout)) ? $mk_options['single_layout'] : $layout) : $layout;

        // Employees single should always be full width.
        $layout = is_singular('employees') ? 'full' : $layout;
        
        $layout = (is_archive() && get_post_type() == 'post') ? $mk_options['archive_page_layout'] : $layout;
        
        $layout = (is_archive() && get_post_type() == 'portfolio') ? $mk_options['archive_portfolio_layout'] : $layout;
        
        $layout = is_search() ? $mk_options['search_page_layout'] : $layout;

        if (isset($_REQUEST['layout']) && !empty($_REQUEST['layout'])) {
            $layout = esc_html($_REQUEST['layout']);
        }

        // For other empty scenarios we get full layout.
        $layout = (empty($layout)) ? 'full' : $layout;
        
        $wrapper_class = empty($wrapper_custom_class) ? 'mk-main-wrapper mk-grid' : $wrapper_custom_class;

        $wrapper_id = is_singular() ? 'id="mk-page-id-'.$post->ID.'"' : '';
        $itemprop = (is_singular()) ? 'mainEntityOfPage' : 'mainContentOfPage';

        $schema_markup = (is_singular()) ?   get_schema_markup('blog') : get_schema_markup('main');


        
        /*
            Option to remove top and bottom padding of the content.
            Its used when page section will be added right after header
            and no space is desired
        */
        $padding = is_singular() ? get_post_meta($post->ID, '_padding', true) : 'false';
        $padding = ($padding == 'true') ? 'no-padding' : '';
        
        mk_get_view('blog/components', 'blog-single-bold-hero');
?>
        
        <div id="theme-page" class="master-holder <?php echo esc_attr($master_holder_class);?> clearfix" <?php echo $schema_markup; ?>>
            <div class="mk-main-wrapper-holder">
                <div <?php echo $wrapper_id; ?> class="theme-page-wrapper <?php
        echo $wrapper_class; ?> <?php
        echo $layout; ?>-layout <?php
        echo $padding; ?> ">
                      <div class="theme-content <?php
        echo $padding; ?>" itemprop="<?php echo $itemprop ?>">
                            <?php
        echo $content;
?>                      
                      <div class="clearboth"></div>
                      <?php
        if (mk_is_pages_comments_enabled()) {
            if (comments_open()) {
                comments_template('', true);
            }
        }
?>
                      </div>
                <?php
        if ($layout != 'full') { get_sidebar(); } ?>
                <div class="clearboth"></div>
                
                </div>
            </div>


                <?php
        
        // Will be loaded in single portfolio page only. located in views/portfolio/portfolio-similar-posts.php
        mk_get_view('portfolio/components', 'portfolio-similar-posts');
?>

        </div>          
<?php
    }
}

/**
 * Insert inline styles for node based on class. Run checks if they are declared
 * @return styles string
 * ==================================================================================
 */

if (!function_exists('mk_insert_style')) {
    
    function mk_insert_style($class, $style) {
        if (!array_key_exists($class, $style)) return;
        return $style[$class];
    }
}

/**
 * Choosing Main Navigation menu location
 * @return menu location    string
 */

if (!function_exists('mk_main_nav_location')) {
    
    function mk_main_nav_location() {
        global $mk_options;
        $post_id = global_get_post_id();
        $post_id = mk_is_woo_archive() ? mk_is_woo_archive() : $post_id;
        $meta_menu_location = !empty($post_id) ? get_post_meta($post_id, '_menu_location', true) : false;
        
        if (is_user_logged_in() && !empty($mk_options['loggedin_menu'])) {
                $menu_location = $mk_options['loggedin_menu'];
        } 
        
        else {
            
            if ($post_id && isset($meta_menu_location) && !empty($meta_menu_location)) {
                $menu_location = $meta_menu_location;
            } 
            else {
                $menu_location = 'primary-menu';
            }
        }
        return $menu_location;
    }
}

/**
 * Generate gradient angles based on the options provided
 * @return angles   array
 */

if (!function_exists('mk_gradient_option_parser')) {
    
    function mk_gradient_option_parser($style, $angle) {
        $output = array();
        if ($style == 'linear') {
            $output['type'] = $style;
            switch ($angle) {
                case 'vertical':
                    $output['angle_1'] = 'top,';
                    $output['angle_2'] = 'to bottom,';
                    $output['name'] = 'vertical';
                    break;

                case 'horizontal':
                    $output['angle_1'] = 'left,';
                    $output['angle_2'] = 'to right,';
                    $output['name'] = 'horizontal';
                    break;

                case 'diagonal_left_bottom':
                    $output['angle_1'] = 'top left,';
                    $output['angle_2'] = 'to bottom right,';
                    $output['name'] = 'diagonal_left_bottom';
                    break;

                case 'diagonal_left_top':
                    $output['angle_1'] = 'bottom left,';
                    $output['angle_2'] = 'to top right,';
                    $output['name'] = 'diagonal_left_top';
                    break;
            }
        } 
        else if ($style == 'radial') {
            $output['type'] = $style;
            $output['angle_1'] = '';
            $output['angle_2'] = '';
        }
        return $output;
    }
}

/**
 * Get blog single post style
 * @return style   string
 */

if (!function_exists('mk_get_blog_single_style')) {
    
    function mk_get_blog_single_style() {
        
        if (!is_singular('post')) return false;
        
        global $mk_options, $post;
        $style = get_post_meta($post->ID, '_single_blog_style', true); 
        $style = ($style == 'default' || empty($style)) ? $mk_options['single_blog_style'] : $style;
        
        return $style;
    }
}

/**
 * Get blog single post type
 * @return style   string
 */

if (!function_exists('mk_get_blog_single_type')) {
    
    function mk_get_blog_single_type() {
        
        if (!is_singular('post')) return false;
        
        global $mk_options, $post;
        $style = get_post_meta($post->ID, '_single_post_type', true); 
        
        return $style;
    }
}

/**
 * Get portfolio lightbox url based on post type
 * @return style   string
 */

if (!function_exists('mk_get_portfolio_lightbox_url')) {
    function mk_get_portfolio_lightbox_url($post_type = 'image') {
        switch ($post_type) {
            case 'image':
                $src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true);
                $src = $src_array[0];
                break;

            case 'video':
                
                $video_id = get_post_meta(get_the_ID() , '_single_video_id', true);
                $video_site = get_post_meta(get_the_ID() , '_single_video_site', true);
                
                switch (get_post_meta(get_the_ID() , '_single_video_site', true)) {
                    case 'vimeo':
                        $src = '//player.vimeo.com/video/' . $video_id . '?autoplay=0';
                        break;

                    case 'youtube':
                        $src = '//www.youtube.com/embed/' . $video_id . '?autoplay=0';
                        break;

                    case 'dailymotion':
                        $src = '//www.dailymotion.com/embed/video/' . $video_id . '?logo=0';
                        break;
                }
                
                break;
        }
        return $src;
    }
}

/**
 * Return background image size class when the param is true
 * @return class   string
 */

if (!function_exists('mk_get_bg_cover_class')) {
    
    function mk_get_bg_cover_class($val) {
        
        if ($val == 'true') {
            return 'mk-background-stretch';
        }
    }
}



/**
 * Return View port animation classes
 * @return class   string
 */

if (!function_exists('get_viewport_animation_class')) {
    
    function get_viewport_animation_class($animation = false) {
        
        if (!empty($animation)) {
            return ' mk-animate-element ' . $animation . ' ';
        }
    }
}

/**
 * Converts column number to class
 * @return class   string
 */

if (!function_exists('mk_get_column_class')) {
    
    function mk_get_column_class($column = 4) {
        
        return 'a_' . $column . 'col';
    }
}

/**
 * Return menu ID by the location its assigned to
 * @param  string $location
 * @return int  $id
 */

if (!function_exists('mk_get_nav_id_by_location')) {
    
    function mk_get_nav_id_by_location($location) {
        
        $locations = get_nav_menu_locations();
        
        $menu_obj = get_term($locations[$location], 'nav_menu');
        
        return $menu_obj->term_id;
    }
}

/**
 * Set logo position in the middle of menu
 * @param  string $location
 * @return int  $id
 */

if (!function_exists('mk_insert_logo_middle_of_nav')) {
    
    function mk_insert_logo_middle_of_nav($nav_id, $menu, $logo) {
        
        // Assign all first level menu item titles into array
        // TODO: get main menu ID programatically
        $menu_items = wp_get_nav_menu_items($nav_id);
        $titles = array();
        
        foreach ((array)$menu_items as $key => $menu_item) {
            $parent = $menu_item->menu_item_parent;
            $title = $menu_item->title;
            $ID = $menu_item->ID;
            $DOM_ID = 'menu-item-' . $ID;
            
            if (!$parent) {
                $titles[$DOM_ID] = $title;
            }
        }
        
        // Count total lenght of letters
        $letter_sum = 0;
        foreach ($titles as $key => $title) {
            $lenght = strlen($title);
            $letter_sum = $letter_sum + $lenght;
        }
        
        // Get insert position for logo by finding a point closest to a half number of letters without breaking the word.
        // The word that is in the middle is divided by the center point and we compare both sides.
        // If left side is longer we set insert position after this word, otherwise before
        $half_letter_sum = $letter_sum / 2;
        $left_half_sum = 0;
        $insert_position = 0;
        $set_position = false;
        
        foreach ($titles as $key => $title) {
            $lenght = strlen($title);
            
            if ($left_half_sum < $half_letter_sum) {
                $left_half_sum_before_addition = $left_half_sum;
                $left_half_sum = $left_half_sum + $lenght;
                
                // Check again after addition to see if we passed our center point
                if ($left_half_sum < $half_letter_sum) {
                    $insert_position++;
                } 
                else {
                    
                    // When we reach to our center point check the last title left & right sides.
                    // First set dividor to a number of letters that remain to reach to the center.
                    $length_to_center = $half_letter_sum - $left_half_sum_before_addition;
                    
                    // To check if center point is on left or right side we check if it's smaller or higher from half title length
                    $half_title = $lenght / 2;
                    
                    // Set insert position after current title if center position is in right side of title or before when in left ( including exact center -
                    // as we usually have icons on right so it makes more sence to balance menu items a little bit more onto left )
                    if ($length_to_center > $half_title) {
                        $insert_position++;
                        break;
                    } 
                    else {
                        break;
                    }
                }
            }
        }
        
        // Insert Logo
        $menu_item_ids = array_keys($titles);
        $menu_item_id = $menu_item_ids[$insert_position];
        $match_string = '<li id="' . $menu_item_id . '"';
        
        $menu = str_replace($match_string, $logo . $match_string, $menu);
        
        return $menu;
    }
}

/**
 * Checks the header for given source. If it's a valid image returns getimagesize array.
 * Otherwise returns another getimagesize array for 1x1 empty.png image.
 *
 * Usage Example:
 * mk_getimagesize('http://jupiter-v5.dev/wp-content/themes/jupiter-v5/images/empty.png');
 *
 * @param  string $location
 * @return int  $id
 * @author      Ugur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @last_update Version 5.0.6
 *
 * TODO:: Create a report section for missing requests to the images.
 * TODO:: Add svg
 *
 *   $svgfile = simplexml_load_file("svgimage.svg");
 *   $width = substr($svgfile[width],0,-2);
 *   $height = substr($svgfile[height],0,-2);
 *
 *   'image/svg+xml'
 */

if (!function_exists('mk_getimagesize')) {
    
    function mk_getimagesize($src) {
        global $total_time;

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $start = $time;

        $return = "";
        $return_transient = "mk_getimagesize_";
        $return_transient .= sha1($src);
        $return = get_transient($return_transient);
        if (!is_array($return)) {
            global $wp_filesystem;
            if (empty($wp_filesystem)) {
                require_once(ABSPATH . '/wp-admin/includes/file.php');
                WP_Filesystem();
            }

            // if the image is local
            $home_url = esc_url( get_home_url('/') );
            $home_path = esc_url( get_home_path() );
            $src_directory = str_replace(array($home_url), array($home_path), $src);

            try {
                if (file_exists($src_directory) and $src_directory != $src) {
                    $return = @getimagesize($src_directory);
                }
            } catch (Exception $e) {

            }
            // if the image is local

            // if the image is not local
            $return = mk_curl_getimage_dimensions($src);


            // if our special curl function fails try with wp_get_http_headers one more time
            if (!is_array($return)) {
                $remote_file = wp_get_http_headers($src);
                if (!mk_is_image($remote_file['content-type'])) {
                    $return = array("", "", "");
                }

                if (!is_array($return)) {
                    try {
                        $return = @getimagesize($src);
                    } catch (Exception $e) {

                    }
                }

            }


            // Get any existing copy of our transient data
            if (is_array($return)) {
                // It wasn't there, so regenerate the data and save the transient
                set_transient($return_transient, $return, 15 * 60);
            }
        }

        if($return == "") {
        $return = array("","","");
        }

        $time = microtime();
        $time = explode(' ', $time);
        $time = $time[1] + $time[0];
        $finish = $time;
        $function_time = round(($finish - $start), 4);
        $total_time += $function_time;
        return $return;

    }
}

/**
 * Gets the only necessary bytes for given url and checks the image content type
 * Returns false if it's not JPG, PNG or GIF
 *
 * @author      Uğur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0.6
 * @last_update Version 5.0.6
 */
if (!function_exists('mk_curl_getimage')) {
    function mk_curl_getimage($url)
    {
        $file_ext = strtolower(pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION));
        //Returns undefined in some cases
        $range = "32768";
        
        if($file_ext == "png") {
            $range = "24";
        } else if ($file_ext == "gif") {
            $range = "10";
        } else if ($file_ext == "jpeg" or $file_ext == "jpg") {
            $range = "32768";
        }

        $headers = array(
            "Range: bytes=0-".$range
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $data = curl_exec($curl);
        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        $curl_info = curl_getinfo($curl);
        $curl_info["file_ext"] = $file_ext;
        if(mk_is_image($contentType)==false)
        return false;
        curl_close($curl);
        return $data;
    }
}

/**
 * Uses mk_curl_getimage for downloading image and gets the image dimensions
 * Returns false if it's corrupt or not proper image.
 *
 * @source
 * @author      Uğur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0.6
 * @last_update Version 5.0.6
 */
if (!function_exists('mk_curl_getimage_dimensions')) {
    function mk_curl_getimage_dimensions($url)
    {


        if(mk_is_curl_active() == false)
        return false;

        $raw = mk_curl_getimage($url);
        if($raw == false)
        return false;


        $file_ext = strtolower(pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION));
        if($file_ext == "png") {
            //The identity for a PNG is 8Bytes (64bits)long
            $ident = unpack('Nupper/Nlower', $raw);
            //Make sure we get PNG
            if($ident['upper'] !== 0x89504E47 || $ident['lower'] !== 0x0D0A1A0A)
            {
                return false;
            }
            //Get rid of the first 8 bytes that we processed
            $data = substr($raw, 8);
            //Grab the first chunk tag, should be IHDR
            $chunk = unpack('Nlength/Ntype', $data);
            //IHDR must come first, if not we return false
            if($chunk['type'] === 0x49484452)
            {
                //Get rid of the 8 bytes we just processed
                $data = substr($data, 8);
                //Grab our x and y
                $info = unpack('NX/NY', $data);
                //Return in common format
                return array($info['X'], $info['Y']);
            }
            else
            {
                return false;
            }
        }

        if($file_ext == "jpg" or $file_ext == "jpeg") {
            $im = @imagecreatefromstring($raw);
            if($im) {
            $width = imagesx($im);
            $height = imagesy($im);
            return array($width,$height,"");
            }
        }

        if($file_ext == "gif") {
            //The identity for a GIF is 6bytes (48Bits)long
            $ident = unpack('nupper/nmiddle/nlower', $raw);
            //Make sure we get GIF 87a or 89a
            if($ident['upper'] !== 0x4749 || $ident['middle'] !== 0x4638 ||
                ($ident['lower'] !== 0x3761 && $ident['lower'] !== 0x3961))
            {
                return false;
            }
            //Get rid of the first 6 bytes that we processed
            $data = substr($raw, 6);
            //Grab our x and y, GIF is little endian for width and length
            $info = unpack('vX/vY', $raw);
            //Return in common format
            return array($info['X'], $info['Y']);
        }

        return false;

    }
}


/**
 * Checks if curl is available
 *
 * @source
 * @author      Uğur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0.6
 * @last_update Version 5.0.6
 */
if (!function_exists('mk_is_curl_active')) {
    function mk_is_curl_active()
    {
        if(is_callable('curl_init')){
            return true;
        }
        return false;
    }
}

/**
 * Check image content types Returns false if it's not JPG, PNG or GIF
 *
 * @source
 * @author      Uğur Mirza ZEYREK
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0.6
 * @last_update Version 5.0.6
 */
if (!function_exists('mk_is_image')) {
    function mk_is_image($content_type)
    {
        $image_extensions = array('image/jpeg', 'image/gif', 'image/png');

        if(in_array($content_type, $image_extensions)) {
            return true;
        } else {
            return false;
        }
    }
}



/**
 * Get the list of enteries from database
 * This function used in components/shortcodes//vc_map.php
 *
 * Usage Example:
 * mk_get_post_enteries('portfolio', 40)
 *
 * @param  string $post_type
 * @param int  $count
 * @return array
 * @deprecated : since v5.1
 */
if (!function_exists('mk_get_post_enteries')) {
    
    function mk_get_post_enteries($post_type = false, $count = 30) {
        if (mk_page_is_vc_edit_form()) {
            $post_type_enteries = get_posts('post_type=' . $post_type . '&orderby=title&numberposts=' . $count . '&order=ASC&suppress_filters=0');
            
            if (!empty($post_type_enteries)) {
                foreach ($post_type_enteries as $key => $entry) {
                    $enteries[$entry->ID] = $entry->post_title;
                }
                return $enteries;
            }
        }
        return false;
    }
}

/**
 * Get the list of categories based on the taxonomy from database
 * This function used in components/shortcodes//vc_map.php
 *
 * Usage Example:
 * mk_get_category_enteries('product_cat', 50)
 *
 * @param  string $taxonomy
 * @param int  $count
 * @return array
 * @deprecated : since v5.1 
 */
if (!function_exists('mk_get_category_enteries')) {
    
    function mk_get_category_enteries($taxonomy = 'category', $count = 50) {
        if (mk_page_is_vc_edit_form()) {
            $cat_enteries = get_categories('&orderby=name&number=' . $count);
            
            if (!empty($cat_enteries)) {
                foreach ($cat_enteries as $key => $entry) {
                    $enteries[$entry->term_id] = $entry->name;
                }
                return $enteries;
            }
        }
        return false;
    }
}

/**
 * Get the list of pages from database
 * This function used in components/shortcodes//vc_map.php
 *
 * Usage Example:
 * mk_get_page_enteries(50)
 *
 * @param  string $taxonomy
 * @param int  $count
 * @return array
 * @deprecated : since v5.1 
 */
if (!function_exists('mk_get_page_enteries')) {
    
    function mk_get_page_enteries($count = 50) {
        //if (mk_page_is_vc_edit_form()) {
            $page_enteries = get_pages('title_li=&orderby=name&number' . $count);
            
            if (!empty($page_enteries)) {
                foreach ($page_enteries as $key => $entry) {
                    $enteries['None'] = "*";
                    $enteries[$entry->post_title] = $entry->ID;
                }
                return $enteries;
            }
        //}
        return false;
    }
}

/**
 * Get the list of users from database
 * This function used in components/shortcodes//vc_map.php
 *
 * Usage Example:
 * mk_get_authors(50)
 *
 * @param  string $taxonomy
 * @param int  $count
 * @return array
 * @deprecated : since v5.1 
 */
if (!function_exists('mk_get_authors')) {
    
    function mk_get_authors($count = 50) {
        if (mk_page_is_vc_edit_form()) {
            $user_enteries = get_users(array(
                'number' => $count
            ));
            
            if (!empty($user_enteries)) {
                foreach ($user_enteries as $user) {
                    $enteries[$user->ID] = $user->display_name;
                }
                return $enteries;
            }
        }
        return false;
    }
}




/**
 * Check if comments in pages is enabled/disbaled through theme options
 *
 *
 * @return boolean
 */
if (!function_exists('mk_is_pages_comments_enabled')) {
    
    function mk_is_pages_comments_enabled() {
        global $mk_options;

        if(!is_page()) return false;

        if($mk_options['pages_comments'] == 'true') return true;
    }
}




/**
 * Used in views/layout/breadcrumbs.php
 *
 */
if (!function_exists('mk_breadcrumbs_get_parents')) {
    function mk_breadcrumbs_get_parents($post_id = '', $separator = '/') {
        
        $parents = array();
        
        if ($post_id == 0) return $parents;
        
        while ($post_id) {
            $page = get_page($post_id);
            $parents[] = '<a href="' . esc_url( get_permalink($post_id) ) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a>';
            $post_id = $page->post_parent;
        }
        
        if ($parents) $parents = array_reverse($parents);
        
        return $parents;
    }
}





/**
 * Gets blog post thumbnail conditionally from blog slideshow type if no featured image is provided.  
 *
 */
if (!function_exists('mk_get_blog_post_thumbnail')) {
    function mk_get_blog_post_thumbnail($post_type = 'image') {
        global $post;

        if($post_type == 'portfolio') {

            if(has_post_thumbnail()) {

                $attachment_id = get_post_thumbnail_id();   

            } else {
                $attachment_id = get_post_meta($post->ID, '_gallery_images', true);
                $attachment_id = explode(',', $attachment_id);
                $attachment_id = $attachment_id[0];
            }
        } else {
            $attachment_id = get_post_thumbnail_id();
        }
        
        return $attachment_id;

    }
}


if (!function_exists('mk_get_theme_version')) {
    /**
     * Gets current jupiter version
     *
     * @return mixed|void
     * @author      Ugur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.0.11
     */
    function mk_get_theme_version() {
        return get_option('mk_jupiter_theme_current_version');
    }
}

if (!function_exists('mk_str_contains')) {
    /**
     * Determine if a given string contains a given substring.
     *
     * @param       string  $haystack
     * @param       string|array  $needles
     * @param       bool $case_insensitive
     * @return      bool
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.1.4
     */
    function mk_str_contains($haystack, $needles, $case_insensitive = false)
    {
        foreach ((array) $needles as $needle)
        {
            if($case_insensitive == false) {
                $pos = strpos($haystack, $needle);
            } else {
                $pos = stripos($haystack, $needle);
            }
            if ($needle != '' && $pos  !== false) return true;
        }
        return false;
    }
}

if (!function_exists('array2string')) {
    /**
     * Gets an array gives a readable string
     *
     * @param       $data
     * @return      string
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.1.4
     */
    function array2string($data)
    {

        $log_a = "";
        foreach ($data as $key => $value) {
            if (is_array($value)) $log_a .= "[" . $key . "] => (" . array2string($value) . ") \n";
            else
                $log_a .= "[" . $key . "] => " . $value . "\n";
        }
        return $log_a;
    }
}

if (!function_exists('str_replace_last')) {
    /**
     * Only replaces the last occurrence of the specified string in the haystack
     *
     * @param $search
     * @param $replace
     * @param $subject 
     * @return      mixed
     * @author      Uğur Mirza ZEYREK
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.1.4
     */
    function str_replace_last($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }
}

if (!function_exists('is_html')) {
    /**
     * Checks if string contains HTML tags
     *
     * @param $string
     * @return      bool
     * @author      Zeljko Dzafic
     * @copyright   Artbees LTD (c)
     * @link        http://artbees.net
     * @since       Version 5.3
     */
    function is_html($string)
    {
        if ( $string != strip_tags($string) )
        {
            return true;
        }
        return false;
    }
}

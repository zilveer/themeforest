<?php

if (!class_exists('video_info')) {

    class video_info {

        public $id;
        public $domain;
        public $thumbnails = array();

    }

}

/**
 * Helper utils, other code
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
if (!class_exists('jwUtils')) {

    class jwUtils {

        public static $glob_ad;

        /**
         * Description
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_post_number() {
            global $wp_query;
            return $wp_query->current_post;
        }

        /**
         * Description
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function getFileExten($file) {

            $pos = strpos($file, ".");
            $fileext = substr($file, $pos, strlen($file));
            return $fileext;
        }

        /**
         * Prevede hodnotu rgba na rgb - potrebne kvuli IE.<br>
         * Osetren vstup pokud neni zadan retezec obsahujici retezec rgba, vraci vstupni parametr.
         * 
         * @param string $rgba hodnota rgba
         * @return string hodnota rgb
         * 
         */
        public static function rgba2rgb($rgba = '') {
            $rgb = '';
            $rgba_test = '#' . $rgba;
            if ($rgba == '' || (strpos($rgba_test, 'rgba')) || (strpos($rgba_test, 'rgb')) == false) {
                return $rgba;
            } else {
                $rgba = str_replace('rgba', '', $rgba);
                $rgba = str_replace('(', '', $rgba);
                $rgba = str_replace(')', '', $rgba);
                $rgba = explode(',', $rgba);
                $rgb = 'rgb(' . $rgba[0] . ',' . $rgba[1] . ',' . $rgba[2] . ')';
                return $rgb;
            }
        }

        /**
         * Description
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function fileLoader($path, $ext = array(), $prepend = '') {
            $out = null;
            if (is_dir($path)) {
                if ($dir = opendir($path)) {
                    while (($file = readdir($dir)) !== false) {

                        if (in_array(jwUtils::getFileExten($file), $ext)) {
                            $out[] = $prepend . $file;
                        }
                    }
                } else
                    $out = 'Folder is close';
            }else {
                $out = 'no folder';
            }
            return $out;
        }

        /**
         * funkce: get_video_info
         * vrací z url adresy (např: http://vimeo.com/26609463) jen ID, název domény a náhledy ve 3 velikostech.
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_video_info($video_url) {
            $ret = new video_info();
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match)) {
                $ret->id = $match[1];
                $ret->domain = 'youtube';
                $ret->thumbnails['thumbnail_small'] = "http://img.youtube.com/vi/" . $ret->id . "/default.jpg";
                $ret->thumbnails['thumbnail_medium'] = "http://img.youtube.com/vi/" . $ret->id . "/mqdefault.jpg";
                $ret->thumbnails['thumbnail_large'] = "http://img.youtube.com/vi/" . $ret->id . "/hqdefault.jpg";
            } else if (preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $video_url, $match)) {
                $ret->id = $match[3];
                $ret->domain = 'vimeo';
                //u vimea jde do thumbnails více informací (např: description, date, nuber of likes ...)
                $thumbnails = (wp_remote_request("http://vimeo.com/api/v2/video/" . $ret->id . ".php"));
                $thumbnails = unserialize($thumbnails['body']);
                $ret->thumbnails = $thumbnails[0];
            } else if (preg_match('/^http(s)?:\/\/(www\.)?vine\.co\/v\/(.*?)(\/.*)?$/', $video_url, $match)) {
                $ret->id = $match[3];
                $ret->domain = 'vine';
                //u vimea jde do thumbnails více informací (např: description, date, nuber of likes ...)
                $ret->thumbnails['thumbnail_medium'] = jwUtils::get_vine_thumbnail($ret->id);
            } else {
                $ret->id = $video_url;
            }
            return $ret;
        }

        /**
         * return vine thumbnail
         * 
         * @param type $id - ID of vine video 
         * @return type - vine thumbnail
         * 
         */
        public static function get_vine_thumbnail($id) {
            $vine = wp_remote_retrieve_body(wp_remote_request("http://vine.co/v/{$id}"));
            preg_match('/property="og:image" content="(.*?)"/', $vine, $matches);
            return ($matches[1]) ? $matches[1] : false;
        }

        /**
         * Description
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_url_domain($url) {

            $explode = explode(".", $url);
            $tld = $explode[0];
            $tld = explode("/", $tld);
            return $tld[2];
        }

        /**
         * Zajištění zobrazení správné pozice reklam
         * 
         * 
         */
        public static function ads_position() {
            global $wp_query;
            $ratingManager = ratingManager::getInstance();
            $var_posts = $wp_query->posts;

            if ($wp_query->post_count > 4 && (jwOpt::get_option('banner_post_1_show', '0') == '1' || jwOpt::get_option('banner_post_2_show', '0') == '1' || jwOpt::get_option('banner_post_3_show', '0') == '1')) {
                $ratingManager = ratingManager::getInstance();
                $loc_ad_title = array();

                foreach ($wp_query->posts as $post) {
                    $sort_title[] = strtolower($post->post_title);
                    $sort_date[] = $post->post_date;
                    $ratings = $ratingManager->getRatings($post->ID);
                    $sort_rating[] = $ratingManager->getRatingsScore($ratings);
                    $act_rating[] = $ratingManager->getRatingsScore($ratings);
                    $post->rating = $act_rating[0];
                    $act_rating = null;
                    $sort_popular[] = $post->comment_count;
                }
                $var_posts_title = $var_posts;
                $var_posts_date = $var_posts;
                $var_posts_popular = $var_posts;
                $var_posts_rating = $var_posts;
                $loc_ad = round(sizeof($var_posts) / 3);
                if (sizeof($var_posts) < ($loc_ad * 3)) {
                    $korekce = 2;
                } else {
                    $korekce = 1;
                }

                array_multisort($sort_title, SORT_ASC, SORT_STRING, $var_posts_title);
                $loc_ad_title[0] = strtolower(substr($var_posts_title[($loc_ad) - 1]->post_title, 0, 5) . "zzz");
                $loc_ad_title[1] = strtolower(substr($var_posts_title[($loc_ad * 2) - 1]->post_title, 0, 5) . "zzz");
                $loc_ad_title[2] = strtolower(substr($var_posts_title[($loc_ad * 3) - $korekce]->post_title, 0, 5) . "zzz");

                array_multisort($sort_date, SORT_DESC, SORT_STRING, $var_posts_date);
                $loc_ad_date[0] = $var_posts_date[($loc_ad) - 1]->post_date;
                $loc_ad_date[1] = $var_posts_date[($loc_ad * 2) - 1]->post_date;
                $loc_ad_date[2] = $var_posts_date[($loc_ad * 3) - $korekce]->post_date;

                array_multisort($sort_date, SORT_DESC, $var_posts_popular);
                $loc_ad_popular[0] = $var_posts_popular[($loc_ad) - 1]->comment_count;
                $loc_ad_popular[1] = $var_posts_popular[($loc_ad * 2) - 1]->comment_count;
                $loc_ad_popular[2] = $var_posts_popular[($loc_ad * 3) - $korekce]->comment_count;

                array_multisort($sort_rating, SORT_DESC, $var_posts_rating);
                $loc_ad_rating[0] = $var_posts_rating[($loc_ad) - 1]->rating;
                $loc_ad_rating[1] = $var_posts_rating[($loc_ad * 2) - 1]->rating;
                $loc_ad_rating[2] = $var_posts_rating[($loc_ad * 3) - $korekce]->rating;

                array_multisort($sort_rating, SORT_DESC, $var_posts_rating);
                $loc_ad_category[0] = strtolower(substr($var_posts_title[($loc_ad) - 1]->taxonomy, 0, 5) . "zzz");
                $loc_ad_category[1] = strtolower(substr($var_posts_title[($loc_ad * 2) - 1]->taxonomy, 0, 5) . "zzz");
                $loc_ad_category[2] = strtolower(substr($var_posts_title[($loc_ad * 3) - $korekce]->taxonomy, 0, 5) . "zzz");

                self::$glob_ad['title'] = $loc_ad_title;
                self::$glob_ad['date'] = $loc_ad_date;
                self::$glob_ad['popular'] = $loc_ad_popular;
                self::$glob_ad['rating'] = $loc_ad_rating;
                self::$glob_ad['category'] = $loc_ad_category;
            } else {

                foreach ($wp_query->posts as $post) {
                    $ratings = $ratingManager->getRatings($post->ID);
                    $sort_rating[] = $ratingManager->getRatingsScore($ratings);
                    $post->rating = $sort_rating[0];
                    $sort_rating = null;
                }
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_gallery_slider($postID, $size = 'post-size') {

            $attach_gallery_post = array();
            if (get_bloginfo('version') >= 3.5) {
                $post_content = get_the_content();
                preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);

                if (isset($ids[1])) {
                    $ids = explode(",", $ids[1]);
                    foreach ($ids as $id) {
                        $attach_gallery_post[] = wp_get_attachment_image_src($id, $size);
                    }
                }
            } else {
                $attach = get_children(array(
                    'post_parent' => $postID,
                    'post_type' => 'attachment',
                    'numberposts' => -1,
                    'post_status' => 'any'));

                foreach ($attach as $att) {
                    $attach_gallery_post[] = wp_get_attachment_image_src($att->ID, $size);
                }
            }
            return $attach_gallery_post;
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function getHelp($keyword, $img = null, $page_url = null) {
            if (!isset($page_url)) {
                $page_url = "http://support.jawtemplates.com/goodstore/documentation/index.html";
            }
            $out = '';

            if (isset($keyword) && $keyword != '') {
                $out .= '<span class="help-icon">';
                $out .= '<a href="';     //?amp;TB_iframe=true class="thickbox" záložky v thickbox nejedou    
                $out .= ' javascript: launchHelp(\'' . $page_url . '#' . $keyword . '\');" title="Click for Help (documentation)" >';
                $out .= '<i class="icon-question"></i></a>';
                $out .= '</span>';
            }
            if (isset($img) && $img != '') {
                $out .= '<span class="help-icon">';
                $out .= '<i class="icon-image"></i>';
                $out .= '<img src="' . THEME_URI . '/help/images/' . $img . '">';
                $out .= '</span>';
            }

            return $out;
        }

        /**
         * Crop the string
         * Test if mb_function support enabled
         * 
         * @param string string - input string
         * @param int max_lenght - crop string length
         * 
         * @return string - croped string
         */
        public static function crop_length($string = '', $max_length = 0) {
            if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                if (($max_length > 0) && (mb_strlen($string, 'UTF-8') > $max_length)) {
                    return mb_substr($string, 0, (int) $max_length, 'UTF-8') . ' ...';
                } else if ($max_length == 0) {
                    return '';
                } else {
                    return $string;
                }
            } else {
                if (($max_length > 0) && (strlen($string) > $max_length)) {
                    return substr($string, 0, (int) $max_length) . ' ...';
                } else if ($max_length == 0) {
                    return '';
                } else {
                    return $string;
                }
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_social_meta() {
            ob_start();
            global $post;
            echo "\n <!-- Open Graph protocol by JaW -->" . "\n";
            if (jwOpt::get_option('fbcomments_appid', '') != '') {
                echo "<meta property='fb:app_id' content='" . jwOpt::get_option('fbcomments_appid') . "'>";
            }
            if (jwOpt::get_option('use_jaw_seo', '1') == '1') {
                // facebook, twitter ang google plus meta
                if (is_home() || is_front_page()) {
                    echo '<meta property="og:image" content="' . get_template_directory_uri() . '/images/logo/none.png">' . "\n";
                    echo '<meta property="og:type" content="website"> ' . "\n";
                    echo '<meta property="og:url" content="' . get_site_url() . '">' . "\n";
                }
                if (is_singular()) {
                    echo '<meta property="og:title" content="' . get_the_title() . '">' . "\n";
                    $content = preg_replace("/\\[.*?\\]/", "", $post->post_content);
                    echo '<meta property="og:description" content="' . str_replace('\n', '', str_replace('"', '\'', stripslashes(strip_tags(jwUtils::crop_length($content, 300))))) . '">' . "\n";
                    if (function_exists('is_shop') && is_shop()) { //woocommerce
                        echo '<meta property="og:type" content="product">' . "\n";
                    } else {
                        echo '<meta property="og:type" content="article">' . "\n";
                    }

                    if (has_post_thumbnail()) {
                        $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'post-size-big');
                        echo '<meta property="og:image" content="' . $src[0] . '">' . "\n";
                    }
                    echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '">' . "\n";
                    echo '<meta property="og:url" content="' . get_permalink() . '">' . "\n";
                    echo "<!-- END OG protocol -->" . "\n";
                }
            }
            return ob_get_clean();
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function the_post_thumbnail($size = 'post-thumbnail', $attr = array()) {
            if (has_post_thumbnail()) {
                the_post_thumbnail($size);
            } else {
                echo apply_filters('jaw_post_thumbnail', $size, $attr);
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function has_post_thumbnail() {
            if (!has_post_thumbnail()) {
                preg_match('~<img [^>]* />~', get_the_content(), $imgs);
                if (isset($imgs) && count($imgs) && jwOpt::get_option('post_image_featured', '0') == '1') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_thumbnail_link($size = "large") {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size);
            if (!isset($img[0]) && jwOpt::get_option('post_image_featured', '0') == '1') {
                preg_match('~<img [^>]* />~', get_the_content(), $imgs);
                preg_match('~src="(.*?)"~', $imgs[0], $imgs);
                if (isset($imgs[1])) {
                    return $imgs[1];
                } else {
                    return false;
                }
            }
            if (isset($img[0])) {
                return $img[0];
            } else {
                return false;
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function woocommerce_activate() {
            if (class_exists('WooCommerce')) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function jaw_nobot_question_filter($x) {

            if (is_user_logged_in()) {
                return $x;
            }
            if (!array_key_exists('question', $_POST) || trim($_POST['question']) == '') {
                wp_die(__('Error: Please fill in the required question.', 'jawtemplates'));
            }
            // Verify the answer.
            if ($_POST['question'] == jwOpt::get_option('comments_antispam_answer', '2')) {
                return $x;
            }
            wp_die(__('Error: Please fill in the correct answer to the question.', 'jawtemplates'));
        }

        /**
         * Desription
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function get_size($size, $space = false) {
            $spaces = array('0' => 40, '1' => 50);
            $sizes = array('0' => array('1' => '102',
                    '2' => '183',
                    '3' => '265',
                    '4' => '347',
                    '5' => '428',
                    '6' => '510',
                    '7' => '592',
                    '8' => '673',
                    '9' => '755',
                    '10' => '837',
                    '11' => '918',
                    '12' => '1000'),
                '1' => array('1' => '125',
                    '2' => '225',
                    '3' => '325',
                    '4' => '425',
                    '5' => '525',
                    '6' => '625',
                    '7' => '725',
                    '8' => '825',
                    '9' => '925',
                    '10' => '1025',
                    '11' => '1125',
                    '12' => '1225'));
            if ($space && isset($sizes[jwOpt::get_option('wide_mode', '0')][$size]) && isset($spaces[jwOpt::get_option('wide_mode', '0')])) {
                return $sizes[jwOpt::get_option('wide_mode', '0')][$size] - $spaces[jwOpt::get_option('wide_mode', '0')];
            } else if (isset($sizes[jwOpt::get_option('wide_mode', '0')][$size])) {
                return $sizes[jwOpt::get_option('wide_mode', '0')][$size];
            } else {
                return $sizes[jwOpt::get_option('wide_mode', '0')]['12'];
            }
        }

        /**
         * aasort - sortování 2rozměrnýho pole dlevnitrniho klice
         * 
         * @since GoodStore
         * @param array $array -
         * @param string $key -
         * @return array - sorted array
         */
        public static function aasort($array, $key) {
            $sorter = array();
            $ret = array();
            reset($array);
            foreach ($array as $ii => $va) {
                $sorter[$ii] = $va[$key];
            }
            asort($sorter);
            foreach ($sorter as $ii => $va) {
                $ret[$ii] = $array[$ii];
            }
            return $ret;
        }

        /**
         * Retrieve stylesheet directory URI - template or child-tempalte
         * 
         * @since GoodStore
         * @param string $file - path to CSS file
         * @return string URI to CSS file
         */
        public static function jaw_get_stylesheet_uri($file) {
            if (file_exists(get_stylesheet_directory() . $file) && strlen($file) > 0) {
                return get_stylesheet_directory_uri() . $file;
            } else {
                return get_template_directory_uri() . $file;
            }
        }

// ***********************   TINY MCE EDITOR   *************************
        /**
         * jaw_mce_buttons_2
         * Callback function to insert 'styleselect' into the $buttons array
         * @since GoodStore
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function jaw_mce_buttons_2($buttons) {
            array_unshift($buttons, 'styleselect'); //formatselect
            return $buttons;
        }

        /**
         * jaw_mce_before_init_insert_formats
         * Callback function to filter the MCE settings
         * @since GoodStore
         * 
         * @param type $name Description
         * @return type Description
         * 
         */
        public static function jaw_mce_before_init_insert_formats($init_array) {

            $init_array['theme_advanced_blockformats'] = 'p,address,pre,div,h1,h2,h3,h4,h5,h6';
            $style_formats = array(
                array('title' => 'With margin (10px)', 'inline' => 'span', 'classes' => 'with-margin', 'wrapper' => true),
                array('title' => 'Button', 'inline' => 'span', 'classes' => 'btn', 'wrapper' => true),
                array('title' => 'Fonts Family'),
                array('title' => 'Title font', 'inline' => 'span', 'classes' => 'font-family title', 'wrapper' => true, 'exact' => true),
                array('title' => 'Paragraph font', 'inline' => 'span', 'classes' => 'font-family paragraph', 'wrapper' => true, 'exact' => true),
                array('title' => 'Fonts Size'),
                array('title' => 'Big', 'inline' => 'span', 'classes' => 'font-size big', 'wrapper' => true, 'exact' => true),
                array('title' => 'Middle', 'inline' => 'span', 'classes' => 'font-size middle', 'wrapper' => true, 'exact' => true),
                array('title' => 'Small', 'inline' => 'span', 'classes' => 'font-size small', 'wrapper' => true, 'exact' => true)
            );
            $init_array['style_formats'] = json_encode($style_formats);

            // $init_array['theme_advanced_blockformats'] = json_encode($style_formats);

            return $init_array;
        }

        public static function woocommerce_related_products_args() {
            global $product;
            if (isset($product->id)) {
                $this_product = $product->id;
            } else {
                $this_product = 0;
            }
            $tag = array();
            $cats = array();

            $categories = get_the_terms($this_product, 'product_cat');
            $tags = get_the_terms($this_product, 'product_tag');
            if ($categories && sizeof($categories) > 0) {
                foreach ((array) $categories as $k => $c) {
                    $cats[] = $c->term_id;
                }
            }
            if ($tags && sizeof($tags) > 0) {
                foreach ((array) $tags as $k => $t) {
                    $tag[] = $t->term_id;
                }
            }

            $args = array(
                'post_type' => 'product',
                'no_found_rows' => 1,
                'posts_per_page' => jwOpt::get_option('woo_number_related_produts', '3'),
                'ignore_sticky_posts' => 1,
                'post__not_in' => array($this_product),
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $cats
                    ),
                    array(
                        'taxonomy' => 'product_tag',
                        'field' => 'id',
                        'terms' => $tag
                    )
                )
            );
            return $args;
        }

        public static function register_new_user($p) {

            if (isset($p['user']) && isset($p['email']) && isset($p['svalue']) && isset($p['jaw-register']) && isset($p['jaw_register_nonce'])) {
                if (!wp_verify_nonce($p['jaw_register_nonce'], 'jaw_register')) {
                    $errors[] = __('Sorry, your nonce did not verify.', 'jawtemplates');
                } else {
                    if ($p['svalue'] == $p['jaw-register']) {
                        $user_login = esc_attr($p['user']);
                        $user_email = esc_attr($p['email']);
                        $sanitized_user_login = sanitize_user($user_login);
                        $user_email = apply_filters('user_registration_email', $user_email);

                        if (!is_email($user_email)) {
                            $errors[] = __('Invalid e-mail.', 'jawtemplates');
                        } elseif (email_exists($user_email)) {
                            $errors[] = __('This email is already registered.', 'jawtemplates');
                        }
                        if (empty($sanitized_user_login) || !validate_username($user_login)) {
                            $errors[] = __('Invalid user name.', 'jawtemplates');
                        } elseif (username_exists($sanitized_user_login)) {
                            $errors[] = __('User name already exists.', 'jawtemplates');
                        }

                        if (empty($errors)) {
                            $user_pass = wp_generate_password();
                            $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);

                            if (!$user_id) {
                                $errors[] = __('Registration failed', 'jawtemplates');
                            } else {
                                update_user_option($user_id, 'default_password_nag', true, true);
                                wp_new_user_notification($user_id, $user_pass);
                            }
                        }
                    }
                }
                if (!empty($errors)) {
                    define('REGISTRATION_ERROR', serialize($errors));
                } else {
                    define('REGISTERED_A_USER', $user_email);
                }
            }
        }

        /**
         *  
         * Vraci verzi scriptu nebo stylsheetu nalinkovaneho pres wp_enqueue_xxx 
         * Cte hodnotu JAW_DEBUG a JAW_DEV_TOOLS
         * 
         * JAW_DEV_TOOLS == true
         * pokud pouzivam chrome developer tools + grunt s automatickym refreshem css souboru, tak nechci zadnou verzi.
         * 
         * JAW_DEBUG == true
         * vraci po kazdym vyrenderovani jinou verzi - necachuje se
         * 
         * nebo
         * vraci $default_version
         * 
         * @param type $default_version
         * @return string
         */
        public static function assetsVersion($default_version = '') {
            if (defined('JAW_DEV_TOOLS') && JAW_DEV_TOOLS) {   //pokud pouzivam chrome developer tools + grunt s automatickym refreshem css souboru, tak nechci zadnou verzi.
                $script_version = (string) false;
            } else if (defined('JAW_DEBUG') && JAW_DEBUG) {     //vraci po kazdym vyrenderovani jinou verzi - necachuje se
                $script_version = (string) time();
            } else {    //vraci verzi z atributu
                $script_version = (string) $default_version;
            }
        }
        
        
        
        // Translation v TO
        public static function jaw_translation($translations, $text, $domain){
            if($domain == 'jawtemplates'){
                $jaw_translation = jwOpt::get_option('translation');
                if(isset($jaw_translation[$text])){
                    if(isset($jaw_translation[$text]['singular'])){
                        $translations = $jaw_translation[$text]['singular'];
                    }
                    
                }
            }
            return $translations;
        }
        
        // Translation v TO plural
        public static function jaw_ntranslation($translations, $singular,$plural, $number, $domain){
            if($domain == 'jawtemplates'){
                $jaw_translation = jwOpt::get_option('translation');
                $text = $singular;
                if(isset($jaw_translation[$text])){
                    if(isset($jaw_translation[$text]['singular']) && $number == 1){
                        $translations = $jaw_translation[$text]['singular'];
                    }
                    if(isset($jaw_translation[$text]['plural']) ){
                        $translations = $jaw_translation[$text]['plural'];
                    }
                }
            }
            return $translations;
        }

    }

}


<?php
function woffice_sort_objects_by_name($a, $b) {
    return strcmp($a->name, $b->name);
}

function woffice_sort_objects_by_post_title($a, $b) {
    return strcmp($a->post_title, $b->post_title);
}

/**
 * Get the content of a string between two substrings
 * @param string $string
 * @param string$start
 * @param string $end
 * @return string
 */
function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

/**
 * Check if the current user is an administrator
 * @return bool
 */
function woffice_current_is_admin() {
    return (current_user_can('administrator')) ? true : false;
}

if(!function_exists('woffice_check_meta_caps')) {
    /**
     * Check if meta caps override Woffice settings by frontend
     * @param null|string $post_type
     * @return bool
     */
    function woffice_check_meta_caps($post_type = null) {

        //TODO when add here new post type available to manage by meta caps, they have to be added also in woffice_frontend_proccess(), around line 115
        if (!is_null($post_type) && ($post_type == 'wiki' || $post_type == 'post'))
            return (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('override_' . $post_type . '_by_caps') : false;
        else
            return false;
    }
}

if(!function_exists('woffice_get_slug_for_meta_caps')) {
    /**
     * Return the corresponding plural slug used in meta capabilities of each post type
     * @param null|string $post_type
     * @return string
     */
    function woffice_get_slug_for_meta_caps($post_type = null) {

        switch ($post_type) {
            case "wiki":
                return 'wikies';
            case 'post':
                return 'posts';
            default:
                return '';
        }

    }
}


if(!function_exists('woffice_get_children_count')) {
    /**
     * Return the number of posts inside a category (recursively)
     *
     * @param $category_id
     * @param $taxonomy
     * @return int
     */
    function woffice_get_children_count($category_id, $taxonomy, $excluded = array()){
        $cat = get_category($category_id);
        $count = (int) $cat->count;
        $args = array(
            'child_of' => $category_id,
            'exclude' => $excluded
        );
        $tax_terms = get_terms($taxonomy,$args);
        foreach ($tax_terms as $tax_term) {
            $count += $tax_term->count ;
        }
        return $count;
    }
}

if(!function_exists('woffice_send_user_registration_email')) {
    /**
     * Send an email to registered user that confirm the complete registration
     *
     * @param $user_id Id of registered user
     */
    function woffice_send_user_registration_email($user_id){

        $register_new_user_email = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('register_new_user_email') : '';
        $login_custom = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('login_custom') : '';
        if($register_new_user_email != 'yep' || $login_custom != 'yep')
            return;

        $site_name = get_option( 'blogname' );
        $admin_email = get_option( 'admin_email' );

        $user = get_userdata( $user_id );

        //Body
        $message = sprintf(esc_html__( 'Your registration on %s is completed.', 'woffice' ), $site_name) . "\r\n\r\n";
        $message .= esc_html__('Login url:', 'woffice'). ' ' . wp_login_url()."\r\n";
        $message .= esc_html__('Username:', 'woffice') . ' ' . $user->user_login ."\r\n";
        $message .= esc_html__('Password: The password chosen during the registration');

        $message = apply_filters( 'woffice_user_registration_message_body', $message );

        //Subject
        $subject = esc_html__( 'Your registration is completed', 'woffice' );
        $subject = apply_filters( 'woffice_user_registration_message_subject', $subject );

        //Headers
        $headers = array(
            "From: \"{$site_name}\" <{$admin_email}>\n",
            "Content-Type: text/plain; charset=\"" . get_option( 'blog_charset' ) . "\"\n",
        );
        $headers = apply_filters( 'woffice_user_registration_message_headers', $headers );

        wp_mail( $user->user_email, $subject, $message, $headers );
    }
}

if(!function_exists('woffice_get_name_to_display')) {
    /**
     * Get the name to user name to display according with Woffice Buddypress Settings
     * @param null|object|int $user
     * @return string
     */
    function woffice_get_name_to_display($user = null)
    {
        if (is_null($user)) {
            $user_info = wp_get_current_user(array('fields' => array('ID', 'user_firstname', 'user_login', 'user_nicename', 'display_name')));
        } elseif (is_object($user)) {
            $user_info = $user;
        } elseif (is_numeric($user)) {
            $user_info = get_userdata($user);
        }

        $buddy_directory_name = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('buddy_directory_name') : '';
        return ($buddy_directory_name == "name" && !empty($user_info->user_firstname)) ? $user_info->user_firstname : $user_info->user_login;
    }
}

if(!function_exists('woffice_adjust_brightness')){
    /*
     * From : http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
     * (C) Torkil Johnsen
     */
    function woffice_get_adjust_brightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }
}

if(!function_exists('woffice_get_navigation_state')) {
    /**
     * Return the state of the navigation default state. Return true if it is showed and false if it is hidden
     * @return bool
     */
    function woffice_get_navigation_state() {
        $menu_default = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('menu_default') : '';
        $nav_opened_state = (isset($_COOKIE['Woffice_nav_position']) && $_COOKIE['Woffice_nav_position'] == 'navigation-hidden' || $menu_default == "close") ? false : true;
        return $nav_opened_state;
    }
}

if(!function_exists('woffice_get_navigation_class')) {
    /**
     * Return the class for the navigation default state. It compare the cookies and the them options
     * @return string
     */
    function woffice_get_navigation_class() {
        $nav_opened_state = woffice_get_navigation_state();
        return (!$nav_opened_state) ? ' navigation-hidden ' : '';
    }
}


if(!function_exists('woffice_display_wiki_subcategories')) {
    /**
     * Display the wiki subcategories of a given category
     *
     * @param $category_id
     * @param $enable_wiki_accordion
     * @param $wiki_sortbylike
     */
    function woffice_display_wiki_subcategories($category_id, $enable_wiki_accordion, $wiki_sortbylike)
    {
	    $return = array('html' => '', 'summed_elements' => 0, 'n_elements' => 0, 'children' => array());
        // We check for excluded categories
        $wiki_excluded_categories = (function_exists('fw_get_db_settings_option')) ? fw_get_db_settings_option('wiki_excluded_categories') : '';
        /*If it's not a child only*/
        $wiki_excluded_categories_ready = (!empty($wiki_excluded_categories)) ? $wiki_excluded_categories : array();

	    //Get all child categories of the current one
        $child_categories = get_categories(array(
            'type' => 'wiki',
            'taxonomy' => 'wiki-category',
            'parent' => $category_id,
            'exclude' => $wiki_excluded_categories_ready
        ));

        if (!empty($child_categories)) {
	        //Foreach child category of the current one
            foreach ($child_categories as $category_child) {

	            //Get the subcategories items
	            $return['children'] = woffice_display_wiki_subcategories($category_child->term_id, $enable_wiki_accordion, $wiki_sortbylike);

	            $wiki_termchildren = get_term_children($category_child->term_id, 'wiki-category');
	            $wiki_query_childes = new WP_Query(
		            array(
			            'post_type' => 'wiki',
			            'showposts' => '-1',
			            'orderby' => 'post_title',
			            'order' => 'ASC',
			            'post_status' => array( 'publish', 'draft' ),
			            'tax_query' =>
				            array('relation' => 'AND',
					            array('taxonomy' => 'wiki-category',
					                  'field' => 'slug',
					                  'terms' => $category_child->slug,
					                  'operator' => 'IN'
					            ),
					            array('taxonomy' => 'wiki-category',
					                  'field' => 'id',
					                  'terms' => $wiki_termchildren,
					                  'operator' => 'NOT IN'
					            ),
					            array('taxonomy' => 'wiki-category',
					                  'field' => 'id',
					                  'terms' => $wiki_excluded_categories_ready,
					                  'operator' => 'NOT IN'
					            )
				            )
		            )
	            );
	            $wiki_array = array();
	            $html = '';

	            //Get all wiki elements of the current category and store in a variable
	            while ($wiki_query_childes->have_posts()) : $wiki_query_childes->the_post();

		            /*WE DISPLAY IT*/
		            if (woffice_is_user_allowed_wiki()) {
			            $return['n_elements']++;
			            $likes = woffice_get_wiki_likes(get_the_id());
			            $likes_display = (!empty($likes)) ? $likes : '';
			            $featured_wiki = (function_exists('fw_get_db_post_option')) ? fw_get_db_post_option(get_the_ID(), 'featured_wiki') : '';
			            $featured_wiki_class = ($featured_wiki) ? 'featured' : '';
			            if ($wiki_sortbylike) {
				            $like = get_string_between($likes_display, '</i> ', '</span>');
				            array_push($wiki_array, array(
						            'string' => '<li class="is-'.get_post_status().'"><a href="' . get_the_permalink() . '" rel="bookmark" class="' . $featured_wiki_class . '">' . get_the_title() . $likes_display . '</a></li>',
						            'likes' => (!empty($like)) ? (int)$like : 0
					            )
				            );
			            } else {
				            $html .= '<li class="is-'.get_post_status().'"><a href="' . get_the_permalink() . '" rel="bookmark" class="' . $featured_wiki_class . '">' . get_the_title() . $likes_display . '</a></li>';
			            }

		            }

	            endwhile;


	            $return['summed_elements'] = $return['n_elements'] + $return['children']['summed_elements'];

                if ($enable_wiki_accordion) {

                    $return['html'] .= apply_filters('woffice_wiki_subcategory_title', '<li class="sub-category"><span data-toggle="collapse" data-target="#' . $category_child->slug . '" expanded="false" aria-controls="' . $category_child->slug . '">' . esc_html($category_child->name) . ' (' . $return['summed_elements'] . ')</span>', $category_child->name, $return['summed_elements'], $category_child->slug);
	                $return['html'] .= '<ul id="' . $category_child->slug . '" class="list-styled list-wiki collapse" aria-expanded="false">';
                } else {
                    $return['html'] .= '<li class="sub-category"><span>' . esc_html($category_child->name) . ' (<span class="wiki-category-count">' . $return['summed_elements'] . '</span>)</span>
                 <ul class="list-styled list-wiki ">';
                }

	            //Save the subcategories that have to be returned
	            if($return['children']['n_elements'] > 0)
	                $return['html'] .= $return['children']['html'];

	            //Save the current wiki articles that have to be returned
	            $return['html'] .= $html;

	            //Sort the wiki articles if it is requested
                if ($wiki_sortbylike) {
                    usort($wiki_array, 'woffice_sort_objects_by_likes');
                    foreach ($wiki_array as $wiki) {
                        $return['html'] .= $wiki['string'];
                    }
                }

	            wp_reset_postdata();


                $return['html'] .= '</ul></li>';

            }

        }

	    return $return;
    }
}

if(!function_exists('woffice_redirect_to_login')) {
    /**
     * Redirect to login page and preserve the previous page url for a potential redirect
     *
     * @param string $param the parameter to add to login page (For instance: 'type=lost-password&foo=bar')
     * @param bool $param $disable_redirect_to
     */
    function woffice_redirect_to_login( $param = '', $disable_redirect_to = true ) {

        if ( ! $disable_redirect_to ) {
            //Get the previous url from parameter if it is already stored
            $redirect_to = ( isset( $_GET['redirect_to'] ) && ! empty( $_GET['redirect_to'] ) ) ? urldecode( $_GET['redirect_to'] ) : null;

            //If there is not a redirect url already stored then get the current url
            if ( is_null( $redirect_to ) ) {
                $http        = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) ? "https://" : "http://";
                $redirect_to = $http . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }

            $redirect_to = '?redirect_to=' . urlencode( $redirect_to );
        } else {
            $redirect_to = '';
        }

        //Get the login url and add the redirect url as parameter
        $login_page_slug = woffice_get_login_page_name();
        $login_page      = home_url( '/' . $login_page_slug . '/' ) . $redirect_to;

        //Add other parameters if they are present
        $param = ( empty( $param ) ) ? '' : '&' . $param;
        if ( ! empty( $param ) && empty( $redirect_to ) ) {
            $param = '?' . $param;
        }


        //Redirect
        wp_redirect( $login_page . $param );

    }
}
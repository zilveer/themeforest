<?php

if(!function_exists('plsh_gs'))
{
    function plsh_gs($param = NULL, $allow_cache = true)	//get setting
    {
        global $_SETTINGS;
        if($param === NULL) return $_SETTINGS->active;
        if(!empty($_SETTINGS->active[$param]) && $allow_cache == true) return $_SETTINGS->active[$param];
        if(!empty($_SETTINGS->$param)) return $_SETTINGS->$param;
        if(!empty($_SETTINGS->hidden[$param])) return $_SETTINGS->hidden[$param];
        return false;
    }
}

if(!function_exists('plsh_ss'))
{
    function plsh_ss($name, $value) //save setting
    {
        global $_SETTINGS;
        $_SETTINGS->update_single($name, $value);
    }
}

if(!function_exists('plsh_get_settings_admin_head'))
{
    function plsh_get_settings_admin_head()
    {
        global $_SETTINGS;
        return $_SETTINGS->admin_head;
    }
}

if(!function_exists('plsh_get_settings_admin_body'))
{
    function plsh_get_settings_admin_body()
    {
        global $_SETTINGS;
        return $_SETTINGS->admin_body;
    }
}

if(!function_exists('debug'))
{
    function debug($variable, $die=true)
    {
        if ((is_scalar($variable)) || (is_null($variable)))
        {
            if (is_null($variable))
            {
                $output = '<i>NULL</i>';
            }
            elseif (is_bool($variable))
            {
                $output = '<i>' . (($variable) ? 'TRUE' : 'FALSE') . '</i>';
            }
            else 
            {
                $output = $variable;
            }
            echo '<pre>variable: ' . $output . '</pre>';
        }
        else // non-scalar
        {
            echo '<pre>';
            print_r($variable);
            echo '</pre>';
        }

        if ($die)
        {
            die();
        }
    }
}    

if(!function_exists('plsh_dbSE'))
{
    function plsh_dbSE($value)
    {
        global $wpdb;
        return $wpdb->_real_escape($value);
    }
}

if(!function_exists('plsh_file_get_contents_curl'))
{
    function plsh_file_get_contents_curl($url) 
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}

if(!function_exists('plsh_get'))
{
    function plsh_get( $array, $key, $default = NULL )
    {
        if(is_array($array))
        {
            if( !empty( $array[$key] ) )
            {
                return $array[$key];
            }
        }
        return $default;
    }
}

if(!function_exists('plsh_current_page_url'))
{
    function plsh_current_page_url() 
    {
        $pageURL = 'http';

        if (plsh_get($_SERVER, "HTTPS") == "on") {$pageURL .= "s";}

        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80") 
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } 
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }


        return $pageURL;
    }
}

if(!function_exists('plsh_assamble_url'))
{
    function plsh_assamble_url($pageURL = false, $add_params = array(), $remove_params = array())
    {
        if(!$pageURL)
        {
            $pageURL = plsh_current_page_url();
        }

        if(!empty($remove_params))
        {
            foreach($remove_params as $remove)
            if(strpos($pageURL, $remove) !== false)
            {
                $parts = explode('?', $pageURL);
                if(count($parts) > 1)
                {
                    $query_parts = explode('&', $parts[1]);
                    foreach($query_parts as $key => $value)
                    {
                        if(strpos($value, $remove) !== false)
                        {
                            unset($query_parts[$key]);
                        }
                    }
                    if(!empty($query_parts))
                    {    
                        $parts[1] = implode('&', $query_parts);
                    }
                    else
                    {
                        unset($parts[1]);
                    }
                }

                $pageURL = implode('?', $parts);
            }
        }

        if(!empty($add_params))
        {
            foreach($add_params as $add)
            {        
                if(strpos($pageURL, '?') !== false)
                {
                    $pageURL .= '&' . $add;
                }
                else
                {
                    $pageURL .= '?' . $add;
                }
            }
        }

        return $pageURL;       
    }
}

if(!function_exists('plsh_get_post_id_from_slug'))
{
    function plsh_get_post_id_from_slug( $slug, $post_type = 'post' ) 
    {
        global $wpdb;

        $query = $wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type = %s", $slug, $post_type );
        $id = $wpdb->get_var( $query );  
        if ( ! empty( $id ) ) {
            return $id;
        } else {
            return 0;
        }
    }
}

if(!function_exists('plsh_get_post_slug_from_id'))
{
    function plsh_get_post_slug_from_id( $post_id ) 
    {
        $post = get_post( $post_id );
        if ( isset( $post->post_name ) ) {
            return $post->post_name;
        } else {
            return null;
        }
    }
}

if(!function_exists('plsh_thumbnail_regenerate_notification'))
{
    function plsh_thumbnail_regenerate_notification()
    {
        $dismissed = get_option('plsh_page_thumb_regen_dismissed', false);
        
        if(!$dismissed)
        {
            
            $dismiss_link = get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin&plsh_action=dismiss-thumb-regen';

            ?>
            <div class="updated plsh-auto-page-notification">
                <p>
                    <?php printf( __('If your blog already has posts with images, please <strong>Install</strong> & <strong>Run</strong> the bundled <strong>Regenerate Thumbnails</strong> plugin! This will ensure faster page load speeds.', 'goliath') ); ?>
                    <a class="plsh-dismiss" href="<?php echo esc_url($dismiss_link); ?>"><?php _e('dismiss', 'goliath'); ?></a>
                </p>
            </div>
            <?php
        }
    }
}

if(!function_exists('plsh_page_install_notification'))
{
    function plsh_page_install_notification() 
    {
        $dismissed = get_option('plsh_page_install_dismissed', false);
        
        if(!$dismissed)
        {
            $pages = plsh_get_auto_pages();
            $pages_installed = true;
            foreach($pages as &$page)
            {
                if(empty($page['id']) || get_post($page['id']) == NULL) //if page is not created of has been deleted
                {
                    $pages_installed = false;
                }
            }

            if(!$pages_installed)
            {
                $install_link = get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin&plsh_action=install-auto-pages';
                $dismiss_link = get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin&plsh_action=dismiss-auto-pages';
                ?>
                <div class="updated plsh-auto-page-notification">
                    <p>
                        <?php printf( __('Click <a href="%1$s">here</a> to automatically setup home and blog pages for Goliath theme.', 'goliath'), $install_link ); ?>
                        <a class="plsh-dismiss" href="<?php echo esc_url($dismiss_link); ?>"><?php _e('dismiss', 'goliath'); ?></a>
                    </p>
                </div>
                <?php
            }
        }
    }
}


if(!function_exists('plsh_db_update_notification'))
{
    function plsh_db_update_notification()
    {
        $install_link = get_admin_url() . 'admin.php?page=' . plsh_gs('theme_slug') . '-admin&plsh_action=plsh-db-migrate';
        ?>
        <div class="update-nag plsh-auto-page-notification">
            <p>
                <?php printf( __('Goliath needs to update your sites database to ensure full compatibility with the latest version of theme. <a href="%1$s">Click here to update</a>.', 'goliath'), $install_link ); ?>
            </p>
        </div>
        <?php
    }
}

if(!function_exists('plsh_page_install_success_notification'))
{
    function plsh_page_install_success_notification() 
    {
        ?>
        <div class="updated plsh-auto-page-notification">
            <p>
                <?php _e('The pages have been installed successfully!', 'goliath'); ?>
            </p>
        </div>
        <?php
    }
}
    
if(!function_exists('plsh_add_auto_pages'))
{
    function plsh_add_auto_pages() 
    {
        $pages = plsh_get_auto_pages();

        foreach($pages as &$page)
        {
            if(empty($page['id']) || get_post($page['id']) == NULL) //if page is not created of has been deleted
            {
                $page['id'] = plsh_create_page($page);

                //set up frontpage & blog page
                if($page['role'] == 'front_page')
                {
                    update_option( 'page_on_front', $page['id'] );
                    update_option( 'show_on_front', 'page' );
                }
                if($page['role'] == 'posts')
                {
                    update_option( 'page_for_posts', $page['id'] );
                }

                if(!empty($page['template']))
                {
                    update_post_meta( $page['id'], '_wp_page_template', $page['template'] );
                }
            }
        }

        update_option('plsh_auto_pages', json_encode($pages));
    }
}

if(!function_exists('plsh_get_auto_pages'))
{
    function plsh_get_auto_pages()
    {
        $default_pages = plsh_gs('auto_pages');
        $pages = get_option('plsh_auto_pages', json_encode($default_pages));
        return json_decode($pages, true);
    }
}

if(!function_exists('plsh_create_page'))
{
    function plsh_create_page($page) 
    {
        $page_data = array(
            'post_status' 		=> 'publish',
            'post_type' 		=> 'page',
            'post_author' 		=> 1,
            'post_name' 		=> esc_sql( $page['slug'] ),
            'post_title' 		=> $page['name'],
            'post_content' 		=> $page['content'],
            'post_parent' 		=> 0,
            'comment_status' 	=> 'closed'
        );

        $page_id = wp_insert_post( $page_data );
        if($page['role'] == 'front_page')
        {
            update_post_meta( $page_id, '_wp_page_template', 'page-home.php' );
        }
        return $page_id;
    }
}

if(!function_exists('plsh_is_shop_installed'))
{
    function plsh_is_shop_installed() 
    {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        $woocommerce = 'woocommerce/woocommerce.php';
        if( is_plugin_active( $woocommerce ) ) 
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

if(!function_exists('plsh_is_woocommerce_active'))
{
    function plsh_is_woocommerce_active()
    {
        if ( plsh_is_shop_installed())
        {
            return true;
        }
        return false;
    }
}

if(!function_exists('plsh_not_woocommerce_special_content'))
{
    function plsh_not_woocommerce_special_content()
    {
        if(plsh_is_woocommerce_active())
        {
            if( is_cart() || is_checkout() )
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        return true;
    }
}

if(!function_exists('plsh_dump_included_files'))
{
    function plsh_dump_included_files()
    {
        $included_files = get_included_files();
        $stylesheet_dir = str_replace( '\\', '/', get_stylesheet_directory() );
        $template_dir   = str_replace( '\\', '/', get_template_directory() );

        foreach ( $included_files as $key => $path ) {

            $path   = str_replace( '\\', '/', $path );

            if ( false === strpos( $path, $stylesheet_dir ) && false === strpos( $path, $template_dir ) )
                unset( $included_files[$key] );
        }

        debug( $included_files );
    }
}

if(!function_exists('plsh_get_posts_by_type'))
{
    function plsh_get_posts_by_type($post_type = 'post', $count = 8)
    {
        global $wpdb;

        if(function_exists('icl_get_languages')) //if wpml
        {
            $querydetails = $wpdb->prepare("
                SELECT wposts.*
                FROM $wpdb->posts as wposts
                LEFT JOIN ". $wpdb->base_prefix ."icl_translations 
                ON wposts.ID = ". $wpdb->base_prefix ."icl_translations.element_id
                WHERE
                wposts.post_status = 'publish'
                AND wposts.post_type = %s
                AND ". $wpdb->base_prefix ."icl_translations.language_code = %s
                ORDER BY wposts.post_date DESC
                LIMIT 0, %d
            ",
            plsh_dbSE($post_type),
            ICL_LANGUAGE_CODE,
            $count);
        }
        else
        {
            $querydetails = $wpdb->prepare("
                SELECT wposts.*
                FROM $wpdb->posts wposts
                WHERE
                wposts.post_status = 'publish'
                AND wposts.post_type = %s
                ORDER BY wposts.post_date DESC
                LIMIT 0, %d",
                plsh_dbSE($post_type),
                $count
                );
        }

        return $wpdb->get_results($querydetails, OBJECT);
    }
}

if(!function_exists('plsh_get_posts_by_meta'))
{
    function plsh_get_posts_by_meta($key, $value, $count, $page=1, $post_type = 'post')
    {
        global $wpdb;
        $limit = ($page-1) * $count;

        $querydetails = $wpdb->prepare("
            SELECT wposts.*
            FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
            WHERE wposts.ID = wpostmeta.post_id
            AND wpostmeta.meta_key = %s
            AND wpostmeta.meta_value = %s
            AND wposts.post_status = 'publish'
            AND wposts.post_type = %s
            ORDER BY wposts.post_date DESC
            LIMIT %d, %d",
            plsh_dbSE($key),
            plsh_dbSE($value),
            plsh_dbSE($post_type),
            $limit,
            $count);
        
        return $wpdb->get_results($querydetails, OBJECT);
    }
}

if(!function_exists('plsh_get_post_count_by_meta'))
{
    function plsh_get_post_count_by_meta($key, $value, $post_type = 'post')
    {
        global $wpdb;

        $querydetails = $wpdb->prepare("
            SELECT COUNT(*) as count
            FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
            WHERE wposts.ID = wpostmeta.post_id
            AND wpostmeta.meta_key = %s
            AND wpostmeta.meta_value = %s
            AND wposts.post_status = 'publish'
            AND wposts.post_type = %s",
            plsh_dbSE($key),
            plsh_dbSE($value),
            plsh_dbSE($post_type)
        );
        
        $values = $wpdb->get_results($querydetails, ARRAY_A);
        if(!empty($values))
        {
            return $values[0]['count'];
        }
        return 0;
    }
}

if(!function_exists('plsh_get_post_collection'))
{
    function plsh_get_post_collection($params = array(), $count = NULL, $page=1, $orderby = 'date', $dir = 'DESC', $type='post')
    {
        $args = array();
        if(!empty($params))
        {
            foreach($params as $key => $value)
            {
                if($value != NULL) $args[$key] = $value;
            }
        }

        $args['orderby'] = $orderby;
        $args['order'] = $dir;
        $args['post_status'] = 'publish';
        $args['ignore_sticky_posts'] = 1;
        $args['paged'] = $page;
        $args['post_type'] = $type;
        if($count) $args['posts_per_page'] = $count;
        $posts = new WP_Query( $args);
		wp_reset_postdata();
        return $posts->posts;
    }
}

if(!function_exists('plsh_get_taxonomy_hierarchy'))
{
    function plsh_get_taxonomy_hierarchy($taxonomy, $parent_id = 0)
    {
        $args = array(
            'type'                     => 'post',
            'parent'                   => $parent_id,
            'orderby'                  => 'name',
            'order'                    => 'ASC',
            'hide_empty'               => 1,
            //'hierarchical'             => 1,
            'taxonomy'                 => $taxonomy,
            'pad_counts'               => false 
        );
        $categories = get_categories( $args );

        foreach($categories as $key => $value)
        {
            $categories[$key]->children = plsh_get_taxonomy_hierarchy($taxonomy, $value->term_id);
        }

        return $categories;
    }
}

if(!function_exists('plsh_get_posts_with_latest_comments'))
{
    function plsh_get_posts_with_latest_comments($count, $page=1, $type='post')
    {
        global $wpdb;
        $limit = ($page-1) * $count;

        $querydetails = $wpdb->prepare("
            select wp_posts.*,
            coalesce(
                (
                    select max(comment_date)
                    from $wpdb->comments wpc
                    where wpc.comment_post_id = wp_posts.id
                ),
                wp_posts.post_date
            ) as mcomment_date
            from $wpdb->posts wp_posts
            where post_type = %s
            and post_status = 'publish'
            and comment_count > 0
            order by mcomment_date desc
            limit %d, %d",
            $type,
            $limit,
            $count
            );

        return $wpdb->get_results($querydetails, OBJECT);    
    }
}

if(!function_exists('plsh_get_posts_with_comments_count'))
{
    function plsh_get_posts_with_comments_count($type='post')
    {
        global $wpdb;

        $querydetails = $wpdb->prepare("
            select COUNT(*) as count
            from $wpdb->posts wp_posts
            where post_type = %s
            and post_status = 'publish'
            and comment_count > 0",
            $type
        );

        $values = $wpdb->get_results($querydetails, ARRAY_A);    
        if(!empty($values))
        {
            return $values[0]['count'];
        }
        return 0;
    }
}

if(!function_exists('generate_css'))
{
    function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true )
    {
        $return = '';
        $default = plsh_gs($mod_name);
        $mod = get_theme_mod($mod_name, $default);
        if ( ! empty( $mod ) )
        {
            $mod = str_replace('#', '', $mod);
            $mod = str_replace('+', ' ', $mod);
            $return = sprintf('%s { %s:%s; }',
               $selector,
               $style,
               $prefix.$mod.$postfix
            );
            if ( $echo )
            {
               echo $return . "\n";
            }
        }
        return $return;
    }
}

/* Add additional params to wp_get_archives thus enabling filter by year functionality */
if(!function_exists('plsh_archive_where'))
{
    function plsh_archive_where($where,$args){
        $year = isset($args['year']) ? $args['year'] : '';
        $month = isset($args['month']) ? $args['month'] : '';

        if($year){
        $where .= " AND YEAR(post_date) = '$year' ";
        $where .= $month ? " AND MONTH(post_date) = '$month' " : '';
        }
        if($month){
        $where .= " AND MONTH(post_date) = '$month' ";
        }

        return $where;
    }
}

if(!function_exists('plsh_is_blog'))
{
    function plsh_is_blog()
    {
        if ( is_front_page() && is_home() ) 
        {
            return false;
        } 
        elseif ( is_front_page() ) 
        {
            return false;
        } 
        elseif ( is_home() ) {
            return true;
        } else {
            return false;
        }
    }
}

if(!function_exists('plsh_log_theme_version'))
{
    function plsh_log_theme_version()
    {
        $theme = wp_get_theme();
        $version = $theme->get('Version');
                
        $prev_version = get_option('plsh_previous_theme_version', $version);
        $curr_version = get_option('plsh_current_theme_version', $version);
        
        //temp
        if($version == '1.0.5' && get_option('plsh_stored_settings', false) !== false)  //if the theme has been installed before
        {
            update_option('plsh_previous_theme_version', '1.0.4');
        }
        else 
        {
            update_option('plsh_previous_theme_version', $curr_version);
        }
        
        update_option('plsh_current_theme_version', $version);
    }
}

if(!function_exists('plsh_get_bundled_plugin_version'))
{
	function plsh_get_bundled_plugin_version($slug = '')
	{
		global $plsh_bundled_versions;
		
		if(!empty($plsh_bundled_versions[$slug]))
		{
			return $plsh_bundled_versions[$slug];
		}
		
		return false;
	}
}
?>
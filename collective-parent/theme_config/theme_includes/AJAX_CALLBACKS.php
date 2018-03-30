<?php

if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_home_page'])) == 'page')
            {
                update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
            }

            if(get_post_type(intval($options[TF_THEME_PREFIX . '_blog_page'])) == 'page')
            {
                update_option('page_for_posts', intval($options[TF_THEME_PREFIX . '_blog_page']));
            }
            else
            {
                update_option('page_for_posts', 0);
            }
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
            update_option('page_for_posts', 0);
        }

    }
endif;

if (!function_exists('tfuse_loveit_cookies')) :
    /**
     *
     *
     * To override tfuse_loveit_cookies() in a child theme, add your own tfuse_loveit_cookies()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_loveit_cookies()
    {
        global $TFUSE;

        if (!$TFUSE->request->isset_POST('cookies') || !$TFUSE->request->isset_POST('id')) { die(); }

        $loves = array();
        if ($TFUSE->request->isset_COOKIE('tfuse_loves'))
        {
            $loves = explode(";", $TFUSE->request->COOKIE('tfuse_loves'));

            if ( !in_array($TFUSE->request->POST('id'), $loves) )
            {
                $loves[] = $TFUSE->request->POST('id');
            }
        }
        else
        {
            $loves[] = $TFUSE->request->POST('id');
        }

        $result = setcookie('tfuse_loves',implode(";", $loves),time()+3600*24*60,'/');

        if ( $result ) _e('Success','tfuse'); else _e('Error','tfuse');
        die();
    }

    add_action("wp_ajax_tfuse_loveit_cookies_action","tfuse_loveit_cookies");
    add_action("wp_ajax_nopriv_tfuse_loveit_cookies_action","tfuse_loveit_cookies");
endif;

if (!function_exists('tfuse_loveit_callback')) :
    /**
     *
     *
     * To override tfuse_loveit_callback() in a child theme, add your own tfuse_loveit_callback()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */
    function tfuse_loveit_callback()
    {
        global $TFUSE;

        if (!$TFUSE->request->isset_POST('id')) { die();}
        $id = $TFUSE->request->POST('id');

        $count1 = 0;
        $count = get_post_meta($id,'tfuse_love_it', true);
        if( $count == '' ) $count = $count1;
        $count = intval($count);
        $count++;

        tf_update_post_meta($id,'tfuse_love_it',$count);
        $response = array('succes'=>true,'loves'=>$count);
        $response = json_encode( $response);
        echo $response;
        die();
    }

    add_action("wp_ajax_tfuse_loveit_action","tfuse_loveit_callback");
    add_action("wp_ajax_nopriv_tfuse_loveit_action","tfuse_loveit_callback");
endif;
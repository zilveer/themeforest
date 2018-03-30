<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Adds love to the posts used in various post types.
 * 
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @version     4.0
 * @package     artbees
 */


class Mk_Love_Post
{
    


    function __construct() {

        add_action('wp_ajax_mk_love_post', array(&$this,
            'action_triger'
        ));
        add_action('wp_ajax_nopriv_mk_love_post', array(&$this,
            'action_triger'
        ));

    }


    
    function action_triger($post_id) {
        
        if (isset($_POST['post_id'])) {
            $post_id = str_replace('mk-love-', '', $_POST['post_id']);
            echo self::love_post($post_id, 'update');
        } 
        else {
            $post_id = str_replace('mk-love-', '', $_POST['post_id']);
            echo self::love_post($post_id, 'get');
        }
        
        exit;
    }



    

    static function love_post($post_id, $action = 'get') {
        
        if (!is_numeric($post_id)) return;
        
        switch ($action) {
            case 'get':
                $love_count = get_post_meta($post_id, '_mk_post_love', true);
                if (!$love_count) {
                    $love_count = 0;
                    add_post_meta($post_id, '_mk_post_love', $love_count, true);
                }
                
                return '<span class="mk-love-count">' . $love_count . '</span>';
                break;

            case 'update':
                $love_count = get_post_meta($post_id, '_mk_post_love', true);
                if (isset($_COOKIE['mk_jupiter_love_' . $post_id])) return $love_count;
                
                $love_count++;
                update_post_meta($post_id, '_mk_post_love', $love_count);
                setcookie('mk_jupiter_love_' . $post_id, $post_id, time() * 20, '/');
                
                return '<span class="mk-love-count">' . $love_count . '</span>';
                break;
            }
    }
    



    static function send_love($icon = 'mk-icon-heart') {
        global $post;
        
        $love_count = self::love_post($post->ID);
        
        $class = '';

        if (isset($_COOKIE['mk_jupiter_love_' . $post->ID])) {
            $class = 'item-loved';
        }
        
        return '<a href="#" class="mk-love-this ' . $class . '" id="mk-love-' . $post->ID . '">'.Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon, 16).'</i> ' . $love_count . '</a>';

    }
}
new Mk_Love_Post();

?>
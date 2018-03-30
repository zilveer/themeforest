<?php
/*
Description: Adds a metabox to the Appearance -> Menu page to add personage sections
Author: Pixflow
Author URL: pixflow.net
*/

class PxSections {

    static function load(){

        // Hook function to add the metabox to the Menu page
        add_action( 'admin_init', array(__CLASS__,'add_meta_box'));

        // Javascript for the meta box
        add_action( 'admin_enqueue_scripts', array(__CLASS__,'metabox_script') );

        // Ajax callback to create menu item and add it to menu
        add_action('wp_ajax_my-add-post-type-archive-links', array( __CLASS__, 'ajax_add_post_type'));

        // Assign menu item the appropriate url
        add_filter( 'wp_setup_nav_menu_item',  array(__CLASS__,'setup_archive_item') );

        // Make post type archive link 'current'
        add_filter( 'wp_nav_menu_objects', array(__CLASS__,'maybe_make_current'));
    }

    static function add_meta_box() {
        add_meta_box( 'post-type-archives', __('Home Sections','my-post-type-archive-links'),array(__CLASS__,'metabox'),'nav-menus' ,'side','core');
    }

    static  function metabox( ) {
        global $nav_menu_selected_id;
        $i = 0;
        $used_sections = array();

        $sections = array(
            '0'=>'portfolio',
            '1'=>'home',
            '2'=>'resume',
            '3'=>'contact');


        function customPartItems (){
            $custom_temp = array();
            $args = array(
                'post_type' => 'custom-part',
            );
            $loop = new WP_Query($args);
            global $post;

            while($loop->have_posts()): $loop->the_post();
                $title = get_the_title($post->ID);
                $pId = (string) $post ->ID;
                $custom_temp[$pId] = strtolower($title);

            endwhile;
            wp_reset_query();
            return $custom_temp;
        };

        $custom_parts = customPartItems();
        $sections = $sections + $custom_parts ;


        $locations = get_nav_menu_locations();
        if (isset($locations['primary-nav'])) {
            $menu_id = $locations['primary-nav'];
            $menu_items = wp_get_nav_menu_items( $menu_id, array() );
            if( !empty( $menu_items ) ) {

                foreach( $menu_items as $menu_item ) {
                    $used_sections[$menu_item->object] = $menu_item->title  ;
                }
            }
        }

        $result = array_diff($sections, $used_sections);

        ?>
        
        <ul id="post-type-archive-checklist">
        
            <?php
            foreach($result as $value => $section){
                echo '<li><label><input type="checkbox" item-title="'.$section.'" value ="'.$value.'" /> '.$section.' </label></li>';
            }
            ?>
            
        </ul><!-- /#post-type-archive-checklist -->

        <!-- 'Add to Menu' button -->
        <p class="button-controls" >
            <span class="add-to-menu" >
                <input type="submit" id="submit-post-type-archives" <?php disabled( $nav_menu_selected_id, 0 ); ?> value="<?php esc_attr_e('Add to Menu'); ?>" name="add-post-type-menu-item"  class="button-secondary submit-add-to-menu" />
            </span>
        </p>
    <?php
        $_POST['last_array'] = array();
    }

    static function metabox_script($hook) {

        if( 'nav-menus.php' != $hook )
            return;

        //On Appearance>Menu page, enqueue script:
        wp_enqueue_script( 'sections', THEME_ADMIN_URI  .'/scripts/sections.js', array('jquery'));

        //Add nonce variable
        wp_localize_script('sections','MyPostTypeArchiveLinks', array('nonce'=>wp_create_nonce('my-add-post-type-archive-links')));
    }

    static function ajax_add_post_type() {
    
        $sections = array (
            '0'=>'portfolio',
            '1'=>'home',
            '2'=>'resume',
            '3'=>'contact');

        if ( ! current_user_can( 'edit_theme_options' ) )
            die('-1');

        check_ajax_referer('my-add-post-type-archive-links', 'posttypearchive_nonce');

        require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

        if(empty($_POST['post_type']))
            exit;

        // Create menu items and store IDs in array
        $item_ids=array();


        //Sort ids and arrays
        $ids=$_POST['post_type'][0];
        $titles=$_POST['post_type'][1];
        $i=0;
        foreach ($ids as $id){
           $items[$id]=$titles[$i];
            $i++;
        }

        foreach ( (array) $items as $key=>$post_type) {
            if(in_array($post_type,$sections) ){
                $menu_item_data= array(
                    'menu-item-title' => $post_type,
                    'menu-item-type' => 'post_type_archive',
                    'menu-item-object' => $key,
                    'menu-item-url' => '/#'.$post_type
                );
            }
            else{
                $menu_item_data= array(
                    'menu-item-title' => $post_type,
                    'menu-item-type' => 'post_type_archive',
                    'menu-item-object' => $key,
                    'menu-item-url' => '/#'.$key
                );
            }
            //Collect the items' IDs.
            $item_ids[] = wp_update_nav_menu_item(0, 0, $menu_item_data );
        }

        // If there was an error die here
        if ( is_wp_error( $item_ids ) )
            die('-1');

        // Set up menu items
        foreach ( (array) $item_ids as $menu_item_id ) {
            $menu_obj = get_post( $menu_item_id );
            if ( ! empty( $menu_obj->ID ) ) {
                $menu_obj = wp_setup_nav_menu_item( $menu_obj );
                $menu_obj->label = $menu_obj->title; // don't show "(pending)" in ajax-added items
                $menu_items[] = $menu_obj;
            }
        }

        // This gets the HTML to returns it to the menu
        if ( ! empty( $menu_items ) ) {
            $args = array(
                'after' => '',
                'before' => '',
                'link_after' => '',
                'link_before' => '',
                'walker' => new Walker_Nav_Menu_Edit
            );
            echo walk_nav_menu_tree( $menu_items, 0, (object) $args );
        }

        // Finally don't forget to exit
        exit;
    }

    static function setup_archive_item($menu_item){
        if($menu_item->type !='post_type_archive')
            return $menu_item;
        $sections = array(
            '0'=>'portfolio',
            '1'=>'home',
            '2'=>'resume',
            '3'=>'contact');
        $post_type = $menu_item->object;
        if(array_key_exists($post_type,$sections) ){
            $menu_item->url = home_url().'/#'.$sections[$post_type];
        }
        else {
            $menu_item->url = home_url().'/#'.$post_type;
        }

        return $menu_item;
    }

    static function maybe_make_current($items) {
        foreach ($items as $item) {
            if('post_type_archive' != $item->type)
                continue;

            $post_type = $item->object;
            if(!is_post_type_archive($post_type)&& !is_singular($post_type))
                continue;

            // Make item current
            $item->current = true;
            $item->classes[] = 'current-menu-item';

            // Get menu item's ancestors:
            $_anc_id = (int) $item->db_id;
            $active_ancestor_item_ids=array();

            while(( $_anc_id = get_post_meta( $_anc_id, '_menu_item_menu_item_parent', true ) ) && ! in_array( $_anc_id, $active_ancestor_item_ids )  ) {
                $active_ancestor_item_ids[] = $_anc_id;
            }

            // Loop through ancestors and give them 'ancestor' or 'parent' class
            foreach ($items as $key=>$parent_item) {
                $classes = (array) $parent_item->classes;

                // If menu item is the parent
                if ($parent_item->db_id == $item->menu_item_parent ) {
                    $classes[] = 'current-menu-parent';
                    $items[$key]->current_item_parent = true;
                }

                // If menu item is an ancestor
                if ( in_array(  intval( $parent_item->db_id ), $active_ancestor_item_ids ) ) {
                    $classes[] = 'current-menu-ancestor';
                    $items[$key]->current_item_ancestor = true;
                }

                $items[$key]->classes = array_unique( $classes );
            }

        }
        return $items;
    }
}
$sections = new PxSections();
$sections->load();
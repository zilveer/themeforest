<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 6/2/14
 * Time: 11:38 AM
 */

if ( class_exists( 'WP_Import' ))
{
    class AWEImport extends WP_Import
    {
        public $theme_options_name;
        public $default_configs;
        public function __construct($default_configs)
        {
            $this->default_configs = $default_configs;
            parent::__construct();
            $this->theme_options_name = apply_filters("awe_theme_options_name","AWE-Theme-Options");
        }

        public function set_menus()
        {
            //get all registered menu locations
            $locations = get_theme_mod('nav_menu_locations');
            // get all created menu
            $created_menus = wp_get_nav_menus();
            $founded = false;
            $menuLocation = array();
            if(!empty($created_menus) && is_array($this->default_configs))
            { 

                foreach($created_menus as $menu)
                { 
                    if(is_object($menu))
                    {
                        
                        if( in_array($menu->name, $this->default_configs['menu_name'])  )
                        {
                            $this->menu_replace_url($menu->term_id,$menu->name);
                            
                            if ( $menu->name=='Main Menu' )
                            {
                                $menuLocation['main_menu'] = $menu->term_id;
                            }

                            if( $menu->name=='Top Menu' ){
                                $menuLocation['top_menu']  = $menu->term_id;
                            }
                            
                            if( $menu->name == 'Left Menu' ){
                                $menuLocation['left_menu'] = $menu->term_id;
                            }
                            $founded = true;
                        }
                    }
                }

                if ( !empty($menuLocation) )
                {
                    set_theme_mod( 'nav_menu_locations', $menuLocation);
                }
            }
            if(!$founded)
            {
                echo "<p class=\"error\">Can not set default menu!</p>";
            }
            

        }

        public function menu_replace_url($id,$menu_name)
        {

            $menu = wp_get_nav_menu_items( $menu_name, array( 'post_status' => 'publish' ) );
            if(is_array($menu))
                foreach($menu as $key => $item){
                    if(preg_match("#".$this->default_configs['menu_replace']."#",$item->url))
                        $item->url = str_replace($this->default_configs['menu_replace'],home_url(),$item->url);
                    $menu[$key] = $item;
                    if(isset($item->classes[0]) && is_array($item->classes)){
                        $item->classes = array_filter($item->classes, 'strlen');
                        $item->classes = implode(' ',$item->classes);
                    }
                    $new = array(
                        'menu-item-db-id' => $item->db_id,

                        'menu-item-object-id' => $item->object_id,

                        'menu-item-object' => $item->object,

                        'menu-item-type'  => $item->type,

                        'menu-item-parent-id' => $item->menu_item_parent,

                        'menu-item-position' => $item->menu_order,

                        'menu-item-title' => $item->title,

                        'menu-item-url' => $item->url,

                        'menu-item-description' => $item->description,

                        'menu-item-attr-title' => $item->attr_title,

                        'menu-item-status' => $item->post_status,

                        'menu-item-target' => $item->target,

                        'menu-item-xfn' => $item->xfn,

                        'menu-item-classes' =>  $item->classes,
                    );

                    wp_update_nav_menu_item($id,$item->ID,$new);
                }

        }

        public function set_widgets()
        {
            if(isset($this->default_configs['widgets']) && is_array($this->default_configs['widgets']) && count($this->default_configs['widgets'])>0)
            {
                update_option('sidebars_widgets', '');
                foreach($this->default_configs['widgets'] as $sidebar => $widgets)
                    if(is_array($widgets) && count($widgets)>0)
                        foreach($widgets as $widget => $options)
                            $this->add_widget_sidebar($sidebar,$widget,$options[0],$options[1]);
            }

        }

        public function set_contact()
        {
            if(isset($this->default_configs['contact_form_name']))
                if(function_exists('wpcf7'))
                {
                    $founded = false;
                    $wcf7s = get_posts( array( 'post_type' => 'wpcf7_contact_form' ) );
                    if(is_array($wcf7s) && count($wcf7s)>0)
                        foreach($wcf7s as $f)
                        {
                            if($f->post_title==$this->default_configs['contact_form_name'])
                            {
                                $options = get_option($this->default_configs['theme_options_name']);
                                $options = $this->recursive_arr_find_replace($options,$this->default_configs['contact_option'],$f->ID);
                                update_option($this->default_configs['theme_options_name'],$options);
                                echo "<p class=\"success\">Set default contact form successfully!</p>";
                                $founded = true;

                            }
                        }
                    if(!$founded)
                        echo "<p class=\"error\">Can not set default contact form!</p>";
                }else
                    echo "<p class=\"error\">Contact Form 7 Plugin does not active!</p>";
        }

        public function set_profile()
        {
            if(isset($this->default_configs['profile_name']))
            {
                $founded = false;
                $members = get_posts( array( 'post_type' => 'awe_team' ) );
                if(is_array($members) && count($members)>0)
                {
                    foreach($members as $member)
                    {
                        if($member->post_title==$this->default_configs['profile_name'])
                        {
                            $options = get_option($this->default_configs['theme_options_name']);
                            $options = $this->recursive_arr_find_replace($options,$this->default_configs['profile_option'],$member->ID);
                            update_option($this->default_configs['theme_options_name'],$options);
                            echo "<p class=\"success\">Set default profile successfully!</p>";
                            $founded = true;
                        }
                    }
                }
                if(!$founded)
                    echo "<p class=\"error\">Can not set default profile!</p>";
            }
        }


        function recursive_arr_find_replace($arr, $find, $replace){
            if(is_array($arr)){
                foreach($arr as $key=>$val) {
                    if(is_array($arr[$key])){
                        $arr[$key] = $this->recursive_arr_find_replace($arr[$key], $find, $replace);
                    }else{
                        if($key == $find && !is_array($val)) {
                            $arr[$key] = $replace;
                        }
                    }
                }
            }
            return $arr;
        }
        
        public function set_aboutus()
        {
            if(isset($this->default_configs['about_name']))
            {
                $founded = false;
                $members = get_posts( array( 'post_type' => 'awe_aboutus' ) );
                if(is_array($members) && count($members)>0)
                {
                    foreach($members as $member)
                    {
                        if($member->post_title==$this->default_configs['about_name'])
                        {
                            $options = get_option($this->default_configs['theme_options_name']);
                            $options = $this->recursive_arr_find_replace($options,$this->default_configs['about_option'],$member->ID);
                            update_option($this->default_configs['theme_options_name'],$options);
                            echo "<p class=\"success\">Set default About Us successfully!</p>";
                            $founded = true;
                        }
                    }
                }
                if(!$founded)
                    echo "<p class=\"error\">Can not set About Us profile!</p>";
            }
        }

        public function set_homepage()
        {
            $homepage = get_page_by_title( $this->default_configs['homegpage_name'] );
            if($homepage)
            {
                update_option( 'page_on_front', $homepage->ID );
                update_option( 'show_on_front', 'page' );
                echo "<p class=\"success\">Set Homepage successfully!</p>";
            }else
                echo "<p class=\"error\">Can not set Homepage!</p>";
        }

        public function set_pricing()
        {
            if(isset($this->default_configs['pricing_name']))
            {
                $founded = false;
                $members = get_posts( array( 'post_type' => 'awe_pricing_table' ) );
                if(is_array($members) && count($members)>0)
                {
                    foreach($members as $member)
                    {
                        if($member->post_title==$this->default_configs['pricing_name'])
                        {
                            $options = get_option($this->default_configs['theme_options_name']);
                            $options = $this->recursive_arr_find_replace($options,$this->default_configs['pricing_option'],$member->ID);
                            update_option($this->default_configs['theme_options_name'],$options);
                            echo "<p class=\"success\">Set default Pricing Table successfully!</p>";
                            $founded = true;
                        }
                    }
                }
                if(!$founded)
                    echo "<p class=\"error\">Can not set Pricing Table!</p>";
            }
        }

        public function set_options()
        {
            if(isset($this->default_configs['options_demo']))
            {
                $options = get_option($this->theme_options_name);
                $options['extra'] = $this->parse_configs($options['extra'],$this->default_configs['options_demo']);
                update_option($this->theme_options_name,$options);
                echo "<p class=\"success\">Update demo options successfully!</p>";
            }
            else
                echo "<p class=\"error\">Can not set demo options!</p>";
        }

        public function remove_all_posts()
        {
            $posts = get_posts( array("post_type"=>"post", "posts_per_page"=>-1) );

            foreach ( $posts as $post ) : setup_postdata($post);
                if($post->post_title=='Hello world!')
                    wp_delete_post($post->ID);
            endforeach;
            wp_reset_postdata();

            $pages = get_posts( array("post_type"=>"page", "posts_per_page"=>-1) );

            foreach ( $pages as $page ) : setup_postdata($page);
                if($page->post_title=='Sample Page')
                    wp_delete_post($page->ID);
            endforeach;
            wp_reset_postdata();
        }

        public function add_widget_sidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){
            $sidebarOptions = get_option('sidebars_widgets');
            if(!isset($sidebarOptions[$sidebarSlug])){
                $sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
            }
            $newWidget = get_option('widget_'.$widgetSlug);
            if(!is_array($newWidget))$newWidget = array();
            $count = count($newWidget)+1+$countMod;
            $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;

            $newWidget[$count] = $widgetSettings;

            update_option('sidebars_widgets', $sidebarOptions);
            update_option('widget_'.$widgetSlug, $newWidget);
        }
        public function parse_configs($current, $new)
        {
            $current = $this->recurse($current,$new);

            // handle the arguments, merge one by one
            $args = func_get_args();
            $current = $args[0];
            if (!is_array($current))
            {
                return $current;
            }
            for ($i = 1; $i < count($args); $i++)
            {
                if (is_array($args[$i]))
                {
                    $current = $this->recurse($current, $args[$i]);
                }
            }
            return $current;
        }

        public function recurse($current, $new)
        {
            foreach ($new as $key => $value)
            {
                // create new key in $current, if it is empty or not an array
                if (!isset($current[$key]) || (isset($current[$key]) && !is_array($current[$key])))
                {
                    $current[$key] = array();
                }

                // overwrite the value in the base array
                if (is_array($value))
                {
                    $value = $this->recurse($current[$key], $value);
                }
                $current[$key] = $value;
            }
            return $current;
        }
    }
}
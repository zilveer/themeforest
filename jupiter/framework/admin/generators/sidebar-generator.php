<?php
class mkSidebarGenerator
{
    var $sidebar_names = array();
    var $footer_sidebar_count = 0;
    var $footer_sidebar_names = array();
    
    function __construct() {
        $this->sidebar_names = array(
            'page' => __('Page Widget Area', 'mk_framework') ,
            'single_post' => __('Single Posts Widget Area', 'mk_framework') ,
            'single_portfolio' => __('Single Portfolios Widget Area', 'mk_framework') ,
            'single_news' => __('Single News Widget Area', 'mk_framework') ,
            'search' => __('Search Widget Area', 'mk_framework') ,
            'archive' => __('Archive Widget Area', 'mk_framework') ,
            '404' => __('404 Widget Area', 'mk_framework') ,
            'woocommerce' => __('Woocommerce Shop Widget Area', 'mk_framework') ,
            'woocommerce_single' => __('Woocommerce Single Widget Area', 'mk_framework') ,
        );
        $this->footer_sidebar_names = array(
            __('First Footer Widget Area', 'mk_framework') ,
            __('Second Footer Widget Area', 'mk_framework') ,
            __('Third Footer Widget Area', 'mk_framework') ,
            __('Fourth Footer Widget Area', 'mk_framework') ,
            __('Fifth Footer Widget Area', 'mk_framework') ,
            __('Sixth Footer Widget Area', 'mk_framework') ,
        );

        $theme_options = get_option(THEME_OPTIONS);
        $this->custom_sidebar_name = isset($theme_options['custom_sidebars']) ? $theme_options['custom_sidebars'] : '';
    }
    
    function register_sidebar() {
        
        $i = 1;
        
        foreach ($this->sidebar_names as $name) {
            register_sidebar(array(
                'name' => $name,
                'id' => 'sidebar-' . $i,
                'description' => $name,
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<div class="widgettitle">',
                'after_title' => '</div>',
            ));
            $i++;
        }
        foreach ($this->footer_sidebar_names as $name) {
            register_sidebar(array(
                'name' => $name,
                'id' => 'sidebar-' . $i,
                'description' => $name,
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<div class="widgettitle">',
                'after_title' => '</div>',
            ));
            $i++;
        }
        
        register_sidebar(array(
            'name' => 'Side Dashboard - Above Navigation',
            'id' => 'sidebar-' . $i,
            'description' => 'Side Dashboard widget area. widgets added int this area will be added above side dashboard navigation.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<div class="widgettitle">',
            'after_title' => '</div>',
        ));
        
        $i++;
        
        register_sidebar(array(
            'name' => 'Side Dashboard - Below Navigation',
            'id' => 'sidebar-' . $i,
            'description' => 'Side Dashboard widget area. widgets added int this area will be added below side dashboard navigation.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<div class="widgettitle">',
            'after_title' => '</div>',
        ));
        
        $i++;
        
        //register custom sidebars
        $custom_sidebars = get_option(THEME_OPTIONS);
        if (!empty($custom_sidebars['sidebars'])) {
            $custom_sidebar_names = explode(',', $custom_sidebars['sidebars']);
            foreach ($custom_sidebar_names as $name) {
                register_sidebar(array(
                    'name' => $name,
                    'id' => 'sidebar-' . $i,
                    'description' => $name,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<div class="widgettitle">',
                    'after_title' => '</div>',
                ));
                
                $i++;
            }
        }


        if (!empty($this->custom_sidebar_name)) {
            foreach ($this->custom_sidebar_name as $name) {
                $name = str_replace('_', ' ', $name);
                $name = str_replace('-', ' ', $name);
                register_sidebar(array(
                    'name' => __('Custom Post Type - ' , 'mk_framework') . $name,
                    'id' => 'sidebar-' . $i,
                    'description' => $name,
                    'before_widget' => '<section id="%1$s" class="widget %2$s">',
                    'after_widget' => '</section>',
                    'before_title' => '<div class="widgettitle">',
                    'after_title' => '</div>',
                ));
                
                $i++;
            }
        }

    }
    
    function get_sidebar($post_id) {
        
        if (is_page() || is_home()) {
            $sidebar = $this->sidebar_names['page'];
        }
        if (is_search()) {
            $sidebar = $this->sidebar_names["search"];
        }
        if (is_404()) {
            $sidebar = $this->sidebar_names["404"];
        }
        if (is_archive()) {
            $sidebar = $this->sidebar_names["archive"];
        }
        if (is_singular('post')) {
            $sidebar = $this->sidebar_names['single_post'];
        }
        if (is_singular('portfolio')) {
            $sidebar = $this->sidebar_names['single_portfolio'];
        }
        if (is_singular('news')) {
            $sidebar = $this->sidebar_names['single_news'];
        }
        if (is_archive()) {
            $sidebar = $this->sidebar_names["archive"];
        }
        if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
            $sidebar = $this->sidebar_names["woocommerce"];
        }
        if (function_exists('is_woocommerce') && is_woocommerce() && is_single()) {
            $sidebar = $this->sidebar_names["woocommerce_single"];
        }
        if (function_exists('is_bbpress') && is_bbpress()) {
            $sidebar = $this->sidebar_names['page'];
        }
        
        if (!empty($post_id)) {
            $custom = get_post_meta($post_id, '_sidebar', true);
            if (!empty($custom)) {
                $sidebar = $custom;
            }
        }

        if(is_array($this->custom_sidebar_name) && !empty($this->custom_sidebar_name)) {
            foreach ($this->custom_sidebar_name as $name) {
                if (is_singular($name)) {
                    $name = str_replace('_', ' ', $name);
                    $name = str_replace('-', ' ', $name);
                    $sidebar = __('Custom Post Type - ' , 'mk_framework') . $name;
                }    
            }
        }

        if (isset($sidebar)) {
            dynamic_sidebar($sidebar);
        }

        
        
    }
    function get_footer_sidebar() {
        global $post;
        if (is_singular()) {
            if ($this->footer_sidebar_count == 0) {
                $single_area = get_post_meta($post->ID, '_widget_first_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
            if ($this->footer_sidebar_count == 1) {
                $single_area = get_post_meta($post->ID, '_widget_second_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
            if ($this->footer_sidebar_count == 2) {
                $single_area = get_post_meta($post->ID, '_widget_third_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
            if ($this->footer_sidebar_count == 3) {
                $single_area = get_post_meta($post->ID, '_widget_fourth_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
            if ($this->footer_sidebar_count == 4) {
                $single_area = get_post_meta($post->ID, '_widget_fifth_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
            if ($this->footer_sidebar_count == 5) {
                $single_area = get_post_meta($post->ID, '_widget_sixth_col', true);
                if (!empty($single_area)) {
                    dynamic_sidebar($single_area);
                } 
                else {
                    dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
                }
            }
        } 
        else {
            dynamic_sidebar($this->footer_sidebar_names[$this->footer_sidebar_count]);
        }
        $single_area = '';
        $this->footer_sidebar_count++;
    }
}
global $_mkSidebarGenerator;
$_mkSidebarGenerator = new mkSidebarGenerator;

add_action('widgets_init', array(
    $_mkSidebarGenerator,
    'register_sidebar'
));

function mk_sidebar_generator($function) {
    global $_mkSidebarGenerator;
    $args = array_slice(func_get_args() , 1);
    return call_user_func_array(array(&$_mkSidebarGenerator,
        $function
    ) , $args);
}
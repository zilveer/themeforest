<?php
namespace Handyman\Core;

/**
 * Class Sidebars
 * @package Handyman\Core
 */
class Sidebars{


    public static $single;


    public static $sidebar;


    /**
     *
     */
    public function __construct()
    {
        self::$single =& $this;

        // Allow shortcodes in sidebar
        add_filter('widget_text', 'do_shortcode');
    }


    /**
     * Check customizer and page template settings before allowing a sidebar to display
     *
     * @param boolean $layers_can_show
     * @param string $sidebar_id
     * @return bool
     */
    public function canShowSidebar($layers_can_show, $sidebar_id)
    {
        // We trust layes.
        if ($layers_can_show){
            return $layers_can_show;
        }
        return $layers_can_show;
    }


    /**
     *  Register theme sidebars
     */
    public function registerSidebars()
    {
        // Sidebar in inner pages. Placed above footer

        register_sidebar(array(
            'id' => 'obox-layers-builder-inner-header',
            'name' => __('Header Section', TL_DOMAIN),
            'description'   => __( 'This container appears on 404, Search pages. Use LayersWP Widgets for this sidebar.' , TL_DOMAIN ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="section-nav-title">',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'id' => 'obox-layers-builder-archive-header',
            'name' => __('Header Section - Archives', TL_DOMAIN),
            'description'   => __( 'This container appears on Single Post, Post List, Category and Tag pages. Use LayersWP Widgets for this sidebar.' , TL_DOMAIN ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h5 class="section-nav-title">',
            'after_title'   => '</h5>',
        ));

        register_sidebar(array(
            'id' => 'obox-layers-builder-prefooter',
            'name' => __('Pre-Footer Section', TL_DOMAIN),
            'description'   => __( 'This section appears just above the page footer. Use LayersWP Widgets for this sidebar.' , TL_DOMAIN ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h5 class="section-nav-title">',
            'after_title' => '</h5>',
        ));
    }


    /**
     * @return mixed
     */
    public static function getSidebar(){
        return self::$sidebar;
    }
}
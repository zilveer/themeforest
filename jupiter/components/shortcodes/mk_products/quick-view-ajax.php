<?php
class Mk_Woocommerce_Quick_View
{
    
    function __construct() {
        add_action('wp_ajax_nopriv_mk_woocommerce_quick_view', array(&$this,
            'quick_view_init'
        ));
        add_action('wp_ajax_mk_woocommerce_quick_view', array(&$this,
            'quick_view_init'
        ));

    }
    
    public function quick_view_init() {
        if (isset($_GET['id']) && !empty($_GET['id'])):
            echo $this->get_product_by_id($_GET['id']);
            wp_die();
        else:
           echo 'Product ID is empty!';
            wp_die();
        endif;
    }
    
    function get_product_by_id($id = false) {
        
        if (empty($id)) return false;

        if(method_exists('WPBMap', 'addAllMappedShortcodes')) {
             WPBMap::addAllMappedShortcodes();
        }
        
        $query = array(
            'post_type' => 'product',
            'p' => $id,
            'suppress_filters' => 0
        );
        $r = new WP_Query($query);
        
        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                echo mk_get_shortcode_view('mk_products', 'components/quick-view', true);
            endwhile;
        endif;
        wp_reset_query();
    }
}

new Mk_Woocommerce_Quick_View();
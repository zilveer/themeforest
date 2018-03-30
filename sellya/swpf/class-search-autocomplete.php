<?php
class sellya_product_auto_search {

    public static $instance;
    
    public function ajax_responder($data = '') {
        global $wpdb, $smof_data;
        
        $limit = !empty($smof_data['sellya_top_search_autosuggest_no']) && is_numeric($smof_data['sellya_top_search_autosuggest_no']) ? $smof_data['sellya_top_search_autosuggest_no'] : 10;
        
        $filter = $_GET['filter_name'];

        if (!empty($filter))
            $filter = urldecode($filter);

        $posts = $wpdb->get_results("select * from $wpdb->posts where post_type = 'product' and post_status = 'publish' and post_title like '%{$filter}%' LIMIT 0,{$limit}");

        $dataarr = array();
        if(!empty($posts))
        foreach ($posts as $post):

            $product = get_product($post->ID);
            $dataarr[] = array(
                'link' => get_permalink($product->id),
                'name' => $post->post_title,                
            );

        endforeach;
        
        $output = json_encode($dataarr);
        header('Content-Type: application/json');
        echo $output;
        die();
    }

    public function sellya_product_search_callback() {
        global $smof_data;
        if($smof_data['sellya_top_search_autosuggest_status'] == 1){
        ?>
        
            <script type="text/javascript">
                jQuery(function($) {

                    var ajaxurl = "<?php echo admin_url('admin-ajax.php') ?>";


                    $("#header #searchform #s").autocomplete({
                        delay: 0,
                        minLength: 2,
                        selectFirst: false,
                        scroll: false,
                        source: function(request, response) {
                            
                            $.ajax({
                                url: ajaxurl,
                                data: {filter_name: encodeURIComponent(request.term), action: 'ajax_product_search'},
                                dataType: 'json',
                                success: function(json) {

                                    response($.map(json, function(item) {
                                        return {
                                            label: item.name,
                                            link: item.link,
                                            thumb: item.thumb
                                        }
                                        })
                                    );
                                }
                            });

                        },
                        select: function(event, ui) {

                                window.location.href = ui.item.link;

                            return false;

                        }
                    });

                });
            </script>        
        <?php
        }
    }

    static function get_instance(){
        
        if(empty(self::$instance) 
            or !is_object(self::$instance) 
            or !(self::$instance instanceof sellya_product_auto_search)){
            
            return self::$instance = new sellya_product_auto_search();
        }
        
        return self::$instance;
        
    }
    
}

$sellya_auto_search = sellya_product_auto_search::get_instance();
add_action('wp_footer',array($sellya_auto_search,'sellya_product_search_callback'),20);
add_action('wp_ajax_ajax_product_search', array($sellya_auto_search, 'ajax_responder'));
add_action('wp_ajax_nopriv_ajax_product_search', array($sellya_auto_search, 'ajax_responder'));

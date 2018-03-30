<?php
$template_directory = get_template_directory_uri();
wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '', true);
wp_register_script('jquery.gmap', $template_directory . '/js/jquery.gmap.min.js', array('jquery', 'maps.google.com'), '', true);
wp_print_scripts('maps.google.com');
wp_print_scripts('jquery.gmap');

global $is_tf_blog_page;

if ( $is_tf_blog_page )
{
    $coords = explode(':', tfuse_options('page_map_blog'));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_blog');
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_blog');
}
elseif (is_front_page())
{
    $page_id = $post->ID;
    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
    {   
        $tmp_conf['post_id'] = $page_id;
        $coords = explode(':', tfuse_page_options('page_map','',$page_id));
        $coords_final = implode(', ', $coords);
        $tmp_conf['post_coords']['html']    = tfuse_page_options('map_text','',$page_id);
        $tmp_conf['post_coords']['zoom']    = tfuse_page_options('map_zoom','',$page_id);
    }
    else
    {   
        $tmp_conf['post_id'] = $post->ID;
        $coords = explode(':', tfuse_options('page_map'));
        $coords_final = implode(', ', $coords);
        $tmp_conf['post_coords']['html']    = tfuse_options('map_text');
        $tmp_conf['post_coords']['zoom']    = tfuse_options('map_zoom');
    }
}
elseif ( is_search() )
{
    $tmp_conf['post_id'] = $post->ID;
    $coords = explode(':', tfuse_options('page_map_search'));
    $coords_final = implode(', ', $coords);
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_search');
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_search');
}
elseif ( is_404() )
{
    $coords = explode(':', tfuse_options('page_map_404'));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_404');
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_404');
}
elseif ( is_tag() )
{
    $tmp_conf['post_id'] = $post->ID;
    $coords = explode(':', tfuse_options('page_map_tag'));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_tag');
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_tag');
}
elseif (is_category())
{
    $ID = get_query_var('cat');
    $coords = explode(':', tfuse_options('page_map_cat',null,$ID));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_cat',null,$ID);
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_cat',null,$ID);
}
elseif (is_tax())
{
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $ID = $term->term_id;
    $coords = explode(':', tfuse_options('page_map_cat',null,$ID));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_options('map_text_cat',null,$ID);
    $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_cat',null,$ID);
}
elseif (is_archive())
{
    if(isset($_GET['posts']) && $_GET['posts'] == 'all' && isset($_GET['post_type']) && $_GET['post_type'] == 'portfolio'){
        $coords = explode(':', tfuse_options('page_map_port_archive',null));
        $coords_final = implode(', ', $coords);
        $tmp_conf['post_coords']['html'] = tfuse_options('map_text_port_archive',null);
        $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_port_archive',null);
    }
    else{
        $coords = explode(':', tfuse_options('page_map_archive',null));
        $coords_final = implode(', ', $coords);
        $tmp_conf['post_coords']['html'] = tfuse_options('map_text_archive',null);
        $tmp_conf['post_coords']['zoom'] = tfuse_options('map_zoom_archive',null);
    }
}
elseif ( is_page() || is_single() )
{
    $tmp_conf['post_id'] = $post->ID;
    $coords = explode(':', tfuse_page_options('page_map'));
    $coords_final = implode(', ', $coords);
    $tmp_conf['post_coords']['html'] = tfuse_page_options('map_text');
    $tmp_conf['post_coords']['zoom'] = tfuse_page_options('map_zoom');
}
else $coords_final = '';

if( !empty($coords_final) ):
    $image = $template_directory.'/images/gmap_icon.png'; ?>
    <script>
        function initialize() {
            var myLatLng = new google.maps.LatLng(<?php echo $coords_final; ?>);
            var mapOptions = {
                zoom: <?php echo $tmp_conf['post_coords']['zoom']; ?>,
                scrollwheel: false,
                center: myLatLng  }
            var map = new google.maps.Map(document.getElementById('header_map'),mapOptions);
            var image = '<?php echo $image; ?>';
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                title: '<?php echo $tmp_conf['post_coords']['html']; ?>',
                map: map,
                icon: image});
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <div class="header_map">
        <div class="container">
            <div id="header_map" style="width:100%; height:460px;" class="map"></div>
        </div>
    </div>
<?php endif; ?>
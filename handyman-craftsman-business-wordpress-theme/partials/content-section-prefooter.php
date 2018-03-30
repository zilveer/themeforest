<?php
/**
 *  Sidebar just above the footer section
 */
use \Handyman\Front as F;
if( is_404()
   || is_search()
   || is_archive()
   || is_attachment()
   || (is_page_template('template-blog.php'))
   || is_single()
   || (is_home())
){

    $show_map  = F\tl_copt('footer-map-show');
    $show_form = F\tl_copt('footer-form7-show');

    if($show_form){
        get_template_part('partials/prefooter', 'form-part');
    }
    if($show_map){
        get_template_part('partials/prefooter', 'map-part');
    }

}elseif(is_page()){

    $show_map  = F\tl_copt('footer-cpage-map-show');
    $show_form = F\tl_copt('footer-cpage-form7-show');

    if($show_form){
        get_template_part('partials/prefooter', 'form-part');
    }
    if($show_map){
        get_template_part('partials/prefooter', 'map-part');
    }

}
<?php //get theme options
global $oswcPostTypes;

/*****************************************/
$postTypeId = get_post_type( $wp_query->post->ID );
if($oswcPostTypes->has_type($postTypeId, true)){
    oswc_get_template_part('single-review'); // show single review page
}else{
    oswc_get_template_part('single-normal'); // show single regular page
}
/*****************************************/
?>
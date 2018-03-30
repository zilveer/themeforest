<div class="box-sidebar-container">
<?php
global $post;
do_action('before_sidebar_hook');
if ($post) {
    if($post->post_type == 'estate'){
	    dynamic_sidebar('estate-widget-area');
    }else{
	    dynamic_sidebar('main-sidebar');
    }
}else{
	dynamic_sidebar('main-sidebar');
}
?>
</div>
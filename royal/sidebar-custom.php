<?php 
	$page_sidebar = etheme_get_custom_field('widget_area');
    if(function_exists('is_bbpress') && is_bbpress()){
        $page_sidebar = 'forum-sidebar';
    }
?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :   
	dynamic_sidebar($page_sidebar);  
else :   
	/* No widgets */  
endif; ?>
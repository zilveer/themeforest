<?php
$sidebar=th_theme_data('blog_sidebar_id');
if(!empty($sidebar)) {
    dynamic_sidebar($sidebar);
}
else {
    if ( is_active_sidebar( 'blog_sidebar' ) ) {
        dynamic_sidebar( 'blog_sidebar' );
    }
}
?>
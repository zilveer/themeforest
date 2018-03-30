<?php if(! defined('ABSPATH')){ return; }
/**
 * Single Social
 */

$show_social = get_post_meta( get_the_ID(), 'zn_show_social', true );
if('default' == $show_social){
    $show_social = zget_option('show_social', 'blog_options', false, false);
}

if( 'show' == $show_social ){

    // Load Generic Icons
    include(locate_template( 'components/blog/default-single-common/single-social-generic.php' ));

}
elseif( 'show_custom' == $show_social ){

    // Load Generic Icons
    include(locate_template( 'components/blog/default-single-common/single-social-custom.php' ));

}

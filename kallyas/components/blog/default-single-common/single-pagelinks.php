<?php if(! defined('ABSPATH')){ return; }
/**
 * Single Page Links
 */

wp_link_pages( array (
    'before' => '<div class="page-link kl-blog-post-pagelink"><span>' . __( 'Pages:', 'zn_framework' ) . '</span>',
    'after'  => '</div>'
) );

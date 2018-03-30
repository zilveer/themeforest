<?php
global $ttso;
$inline_editing = esc_attr( $ttso->st_inline_editing );

if ( 'true' == $inline_editing ) :
    if ( is_home() || is_single() )
        edit_post_link( __( '+ Edit this post' , 'tt_theme_framework' ), '<p class="edit-page-button">', '</p>' );
    else
        edit_post_link( __( '+ Edit this page' , 'tt_theme_framework' ), '<p class="edit-page-button">', '</p>' );
endif;
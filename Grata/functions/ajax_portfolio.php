<?php

if ( ! function_exists('usAjaxPortfolio'))
{
    function usAjaxPortfolio() {

	    if ( ! isset( $_POST['project_id'] ) OR empty( $_POST['project_id'] ) ) {
		    die();
	    }
	    $project_id = intval( $_POST['project_id'] );
	    $post = get_post( $project_id );
	    if ( empty( $post ) ) {
		    die();
	    }

        $content = apply_filters( 'the_content', $post->post_content );
        $content = str_replace( ']]>', ']]&gt;', $content );
        echo $content;

        die();
    }

    add_action( 'wp_ajax_nopriv_usAjaxPortfolio', 'usAjaxPortfolio' );
    add_action( 'wp_ajax_usAjaxPortfolio', 'usAjaxPortfolio' );
}

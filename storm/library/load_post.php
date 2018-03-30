<?php 
add_action( 'wp_ajax_bk_load_post', 'bk_ajax_load_post' );
add_action( 'wp_ajax_bk_blog_load_post', 'bk_ajax_blog_load_post' );
add_action('wp_ajax_nopriv_bk_load_post', 'bk_ajax_load_post');
add_action('wp_ajax_nopriv_bk_blog_load_post', 'bk_ajax_blog_load_post');
?>
<?php
/**
 * Ajax callback for attaching media to field
 *
 * @return void
 */
if ( ! function_exists( 'bk_ajax_load_post' ) ) {
    function bk_ajax_load_post() {
    
        $post_offset = isset( $_POST['post_offset'] ) ? $_POST['post_offset'] : 0;
        $postperpage = isset( $_POST['postperpage'] ) ? $_POST['postperpage'] : 0;
        $cat_id = isset( $_POST['cat_id'] ) ? $_POST['cat_id'] : 0;
        $display = isset( $_POST['display'] ) ? $_POST['display'] : 0;
    	$args = array(
            'cat' => $cat_id,
            'posts_per_page' => $postperpage,
            'offset' => $post_offset,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
            );
        query_posts($args);
        if(have_posts()) : while(have_posts()) : the_post();
            echo (bk_get_masonry_content($display));   
        endwhile;
        endif;
        die();
    }
}
/**
 * Ajax callback for attaching media to field
 *
 * @return void
 */
if ( ! function_exists( 'bk_ajax_blog_load_post' ) ) {
    function bk_ajax_blog_load_post() {
    
        $post_offset = isset( $_POST['post_offset'] ) ? $_POST['post_offset'] : 0;
        $postperpage = isset( $_POST['postperpage'] ) ? $_POST['postperpage'] : 0;
        $cat_id = isset( $_POST['cat_id'] ) ? $_POST['cat_id'] : 0;
        $display = isset( $_POST['display'] ) ? $_POST['display'] : 0;
        $size = isset( $_POST['size'] ) ? $_POST['size'] : 0;
    	$args = array(
            'cat' => $cat_id,
            'posts_per_page' => $postperpage,
            'post_status' => 'publish',
            'offset' => $post_offset,
            'orderby' => 'date',
            'order' => 'DESC'
            );
        query_posts($args);
        if(have_posts()) : while(have_posts()) : the_post();
            echo (bk_get_classic_blog_content($size, $display));    
        endwhile;
        endif;
        die();
    }
}


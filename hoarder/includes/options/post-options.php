<?php 

/**
 * Create the Post Options section
 */
add_action('admin_init', 'zilla_post_options');
function zilla_post_options(){
	$post_options['description'] = __('Here you can configure blog settings.', 'zilla');

    $options = array(
    	'prevnext' => 'Prev/Next',
    	'loadmore' => 'Load More'
    );

    $post_options[] = array('title' => __('Blog Pagination Style', 'zilla'),
                            'desc' => __('Select either "Load More" or "Prev/Next" pagination.', 'zilla'),
                            'type' => 'select',
                            'id' => 'post_pagination_type',
                            'options' => $options);

    // $post_options[] = array('title' => __('Show Featured Image', 'zilla'),
    //                         'desc' => __('Check this to show the featured image at the beginning of the post.', 'zilla'),
    //                         'type' => 'checkbox',
    //                         'id' => 'post_show_featured_image');

                                
    zilla_add_framework_page( 'Post Options', $post_options, 15 );
}

?>
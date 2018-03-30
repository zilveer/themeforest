<?php
add_action( 'init', 'mom_load_more_init' );
function mom_load_more_init() {
	// add scripts
        wp_register_script( 'mom_load_more', get_template_directory_uri().'/framework/ajax/load-more.js',  array('jquery'),'1.0',true);
	wp_localize_script( 'mom_load_more', 'MomLMore', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		'nomore' => __('No More Posts', 'theme'),
		)
	);
        wp_enqueue_script('mom_load_more');
	
        // ajax Action
        add_action( 'wp_ajax_mom_loadMore', 'mom_load_more' );  
        add_action( 'wp_ajax_nopriv_mom_loadMore', 'mom_load_more');
}

function mom_load_more () {
    $style = $_POST['style'];
    $share = $_POST['share'];
    $count = $_POST['number_of_posts'];
    $display = $_POST['display'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    $sort = isset($_POST['sort']) ? $_POST['sort'] : '';
    $orderby = isset($_POST['orderby']) ? $_POST['orderby'] : '';
    $offset = $_POST['offset'];
    $format = $_POST['format'];
    $excerpt_length = $_POST['excerpt_length'];
    $load_more_count = $_POST['load_more_count'];
    

// stay away from bad guys 
    $nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) { die ( 'Nope!' ); }
//post format
if ($format != '') {
$format = explode(',',$format);
$formats = array ();
foreach ($format as $f) {
$formats[] = 'post-format-'.$f;
}
$format = array(
array(
'taxonomy' => 'post_format',
'field' => 'slug',
'terms' => $formats,
'operator' => 'IN'
)
);
}
?>
<?php
if ($display == 'category') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'cat' => $category,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
} elseif ($display == 'tag') {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'tag_id' => $tag,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
} else {
$args = array(
'ignore_sticky_posts' => 1,
'posts_per_page' => $load_more_count,
'orderby' => $orderby,
'order' => $sort,
'tax_query' => $format,
'post_status' => 'publish',
'offset' => $offset,
); 
}
$query = new WP_Query( $args ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    mom_blog_post($style, $share, $excerpt_length);
endwhile; else: ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
exit();
}
<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Loop - Recipe 
 *
 * This is the default loop file, containing the looping logic for use in all templates
 * where a loop is required.
 *
 * To override this loop in a particular context (in all archives, for example), create a
 * duplicate of this file and rename it to `loop-archive.php`. Make any changes to this
 * new file and they will be reflected on all your archive screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
global $more; $more = 0; 
global $woo_options;
woo_loop_before();

// Fix for the WordPress 3.0 "paged" bug.
 if (isset($_POST['auth_name'])) { 
$author = $_POST['auth_name'];
}

if (isset($_POST['asc'])) { 
$order = "asc";

} 
else if (isset($_POST['desc'])) { 
$order = "desc";

}
$orderby =  (isset($_POST['select']) ? $_POST['select'] : null);
$number = isset($woo_options['woo_recipe_number_of_posts']);


if (is_page_template('template-recipes-list.php')){
 
$paged = 1;
if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
if ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
$paged = intval( $paged );

 
 if (isset($_GET['auth_name'])) { 

$query_args = array(
					'post_type' => 'recipe', 
					'posts_per_page' => -1, 
					'paged' => $paged, 
					'orderby' => $orderby, 
					'order' => $order,
					'author_name' => $author
					 
				);

 }
 else {
 	$query_args = array(
					'post_type' => 'recipe', 
					// 'posts_per_page' => $number, 
					'paged' => $paged, 
					'orderby' => $orderby, 
					'order' => $order,
					'author_name' => $author
					 
				);
 }

 
}	

else{
$paged = 1;
if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
if ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
$paged = intval( $paged );
$query_args = array(
					'post_type' => 'recipe', 
					'paged' => $paged,
					'author_name' => $author

				);

}

$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.

remove_filter( 'pre_get_posts', 'woo_exclude_categories_homepage', 10 );

query_posts( $query_args );
if ( have_posts() ) { $count = 0;
?>

<div class="fix"></div>

<?php
	while (have_posts()) { the_post(); $count++;
		dahz_get_template( 'content', 'content-recipelist' );
	} // End WHILE Loop
	
} else {
	dahz_get_template( 'content', 'content-noposts' );
} // End IF Statement


woo_loop_after();

woo_pagenav();
wp_reset_query();
?>
<?php
define('WP_USE_THEMES', false);
$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);
global $post;
$args = array(  'post_type'			=>'post',
				'posts_per_page' 	=> $_POST['perpage'],
				'paged' 			=> $_POST['paged'],
	);

$loadposts = new WP_Query($args);

$col_grid = $_POST['col_grid'];

while($loadposts->have_posts()){ $loadposts->the_post(); 
	echo '<div class="themeum-post-item col-sm-'.$col_grid.' masonery-post">';
	get_template_part( 'post-format/content', get_post_format() ); 
	echo '</div>';
}
wp_reset_postdata();
die();

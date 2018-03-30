<?php 
/**
 * index.php
 *
 * The main template file.
 */
 ?>

<?php get_header(); ?>

<?php 



	$blog_options = owlab_get_blog_options();
	
	if (array_key_exists('blog_index_layout', $blog_options)){
		include(locate_template(OWLAB_TEMPLATES . '/blog/'. $blog_options['blog_index_layout'] .'.php'));
	}else{
		include(locate_template(OWLAB_TEMPLATES . '/blog/grid.php'));
	}
	 
?>

<?php get_footer(); ?>
<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */

get_header(); ?>

	
	<?php if ( have_posts() ) {
		while ( have_posts() ){
			the_post(); 
				$type = get_post_type();
		} }
		if ($type === "post") get_template_part('post-archive', 'archive');
		if ($type === "portfolio") get_template_part('proj-archive', 'archive');
		?>

	
<?php get_footer(); ?>
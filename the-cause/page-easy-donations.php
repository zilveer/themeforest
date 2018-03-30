<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Easy Donations Plugin Page
	
*/

get_header();

if (have_posts()) : while (have_posts()) : the_post();

?>


<h2><?php the_title(); ?></h2>

<div>
			
<?php

the_content();

?>

</div>

<?php

endwhile; endif;

get_footer();

?>
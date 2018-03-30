<?php
/*
* Attachment Page
*/
?>
 
<?php get_header(); ?>

<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="fullpage-contents-wrap">
	<?php
		get_template_part( 'loop', 'attachment' );
	?>
</div>
<?php get_footer(); ?>
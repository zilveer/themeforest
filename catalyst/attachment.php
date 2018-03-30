<?php
/*
* Catalyst Attachment Page
*/
?>
 
<?php get_header(); ?>

<div class="contents-wrap float-left two-column">
	<?php
		get_template_part( 'loop', 'attachment' );
	?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
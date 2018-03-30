<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Wide Page
	
*/

get_header();

if (have_posts()) : while (have_posts()) : the_post();

?>


<h2><?php the_title(); ?></h2>  

<div>

<?php $postID = get_the_ID(); ?> 


<?php $postThumbnail = tb_get_thumbnail($postID, 'dfl'); ?>
<?php if ($postThumbnail) { ?>
	
<?php $imageFull = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full'); ?>
        
<div class="doubleFramed large alignleft">
	<a href="<?php echo $imageFull[0]; ?>" title="<?php echo $postTitle; ?>">
	<?php echo $postThumbnail; ?>
	</a>
</div>
<?php } ?>
			
<?php

the_content();

wp_link_pages();

endwhile; endif;

?>

</div>

<?php

get_footer();

?>
<?php 
	global $thumbnail_size;
?>

<?php if ( has_post_thumbnail() ) { ?>
<div class="post-image">
	<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>" title="<?php the_title(); ?>" rel="prettyPhoto">
		<?php the_post_thumbnail($thumbnail_size); ?>
	</a>
</div>
<?php }?>
		

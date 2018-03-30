<?php if ( has_post_thumbnail() ) {
	
	if(isset($image_size)){
		
		$image_size = $image_size;
		
	}else{
		
		$image_size = "full";
		
	}
	?>
	<div class="eltd-post-image">
		<a href="<?php echo flow_elated_get_post_link(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($image_size); ?>
		</a>
	</div>
<?php } ?>
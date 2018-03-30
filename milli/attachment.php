<?php 
	get_header();
	the_post();
	
	$format = get_post_format();
	if(!( $format )) 
		$format = 'standard';
	
	if( is_active_sidebar('primary') && get_post_meta( $post->ID, '_ebor_disable_sidebar', true ) !=='on' )	
		get_sidebar();
?>

<section id="content" class="clearfix">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php 
			if (wp_attachment_is_image($post->id)) :
				$att_image = wp_get_attachment_image_src( $post->id, "full");
		?>
		
		<a href="<?php echo $att_image[0];?>" class="view" title="<?php the_title(); ?>">
			<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" />
		</a>
			
		<?php 
			endif;
			
			the_title('<div class="break-30"></div><h2 class="article-title"><a href="'. get_permalink().'">','</a></h2>'); 
			
			the_content();
			wp_link_pages();
			
			if( comments_open() )
				comments_template();
		?>
	
	</article>

</section>

<?php	
	get_footer();
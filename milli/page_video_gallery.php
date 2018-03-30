<?php 
	/*
	Template Name: Page Video Gallery
	*/
	get_header();
	the_post();
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class('gallery-page'); ?>>
		
		<?php 
			the_content();
			wp_link_pages();
			
			if ( !( post_password_required() ) ) {
			
				if( get_the_content() )
					echo '<div class="break-30"></div>';
				
				get_template_part('loop/gallery', get_post_meta( $post->ID, '_ebor_video_gallery_type', true) );
			
			}
			
			if( function_exists('zilla_share') ) 
				zilla_share();
				
			if( comments_open() && get_post_meta( $post->ID, '_ebor_gallery_comments', true) == 'on' )
				comments_template();
		?>
		
		<div class="clear"></div><!--clear floats-->
		
	</article>
	
</section>
	
<?php	
	get_footer();
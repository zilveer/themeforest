<?php 
	/*
	Template Name: Page Image Gallery With Sidebar
	*/
	get_header();
	the_post();
	
	if( is_active_sidebar('gallery') && get_post_meta( $post->ID, '_ebor_disable_sidebar', true ) !=='on' ){
		get_sidebar('gallery');
		$sidebar = 'has-sidebar';
	} else {
		$sidebar = 'no-sidebar';
	}
?>

<section id="content" class="clearfix">
	
	<article id="page-<?php the_ID(); ?>" <?php post_class('gallery-page ' . $sidebar); ?>>
		
		<?php 
			the_content();
			wp_link_pages();
			
			if ( !( post_password_required() ) ) {
			
				if( get_the_content() )
					echo '<div class="break-30"></div>';
					
				get_template_part('loop/gallery', get_post_meta( $post->ID, '_ebor_gallery_type', 1) );
			
			}
			
			if( function_exists('zilla_share') ) 
				zilla_share();
				
			if( comments_open() && get_post_meta( $post->ID, '_ebor_gallery_comments', 1) == 'on' )
				comments_template();
		?>
		
		<div class="clear"></div><!--clear floats-->
		
	</article>
	
</section>
	
<?php	
	get_footer();
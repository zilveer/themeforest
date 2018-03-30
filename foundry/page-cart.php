<?php 
	get_header();
	the_post();
	
	$thumbnail = false;
	if( has_post_thumbnail() ){
		$thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image') );
	}
	
	echo ebor_get_page_title( 
		get_the_title(), 
		get_post_meta($post->ID, '_ebor_the_subtitle', 1), 
		get_post_meta($post->ID, '_ebor_page_title_icon', 1), 
		$thumbnail, 
		get_post_meta($post->ID, '_ebor_page_title_layout', 1) 
	);
?>

	<section id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="container">
		    <div class="row">
		        <div class="col-sm-12">
		        	<?php
		        		the_content();
		        		wp_link_pages();
		        	?>
		        </div>
		    </div>
		</div>
	</section>
	
<?php get_footer();
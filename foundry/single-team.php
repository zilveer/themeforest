<?php
	get_header();
	the_post();
	
	$thumbnail = false;
	if( has_post_thumbnail() ){
		$thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'full', 0, array('class' => 'background-image') );
	}
	
	//Page Title
	echo ebor_get_page_title( 
		get_option('team_title','Our Team'), 
		get_post_meta($post->ID, '_ebor_the_subtitle', 1), 
		get_post_meta($post->ID, '_ebor_page_title_icon', 1), 
		$thumbnail, 
		get_post_meta($post->ID, '_ebor_page_title_layout', 1) 
	);
?>

<section id="team-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
        	
            <div class="col-sm-7">
            	<?php get_template_part('inc/content-format', get_post_format()); ?>
            </div>
            
            <div class="post-snippet col-sm-5">
            
                <?php the_title('<a href="'. esc_url(get_permalink()) .'"><h4 class="mb0">', '</h4></a><span class="inline-block mb40 mb-xs-24">'. get_post_meta($post->ID, '_ebor_the_job_title', 1) .'</span>'); ?>
                
                <hr>
                
                <div class="post-content">
                	<?php the_content(); ?>
                	<?php get_template_part('inc/content-team','social'); ?>
                </div>
                
            </div><!--/post-snippet-->

        </div>
    </div>
</section>

<?php get_footer();
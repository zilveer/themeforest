<?php get_header(); ?>

<div id="project-<?php the_ID(); ?>" <?php post_class("inner single_project"); ?>>
	
	<?php
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	
	// Taxonomy
    $cats = get_the_terms($post->ID, 'projects');
    $count = count($cats);
	
	$url = get_post_meta(get_the_ID(), 'si_project_url', true);
	$project_img2 = get_post_meta(get_the_ID(), 'si_project_img_two', true);
	$project_img3 = get_post_meta(get_the_ID(), 'si_project_img_three', true);
	$project_img4 = get_post_meta(get_the_ID(), 'si_project_img_four', true);
	$project_img5 = get_post_meta(get_the_ID(), 'si_project_img_five', true);
	$project_img6 = get_post_meta(get_the_ID(), 'si_project_img_six', true);
	
	$imgFull = wp_get_attachment_image_src(get_post_thumbnail_id(), 'fullsize');
	
	?>
	
		<div class="project_thumb">
		
		<?php if ($imgFull) : ?>
					
            <a href="<?php echo $imgFull[0]; ?>" class="pretty prettyPhoto[enlarge]"><span><i class='icon-fullscreen'></i></span><img src="<?php echo $imgFull[0]; ?>" alt="<?php the_title(); ?>" /></a>
            
            <div id="project_images" class="none">
            
	           <?php if ($project_img2 != "") : ?><a href="<?php echo $project_img2; ?>" class="pretty prettyPhoto[enlarge]"><img src="<?php echo $project_img2; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?>
	            <?php if ($project_img3 != "") : ?><a href="<?php echo $project_img3; ?>" class="pretty prettyPhoto[enlarge]"><img src="<?php echo $project_img3; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?>
	            <?php if ($project_img4 != "") : ?><a href="<?php echo $project_img4; ?>" class="pretty prettyPhoto[enlarge]"><img src="<?php echo $project_img4; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?>
	            <?php if ($project_img5 != "") : ?><a href="<?php echo $project_img5; ?>" class="pretty prettyPhoto[enlarge]"><img src="<?php echo $project_img5; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?>
	            <?php if ($project_img6 != "") : ?><a href="<?php echo $project_img6; ?>" class="pretty prettyPhoto[enlarge]"><img src="<?php echo $project_img6; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?>
            
            </div>
            
        <?php else : ?>
        
            <p class="center"><?php _e("- No Image Defined -", "shorti"); ?></p>
            
        <?php endif; ?>
        
        </div>
        
        <div class="project_info">
        
	        <h1 class="project_title"><?php the_title(); ?></h1>
	        
			<div class="project_meta"><?php _e("Published under", "shorti"); ?> <?php echo shorti_taxonomies_terms_links(); ?>, <?php _e("on", "shorti"); ?> <?php the_time("l j, Y"); ?></div>
	        
	        <div class="project_body">
	        
		        <?php the_content(); ?>
		        
				<?php if ($url != "") { ?><a href="<?php echo $url; ?>" class="btn view" target="_blank"><?php _e("View Project", "shorti"); ?> <i class="icon-arrow-right"></i></a><?php } ?>
	        
	        </div>
        
        </div>
        
	<?php endwhile; endif; ?> 
	
</div>

<div id="post_other" class="inner">

	<div class="one-half">
	
		<?php comments_template('', true); ?>
		<div class="none"><?php comment_form(); ?></div>
	
	</div>
	
	<div class="one-half column-last">
	
		<?php shorti_similar_projects(); ?>
	
	</div>

</div>



<?php get_footer(); ?>
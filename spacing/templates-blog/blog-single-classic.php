<?php
// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_posted_by = $of_option[$prefix.'tr_posted_by'];
	$tr_on = $of_option[$prefix.'tr_on'];
	$tr_in = $of_option[$prefix.'tr_in'];
}else{			
	$tr_posted_by = __('Posted by', 'spacing');
	$tr_on = __('on', 'spacing');
	$tr_in = __('in', 'spacing');
}
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>        
        
	<?php	
		if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : 
			post_gallery(1); 
		endif;
	?>  
    
    <h1 class="post-title"><?php the_title(); ?></h1>
    
    <div class="classic-meta-section">
    	<?php echo $tr_posted_by ?> <span><?php the_author_posts_link(); ?></span> <?php echo $tr_on ?> <span><?php the_time('M d, Y'); ?></span> <?php echo $tr_in ?> <span><?php the_category(', '); ?></span>
    </div> 
    
    <div class="classic-content-holder">   
    
    	<?php the_content(); ?>	
    
    </div>
    
    <?php comments_template(); ?>  

    <?php endwhile; endif; ?>
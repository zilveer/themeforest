<?php
// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_posted_by = $of_option[$prefix.'tr_posted_by'];
	$tr_on = $of_option[$prefix.'tr_on'];
	$tr_in = $of_option[$prefix.'tr_in'];
	$tr_read_more = $of_option[$prefix.'tr_read_more'];
}else{			
	$tr_posted_by = __('Posted by', 'spacing');
	$tr_on = __('on', 'spacing');
	$tr_in = __('in', 'spacing');
	$tr_read_more = __('Read More', 'spacing');
}

$layout = get_post_meta(get_option('page_for_posts'), 'page_layout', true);
if($layout !== "fullwidth"){
	$img_size = "content-wide";
}else{
	$img_size = "homepage-slider";
}
?>
   
    <div class="classic-post-holder"> 
     
     	<?php if(has_post_thumbnail()){ ?>
        <div class="featured-image-holder">
        	<a class="opacity-hover" href="<?php the_permalink(); ?>"><?php the_post_thumbnail($img_size); ?></a>  
        </div>
        <?php } ?>
           	           
        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        
        <div class="classic-meta-section">
        	<?php echo $tr_posted_by ?> <span><?php the_author_posts_link(); ?></span> <?php echo $tr_on ?> <span><?php the_time('M d, Y'); ?></span> <?php echo $tr_in ?> <span><?php the_category(', '); ?></span>
        </div> 
        
        <?php the_content($tr_read_more.' →'); ?>
                         
    </div>
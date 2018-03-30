<?php
// Translation
$prefix = "st_"; 
if($of_option[$prefix.'translate']){	
	$tr_author = $of_option[$prefix.'tr_author'];
	$tr_posted_in = $of_option[$prefix.'tr_posted_in'];
	$tr_comment = $of_option[$prefix.'tr_comment'];
	$tr_comments = $of_option[$prefix.'tr_comments'];
	$tr_read_more = $of_option[$prefix.'tr_read_more'];
}else{			
	$tr_author = __('Author', 'spacing');
	$tr_posted_in = __('Posted in', 'spacing');
	$tr_comment = __('Comment', 'spacing');
	$tr_comments = __('Comments', 'spacing');
	$tr_read_more = __('Read More', 'spacing');
}

$layout = get_post_meta(get_option('page_for_posts'), 'page_layout', true);
if($layout !== "fullwidth"){
	$img_size = "content-wide";
}else{
	$img_size = "homepage-slider";
}
?>
	<div class="blog-default-holder">
	<div class="blog-default-meta two columns">
        
        <div class="boxes-holder clearfix">
            <div class="post-date-box">
                <span class="bold"><?php the_time('M d'); ?></span>
                <p><?php the_time('Y'); ?></p>
            </div>
            
            <a class="post-cn-box" href="<?php the_permalink(); ?>#comments">                        
                <span class="bold"><?php comments_number('0','1','%'); ?></span>
                <p><?php echo _n( $tr_comment , $tr_comments , get_comments_number() ); ?></p>
            </a>
        </div>
        
        <div class="post-meta-box">
            <p><span><?php echo $tr_author ?></span><?php the_author_posts_link(); ?></p>
            <p><span><?php echo $tr_posted_in ?></span><?php the_category(', '); ?></p>
            <?php post_tags() ?>
        </div>
    </div>
    
    <div class="<?php if($layout == "fullwidth"){echo "fourteen";}elseif($layout == "sidebar-both"){ echo "six"; }else{ echo "ten"; } ?> columns">
    	<div class="post-entry-holder">   
    	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
    	<div class="featured-image-holder">
        	<a class="opacity-hover" href="<?php the_permalink(); ?>"><?php the_post_thumbnail($img_size); ?></a>  
        </div>    
        <?php endif; ?>    	           
        <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        
        <?php the_content($tr_read_more.' →'); ?>       
        </div>          
    </div>
    </div>
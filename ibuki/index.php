<?php get_header(); ?>
<?php 
$options_ibuki = get_option('ibuki'); 
$blog_type = $options_ibuki['blog_type'];
$blog_masonry_container = $options_ibuki['blog_masonry_container'];

if($blog_type == 'masonry-blog'){
	$container_class = $blog_masonry_container;
} else if($blog_type == 'standard-blog'){
	$container_class = 'container';
} else {
	$container_class = 'container-fluid';
}

$cols = (!empty($options_ibuki['blog_masonry_columns'])) ? $options_ibuki['blog_masonry_columns'] : '3' ;

switch ($cols) {
case '4' :
	$span_num = '3';
break;
case '3' :
	$span_num = '4';
break;
case '2' :
	$span_num = '6';
break;
}

$alignment = (!empty($options_ibuki['blog_standard_sidebar_layout'])) ? $options_ibuki['blog_standard_sidebar_layout'] : 'no_side' ;
				
switch ($alignment) {
case 'right_side' :
	$align_sidebar = 'right_side';
	$align_main = 'left_side';
break;
			
case 'left_side' :
	$align_sidebar = 'left_side';
	$align_main = 'right_side';
break;
}

$align_content = null;
if($blog_type == 'standard-blog'){ 
	if($alignment == 'left_side' || $alignment == 'right_side') {
		$align_content = ' content-sidebar';
	}
}
?>

<div id="content">
<?php az_page_header(get_option('page_for_posts')); ?>

<section class="wrap_content">
<section id="blog" class="main-content <?php echo $options_ibuki['blog_type']; ?>">
<div class="<?php echo $container_class; ?><?php echo $align_content; ?>">
<div class="row">

<?php if($blog_type == 'masonry-blog'){ ?>
<div class="masonry-container isotope">
<?php } ?>

<?php if($blog_type == 'standard-blog'){ 
if($alignment == 'no_side') { ?>
	<div class="col-md-12">
		<div class="standard-container">
<?php }
else if($alignment == 'left_side' || $alignment == 'right_side') { ?>
	<div class="page-content col-md-9 <?php echo $align_main; ?>">
		<div class="standard-container">
<?php }
} ?>
            
<?php    
// Counter
$x= 0; 
?>
                
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php 
if ($blog_type=="center-blog" || $blog_type=="masonry-blog" || $blog_type=="standard-blog") {
	$classX = ($x%2) ? '' : '';
} else {
	$classX = ($x%2) ? ' reverse-layout' : '';
	$x++;
}
?>
              
<?php if($blog_type == 'listed-blog'){ ?>
<article <?php post_class('item-blog single-post-listed'.$classX.''); ?> id="post-<?php the_ID(); ?>">	
<div class="post-container"><?php $format = get_post_format(); get_template_part( 'content', $format ); ?></div>
</article>
<?php } else if($blog_type == 'center-blog'){ ?>
<article <?php post_class('item-blog single-post-center'); ?> id="post-<?php the_ID(); ?>">	
<div class="post-container"><?php $format = get_post_format(); get_template_part( 'content', $format ); ?></div>
</article>            
<?php } else if($blog_type == 'masonry-blog'){ $span_clm = $span_num; ?>
<article <?php post_class('item-blog single-post-masonry col-md-'.$span_clm.''); ?> id="post-<?php the_ID(); ?>">	
<div class="post-container"><?php $format = get_post_format(); get_template_part( 'content', $format ); ?></div>
</article>
<?php } else if($blog_type == 'standard-blog'){ ?>
<article <?php post_class('item-blog single-post-standard'); ?> id="post-<?php the_ID(); ?>">	
<div class="post-container"><?php $format = get_post_format(); get_template_part( 'content', $format ); ?></div>
</article>
<?php } ?>
        
<?php endwhile; endif; ?>

<?php if($blog_type == 'masonry-blog'){ ?>
</div>
<?php } ?>

<?php
if($blog_type == 'standard-blog'){ ?>
</div>
</div>
<?php if($alignment == 'left_side' || $alignment == 'right_side') { ?>
		<div class="col-md-3 page-sidebar <?php echo $align_sidebar; ?>">
			<aside id="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
<?php }
} ?>
              
</div> 
</div>
</section>
</section>

<?php az_pagination(); ?>
    
</div>
    
<?php get_footer(); ?>
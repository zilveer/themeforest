<?php get_header(); ?>

<!-- Title Bar -->	
<?php get_template_part('framework/inc/titlebar'); ?>
<!-- End: Title Bar -->

<?php 
global $single_img_size;
// Get Blog Layout from Theme Options
if($options_data['select_bloglayout'] == 'Blog Medium') { 
	$blogclass = 'blog-medium';
	$blogtype = 'medium';
	$single_img_size='standard';
} else {
	$blogclass = 'blog-large';
	$blogtype = 'large';
	$single_img_size='span12';
}

if($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != ''){
	$sidebar_pos = $options_data['select_blogsidebar'].' span9';
	$single_img_size='standard';
} else if(($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != '') || $options_data['select_bloglayout'] == 'Blog Medium'){
	$sidebar_pos = $options_data['select_blogsidebar'].' span9';
	$single_img_size='standard';
} else {
	$sidebar_pos ='span12';
	$single_img_size='span12';
}
?>
<div id="page-wrap" class="container">
	
	<div id="content" class="<?php echo $sidebar_pos; ?> single">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post clearfix <?php echo 'format-'.get_post_format(); ?>">					
					<div class="post-content-container">
						<div class="post-content">

							<?php if(get_post_format() != 'quote'){?>
										<div class="post-excerpt"><?php the_content(); ?></div>
							<?php } else {
								get_template_part( 'framework/inc/post-format/single', get_post_format() );
							}?>
					
						</div>

						<?php if($options_data['check_disablecomments'] !=0) { ?>
							<?php comments_template(); ?>
						<?php } ?>
						<?php if($options_data['check_postnavigation'] !=0) { ?>
						<div class="hr dotted" style="margin:0px 0px 10px!important;"></div>
							<div class="wrapper post-navigation">
								<div class="alignleft prev"><?php previous_post_link('%link'); ?></div>
								<div class="alignright next"><?php next_post_link('%link'); ?> </div>
							</div>
						<div class="hr dotted" style="margin:10px 0px 0px!important;"></div>
						<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				
		<?php endwhile; endif; ?>
	</div>

<?php if($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != ''){
		get_sidebar();
	} 
?>

</div>

<?php get_footer(); ?>

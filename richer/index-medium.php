<?php 
/**
 * Template Name: Medium Blog Page
 */
get_header(); ?>

<!-- Title Bar -->	
<?php get_template_part('framework/inc/titlebar'); ?>
<!-- End: Title Bar -->

<?php 
// Get Blog Layout from Theme Options
$blogtype = 'medium';
$thumbnail_size = 'standard';
if ($blogtype == 'medium') {
	$thumbnail_size = 'span4';
}
if ($blogtype == 'large') {
	$thumbnail_size = 'span12';
}
if ($blogtype == 'large' && $options_data['select_blogsidebar'] != 'none') {
	$thumbnail_size = 'standard';
}
if($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != ''){
	$sidebar_pos = $options_data['select_blogsidebar'].' span9';
} else {
	$sidebar_pos ='span12';
}
static $gal_id;

$video_height = '340';
$video_width = '470';
?>

<div id="page-wrap" class="container">
	<div id="content" class="span12 blog blog-medium">
			<?php
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$paged);
			if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post">
					<?php if(get_post_format() != 'quote') { get_template_part( 'framework/inc/post-format/content', get_post_format() ); } ?>
						<div class="wrapper">
							<?php if($options_data['check_big_date'] != 0 && $options_data['select_bloglayout'] != 'Blog Medium') :?>
								<div class="date">
									<h3><div class="border"><?php echo get_the_time('d'); ?></div></h3><span><?php echo get_the_time('F'); ?></span>
								</div>
							<?php endif;?>
							<div class="post-content-container">
								<div class="post-content">
									<?php if(get_post_format() != 'link') {?>
									<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
									<?php } else { ?>
									<h3 class="title"><a href="<?php echo esc_url(get_post_meta($post->ID, 'richer_post_url', true)); ?>"  target="_blank" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
									<?php } ?>
									<?php if(get_post_format() != 'quote'){?>
										<div class="post-excerpt"><?php if($options_data['text_excerptlength'] >= 0) {the_excerpt();} else {the_content();} ?></div>
									<?php } else {
										get_template_part( 'framework/inc/post-format/content', get_post_format() );
									}?>
								</div>
								<?php if($options_data['check_meta'] != 0) {?>
										<div class="post-meta"><?php get_template_part( 'framework/inc/meta' ); ?></div>
									<?php } ?>
									<?php if($options_data['check_readmore'] != "0") { ?>
										<div class="post-more"><a href="<?php the_permalink(); ?>" class="button medium default" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php printf( esc_attr__('Read more', 'richer'), the_title_attribute('echo=0') ); ?></a></div>
									<?php }?>
							</div>
						</div>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>
			<?php get_template_part( 'framework/inc/nav' ); ?>	
			<?php else : ?>
				
				<h2><?php _e('Not Found', 'richer') ?></h2>
				
			<?php endif; ?>
			<?php $wp_query = null; $wp_query = $temp;?>
	</div>

</div>

<?php get_footer(); ?>

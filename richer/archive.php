<?php get_header(); ?>

<!-- Title Bar -->	
<?php get_template_part('framework/inc/titlebar'); ?>
<!-- End: Title Bar -->

<?php 

// Get Blog Layout from Theme Options
if($options_data['select_bloglayout'] == 'Blog Medium') { 
	$blogclass = 'blog-medium';
	$blogtype = 'medium';
} elseif($options_data['select_bloglayout'] == 'Grid'){
	$blogclass = 'grid';
	wp_deregister_script('isotope-js');
	wp_register_script('isotope-js', get_template_directory_uri() . '/framework/js/isotope.js', 'jquery', '1.5', TRUE);
	wp_enqueue_script('isotope-js');
} elseif($options_data['select_bloglayout'] == 'List'){
	$blogclass = 'list';
} else {
	$blogclass = 'blog-large';
	$blogtype = 'large';
}
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
?>

<div id="page-wrap" class="container">
	<?php switch ($options_data['select_bloglayout']) {
		case 'Blog Fullwidth':
		case 'Blog Medium':
			?>
			<div id="content" class="<?php echo esc_attr($sidebar_pos); ?> blog <?php echo esc_attr($blogclass); ?>">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="post">
							<?php if(get_post_format() != 'quote') { get_template_part( 'framework/inc/post-format/content', get_post_format() ); } ?>
								<div class="clearfix">
									<?php if($options_data['check_big_date'] != 0) :?>
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
												<div class="post-excerpt"><?php the_excerpt(); ?></div>
											<?php } else {
												get_template_part( 'framework/inc/post-format/content', get_post_format() );
											}?>
										</div>
										<div class="wrapper">
											<?php if($options_data['check_readmore'] != "0") { ?>
												<div class="post-more"><a href="<?php the_permalink(); ?>" class="button medium default" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php printf( esc_attr__('Read more', 'richer'), the_title_attribute('echo=0') ); ?></a></div>
											<?php }?>
											<?php if($options_data['check_meta'] != 0) {?>
												<div class="post-meta"><?php get_template_part( 'framework/inc/meta' ); ?></div>
											<?php } ?>
										</div>
									</div>
								</div>
							<div class="clear"></div>
						</div>
					<?php endwhile; ?>
					
					<?php get_template_part( 'framework/inc/nav' ); ?>
						
					<?php else : ?>
						
						<h2><?php _e('Not Found', 'richer') ?></h2>
						
					<?php endif; ?>
			
			</div>
			<?php
			break;
		case 'Grid':?>
			<div id="content" class="<?php echo $sidebar_pos; ?> blog <?php echo $blogclass; ?>">
				<div class="row-fluid">
					<?php if (have_posts()) : while (have_posts()) : the_post(); 

						if(get_post_format() == 'quote'  || get_post_format() == 'link'){
							$post_class='author-pad-top';
						} else {
							$post_class='';
						}
					?>
					<div class="span4">
						<div class="post blog-item <?php echo $post_class;?>">
							<?php if(get_post_format() != 'quote'  && get_post_format() != 'link') { get_template_part( 'framework/inc/post-format/content', get_post_format() ); } ?>
								<?php if($options_data['check_meta'] != 0 && $options_data['check_author'] != 0){ ?>
									<div class="author">
										<div class="author-image"><?php echo get_avatar( get_the_author_meta('user_email'), '60', '' ); ?></div>
	            						<div class="name"><?php echo __('By','richer').' '.get_the_author(); ?> </div>  
	            					</div>
            					<?php }?>
								<div class="blog-item-description">
									<div class="post-content-container">
										<div class="post-content">
											<h6><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h6>
											<?php if($options_data['check_meta'] != 0 && $options_data['check_date'] != 0) :?>
												<div class="date"><span><?php echo get_the_time('F j, Y'); ?></span></div>
											<?php endif;?>
											<?php if(get_post_format() != 'quote'){?>
												<div class="post-excerpt"><?php the_excerpt(); ?><?php if($options_data['check_readmore'] != "0") { ?>
												<a href="<?php the_permalink(); ?>" class="more" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php printf( esc_attr__('Read more', 'richer'), the_title_attribute('echo=0') ); ?></a>
													<?php }?>
												</div>
											<?php } else {
												get_template_part( 'framework/inc/post-format/content', get_post_format() );
											}?>
										</div>
									</div>
								</div>
							<div class="clear"></div>
						</div>
					</div>
					<?php endwhile; ?>	
					<?php else : ?>
						
						<h2><?php _e('Not Found', 'richer') ?></h2>
						
					<?php endif; ?>
				</div><div class="clear"></div>
				<?php get_template_part( 'framework/inc/nav' ); ?>
			</div>
		<?php
		break;
		case 'List':?>
			<div id="content" class="<?php echo $sidebar_pos; ?> blog <?php echo $blogclass; ?>">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="post">
							<div class="wrapper">
								<?php if($options_data['check_big_date'] != 0) :?>
									<div class="date">
										<h3><div class="border"><?php echo get_the_time('d'); ?></div></h3><span><?php echo get_the_time('F'); ?></span>
									</div>
								<?php endif;?>
								<div class="post-content-container">
									<div class="post-content">
										<h3 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
										<?php if(get_post_format() != 'quote'){?>
											<div class="post-excerpt"><?php the_excerpt(); ?></div>
										<?php } else {
											get_template_part( 'framework/inc/post-format/content', get_post_format() );
										}?>
									</div>
									<div class="wrapper">
										<?php if($options_data['check_readmore'] != "0") { ?>
											<div class="post-more"><a href="<?php the_permalink(); ?>" class="button medium default" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php printf( esc_attr__('Read more', 'richer'), the_title_attribute('echo=0') ); ?></a></div>
										<?php }?>
										<?php if($options_data['check_meta'] != 0) {?>
											<div class="post-meta"><?php get_template_part( 'framework/inc/meta' ); ?></div>
										<?php } ?>
									</div>
								</div>
							</div>
						<div class="clear"></div>
					</div>
				<?php endwhile; ?>	
				<?php else : ?>
					<h2><?php _e('Not Found', 'richer') ?></h2>					
				<?php endif; ?>
				<div class="clear"></div>
				<?php get_template_part( 'framework/inc/nav' ); ?>
			</div>
		<?php
		break;
		default:
			# code...
			break;
	}?>

<?php if($options_data['select_blogsidebar'] != 'none' && $options_data['select_blogsidebar'] != ''){
		get_sidebar();
	} 
?>

</div>

<?php get_footer(); ?>

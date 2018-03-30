<?php get_header(); ?>
<?php get_template_part('framework/inc/titlebar');
$post_loop_count = 1;
$page = (get_query_var('paged')) ? get_query_var('paged') : 1; 
if($page > 1) $post_loop_count = ((int) ($page - 1) * (int) get_query_var('posts_per_page')) +1;
?>

<div id="page-wrap" class="container">
	<div id="content" class="<?php echo get_post_meta( get_option('page_for_posts'), 'richer_sidebar', true ); ?> span9 search">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">	
				<i class="icon mini alignleft circle" style="color:inherit;background-color:#ffffff;border-color:inherit;"><?php echo $post_loop_count++; ?></i>
				<div class="search-result post-content clearfix">
					<h3 class="title">
						<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'richer'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h3>
					<div class="post-meta"><?php get_template_part( 'framework/inc/meta' ); ?></div>
					<div class="search-content">
						<div class="search-excerpt"><?php the_excerpt(); ?></div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		<?php endwhile; ?>

		<?php get_template_part( 'framework/inc/nav' ); ?>
	
		<?php else : ?>
	
			<h2><?php _e('Not Found', 'richer') ?></h2>
	
		<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>

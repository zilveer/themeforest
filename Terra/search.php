<?php 
/**
 * Template Name: Search Template
 * 
 * @package WordPress
 */


get_header(); ?>


<?php if(is_archive() || is_search() || is_home()): ?>
	<div class="full_container_page_title">	
		<div class="container animationStart">		
			<div class="row no_bm">
				<div class="sixteen columns">
				    <?php boc_breadcrumbs(); ?>
					<div class="page_heading"><h1><?php echo (is_archive() ? single_cat_title() : (is_search() ? _e('Search results for:', 'Terra').' '. get_search_query(): (is_home() ? wp_title('') :'') ));?></h1></div>
				</div>		
			</div>
		</div>
	</div>
<?php else: ?>
<div class="h10"></div>
<?php endif; ?>



<div class="container animationStart startNow">
	<div class="row blog_list_page">

		<?php 
			// Check where sidebar should be
			$sidebar_left = false; 
			if(ot_get_option('sidebar_layout','right-sidebar')=='left-sidebar'){
				$sidebar_left=true;
			}
			// Place sidebar if it's left
			($sidebar_left ? get_sidebar() : '');
		?>

			<div class="twelve columns">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<!-- Post Loop Begin -->
					<div class="post_item clearfix">
					
						
							<h3 class="post_title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'Terra'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h3>
							
							<p class="post_meta mb10">
								<span class="calendar"><?php printf('%1$s', get_the_date()); ?></span>
								<span class="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID' )); ?>"><?php echo __('By ','Terra');?> <?php the_author_meta('display_name'); ?></a></span>
								<span class="comments"><?php  comments_popup_link( __('No comments yet','Terra'), __('1 comment','Terra'), __('% comments','Terra'), 'comments-link', __('Comments are Off','Terra'));?></span>
						<?php $categories = get_the_category_list(', '); ?>
						<?php if(!empty($categories)){?>
								<span class="tags"><?php echo $categories; ?></span> 
						<?php } ?>
							</p>

							<?php the_excerpt_max_charlength(230); ?>
							<div class="divider_bgr"></div>
						
					</div>
					<!-- Post Loop End -->
					
				<?php endwhile; ?>
				
				<?php boc_pagination($pages = '', $range = 2); ?>
				
				<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.','Terra'); ?></p>
				<?php endif; // Loop End  ?>
	
			</div>
		
		
		<?php // Place sidebar if it's right
			  (!$sidebar_left ? get_sidebar() : '');?>
		
	</div>	
</div>
	
<?php get_footer(); ?>	
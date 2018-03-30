<?php get_header(); ?>
<?php get_template_part('_subheader'); ?>

<div class="container fix <?php if(!wpb_option('sidebar-enable')) echo 'no-sidebar'; ?>">
	
	<?php if(!wpb_option('disable-archive-heading')): ?>
		<div id="page-title">
			<h2><?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e('Search results for','feather'); ?> <span>"<?php echo get_search_query(); ?>"</span></h2>
		</div><!--/page-title-->
	<?php endif; ?>
	
	<div id="content-part">
		<?php if(!have_posts()): ?>
		<article class="entry">
			<div class="pad">
				<div class="text">
					<h1><?php _e('No search results','feather'); ?></h1>
					<p><?php _e('The good news is you can try again.','feather'); ?></p>
					<form role="search" method="get" action="<?php echo home_url('/'); ?>">
						<div class="fix">
							<input type="text" value="" name="s" id="s" />
							<input type="submit" id="searchsubmit" value="<?php _e('Search','feather'); ?>" />
						</div>
					</form>
					<div class="clear"></div>
				</div>
			</div>
		</article>
		<?php endif; ?>
		<?php get_template_part('_loop'); ?>
	</div><!--/content-part-->
	
	<?php if(wpb_option('sidebar-enable')): ?>
		<div id="sidebar" class="sidebar-right">
			<?php get_sidebar(); ?>
		</div><!--/sidebar-->
	<?php endif; ?>
		
</div><!--/container-->

<?php get_footer(); ?>
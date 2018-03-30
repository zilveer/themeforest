<?php get_header(); ?>
<?php if ( !( (is_tax('types')) || (is_tax('product_tags')) || (is_tax('product-category')) ) ) { ?>
<div class="posts-wrap the_archive">
<?php } else { ?>
<div id="archive_grid_wrap">
<?php } ?>
	<?php if (have_posts()) : ?>
	<h2 class="post_title">
	<?php /* If this is a category */ if (is_category()) { ?>
		<?php _e('Category', 'designcrumbs'); ?> &#8220;<?php single_cat_title(); ?>&#8221;	
	<?php /* If this is a tag */ } elseif( is_tag() ) { ?>
		<?php _e('Posts tagged with', 'designcrumbs'); ?> &#8220;<?php single_tag_title(); ?>&#8221;  
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<?php _e('Archive for', 'designcrumbs'); ?> <?php the_time('F jS, Y'); ?>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<?php _e('Archive for', 'designcrumbs'); ?> <?php the_time('F, Y'); ?>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<?php _e('Archive for', 'designcrumbs'); ?> <?php the_time('Y'); ?>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<?php _e('Author Archive', 'designcrumbs'); ?>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<?php _e('Blog Archives', 'designcrumbs'); ?>
	<?php } elseif (is_tax()) { ?>
		<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
		<?php echo $term->name; ?>
	<?php }  ?>
	</h2>
	<?php if (term_description() != '') { ?>
		<div class="tax_description">
			<?php echo term_description(); ?> 
		</div>
	<?php }
	
	if (!((is_tax('types')) || (is_tax('product_tags')) || (is_tax('product-category')))) {
	
	while (have_posts()) : the_post(); ?>
     	<div class="post-archive_wrap">
     		<div <?php post_class('post-archive'); ?> id="post-<?php the_ID(); ?>">
				<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="archive_image_link">
					<?php the_post_thumbnail( 'archive_image', array( 'alt' => get_the_title()) ); ?>
				</a>
				<?php } ?>
				<h4 class="archive-entry-title">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h4>
				<div class="archive-meta">
					<span class="left"><?php _e('Posted in', 'designcrumbs'); ?> <?php the_category(', ') ?> <?php _e('by', 'designcrumbs'); ?> <?php the_author_posts_link(); ?> <?php _e('on', 'designcrumbs'); ?> <?php the_time('F d, Y'); ?></span>
					<span class="right"><?php comments_popup_link( __( 'No Comments', 'designcrumbs' ), __( '1 Comment', 'designcrumbs' ), __( '% Comments', 'designcrumbs' ), 'comments-link', __('Comments Closed', 'designcrumbs')); ?></span>
					<div class="clear"></div>
				</div><!-- end .archive-meta -->
			</div><!-- end .post -->
		</div><!-- end .post-archive_wrap -->
	<?php endwhile; ?>
	<?php } else { ?>
	<div id="archive_grid">
	<?php while (have_posts()) : the_post(); ?>
		
		<?php get_template_part( 'loop', 'gridproduct' ); ?>
		
	<?php endwhile; ?>
		<div class="clear"></div>
		</div><!-- end #archive_wrap -->
	<?php } ?>

		<div class="navigation">
			<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
			<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
			<div class="clear"></div>
		</div>

	<?php else : ?>

	<h2><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>
        
	<?php endif; ?>
</div><!-- end .posts-wrap or #archive_grid_wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
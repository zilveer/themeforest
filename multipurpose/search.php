<?php get_header(); ?>
<div class="main"><div>
	<?php if (have_posts() && strlen( trim(get_search_query()) ) != 0 ) :  ?>
		<?php while (have_posts()) : the_post(); ?>
			<!-- Start: Post -->
			<article <?php post_class(); ?>>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h2>
				<p class="post-meta"><?php the_time(get_option( 'date_format')) ?> <span>|</span> <?php esc_attr_e( 'by', 'multipurpose' );?> <?php the_author(); ?> <span>|</span> <?php the_category(", "); ?> <?php if ( comments_open() ) : ?><?php comments_popup_link('0', '1', '%', 'comment-link'); ?><?php endif; ?></p>
				<?php 
				$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
				if($iframe_video):
					echo '<p>'.$iframe_video.'</p>'; 
				else :
					if(has_post_thumbnail()): ?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a><?php endif;
				endif; ?>
				<?php the_excerpt(); ?>
				<?php if(has_tag()): ?><p class="tags"><?php esc_attr_e('Tags', 'multipurpose'); ?>: <?php the_tags(""); ?></p><?php endif; ?>
				<p class="more"><a href="<?php the_permalink() ?>"><?php esc_attr_e( 'Read more', 'multipurpose' );?></a></p>
			</article>
			<!-- End: Post -->
		<?php endwhile; ?>

		<nav class="project-nav">
			<span class="prev"><?php next_posts_link(esc_attr__('Previous Posts', 'multipurpose')) ?></span>
			<span class="next"><?php previous_posts_link(esc_attr__('Next posts', 'multipurpose')) ?></span>
		</nav>
	<?php else : ?>
	<div class="post">
		<h1><?php esc_attr_e( 'No posts found. Try a different search?', 'multipurpose' ); ?></h1>
		<?php get_search_form(); ?>
	</div>
	<?php endif; ?>
</div></div>
<?php 
$sidebar_position = $sidebar_pos_global;
if($sidebar_position != 2) {
	get_sidebar();	
}
?>
<?php get_footer(); ?>
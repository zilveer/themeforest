<?php get_header(); ?>
<section class="main postlist">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<!-- Start: Post -->
			<article <?php post_class(); ?>>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h2>
				<p class="post-meta"><?php the_time(get_option('date_format')) ?> <span>|</span> <?php esc_attr_e( 'by', 'multipurpose' );?> <?php the_author(); ?> <span>|</span> <?php the_category(", "); ?> <?php if ( comments_open() ) : ?><?php comments_popup_link('0', '1', '%', 'comment-link'); ?><?php endif; ?></p>
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
		<h2 class="center"><?php esc_attr_e( 'Not found', 'multipurpose' ); ?></h2>
		<p class="center"><?php esc_attr_e( 'Sorry, but you are looking for something that isn\'t here.', 'multipurpose' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>
<?php 
$sidebar_position = $sidebar_pos_global;
if($sidebar_position != 2) {
	$sidebar = get_post_meta(get_the_id(), 'custom_sidebar', true) ? get_post_meta(get_the_id(), 'custom_sidebar', true) : "default";
	if($sidebar != 'no') {
		if($sidebar && $sidebar != "default") get_sidebar("custom");
		else get_sidebar();	
	}
}
?>
<?php get_footer(); ?>

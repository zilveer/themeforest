<?php
/*
* Template name: Blog - full width image
*/
get_header(); ?>
<div class="postlist">
	<?php 
	if (have_posts()) :
		while (have_posts()) : the_post(); ?>
			<?php 
			$hide_title = get_post_meta(get_the_id(), 'hide_title', true);
			if(!$hide_title) : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
		<?php  wp_reset_postdata();
		endwhile; ?>
		<?php
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		?>
		<?php 
		$options = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $paged
			);
		$postlist = new WP_Query($options);
		if($postlist->have_posts()) :
			while($postlist->have_posts()): $postlist->the_post(); ?>
			<!-- Start: Post -->
			<?php 
			$classes = '';
			if (is_sticky(get_the_id())) $classes = "sticky";
			?>
			<article <?php post_class($classes); ?>>
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h2>
				<p class="post-meta"><?php the_time(get_option('date_format')) ?> <span>|</span> <?php esc_attr_e( 'by', 'multipurpose' );?> <?php the_author(); ?> <span>|</span> <?php the_category(", "); ?> <?php if ( comments_open() ) : ?><?php comments_popup_link('0', '1', '%', 'comment-link'); ?><?php endif; ?></p>
				<?php 
				$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
				if($iframe_video):
					echo '<p>'.$iframe_video.'</p>'; 
				else :
					if(has_post_thumbnail()): ?><div class="img"><a href="<?php the_permalink() ?>"><span class="img-border"><?php the_post_thumbnail('thumbnail-large'); ?></span></a></div><?php endif;
				endif; ?>
				<?php global $more; $more = 0; the_excerpt(); ?>
				<?php if(has_tag()): ?><p class="tags"><?php esc_attr_e('Tags', 'multipurpose'); ?>: <?php the_tags(""); ?></p><?php endif; ?>
				<p class="more"><a href="<?php the_permalink() ?>"><?php esc_attr_e( 'Read more', 'multipurpose' );?></a></p>
			</article>
			<!-- End: Post -->
		<?php endwhile; ?>

		<div class='wp-pagenavi'>
			<?php 
			global $wp_query;
			$big = 999999999;
			echo paginate_links(array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),  
		    	'format' => '/page/%#%',
				'current' => max( 1, $paged ),
				'total' => $postlist->max_num_pages,
				'prev_text' => esc_attr__('Previous page', 'multipurpose'),
				'next_text' => esc_attr__('Next page', 'multipurpose'),
			));
			 ?> 
		</div>
		<?php endif; ?>
	</div>
	<?php else : ?>
		<?php get_template_part('no-content'); ?>
	<?php endif; ?>
<?php get_footer(); ?>

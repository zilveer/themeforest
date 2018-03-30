<section class="main postlist">
<?php if (have_posts()) :
	
	get_template_part('archive-heading');

	while(have_posts()): the_post(); ?>
		<!-- Start: Post -->
		<article <?php post_class(); ?>>
			<div class="post-meta-exposed">
				<p class="post-date">
					<span class="day"><?php the_time('d') ?></span>
					<span class="month-year"><?php the_time('M') ?><br><?php the_time('Y') ?></span>
				</p>
				<?php if ( comments_open() ) : ?><?php comments_popup_link('0', '1', '%', 'comment-link'); ?><?php endif; ?>
			</div>
			<div class="the-post">
				<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h2>
				<p class="post-meta"> <?php esc_attr_e( 'by', 'multipurpose' );?> <?php the_author(); ?> <span>|</span> <?php the_category(", "); ?> <?php if(has_tag()): ?><span>|</span> <?php esc_attr_e('Tags', 'multipurpose'); ?>: <?php the_tags(""); ?><?php endif; ?> </p>
				<?php 
				$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
				if($iframe_video):
					echo '<p>'.$iframe_video.'</p>'; 
				else :
					if(has_post_thumbnail()): ?><div class="img"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div><?php endif;
				endif; ?>
				<?php the_excerpt(); ?>
				
				<p class="more"><a href="<?php the_permalink() ?>"><?php esc_attr_e( 'Read more', 'multipurpose' );?></a></p>
			</div>
		</article>
		<!-- End: Post -->
	<?php endwhile; ?>

	<div class='pager'>
		<?php 
		global $wp_query;
		$multipurpose_big = 999999999;
		echo paginate_links(array(
			'base' => str_replace( $multipurpose_big, '%#%', esc_url( get_pagenum_link( $multipurpose_big ) ) ),  
	    	'format' => '/page/%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'prev_text' => esc_attr__('Previous page', 'multipurpose'),
			'next_text' => esc_attr__('Next page', 'multipurpose'),
		));
		 ?> 
	</div>

<?php endif; ?>
</section>
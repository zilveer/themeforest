<?php 
global $qode_options;

$blog_hide_author = "";
if (isset($qode_options['blog_hide_author'])) {
    $blog_hide_author = $qode_options['blog_hide_author'];
}
?>
<article id="post-<?php the_ID(); ?>">
	<div class="post_content_holder">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post_image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('blog_image_in_grid'); ?>
				</a>
			</div>
		<?php } ?>
		<div class="post_text">
			<div class="post_text_inner">
				<div class="post_info">
					<span class="time">
						<span><?php the_time(get_option('date_format')); ?></span>
					</span>
					<?php $category = get_the_category(get_the_ID()); ?>
					<?php if(!empty($category)){ ?>
						<span class="post_category">
							<span><?php _e('In', 'qode'); ?></span>
							<span><?php the_category(', '); ?></span>
						</span>
					<?php } ?>
					<?php if($blog_hide_author == "no") { ?>
						<span class="post_author">
						<span><?php _e('By', 'qode'); ?></span>
							<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><span><?php the_author_meta('display_name'); ?></span></a>
						</span>
					<?php } ?>	
				</div>
				<div class="post_content">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php
						$my_excerpt = get_the_excerpt();
						if ($my_excerpt != '') {
							echo esc_html($my_excerpt);
						}
					?>
				</div>
			</div>
		</div>
	</div>
</article>
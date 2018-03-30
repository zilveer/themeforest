<?php
define('IS_POST', TRUE);

remove_shortcode('subsection');
add_shortcode('subsection', array($us_shortcodes, 'subsection_dummy'));

get_header();
if (have_posts()) : while(have_posts()) : the_post(); ?>
<section class="l-section">
	<div class="l-section-h g-html i-cf">
	
		<div class="l-content">

			<div <?php post_class("w-blog"); ?>>
			
				<div class="w-blog-preview"></div>
				
				<div class="w-blog-content">
				
					<h1 class="w-blog-title"><?php the_title(); ?></h1>
					
					<div class="w-blog-meta">
						<div class="w-blog-meta-date">
							<i class="fa fa-clock-o"></i>
							<span><?php echo get_the_date() ?></span>
						</div>
						<div class="w-blog-meta-author">
							<i class="fa fa-user"></i>
							<?php if (get_the_author_meta('url')) { ?>
								<a href="<?php echo esc_url( get_the_author_meta('url') ); ?>"><?php echo get_the_author() ?></a>
							<?php } else { ?>
								<span><?php echo get_the_author() ?></span>
							<?php } ?>
						</div>
						<div class="w-blog-meta-comments">
							<i class="fa fa-comments"></i>
							<?php comments_popup_link(__('No Comments', 'us'), __('1 Comment', 'us'), __('% Comments', 'us'), '', ''); ?>
						</div>
					</div>
					<div class="w-blog-text i-cf">
						<?php the_content(__('Read More &raquo;', 'us')); ?>
					</div>
				</div>
				<?php
				$tags = wp_get_post_tags($post->ID);
				if ($tags) {
					if ( ! isset($smof_data['post_meta_tags']) OR $smof_data['post_meta_tags'] == 1) { ?>
				<div class="w-tags">
					<span class="w-tags-title">Tags:</span>
					<?php foreach ($tags as $tag) { ?>
					<a class="w-tags-item-link" href="<?php echo get_tag_link($tag->term_id) ?>"><?php echo $tag->name ?></a><span class="w-tags-item-separator">,</span>
					<?php } ?>
				</div>
				<?php }
				} ?>
			</div>

			<?php if (comments_open()) { comments_template(); } ?>

		</div>

		<div class="l-sidebar">
			<?php if (@$smof_data['post_sidebar_pos'] != 'No Sidebar') {
				generated_dynamic_sidebar();
			} ?>
		</div>
		
	</div>
</section>
<?php endwhile; endif;
get_footer();
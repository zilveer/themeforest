<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-link-content-holder">
			<div class="mkd-post-image-text-holder" style="background-image:url('<?php the_post_thumbnail_url(); ?>')">
				<div class="mkd-post-text">
					<div class="mkd-post-text-inner">
						<div class="mkd-post-mark">
							<?php echo hue_mikado_icon_collections()->renderIcon('lnr-link', 'linear_icons'); ?>
						</div>
						<h1 class="mkd-post-title">
							<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"
							   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h1>
						<div class="mkd-post-info">
							<?php hue_mikado_post_info(array(
								'date'     => 'yes',
								'category' => 'no',
								'comments' => 'no',
								'like'     => 'no'
							)) ?>
						</div>
					</div>
				</div>
			</div>
			<div class="mkd-content-category-share-holder">
				<div class="mkd-content-holder">
					<?php the_content(); ?>
				</div>
				<div class="mkd-category-share-holder clearfix">
					<div class="mkd-categories-list">
						<?php hue_mikado_get_module_template_part('templates/parts/post-info-category', 'blog'); ?>
					</div>
					<div class="mkd-share-icons">
						<?php $post_info_array['share'] = hue_mikado_options()->getOptionValue('enable_social_share') == 'yes'; ?>
						<?php if ($post_info_array['share'] == 'yes'): ?>
							<span class="mkd-share-label"><?php esc_html_e('Share', 'hue'); ?></span>
						<?php endif; ?>
						<?php echo hue_mikado_get_social_share_html(array(
							'type'      => 'list',
							'icon_type' => 'normal'
						)); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('hue_mikado_before_blog_article_closed_tag'); ?>
</article>
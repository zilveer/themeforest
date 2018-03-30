<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="mkd-post-content">
		<div class="mkd-post-info-column">
			<div class="mkd-post-info-column-inner">
				<?php libero_mikado_post_info(array('date' => 'yes', 'comments' => 'yes', 'share' => 'yes')) ?>
			</div>
			<span class="mkd-post-sticky">
				<span class="icon_ribbon_alt mkd-sticky-icon"></span>
				<?php esc_html_e('Sticky','libero'); ?>
			</span>
		</div>
		<div class="mkd-post-content-column">
			<div class="mkd-post-text">
				<div class="mkd-post-text-inner">
					<?php libero_mikado_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
					<div class="mkd-post-info">
						<?php libero_mikado_post_info(array('author' => 'yes', 'category' => 'yes')) ?>
					</div>
					<?php
						libero_mikado_get_module_template_part('templates/lists/parts/image', 'blog');
						libero_mikado_excerpt();
                        $args_pages = array(
                            'before'           => '<div class="mkd-single-links-pages"><div class="mkd-single-links-pages-inner">',
                            'after'            => '</div></div>',
                            'link_before'      => '<span>',
                            'link_after'       => '</span>',
                            'pagelink'         => '%'
                        );
                        wp_link_pages($args_pages);
						libero_mikado_read_more_button();
					?>
				</div>
			</div>
		</div>
	</div>
</article>
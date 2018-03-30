<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="mkd-post-image">
		<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"
		   title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($image_size); ?>
		</a>
	</div>
	<div class="mkd-date-title">
		<?php hue_mikado_post_info(array('date' => 'yes')) ?>
		<h2 class="mkd-post-title">
			<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"
			   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</h2>
	</div>

	<span class="mkd-post-mark">
		<a href="<?php echo esc_html(get_post_meta(get_the_ID(), "mkd_post_link_link_meta", true)); ?>"
		   title="<?php the_title_attribute(); ?>">
			<?php echo hue_mikado_icon_collections()->renderIcon('lnr-link', 'linear_icons'); ?>
		</a>
	</span>
</article>
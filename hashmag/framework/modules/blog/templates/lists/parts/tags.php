<?php if(hashmag_mikado_options()->getOptionValue('blog_single_tags') == 'yes' && has_tag()){ ?>
	<div class="mkdf-single-tags-holder">
		<h6 class="mkdf-single-tags-title"><?php esc_html_e('POST TAGS:', 'hashmag'); ?></h6>
		<div class="mkdf-tags">
			<?php the_tags('', '', ''); ?>
		</div>
	</div>
<?php } ?>
<?php get_template_part('templates/page', 'head'); ?>
<div id="ourBlog">
    <div class="container">
        <div class="row">
			<?php if (is_404()): ?>
                <div class="span9">
			<?php else: ?>
                <div class="<?php echo roots_main_class()?>">
	        <?php endif;?>
			<?php if (have_posts()) : ?>
			<?php the_post(); ?>
            <div class="titleRow">
	            <?php echo do_shortcode('[header type="2" line="crossLine"]' . __('AUTHOR', 'ct_theme') . "[/header]");?>
            </div>
            <div class="row-fluid">
                <div class="span12">
	                <?php get_template_part('templates/content-author-box'); ?>
                </div>
            </div>

	        <?php echo do_shortcode('[header type="2" line="crossLine"]' . __('POSTS', 'ct_theme') . "[/header]");?>
			<?php rewind_posts(); ?>
			<?php get_template_part('templates/content', get_post($post) ? get_post_format() : false); ?>
			<?php endif; ?>
        </div>

			<?php if (roots_sidebar()): ?>
            <div class="<?php roots_sidebar_class(); ?>">
                <div class="blogSidebar">
					<?php get_template_part('templates/sidebar'); ?>
                </div>
            </div>
			<?php endif;?>
        </div>
    </div>
</div>
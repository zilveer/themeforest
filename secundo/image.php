<div id="ourBlog">
    <div class="container">
        <div class="row">
            <div class="<?php echo roots_main_class()?>">
				<?php get_template_part('templates/content', 'image'); ?>
            </div>

	        <?php if(roots_sidebar()):?>
                <div class="<?php roots_sidebar_class(); ?>">
	                <div class="blogSidebar">
                        <?php get_template_part('templates/sidebar'); ?>
		            </div>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php get_template_part('templates/post_single/content-meta'); ?>
<div class="post-content">
    <div class="post-abstract">
        <?php if (ct_get_option("posts_single_show_content", 1)): ?>
            <p><?php the_content();?></p>
	        <?php wp_link_pages(array('before' => '<nav class="pager">', 'after' => '</nav>')); ?>
        <?php endif;?>

    </div>
</div>
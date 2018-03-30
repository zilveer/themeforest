<div class="row-fluid">
	<?php while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	<?php wp_link_pages(array('before' => '<nav class="pager">', 'after' => '</nav>')); ?>

    <div class="patStd mainCommentsContainer">
        <div class="container">
            <div class="row-fluid">
	            <?php comments_template('/templates/comments.php'); ?>
            </div>
        </div>
    </div>
	<?php endwhile; ?>
</div>

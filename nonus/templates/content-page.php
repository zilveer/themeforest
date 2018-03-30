<?php while (have_posts()) : the_post(); ?>
<?php the_content(); ?>
<?php wp_link_pages(array('before' => '<nav class="pager">', 'after' => '</nav>')); ?>

<div class="row-fluid">
    <?php comments_template('/templates/comments.php'); ?>
</div>
<?php endwhile; ?>

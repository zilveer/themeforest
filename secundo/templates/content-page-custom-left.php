<div class="container">
    <div class="row-fluid">
        <div class="span3">
            <div class="blogSidebar">
				<?php get_template_part('templates/sidebar'); ?>
            </div>
        </div>
        <div class="span9">
			<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
            <div class="row-fluid">
				<?php comments_template('/templates/comments.php'); ?>
            </div>
			<?php endwhile; ?>
        </div>
    </div>
</div>

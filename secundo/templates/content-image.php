<?php while (have_posts()) : the_post(); ?>
<div class="singlePost">
	<?php if (ct_get_option("posts_single_show_date", 1)): ?><?php get_template_part('templates/content-date-header'); ?><?php endif;?>

	<?php if (ct_get_option("posts_single_show_image", 1)): ?><?php get_template_part('templates/content-featured-image'); ?><?php endif;?>

	<?php if (ct_get_option("posts_single_show_title", 1)): ?><h2><?php the_title();?></h2><?php endif;?>


	<span class="thumbanil corners">
	<?php echo wp_get_attachment_image(get_the_ID(), array(870, 1024))?>
		</span>
	<?php if (!empty($post->post_excerpt)) : ?>
    <div class="entry-caption">
		<?php the_excerpt(); ?>
    </div>
	<?php endif; ?>

	<?php if (ct_get_option("posts_single_show_content", 1)): ?><?php the_content(); ?><?php endif;?>

</div>
<?php if (ct_get_option("posts_single_show_socials", 1)): ?><?php comments_template('/templates/content-socials.php'); ?><?php endif; ?>
<?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
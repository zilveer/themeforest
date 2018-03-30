<?php while (have_posts()) : the_post(); ?>
<div class="singlePost">
	<?php if (ct_get_option("posts_single_show_image", 1)): ?>
	<?php get_template_part('templates/content-featured-image'); ?>
	<?php endif;?>

	<?php if (ct_get_option("posts_single_show_title", 1)): ?>
    <h1><?php the_title(); ?></h1>
	<?php endif;?>

    <p class="vgray">
		<?php $cats = get_the_terms(get_the_ID(), 'category');?>
		<?php if (ct_get_option("posts_single_show_date", 1)): ?>
	    <?php echo get_the_date(); ?>
		<?php endif;?>
		<?php if (ct_get_option("posts_single_show_date", 1) && ct_get_option("posts_single_show_categories", 1) && $cats): ?> | <?php endif;?>
		<?php if (ct_get_option("posts_single_show_categories", 1) && $cats): ?>
		<?php the_category(', ', '', get_the_ID()) ?>
		<?php endif;?>
		<?php if ((ct_get_option("posts_single_show_categories", 1) || ct_get_option("posts_single_show_date", 1)) && $cats && ct_get_option("posts_single_show_comments_link", 1)): ?> | <?php endif;?>
		<?php if (ct_get_option("posts_single_show_comments_link", 1)): ?>
        <a href="<?php the_permalink()?>#comments"><?php echo wp_count_comments(get_the_ID())->approved?> <?php echo __("comments", "ct_theme");?></a>
		<?php endif;?>
		<?php if ((ct_get_option("posts_single_show_comments_link", 1) || ct_get_option("posts_single_show_categories", 1) || ct_get_option("posts_single_show_date", 1)) && ct_get_option("posts_single_show_author", 1)): ?> | <?php endif;?>
		<?php if (ct_get_option("posts_single_show_author", 1)): ?>
		<?php echo __('Author', 'ct_theme'); ?>: <?php the_author_posts_link() ?>
		<?php endif;?>
    </p>

	<?php if (ct_get_option("posts_single_show_content", 1)): ?>
    <?php the_content();?>
	<?php wp_link_pages(array('before' => '<nav class="pager">', 'after' => '</nav>')); ?>
	<?php endif;?>
</div>
<br>
<?php if (ct_get_option("posts_single_show_socials", 1)): ?><?php get_template_part('/templates/content-socials'); ?><?php endif; ?>

<?php if (ct_get_option("posts_single_show_author_box", 1)): ?>
<br><br>
<div class="row-fluid">
    <div class="span12">
        <?php get_template_part('templates/content-author-box'); ?>
    </div>
</div>
<?php endif;?>

<br><br>
<?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
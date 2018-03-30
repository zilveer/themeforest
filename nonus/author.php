<?php
/*
Template Name: Author
*/
?>
</div>
<?php get_template_part('templates/page', 'head'); ?>
<?php $breadcrumbs = ct_show_index_post_breadcrumbs('post') ? 'yes' : 'no';?>
<?php $pageTitle = '';?>
<?php if (have_posts()) : ?>
		<?php the_post(); ?>
		<?php $pageTitle =  get_the_author(); ?>
		<?php rewind_posts(); ?>
<?php endif; ?>
<?php $pageTitle =  $pageTitle ? (__('Posts by', 'ct_theme') . ' ' . $pageTitle) : __('Posts', 'ct_theme');?>

<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<section id="BlogBody" class="container">
    <div class="row-fluid">
        <section id="Content" class="span7 offset2">
	        <p><?php the_author_meta('description'); ?></p>
	        <br>
	        <?php get_template_part('templates/content'); ?>
        </section>
	    <?php if (ct_use_blog_index_sidebar()): ?>
	        <section id="Sidebar" class="span3">
                <?php get_template_part('templates/sidebar'); ?>
            </section>
        <?php endif;?>
    </div>
</section>
<div class="container">









	<?php
	/*
	Template Name: Author
	*/
	get_template_part('templates/page', 'head'); ?>
	<?php $breadcrumbs = ct_show_index_post_breadcrumbs('post') ? 'yes' : 'no';?>
	<?php $pageTitle =  get_the_author() ? (__('Posts by', 'ct_theme') . ' ' . get_the_author()) : __('Posts', 'ct_theme');?>

	<?php if($pageTitle || $breadcrumbs == "yes"):?>
		<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
	<?php endif;?>

	<div class="row-fluid topSpace">
		<?php if (is_404()): ?><div class="span9"><?php else: ?><div class="span8"><?php endif;?>
			<p><?php the_author_meta('description'); ?></p>

			<div class="blogContent">
				<?php get_template_part('templates/content'); ?>
	        </div>
	    </div>
		<?php if (ct_use_blog_index_sidebar()): ?>
	    <div class="span3 offset1">
			<?php get_template_part('templates/sidebar'); ?>
	    </div>
		<?php endif;?>
	</div>


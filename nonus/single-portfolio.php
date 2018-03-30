</div>
<?php $breadcrumbs = ct_show_single_post_breadcrumbs('portfolio') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_single_post_title('portfolio');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<section class="container">
<?php get_template_part('templates/content', 'single-portfolio'); ?>
</section>

<div class="container">

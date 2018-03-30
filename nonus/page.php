<?php get_template_part('templates/page', 'head'); ?>
<?php $breadcrumbs = ct_show_single_post_breadcrumbs('page') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_single_post_title('page');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	</div>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
	<div class="container">
<?php endif;?>
<?php get_template_part('templates/content', 'page'); ?>

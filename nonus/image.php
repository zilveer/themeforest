<?php
/*
Template Name: Image
*/
?>
</div>
<?php get_template_part('templates/page', 'head'); ?>

<?php $breadcrumbs = ct_show_index_post_breadcrumbs('post') ? 'yes' : 'no';?>
<?php $pageTitle = ct_get_index_post_title('post');?>
<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<section id="BlogBody" class="container">
    <div class="row-fluid">
        <section id="Content" class="span7 offset2">
	        <?php get_template_part('templates/content', 'image'); ?>
        </section>
	    <?php if (ct_use_blog_index_sidebar()): ?>
	        <section id="Sidebar" class="span3">
                <?php get_template_part('templates/sidebar'); ?>
            </section>
        <?php endif;?>
    </div>
</section>
<div class="container">

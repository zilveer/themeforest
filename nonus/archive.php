<?php
/*
Template Name: Archives
*/
?>
</div>
<?php get_template_part('templates/page', 'head'); ?>

<?php $breadcrumbs = ct_show_index_post_breadcrumbs('post') ? 'yes' : 'no';?>
<?php
$pageTitle = __('Archive', 'ct_theme');
if (is_day()) {
	$pageTitle = __('Archive for', 'ct_theme') . ' ' . get_the_time(get_option('date_format'));
}
if (is_month()) {
	$pageTitle = __('Archive for', 'ct_theme') . ' ' . get_the_time('F, Y');
}
if (is_year()) {
	$pageTitle = __('Archive for', 'ct_theme') . ' ' . get_the_time('Y');
}
?>

<?php if($pageTitle || $breadcrumbs == "yes"):?>
	<?php echo do_shortcode('[title_row header="' . $pageTitle . '" breadcrumbs="' . $breadcrumbs . '"]')?>
<?php endif;?>

<section id="BlogBody" class="container">
    <div class="row-fluid">
        <section id="Content" class="span7 offset2">
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
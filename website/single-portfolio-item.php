<?php
/**
 * @package    WordPress
 * @subpackage Website
 * @since      1.0
 */
?>

<?php
	get_header();
	get_template_part('breadcrumbs', 'portfolio-item');
?>

<section id="content" class="<?php Website::contentClass(); ?>">
	<?php get_template_part('loop', 'portfolio-item'); ?>
</section>

<?php
	get_sidebar();
	get_footer();
?>
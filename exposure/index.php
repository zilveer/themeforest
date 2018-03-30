<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */
?>
<?php get_header(); ?>

<div class="wrapper full-width">
	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>
		
		<?php get_template_part('loop/blog', 'classic'); ?>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>
</div><!-- /.wrapper -->

<?php get_footer(); ?>
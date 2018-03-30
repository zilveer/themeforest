<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

get_header();

?>
<div class="wrapper">

	<?php
		if(have_posts()) :
			the_post();

			$pagetitle = get_the_author();
			$pagesubtitle = __("Author", 'thb_text_domain');
		?>

		<header class="pageheader">
			<h1><?php echo $pagetitle; ?></h1>
			<h2 class="meta"><?php echo $pagesubtitle; ?></h2>
		</header><!-- /.pageheader -->

	<?php endif; ?>

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

		<?php
			rewind_posts();
			get_template_part("loop/archive");
		?>
</div>
		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>
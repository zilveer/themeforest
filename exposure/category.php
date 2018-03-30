<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

get_header();

$pagetitle = single_cat_title( '', false );
$pagesubtitle = __("Category", 'thb_text_domain');

?>

<div class="wrapper">

	<header class="pageheader">
		<h1><?php echo $pagetitle; ?></h1>
		<h2 class="meta"><?php echo $pagesubtitle; ?></h2>
	</header><!-- /.pageheader -->

	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

		<?php get_template_part("loop/archive"); ?>

		<?php thb_page_end(); ?>

</div>

	<?php thb_page_after(); ?>

<?php get_footer(); ?>
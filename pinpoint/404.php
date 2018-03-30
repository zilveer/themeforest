<?php get_header(); ?>

<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
?>

<div class="page-heading full-width clearfix">
	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>
	<h1><?php _e("404", "swiftframework"); ?></h1>
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>
</div>

<?php if ($page_layout == "fullwidth") { ?>
<div class="container">
<div class="sixteen columns">
<?php } ?>
<div class="inner-page-wrap clearfix">

	<article class="help-text">
		<?php _e("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", "swiftframework"); ?> 
		<?php get_template_part('searchform'); ?>
		<a class="sf-button small accent slightlyroundedarrow" href="javascript:history.go(-1)" target="_self"><span><?php _e("Return to the previous page", "swiftframework"); ?></span><span class="arrow"></span></a>
	</article>
	
</div>

<?php if ($page_layout == "fullwidth") { ?>
</div>
</div>
<?php } ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>
<?php get_header(); ?>

<div class="page-heading clearfix">

	<h2><?php _e("404", "swiftframework"); ?></h2>
	
	<?php if(function_exists('bcn_display')) { ?>	
	<div class="breadcrumbs-wrap">
		<div id="breadcrumbs">
			<?php bcn_display(); ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="heading-divider"></div>
	
</div>

<div class="inner-page-wrap clearfix">

	<article class="help-text">
		<?php _e("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", "swiftframework"); ?> 
		<?php get_template_part('searchform'); ?>
		<a class="sf-button small accent slightlyroundedarrow" href="javascript:history.go(-1)" target="_self"><span><?php _e("Return to the previous page", "swiftframework"); ?></span><span class="arrow"></span></a>
	</article>
	
</div>

<!-- WordPress Hook -->
<?php get_footer(); ?>
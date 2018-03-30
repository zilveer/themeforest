<?php get_header(); ?>

<div class="inner-page-wrap row has-right-sidebar has-one-sidebar clearfix">

	<article class="help-text span8">
		<?php _e("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", "swiftframework"); ?> 
		<?php get_template_part('searchform'); ?>
		<a class="sf-button small accent slightlyroundedarrow" href="javascript:history.go(-1)" target="_self"><span><?php _e("Return to the previous page", "swiftframework"); ?></span><span class="arrow"></span></a>
	</article>
	
	<aside class="sidebar right-sidebar span4">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</aside>
	
</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
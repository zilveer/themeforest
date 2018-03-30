<?php get_header(); ?>

<div class="container">
	<div class="inner-page-wrap row has-right-sidebar has-one-sidebar clearfix">
	
		<article class="help-text col-sm-8">
			<?php _e("Sorry but we couldn't find the page you are looking for. Please check to make sure you've typed the URL correctly. You may also want to search for what you are looking for.", "swiftframework"); ?> 
			<form method="get" class="search-form" action="<?php echo home_url(); ?>/">
				<input type="text" placeholder="<?php _e("Search", "swiftframework"); ?>" name="s" />
			</form>
			<a class="sf-button small accent slightlyroundedarrow" href="javascript:history.go(-1)" target="_self"><span><?php _e("Return to the previous page", "swiftframework"); ?></span><span class="arrow"></span></a>
		</article>
		
		<aside class="sidebar right-sidebar col-sm-4">
			<?php dynamic_sidebar('sidebar-1'); ?>
		</aside>
		
	</div>
</div>

<!--// WordPress Hook //-->
<?php get_footer(); ?>
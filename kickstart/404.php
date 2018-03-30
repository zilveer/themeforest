<?php get_header('notitle'); ?>
<div id="container_bg">
	<div id="content_full" >
		<div id="post-0" class="post error404_content not-found hentry">
			<i class="moon-weather-lightning error404-icon"></i>
			<div class="error_title">
				<?php _e('Page Not Found', 'kickstart'); ?>
			</div>
			<p>
				<?php _e('The page you were looking for does not exist.', 'kickstart'); ?>
			</p>
			<?php get_search_form(); ?>
		</div><!-- #post -->
	</div><!-- #content -->
	<div class="clear"></div>

</div><!-- #container -->
<?php get_footer(); ?>
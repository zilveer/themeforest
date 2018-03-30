<?php get_header(); ?>
		
		<div id="content">
            <div class="sub-title"><?php _e('404 - Page Not Found!','cr'); ?></div>
			<div class="post page 404">

						<p><?php _e('Sorry, but the page you are looking for is no longer here. Please use the navigations or the search to find what what you are looking for.','cr'); ?></p>
				
							<form action="<?php echo home_url( '/' ); ?>" class="search-form clearfix">
								<fieldset>
									<input type="text" class="search-form-input text" name="s" onfocus="if (this.value == '<?php _e('Search','cr'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search','cr'); ?>';}" value="<?php _e('Search','cr'); ?>"/>
									<input type="submit" value="Go" class="submit" />
								</fieldset>
							</form>

			</div>
			
		</div><!--content-->
		
<!-- grab the sidebar -->
<?php get_sidebar(); ?>
	
<!-- grab footer -->
<?php get_footer(); ?>

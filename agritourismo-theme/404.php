<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>
<?php wp_reset_query(); ?>
<?php 
	if (is_pagetemplate_active("template-contact.php") || is_pagetemplate_active("template-contact-2.php")) {
		$contactPages = get_contact_page();
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		} else {
			$contactPages = get_contact_page2();
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = "#";
	}
?>

			<!-- BEGIN .content -->
			<div class="content">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<!-- BEGIN .main-block -->
					<div class="main-block big-error">

						<h2><?php _e("Error 404",THEME_NAME);?></h2>

						<strong><?php _e("Sorry, this page was not found.",THEME_NAME);?></strong>

						<span><?php printf(__('Someone probably spilled something on this page, so we have taken it to dry cleaning, but you can go back to <a href="%1$s">homepage</a> and find what you are looking for',THEME_NAME), home_url());?></span>

						<div class="error-glass"></div>

						<a href="<?php echo home_url();?>" class="button-link invert"><span class="icon-text left">&#9666;</span><?php _e("Back To Homepage",THEME_NAME);?></a>

					<!-- END .main-block -->
					</div>

				<!-- END .wrapper -->
				</div>
				
			<!-- BEGIN .content -->
			</div>
		
<?php get_footer(); ?>
<?php
/**
 * @KingSize 2014
 **/
get_header(); ?>

			<!--Page title start-->
			<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
			<div class="row header">
				<div class="twelve columns">
					<h2 class="title-page"><?php _e('Sorry! This page was not found.', 'kslang'); ?></h2>
				</div>
			</div>
			<?php } else { ?>
			<div class="row header">
				<div class="twelve columns">
					<h3 class="title-page"></h3>
				</div>
			</div>
			<?php } ?>					
			<!-- Ends Page title --> 
			  			 	
  			<!--Page title start-->
  			<?php if ( $data['wm_show_page_post_headers'] == "" || $data['wm_show_page_post_headers'] == "0" ) { ?>
				<div class="row">
					<div class="twelve columns">
						<h3 class=""><?php if ( $data['wm_custom_404_title']!= "" ) {?><?php echo $data['wm_custom_404_title'];?><?php } else { ?><?php _e('The page you\'re looking for isn\'t available...', 'kslang'); ?><?php } ?></h3>
					</div>
				</div>
			<?php } else { ?>
				<div class="row">
					<div class="twelve columns">
						<h3 class="title-page"></h3>
					</div>
				</div>
			<?php } ?>					
			<!-- Ends Page title --> 
			
			<!-- Begin Breadcrumbs -->
			<div class="row">
				<div class="twelve columns">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs" class="yoast-bc">','</p>');
					} ?>
				</div>
			</div>
			<!-- End Breadcrumbs -->
			
			<!--Blog Main Start-->					
			<div class="row">
				<div class="twelve columns">
						
							<p><?php if ( $data['wm_custom_404']!= "" ) {?><?php echo $data['wm_custom_404'];?><?php } else { ?><?php _e('We\'re very sorry for the inconvenience but the page you are looking for either no longer exists or has been moved. Try using the below search box or site index to locate what you\'re looking for.', 'kslang'); ?><?php } ?></p>
							
							<h3><?php _e('Search can help', 'kslang'); ?></h3>
							<p><?php _e('Please try searching using the search form below.', 'kslang'); ?></p>
							
							<div id="page_search">
								<?php get_search_form();?>	
							</div> 
						
							<div class="four columns">
							<h3><?php _e('Site Map', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_list_pages('depth=3&sort_column=menu_order&title_li='); ?></ul>
							</div>	
								
							<div class="four columns">
							<h3><?php _e('Categories', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_list_categories(); ?></ul>
							</div>

							<div class="four columns">
							<h3><?php _e('Archives', 'kslang'); ?></h3>
								<ul class="archives"><?php wp_get_archives(); ?></ul>
							</div>
     						
    		  		</div>	
      				<!-- row ends here -->
  			 </div>
  			 <!-- twelve columns ends here -->

<?php get_footer(); ?>
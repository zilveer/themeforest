<?php

get_header(); ?>

		<div class="container-col-w-sidebar">
    	<h1 class="main-h1"><?php _e('Error 404 - Not Found', 'om_theme') ?></h1>
    </div>
    <div class="clear"></div>
        
		<div class="container-col-w-sidebar">
			
			<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>

		</div>

		<div class="container-col-sidebar">
			<!-- Sidebar -->
			<div class="sidebar-inner">
			<?php
					get_sidebar();
			?>
			</div>
			<!-- /Sidebar -->
		</div>
		
		<div class="clear"></div>
		
<?php get_footer(); ?>
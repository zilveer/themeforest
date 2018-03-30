<?php

get_header(); ?>

		<div class="block-6 no-mar content-with-sidebar">
			
			<div class="block-6 bg-color-main">
				<div class="block-inner">
					<div class="tbl-bottom">
						<div class="tbl-td">
							<h1 class="page-h1"><?php _e('Error 404 - Not Found', 'om_theme') ?></h1>
						</div>
					</div>
					<div class="clear page-h1-divider"></div>
	      		
					<p><?php _e('Sorry, but you are looking for something that isn\'t here.', 'om_theme') ?></p>
					<p>&nbsp;</p>
					
				</div>
			</div>	
						
		</div>


		<div class="block-3 no-mar sidebar">
			<?php
					get_sidebar();
			?>
		</div>
		
		<!-- /Content -->
		
		<div class="clear anti-mar">&nbsp;</div>
	
<?php get_footer(); ?>
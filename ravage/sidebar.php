
		<!--BEGIN .sidebar four columns-->
		<aside class="sidebar span3">
	
		 	<!-- START nav -->
		    <nav class="clearfix">

		        <div class="container">
		            
		            <?php 
		                wp_nav_menu( array( 
		                    'theme_location' => 'main-menu', 
		                    'container' => '', 
		                    'before' => '',
		                ) ); 
		            ?>

		        </div>

		    </nav>
		    <!-- END nav -->
			
			<?php 
			if(!is_page()) :
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) : ?>
				
                <?php
				
				endif;
			else:
			/* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) : ?>
                
                <?php
				endif;
			endif;
			?>
		
		<!--END .sidebar .four columns-->
		</aside>
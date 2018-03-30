	                            
	                        <!--END .entry-content -->
	                        </div>     
	                          
					<!--END .post-->  
					</div>
	               
			<!--END main-content -->
			</section>


		<!--BEGIN .sidebar four columns-->
		<aside class="sidebar four columns bot-margin-triple">
			
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
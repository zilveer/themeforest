<?php
/**
 * @KingSize 2014
 **/
?>
				
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Blog Sidebar") ) : ?> 		
<!-- This sidebar will be shown if no widgets used -->	

	<!-- Sidebar item -->
   <div id="recent_posts" class="blog_section">     
  	 <h3><?php _e( 'Demo Sidebar', 'kslang' ); ?></h3>
		<p><?php _e( 'Currently there are no active sidebar widgets. To enable sidebar widgets go to <em>"Appearance > Widgets"', 'kslang' ); ?></em>.
		<p><?php _e( 'You can also import the demo widgets. Open the downloaded folder from Themeforest and open <em>"Documentation > Patches / Extras"</em> for details.', 'kslang' ); ?></p>
   </div>
<!-- Sidebar item ends here-->
    
<?php endif; ?>
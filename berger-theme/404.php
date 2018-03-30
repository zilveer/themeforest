<?php 

get_header(); 

global $clapat_bg_theme_options;


?>


    <!-- Content -->
    <div id="content">
	<div id="content-ajax">
        
        
        
        <!-- Main --> 
        <div id="main">
                
           	
            
            <div class="container text-align-center">
            
            	<!-- 404 Shortcode -->
                <div class="page-error">
                
                    <h1 class="title-has-line blink_me"><?php echo $clapat_bg_theme_options['clapat_bg_error_title']; ?></h1>
                    
                    <p class="monospace"><?php echo $clapat_bg_theme_options['clapat_bg_error_info']; ?></p>
                    
                    <a class="clapat-button" href="<?php echo esc_url( $clapat_bg_theme_options['clapat_bg_error_back_button_url'] ); ?>"><?php echo $clapat_bg_theme_options['clapat_bg_error_back_button']; ?></a>
                
                </div>
                <!-- 404 Shortcode -->
                
            </div>
            
    
    	</div>
        <!--/Main -->
        
        <?php get_template_part("sections/scroll_top_section"); ?>
            
	</div>
    </div>
	<!--/Content -->



<?php get_footer(); ?>
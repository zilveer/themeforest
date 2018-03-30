<div class="clear"></div>

			<footer role="contentinfo" class="content">
			<?php if ( is_active_sidebar('footer1') || is_active_sidebar('footer2') || is_active_sidebar('footer3') ): ?>
            
				<div id="footer-widgets" class="clearfix content">
				
                	<div class="row">
                    
                        <div id="footer1" class="sidebar four columns" role="complementary">
                        
                            <?php if ( is_active_sidebar( 'footer1' ) ) : ?>
        
                                <?php dynamic_sidebar( 'footer1' ); ?>
        
                            <?php endif; ?>
        
                        </div>
                        <div id="footer2" class="sidebar four columns" role="complementary">
                        
                            <?php if ( is_active_sidebar( 'footer2' ) ) : ?>
        
                                <?php dynamic_sidebar( 'footer2' ); ?>
        
                            <?php endif; ?>
        
                        </div>
                        <div id="footer3" class="sidebar four columns last" role="complementary">
                        
                            <?php if ( is_active_sidebar( 'footer3' ) ) : ?>
        
                                <?php dynamic_sidebar( 'footer3' ); ?>
        
                            <?php endif; ?>
        
                        </div>
                    
                    </div>
                    
                </div> <!-- end #footer widgets-->    
                
            <?php endif; ?>
                <div id="footer-copy">
                	
                    <div class="row">
		    <?php
                        echo apply_filters( 'qs_footer', of_get_option('qs_footer_text') );
                    ?>

                    </div>
                </div>
                    
				
				
				
			</footer> <!-- end footer -->
		
		
		
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		

                <?php include_once 'js/customjs.php'; ?>
                    
                <?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>
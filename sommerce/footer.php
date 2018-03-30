			        </div>
			        <!-- END PRIMARY SECTION -->
			        
			        <?php if ( yiw_get_option( 'newsletter_form_show' ) ) : ?>
			        <!-- START NEWSLETTER FORM -->
			        <div id="newsletter-form" class="group">
				    	
				    	<div class="inner">
				    	
							<?php 
                                $attrs = array();
                                $attrs[] = ' title="' .         yiw_get_option('newsletter_form_title') . '"';
                                $attrs[] = ' description="' .   yiw_get_option('newsletter_form_description') . '"';
                                $attrs[] = ' action="' .        yiw_get_option('newsletter_form_action') . '"'; 
                                $attrs[] = ' name="' .          yiw_get_option('newsletter_form_name') . '"';
                                $attrs[] = ' email="' .         yiw_get_option('newsletter_form_email') . '"';
                                $attrs[] = ' name_label="' .    yiw_get_option('newsletter_form_label_name') . '"';
                                $attrs[] = ' email_label="' .   yiw_get_option('newsletter_form_label_email') . '"';
                                $attrs[] = ' submit="' .        yiw_get_option('newsletter_form_label_submit') . '"';
                                $attrs[] = ' hidden_fields="' . yiw_get_option('newsletter_form_label_hidden_fields') . '"';
                                $attrs[] = ' method="' .        yiw_get_option('newsletter_form_method') . '"';
                                echo do_shortcode( '[newsletter_form' . implode( '', $attrs ) . ']' ); 
                            ?>
				        
				        </div>
								    
					</div>       
			        <!-- ENDSTART NEWSLETTER FORM -->
			        <?php endif; ?>
			        
			        <?php if ( yiw_get_option( 'show_footer' ) ) : ?>
			        <!-- START FOOTER -->
			        <div id="footer" class="group footer-<?php echo yiw_get_option( 'footer_layout' ); ?> columns-<?php echo yiw_get_option( 'footer_columns' ); ?>">
				    	
				    	<div class="inner">
				    	
							<div class="footer-main">
								<?php dynamic_sidebar( 'Footer Main' ) ?>
							</div>
							
							<?php if ( yiw_get_option( 'footer_layout' ) != 'no-sidebar' ) : ?>
							<div class="footer-sidebar">
								<?php dynamic_sidebar( 'Footer Sidebar' ) ?>
							</div>       
				        	<?php endif; ?>
				            
                            <div class="clear"></div>
				        </div>
								    
					</div>       
			        <!-- END FOOTER -->
			        <?php endif; ?>
					
					<?php $copyright_type = yiw_get_option( 'copyright_type' ); ?>
			        
			        <!-- START COPYRIGHT -->
			        <div id="copyright" class="group <?php echo $copyright_type ?>">
			        
			             <div class="inner group">
			        
        			        <?php if( $copyright_type == 'two-columns' ) : ?>
        			        
        			            <p class="left">
        			                <?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'copyright_text_left', 'Copyright <a href="%site_url%"><strong>%name_site%</strong></a> 2010' ) ) ) ) ?>
        			            </p>
        			            
        			            <p class="right">
        			                <?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'copyright_text_right', 'Powered by <a href="http://www.yourinspirationweb.com/en"><strong>Your Inspiration Web</strong></a>' ) ) ) ) ?>  
        			            </p>
        			            
        			        <?php elseif( $copyright_type == 'centered' ) : ?> 
        			        
        			            <!-- START NAVIGATION -->
                    		    <?php 
                    				$options = array(
                    		            'theme_location' => 'footer-nav',
                    		            'containter' => 'none',
                    		            'menu_id' => 'footer-nav',
                    		            'fallback_cb' => '',
                    		            'depth' => 1
                    		        );
                    		        
                    		        wp_nav_menu( $options )
                    			?>
                    		    <!-- END NAVIGATION --> 
        			            
        			            <p class="center">
        		                	<?php yiw_convertTags( do_shortcode( stripslashes( yiw_get_option( 'copyright_text_centered' ) ) ) ) ?>  
        			            </p>
        			            
        			        <?php endif ?>   
			        
			             </div>
			        
			        </div>
			        <!-- END COPYRIGHT -->          
		    
				</div>     
			    <!-- END BG WRAPPER --> 	      
		    
			</div>     
		    <!-- END WRAPPER --> 	 	      
		    
		</div>     
	    <!-- END LIGHT WRAPPER --> 
	
		<script type="text/javascript">
	        jQuery(document).ready(function($){
	            $("a[rel^='prettyPhoto']").prettyPhoto({
	                theme: '<?php echo yiw_get_option('portfolio_skin_lightbox') ?>'});
	        });
	    </script>         
	    
		<?php wp_footer() ?>  
	</body>
</html>
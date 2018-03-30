				<?php do_action( 'rt_content_after'); ?>			
	
				</div><!-- / end div .content_area -->  

				<?php 
					#
					# footer output
					# get templates footer content outputs
					# @hooked in /rt-framework/functions/theme_functions.php
					#				
					do_action( 'rt_footer_output');					
				?>


	        </div><!-- / end div .content_second_background -->  
	    </div><!-- / end div .content_holder -->  
	</div><!-- end div #container --> 

    <!-- footer -->
    <footer id="footer">
     
        <!-- footer info -->
        <div class="footer_info">       
                
            <!-- left side -->
            <div class="part1">

					<!-- footer nav -->
					<?php if ( has_nav_menu( 'rt-theme-footer-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
					    <?php  
						    //call the footer menu
						    $footermenuVars = array(							  
							   'depth'		 => 1,
							   'menu_id'         => 'footer_links',
							   'menu_class'      => 'footer_links', 
							   'echo'            => false,
							   'container'       => '', 
							   'container_class' => '', 
							   'container_id'    => '',
							   'theme_location'  => 'rt-theme-footer-navigation' 
						    );
						    
						    $footer_menu=wp_nav_menu($footermenuVars);
						    echo $footer_menu;
					    ?>
				    <?php else:?>
					    <?php  
						    //call the footer menu
						    $footermenuVars = array(
						       'menu'            => 'RT Theme Footer Navigation Menu', 
							   'depth'		 	 => 1,
							   'menu_id'         => 'footer_links',
							   'menu_class'      => 'footer_links', 
							   'echo'            => false,
							   'container'       => '', 
							   'container_class' => '', 
							   'container_id'    => '',
							   'theme_location'  => 'rt-theme-footer-navigation' 
						    );
						    
						    $footer_menu=wp_nav_menu($footermenuVars);
						    echo $footer_menu;
					    ?>
			  			<!-- / end ul .footer_links -->
		  			<?php endif;?>

					<!-- copyright text -->
					<div class="copyright"><?php echo do_shortcode(rt_wpml_t(RT_THEMESLUG, 'Footer Copyright Text', get_option(RT_THEMESLUG.'_footer_copy')));?>

					</div><!-- / end div .copyright -->	            
                
            </div><!-- / end div .part1 -->
            
			<!-- social media icons -->				
			<?php 
			//social media icons
			if(get_option(RT_THEMESLUG.'_social_media_bottom')){
				echo do_shortcode("[rt_social_media_icons]");
			}
			?><!-- / end ul .social_media_icons -->

        </div><!-- / end div .footer_info -->
            
    </footer>
    <!-- / footer -->


<?php echo get_option( RT_THEMESLUG.'_google_analytics');?>  
<?php echo stripcslashes(get_option(RT_THEMESLUG.'_space_for_footer'));?>

<?php wp_footer(); ?>
</body>
</html>
	<!-- footer --> 
	<?php if(get_option(THEMESLUG.'_show_footer_widgets')): ?> 
		<div class="content fullwidth clearfix">
			<div class="footer_widgets"> 
				<?php if (function_exists('dynamic_sidebar')){  dynamic_sidebar('sidebar-for-footer'); } ?>				
			</div> 			
		</div>
	<?php endif; ?>

	<div class="footer_pos_fix">
	<div class="transparent-line footer"></div><!-- transparent line -->
	<div id="footer" class="box-shadow">
	<footer>
	 
		<!-- footer info -->
		<div class="footer_info">		
				
				<!-- left side -->
				<div class="part1">

					<!-- footer nav -->
					<?php if ( has_nav_menu( 'rt-theme-footer-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
					    <?php  
						    //call the footer menu
						    $topmenuVars = array(							  
							   'depth'		 => 1,
							   'menu_id'         => '',
							   'menu_class'      => 'footer_links', 
							   'echo'            => false,
							   'container'       => '', 
							   'container_class' => '', 
							   'container_id'    => '',
							   'theme_location'  => 'rt-theme-footer-navigation' 
						    );
						    
						    $footer_menu=wp_nav_menu($topmenuVars);
						    echo add_class_first_item($footer_menu);
					    ?>
				    <?php else:?>
					    <?php  
						    //call the footer menu
						    $topmenuVars = array(
						       'menu'            => 'RT Theme Footer Navigation Menu', 
							   'depth'		 	 => 1,
							   'menu_id'         => '',
							   'menu_class'      => 'footer_links', 
							   'echo'            => false,
							   'container'       => '', 
							   'container_class' => '', 
							   'container_id'    => '',
							   'theme_location'  => 'rt-theme-footer-navigation' 
						    );
						    
						    $footer_menu=wp_nav_menu($topmenuVars);
						    echo add_class_first_item($footer_menu);
					    ?>
			  			<!-- / end ul .footer_links -->
		  			<?php endif;?>
					

					<!-- copyright text -->
					<div class="copyright"><?php echo do_shortcode(wpml_t(THEMESLUG, 'Footer Copyright Text', get_option(THEMESLUG.'_footer_copy')));?>
					</div><!-- / end div .copyright -->				
					
				</div><!-- / end div .part1 -->
				
				<!-- social media icons -->				
				<?php 
				//social media icons
				if(get_option(THEMESLUG.'_social_media_bottom')){
					echo do_shortcode("[rt_social_media_icons]");
				}
				?><!-- / end ul .social_media_icons -->

		</div><!-- / end div .footer_info -->
		
	</footer>
	<div class="clear"></div>
	</div><!--! end of div #footer -->
	</div><!--! end of div .footer_pos_fix -->

  </div><!-- end div #container -->

<?php echo get_option( THEMESLUG.'_google_analytics');?> 
<?php echo get_option(THEMESLUG.'_space_for_footer');?>
<?php wp_footer(); ?>
</body>
</html> 
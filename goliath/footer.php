
        <!-- Footer -->
		<footer class="container footer">
            <?php
                dynamic_sidebar('footer');
            ?>			
		</footer>
		
		<!-- Copyright -->
		<div class="container copyright">
			<div class="left">
				<?php echo get_wpml_admin_text_string('copyright'); ?>
			</div>
			<div class="right">
                <ul>
                    <?php plsh_language_selector_flags(); ?>
                    <?php
                        wp_nav_menu( array(
                            'menu'              => 'footer-menu',
                            'theme_location'    => 'footer-menu',
                            'depth'             => 1,
                            'container'         => false,
                            'container_class'   => '',
                            'container_id'      => '',
                            'menu_class'        => '',
                            'items_wrap'        => '%3$s',
                            'fallback_cb'       => false
                        ));
                    ?>
					<li>
                        <?php
						if(plsh_gs('show_footer_social') == 'on') {
						
							if(plsh_gs('social_facebook') != '')
							{
								echo '<a href="' . plsh_gs('social_facebook') . '" target="_blank"><i class="fa fa-facebook-square"></i></a>';
							}
							if(plsh_gs('social_twitter') != '')
							{
								echo '<a href="' . plsh_gs('social_twitter') . '" target="_blank"><i class="fa fa-twitter-square"></i></a>';
							}
							if(plsh_gs('social_youtube') != '')
							{
								echo '<a href="' . plsh_gs('social_youtube') . '" target="_blank"><i class="fa fa-youtube-square"></i></a>';
							}
							if(plsh_gs('social_pinterest') != '')
							{
								echo '<a href="' . plsh_gs('social_pinterest') . '" target="_blank"><i class="fa fa-pinterest-square"></i></a>';
							}
							if(plsh_gs('social_gplus') != '')
							{
								echo '<a href="' . plsh_gs('social_gplus') . '" target="_blank"><i class="fa fa-google-plus-square"></i></a>';
							}
							if(plsh_gs('social_instagram') != '')
							{
								echo '<a href="' . plsh_gs('social_instagram') . '" target="_blank"><i class="fa fa-instagram"></i></a> ';
							}
							if(plsh_gs('social_linkedin') != '')
							{
								echo '<a href="' . plsh_gs('social_linkedin') . '" target="_blank"><i class="fa fa-linkedin-square"></i></a> ';
							}
							if(plsh_gs('social_rss') != '')
							{
								echo '<a href="' . plsh_gs('social_rss') . '" target="_blank"><i class="fa fa-rss-square"></i></a>';
							}
							
						}
                        ?>
					</li>
				</ul>
			</div>
		</div>
		
		<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
        
        <?php wp_footer();?>
	<!-- END body -->
	</body>
	
<!-- END html -->
</html>
<?php
/**
 * @KingSize 2011
 **/
 global $data;
?>
	
            <!--Footer Start-->
    		<footer class="row">    

				<?php if ( $data['wm_show_footer'] == "1" ) { ?>
				<div class="row">
                    <div class="twelve columns centered" style="padding-left:30px; padding-right:30px;">
                        <hr>
                    </div>
                </div>
                
				<!-- Footer columns -->
                <div class="row">
                    <div class="twelve columns footer">
                        <div class="four mobile-four columns mobile-fullwidth">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column Left") ) : ?> 
                            <h3><?php _e('LEARN MORE', 'kslang'); ?></h3>
                            <ul class="side-nav bg-hover">
                                <li><a href="#"><?php _e('Blog', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                                <li><a href="#"><?php _e('Contact Us', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                                <li><a href="#"><?php _e('Portfolio', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                            </ul>
							<?php endif; ?>
                        </div> 
                        <div class="four mobile-four columns mobile-fullwidth">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column Center") ) : ?>
                            <h3><?php _e('GET IN TOUCH', 'kslang'); ?></h3>
                            <ul class="side-nav bg-hover">
                                <li><a href="#"><?php _e('Contact Us Today', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.denoizzed.com"><?php _e('Denoizzed', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                                <li><a href="http://www.ourwebmedia.com"><?php _e('Our Web Media', 'kslang'); ?></a></li>
                                <li class="divider"></li>
                            </ul>
							<?php endif; ?>
                        </div>
                        <div class="four mobile-four columns mobile-fullwidth">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Column Right") ) : ?>
                            <h3><?php _e('NEED TO KNOW', 'kslang'); ?></h3>
                            <ul class="side-nav">
                                <li class="active"><?php _e('&copy; 2010 - 2015, King Size WP. 
                                Include your tagline if you want to.
                                This footer is Widget Ready.', 'kslang'); ?></li>
                            </ul>
							<?php endif; ?>
                        </div> 
                    </div>
                </div> 
				<!-- Footer columns end here -->
				<?php } ?>
				
                <div class="row">
                    <div class="twelve columns centered" style="padding-left:30px; padding-right:30px;">
                    <hr>
                    </div>
                </div>

				<!-- Copyright / Social Footer Begins Here -->
                <div class="row">
                    <div class="twelve columns mobile-twelve copyright-footer">
                        <div class="six mobile-two columns">
                            <p class="copyright-text"><?php echo stripslashes($data['wm_footer_copyright']);?></p>
                        </div>
                        <div class="six mobile-two columns">
							<!-- SOCIAL ICONS -->
							<ul class="text-right inline footer-networks">
							 	<?php include (get_template_directory() . "/lib/social-networks-footer.php"); ?>
							</ul>
							<!-- SOCIAL ICONS -->
                        </div>
                    </div>
                </div>
				<!-- END Copyright / Social Footer Begins Here -->

            </footer>
       		<!--Footer Ends-->
       		
        </div><!-- /Nine columns ends-->
    	
    </div><!--/Main Content Ends-->
    
    <!-- Included JS Files (Compressed) -->
  	<script src="<?php echo get_template_directory_uri();?>/js/modernizr.foundation.js"></script>
  	<script src="<?php echo get_template_directory_uri();?>/js/jquery.foundation.tooltips.js"></script>
    
    <script src="<?php echo get_template_directory_uri();?>/js/tipsy.js"></script>
    <!-- Initialize JS Plugins -->
	<script src="<?php echo get_template_directory_uri();?>/js/app.js"></script>
	
	
	<?php wp_footer();?>

	<!-- GOOGLE ANALYTICS -->
	<?php include (get_template_directory() . "/lib/google-analytics-input.php"); ?>
	<!-- GOOGLE ANALYTICS -->

	<!-- Portfolio control CSS and JS-->
	<?php include (get_template_directory() . "/lib/footer_gallery.php"); ?>
	<!-- END Portfolio control CSS and JS-->

</body>
</html>

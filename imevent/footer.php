<div class="vc_row-full-width vc_clearfix"></div>
<?php global $theme_option; ?>
<?php 
    $footer_global = get_post_meta($wp_query->get_queried_object_id(), "_cmb_footer_global", true);
    if($footer_global != 'no'){
?>
    	<footer class="footer">
        <div class="footer-meta">
            <div class="container1 text-center">

                <?php 

                    if(isset($theme_option['footer']) && $theme_option['footer_style'] == 2)

                        echo wp_kses($theme_option['footer_square'],true);

                    else if(isset($theme_option['footer']) && $theme_option['footer_style'] == 1)
                        echo wp_kses($theme_option['footer_cricle'],true); 

                    else if(isset($theme_option['footer']) && $theme_option['footer'] != '' )
                        echo  wp_kses($theme_option['footer'],true);
                    else{ ?>

                	<div class="clearfix">
                		<ul class="social-line list-inline">
	                        <li data-animation="flipInY" data-animation-delay="100"><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="200"><a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="300"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="400"><a href="#" class="google"><i class="fa fa-google-plus"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="500"><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="600"><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
	                        <li data-animation="flipInY" data-animation-delay="700"><a href="#" class="skype"><i class="fa fa-skype"></i></a></li>
	                    </ul>
                	</div>                
                	<span class="copyright" data-animation="fadeInUp" data-animation-delay="100">&copy; 2014 im Event &#8212; An One Page Event Manager Theme made with passion by jThemes Studio</span>
                <?php } ?>

            </div>
        </div>
    </footer>
    
    <?php } ?>
    <!-- /FOOTER -->

	<?php if($theme_option['go_top']){ ?>
    	<div class="to-top"><i class="fa fa-angle-up"></i></div>
    <?php } ?>

</div> <!-- /wrapper -->
</div> <!-- /content-area -->
<?php wp_footer();?>
</body></html>
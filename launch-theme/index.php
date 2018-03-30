<?php get_header(); ?>

		<!-- SLIDER WRAP -->
        <div id="slider-wrap" class="clearfix">
			
			<!-- INNER WRAP -->
        	<div class="inner-wrap clearfix">
        		
				<!-- SLIDER -->
		        <div class="slider clearfix">
        			
					<?php 
					// Information Slide
					get_template_part( 'slides/info-slide' );	
					
					// Twitter Slide
					get_template_part( 'slides/twitter-slide' );
					
					// News Slide
					get_template_part( 'slides/news-slide' );
					
					// Contact Slide
					get_template_part( 'slides/contact-slide' );
					
					?>                    																														
                    
                </div>
                <!-- END OF SLIDER -->
				
            </div>
			<!-- END OF INNER WRAP -->
			
			<div class="slider-nave">
				<ul class="nav">
					<li><a href="#"><?php _e('LAUNCH INFO','framework'); ?></a></li>
					<li><a href="#"><?php _e('TWITTER FEED','framework'); ?></a></li>
					<li><a href="#"><?php _e('NEWS &amp; UPDATES','framework'); ?></a></li>
					<li><a href="#"><?php _e('CONTACT US','framework'); ?></a></li>
				</ul>
			</div><!-- end of .slider-nave -->
			
			<!-- PREVIOUS ARROW -->            
            <a class="prev-slide" href="#"></a>
			<!-- NEXT ARROW -->
            <a class="next-slide" href="#"></a>
			
        </div>
		<!-- END OF SLIDER WRAP -->

<?php get_footer(); ?>

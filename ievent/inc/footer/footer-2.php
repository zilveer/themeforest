<?php global $ievent_data;?>
    <!-- BOF Footer -->
	<!-- EOF Main -->
    <?php if($ievent_data['checkbox_infobox']): ?>
		<?php if (shortcode_exists('info_box')):?>
            <?php echo do_shortcode('[info_box icon_1="vc_li vc_li-location" title_1="'.$ievent_data['venue_location'].'" info_1="'.$ievent_data['venue_address'].'" icon_2="vc_li vc_li-world" title_2="'.$ievent_data['venue_phone'].'" info_2="'.$ievent_data['venue_email'].'"][/info_box]'); ?>
        <?php endif; ?>
    <?php endif; ?>
    
    <footer class="jx-ievent-footer-2 jx-ievent-footer-section jx-ievent-container">      	
        
        <div class="jx-ievent-footer-widget">        
        	<div class="container">        	
                    <div class="sixteen columns">
					
					<?php if ($ievent_data['footer-logo']): ?>
                    <div class="jx-ievent-footer-logo">
                    <img src="<?php echo esc_url($ievent_data['footer-logo']); ?>" alt="<?php bloginfo('name'); ?>" class="logo" /></div>
					<?php endif; ?>
                    <!-- EOF Logo -->

                    <?php if($ievent_data['checkbox_social_footer']): ?>
                        <div class="jx-ievent-footer-social">
                            <ul>
                                <?php if($ievent_data['text_facebook']): ?>
                                <li><a href="http://www.facebook.com/<?php echo esc_attr($ievent_data['text_facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_twitter']): ?>
                                <li><a href="http://www.twitter.com/<?php echo esc_attr($ievent_data['text_twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_youtube']): ?>
                                <li><a href="http://www.youtube.com/<?php echo esc_attr($ievent_data['text_youtube']); ?>"><i class="fa fa-youtube"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_googleplus']): ?>
                                <li><a href="http://www.googleplus.com/<?php echo esc_attr($ievent_data['text_googleplus']); ?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_dribbble']): ?>
                                <li><a href="http://www.dribbble.com/<?php echo esc_attr($ievent_data['text_dribbble']); ?>"><i class="fa fa-dribbble"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_instagram']): ?>
                                <li><a href="http://www.instagram.com/<?php echo esc_attr($ievent_data['text_instagram']); ?>"><i class="fa fa-instagram"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_pinterest']): ?>
                                <li><a href="http://www.pinterest.com/<?php echo esc_attr($ievent_data['text_pinterest']); ?>"><i class="fa fa-pinterest"></i></a></li>
                                <?php endif; ?>
                                <?php if($ievent_data['text_flickr']): ?>
                                <li><a href="http://www.flickr.com/<?php echo esc_attr($ievent_data['text_flickr']); ?>"><i class="fa fa-flickr"></i></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                           <!-- EOF Social -->
                           
                                            
                    <div class="jx-ievent-footer-copyright">
						<?php echo sprintf(esc_html__('%s', 'ievent'),$ievent_data['copyright']); ?> <a href="<?php get_site_url(); ?>"><?php bloginfo('name'); ?></a>
                    </div>
                       
                           
                    </div>
                    <!-- Widget#1 -->
            </div>
        </div>
		<!-- EOF Widgets -->		

    </footer>
     
    <!-- EOF Footer -->
    <?php echo $ievent_data['body_code']; // Space for code before body tag ?>
    <?php wp_footer(); ?>
    
</body>
</html>
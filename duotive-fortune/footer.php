<?php /* FOOTER TEMPLATE */ ?>
<!-- end of content wrapper -->
</section>
<footer id="website-footer">
	<?php $dt_FooterSharing = get_option('dt_FooterSharing','no'); ?>
    <?php if ( $dt_FooterSharing == 'yes' ) : ?>
		<?php $dt_FrontPageID = get_post_meta($post->ID, "front-page-template", true); ?>
        <?php $dt_FrontPageIntroOnly = get_option('dt_FrontPageIntroOnly_'.$dt_FrontPageID, 'no'); ?>
        <?php $dt_Footer = get_option('dt_Footer','no'); ?>    
        <div id="footer-sharing-wrapper" class="clearfix<?php if ( $dt_FrontPageIntroOnly == 'yes' && is_page_template('frontpage-base.php') ) echo ' footer-sharing-wrapper-introonly'; ?>">
	        <?php $dt_FooterSharingHeading = get_option('dt_FooterSharingHeading',''); ?>
            <?php if ( $dt_FooterSharingHeading != '' ): ?>
            <h6><?php echo $dt_FooterSharingHeading; ?></h6>
            <?php endif; ?>
                <div id="footer-sharing">
                    <?php if ( get_option('dt_FooterSharingDeviantart') != '' ): ?>
                        <a href="<?php echo get_option('dt_FooterSharingDeviantart'); ?>" class="social-item deviantart" title="Deviantart" target="_blank"><span class="normal"></span><span class="hover"></span>Deviantart</a>
                    <?php endif; ?>
                    <?php if ( get_option('dt_FooterSharingFacebook') != '' ): ?>                    
                        <a href="<?php echo get_option('dt_FooterSharingFacebook'); ?>" class="social-item facebook" title="Facebook" target="_blank"><span class="normal"></span><span class="hover"></span>Facebook</a>	
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingFlickr') != '' ): ?>                    
                        <a href="<?php echo get_option('dt_FooterSharingFlickr'); ?>" class="social-item flickr" title="Flickr" target="_blank"><span class="normal"></span><span class="hover"></span>Flickr</a>
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingMyspace') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingMyspace'); ?>" class="social-item myspace" title="Myspace" target="_blank"><span class="normal"></span><span class="hover"></span>Myspace</a>
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingRss') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingRss'); ?>" class="social-item rss" title="RSS" target="_blank"><span class="normal"></span><span class="hover"></span>RSS</a>
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingTwitter') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingTwitter'); ?>" class="social-item twitter" title="Twitter" target="_blank"><span class="normal"></span><span class="hover"></span>Twitter</a>
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingVimeo') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingVimeo'); ?>" class="social-item vimeo" title="Vimeo" target="_blank"><span class="normal"></span><span class="hover"></span>Vimeo</a>
                    <?php endif; ?>	                    
                    <?php if ( get_option('dt_FooterSharingYoutube') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingYoutube'); ?>" class="social-item youtube" title="Youtube" target="_blank"><span class="normal"></span><span class="hover"></span>Youtube</a>
                    <?php endif; ?>
					<?php if ( get_option('dt_FooterSharingReddit') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingReddit'); ?>" class="social-item reedit" title="Reedit" target="_blank"><span class="normal"></span><span class="hover"></span>Reedit</a>
                    <?php endif; ?> 
                    <?php if ( get_option('dt_FooterSharingStumbleUpon') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingStumbleUpon'); ?>" class="social-item stumpleupon" title="StumpleUpon" target="_blank"><span class="normal"></span><span class="hover"></span>StumpleUpon</a>
                    <?php endif; ?> 
                    <?php if ( get_option('dt_FooterSharingSoundCloud') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingSoundCloud'); ?>" class="social-item soundcloud" title="SoundCloud" target="_blank"><span class="normal"></span><span class="hover"></span>SoundCloud</a>
                    <?php endif; ?> 
                    <?php if ( get_option('dt_FooterSharingGooglePlus') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingGooglePlus'); ?>" class="social-item googleplus" title="Google+" target="_blank"><span class="normal"></span><span class="hover"></span>Google+</a>
                    <?php endif; ?>   
                    <?php if ( get_option('dt_FooterSharingLinkedIn') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingLinkedIn'); ?>" class="social-item linkedin" title="LinkedIn" target="_blank"><span class="normal"></span><span class="hover"></span>LinkedIn</a>
                    <?php endif; ?> 
                    <?php if ( get_option('dt_FooterSharingDelicious') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingDelicious'); ?>" class="social-item delicious" title="Delicious" target="_blank"><span class="normal"></span><span class="hover"></span>Delicious</a>
                    <?php endif; ?>   
                    <?php if ( get_option('dt_FooterSharingDigg') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingDigg'); ?>" class="social-item digg" title="Digg" target="_blank"><span class="normal"></span><span class="hover"></span>Digg</a>
                    <?php endif; ?>   
                    <?php if ( get_option('dt_FooterSharingTechnorati') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingTechnorati'); ?>" class="social-item technorati" title="Technorati" target="_blank"><span class="normal"></span><span class="hover"></span>Technorati</a>
                    <?php endif; ?>
                    <?php if ( get_option('dt_FooterSharingSkype') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingSkype'); ?>" class="social-item skype" title="Skype" target="_blank"><span class="normal"></span><span class="hover"></span>Skype</a>
                    <?php endif; ?>                                                                                                            
                    <?php if ( get_option('dt_FooterSharingBlogger') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingBlogger'); ?>" class="social-item blogger" title="Blogger" target="_blank"><span class="normal"></span><span class="hover"></span>Blogger</a>
                    <?php endif; ?> 
                    <?php if ( get_option('dt_FooterSharingPicasa') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingPicasa'); ?>" class="social-item picasa" title="Picasa" target="_blank"><span class="normal"></span><span class="hover"></span>Picasa</a>
                    <?php endif; ?>
                    <?php if ( get_option('dt_FooterSharingDribble') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingDribble'); ?>" class="social-item dribble" title="Dribbble" target="_blank"><span class="normal"></span><span class="hover"></span>Dribbble</a>
                    <?php endif; ?>
                    <?php if ( get_option('dt_FooterSharingModelMayhem') != '' ): ?>                
                        <a href="<?php echo get_option('dt_FooterSharingModelMayhem'); ?>" class="social-item modelmayhem" title="ModelMayhem" target="_blank"><span class="normal"></span><span class="hover"></span>ModelMayhem</a>
                    <?php endif; ?>                        
                <!-- end of footer sharing -->                                       
                </div> 
        <!-- end of footer sharing wrapper -->
        </div>
	<?php endif; ?>
    <?php $dt_Footer = get_option('dt_Footer','no'); ?>
    <?php $dt_FrontPageID = get_post_meta($post->ID, "front-page-template", true); ?>
    <?php $dt_FrontPageIntroOnly = get_option('dt_FrontPageIntroOnly_'.$dt_FrontPageID, 'no'); ?>
    <?php if ( $dt_Footer == 'yes' ): ?>
		<div id="footer">
        	<?php if ( !is_page_template('frontpage-base.php') && $dt_FooterSharing == 'no' || $dt_FrontPageIntroOnly == 'no' && is_page_template('frontpage-base.php')) : ?>
            	<div class="footer-content-sep"></div>
            <?php endif; ?>
            <?php $dt_FooterTabs = get_option('dt_FooterTabs','disabled'); ?>
            <?php if ( $dt_FooterTabs != 'disabled' ): ?>
                <div id="footer-tabs" class="clearfix">
                <?php if ( is_numeric($dt_FooterTabs) ): ?>
                	<?php
						switch($dt_FooterTabs)
						{
							case 6: $dt_FooterTabsClass = 'one-sixth'; break;
							case 5: $dt_FooterTabsClass = 'one-fifth'; break;
							case 4: $dt_FooterTabsClass = 'one-forth'; break;
							case 3: $dt_FooterTabsClass = 'one-third'; break;
							case 2: $dt_FooterTabsClass = 'one-half'; break;
							case 1: $dt_FooterTabsClass = 'full-width'; break;														
						}
					?>
                    <?php for($i = 1; $i <= $dt_FooterTabs; $i++): ?>
                    	<?php if ( $i == $dt_FooterTabs ) $dt_FooterTabsClass.= ' tab-last'; ?>
						<?php if ( is_active_sidebar( 'footer-tabs-'.$i ) ) : ?>
                            <div class="tab <?php echo $dt_FooterTabsClass; ?>">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-'.$i ); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
				<?php else: ?>
               		<?php if ( $dt_FooterTabs == 'threesixthsandonehalf' ) : ?>
						<?php if ( is_active_sidebar( 'footer-tabs-1' ) ) : ?>                    
                            <div class="tab one-sixth">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-1' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-2' ) ) : ?>                    
                            <div class="tab one-sixth">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-2' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-3' ) ) : ?>                    
                            <div class="tab one-sixth">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-3' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-4' ) ) : ?>                    
                            <div class="tab one-half tab-last">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-4' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?>                                                                                                                                    
                    <?php endif; ?>
                    <?php if ( $dt_FooterTabs == 'twooneforthandonehalf' ): ?>
						<?php if ( is_active_sidebar( 'footer-tabs-1' ) ) : ?>                    
                            <div class="tab one-forth">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-1' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-2' ) ) : ?>                    
                            <div class="tab one-forth">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-2' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-3' ) ) : ?>                    
                            <div class="tab one-half tab-last">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-3' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?>
					<?php endif; ?>                        
                    <?php if ( $dt_FooterTabs == 'onethirdandtwothirds' ): ?>
						<?php if ( is_active_sidebar( 'footer-tabs-1' ) ) : ?>                    
                            <div class="tab one-third">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-1' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?> 
						<?php if ( is_active_sidebar( 'footer-tabs-2' ) ) : ?>                    
                            <div class="tab two-thirds tab-last">
                                <ul>
                                    <?php dynamic_sidebar( 'footer-tabs-2' ); ?>
                                </ul>
                            </div> 
						<?php endif; ?>                                            
                    <?php endif; ?>
				<?php endif; ?>                    
                <!-- end of footer tabs -->                                                                                               
                </div>     
            <?php endif; ?>
            <?php $dt_SubFooter = get_option('dt_SubFooter','no'); ?>
            <?php if ( $dt_SubFooter == 'yes' ) : ?>
                <div id="sub-footer"<?php if ( $dt_FooterTabs == 'disabled' && !is_page_template('frontpage-base.php') ) echo' class="sub-footer-no-tabs"' ?>>
                
                	<?php $dt_FooterLogo = get_option('dt_FooterLogo',''); ?>
                    <?php if ( $dt_FooterLogo != '' ) : ?>
                    	<?php echo '<img id="footer-logo" src="'.$dt_FooterLogo.'" alt="'.get_bloginfo('name').'" />'; ?>
                    <?php endif; ?>    
                    
                    <div id="footer-menu">
                        <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => 'footer-menu', 'fallback_cb' => '' ) ); ?>    
                    <!-- end of footer menu -->
                    </div>
                    
                    <?php $dt_Copyright = get_option('dt_Copyright',''); ?>
                    <?php if ( $dt_Copyright != '' ): ?>
                    <div id="copyright">
						<?php echo $dt_Copyright; ?>
                    <!-- end of copyright -->
                    </div>
                    <?php endif; ?>
                    
                <!-- end of sub footer -->
                </div>
            <?php endif; ?>            
        <!-- end of footer -->
		</div>      
    <?php endif; ?>
<!-- end of website footer -->
</footer>
<div id="backtotop"></div>
<?php wp_footer(); ?>
</body>
</html>
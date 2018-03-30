<?php //get theme options
global $oswc_front, $oswc_ads, $oswc_misc, $oswc_single, $oswcPostTypes;

//set theme options
$oswc_flickr_name = $oswc_misc['flickr_name'];
$oswc_google_analytics = $oswc_misc['google_analytics'];
$oswc_footer_ad_hide = $oswc_ads['footer_ad_hide'];
$oswc_footer_ad = $oswc_ads['footer_ad'];
$oswc_featured_duration = $oswc_front['featured_duration'];
$oswc_spotlight_duration = $oswc_front['spotlight_duration'];
$oswc_latest_speed = $oswc_misc['latest_speed'];
$oswc_colorbox = $oswc_misc['colorbox'];
$oswc_footer_menu_hide = $oswc_misc['footer_menu_hide'];
$oswc_share_twitter_show = $oswc_single['twitter_show'];
$oswc_share_digg_show = $oswc_single['digg_show'];
$oswc_share_plusone_show = $oswc_single['plusone_show'];
$oswc_share_pinterest_show = $oswc_single['pinterest_show'];
$oswc_share_tumblr_show = $oswc_single['tumblr_show'];
?>

		<?php if(!$oswc_footer_ad_hide) { //the ad above the footer ?>
            
            <div class="full-width-ad" id="footer-ad">  
            
                <?php echo do_shortcode($oswc_footer_ad); ?>
                
            </div>
            
            <br class="clearer" />
        
        <?php } ?>
        
    </div><!--end main wrapper dark-->
    
    </div><!--end main white content wrapper -->
    
    <div id="footer-wrapper"> <!--begin footer wrapper -->
        
        <div id="footer">
        
        	<?php if(!$oswc_footer_menu_hide) { //the menu in the footer ?>
        
                <div class="footer-menu">
            
                    <a class="home-link" href="<?php echo home_url(); ?>">&nbsp;</a>
            
                    <?php 
                    //title attribute gets in the way - remove it
                    $menu = wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '0', 'fallback_cb' => 'fallback_footer_menu', 'echo' => '0' ) );
                    $menu = preg_replace('/title=\"(.*?)\"/','',$menu);
                    echo $menu;
                    ?> 
                
                </div> 
                
                 <br class="clearer" />
                
            <?php } ?>
        
            <div class="inner">
        
                <div class="panel">
                
                    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Panel 1') ) : else : ?>
                    
                        <div class="widget">
                        
                            <h2><?php _e(' Made Magazine ', 'made' ); ?></h2>                           
                            <p><?php _e( "This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into this widget panel.", 'made' ); ?></p>
                            
                        </div>
                    
                    <?php endif; ?>
                
                </div>
                
                <div class="panel">
                
                    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Panel 2') ) : else : ?>
                    
                        <div class="widget">
                        
                            <h2><?php _e(' Made Magazine ', 'made' ); ?></h2>                           
                            <p><?php _e( "This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into this widget panel.", 'made' ); ?></p>
                            
                        </div>
                    
                    <?php endif; ?>
                
                </div>
                
                <div class="panel">
                
                    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Panel 3') ) : else : ?>
                    
                        <div class="widget">
                        
                            <h2><?php _e(' Made Magazine ', 'made' ); ?></h2>                           
                            <p><?php _e( "This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into this widget panel.", 'made' ); ?></p>
                            
                        </div>
                    
                    <?php endif; ?>
                
                </div>
                
                <div class="panel right">
                
                    <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Panel 4') ) : else : ?>
                    
                        <div class="widget">
                        
                            <div class="widget">
                        
                            <h2><?php _e(' Made Magazine ', 'made' ); ?></h2>                           
                            <p><?php _e( "This is a widget panel. To remove this text, login to your WordPress admin panel and go to Appearance >> Widgets, and drag &amp; drop a widget into this widget panel.", 'made' ); ?></p>
                            
                        </div>
                        
                        </div>
                    
                    <?php endif; ?>                        
                
                </div>
                
                <br class="clearer" />
                
            </div>
            
            <div class="copyright">
            
            	<div class="ribbon-shadow-left">&nbsp;</div>
            
                <div class="floatleft">
            
                    <?php _e( 'Copyright', 'made' ); ?> &copy; <?php echo date("Y").' '.get_bloginfo('name'); ?>,&nbsp;<?php _e( 'All Rights Reserved.', 'made' ); ?>
                    
                </div>
                
                <div class="floatright">
                
                    <div class="floatleft">
                    
                        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Credits') ) : else : ?>
                        
                            &nbsp;
                        
                        <?php endif; ?> 
                        
                    </div>
                    
                </div>
                
                <br class="clearer" />
                
                <div class="ribbon-shadow-right">&nbsp;</div>
            
            </div>
            
        </div>
    
    </div> <!--end footer wrapper-->

	<?php wp_footer(); ?>
	
	<?php echo $oswc_google_analytics; // google analytics code ?>  
    
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script> <!-- jquery plugin js -->
    
    <!-- need to setup review category tabs here since we don't know how many review types there are -->
    <script type="text/javascript">
		jQuery.noConflict(); 
		
		//DOCUMENT.READY
		jQuery(document).ready(function() { 
			//loop through each post type and setup a jquery tabs object
			<?php foreach($oswcPostTypes->postTypes as $postType){ ?>
					jQuery('#tabbed-<?php echo $postType->id; ?>-reviews').tabs({ fx: { opacity: 'toggle', duration: 150 } });		
			<?php } ?> 
			
			<?php if($oswc_colorbox) { ?>			
				//colorbox
				jQuery('.review .article-image a').colorbox({transition:'fade', speed:250});
				jQuery('.single-post .content .article-image a').colorbox({transition:'fade', speed:250});
				jQuery('.colorbox').colorbox({transition:'fade', speed:250});
				jQuery('.colorboxiframe').colorbox({transition:'fade', speed:250, iframe:true, innerWidth:640, innerHeight:390});
				jQuery(".page-content a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").colorbox(); 
				jQuery('.page-content .gallery a').colorbox({  rel:'gallery' });
										
			<?php } ?> 
			//initialize smooth div scroll on Don't Miss slider
			jQuery("#dontmiss").smoothDivScroll({ 
				autoScrollingMode: "always", 
				autoScrollingDirection: "endlessloopright", 
				autoScrollingStep: 1, 
				autoScrollingInterval: 50 
			});
		
			// Logo parade event handlers
			jQuery("#dontmiss").bind("mouseover", function() {
				jQuery(this).smoothDivScroll("stopAutoScrolling");
			}).bind("mouseout", function() {
				jQuery(this).smoothDivScroll("startAutoScrolling");
			});
			
			// uitotop scroller:
			//var defaults = {
	  			//containerID: 'toTop', // fading element id
				//containerHoverID: 'toTopHover', // fading element hover id
				//scrollSpeed: 1200,
				//easingType: 'linear' 
	 		//};			
			
			jQuery().UItoTop({ easingType: 'easeOutExpo' });	
	
		});
	
		//the reason they are here instead of in custom.js is because they contain php variables which can't
		//be applied in a .js file. Also, make sure these come before the darken function.
		
		//WINDOW.LOAD
		jQuery(window).load(function() {
			//spotlight slider	
			jQuery(function() {
				jQuery(".main-content-left #spotlight-slider, .main-content-left #spotlight-slider-responsive").jCarouselLite({		
					auto: <?php echo $oswc_spotlight_duration; ?>000,
					easing: "easeInOutExpo",
					speed: 1100,
					visible: 2			
				});	
			});
			jQuery(function() {
				jQuery(".main-content #spotlight-slider, .main-content #spotlight-slider-responsive").jCarouselLite({		
					auto: <?php echo $oswc_spotlight_duration; ?>000,
					easing: "easeInOutExpo",
					speed: 1100,
					visible: 3			
				});	
			});		
			//featured slider			
			jQuery('#featured').nivoSlider({				
				effect: 'random', // Specify sets like: 'fold,fade,sliceDown'
				slices: 10, // For slice animations
				boxCols: 6, // For box animations
				boxRows: 3, // For box animations
				animSpeed: 200, // Slide transition speed
				pauseTime: <?php echo $oswc_featured_duration; ?>000, // How long each slide will show
				startSlide: 0, // Set starting Slide (0 index)
				directionNav: true, // Next and Prev navigation
				directionNavHide: false, // Only show on hover
				controlNav: false, // 1,2,3... navigation
				controlNavThumbs: false, // Use thumbnails for Control Nav
				pauseOnHover: true, // Stop animation while hovering
				manualAdvance: false, // Force manual transitions
				prevText: 'Prev', // Prev directionNav text
				nextText: 'Next', // Next directionNav text
				beforeChange: function(){}, // Triggers before a slide transition
				afterChange: function(){}, // Triggers after a slide transition
				slideshowEnd: function(){}, // Triggers after all slides have been shown
				lastSlide: function(){}, // Triggers when last slide is shown
				afterLoad: function(){} // Triggers when slider has loaded							 
			});	
					
		});		
    </script>
    
    <!-- make sure this js file is called after image sliders are setup or else the mosaic and darken effects won't work on hidden image elements-->
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/custom.js"></script> <!-- made js -->   
    <?php if(!is_front_page() && !is_tax() && !is_category() && !is_tag() && !is_search() && !is_404() && !is_archive() && !is_page_template('template-reviews.php')) { //don't load external javascript for pages that don't use the sharebox?> 
    <?php if($oswc_share_plusone_show) { ?><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script> <!-- google plus 1 button js --><?php } ?>   
    <?php if($oswc_share_pinterest_show) { ?><script type="text/javascript" src="http://assets.pinterest.com/js/pinit.js"></script> <!-- pinterest share button --><?php } ?>
    <?php if($oswc_share_tumblr_show) { ?><script type="text/javascript" src="http://platform.tumblr.com/v1/share.js"></script> <!-- tumblr --><?php } ?>
    <?php if($oswc_share_twitter_show) { ?><script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script> <!-- twitter --><?php } ?>
    <?php if($oswc_share_digg_show) { ?><script src="http://widgets.digg.com/buttons.js" type="text/javascript"></script> <!-- digg --><?php } ?>
    <?php } ?>
	
</div>

</body>

</html>

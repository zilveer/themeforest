</div><!--end main-->

<?php 
//VAR SETUP
$logo = get_theme_mod('themolitor_customizer_logo');
$footerOnOff = get_theme_mod('themolitor_customizer_footer_onoff', TRUE);
$twitter = get_theme_mod('themolitor_customizer_twitter');
$facebook = get_theme_mod('themolitor_customizer_facebook');
$flikr = get_theme_mod('themolitor_customizer_flikr');
$linkedin = get_theme_mod('themolitor_customizer_linkedin');
$youtube = get_theme_mod('themolitor_customizer_youtube');
$gplus = get_theme_mod('themolitor_customizer_gplus');
$instagram = get_theme_mod('themolitor_customizer_instagram');
$pinterest = get_theme_mod('themolitor_customizer_pinterest');
$vimeo = get_theme_mod('themolitor_customizer_vimeo');

$nivoEffect = get_theme_mod('themolitor_customizer_nivo_effect','random');

get_sidebar(); 
?>

<div class="clear"></div>
</div><!--end content-->
</div><!--end contentContainer-->

<?php if($footerOnOff == 1) { ?>
<a class="backTop" href="#"></a>

	<div id="footerWidgets">
		<ul>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets') ) : endif; ?>
		</ul>
		<div class="clear"></div>
	</div><!--end footerWidgets-->
<?php } ?>

<a class="backTop" href="#"></a>

<div id="footerContainer">
<div id="footer">  

	<a class="logo" href="<?php echo home_url(); ?>"><img src="<?php echo $logo;?>" alt="<?php bloginfo('name'); ?>" /></a>    
	
	<?php wp_nav_menu(array('theme_location' => 'footer', 'container_id' => 'footerNav', 'menu_id' => 'footmenu')); ?>
	
	<div id="socialIcons">
		<a class="socialicon" id="rss" href="<?php bloginfo('rss2_url'); ?>"  title="<?php _e('Subscribe via RSS','themolitor');?>" rel="nofollow"><i class="fa fa-rss-square"></i></a>
	<?php if(!empty($twitter)) { ?>
		<a class="socialicon" id="twitter" href="<?php echo $twitter; ?>" title="<?php _e('Follow me on Twitter','themolitor');?>"  rel="nofollow"><i class="fa fa-twitter-square"></i></a>
	<?php } if(!empty($facebook)) { ?> 
		<a class="socialicon" id="facebook" href="<?php echo $facebook; ?>"  title="<?php _e('Facebook Profile','themolitor');?>" rel="nofollow"><i class="fa fa-facebook-square"></i></a>
	<?php } if(!empty($flikr)) { ?>
		<a class="socialicon" id="flikr" href="<?php echo $flikr; ?>"  title="<?php _e('Flikr Profile','themolitor');?>" rel="nofollow"><i class="fa fa-flickr"></i></a>
	<?php } if(!empty($linkedin)) { ?> 
		<a class="socialicon" id="linkedin" href="<?php echo $linkedin; ?>"  title="<?php _e('LinkedIn Profile','themolitor');?>" rel="nofollow"><i class="fa fa-linkedin-square"></i></a>
	<?php } if(!empty($youtube)) { ?> 
		<a class="socialicon" id="youtube" href="<?php echo $youtube; ?>"  title="<?php _e('YouTube Profile','themolitor');?>" rel="nofollow"><i class="fa fa-youtube-square"></i></a>
	<?php } if(!empty($gplus)) { ?> 
		<a class="socialicon" id="gplus" href="<?php echo $gplus; ?>"  title="<?php _e('Google+ Profile','themolitor');?>" rel="nofollow"><i class="fa fa-google-plus-square"></i></a>
	<?php } if(!empty($instagram)) { ?> 
		<a class="socialicon" id="instagram" href="<?php echo $instagram; ?>"  title="<?php _e('Instagram Profile','themolitor');?>" rel="nofollow"><i class="fa fa-instagram"></i></a>
	<?php } if(!empty($pinterest)) { ?> 
		<a class="socialicon" id="pinterest" href="<?php echo $pinterest; ?>"  title="<?php _e('Pinterest Profile','themolitor');?>" rel="nofollow"><i class="fa fa-pinterest-square"></i></a>
	<?php } if(!empty($vimeo)) { ?> 
		<a class="socialicon" id="vimeo" href="<?php echo $vimeo; ?>"  title="<?php _e('Vimeo Profile','themolitor');?>" rel="nofollow"><i class="fa fa-vimeo-square"></i></a>
	<?php } ?>
		<div class="clear"></div>
	</div><!--end socialIcons-->
	
	<div id="copyright">
	&copy; <?php _e('Copyright','themolitor');?> <?php echo date("Y "); bloginfo('name'); ?>. <?php _e('All rights reserved. Designed and developed by','themolitor');?> <a href="http://themeforest.net/user/themolitor/portfolio?ref=themolitor" title="<?php _e('Web Design &amp; Development Services by THE MOLITOR','themolitor');?>">THE MOLITOR</a>
	</div>

</div><!--end footer-->
</div><!--end footerContainer-->

<script src="<?php echo get_template_directory_uri(); ?>/scripts/nivo.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/tooltip.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/slidingLabel.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/retina.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/scripts/scripts.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict(); jQuery(document).ready(function(){
	molitorscripts(); 
	tooltip();  
	
	//SLIDER STUFF	
	jQuery('#nivoSlider').fadeIn(400).nivoSlider({
    	effect:'<?php echo $nivoEffect;?>',               // Specify sets like: 'fold,fade,sliceDown'
    	slices: 15,                     // For slice animations
    	boxCols: 8,                     // For box animations
    	boxRows: 4,                     // For box animations
    	animSpeed: 500,                 // Slide transition speed
    	pauseTime: 5000,                // How long each slide will show
    	startSlide: 0,                  // Set starting Slide (0 index)
    	directionNav: true,             // Next & Prev navigation
    	controlNav: true,               // 1,2,3... navigation
    	controlNavThumbs: false,        // Use thumbnails for Control Nav
    	pauseOnHover: true,             // Stop animation while hovering
    	manualAdvance: false,           // Force manual transitions
    	prevText: '<i class="fa fa-chevron-left"></i>',               // Prev directionNav text
    	nextText: '<i class="fa fa-chevron-right"></i>',               // Next directionNav text
    	randomStart: false             // Start on a random slide
	});
	
});
</script>
<?php wp_footer(); ?>

</body>
</html>
<?php global $smof_data; ?>

      <!-- START COPYRIGHT SECTION -->   	
       <div class="copyright aligncenter">
     <div class="container clearfix">
        <div class="sixteen columns">   
        <div class="copyright-logo">
           <?php if($smof_data['rnr_footer_logo_url'] != "") { ?>
						<a href="<?php echo home_url(); ?>/">
                         <img src="<?php echo $smof_data['rnr_footer_logo_url']; ?>" 
                              alt="<?php bloginfo('name'); ?>"
                          />
                       </a>
					<?php } else { ?>
						<h1><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a></h1>
					<?php } ?>
        </div>   
           <div class="social-icons">

<?php if($smof_data['rnr_social_email'] != "") { ?>
    <div class="social-icon social-email"><a href="mailto:<?php echo $smof_data['rnr_social_email']; ?>" title="<?php _e( 'Email', 'rocknrolla' ) ?>"><?php _e( 'Email', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_aim'] != "") { ?>
    <div class="social-icon social-aim"><a href="<?php echo $smof_data['rnr_social_aim']; ?>" target="_blank" title="<?php _e( 'Aim', 'rocknrolla' ) ?>"><?php _e( 'Aim', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_apple'] != "") { ?>
    <div class="social-icon social-apple"><a href="<?php echo $smof_data['rnr_social_apple']; ?>" target="_blank" title="<?php _e( 'Apple', 'rocknrolla' ) ?>"><?php _e( 'Apple', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_behance'] != "") { ?>
    <div class="social-icon social-behance"><a href="<?php echo $smof_data['rnr_social_behance']; ?>" target="_blank" title="<?php _e( 'Behance', 'rocknrolla' ) ?>"><?php _e( 'Behance', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_blogger'] != "") { ?>
    <div class="social-icon social-blogger"><a href="<?php echo $smof_data['rnr_social_blogger']; ?>" target="_blank" title="<?php _e( 'Blogger', 'rocknrolla' ) ?>"><?php _e( 'Blogger', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_delicious'] != "") { ?>
    <div class="social-icon social-delicious"><a href="<?php echo $smof_data['rnr_social_delicious']; ?>" target="_blank" title="<?php _e( 'Delicious', 'rocknrolla' ) ?>"><?php _e( 'Delicious', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_deviantart'] != "") { ?>
    <div class="social-icon social-deviantart"><a href="<?php echo $smof_data['rnr_social_deviantart']; ?>" target="_blank" title="<?php _e( 'Deviantart', 'rocknrolla' ) ?>"><?php _e( 'Deviantart', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_digg'] != "") { ?>
    <div class="social-icon social-digg"><a href="<?php echo $smof_data['rnr_social_digg']; ?>" target="_blank" title="<?php _e( 'Digg', 'rocknrolla' ) ?>"><?php _e( 'Digg', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_dribbble'] != "") { ?>
    <div class="social-icon social-dribbble"><a href="<?php echo $smof_data['rnr_social_dribbble']; ?>" target="_blank" title="<?php _e( 'Dribbble', 'rocknrolla' ) ?>"><?php _e( 'Dribbble', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_ember'] != "") { ?>
    <div class="social-icon social-ember"><a href="<?php echo $smof_data['rnr_social_ember']; ?>" target="_blank" title="<?php _e( 'Ember', 'rocknrolla' ) ?>"><?php _e( 'Ember', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_facebook'] != "") { ?>
    <div class="social-icon social-facebook"><a href="<?php echo $smof_data['rnr_social_facebook']; ?>" target="_blank" title="<?php _e( 'Facebook', 'rocknrolla' ) ?>"><?php _e( 'Facebook', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_flickr'] != "") { ?>
    <div class="social-icon social-flickr"><a href="<?php echo $smof_data['rnr_social_flickr']; ?>" target="_blank" title="<?php _e( 'Flickr', 'rocknrolla' ) ?>"><?php _e( 'Flickr', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_forrst'] != "") { ?>
    <div class="social-icon social-forrst"><a href="<?php echo $smof_data['rnr_social_forrst']; ?>" target="_blank" title="<?php _e( 'Forrst', 'rocknrolla' ) ?>"><?php _e( 'Forrst', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_google'] != "") { ?>
    <div class="social-icon social-google"><a href="<?php echo $smof_data['rnr_social_google']; ?>" target="_blank" title="<?php _e( 'Google', 'rocknrolla' ) ?>"><?php _e( 'Google', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_googleplus'] != "") { ?>
    <div class="social-icon social-googleplus"><a href="<?php echo $smof_data['rnr_social_googleplus']; ?>" target="_blank" title="<?php _e( 'Googleplus', 'rocknrolla' ) ?>"><?php _e( 'Googleplus', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_gowalla'] != "") { ?>
    <div class="social-icon social-gowalla"><a href="<?php echo $smof_data['rnr_social_gowalla']; ?>" target="_blank" title="<?php _e( 'Gowalla', 'rocknrolla' ) ?>"><?php _e( 'Gowalla', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_grooveshark'] != "") { ?>
    <div class="social-icon social-grooveshark"><a href="<?php echo $smof_data['rnr_social_grooveshark']; ?>" target="_blank" title="<?php _e( 'Grooveshark', 'rocknrolla' ) ?>"><?php _e( 'Grooveshark', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_html5'] != "") { ?>
    <div class="social-icon social-html5"><a href="<?php echo $smof_data['rnr_social_html5']; ?>" target="_blank" title="<?php _e( 'Html5', 'rocknrolla' ) ?>"><?php _e( 'Html5', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_lastfm'] != "") { ?>
    <div class="social-icon social-lastfm"><a href="<?php echo $smof_data['rnr_social_lastfm']; ?>" target="_blank" title="<?php _e( 'Lastfm', 'rocknrolla' ) ?>"><?php _e( 'Lastfm', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_linkedin'] != "") { ?>
    <div class="social-icon social-linkedin"><a href="<?php echo $smof_data['rnr_social_linkedin']; ?>" target="_blank" title="<?php _e( 'Linkedin', 'rocknrolla' ) ?>"><?php _e( 'Linkedin', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_metacafe'] != "") { ?>
    <div class="social-icon social-metacafe"><a href="<?php echo $smof_data['rnr_social_metacafe']; ?>" target="_blank" title="<?php _e( 'Metacafe', 'rocknrolla' ) ?>"><?php _e( 'Metacafe', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_mixx'] != "") { ?>
    <div class="social-icon social-mixx"><a href="<?php echo $smof_data['rnr_social_mixx']; ?>" target="_blank" title="<?php _e( 'Mixx', 'rocknrolla' ) ?>"><?php _e( 'Mixx', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_netvibes'] != "") { ?>
    <div class="social-icon social-netvibes"><a href="<?php echo $smof_data['rnr_social_netvibes']; ?>" target="_blank" title="<?php _e( 'Netvibes', 'rocknrolla' ) ?>"><?php _e( 'Netvibes', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_paypal'] != "") { ?>
    <div class="social-icon social-paypal"><a href="<?php echo $smof_data['rnr_social_paypal']; ?>" target="_blank" title="<?php _e( 'Paypal', 'rocknrolla' ) ?>"><?php _e( 'Paypal', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_picasa'] != "") { ?>
    <div class="social-icon social-picasa"><a href="<?php echo $smof_data['rnr_social_picasa']; ?>" target="_blank" title="<?php _e( 'Picasa', 'rocknrolla' ) ?>"><?php _e( 'Picasa', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_pinterest'] != "") { ?>
    <div class="social-icon social-pinterest"><a href="<?php echo $smof_data['rnr_social_pinterest']; ?>" target="_blank" title="<?php _e( 'Pinterest', 'rocknrolla' ) ?>"><?php _e( 'Pinterest', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_plurk'] != "") { ?>
    <div class="social-icon social-plurk"><a href="<?php echo $smof_data['rnr_social_plurk']; ?>" target="_blank" title="<?php _e( 'Plurk', 'rocknrolla' ) ?>"><?php _e( 'Plurk', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_reddit'] != "") { ?>
    <div class="social-icon social-reddit"><a href="<?php echo $smof_data['rnr_social_reddit']; ?>" target="_blank" title="<?php _e( 'Reddit', 'rocknrolla' ) ?>"><?php _e( 'Reddit', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_rss'] != "") { ?>
    <div class="social-icon social-rss"><a href="<?php echo $smof_data['rnr_social_rss']; ?>" target="_blank" title="<?php _e( 'Rss', 'rocknrolla' ) ?>"><?php _e( 'Rss', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_skype'] != "") { ?>
    <div class="social-icon social-skype"><a href="<?php echo $smof_data['rnr_social_skype']; ?>" target="_blank" title="<?php _e( 'Skype', 'rocknrolla' ) ?>"><?php _e( 'Skype', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_stumbleupon'] != "") { ?>
    <div class="social-icon social-stumbleupon"><a href="<?php echo $smof_data['rnr_social_stumbleupon']; ?>" target="_blank" title="<?php _e( 'Stumbleupon', 'rocknrolla' ) ?>"><?php _e( 'Stumbleupon', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_technorati'] != "") { ?>
    <div class="social-icon social-technorati"><a href="<?php echo $smof_data['rnr_social_technorati']; ?>" target="_blank" title="<?php _e( 'Technorati', 'rocknrolla' ) ?>"><?php _e( 'Technorati', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_tumblr'] != "") { ?>
    <div class="social-icon social-tumblr"><a href="<?php echo $smof_data['rnr_social_tumblr']; ?>" target="_blank" title="<?php _e( 'Tumblr', 'rocknrolla' ) ?>"><?php _e( 'Tumblr', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_twitter'] != "") { ?>
    <div class="social-icon social-twitter"><a href="<?php echo $smof_data['rnr_social_twitter']; ?>" target="_blank" title="<?php _e( 'Twitter', 'rocknrolla' ) ?>"><?php _e( 'Twitter', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_vimeo'] != "") { ?>
    <div class="social-icon social-vimeo"><a href="<?php echo $smof_data['rnr_social_vimeo']; ?>" target="_blank" title="<?php _e( 'Vimeo', 'rocknrolla' ) ?>"><?php _e( 'Vimeo', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_wordpress'] != "") { ?>
    <div class="social-icon social-wordpress"><a href="<?php echo $smof_data['rnr_social_wordpress']; ?>" target="_blank" title="<?php _e( 'Wordpress', 'rocknrolla' ) ?>"><?php _e( 'Wordpress', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_yahoo'] != "") { ?>
    <div class="social-icon social-yahoo"><a href="<?php echo $smof_data['rnr_social_yahoo']; ?>" target="_blank" title="<?php _e( 'Yahoo', 'rocknrolla' ) ?>"><?php _e( 'Yahoo', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_yelp'] != "") { ?>
    <div class="social-icon social-yelp"><a href="<?php echo $smof_data['rnr_social_yelp']; ?>" target="_blank" title="<?php _e( 'Yelp', 'rocknrolla' ) ?>"><?php _e( 'Yelp', 'rocknrolla' ) ?></a></div>
<?php } ?>
<?php if($smof_data['rnr_social_youtube'] != "") { ?>
    <div class="social-icon social-youtube"><a href="<?php echo $smof_data['rnr_social_youtube']; ?>" target="_blank" title="<?php _e( 'Youtube', 'rocknrolla' ) ?>"><?php _e( 'Youtube', 'rocknrolla' ) ?></a></div>
<?php } ?>   
<?php if($smof_data['rnr_social_instagram'] != "") { ?>
    <div class="social-icon social-instagram"><a href="<?php echo $smof_data['rnr_social_instagram']; ?>" target="_blank" title="<?php _e( 'Instagram', 'rocknrolla' ) ?>"><?php _e( 'Instagram', 'rocknrolla' ) ?></a></div>
<?php } ?>  
<?php if($smof_data['rnr_social_xing'] != "") { ?>
    <div class="social-icon social-xing"><a href="<?php echo $smof_data['rnr_social_xing']; ?>" target="_blank" title="<?php _e( 'Xing', 'rocknrolla' ) ?>"><?php _e( 'Xing', 'rocknrolla' ) ?></a></div>
<?php } ?>    
<?php if($smof_data['rnr_social_angellist'] != "") { ?>
    <div class="social-icon social-angellist"><a href="<?php echo $smof_data['rnr_social_angellist']; ?>" target="_blank" title="<?php _e( 'Angel List', 'rocknrolla' ) ?>"><?php _e( 'Angel List', 'rocknrolla' ) ?></a></div>
<?php } ?>  



           </div>
			<p><?php _e($smof_data['rnr_footer_caption'],'rocknrolla'); ?></p>
            
         </div> <!-- END SIXTEEN COLUMNS -->        
	  </div><!-- END CONTAINER -->
             <?php // if($titanium_options['rnr_subfooter_nav'] == 1) {
    	     
			wp_nav_menu( array(
				'theme_location' => 'footer-menu',
				'container' => 'nav',
				'container_id' => 'rnr-footer-navigation',
				'container_class' => 'footer_menu',
				'fallback_cb' => '',
			) );
		 
      //  } ?>
     </div>
     <!-- END COPYRIGHT SECTION -->	 
     
<?php if($smof_data['rnr_home_type']=="Video") { ?>

        <a id="rnr-background-video" class="rnr-video-player" data-property="{ videoURL : '<?php echo $smof_data['rnr_home_video_id']; ?>' , containment : '#home-background-video' , mute : <?php echo $smof_data['rnr_video_mute']; ?>, startAt : 0.1, stopAt : 0, opacity : 1, optimizeDisplay: true, autoPlay : true, vol: 100, showControls: false, loop: <?php echo $smof_data['rnr_enable_video_loop']; ?>}"></a>	            
 <?php } ?>
        
   
  

	<?php if($smof_data['rnr_custom_js'] != '') { echo $smof_data['rnr_custom_js']; } ?>
        </div>
        <div id="back-to-top"><a href="#">Back to Top</a></div>
 	<?php wp_footer(); ?>	      
    </body>
</html>        
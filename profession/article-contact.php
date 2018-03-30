	<!-- contact -->
	<article class="cvpage <?php if ( opt('vertical_template') == 0 ) { ?> wrap <?php } ?>" id="contact">
	
		<div class="contact-content">
		
			<?php if ( opt('vertical_template') == 1 ) { ?>
				<div class="span12 contact-info">
			<?php } else if ( opt('vertical_template') == 0 ) { ?>
				<div class="span5 contact-info">
			<?php } ?>

				<!-- Contact title -->
				<div  class="contact-title">
					<?php
					$locations = get_nav_menu_locations();
					if (isset($locations['primary-nav'])) {
						$menu_id = $locations['primary-nav'];
						$menu_items = wp_get_nav_menu_items( $menu_id, array() );
						foreach( $menu_items as $menu_item ) {
                            $len=strlen(get_site_url());
                            $url=substr($menu_item->url,$len+1);
                            if($url == '#contact' ) {
								?>
								<h2><?php  echo $menu_item->post_title ?></h2>
							<?php
							}
						}
					}
					?>
				</div> 
			
				<!-- social icons -->
				<ul class="socials clearfix">

					<?php px_social_link('social_facebook_address', __('Facebook Profile', TEXTDOMAIN), 'facebook'); ?>
					<?php px_social_link('social_twitter_address', __('Twitter Profile', TEXTDOMAIN), 'twitter'); ?>
					<?php px_social_link('social_dribbble_address', __('Dribbble Profile', TEXTDOMAIN), 'dribbble'); ?>
					<?php px_social_link('social_vimeo_address', __('Vimeo Profile', TEXTDOMAIN), 'vimeo'); ?>
					<?php px_social_link('social_youtube_address', __('YouTube Profile', TEXTDOMAIN), 'youtube'); ?>
					<?php px_social_link('social_googleplus_address', __('Google+ Profile', TEXTDOMAIN), 'google'); ?>
					<?php px_social_link('social_instagram_address', __('instagram Profile', TEXTDOMAIN), 'instagram'); ?>
                    <?php px_social_link('social_pinterest_address', __('pinterest Profile', TEXTDOMAIN), 'pinterest'); ?>
                    <?php px_social_link('social_flipboard_address', __('flipboard Profile', TEXTDOMAIN), 'flipboard'); ?>
					<?php px_social_link('social_linkedin_address', __('Linkedin Profile', TEXTDOMAIN), 'linkedin'); ?>
					<?php px_social_link('social_yahoo_address', __('yahoo Profile', TEXTDOMAIN), 'yahoo'); ?>
					<?php px_social_link('social_behance_address', __('behance Profile', TEXTDOMAIN), 'behance'); ?>
					<?php px_social_link('social_deviantart_address', __('deviantart', TEXTDOMAIN), 'deviantart'); ?>
					<?php px_social_link('social_skype_address', __('skype  Profile', TEXTDOMAIN), 'skype'); ?>
					<?php px_social_link('social_flickr_address', __('Flickr Profile', TEXTDOMAIN), 'flickr'); ?>
					<?php px_social_link('social_lastFM_address', __('lastFM Profile', TEXTDOMAIN), 'lastfm'); ?>
					<?php px_social_link('rss_feed_address', __('RSS Feed', TEXTDOMAIN), 'RSS'); ?>
					<?php px_social_link('social_forrst_address', __('forrst Profile', TEXTDOMAIN), 'forrst'); ?>
					<?php px_social_link('social_reddit_address', __('reddit Profile', TEXTDOMAIN), 'reddit'); ?>
					<?php px_social_link('social_dingg_address', __('dingg Profile', TEXTDOMAIN), 'digg'); ?>
					<?php px_social_link('social_gowalla_address', __('gowalla Profile', TEXTDOMAIN), 'gowalla'); ?>
					<?php px_social_link('social_orkut_address', __('orkut Profile', TEXTDOMAIN), 'orkut'); ?>
					<?php px_social_link('social_zerply_address', __('zerply Profile', TEXTDOMAIN), 'zerply'); ?>
					<?php px_social_link('social_xing_address', __('xing Profile', TEXTDOMAIN), 'xing'); ?>
				</ul>
				<!-- End social icons -->
							

				<div class="contact-scroll">				
					<div class="contact-add">
					
						<?php if ( opt('contact_info_1') ) { ?>
							<p><?php eopt ('contact_info_1'); ?></p>
						<?php } 
							if ( opt('contact_info_2') ) { ?>
							<p><?php eopt ('contact_info_2'); ?></p>
						<?php }
							if ( opt('contact_info_3') ) { ?>
							<p><?php eopt ('contact_info_3'); ?></p>
						<?php }
							if ( opt('contact_info_4') ) { ?>
							<p><?php eopt ('contact_info_4'); ?></p>
						<?php } ?>
						
					</div>
					
					<!-- contact form -->
					<div class="contact-form">
						
						<?php 
							$contactform7 = opt ('contactform7_shortcode');
							echo do_shortcode ($contactform7);
						?>
											
					</div>
					
				</div>
			</div>
			
			<?php if ( opt('location_display') ) { ?>
				<div class="gmap3 span7" id="map"></div>
			<?php } ?>
				
		</div>
	
	</article>
	<!-- End contact -->

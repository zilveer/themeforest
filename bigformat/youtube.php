<!-- This is the Youtube Template -->
<!--Lines Overlay-->
<div class="lines"></div>

   <?php if (have_posts()) : while (have_posts()) : the_post(); // Wordpress Loop
   
   global $vendor;
   			
			/* #Get Video URL, Fullscreen Background
			======================================================*/
            $video_url = get_post_meta(get_the_ID(), 'ag_video_url', true); //Get the Video Link for the Post
			$full = get_post_meta($post->ID,'_thumbnail_id',false); $full = wp_get_attachment_image_src($full[0], 'full', false);  // URL of Featured Full Image
			ag_fullscreen_bg($full[0]); ?>

        <!-- Play Controls for Non-Flash Browsers -->
        	<div id="captioncontainer">
                <div id="videocaption">
                    <div class="Center caption">
                        <div class="bgwrap">
                            <a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="popupplay">Play</a>
                         </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
         <!-- Play Controls for Non-Flash Browsers -->

<div class="videowrapper">

                
                <?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
                
					<script type="text/javascript" src="swfobject.js"></script>   
                     
                          <div id="ytapiplayer"></div>
                          <script type="text/javascript">
                            var $playerState; 
                            var params = { allowScriptAccess: "always", wmode: "transparent" };
                            var atts = { id: "myytplayer" };
                            swfobject.embedSWF("http://www.youtube.com/v/<?php echo $my_array_of_vars['v']; ?>?enablejsapi=1&playerapiid=ytplayer&version=3&rel=0&showinfo=0&modestbranding=1&autohide=1",
                                               "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
                          </script>
                
				<?php } else { ?>
                  			
                           <div id="ytapiplayer"></div>
						   <script type="text/javascript">
                                      
                            var $playerState; 
                            var params = { allowScriptAccess: "always", wmode: "transparent" };
                            var atts = { id: "myytplayer" };
                            swfobject.embedSWF("http://www.youtube.com/v/<?php echo parse_url($video_url, PHP_URL_PATH);?>?enablejsapi=1&playerapiid=ytplayer&version=3&rel=0&showinfo=0&modestbranding=1&autohide=1",
                                               "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
                          </script>
                <?php } ?> 
</div> 
<!-- End Video Wrapper -->

<div class="contentarea"><div class="clear"></div><!-- For Stupid ie7-->

<!-- Page Title
  ================================================== -->
    <div class="singleproject"><div class="clear"></div><!-- For Stupid ie7-->
        <div class="full page">
            <div class="pagename">
                    <div class="tipsy tipsy-w tipsy-on">
                        <div class="tipsy-arrow tipsy-arrow-w"></div>
                        <div class="tipsy-inner"><?php _e('More Info', 'framework'); ?></div>
                    </div>
                <a href="#" class="toggleproject tool-project" data-url="closed" title="<?php _e('More Info', 'framework'); ?>"><?php _e('Read More', 'framework'); ?></a> 
            </div>
        </div>
    </div>

<!-- Mobile and SEO Friendly Images + Non-Flash Video
  ================================================== -->
<div class="wmuSlider videoslide project-<?php the_ID(); ?>">
    <div class="wmuSliderWrapper">
        <span><?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
            <iframe id="iframeplayer" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
        <?php } else { ?>
            <iframe id="iframeplayer" src="http://www.youtube.com/embed<?php echo parse_url($video_url, PHP_URL_PATH);?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
        <?php } ?></span>
    </div>
</div>
    
<!-- Page Content
  ================================================== -->
<div class="projectcontent">

    <div class="namecontainer container singleproject">
        <div class="pagename">
           <h2><span> <?php the_title(); ?></span></h2>
        </div>
    </div>
    
    <div class="container clearfix ">
        <div class="smallpage">
            <?php $content = get_the_content(); if($content  != '') : // if there is content ?>
            <div class="content pagebg">
                <div class="contentwrap">
                    <?php the_content(); ?>
                    <div class="clear"></div>
                    <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
                    
                     <?php show_social_icons(get_permalink(),get_the_title()); ?>
                    
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <?php endif; ?>
            <?php comments_template('', true);?>
        </div>
    </div>

</div>
<!-- End Project Content-->

</div>
<!-- End contentarea -->
<?php endwhile; endif; ?>
<!-- End Youtube -->
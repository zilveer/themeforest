<div class="lines"></div>

<div class="home">
   <?php if (have_posts()) : while (have_posts()) : the_post(); // Wordpress Loop
   			
			/* #Get Video Info and Featured Image
			======================================================*/
            $video_url = get_post_meta(get_the_ID(), 'ag_video_url_home', true); //Get the Video Link for the Post
			$vendor = parse_url($video_url);
			
			$video_more = get_post_meta(get_the_ID(), 'ag_more_text_home', true);
			$video_link = get_post_meta(get_the_ID(), 'ag_more_link_home', true);
			$full = get_post_meta($post->ID,'_thumbnail_id',false); $full = wp_get_attachment_image_src($full[0], 'full', false);  // URL of Featured Full Image
			
			/* #Get Fullscreen Background
			======================================================*/
			ag_fullscreen_bg($full[0]);  ?>

        <!-- Play Controls for Non-Flash Browsers -->
        	<div id="captioncontainer">
                <div id="videocaption">
                    <div class="Center caption">
                        <div class="bgwrap">
                            <a href="<?php echo $video_url; ?>" rel="prettyPhoto" class="popupplay"><?php _e('Play', 'framework'); ?></a>
                         </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
         <!-- Play Controls for Non-Flash Browsers -->

<!-- Fullscreen Video Background -->
<div class="videowrapper">
                
                <?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
                
					<script type="text/javascript" src="swfobject.js"></script>   
                     
                          <div id="ytapiplayer"></div>
                          <script type="text/javascript">
                            var $playerState; 
                            var params = { allowScriptAccess: "always", wmode: "transparent" };
                            var atts = { id: "myytplayer" };
                            swfobject.embedSWF("http://www.youtube.com/v/<?php echo $my_array_of_vars['v']; ?>?enablejsapi=1&playerapiid=ytplayer&version=3&rel=0&showinfo=0&modestbranding=1&autohide=1&autoplay=1",
                                               "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
                          </script>
                
				<?php } else { ?>
                  <div id="ytapiplayer"></div>
  
						   <script type="text/javascript">
                                      
                            var $playerState; 
                            var params = { allowScriptAccess: "always", wmode: "transparent" };
                            var atts = { id: "myytplayer" };
                            swfobject.embedSWF("http://www.youtube.com/v/<?php echo parse_url($video_url, PHP_URL_PATH);?>?enablejsapi=1&playerapiid=ytplayer&version=3&rel=0&showinfo=0&modestbranding=1&autohide=1&autoplay=1",
                                               "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
                          </script>
                <?php } ?> 
</div> 
<!-- End Fullscreen Video Background -->


<div class="contentarea">


<!-- Mobile and SEO Friendly Images + Non-Flash Video
  ================================================== -->
<div class="wmuSlider videoslide project-<?php the_ID(); ?>">
    <div class="wmuSliderWrapper">
        <span><?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
            <iframe id="iframeplayer" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;"></iframe>
        <?php } else { ?>
            <iframe id="iframeplayer" src="http://www.youtube.com/embed<?php echo parse_url($video_url, PHP_URL_PATH);?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;"></iframe>
        <?php } ?></span>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="projectcontent">
    <div class="namecontainer container singleproject">
    
    <!-- Page Title
 	 ================================================== -->
        <div class="pagename">
            <h2><span> <?php the_title(); ?></span></h2>
        </div>
       
    </div>
    <div class="container clearfix ">
        <div class="smallpage">
            <div class="content">
                  <p> <a href="<?php if ($video_link) echo $video_link; ?>" class="button"><?php if ($video_more) echo $video_more; ?></a></p>
                  <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

</div>
<!-- End ContentArea -->

<!-- Video Page Content
================================================== -->

<div id="videocaptioncontainer">
    <div id="homevideocaption">
        <div class="Right Bottom Light" id="<?php the_ID();?>">
            <div class="bgwrap"><h2><strong><?php the_title(); ?></strong></h2></div>
            <div class="subheadline"><span><a href="<?php if ($video_link) echo $video_link; ?>" class="button"><?php if ($video_more) echo $video_more; ?></a></span></div>
        </div>
        <div class="clear"></div>
     </div>
</div>

<?php endwhile; endif;?>
</div>
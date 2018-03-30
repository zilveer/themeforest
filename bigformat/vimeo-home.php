<!--Lines Overlay-->
<div class="lines vimeolines"></div>

<div class="home">
   <?php if (have_posts()) : while (have_posts()) : the_post(); // Wordpress Loop
   			
			/* #Get Video Info and Featured Image
			======================================================*/
            $video_url = get_post_meta(get_the_ID(), 'ag_video_url_home', true); //Get the Video Link for the Post
			
			
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
<div id="ytapiplayer"></div>
<?php 
/*Get Video ID, Strip slashes out of url path */
$video_url = parse_url($video_url, PHP_URL_PATH); $video_url = trim($video_url, '/'); ?>

<script type="text/javascript">
		var flashvars = {
			'clip_id': '<?php echo $video_url; ?>',
			'server': 'vimeo.com',
			'show_title': 0,
			'show_byline': 0,
			'show_portrait': 0,
			'fullscreen': 1,
			'js_api': 1,
			'autoplay': 1
			}
		
		var parObj = {
			'swliveconnect':true,
			'fullscreen': 1,
			'allowscriptaccess': 'always',
			'allowfullscreen':true,
			'wmode': 'transparent'
		};
		
		var attObj = {}
		attObj.id="vimeoplayer";
		
		swfobject.embedSWF("http://www.vimeo.com/moogaloop.swf", "ytapiplayer", "100%", "100%", "9.0.28", '',flashvars,parObj, attObj );
</script>

</div> 
<!-- End Fullscreen Video Background -->


<div class="contentarea">

<!-- Mobile and SEO Friendly Images + Non-Flash Video
  ================================================== -->
<div class="wmuSlider videoslide project-<?php the_ID(); ?>">
    <div class="wmuSliderWrapper">
        <span><iframe id="iframeplayer" src="http://player.vimeo.com/video/<?php echo $video_url; ?>" frameborder="0"></iframe></span>
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
<script type='text/javascript' src='<?php echo get_template_directory_uri() . '/js/vimeo.js'?>'></script>
<script type='text/javascript'>
jQuery(document).ready(function() {
	jQuery('#play-video').removeClass('play'); // Change play button
});
</script>
<!-- This is the Vimeo Template -->

<!--Lines Overlay-->
<div class="lines vimeolines"></div>

   <?php if (have_posts()) : while (have_posts()) : the_post(); // Wordpress Loop
   			
			/* #Get Video URL, Fullscreen Background
			======================================================*/
            $video_url = get_post_meta(get_the_ID(), 'ag_video_url', true); //Get the Video Link for the Post
			$full = get_post_meta($post->ID,'_thumbnail_id',false); $full = wp_get_attachment_image_src($full[0], 'full', false);  // URL of Featured Full Image
			ag_fullscreen_bg($full[0]); 
			?>

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
			'js_api': 1
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
        <span><iframe id="iframeplayer" src="http://player.vimeo.com/video/<?php echo $video_url; ?>" frameborder="0"></iframe></span>
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
<!-- Load Vimeo Script -->
<script type='text/javascript' src='<?php echo get_template_directory_uri() . '/js/vimeo.js'?>'></script>
<!-- End Vimeo -->
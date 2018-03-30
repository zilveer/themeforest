<?php
# 
# rt-theme single portfolio page
#

//taxonomy
$taxonomy = 'portfolio_categories';

//page link
$link_page=get_permalink(get_option('rttheme_portf_page'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat		= get_term_link($taxitem->slug,$taxonomy);
		$term_slug 		= $taxitem->slug;
		$term_id 		= $taxitem->term_id;    
		}
	$i++;
	}
} 

// portfolio crop image
$crop 	= 	get_option(THEMESLUG.'_portfolio_image_crop_single') ? "true" : "" ;

//image max height
$h = $crop ? get_option('rttheme_portfolio_image_height_single') : 10000;

// page layout - sidebar
$sidebar 	= 	(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : get_option(THEMESLUG."_sidebar_position_portfolio");

//varialbles
$video_width 		= ($content_width 	=="960") ? 940 : 606; 
$video_height 		= ($content_width 	=="960") ? 500 : 380;

get_header();
 
//call sub page header
get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

//call the sub content holder 1st part
sub_page_layout("subheader",$sidebar);

?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php
	// Portfolio featured images
	$rt_gallery_images 				= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
	$rt_gallery_image_titles 		= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
	$rt_gallery_image_descs 			= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );
 

	// Values
	$title                =	get_the_title();
	$video                =	get_post_meta($post->ID, 'rttheme_portfolio_video', true);
	$video_thumbnail      =	get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true);
	$image                =	(is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
	$desc                 =	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
	$permalink            =	get_permalink();
	$remove_link          = get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
	$custom_thumb         = get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);
	$project_info         = get_post_meta($post->ID, 'rttheme_project_info', true);
	$featured_image_usage = get_post_meta($post->ID, 'rttheme_featured_image_usage', true);	
	$post_uniqueID        = 'portfolio-post-'.get_the_ID().'';
	$portfolio_format     = get_post_meta($post->ID, 'rttheme_portfolio_post_format', true);
	$password_protected   = ( post_password_required($post) ) ? true : false ;// Password Protected
	
	//project key details to add before sidebar
	if(trim($project_info)){
		$before_sidebar		 = '<div class="box first box-shadow box_layout widget project_notes">';
		$before_sidebar		.= '<div class="head_text nomargin"><div class="arrow"></div><h4>';
		$before_sidebar		.= get_post_meta($post->ID, 'rttheme_project_info_title', true);;
		$before_sidebar		.= '</h4><div class="space margin-b10"></div></div>';
		$before_sidebar 	.=  do_shortcode(fixshortcode(wpautop(str_replace("<ul", '<ul class="check"', $project_info))));   
		$before_sidebar		.= '</div>';
	}else{$before_sidebar="";}
	
	//next and previous links
	if(get_option(THEMESLUG.'_hide_portfolio_navigation')){
	
		$prev = is_array( $terms ) ? mod_get_adjacent_post(true,true,'', 'portfolio_categories','date') : get_adjacent_post("","",true);
		$next = is_array( $terms ) ? mod_get_adjacent_post(true,false,'', 'portfolio_categories','date') : get_adjacent_post("","",false);
		$prev_post_link_url 	= ($prev) ? get_permalink( $prev->ID ) : "";
		$next_post_link_url 	= ($next) ? get_permalink( $next->ID ) : "";
	
		$next_post_link  = ($next_post_link_url) ? '<a href="'.$next_post_link_url.'" title="" class="p_next"><span>'.__( 'Next →', 'rt_theme').'</span></a>' : false ;
		$prev_post_link  = ($prev_post_link_url) ? '<a href="'.$prev_post_link_url.'" title="" class="p_prev"><span>'.__( '← Previous', 'rt_theme').'</span></a>': false ;				 
		$add_class       = ($prev_post_link==false) ? "single" : ""; // if previous link is empty add class to fix white border
		$before_sidebar .= ($next_post_link || $prev_post_link) ? '<div class="post-navigations  margin-b20 '.$add_class.'">'.$prev_post_link. '' .$next_post_link.'</div>' : "";
	}
	
	$crop = ($crop) ? true : false;
	
	$w=($sidebar=="full") ? 940 :606;				 
	$h = ($h=="") ? 400 : $h;   
	
	// Resize Portfolio Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, $crop);
	
	// Resize Video Image
	if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, 999, '' );
	
	
	// Getting image type
	if ($video) {
		$button="play";
		$media_link= $video;
	} else {
		$media_link= $image;
		$button="magnifier";
	}
	?>

<div class="box portfolio one box-shadow" id="<?php echo $post_uniqueID;?>">
	<!-- page title --> 
	<?php if(!is_front_page() && !is_blog_page()):?>
		<!-- page title -->
		<div class="head_text">
			<div class="arrow"></div><!-- arrow -->
			<h2><?php the_title(); ?></h2>
		</div>
		<!-- /page title -->
	<?php endif;?>
 
		<?php
		#
		#	IMAGE POST FORMAT || EXTERNAL VIDEO
		#
		if( ( $portfolio_format == "image" || $video )  && !$password_protected): ?>
 

				<?php
				#
				#	gallery
				# 
				$rt_gallery_images 			= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
				$rt_gallery_image_titles 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
				$rt_gallery_image_descs 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );
				$gallery_list = "";
				$biggest_width = 0;


				if(is_array($rt_gallery_images) && $featured_image_usage=="slider"){ 
 
						for ($i=0; $i < (count($rt_gallery_images)); $i++) {

								$gallery_image_resized 		 = vt_resize("" , trim($rt_gallery_images[$i]) , $w, $h, $crop);
								$gallery_list				.= "<li>";
								$gallery_list				.= '<a class="imgeffect magnifier" href="'.$rt_gallery_images[$i].'"  data-gal="prettyPhoto[rt_theme_portfolio]"><img src="'.$gallery_image_resized['url'].'" alt="'.$rt_gallery_image_titles[$i].'" /></a>';								


								if($rt_gallery_image_titles[$i] || $rt_gallery_image_descs[$i]){
									$gallery_list			.= '<div class="flex-caption"><div class="desc-background">';
									if($rt_gallery_image_titles[$i])	$gallery_list			.= '<h5>'.$rt_gallery_image_titles[$i].'</h5>';
									if($rt_gallery_image_descs[$i])	$gallery_list			.= '<p>'.$rt_gallery_image_descs[$i].'</p>';
									$gallery_list			.= '</div></div></li>';								
								}

								//find the bigest width value of the images
								if($biggest_width < $gallery_image_resized["width"])
									$biggest_width = $gallery_image_resized["width"];
						} 

								//make sure the bigest width is bigger than 0 and create css 								
								$biggest_width = ($biggest_width > 0) ? $biggest_width."px" : "100%";

echo <<<SCRIPT
	<script type="text/javascript">
	 /* <![CDATA[ */ 
		// Flex Slider and Helper Functions
		jQuery(window).load(function() {
			jQuery('#$post_uniqueID .slider-for-blog-posts').flexslider({
				   animation: "fade",
				   controlsContainer: "#$post_uniqueID .flex-nav-container",
				   smoothHeight: true,
				   directionNav: true,
				   controlNav:false, 
				   prevText: "←", 
				   nextText: "→" 
			});
		});  
	/* ]]> */	
	</script>
SCRIPT;

					echo '<div class="flex_slider_holder" style="max-width:'.$biggest_width.'"><div class="flex-container post_gallery"><div class="flexslider slider-for-blog-posts"><ul class="slides">'.$gallery_list.'</ul></div></div><div class="flex-nav-container"></div></div>';  
					echo '<div class="space margin-t20"></div>';
				}

 
				if(is_array($rt_gallery_images) && $featured_image_usage=="gallery"){ 
 
 						$rt_gallery_images = array_reverse($rt_gallery_images);

						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_list		.= '[image thumb_width="160" thumb_height="160" lightbox="true" custom_link="" title="'.$rt_gallery_image_titles[$i].'" caption="'.$rt_gallery_image_descs[$i].'"]'.$rt_gallery_images[$i].'[/image]'; 
						} 
			 
 
					$gallery_list  =  '[photo_gallery]'.$gallery_list.'[/photo_gallery]';
 
					echo do_shortcode($gallery_list); 

				}
				?>
				
				
			<?php
			if ($video){
				 
				if( strpos($media_link, 'youtube')  ) { //youtube
					echo '<div class="video-container"><iframe  width="100%" height="'.$video_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($media_link).'" frameborder="0" allowfullscreen></iframe></div>';
				}
				
				if( strpos($media_link, 'vimeo')  ) { //vimeo
					echo '<div class="video-container"><iframe  src="http://player.vimeo.com/video/'.find_tube_video_id($media_link).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="100%" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
				}
				
				echo '<div class="space margin-t20"></div>';
			}
			?>
			<?php endif;?>


		<?php
		#
		#	AUDIO POST FORMAT
		#
		if( $portfolio_format == "audio"  && !$password_protected ):
			$portfolio_audio_mp3	= 	get_post_meta($post->ID, THEMESLUG.'_portfolio_audio_mp3', true);
			$portfolio_audio_oga	= 	get_post_meta($post->ID, THEMESLUG.'_portfolio_audio_oga', true);		
		?>
   	<script type="text/javascript">
		//<![CDATA[
    			jQuery(document).ready(function($){
    				if($().jPlayer) {
    					$("#<?php echo $post->ID;?>_audio").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", { 
								<?php echo $image ? 'poster:"'.$image_thumb["url"].'",' : "";?>
								<?php echo $portfolio_audio_mp3 ? 'mp3:"'.$portfolio_audio_mp3.'",' : "";?>
								<?php echo $portfolio_audio_oga ? 'oga:"'.$portfolio_audio_oga.'",' : "";?>
								end: ""
    							});
								
							<?php if($image):?>
							$(this).parents(".jp-holder").find(".remove_image").remove();
							$(this).css({"position":"static"});
							<?php endif;?>
    						},
    						size: {
            				    width: "100%",
            				    <?php if($image):?>height: "auto"<?php else:?>height: "40px"<?php endif;?>
            				},
    						swfPath: "<?php echo THEMEURI;?>/js/", 
    						cssSelectorAncestor: "#<?php echo $post->ID;?>_audio_interface", 
						supplied: "<?php if($portfolio_audio_mp3){echo "mp3,";}?> <?php if($portfolio_audio_oga){echo "oga,";}?>, all"
    					});
    				}
    			});
		//]]>
    	</script>
		<div class="jp-holder">
		<?php if($image):?><img src="<?php echo $image_thumb["url"];?>" alt="" class="remove_image" style="opacity:0;width:100%;height:auto;"/><?php endif;?>
		<div class="jp-container">			
			<div id="<?php echo $post->ID;?>_audio" class="jp-jplayer jp-jplayer-audio" <?php if($image):?>style="position:absolute;"<?php endif;?>></div>
			
			<!-- controllers -->
			<div class="jp-audio-container <?php if(!$image):?>noposter<?php endif;?>">
				<div class="jp-audio">
				    <div class="jp-type-single">
					   <div id="<?php echo $post->ID;?>_audio_interface" class="jp-interface">
							<div class="jp-controls">  
								<a href="#" class="jp-play" tabindex="1">play</a>
								<a href="#" class="jp-pause" tabindex="1">pause</a>
							</div>
							
							<div class="jp-progress-container">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							
							<div class="jp-volume-bar-container">
								<div class="jp-valume-controllers">
									<a href="#" class="jp-mute" tabindex="1">mute</a>
									<a href="#" class="jp-unmute" tabindex="1">unmute</a>
								</div>
								<div class="jp-volume-bar">
									<div class="jp-volume-bar-value"></div>
								</div>
							</div>

							<div class="jp-current-time">00:00</div> 

					   </div>
				    </div>
				</div>
			</div><!-- / controllers end -->
		</div>
		</div>
		<?php endif;?>

		<?php
		#
		#	VIDEO POST FORMAT
		#
		if( ( $portfolio_format == "video" && !$video )  && !$password_protected ):
		
			$portfolio_video_m4v	= 	get_post_meta($post->ID, THEMESLUG.'_portfolio_video_m4v', true);
			$portfolio_video_ogv	= 	get_post_meta($post->ID, THEMESLUG.'_portfolio_video_ogv', true);		
		?>
   	<script type="text/javascript">
		//<![CDATA[ 
    			jQuery(document).ready(function($){ 
    				if($().jPlayer) { 
					$("#jquery_jplayer_<?php echo $post->ID;?>").jPlayer({
						ready: function () {
							$(this).jPlayer("setMedia", { 
								<?php if($custom_thumb): echo 'poster:"'.$custom_thumb.'",';  else: echo $image ? 'poster:"'.$image_thumb["url"].'",' : "";endif;?>
								<?php echo $portfolio_video_m4v ? 'm4v:"'.$portfolio_video_m4v.'",' : "";?>
								<?php echo $portfolio_video_ogv ? 'ogv:"'.$portfolio_video_ogv.'",' : "";?>
								end: "" 
							});
							<?php if($image || $custom_thumb):?>
							$(this).parents(".jp-holder").find(".remove_image").remove();
							$(this).css({"position":"static"});
							<?php endif;?>

						},
						<?php // flash player
							$ua = browser_info();//user browser
							if (	( isset($ua['msie']) && $ua['msie']!="" && version_compare($ua['msie'],"9","<")) || ($portfolio_video_m4v && !$portfolio_video_ogv)): // IE8 & before
						?>						
							size: {
							    width: "<?php echo $video_width-40;?>px",
							    <?php if($crop):?>height: "<?php echo round($h);?>px",<?php else:?>height: "<?php echo round($video_width/2);?>px",<?php endif;?>
								end: "" 
							},
						<?php else:?>
							size: {
							    width: "100%",
							    height: "auto"
							},
						<?php endif;?>  
						swfPath: "<?php echo THEMEURI;?>/js/",
						cssSelectorAncestor: "#jp_interface_<?php echo $post->ID;?>",
						supplied: "<?php if($portfolio_video_m4v){echo "m4v,";}?> <?php if($portfolio_video_ogv){echo "ogv,";}?> all"
					});      
    				}
    			});   
		//]]>
		</script> 


		<div class="jp-holder">
		
		<?php if($custom_thumb):?><img src="<?php echo $custom_thumb;?>" alt="" class="remove_image" style="opacity:0;width:100%;height:auto;"/><?php endif;?>
		<?php if($image && !$custom_thumb):?><img src="<?php echo $image_thumb["url"];?>" alt="" class="remove_image" style="opacity:0;width:100%;height:auto;"/><?php endif;?>

			<div id="jp_interface_<?php echo $post->ID;?>" class="jp-video jp-container">
				<div class="jp-type-single">
					<div id="jquery_jplayer_<?php echo $post->ID;?>" class="jp-jplayer jp-jplayer-video" <?php if($image || $custom_thumb):?>style="position:absolute;"<?php else:?>style="min-height:40px;"<?php endif;?>></div>
 
					<!-- controllers -->
					<div class="jp-gui <?php if(!$image && !$custom_thumb):?>noposter<?php endif;?>"> 				    
						<div class="jp-interface">
							  <div class="jp-controls">  
								  <a href="javascript:;" class="jp-play" tabindex="1">play</a>
								  <a href="javascript:;" class="jp-pause" tabindex="1">pause</a>
							  </div>
							  
							  <div class="jp-progress-container">
								  <div class="jp-progress">
									  <div class="jp-seek-bar">
										  <div class="jp-play-bar"></div>
									  </div>
								  </div>
							  </div>
							  
							  <div class="jp-current-time">00:00</div>
  
							  <div class="jp-volume-bar-container">
								  <div class="jp-valume-controllers">
									  <a href="javascript:;" class="jp-mute" tabindex="1">mute</a>
									  <a href="javascript:;" class="jp-unmute" tabindex="1">unmute</a>
								  </div>
								  <div class="jp-volume-bar">
									  <div class="jp-volume-bar-value"></div>
								  </div>
							  </div>
  
							  <div class="jp-toggles">
								  <a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a>
								  <a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a>
							  </div>		
						</div>	 
					</div><!-- / controllers end -->
				</div>
			</div> 
		</div>
		<?php endif;?>
		 
			<?php the_content(); ?>
				
			<?php endwhile;?>
			
			<?php
					if($sidebar=="full"){
						echo $before_sidebar;
					}
			?>
		
			<div class="clear"></div> 
			
			<?php  
			 if(get_option( THEMESLUG.'_portfolio_comments') && comments_open()):?>
				<div class='entry commententry'>
					<div class="line"><span class="top">[<?php _e( 'top', 'rt_theme'); ?>]</span></div><!-- line -->
				   <?php comments_template(); ?>
				</div>
			<?php endif;?>
		  
			<?php else: ?>
				<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
			<?php endif; ?>
</div>
<div class="space margin-b30"></div>
<?php
//call the sub content holder 2nd part
sub_page_layout("subfooter",$sidebar);

get_footer();
?> 
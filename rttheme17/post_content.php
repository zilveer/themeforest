<?php
global $sidebar,$heading,$content_width;
?> 

<?php
//varialbles
$video_width           = ($content_width 	=="960") ? 940 : 606; 
$video_height          = ($content_width 	=="960") ? 500 : 380;
$image_width           = ($content_width 	=="960") ? 940 : 606; 
$image_height          = ($content_width 	=="960") ? 500 : 380;

$hide_author           = get_option(THEMESLUG.'_hide_author');
$hide_categories       = get_option(THEMESLUG.'_hide_categories');
$hide_dates            = get_option(THEMESLUG.'_hide_dates');
$hide_commnent_numbers = get_option(THEMESLUG.'_hide_commnent_numbers');
$show_small_dates      = get_option(THEMESLUG.'_show_small_dates');
$date_format           = get_option('rttheme_date_format');
?>



	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>            


	<?php 
	#
	#	post variables
	#

	//featured images
	$rt_gallery_images                  = (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true ) : "";
	$rt_gallery_image_titles            = (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true ) : "";
	$rt_gallery_image_descs             = (get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true )) ? get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true ) : "";
	$fist_featured_image                = (is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
	$featured_image_in_single_post_page = get_post_meta($post->ID, THEMESLUG .'featured_image_in_single_post_page', true);

	//various	
	$is_old_post                        = (get_post_meta($post->ID, THEMESLUG.'is_old_post', true)=="1") ? false : true;
	$resize                             = (get_post_meta($post->ID, THEMESLUG.'blog_image_resize', true)  &&  $featured_image_in_single_post_page) ? true : false;
	$crop                               = (get_post_meta($post->ID, THEMESLUG.'blog_image_crop', true)  &&  $featured_image_in_single_post_page) ? true : false;
	$width                              = (get_post_meta($post->ID, THEMESLUG.'blog_image_width', true)) ? get_post_meta($post->ID, THEMESLUG.'blog_image_width', true) : $image_width;
	$meta_height                        = get_post_meta($post->ID, THEMESLUG.'blog_image_height', true);
	$height                             = (!$meta_height && !$crop) ? 10000 : (($meta_height && !$crop) ? $meta_height : ($meta_height && $crop) ? $meta_height : $image_height); 	
	$img_position                       = (get_post_meta($post->ID, THEMESLUG.'featured_image_position', true)   &&  $featured_image_in_single_post_page) ? get_post_meta($post->ID, THEMESLUG.'featured_image_position', true): "center";
	$post_class_img                     = "featured_image_".$img_position;
	$featured_image_usage               = get_post_meta($post->ID, THEMESLUG .'_featured_image_usage', true);	
	$display_gallery_images             = get_post_meta($post->ID, THEMESLUG .'_display_gallery_images', true);		
	$photo_gallery_images_width         = (get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_width", true )) ? get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_width", true ) : 160;
	$photo_gallery_images_height        = (get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_height", true )) ? get_post_meta( $post->ID, THEMESLUG . "photo_gallery_images_height", true ) : 160;
	$imageURL                           = "";
	$post_uniqueID                      = 'post-'.get_the_ID().'';

	//post format fix for wp 3.6
	$new_post_format_value              = get_post_meta( $post->ID, "post_format", true );
	$old_post_format_value              = get_post_format( $post->ID ); 
	$post_format                        =  ! $old_post_format_value ?  $new_post_format_value : $old_post_format_value;
	$post_format                        =  empty( $post_format ) ? "post" : $post_format;	


	if($is_old_post && !$resize) $resize = true; //activate resizer for old posts
	
	//standart post types
	if($post_format == "post"){ 
		if($fist_featured_image && $resize) { // if resize is on
			$image    = @vt_resize('', $fist_featured_image, $width, $height, $crop );
			$imageURL = $image["url"];
		}else{
			$imageURL = $fist_featured_image;
		}	 
	} 


	//gallery post types
	if($post_format == "gallery"){
			$imageURL = $fist_featured_image;
	}

	?>

		<?php
		#
		#	link
		#
		if($post_format=="link"){
			$link 			= get_post_meta($post->ID, THEMESLUG.'post_format_link', true);
			$link_html  		= '<span class="post_url"><a href="'.$link.'" target="_new" title="'.get_the_title().'">'.$link.'</a></span>';
		}else{$link_html=false;}
		?>

			

		<!-- blog box-->
		<div id="<?php echo $post_uniqueID; ?>" <?php post_class('box one blog blog_list box-shadow '.$post_class_img.''); ?>>
			
			<div class="blog-head-line <?php if($post_format=="link") echo "link";?> clearfix">	

				<?php if(!$hide_dates):?>
				<!-- post date -->
				<div class="date">
					<span class="day"><?php the_time("d") ?></span>
					<span class="year"><?php the_time("M") ?> <?php the_time("Y") ?></span> 
				</div>

				<div class="mobile-date"><?php the_time(get_option('rttheme_date_format')) ?></div>
				<!-- / end div .date --> 
				<?php endif;?>
		 				
		 		<div class="post-title-holder">
					<!-- blog headline-->
					<h2><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> 
					<!-- / blog headline--> 

					<!-- post data -->
					<div class="post_data">
						
						<?php if($post_format=="link"):?>
							<?php echo $link_html;?>
						<?php else:?>
							<!-- post data -->
							<?php if($show_small_dates):?><span class="small_date"><?php the_time($date_format); ?></span><?php endif;?>
							<?php if(!$hide_author):?><span class="user margin-right20"><?php the_author_posts_link();?></span><?php endif;?>
							<?php if(!$hide_categories):?><span class="categories"><?php the_category(', ');?></span><?php endif;?>
							<?php if(!$hide_commnent_numbers):?>
							<span class="comment_link"><a href="<?php comments_link(); ?>" title="" class="comment_link"><?php comments_number( __('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme') ); ?></a></span>
							<?php endif;?>

						<?php endif;?>
					</div><!-- / end div  .post_data -->

				</div><!-- / end div  .post-title-holder -->	 
			</div><!-- / end div  .blog-head-line -->	

							
			<?php
			#
			#	gallery
			#
			if($post_format == "gallery"){
				//resize the photo 
				$gallery_crop          = (get_post_meta($post->ID, THEMESLUG.'gallery_images_crop', true)) ? true : false;
				$gallery_images_height = get_post_meta($post->ID, THEMESLUG.'gallery_images_height', true);
				$gallery_w             = $image_width;  
				$gallery_h             = ($gallery_crop) ? $gallery_images_height:10000;
				$gallery_list          = "";			 								
  
				
				//slider option
				if(is_array($rt_gallery_images) && $featured_image_usage=="slider"){ 
 
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_image_resized 		 = vt_resize("" , trim($rt_gallery_images[$i]) ,$gallery_w, $gallery_h, $gallery_crop);
								$gallery_list				.= "<li>";
								$gallery_list				.= '<a class="imgeffect magnifier" href="'.$rt_gallery_images[$i].'" data-gal="prettyPhoto[rt_theme_blog]"><img src="'.$gallery_image_resized['url'].'" alt="'.$rt_gallery_image_titles[$i].'" /></a>';
								
								if($rt_gallery_image_titles[$i] || $rt_gallery_image_descs[$i]){
									$gallery_list			.= '<div class="flex-caption"><div class="desc-background">';
									if($rt_gallery_image_titles[$i])	$gallery_list			.= '<h5>'.$rt_gallery_image_titles[$i].'</h5>';
									if($rt_gallery_image_descs[$i])	$gallery_list			.= '<p>'.$rt_gallery_image_descs[$i].'</p>';
									$gallery_list			.= '</div></div></li>';								
								}
						} 

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
			 
					echo '<div class="flex_slider_holder"><div class="flex-container post_gallery"><div class="flexslider slider-for-blog-posts"><ul class="slides">'.$gallery_list.'</ul></div></div><div class="flex-nav-container"></div></div>';  
					echo '<div class="space margin-t20"></div>';
				}

				//gallery option 
				if(is_array($rt_gallery_images) && $featured_image_usage=="gallery"){  
						for ($i=0; $i < (count($rt_gallery_images)); $i++) { 
								$gallery_list		.= '[image thumb_width="'.$photo_gallery_images_width.'" thumb_height="'.$photo_gallery_images_height.'" lightbox="true" title="'.$rt_gallery_image_titles[$i].'" caption="'.$rt_gallery_image_descs[$i].'"]'.$rt_gallery_images[$i].'[/image]'; 
						}  
					$gallery_list  =  '[photo_gallery]'.$gallery_list.'[/photo_gallery]'; 
					echo do_shortcode($gallery_list); 

				}
			}
			?>

			<?php
			#
			#	Standart post featured image
			#			
			if ($fist_featured_image &&  ($post_format == "post")):?>
				<!-- blog image--> 
				    <a href="<?php echo @$fist_featured_image; ?>" title="<?php echo $rt_gallery_image_descs[0]; ?>" class="imgeffect magnifier align<?php echo $img_position;?>"  data-gal="prettyPhoto[rt_theme_blog]">
					   <img class="featured_image" src="<?php echo $imageURL;?>" alt="<?php echo $rt_gallery_image_titles[0]; ?>" />
				    </a>  
				<!-- / blog image -->
				
				<?php if($img_position=="center"):?>
					<div class="space margin-t20"></div> 
				<?php endif;?> 
			<?php endif;?>		 

			<?php
			#
			#	audio format
			#
			if($post_format=="audio"){
				$post_audio_mp3 = 	get_post_meta($post->ID, THEMESLUG.'_post_audio_mp3', true);
				$post_audio_oga = 	get_post_meta($post->ID, THEMESLUG.'_post_audio_oga', true);

				//poster image
				$poster_image = "";
				if($fist_featured_image && $resize) { // if resize is on
					$image        = @vt_resize('', $fist_featured_image, $width, $height, $crop );
					$poster_image = $image["url"];
				}else{
					$poster_image = $fist_featured_image;
				}
			?>
				<script type="text/javascript">
				//<![CDATA[
		
					jQuery(document).ready(function($){
			
						if($().jPlayer) {
							$("#<?php echo $post->ID;?>_audio").jPlayer({
								ready: function () {
									$(this).jPlayer("setMedia", { 
										<?php echo $poster_image ? 'poster:"'.$poster_image.'",' : "";?>
										<?php echo $post_audio_mp3 ? 'mp3:"'.$post_audio_mp3.'",' : "";?>
										<?php echo $post_audio_oga ? 'oga:"'.$post_audio_oga.'",' : "";?>
										end: ""
									});
										
									<?php if($poster_image):?>
									$(this).parents(".jp-holder").find(".remove_image").remove();
									$(this).css({"position":"static"});
									<?php endif;?>
								},
								size: {
								    width: "100%",
								    <?php if($poster_image):?>height: "auto"<?php else:?>height: "40px"<?php endif;?>
								},
								swfPath: "<?php echo THEMEURI;?>/js/", 
								cssSelectorAncestor: "#<?php echo $post->ID;?>_audio_interface",
								supplied: "<?php if($post_audio_mp3){echo "mp3,";}?> <?php if($post_audio_oga){echo "oga,";}?>, all"
							});
							    
				 
						}
					});
				//]]>
				</script>
				<div class="jp-holder">
				<?php if($poster_image):?><img src="<?php echo $poster_image;?>" alt="" class="remove_image" style="opacity:0;width:100%;height:auto;"/><?php endif;?>
				<div class="jp-container">			
					<div id="<?php echo $post->ID;?>_audio" class="jp-jplayer jp-jplayer-audio" <?php if($poster_image):?>style="position:absolute;"<?php endif;?>></div>
					
					<!-- controllers -->
					<div class="jp-audio-container <?php if(!$poster_image):?>noposter<?php endif;?>">
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
			<?php	
			}
			?>

			<?php
			#
			#	video format
			#
			if($post_format=="video"){
			$video_url = get_post_meta($post->ID, THEMESLUG.'video_url', true);
			if ($video_url){
				 
				if( strpos($video_url, 'youtube')  ) { //youtube
					echo '<div class="video-container"><iframe  width="100%" height="'.$video_height.'" src="http://www.youtube.com/embed/'.find_tube_video_id($video_url).'" frameborder="0" allowfullscreen></iframe></div>';
				}
				
				if( strpos($video_url, 'vimeo')  ) { //vimeo
					echo '<div class="video-container"><iframe  src="http://player.vimeo.com/video/'.find_tube_video_id($video_url).'?color=d6d6d6&title=0&amp;byline=0&amp;portrait=0" width="100%" height="'.$video_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
				}
				
				echo '<div class="space margin-t20"></div>';
			}else{

				$post_video_m4v	= 	get_post_meta($post->ID, THEMESLUG.'_post_video_m4v', true);
				$post_video_ogv	= 	get_post_meta($post->ID, THEMESLUG.'_post_video_ogv', true);

				//poster image
				$poster_image = "";
				if($fist_featured_image) { // if resize is on 
					$poster_image = $fist_featured_image;
				}
			?>

				<script type="text/javascript">
				//<![CDATA[ 
					jQuery(document).ready(function($){ 
						if($().jPlayer) { 
							$("#jquery_jplayer_<?php echo $post->ID;?>").jPlayer({
								ready: function () {
									$(this).jPlayer("setMedia", { 
										<?php echo $poster_image ? 'poster:"'.$poster_image.'",' : "";?>
										<?php echo $post_video_m4v ? 'm4v:"'.$post_video_m4v.'",' : "";?>
										<?php echo $post_video_ogv ? 'ogv:"'.$post_video_ogv.'",' : "";?>
										end: "" 
									});
									<?php if($poster_image):?>
									$(this).parents(".jp-holder").find(".remove_image").remove();
									$(this).css({"position":"static"});
									<?php endif;?>
		
								},
								<?php $ua = browser_info();//user browser
									if (	( isset($ua['msie']) && $ua['msie']!="" && version_compare($ua['msie'],"9","<")) || ($post_video_m4v && !$post_video_ogv)): // IE8 & before
								?>						
									size: {
										width: "<?php echo $video_width;?>px",
										height: "<?php echo $video_height;?>px",
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
								supplied: "<?php if($post_video_m4v){echo "m4v,";}?> <?php if($post_video_ogv){echo "ogv,";}?>, all"
							});      
						}
					});   
				//]]>
				</script> 
		
				<div class="jp-holder">
				 
				<?php if($poster_image):?><img src="<?php echo $poster_image;?>" alt="" class="remove_image" style="opacity:0;width:100%;height:auto;"/><?php endif;?>
		
					<div id="jp_interface_<?php echo $post->ID;?>" class="jp-video jp-container">
						<div class="jp-type-single">
							<div id="jquery_jplayer_<?php echo $post->ID;?>" class="jp-jplayer jp-jplayer-video" <?php if($poster_image):?>style="position:absolute;"<?php else:?>style="min-height:40px;"<?php endif;?>></div>
		 
							<!-- controllers -->
							<div class="jp-gui <?php if(!$poster_image):?>noposter<?php endif;?>"> 				    
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
			<?php	
			}}			
			?>

					
			<!-- blog text-->
			<?php if($post_format=="link" && get_the_content()):?><div class="space margin-b20"></div><?php endif;?>

			<?php the_content(); ?> 
			<?php wp_link_pages(); ?>
			<!-- /blog text-->	  
 
			</div> <!-- / blog box-->	 

 
			 
		<?php if(get_the_tags()):?> 
 		<div class="space margin-b30"></div> 
		<div class="box one nomargin box-shadow">
			<div class="tags nomargin">
			    <!-- tags -->
			    <?php echo the_tags( '<span>', '</span>, <span>', '</span>');?>  
			    <!-- / tags -->
			</div>
		</div>
		<?php endif;?>
		 
		<!-- / blog box -->
		
		<?php
		#
		#	Autor Info
		#		
		if(comments_open() || get_option(THEMESLUG."_hide_author_info")):?>
			<div class="clear"></div>
			<div class="space margin-b30"></div> 
			<?php endif;?> 

			<?php endwhile;?>
			
			<?php if(get_option(THEMESLUG."_hide_author_info")):?>
			<!-- Info Box -->		
				<div class="box one box-shadow author_info margin-b30">
				<h5><?php _e( 'About the Author', 'rt_theme' ); ?></h5>
				
				<span class="alignleft frame"><span class="avatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '60' ); }?></span></span>
				<p>				 
					<strong><?php the_author_posts_link(); ?></strong><br />
					<?php the_author_meta('description'); ?>
				</p>
			</div> 
		<?php endif;?>
		            

		<?php
		#
		#	Comments
		#		
		if(comments_open()):
		?>		 
	 	<!-- comments -->     
		<div class="box one box-shadow">
			<div class='entry commententry'>
			    <?php comments_template(); ?>			    
			</div>
		</div>
		<!-- / comments -->   
		<?php endif;?>  
		
		<?php else: ?>
		    <p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
		<?php endif; ?>		
<?php
/* 
* rt-theme portfolio loop
*/
global $args,$wp_query,$item_width,$content_width,$paged,$box_border,$this_column_width_pixel,$item_width,$selectedPortfolioCatetegories,$filterable,$boxNumber,$layout;

if(is_tax()) $args = array_merge( $wp_query->query, $args);

//keep posts
$keep                   = query_posts($args); 

// portfolio layout
$portfolio_layout_names = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one"); 

//is crop active	
$crop              = get_option(THEMESLUG.'_portfolio_image_crop') ? "true" : "" ;

//image max height
$h = $crop ? get_option('rttheme_portfolio_image_height') : 10000;


$reset_row_count        = 0;
$counter                = 0;   


#
#	item width 
#
$item_width 		=  ($item_width) ?  $item_width  : get_option(THEMESLUG."_portfolio_layout");
 
#
#	column width - pixel  
#
$this_column_width_pixel =  ($this_column_width_pixel) ? intval ($this_column_width_pixel/$item_width) : intval ( ($content_width) / $item_width);


#
#	category navigation for sortable items 
#
$sortNavigation = "";
$randomClass = "portfolio_sortables_".rand(100,100000);

if($filterable){
	if($selectedPortfolioCatetegories){  
		if(is_array($selectedPortfolioCatetegories)){ 
			foreach ($selectedPortfolioCatetegories as $arrayorder => $termID) { 
				$sortCategories = get_term_by('id', $termID, 'portfolio_categories');
				$sortNavigation  .= '<li><a data-filter="'.$sortCategories->slug.'">'.$sortCategories->name.'</a></li>';
			}
		}  

	}else{
		$sortCategories  = get_terms( 'portfolio_categories', 'orderby=name&hide_empty=1&order=ASC' );
		$sortCategories  = is_array($sortCategories) ? $sortCategories : "";

		foreach ($sortCategories as $key => $term) {
			$sortNavigation  .= '<li><a data-filter="'.$term->slug.'">'.$term->name.'</a></li>';
		}	
	}

	echo '
		<script>
			//<![CDATA[
				jQuery(window).load(function() {
					jQuery("#'.$randomClass.'").rt_sort_columns({navigation:"'.$randomClass.'"});
				}); 
			//]]>
		</script>
	';

 
	if($boxNumber == 2 && $layout=="one"){ 
		printf("%s".$sortNavigation."%s", '<div class="box-shadow one portfolio_sortables relocate clearfix '.$boxNumber.' '.$randomClass.'"><ul class="clearfix"><li class="sort_icon">&nbsp;</li>', '</ul></div>');
	}else{
		printf("%s".$sortNavigation."%s", '<div class="box-shadow one portfolio_sortables '.$boxNumber.' clearfix '.$randomClass.'"><ul class="clearfix"><li class="sort_icon">&nbsp;</li>', '</ul></div>');
	}
}

//random div id for scripts
echo '<div id="'.$randomClass.'">';
		
if ( have_posts() ) : while ( have_posts() ) : the_post();

	#
	#	Values
	#  
	
	// Portfolio featured images
	$rt_gallery_images 				= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
	$rt_gallery_image_titles 		= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
	$rt_gallery_image_descs 		= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );
	 

	// other values
	$image					=	(is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
	$title           		=	get_the_title();
	$video          		=	str_replace("&","&amp;",get_post_meta($post->ID, 'rttheme_portfolio_video', true));
	$video_thumbnail 		=	find_image_org_path(get_post_meta($post->ID, 'rttheme_portfolio_video_thumbnail', true)); 
	$desc					=	get_post_meta($post->ID, 'rttheme_portfolio_desc', true);
	$permalink				=	get_permalink();
	$remove_link			= 	get_post_meta($post->ID, 'rttheme_portf_no_detail', true);
	$custom_thumb			= 	get_post_meta($post->ID, 'rttheme_portfolio_thumb_image', true);
	$disable_lightbox		= 	get_post_meta($post->ID, 'rttheme_disable_lightbox', true);	
	$term_list 				=	get_the_terms($post->ID, 'portfolio_categories'); //  selected term list of each post
	$portfolio_format		= 	get_post_meta($post->ID, 'rttheme_portfolio_post_format', true);
	$external_link			= 	get_post_meta($post->ID, 'rttheme_external_link', true);
	$open_in_new_tab		= 	get_post_meta($post->ID, 'rttheme_open_in_new_tab', true);
	$media_link 			=    "";
	$target	 				=    "";

	//box counter
	if(!isset($box_counter)) $box_counter = 1;
 
	//this column width	- grid 
	$this_column_width_grid = 60 / $item_width;
	
	// Reset Counter	
	$reset=false;
	$reset_row_count =  $reset_row_count + $this_column_width_grid;

	//Thumbnail dimensions
	$w = ($this_column_width_pixel > 600) ? 940 : (($this_column_width_pixel > 400) ? 440 : 420);		
	$h = ($h=="") ? intval($w * 0.6) : $h;

 
	// Crop
	if($crop) $crop="true"; else $h=10000;
	
	// Resize Portfolio Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' );
	
	
	// Resize Video Image
	if($video_thumbnail) $video_thumbnail = @vt_resize( '', $video_thumbnail, $w, $h, ''.$crop.'' );
	
	
	/* Getting image type */
	if($disable_lightbox){
		$button="link";
		$media_link= $permalink;
	}else{
		if ($video) {
			$button="play";
			$media_link= $video;
		}elseif ($external_link) {
			$button="link";
			$media_link= $external_link;
			$disable_lightbox = "on";
		} else {
			$media_link= $image;
			$button="magnifier";
		}
	}

	//open in new window
	if($open_in_new_tab){
		$target = 'target="_new"';
	}

	// fixed row holder			
	if($box_counter ==1) echo '<div class="fixed-row">';		
	
	//firt and last
	if($item_width==1){
		$addClass="first";
		$addClass.=" last";
		$box_counter=0;
		$reset_row_count = 0;		
	}	
	elseif($box_counter==1){
		$addClass="first";
	}  
	elseif ($reset_row_count+$this_column_width_grid > 60){
		$addClass="last";
		$box_counter=0;
		$reset_row_count = 0;
	}
	else{
		$addClass="";
	}

	//add terms as class name
	$addTermsClass = "";
	if($term_list){
		if(is_array($term_list)){
			foreach ($term_list as $termSlug) {
				$addTermsClass .= " ". $termSlug->slug;
			}
		}
	}


?>
				
	<!-- box -->
	<div class="box box-shadow <?php echo $addTermsClass;?> <?php echo $portfolio_layout_names[$item_width];?> <?php echo $addClass;?> portfolio <?php echo $portfolio_format;?>">
 
		<?php
		#
		#	IMAGE POST FORMAT || EXTERNAL VIDEO
		#
		if($portfolio_format == "image" || $video): ?>
			<?php if ($image || $video_thumbnail || $custom_thumb):?>
			<!-- portfolio image --> 
				<?php if($media_link):?><a href="<?php echo $media_link;?>" <?php echo $target;?> title="<?php echo $title; ?>" <?php if(!$disable_lightbox) echo 'data-gal="prettyPhoto[rt_theme_portfolio]"';?> class="imgeffect <?php echo $button;?>"><?php endif;?>

					<?php if($custom_thumb)://auto resize not active?>
					    <img src="<?php echo $custom_thumb;?>" alt="<?php echo $title; ?>" class="portfolio_image" />
					<?php elseif($video_thumbnail):?>
					    <img src="<?php echo $video_thumbnail["url"];?>" alt="<?php echo $title;?>"  class="portfolio_image" />	    
					<?php else:?>
					    <img src="<?php echo $image_thumb["url"];?>" alt="<?php echo $title;?>"  class="portfolio_image" />
					<?php endif;?>
	
				<?php if($media_link):?></a><?php endif;?> 
			<!-- / portfolio image -->		
	
				<div class="image-border-bottom"></div><!-- the underline for the image  -->	
			<?php endif;?>
		<?php endif;?>

		<?php
		#
		#	AUDIO POST FORMAT
		#
		if($portfolio_format == "audio"):
		
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
		</div><div class="image-border-bottom"></div><!-- the underline for the image  -->	
		<?php endif;?>
		
		<?php
		#
		#	VIDEO POST FORMAT
		#
		if($portfolio_format == "video" && !$video): 

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
						<?php $ua = browser_info();//user browser
							if (	( isset($ua['msie']) && $ua['msie']!="" && version_compare($ua['msie'],"9","<")) || ($portfolio_video_m4v && !$portfolio_video_ogv)): // IE8 & before
						?>						
							size: {
							    width: "<?php echo $this_column_width_pixel-40;?>px",
							    <?php if($crop):?>height: "<?php echo round($h);?>px",<?php else:?>height: "<?php echo round($this_column_width_pixel/2);?>px",<?php endif;?>
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
						supplied: "<?php if($portfolio_video_m4v){echo "m4v,";}?> <?php if($portfolio_video_ogv){echo "ogv,";}?>, all"
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

		<div class="image-border-bottom"></div><!-- the underline for the image  -->	
		<?php endif;?>

 
		<div class="portfolio_info">
			<!-- title-->
			<h5><?php if(!$remove_link):?><a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>"><?php endif; ?><?php echo $title; ?><?php if(!$remove_link): ?></a><?php endif; ?></h5>	

			<?php if($desc):?>
				<p>
				<!-- text-->
				<?php echo $desc;?>
				
				<?php if(!$remove_link):?>
					<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>" class="read_more"><?php _e( 'read more →', 'rt_theme' ); ?></a>
				<?php endif;?>
				</p>
			<?php endif;?>
    
		</div>

	</div>
	<!-- /box --> 

			
<?php
//get page and post counts
$page_count=get_page_count();
$post_count=$page_count['post_count'];
    
    $counter++; 
    $box_counter++;
    
    //close row
    if(stristr($addClass,"last") || $post_count==$counter){

    	echo "</div>";//end of fixed rows
		
		if ($post_count!=$counter){
			echo '<div class="clear"></div><div class="space margin-b30"></div>';
		}
    }    

?>

<?php endwhile;?> 

 

<?php if($page_count['page_count']>1 && $paged):?> 
 
	<!-- paging-->
	<div class="clear"></div>
	<div class="paging_wrapper margin-t30">
		<ul class="paging">
			<?php get_pagination(); ?>
		</ul>
	</div>			
	<!-- / paging-->
    
<?php endif;?>


<?php endif; wp_reset_query(); ?></div>
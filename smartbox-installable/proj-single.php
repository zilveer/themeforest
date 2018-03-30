<?php get_header(); 
global $smartbox_thisPostID; $smartbox_thisPostID = get_the_ID(); ?>
<div class="fullwidth-container <?php echo $smartbox_thisPostID; ?>" style="
	    	
	    	<?php 
		    	global $smartbox_custom, $smartbox_styleColor;	    		
	    		$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	    		if (empty($type)) $type = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
				$color = des_get_value(DESIGNARE_SHORTNAME."_header_color"); 
				$image = des_get_value(DESIGNARE_SHORTNAME."_header_image"); 
				$pattern = DESIGNARE_PATTERNS_URL.des_get_value(DESIGNARE_SHORTNAME."_header_pattern"); 
				$height = des_get_value(DESIGNARE_SHORTNAME."_header_height"); 
				$margintop = des_get_value(DESIGNARE_SHORTNAME."_header_text_margin_top");	
				$banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider");
				if (empty($banner)) $banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider option:selected");
		 		if ($height != "") echo "height: ". $height . ";";
				if($type == "none") echo "background: none;"; 
				if($type == "color") echo "background: #" . $color . ";";
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
	 			if($type == "pattern") echo "background: url('" . $pattern . "') 0 0 repeat;";
	 			if($type == "border") echo "background: white;";
	    	?>">
	    	
	    	<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div>
			    	<?php
		    	} else {
	    	?>
				<div class="container">
					
					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h1 class="page_title" style="<?php 
					    	$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";
			    	?>"><?php echo get_the_title($smartbox_thisPostID); ?></h1>
		    		<?php
				    		if (get_post_meta($post->ID, 'secondaryTitle_value', true) != ""){
					    		?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";				    		
			    		?>" ><?php echo get_post_meta($post->ID, 'secondaryTitle_value', true); ?></h2>
			    		<?php
			    		}	
		    		?>
		    		
		    	</div>
		    	<div class="projects_nav1">
						<div class="nav-previous-nav1"><?php previous_post_link( '%link', '' ); ?></div>
						<div class="nav-next-nav1"><?php next_post_link( '%link', '' ); ?></div>
					</div>
			</div>
		</div>
	
	<?php }
	
		$smartbox_custom = get_post_meta($smartbox_thisPostID, 'des_custom_page_style_value', true);
		$singleLayout = get_post_meta($smartbox_thisPostID, 'singleLayout_value', true);
		if ($singleLayout == "default"){
			$singleLayout = get_option(DESIGNARE_SHORTNAME."_single_layout");
		}

		if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) != "other") {
			switch($singleLayout){
				case "left_slider":
					?>					
						<div id="white_content">
		
							<div id="wrapper">
							
								<div class="container">
									<?php
										if ($type == "border"){
											?>
											<div class="borderline"></div>
											<?php
										}
									?>
									
									<div id="primary" class="blogarchive2 single-p">
										<div id="content">
									
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
											
												<div class="proj-content <?php echo get_the_ID(); ?>">
													<div class="projects_description">
														<div class="projects_media eleven columns leftSlider">
															<?php
																if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){
																	echo "<div id='p-slider-".get_the_ID()."' class='flexslider clearfix'><ul class='slides da-thumbs-plus'>";
																	
																	$sliderData = get_post_meta($smartbox_thisPostID, "sliderImages_value", true);
																	$slide = explode("|*|",$sliderData);
																	foreach ($slide as $s){
																    	if ($s != ""){
																    		$url = explode("|!|",$s);
																    		echo "<li>";
																    		if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																	    		echo "<a href='".$url[1]."' rel='prettyPhoto[pp_gal]' >";
																    		}
																    		echo "<img src='".$url[1]."' alt='' width='100%' class='rp_style1_img'>";
																    		if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																	    		echo "</a>";
																    		}
																    		echo "</li>";	
																    	}
																    }
																    echo "</ul>";
																    if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																		?>
																			<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');">
																				<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
																			</div>
																		<?php
																	}
																	echo "</div>";
																} 
																if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
																	echo "<div id='the_movies'></div>";
																	$videosType = get_post_meta($smartbox_thisPostID, "videoSource_value", true);
																	if ($videosType != "embed"){
																		$videos = get_post_meta($smartbox_thisPostID, "videoCode_value", true);
																		$videos = preg_replace( '/\s+/', '', $videos );
																		$vid = explode(",",$videos);
																	}
																	switch (get_post_meta($smartbox_thisPostID, "videoSource_value", true)){
																		case "youtube":
																			foreach ($vid as $v){
																				echo "<div class='v_links'>http://www.youtube.com/embed/".$v."?autoplay=1&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";	
																			}
																			break;
																		case "vimeo":
																			foreach ($vid as $v){
																				echo "<div class='v_links'>http://player.vimeo.com/video/".$v."?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0</div>";	
																			}
																			break;
																		case "embed":
																			echo "<div class='embedded'>".get_post_meta($smartbox_thisPostID, "videoCode_value", true)."</div>";
																			break;
																	}
																}
															?>
														</div>
														<div class="content_container five columns">
															<?php do_shortcode(the_content()); ?>
														</div>
													</div>
												</div><!-- .entry-content -->
												
												<script type="text/javascript">
													jQuery(document).ready(function($){
														
													<?php
														if(get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){ 
														
															if (get_post_meta($smartbox_thisPostID, "custom_slider_opts_value", true) == "on"){
																$animation = get_post_meta($smartbox_thisPostID, "projs_flex_transition_value", true);
																$directionNav = get_post_meta($smartbox_thisPostID, "projs_flex_navigation_value", true);
																$slideshowSpeed = get_post_meta($smartbox_thisPostID, "projs_flex_slide_duration_value", true);
																$pauseOnHover = get_post_meta($smartbox_thisPostID, "projs_flex_pause_hover_value", true);
																$controlNav = get_post_meta($smartbox_thisPostID, "projs_flex_controls_value", true);
																$slideshow = get_post_meta($smartbox_thisPostID, "projs_flex_autoplay_value", true);
																$height = get_post_meta($smartbox_thisPostID, "projs_flex_height_value", true);
																$animationDuration = get_post_meta($smartbox_thisPostID, "projs_flex_transition_duration_value", true);
															} else {
																$animation = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition");
																$directionNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_navigation");
																$slideshowSpeed = get_option(DESIGNARE_SHORTNAME. "_projs_flex_slide_duration");
																$pauseOnHover = get_option(DESIGNARE_SHORTNAME. "_projs_flex_pause_hover");
																$controlNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_controls");
																$slideshow = get_option(DESIGNARE_SHORTNAME. "_projs_flex_autoplay");
																$height = get_option(DESIGNARE_SHORTNAME. "_projs_flex_height");
																$animationDuration = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition_duration");
															}
														
															if ($directionNav == "on" || $directionNav == "true") $directionNav = true; else $directionNav = false;
															if ($pauseOnHover == "on" || $pauseOnHover == "true") $pauseOnHover = true; else $pauseOnHover = false;
															if ($controlNav == "on" || $controlNav == "true") $controlNav = true; else $controlNav = false;
															if ($slideshow == "on" || $slideshow == "true") $slideshow = true; else $slideshow = false;
														?>
														
															
									
														if ($("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li').length > 1){
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").flexslider({
																animation: '<?php echo $animation; ?>',
																slideDirection: "horizontal", 
																directionNav: '<?php echo $directionNav; ?>',
																slideshowSpeed: <?php echo $slideshowSpeed; ?>,
																controlsContainer: "#p-slider-<?php echo $smartbox_thisPostID; ?> .flex-container",
																pauseOnAction: false,
																pauseOnHover: '<?php echo $pauseOnHover; ?>',
																keyboardNav: false,
																controlNav: '<?php echo $controlNav; ?>',
																slideshow: '<?php echo $slideshow; ?>',
																animationDuration: <?php echo $animationDuration; ?>,
																after: function(slider){
																	$(slider).find('.magnifier')
																		.unbind('click')
																		.bind('click', function(){
																			$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																		});
																	window.curSlide = slider.currentSlide;
																},
																start: function(slider){
																	window.curSlide = slider.currentSlide;
																	$(slider).find('.magnifier').bind('click', function(){
																		$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																	});
																	if ($('.projects_media .flexslider .mask').length){
																	    $('.projects_media .flexslider .flex-direction-nav li a').hover(function(){
																	    	$('.projects_media .flexslider .mask .more').css('opacity',0);
																	    }, function(){
																	    	$('.projects_media .flexslider .mask .more').css('opacity',1);				
																	    });
																	}
																}
															});
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").css('max-height','<?php echo $height ?>');
									
														} else {
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('ul li').css('display','block');
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a img').css('opacity',1);
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('.magnifier').bind('click', function(){
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a').trigger('click');
															});
														}
														
																			
														$('.slides a.pretty').prettyPhoto({deeplinking: false, show_title: false, social_tools: '', theme: 'pp_default'});	
									
														
													<?php } if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
														
														if (get_post_meta($smartbox_thisPostID, "videoSource_value", true) != "embed"){ 
															?>
															$("#the_movies").html("<iframe src='"+$(".v_links").eq(0).html()+"' width='100%' height='370' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
															<?php
														}
														?>									          	
											          	if ($("#the_movies").siblings(".v_links").length > 1){
											          		$('.projects_media #the_movies').siblings('.movies-nav').remove();
											            	$('.projects_media #the_movies').append('<ul class="flex-direction-nav movies-nav"><li><a class="prev" href="javascript:;">Previous</a></li><li><a class="next" href="javascript:;">Next</a></li></ul>');
											          		
											          		
											          		$('.projects_media #the_movies').siblings('.current_movie').remove();
											          		$('.projects_media #the_movies').after('<div style="display:none;" class="current_movie">0</div>');
											          		
											          		$('.movies-nav').find('.prev').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == 0) nextIndex = $('.projects_media #the_movies').siblings('.v_links').length - 1;
											          			else nextIndex = index-1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											          			
											          		});
											          		$('.movies-nav').find('.next').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == $('.projects_media #the_movies').siblings('.v_links').length - 1) nextIndex = 0;
											          			else nextIndex = index+1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											
											          		});
											          		
											          	}
											          	<?php
													} ?>
														
														if (!$('.nav-previous-nav1').html().length){
															$('.nav-previous-nav1').html('<a href="javascript:;" rel="prev" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">l</a>');
														}
														if (!$('.nav-next-nav1').html().length){
															$('.nav-next-nav1').html('<a href="javascript:;" rel="next" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">r</a>');
														}
																			
													});
									
												</script>
									
												
											</article><!-- #post-<?php the_ID(); ?> -->
									
										
									
										</div><!-- #content -->
									</div><!-- #primary -->
	
					
					<?php
					break;
				case "full_slider":
					
					?>
						<div id="white_content">
		
							<div id="wrapper">
							
								<div class="container">
									<?php
										if ($type == "border"){
											?>
											<div class="borderline"></div>
											<?php
										}
									?>
									
									<div id="primary" class="blogarchive2 single-p">
										<div id="content">
									
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
											
																
												
									
												<div class="proj-content <?php echo get_the_ID(); ?>">
													<div class="projects_media sixteen columns full-slider">
														<?php
															if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){
																echo "<div id='p-slider-".get_the_ID()."' class='flexslider clearfix'><ul class='slides da-thumbs-plus'>";
																	
																$sliderData = get_post_meta($smartbox_thisPostID, "sliderImages_value", true);
																$slide = explode("|*|",$sliderData);
																foreach ($slide as $s){
															    	if ($s != ""){
															    		$url = explode("|!|",$s);
															    		echo "<li>";
															    		if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																    		echo "<a href='".$url[1]."' rel='prettyPhoto[pp_gal]' >";
															    		}
															    		echo "<img src='".$url[1]."' alt='' width='100%' class='rp_style1_img'>";
															    		if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																    		echo "</a>";
															    		}
															    		echo "</li>";	
															    	}
															    }
															    echo "</ul>";
															    if (get_option(DESIGNARE_SHORTNAME."_projects_enlarge_images") == "on"){
																	?>
																		<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');" style="height:100%;">
																			<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
																		</div>
																	<?php
																}
																echo "</div>";
															} 
															if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
																echo "<div id='the_movies'></div>";
																$videosType = get_post_meta($smartbox_thisPostID, "videoSource_value", true);
																if ($videosType != "embed"){
																	$videos = get_post_meta($smartbox_thisPostID, "videoCode_value", true);
																	$videos = preg_replace( '/\s+/', '', $videos );
																	$vid = explode(",",$videos);
																}
																switch (get_post_meta($smartbox_thisPostID, "videoSource_value", true)){
																	case "youtube":
																		foreach ($vid as $v){
																			echo "<div class='v_links' style='display: none'>http://www.youtube.com/embed/".$v."?autoplay=1&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";	
																		}
																		break;
																	case "vimeo":
																		foreach ($vid as $v){
																			echo "<div class='v_links' style='display: none'>http://player.vimeo.com/video/".$v."?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0</div>";	
																		}
																		break;
																	case "embed":
																		echo "<div class='embedded'>".get_post_meta($smartbox_thisPostID, "videoCode_value", true)."</div>";
																		break;
																}
															}
														?>
													</div>
													<div class="projects_description">
														<?php do_shortcode(the_content()); ?>
													</div>
												</div><!-- .entry-content -->
												
												<script type="text/javascript">
													jQuery(document).ready(function($){
													<?php
														if(get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){ 
														
															if (get_post_meta($smartbox_thisPostID, "custom_slider_opts_value", true) == "on"){
																$animation = get_post_meta($smartbox_thisPostID, "projs_flex_transition_value", true);
																$directionNav = get_post_meta($smartbox_thisPostID, "projs_flex_navigation_value", true);
																$slideshowSpeed = get_post_meta($smartbox_thisPostID, "projs_flex_slide_duration_value", true);
																$pauseOnHover = get_post_meta($smartbox_thisPostID, "projs_flex_pause_hover_value", true);
																$controlNav = get_post_meta($smartbox_thisPostID, "projs_flex_controls_value", true);
																$slideshow = get_post_meta($smartbox_thisPostID, "projs_flex_autoplay_value", true);
																$height = get_post_meta($smartbox_thisPostID, "projs_flex_height_value", true);
																$animationDuration = get_post_meta($smartbox_thisPostID, "projs_flex_transition_duration_value", true);
															} else {
																$animation = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition");
																$directionNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_navigation");
																$slideshowSpeed = get_option(DESIGNARE_SHORTNAME. "_projs_flex_slide_duration");
																$pauseOnHover = get_option(DESIGNARE_SHORTNAME. "_projs_flex_pause_hover");
																$controlNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_controls");
																$slideshow = get_option(DESIGNARE_SHORTNAME. "_projs_flex_autoplay");
																$height = get_option(DESIGNARE_SHORTNAME. "_projs_flex_height");
																$animationDuration = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition_duration");
															}
														
															if ($directionNav == "on" || $directionNav == "true") $directionNav = true; else $directionNav = false;
															if ($pauseOnHover == "on" || $pauseOnHover == "true") $pauseOnHover = true; else $pauseOnHover = false;
															if ($controlNav == "on" || $controlNav == "true") $controlNav = true; else $controlNav = false;
															if ($slideshow == "on" || $slideshow == "true") $slideshow = true; else $slideshow = false;
														?>
														
															
									
														if ($("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li').length > 1){
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").flexslider({
																animation: '<?php echo $animation; ?>',
																slideDirection: "horizontal", 
																directionNav: '<?php echo $directionNav; ?>',
																slideshowSpeed: <?php echo $slideshowSpeed; ?>,
																controlsContainer: "#p-slider-<?php echo $smartbox_thisPostID; ?> .flex-container",
																pauseOnAction: false,
																pauseOnHover: '<?php echo $pauseOnHover; ?>',
																keyboardNav: false,
																controlNav: '<?php echo $controlNav; ?>',
																slideshow: '<?php echo $slideshow; ?>',
																animationDuration: <?php echo $animationDuration; ?>,
																after: function(slider){
																	$(slider).find('.magnifier')
																		.unbind('click')
																		.bind('click', function(){
																			$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																		});
																},
																start: function(slider){
																	$(slider).find('.magnifier').bind('click', function(){
																		$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																	});
																}
															});
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").css('max-height','<?php echo $height ?>');
														} else {
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('ul li').css('display','block');
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a img').css('opacity',1);
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('.magnifier').bind('click', function(){
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a').trigger('click');
															});
														}
														
																			
														$('.slides a.pretty').prettyPhoto({deeplinking: false, show_title: false, social_tools: '', theme: 'pp_default'});	
									
														
													<?php } if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
														
														if (get_post_meta($smartbox_thisPostID, "videoSource_value", true) != "embed"){ 
															?>
															$("#the_movies").html("<iframe src='"+$(".v_links").eq(0).html()+"' width='100%' height='370' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
															<?php
														}
														?>									          	
											          	if ($("#the_movies").siblings(".v_links").length > 1){
											          		$('.projects_media #the_movies').siblings('.movies-nav').remove();
											            	$('.projects_media #the_movies').append('<ul class="flex-direction-nav movies-nav"><li><a class="prev" href="javascript:;">Previous</a></li><li><a class="next" href="javascript:;">Next</a></li></ul>');
											          		
											          		
											          		$('.projects_media #the_movies').siblings('.current_movie').remove();
											          		$('.projects_media #the_movies').after('<div style="display:none;" class="current_movie">0</div>');
											          		
											          		$('.movies-nav').find('.prev').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == 0) nextIndex = $('.projects_media #the_movies').siblings('.v_links').length - 1;
											          			else nextIndex = index-1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											          			
											          		});
											          		$('.movies-nav').find('.next').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == $('.projects_media #the_movies').siblings('.v_links').length - 1) nextIndex = 0;
											          			else nextIndex = index+1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											
											          		});
											          		
											          	}
											          	<?php
													} ?>
														
														if (!$('.nav-previous-nav1').html().length){
															$('.nav-previous-nav1').html('<a href="javascript:;" rel="prev" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">l</a>');
														}
														if (!$('.nav-next-nav1').html().length){
															$('.nav-next-nav1').html('<a href="javascript:;" rel="next" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">r</a>');
														}
																			
													});
									
												</script>
									
												
											</article><!-- #post-<?php the_ID(); ?> -->
									
										
									
										</div><!-- #content -->
									</div><!-- #primary -->
	
					
					<?php
					break;
					
				case "fullwidth_slider":
					?>
			
					<div class="projects_media fullwidthslider">
						<?php
							if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){
								echo "<div id='p-slider-".get_the_ID()."' class='flexslider clearfix'><ul class='slides da-thumbs-plus'>";
								
								$sliderData = get_post_meta($smartbox_thisPostID, "sliderImages_value", true);
								$slide = explode("|*|",$sliderData);
								foreach ($slide as $s){
									if ($s != ""){
										$url = explode("|!|",$s);
										echo "<li><img src='".$url[1]."' alt='' class='rp_style1_img' style='max-height:auto;width:auto;height:100%;'></li>";
									}
								}
								?>
								</ul>
								<?php
								echo "</div>";
							} 
							if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
								echo "<div id='the_movies'></div>";
								$videosType = get_post_meta($smartbox_thisPostID, "videoSource_value", true);
								if ($videosType != "embed"){
									$videos = get_post_meta($smartbox_thisPostID, "videoCode_value", true);
									$videos = preg_replace( '/\s+/', '', $videos );
									$vid = explode(",",$videos);
								}
								switch (get_post_meta($smartbox_thisPostID, "videoSource_value", true)){
									case "youtube":
										foreach ($vid as $v){
											echo "<div class='v_links' style='display: none'>http://www.youtube.com/embed/".$v."?autoplay=1&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";	
										}
										break;
									case "vimeo":
										foreach ($vid as $v){
											echo "<div class='v_links' style='display: none'>http://player.vimeo.com/video/".$v."?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0</div>";	
										}
										break;
									case "embed":
										echo "<div class='embedded'>".get_post_meta($smartbox_thisPostID, "videoCode_value", true)."</div>";
										break;
								}
							}
						?>
					</div>
						<div id="white_content">
		
							<div id="wrapper">
							
								<div class="container">
									<?php
										if ($type == "border"){
											?>
											<div class="borderline"></div>
											<?php
										}
									?>
									
									<div id="primary" class="blogarchive2 single-p">
										<div id="content">
									
											<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
											
												<div class="proj-content <?php echo get_the_ID(); ?>">
													
													<div class="projects_description">
														<?php do_shortcode(the_content()); ?>
													</div>
												</div><!-- .entry-content -->
																								
												<script type="text/javascript">
													jQuery(document).ready(function($){
													<?php
														if(get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "image"){ 
														
															if (get_post_meta($smartbox_thisPostID, "custom_slider_opts_value", true) == "on"){
																$animation = get_post_meta($smartbox_thisPostID, "projs_flex_transition_value", true);
																$directionNav = get_post_meta($smartbox_thisPostID, "projs_flex_navigation_value", true);
																$slideshowSpeed = get_post_meta($smartbox_thisPostID, "projs_flex_slide_duration_value", true);
																$pauseOnHover = get_post_meta($smartbox_thisPostID, "projs_flex_pause_hover_value", true);
																$controlNav = get_post_meta($smartbox_thisPostID, "projs_flex_controls_value", true);
																$slideshow = get_post_meta($smartbox_thisPostID, "projs_flex_autoplay_value", true);
																$height = get_post_meta($smartbox_thisPostID, "projs_flex_height_value", true);
																$animationDuration = get_post_meta($smartbox_thisPostID, "projs_flex_transition_duration_value", true);
															} else {
																$animation = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition");
																$directionNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_navigation");
																$slideshowSpeed = get_option(DESIGNARE_SHORTNAME. "_projs_flex_slide_duration");
																$pauseOnHover = get_option(DESIGNARE_SHORTNAME. "_projs_flex_pause_hover");
																$controlNav = get_option(DESIGNARE_SHORTNAME. "_projs_flex_controls");
																$slideshow = get_option(DESIGNARE_SHORTNAME. "_projs_flex_autoplay");
																$height = get_option(DESIGNARE_SHORTNAME. "_projs_flex_height");
																$animationDuration = get_option(DESIGNARE_SHORTNAME. "_projs_flex_transition_duration");
															}
														
															if ($directionNav == "on" || $directionNav == "true") $directionNav = true; else $directionNav = false;
															if ($pauseOnHover == "on" || $pauseOnHover == "true") $pauseOnHover = true; else $pauseOnHover = false;
															if ($controlNav == "on" || $controlNav == "true") $controlNav = true; else $controlNav = false;
															if ($slideshow == "on" || $slideshow == "true") $slideshow = true; else $slideshow = false;
														?>
														
															
									
														if ($("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li').length > 1){
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").flexslider({
																animation: '<?php echo $animation; ?>',
																slideDirection: "horizontal", 
																directionNav: '<?php echo $directionNav; ?>',
																slideshowSpeed: <?php echo $slideshowSpeed; ?>,
																controlsContainer: "#p-slider-<?php echo $smartbox_thisPostID; ?> .flex-container",
																pauseOnAction: false,
																pauseOnHover: '<?php echo $pauseOnHover; ?>',
																keyboardNav: false,
																controlNav: '<?php echo $controlNav; ?>',
																slideshow: '<?php echo $slideshow; ?>',
																animationDuration: <?php echo $animationDuration; ?>,
																after: function(slider){
																	if ($(slider).find('.magnifier').length){
																		$(slider).find('.magnifier')
																			.unbind('click')
																			.bind('click', function(){
																				$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																			});	
																	}
																	$(slider).find('ul.slides > li').each(function(e){  
																		//console.log($(this).children('img').width());
																		$(this).children('img').css('margin-left', Math.floor(($(slider).width()-$(this).children('img').width())/2)+'px');
																	});
																},
																start: function(slider){
																	$(slider).find('.magnifier').bind('click', function(){
																		$(slider).find('li:not(".clone")').eq(slider.currentSlide).find('a').trigger('click');
																	});
																	
																	var checkLoad = setInterval(function(){
																		var loadComplete = true;
																		$(slider).find('ul.slides > li').each(function(e){  
																			if ($(this).children('img').width() < 1) loadComplete = false;
																		});
																		if (loadComplete){
																			$(slider).find('ul.slides > li').each(function(e){  
																				//console.log($(this).children('img').width());
																				$(this).children('img').css('margin-left', Math.floor(($(slider).width()-$(this).children('img').width())/2)+'px');
																			});
																			clearInterval(checkLoad);
																		}
																	}, 100);
																	
																}
															});
															$("#p-slider-<?php echo $smartbox_thisPostID; ?>").css('max-height','<?php echo $height ?>');
														} else {
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('ul li').css('display','block');
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a img').css('opacity',1);
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('.magnifier').bind('click', function(){
																$("#p-slider-<?php echo $smartbox_thisPostID; ?>").find('li a').trigger('click');
															});
														}
														
																			
														$('.slides a.pretty').prettyPhoto({deeplinking: false, show_title: false, social_tools: '', theme: 'pp_default'});	
									
														
													<?php } if (get_post_meta($smartbox_thisPostID, "portfolioType_value", true) == "video") {
														
														if (get_post_meta($smartbox_thisPostID, "videoSource_value", true) != "embed"){ 
															?>
															$("#the_movies").html("<iframe src='"+$(".v_links").eq(0).html()+"' width='100%' height='370' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
															<?php
														}
														?>									          	
											          	if ($("#the_movies").siblings(".v_links").length > 1){
											          		$('.projects_media #the_movies').siblings('.movies-nav').remove();
											            	$('.projects_media #the_movies').append('<ul class="flex-direction-nav movies-nav"><li><a class="prev" href="javascript:;">Previous</a></li><li><a class="next" href="javascript:;">Next</a></li></ul>');
											          		
											          		
											          		$('.projects_media #the_movies').siblings('.current_movie').remove();
											          		$('.projects_media #the_movies').after('<div style="display:none;" class="current_movie">0</div>');
											          		
											          		$('.movies-nav').find('.prev').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == 0) nextIndex = $('.projects_media #the_movies').siblings('.v_links').length - 1;
											          			else nextIndex = index-1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											          			
											          		});
											          		$('.movies-nav').find('.next').click(function(e){
											          			e.preventDefault();
											          			var index = parseInt($('.current_movie').html());
											          			var nextIndex = 0;
											          			if (index == $('.projects_media #the_movies').siblings('.v_links').length - 1) nextIndex = 0;
											          			else nextIndex = index+1;
											          			$("#the_movies iframe").attr('src', $('.projects_media #the_movies').siblings('.v_links').eq(nextIndex).html() );
											          			$('.projects_media #the_movies').siblings('.current_movie').html(nextIndex);
											
											          		});
											          		
											          	}
											          	<?php
													} ?>
														
														if (!$('.nav-previous-nav1').html().length){
															$('.nav-previous-nav1').html('<a href="javascript:;" rel="prev" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">l</a>');
														}
														if (!$('.nav-next-nav1').html().length){
															$('.nav-next-nav1').html('<a href="javascript:;" rel="next" style="color: rgb(102, 102, 102); opacity: 0.3; filter: alpha(opacity=30);">r</a>');
														}
																			
													});
									
												</script>
									
												
											</article><!-- #post-<?php the_ID(); ?> -->
									
										
									
										</div><!-- #content -->
									</div><!-- #primary -->
	
					
					<?php
					break;

			}	
		} else {
			?>
			<div id="white_content">

				<div id="wrapper">
				
					<div class="container">
						<?php
							if ($type == "border"){
								?>
								<div class="borderline"></div>
								<?php
							}
						?>
						
						<div id="primary" class="blogarchive2 single-p">
							<div id="content">
						
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
									<?php do_shortcode(the_content()); ?>
								</article>
							</div>
						</div>
			<?php
		}
		
	?>	
	
	<div class="clear"></div>
	
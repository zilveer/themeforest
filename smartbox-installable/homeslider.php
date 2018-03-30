<?php
	
	$slidertype = get_post_meta(get_the_ID(), 'homepageslider_value', true);
	$boxed = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type");
	if (empty($boxed)) $boxed = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type option:selected");

	if ($slidertype != "no_slider"){
				
		/* rev slider */
		if (substr($slidertype, 0, 10) === "revSlider_"){
			if ($boxed == "full"){
		 
			?>
			<div id="slider_container">
				<?php 
					if (!function_exists('putRevSlider')){
						echo 'Please install the missing plugin - Revolution Slider.';
					} else putRevSlider(substr($slidertype, 10));
				?>
			</div>
				
			<?php
			}
		}		
		
		if (substr($slidertype, 0, 7) === "camera_"){ 
			wp_enqueue_script( 'camera', DESIGNARE_JS_PATH .'camera.min.js', array(), '1',$in_footer = true);
		?>

		<div id="slider_container" class="designareslider">

		<?php 
			
			$coll = designare_get_slider_data(get_post_meta(get_the_ID(), 'homepageslider_value', true)); 
			
			foreach($coll['posts'] as $c){
				$s_type = get_post_meta($c->ID, 'custom_slide_type');
		
				if($s_type[0] == 'Image'){
					$s_back_img = get_post_meta($c->ID, 'custom_bg_image_url');
					
					$s_desc_img = get_post_meta($c->ID, 'custom_image_url');
					$s_desc_img_effect = get_post_meta($c->ID, 'custom_image_url_effect');
					$s_title = get_post_meta($c->ID, 'custom_desctitle');
					$s_title_effect = get_post_meta($c->ID, 'custom_desctitle_effect');
					$s_text = get_post_meta($c->ID, 'custom_desctext');
					$s_text_effect = get_post_meta($c->ID, 'custom_desctext_effect');
					$s_btn_text = get_post_meta($c->ID, 'custom_buttontext');
					$s_btn_link = get_post_meta($c->ID, 'custom_buttonlink');
					$s_btn_style = get_post_meta($c->ID, 'custom_buttonstyle');
					$s_btn_effect = get_post_meta($c->ID, 'custom_button_effect');
					$titlefontfamily = get_post_meta($c->ID, 'custom_titlefontfamily');
					$titlefontsize = get_post_meta($c->ID, 'custom_titlefontsize');
					$titlefontcolor = get_post_meta($c->ID, 'custom_titlefontcolor');
					$descfontfamily = get_post_meta($c->ID, 'custom_descfontfamily');
					$descfontsize = get_post_meta($c->ID, 'custom_descfontsize');
					$descfontcolor = get_post_meta($c->ID, 'custom_descfontcolor');
					
					$customtitlestyle = "";
					if ($titlefontfamily[0] != ""){
						if ($titlefontfamily[0] == "Helvetica" || $titlefontfamily[0] == "Helvetica Neue"){
							$customtitlestyle .= "font-family:".$titlefontfamily[0].", Arial, sans-serif;";
						} else {
							$customtitlestyle .= "font-family:".$titlefontfamily[0].";";
						}
					}
					if ($titlefontsize[0] != "") $customtitlestyle .= "font-size:".$titlefontsize[0].";";
					if ($titlefontcolor[0] != "") $customtitlestyle .= "color:".$titlefontcolor[0].";";

					$customdescstyle = "";
					if ($descfontfamily[0] != ""){
						if ($descfontfamily[0] == "Helvetica" || $descfontfamily[0] == "Helvetica Neue"){
							$customdescstyle .= "font-family:".$descfontfamily[0].", Arial, sans-serif;";
						} else {
							$customdescstyle .= "font-family:".$descfontfamily[0].";";
						}
					}
					if ($descfontsize[0] != "") $customdescstyle .= "font-size:".$descfontsize[0].";";
					if ($descfontcolor[0] != "") $customdescstyle .= "color:".$descfontcolor[0].";";
					
						
					if ($s_back_img[0] != ""){
						?>
						<div data-thumb="<?php echo $s_back_img[0]; ?>" data-src="<?php echo $s_back_img[0]; ?>" >
							<div class="camera_caption">
								<div class="container">
									
									<?php if ($s_desc_img[0] != '') $columns = "eight columns"; else $columns = "sixteen columns"; ?>
									<div class="camera-text-contents <?php echo $columns; ?>">
									<?php if ($s_title[0] != ''){ ?> 
										<div class="title <?php echo $s_title_effect[0]; ?>"><h1 <?php if ($customtitlestyle!="") echo "style='".$customtitlestyle."'";?>><?php echo $s_title[0]; ?></h1></div>
									<?php } ?>
									<?php if ($s_text[0] != ''){ ?> 
										<div class="text <?php echo $s_text_effect[0]; ?>" <?php if ($customdescstyle!="") echo "style='".$customdescstyle."'"; ?>><?php echo $s_text[0]; ?></div>
									<?php } ?>
									<?php if ($s_btn_text[0] != ''){ ?> 
										<a class="button medium <?php echo $s_btn_style[0]; ?> <?php echo $s_btn_effect[0]; ?>" href="<?php if ($s_btn_link[0] != '') echo $s_btn_link[0]; else echo "#"; ?>"><?php echo $s_btn_text[0]; ?></a>
									<?php } ?>
									</div>
									<?php if ($s_desc_img[0] != ''){ ?> 
										<div class="camera-image-contents eight columns">
											<img class="image <?php echo $s_desc_img_effect[0]; ?>" src="<?php echo $s_desc_img[0]; ?>" />
										</div>
									<?php } ?>
									
								</div>
							</div>
						</div>
						<?php
					}
				} 
				else if($s_type[0] == 'Video') {
					$s_video_url = get_post_meta($c->ID, 'custom_video_url');
					$s_video_id = get_post_meta($c->ID, 'custom_video_id');
					
					if(strpos($s_video_url[0], 'youtube') === false){
						if(strpos($s_video_url[0], 'vimeo') === false){
							//Daily
							?>
							
								<div data-src="<?php echo get_template_directory_uri(); ?>/images/blank.gif" data-thumb="<?php echo $s_video_url[0]; ?>">
									<iframe src="http://www.dailymotion.com/embed/video/<?php echo $s_video_id[0]; ?>"></iframe>
								</div>
							
							<?php
						} else {
							//Vimeo
							?>
							
								<div data-src="<?php echo get_template_directory_uri(); ?>/images/blank.gif" data-thumb="">
									<iframe src="http://player.vimeo.com/video/<?php echo $s_video_id[0]; ?>" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								</div>
							
							<?php
						}
					} else {
						//Youtube
						?>
							
						<div data-src="<?php echo get_template_directory_uri(); ?>/images/blank.gif" data-thumb="http://img.youtube.com/vi/<?php echo $s_video_id[0]; ?>/0.jpg">
							<iframe src="http://www.youtube.com/embed/<?php echo $s_video_id[0]; ?>?HD=1;rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>
						</div>
						
						<?php
					}
				}
			}
			
			
		?>
	
		
		</div>
		<script type="text/javascript">
						
			jQuery(document).ready(function($){
			
				var styleColor = "<?php global $smartbox_styleColor; echo $smartbox_styleColor; ?>"; 
				/* slideshow */
				window.firstSlider = true;
				window.sliderIndex = 0;
				
				window.firstLoad = true;
					
				if ($('#slider_container').length){
				
					$('#slider_container').camera({
						pagination: true,
						loader: '<?php if (get_option(DESIGNARE_SHORTNAME."_camera_timeline") == "on") echo 'bar'; else echo 'none'; ?>',
						fx: '<?php echo get_option(DESIGNARE_SHORTNAME."_camera_transition"); ?>',
						transPeriod: <?php echo get_option(DESIGNARE_SHORTNAME."_camera_transition_duration"); ?>,
						barPosition: 'bottom',
						loaderStroke: 1,
						loaderPadding: 0,
						loaderOpacity: .6,
						loaderColor: '<?php global $smartbox_styleColor; echo $smartbox_styleColor; ?>',
						height: '<?php echo get_option(DESIGNARE_SHORTNAME."_camera_height"); ?>',
						time: <?php echo get_option(DESIGNARE_SHORTNAME."_camera_slide_duration"); ?>,
						hover: <?php if(get_option(DESIGNARE_SHORTNAME."_camera_pause_hover") == "on") echo 'true'; else echo 'false'; ?>,
						playPause: false,
						pauseOnClick: false,
						autoAdvance: <?php if (get_option(DESIGNARE_SHORTNAME."_camera_autoplay") == "on") echo 'true'; else echo 'false'; ?>,
						thumbnails: <?php if (get_option(DESIGNARE_SHORTNAME."_camera_thumbnails") == "on") echo 'true'; else echo 'false'; ?>,
						imagePath: $('#templatepath').html() + "images/",
						onLoaded: function(){
							if (window.firstSlider){
								if ($('#bodyLayoutType').html() === "boxed"){
									$('#white_content > #wrapper').prepend('<div class="cameracontrols boxed"><div class="controls-mover"><div class="camera-controls-toggler closed" onclick="toggleCameraControls($(this));">+</div><div class="cameraholder" /></div></div>');
								} else {
									$('#white_content > #wrapper').prepend('<div class="cameracontrols boxed"><div class="controls-mover"><div class="camera-controls-toggler closed" onclick="toggleCameraControls($(this));">+</div><div class="cameraholder" /></div></div>');
								}
								<?php if (get_option(DESIGNARE_SHORTNAME."_camera_controls") == "on") {
									?>
										$('#slider_container .camera_pag_ul').clone(true, true).prependTo($('#white_content .cameraholder'));	
									<?php
								}
								?>
								$('#white_content .cameraholder').prepend('<div id="triangle-bottomleft" /><div class="vert-sep" style="background: #<?php echo designare_hexDarker(get_option(DESIGNARE_SHORTNAME."_style_color"),20);?>;" />');
								
								if (window.BrowserDetect.browser == "Firefox" && window.BrowserDetect.OS == "Mac"){
									$('#white_content > #wrapper .cameracontrols').css('top','-31px');
								}
								if (window.BrowserDetect.browser == "Firefox" && window.BrowserDetect.OS == "Windows"){
									$('#white_content > #wrapper .cameracontrols').css('top','-34px');
								}
								$('.camera-controls-toggler').css({'background': $.xcolor.lighten($('#styleColor').html()) , 'border-bottom': '3px solid '+$('#styleColor').html()});
								$('.cameraholder').stop().animate({width: 'toggle'}, 0);
								
								var classPlaying = "playing";
								<?php if (get_option(DESIGNARE_SHORTNAME."_camera_autoplay") == "on"){
									?>
									classPlaying = "paused";
									<?php
								} ?>
								
								$('#white_content .cameraholder #triangle-bottomleft').html('<div id="play_pause" class="'+classPlaying+'" onclick="playpause($(this));"/>');

								$('.camera_caption .container').css({'opacity': 1, 'filter': 'alpha(opacity=100)', 'display':'block'});
																
								var ind = parseInt($('#slider_container .camera_pag_ul .cameracurrent').index('li'),10);
								window.sliderIndex = ind;
								
								window.firstSlider = false;
								
								$('.camera_prev').before('<div class="camera_nav_container" />');
								$('.camera_nav_container').css({
									'position':'absolute',
									'width':'1024px',
									'bottom': '0px',
									'margin':'0 auto',
									'height':'30px',
									'left':'0',
									'right':'0',
									'opacity':'1',
									'filter':'alpha(opacity=100)'
								});
								
								$('.camera_prev, .camera_next').appendTo($('.camera_nav_container'));
								$('.camera_prev, .camera_next').css({'opacity': 1, 'filter': 'alpha(opacity=100)', 'display':'block'});
								
							}
							
							if ($('#bodyLayoutType').html() == "boxed"){
								$('.camera_caption').each(function(){
									$(this).find('.container > .eight.columns').css('margin-right','0px');
									$(this).find('.container > .eight.columns').eq(0).css('margin-left','20px');
								});
							}
							
						},
						onStartTransition: function(){
							var ind = 0;
							
							for (var x=0; x< $('#slider_container .camera_pag_ul li').length; x++){
								if ($('#slider_container .camera_pag_ul li').eq(x).hasClass('cameracurrent')){
									ind = x;
								}
							}
							
							$('#white_content .camera_pag_ul').find('.cameracurrent').removeClass('cameracurrent');
							$('#white_content .camera_pag_ul li').eq(ind).addClass('cameracurrent');
							
							var source = $('#slider_container .camera_pag_ul li').eq(ind).html();
							
							$('.camera_target_content .cameraContents').children().eq(ind).unbind('mouseenter mouseleave');
										
						}, 
						onEndTransition: function(){
							
							if ($('.cameracurrent .camera_caption').length){
								if ($('.cameracurrent .camera_caption').find('.title').length){
									var animation = $('.cameracurrent .camera_caption').find('.title').attr('class').split(' ');
										type = animation[0];
										animation = animation[animation.length-1];
									animateElement($('.cameracurrent .camera_caption').find('.title'), type, animation);
								}
								if ($('.cameracurrent .camera_caption').find('.text').length){
									var animation = $('.cameracurrent .camera_caption').find('.text').attr('class').split(' ');
										type = animation[0];
										animation = animation[animation.length-1];
									animateElement($('.cameracurrent .camera_caption').find('.text'), type, animation);
								}
								if ($('.cameracurrent .camera_caption').find('.image').length){
									var animation = $('.cameracurrent .camera_caption').find('.image').attr('class').split(' ');
										type = animation[0];
										animation = animation[animation.length-1];
									animateElement($('.cameracurrent .camera_caption').find('.image'), type, animation);
								}
								if ($('.cameracurrent .camera_caption').find('.button').length){
									var animation = $('.cameracurrent .camera_caption').find('.button').attr('class').split(' ');
										type = animation[0];
										animation = animation[animation.length-1];
									animateElement($('.cameracurrent .camera_caption').find('.button'), type, animation);
								}

							}
							
						} 
					});
				
				}
				
			});
			
			function toggleCameraControls($toggle){
				if ($toggle.hasClass('closed')){
					
					$toggle.parents('.controls-mover').find('.cameraholder').stop().animate({width: 'toggle'}, 500, "easeInOutExpo", function(){
						$(this).css('overflow','visible');
					});
					
					$toggle.removeClass('closed').addClass('open').html('-');
				} else {
				
					$toggle.parents('.controls-mover').find('.cameraholder')
						.stop()
							.css('overflow',' ')
							.animate({width: 'toggle'}, 500, "easeInOutExpo");
									
					$toggle.removeClass('open').addClass('closed').html('+');
				}
			}
			
		</script>
		
<?php 
		}
		
		if (substr($slidertype, 0, 7) === "slider_"){ 
			wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
			global $wpdb;
		
			$cc = explode("slider_collection:",$slidertype);
			if (isset($cc[1])){
				$q = "SELECT * from ". $wpdb->prefix ."term_taxonomy
					WHERE taxonomy='slider_collection_category'";
				$res = $wpdb->get_results($q, ARRAY_A);
				foreach($res as $r){
					if ($r['term_id'] == $cc[1]) {
						$found = true;
						
						$height = get_option(DESIGNARE_SHORTNAME."_flex_height");
						$effect = get_option(DESIGNARE_SHORTNAME."_flex_transition");
						if (get_option(DESIGNARE_SHORTNAME."_flex_navigation") == "on")	$navigation = true; 
						else $navigation = "false"; 
						if (get_option(DESIGNARE_SHORTNAME."_flex_controls") == "on")
							$control_navigation = true;
						else $control_navigation = "false";
						$transitionDuration = get_option(DESIGNARE_SHORTNAME."_flex_transition_duration");
						if (get_option(DESIGNARE_SHORTNAME."_flex_pause_hover") == "on")
							$pause_on_hover = true;
						else $pause_on_hover = "false";
						$speed = get_option(DESIGNARE_SHORTNAME."_flex_slide_duration");
						if (get_option(DESIGNARE_SHORTNAME."_flex_autoplay") == "on")
							$autoplay = true;
						else $autoplay = "false";
						
						$plus1="";
						if($effect == 'slide') $plus1 = "+1";
						
						$coll = designare_get_slider_data($slidertype);
						
						$li="";
						$randID = rand();
							
						if (empty($height) || !isset($height)) $height = "300";
						
						?>
						<div class="flexslider_container">
							<div id="myslider-<?php echo $randID; ?>" class="flexslider clearfix" style="height:<?php echo $height; ?>;">
								<ul class="slides">
								<?php	
									foreach($coll['posts'] as $c){
							
										$p_url = get_post_meta($c->ID, 'custom_image_url');
										$p_title = get_post_meta($c->ID, 'custom_desctitle');
										$p_desc = get_post_meta($c->ID, 'custom_desctext');
										$p_link = get_post_meta($c->ID, 'custom_imagelink');
										
										if ($p_link[0] == ""){
											$p_link[0] = "javascript:;";
										}
										
										?>
											<li style="height:100%;">
												<img src="<?php echo $p_url[0]; ?>" alt='' onclick="window.location = '<?php echo $p_link[0]; ?>' ;" > 
												<?php
													if ($p_desc[0] != "" || $p_title[0] != ""){
													?>
													<div class='flex-caption'>
														<div class="container">
														<?php
															if ($p_title[0] != ""){
																?>
																<span class='caption-title'><?php echo $p_title[0]; ?></span>
																<?php
															}
															if (nl2br($p_desc[0]) != ""){
																?>
																<span class='caption-content'><?php echo nl2br($p_desc[0]); ?></span>
																<?php
															}
														?>
														</div>
													</div>
													<?php	
													}
													
												?>
											</li>
										<?php
									}
								?>
								
								</ul>
							</div>
						</div>
			
						
						<script type="text/javascript">
							jQuery(document).ready(function() {
								jQuery('#myslider-<?php echo $randID; ?>').flexslider({
									animation: '<?php echo $effect; ?>',
									slideDirection: "vertical",
									directionNav: <?php echo $navigation; ?>,
									slideshowSpeed: <?php echo $speed; ?>,
									controlsContainer: jQuery('#myslider-<?php echo $randID; ?> .flex-container'),
									pauseOnAction: false,
									pauseOnHover: <?php echo $pause_on_hover; ?>,
									animationDuration: <?php echo $transitionDuration; ?>,
									keyboardNav: false,
									slideshow: <?php echo $autoplay; ?>,
									controlNav: <?php echo $control_navigation; ?>,
									start: function(slider) {
										jQuery('#myslider-<?php echo $randID; ?> .slides li').eq(slider.currentSlide<?php echo $plus1; ?>).find(".flex-caption").animate({
											'opacity' : 1
										}, 500);
									},
									after: function(slider) {
										jQuery('#myslider-<?php echo $randID; ?> .slides li').find(".flex-caption").each(function(){
											jQuery(this).css('opacity', 0);
											if(jQuery(this).parent().hasClass('clone')){}
											else{
												jQuery(this).animate({
													'opacity' : 0
												}, 500);
											}
										});
										jQuery('#myslider-<?php echo $randID; ?> .slides li').eq(slider.currentSlide<?php echo $plus1; ?>).find(".flex-caption").animate({
											'opacity' : 1
										}, 500);
									}
								});
							});
						</script>
						<?php		
					}
				}	
			}
		}
		
	} else {
		
		/* no slider */
		?>
			<script type="text/javascript">
			
				jQuery(document).ready(function($){
					$('.entry-content').css('top','-5px');
					$('.entry-content > p > a > img').unbind('hover');
				});
				
			</script>
		<?php
	}
?>
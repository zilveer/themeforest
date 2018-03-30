<?php if(get_option(OM_THEME_PREFIX . 'show_homepage_slider') == 'true') { ?>
		<?php
			$slider_option = 'homepage_slider';
		
			global $sitepress;
			if(defined('ICL_PLUGIN_INACTIVE') && isset($sitepress) && $sitepress->get_default_language()) {
				$curr=$sitepress->get_current_language();
				if($curr != $sitepress->get_default_language())
					$slider_option.='_'.$curr;
			}
			
			$slider=get_option(OM_THEME_PREFIX . $slider_option);
			if(!is_array($slider))
				$slider=array();

			if(!empty($slider)) {
				$timeout=intval(get_option(OM_THEME_PREFIX . 'homepage_slider_timeout'));
			?>
			<!-- Slider -->		
			<div class="big-slider-wrapper block-full block-h-3">
				<div class="big-slider" id="big-slider"<?php echo ($timeout?' data-timeout="'.$timeout.'"':'')?>>
					<div class="big-slider-inner">
						<div class="big-slider-uber-inner">

						<?php
							$i=1;
							$checkerboard=get_option(OM_THEME_PREFIX . 'homepage_slider_checkerboard');
							foreach($slider as $slide) {
								if($checkerboard == 'true')
									$flip=!($i%2);
								else
									$flip=false;

								//if(@$slide['video_embed'])
								//	$slide['link']='';

								if(@$slide['link'])
									echo '<a href="'.$slide['link'].'" class="big-slider-slide block-3 bg-color-slider'.($flip?' flip':'').(@$slide['video_embed']?' video-slide':'').'">';
								else
									echo '<div class="big-slider-slide block-3 bg-color-slider'.($flip?' flip':'').(@$slide['video_embed']?' video-slide':'').'">';

								$pic='<span class="pic block-h-2 no-mar">';
									if(@$slide['video_embed'])
										$pic.='<span class="video">'.$slide['video_embed'].'</span>';
									elseif($slide['bgimage']) {
										
										$cropped_image=preg_replace('/(\.[^\.]+)$/', '-480x328$1', $slide['bgimage']);
										$cropped_image_local=om_http2local($cropped_image);
										if(substr($cropped_image_local, 0, 1) != '/' || !file_exists($cropped_image_local))
											$cropped_image=$slide['bgimage'];
										
										$size=getimagesize(om_http2local($cropped_image));
										$pic.='<img src="'.$cropped_image.'" alt="'.esc_attr($slide['title']).'" '.($size ? $size[3] : '').' /><span class="pic-after"></span>';
									}
								$pic.='</span>';

								$text='
									<span class="text-wrapper">
										<span class="text block-h-1">
											<span class="text-inner">
												<span class="title">'.$slide['title'].'</span>
												<span class="text-text">'.$slide['description'].'</span>
											</span>
										</span>
									</span>
								';
								
								if($flip)
									echo $text.$pic;
								else
									echo $pic.$text;
								
								if(@$slide['link'])
									echo '</a>';
								else
									echo '</div>';
									
								$i++;
							}
						?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clear anti-mar">&nbsp;</div>
			
			<div class="big-slider-control block-full block-h-half bg-color-slider" id="big-slider-control">
				<a href="#" class="control-left"></a>
				<div class="control-seek">
					<div class="control-seek-box"><div class="control-seek-box-inner"></div></div>
				</div>
				<a href="#" class="control-right"></a>
				<div class="clear"></div>
			</div>
			<!-- /Slider -->
			
			<div class="clear anti-mar">&nbsp;</div>
			<?php	
			}
		?>
<?php } ?>
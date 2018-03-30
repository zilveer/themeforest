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

			if(!empty($slider)) {
			?>
				<!-- Slider -->
				<div class="slider" id="homepage-slider">
					<ul class="slider-slides">
					<?php
						foreach($slider as $slide) {
							echo '<li>';
							if(@$slide['link'])
								echo '<a href="'.$slide['link'].'">';
							echo '<span class="img">';
//								if(@$slide['video_embed'])
//									echo '<span class="video-embed">'.$slide['video_embed'].'</span>';
//								else
							if($slide['bgimage'])
									echo '<img src="'.$slide['bgimage'].'" alt="" />';
							echo '</span>';	
							echo '<span class="mask"></span>';
							echo '<span class="text">'.do_shortcode(@$slide['description']).'</span>';

							if(@$slide['link'])
								echo '</a>';

							echo '</li>';
						}
					?>
					</ul>
				</div>
				<!-- /Slider -->
			<?php	
			}
		?>
<?php } ?>
<?php

global $template_dir, $no_slider;

$slider_choice = get_post_meta($post->ID, '_slider_choice', true);

if ($slider_choice):

	$alias_split = explode('---',$slider_choice);
	$alias_type = $alias_split[0];
	$alias_name = $alias_split[1];
	if ($alias_name == 'blur'): $alias_name = 'espresso'; endif;
	
	echo '<div id="slider-wrap" class="loader-block top-loader">';
	
		// Revolution Slider?
		if ($alias_type == 'REVSLIDER'):
		
			putRevSlider($alias_name);
			
		// Soliloquy Slider?
		elseif ($alias_type == 'SOLILOQUY'):
	
			echo do_shortcode('[soliloquy id="'.$alias_name.'"]');
		
		// Espresso Slider?
		else :
	
			$items = get_post_meta($alias_name, '_slides', true); $item_count = count($items);
			
			$blur_style = ot_get_option('blur_slider_style','blur');
			
			// Slides?
			if ($item_count > 0): $temp_count = 0; ?>
			
			<div class="carousel <?php echo $blur_style; ?>">
			    <div class="main-wrap">
					<div class="main-slider">
						
						<?php // GET IMAGE SLIDES FIRST
						foreach($items as $i) {
							$temp_count++;
							if($i['image_id']) {
								
								$dark_text = (isset($i['dark_text']) ? true : false);
								
								$src = wp_get_attachment_image_src($i['image_id'], 'slide');
								?><div class="slide<?php if (!$i['title'] && !$i['content'] && !$i['button_text']){ ?> no-caption<?php } if ($dark_text): echo ' dark-text'; endif; ?>">
						            <img src="<?php echo esc_attr($src[0]); ?>" alt="<?php echo $i['title']; ?>" width="1440" id="image-id-<?php echo $temp_count; ?>" />
						            <div class="caption-wrap">
						                <span class="overlay"></span>
						                <canvas width="100%" style="width: 100%; height:auto;" id="canvas-<?php echo $temp_count; ?>"></canvas>
						                <div class="cnt-wrap">
						                	<div class="caption">
							                    <?php if ($i['title']){ ?><strong class="title"<?php if ($dark_text): echo ' style="color:#222;"'; endif; ?>><?php echo $i['title']; ?></strong><?php } ?>
												<?php if ($i['content']){ ?><p<?php if ($dark_text): echo ' style="color:#222;"'; endif; ?>><?php echo $i['content']; ?></p><?php } ?>
							                    <?php if ($i['button_text'] && $i['button_link']){ ?><a href="<?php echo $i['button_link']; ?>" class="es-button"><?php echo $i['button_text']; ?></a><?php } ?>
						                	</div>
						                </div>
						            </div>
						        </div><?php
							}
						} ?>
						
				    </div>
				</div>
		
			    <div class="secondary-wrap">
			        <div class="secondary-slider">
			        
			        	<?php // GET IMAGE SLIDES FIRST
						$temp_count = 0;
						foreach($items as $i) {
							$temp_count++;
							if($i['image_id']) {
								$src = wp_get_attachment_image_src($i['image_id'], 'slide');
								?><img src="<?php echo esc_attr($src[0]); ?>" alt="<?php echo $i['title']; ?>" width="1440" id="image-id-<?php echo $temp_count; ?>" /><?php
							}
						} ?>
						
			        </div>
			    </div>
			    <a href="#" class="btn-prev">Previous</a>
			    <a href="#" class="btn-next">Next</a>
			</div><?php
			
			endif;
			// END Slides
			
			
			// Add Blur Slider Options to page
			$auto_cycle = get_post_meta($post->ID, '_es_blur_auto_cycle', false);
			$auto_cycle = $auto_cycle[0];
			$cycle_speed = get_post_meta($post->ID, '_es_blur_speed', 6) * 1000;
			if ($auto_cycle){
				echo '<script type="text/javascript">';
				echo 'var blur_auto_cycle = '.$cycle_speed.';';
				echo '</script>';
			} else {
				echo '<script type="text/javascript">';
				echo 'var blur_auto_cycle = false;';
				echo '</script>';
			}
			// END Blur Slider Options
			
		
		endif;
		// END Slider Type
		
		// Revolution Slider?
		if ($alias_type != 'REVSLIDER' && $alias_type != 'SOLILOQUY'):
		
		// MOBILE SLIDER
		?><section id="mobile-slider">
			<div class="colored-wrap">
				<div class="mobile-blur-slider"><?php
				
				foreach($items as $i) {
				
					?><div class="mobile-slide">
						<div class="wrapped">
							<h3><?php echo $i['title']; ?></h3>
							<p><?php echo $i['content']; ?></p>
							<a href="<?php echo $i['button_link']; ?>" class="es-button"><?php echo $i['button_text']; ?></a>
						</div>
					</div><?php
					
				}
					
				?></div>
				<a href="#" class="btn-prev">P</a>
				<a href="#" class="btn-next">N</a>
			</div>
		</section><?php
		
		endif;

	echo '</div>';

else :

	$no_slider = true;

endif;
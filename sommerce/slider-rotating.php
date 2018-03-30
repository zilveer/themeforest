<?php 
/**
 * @package WordPress
 * @subpackage Sommerce
 * @since 1.0
 */
 
if ( yiw_is_empty() )
    return;
?>
 
<div id="rotating-slider">
	<!-- ROTAING SLIDER -->
		<?php
			$rotatings = yiw_get_slides( 'slider_rotating_slides' );
			
			if( is_array( $rotatings ) AND !empty( $rotatings ) ) : 
		?>
		
		<div class="content">
			<div class="rm_wrapper">
				<div id="rm_container" class="rm_container">
		
					<ul>	
						<?php 
							$nslides = yiw_get_option( 'slider_rotating_n_panels' );  // number of panel for slide
							$count = 0; 
							$max_rotation = 15;   // max value of data rotation
							
							foreach( $rotatings as $rotating ) :               
								
								// calculate image rotation for each panel
// 								$data_rotation = ( ( ( $max_rotation * 2 ) / ( $nslides - 1 ) ) * $count ) - $max_rotation;
								$width_li = 960 / $nslides;
								
								$count++;
						?>
						
							<li data-images="rm_container_<?php echo $count; ?>" style="width:<?php echo $width_li ?>px">
								<img src="<?php echo $rotating['image_url']; ?>" alt="" />
							</li>
							
						<?php 
								if ( $count == $nslides ) 
									break;
							
							endforeach;
						?>
					</ul>
					
					<!--<div id="rm_mask_left" class="rm_mask_left"></div>
					<div id="rm_mask_right" class="rm_mask_right"></div>
					<div id="rm_corner_left" class="rm_corner_left"></div>
					<div id="rm_corner_right" class="rm_corner_right"></div>-->
					
					<?php yiw_string_( '<h2>', yiw_get_option('slider_rotating_title'), '</h2>' ); ?>
					<div style="display:none;">
						<?php
							$count = 0;
							
							$containers = array();
							
							$i = 1;
							foreach ( $rotatings as $rotating ) {
								$containers[$i][] = '<img src="' . $rotating['image_url'] . '" alt="" />';
								
								if ( $i == $nslides )
									$i = 0;
								
								$i++;
							}
							
							foreach ( $containers as $i => $img ) {
								yiw_string_( '<div id="rm_container_' . $i . '">', "\n    " . implode( "\n    ", $img ) . "\n", '</div>' );
							}
						?>
					</div>
				</div>
				
				<!--<div class="rm_controls">
					<a id="rm_small_next" href="#" class="rm_small_next"></a>
					<a id="rm_small_prev" href="#" class="rm_small_prev"></a>
				
					<a id="rm_play" href="#" class="rm_play"><?php _e( 'Play', 'yiw' ) ?></a>
					<a id="rm_pause" href="#" class="rm_pause"><?php _e( 'Pause', 'yiw' ) ?></a>
				</div>   
			
				<div class="rm_nav">
					<a id="rm_next" href="#" class="rm_next"></a>
					<a id="rm_prev" href="#" class="rm_prev"></a>
				</div>-->
			</div>   
		</div>
		
		<?php endif; ?>
</div>
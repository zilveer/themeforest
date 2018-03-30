<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */             

global $is_primary;
 
$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' ); 

$width  = yit_slide_get( 'width' );
$height = yit_slide_get( 'height' );

$width_inline  = ( empty( $width ) )  ? "" : "width:{$width}px;";
$height_inline = ( empty( $height ) ) ? '' : "height:{$height}px;";

$slider_class = 'rm_container';
if ( ! $is_primary ) $slider_class .= ' container';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

$background = ( yit_slide_get( 'header-background' ) != '' ) ? 'style="background-color: ' . yit_slide_get( 'header-background' ) . ';"' : '' ;
?>
 
        			<div class="rm_wrapper <?php if ($background != '') echo 'back-color' ?>" <?php echo $background ?>> 
        				<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="<?php echo $width_inline; ?><?php echo $height_inline; ?>">
        		
        					<ul>	
        						<?php 
        							$nslides = yit_slide_get( 'n_panels' );  // number of panel for slide
        							$count = 0; 
        							$max_rotation = 15;   // max value of data rotation
        							
        							while( yit_have_slide() ) :             
        								
        								// calculate image rotation for each panel
        // 								$data_rotation = ( ( ( $max_rotation * 2 ) / ( $nslides - 1 ) ) * $count ) - $max_rotation;
                                        $padding = 2.5641025641025641025641025641026;
        								$width_li = ( 100 - $padding*($nslides-1) ) / $nslides;
        								
        								$count++;
        						?>
        						
        							<li data-images="rm_container_<?php echo $count; ?>" style="width:<?php echo $width_li ?>%;<?php if ( $count == $nslides ) echo 'margin-right:0;' ?>">
        								<?php yit_slide_the( 'featured-content', array( 'container' => false ) ) ?>    
        							</li>
        							
        						<?php 
        								if ( $count == $nslides ) 
        									break;
        							
        							endwhile;
        						?>
        					</ul>
        					
        					<!--<div id="rm_mask_left" class="rm_mask_left"></div>
        					<div id="rm_mask_right" class="rm_mask_right"></div>
        					<div id="rm_corner_left" class="rm_corner_left"></div>
        					<div id="rm_corner_right" class="rm_corner_right"></div>-->
        					
        					<?php yit_string( '<h2>', yit_slide_get('slider_title'), '</h2>' ); ?>
        					<div style="display:none;">
        						<?php
        							$count = 0;
        							
        							$containers = array();
        							
        							yit_set_slider_loop( $this->shortcode_atts['name'] );
        							
        							$i = 1;
        							while( yit_have_slide() ) {
        								$containers[$i][] = yit_slide_get( 'featured-content', array( 'container' => false ) );
        								
        								if ( $i == $nslides )
        									$i = 0;
        								
        								$i++;
        							}
        							
        							foreach ( $containers as $i => $img ) {
        								yit_string( '<div id="rm_container_' . $i . '">', "\n    " . implode( "\n    ", $img ) . "\n", '</div>' );
        							}
        						?>
        					</div>
        				</div>
        				
        				<!--<div class="rm_controls">
        					<a id="rm_small_next" href="#" class="rm_small_next"></a>
        					<a id="rm_small_prev" href="#" class="rm_small_prev"></a>
        				
        					<a id="rm_play" href="#" class="rm_play"><?php _e( 'Play', 'yit' ) ?></a>
        					<a id="rm_pause" href="#" class="rm_pause"><?php _e( 'Pause', 'yit' ) ?></a>
        				</div>   
        			
        				<div class="rm_nav">
        					<a id="rm_next" href="#" class="rm_next"></a>
        					<a id="rm_prev" href="#" class="rm_prev"></a>
        				</div>-->
        			</div>   
        
 
        <script type="text/javascript">
    		var 	yit_slider_rotating_npanels = <?php echo yit_slide_get('n_panels' ) * 1000 ?>,
    				yit_slider_rotating_timeDiff = <?php echo yit_slide_get( 'speed' ) * 1000 ?>,
    				yit_slider_rotating_slideshowTime = <?php echo yit_slide_get( 'interval' ) * 1000 ?>; 
            
            jQuery(document).ready(function($){     
                $(window).load(function(){      
                    $('#<?php echo $slider_id ?>').bind('yit_change_rotating_height', function(){
                        $(this).height( $(this).find('img').height() );    
                    }).trigger('yit_change_rotating_height'); 
                });
                
                $(window).resize(function(){
                    $('#<?php echo $slider_id ?>').trigger('yit_change_rotating_height');    
                });          
            }); 
        </script>
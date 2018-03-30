		<?php        
			if ( ! yiw_can_show_slider() )
				return;
				
			$slider = yiw_slider_type();
			if ( $slider != 'none' )
			     get_template_part( 'slider', $slider ); 
		?>                      
		
	    <?php if ( yiw_get_option( 'slider_responsive' ) == 'fixed-image' && $slider != 'fixed-image' ) : ?>   
	        <div class="slider-mobile">
               <?php get_template_part( 'slider', 'fixed-image' ); ?>    
	        </div>   
        <?php endif; ?>
    <?php
      // Getting the slider images for later use
      $image1 = get_option('icy_slider_1'); 
      $image2 = get_option('icy_slider_2'); 
      $image3 = get_option('icy_slider_3'); 
      $image4 = get_option('icy_slider_4'); 
      $image5 = get_option('icy_slider_5');
      
      $imageUrl1 = get_option('icy_slider_url_1'); 
      $imageUrl2 = get_option('icy_slider_url_2'); 
      $imageUrl3 = get_option('icy_slider_url_3'); 
      $imageUrl4 = get_option('icy_slider_url_4'); 
      $imageUrl5 = get_option('icy_slider_url_5'); 
    
      $speed        = get_option('icy_slider_speed');
      $animation    = get_option('icy_slider_animation');

      ?>

    <script type="text/javascript"> 

        jQuery(document).ready(function($) { 

            jQuery("#flex-home").flexslider({
                                animation: "<?php echo $animation ?>",
                                slideshowSpeed: <?php echo $speed; ?>,
                                animationDuration: 600,
                                controlNav: false,   
                                slideshow: true,
                                touchSwipe: true,
                                pauseOnHover: true
            });

        }); 
    </script>
                        
            <!--BEGIN #flex-container -->
            <div class="flex-container">
                
                <!--BEGIN .flexslider -->
                <div id="flex-home" class="flexslider loading">
                    
                    <ul class="slides">

                        <?php if($image1 != '') : ?>
                        <li>
                            <?php if($imageUrl1 != '') : ?>
                            
                                <a href="<?php echo $imageUrl1; ?>">
                                    <img src="<?php echo $image1; ?>" alt="<?php bloginfo(''); ?>" />
                                </a>
                                
                            <?php else: ?>
                                
                                <img id="slider-image-1" src="<?php echo $image1 ?>" alt="<?php bloginfo(''); ?>" />
                            
                            <?php endif; ?>

                            <?php if( get_option( 'icy_slider_cap_1' ) != '' ) : ?>
                            
                                <div class="flex-caption"><div><?php echo get_option( 'icy_slider_cap_1' ); ?></div></div>
                            
                            <?php endif; ?>
                        </li>

                        <?php endif; ?>

                        <?php if($image2 != '') : ?>
                        <li>
                            <?php if($imageUrl2 != '') : ?>

                                <a href="<?php echo $imageUrl2; ?>">
                                    <img src="<?php echo $image2; ?>" alt="<?php bloginfo(''); ?>" />
                                </a>

                            <?php else: ?>

                                <img id="slider-image-2" src="<?php echo $image2 ?>" alt="<?php bloginfo(''); ?>" />
                            
                            <?php endif; ?>
                            
                            <?php if( get_option( 'icy_slider_cap_2' ) != '' ) : ?>
                                
                                <div class="flex-caption"><div><?php echo get_option( 'icy_slider_cap_2' ); ?></div></div>
                            
                            <?php endif; ?>
                        </li>
                        <?php endif; ?>

                        <?php if($image3 != '') : ?>
                        <li>
                            <?php if($imageUrl3 != '') : ?>
                            <a href="<?php echo $imageUrl3; ?>"><img src="<?php echo $image3; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-3" src="<?php echo $image3 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'icy_slider_cap_3' ) != '' ) : ?>
                            <div class="flex-caption"><div><?php echo get_option( 'icy_slider_cap_3' ); ?></div></div>
                            <?php endif; ?>                       
                        </li>

                        <?php endif; ?>

                        <?php if($image4 != '') : ?>
                        <li>
                            <?php if($imageUrl4 != '') : ?>
                            <a href="<?php echo $imageUrl4; ?>"><img src="<?php echo $image4; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-4" src="<?php echo $image4 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'icy_slider_cap_4' ) != '' ) : ?>
                            <div class="flex-caption"><div><?php echo get_option( 'icy_slider_cap_4' ); ?></div></div>
                            <?php endif; ?>                            
                        </li>

                        <?php endif; ?>

                        <?php if($image5 != '') : ?>
                        <li>
                            <?php if($imageUrl5 != '') : ?>
                            <a href="<?php echo $imageUrl5; ?>"><img src="<?php echo $image5; ?>" alt="<?php bloginfo(''); ?>" /></a>
                            <?php else: ?>
                            <img id="slider-image-5" src="<?php echo $image5 ?>" alt="<?php bloginfo(''); ?>" />
                            <?php endif; ?>
                            <?php if( get_option( 'icy_slider_cap_5' ) != '' ) : ?>
                            <div class="flex-caption"><div><?php echo get_option( 'icy_slider_cap_5' ); ?></div></div>
                            <?php endif; ?>                            
                        </li>

                        <?php endif; ?>
                  </ul>
                
                <!--END .flexslider -->
                </div>
                
            <!--END #flex-container -->
            </div>
            
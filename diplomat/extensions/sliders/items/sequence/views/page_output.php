<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php

wp_enqueue_script('tmm_flexslider_js', TMM_Slider::get_application_uri() . '/items/sequence/js/jquery.sequence-min.js');

?>
<!-- I cant call it by wp_enqueue_style because its going after header but must be there -->
<link rel="stylesheet" href="<?php echo TMM_Slider::get_application_uri() ?>/items/sequence/css/sequencejs-theme.css" />

<?php if (!empty($slides)){ ?>	
		
            <?php if ( $data['slider_options']['fullscreen']){ ?>

                <div id="fullscreen" class="sequence-theme">
			
                <div id="sequence-fullscreen" class="sequence">
                    
                    <?php if($data['slider_options']['pagination']){ ?>
                        <div class="sequence-prev"><?php esc_attr_e('Prev', 'diplomat') ?></div>
                        <div class="sequence-next"><?php esc_attr_e('Next', 'diplomat') ?></div>
                    <?php } ?>              
                            
            <?php }else{ ?>
                		
			<div id="sequence" class="sequence sequence-theme" style="height:<?php echo $data['slider_options']['height'] ?>px">
                
                <?php if($data['slider_options']['pagination']){ ?>
                    <div class="sequence-prev"><?php esc_attr_e('Prev', 'diplomat') ?></div>
                    <div class="sequence-next"><?php esc_attr_e('Next', 'diplomat') ?></div>
                <?php } ?>
                            
            <?php  } ?>                             
                                
				<ul class="sequence-canvas">

					<?php foreach ($slides as $slide_num => $slide){ ?>

						<?php
						if (!isset($alias) OR empty($alias)) {
							$alias = "940*520";
						}
						//***
						$slide_url = TMM_Helper::get_image($slide['imgurl'], $alias);
                                                
                        ?>
                            <li class="animate-in">
                                <div class="full-bg-image animated-element" style="background-image: url(<?php echo esc_url($slide_url); ?>)"></div>
                                <div class="parallax-overlay animated-element"></div>

                                <div class="sequence-entry animated-element">
                                    <div class="sequence-extra">
                                        <div class="sequence-content">
                                            <?php $content = preg_replace('/^<p>|<\/p>$/', '', do_shortcode($slide['sequence_content'])); 
                                            echo esc_html($content);
                                            ?>                                                                
                                        </div>
                                    </div>
                                </div>
                            </li>						

                    <?php } ?>

				</ul><!--/ .slides-->
                <div class="sequence-pagination">
                    <?php foreach ($slides as $slide_num => $slide){ ?>
                            <div class="page"><span><?php echo esc_html($slide_num) ?></span></div>
                    <?php } ?>                                        
                </div><!--/ .sequence-pagination-->

                <?php if ( $data['slider_options']['fullscreen']){ ?>
                    </div><!--/ .sequence-->

                </div>	
                <?php }else{?>

                </div><!--/ .sequence-->			

                <?php } ?>
			

<?php } ?>

<script>
	
	jQuery(function() {
		
		(function() {                   
                        
            var fullscreen = <?php echo $data['slider_options']['fullscreen'] ?>;
                        
			var $sequence = (fullscreen) ? jQuery('#sequence-fullscreen') : jQuery('#sequence');
                        
                if ($sequence.length) {

					var mySequence = $sequence.sequence({
                        nextButton: true,
                        prevButton: true,
                        pagination: <?php echo ($data['slider_options']['pagination']) ? 'true' : 'false' ?>,
                        animateStartingFrameIn: true,
                        autoPlay: <?php echo $data['slider_options']['autoplay'] ?>,
                        autoPlayDelay: <?php echo $data['slider_options']['delay'] ?>,
                        preloader: true,
                        preloadTheseFrames: [],
                        fallback: {
                                theme: "slide",
                                speed: <?php echo $data['slider_options']['speed']  ?>
                        }
                    }).data('sequence');

                    if (fullscreen){
                        mySequence.afterLoaded = function () {
                            var self = this,
                                $window = jQuery(window),
                            resizeInit = function () {
                                self.container.height($window.outerHeight(true));
                            };
                            resizeInit();
                            $window.on('resize', function (e) {
                                resizeInit();
                            });
                        };
                        mySequence.afterLoaded.call(mySequence);
                    }
					
				}			

		})();
		 
	});
	
</script>
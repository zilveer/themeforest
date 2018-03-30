					<!-- LAUNCH INFO SLIDE -->
		            <div class="slide clearfix">
        		    	
						<!-- INFO HEADING -->
						<h1 class="home-title"><?php echo get_option('launch_info_heading'); ?></h1>
                        
						<div class="home-contents">
                            
							<!-- INFO TEXT -->
                            <p class="launch-intro"><?php echo get_option('launch_info_text'); ?></p>

                            <!-- WIDGETIZED AREA FOR SUBSCRIBE FORM -->
                            <?php
                            $launch_show_subscribe = get_option('launch_show_subscribe');
                            if ($launch_show_subscribe == 'true'){
                                if (class_exists('SimpleSubscribe')){
                                    echo do_shortcode('[simpleSubscribeForm]');
                                }
                            }else {
                                if ( ! dynamic_sidebar( __('Subscribe','framework') )) :
                                endif;
                            }
                            ?>

														
                        </div><!-- end of .home-contents -->                       
						
                    </div>
                    <!-- END OF LAUNCH INFO SLIDE -->
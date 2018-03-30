					<!-- TWITTER SLIDE -->
                    <div class="slide clearfix">
					
                        <div class="twitter-contents clearfix">
                        	
							<!-- TWITTER HEADING -->
							<h1 class="page-title"><?php echo get_option('launch_twitter_heading'); ?></h1>
                            <img class="twitter-ico" src="<?php echo get_template_directory_uri(); ?>/images/twitter-ico.png" alt="twitter" />
                            <div id="twitter_update_list">
                                <?php
                                if ( ! dynamic_sidebar( __('Tweets','framework') )) :
                                endif;
                                ?>
                            </div>

                            
                        </div><!-- end of .twitter-contents -->
						
                    </div>
                    <!-- END OF TWITTER SLIDE -->
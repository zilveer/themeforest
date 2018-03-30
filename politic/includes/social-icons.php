<!-- .social -->
                <ul class="social_bookmarks alignright six columns offset-by-five no-bottom">
                            
                            <?php //Checking if the icon is needed from the options panel ?>
                            <?php if(get_option('icy_enable_facebook_icon') == 'true') : ?>
                                <?php //Using the icon link from the options panel ?>
                                <a href="<?php echo get_option( 'icy_facebook_link' ); ?>" title="facebook"><li class="facebook"></li></a>
                            <?php endif; ?>        
                            
                            <?php //Checking if the icon is needed from the options panel ?>                
                            <?php if(get_option('icy_enable_twitter_icon') == 'true') : ?>        
                                <?php //Using the icon link from the options panel ?>
                                <a href="<?php echo get_option( 'icy_twitter_link' ); ?>" title="twitter"><li class="twitter"></li></a>
                            <?php endif; ?>

                            <?php //Checking if the icon is needed from the options panel ?>                
                            <?php if(get_option('icy_enable_googleplus_icon') == 'true') : ?>        
                                <?php //Using the icon link from the options panel ?>
                                <a href="<?php echo get_option( 'icy_googleplus_link' ); ?>" title="g+"><li class="gplus"></li></a>
                            <?php endif; ?>

                            <?php //Checking if the icon is needed from the options panel ?>
                            <?php if(get_option('icy_enable_dribbble_icon') == 'true') : ?>        
                                <?php //Using the icon link from the options panel ?>
                                <a href="<?php echo get_option( 'icy_dribbble_link' ); ?>" title="dribbble"><li class="dribbble"></li></a>
                            <?php endif; ?>                            

                            <?php //Checking if the icon is needed from the options panel ?>
                            <?php if(get_option('icy_enable_linkedin_icon') == 'true') : ?>        
                                <?php //Using the icon link from the options panel ?>
                                <a href="<?php echo get_option( 'icy_linkedin_link' ); ?>" title="linkedin"><li class="linkedin"></li></a>
                            <?php endif; ?>                            

                            <?php //Checking if the icon is needed from the options panel ?>
                            <?php if(get_option('icy_enable_rss_icon') == 'true') : ?>
                                <a href="<?php $feed = get_option(' icy_feedburner ');
                                                // if feedburner URL is provided in the Theme Options Panel it uses it
                                                if ($feed != '')
                                                {
                                                    echo get_option(' icy_feedburner ');
                                                }
                                                else
                                                {
                                                    // else it uses the standard RSS link
                                                    bloginfo('rss2_url');
                                                } ?>
                                                " title="rss">
                                    <li class="rss"></li>
                                </a>
                            <?php endif; ?>
                                    
                    </ul>
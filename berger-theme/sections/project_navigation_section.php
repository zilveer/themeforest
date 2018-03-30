<?php global $clapat_bg_theme_options; ?>
				
				
				<!-- Projects Navigation -->
                <div class="projects-nav">
                
					
					<?php previous_post_link( 'berger_portfolio', '%title' ); ?>
                    
                    <a class="all-projects" href="<?php echo esc_url( $clapat_bg_theme_options['clapat_bg_portfolio_back_main_url'] ); ?>"><?php echo $clapat_bg_theme_options['clapat_bg_portfolio_back_main_caption']; ?><span>...</span></a>
                    
                    <?php next_post_link( 'berger_portfolio', '%title' ); ?>
                                    
                </div>
                <!--/Projects Navigation -->

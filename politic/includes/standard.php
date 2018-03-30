                    <?php 
                    if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { 
                        if ( !is_singular() ) { ?>
                            
                            <div class="post-thumb">        
                            	<a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">
                            	    <?php the_post_thumbnail('thumbnail-large'); ?>
                            	</a>
                            </div>
                            
                        <?php } else { ?>
                            
                            <div class="post-thumb">        
                            	<?php the_post_thumbnail('thumbnail-large'); ?>
                            </div>	

                        <?php } ?>
                    <?php } ?>

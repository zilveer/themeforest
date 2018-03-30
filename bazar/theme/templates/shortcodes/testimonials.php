<?php
	wp_reset_query();
    
    $args = array(
        'post_type' => 'testimonial'
    );
	
	$args['posts_per_page'] = (isset($items) && $items != '') ? $items : -1;
	
	$tests = new WP_Query( $args );   
    
    if( !$tests->have_posts() ) return false ?>
    	
        <?php if($style == "square-style") { ?>
    		
            <!-- CELESTINO STYLE -->
            
            <?php
            	$last = 1;
				$cols = yit_get_sidebar_layout() != 'sidebar-no' ? 4 : 6
			?>
                    
			<?php while( $tests->have_posts() ) : $tests->the_post();
                $fulltext = '';
                $text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
                
                $title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
                $label = yit_get_post_meta( get_the_ID(), '_site-label' );
                $siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
                $website = '';
                if ($siteurl != ''):
                    if ($label != ''):
                        $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
                    else:
                        $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
                    endif;
                endif;
                ?>
                
                <?php echo ($last % 2) ? '<div class="row">' : '' ?>
                <div class="testimonial-square-style span<?php echo $cols ?>">
                    <?php if (yit_get_option('thumbnail-testimonials') && has_post_thumbnail()) :  ?>
                        <div class="thumbnail">
                            <?php yit_image( "size=thumb-testimonial-square" );//echo get_the_post_thumbnail( null, 'thumb-testimonial-square' ); ?>   
                        </div>
                    <?php 
                        else:
                            $fulltext = '-full';					
                        endif; ?>
                    <div class="testimonial-text<?php echo $fulltext; ?>"><?php echo wpautop( $text ); ?></div>
                    <div class="testimonial-name"><?php echo $title . $website; ?></div>
                </div>
                <?php echo ($last % 2) ? '' : '</div>' ?>
                <?php $last++;
            endwhile; 
            echo ($last % 2) ? '' : '</div>';
            ?>
    	
		<?php } elseif($style == "quote-style") { ?>
        
        	<!-- CHEOPE STYLE -->
        
            <div class="row">	
                <?php while( $tests->have_posts() ) : $tests->the_post();
                    $fulltext = '';
                    $text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
                    
                    $title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
                    $label = yit_get_post_meta( get_the_ID(), '_site-label' );
                    $siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
                    $smallquote = yit_get_post_meta( get_the_ID(), '_small-quote' );
                    $website = '';
                    if ($siteurl != ''):
                        if ($label != ''):
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
                        else:
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
                        endif;
                    else:
                        $website = '<span class="website">' . $label . '</span>';	
                    endif;
                    ?>
                    <div class="span3">
                        <div class="testimonial-quote-style">
                            <?php if (isset($smallquote) && $smallquote != '') : ?>
                                <blockquote><?php echo $smallquote ?></blockquote>
                            <?php endif ?>	        
                            <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                            <?php if (yit_get_option('thumbnail-testimonials') && has_post_thumbnail()) :  ?>
                                <div class="thumbnail">
                                    <?php yit_image( "size=thumb-testimonial-quote" );//echo get_the_post_thumbnail( null, 'thumb-testimonial-quote' ); ?>   
                                </div>
                            <?php endif ?>
                            <div class="testimonial-name <?php if (!yit_get_option('thumbnail-testimonials') || !get_the_post_thumbnail( null, 'thumb-testimonial-quote' )) :  ?>nothumb<?php endif ?>"><?php echo $title . $website; ?></div>
        
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
    	
		<?php } elseif($style == "circle-style") { ?>
        
        	<!-- LIBRA STYLE -->
        
            <div class="row">	
                <?php while( $tests->have_posts() ) : $tests->the_post();
                    $fulltext = '';
                    $text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
                    
                    $title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
                    $label = yit_get_post_meta( get_the_ID(), '_site-label' );
                    $siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
                    $smallquote = yit_get_post_meta( get_the_ID(), '_small-quote' );
                    $website = '';
                    if ($siteurl != ''):
                        if ($label != ''):
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
                        else:
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
                        endif;
                    else:
                        $website = '<span class="website">' . $label . '</span>';	
                    endif;
                    ?>
                    <div class="span3">
                        <div class="testimonial-circle-style">
                            <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                            <div class="testimonial-name <?php if (!yit_get_option('thumbnail-testimonials') || !get_the_post_thumbnail( null, 'thumb-testimonial-circle' )) :  ?>nothumb<?php endif ?>"><?php echo $title . $website; ?></div>
                            <div class="testimonial-quote"></div>
                            <?php if (yit_get_option('thumbnail-testimonials') && has_post_thumbnail()) :  ?>
                                <div class="thumbnail">
                                    <?php yit_image( "size=thumb-testimonial-circle" );//echo get_the_post_thumbnail( null, 'thumb-testimonial-circle' ); ?>   
                                </div>
                            <?php endif ?>
                            
        
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
            
		<?php } else { ?>
        
        	<!-- BAZAR STYLE -->
        
            <div class="row">	
                <?php while( $tests->have_posts() ) : $tests->the_post();
                    $fulltext = '';
                    $text = (strcmp(yit_get_option('text-type-testimonials'), 'content') == 0) ? get_the_content() : get_the_excerpt();
                    
                    $title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
                    $label = yit_get_post_meta( get_the_ID(), '_site-label' );
                    $siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
                    $smallquote = yit_get_post_meta( get_the_ID(), '_small-quote' );
                    $website = '';
                    if ($siteurl != ''):
                        if ($label != ''):
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
                        else:
                            $website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
                        endif;
                    else:
                        $website = '<span class="website">' . $label . '</span>';	
                    endif;
                    ?>
                    <div class="span3">
                        <div class="testimonial-bazar-style">
                            <div class="testimonial-text"><?php echo wpautop( $text ); ?></div>
                            <?php if (yit_get_option('thumbnail-testimonials') && has_post_thumbnail()) :  ?>
                                <div class="thumbnail span1">
                                	<div class="border">
                                    	<?php yit_image( 'size=thumb-testimonial-bazar' ); ?>
                                    </div>   
                                </div>
                            <?php endif ?>
                            <div class="testimonial-name <?php if (!yit_get_option('thumbnail-testimonials') || !get_the_post_thumbnail( null, 'thumb-testimonial-circle' )) :  ?>nothumb<?php endif ?>">
                            	<?php echo $title; ?>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
            
		<?php } ?>
		
        	
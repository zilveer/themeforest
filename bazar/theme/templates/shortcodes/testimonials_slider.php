<?php
	wp_reset_query();
    
    $args = array(
        'post_type' => 'testimonial'    
    );
	
	$args['posts_per_page'] = (!is_null( $items )) ? $items : -1;
    
    $tests = new WP_Query( $args );  
    $count_posts = wp_count_posts('testimonial');                        

    if ( $count_posts->publish == 1 )  
        $is_slider = false;
    else
        $is_slider = true;

    $html = '';
    if( !$tests->have_posts() ) return $html;
    
?>
   	    
<div class="testimonials-flexslider">
    <ul class="slides">
       	    
    <?php 
    //loop
    $c = 0;
    while( $tests->have_posts() ) : $tests->the_post(); 
                 
        $length = create_function( '', "return $excerpt;" );
        add_filter('excerpt_length', $length );
        add_filter('excerpt_length', $length );
		
		$title = the_title( '<strong><a href="' . get_permalink() . '" class="name">', '</a></strong>', false );
		
        $label = yit_get_post_meta( get_the_ID(), '_site-label' );
		$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
		$website = '';
		if ($siteurl != ''):
			if ($label != ''):
				$website = '<a href="' . esc_url($siteurl) . '">' . $label . '</a>';
			else:
				$website = '<a href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
			endif;
		endif;
		
		?>
            
        <li>
            <blockquote><p><a href="<?php the_permalink() ?>">&rdquo;<?php echo get_the_excerpt() ?>&rdquo;</a></p></blockquote>
            <p class="meta"><?php echo $title; ?> <?php if ($website != '') : ?> - <?php echo $website; endif; ?></p>
        </li>

    <?php $c++; endwhile; ?>         
            
            </ul> 
            <?php if ( $is_slider ) : ?>
            <div class="prev"></div>
            <div class="next"></div>       
            <?php endif; ?>
        </div> <?php      
    
    if ( $is_slider ) : ?>                    
    <script type="text/javascript">
        jQuery(function($){
            var animation = $.browser.msie || $.browser.opera ? 'fade' : 'slide';
            $('.testimonials-flexslider').flexslider({
                animation : animation,
                slideshowSpeed: <?php echo $timeout ?>,
                animationSpeed: <?php echo $speed ?>,
                touch: false,
                controlNav: false,
                directionNav: true
            });
        });
    </script>
    <?php endif;?>

<?php echo $html; ?>
<?php
	wp_reset_query();
    
    $args = array(
        'post_type' => 'testimonial'    
    );
	
	if( !is_null( $items ) ) $args['posts_per_page'] = $items;
    
    $tests = new WP_Query( $args );   
    
    $html = '';
    if( !$tests->have_posts() ) return $html;
    
    //loop           
    $html = '';
    while( $tests->have_posts() ) : $tests->the_post();
      
        $title = the_title( '<span class="title">', '</span>', false );
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
		//$website = '';// "<a href=\"" . esc_url( yit_get_post_meta( get_the_ID(), '_site-url' ) ) . "\">$website</a>";
        
        $html .= '<div class="testimonials-list group">';   
        
        $html .= '  <div class="thumb-testimonial group">';    
        $html .= '      ' . yit_image( "size=thumb-testimonial", false );//get_the_post_thumbnail( null, 'thumb-testimonial' );   
        $html .= '      <div class="shadow-thumb"></div>'; 
        $html .= '      <p class="name-testimonial group">' . $title . '<span class="website">' . $website . '</span></p>'; 
        $html .= '  </div>'; 
        
        $content = wpautop( get_the_content() );
        
        $html .= '  <div class="the-post group">';    
        $html .= '      ' . $content; 
        $html .= '  </div>';               
        
        $html .= '</div>';
    
    endwhile;
    
    wp_reset_query();
?>

<?php echo $html; ?>
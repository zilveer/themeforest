<?php

	$loop = new WP_Query( array(
        'category_name' => $cat,
        'posts_per_page' => $items                  
    ) );                          
    
    $html = '';
    while( $loop->have_posts() ) : $loop->the_post();   
        
        $html .= '<p>';
        $html .= the_title( '<a href="' . get_permalink() . '">', '</a><br />', false );
        
        $html .= get_the_excerpt();                                   
        
        $html .= '</p>';
    
    endwhile;
	
?>
<?php echo $html; ?>
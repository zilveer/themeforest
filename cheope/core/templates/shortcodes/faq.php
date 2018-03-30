<?php
	$args = array(
        'post_type' => 'bl_faq',
        'posts_per_page' => $items,
    );
    
    if(!empty( $category )) {
        $tax = 'category-faq';
        $category = array_map( 'trim', explode( ',', $category ) );
        if ( count($category) == 1 ) $category = $category[0];
        $args['tax_query'] = array(
            array(
                'taxonomy' => $tax,
                'field' => 'slug',
                'terms' => $category
            )
        );
    }
    
    $faqs = new WP_Query( $args );          
    
    $first = TRUE;
    if( $close_first ) $first = FALSE;
    
    $html = '';
    if( !$faqs->have_posts() ) return $html;
    
    //loop
    while( $faqs->have_posts() ) : $faqs->the_post();
    
            $title = the_title( '', '', false );
            $content = get_the_content();
        
            $attr = '';
            if( $first )
                $attr = ' opened="1"';
        
            $html .= do_shortcode( "[toggle title=\"$title\"{$attr}]{$content}[/toggle]" );
            $first = FALSE; 
    
    endwhile;          
?>

<?php echo $html; ?>
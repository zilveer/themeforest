<?php	
	global $icons_name;
    
    remove_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
    
    $args = array(
       'posts_per_page' => $items,
       'orderby' => 'date',
       'ignore_sticky_posts' => 1
    );                            
    
    if( isset($popular) ) $args['orderby'] = 'comment_count';
	if( isset( $cat_name ) && !empty( $cat_name ) ) $args['category_name'] = $cat_name;
    
    $args['order'] = 'DESC'; 
    
    $myposts = new WP_Query( $args );
	
    $html = "\n";       
    $html .= '<div class="recent-post group">'."\n";
    
    if( $myposts->have_posts() ) : while( $myposts->have_posts() ) : $myposts->the_post();
        
        $img = '';
        if(has_post_thumbnail())
            { $img = yit_image( "size=blog_thumb", false ); }
        else
            { $img = '<img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" />'; }
		    
        $html .= '<div class="hentry-post group">'."\n";
		if ( $date == 'yes' ) :  
			$html .= '<p class="post-date">' . get_the_date( 'M' ) . '<br /><span>' . get_the_date( 'd' ) . '</span></p>';
		endif;
        if ( $showthumb == 'yes' ) :                        
            $html .= "    <div class=\"thumb-img\">$img</div>\n";
			$html .= '<div class="text">';
		else :
			$html .= '<div class="text without-thumbnail">';
		endif;
        $html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );
        
        $html .= '<span class="postedby">' . __('posted by', 'yit') . ' <a href="' . get_author_posts_url(get_the_author_meta( 'ID' )) . '" class="author">' . get_the_author() . '</a></span>';
        $html .= '</div>'."\n";
		$html .= '</div>'."\n";
    
    endwhile; endif; 
    
    wp_reset_query();
    $html .= '</div>';
    
    add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
?>
<?php echo $html; ?>
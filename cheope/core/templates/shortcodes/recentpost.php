<?php	
	global $icons_name;

    if( !isset( $post_layout ) ) $post_layout = 'widget';

    $is_column_layout = ($post_layout=='columns');

    $blog_thumb = 'blog_thumb' ;

    $class_container =  'recent-post group';

    $class_item='';

    if ( $is_column_layout ) {
        $blog_thumb = 'blog_thumb_recentpost';
        $class_container .= ' row columns';
        $class_item = 'span3';
    }


    remove_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
    
    $args = array(
       'posts_per_page' => $items,
       'orderby' => 'date',
       'ignore_sticky_posts' => 1,
    );

    if( isset($popular) && $popular == 'yes' ) $args['orderby'] = 'comment_count';
	if( isset( $cat_name ) && !empty( $cat_name ) ) $args['category_name'] = $cat_name;

    $args['order'] = 'DESC'; 
    
    $myposts = new WP_Query( $args );
	
    $html = "\n";       
    $html .= '<div class="'.$class_container.'">'."\n";
    
    if( $myposts->have_posts() ) : while( $myposts->have_posts() ) : $myposts->the_post();
        
        $img = '';
        if(has_post_thumbnail())
            { $img = get_the_post_thumbnail( get_the_ID(), $blog_thumb ); }
        else if( $is_column_layout )
            { $img = '<img src="'.get_template_directory_uri().'/images/no_image_wide_recentposts.jpg" alt="No Image" />'; }
        else
        { $img = '<img src="'.get_template_directory_uri().'/images/no_image_recentposts.jpg" alt="No Image" />'; }
		    
        $html .= '<div class="hentry-post group '.$class_item.'">'."\n";
        if ( $showthumb == 'yes' )
            $html .= "    <div class=\"thumb-img\">$img</div>\n";
        if ($is_column_layout)
            $html .= '    <div class="clear"></div>';
		$html .= '<div class="text">';
        $html .= the_title( '<a href="'.get_permalink().'" title="'.get_the_title().'" class="title">', '</a>', false );
        
        if( strpos( $readmore, "href='#'" ) ) {
            $post_readmore = str_replace( "href='#'", "href='" . get_permalink() . "'", $readmore );
        } else {
        	$post_readmore = $readmore;
        }

        $html .= ( $date == "yes" ) ? '<p class="post-date">' . get_the_date() . '</p>' : '' . yit_content( 'excerpt', $excerpt_length, $post_readmore ) . '';
        $html .= '</div>'."\n";
		$html .= '</div>'."\n";
    
    endwhile; endif; 
    
    wp_reset_query();
    $html .= '</div>';
    
    add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links
?>
<?php echo $html; ?>
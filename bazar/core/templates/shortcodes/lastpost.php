<?php	
	$args = array(
       'post_type'=>'post',
       'category_name' => $cat_name,
       'showposts' => 1,
       'cat' => yit_theme_get_excluded_categories(2)
    );
    
    $posts = new WP_Query();
    $posts->query($args);
    
    $date = TRUE;
    if($showdate == 'no') $date = FALSE;
    $title_ = TRUE;
    if($showtitle == 'no') $title_ = FALSE; 
    
	$last = (isset($last) && strcmp($last, 'yes') == 0) ? ' last' : '';
    $html = "\n";
	while($posts->have_posts()) :    
        $posts->the_post();           
        
        global $more;
        $more = 0;

        $img = '';
        if( ! is_null( $icon ) ) 
            $img = yit_get_img( 'icons/set_icons/' . $icon . $size . '.png', $title, 'icon' );
        
        $html .= "<div class=\"$class{$last}\">\n";
        $html .= "    $img\n";
        $html .= "    <h2>$title</h2>\n"; 
        if($title_)
        {
            $html .= "    <h4 class=\"title-widget-blog\"><a href=\"".get_permalink()."\">".get_the_title()."</a></h4>\n";
        }
        if($date)
        {                                        
            $html .= "    <p>".the_date('F jS, Y', '<small>', '</small>', FALSE)."</p>\n";
        }                                  
        
        $content = get_the_content($more_text);            
        $content = wpautop( $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        
        $html .= "    $content\n";
        $html .= "</div>\n";    
    endwhile;
?>

<?php echo $html; ?>
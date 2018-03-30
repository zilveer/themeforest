<?php 
	$a_before = $a_after = '';
    	
    if ( !isset( $title_size) || $title_size == '' ) {        
        $title_size = 'h3';     
    }
    
    $img = '';
    if( ! is_null( $icon ) ) {
		$img = yit_get_img( 'icons/set_icons/' . $icon . $size . '.png', $title, 'icon' );   
		if ( empty( $img ) )
			$img = yit_get_img( 'icons/set_icons/' . $icon . '.png', $title, 'icon' );	
	}
    
    $last_class = (isset($last) && strcmp($last, 'yes') == 0) ? ' last' : '';
    
    if( isset($border) && strcmp($border, 'yes') == 0 )
    	$class .= '-border';
    
    if ( ! empty( $link ) ) {
        $link = esc_url( $link );
        if ( ! empty( $link_title ) )
            $link_title = ' title="' . $link_title . '"';
        $a_before = '<a href="' . $link . '"' . $link_title . '>';
        $a_after  = '</a>';
    }
?>

<div class="margin-bottom <?php echo $class . $last_class; ?>">
	<?php echo $a_before . $img . '<' . $title_size . '><span style="line-height:' . $size . 'px">' . $title . '</span></' . $title_size . '>' . $a_after; ?>
    <?php echo wpautop(do_shortcode($content)); ?>
</div>
<?php                               
    	
    global $yit_is_feature_tab;
    $yit_is_feature_tab = true;

	$name = sanitize_title( $name );
    $open = abs( ( int ) $open );
    
    if( empty( $name ) ) {
        return false;
    }
    
    $args = array( 'post_type' => $name, 'posts_per_page' => -1, 'order' => 'ASC' );
    $ft = new WP_Query( $args );
    
    $features_label = '';
    $features_content = '';
    $i = 0;
    
    while( $ft->have_posts() ) : $ft->the_post();
        $current = ( $open == ( $i + 1 ) ) ? 'current-feature' : '';
        
        $the_label = '<li class="features-tab-' . ( $i ) . ' ' . $current . '">';
        
        if( has_post_thumbnail() ) {
            $the_label .= get_the_post_thumbnail( get_the_ID(), 'features_tab_icon' );
        }
        
        $the_label .= get_the_title();
        $the_label .= '</li>';
        
        $the_content = '<div class="features-tab-content features-tab-' . ( $i ) . ' ' . $current . '">' . yit_addp( get_the_content() ) . '</div>';
        
        $features_label .= $the_label;
        $features_content .= $the_content;
        
        $i++;
        
    endwhile;

    $without_sidebar = ( yit_sidebar_layout() == 'sidebar-no' ) ? 'without-sidebar' : '';
    
    $html  = '<div id="features-tab-' . $name . '" class="features-tab-container ' . $without_sidebar . ' group">';
        $html .= '<ul class="features-tab-labels">' . $features_label . '</ul>';
        $html .= '<div class="features-tab-wrapper">' . $features_content . '</div>';
    $html .= '</div>';
    
    echo $html;
    
    $yit_is_feature_tab = false;
<?php

if ( function_exists( 'vc_map_get_attributes' ) ) {
    
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    switch( $type ) {
    	case 'm' : $type = 'ROADMAP'; break;
    	case 'k' : $type = 'SATELLITE'; break;
    	case 'p' : $type = 'HYBRID'; break;
    	case 'TERRAIN' : $type = 'TERRAIN'; break;
    	default : $type = 'ROADMAP'; break;
    }

    if ( ! empty( $title ) ) {
        ?>
        <h2><?php echo esc_html( $title ); ?></h2>
        <?php
    }

    echo '
        <div class="google-map ' . esc_attr( $el_class ) . ' border" 
            data-latlng="' . floatval( $latitude ) . ', ' . floatval( $longitude ) . '" 
            data-address="' . esc_html( $address ) . '" 
            data-display-type="' . esc_attr( $type ) . '" 
            data-zoom-level="' . intval( $zoom ) . '" 
            data-height="' . intval( $size ) . '">
        </div>';
        
} else {
    echo __( 'Error: Function "vc_map_get_attributes()" does not exist', 'uxbarn' );
}
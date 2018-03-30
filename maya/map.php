<?php 
            $post_id = isset($post->ID) ? $post->ID : 0;
            $src = get_post_meta( $post_id, '_map_url', true );
            if ( get_post_meta( $post_id, '_show_map', true ) != 'yes' || empty( $src ) ) 
                return;
            
            $opened = get_post_meta( $post_id, '_map_opened', true );
            
//             http://maps.google.it/?ll=37.496652,14.205322&spn=2.40995,5.410767&t=h&z=8&vpsrc=6
//             preg_match( '/ll=([-0-9.]+),([-0-9.]+)/', $src, $match );
//             $lat = $match[1];
//             $lng = $match[2];                 
//             preg_match( '/z=([0-9]+)/', $src, $match );
//             $zoom = $match[1];                               
//             preg_match( '/t=([a-z]+)/', $src, $match );
//             
//             switch( $match[1] ) {
//                 case 'h' :
//                     $type = 'HYBRID';
//                     break;
//                 case 'm' :
//                     $type = 'ROADMAP';
//                     break;
//                 default :
//                     $type = 'ROADMAP';
//                     break;
//             }                  
        ?>
        
        <div class="header-map hide-if-no-js">
        
            <div id="map-wrap"<?php if ( $opened == 'yes' ) : ?> class="opened"<?php endif ?>>
                <div id="map"><iframe 
                width="100%" 
                height="400" 
                frameborder="0" 
                scrolling="no" 
                marginheight="0" 
                marginwidth="0" 
                src="<?php echo $src; ?>&amp;output=embed">
            </iframe></div></div>
            
            <div id="map-text">
                <?php echo stripslashes( yiw_get_option( 'contact_map_text', __( 'Where we are? Find us in this great google map', 'yiw' ) ) ); ?>
            </div>
            <a href="#" class="tab-label<?php if ( $opened == 'yes' ) : ?> opened<?php else : ?> closed<?php endif; ?>"><?php if ( $opened == 'yes' ) _e( 'Close Map', 'yiw' ); else _e( 'Open Map', 'yiw' ); ?></a>
        
        </div>   
<?php if( ot_get_option( 'ut_top_header' , 'hide' ) == 'hide' ) { return; } ?>

<!-- Start UT-Top-Header -->
<div id="ut-top-header" class="hide-on-tablet hide-on-mobile clearfix">

    <div class="ut-header-inner clearfix">

        <div id="ut-top-header-left">
            
            <?php if( ot_get_option('ut_top_header_email') || ot_get_option('ut_top_header_phone') ) : ?>
            
            <ul class="fa-ul">
                
                <?php if( ot_get_option('ut_top_header_email') ) : ?>
                
                    <li><i class="fa fa-envelope-o"></i><a href="mailto:<?php echo ot_get_option('ut_top_header_email'); ?>"><?php echo ot_get_option('ut_top_header_email'); ?></a></li>
                
                <?php endif; ?>
                
                <?php if( ot_get_option('ut_top_header_phone') ) : ?>
                
                    <li><i class="fa fa-phone"></i><?php echo ot_get_option('ut_top_header_phone'); ?></li>
                
                <?php endif; ?>
                
            </ul>
            
            <?php endif; ?>
            
        </div>
        <!-- Close UT-Top-Header-Left -->
        
        <div id="ut-top-header-right">
            
              <?php $social = ot_get_option('ut_top_header_social_icons'); ?>
              
              <?php if( is_array( $social ) && !empty( $social ) ) : ?>
                  
              <ul class="fa-ul">
              
              <?php foreach( $social as $icon => $value ) : ?>
                    
                    <?php 
                    
                    $link  = !empty( $value["link"] )  ? esc_url( $value["link"] ) : '#' ;
                    $title = !empty( $value["title"] ) ? 'title="' . esc_attr( $value["title"] ) . '"' : '' ;
                    
                    ?>
                    
                    <li><a <?php echo $title; ?> href="<?php echo $link; ?>"><i class="fa <?php echo $value["icon"]; ?>"></i></a></li>
            
              <?php endforeach; ?>
            
            </ul>
            
            <?php endif; ?>            
            
        </div>
        <!-- Close UT-Top-Header-Right -->
        
    </div>   
 
</div>
<!-- Close UT-Top-Header -->
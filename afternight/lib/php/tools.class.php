<?php
    class tools{
        
        static function tour( $pos ,  $location , $id , $type , $title , $body , $nr ,  $next = true ){
            
            $nrs = explode('/' , $nr );
            
            /* stap */
            if( isset( $_COOKIE[ ZIP_NAME.'_tour_stap_' . $location . '_' . $id ] ) && (int)$_COOKIE[ ZIP_NAME.'_tour_stap_' . $location . '_' . $id ] > 0  ){
                $k = $_COOKIE[ ZIP_NAME.'_tour_stap_' . $location . '_' . $id ] + 1;
            }else{
                $k = 1;
            }
            
            if( $nrs[0] == $k ){
                $classes = '';
            }else{
                $classes = 'hidden';
            }
        ?>
            <div class="demo-tooltip <?php echo $classes; ?>" index="<?php echo $nrs[0] - 1; ?>" data-rel="<?php echo $location . '_' . $id; ?>" style="top: <?php echo $pos[0]; ?>px; left: <?php echo $pos[1]; ?>px; "><!--Virtual guide starts here. Set coordinates top and left-->
                <span class="arrow <?php echo $type; ?>" title="<?php _e('Click on this arrow to change the possition','cosmotheme'); ?>">&nbsp;</span><!--Available arrow position: left, right, top -->
                <header class="demo-steps">
                    <strong class="fl"><?php echo $title; ?></strong>
                    <span class="fr"><?php echo $nr; ?></span><!--Step number from-->
                </header>
                <div class="demo-content">
                    <?php echo stripslashes( $body ); ?>
                    <?php
                        if( $next ){
                    ?>
                            <p class="fr close"><a href="#" class="close"><?php _e( 'Do not show hints anymore' , 'cosmotheme' ); ?></a></p>
                    <?php
                        }
                    ?>
                </div>
                <footer class="demo-buttons">
                    <?php
                        if( $next ){
                    ?>
                            <p class="fl button-small gray"><a href="#" class="next"><?php _e( 'Next feature' , 'cosmotheme' ); ?></a></p>
                            <p class="fr button-small blue"><a href="#" class="skip"><?php _e( 'Skip' , 'cosmotheme' ); ?></a></p>
                    <?php
                        }else{
                            ?><p class="fr button-small red"><a href="#" class="close"><?php _e( 'Close' , 'cosmotheme' ); ?></a></p><?php
                        }
                    ?>
                            
                    
                </footer>
            </div>
        <?php
        }

        function columns_arabic_to_word($arabic, $full_width = true){
            if($full_width){
                $words = array(
                    1 => 'twelve',
                    2 => 'six',
                    3 => 'four',
                    4 => 'three',
                    5 => 'three',
                    6 => 'two',
                    7 => 'two',
                    8 => 'one',
                    9 => 'one',
                    10 => 'one',
                    11 => 'one',
                    12 => 'one',
                );
    
            }else{
                $words = array(
                    1 => 'nine`',
                    2 => 'nine',
                    3 => 'three',
                    4 => 'three',
                    5 => 'three',
                    6 => 'three',
                    7 => 'three',
                    8 => 'one',
                    9 => 'one',
                    10 => 'one',
                    11 => 'one',
                    12 => 'one',
                );

            }
            
            
            
            return  $words[ $arabic ];
            
        }
    }
?>
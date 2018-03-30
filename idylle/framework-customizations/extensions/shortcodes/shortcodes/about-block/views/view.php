<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */


?>

<!-- Two Blocks -->
<div data-animation="idy_animation_blocks" data-600-bottom="@class:noactive" data-350-bottom="@class:active">
    <div class="idy_about">

		<div class="row">
        <!-- Item -->
        <div class="col-md-4 col-sm-12 idy_text_center">

            <?php if(!empty($atts['left_block']['link'])){ ?>
            <a href="<?php echo esc_url( get_home_url('/').'/'.$atts['left_block']['link'] ); ?>" class="idy_groom idy_about_3d">
            <?php }else{ ?>
            <div class="idy_groom idy_about_3d idy_about_photo_bl">
            <?php } ?>

                <span class="idy_ab_line"></span>

                <?php /*Slider*/if( $atts['left_block']['slider_type'] == 1) {  ?>
                
                <span class="idy_about_photo idy_image_bck">

                    <span class="idy_ab_slider">
                        <?php foreach ($atts['left_block']['slider'] as $slider_left):
                            $slider_left_image = fw_resize( $slider_left['image']['attachment_id'], '400', '400', true );
                        ?>
                        <span class="idy_ab_slider_item idy_image_bck" data-image="<?php echo esc_attr($slider_left_image); ?>"></span>
                        <?php endforeach; ?>
                    </span>

                    <!-- Name -->
                    <span class="idy_about_name">
                        <!-- First Name -->
                        <b><?php echo esc_attr( $atts['left_block']['first_title'] ); ?></b> 
                        <!-- Second Name -->
                        <?php echo esc_attr( $atts['left_block']['second_title'] ); ?>
                    </span>
                    <?php if ( !empty($atts['left_block']['signature']['attachment_id']) ) {
                         $idy_left_sign = fw_resize( $atts['left_block']['signature']['attachment_id'], '', '200', true );
                    ?>
                    <img class="idy_sign" src="<?php echo esc_attr($idy_left_sign); ?>" alt="<?php echo esc_attr( $atts['left_block']['first_title'] ); ?>">
                    <?php } ?>
                </span>

                <?php /*No Slider*/ }else { ?>
                <?php 
                    if(!empty($atts['left_block']['image']['attachment_id'])) {
                        $idy_left_image = fw_resize( $atts['left_block']['image']['attachment_id'], '400', '400', true );
                    }else {
                        $idy_left_image ="";
                    }
                ?>
                <span class="idy_about_photo idy_image_bck" data-image="<?php echo esc_attr($idy_left_image); ?>">
                    <!-- Name -->
                    <span class="idy_about_name">
                        <!-- First Name -->
                        <b><?php echo esc_attr( $atts['left_block']['first_title'] ); ?></b> 
                        <!-- Second Name -->
                        <?php echo esc_attr( $atts['left_block']['second_title'] ); ?>
                    </span>
                    <?php if ( !empty($atts['left_block']['signature']['attachment_id']) ) {
                         $idy_left_sign = fw_resize( $atts['left_block']['signature']['attachment_id'], '', '200', true );
                    ?>
                    <img class="idy_sign" src="<?php echo esc_attr($idy_left_sign); ?>" alt="<?php echo esc_attr( $atts['left_block']['first_title'] ); ?>">
                    <?php } ?>
                </span>

                <?php } ?>
                

                
            <?php if(!empty($atts['left_block']['link'])){ ?>
            </a>
            <?php }else{ ?>
            </div>
            <?php } ?>
            
            <?php if (!empty($atts['left_block']['title'])) {?>
                <h4><?php echo esc_attr( $atts['left_block']['title'] ); ?></h4>
            <?php } ?>

        </div>

        

        <!-- Item -->
        <div class="col-md-4 col-md-push-4 col-sm-12 idy_text_center">
            <?php if(!empty($atts['right_block']['link'])){ ?>
            <a href="<?php echo esc_url( get_home_url('/').'/'.$atts['right_block']['link'] ); ?>" class="idy_bride idy_about_3d">
            <?php }else{ ?>
            <div class="idy_bride idy_about_3d idy_about_photo_bl">
            <?php } ?>

                <span class="idy_ab_line"></span>




                
                <?php /*Slider*/if( $atts['right_block']['slider_type'] == 1) {  ?>
                
                <span class="idy_about_photo idy_image_bck">

                    <span class="idy_ab_slider">
                        <?php foreach ($atts['right_block']['slider'] as $slider_left):
                            $slider_left_image = fw_resize( $slider_left['image']['attachment_id'], '400', '400', true );
                        ?>
                        <span class="idy_ab_slider_item idy_image_bck" data-image="<?php echo esc_attr($slider_left_image); ?>"></span>
                        <?php endforeach; ?>
                    </span>
                    
                    <!-- Name -->
                    <span class="idy_about_name">
                        <!-- First Name -->
                        <b><?php echo esc_attr( $atts['right_block']['first_title'] ); ?></b> 
                        <!-- Second Name -->
                        <?php echo esc_attr( $atts['right_block']['second_title'] ); ?>
                    </span>
                    <?php if ( !empty($atts['right_block']['signature']['attachment_id']) ) {
                         $idy_left_sign = fw_resize( $atts['right_block']['signature']['attachment_id'], '', '200', true );
                    ?>
                    <img class="idy_sign" src="<?php echo esc_attr($idy_left_sign); ?>" alt="<?php echo esc_attr( $atts['right_block']['first_title'] ); ?>">
                    <?php } ?>
                </span>

                <?php /*No Slider*/ }else { ?>
                <?php 
                    if(!empty($atts['right_block']['image']['attachment_id'])) {
                        $idy_left_image = fw_resize( $atts['right_block']['image']['attachment_id'], '400', '400', true );
                    }else {
                        $idy_left_image ="";
                    }
                ?>
                <span class="idy_about_photo idy_image_bck" data-image="<?php echo esc_attr($idy_left_image); ?>">
                    <!-- Name -->
                    <span class="idy_about_name">
                        <!-- First Name -->
                        <b><?php echo esc_attr( $atts['right_block']['first_title'] ); ?></b> 
                        <!-- Second Name -->
                        <?php echo esc_attr( $atts['right_block']['second_title'] ); ?>
                    </span>
                    <?php if ( !empty($atts['right_block']['signature']['attachment_id']) ) {
                         $idy_left_sign = fw_resize( $atts['right_block']['signature']['attachment_id'], '', '200', true );
                    ?>
                    <img class="idy_sign" src="<?php echo esc_attr($idy_left_sign); ?>" alt="<?php echo esc_attr( $atts['right_block']['first_title'] ); ?>">
                    <?php } ?>
                </span>

                <?php } ?>
                


                
            <?php if(!empty($atts['right_block']['link'])){ ?>
            </a>
            <?php }else{ ?>
            </div>
            <?php } ?>

            <?php if (!empty($atts['right_block']['title'])) {?>
                <h4><?php echo esc_attr( $atts['right_block']['title'] ); ?></h4>
            <?php } ?>

		</div>
		<!-- row end -->

        <div class="col-md-4 col-md-pull-4 col-sm-12 idy_text_center idy_about_txt">
            <?php echo do_shortcode( $atts['text'] ); ?>

            <?php if(!empty($atts['rsvp_txt'])){ ?>
            <a href="<?php echo esc_url( $atts['rsvp_link'] ); ?>" class="idy_go btn">
                <?php echo esc_attr( $atts['rsvp_txt']); ?>
            </a>
            <?php } ?>
        </div>

    </div>
    <!-- container end -->

    </div>
</div>

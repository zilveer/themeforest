<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

?>

<div class="row">

    <?php foreach ($atts['block'] as $block):
        if ( empty( $block['image'] ) ) {
            $image = get_template_directory_uri().'/images/no_image.jpg';
        } else {
            $image = fw_resize( $block['image']['attachment_id'], '300', '300', true );
        }
    ?>
    <!-- Item -->
    <div class="col-md-4 idy_idylle_block">

        <?php if(!empty($block['link'])){ ?>
        <a href="<?php echo esc_url( get_home_url('/').'/'.$block['link'] ); ?>" class="idy_block idy_about_3d">
        <?php }else{ ?>
        <div class="idy_block idy_about_3d">
        <?php } ?>
            <span class="idy_ab_line"></span>
            <span class="idy_about_photo idy_image_bck" data-image="<?php echo esc_attr($image); ?>">
                <span class="idy_about_name">
                    <!-- First Name -->
                    <b><?php echo esc_attr($block['first_title']); ?></b> 
                    <!-- Second Name  -->
                    <?php echo esc_attr($block['second_title']); ?>
                </span>
            </span>
            <span class="idy_about_photo_b idy_image_bck" data-image="<?php echo esc_attr($image); ?>"></span> 
        
        <?php if(!empty($block['link'])){ ?>
        </a>
        <?php }else{ ?>
        </div>
        <?php } ?>

        <h3><?php echo esc_attr($block['subtitle']); ?></h3>

      
    </div>
    <?php endforeach; ?>

</div>



<?php

$currentslider = $_GET['slider'];

$sliders = get_option('cp_sliders' );
foreach ($sliders as $slider) {
    if($slider->slug == $currentslider) {
        $type = $slider->type;
    }
}

?>
<div class="wrap">
    <div id="icon-options-general" class="icon32"><br /></div><h2><?php _e('Slider Editor','chow') ?> <strong><?php echo $currentslider ?></strong></h2>
    <div id="poststuff">
        <?php switch ($type) {
            case 'posts':
                require( dirname( __FILE__ ) . '/posts.admin.slides.php' );
                break;

            case 'postssel':
                require( dirname( __FILE__ ) . '/postssel.admin.slides.php' );
                break;

            case 'custom':
                require( dirname( __FILE__ ) . '/custom.admin.slides.php' );
                break;

            default:
                require( dirname( __FILE__ ) . '/custom.admin.slides.php' );
                break;
        } ?>

    </div>
</div>

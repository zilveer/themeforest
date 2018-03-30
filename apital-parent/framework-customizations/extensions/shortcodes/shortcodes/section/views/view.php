<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$section_type = $atts['section_type'];
$bg_color = $atts['bg_color'];
$bg_image = $atts['bg_image'];
$class = $atts['class'];

if(!empty($bg_image) && !empty($bg_color))
{
    $style = 'style="background-image: url('.esc_url($bg_image['url']).'); background-color: '.$bg_color.'"';
}
elseif(!empty($bg_image))
{
    $style = 'style="background-image: url('.esc_url($bg_image['url']).');"';
}
elseif(!empty($bg_color))
{
    $style = 'style="background-color: '.$bg_color.'"';
}
else
    $style = '';

?>

<?php if($section_type['section'] == 'section2'):?>
    <section class="section less-p <?php echo esc_attr($class);?>" <?php echo ($style);?>>
        <div class="w-container">
            <?php echo do_shortcode( $content ); ?>
        </div>
    </section>
<?php elseif($section_type['section'] == 'section3'):?>
    <section class="w-section section <?php echo esc_attr($class);?>" <?php echo ($style);?>>
        <div class="w-container">
            <?php echo do_shortcode( $content ); ?>
        </div>
    </section>
<?php elseif($section_type['section'] == 'section4'):?>
    <?php
        $video_type = $section_type['section4']['video_type'];
        $video = ($video_type['video'] == 'uploaded') ? $video_type['uploaded']['video'] : $video_type['link']['video'];

        if(!empty($bg_image) && !empty($bg_color))
        {
            $style = 'style="background: '.$bg_color.' url('.esc_url($bg_image['url']).');"';
        }
        elseif(!empty($bg_image))
        {
            $style = 'style="background-image: url('.esc_url($bg_image['url']).'), linear-gradient(to right, rgba(61, 196, 228, 0.98) 19%, rgba(61, 196, 228, 0.59) 75%, rgba(61, 196, 228, 0.27));"';
        }
        elseif(!empty($bg_color))
        {
            $style = 'style="background-color: '.$bg_color.'"';
        }
        else
            $style = '';
    ?>

    <section class="w-section section video <?php echo esc_attr($class);?>">
        <div class="video-wrapper">
            <?php if(!empty($video)):?>
                <div class="w-embed w-hidden-small w-hidden-tiny embed-video">
                    <video autoplay loop style="width:100%; height: auto; position:absolute; z-index: -1;">
                        <source src="<?php echo isset($video['url']) ? esc_url($video['url']) : esc_url($video); ?>" type="video/mp4">
                    </video>
                </div>
            <?php endif;?>
            <div class="video-overlay" <?php echo ($style);?>>
                <div class="w-container container-inside-v">
                    <?php echo do_shortcode( $content ); ?>
                </div>
                <div class="arrow"></div>
            </div>
        </div>
    </section>
<?php elseif($section_type['section'] == 'section5'):?>
    <section class="w-section section logo <?php echo esc_attr($class);?>" <?php echo ($style);?>>
        <div class="w-container">
            <?php echo do_shortcode( $content ); ?>
        </div>
    </section>
<?php elseif($section_type['section'] == 'section6'):?>
    <div class="w-section hero-section <?php echo esc_attr($class);?>" <?php echo ($style);?>>
        <div class="w-container">
            <div class="hero-center-div">
                <?php echo do_shortcode( $content ); ?>
            </div>
        </div>
    </div>
<?php elseif($section_type['section'] == 'section7'):?>
    <?php
        if(!empty($bg_image) && !empty($bg_color))
        {
            $style = '
                style="background-image: -webkit-linear-gradient(left, '.$bg_color.', rgba(0, 0, 0, 0.59)), url('.esc_url($bg_image['url']).');
                background-image: linear-gradient(to right, '.$bg_color.' , rgba(0, 0, 0, 0.59)), url('.esc_url($bg_image['url']).')
            "';
        }
        elseif(!empty($bg_image))
        {
            $style = 'style="background-image: url('.esc_url($bg_image['url']).')"';
        }
        elseif(!empty($bg_color))
        {
            $style = 'style="background-color: '.$bg_color.'"';
        }
        else
            $style = '';
    ?>
    <section class="w-section section parrallax <?php echo esc_attr($class);?>" data-stellar-background-ratio="0.8" <?php echo ($style);?>>
        <div class="w-container container-inside-v">
            <?php echo do_shortcode( $content ); ?>
        </div>
        <div class="arrow"></div>
    </section>
<?php else:?>
    <section class="w-section w-clearfix default-section <?php echo esc_attr($class);?>" <?php echo ($style);?>>
        <?php echo do_shortcode( $content ); ?>
    </section>
<?php endif;?>

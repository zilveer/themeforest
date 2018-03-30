<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

?>
<?php if ( ! empty( $instance ) ) :
    echo do_shortcode($before_widget); ?>

    <div class="w-col w-col-4 col-footer">
        <?php if(!empty($instance['image'])):?>
            <div><img src="<?php echo esc_url($instance['image']);?>" width="111" alt=""></div>
        <?php endif;?>

        <?php if(!empty($instance['text'])):?>
            <div class="space x1">
                <p class="p-lighter"><em><?php echo do_shortcode($instance['text']);?></em>
            </div>
        <?php endif;?>

        <?php if(!empty($instance['short'])):?>
            <div class="space">
                <p class="p-lighter"><em><?php echo do_shortcode($instance['short']);?></em>
                </p>
            </div>
        <?php endif;?>
    </div>

    <?php echo do_shortcode($after_widget);
endif;
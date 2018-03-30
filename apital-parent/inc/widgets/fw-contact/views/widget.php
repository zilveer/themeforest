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

    echo do_shortcode($before_widget);
    ?>

    <div class="w-col w-col-4 col-footer no-line">
        <?php if(!empty($instance['title'])):?>
            <div class="footer-tittle">
                <h6><?php echo esc_html($instance['title']);?></h6>
            </div>
        <?php endif;?>

        <?php if(!empty($instance['text'])):?>
            <div class="space x1">
                <p class="p-lighter"><?php echo esc_html($instance['text']);?></p>
            </div>
        <?php endif;?>
        <div class="space">
            <ul class="w-list-unstyled ul">

                <?php if(!empty($instance['adress'])):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-ico-footer">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <p class="p-lighter"><strong><?php _e('Address','fw');?>:</strong>&nbsp;&nbsp;<?php echo esc_html($instance['adress']);?></p>
                    </li>
                <?php endif;?>

                <?php if(!empty($instance['phone'])):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-ico-footer">
                            <i class="fa fa-phone"></i>
                        </div>
                        <p class="p-lighter"><strong><?php _e('Phone','fw');?>:</strong>&nbsp;<?php echo esc_html($instance['phone']);?></p>
                    </li>
                <?php endif;?>

                <?php if(!empty($instance['email'])):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-ico-footer">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <p class="p-lighter"><strong><?php _e('Email','fw');?>:</strong>&nbsp;<?php echo esc_html($instance['email']);?></p>
                    </li>
                <?php endif;?>

                <?php if(!empty($instance['website'])):?>
                    <li class="w-clearfix li-list">
                        <div class="li-ico li-ico-footer">
                            <i class="fa fa-globe"></i>
                        </div>
                        <p class="p-lighter"><strong><?php _e('Website','fw');?>:</strong>&nbsp;<?php echo esc_html($instance['website']);?></p>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>

    <?php echo do_shortcode($after_widget);
endif;
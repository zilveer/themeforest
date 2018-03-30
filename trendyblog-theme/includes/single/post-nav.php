<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    wp_reset_postdata();

    //previous/next post data
    $next_post = get_next_post();
    $prev_post = get_previous_post();
?>        
<?php if(df_option_compare('postControls','postControls',$post->ID)==true) { ?>
    <div class="cs-single-post-controls">
        <?php if(isset($prev_post->post_title)) { ?>
            <div class="cs-prev-post">
                <span><i class="fa fa-angle-double-left"></i> <?php esc_html_e("Previous",'different_themes');?></span>
                <a href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>"><?php echo esc_html($prev_post->post_title); ?></a>
            </div>
        <?php } ?>
        <?php if(isset($next_post->post_title)) { ?>
            <div class="cs-next-post">
                <span><?php esc_html_e("Next ",'different_themes');?> <i class="fa fa-angle-double-right"></i></span>
                <a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><?php echo esc_html($next_post->post_title); ?></a>
            </div>
        <?php } ?>
    </div>

<?php } ?>
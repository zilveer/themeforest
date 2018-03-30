<?php
$twitter_user = '';//$ft_option['twitter_username'];
global $post, $prop_images;

if( is_singular('property')) {
    $class_tooltip = 'share_tooltip tooltip_left';
    $class_tooltip_placement = 'right';
} else {
    $class_tooltip = 'share_tooltip';
    $class_tooltip_placement = 'top';
}
?>

<div class="<?php echo esc_attr($class_tooltip); ?> fade">
    <?php
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );

    echo '<a href="http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink()) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-facebook"></i></a>
                  <a href="https://twitter.com/intent/tweet?text=' . urlencode(get_the_title()) . '&url=' .  urlencode(get_permalink()) . '&via=' . urlencode($twitter_user ? $twitter_user : get_bloginfo('name')) .'" onclick="if(!document.getElementById(\'td_social_networks_buttons\')){window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;}"><i class="fa fa-twitter"></i></a>

                  <a href="http://pinterest.com/pin/create/button/?url='. urlencode( get_permalink() ) .'&amp;media=' . (!empty($image[0]) ? $image[0] : '') . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest"></i></a>

                  <a href="http://www.linkedin.com/shareArticle?mini=true&url='. urlencode( get_permalink() ) .'&title=' . urlencode( get_the_title() ) . '&source='.urlencode( home_url( '/' ) ).'" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-linkedin"></i></a>

                  <a href="http://plus.google.com/share?url=' . urlencode( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-google-plus"></i></a>
                  <a href="mailto:example.com?subject='.urlencode( get_the_title() ).'&body='. urlencode( get_permalink() ) .'"><i class="fa fa-envelope"></i></a>'; ?>

</div>
<span title="" data-placement="<?php echo esc_attr($class_tooltip_placement); ?>" data-toggle="tooltip" data-original-title="<?php esc_html_e('share', 'houzez'); ?>"><i class="fa fa-share-alt"></i></span>
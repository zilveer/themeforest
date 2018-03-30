<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/6/2015
 * Time: 5:19 PM
 */
$g5plus_options = &G5Plus_Global::get_options();
$show_author_info = isset($g5plus_options['show_author_info']) ? $g5plus_options['show_author_info'] : 1;
if ($show_author_info == 0) {
    return;
}
$author_description = get_the_author_meta('description');
$admin_profiles = new G5Plus_Admin_Profile();
$profiles =  $admin_profiles->get_customer_meta_fields();
$social_icons = '<ul class="social-profile">';
foreach ( $profiles['social-profiles']['fields'] as $key => $field ) {
    $social_url = get_the_author_meta($key);
    if (isset($social_url) && !empty($social_url)) {
        $social_icons .= '<li><a title="'. esc_attr($field['label']) .'" href="' . esc_url( $social_url ) . '" target="_blank"><i class="'. esc_attr($field['icon']) .'"></i></a></li>' . "\n";
    }
}
$social_icons .= '</ul>';
$job_author = '<span class="job-author">';
foreach($profiles['job-author']['fields'] as $key => $field) {
    $job = get_the_author_meta($key);
    if (isset($job) && !empty($job)) {
        $job_author .= esc_attr($job);
    }
}
$job_author .='</span>';
?>
<div class="post-author-info clearfix">
    <?php
    $author_avatar_size = apply_filters( 'g5plus_framework_author_avatar_size', 300 );
    echo get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size );
    ?>
    <div class="author-info-inner">
        <div class="author-title-social">
            <div class="title-job">
                <h6 class="p-font"><?php the_author_posts_link(); ?></h6>
                <?php echo wp_kses_post($job_author);?>
            </div>
            <?php echo wp_kses_post($social_icons); ?>
        </div>
        <p><?php the_author_meta( 'description' ); ?></p>

    </div>
</div>
<?php
global $post, $current_user, $prop_images;
wp_get_current_user();

$key = '';
$userID      =   $current_user->ID;
$fav_option = 'houzez_favorites-'.$userID;
$fav_option = get_option( $fav_option );
if( !empty($fav_option) ) {
    $key = array_search($post->ID, $fav_option);
}

if( $key != false || $key != '' ) {
    $fav_class = 'fa fa-heart';
} else {
    $fav_class = 'fa fa-heart-o';
}
?>
<span class="add_fav" data-toggle="tooltip" data-original-title="<?php esc_html_e('Favorite', 'houzez'); ?>" data-propid="<?php echo intval( $post->ID ); ?>"><i class="<?php echo esc_attr( $fav_class ); ?>"></i></span>
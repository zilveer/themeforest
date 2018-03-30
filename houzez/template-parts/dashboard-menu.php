<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/01/16
 * Time: 7:30 PM
 */
global $post;
$dash_profile_link = houzez_get_dashboard_profile_link();
$dashboard_listings = houzez_dashboard_listings();
$dashboard_add_listing = houzez_dashboard_add_listing();
$dashboard_favorites = houzez_dashboard_favorites_link();
$dashboard_search = houzez_dashboard_saved_search_link();
$dashboard_invoices = houzez_dashboard_invoices_link();
$home_link = home_url('/');

$ac_profile = $ac_props = $ac_add_prop = $ac_fav = $ac_search = $ac_invoices = '';
if( is_page_template( 'template/user_dashboard_profile.php' ) ) {
    $ac_profile = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_properties.php' ) ) {
    $ac_props = 'class=active';
} elseif ( is_page_template( 'template/submit_property.php' ) ) {
    $ac_add_prop = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_saved_search.php' ) ) {
    $ac_search = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_favorites.php' ) ) {
    $ac_fav = 'class=active';
} elseif ( is_page_template( 'template/user_dashboard_invoices.php' ) ) {
    $ac_invoices = 'class=active';
}
?>

<ul class="profile-menu-tabs">
    <?php
    if( $home_link != $dash_profile_link ) {
        echo '<li ' .esc_attr( $ac_profile ). '> <a href="' . esc_url($dash_profile_link) . '">' . esc_html__('My profile', 'houzez') . '</a></li>';
    }
    if( $home_link != $dashboard_listings && houzez_check_role() ) {
        echo '<li ' .esc_attr( $ac_props ). '> <a href="' . esc_url($dashboard_listings) . '">' . esc_html__('My Properties', 'houzez') . '</a></li>';
    }
    if( $home_link != $dashboard_add_listing && houzez_check_role() ) {
        echo '<li ' .esc_attr( $ac_add_prop ). '> <a href="' . esc_url($dashboard_add_listing) . '">' . esc_html__('Add new property', 'houzez') . '</a></li>';
    }
    if( $home_link != $dashboard_favorites ) {
        echo '<li ' .esc_attr( $ac_fav ). '> <a href="' . esc_url($dashboard_favorites) . '">' . esc_html__('Favourite properties', 'houzez') . '</a></li>';
    }
    if( $home_link != $dashboard_search ) {
        echo '<li ' .esc_attr( $ac_search ). '> <a href="' . esc_url($dashboard_search) . '">' . esc_html__('Saved Searches', 'houzez') . '</a></li>';
    }
    if( $home_link != $dashboard_invoices && houzez_check_role() ) {
        echo '<li ' .esc_attr(  $ac_invoices ). '> <a href="' . esc_url($dashboard_invoices) . '">' . esc_html__('Invoices', 'houzez') . '</a></li>';
    }
    ?>

</ul>

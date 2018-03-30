<?php
/**
 * Template Name: User Dashboard Favorite Properties
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/01/16
 * Time: 4:35 PM
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

global $houzez_local, $current_user;

wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$fav_ids = 'houzez_favorites-'.$userID;
$fav_ids = get_option( $fav_ids );
get_header();
?>
<?php get_template_part( 'template-parts/dashboard-title'); ?>


<div class="user-dashboard-full">

    <?php get_template_part( 'template-parts/dashboard', 'menu' ); ?>

    <div class="profile-top">
        <div class="profile-top-left">
            <h2 class="title"><?php the_title(); ?></h2>
        </div>
    </div>

    <div class="profile-area-content">
    <div class="account-block">
        <!--start property items-->
        <div class="property-listing list-view">
            <div class="row">

                <?php
                if( !empty( $fav_ids ) ) {
                    $args = array('post_type' => 'property', 'post__in' => $fav_ids);

                    $myposts = get_posts($args);
                    foreach ($myposts as $post) : setup_postdata($post);

                        get_template_part('template-parts/property-for-listing');

                    endforeach;
                    wp_reset_postdata();
                } else {
                    echo '<div class="col-sm-12">';
                    echo $houzez_local['favorite_not_found'];
                    echo '</div>';
                }
                ?>

            </div>
        </div>
        <!--end property items-->
    </div>
    <hr>

    <!--start Pagination-->
    <?php houzez_pagination(); ?>
    <!--start Pagination-->
    </div>
</div>


<?php get_footer(); ?>
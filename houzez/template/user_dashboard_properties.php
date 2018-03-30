<?php
/**
 * Template Name: User Dashboard Properties
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 15/10/15
 * Time: 3:33 PM
 */
if ( !is_user_logged_in() ) {
    wp_redirect(  home_url() );
}

global $houzez_local, $current_user, $post;

wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$edit_link      = houzez_dashboard_add_listing();
$dashboard_listings = houzez_dashboard_listings();
$paid_submission_type = esc_html ( houzez_option('enable_paid_submission','') );

$approved = add_query_arg( 'prop_status', 'approved', $dashboard_listings );
$pending = add_query_arg( 'prop_status', 'pending', $dashboard_listings );
$expired = add_query_arg( 'prop_status', 'expired', $dashboard_listings );

$packages_page_link = houzez_get_template_link('template/template-packages.php');

get_header();
?>

<?php get_template_part( 'template-parts/dashboard-title'); ?>

<?php
$ac_approved = $ac_pending = $ac_expired = '';
if( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'approved' ) {
    $qry_status = 'publish';
    $ac_approved = 'class=active';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'pending' ) {
    $qry_status = 'pending';
    $ac_pending = 'class=active';

} elseif( isset( $_GET['prop_status'] ) && $_GET['prop_status'] == 'expired' ) {
    $qry_status = 'expired';
    $ac_expired = 'class=active';
} else {
    $qry_status = 'publish';
    $ac_approved = 'class=active';
}

$no_of_prop   =  '9';
$paged        = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'        =>  'property',
    'author'           =>  $userID,
    'paged'             => $paged,
    'posts_per_page'    => $no_of_prop,
    'post_status'      =>  array( $qry_status )
);
$prop_qry = new WP_Query($args);
?>
    <div id="dummy_msg"></div>


<div class="user-dashboard-full">
    <?php get_template_part( 'template-parts/dashboard', 'menu' ); ?>

    <div class="profile-area-content">
        <div class="profile-top">
            <div class="profile-top-left">
                <h2 class="title"><?php the_title(); ?></h2>
            </div>
            <div class="profile-top-right">
                <div class="my-property-search">
                    <form action="#" id="search_dashboard_autocomplete" method="POST">
                        <div class="table-list">
                            <div class="form-group table-cell">
                                <input name="property_name" id="property_name" class="form-control" placeholder="<?php echo $houzez_local['search_listing']; ?>">
                            </div>
                            <div class="table-cell">
                                <button type="submit" class="btn btn-orange"><?php echo $houzez_local['search']; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="account-block">

            <div class="my-property-listing">
                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="my-list-sidebar">
                            <div class="my-property-menu">
                                <ul>
                                    <li>
                                        <a href="<?php echo esc_url($approved); ?>" <?php echo esc_attr($ac_approved); ?>><?php echo $houzez_local['published']; ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url($pending); ?>" <?php echo esc_attr($ac_pending); ?>><?php echo $houzez_local['pending']; ?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo esc_url($expired); ?>" <?php echo esc_attr($ac_expired); ?>><?php echo $houzez_local['expired']; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="my-property-menu menu-status">
                                <?php
                                if ( $paid_submission_type == 'membership' ) {
                                    houzez_get_user_current_package( $userID );
                                }
                                ?>
                            </div>
                            <div class="my-property-menu">
                                <a href="<?php echo esc_url($packages_page_link); ?>" class="btn btn-primary btn-block"> <?php echo esc_html__('Change Membership Plan', 'houzez'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <?php if( $prop_qry->have_posts() ) { ?>

                            <div class="row grid-row">
                                <?php

                                while ($prop_qry->have_posts()): $prop_qry->the_post();
                                    $post_meta_data     = get_post_custom($post->ID);
                                    $prop_images        = get_post_meta( get_the_ID(), 'fave_property_images', false );
                                    $prop_address       = get_post_meta( get_the_ID(), 'fave_property_map_address', true );
                                    $prop_featured       = get_post_meta( get_the_ID(), 'fave_featured', true );
                                    $prop_agent_display = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );

                                    get_template_part('template-parts/dashboard_property_unit');

                                endwhile;
                                ?>
                            </div>
                        <?php
                        } else {
                            print '<h4>'.$houzez_local['properties_not_found'].'</h4>';
                        }?>
                    </div>
                </div>
            </div>
            <hr>

            <!--start Pagination-->
            <?php houzez_pagination( $prop_qry->max_num_pages, $range = 2 ); ?>
            <!--start Pagination-->
        </div>
    </div>
</div>
<?php get_footer(); ?>
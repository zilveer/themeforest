<?php
/**
 * Template for property units
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 15/10/15
 * Time: 5:25 PM
 */
global $post,
       $edit_link,
       $prop_address,
       $prop_featured,
       $payment_status,
       $dashboard_listings,
       $property_status_text,
       $price_per_submission,
       $price_featured_submission,
       $currency, $paid_submission_type;

$post_id    = get_the_ID();
$edit_link  = add_query_arg( 'edit_property', $post_id, $edit_link ) ;
$delete_link  = add_query_arg( 'property_id', $post_id, $dashboard_listings ) ;
$property_status = get_post_status ( $post->ID );
$property_status_text = $property_status;
$payment_status = get_post_meta( $post_id, 'fave_payment_status', true );

$paid_submission_type  = houzez_option('enable_paid_submission');
$price_per_submission = houzez_option('price_listing_submission');
$price_featured_submission = houzez_option('price_featured_listing_submission');
$price_per_submission = floatval($price_per_submission);
$price_featured_submission = floatval($price_featured_submission);
$currency = houzez_option('currency_paid_submission');

$add_floor_plans = houzez_get_template_link_2('template/user_dashboard_floor_plans.php');
$add_floor_plans_link = add_query_arg( 'listing_id', $post_id, $add_floor_plans );

$add_multiunits = houzez_get_template_link_2('template/user_dashboard_multi_units.php');
$add_multiunits_link = add_query_arg( 'listing_id', $post_id, $add_multiunits );

if( $property_status == 'publish' ) {
    $property_status = '<span class="label label-success">'.esc_html__('Approved', 'houzez').'</span>';
} elseif( $property_status == 'pending' ) {
    $property_status = '<span class="label label-warning">'.esc_html__('Under Approved', 'houzez').'</span>';
}  elseif( $property_status == 'expired' ) {
    $property_status = '<span class="label label-danger">'.esc_html__('Expired', 'houzez').'</span>';
    $payment_status_label = '<span class="label label-danger">'.esc_html__('Expired', 'houzez').'</span>';
} else {
    $property_status = '';
}

if( $property_status_text != 'expired' ) {
    if ($paid_submission_type != 'no' && $paid_submission_type != 'membership' ) {
        if ($payment_status == 'paid') {
            $payment_status_label = '<span class="label label-success">' . esc_html__('PAID', 'houzez') . '</span>';
        } elseif ($payment_status == 'not_paid') {
            $payment_status_label = '<span class="label label-warning">' . esc_html__('NOT PAID', 'houzez') . '</span>';
        } else {
            $payment_status_label = '';
        }
    } else {
        $payment_status_label = '';
    }
}

?>

<div class="item-wrap">
    <div class="media my-property">
        <div class="media-left">
            <div class="figure-block">
                <figure class="item-thumb">
                    <?php if( $prop_featured != 0 ) { ?>
                        <span class="label-featured label"><?php esc_html_e( 'Featured', 'houzez' ); ?></span>
                    <?php } ?>
                    <a href="<?php the_permalink() ?>">
                        <?php
                        if( has_post_thumbnail( ) ) {
                            the_post_thumbnail( 'houzez-widget-prop' );
                        }else{
                            houzez_image_placeholder( 'houzez-widget-prop' );
                        }
                        ?>
                    </a>
                </figure>
            </div>
        </div>
        <div class="media-body media-middle">
            <div class="my-description">
                <h4 class="my-heading">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo $payment_status_label; ?> <?php the_title(); ?>
                    </a>
                </h4>
                <p class="address"> <?php if( !empty( $prop_address )) { echo esc_attr( $prop_address ); } ?> </p>
                <p class="status">
                    <strong><?php esc_html_e( 'Status:', 'houzez' ); ?></strong> <?php echo houzez_taxonomy_simple( 'property_status' ); ?> <br/>
                    <strong><?php esc_html_e( 'Price:', 'houzez' ); ?></strong> <?php echo houzez_listing_price(); ?> <br/>
                </p>
            </div>
            <div class="my-actions houzez-per-listing-buttons-main">
                <div class="btn-group">
                    <a href="<?php echo esc_url($edit_link); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Edit Property', 'houzez' ); ?>"><i class="fa fa-edit"></i></a>
                    <?php
                    /* Delete Post Link Bypassing Trash */
                    if ( current_user_can('delete_posts') ) {
                        $delete_post_link = get_delete_post_link( $post->ID, '', true );
                        if(!empty($delete_post_link)){
                        ?>
                            <a onclick="return confirm('<?php esc_html_e( 'Are you sure you wish to delete?', 'houzez' ); ?>')" href="<?php echo esc_url( $delete_post_link ); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Delete Property', 'houzez' ); ?>"><i class="fa fa-close"></i></a>
                    <?php
                        }
                    }?>

                    <!--<a href="#" class="action-btn" data-toggle="tooltip" data-placement="top" title="Floor Plan"><i class="fa fa-book"></i></a>-->

                    <?php if( $paid_submission_type == 'membership' && $prop_featured != 1 && $property_status_text != 'expired' ) { ?>
                        <a href="#" data-propid="<?php echo intval( $post->ID ); ?>" class="make-prop-featured action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Set as Featured', 'houzez' ); ?>"><i class="fa fa-star"></i></a>
                    <?php } ?>

                    <?php if( !empty($add_floor_plans) ) { ?>
                        <a href="<?php echo $add_floor_plans_link; ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Floor Plans', 'houzez' ); ?>"><i class="fa fa-book"></i></a>
                    <?php } ?>

                    <?php if( !empty($add_multiunits) ) { ?>
                        <a href="<?php echo $add_multiunits_link; ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Multi Units / Sub Properties', 'houzez' ); ?>"><i class="fa fa-th-large"></i></a>
                    <?php } ?>

                    <?php if( $property_status_text == 'expired' && $paid_submission_type == 'membership' ) { ?>
                        <a href="#" data-propid="<?php echo intval( $post->ID ); ?>" class="resend-for-approval action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Reactivate Listing', 'houzez' ); ?>"><i class="fa fa-upload"></i></a>
                    <?php } ?>

                    <?php if( $property_status_text == 'expired' && $paid_submission_type == 'per_listing' ) { ?>
                        <a href="#" data-propid="<?php echo intval( $post->ID ); ?>" class="resend-for-approval-perlisting action-btn" data-toggle="tooltip" data-placement="top" title="<?php esc_html_e( 'Resend for Approval', 'houzez' ); ?>"><i class="fa fa-upload"></i></a>
                    <?php } ?>
                    <!--<a href="#" class="action-btn"><i class="fa fa-area-chart"></i></a>-->
                </div>
                <?php get_template_part( 'template-parts/payment', 'buttons' ); ?>
                <?php
                $houzez_listing_type = houzez_option( 'enable_paid_submission' );
                $houzez_listing_expire = houzez_option( 'per_listing_expire_unlimited' );

                if ( $houzez_listing_type == 'per_listing' && $houzez_listing_expire == 1 ) :

                    $houzez_listing_expire_limit = houzez_option( 'per_listing_expire' );

                    $parts = explode( '-', get_the_date( 'Y-m-d' ) );
                    $today = new DateTime("now");
                    $_expire_date = date( 'Y-m-d h:i:sa', mktime( 0, 0, 0, $parts[1], $parts[2] + $houzez_listing_expire_limit, $parts[0] ) );
                    $expire_date = new DateTime( $_expire_date );

                    $interval = $expire_date->diff( $today );
                    $years = $interval->format('%y');
                    $months = $interval->format('%m');
                    $days = $interval->format('%d');
                    $hours = $interval->format('%h');
                    $minutes = $interval->format('%i');
                    // $diff = $interval->format('%y-%m-%d');

                    $time_left = '';

                    if ( $years != 0 ) :

                        $time_left = $years . ' years remaining';

                    elseif ( $months != 0 ) :

                        $time_left = $months . ' months remaining';

                    elseif ( $days != 0 ) :

                        $time_left = $days . ' days remaining';

                    elseif ( $days != 0 ) :

                        $time_left = $days . ' hours remaining';

                    elseif ( $days != 0 ) :

                        $time_left = $days . ' minutes remaining';

                    else:

                        $time_left = 'expired';

                    endif;

                    echo '<p class="expire-text"><strong>Expiration:</strong> ' . $time_left . '</p>';

                endif;
                ?>
            </div>
        </div>
    </div>
</div>


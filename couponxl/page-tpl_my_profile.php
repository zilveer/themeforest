<?php
/*
    Template Name: My Profile
*/

if( !is_user_logged_in() ){
    wp_redirect( home_url() );
}

get_header();
the_post();
get_template_part( 'includes/title' );
global $current_user;
$current_user = wp_get_current_user();

$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );
$theme_usage = couponxl_get_option( 'theme_usage' );
if( $theme_usage == 'coupons' && $subpage == 'my_deals' ){
    $subpage = '';
}
if( $theme_usage == 'deals' && $subpage == 'my_coupons' ){
    $subpage = '';
}  
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            	<div class="white-block top-border">

                    <div class="white-block-title clearfix">
                        <i class="fa fa-user"></i>
                        <h2><?php the_title(); ?></h2>
                        <div class="pull-right">
                            <ul class="list-unstyled list-inline">
                                <li>
                                    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="log-out">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                </li>
                                <li>
                                    <p><?php echo $current_user->display_name; ?></p>
                                </li>
                                <li>
                                    <?php 
                                    $avatar_url = couponxl_get_avatar_url( get_avatar( $current_user->ID, 55 ) );
                                    ?>
                                    <img src="<?php echo esc_url( $avatar_url ); ?>" class="img-responsive img-user-avatar" alt="avatar" />
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="white-block-content">
                		<div class="row">
                			<div class="col-sm-4">
                				<ul class="list-unstyled">
                					<li class="<?php echo empty( $subpage ) ? 'active' : '' ?>">
                						<a href="<?php echo $permalink; ?>">
                							<h4><?php _e( 'My Dashboard', 'couponxl' ) ?></h4>
                							<p><small><?php _e( 'Quick informations about your profile', 'couponxl' ) ?></small></p>
                						</a>
                					</li>
                					<li class="<?php echo $subpage == 'edit_profile' ? 'active' : '' ?>">
                						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'edit_profile' ), array( 'all' ) ) ); ?>">
                							<h4><?php _e( 'Edit Profile', 'couponxl' ) ?></h4>
                							<p><small><?php _e( 'Change your profile details here', 'couponxl' ) ?></small></p>
                						</a>
                					</li>
                					<li class="<?php echo $subpage == 'my_purchases' ? 'active' : '' ?>">
                						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_purchases' ), array( 'all' ) ) ); ?>">
                							<h4><?php _e( 'My Purchases', 'couponxl' ) ?></h4>
                							<p><small><?php _e( 'Check here deals you have purchased', 'couponxl' ) ?></small></p>
                						</a>
                					</li>
                                    <?php if( $theme_usage == 'all' || $theme_usage == 'coupons' ): ?>
                    					<li class="<?php echo $subpage == 'my_coupons' ? 'active' : '' ?>">
                    						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_coupons' ), array( 'all' ) ) ); ?>">
                    							<h4><?php _e( 'My Coupons', 'couponxl' ) ?></h4>
                    							<p><small><?php _e( 'Check here coupons you have submitted or add new one', 'couponxl' ) ?></small></p>
                    						</a>
                    					</li>
                                    <?php endif; ?>
                                    <?php if( $theme_usage == 'all' || $theme_usage == 'deals' ): ?>
                    					<li class="<?php echo $subpage == 'my_deals' ? 'active' : '' ?>">
                    						<a href="<?php echo esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_deals' ), array( 'all' ) ) ); ?>">
                    							<h4><?php _e( 'My Deals', 'couponxl' ) ?></h4>
                    							<p><small><?php _e( 'Check here deals you have submitted or add new one', 'couponxl' ) ?></small></p>
                    						</a>
                    					</li>
                                    <?php endif; ?>
                				</ul>
                			</div>
                			<div class="col-sm-8">
                				<?php                              
                				switch( $subpage ){
                					case 'edit_profile' : include( locate_template( 'includes/profile-pages/edit-profile.php' ) ); break;
                					case 'my_purchases' : include( locate_template( 'includes/profile-pages/my-purchases.php' ) ); break;
                					case 'my_coupons' : include( locate_template( 'includes/profile-pages/my-coupons.php' ) ); break;
                					case 'my_deals' : include( locate_template( 'includes/profile-pages/my-deals.php' ) ); break;
                					default : include( locate_template( 'includes/profile-pages/dashboard.php' ) ); break;
                				}
                				?>
                			</div>
                		</div>
                    </div>
            	</div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
<?php
/*
    Template Name: Register
*/
if( is_user_logged_in() ){
    wp_redirect( home_url() );
}
get_header();
the_post();
get_template_part( 'includes/title' );

$message = '';
$success = false;

if( !empty( $confirmation_hash ) ){
    global $couponxl_slugs;
    $username = get_query_var( $couponxl_slugs['username'], '' );
    $username = esc_sql( $username );
    $user = get_user_by( 'login', $username );
    if( !empty( $user ) ){
        $confirmation_hash = get_user_meta( $user->ID, 'confirmation_hash', true );
        if( !empty( $confirmation_hash ) && $confirmation_hash == $confirmation_hash ){
            update_user_meta( $user->ID, 'user_active_status', 'active' );
            $message = '<div class="alert alert-success">'.__( 'Thank you for confirming your email. Now you can proceed to login.', 'couponxl' ).'</div>';
        }
        else{
            $message = '<div class="alert alert-danger">'.__( 'Wrong confirmation hash.', 'couponxl' ).'</div>';
        }
    }
    else{
        $message = '<div class="alert alert-danger">'.__( 'There is no user with that username.', 'couponxl' ).'</div>';
    }
    $success = true;
}


?>
<?php if(get_option('users_can_register')): ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-block top-border">

                    <div class="white-block-title">
                        <i class="fa fa-user"></i>
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php if( !empty( $message ) ): ?>
                        <div class="white-block-content">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="ajax-response"></div>

                    <?php if( !$success ): ?>
                        <div class="white-block-content clearfix">
                            <div class="page-content clearfix">
                                <?php the_content() ?>
                            </div>
                            <form method="post" action="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_register' ) ?>">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="first_name"><?php _e( 'FIRST NAME', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your first name', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="last_name"><?php _e( 'LAST NAME', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your last name', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="email"><?php _e( 'EMAIL', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="text" name="email" id="email" class="form-control" data-validation="required|email"  data-error="<?php esc_attr_e( 'Email is empty or invalid', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="username"><?php _e( 'USERNAME', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="text" name="username" id="username" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input desired username', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="password"><?php _e( 'PASSWORD', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="password" name="password" id="password" class="form-control" data-validation="required|match" data-match="repeat_password" data-error="<?php esc_attr_e( 'Passwords do not match', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <label for="repeat_password"><?php _e( 'REPEAT PASSWORD', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <input type="password" name="repeat_password" id="repeat_password" class="form-control" data-validation="required|match" data-match="password" data-error="<?php esc_attr_e( 'Passwords do not match', 'couponxl' ); ?>">
                                        </div>
                                    </div>
                                    <?php $register_terms = couponxl_get_option( 'register_terms');
                                    if( !empty( $register_terms ) ):?>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <label><?php _e( 'TERMS & CONDITIONS', 'couponxl' ); ?> <span class="required">*</span></label>
                                            <div class="terms_conditions">
                                                <?php echo apply_filters( 'the_content', $register_terms ); ?>
                                            </div>
                                            <div class="checkbox checkbox-inline">
                                                <input type="checkbox" name="terms" id="terms" data-validation="checked" data-error="<?php esc_attr_e( 'You must read and accept terms in order to be able to register on site', 'couponxl' ); ?>">
                                                <label for="terms"><?php _e( 'I have read and agreed with the terms and conditions.', 'couponxl' ); ?></label>
                                            </div>
                                        </div>
                                        <label>
                                    </div>
                                    <?php endif; ?>
                                    <input type="checkbox" name="captcha" id="captcha">
                                    <input type="hidden" name="action" value="register">
                                    <?php wp_nonce_field('register','register_field'); ?>
                                </div>
                                <a href="javascript:;" class="btn submit-form register-form"><?php _e( 'REGISTER', 'couponxl' ); ?></a>
                            </form>
                            <?php
                            if( function_exists( 'sc_render_login_form_social_connect' ) ){
                                sc_render_login_form_social_connect();
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
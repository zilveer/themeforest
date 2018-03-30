<?php
/*
    Template Name: Login
*/
if( is_user_logged_in() ){
    wp_redirect( home_url() );
}

the_post();
$message = '';

if( isset( $_POST['login_field'] ) ){
    if( wp_verify_nonce($_POST['login_field'], 'login') ){
        $username = isset( $_POST['username'] ) ? esc_sql( $_POST['username'] ) : '';
        $password = isset( $_POST['password'] ) ? esc_sql( $_POST['password'] ) : '';

        $user = get_user_by( 'login', $username );
        if( $user ){
            $is_active = get_user_meta( $user->ID, 'user_active_status', true );
            if( empty( $is_active ) || $is_active == 'active' ){
                $user = wp_signon( array(
                    'user_login' => $username,
                    'user_password' => $password,
                    'remember' => isset( $_POST['remember_me'] ) ? true : false
                ), is_ssl() );
                if ( is_wp_error($user) ){
                    switch( $user->get_error_code() ){
                        case 'invalid_username': 
                            $message = __( 'Invalid username', 'couponxl' ); 
                            break;
                        case 'incorrect_password':
                            $message = __( 'Invalid password', 'couponxl' ); 
                            break;                    
                    }
                    $message = '<div class="alert alert-danger">'.$message.'</div>';
                }
                else{
                	if( !empty( $_POST['redirect'] ) ){
                		wp_redirect( $_POST['redirect'] );
                	}
                	else{
                		wp_redirect( home_url() );
                	}
                }
            }
            else{
                $message = '<div class="alert alert-danger">'.__( 'Your account is not activated. Check you mail for the activation link.', 'couponxl' ).'</div>';
            }
        }
        else{
            $message = '<div class="alert alert-danger">'.__( 'Invalid username', 'couponxl' ).'</div>';
        }
    }
    else{
        $message = '<div class="alert alert-danger">'.__( 'You do not permission for your action', 'couponxl' ).'</div>';
    }
}

get_header();
get_template_part( 'includes/title' );

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-block top-border">

                    <div class="white-block-title">
                        <i class="fa fa-lock"></i>
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php if( !empty( $message ) ): ?>
                        <div class="white-block-content">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <div class="white-block-content">
                        <div class="row">
                            <div class="col-sm-8">                                
                                <div class="page-content clearfix">
                                    <?php the_content() ?>
                                </div>
                                <form method="post" action="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_login' ) ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="text" name="username" placeholder="<?php esc_attr_e( 'USERNAME', 'couponxl' ); ?>"class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your username', 'couponxl' ); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <input type="password" name="password" placeholder="<?php esc_attr_e( 'PASSWORD', 'couponxl' ); ?>" class="form-control" data-validation="required"  data-error="<?php esc_attr_e( 'Please input your password', 'couponxl' ); ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="remember_me" name="remember_me">
                                                    <label for="remember_me"><?php _e( 'Remember me', 'couponxl' ); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <p align="right">
                                                <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_recover_password' ) ?>"><?php _e( 'Forgot Password?', 'couponxl' ) ?></a>
                                            </p>
                                        </div>
                                        <?php wp_nonce_field('login','login_field'); ?>
                                    </div>
                                    <input type="hidden" name="redirect" value="<?php echo !empty( $_GET['redirect'] ) ? esc_url( urldecode( $_GET['redirect']) ) : '' ?>">
                                    <a href="javascript:;" class="btn submit-form"><?php _e( 'LOG IN', 'couponxl' ) ?></a>
                                </form>
                                <?php
                                if( function_exists( 'sc_render_login_form_social_connect' ) ){
                                    sc_render_login_form_social_connect();
                                }
                                ?>                                
                            </div>
                            <div class="col-sm-4">
                                <h2><?php _e( 'Not a member?', 'couponxl' ); ?></h2>
                                <a href="<?php echo couponxl_get_permalink_by_tpl( 'page-tpl_register' ); ?>" class="btn btn-red"><?php _e( 'REGISTER HERE', 'couponxl' ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
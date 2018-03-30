<?php
/*
    Template Name: Recover Password
*/

if( is_user_logged_in() ){
    wp_redirect( home_url() );
}

get_header();
the_post();
get_template_part( 'includes/title' );

$message = '';

if( isset( $_POST['recover_field'] ) ){
    if( wp_verify_nonce($_POST['recover_field'], 'recover') ){
        $email = $_POST['email'];
        if( !empty( $email ) ){
            if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
                if( email_exists( $email ) ){
                    $user = get_user_by( 'email', $email );
                    $new_password = couponxl_random_string( 5 );
                    $update_fields = array(
                        'ID'            => $user->ID,
                        'user_pass'     => $new_password,
                    );
                    $update_id = wp_update_user( $update_fields );
                    $lost_password_message = couponxl_get_option( 'lost_password_message' );
                    $lost_password_message = str_replace( "%USERNAME%", $user->user_login, $lost_password_message );
                    $lost_password_message = str_replace( "%PASSWORD%", $new_password, $lost_password_message );

                    $email_sender = couponxl_get_option( 'email_sender' );
                    $name_sender = couponxl_get_option( 'name_sender' );
                    $headers   = array();
                    $headers[] = "MIME-Version: 1.0";
                    $headers[] = "Content-Type: text/html; charset=UTF-8"; 
                    $headers[] = "From: ".$name_sender." <".$email_sender.">";   

                    $lost_password_subject = couponxl_get_option( 'lost_password_subject' )               ;

                    $message_info = @wp_mail( $email, $lost_password_subject, $lost_password_message, $headers );
                    if( $message_info ){
                        $message = '<div class="alert alert-danger">'.__( 'Email with the new password and your username is sent to the provided email address', 'couponxl' ).'</div>';  
                    }
                    else{
                        $message = '<div class="alert alert-danger">'.__( 'There was an error trying to send an email', 'couponxl' ).'</div>';  
                    }
                }
                else{
                    $message = '<div class="alert alert-danger">'.__( 'There is no user with the provided email address', 'couponxl' ).'</div>';  
                }
            }
            else{
                $message = '<div class="alert alert-danger">'.__( 'Email address is invalid', 'couponxl' ).'</div>';
            }
        }
        else{
            $message = '<div class="alert alert-danger">'.__( 'Email address is empty', 'couponxl' ).'</div>';
        }
    }
    else{
        $message = '<div class="alert alert-danger">'.__( 'You do not permission for your action', 'couponxl' ).'</div>';
    }    
}

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-block top-border">

                    <div class="white-block-title">
                        <i class="fa fa-unlock-alt"></i>
                        <h2><?php the_title(); ?></h2>
                    </div>

                    <?php if( !empty( $message ) ): ?>
                        <div class="white-block-content">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <div class="white-block-content">
                        <div class="page-content clearfix">
                            <?php the_content() ?>
                        </div>
                        <form method="post" action="<?php  echo couponxl_get_permalink_by_tpl( 'page-tpl_recover_password' ); ?>">
                            <div class="input-group">
                                <input type="text" name="email" placeholder="<?php esc_attr_e( 'EMAIL', 'couponxl' ); ?>"class="form-control" data-validation="required|email"  data-error="<?php esc_attr_e( 'Email is empty or invaid', 'couponxl' ); ?>">
                            </div>
                            <?php wp_nonce_field('recover','recover_field'); ?>
                            <a href="javascript:;" class="btn submit-form"><?php _e( 'RECOVER PASSWORD', 'couponxl' ); ?></a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
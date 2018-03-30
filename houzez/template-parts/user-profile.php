<?php
/**
 * User Profile
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 02/10/15
 * Time: 4:43 PM
 */

global $current_user;
wp_get_current_user();
$userID                 =   $current_user->ID;
$user_login             =   $current_user->user_login;
$first_name             =   get_the_author_meta( 'first_name' , $userID );
$last_name              =   get_the_author_meta( 'last_name' , $userID );
$user_email             =   get_the_author_meta( 'user_email' , $userID );
$user_mobile            =   get_the_author_meta( 'fave_author_mobile' , $userID );
$user_phone             =   get_the_author_meta( 'fave_author_phone' , $userID );
$description            =   get_the_author_meta( 'description' , $userID );
$facebook               =   get_the_author_meta( 'fave_author_facebook' , $userID );
$twitter                =   get_the_author_meta( 'fave_author_twitter' , $userID );
$linkedin               =   get_the_author_meta( 'fave_author_linkedin' , $userID );
$pinterest              =   get_the_author_meta( 'fave_author_pinterest' , $userID );
$instagram              =   get_the_author_meta( 'fave_author_instagram' , $userID );
$googleplus             =   get_the_author_meta( 'fave_author_googleplus' , $userID );
$youtube                =   get_the_author_meta( 'fave_author_youtube' , $userID );
$vimeo                  =   get_the_author_meta( 'fave_author_vimeo' , $userID );
$user_skype             =   get_the_author_meta( 'fave_author_skype' , $userID );
$website_url            =   get_the_author_meta( 'user_url' , $userID );

$user_title             =   get_the_author_meta( 'fave_author_title' , $userID );
$user_custom_picture    =   get_the_author_meta( 'fave_author_custom_picture' , $userID );
$author_picture_id      =   get_the_author_meta( 'fave_author_picture_id' , $userID );
$about_me               =   get_the_author_meta( 'description' , $userID );
if($user_custom_picture==''){
    $user_custom_picture=get_template_directory_uri().'/images/profile-avatar.png';
}
$current_user_meta = get_user_meta( $userID );
$user_data              =   get_userdata( $userID );
$role                   =   $user_data->roles[0];
$user_show_roles_profile = houzez_option('user_show_roles_profile');
?>

<?php get_header(); ?>

<div class="profile-area account-block white-block">
    <div id="profile_message"></div>
    <div class="row">
        <div class="col-md-4 col-sm-5">
            <!--<h4><?php /*esc_html_e('Welcome back, ','houzez'); echo esc_attr( $user_login );*/?></h4>-->
            <div class="my-avatar">
                <div id="user-profile-img">
                    <div class="profile-thumb">
                        <?php
                        if( !empty( $author_picture_id ) ) {
                            $author_picture_id = intval( $author_picture_id );
                            if ( $author_picture_id ) {
                                echo wp_get_attachment_image( $author_picture_id, array( 270, 270 ) );
                                echo '<input type="hidden" class="profile-pic-id" id="profile-pic-id" name="profile-pic-id" value="' . esc_attr( $author_picture_id ).'"/>';
                            }
                        } else {
                            print '<img id="profile-image" src="'.esc_url( $user_custom_picture ).'" alt="user image" >';
                        }
                        ?>
                    </div>
                </div><!-- end of user profile image -->
                <div class="profile-img-controls">
                    <div id="errors-log"></div>
                    <div id="plupload-container"></div>
                </div><!-- end of profile image controls -->
                <a id="select-profile-image" class="btn btn-primary btn-block" href="javascript:;"><?php esc_html_e('Update Profile Picture','houzez'); ?></a>
                <!--<a id="remove-profile-image" class="btn btn-primary btn-block" href="javascript:;"><?php /*esc_html_e('Remove','houzez'); */?></a>-->
                <span class="profile-img-info"><?php esc_html_e( '*minimum 270px x 270px', 'houzez' ); ?><br/></span>
            </div>
        </div>

        <div class="col-md-8 col-sm-7">
            <h4><?php esc_html_e( 'Information', 'houzez' ); ?></h4>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="firstname"><?php esc_html_e('First Name','houzez');?></label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo esc_attr( $first_name );?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="lastname"><?php esc_html_e('Last Name','houzez');?></label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo esc_attr( $last_name );?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="useremail"><?php esc_html_e('Email','houzez');?></label>
                        <input type="text" name="prof_useremail" id="prof_useremail"  class="form-control" value="<?php echo esc_attr( $user_email );?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="title"><?php esc_html_e('Title / Position','houzez');?></label>
                        <input type="text" id="title" name="title" value="<?php echo esc_attr( $user_title );?>" class="form-control">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="about"><?php esc_html_e( 'About me', 'houzez' ); ?></label>
                        <textarea id="about" class="form-control" rows="7"><?php echo esc_attr( $about_me );?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="userphone"><?php esc_html_e('Phone','houzez');?></label>
                <input type="text" id="userphone" class="form-control" value="<?php echo esc_attr( $user_phone );?>" name="userphone">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="usermobile"><?php esc_html_e('Mobile','houzez');?></label>
                <input type="text" id="usermobile" class="form-control" value="<?php echo esc_attr( $user_mobile );?>" name="usermobile">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="userskype"><?php esc_html_e('Skype','houzez');?></label>
                <input type="text" id="userskype" class="form-control" value="<?php echo esc_attr( $user_skype );?>" name="userskype">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="website"><?php esc_html_e( 'Website URL', 'houzez' ); ?></label>
                <input type="text" id="website" class="form-control" value="<?php echo esc_url($website_url); ?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="facebook"><?php esc_html_e( 'Facebook URL', 'houzez' ); ?></label>
                <input type="text" id="facebook" name="facebook" value="<?php echo esc_url( $facebook );?>"  class="form-control">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="twitter"><?php esc_html_e( 'Twitter URL', 'houzez' ); ?></label>
                <input type="text" id="twitter" class="form-control" value="<?php echo esc_url( $twitter );?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="linkedin"><?php esc_html_e( 'Linkedin URL', 'houzez' ); ?></label>
                <input type="text" id="linkedin" class="form-control" value="<?php echo esc_url( $linkedin );?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="instagram"><?php esc_html_e( 'Instagram URL', 'houzez' ); ?></label>
                <input type="text" id="instagram" class="form-control" value="<?php echo esc_url( $instagram );?>">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="pinterest"><?php esc_html_e('Pinterest Url','houzez');?></label>
                <input type="text" id="pinterest" class="form-control" value="<?php echo esc_url( $pinterest );?>" name="pinterest">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="googleplus"><?php esc_html_e('Google Plus Url','houzez');?></label>
                <input type="text" id="googleplus" class="form-control" value="<?php echo esc_url( $googleplus );?>" name="googleplus">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="youtube"><?php esc_html_e('Youtube Url','houzez');?></label>
                <input type="text" id="youtube" class="form-control" value="<?php echo esc_url( $youtube );?>" name="youtube">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="vimeo"><?php esc_html_e('Vimeo Url','houzez');?></label>
                <input type="text" id="vimeo" class="form-control" value="<?php echo esc_url( $vimeo );?>" name="vimeo">
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 text-right">
            <?php  wp_nonce_field( 'houzez_profile_ajax_nonce', 'houzez-security-profile' );   ?>
            <button class="btn btn-primary" id="houzez_update_profile"><?php esc_html_e('Update Profile','houzez');?></button>
        </div>
    </div>
</div>

<div class="profile-area account-block white-block">
    <h4><?php esc_html_e( 'Change password', 'houzez' ); ?></h4>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="oldpass"><?php esc_html_e('Old Password','houzez');?></label>
                <input  id="oldpass" value=""  class="form-control" name="oldpass" type="password">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="newpass"><?php esc_html_e('New Password ','houzez');?></label>
                <input  id="newpass" value="" class="form-control" name="newpass" type="password">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="confirmpass"><?php esc_html_e('Confirm New Password','houzez');?></label>
                <input id="confirmpass" value="" class="form-control" name="confirmpass" type="password">
            </div>
        </div>
    </div>
    <?php   wp_nonce_field( 'houzez_pass_ajax_nonce', 'houzez-security-pass' );   ?>
    <button class="btn btn-primary" id="houzez_change_pass"><?php esc_html_e('Update Password','houzez');?></button>
</div>

<?php if( $user_show_roles_profile != 0 ) { ?>
<div class="profile-area account-block white-block">
    <h4 class="account-action-title"> <?php esc_html_e( 'Account role', 'houzez' ); ?> </h4>
    <div class="account-action-right">
        <select name="houzez_user_role" id="houzez_user_role" class="selectpicker" data-live-search="false" data-live-search-style="begins" title=" Registered User ">
            <option value="houzez_buyer" <?php selected( 'houzez_buyer', $role  ); ?>> <?php esc_html_e('Buyer', 'houzez'); ?>  </option>
            <option value="houzez_agent" <?php selected( 'houzez_agent', $role  ); ?>> <?php esc_html_e('Seller( Agent )', 'houzez'); ?> </option>
        </select>
    </div>
</div>
<?php } ?>

<div class="profile-area account-block white-block">
    <h4 class="account-action-title"> <?php esc_html_e( 'Delete account', 'houzez' ); ?> </h4>
    <div class="account-action-right">
        <input type="hidden" name="houzez_account_id" id="houzez_account_id" value="<?php echo $userID; ?>">
        <button class="btn btn-danger" id="houzez_delete_account"> <?php esc_html_e( 'Detele My Account', 'houzez' ); ?> </button>
    </div>
</div>
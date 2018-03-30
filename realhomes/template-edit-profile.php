<?php
/**
 * Template Name: Edit Profile
 *
 * Allow users to update their profile information from front end
 *
 */

get_header();
?>

<!-- Page Head -->
<?php get_template_part("banners/default_page_banner"); ?>

<!-- Content -->
<div class="container contents single">

    <div class="row">

        <div class="span12 main-wrap">

            <!-- Main Content -->
            <div class="main">

                <div class="inner-wrapper">

                    <?php
                    /* Page contents */
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                                <?php the_content(); ?>
                            </article>
                            <?php
                        endwhile;
                    endif;


                    /* Stuff related to property submit or property edit */
                    if( is_user_logged_in() ) {

                        // get user information
                        global $current_user;
                        get_currentuserinfo();
                        $current_user_meta = get_user_meta( $current_user->ID );
                        ?>
                        <form id="inspiry-edit-user" enctype="multipart/form-data" class="submit-form">

                            <div class="row-fluid">

                                <div class="span6">

                                    <div class="form-option user-profile-img-wrapper clearfix">

                                        <div id="user-profile-img">

                                            <div class="profile-thumb">
                                                <?php
                                                if( isset( $current_user_meta['profile_image_id'] ) ) {
                                                    $profile_image_id = intval( $current_user_meta['profile_image_id'][0] );
                                                    if ( $profile_image_id ) {
                                                        echo wp_get_attachment_image( $profile_image_id, 'agent-image' );
                                                        echo '<input type="hidden" class="profile-image-id" name="profile-image-id" value="' . $profile_image_id .'"/>';
                                                    }
                                                }
                                                ?>
                                            </div>

                                        </div><!-- end of user profile image -->

                                        <div class="profile-img-controls">

                                            <a id="select-profile-image" class="real-btn" href="javascript:;"><?php _e('Change','framework'); ?> <i class="fa fa-picture-o"></i></a><br/>
                                            <a id="remove-profile-image" class="real-btn" href="#remove-profile-image"><?php _e('Remove','framework'); ?> <i class="fa fa-trash-o"></i></a>

                                            <ul class="field-description">
                                                <li><?php _e( 'Profile image should have minimum width of 210px and minimum height of 210px.', 'framework' ); ?><br/></li>
                                                <li><?php _e( 'Make sure to save changes after changing the image.', 'framework' ); ?></li>
                                            </ul>

                                            <div id="errors-log"></div>

                                        </div><!-- end of profile image controls -->

                                    </div><!-- end of user-profile-img-wrapper wrapper -->

                                    <div class="form-option">
                                        <label for="first-name"><?php _e('First Name', 'framework'); ?></label>
                                        <input name="first-name" type="text" id="first-name" value="<?php if( isset( $current_user_meta['first_name'] ) ) { echo $current_user_meta['first_name'][0]; } ?>" autofocus />
                                    </div>

                                    <div class="form-option">
                                        <label for="last-name"><?php _e('Last Name', 'framework'); ?></label>
                                        <input name="last-name" type="text" id="last-name" value="<?php if( isset( $current_user_meta['last_name'] ) ) {  echo $current_user_meta['last_name'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="display-name"><?php _e('Display Name', 'framework'); ?> *</label>
                                        <input class="required" name="display-name" type="text" id="display-name" value="<?php echo $current_user->display_name; ?>" required />
                                    </div>

                                    <div class="form-option">
                                        <label for="email"><?php _e('Email', 'framework'); ?> *</label>
                                        <input class="required" name="email" type="email" id="email" value="<?php echo $current_user->user_email; ?>" required/>
                                    </div>

                                    <div class="form-option">
                                        <label for="pass1"><?php _e('Password', 'framework'); ?> <small>( <?php _e('Fill it only if you want to change your password', 'framework'); ?> )</small></label>
                                        <input name="pass1" type="password" id="pass1" />
                                    </div>

                                    <div class="form-option">
                                        <label for="pass2"><?php _e('Confirm Password', 'framework'); ?></label>
                                        <input name="pass2" type="password" id="pass2" />
                                    </div>

                                </div><!-- end of span6 -->

                                <div class="span6">

                                    <div class="form-option">
                                        <label for="description"><?php _e('Biographical Information', 'framework') ?></label>
                                        <textarea name="description" id="description" rows="5" cols="30"><?php if( isset( $current_user_meta['description'] ) ) { echo $current_user_meta['description'][0]; } ?></textarea>
                                    </div>

                                    <div class="form-option">
                                        <label for="mobile-number"><?php _e('Mobile Number', 'framework'); ?></label>
                                        <input name="mobile-number" type="text" id="mobile-number" value="<?php if( isset( $current_user_meta['mobile_number'] ) ) { echo $current_user_meta['mobile_number'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="office-number"><?php _e('Office Number', 'framework'); ?></label>
                                        <input name="office-number" type="text" id="office-number" value="<?php if( isset( $current_user_meta['office_number'] ) ) { echo $current_user_meta['office_number'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="fax-number"><?php _e('Fax Number', 'framework'); ?></label>
                                        <input name="fax-number" type="text" id="fax-number" value="<?php if( isset( $current_user_meta['fax_number'] ) ) { echo $current_user_meta['fax_number'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="facebook-url"><?php _e('Facebook URL', 'framework'); ?></label>
                                        <input name="facebook-url" type="text" id="facebook-url" value="<?php if( isset( $current_user_meta['facebook_url'] ) ) { echo $current_user_meta['facebook_url'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="twitter-url"><?php _e('Twitter URL', 'framework'); ?></label>
                                        <input name="twitter-url" type="text" id="twitter-url" value="<?php if( isset( $current_user_meta['twitter_url'] ) ) { echo $current_user_meta['twitter_url'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="google-plus-url"><?php _e('Google Plus URL', 'framework'); ?></label>
                                        <input name="google-plus-url" type="text" id="google-plus-url" value="<?php if( isset( $current_user_meta['google_plus_url'] ) ) { echo $current_user_meta['google_plus_url'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <label for="linkedin-url"><?php _e('LinkedIn URL', 'framework'); ?></label>
                                        <input name="linkedin-url" type="text" id="linkedin-url" value="<?php if( isset( $current_user_meta['linkedin_url'] ) ) { echo $current_user_meta['linkedin_url'][0]; } ?>" />
                                    </div>

                                    <div class="form-option">
                                        <?php
                                        //action hook for plugin and extra fields
                                        do_action('edit_user_profile',$current_user);
                                        // WordPress Nonce for Security Check
                                        wp_nonce_field( 'update_user', 'user_profile_nonce' );
                                        ?>
                                        <input type="hidden" name="action" value="inspiry_update_profile" />
                                    </div>

                                    <div class="form-option">
                                        <input name="update-user" type="submit" id="update-user" class="real-btn" value="<?php _e('Save Changes', 'framework'); ?>" />
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" id="form-loader" alt="Loading...">
                                    </div>

                                    <p id="form-message"></p>
                                    <ul id="form-errors"></ul>

                                </div><!-- end of span6 -->

                            </div>

                        </form><!-- #adduser -->
                        <?php
                    } else {
                        alert( __( 'Login Required:', 'framework' ), __( 'Please login to edit your profile information!', 'framework' ) );
                    }
                    ?>

                </div>

            </div><!-- End Main Content -->

        </div><!-- End span12 -->

    </div><!-- End contents row -->

</div><!-- End Content -->

<?php get_footer(); ?>

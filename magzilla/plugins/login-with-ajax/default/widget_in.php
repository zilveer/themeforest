<?php 
/*
 * This is the page users will see logged in. 
 * You can edit this, but for upgrade safety you should copy and modify this file into your template folder.
 * The location from within your template folder is plugins/login-with-ajax/ (create these directories if they don't exist)
*/
?>

<?php 
	global $current_user;
	get_currentuserinfo();
	
?>

<li class="dropdown user-login-dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <img class="media-object img-circle menu-author-avatar" alt="<?php echo $current_user->display_name; ?>" src="<?php echo fave_get_avatar_url(get_avatar( $current_user->ID, 50 )); ?>"> <?php echo $current_user->display_name; ?> <i class="fa fa-caret-down"></i>
    </a>
    
    <ul class="dropdown-menu">
        <li>

            <?php if ( class_exists('bbpress') ) { ?>
                 
                 <a href="<?php bbp_user_profile_url( $current_user->ID ); ?>" rel="me"><?php _e( 'My Profile', 'magzilla' ); ?></a>
                 <a href="<?php echo get_author_posts_url( $current_user->ID ); ?>"><?php _e( 'My Posts', 'magzilla' ); ?></a>
                 <!-- <a href="<?php bbp_user_topics_created_url( $current_user->ID ); ?>"><?php _e( 'Topics Started', 'magzilla' ); ?></a>
                 <a href="<?php bbp_user_replies_created_url( $current_user->ID ); ?>"><?php _e( 'Replies Created', 'magzilla' ); ?></a>
                 <a href="<?php bbp_favorites_permalink( $current_user->ID ); ?>"><?php _e( 'Favorites', 'magzilla' ); ?></a>
                 <a href="<?php bbp_subscriptions_permalink( $current_user->ID ); ?>"><?php _e( 'Subscriptions', 'magzilla' ); ?></a> -->

            <?php } else { ?>
                
                <a href="<?php echo get_edit_user_link( $current_user->ID ); ?>"><?php _e( 'My profile', 'magzilla' ); ?></a>
                <a href="<?php echo get_author_posts_url( $current_user->ID ); ?>"><?php _e( 'My Posts', 'magzilla' ); ?></a>
                
            <?php } ?>

                <a href="<?php echo wp_logout_url() ?>"><?php esc_html_e( 'Logout' ,'magzilla') ?></a>

        </li>
    </ul>
</li>
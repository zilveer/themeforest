<?php

// Start custom opt in
/* Display a notice that can be dismissed */
/* Display a notice that can be dismissed */
function my_admin_notice() {
    global $pagenow;
    if ( $pagenow == 'plugins.php' ) {
        echo '<div class="updated">
             <p>This notice only appears on the plugins page.</p>
         </div>';
    }
}
add_action( 'admin_notices', 'my_admin_notice' );
add_action( 'admin_notices', 'example_admin_notice' );
function example_admin_notice() {
    global $current_user ;
    $user_id = $current_user->ID;
    /* Check that the user hasn't already clicked to ignore the message */
    if ( ! get_user_meta( $user_id, 'example_ignore_notice' ) ) {
        echo '<div class="updated"><p>';
        printf( __( 'This is an annoying nag message.  Why do people make these? | <a href="%1$s">Hide Notice</a>' ), '?example_nag_ignore=0' );
        echo "</p></div>";
    }
}
add_action( 'admin_init', 'example_nag_ignore' );
function example_nag_ignore() {
    global $current_user;
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if ( isset( $_GET['example_nag_ignore'] ) && '0' == $_GET['example_nag_ignore'] ) {
        add_user_meta( $user_id, 'example_ignore_notice', 'true', true );
    }
}
//end custom optin
}
?>

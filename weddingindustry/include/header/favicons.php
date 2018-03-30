<?php if ($redux_demo['favicon_custom'] == 1) { ?>

    <!--CUSTOM FAVICONS-->
    <link rel="shortcut icon" href="<?php echo esc_url( $redux_demo['favicon_ico']['url'] ); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url( $redux_demo['favicon_iphone']['url'] ); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $redux_demo['favicon_ipad']['url'] ); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $redux_demo['favicon_retina']['url'] ); ?>">
    <!--END CUSTOM FAVICONS-->

<?php } else { ?>

    <!--FAVICONS-->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/favicon/apple-touch-icon-114x114.png">
    <!--END FAVICONS-->

<?php }; ?>








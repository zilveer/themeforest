<?php
$theme = wp_get_theme();
if ($theme->parent_theme) {
    $template_dir =  basename(get_template_directory());
    $theme = wp_get_theme($template_dir);
}
?>
<div class="wrap about-wrap porto-wrap">
    <h1><?php _e( 'Welcome to Porto!', 'porto' ); ?></h1>
    <div class="about-text"><?php echo esc_html__( 'Porto is now installed and ready to use! Read below for additional information. We hope you enjoy it!', 'porto' ); ?></div>
    <div class="porto-logo"><span class="porto-version"><?php _e( 'Version', 'porto' ); ?> <?php echo porto_version; ?></span></div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', __( "Welcome", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-system' ), __( "System Status", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-plugins' ), __( "Plugins", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto-demos' ), __( "Install Demos", 'porto' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=porto_settings' ), __( "Theme Options", 'porto' ) );
        ?>
    </h2>
    <div class="porto-section">
        <p class="about-description">
            <?php printf( __( 'Before you get started, please be sure to always check out <a href="%s" target="_blank">this documentation</a>. We outline all kinds of good information, and provide you with all the details you need to use Porto.', 'porto'), 'http://www.newsmartwave.net/wordpress/porto/documentation'); ?>
        </p>
        <p class="about-description">
            <?php printf( __( 'If you are unable to find your answer in our documentation, we encourage you to contact us through <a href="%s" target="_blank">support page</a> with your site CPanel (or FTP) and wordpress admin details. We are very happy to help you and you will get reply from us more faster than you expected.', 'porto'), 'http://smartwavethemes.net/support'); ?>
        </p>
        <p class="about-description">
            <a target="_blank" href="http://www.newsmartwave.net/wordpress/porto/documentation#changelog"><?php _e('Click here to view change logs.', 'porto') ?></a>
        </p>
        <p class="about-description">
            <?php
            printf( 'Please regenerate again default css files in <a href="%s">Theme Options > Skin > Compile Default CSS</a> after update theme.', admin_url( 'admin.php?page=porto_settings&tab=5' ) );
            ?>
        </p>
    </div>
    <div class="porto-thanks">
        <p class="description"><?php _e( 'Thank you, we hope you to enjoy using Porto!', 'porto' ); ?></p>
    </div>
</div>
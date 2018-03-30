<p><?php _e( 'Manage the appearance and behavior of various theme components with the live customizer.', 'listify' ); ?></p>

<ul>
    <li><a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[section]=sidebar-widgets-widget-area-home' ) ); ?>"><?php _e( 'Update homepage content', 'listify' ); ?></a></li>
	<li><a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[section]=style-kit' ) ); ?>"><?php _e( 'Choose a Style Kit', 'listify' ); ?></a> <?php _e( 'or', 'listify' ); ?> <a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[panel]=colors' ) ); ?>"><?php _e( 'change colors', 'listify' ); ?></a></li>
	<li><a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[section]=font-pack' ) ); ?>"><?php _e( 'Choose a Font Pack', 'listify' ); ?></a> <?php _e( 'or', 'listify' ); ?> <a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[panel]=typography' ) ); ?>"><?php _e( 'change typography', 'listify' ); ?></a></li>
    <li><a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[panel]=content' ) ); ?>"><?php _e( 'Adjust content styles and layout', 'listify' ); ?></a></li>
    <li><a href="<?php echo esc_url_raw( admin_url( 'customize.php?autofocus[panel]=listings' ) ); ?>"><?php _e( 'Update listing settings and behaviors', 'listify' ); ?></a></li>
</ul>

<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary button-large"><?php _e( 'Launch Customizer', 'listify' ); ?></a></p>

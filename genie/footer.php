<?php

global $bt_featured_slider;

if ( $bt_featured_slider ) {
	echo '<footer id="bt_footer_t" class="mainFooter">';
} else {
	echo '<footer class="mainFooter">';
} ?>
    <div class="upper">
        <div class="gutter">
            <div class="fooBoxes x3">
                <div class="fooBox">
					<?php dynamic_sidebar( 'footer_widget_area_1' ); ?>
                </div><!-- /fooBox -->

                <div class="fooBox">
					<?php dynamic_sidebar( 'footer_widget_area_2' ); ?>
                </div><!-- /fooBox -->

                <div class="fooBox">
					<?php dynamic_sidebar( 'footer_widget_area_3' ); ?>
                </div><!-- /fooBox -->
            </div><!-- /fooBoxes -->
        </div><!-- /gutter -->
    </div><!-- /upper -->
	<?php
		$facebook = '';
		if ( bt_get_option( 'contact_facebook' ) ) {
			$facebook = '<a href="' . esc_url( bt_get_option( 'contact_facebook' ) ) . '" class="ico" title="Facebook"><span data-icon="&#xf09a;"></span></a>';
		}
		$twitter = '';
		if ( bt_get_option( 'contact_twitter' ) ) {
			$twitter = '<a href="' . esc_url( bt_get_option( 'contact_twitter' ) ) . '" class="ico" title="Twitter"><span data-icon="&#xf099;"></span></a>';
		}
		$linkedin = '';
		if ( bt_get_option( 'contact_linkedin' ) ) {
			$linkedin = '<a href="' . esc_url( bt_get_option( 'contact_linkedin' ) ) . '" class="ico" title="LinkedIn"><span data-icon="&#xf0e1;"></span></a>';
		}
		$google_plus = '';
		if ( bt_get_option( 'contact_google_plus' ) ) {
			$google_plus = '<a href="' . esc_url( bt_get_option( 'contact_google_plus' ) ) . '" class="ico" title="Google+"><span data-icon="&#xf0d5;"></span></a>';
		}		
		$pinterest = '';
		if ( bt_get_option( 'contact_pinterest' ) ) {
			$pinterest = '<a href="' . esc_url( bt_get_option( 'contact_pinterest' ) ) . '" class="ico" title="Pinterest"><span data-icon="&#xf0d2;"></span></a>';
		}
		$vk = '';
		if ( bt_get_option( 'contact_vk' ) ) {
			$vk = '<a href="' . esc_url( bt_get_option( 'contact_vk' ) ) . '" class="ico" title="VK"><span data-icon="&#xf189;"></span></a>';
		}
		$slideshare = '';
		if ( bt_get_option( 'contact_slideshare' ) ) {
			$slideshare = '<a href="' . esc_url( bt_get_option( 'contact_slideshare' ) ) . '" class="ico" title="SlideShare"><span data-icon="&#xf1e7;"></span></a>';
		}
		$instagram = '';
		if ( bt_get_option( 'contact_instagram' ) ) {
			$instagram = '<a href="' . esc_url( bt_get_option( 'contact_instagram' ) ) . '" class="ico" title="Instagram"><span data-icon="&#xf16d;"></span></a>';
		}
		$youtube = '';
		if ( bt_get_option( 'contact_youtube' ) ) {
			$youtube = '<a href="' . esc_url( bt_get_option( 'contact_youtube' ) ) . '" class="ico" title="YouTube"><span data-icon="&#xf167;"></span></a>';
		}
		$vimeo = '';
		if ( bt_get_option( 'contact_vimeo' ) ) {
			$vimeo = '<a href="' . esc_url( bt_get_option( 'contact_vimeo' ) ) . '" class="ico" title="Vimeo"><span data-icon="&#xf194;"></span></a>';
		}
		
		$custom_text = '';
		if ( bt_get_option( 'custom_text' ) ) {
			$custom_text = bt_get_option( 'custom_text' );
		}
		
		$social_html = '';
		if ( $facebook != '' || $twitter != '' || $google_plus != '' || $linkedin != '' || $pinterest != '' || $vk != '' || $slideshare != '' || $instagram != '' || $youtube != '' || $vimeo != '' ) {
			$social_html = '<div class="fooSocials">
				' . $facebook . $twitter . $linkedin . $google_plus . $pinterest . $vk . $slideshare . $instagram . $youtube . $vimeo . '
			</div><!-- /fooSocials -->';
		}
	?>
    <div class="lower">
        <div class="gutter">
            <div class="fooNav">
                <nav>
                    <ul>
						<?php
							wp_nav_menu( array( 'theme_location' => 'footer', 'items_wrap' => '%3$s', 'container' => '', 'depth' => 1, 'fallback_cb' => false ));
						?>
                    </ul>
                </nav>
            </div><!-- /fooNav -->
			<?php echo $social_html; ?>
            <div class="copy">
                <?php bt_logo( true ); ?>
                <p><?php echo $custom_text; ?></p>
            </div><!-- /copy -->
            <span class="toTop"></span>
        </div><!-- /gutter -->
    </div><!-- /lower -->
</footer><!-- /mainFooter -->
</div><!-- /pageWrap -->
<?php wp_footer(); ?>
</body>
</html>
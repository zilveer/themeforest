<?php
get_header();
$settings = crazyblog_opt();
$page_settings = $settings;
$bg = (crazyblog_set( $page_settings, '404_page_title_bg' )) ? 'style=background:url(' . crazyblog_set( $page_settings, '404_page_title_bg' ) . ')' : "";
$title = (crazyblog_set( $page_settings, '404_page_title' )) ? crazyblog_set( $page_settings, '404_page_title' ) : "";
?>


<div class="pagetop" <?php echo esc_attr( $bg ); ?>>
    <div class="page-name">
        <div class="container">
            <span><?php esc_html_e( '404', 'crazyblog' ); ?></span>
			<?php echo crazyblog_get_breadcrumbs(); ?>
        </div>
    </div>
</div><!-- Page Top -->

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-12 column">
                    <div class="error-page">
                        <h2>4<i>0</i>4</h2>
						<?php echo wp_kses_post( (crazyblog_set( $page_settings, '404_page_title' )) ? "<span>" . crazyblog_set( $page_settings, '404_page_title' ) . "</span>" : ""  ); ?>

						<p> <?php echo crazyblog_set( $page_settings, '404_page_description' ); ?></p>
						<?php if ( crazyblog_set( $page_settings, '404_contact_button' ) ) : ?>
							<a class="dark-btn" href="<?php echo esc_url( get_permalink( crazyblog_set( $page_settings, '404_contact_page' ) ) ); ?>" title=""><?php echo wp_kses_post( (crazyblog_set( $page_settings, '404_contact_button_label' )) ? esc_html( crazyblog_set( $page_settings, '404_contact_button_label' ) ) : '' ); ?></a>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
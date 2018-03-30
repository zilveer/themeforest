
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
		<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
		<div id="coming-soon-loader" class="rings">
			<div class="ring1"></div>
			<div class="ring2"></div>
			<div class="ring3"></div>
			<div class="ring4"></div>
			<div class="ring5"></div>
		</div>
		<?php
		$settings = crazyblog_opt();
		$soon_settings = $settings;
		$social = crazyblog_set( crazyblog_set( $soon_settings, 'under_construction_social_icons' ), 'under_construction_social_icons' );
		$bg = (crazyblog_set( $soon_settings, 'const_background_image' )) ? 'style=background:url(' . crazyblog_set( $soon_settings, 'const_background_image' ) . ')' : "";
		?>
        <div class="commingsoon" <?php echo esc_attr( $bg ); ?>>
            <div class="container">
                <div class="comming-soon-logo">
                </div>
                <div class="timer">
                    <ul class="countdown">
                        <li><span class="days">00</span><p class="days_ref"><?php esc_html_e( 'days', 'crazyblog' ); ?></p></li>
                        <li> <span class="hours">00</span><p class="hours_ref"><?php esc_html_e( 'hours', 'crazyblog' ); ?></p></li>
                        <li> <span class="minutes">00</span><p class="minutes_ref"><?php esc_html_e( 'minutes', 'crazyblog' ); ?></p></li>
                        <li> <span class="seconds">00</span><p class="seconds_ref"><?php esc_html_e( 'seconds', 'crazyblog' ); ?></p></li>
                    </ul>
                </div><!-- Timer -->
                <div class="fancy-social">
					<?php echo wp_kses_post( (crazyblog_set( $soon_settings, 'under_social_icons_section_title' )) ? "<span>" . esc_html( crazyblog_set( $soon_settings, 'under_social_icons_section_title' ) ) . "</span>" : ""  ); ?>
					<?php
					$get_timezone = ( crazyblog_set( $soon_settings, 'time_zone' ) != '') ? explode( ' ', crazyblog_set( $soon_settings, 'time_zone' ), 2 ) : '';
					$timezone = (!empty( $get_timezone )) ? crazyblog_set( $get_timezone, '0' ) : '0';
					array_pop( $social );
					if ( !empty( $social ) ) :
						foreach ( $social as $s ) :
							if ( crazyblog_set( $s, 'icon' ) != '' ):
								?>
								<a href="<?php echo esc_url( crazyblog_set( $s, 'link' ) ); ?>" title=""><i class="<?php echo esc_attr( crazyblog_set( $s, 'icon' ) ); ?>"></i></a>
								<?php
							endif;
						endforeach;
					endif;
					?>
                </div><!-- Fancy Social -->
				<div class="row" id="comming-soon-notify">
					<div class="col-md-offset-3 col-md-6">
						<div class="notifications"></div>
					</div>
				</div>
				<form class="subscribtion">
					<input type="text" class="subscribe-email" placeholder="<?php esc_html_e( "Subscribe Your Email", "crazyblog" ); ?> ">
					<button class="subscribe-submit" type="submit"><?php esc_html_e( "Done", "crazyblog" ); ?></button>
				</form><!-- Form -->
			</div>
		</div><!-- Comming Soon -->
		<?php //exit(crazyblog_set($soon_settings, 'launch_date'));?>
		<?php
		if ( crazyblog_set( $soon_settings, 'launch_date' ) ) {

			crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'jquery', 'df-countdown' ) );
			$count_down_script = 'jQuery(document).ready(function ($) {
                    var date = "' . esc_js( crazyblog_set( $soon_settings, 'launch_date' ) ) . '";
                    jQuery(".countdown").downCount({
                        date: date,
                        offset: ' . esc_js( $timezone ) . '
                    });
                });';

			wp_add_inline_script( 'crazyblog_df-countdown', $count_down_script );
		}
		?>
		<?php wp_footer(); ?>
	</body>
</html>

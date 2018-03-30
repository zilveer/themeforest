		<!--BEGIN #sidebar .aside-->
		<div id="sidebar" class="aside">
			
			<!-- BEGIN #logo -->
			<div id="logo">
				<?php /*
				If "plain text logo" is set in theme options then use text
				if a logo url has been set in theme options then use that
				if none of the above then use the default logo.png */
				if (get_option('tz_plain_logo') == 'true') { ?>
				<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php } elseif (get_option('tz_logo')) { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_option('tz_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
				<?php } else { ?>
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="160" height="160" /></a>
				<?php } ?>
			<!-- END #logo -->
			</div>
			
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) ?>
		
		    <!--BEGIN #back-to-top -->
	        <a id="back-to-top" href="#"><?php _e('Back to Top', 'framework'); ?></a>
		    <!--END #back-to-top -->
		
		<!--END #sidebar .aside-->
		</div>
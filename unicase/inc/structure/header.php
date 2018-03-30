<?php
/**
 * Template functions used for the site header.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_site_branding' ) ) {
	/**
	 * Display Site Branding
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_site_branding() {
		ob_start();
		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else {
			?>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
			<?php
		}
		$site_logo = ob_get_clean();
		$site_logo = apply_filters( 'unicase_site_logo', $site_logo );
		echo sprintf( '<div class="site-branding"><a href="%s" rel="home">%s</a></div>', esc_url( home_url( '/' ) ), $site_logo );
	}
}

if ( ! function_exists( 'unicase_primary_navigation' ) ) {
	/**
	 * Display Primary Navigation
	 * @since  1.0.0
	 * @return void
	 */
	function unicase_primary_navigation() {
		?>
		<nav id="site-navigation" class="main-navigation navbar yamm" aria-label="<?php esc_attr_e( 'Primary Navigation', 'unicase' ); ?>">
			<div class="container">
				<div class="navbar-header">
					<button class="navbar-toggle collapsed" data-target="#uc-horizontal-menu-collapse" data-toggle="collapse" type="button">
						<span class="sr-only"><?php echo esc_html__( 'Toggle navigation', 'unicase' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
                
                <div class="nav-bg-class">
					<div class="collapse navbar-collapse" id="uc-horizontal-menu-collapse">
						<div class="nav-outer">
							<?php 
								$navbar_menu_class = apply_filters( 'unicase_primary_dropdown_style', 'navbar-nav-inverse' );
								wp_nav_menu(
									array(
										'theme_location'	=> 'primary',
										'container'			=> 'false',
										'menu_class'        => 'nav navbar-nav ' . $navbar_menu_class,
										'fallback_cb'		=> 'wp_bootstrap_navwalker::fallback',
										'walker'			=> new wp_bootstrap_navwalker()
									)
								);
							?>
						</div>
						<div class="clearfix"></div>
					</div><!-- /.navbar-collapse -->
				</div>
			</div><!-- /.container -->
		</nav><!-- #site-navigation -->
		<?php
	}
}

if ( ! function_exists( 'unicase_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.4.1
	 * @return void
	 */
	function unicase_skip_links() {
		?>
		<div class="skip-links">
			<a class="skip-link sr-only" href="#site-navigation"><?php esc_html_e( 'Skip to navigation', 'unicase' ); ?></a>
			<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'unicase' ); ?></a>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_top_bar' ) ) {
	function unicase_top_bar() {
		?>
		<div class="top-bar">
	        <div class="container">

	        	<?php wp_nav_menu( array(
	        		'theme_location'	=> 'topbar-left',
	        		'container'			=> false,
	        		'depth'				=> 2,
	        		'menu_class'		=> 'list-unstyled quick-links pull-left flip',
	        		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	        		'walker'            => new wp_bootstrap_navwalker()
        		) ); ?>

        		<?php wp_nav_menu( array(
	        		'theme_location'	=> 'topbar-right',
	        		'container'			=> false,
	        		'depth'				=> 2,
	        		'menu_class'		=> 'list-unstyled quick-links pull-right flip',
	        		'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
	        		'walker'            => new wp_bootstrap_navwalker()
        		) ); ?>

	        </div>
	    </div><!-- /.top-bar -->
		<?php
	}
}

if( ! function_exists( 'unicase_main_header' ) ) {
	function unicase_main_header() {
		?>
		<div class="main-header">
			<div class="container">
				<div class="main-header-content">
					<?php do_action( 'unicase_main_header_content' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if( ! function_exists( 'unicase_header_class' ) ) {
	/**
	 * Displays the classes for header
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function unicase_header_class( $class = '' ) {
		echo 'class="' . join( ' ', unicase_get_header_class( $class ) ) . '"';
	}
}

if( ! function_exists( 'unicase_get_header_class' ) ) {
	/**
	 * Retrieve the classes for the header as an array.
	 * @since 1.0.0
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function unicase_get_header_class( $class ) {

		$classes = array();
		
		if ( $class ) {
            if ( ! is_array( $class ) ) {
                $class = preg_split( '#\s+#', $class );
            }
            $classes = array_map( 'esc_attr', $class );
        }

        $classes[] = 'site-header';

        $header_style = unicase_get_header_style();

        $classes[] = $header_style;

        $page_layout_args = unicase_get_page_layout_args();

        if( ! empty( $page_layout_args['has_jumbotron'] ) && $page_layout_args['has_jumbotron'] ){
        	$classes[] = 'has-jumbotron';
        }

        if( ! empty( $page_layout_args['header_classes'] ) ) {
        	$classes[] = $page_layout_args['header_classes'];
        }

        $classes = array_map( 'esc_attr', $classes );

        $classes = apply_filters( 'unicase_header_class', $classes );

        return array_unique( $classes );
	}
}

if( ! function_exists( 'unicase_get_header_style' ) ) {
	/**
	 * Returns style of header
	 * @since 1.0.0
	 */
	function unicase_get_header_style() {
		return apply_filters( 'unicase_header_style', 'header-1' );
	}
}

if ( ! function_exists( 'unicase_header_cart' ) ) {
	function unicase_header_cart() {
		?>
		<div class="top-cart-row">
			<?php
				if( is_woocommerce_activated() ) {
					unicase_display_mini_cart();
				}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_search_bar' ) ) {
	function unicase_search_bar() {
		unicase_get_template( 'sections/unicase_search_bar.php' );
	}
}

if ( ! function_exists( 'unicase_header_contact_info' ) ) {
	function unicase_header_contact_info() {
		ob_start();
		?>
		<div class="contact-row">
			<div class="phone inline">
				<i class="icon fa fa-phone"></i> <?php echo '(400) 888 888 868'; ?>
			</div>
			<div class="contact inline">
				<i class="icon fa fa-envelope"></i> <?php echo 'sales@unicase.com'; ?>
			</div>
		</div>
		<?php
		$contact_info = ob_get_clean();
		echo apply_filters( 'unicase_header_contact_info', $contact_info );
	}
}

if ( ! function_exists( 'unicase_top_search_holder' ) ) {
	function unicase_top_search_holder() {
		?>
		<div class="top-search-holder">
			<?php unicase_header_contact_info(); ?>
			<?php unicase_search_bar(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'unicase_add_data_hover_attribute' ) ) {
	function unicase_add_data_hover_attribute( $atts, $item, $args, $depth ) {
		if( $args->has_children && $depth === 0 ) {

			$dropdown_trigger = apply_filters( 'unicase_' . $args->theme_location . '_dropdown_trigger', 'click', $args->theme_location );
			if( $dropdown_trigger == 'hover' ) {
				$atts['data-hover'] = 'dropdown';
				
				if( isset( $atts['data-toggle'] ) ) {
					unset( $atts['data-toggle'] );
				}
			}
		}
		
		return $atts;
	}
}

if ( ! function_exists( 'unicase_animate_dropdown_menu' ) ) {
	function unicase_animate_dropdown_menu( $dropdown_menu, $indent, $args ) {
		$dropdown_animation = apply_filters( 'unicase_' . $args->theme_location . '_dropdown_animation', 'animated fadeInUp', $args->theme_location );
		$dropdown_menu = "\n$indent<ul role=\"menu\" class=\" dropdown-menu " . $dropdown_animation . "\">\n";
		return $dropdown_menu;
	}
}

if ( ! function_exists( 'unicase_site_favicon' ) ) {
	function unicase_site_favicon() {
		$favicon_url = apply_filters( 'unicase_site_favicon_url', get_stylesheet_directory_uri() . '/assets/images/favicon.png' );
		?>
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon_url );?>">
		<?php
	}
}
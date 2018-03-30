<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="page-wrapper">
	<div class="header">
		<div class="header-topbar">
			<div class="container">
				<?php if ( is_user_logged_in() ) : ?>
					<?php $menu = wp_nav_menu( array(
						'theme_location' 	=> 'topbar-authenticated',
						'fallback_cb' 		=> false,
						'container_class' 	=> 'menu-container',
						'echo'				=> false,
					) ); ?>
				<?php else: ?>
					<?php $menu = wp_nav_menu( array(
						'theme_location' 	=> 'topbar-anonymous',
						'fallback_cb' 		=> false,
						'container_class' 	=> 'menu-container',
						'echo'				=> false,
					) ); ?>
				<?php endif; ?>


				<div class="header-topbar-left">
					<?php do_shortcode( '[realia_breadcrumb]' );?>
				</div><!-- /.header-topbar-left -->

				<div class="header-topbar-right">
					<?php echo wp_kses( $menu, wp_kses_allowed_html( 'post' ) ); ?>
				</div><!-- /.header-topbar-right -->
			</div><!-- /.container -->
		</div><!-- /.header-topbar -->

		<nav class="navbar navbar-default">
			<div class="header-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-menu" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if ( get_theme_mod( 'realia_header_logo' ) ) : ?>
								<img src="<?php echo get_theme_mod( 'realia_header_logo' ); ?>" alt="<?php echo __( 'Home', 'realia' ); ?>">
							<?php endif; ?>

							<span><?php bloginfo( 'name' ); ?></span>
						</a>

						<?php $description = get_bloginfo( 'description' ); ?>
						<?php if ( ! empty( $description ) ) : ?>
							<p class="navbar-text"><?php echo html_entity_decode( $description ); ?></p>
						<?php endif; ?>
					</div><!-- /.navbar-header -->

					<?php if ( get_theme_mod( 'realia_header_1_information_box_text' ) && get_theme_mod( 'realia_header_1_information_box_icon' ) ) : ?>
						<div class="navbar-info">
							<i class="<?php echo get_theme_mod( 'realia_header_1_information_box_icon' ); ?>"></i> <?php echo get_theme_mod( 'realia_header_1_information_box_text' ); ?>
						</div><!-- /.navbar-info -->
					<?php endif; ?>

					<?php if ( get_theme_mod( 'realia_header_2_information_box_text' ) && get_theme_mod( 'realia_header_2_information_box_icon' ) ) : ?>
						<div class="navbar-info">
							<i class="<?php echo get_theme_mod( 'realia_header_2_information_box_icon' ); ?>"></i> <?php echo get_theme_mod( 'realia_header_2_information_box_text' ); ?>
						</div><!-- /.navbar-info -->
					<?php endif; ?>


					<?php if ( get_theme_mod( 'realia_header_action_link' ) && get_theme_mod( 'realia_header_action_text' ) ) : ?>
						<a href="<?php echo get_theme_mod( 'realia_header_action_link' ); ?>" class="btn btn-secondary btn-lg pull-right navbar-btn">
							<?php echo get_theme_mod( 'realia_header_action_text' ); ?> <i class="pp pp-normal-right-arrow-small"></i>
						</a>
					<?php endif; ?>
				</div><!-- /.container -->
			</div><!-- /.header-top -->

			<?php $menu = wp_nav_menu( array(
				'menu_class'        => 'nav navbar-nav navbar-right collapse navbar-collapse',
				'walker'            => new Realia_Menu_Walker(),
				'theme_location'    => 'primary',
				'menu_id'           => 'primary-menu',
				'fallback_cb' 		=> false,
				'echo'              => false,
			) ); ?>

			<?php if ( ! empty( $menu ) ) : ?>
				<div class="header-bottom">
					<div class="container"><?php echo $menu; ?></div><!-- /.container -->
				</div><!-- /.header-bottom -->
			<?php endif; ?>
		</nav>
	</div><!-- /.header -->

	<div class="main">
		<?php dynamic_sidebar( 'sidebar-top-fullwidth' ); ?>

		<div class="container">
			<?php get_sidebar( 'top' ); ?>

			<?php if ( ! empty( $_SESSION['messages'] ) && is_array( $_SESSION['messages'] ) ) : ?>
				<?php $_SESSION['messages'] = Realia_Utilities::array_unique_multidimensional( $_SESSION['messages'] );?>

				<div class="alerts">
					<?php foreach ( $_SESSION['messages'] as $message ) : ?>
						<div class="alert alert-dismissible alert-<?php echo esc_attr( $message[0] ); ?>">
							<div class="alert-inner">
								<?php echo wp_kses( $message[1], wp_kses_allowed_html( 'post' ) ); ?>

								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="pp pp-normal-circle-cross"></i></button>
							</div><!-- /.alert-inner -->
						</div><!-- /.alert -->
					<?php endforeach; ?>
				</div><!-- /.alerts -->

				<?php unset( $_SESSION['messages'] ); ?>
			<?php endif; ?>

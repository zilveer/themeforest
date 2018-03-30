<div class="logo">
	<?php
	$logo_type = TMM::get_option( "logo_type" );
	$logo_text = TMM::get_option( "logo_text" );
	$logo_img  = TMM::get_option( "logo_img" );
	$logo_img_attr = '';
	$logo_color = '';

	if( get_theme_mod('header_textcolor') ) {
		$logo_color = get_header_textcolor();
	}

	if( !empty($logo_color) ) {
		$logo_color = ' style="color:#'.$logo_color.';"';
	}

	if( get_theme_mod('header_image') && get_header_image() ) {
		$logo_img = get_header_image();
		$logo_img_attr = ' height="'. get_custom_header()->height . '" width="' . get_custom_header()->width . '"';
	}

	if ( ! $logo_type AND $logo_text ) {
		?>
		<h1><a title="<?php bloginfo( 'description' ); ?>"
		       href="<?php echo esc_url( home_url('/') ); ?>"<?php echo $logo_color; ?>><?php echo $logo_text; ?></a></h1>
	<?php } else if ( $logo_type AND $logo_img ) { ?>
		<a title="<?php bloginfo( 'description' ); ?>" href="<?php echo esc_url( home_url('/') ); ?>"><img<?php echo $logo_img_attr; ?>
				src="<?php echo $logo_img; ?>" alt="<?php bloginfo( 'description' ); ?>" /></a>
	<?php } else { ?>
		<a title="<?php bloginfo( 'description' ); ?>" href="<?php echo esc_url( home_url('/') ); ?>"><h1>
				<span>Car</span>Dealer</h1></a>
	<?php } ?>
</div>
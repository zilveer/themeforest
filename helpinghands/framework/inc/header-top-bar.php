<?php
/**
 * Header Top Bar
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
 global $sd_data;
 
?>
<div class="sd-header-top">
	<div class="container">
			<div class="sd-header-left-options">
				<?php if ( $sd_data['sd_top_bar_style'] == 1 ) : ?>
					<?php if ( !empty( $sd_data['sd_top_text'] ) ) : ?>
						<span class="sd-top-quote"><?php echo $sd_data['sd_top_text']; ?></span>
					<?php endif; ?>
				<?php else : ?>
					<?php if ( has_nav_menu( 'top-bar-menu' ) ) : ?>
						<nav class="sd-top-bar-nav">
							<?php
								// Using wp_nav_menu() to display menu
								wp_nav_menu( array(
									'menu' => 'Top Bar Menu',
									'class' => '',
									'menu_class' =>'',
									'menu_id' => 'sd-top-bar-menu',
									'container' => false,
									'theme_location' => 'top-bar-menu'
									)
								);
							?>
						</nav>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<!-- sd-header-left-options -->
		<?php if ( $sd_data['sd_social_icons'] == '1' ) : ?>	
			<div class="sd-header-social clearfix">
			<?php foreach ( $sd_data['sd_social_icons_data'] as $font_class => $url ) {
					if ( $url ) { ?>
						<a class="sd-header-<?php if ( $font_class == 'email' ) { echo 'email'; } else { echo esc_attr( $font_class ); } ?>" href="<?php if ( $font_class == 'email' ) { $email = sanitize_email( $url ); echo 'mailto:' . antispambot( $email, 1 ); } else if ( $font_class == 'phone' ) { echo '#'; } else { echo esc_url( $url ); } ?>" title="<?php echo esc_attr( $font_class ); ?>" target="<?php if ( $font_class == 'phone' ) { echo '_self'; } else { echo '_blank'; } ?>" rel="nofollow"><i class="sd-link-trans fa fa-<?php if ( $font_class == 'email' ) { echo 'envelope-o'; } else { echo esc_attr( $font_class ); } ?>"></i> <?php if ( $font_class == 'email' ) { $email = sanitize_email( $url ); echo antispambot( $email ); } if ( $font_class == 'phone' ) { echo esc_attr( $url ); } ?> </a>
			<?php   }
				  } 
			?>
			</div>
			<!-- sd-header-social -->
		<?php endif; ?>
	</div>
	<!-- container -->
</div>
<!-- sd-header-top -->
<?php global $ft_option; ?>

<h1 <?php if( $ft_option['logo_type'] == 'text_logo' ) { ?>class="favethemes_text_logo" <?php } ?>>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		
		<?php if( $ft_option['logo_type'] == 'text_logo' ) { 
				  if( !empty($ft_option['site_text_logo'])) {
					  echo esc_attr( $ft_option['site_text_logo'] );
					}
		} else { ?>

				<?php if( !empty($ft_option['site_logo'])) { ?>
				 <img src="<?php echo esc_url( $ft_option['site_logo'] ); ?>" width="250" height="42" alt="<?php bloginfo( 'name' );?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>"/>
				<?php } ?>
		<?php
		}?>

	</a>
</h1>

<div class="mag-info"><?php bloginfo( 'description' ); ?></div>
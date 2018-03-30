<?php
/**
 * Prints the social icons
 *
 * @package Organique
 */
?>
<div class="icons">
	<?php
		$icons         = get_social_icons_links();
		$in_new_window = get_theme_mod( 'icons_new_window' );
	?>
	<?php
		if( ! empty( $icons ) ) :
			foreach( $icons as $service => $url ) :
				switch ( $service ) {
					case 'zocial-skype':
						$url = 'skype:' . $url . '?call';
						break;
					case 'zocial-email':
						$url = 'mailto:' . antispambot( $url );
						break;
				} ?>
				<a href="<?php echo $url; ?>"<?php echo 'yes' === $in_new_window ? ' target="_blank"' : ''; ?>><span class="<?php echo $service; ?>"></span></a>
	<?php
			endforeach;
		endif;
	?>
</div>
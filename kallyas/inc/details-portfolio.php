<?php if(! defined('ABSPATH')){ return; }

	// Get portfolio fields
	get_template_part( 'inc/details', 'portfolio-fields' );

?>
<div class="portfolio-item-otherdetails clearfix">
	<?php

	// Social Sharing
	$sp_show_social = get_post_meta( get_the_ID(), 'zn_sp_show_social', true );
	if ( ! empty ( $sp_show_social ) && $sp_show_social == 'yes' ) {
		?>
		<div class="portfolio-item-share clearfix" data-share-title="<?php echo esc_attr( __( 'SHARE:', 'zn_framework') ); ?>">
			<?php

			$encoded_url = urlencode( get_permalink() );
			$share_text = htmlspecialchars( urlencode( __( "Check out - ", 'zn_framework' ) . get_the_title() ), ENT_COMPAT, 'UTF-8');
			$share_image = isset( $portfolio_image ) ? '&amp;media='.$portfolio_image : '';

			$mail_subject = htmlspecialchars( __( "Check out this awesome project: ", 'zn_framework' ) .get_the_title() );
			$mail_body = htmlspecialchars( __( "You can see it live here ", 'zn_framework' ) .$encoded_url.'%3Futm_source%3Dsharemail .'."\n\n". __( " Made by ", 'zn_framework' ) . get_bloginfo() . ' ' . get_site_url() );

			$socialicons = array();
			$socialicons['twitter'] = array(
				'url' => 'https://twitter.com/intent/tweet?text='.$share_text.'&amp;url='.$encoded_url.'%3Futm_source%3Dsharetw',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue82f')
			);
			$socialicons['facebook'] = array(
				'url' => 'https://www.facebook.com/sharer/sharer.php?display=popup&amp;u='.$encoded_url.'%3Futm_source%3Dsharefb',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue83f')
			);
			$socialicons['gplus'] = array(
				'url' => 'https://plus.google.com/share?url='.$encoded_url.'%3Futm_source%3Dsharegp',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue808')
			);
			$socialicons['pinterest'] = array(
				'url' => 'http://pinterest.com/pin/create/button?description='.$share_text.'&amp;url='.$encoded_url . $share_image.'&amp;utm_source%3Dsharepi',
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue80e')
			);
			$socialicons['mail'] = array(
				'url' => 'mailto:?body='.$mail_body.'&amp;subject='.$mail_subject,
				'icon' => array('family' => 'kl-social-icons', 'unicode' => 'ue836')
			);

			foreach ($socialicons as $key => $value) {

				$js = $key != 'mail' ? 'onclick="javascript:window.open(\''.$value['url'].'\',\'SHARE\',\'width=600,height=400\'); return false;"' : '';
				$url = $key == 'mail' ? $value['url'] : '#';

				echo '<a href="'.$url.'" '.$js.' title="' . __( "SHARE ON", 'zn_framework' ) . ' '.strtoupper($key).'" class=" portfolio-item-share-link portfolio-item-share-'.$key.'">';
				echo '<span '. zn_generate_icon( $value['icon'] ) .'></span>';
				echo '</a>';
			}

			?>

		</div><!-- social links -->
		<?php
	}

	$sp_link = get_post_meta( get_the_ID(), 'zn_sp_link', true );
	$sp_link_ext = zn_extract_link($sp_link, 'btn btn-lined lined-custom');

	if ( ! empty ( $sp_link_ext['start'] ) ) {

		$button_text = get_post_meta( get_the_ID(), 'zn_sp_link_text', true );
		$button_text = ! empty( $button_text ) ? $button_text : __( "PROJECT LIVE PREVIEW", 'zn_framework' );

		echo '
		<div class="portfolio-item-livelink">
			'.$sp_link_ext['start'].'
				<span class="visible-sm visible-xs visible-lg">' . $button_text . '</span>
				<span class="visible-md">' . __( "PREVIEW", 'zn_framework' ) . '</span>
			'.$sp_link_ext['end'].'
		</div>';
	}
	?>

</div><!-- /.portfolio-item-otherdetails -->

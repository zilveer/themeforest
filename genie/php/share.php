<?php
if ( ! function_exists( 'bt_get_share_link' ) ) {
	function bt_get_share_link( $service, $url ) {
		if ( $service == 'facebook' ) {
			return 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
		} else if ( $service == 'twitter' ) {
			return 'https://twitter.com/home?status=' . $url;
		} else if ( $service == 'google_plus' ) {
			return 'https://plus.google.com/share?url=' . $url;
		} else if ( $service == 'linkedin' ) {
			return 'https://www.linkedin.com/shareArticle?url=' . $url;
		} else if ( $service == 'vk' ) {
			return 'http://vkontakte.ru/share.php?url=' . $url;		
		} else {
			return '#';
		}
	}
}
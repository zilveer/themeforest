<?php

if ( ! function_exists( 'krown_svg' ) ) {

	function krown_svg( $type ) {

		switch ( $type ) {

			case 'hamburger':
				return '<svg class="krown-svg hamburger" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="20" width="25" height="4"/><rect x="18" y="28" width="25" height="4"/><rect x="18" y="36" width="25" height="4"/></g></svg>';
				break;

			case 'close':	
				return '<svg class="krown-svg close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="28" transform="matrix(0.7071 0.7071 -0.7071 0.7071 30.1464 -12.78)" width="25" height="4"/><rect x="18" y="28" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -12.28 30.3536)" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_right':
				return '<svg class="krown-svg arrow_right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="45.328,29 42.5,26.172 35.075,18.747 32.247,21.575 39.672,29 32.247,36.425 35.075,39.253 42.5,31.828 "/><g><rect x="16" y="27" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_left':
				return '<svg class="krown-svg arrow_left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="16,29 18.828,31.828 26.253,39.253 29.081,36.425 21.656,29 29.081,21.575 26.253,18.747 18.828,26.172 "/><g><rect x="20.328" y="27" width="25" height="4"/></g></svg>';
				break;

			case 'arrow_down':
				return '<svg class="krown-svg arrow_down" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polyline points="26.414,28.008 30.414,32.008 34.414,28.008 "/></svg>';
				break;

			case 'arrow_up':
				return '<svg ckass="krown-svg arrow_up" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><polygon fill="#FFFFFF" points="29.791,22.459 26.962,25.288 19.538,32.713 22.366,35.541 29.791,28.116 37.215,35.541 40.043,32.713 32.619,25.288 "/></svg>';
				break;

			case 'filter':
				return '<svg class="krown-svg filter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" enable-background="new 0 0 60 60" xml:space="preserve"><g><rect x="18" y="20" width="4" height="4"/><rect x="18" y="28" width="4" height="4"/><rect x="18" y="36" width="4" height="4"/><polyline points="26,20 30,20 30,24 26,24"/><polyline points="26,28 30,28 30,32 26,32"/><polyline points="26,36 30,36 30,40 26,40"/><polyline points="34,20 38,20 38,24 34,24"/><polyline points="34,28 38,28 38,32 34,32"/></g></svg>';
				break;

			case 'cart':
				return '<svg version="1.1" class="krown-svg cart" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><g><path d="M72.715,29.241H16.074c-4.416,0-2.961,3.613-2.961,8.03l3.802,38.897c0,4.416,3.614,4.229,8.031,4.229h38.896c4.416,0,8.664,0.188,8.664-4.229l3.167-38.897C75.674,32.854,77.131,29.241,72.715,29.241z"/><path d="M44.394,10.491c7.146,0,12.961,5.814,12.961,12.961h3.543c0-9.101-7.403-16.505-16.504-16.505c-9.1,0-16.503,7.404-16.503,16.505h3.543C31.434,16.306,37.249,10.491,44.394,10.491z"/></g></svg>';
				break;

		}
		
	}

}

?>
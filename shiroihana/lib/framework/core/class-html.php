<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

final class Youxi_HTML {

	public function html_attr( $attributes ) {

		$html = '';

		foreach( (array) $attributes as $key => $attribute ) {
			$html .= " {$key}=\"" . esc_attr( $attribute ) . "\"";
		}

		return $html;
	}
}

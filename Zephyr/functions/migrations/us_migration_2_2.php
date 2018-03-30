<?php

class us_migration_2_2 extends US_Migration_Translator {

	// Content
	public function translate_content( &$content ) {
		return $this->_translate_content( $content );
	}

	public function translate_us_social_links( &$name, &$params, &$content ) {
		$changed = FALSE;

		if ( isset( $params['inverted'] ) OR isset( $params['desaturated'] ) ) {
			$params['style'] = ( isset( $params['desaturated'] ) AND $params['desaturated'] ) ? 'desaturated' : 'colored';
			if ( isset( $params['inverted'] ) AND $params['inverted'] ) {
				$params['style'] .= '_inv';
			}
			unset( $params['inverted'], $params['desaturated'] );
			$changed = TRUE;
		}

		return $changed;
	}

	public function translate_us_person( &$name, &$params, &$content ) {
		$changed = FALSE;

		if ( isset( $params['style'] ) ) {
			$old_new_values = array(
				'1' => 'card',
				'2' => 'flat',
			);
			if ( isset( $old_new_values[ $params['style'] ] ) ) {
				$params['layout'] = $old_new_values[ $params['style'] ];
			}
			unset( $params['style'] );
			$changed = TRUE;
		}

		if ( isset( $params['img_circle'] ) ) {
			unset( $params['img_circle'] );
			$changed = TRUE;
		}

		return $changed;
	}

	public function translate_vc_iconbox( &$name, &$params, &$content ) {
		$name = 'us_iconbox';

		$params_rules = array(
			'type' => array(
				'new_name' => 'style',
			),
			'size' => array(
				'values' => array(
					'big' => 'large',
				),
			),
		);

		$this->translate_params( $params, $params_rules );

		$link = '';

		if ( isset( $params['link'] ) AND $params['link'] != '' ) {
			$link .= 'url:' . urlencode( $params['link'] );
			unset( $params['link'] );
		}
		if ( isset( $params['external'] ) AND $params['external'] == 1 ) {
			$link .= '|target:%20_blank';
			unset( $params['external'] );
		}

		$params['link'] = $link;

		return TRUE;
	}

	public function translate_us_sharing( &$name, &$params, &$content ) {
		$changed = FALSE;

		if ( isset( $params['type'] ) ) {
			if ( $params['type'] == 'fixed_left' ) {
				$params['type'] = 'fixed';
				$params['align'] = 'left';
				$params['counters'] = 'hide';
				$changed = TRUE;
			} elseif ( $params['type'] == 'fixed_right' ) {
				$params['type'] = 'fixed';
				$params['align'] = 'right';
				$params['counters'] = 'hide';
				$changed = TRUE;
			}
		}

		return $changed;
	}

	// Widgets
	public function translate_widgets( &$name, &$instance ) {
		if ( $name == 'text' ) {
			return $this->_translate_content( $instance['text'] );
		} elseif ( $name == 'socials' ) {
			$name = 'us_socials';
			if ( isset( $instance['size'] ) ) {
				if ( $instance['size'] == 'normal' ) {
					$instance['size'] = 'medium';
				} elseif ( $instance['size'] == 'big' ) {
					$instance['size'] = 'large';
				}
			}
			if ( isset( $instance['style'] ) ) {
				$old_new_values = array(
					'1' => 'colored',
					'2' => 'colored_inv',
					'3' => 'desaturated',
					'4' => 'desaturated_inv',
				);
				$instance['color'] = isset( $old_new_values[ $instance['style'] ] ) ? $old_new_values[ $instance['style'] ] : 'colored';
				unset( $instance['style'] );
			} else {
				$instance['color'] = us_config( 'widgets.us_socials.params.color.std', 'colored' );
			}

			return TRUE;
		} elseif ( $name == 'login' ) {
			$name = 'us_login';

			return TRUE;
		} elseif ( $name == 'contact' ) {
			$name = 'us_contacts';

			return TRUE;
		}

		return FALSE;
	}

}


<?php if(!defined('ABSPATH')) { return; }
	/*
	 * Build and display the element
	 */
	$options = (isset($GLOBALS['options']['featuresBoxes']) ? $GLOBALS['options']['featuresBoxes'] : null);
	if(empty($options)){
		return;
	}


	echo '<div class="zn_features_boxes">';

	// if no subtitle nor description use full 12 column
	$useColCustom = (empty($options['fb_stitle']) && empty($options['fb_desc'])) ? 'col-sm-12' : 'col-sm-12 col-lg-9';
	// $useColCustomFeat = (empty($options['fb_stitle']) && empty($options['fb_desc'])) ? 'col-lg-3' : 'col-lg-4';
	$useColCustomFeat = $this->opt( 'fb_columns', 'col-lg-6' );

	if ( $options['fb_style'] == 'style1' ) {
		echo '<div class="row">';
		if ( ! empty( $options['fb_title'] ) ) {
			echo '<div class="col-sm-12">';
				echo '<h4 class="zn_features_boxes-title zn_features_boxes-title--ext text-custom"><span class="zn_features_boxes-title-sp">' . $options['fb_title'] . '</span></h4>';
			echo '</div>';
		}

		// SECONDARY TITLE AND CONTENT
		if ( ! empty ( $options['fb_stitle'] ) || ! empty ( $options['fb_desc'] ) ) {
			echo '<div class="feature_box_desc col-sm-12 col-lg-3">';
			if ( ! empty ( $options['fb_stitle'] ) ) {
				echo '<p><strong>' . $options['fb_stitle'] . '</strong></p>';
			}
			if ( ! empty ( $options['fb_desc'] ) ) {
				echo '<div class="zn_fb_description">'.wpautop( $options['fb_desc'] ) .'</div>';
				// echo '<p><em>' . $options['fb_desc'] . '</em></p>';
			}
			echo '</div>';
		}

		if ( isset ( $options['features_single'] ) && is_array( $options['features_single'] ) )
		{
			echo '<div class="'.$useColCustom.'"><div class="row">';
			foreach ( $options['features_single'] as $feature ) {
				echo '<div class="col-sm-6 '.$useColCustomFeat.' feature_box style2">';
				echo '<div class="box">';
				if ( ! empty ( $feature['fb_single_icon'] ) ) {
					echo '<span class="icon"><img src="' . $feature['fb_single_icon'] . '" alt="' .
						 strip_tags( $feature['fb_single_title'] ) . '"></span>';
				}
				if ( ! empty ( $feature['fb_single_title'] ) ) {
					echo '<h4 class="title text-custom">' . $feature['fb_single_title'] . '</h4>';
				}
				if ( ! empty ( $feature['fb_single_desc'] ) ) {
					echo '<p>' . $feature['fb_single_desc'] . '</p>';
				}
				echo '</div>';
				echo '</div>';
			}// end foreach
			echo '</div></div>';
		}
		echo '</div>';
	}
	elseif ( $options['fb_style'] == 'style2' ) {

		echo '<div class="row">';
		// TITLE
		if ( ! empty( $options['fb_title'] ) ) {
			echo '<div class="col-sm-12">';
			echo '<h4 class="zn_features_boxes-title text-custom"><span class="zn_features_boxes-title-sp">' . $options['fb_title'] . '</span></h4>';
			echo '</div>';
		}

		// SECONDARY TITLE AND CONTENT
		if ( ! empty ( $options['fb_stitle'] ) || ! empty ( $options['fb_desc'] ) ) {
			echo '<div class="col-sm-12 col-lg-3">';
			if ( ! empty ( $options['fb_stitle'] ) ) {
				echo '<p><strong>' . $options['fb_stitle'] . '</strong></p>';
			}
			if ( ! empty ( $options['fb_desc'] ) ) {
				echo '<div class="zn_fb_description">'.wpautop( $options['fb_desc'] ) .'</div>';
				// echo '<p><em>' . $options['fb_desc'] . '</em></p>';
			}
			echo '</div>';
		}

		// FEATURES
		if ( isset ( $options['features_single'] ) && is_array( $options['features_single'] ) ) {
			echo '<div class="'.$useColCustom.'"><div class="row">';
			foreach ( $options['features_single'] as $feature ) {
				$image = '';
				echo '<div class="col-sm-6 '.$useColCustomFeat.' feature_box default_style">';
				echo '<div class="box">';
				if ( ! empty ( $feature['fb_single_icon'] ) ) {
					$image = '<img src="' . $feature['fb_single_icon'] . '" alt="' .
							 strip_tags( $feature['fb_single_title'] ) . '">';
				}
				if ( ! empty ( $feature['fb_single_title'] ) ) {
					echo '<h4 class="title text-custom">' . $image . '' . $feature['fb_single_title'] . '</h4>';
				}
				if ( ! empty ( $feature['fb_single_desc'] ) ) {
					echo '<p>' . $feature['fb_single_desc'] . '</p>';
				}
				echo '</div>';
				echo '</div>';
			}// end foreach
			echo '</div></div>';
		}
		echo '</div>';
	}
	elseif ( $options['fb_style'] == 'style3' ) {


		echo '<div class="row">';
		// TITLE
		if ( ! empty( $options['fb_title'] ) ) {
			echo '<div class="col-sm-12">';
				echo '<h3 class="m_title m_title_ext text-custom" '.WpkPageHelper::zn_schema_markup('title').'>' . $options['fb_title'] . '</h3>';
			echo '</div>';
		}

		// SECONDARY TITLE AND CONTENT
		if ( ! empty ( $options['fb_stitle'] ) || ! empty ( $options['fb_desc'] ) ) {
			echo '<div class="col-sm-12 col-lg-3">';
			if ( ! empty ( $options['fb_stitle'] ) ) {
				echo '<p><strong>' . $options['fb_stitle'] . '</strong></p>';
			}
			if ( ! empty ( $options['fb_desc'] ) ) {
				echo '<div class="zn_fb_description">'.wpautop( $options['fb_desc'] ) .'</div>';
			}
			echo '</div>';
		}

		// FEATURES
		if ( isset ( $options['features_single'] ) && is_array( $options['features_single'] ) ) {
			echo '<div class="'.$useColCustom.'"><div class="row">';
			foreach ( $options['features_single'] as $feature ) {
				$image = '';
				echo '<div class="col-sm-3 '.$useColCustomFeat.' feature_box default_style">';
				echo '<div class="box u-trans-all-2s">';
				if ( ! empty ( $feature['fb_single_icon'] ) ) {
					$image = '<img src="' . $feature['fb_single_icon'] . '" alt="' . $feature['fb_single_title'] . '">';
				}

				if ( ! empty ( $feature['fb_single_title'] ) ) {
					echo '<h4 class="title text-custom">' . $image . '' . $feature['fb_single_title'] . '</h4>';
				}

				if ( ! empty ( $feature['fb_single_desc'] ) ) {
					echo '<p>' . $feature['fb_single_desc'] . '</p>';
				}
				echo '</div>';
				echo '</div>';
			} // end foreach
			echo '</div></div>';
		}
		echo '</div>';
	}
	echo '</div>';
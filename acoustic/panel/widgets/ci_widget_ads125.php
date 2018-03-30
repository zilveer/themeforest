<?php 
if( !class_exists('CI_Ads125') ):
class CI_Ads125 extends WP_Widget {

	function __construct(){
		$widget_ops  = array( 'description' => __( 'Display 125x125 Banners', 'ci_theme' ) );
		$control_ops = array(/*'width' => 300, 'height' => 400*/ );
		parent::__construct( 'ci_ads125_widget', $name = __( '-= CI 125x125 Ads =-', 'ci_theme' ), $widget_ops, $control_ops );
	}


	function widget( $args, $instance ) {
		extract( $args );
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_title = ci_get_string_translation( 'Ads125 - Title', $ci_title, 'Widgets' );

		$ci_random  = $instance['ci_random'];
		$ci_new_win = isset( $instance['ci_new_win'] ) ? $instance['ci_new_win'] : '';

		$b = array();
		for ( $i = 1; $i <= 8; $i ++ ) {
			$b[ $i ]['url'] = $instance[ 'ci_b' . $i . 'url' ];
			$b[ $i ]['lin'] = $instance[ 'ci_b' . $i . 'lin' ];
			$b[ $i ]['tit'] = ci_get_string_translation( 'Ads125 - Banner Title', $instance[ 'ci_b' . $i . 'tit' ], 'Widgets' );
		}
		
		echo $before_widget;

		if ( $ci_title ) {
			echo $before_title . $ci_title . $after_title;
		}

		echo '<ul id="ads125" class="ads125 group">';

		if ( $ci_random == "random" ) {
			shuffle( $b );
		}

		$target = '';
		if ( $ci_new_win == 'enabled' ) {
			$target = ' target="_blank" ';
		}

		$i = 1;
		foreach ( $b as $key => $value ) {
			if ( ! empty( $value['url'] ) ) {
				if ( $i % 2 == 0 ) {
					echo '<li class="last"><a href="' . esc_url( $value['lin'] ) . '" ' . $target . ' ><img src="' . esc_url( $value['url'] ) . '" alt="' . esc_attr( $value['tit'] ) . '" /></a></li>';
				} else {
					echo '<li><a href="' . esc_url( $value['lin'] ) . '" ' . $target . ' ><img src="' . esc_url( $value['url'] ) . '" alt="' . esc_attr( $value['tit'] ) . '" /></a></li>';
				}

			}
			$i ++;
		}

		echo '</ul>';

		echo $after_widget;
	} // widget

	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['ci_title']   = sanitize_text_field( $new_instance['ci_title'] );
		$instance['ci_random']  = ci_sanitize_checkbox( $new_instance['ci_random'], 'random' );
		$instance['ci_new_win'] = ci_sanitize_checkbox( $new_instance['ci_new_win'], 'enabled' );

		$instance['ci_title'] = ci_register_string_translation('Ads125 - Title', $instance['ci_title'], 'Widgets');

		for ( $i = 1; $i <= 8; $i ++ ) {
			$instance[ 'ci_b' . $i . 'url' ] = esc_url_raw( $new_instance[ 'ci_b' . $i . 'url' ] );
			$instance[ 'ci_b' . $i . 'lin' ] = esc_url_raw( $new_instance[ 'ci_b' . $i . 'lin' ] );
			$instance[ 'ci_b' . $i . 'tit' ] = sanitize_title( $new_instance[ 'ci_b' . $i . 'tit' ] );

			$instance[ 'ci_b' . $i . 'tit' ] = ci_register_string_translation( 'Ads125 - Banner Title', $instance[ 'ci_b' . $i . 'tit' ], 'Widgets' );
		}
		
		return $instance;
	} // save

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'ci_title'   => '',
			'ci_random'  => '',
			'ci_new_win' => '',
			'ci_b1url'   => '', 'ci_b1lin'   => '', 'ci_b1tit'   => '',
			'ci_b2url'   => '', 'ci_b2lin'   => '', 'ci_b2tit'   => '',
			'ci_b3url'   => '', 'ci_b3lin'   => '', 'ci_b3tit'   => '',
			'ci_b4url'   => '', 'ci_b4lin'   => '', 'ci_b4tit'   => '',
			'ci_b5url'   => '', 'ci_b5lin'   => '', 'ci_b5tit'   => '',
			'ci_b6url'   => '', 'ci_b6lin'   => '', 'ci_b6tit'   => '',
			'ci_b7url'   => '', 'ci_b7lin'   => '', 'ci_b7tit'   => '',
			'ci_b8url'   => '', 'ci_b8lin'   => '', 'ci_b8tit'   => ''
		) );

		$ci_title   = $instance['ci_title'];
		$ci_random  = $instance['ci_random'];
		$ci_new_win = isset( $instance['ci_new_win'] ) ? $instance['ci_new_win'] : '' ;

		echo '<p><label for="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '">' . __( 'Title', 'ci_theme' ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_title' ) ) . '" type="text" value="' . esc_attr( $ci_title ) . '" class="widefat" /></p>';
		echo '<p><input id="' . esc_attr( $this->get_field_id( 'ci_random' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_random' ) ) . '" type="checkbox"' . checked( $instance['ci_random'], 'random' ) . ' value="random" /> <label for="' . esc_attr( $this->get_field_id( 'ci_random' ) ) . '">' . __( 'Display ads in random order?', 'ci_theme' ) . '</label></p>';
		echo '<p><input id="' . esc_attr( $this->get_field_id( 'ci_new_win' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_new_win' ) ) . '" type="checkbox"' . checked( $instance['ci_new_win'], 'enabled' ) . ' value="enabled" /> <label for="' . esc_attr( $this->get_field_id( 'ci_new_win' ) ) . '">' . __( 'Open ads in new window?', 'ci_theme' ) . '</label></p>';

		for ( $i = 1; $i <= 8; $i ++ ) {
			?><p><?php
			$url = $instance[ 'ci_b' . $i . 'url' ];
			$lin = $instance[ 'ci_b' . $i . 'lin' ];
			$tit = $instance[ 'ci_b' . $i . 'tit' ];
			echo '<label for="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'url' ) ) . '">' . sprintf( __( 'Banner #%d URL', 'ci_theme' ), $i ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'url' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_b' . $i . 'url' ) ) . '" type="text" value="' . esc_attr( $url ) . '" class="widefat" />';
			echo '<label for="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'lin' ) ) . '">' . sprintf( __( 'Banner #%d Link', 'ci_theme' ), $i ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'lin' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_b' . $i . 'lin' ) ) . '" type="text" value="' . esc_attr( $lin ) . '" class="widefat" />';
			echo '<label for="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'tit' ) ) . '">' . sprintf( __( 'Banner #%d Title', 'ci_theme' ), $i ) . '</label><input id="' . esc_attr( $this->get_field_id( 'ci_b' . $i . 'tit' ) ) . '" name="' . esc_attr( $this->get_field_name( 'ci_b' . $i . 'tit' ) ) . '" type="text" value="' . esc_attr( $tit ) . '" class="widefat" />';
			?></p><?php
		}


	} // form

} // class

register_widget( 'CI_Ads125' );

endif; //class_exists

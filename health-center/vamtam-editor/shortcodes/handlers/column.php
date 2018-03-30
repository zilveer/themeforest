<?php

/**
 * Column shortcodes handler
 *
 * @package wpv
 * @subpackage editor
 */

/**
 * class WPV_Columns
 */
class WPV_Columns {
	/**
	 * Current row
	 *
	 * @var integer
	 */
	public static $in_row = 0;
	/**
	 * Last row
	 * @var integer
	 */
	public static $last_row = -1;

	/**
	 * Register the shortcodes
	 */
	public function __construct() {
		$GLOBALS['wpv_column_stack'] = array();

		for ( $i = 0; $i < 20; $i++ ) {
			$suffix = ( $i == 0 ) ? '' : '_'.$i;
			add_shortcode( 'column'.$suffix, array( __CLASS__, 'dispatch' ) );
		}
	}

	/**
	 * Column shortcode callback
	 *
	 * @param  array  $atts    shortcode attributes
	 * @param  string $content shortcode content
	 * @param  string $code    shortcode name
	 * @return string          output html
	 */
	public static function dispatch( $atts, $content, $code ) {
		extract(
			shortcode_atts(
				array(
					'animation' => 'none',
					'background_attachment' => 'scroll',
					'background_color' => '',
					'background_image' => '',
					'background_position' => '',
					'background_repeat' => '',
					'background_size' => '',
					'background_video' => '',
					'hide_bg_lowres' => '',
					'class' => '',
					'extended' => 'false',
					'extended_padding' => 'true',
					'last' => 'false',
					'more_link' => '',
					'more_text' => '',
					'parallax_bg' => 'disabled',
					'parallax_bg_inertia' => '1',
					'title' => '',
					'title_type' => 'single',
					'vertical_padding_bottom' => '0',
					'vertical_padding_top' => '0',
					'width' => '1/1',
					'div_atts' => '',
					'left_border' => 'transparent',
					'id' => '',
				),
				$atts
			)
		);

		if ( ! preg_match( '/column_\d+/', $code ) )
			$class .= ' wpv-first-level';

		$GLOBALS['wpv_column_stack'][]    = $width;
		$GLOBALS['wpv_last_column_title'] = $title;

		if ( $parallax_bg !== 'disabled' ) {
			$class                .= ' parallax-bg';
			$div_atts             .= ' data-parallax-method="'.esc_attr( $parallax_bg ).'" data-parallax-inertia="'.esc_attr( $parallax_bg_inertia ).'"';
			$background_position   = 'center top';
			$background_attachment = 'fixed';
		}

		$has_price         = ( strpos( $content, '[price' ) !== false );
		$has_vertical_tabs = preg_match( '/\[tabs.+layout="vertical"/s', $content );

		$width = str_replace( '/', '-', $width );
		$title = ! empty( $title ) && ! $has_vertical_tabs ? apply_filters( 'wpv_column_title', $title, $title_type ) : '';

		$extended = wpv_sanitize_bool( $extended );
		$last     = wpv_sanitize_bool( $last );
		$first    = ! $last;

		$id = empty( $id ) ? 'wpv-column-'.md5( uniqid() ) : $id;

		if ( $width === '1-1' ) {
			$first = true;
			$last  = true;
		}

		if ( $width !== '1-1' || WpvTemplates::get_layout() !== 'full' ) {
			$extended = false;
		}

		$result = $result_before = $result_after = $content_before = $content_after = '';

		if ( self::$in_row > self::$last_row ) {
			$rowclass = ( $has_price ) ? 'has-price' : '';

			$class  .= ' first';
			$result .= '<div class="row '.$rowclass.'">';
			self::$last_row = self::$in_row;
		}

		if ( ! empty( $background_image ) ) {
			$background_image = "
				background: url( '$background_image' ) $background_repeat $background_position;
				background-size: $background_size;
				background-attachment: $background_attachment;
			";

			if ( wpv_sanitize_bool( $hide_bg_lowres ) ) {
				$class .= ' hide-bg-lowres';
			}
		}

		$inner_style = '';

		$l = new WpvLessc();
		$l->importDir = '.';
		$l->setFormatter( 'compressed' );

		if ( ! empty( $background_color ) && $background_color !== 'transparent' ) {
			$color = wpv_sanitize_accent( $background_color );

			$inner_style .= $l->compile(
				WpvTemplates::readable_color_mixin() .
				"
				.safe-bg( @bgcolor ) when ( iscolor( @bgcolor ) ) {
					background-color: @bgcolor;
				}
				.safe-bg( @bgcolor ) {}

				#{$id} {
					p,
					em,
					.column-title,
					.sep-text h2.regular-title-wrapper,
					.text-divider-double,
					.sep-text .sep-text-line,
					.sep,
					.sep-2,
					.sep-3,
					td,
					th,
					caption {
						.readable-color( $color );
					}

					&:before {
						.safe-bg( $left_border );
					}
				}
			"
			);

			$background_color = 'background-color:' . wpv_sanitize_accent( $background_color ) . ';';
		} else {
			$background_color = '';
		}

		if ( ! empty( $left_border ) && $left_border !== 'transparent' ) {
			$inner_style .= $l->compile(
			"
				.safe-bg( @bgcolor ) when ( iscolor( @bgcolor ) ) {
					background-color: @bgcolor;
				}
				.safe-bg( @bgcolor ) {}

				#{$id} {
					&:before {
						.safe-bg( $left_border );
					}
				}
			"
			);
		}

		if ( ! empty( $inner_style ) ) {
			$content_before = '<style scoped>' . $inner_style . '</style>' . $content_before;
		}

		if ( ! empty( $more_link ) && ! empty( $more_text ) && ! $extended ) {
			$class .= ' has-more-button';
			$more_link = esc_attr( $more_link );
			$content_after .= "<a href='$more_link' title='".esc_attr( $more_text )."' class='column-read-more-btn'>$more_text</a>";
		}

		if ( ! empty( $background_video ) && ! WpvMobileDetect::get_instance()->isMobile() ) {
			$type = wp_check_filetype( $background_video, wp_get_mime_types() );

			$content_before .= '<div class="wpv-video-bg">
				<video autoplay loop preload="metadata" width="100%" class="wpv-background-video" style="width:100%">
					<source type="'.$type['type'].'" src="'.$background_video.'"></source>
				</video>
			</div><div class="wpv-video-bg-content">';

			$content_after .= '</div>';

			$class .= ' has-video-bg';

			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}

		if ( ! empty( $background_image ) || ( ! empty( $background_color ) && $background_color !== 'transparent' ) )
			$class .= ' has-background';

		if ( ( int )$vertical_padding_top < 0 ) {
			$div_atts .= ' data-padding-top="'.( int )$vertical_padding_top.'"';
		}

		if ( ( int )$vertical_padding_bottom < 0 ) {
			$div_atts .= ' data-padding-bottom="'.( int )$vertical_padding_bottom.'"';
		}

		$vertical_padding_top    = max( 0, (int)$vertical_padding_top ).'px';
		$vertical_padding_bottom = max( 0, (int)$vertical_padding_bottom ).'px';

		$style = 'style="'.$background_image.$background_color.'padding-top:'.$vertical_padding_top.';padding-bottom:'.$vertical_padding_bottom.'"';

		$class .= $extended ? ' extended' : ' unextended';

		if ( $left_border != 'transparent' )
			$class .= ' left-border';

		if ( $animation !== 'none' && $parallax_bg == 'disabled' )
			$class .= ' animation-'.$animation.' animated-active';

		if ( $extended_padding === 'false' )
			$class .= ' no-extended-padding';

		if ( $extended ) {
			$content_before = '<div class="extended-column-inner">' . $content_before;
			$content_after .= '</div>';
		}

		$result .= '<div class="wpv-grid grid-'.$width.' '.$class.'" '.$style.' id="'.$id.'" '.$div_atts.'>' . $content_before . $title . self::content( $content ) . $content_after . '</div>';

		if ( $last ) {
			self::$last_row--;

			$result .= '</div>';
		}

		array_pop( $GLOBALS['wpv_column_stack'] );

		return $result_before.$result.$result_after;
	}

	/**
	 * Parse column content
	 *
	 * @param  string $content unparsed content
	 * @return string          parsed content
	 */
	public static function content( $content ) {
		self::$in_row++;
		$content = do_shortcode( trim( $content ) );
		self::$in_row--;

		return $content;
	}
};

new WPV_Columns;

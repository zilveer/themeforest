<?php
/** Elderberry Shortcodes
  *
  * This file houses the Elderberry shortcodes class
  *
  * @package Elderberry
  *
  */


/** Elderberry Shortcodes Class
  *
  * Apart from providing the actual shortcodes and the framework for them,
  * it provides a number of helper methods and misc things like the
  * shortcode and layout helpers.
  *
  */
class EB_Shortcodes {

	/** Class Constructor
	  *
	  * This function makes sure our framework is accessable, it stores
	  * the shortcodes list, adds all the shortcodes, creates the editor
	  * style needed and adds the TinyMCE controls.
	  *
	  * @param object $framework The Elderberry Framework
	  *
	  */
	function __construct( $framework ) {

		$this->framework = $framework;
		$this->shortcodes = $this->framework->defaults['shortcode_defaults'];
		$this->styler = new EB_Styler();

		foreach( $this->framework->defaults['shortcodes'] as $shortcode ) {
			if( method_exists( $this, $shortcode ) ) {
				add_shortcode( $shortcode , array( $this, $shortcode ) );
			}
			else {
				$function = EB_THEME_PREFIX . 'shortcode_' . $shortcode;
				if( !function_exists( $function ) ) {
					$this->framework->fatal_error( '
						<p>
							You have defined a shortcode in the defaults.php file
							which you haven\'t created code for.
						</p>
						<p>
							Please create the <code>' . $function . '</code> function
							to govern the "' . $shortcode . '" shortcode. We recommend using
							the shortcodes.php file in the configuration directory.
						</p>
					');
				}
				add_shortcode( $shortcode, $function );
			}

		}


		add_action( 'admin_footer', array( $this, 'shortcode_helper_popup' ) );
		add_action( 'admin_footer', array( $this, 'column_helper_popup' ) );
		add_filter( 'mce_external_plugins', array( $this, 'tinymce_add_plugins' ) );
		add_filter( 'mce_buttons', array( $this, 'tinymce_add_buttons' ) );
		add_action( 'init', array( $this, 'tinymce_styles' )  );

		add_filter( 'img_caption_shortcode', array( $this, 'caption' ), 10, 3 );
		add_shortcode('gallery', array( $this, 'gallery_shortcode' ) );

	}

	/***********************************************/
	/*            Shortcode Functions              */
	/***********************************************/

	function box( $atts, $content ) {
		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample' => false,
			'margin' => $this->shortcodes['box']['margin'],
			'style' => $this->shortcodes['box']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_string = implode( '; ', $style_array );
        $style_string .= '; ' . $style;

		$html = '<div style="' . $style_string . '" class="box">' . do_shortcode( $content ) . '</div>';
		return $html;
	}


	function gallery_shortcode( $attr ) {

	global $post;

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	if( empty( $attr['include'] ) && !empty( $attr['ids'] ) ){
		$attr['include'] = $attr['ids'];
	}


	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => ''
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}



	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "
		<style type='text/css'>
			#{$selector} {
				margin: auto;
			}
			#{$selector} .gallery-item {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector} img {
				border: 2px solid #cfcfcf;
			}
			#{$selector} .gallery-caption {
				margin-left: 0;
			}
		</style>
		<!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' style='$style' class='wp-gallery gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon'>
				$link
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize($attachment->post_excerpt) . "
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		if ( $columns > 0 && ++$i % $columns == 0 )
			$output .= '<br style="clear: both" />';
	}

	$output .= "
			<br style='clear: both;' />
		</div>\n";

	return $output;
	}



	/** Caption
	  *
	  * Modifies the behaviour of the default caption shortcode by
	  * wrapping it in a div with a specific class
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @return string $html The resulting HTML code
	  *
	  */


	function caption( $value, $atts, $image ) {
		$html = '
			<div class="caption ' . $atts['align'] . '">
			<div id="' . $atts['id'] . '" class="wp-caption">' . $image . '
			<p class="wp-caption-text">' . $atts['caption'] . '</p>
			</div>
			</div>
			';

		return $html;
	}


	/** Line
	  *
	  * Creates a line separator
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses prepare_margin()
	  * @uses prepare_color()
	  * @uses shortcode_documentation()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function line( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample' => false,
			'margin' => $this->shortcodes['line']['margin'],
			'color'  => $this->shortcodes['line']['color'],
			'line_style'  => $this->shortcodes['line']['line_style'],
			'height' => $this->shortcodes['line']['height'],
			'style' => $this->shortcodes['line']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'line' );
		}

		// Prepare Styles
		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_array['border-color'] = 'border-color: ' . $this->prepare_color( $color );
		$style_array['border-style'] = 'border-style: ' . $line_style;
		$style_array['border-width'] = 'border-width: 0 0 ' . $height . ' 0';
		$style_string = implode( '; ', $style_array );
        $style_string .= '; ' . $style;

		// Prepare Classes
		$class_array[] = 'line';
		$class_string = implode( ' ', $class_array );

		// Create Output

		$output .= "
			<div class='" . $class_string . "' style='" . $style_string . "'></div>
		";

		return $output;


	}


	/** Line and Link
	  *
	  * Creates a line separator with a link floated to one side
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses prepare_margin()
	  * @uses prepare_color()
	  * @uses shortcode_documentation()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function linelink( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'     => false,
			'margin'    => $this->shortcodes['linelink']['margin'],
			'color'     => $this->shortcodes['linelink']['color'],
			'line_style'     => $this->shortcodes['linelink']['line_style'],
			'height'     => $this->shortcodes['linelink']['height'],
			'linktext'   => $this->shortcodes['linelink']['linktext'],
			'url'        => $this->shortcodes['linelink']['url'],
			'text_align' => $this->shortcodes['linelink']['text_align'],
			'style' => $this->shortcodes['linelink']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'linelink' );
		}

		// Prepare Styles
		$linelink_style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$linelink_style_string = implode( '; ', $linelink_style_array );
        $linelink_style_string .= '; ' . $style;

		$line_style_array['border-color'] = 'border-color: ' . $this->prepare_color( $color );
		$line_style_array['border-style'] = 'border-style: ' . $line_style;
		$line_style_array['border-width'] = 'border-width: 0 0 ' . $height . ' 0';
		$line_style_string = implode( '; ',  $line_style_array );

		// Prepare Classes
		$class_array[] = 'linelink';
		$class_array[] = $text_align;
		$class_string = implode( ' ', $class_array );

		// Create Output

		$output .= "
			<div class='" . $class_string . "' style='" . $linelink_style_string . "'>
				<a href='" . $url . "'>" . $linktext . "</a>
				<div class='line' style='" . $line_style_string . "'></div>
			</div>
		";

		return $output;


	}



	function page( $atts, $content ) {
		global $blueprint, $post;
		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample' => false,
			'margin' => $this->shortcodes['page']['margin'],
			'id'     => $this->shortcodes['page']['id'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'page' );
		}

		// Prepare Styles
		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_string = implode( '; ', $style_array );

		// Prepare Classes
		$class_array[] = 'mashup-page';
		$class_string = implode( ' ', $class_array );

		// Create Output


		$temp_post = $post;
		$post = get_post( $id );
		setup_postdata($post);

		$output = '';
		if( $this->framework->get_post_type( $post->ID ) != 'template-apartmentlist' ) {
			ob_start();

			echo "<div class='" . $class_string . "' style='" . $style_string . "'>";
			$this->framework->get_all_postmeta();

			global $in_mashup; $in_mashup = true;
			include( get_template_directory() . '/templates/' . $blueprint->blueprint_template( 'file', true ) );

			echo "</div>";
			$output = ob_get_clean();

		}

		$post = $temp_post;

		return $output;


	}



	/** Highlight
	  *
	  * Highlights the text in the $content variable.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses EB_Styler::color()
	  * @uses EB_Styler::background()
	  * @uses EB_Styler::textshadow()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function highlight( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'    => false,
			'color'      => $this->shortcodes['highlight']['color'],
			'background' => $this->shortcodes['highlight']['background'],
			'style' => $this->shortcodes['highlight']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'highlight' );
		}

		// Prepare Styles
		$color = $this->prepare_color( $color );

		$background = $this->prepare_color( $background );
		$style_array['color'] = $this->styler->color( $color );
		$style_array['background'] = $this->styler->background( $background );
		//$style_array['text-shadow'] = $this->styler->textshadow( $color );
		$style_string = implode( '; ', $style_array ) ;
        $style_string .= '; ' . $style;

		// Prepare Classes
		$class_array[] = 'highlight';
		$class_string = implode( ' ', $class_array );

		// Create Output

		$output .= "<span class='" . $class_string . "' style='" . $style_string . "'>&nbsp;" . $content . "&nbsp;</span>";

		return $output;


	}


	/** State
	  *
	  * Outputs the $content based on the user's login state.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function state( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'    => false,
			'type'     => 'loggedin',
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'state' );
		}

		// Create Output

		if( ( $type == 'loggedin' AND is_user_logged_in() ) OR ( $type == 'guest' ) AND !is_user_logged_in() ) {
			$output = do_shortcode( $content );
		}

		return $output;

	}


	/** Button
	  *
	  * Creates a nicely formatted button.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_color()
	  * @uses EB_Styler::color()
	  * @uses EB_Styler::background()
	  * @uses EB_Styler::radius()
	  * @uses EB_Styler::textshadow()
	  * @uses EB_Styler::shadow()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function button( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'       => false,
			'margin'       => $this->shortcodes['button']['margin'],
			'color'        => $this->shortcodes['button']['color'],
			'background'   => $this->shortcodes['button']['background'],
			'radius'       => $this->shortcodes['button']['radius'],
			'border_style' => $this->shortcodes['button']['border_style'],
			'border_width' => $this->shortcodes['button']['border_width'],
			'border_color' => $this->shortcodes['button']['border_color'],
			'gradient'     => $this->shortcodes['button']['gradient'],
			'outline_style'=> $this->shortcodes['button']['outline_style'],
			'outline_width'=> $this->shortcodes['button']['outline_width'],
			'outline_color'=> $this->shortcodes['button']['outline_color'],
			'shadow'       => $this->shortcodes['button']['shadow'],
			'arrow'        => $this->shortcodes['button']['arrow'],
			'text'         => 'To The Top',
			'url'          => '',
			'classes'      => '',
			'parameters'   => '',
			'target'       => '',
			'style' => $this->shortcodes['button']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'button' );
		}

		// Prepare Styles

		$background = $this->prepare_color( $background );
		$color = $this->prepare_color( $color, $background );

		$button_style_array['color'] = $this->styler->color( $color );

		$button_style_array['background'] = $this->styler->background( $background, $gradient );
		$button_style_array['radius'] = $this->styler->radius( $radius );
		if( !empty( $border_style ) ) {
			$button_style_array['border_style'] = 'border-style: ' . $border_style;
		}
		if( !empty( $border_width ) ) {
			$button_style_array['border_width'] = 'border-width: ' . $border_width;
		}
		if( !empty( $border_color ) ) {
			$auto = $this->shortcodes['button']['border_auto_color'];
			array_unshift( $auto, $background );
			$button_style_array['border_color'] = 'border-color: ' . $this->prepare_color( $border_color, $auto );
		}
		if( !empty( $shadow ) AND $shadow == 'yes' ) {
			$shadow_value = $this->shortcodes['button']['shadow_value'];
			$button_style_array['shadow'] = $this->styler->shadow( $shadow_value );
		}


		//$button_style_array['text-shadow'] = $this->styler->textshadow( $color );


		$button_style_string = implode( '; ', $button_style_array ) ;

		$container_style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$container_style_array['radius'] = $this->styler->radius( $radius, 1 );
		if( !empty( $outline_style ) ) {
			$container_style_array['border_style'] = 'border-style: ' . $outline_style;
		}
		if( !empty( $outline_width ) ) {
			$container_style_array['border_width'] = 'border-width: ' . $outline_width;
		}
		if( !empty( $outline_color ) ) {
			$auto = $this->shortcodes['button']['outline_auto_color'];
			array_unshift( $auto, $background );
			$container_style_array['border_color'] = 'border-color: ' . $this->prepare_color( $outline_color, $auto );
		}
		$container_style_string = implode( '; ', $container_style_array );
        $container_style_string .= '; ' . $style;

		// Prepare Classes
		$class_array[] = 'button-container';
		$class_string = implode( ' ', $class_array );
		$class_string .= ' ' . $classes;
		// Determine Element

		$element_start = ( !empty( $url ) ) ? '<a href="' . $url . '"' : "<span";
		$element_end = ( !empty( $url ) ) ? 'a' : "span";


		// Create Output

		$parameters = wp_parse_args($parameters);
		$parameter_array = array();
		foreach( $parameters as $parameter => $value ) {
			$parameter_array[] = $parameter . "='" . $value . "'";
		}
		$parameters = implode( ' ', $parameter_array );

		$target_attr = ( !empty( $target ) ) ? 'target="' . $target . '"'  : '';

		$output .= "
			<div " . $parameters . " class='" . $class_string . "' style='" . $container_style_string . "'>
				" . $element_start . " " . $target_attr . " class='button' style='" . $button_style_string . "'>";
		$output .= $text;
		if( $arrow == 'yes' ){
			$output .= '<span class="arrow" style="border-color: transparent transparent transparent '.$color .'"></span>';
		}
		$output .= "</" . $element_end . ">
			</div>
		";

		return $output;


	}


	/** Message
	  *
	  * Creates configurable message to display to the user.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_margin()
	  * @uses prepare_color()
	  * @uses EB_Styler::color()
	  * @uses EB_Styler::background()
	  * @uses EB_Styler::radius()
	  * @uses EB_Styler::textshadow()
	  * @uses EB_Styler::shadow()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function message( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'       => false,
			'margin'       => $this->shortcodes['message']['margin'],
			'color'        => $this->shortcodes['message']['color'],
			'background'   => $this->shortcodes['message']['background'],
			'radius'       => $this->shortcodes['message']['radius'],
			'border_style' => $this->shortcodes['message']['border_style'],
			'border_width' => $this->shortcodes['message']['border_width'],
			'border_color' => $this->shortcodes['message']['border_color'],
			'gradient'     => $this->shortcodes['message']['gradient'],
			'outline_style'=> $this->shortcodes['message']['outline_style'],
			'outline_width'=> $this->shortcodes['message']['outline_width'],
			'outline_color'=> $this->shortcodes['message']['outline_color'],
			'shadow'       => $this->shortcodes['message']['shadow'],
			'style'        => $this->shortcodes['message']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'message' );
		}

		// Prepare Styles
		$background = $this->prepare_color( $background );
		$color = $this->prepare_color( $color, $background );

		$button_style_array['color'] = $this->styler->color( $color );
		$button_style_array['background'] = $this->styler->background( $background, $gradient );
		$button_style_array['radius'] = $this->styler->radius( $radius );
		if( !empty( $border_style ) ) {
			$button_style_array['border_style'] = 'border-style: ' . $border_style;
		}
		if( !empty( $border_width ) ) {
			$button_style_array['border_width'] = 'border-width: ' . $border_width;
		}
		if( !empty( $border_color ) ) {
			$auto = $this->shortcodes['button']['border_auto_color'];
			array_unshift( $auto, $background );
			$button_style_array['border_color'] = 'border-color: ' . $this->prepare_color( $border_color, $auto );
		}

		//$button_style_array['text-shadow'] = $this->styler->textshadow( $color );

		$button_style_string = implode( '; ', $button_style_array ) ;

		$container_style_array['radius'] = $this->styler->radius( $radius, 1 );
		$container_style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		if( !empty( $shadow ) AND $shadow == 'on' ) {
			$shadow_value = $this->shortcodes['button']['shadow_value'];
			$container_style_array['shadow'] = $this->styler->shadow( $shadow_value );
		}
		if( !empty( $outline_style ) ) {
			$container_style_array['outline_style'] = 'outline-style: ' . $outline_style;
		}
		if( !empty( $outline_width ) ) {
			$container_style_array['outline_width'] = 'outline-width: ' . $outline_width;
		}
		if( !empty( $outline_color ) ) {
			$auto = $this->shortcodes['button']['outline_auto_color'];
			array_unshift( $auto, $background );
			$container_style_array['outline_color'] = 'outline-color: ' . $this->prepare_color( $outline_color, $auto );
		}
		$container_style_string = implode( '; ', $container_style_array );
        $container_style_string .= '; ' . $style;
		// Prepare Classes
		$class_array[] = 'message-container';
		$class_string = implode( ' ', $class_array );

		// Create Output

		$output .= "
			<div class='" . $class_string . "' style='" . $container_style_string . "'>
				<div class='message' style='" . $button_style_string . "'>" . $content . "</div>
			</div>
		";

		return $output;


	}


	/** Image Slider
	  *
	  * Creates a slider to be used with images.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_margin()
	  *
	  * @global object $imageslider A WordPress query object
	  * @global object $post The WordPress post object
	  * @global array $attributes An array of attributes for the slider
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function imageslider( $atts, $content ) {
		global $imageslider, $post, $attributes;
		// Extract the attributes into variables
		$atts = shortcode_atts( array(
			'sample'    => false,
			'margin' => $this->shortcodes['imageslider']['margin'],
			'animation' => $this->shortcodes['imageslider']['animation'],
			'direction' => $this->shortcodes['imageslider']['direction'],
			'slideshow_speed' => $this->shortcodes['imageslider']['slideshow_speed'],
			'animation_speed' => $this->shortcodes['imageslider']['animation_speed'],
			'pause_on_hover' => $this->shortcodes['imageslider']['pause_on_hover'],
			'height' => $this->shortcodes['imageslider']['height'],
			'controls' => $this->shortcodes['imageslider']['controls'],
			'images' => $this->shortcodes['imageslider']['images'],
			'layout' => $this->shortcodes['imageslider']['layout'],
			'show_title' => $this->shortcodes['imageslider']['show_title'],
			'show_description' => $this->shortcodes['imageslider']['show_description'],
			'style' => $this->shortcodes['imageslider']['style'],
		 ), $atts );


		extract( $atts );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'imageslider' );
		}

		// Create Output

		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_array['height'] = 'max-height: ' . $height;
		$style_string = implode( '; ',  $style_array );
        $style_string .= '; ' . $style;

		if( !empty( $query_vars ) ) {
			$args = unserialize( $query_vars );
		}

		if( $images == 'all' ) {
			$args = array(
				'post_type' => 'attachment',
				'post_status' => 'any',
				'post_parent' => $post->ID,
				'posts_per_page' => -1
			);
		}
		else {
			$args = array(
				'post_type' => 'attachment',
				'post_status' => 'any',
				'post__in' => explode( ',', $images ),
				'posts_per_page' => -1
			);
		}

		$data = array();
		foreach( $atts as $name => $value ) {
			$data[] = 'data-' . $name . '="' . $value . '"';
		}
		$data = implode( ' ', $data );

		$imageslider = new WP_Query( $args );
		$temp_post = $post;
		$attributes = $atts;
		ob_start();
		echo '<div ' . $data . ' class="imageslider" style="' . $style_string . '">';
		include( $this->framework->get_layout( 'imageslider', $layout ) );
		echo '</div>';
		$output = ob_get_clean();
		$post = $temp_post;
		return $output;

	}


	/** Post Slider
	  *
	  * Creates a slider to be used with posts.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_margin()
	  *
	  * @global object $postslider A WordPress query object
	  * @global object $post The WordPress post object
	  * @global array $attributes An array of attributes for the slider
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function postslider( $atts, $content ) {
		global $postslider, $post, $attributes;
		// Extract the attributes into variables
		$atts = shortcode_atts( array(
			'sample'    => false,
			'margin' => $this->shortcodes['postslider']['margin'],
			'height'=> $this->shortcodes['postslider']['height'],
			'post_type' => $this->shortcodes['postslider']['post_type'],
			'post_status'=> $this->shortcodes['postslider']['post_status'],
			'posts_per_page' => $this->shortcodes['postslider']['posts_per_page'],
			'author' => $this->shortcodes['postslider']['author'],
			'cat' => $this->shortcodes['postslider']['cat'],
			'tag' => $this->shortcodes['postslider']['tag'],
			'offset' => $this->shortcodes['postslider']['offset'],
			'order' => $this->shortcodes['postslider']['order'],
			'orderby' => $this->shortcodes['postslider']['orderby'],
			'query_vars' => $this->shortcodes['postslider']['query_vars'],
			'animation' => $this->shortcodes['postslider']['animation'],
			'only_thumbnailed' => $this->shortcodes['postslider']['only_thumbnailed'],
			'direction' => $this->shortcodes['postslider']['direction'],
			'slideshow_speed' => $this->shortcodes['postslider']['slideshow_speed'],
			'animation_speed' => $this->shortcodes['postslider']['animation_speed'],
			'pause_on_hover' => $this->shortcodes['postslider']['pause_on_hover'],
			'smooth_height' => $this->shortcodes['postslider']['smooth_height'],
			'controls' => $this->shortcodes['postslider']['controls'],
			'layout' => $this->shortcodes['postslider']['layout'],
			'show_title' => $this->shortcodes['postslider']['show_title'],
			'show_description' => $this->shortcodes['postslider']['show_description'],
			'style' => $this->shortcodes['postslider']['style'],
		 ), $atts );

		extract( $atts );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'postslider' );
		}

		// Create Output
		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_array['height'] = 'max-height: ' . $height;
		$style_string = implode( '; ',  $style_array );
        $style_string .= '; ' . $style;

		if( !empty( $query_vars ) ) {
			$atts = unserialize( $query_vars );
		}

		$temp_post = $post;


		if ( $only_thumbnailed == true ) {
			$atts['meta_query'] = array(
				array(
					'key' => '_thumbnail_id',
					'value' => '',
					'compare' => '!='
				)
			);
		}

		$attributes = $atts;
		$postslider = new WP_Query( $atts );

		foreach( $atts as $name => $value ) {
			if( is_string( $value ) ) {
				$data[] = 'data-' . $name . '="' . $value . '"';
			}
		}
		$data = implode( ' ', $data );

		ob_start();
		echo '<div ' . $data . ' class="postslider imageslider" style="' . $style_string . '">';
		echo '<div class="loader"></div>';
		include( $this->framework->get_layout( 'postslider', $layout ) );
		echo '</div>';
		$output = ob_get_clean();
		$post = $temp_post;

		return $output;

	}


	/** Toggle
	  *
	  * Creates a toggle section which users can use to hide/show content
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_margin()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function toggle( $atts, $content ) {

		// Extract the attributes into variables
		$atts = shortcode_atts( array(
			'sample'    => false,
			'margin' => $this->shortcodes['toggle']['margin'],
			'title' => $this->shortcodes['toggle']['title'],
			'title_level' => $this->shortcodes['toggle']['title_level'],
			'default' => $this->shortcodes['toggle']['default'],
			'animation' => $this->shortcodes['toggle']['animation'],
			'animation_speed' => $this->shortcodes['toggle']['animation_speed'],
			'style' => $this->shortcodes['toggle']['style'],
		 ), $atts );

		extract( $atts );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'toggle' );
		}

		// Create Output
		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_string = implode( '; ',  $style_array );
        $style_string .= '; ' . $style;

		$output = '
			<div class="toggle ' . $default . '" data-animation="' . $animation . '" data-animation_speed="' . $animation_speed . '" style="' . $style_string . '">
				<h' . $title_level . ' class="toggle-title">' . $title . '</h' . $title_level . '>
				<div class="toggle-content">
					' . do_shortcode( $content ) . '
				</div>
			</div>
		';


		return $output;

	}


	/** Map
	  *
	  * Creates and inserts a Google Maps map into the content.
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  * @uses prepare_margin()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function map( $atts, $content ) {

		// Extract the attributes into variables
		$atts = shortcode_atts( array(
			'sample'    => false,
			'margin' => $this->shortcodes['map']['margin'],
			'location' => $this->shortcodes['map']['location'],
			'zoom' => $this->shortcodes['map']['zoom'],
			'maptype' => $this->shortcodes['map']['maptype'],
			'marker' => $this->shortcodes['map']['marker'],
			'height' => $this->shortcodes['map']['height'],
			'style' => $this->shortcodes['map']['style'],
		 ), $atts );

		extract( $atts );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'map' );
		}

		// Create Output
		$style_array['height'] = 'height: ' . $height . 'px';
		$style_array['margin'] = 'margin: ' . $this->prepare_margin( $margin );
		$style_string = implode( '; ', $style_array ) ;
        $style_string .= '; ' . $style;

	$id = rand( 9999, 999999 );
	ob_start();
	?>

	<div class="map-canvas" id='map-<?php echo $id ?>' style="width: 100%; <?php echo $style_string ?>"></div>
		<script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			var geocoder = new google.maps.Geocoder();
			var address = '<?php echo $location  ?>';
			geocoder.geocode( { 'address': address}, function(results, status) {
				var lat = results[0].geometry.location.lat();
				var lng = results[0].geometry.location.lng();
				var latLng = new google.maps.LatLng(lat, lng);
				var mapOptions = {
					scrollwheel: false,
				  center: latLng,
				  zoom: <?php echo $zoom ?>,
				  mapTypeId: google.maps.MapTypeId.<?php echo strtoupper($maptype) ?>
				};

				var map = new google.maps.Map( $("#map-<?php echo $id ?>")[0],
			    mapOptions);

			    <?php if( $marker == 'yes' ) : ?>
			    var marker = new google.maps.Marker({
			      position: latLng,
			      map: map,
			    });
			    <?php endif ?>
			})
		})

		</script>


	<?php
	$output = ob_get_clean();
	return $output;

	}


	function tiles( $atts, $content ) {
		global $post;
		// Extract the attributes into variables
		$atts = shortcode_atts( array(
			'sample'    => false,
			'columns' => $this->shortcodes['tiles']['columns'],
			'style' => $this->shortcodes['tiles']['style'],
			'tile_style' => $this->shortcodes['tiles']['tile_style'],
			'background'          => $this->shortcodes['tiles']['background'],
			'excerpt_length'      => $this->shortcodes['tiles']['excerpt_length'],
			'show_title'          => $this->shortcodes['tiles']['show_title'],
			'show_excerpt'        => $this->shortcodes['tiles']['show_excerpt'],
			'show_link'           => $this->shortcodes['tiles']['show_link'],
			'only_thumbnailed' => $this->shortcodes['tiles']['only_thumbnailed'],
			'post_type' => $this->shortcodes['tiles']['post_type'],
			'post_status'=> $this->shortcodes['tiles']['post_status'],
			'posts_per_page' => $this->shortcodes['tiles']['posts_per_page'],
			'author' => $this->shortcodes['tiles']['author'],
			'cat' => $this->shortcodes['tiles']['cat'],
			'tag' => $this->shortcodes['tiles']['tag'],
			'offset' => $this->shortcodes['tiles']['offset'],
			'order' => $this->shortcodes['tiles']['order'],
			'orderby' => $this->shortcodes['tiles']['orderby'],
			'query_vars' => $this->shortcodes['tiles']['query_vars'],
			'slideshow' => $this->shortcodes['tiles']['slideshow'],
			'slideshow_speed' => $this->shortcodes['tiles']['slideshow_speed'],
			'animation_speed' => $this->shortcodes['tiles']['animation_speed'],
			'animation_order' => $this->shortcodes['tiles']['animation_order'],
		 ), $atts );

		extract( $atts );


		$style_array['margin'] = '';
		$style_string = implode( '; ', $style_array ) ;
        $style_string .= '; ' . $style;

        $background = $this->prepare_color( $background );
		$tile_style_array['background'] = 'background: ' . $background;
		$tile_style_string = implode( '; ', $tile_style_array ) ;
        $tile_style_string .= '; ' . $tile_style;


        if( empty( $content ) ) {
	        $args['post_type'] = $post_type;
	        $args['post_status'] = $post_status;
	        $args['posts_per_page'] = $posts_per_page;
	        $args['author'] = $author;
	        $args['cat'] = $cat;
	        $args['tag'] = $tag;
	        $args['order'] = $order;
	        $args['orderby'] = $orderby;

			if ( $only_thumbnailed == true ) {
				$args['meta_query'] = array(
					array(
						'key' => '_thumbnail_id',
						'value' => '',
						'compare' => '!='
					)
				);
			}
			$temp_post = $post;
			$tiles = new WP_Query( $args );

			?>
			<?php
			ob_start();
			?>
			<div class='tiles' data-slideshow='<?php echo $slideshow ?>' data-col='<?php echo $columns ?>' style="<?php echo $style_string ?>" data-slideshow_speed='<?php echo $slideshow_speed ?>' data-animation_speed='<?php echo $animation_speed ?>' data-animation_order='<?php echo $animation_order ?>'>
				<?php while( $tiles->have_posts() ): $tiles->the_post(); ?>
				<div class="tile" style="<?php echo $tile_style_string ?>">
						<?php the_post_thumbnail( 'eb_xlarge_thumb' ) ?>
					<div class="tile-content">
						<div class='inner'>
						<?php if( $show_title == 'yes' ) : ?>
							<h2 class="title"><?php the_title() ?></h2>
						<?php endif ?>
						<?php if( $show_excerpt == 'yes' ) : ?>
							<div class='excerpt'><?php the_excerpt() ?></div>
						<?php endif ?>
						</div>
						<?php if( $show_link == 'yes' ) : ?>
							<a class="link" href='<?php the_permalink() ?>'><span style='background-color: <?php echo $background ?>' class='read-more-arrow'></span></a>
						<?php endif ?>
					</div>
				</div>
				<?php endwhile; $post = $temp_post ?>
			</div>
			<?php
			return ob_get_clean();
		}
		else {

			preg_match_all( "/\[tile(.*?)\](.*?)\[\/tile\]/s", $content, $tiles, PREG_SET_ORDER );
			ob_start();


			?>

			<div data-slideshow='<?php echo $slideshow ?>' class='tiles' data-col='<?php echo $columns ?>' style="<?php echo $style_string ?>" data-slideshow_speed='<?php echo $slideshow_speed ?>' data-animation_speed='<?php echo $animation_speed ?>' data-animation_order='<?php echo $animation_order ?>'>
				<?php
					foreach( $tiles as $tile ) {
							echo do_shortcode( $tile[0] );
					}
					?>

			</div>

			<?php

			return ob_get_clean();
		}

	}


function tile( $atts, $content ) {

		ob_start();

		$tile_background = ( !empty( $atts['background'] ) ) ?  $atts['background']  : $this->shortcodes['tiles']['background'];
        $background = $this->prepare_color( $tile_background );

	?>
	<div class="tile" style="background-color:<?php echo $background ?>">
		<div class="image">
			<?php
				$image = wp_get_attachment_image_src( $atts['image'], 'eb_xlarge_thumb' );
				echo '<img src="' . $image[0] . '">';
			?>
		</div>
		<div class="tile-content">
			<div class='inner'>
				<?php echo do_shortcode($content) ?>
			</div>
			<?php if( !empty( $atts['url'] ) ) : ?>
				<a class="link" href='<?php echo $atts['url'] ?>'><span style='background-color: <?php echo $tile_background ?>' class='read-more-arrow'></span></a>
			<?php endif ?>
		</div>
	</div>
<?php
	return ob_get_clean();
}


	/** Tabbed Section
	  *
	  * Creates a tabbed section, to be used in conjunction with the
	  * tab shortcode (not an actual shortcode, we just use regex).
	  *
	  * @param array $atts The attributes passed to the shortcode
	  * @param string $content The content the shortcode is wrapped around
	  *
	  * @see $shortcodes
	  *
	  * @uses shortcode_documentation()
	  *
	  * @return string $output The resulting HTML code
	  *
	  */
	function tabs( $atts, $content ) {

		// Extract the attributes into variables
		extract( shortcode_atts( array(
			'sample'    => false,
			'margin'    => $this->shortcodes['tabs']['margin'],
			'style' => $this->shortcodes['tabs']['style'],
		 ), $atts ) );

		// Prepare the style and class display and the output
		$style_array = array(); $class_array = array(); $output = '';

		// Display Documentation
		if ( isset( $sample ) AND !empty( $sample ) ) {
			return $this->shortcode_documentation( 'tabs' );
		}

		preg_match_all( "/\[tab title=['|\"](.*?)['|\"]\](.*?)\[\/tab\]/s", $content, $matches );

		$tabs = $matches[1];
		$tab_content = $matches[2];
		ob_start();
		?>
		<div class="tabs" style="<?php echo $style ?>">
			<nav>
				<ul>
					<?php
						while( $tab = current( $tabs ) ) :
						$current = ( key( $tabs ) == 0 ) ? 'current' : '';
					?><li class='<?php echo $current ?>' data-tab='<?php echo key( $tabs ) ?>'><?php echo $tab ?></li><?php next( $tabs ); endwhile ?>
				</ul>
			</nav>

			<div class='tab-container'>
			<?php
				while( $tab = current( $tab_content ) ) :
				$current = ( key( $tab_content ) == 0 ) ? 'current' : '';
			?>
				<div class='tab' data-tab='<?php echo key( $tab_content ) ?>'>
					<?php echo do_shortcode( $tab ) ?>
				</div>
			<?php next( $tab_content ); endwhile ?>
			</div>
		</div>
		<?php
			$output = ob_get_clean();
		return $output;

	}




	/***********************************************/
	/*         Style And Class Prepatation         */
	/***********************************************/

	/** Prepare Margin
	  *
	  * Prepares the value of a margin. It figures out
	  * a margin value based on a named value.
	  *
	  * @param string $margin
	  *
	  * @return string $output The resulting margin value
	  *
	  */
	function prepare_margin( $margin ) {
		switch ( $margin ) {
			case 'small' :
				$output = '0 0 11px 0';
				break;
			case 'normal' :
				$output = '0 0 22px 0';
				break;
			case 'large' :
				$output = '0 0 44px 0';
				break;
			case 'none' :
				$output = '0px';
				break;
			case '0' :
				$output = '0px';
				break;
			case '0px' :
				$output = '0px';
				break;
			default :
				$output = $margin;
		}

		return $output;
	}

	/** Prepare Color
	  *
	  * Prepares a color valur for use. It either calculates
	  * the correct color automatically or it finds it in the
	  * color array if it exists.
	  *
	  * @param string $color The color to prepare
	  * @param mixed $auto Instructiosn for styling color automatically
	  *
	  * @uses EB_Styler::lightness
	  *
	  * @return string $color_value The resulting color value
	  *
	  */
	function prepare_color( $color, $auto = '' ) {

		if( $color == 'auto' ) {
			if( is_array( $auto ) ) {
				$color_value = $this->styler->lightness( $auto[0], $auto[1], $auto[2] );
			}
			else {
				$base_color = substr( $auto, 1 );
				if( strlen( $base_color ) == 3 ) {
					$c = str_split( $base_color );
					$base_color = $c[0].$c[0].$c[1].$c[1].$c[2].$c[2];
				}

				$r = hexdec(substr($base_color,0,2));
				$g = hexdec(substr($base_color,2,2));
				$b = hexdec(substr($base_color,4,2));

				if($r + $g + $b > 400 ){
				   $color_value = $this->styler->lightness( '#' . $base_color , '-', 66 );
				}else{
				   $color_value = '#ffffff';
				}

			}
		}
		else {
			$colors = array_keys( $this->framework->defaults['colors'] );
			if( in_array( $color, $colors ) ) {
				if( !empty( $this->framework->options[$color . '_color'] ) ){
					$color_value = $this->framework->options[$color . '_color'];
				}
				else {
					$color_value = $this->framework->defaults['colors'][$color];
				}
			}
			else {
				$color_value = $color;
			}

		}
		return $color_value;
	}

	/***********************************************/
	/*          Documentation Functions            */
	/***********************************************/

	/** Get Documentation
	  *
	  * Contains the documentation array for all the shortcodes defined
	  * in this class. It also checks for custom shortcode definitions,
	  * merges the two arrays and produces the result.
	  *
	  * @uses get_element_documentation()
	  *
	  * @return array $documentation
	  *
	  */
	function get_documentation() {
		$documentation = array();

		if( isset( $this->shortcodes['line'] ) ) {
		$documentation['line'] = array(
			'title' => 'Line',
			'shortcode' => '[line]',
			'description' => 'Creates a divider line',
			'parameters'  => array(
				$this->get_element_documentation( 'margin', $this->shortcodes['line']['margin'] ),
				$this->get_element_documentation( 'line_style',  $this->shortcodes['line']['line_style'] ),
				$this->get_element_documentation( 'color',  $this->shortcodes['line']['color'] ),
				$this->get_element_documentation( 'style',  $this->shortcodes['line']['style'] ),
				$this->get_element_documentation( 'height',  $this->shortcodes['line']['height'] ),
			 )
		 );
		}
		if( isset( $this->shortcodes['linelink'] ) ) {
		$documentation['linelink'] = array(
				'title' => 'Line with Link',
				'shortcode' => '[linelink]',
				'description' => 'Creates a divider line with a link',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['linelink']['margin'] ),
					$this->get_element_documentation( 'line_style',  $this->shortcodes['linelink']['line_style'] ),
					$this->get_element_documentation( 'color',  $this->shortcodes['linelink']['color'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['linelink']['style'] ),
					$this->get_element_documentation( 'height',  $this->shortcodes['linelink']['height'] ),
					$this->get_element_documentation( 'linktext',  $this->shortcodes['linelink']['linktext'] ),
					$this->get_element_documentation( 'url',  $this->shortcodes['linelink']['url'] ),
					'text_align' => array(
						'name'         => 'text_align',
						'description'  => 'Change the alignment of the text in this element',
						'default'      => $this->shortcodes['linelink']['text_align'],
						'values'       => array(
							'left' => array (
								'name' => 'left',
								'description' => 'Aligns the text to the left',
							),
							'right' => array (
								'name' => 'right',
								'description' => 'Aligns the text to the right',
							),
						 )
					 ),

				 )
			 );
		}
		if( isset( $this->shortcodes['highlight'] ) ) {
		$documentation['highlight'] = array(
				'title' => 'Highlight',
				'shortcode' => '[highlight]',
				'description' => 'Highlights the selected text using the given colors',
				'parameters'  => array(
					$this->get_element_documentation( 'color',  $this->shortcodes['highlight']['color'] ),
					$this->get_element_documentation( 'background',  $this->shortcodes['highlight']['background'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['highlight']['style'] ),
				 )
			 );
		}
		if( isset( $this->shortcodes['tabs'] ) ) {
		$documentation['tabs'] = array(
				'title' => 'Tabs',
				'shortcode' => '[tabs]',
				'description' => 'Tabs can be used to create tabbed content.',
				'example' => $this->shortcodes['tabs']['example'],
				'parameters'  => array(
					$this->get_element_documentation( 'style',  $this->shortcodes['tabs']['style'] ),
				 )
			 );
		}
		if( isset( $this->shortcodes['page'] ) ) {
		$documentation['page'] = array(
				'title' => 'Page',
				'shortcode' => '[page]',
				'description' => 'Enables you to insert any post/page into the content',
				'parameters'  => array(
					$this->get_element_documentation( 'margin',  $this->shortcodes['page']['margin'] ),
					'id' => array(
						'name'         => 'id',
						'description'  => 'The ID of the page to insert',
						'default'      => '',
						'values'       => array(
							'[id]' => array (
								'name' => 'id',
								'description' => 'The numerical ID of the post/page to show.',
							),
						)

					 ),
				 )
			 );
		}
		if( isset( $this->shortcodes['box'] ) ) {
		$documentation['box'] = array(
				'title' => 'Box',
				'shortcode' => '[box]',
				'description' => 'Wrap content in this shortcode to create a box around it',
				'parameters'  => array(
					$this->get_element_documentation( 'margin',  $this->shortcodes['box']['margin'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['box']['style'] ),
				 )
			 );
		}
		if( isset( $this->shortcodes['map'] ) ) {
		$documentation['map'] = array(
				'title' => 'Map',
				'shortcode' => '[map]',
				'description' => 'Inserts a Google Map into the page',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['map']['margin'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['map']['style'] ),
					'location' => array(
						'name'         => 'location',
						'description'  => 'Enter an address to show',
						'default'      => $this->shortcodes['map']['location'],
						'values'       => array(
							'[location]' => array (
								'name' => 'location',
								'description' => 'Any address which works in Google Maps or Google Earth will work here',
							),
						)

					 ),
					'height' => array(
						'name'         => 'height',
						'description'  => 'Define how height the map container should be',
						'default'      => $this->shortcodes['map']['height'],
						'values'       => array(
							'[positive whole number]' => array (
								'name' => 'positive whole number',
								'description' => 'You can use any positive number as the height, it will be applied as a pixel height.',
							),
						)
					 ),

					'zoom' => array(
						'name'         => 'zoom',
						'description'  => 'Define how zoomed in the map should be',
						'default'      => $this->shortcodes['map']['zoom'],
						'values'       => array(
							'[positive whole number]' => array (
								'name' => 'positive whole number',
								'description' => 'You can use a positive whole number up to about 16; the higher the number, the more zoomed in the map goes. 12 works well for closeup maps.',
							),
						)
					 ),
					'maptype' => array(
						'name'         => 'maptype',
						'description'  => 'Set the map type to be used',
						'default'      => $this->shortcodes['map']['maptype'],
						'values'       => array(
							'ROADMAP' => array (
								'name' => 'ROADMAP',
								'description' => 'The default road map view',
							),
							'SATELLITE' => array (
								'name' => 'SATELLITE',
								'description' => 'Google Earth style satellite image',
							),
							'HYBRID' => array (
								'name' => 'HYBRID',
								'description' => 'A mixture of normal and satellite views',
							),
							'TERRAIN' => array (
								'name' => 'TERRAIN',
								'description' => 'Physical map based on terrain information',
							),
						)
					 ),
					'marker' => array(
						'name'         => 'marker',
						'description'  => 'Place a marker on the specified location on the map',
						'default'      => $this->shortcodes['map']['marker'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'A marker will be placed on the given location on the map',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The map will have no markers on it',
							),
						)
					 ),
				 )
			 );
		}
		if( isset( $this->shortcodes['toggle'] ) ) {
		$documentation['toggle'] = array(
				'title' => 'Toggle',
				'shortcode' => '[toggle]',
				'description' => 'Creates a toggleable content area',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['toggle']['margin'] ),
					'title' => array(
						'name'         => 'title',
						'description'  => 'The title of the section, users can also click this to toggle the section',
						'default'      => $this->shortcodes['toggle']['title'],
						'values'       => array(
							'[text]' => array (
								'name' => 'text',
								'description' => 'Any text can be used here',
							),
						)

					 ),
					$this->get_element_documentation( 'style',  $this->shortcodes['toggle']['style'] ),
					'title_level' => array(
						'name'         => 'title_level',
						'description'  => 'The heading level of the section title',
						'default'      => $this->shortcodes['toggle']['title_level'],
						'values'       => array(
							'heading_level' => array (
								'name' => 'heading_level',
								'description' => 'You can use any CSS heading level, enter 1-6 here to use the one you need',
							),
						)
					 ),
					'default' => array(
						'name'         => 'default',
						'description'  => 'The default state of the section',
						'default'      => $this->shortcodes['toggle']['default'],
						'values'       => array(
							'open' => array (
								'name' => 'open',
								'description' => 'The section will start out opened',
							),
							'closed' => array (
								'name' => 'closed',
								'description' => 'The section will start out closed',
							),

						)
					 ),
					'animation' => array(
						'name'         => 'animation',
						'description'  => 'The animation used when the slider is toggled',
						'default'      => $this->shortcodes['toggle']['animation'],
						'values'       => array(
							'none' => array (
								'name' => 'none',
								'description' => 'No animation will be used',
							),
							'slide' => array (
								'name' => 'slide',
								'description' => 'A sliding animation will be used',
							),

						)
					 ),
					'animation_speed' => array(
						'name'         => 'animation_speed',
						'description'  => 'The speed of the toggle animation',
						'default'      => $this->shortcodes['toggle']['animation_speed'],
						'values'       => array(
							'[miliseconds]' => array (
								'name' => 'miliseconds',
								'description' => 'The amount of time you\'d like each item to be shown, in miliseconds',
							),
						)
					),
				 )
			 );
		}
		if( isset( $this->shortcodes['state'] ) ) {

		$documentation['state'] = array(
				'title' => 'State',
				'shortcode' => '[state]',
				'description' => 'Enables you to show content based on the logged in state of the user',
				'parameters'  => array(
					'type' => array(
						'name'         => 'type',
						'description'  => 'Define which logged in state you want to show the content for',
						'default'      => $this->shortcodes['state']['type'],
						'values'       => array(
							'loggedin' => array (
								'name' => 'loggedin',
								'description' => 'The content is only shown if the user is logged in',
							),
							'guest' => array (
								'name' => 'guest',
								'description' => 'The content is only shown if the user is not logged in',
							),
						)
					 ),
				 )
			 );
		}
		if( isset( $this->shortcodes['imageslider'] ) ) {
		$documentation['imageslider'] = array(
				'title' => 'Post List',
				'shortcode' => '[imageslider]',
				'description' => 'Enables you to show a slideshow of images anywhere.',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['imageslider']['margin'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['imageslider']['style'] ),
					$this->get_element_documentation( 'animation', $this->shortcodes['imageslider']['animation'] ),
					$this->get_element_documentation( 'direction', $this->shortcodes['imageslider']['direction'] ),
					$this->get_element_documentation( 'slideshow_speed', $this->shortcodes['imageslider']['slideshow_speed'] ),
					$this->get_element_documentation( 'animation_speed', $this->shortcodes['imageslider']['animation_speed'] ),
					$this->get_element_documentation( 'pause_on_hover', $this->shortcodes['imageslider']['pause_on_hover'] ),
					'height' => array(
						'name'         => 'height',
						'description'  => 'Specify the height of the slider',
						'default'      => $this->shortcodes['imageslider']['height'],
						'values'       => array(
							'css_value' => array (
								'name' => 'css_value',
								'description' => 'A valid css height.',
							),
						 )
					 ),
					$this->get_element_documentation( 'controls',  $this->shortcodes['imageslider']['controls'] ),
					'images' => array(
						'name'         => 'images',
						'description'  => 'Select the images to show in this slider',
						'default'      => $this->shortcodes['imageslider']['images'],
						'values'       => array(
							'[ID,ID,ID]' => array (
								'name' => '[ID,ID,ID]',
								'description' => 'Add any number of image IDs to show. The post editor has an insert slider button which you can use to easily select images for a slider',
							),
							'all' => array (
								'name' => 'all',
								'description' => 'All images attached to the current post will be used in the slider',
							),
						 )
					 ),
					'show_title' => array(
						'name'         => 'show_title',
						'description'  => 'Show the image title in the slider (make sure to fill out the title field when uploading images)',
						'default'      => $this->shortcodes['imageslider']['show_title'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The title will be shown in the slider',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The title will not be shown in the slider',
							),
						 )
					 ),
					'show_description' => array(
						'name'         => 'show_description',
						'description'  => 'Show the image description in the slider (make sure to fill out the description field when uploading images)',
						'default'      => $this->shortcodes['imageslider']['show_description'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The description will be shown in the slider',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The description will not be shown in the slider',
							),
						 )
					 ),
					$this->get_element_documentation( 'layout',  $this->shortcodes['imageslider']['layout'], 'imageslider' ),
				 )
			 );
		}
		if( isset( $this->shortcodes['postslider'] ) ) {
		$documentation['postslider'] = array(
				'title' => 'Post Slider',
				'shortcode' => '[postslider]',
				'description' => 'Enables you to show a slideshow of posts anywhere',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['postslider']['margin'] ),
					$this->get_element_documentation( 'height',  $this->shortcodes['postslider']['height'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['postslider']['style'] ),
					$this->get_element_documentation( 'layout',  'default', 'postslider' ),
					$this->get_element_documentation( 'post_type', $this->shortcodes['postslider']['post_type'] ),
					$this->get_element_documentation( 'post_status', $this->shortcodes['postslider']['post_status'] ),
					$this->get_element_documentation( 'author', $this->shortcodes['postslider']['author'] ),
					$this->get_element_documentation( 'cat', $this->shortcodes['postslider']['cat'] ),
					$this->get_element_documentation( 'tag', $this->shortcodes['postslider']['tag'] ),
					$this->get_element_documentation( 'posts_per_page', $this->shortcodes['postslider']['posts_per_page'] ),
					$this->get_element_documentation( 'offset', $this->shortcodes['postslider']['offset'] ),
					$this->get_element_documentation( 'order', $this->shortcodes['postslider']['order'] ),
					$this->get_element_documentation( 'orderby', $this->shortcodes['postslider']['orderby'] ),
					$this->get_element_documentation( 'query_vars', $this->shortcodes['postslider']['query_vars'] ),



					$this->get_element_documentation( 'animation', $this->shortcodes['postslider']['animation'] ),
					$this->get_element_documentation( 'direction', $this->shortcodes['postslider']['direction'] ),
					$this->get_element_documentation( 'slideshow_speed', $this->shortcodes['postslider']['slideshow_speed'] ),
					$this->get_element_documentation( 'animation_speed', $this->shortcodes['postslider']['animation_speed'] ),
					$this->get_element_documentation( 'pause_on_hover', $this->shortcodes['postslider']['pause_on_hover'] ),
					$this->get_element_documentation( 'smooth_height', $this->shortcodes['postslider']['smooth_height'] ),
					$this->get_element_documentation( 'controls',  $this->shortcodes['postslider']['controls'] ),
					'show_title' => array(
						'name'         => 'show_title',
						'description'  => 'Show the image title in the slider (make sure to fill out the title field when uploading images)',
						'default'      => $this->shortcodes['postslider']['show_title'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The title will be shown in the slider',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The title will not be shown in the slider',
							),
						 )
					 ),
					'only_thumbnailed' => array(
						'name'         => 'only_thumbnailed',
						'description'  => 'Only show posts if they have a featured image',
						'default'      => $this->shortcodes['postslider']['only_thumbnailed'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'Only show posts with featured images',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'Show all posts',
							),
						 )
					 ),
					'show_description' => array(
						'name'         => 'show_description',
						'description'  => 'Show the image description in the slider (make sure to fill out the description field when uploading images)',
						'default'      => $this->shortcodes['postslider']['show_description'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The description will be shown in the slider',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The description will not be shown in the slider',
							),
						 )
					 ),
				 )
			 );
		}
		if( isset( $this->shortcodes['tiles'] ) ) {
		$documentation['tiles'] = array(
				'title' => 'Tiles',
				'shortcode' => '[tiles]',
				'description' => 'Enables you to show a gallery of tiled images',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['tiles']['margin'] ),
					$this->get_element_documentation( 'post_type', $this->shortcodes['tiles']['post_type'] ),
					$this->get_element_documentation( 'post_status', $this->shortcodes['tiles']['post_status'] ),
					$this->get_element_documentation( 'author', $this->shortcodes['tiles']['author'] ),
					$this->get_element_documentation( 'cat', $this->shortcodes['tiles']['cat'] ),
					$this->get_element_documentation( 'tag', $this->shortcodes['tiles']['tag'] ),
					$this->get_element_documentation( 'posts_per_page', $this->shortcodes['tiles']['posts_per_page'] ),
					$this->get_element_documentation( 'offset', $this->shortcodes['tiles']['offset'] ),
					$this->get_element_documentation( 'order', $this->shortcodes['tiles']['order'] ),
					$this->get_element_documentation( 'orderby', $this->shortcodes['tiles']['orderby'] ),
					'columns' => array(
						'name'         => 'columns',
						'description'  => 'Enables you to specify the number of columns to arrange the tiles in',
						'default'      => $this->shortcodes['tiles']['columns'] ,
						'values'       => array(
							'number' => array (
								'name' => 'number',
								'description' => 'The amount of columns to use. usually 3 or 4 works best here.'

							),
						 )
					 ),
					'background' => array(
						'name'         => 'background',
						'description'  => 'Enables you to specify the background color of the tiles',
						'default'      => $this->shortcodes['tiles']['background'] ,
						'values'       => array(
							'preset_color' => array (
								'name' => 'A preset color',
								'description' => '
									Choose from any of our preset colors, just type its name
									' . $this->framework->get_colorbox_list()
							),
							'hex color' => array (
								'name' => 'Hex color',
								'description' => 'Use any hex color value. Add a pound symbol in front of the color name; eg: #353535',
							),
							'rgb color' => array (
								'name' => 'RGB color',
								'description' => 'Use any RGB color. Use the following format: rgb(120,120,120)',
							),
						 )
					 ),

					$this->get_element_documentation( 'slideshow_speed', $this->shortcodes['tiles']['slideshow_speed'] ),
					$this->get_element_documentation( 'animation_speed', $this->shortcodes['tiles']['animation_speed'] ),

					'animation_order' => array(
						'name'         => 'animation_order',
						'description'  => 'The order in which the tiles show up',
						'default'      => $this->shortcodes['tiles']['animation_order'],
						'values'       => array(
							'random' => array (
								'name' => 'random',
								'description' => 'The tiles are shown randomly',
							),
							'asc' => array (
								'name' => 'asc',
								'description' => 'Titles are shown in ascending order, starting with the first one',
							),
							'desc' => array (
								'name' => 'desc',
								'description' => 'Titles are shown in descending, starting with the last one',
							),
						 )
					 ),
					'only_thumbnailed' => array(
						'name'         => 'only_thumbnailed',
						'description'  => 'Only show posts if they have a featured image',
						'default'      => $this->shortcodes['postslider']['only_thumbnailed'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'Only show posts with featured images',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'Show all posts',
							),
						 )
					 ),
					'show_title' => array(
						'name'         => 'show_title',
						'description'  => 'Show the tile title',
						'default'      => $this->shortcodes['tiles']['show_title'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The title will be shown',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The title will not be shown',
							),
						 )
					 ),

					'show_excerpt' => array(
						'name'         => 'show_excerpt',
						'description'  => 'Show the excerpt',
						'default'      => $this->shortcodes['tiles']['show_excerpt'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The excerpt will be shown',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The excerpt will not be shown',
							),
						 )
					 ),
					'show_link' => array(
						'name'         => 'show_link',
						'description'  => 'Show the arrow link',
						'default'      => $this->shortcodes['tiles']['show_link'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The link will be shown',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The link will not be shown',
							),
						 )
					 ),
					$this->get_element_documentation( 'style',  $this->shortcodes['tiles']['style'] ),
					'tile_style' => array(
						'name'         => 'tile_style',
						'description'  => 'Styles applied to the individual tiles',
						'default'      => $this->shortcodes['tiles']['tile_style'],
						'values'       => array(
							'css' => array (
								'name' => 'css',
								'description' => 'Any valid CSS code',
							),
						 )
					 ),


				 )
			 );
		}

		if( isset( $this->shortcodes['button'] ) ) {
		$documentation['button'] = array(
				'title' => 'Button',
				'shortcode' => '[button]',
				'description' => 'Creates a nicely formatted button',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['button']['margin'] ),
					$this->get_element_documentation( 'color', $this->shortcodes['button']['color'] ),
					$this->get_element_documentation( 'background', $this->shortcodes['button']['background'] ),
					'arrow' => array(
						'name'         => 'arrow',
						'description'  => 'Show an arrow in the button',
						'default'      => $this->shortcodes['button']['arrow'],
						'values'       => array(
							'yes' => array (
								'name' => 'yes',
								'description' => 'The arrow will be shown',
							),
							'no' => array (
								'name' => 'no',
								'description' => 'The arrow will not be shown',
							),
						 )
					 ),

					$this->get_element_documentation( 'radius', $this->shortcodes['button']['radius'] ),
					$this->get_element_documentation( 'text', 'To The Top' ),
					$this->get_element_documentation( 'url', '#' ),
					$this->get_element_documentation( 'gradient',  $this->shortcodes['button']['gradient'] ),
					$this->get_element_documentation( 'shadow',  $this->shortcodes['button']['shadow'] ),
					$this->get_element_documentation( 'border_style',  $this->shortcodes['button']['border_style'] ),
					$this->get_element_documentation( 'border_width',  $this->shortcodes['button']['border_width'] ),
					$this->get_element_documentation( 'border_color',  $this->shortcodes['button']['border_color'] ),
					$this->get_element_documentation( 'outline_style',  $this->shortcodes['button']['outline_style'] ),
					$this->get_element_documentation( 'outline_width',  $this->shortcodes['button']['outline_width'] ),
					$this->get_element_documentation( 'outline_color',  $this->shortcodes['button']['outline_color'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['button']['style'] ),
				 )
			 );
		}
		if( isset( $this->shortcodes['message'] ) ) {
		$documentation['message'] = array(
				'title' => 'Message',
				'shortcode' => '[message]',
				'description' => 'Creates a nicely formatted message',
				'parameters'  => array(
					$this->get_element_documentation( 'margin', $this->shortcodes['message']['margin'] ),
					$this->get_element_documentation( 'color', $this->shortcodes['message']['color'] ),
					$this->get_element_documentation( 'background', $this->shortcodes['message']['background'] ),
					$this->get_element_documentation( 'radius', $this->shortcodes['message']['radius'] ),
					$this->get_element_documentation( 'gradient',  $this->shortcodes['message']['gradient'] ),
					$this->get_element_documentation( 'shadow',  $this->shortcodes['message']['shadow'] ),
					$this->get_element_documentation( 'border_style',  $this->shortcodes['message']['border_style'] ),
					$this->get_element_documentation( 'border_width',  $this->shortcodes['message']['border_width'] ),
					$this->get_element_documentation( 'border_color',  $this->shortcodes['message']['border_color'] ),
					$this->get_element_documentation( 'outline_style',  $this->shortcodes['message']['outline_style'] ),
					$this->get_element_documentation( 'outline_width',  $this->shortcodes['message']['outline_width'] ),
					$this->get_element_documentation( 'outline_color',  $this->shortcodes['message']['outline_color'] ),
					$this->get_element_documentation( 'style',  $this->shortcodes['message']['style'] ),
				 )
			 );
			}

		 /*
		 if( method_exists( EB_THEME_PREFIX . 'Shortcodes', 'get_documentation' ) ) {
			 $theme_documentation = call_user_func( array( EB_THEME_PREFIX . 'Shortcodes', 'get_documentation' ) );

			 $documentation = array_merge( $documentation, $theme_documentation );
		 }
		 */

		 return $documentation;
	 }

	/** Get Element Documentation
	  *
	  * To make the documentation more modular, some common elements are
	  * documented separately here.
	  *
	  * @param string $parameter The element we need documentation for
	  * @param string $default The default value we want for the element
	  * @param mixed $option An additional option we can use for retrieving documentation
	  *
	  * @return array $documentation
	  *
	  */
	function get_element_documentation( $parameter, $default = '', $option = '' ) {

		$documentation = array(

			'margin' => array(
				'name'         => 'margin',
				'description'  => 'Enables you to add margins to the element',
				'default'      => $default,
				'values'       => array(
					'small' => array (
						'name' => 'small',
						'description' => 'Add a margin of 22px below the line',
					),
					'normal' => array (
						'name' => 'normal',
						'description' => 'Add a margin of 44px below the line',
					),
					'large' => array (
						'name' => 'large',
						'description' => 'Add a margin of 66px below the line',
					),
					'[css_value]'     => array(
						'name' => 'css value',
						'description' => 'If you would like to add a margin to the element use the following notation: <code>11px 20px 8px 9px</code>. The element will have a 11px top margin, a 20px right margin, an 8px bottom margin and a 9px left margin.'
					 ),
				 )
			 ),
			'post_type' => array(
				'name'         => 'post_type',
				'description'  => 'The post type you would like to list',
				'default'      => $default,
				'values'       => array(
					'post' => array (
						'name' => 'post',
						'description' => 'The post type of all your regular posts',
					),
					'page' => array (
						'name' => 'page',
						'description' => 'The post type of your WordPress pages',
					),
					'[custom]' => array (
						'name' => '[custom]',
						'description' => 'You may also list posts from any other custom post type, just add the name here.',
					),
				)
			 ),
			'post_status' => array(
				'name'         => 'post_status',
				'description'  => 'The status of the posts you want to display',
				'default'      => $default,
				'values'       => array(
					'publish' => array (
						'name' => 'publish',
						'description' => 'Published posts',
					),
					'draft' => array (
						'name' => 'draft',
						'description' => 'Draft posts',
					),
					'future' => array (
						'name' => 'future',
						'description' => 'Scheduled posts',
					),
					'any' => array(
						'name' => 'any',
						'description' => 'Retrieves all posts types which aren\'t excluded from searches by default'
					)
				)
			 ),
			'author' => array(
				'name'         => 'author',
				'description'  => 'Get posts from specific authors',
				'default'      => $default,
				'values'       => array(
					'[ID]' => array (
						'name' => '[ID]',
						'description' => 'The ID of the author you want to retrieve posts from',
					),
					'[ID,ID,ID]' => array (
						'name' => '[ID,ID,ID]',
						'description' => 'A comma separated list of author IDs you want to retrieve posts from',
					),
				)
			 ),
			'cat' => array(
				'name'         => 'cat',
				'description'  => 'Get posts from specific categories',
				'default'      => $default,
				'values'       => array(
					'[ID]' => array (
						'name' => '[ID]',
						'description' => 'The ID of the category you want to retrieve posts from',
					),
					'[-ID]' => array(
						'name' => '[-ID]',
						'description' => 'If you prefix a category ID with a dash you will exclude that category'
					),
					'[ID,ID,ID]' => array (
						'name' => '[ID,ID,ID]',
						'description' => 'A comma separated list of category IDs you want to retrieve posts from.',
					),
					'[-ID,-ID,-ID]' => array (
						'name' => '[-ID,-ID,-ID]',
						'description' => 'A comma separated list of category IDs you want to exclude from the query. Be sure to add a dash before each ID.',
					),
				)
			 ),
			'tag' => array(
				'name'         => 'tag',
				'description'  => 'Get posts from specific tags',
				'default'      => $default,
				'values'       => array(
					'[name]' => array (
						'name' => '[name]',
						'description' => 'The name of the tag you want to retrieve posts from',
					),
					'[name,name,name]' => array(
						'name' => '[name,name,name]',
						'description' => 'Retrieve posts belonging to any of the tags listed'
					),
					'[name+name+name]' => array (
						'name' => '[name]',
						'description' => 'Retrieve posts belonging to all of the listed tags',
					),
				)
			 ),
			'posts_per_page' => array(
				'name'         => 'posts_per_page',
				'description'  => 'The number of posts you would like to show',
				'default'      => $default,
				'values'       => array(
					'[positive whole numbers]' => array (
						'name' => '[positive whole numbers]',
						'description' => 'Any positive whole number can be used to retrieve a specific amount of posts',
					),
					'-1' => array (
						'name' => '-1',
						'description' => 'If you specify -1, all posts will be pulled from the database',
					),
				)
			 ),
			'offset' => array(
				'name'         => 'offset',
				'description'  => 'add an offset to the retrieved posts',
				'default'      => $default,
				'values'       => array(
					'[positive whole numbers]' => array (
						'name' => '[positive whole numbers]',
						'description' => 'This offset will be applied to the final results. Ie: If you want to pull your ten latest posts with an offset of 1 the first post will not be shown, the 10 posts following it will be listed.',
					),
				)
			 ),
			'order' => array(
				'name'         => 'order',
				'description'  => 'The direction of ordering for the results',
				'default'      => $default,
				'values'       => array(
					'DESC' => array (
						'name' => 'DESC',
						'description' => 'Order the results in a descending fashion',
					),
					'ASC' => array (
						'name' => 'ASC',
						'description' => 'Order the results in a ascending fashion',
					),
				)
			 ),
			'orderby' => array(
				'name'         => 'orderby',
				'description'  => 'Select the criteria to order the results by',
				'default'      => $default,
				'values'       => array(
					'date' => array (
						'name' => 'date',
						'description' => 'Order the posts by date',
					),
					'title' => array (
						'name' => 'title',
						'description' => 'Order the posts by their titles',
					),
					'modified' => array (
						'name' => 'modified',
						'description' => 'Order the posts by their last modified date',
					),
					'rand' => array (
						'name' => 'rand',
						'description' => 'Apply a random order to the posts',
					),
				)
			 ),
			'query_vars' => array(
				'name'         => 'query_vars',
				'description'  => 'This option is for advanced users/developers only. Since our parameters map directly to a WP_Query object you can use any parameter found in the WP_Query documentation.',
				'default'      => $default,
				'values'       => array(
					'serialized array' => array (
						'name' => 'serialized array',
						'description' => 'A serialized array created from the arguments you want to pass to the WP_Query object.',
					),
				)
			 ),

			'layout' => array(
				'name'         => 'layout',
				'description'  => 'The layout you would like to use to display the items',
				'default'      => $default,
				'values'       => $this->framework->get_layouts_for_documentation( $option ),
			 ),

			'text_align' => array(
				'name'         => 'text_align',
				'description'  => 'Change the alignment of the text in this element',
				'default'      => $default,
				'values'       => array(
					'left' => array (
						'name' => 'left',
						'description' => 'Aligns the text to the left',
					),
					'center' => array (
						'name' => 'center',
						'description' => 'Center aligns the text',
					),
					'right' => array (
						'name' => 'right',
						'description' => 'Aligns the text to the right',
					),
				 )
			 ),


			'animation' => array(
				'name'         => 'animation',
				'description'  => 'Change the type of animation used in this element',
				'default'      => $default,
				'values'       => array(
					'fade' => array (
						'name' => 'fade',
						'description' => 'Items fade into each other',
					),
					'slide' => array (
						'name' => 'slide',
						'description' => 'Items use a slide transition',
					),
				 )
			 ),

			'direction' => array(
				'name'         => 'direction',
				'description'  => 'Change the direction of the animation used in this element (only applicable for slide animations)',
				'default'      => $default,
				'values'       => array(
					'horizontal' => array (
						'name' => 'horizontal',
						'description' => 'Items will slide to the side',
					),
					'vertical' => array (
						'name' => 'vertical',
						'description' => 'Items will scroll vertically',
					),
				 )
			 ),

			'slideshow_speed' => array(
				'name'         => 'slideshow_speed',
				'description'  => 'The amount of time each item is shown for',
				'default'      => $default,
				'values'       => array(
					'[miliseconds]' => array (
						'name' => 'miliseconds',
						'description' => 'The amount of time you\'d like each item to be shown, in miliseconds',
					),
				 )
			 ),

			'animation_speed' => array(
				'name'         => 'animation_speed',
				'description'  => 'The amount of time it takes for the animation to complete',
				'default'      => $default,
				'values'       => array(
					'[miliseconds]' => array (
						'name' => 'miliseconds',
						'description' => 'The amount of time you\'d like the animations to take, in miliseconds',
					),
				 )
			 ),

			'pause_on_hover' => array(
				'name'         => 'pause_on_hover',
				'description'  => 'Define weather you want the slideshow to pause when the user hovers over them',
				'default'      => $default,
				'values'       => array(
					'yes' => array (
						'name' => 'yes',
						'description' => 'The slideshow will stop while users are hovered over it',
					),
					'no' => array (
						'name' => 'no',
						'description' => 'The slideshow will not stop while users are hovered over it',
					),
				 )
			 ),

			'smooth_height' => array(
				'name'         => 'smooth_height',
				'description'  => 'If set to yes, the slider will animate vertically to the height of the image. We recommend NOT turning this on and using uniformly sized images instead. If the slider animates up and down, the content moves below it as well, making reading the content very hard.',
				'default'      => $default,
				'values'       => array(
					'yes' => array (
						'name' => 'yes',
						'description' => 'The slideshow will change its height to the height of the current image',
					),
					'no' => array (
						'name' => 'no',
						'description' => 'The slideshow\'s height will remain static',
					),
				 )
			 ),


			'controls' => array(
				'name'         => 'controls',
				'description'  => 'Change weather the controls are shown or not',
				'default'      => $default,
				'values'       => array(
					'yes' => array (
						'name' => 'yes',
						'description' => 'Navigation controls will be shown for this slider',
					),
					'no' => array (
						'name' => 'no',
						'description' => 'Navigation will be hidden for this slider',
					),
				 )
			 ),

			'color' => array(
				'name'         => 'color',
				'description'  => 'Enables you to specify the text color of this element',
				'default'      => $default,
				'values'       => array(
					'preset_color' => array (
						'name' => 'A preset color',
						'description' => '
							Choose from any of our preset colors, just type its name
							' . $this->framework->get_colorbox_list()
					),
					'hex color' => array (
						'name' => 'Hex color',
						'description' => 'Use any hex color value. Add a pound symbol in front of the color name; eg: #353535',
					),
					'auto' => array(
						'name' => 'auto',
						'description' => 'If set to auto the color will be set automatically, according to the item\'s background color. If the background is light, the color will be dark and vica-versa.',
					),
					'rgb color' => array (
						'name' => 'RGB color',
						'description' => 'Use any RGB color. Use the following format: rgb(120,120,120)',
					),
				 )
			 ),
			'background' => array(
				'name'         => 'background',
				'description'  => 'Enables you to specify the background color of this element',
				'default'      => $default,
				'values'       => array(
					'[preset_color]' => array (
						'name' => 'A preset color',
						'description' => '
							Choose from any of our preset colors, just type its name
							' . $this->framework->get_colorbox_list()
					),
					'[hex color]' => array (
						'name' => 'Hex color',
						'description' => 'Use any hex color value. Add a pound symbol in front of the color name; eg: #353535',
					),
					'[rgb color]' => array (
						'name' => 'RGB color',
						'description' => 'Use any RGB color. Use the following format: rgb(120,120,120)',
					),
				 )
			 ),
			'style' => array(
				'name'         => 'style',
				'description'  => 'Add custom styles to this element',
				'default'      => $default,
				'values'       => array(
					'css rules' => array (
						'name' => 'css rules',
						'description' => 'Add any css rules as if you were adding them inline. To add a border and a margin for example you could write: "margin-bottom:10px; border:1px solid white" ',
					),
				 )
			 ),
			'height' => array(
				'name'         => 'height',
				'description'  => 'Specify the height (thickness) of the line',
				'default'      => $default,
				'values'       => array(
					'[css_value]'     => array(
						'name' => 'css value',
						'description' => 'The value of this property can be any valid CSS value. We recommend using pixels (eg: 2px ), but you may also use any other css specification.'
					 ),
				 )
			 ),
			'linktext' => array(
				'name'         => 'linktext',
				'description'  => 'Specify the text of the link (anchortext)',
				'default'      => $default,
				'values'       => array(
					'[text]' => array (
						'name' => 'text',
						'description' => 'Any text can be used here',
					),
				)

			 ),
			'url' => array(
				'name'         => 'url',
				'description'  => 'Specify the URL of the link',
				'default'      => $default,
				'values'       => array(
					'[url]' => array (
						'name' => 'url',
						'description' => 'Any well formed URL can be used. Don\'t forget to start with "http://"',
					),
				)
			 ),
			'radius' => array(
				'name'         => 'radius',
				'description'  => 'Set the border radius of the element',
				'default'      => $default,
				'values'       => array(
					'[css_value]' => array (
						'name' => 'css value',
						'description' => 'Any valid CSS value can be used for the border radius, eg: 3px',
					),
				 )
			 ),
			'text' => array(
				'name'         => 'text',
				'description'  => 'Specify the text shown on this element',
				'default'      => $default,
				'values'       => array(
					'[text]' => array (
						'name' => 'text',
						'description' => 'Any text can be used here',
					),
				)
			 ),

			'gradient' => array(
				'name'         => 'gradient',
				'description'  => 'Apply a gradient based on the background color',
				'default'      => $default,
				'values'       => array(
					'yes' => array (
						'name' => 'yes',
						'description' => 'A gradient will be applied',
					),
					'no' => array (
						'name' => 'no',
						'description' => 'The background will be a solid color',
					),
				 )
			 ),

			'shadow' => array(
				'name'         => 'shadow',
				'description'  => 'Apply a drop shadow to the element',
				'default'      => $default,
				'values'       => array(
					'yes' => array (
						'name' => 'yes',
						'description' => 'A drop shadow will be applied',
					),
					'no' => array (
						'name' => 'no',
						'description' => 'There will be no drop shadow',
					),
				 )
			 ),
			'border_color' => array(
				'name'         => 'border_color',
				'description'  => 'Enables you to specify the color of the border',
				'default'      => $default,
				'values'       => array(
					'preset_color' => array (
						'name' => 'A preset color',
						'description' => '
							Choose from any of our preset colors, just type its name
							' //. $this->framework->get_colorbox_list()
					),
					'hex color' => array (
						'name' => 'Hex color',
						'description' => 'Use any hex color value. Add a pound symbol in front of the color name; eg: #353535',
					),
					'auto' => array(
						'name' => 'auto',
						'description' => 'If set to auto the color will be set automatically, according to the item\'s background color. If the background is light, the color will be dark and vica-versa.',
					),
					'rgb color' => array (
						'name' => 'RGB color',
						'description' => 'Use any RGB color. Use the following format: rgb(120,120,120)',
					),
				 )
			 ),
			'outline_color' => array(
				'name'         => 'outline_color',
				'description'  => 'Enables you to specify the color of the outline',
				'default'      => $default,
				'values'       => array(
					'preset_color' => array (
						'name' => 'A preset color',
						'description' => '
							Choose from any of our preset colors, just type its name
							' //. $this->framework->get_colorbox_list()
					),
					'hex color' => array (
						'name' => 'Hex color',
						'description' => 'Use any hex color value. Add a pound symbol in front of the color name; eg: #353535',
					),
					'auto' => array(
						'name' => 'auto',
						'description' => 'If set to auto the color will be set automatically, according to the item\'s background color. If the background is light, the color will be dark and vica-versa.',
					),
					'rgb color' => array (
						'name' => 'RGB color',
						'description' => 'Use any RGB color. Use the following format: rgb(120,120,120)',
					),
				 )
			 ),
			'border_width' => array(
				'name'         => 'border_width',
				'description'  => 'Specify the width of the border',
				'default'      => $default,
				'values'       => array(
					'[css_value]'     => array(
						'name' => 'css value',
						'description' => 'The value of this property can be any valid CSS value. We recommend using pixels (eg: 2px ), but you may also use any other css specification.'
					 ),
				 )
			 ),
			'outline_width' => array(
				'name'         => 'outline_width',
				'description'  => 'Specify the width of the outline',
				'default'      => $default,
				'values'       => array(
					'[css_value]'     => array(
						'name' => 'css value',
						'description' => 'The value of this property can be any valid CSS value. We recommend using pixels (eg: 2px ), but you may also use any other css specification.'
					 ),
				 )
			 ),
			'line_style' => array(
				'name'         => 'line_style',
				'description'  => 'Choose the style for the line',
				'default'      => $default,
				'values'       => array(
					'dotted' => array (
						'name' => 'dotted',
						'description' => 'Created a dotted border',
					),
					'dashed' => array (
						'name' => 'dashed',
						'description' => 'Created a dashed border',
					),
					'solid' => array (
						'name' => 'solid',
						'description' => 'Created a solid border',
					),
				 )
			 ),

			'border_style' => array(
				'name'         => 'border_style',
				'description'  => 'Choose the style for this border',
				'default'      => $default,
				'values'       => array(
					'dotted' => array (
						'name' => 'dotted',
						'description' => 'Created a dotted border',
					),
					'dashed' => array (
						'name' => 'dashed',
						'description' => 'Created a dashed border',
					),
					'solid' => array (
						'name' => 'solid',
						'description' => 'Created a solid border',
					),
				 )
			 ),
			'outline_style' => array(
				'name'         => 'outline_style',
				'description'  => 'Choose the style for this outline',
				'default'      => $default,
				'values'       => array(
					'dotted' => array (
						'name' => 'dotted',
						'description' => 'Created a dotted border',
					),
					'dashed' => array (
						'name' => 'dashed',
						'description' => 'Created a dashed border',
					),
					'solid' => array (
						'name' => 'solid',
						'description' => 'Created a solid border',
					),
				 )
			 ),
		);
		if( !empty( $documentation[$parameter] ) ) {
			return $documentation[$parameter];
		}
	}



   /** Shortcode Documentation
	 *
	 * Outputs the documentation of the shortcode in question. The data used
	 * is set up in the default.php file and the documentation functions here.
	 * Take a look at the default.php file or the default.sample.php file in
	 * the samples directory.
	 *
	 * @uses get_documentation()
	 *
	 * @param string $type The type of display (short or long)
	 *
	 */
	function shortcode_documentation( $type ) {
		$data = $this->get_documentation();
		$data = $data[$type];
		ob_start(); ?>
	   		<div class='shortcode-documentation'>
	   			<h1 class='shortcode-title'>
	   				<?php echo $data['title'] ?> <code><?php echo $data['shortcode'] ?></code>
	   			</h1>
	 			<p class='shortcode-description'>
	 				<?php echo $data['description'] ?>
	 			</p>
				<div class='shortcode-parameters'>
	 				<h2 class='parameter-type'>Parameters</h2>
		   			<ul class='parameter-list'>
		   				<?php foreach( $data['parameters'] as $parameter ) : ?>
		   				<li class='parameter'>
		   					<h3 class='parameter_title'>
		   						<?php echo $parameter['name'] ?>
		   					</h3>
		   					<div class='parameter-documentation'>
			   					<p class='parameter-description'>
			   						<?php echo $parameter['description'] ?>
			   						<?php if ( !empty( $parameter['default'] ) ) : ?>
			   						<br>
			   						<span class='parameter-default'>Default: <code><?php echo $parameter['default'] ?> </code></span>
			   						<?php endif ?>
			   					</p>
			   					<?php if ( isset( $parameter['values'] ) AND !empty( $parameter['values'] ) ) : ?>
				   					<h4 class='values-title'>Possible Values</h4>
				   					<ul class='values-list'>
				   						<?php foreach( $parameter['values'] as $value ) : ?>
				   						<li>
				   							<h5 class='value-title'><?php echo $value['name'] ?></h5>
					   							<?php if( isset( $value['default'] ) AND $value['default'] === true ) : ?>
					   								<small>( default )</small>
					   							<?php endif ?>

					   							<?php if( isset( $value['description'] ) AND !empty( $value['description'] ) ) : ?>
						   							<div class='value-description'><?php echo $value['description'] ?></div>
					   							<?php endif ?>
				   						</li>
				   						<?php endforeach ?>
				   					</ul>
								<?php endif ?>
							</div> <!-- Parameter documentation -->
		   				</li>
		   				<?php endforeach; ?>
		   			</ul>
			   	</div> <!-- Shortcode parameters -->
	   		</div> <!-- Shortcode-documentation -->
	   	<?php

	   	$info = ob_get_clean();
	   	return $info;
	}




	/***********************************************/
	/*              TinyMCE additions              */
	/***********************************************/

   /** Add TinyMCE Plugins
	 *
	 * Adds our plugins for the TinyMCE WordPress editor. Note
	 * that dashes shoudn't be used in the keys as it will not
	 * work on the Javascript side for some reason.
	 *
	 * @param array $plugins The array of TinyMCE plugins
	 *
	 * @return array $plugins
	 *
	 */
	function tinymce_add_plugins( $plugins ){
		$plugins['ebShortcode'] = EB_URL . '/js/eb-shortcode-helper.min.js';
		$plugins['ebColumns'] = EB_URL . '/js/eb-columns-helper.min.js';
		return $plugins;
	}

   /** Add TinyMCE Buttons
	 *
	 * Adds our buttons for the TinyMCE WordPress editor. Note
	 * that dashes shoudn't be used in the keys as it will not
	 * work on the Javascript side for some reason.
	 *
	 * @param array $buttons The array of TinyMCE buttons
	 *
	 * @return array $buttons
	 *
	 */
	function tinymce_add_buttons( $buttons ){
		$buttons[] = 'ebShortcode';
		$buttons[] = 'ebColumns';
		return $buttons;
	}


   /** Shortcode Helper
	 *
	 * The HTML used in the Shortcode Helper section of the
	 * tinyMCE editor.
	 *
	 * @uses get_documentation()
	 *
	 */
	function shortcode_helper_popup() {

	?>

		<div style="display:none; overflow: auto;" id="eb-shortcode-helper" >
		<form class='eb-shortcode-helper'>
			<?php wp_nonce_field( 'create_shortcode', '_ajax_eb_shortcode_nonce', false ); ?>
			<div id="shortcode-create">
				<p class="howto">Select a shortcode below to use it. Once selected you will be able to fill out the parameters for the shortcode before inserting it into the post</p>
				<div>
					<input id="shortcode-field" type="text" tabindex="10" name="shortcode" />
				</div>

				<?php foreach( $this->shortcodes as $shortcode => $data ) : ?>
					<div class='eb-shortcode-parameters eb-shortcode-parameters-<?php echo $shortcode ?>'>
						<h3>Additional Settings</h3>
						<?php
							$parameters = $this->get_documentation();
							$parameters = $parameters[$shortcode]['parameters'];
							foreach( $parameters as $parameter ) :
						?>
						<div class='shortcode-parameter'>
							<label><?php echo $parameter['name'] ?></label>
							<div class='control'>
								<input type='text' name='<?php echo $parameter['name'] ?>' value='<?php echo $parameter['default'] ?>' data-value='<?php echo $parameter['default'] ?>'>
								<small><?php echo $parameter['description'] ?>.
									<span class="view-examples">
										view examples
										<div class='example'>
											<ul>
											<?php if( !empty( $parameter['values'] ) ) : foreach( $parameter['values'] as $value ) : ?>
												<li>
													<strong><?php echo $value['name'] ?></strong><br>
													<?php echo $value['description'] ?>
												</li>
											<?php endforeach; endif; ?>
											</ul>
										</div>
									</span>
								</small>
							</div>
						</div>
						<?php endforeach ?>
					</div>
				<?php endforeach ?>

			</div>
			<div class="submitbox">
				<div id="eb-shortcode-helper-update">
					<input type="submit" tabindex="100" value="<?php esc_attr_e( 'Add Shortcode' ); ?>" class="button-primary" id="eb-shortcode-helper-submit" name="wys-menu-submit">
				</div>
			</div>
			<hr />
			<p class="howto">Choose from existing shortcodes</p>
			<ul class="shortcode-list">
				<?php
					$i=1;
					$documentation = $this->get_documentation();

					foreach( $this->shortcodes as $shortcode => $data ) {
						$class = ( $i % 2 )? 'class="alternate"': '';
						echo '<li data-shortcode="'.$shortcode.'" class="' . $class . '"><span class="shortcode-name">' . $shortcode . '</span> <span class="shortcode-description">' . $documentation[$shortcode]['description'] . '</span>';

						if( !empty($documentation[$shortcode]['example'] ) ) {
						echo '<span class="shortcode-example">'.$documentation[$shortcode]['example'].'</span>';
						}

						echo '</li>';
						$i++;
					}
				?>
			</ul>
		</form>
		</div>
	<?php }

   /** Column Helper
	 *
	 * The HTML used in the Column Helper section of the
	 * tinyMCE editor.
	 *
	 */
	function column_helper_popup() {

	?>

		<div style="display:none; overflow: auto;" id="eb-columns-helper" >
		<form class='eb-columns-helper'>
			<?php wp_nonce_field( 'create_shortcode', '_ajax_eb_shortcode_nonce', false ); ?>

			<h3>Available Column Sizes</h3>
			<p>
				Drag and drop the columns below into the layout creator to build your columned layout
			</p>
			<div class='columns'>
				<div class='row' data-col='onecol'>
					<div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol' data-col='onecol'>1</div><div class='onecol last' data-col='onecol'>1</div>
				</div>
				<div class='row' data-col='twocol'>
					<div class='twocol' data-col='twocol'>2</div><div class='twocol' data-col='twocol'>2</div><div class='twocol' data-col='twocol'>2</div><div class='twocol' data-col='twocol'>2</div><div class='twocol' data-col='twocol'>2</div><div class='twocol last' data-col='twocol'>2</div>
				</div>
				<div class='row' data-col='threecol'>
					<div class='threecol' data-col='threecol'>3</div><div class='threecol' data-col='threecol'>3</div><div class='threecol' data-col='threecol'>3</div><div class='threecol last' data-col='threecol'>3</div>
				</div>
				<div class='row' data-col='fourcol'>
					<div class='fourcol' data-col='fourcol'>4</div><div class='fourcol' data-col='fourcol'>4</div><div class='fourcol last' data-col='fourcol'>4</div>
				</div>
				<div class='row' data-col='sixcol'>
					<div class='sixcol' data-col='sixcol'>6</div><div class='sixcol last' data-col='sixcol'>6</div>
				</div>
				<div class='row' data-col='eightcol'>
					<div class='eightcol' data-col='eightcol'>8</div>
				</div>
				<div class='row' data-col='ninecol'>
					<div class='ninecol' data-col='ninecol'>9</div>
				</div>


				<div class='row' data-col='twelvecol'>
					<div class='twelvecol' data-col='twelvecol'>12</div>
				</div>

			</div>


			<h3>Layout Creator</h3>

			<div class='layout-creator empty'>
				<div class='row'>
					<div class='default-message'>Drag columns from above in here</div>
				</div>
			</div>

			<div class="submitbox">
				<div id="eb-columns-helper-update">
					<input type="submit" tabindex="100" value="<?php esc_attr_e( 'Create my layout' ); ?>" class="button-primary" id="eb-columns-helper-submit" name="wys-menu-submit">
				</div>
			</div>


		</form>
		</div>
	<?php }

   /** TinyMCE Styles
	 *
	 * Adds the necessary styles to make style the new tinyMCE
	 * plugins
	 *
	 */
	function tinymce_styles() {
		if( is_admin() ) {
		wp_register_style( 'eb-shortcode-button-style', EB_ADMIN_THEME_URL . '/css/eb-shortcode-button-style.css');
		wp_enqueue_style( 'eb-shortcode-button-style' );
		}
	}




}

?>

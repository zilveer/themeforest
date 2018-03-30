<?php
/**
 *
 */
class mysiteHidden {
	
	/**
	 *
	 */
	function one_half( $atts = null, $content = null ) {
		return '<div class="one_half">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function one_half_last( $atts = null, $content = null ) {
		return '<div class="one_half last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function one_third( $atts = null, $content = null ) {
		return '<div class="one_third">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function one_third_last( $atts = null, $content = null ) {
		return '<div class="one_third last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function two_third( $atts = null, $content = null ) {
		return '<div class="two_third">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function two_third_last( $atts = null, $content = null ) {
		return '<div class="two_third last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function one_fourth( $atts = null, $content = null ) {
		return '<div class="one_fourth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function one_fourth_last( $atts = null, $content = null ) {
		return '<div class="one_fourth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function three_fourth( $atts = null, $content = null ) {
		return '<div class="three_fourth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function three_fourth_last( $atts = null, $content = null ) {
		return '<div class="three_fourth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function one_fifth( $atts = null, $content = null ) {
		return '<div class="one_fifth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function one_fifth_last( $atts = null, $content = null ) {
		return '<div class="one_fifth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function two_fifth( $atts = null, $content = null ) {
		return '<div class="two_fifth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function two_fifth_last( $atts = null, $content = null ) {
		return '<div class="two_fifth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function three_fifth( $atts = null, $content = null ) {
		return '<div class="three_fifth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function three_fifth_last( $atts = null, $content = null ) {
		return '<div class="three_fifth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function four_fifth( $atts = null, $content = null ) {
		return '<div class="four_fifth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function four_fifth_last( $atts = null, $content = null ) {
		return '<div class="four_fifth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function one_sixth( $atts = null, $content = null ) {
		return '<div class="one_sixth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function one_sixth_last( $atts = null, $content = null ) {
		return '<div class="one_sixth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function five_sixth( $atts = null, $content = null ) {		
		return '<div class="five_sixth">' . mysite_remove_wpautop( $content ) . '</div>';
	}
	
	/**
	 *
	 */
	function five_sixth_last( $atts = null, $content = null ) {
		return '<div class="five_sixth last">' . mysite_remove_wpautop( $content ) . '</div><div class="clearboth"></div>';
	}
	
	/**
	 *
	 */
	function divider_padding( $atts = null, $content = null ) {
		return '<div class="divider_padding"></div>';
	}
	
	/**
	 *
	 */
	function fancy_header( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));

		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' class="' . trim( $variation ) . '"' : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;

	   	return '<h6 class="fancy_header"><span' . $variation . $style . '>' . mysite_remove_wpautop( $content ) . '</span></h6>';
	}
	
	/**
	 *
	 */
	function dropcap( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> ''
	    ), $atts));
		
		$variation = ( $variation ) ? ' ' . $variation . '_sprite' : '';
			
		return '<span class="dropcap' . $variation . '">' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function pullquote( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'quotes'	=> '',
			'align'		=> '',
			'variation'	=> '',
			'textcolor'	=> '',
			'cite'		=> '',
			'citelink'	=> ''
	    ), $atts));
	
		$class = array();
		
		if( trim( $quotes ) == 'true' )
			$class[] = ' quotes';
			
		if( preg_match( '/left|right|center/', trim( $align ) ) )
			$class[] = ' align' . $align;
			
		if( ( $variation ) && ( empty( $textcolor ) ) )
			$class[] = ' ' . $variation . '_text';
			
		$citelink = ( $citelink ) ? ' ,<a href="' . esc_url( $citelink ) . '" class="target_blank">' . $citelink . '</a>' : '';
		
		$cite = ( $cite ) ? ' <cite>&ndash; ' . $cite . $citelink . '</cite>' : '' ;
		
		$style = ( $textcolor ) ? ' style="color:' . $textcolor . ';"' : '';
			
		$class = join( '', array_unique( $class ) );
	
		return '<span class="pullquote' . $class . '"' . $style . '>' . mysite_remove_wpautop( $content ) . $cite . '</span>';
	}
	
	/**
	 *
	 */
	function highlight( $atts = null, $content = null ) {
		extract(shortcode_atts(array(
			'variation'	=> '',
			'bgcolor'	=> '',
			'textcolor'	=> ''
	    ), $atts));
	
		$variation = ( ( $variation ) && ( empty( $bgcolor ) ) ) ? ' ' . trim( $variation ) : '';
		
		$styles = array();
		
		if( $bgcolor )
			$styles[] = 'background-color:' . $bgcolor . ';border-color:' . $bgcolor . ';';
			
		if( $textcolor )
			$styles[] = 'color:' . $textcolor . ';';
			
		$style = join( '', array_unique( $styles ) );
		$style = ( !empty( $style ) ) ? ' style="' . $style . '"': '' ;
			
		return '<span class="highlight' . $variation . '"' . $style . '>' . mysite_remove_wpautop( $content ) . '</span>';
	}
	
	/**
	 *
	 */
	function post_author( $attr ) {
		$attr = shortcode_atts(array(
			'before' => '',
			'after' => '',
			'text' => __( '<em>Posted by:</em>', MYSITE_TEXTDOMAIN )
		), $attr);

		$author = '<span class="meta_author">' . $attr['before'] . $attr['text'] . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>' . $attr['after'] . '</span>';

		return $author;
		
	}
	
	/**
	 *
	 */
	function post_date( $attr ) {
		$attr = shortcode_atts(array(
			'before' => '',
			'after' => '',
			'text' => __( '<em>Posted on: </em>', MYSITE_TEXTDOMAIN ),
			'format' => 'm-j-Y'
		), $attr);

		$published = '<span class="meta_date">' . $attr['before'] . $attr['text'] . '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . sprintf( get_the_time( __( 'l, F jS, Y, g:i a', MYSITE_TEXTDOMAIN ) ) ) . '">' . sprintf( get_the_time( $attr['format'] ) ) . '</a>' . $attr['after'] . '</span>';
		return $published;
		
	}
	
	/**
	 *
	 */
	function post_comments( $attr ) {
		$number = get_comments_number();
		$attr = shortcode_atts(array(
			'zero' => __( '0 Comments', MYSITE_TEXTDOMAIN ),
			'one' => __( '1 Comment', MYSITE_TEXTDOMAIN ),
			'more' => __( '%1$s Comments', MYSITE_TEXTDOMAIN ),
			'css_class' => 'comments-link',
			'none' => '', 
			'text' => '',
			'before' => ' ',
			'after' => ''
		), $attr);

		if ( 0 == $number && !comments_open() && !pings_open() ) {
			if ( $attr['none'] )
				$comments_link = '<span class="' . esc_attr( $attr['css_class'] ) . '">' . $attr['none'] . '</span>';
		}
		elseif ( $number == 0 )
			$comments_link = '<a href="' . get_permalink() . '#respond" title="' . sprintf( __( 'Comment on %1$s', MYSITE_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . $attr['zero'] . '</a>';
		elseif ( $number == 1 )
			$comments_link = '<a href="' . get_comments_link() . '" title="' . sprintf( __( 'Comment on %1$s', MYSITE_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . $attr['one'] . '</a>';
		elseif ( $number > 1 )
			$comments_link = '<a href="' . get_comments_link() . '" title="' . sprintf( __( 'Comment on %1$s', MYSITE_TEXTDOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . sprintf( $attr['more'], $number ) . '</a>';

		if ( isset( $comments_link ) ) {
			return '<span class="meta_comments">' . $attr['before'] . $attr['text'] . $comments_link . $attr['after'] . '</span>';
		}
	}
	
	/**
	 *
	 */
	function post_terms( $attr ) {
		global $post;

		$attr = shortcode_atts(array(
			'id' => $post->ID,
			'taxonomy' => 'post_tag',
			'separator' => ', ',
			'before' => ' ',
			'after' => '',
			'text' => __( '<em>Posted in: </em>', MYSITE_TEXTDOMAIN )
		), $attr );

		$attr['before'] = '<span class="meta_' . $attr['taxonomy'] . '">' . $attr['before'] . $attr['text'];
		$attr['after'] = $attr['after'] . '</span>';

		return get_the_term_list( $attr['id'], $attr['taxonomy'], $attr['before'], $attr['separator'], $attr['after'] );
	}
	
	/**
	 *
	 */
	function teaser_small( $atts = null, $content = null ) {
		return '<p class="teaser_small">' . mysite_remove_wpautop( $content ) . '</p>';
	}
	
	/**
	 *
	 */
	function theme_name() {
		return THEME_NAME;
	}
	
	
	/**
	 * Legacy Shortcodes
	 */
	
	/**
	 *
	 */
	function frame_left( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="left" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function frame_right( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="right" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function frame_center( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'alt'		=> '',
			'title'		=> ''
		), $atts));
	
		$out = do_shortcode( '[image_frame style="framed" align="center" alt="' . $alt . '" title="' . $title . '"]' . $content . '[/image_frame]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function simple_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[colored_box variation="white"]' . $content . '[/colored_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function color_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'title'      => '',
	        'align'      => '',
			'variation'  => ''
		), $atts));
	
		$out = do_shortcode( '[titled_box title="' . $title . '" align="' . $align . '" variation="' . $variation . '"]' . $content . '[/titled_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function fancy_titled_box( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'title'      => ''
		), $atts));
	
		$out = do_shortcode( '[fancy_box title="' . $title . '"]' . $content . '[/fancy_box]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function arrow_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[fancy_list variation="' . $variation . '" type="arrow_list"]' . $content . '[/fancy_list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function bullet_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[fancy_list variation="' . $variation . '" type="bullet_list"]' . $content . '[/fancy_list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function check_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[fancy_list variation="' . $variation . '" type="check_list"]' . $content . '[/fancy_list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function star_list( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
			'variation'      => ''
		), $atts));
	
		$out = do_shortcode( '[fancy_list variation="' . $variation . '" type="star_list"]' . $content . '[/fancy_list]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function pullquote_left( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[pullquote align="left"]' . $content . '[/pullquote]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function pullquote_right( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
	
		$out = do_shortcode( '[pullquote align="right"]' . $content . '[/pullquote]' );
		
		return $out;
	}
	
	/**
	 *
	 */
	function minimal_tabs( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
		
		$out = '';
		
		$i=0;
		foreach( $atts as $tab ) {
			$tabs[$i] = $tab; $i++;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= ' [tab title="' . $tabs[$i] . '"]' . $matches[5][$i] . '[/tab] ';
			}
		}
		
		return do_shortcode( '[tabs] ' . $out . ' [/tabs]' );
	}
	
	/**
	 *
	 */
	function framed_tabs( $atts = null, $content = null ) {
	
		extract(shortcode_atts(array(
		), $atts));
		
		$out = '';
		
		$i=0;
		foreach( $atts as $tab ) {
			$tabs[$i] = $tab; $i++;
		}
		
		if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
			return mysite_remove_wpautop( $content );
		} else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= ' [tab title="' . $tabs[$i] . '"]' . $matches[5][$i] . '[/tab] ';
			}
		}
		
		return do_shortcode( '[tabs_framed] ' . $out . ' [/tabs_framed]' );
	}
	
	/**
	 *
	 */
	function raw( $atts = null, $content = null ) {
		return $content;
	}

}

?>
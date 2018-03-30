<?php
/*
Plugin Name: Recent Searches Widget
Plugin URI: http://www.poradnik-webmastera.com/projekty/recent_searches_widget/
Description: Shows recent searches in a sidebar widget.
Author: Daniel Frużyński
Version: 1.2
Author URI: http://www.poradnik-webmastera.com/
Text Domain: recent-searches-widget
*/

/*  Copyright 2009-2010  Daniel Frużyński  (email : daniel [A-T] poradnik-webmastera.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if ( !class_exists( 'RecentSearchesWidget' ) ) {

class RecentSearchesWidget {
	// Constructor
	function RecentSearchesWidget() {
		// Initialize plugin
		add_action( 'init', array( &$this, 'init' ) );
		
		// Page load
		add_action( 'template_redirect', array( &$this, 'template_redirect' ) );
		
		// Widgets initialization
		add_action( 'widgets_init', array( &$this, 'widgets_init' ) );
	}
	
	// Plugin initialization
	function init() {
		load_plugin_textdomain( 'recent-searches-widget', false, get_template_directory_uri() . '/widgets/recent-searches-widget/lang' );
	}
	
	// Page load
	function template_redirect() {

		if ( is_search() ) {
			// Store search term
			$query = $this->strtolower( trim( get_search_query() ) );
			
			$options = get_option( 'recent_searches_widget' );
			if ( !is_array( $options ) ) {
				$options = $this->get_default_options();
			}
			$max = $options['max'];
			
			$data = get_option( 'recent_searches_widget_data', array() );
			if ( !is_array( $data ) ) {
				if ( isset( $options['data'] ) ) {
					$data = $options['data'];
					unset( $options['data'] );
					update_option( 'recent_searches_widget', $options );
				}
				if ( !is_array( $data ) ) {
					$data = array();
				}
			}
			
			$pos = array_search( $query, $data );
			if ( $pos !== false ) {
				if ( $pos != 0 ) {
					$data = array_merge( array_slice( $data, 0, $pos ),
						array( $query ), array_slice( $data, $pos + 1 ) );
				}
			} else {
				array_unshift( $data, $query );
				if ( count( $data ) > $max ) {
					array_pop( $data );
				}
			}

			update_option( 'recent_searches_widget_data', $data );
		}
	}
	
	// Widgets initialization
	function widgets_init() {
		$widget_ops = array(
			'classname' => 'widget_rsw', 
			'description' => __('Shows recent searches', 'recent-searches-widget'),
		);
		wp_register_sidebar_widget( 'recentsearcheswidget', __('Recent Searches', 'recent-searches-widget'), 
			array( &$this, 'widget_rsw' ), $widget_ops );
		wp_register_widget_control( 'recentsearcheswidget', __('Recent Searches', 'recent-searches-widget'), 
			array( &$this, 'widget_rsw_control' ) );
	}
	
	function widget_rsw( $args ) {
		extract( $args );
		$title = isset( $options['title'] ) ? $options['title'] : '';
		$title = apply_filters( 'widget_title', $title );
		if ( empty($title) )
			$title = '&nbsp;';
		echo $before_widget . $before_title . $title . $after_title, "\n";
		$this->show_recent_searches( "<ul>\n<li>", "</li>\n</ul>", "</li>\n<li>" );
		echo $after_widget;
	}
	
	function show_recent_searches( $before_list, $after_list, $between_items ) {
		
		$options = get_option( 'recent_searches_widget' );
		if ( !is_array( $options ) ) {
			$options = $this->get_default_options();
		}

		$data = get_option( 'recent_searches_widget_data' );

		if ( !is_array( $data ) ) {
			if ( isset( $options['data'] ) ) {
				$data = $options['data'];
			}
			if ( !is_array( $data ) ) {
				$data = array();
			}
		}
		
		if ( count( $data ) > 0 ) {
			echo $before_list;
			$first = true;
			$num_item = 0;
			foreach ( $data as $search ) {
			$num_item++;
			
			if($num_item < 2) {
			
				if ( $first ) {
					$first = false;
				} else {
					echo $between_items;
				}
				$my_search = $search;
				if ( empty($my_search) ) {
				$my_search = get_search_query();
				}
				
				$my_search = mb_substr($my_search, 0, 10, 'UTF-8') . '';

				
				
				echo '<a href="'. get_search_link1( $search ). '"';
				if ( $options['nofollow'] ) {
					echo ' rel="nofollow"';
				}
				echo '>'.  $my_search . '</a>';
				
			}	
				
				
				
			}
			echo $after_list, "\n";
		} else {
			_e('No searches yet', 'recent-searches-widget');
		}
	}
	
	function widget_rsw_control() {
		$options = $newoptions = get_option('recent_searches_widget', array() );
		if ( count( $options ) == 0 ) {
			$options = $this->get_default_options();
			update_option( 'recent_searches_widget', $options );
		}
		if ( isset( $_POST['rsw-submit'] ) ) {
			$options['title'] = strip_tags( stripslashes( $_POST['rsw-title'] ) );
			$options['max'] = (int)( $_POST['rsw-max'] );
			$options['nofollow'] = isset( $_POST['rsw-nofollow'] );
			if ( count( $options['data'] ) > $options['max'] ) {
				$options['data'] = array_slice( $options['data'], 0, $options['max'] );
			}
			update_option( 'recent_searches_widget', $options );
		}
		$title = esc_attr( $options['title'] );
		$max = esc_attr( $options['max'] );
		$nofollow = $options['nofollow'];
	?>
	<p><label for="rsw-title"><?php _e('Title:', 'recent-searches-widget'); ?> <input class="widefat" id="rsw-title" name="rsw-title" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="rsw-max"><?php _e('Max searches:', 'recent-searches-widget'); ?> <input id="rsw-max" name="rsw-max" type="text" size="3" maxlength="5" value="<?php echo $max; ?>" /></label></p>
	<p><label for="rsw-nofollow"><?php _e('Add <code>rel="nofollow"</code> to links:', 'recent-searches-widget'); ?> <input id="rsw-nofollow" name="rsw-nofollow" type="checkbox" value="yes" <?php checked( $nofollow, true ); ?>" /></label></p>
	<input type="hidden" id="rsw-submit" name="rsw-submit" value="1" />
	<?php
	}
	
	// Make string lowercase
	function strtolower( $str ) {
		if ( function_exists( 'mb_strtolower' ) ) {
			return mb_strtolower( $str );
		} else {
			return strtolower( $str );
		}
	}
	
	function get_default_options() {
		return array(
			'title' => '',
			'max' => 3,
			'nofollow' => true,
		);
	}
}

// Add functions from WP2.8 for previous WP versions
if ( !function_exists( 'esc_html' ) ) {
	function esc_html( $text ) {
		return esc_html( $text );
	}
}

if ( !function_exists( 'esc_attr' ) ) {
	function esc_attr( $text ) {
		return esc_attr( $text );
	}
}

// Add functions from WP3.0 for previous WP versions
if ( !function_exists( 'get_search_link1' ) ) {
	function get_search_link1( $query = '' ) {
		global $wp_rewrite;
	
		if ( empty($query) )
			$search = get_search_query();
		else
			$search = stripslashes($query);
	
		$permastruct = $wp_rewrite->get_search_permastruct();
	
		//if ( empty( $permastruct ) ) {
			$link = home_url('?s=' . urlencode($search). '&post_type=product' );
		//} else {
			//$search = urlencode($search);
			//$search = str_replace('%2F', '/', $search); // %2F(/) is not valid within a URL, send it unencoded.
			//$link = str_replace( '%search%', $search, $permastruct );
			//$link = trailingslashit( home_url() ) . user_trailingslashit( $link, 'search' );
		//}
	
		return apply_filters( 'search_link', $link, $search );
	}
}

$wp_recent_searches_widget = new RecentSearchesWidget();

// Show recent searches anywhere in the theme
function rsw_show_recent_searches( $before_list = "<ul>\n<li>", $after_list = "</li>\n</ul>", $between_items = "</li>\n<li>" ) {
	global $wp_recent_searches_widget;
	$wp_recent_searches_widget->show_recent_searches( $before_list, $after_list, $between_items );
}

} // END

?>
<?php
class Iron_Widget extends WP_Widget {

	
	function __construct ($id_base, $name, $widget_options = array(), $control_options = array())
	{
		parent::__construct($id_base, $name, $widget_options, $control_options);
		
		add_filter('widget_title', array(&$this, 'html_title'), 10, 3);
	
	}
	
	function action_link ( $object_id = null, $ext_link = null, $title= '' ) {
	
		if ( $object_id || $ext_link )
		{
			$url = !empty($ext_link) ? $ext_link : get_permalink($object_id);
			$target = !empty($ext_link) ? "_blank" : "_self";
			
			if(!empty($url))
				return '<a target="'.$target.'" href="' . $url . '" class="panel-action panel-action__label">' . $title . '</a>';
		}
	
		return '';
	}
	
	/* CUSTOM WIDGET HEADING DIVIDER */
	public static function get_title_divider() {
		$divider_image = get_iron_option('widget_title_divider_image');
		$divider_color = get_iron_option('widget_title_divider_color');
		$divider_margin_top = get_iron_option('widget_title_divider_margin_top');
		$divider_margin_bottom = get_iron_option('widget_title_divider_margin_bottom');
		if(empty($divider_image)){
			echo '<span class="heading-b3" style="margin-top:'.$divider_margin_top.'px; margin-bottom:'.$divider_margin_bottom.'px; background-color:'.$divider_color.'"></span>';
		} else {
			echo '<img class="custom-header-img" style="margin-top:'.$divider_margin_top.'px; margin-bottom:'.$divider_margin_bottom.'px;" src="'.$divider_image.'" />';
		}
	}

	public static function is_widget_title_uppercase() {
		$widget_title_uppercase = (bool)get_iron_option('widget_title_uppercase');
		if(!empty($widget_title_uppercase)){
			return true;
		}
		return false;
	}
	
	
	/**
	 * Render HTML output
	 */
	
	function html_title ( $title = '', $instance = array(), $id_base = 0 )
	{
		$title = htmlspecialchars_decode( $title );
		$title = strip_tags( $title, '<a><b><i><strong><em>' );
	
		return $title;
	}
	
	
	public static function get_object_options($selected = null, $post_type = 'page') {
		
		$posts = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1, 'suppress_filters' => false));
		$options = '';
		
		$options .= '<option></option>';
		foreach($posts as $p) {
		
			$options .= '<option value="'.$p->ID.'"'.(!is_array($selected) && ($p->ID == $selected) || is_array($selected) && in_array($p->ID, $selected) ? ' selected="selected"' : '').'>'.esc_attr($p->post_title).'</option>';
		
		}

		return $options;
	}

	public static function get_taxonomy_options($selected = null, $taxonomy = 'category') {
		
		$terms = get_terms($taxonomy);
		$options = '';
		
		$options .= '<option></option>';
		foreach($terms as $t) {
		
			$options .= '<option value="'.$t->term_id.'"'.(!is_array($selected) && ($t->term_id == $selected) || is_array($selected) && in_array($t->term_id, $selected) ? ' selected="selected"' : '').'>'.esc_attr($t->name).'</option>';
		
		}

		return $options;
	}
	
}
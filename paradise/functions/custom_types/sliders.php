<?php
class BaseSlider {
	protected $show_caption;
	protected $show_title;
	protected $show_content;
	protected $show_more;
	private $more_text;
	protected $linked_slide;
	protected $target_link;
	protected $use_thumb_filter = true;

	public function __construct() {
		$this->show_caption = get_option('slider_caption');
		$this->show_title = get_option('slider_caption_title');
		$this->show_content = get_option('slider_caption_content');
		$this->show_more = get_option('slider_caption_more');
		$this->more_text = get_option('slider_caption_more_text');
		$this->linked_slide = get_option('slider_link');
		if ($this->use_thumb_filter) {
			add_filter('post_thumbnail_html', array(&$this, 'post_thumbnail_html'), 20, 1);
		}
	}

	public function post_thumbnail_html($html) {
		if ($this->linked_slide && !empty($this->target_link))
			$html = "<a href=\"{$this->target_link}\">{$html}</a>";
		return $html;
	}

	protected function get_caption() {
		$title = $content = $more = '';
		if ($this->show_title)
			$title = '<span class="slider_title">'.get_the_title().'</span>';
		if ($this->show_content) {
			$content = apply_filters('the_content', get_the_content());
			$content = str_replace(']]>', ']]&gt;', $content);
		}
		if ($this->show_more && !empty($this->target_link))
			$more = "<a href=\"{$this->target_link}\" title=\"\" class=\"btn alignleft small\" style=\"display:block;\">{$this->more_text}</a>";
		return "{$title}{$content}{$more}";
	}
}

global $_theme_sliders;
global $_theme_sliders_list;
$_theme_sliders = array();
$_theme_sliders_list = array();

function autoload_sliders() {
	global $_theme_sliders;
	global $_theme_sliders_list;

	$dir = get_theme_root() . '/' . get_template() . '/functions/sliders/';
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (is_file($dir . $file)) {
					$class_name = basename($dir . $file, '.php');
					require_once($dir . $file);
					$new_slider = new $class_name();
					$_theme_sliders[$new_slider->id] = $new_slider;
					$_theme_sliders_list[$new_slider->id] = $new_slider->get_name();
				}
			}
			closedir($dh);
		}
	}
}
add_action('init', 'autoload_sliders');

function get_option_str($option) {
	$option = get_option($option);
	return ($option) ? 'true' :'false';
}

function slider_enqueue() {
	global $_theme_sliders;
	if (is_front_page()) {
		$set_slider = (isset($_GET['slider'])) ? $_GET['slider'] : '';
		if ($set_slider && array_key_exists($set_slider, $_theme_sliders)) {
			update_option('slider_type', $set_slider);
		}
		$_slider_type = get_option('slider_type');
		if ($_slider_type != 'disable' && !empty($_slider_type))
			$_theme_sliders[$_slider_type]->scripts();
	}
}

function slider_init() {
	global $_theme_sliders;
	$_slider_type = get_option('slider_type');
	if ($_slider_type == 'disable' || empty($_slider_type))
		return;
	if (is_front_page()) {
		echo '<script type="text/javascript">';
		$_theme_sliders[$_slider_type]->scripts_init();
		echo '</script>';
	}
}

function theme_slider_render() {
					
	global $_theme_sliders;
	$_slider_type = get_option('slider_type');
	if ($_slider_type == 'disable' || empty($_slider_type))
		return;
	$tag = get_option('slider_tag');
	$args = array(
		'post_type' => 'slideshow',
	);
	$items_count = get_option('slider_count_items');
	if (empty($items_count))
		$items_count = -1;
	if (!empty($items_count))
		$args['posts_per_page'] = $items_count;
	if ($post_order = get_option('slider_post_order'))
		$args['orderby'] = $post_order;
	if ($post_order != 'rand') {
		$sort_order = get_option('slider_sort_order', 'DESC');
		$args['order'] = $sort_order;
	}
	$loop = new WP_Query($args);
	if ($loop->have_posts()):
		$_theme_sliders[get_option('slider_type')]->render($loop);
	endif;
}

function theme_slider_options() {
	global $_theme_sliders;
	$_slider_type = get_option('slider_type');
	if ($_slider_type == 'disable' || empty($_slider_type))
		return;
	foreach ($_theme_sliders as $slider) {
		if ($slider->id != $_slider_type)
			continue;
		$slider->options();
		break;
	}
}

sd_register_post_type('slideshow', array(
	'labels' => array(
		'name' => _x('Slideshow', 'post type general name'),
		'singular_name' => _x('Slideshow Item', 'post type singular name'),
		'add_new' => _x('Add New', 'slideshow'),
		'add_new_item' => __('Add New Item'),
		'edit_item' => __('Edit Item'),
		'new_item' => __('New Item'),
		'view_item' => __('View Item'),
		'search_items' => __('Search Items'),
		'not_found' =>  __('No items found'),
		'not_found_in_trash' => __('No items found in Trash'),
		'parent_item_colon' => ''
	),
	'public' => true,
	'show_ui' => true,
	'hierarchical' => false,
	'capability_type' => 'post',
	'exclude_from_search' => true,
	'show_in_nav_menus' => false,
	'supports' => array(
		'title',
		'editor',
		'thumbnail',
	),
), 'slideshow');

function set_slideshow_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Items', TEMPLATENAME),
		'thumbnail' => __('Thumbnail', TEMPLATENAME),
	);
	return $columns;
}
add_filter('manage_edit-slideshow_columns', 'set_slideshow_columns');

function display_slideshow_columns($column_name, $post_id) {
	global $post;
	if ($post->post_type == 'slideshow') {
		if ($column_name == 'thumbnail') {
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('thumbnail');
			} else {
				echo __('None', TEMPLATENAME);
			}
		}
	}
}
add_action('manage_posts_custom_column',  'display_slideshow_columns', 10, 2);

require_once (TEMPLATEPATH . '/functions/metaboxes/sliders.php');

?>

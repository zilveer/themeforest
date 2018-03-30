<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

add_action('init', array('TMM_Slider', 'register'), 2);
add_action("admin_init", array('TMM_Slider', 'admin_init'));
add_action('save_post', array('TMM_Slider', 'save_post'));
//AJAX
add_action('wp_ajax_add_meta_slide_item', array('TMM_Slider', 'add_meta_slide_item'));
add_action('wp_ajax_add_post_slide_item', array('TMM_Slider', 'add_post_slide_item'));

class TMM_Slider {

	public static $slug = 'slidergroup';
	public static $sliders_classes_array = array();
	public static $slider_options = array(); //$key=>$name
	public static $slider_js_options = array();
	public static $easing_effects = array();

	public static function register() {
		self::$easing_effects = array(
			'swing' => __('Swing', 'diplomat'),
			'easeInQuad' => __('easeInQuad', 'diplomat'),
			'easeOutQuad' => __('easeOutQuad', 'diplomat'),
			'easeInOutQuad' => __('easeInOutQuad', 'diplomat'),
			'easeInCubic' => __('easeInCubic', 'diplomat'),
			'easeOutCubic' => __('easeOutCubic', 'diplomat'),
			'easeInOutCubic' => __('easeInOutCubic', 'diplomat'),
			'easeInQuart' => __('easeInQuart', 'diplomat'),
			'easeOutQuart' => __('easeOutQuart', 'diplomat'),
			'easeInOutQuart' => __('easeInOutQuart', 'diplomat'),
			'easeInQuint' => __('easeInQuint', 'diplomat'),
			'easeOutQuint' => __('easeOutQuint', 'diplomat'),
			'easeInOutQuint' => __('easeInOutQuint', 'diplomat'),
			'easeInExpo' => __('easeInExpo', 'diplomat'),
			'easeOutExpo' => __('easeOutExpo', 'diplomat'),
			'easeInOutExpo' => __('easeInOutExpo', 'diplomat'),
			'easeInSine' => __('easeInSine', 'diplomat'),
			'easeOutSine' => __('easeOutSine', 'diplomat'),
			'easeInOutSine' => __('easeInOutSine', 'diplomat'),
			'easeInCirc' => __('easeInCirc', 'diplomat'),
			'easeOutCirc' => __('easeOutCirc', 'diplomat'),
			'easeInOutCirc' => __('easeInOutCirc', 'diplomat'),
			'easeInElastic' => __('easeInElastic', 'diplomat'),
			'easeOutElastic' => __('easeOutElastic', 'diplomat'),
			'easeInOutElastic' => __('easeInOutElastic', 'diplomat'),
			'easeInBack' => __('easeInBack', 'diplomat'),
			'easeOutBack' => __('easeOutBack', 'diplomat'),
			'easeInOutBack' => __('easeInOutBack', 'diplomat'),
			'easeInBounce' => __('easeInBounce', 'diplomat'),
			'easeOutBounce' => __('easeOutBounce', 'diplomat'),
			'easeInOutBounce' => __('easeInOutBounce', 'diplomat'),
		);

		TMM_Slider_Flex::init();
		TMM_Slider_Layer::init();

		add_filter("manage_" . self::$slug . "_posts_columns", array(__CLASS__, "show_edit_columns"));
		add_action("manage_" . self::$slug . "_posts_custom_column", array(__CLASS__, "show_edit_columns_content"));

		return false;
	}

	public static function get_application_path() {
		return TMM_EXT_PATH . '/sliders';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/sliders';
	}

	public static function admin_init() {
		self::init_meta_boxes();
                
	}

	public static function init_meta_boxes() {

		add_meta_box("tmm_slider_meta_options", __("Slider Options", 'diplomat'), array(__CLASS__, 'draw_slidergroup_options'), self::$slug, "normal", "low");
		add_meta_box("tmm_slides_meta", __("Slides", 'diplomat'), array(__CLASS__, 'draw_slidergroup_slides_meta'), self::$slug, "normal", "low");
		//***
		//add_meta_box("tmm_slider_meta_box", __("Page slider", 'diplomat'), array(__CLASS__, 'draw_page_slides_meta_box'), "post", "side", "low");
		//add_meta_box("tmm_slider_meta_box", __("Page slider", 'diplomat'), array(__CLASS__, 'draw_page_slides_meta_box'), "page", "side", "low");
	}

	public static function get_slider_types() {
		$result = array();
		$slider_options = self::$slider_options;
		foreach ($slider_options as $value) {
			$result[$value['key']] = $value['name'];
		}

		return $result;
	}
        
    public static function draw_slidergroup_options(){
        global $post;
		$data = array();
		$slider_options = self::get_page_slider_options($post->ID);
		$data['slider_options'] = $slider_options;
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_options.php', $data);
    }

    public static function draw_slidergroup_slides_meta() {
		wp_enqueue_style('tmm_ext_sliders_css', self::get_application_uri() . '/css/styles.css');
		wp_enqueue_script('tmm_ext_sliders_js', self::get_application_uri() . '/js/slidergroup.js');
		wp_enqueue_script('tmm_popup', self::get_application_uri() . 'js/popup.js', array('jquery'));
		global $post;
		$data = array();
		$slides_group = self::get_page_slides($post->ID);
		$post_slides_group = self::get_post_slides($post->ID);
		$data['slides_group'] = $slides_group;
		$data['post_slides_group'] = $post_slides_group;
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta.php', $data);
	}

	public static function draw_page_slides_meta_box() {
		wp_enqueue_script('tmm_ext_sliders_js', self::get_application_uri() . '/js/slidergroup.js');
		global $post;
		$data = array();
		$data['slides'] = self::get_list_of_groups();
		$data['slider_types'] = self::get_slider_types();
		$data = array_merge($data, self::get_page_settings($post->ID));
		$data['layerslider_slide_group'] = $data['layerslider_slide_group'];
		$data['cuteslider_slide_group'] = $data['cuteslider_slide_group'];
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_box.php', $data);
	}

	public static function save_post($post_id) {
		global $post;
		if (is_object($post) AND !empty($_POST)) {
			$allows_post_types = array(self::$slug, 'post', 'page');
			if (in_array($post->post_type, $allows_post_types)) {
				update_post_meta($post_id, "slides_group", @$_POST["slides_group"]);
				update_post_meta($post_id, "slider_settings", @$_POST["slider_settings"]);
				update_post_meta($post_id, "post_slides_group", @$_POST["post_slides_group"]);

				update_post_meta($post_id, "page_slider", @$_POST["page_slider"]);
				update_post_meta($post_id, "page_slider_width", @$_POST["page_slider_width"]);
				update_post_meta($post_id, "layerslider_slide_group", @$_POST["layerslider_slide_group"]);
				update_post_meta($post_id, "cuteslider_slide_group", @$_POST["cuteslider_slide_group"]);
				update_post_meta($post_id, "page_slider_type", @$_POST["page_slider_type"]);
			}
		}
	}

	public static function get_page_settings($post_id) {
		$custom = get_post_custom($post_id);
		$data = array();
		$data['page_slider'] = (isset($custom["page_slider"][0])) ? $custom["page_slider"][0] : '';
		$data['page_slider_width'] = (isset($custom["page_slider_width"][0])) ? $custom["page_slider_width"][0] : '';
		$data['layerslider_slide_group'] = (isset($custom["layerslider_slide_group"][0])) ? $custom["layerslider_slide_group"][0] : '';
		$data['cuteslider_slide_group'] = (isset($custom["cuteslider_slide_group"][0])) ? $custom["cuteslider_slide_group"][0] : '';
		$data['page_slider_type'] = (isset($custom["page_slider_type"][0])) ? $custom["page_slider_type"][0] : '';
		return $data;
	}

	public static function get_page_slides_count($post_id) {
		$slides = self::get_page_slides($post_id);
		return count($slides);
	}

	public static function get_mixed_slides_count($post_id){
		$slides = self :: get_post_slides($post_id);
		return count($slides);
	}
        
    public static function get_page_slider_options($post_id){
    	return get_post_meta($post_id, 'slider_settings', true);
    }

	public static function get_page_slides($post_id) {
		return get_post_meta($post_id, 'slides_group', true);
	}

	public static function get_post_slides($post_id){
		return get_post_meta($post_id, 'post_slides_group', true);
	}

	//ajax
	public static function add_meta_slide_item() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];
		$data['group'] = $data;
		echo TMM::draw_free_page(self::get_application_path() . '/views/meta_slide_item.php', $data);
		exit;
	}
	public static function add_post_slide_item(){
		$data = array();
		$posts = $_REQUEST['posts'];
		if (!empty($posts)){
			$posts = explode('^', $posts);
			foreach($posts as $id) {
				$data['unique_id'] = uniqid();
				$post = get_post($id);
				$data['post_id'] = $post->ID;
				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
				$data['post_thumb'] = (isset($img_src[0])) ? $img_src[0] : '';
				$data['post_title'] = $post->post_title;
				$data['post_date'] = $post->post_date;
				$data['date'] = 'd_m_Y';
				$data['post_content'] = $post->post_content;
				$data['post_permalink'] = get_permalink($post->ID);
				$data['lm_text'] =  _('Load more', 'diplomat');
				$data['author_link'] = '1';
				$data['comments_link'] = '1';
				echo TMM::draw_free_page(self::get_application_path().'/views/post_slide_item.php', $data);
			}
		}
		exit;
	}

	public static function remove_empty_tags($content){
		$tags = array(
			'<p>[' => '[',
			']</p>' => ']',
			']<br>' => ']',
			']<br />' => ']'
		);

		$content = strtr($content, $tags);
		return $content;
	}

	public static function show_edit_columns_content($column) {
		global $post;

		switch ($column) {
			case "image":
				echo '<img width="200" alt="' . esc_attr($post->post_title) . '" src="' . esc_url(TMM_Helper::get_post_featured_image($post->ID, '200*200')) . '"/>';
				break;
			case "count":
				echo self::get_mixed_slides_count($post->ID);
				break;
		}
	}

	public static function show_edit_columns($columns) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => __("Title", 'diplomat'),
			"image" => __("Group Cover", 'diplomat'),
			"count" => __("Slides Amount", 'diplomat'),
		);

		return $columns;
	}

	public static function get_list_of_groups() {
		$result = array();

		$posts = get_posts(array(
			'post_type' => self::$slug,
			'order' => 'ASC',
			'orderby' => 'post_title',
			'posts_per_page' => -1,
            'suppress_filters' => false
		));

		if (!empty($posts)) {
			foreach ($posts as $value) {
				$result[$value->ID] = $value->post_title;
			}
		}

		return $result;
	}

	public static function get_slider_js_options($slider_type) {
		$options_list = self::$slider_js_options[$slider_type];

		$options = array();
		if (!empty($options_list)) {
			foreach ($options_list as $option_key => $values) {
				$option = TMM::get_option("slider_" . $slider_type . "_" . $option_key);
				if (empty($option) AND !is_numeric($option)) {
					$option = $values['default'];
				}

				$options[$option_key] = $option;
			}
		}

		return $options;
	}

	public static function draw_page_slider($post_id) {
		$page_settings = self::get_page_settings($post_id);

		if ($page_settings['page_slider_type'] == 'layerslider') {
			if ($page_settings['layerslider_slide_group'] > 0) {
				return do_shortcode('[layerslider id="' . $page_settings['layerslider_slide_group'] . '"]');
			}
			return "";
		}

		if ($page_settings['page_slider_type'] == 'cuteslider') {
			if ($page_settings['cuteslider_slide_group'] > 0) {
				return do_shortcode('[cuteslider id="' . $page_settings['cuteslider_slide_group'] . '"]');
			}
			return "";
		}

		if (!$page_settings['page_slider']) {
			return "";
		}

		if (!isset(self::$slider_options[$page_settings['page_slider_type']])) {
			return "";
		}

		$data = array();
		$data['post_id'] = $post_id;
		$data['slides'] = self::get_page_slides($page_settings['page_slider']);
		$data['options'] = self::get_slider_js_options($page_settings['page_slider_type']);
		$_REQUEST['page_slider_activated'] = TRUE; //if I need to know is page slider activated
		return TMM::draw_free_page(self::get_application_path() . '/items/' . $page_settings['page_slider_type'] . '/views/page_output.php', $data);
	}

	//for shortcode slider only
	public static function draw_shortcode_slider($type, $group_id, $alias) {                             
		$data = array();
		$data['slider_options'] = self::get_page_slider_options($group_id);
		//$slider_type = $data['slider_options']['slider_type'];
		$slider_type = 'post';
		switch ($slider_type){
			case 'post':
				$data['slides']=self::get_post_slides($group_id);
				return TMM::draw_free_page(self::get_application_path() . '/items/post/page_output.php', $data);
				break;
			case 'sequence':
				$data['slides'] = self::get_page_slides($group_id);
				$data['options'] = self::get_slider_js_options($type);
				$data['alias'] = $alias;
				$data['is_shortcode'] = true;
				return TMM::draw_free_page(self::get_application_path() . '/items/' . $type . '/views/page_output.php', $data);
				break;
		}

	}

	//$post_id - slider group post type id
	public static function draw_group_slider($post_id, $page_slider_type, $alias = 0) {
		if (!isset(self::$slider_options[$page_slider_type])) {
			return "";
		}

		$data = array();
		$data['post_id'] = $post_id;
		$data['slides'] = self::get_page_slides($post_id);
		$data['options'] = self::get_slider_js_options($page_slider_type);
		$data['alias'] = $alias;
		$_REQUEST['page_slider_activated'] = TRUE; //if I need to know is page slider activated
		return TMM::draw_free_page(self::get_application_path() . '/items/' . $page_slider_type . '/views/page_output.php', $data);
	}
        
	public static function draw_slider_option($data) {
		$value = "";
		//sometimes I have value or cant get in by TMM::get_option
		if (isset($data['value'])) {
			$value = $data['value'];
		}
		if (empty($value) && '0' != $value && !empty($data['default_value'])) {
			$value = $data['default_value'];
		}

		switch ($data['type']) {
			
			case 'text':
				?>
				<div class="option option-text">
					
					<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>
					
					<div class="controls">
                        <input data-default-value="<?php echo esc_attr(@$data['default_value']) ?>" type="text" class="<?php echo (isset($data['css_class'])) ? esc_attr($data['css_class']) : ''; ?>" name="<?php echo esc_attr($data['name']) ?>" <?php if (!empty($data['placeholder'])){ echo 'placeholder="'. esc_attr($data['placeholder']) .'"';} ?> value="<?php echo esc_attr($value) ?>">
					</div><!--/ .controls-->
					
					<div class="explain"><?php echo esc_html($data['description']) ?></div>
					
				</div>
				<?php
				break;
			case 'textarea':
				?>
				<div class="option option-textarea">

					<?php if (isset($data['title']) && !empty($data['title'])){ ?>
						<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>
					<?php }?>
					
					<textarea rows="5" data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="<?php echo esc_attr($data['css_class']); ?>"><?php echo esc_html($value); ?></textarea>
					
					<div class="explain">
						<?php echo esc_html($data['description']); ?>
					</div>
					
				</div>
				<?php
				break;
			case 'select':
				?>
				<div class="option option-select">
		
					<h4 class="option-title"><?php echo esc_html($data['title']); ?></h4>
					
					<div class="controls">
						<label class="sel">
							<select data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" name="<?php echo esc_attr($data['name']); ?>" class="<?php echo esc_attr($data['css_class']); ?>">
								<?php if (!empty($data['values'])): ?>
									<?php foreach ($data['values'] as $key => $option_text) : ?>
										<option value="<?php echo esc_attr($key); ?>" <?php echo($value == $key ? 'selected=""' : "") ?>><?php echo esc_html($option_text); ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>							
						</label>
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;
			case 'checkbox':

				?>
				<div class="option option-checkbox">
					
					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" type="hidden" value="<?php echo($value == 1 ? "1" : "0") ?>" name="<?php echo esc_attr($data['name']); ?>">
						<input type="checkbox" id="<?php echo esc_attr($data['name']); ?>" class="option_checkbox <?php echo (isset($data['css_class'])) ? esc_attr($data['css_class']) : ''; ?>" <?php echo($value == 1 ? "checked" : "") ?> />
						<label for="<?php echo esc_attr($data['name']); ?>"><span></span><?php echo esc_html($data['title']); ?></label>
					</div>
					
					<div class="explain">
						<?php echo esc_html($data['description']); ?>
					</div>
					
				</div>
				<?php
				break;
			case 'color':
				?>
				<div class="option option-color">
					
					<h4 class="option-title"><?php echo esc_html(@$data['title']); ?></h4>

					<div class="controls">
						<input data-default-value="<?php echo esc_attr(@$data['default_value']); ?>" value-index="0" type="text" class="bg_hex_color text small <?php echo esc_attr(@$data['css_class']); ?>" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($data['name']); ?>">
						<div class="bgpicker" style="background-color: <?php echo $value ?>"></div>

						<?php if (@$_GET['page'] == 'tmm_theme_options'): ?>
							<a href="javascript:void(0);" class="js_picker_val_back" title="<?php esc_attr_e('Back', 'diplomat'); ?>"><?php esc_html_e('back', 'diplomat'); ?></a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_ahead" title="<?php esc_attr_e('Forward', 'diplomat'); ?>"><?php esc_html_e('forward', 'diplomat'); ?></a>&nbsp;
							<a href="javascript:void(0);" class="js_picker_val_reset" title="<?php esc_attr_e('Reset', 'diplomat'); ?>"><?php esc_html_e('reset', 'diplomat'); ?></a>
						<?php endif; ?>
					</div>

					<div class="explain"><?php echo esc_html($data['description']); ?></div>

				</div>
				<?php
				break;		

			default:
				esc_html_e('Option type does not exist!', 'diplomat');
				break;
		}	
	}

	public static function get_post_date_format($post_date){
		$date = array(
			'none' => 'None',
			'd_m_Y' => mysql2date('d.m.Y', $post_date),
			'j_M_Y' => mysql2date('j M Y', $post_date),
			'F_j_Y_g_i' => mysql2date('F j, Y g:i', $post_date),
			'F_j_Y' => mysql2date('F j, Y', $post_date),
			'F_Y' => mysql2date('F, Y', $post_date),
			'l_F_jS_Y' => mysql2date('l, F jS, Y', $post_date),
			'M_j_Y_G_i' => mysql2date('M j, Y @ G:i', $post_date),
			'Y_m_d_a_t_g_i_A' => mysql2date('Y/m/d \a\t g:i A', $post_date),
			'Y_m_d_a_t_g_ia' => mysql2date('Y/m/d \a\t g:ia', $post_date),
			'Y_m_d_g_i_s_A' => mysql2date('Y/m/d g:i:s A', $post_date),
			'Y_m_d' => mysql2date('Y/m/d', $post_date)
		);
		return $date;
	}

	public static function get_date_format($format, $post_date){
		switch($format){
			case 'd_m_Y':
				return mysql2date('d.m.Y', $post_date);
				break;
			case 'j_M_Y':
				return mysql2date('j M Y', $post_date);
				break;
			case 'F_j_Y_g_i':
				return mysql2date('F j, Y g:i', $post_date);
				break;
			case 'F_j_Y':
				return mysql2date('F j, Y', $post_date);
				break;
			case 'F_Y':
				return mysql2date('F, Y', $post_date);
				break;
			case 'l_F_jS_Y':
				return mysql2date('l, F jS, Y', $post_date);
				break;
			case 'M_j_Y_G_i':
				return mysql2date('M j, Y @ G:i', $post_date);
				break;
			case 'Y_m_d_a_t_g_i_A':
				return mysql2date('Y/m/d \a\t g:i A', $post_date);
				break;
			case 'Y_m_d_a_t_g_ia':
				return mysql2date('Y/m/d \a\t g:ia', $post_date);
				break;
			case 'Y_m_d_g_i_s_A':
				return mysql2date('Y/m/d g:i:s A', $post_date);
				break;
			case 'Y_m_d':
				return mysql2date('Y/m/d', $post_date);
				break;
		}
	}

	public static function get_slide_posts(){
		$data = array();
		$output = '';
		$args = array(	'post_type' => 'post',
						'posts_per_page' => -1,
						'post_status' => 'any',
						'suppress_filters' => false
						);
		$postslist = get_posts($args);

		if (!empty($postslist)) {
			$output .= '<ul>';
			foreach ($postslist as $id => $post) {
				$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
				$data['imgurl'] = (isset($img_src[0])) ? $img_src[0] : '';
				$data['title'] = $post->post_title;
				$data['id'] = $post->ID;
				$data['author'] = $post->post_author;

				$data['date'] = array('j_M_Y' => mysql2date('j M Y', $post->post_date),
					'F_j_Y_g_i' => mysql2date('F j, Y g:i', $post->post_date),
					'F_j_Y' => mysql2date('F j, Y', $post->post_date),
					'F_Y' => mysql2date('F, Y', $post->post_date),
					'l_F_jS_Y' => mysql2date('l, F jS, Y', $post->post_date),
					'M_j_Y_G_i' => mysql2date('M j, Y @ G:i', $post->post_date),
					'Y_m_d_a_t_g_i_A' => mysql2date('Y/m/d \a\t g:i A', $post->post_date),
					'Y_m_d_a_t_g_ia' => mysql2date('Y/m/d \a\t g:ia', $post->post_date),
					'Y_m_d_g_i_s_A' => mysql2date('Y/m/d g:i:s A', $post->post_date),
					'Y_m_d' => mysql2date('Y/m/d', $post->post_date)
				);

				$data['excerpt'] = $post->post_excerpt;
				$data['guid'] = get_permalink($post->ID);

				$output .= TMM::draw_free_page(TMM_Slider::get_application_path() . '/views/post_list.php', $data);
			};
			$output .= '</ul>';
			echo $output;
		};
	}
}


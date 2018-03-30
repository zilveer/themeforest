<?php
/**
 * Estate Addon class
 */
class PGL_Addon_Estate
{
	static function init()
	{
		self::register();
		self::add_features();
		self::add_actions();
		self::add_filters();
		self::add_shortcodes();
	}

	/**
	 * #####################################
	 * Actions
	 * #####################################
	 */
	static function register()
	{
        global $pgl_options;
		$args = array(
			'labels' => array(
				'name' => 'Estates',
				'singular_name' => 'Estate',
			),
			'description' => __('This post type is used in RealEstast theme', PGL),
			'public' => TRUE,
			'show_ui' => TRUE,
			'hierarchical' => FALSE,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
			),
			'has_archive' => TRUE,
			'rewrite' => array(
				'slug' => $pgl_options->option('estate_slug') ? $pgl_options->option('estate_slug') : 'estate',
				'with_front' => false
			),
		);
		register_post_type('estate', $args);

		$args = array(
			'labels' => array(
				'name' => __('Estate Categories', PGL),
				'singular_name' => __('Estate Category', PGL),
			),
			'hierarchical' => TRUE,
			'rewrite' => array(
				'slug' => ($pgl_options->option('estate_slug') ? $pgl_options->option('estate_slug') : 'estate').'-type',
				'with_front' => false,
				'hierarchical' => TRUE,
			)
		);
		register_taxonomy('estate-type', 'estate', $args);

		$args = array(
			'labels' => array(
				'name' => __('Estate Locations', PGL),
				'singular_name' => __('Estate location', PGL),
			),
			'hierarchical' => FALSE,
			'rewrite' => array(
				'slug' => ($pgl_options->option('estate_slug') ? $pgl_options->option('estate_slug') : 'estate').'-location',
				'with_front' => false,
				'hierarchical' => TRUE,
			),
			'single_value' => TRUE,
		);
		register_taxonomy('estate-location', 'estate', $args);
	}

	private static function add_features()
	{
		$image_size = array(
			'estate-detail-thumbnail' => array(
				'w' => 620,
				'h' => 388,
				'c' => TRUE,
			),
			'estate-detail-small-thumbnail' => array(
				'w' => 55,
				'h' => 55,
				'c' => TRUE,
			),
			'estate-respond-thumbnail' => array(
				'w' => 720,
				'h' => 0,
				'c' => TRUE,
			),
			'estate-showcase-big-thumbnail' => array(
				'w' => 600,
				'h' => 600,
				'c' => TRUE,
			),
			'estate-showcase-small-thumbnail' => array(
				'w' => 400,
				'h' => 400,
				'c' => TRUE,
			),
			'estate-grid-view-3-column-thumbnail' => array(
				'w' => 300,
				'h' => 200,
				'c' => TRUE,
			),
			'estate-sidebar-widget-thumbnail' => array(
				'w' => 90,
				'h' => 54,
				'c' => TRUE,
			),
			'estate-icon' => array(
				'w' => 0,
				'h' => 14,
				'c' => TRUE,
			)
		);

		foreach ($image_size as $key => $size) {
			add_image_size(_PREFIX_ . $key, $size['w'], $size['h'], $size['c']);
		}
	}

	static function add_actions()
	{
		// add_action( 'init', array( 'PGL_Addon_Estate', 'register' ) );
		add_action('admin_init', array(
			'PGL_Addon_Estate',
			'add_meta_box'
		));
		add_action('save_post', array(
			'PGL_Addon_Estate',
			'save_meta_box'
		));
		add_action('pre_get_posts', array(
			'PGL_Addon_Estate',
			'__action_list_display'
		));
		//search action
		add_action('pre_get_posts', array(
			'PGL_Addon_Estate',
			'__action_search'
		));
		add_action('before_sidebar_hook', array(
			'PGL_Addon_Estate',
			'estate_detail_map'
		));
		add_action('before_sidebar_hook', array(
			'PGL_Addon_Estate',
			'estate_detail_contact'
		));

		add_action( 'init', 'init_cmb_meta_boxes', 9999 );
	}

	static function add_filters()
	{
		add_filter('estate_the_excerpt', array(
			'PGL_Addon_Estate',
			'__filter_the_excerpt'
		));
		add_filter('search_template', array(
			'PGL_Addon_Estate',
			'__filter_load_search_template'
		));
		add_filter('archive_template', array(
			'PGL_Addon_Estate',
			'__filter_load_search_template'
		)); //load search template when the search keyword is empty (search by other conditions)
		//		add_filter( 'posts_where', array( 'PGL_Addon_Estate', '__filter_search' ) );
		add_filter( 'cmb_meta_boxes', array(
			'PGL_Addon_Estate',
			'_init_metaboxes'
		) );
	}

	/**
	 * ###############################################
	 * Shortcodes
	 * ###############################################
	 */
	private static function add_shortcodes()
	{
		add_shortcode('estate_list', array(
			'PGL_Addon_Estate',
			'estate_list_shortcode'
		));
		add_shortcode('estate_horizontal_slide', array(
			'PGL_Addon_Estate',
			'estate_horizontal_slide_shortcode'
		));
		add_shortcode('estate_search', array(
			'PGL_Addon_Estate',
			'estate_search_shortcode'
		));
		add_shortcode('estate', array(
			'PGL_Addon_Estate',
			'estate_shortcode'
		));
	}
	static function _init_metaboxes( $meta_boxes ) {
        global $pgl_options;
		$prefix = 'estate_'; // Prefix for all fields

        $meta_boxes['estate-core-fields'] = array(
            'id' => $prefix.'core_fields',
            'title' => __('Estate Infomation', PGL),
            'pages' => array('estate'),
            'context' => 'normal',
            'priority' => 'low',
            'show_names' => true,
            'cmb_styles' => false,
            'fields' => array(
                array(
                    'name' => __('Purpose', PGL),
                    'id' => $prefix . 'purpose',
                    'type' => 'select',
                    'options' => array(
                        array( 'name' => __( 'For sale', PGL ), 'value' => 'sale', ),
                        array( 'name' => __( 'For rent', PGL ), 'value' => 'rent', )
                    )
                ),
                array(
                    'name'=> __('Price', PGL),
                    'id' => $prefix . 'price',
                    'type' => 'text_medium',
                    'before' => ' ',
                    'after' => PGL_Utilities::get_currency_symbol($pgl_options->option('estate_currency'))
                ),
                array(
                    'name'=>__('Bathroom', PGL),
                    'desc'=>__('Number of bathroom', PGL),
                    'id'=> $prefix . 'bathrooms',
                    'type'=> 'text_small'
                ),
                array(
                    'name'=>__('Bedroom', PGL),
                    'desc'=>__('Number of bedroom', PGL),
                    'id'=> $prefix . 'bedrooms',
                    'type'=> 'text_small'
                ),
                array(
                    'name'=>__('Area', PGL),
                    'id'=> $prefix . 'area',
                    'after'=> $pgl_options->option('estate_area_unit'),
                    'type'=> 'text_small'
                ),
                array(
                    'name'=>__('Coordinates', PGL),
                    'desc'=>__('Input coordinates to display map, lat long separated with ";" eg. 12.123123;34.234234'),
                    'id'=> $prefix . 'coordinates',
                    'type'=> 'text_medium'
                ),
                array(
                    'name'=> __('Map position', PGL),
                    'id' => $prefix . 'map_pos',
                    'type' => 'select',
                    'options' => array(
                        array( 'name' => __( 'Sidebar', PGL ), 'value' => 'side', ),
                        array( 'name' => __( 'Content', PGL ), 'value' => 'main', )
                    )
                ),
                array(
                    'name'=> __('Sold/Rented', PGL),
                    'desc'=> __('Show sold or rented label', PGL),
                    'id' => $prefix . 'status',
                    'type' => 'select',
                    'options' => array(
                        array( 'name' => __( 'No', PGL ), 'value' => '0', ),
                        array( 'name' => __( 'Yes', PGL ), 'value' => '1', )
                    )
                ),
                array(
                    'name'=> __('Featured', PGL),
                    'desc'=> __('Show it in horizontal slider', PGL),
                    'id' => $prefix . 'featured',
                    'type' => 'select',
                    'options' => array(
                        array( 'name' => __( 'No', PGL ), 'value' => '0', ),
                        array( 'name' => __( 'Yes', PGL ), 'value' => '1', )
                    )
                ),
            )
        );
		return $meta_boxes;
	}
	/**
	 * [__filter_search description]
	 *
	 * @param  string $query [description]
	 *
	 * @return string		 [description]
	 */
	static function __filter_search($query)
	{
		if ((isset($_GET['available_from']) && !empty($_GET['available_from'])) || (isset($_GET['available_to']) && !empty($_GET['available_to']))) {
			/**
			 * @var $wpdb wpdb
			 */
			global $wpdb;
			$tmp = array();
			if (isset($_GET['available_from'])) {
				$tmp[] = 'from_date >= ' . $_GET['available_from'];
			}
			if (isset($_GET['available_to'])) {
				$tmp[] = $_GET['available_to'] . ' >= to_date';
			}
			$sub_query = "SELECT post_id from {$wpdb->prefix}datelog WHERE " . implode(' AND ', $tmp);

			$query .= " AND {$wpdb->prefix}posts.ID in ($sub_query)";
			// var_dump($query);exit;

		}

		return $query;
	}

	static function info()
	{

		return array(
			'title' => 'Estate addon',
		);
	}

	/**
	 * ##############################################
	 * Template tag
	 * ##############################################
	 */
	static function estate_detail_map(){
		global $post;
		if($post->post_type != 'estate' || get_post_meta($post->ID, 'estate_map_pos', true) == 'main'){
			return false;
		}
        wp_enqueue_script('google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
		$coordinates = get_post_meta($post->ID, 'estate_coordinates', true);
		$coordinates = explode(',', $coordinates);
		if (count($coordinates) < 2)
			return;
		?>
		<div class="sidebar-box">
			<div class="title-get">
				<div class="heading">
					<span class="widget-name"><?php _e('Map & Direction', PGL) ?></span>
				</div>
			</div>
		<div id="map_canvas_side" style="width: 100%;height: 300px;"></div>
		<script type="text/javascript">
			var my_map;
			function map_init() {
				var location = new google.maps.LatLng("<?php
		echo $coordinates[0]; ?>", "<?php
		echo $coordinates[1]; ?>");
				var map_options = {
					zoom: 15,
					center: location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				my_map = new google.maps.Map(document.getElementById("map_canvas_side"), map_options);
				var marker = new google.maps.Marker({
					position: location,
					map: my_map
				});
			}
			jQuery(function () {
				map_init();
			});
		</script>
		</div>
		<?php
	}
	static function estate_detail_contact(){
		global $post;
		$agent_ids = get_post_meta($post->ID,'agent_id');
		if($post->post_type != 'estate' || !$agent_ids){
			return false;
		}
		$widget_name = __('Contact agent', PGL);
		$html = <<<HTML
		<div class="sidebar-box sidebar-agent">
			<div class="title-get">
				<div class="heading">
					<span class="widget-name">{$widget_name}</span>
				</div>
			</div>
HTML;
		foreach($agent_ids as $agent_id){
			$agent = get_post($agent_id);
			$agent_title = esc_html( get_post_meta( $agent->ID, 'agent_title', TRUE ) );
			$agent_name = $agent->post_title;
			$extra = get_agent_extra_info( $agent );
			$image = get_the_post_thumbnail($agent_id, 'estate-agent-square-thumbnail', array('class'=>'img-responsive'));
			$link = get_permalink($agent->ID);
			$class = 'agent-row';
			if($agent_id === end($agent_ids)){
				$class = 'agent-row-last';
			}
			$html .= <<<HTML
			<div class="row {$class}">
				<div class="our-img col-md-4 col-sm-4 col-xs-4">
					<a href="{$link}" title="{$agent_name}">{$image}</a>
				</div>
	            <div class="our-info col-md-8 col-sm-8 col-xs-8">
	                <h4 class="title">{$agent_title}</h4>
	                <h3 class="name"><a href="{$link}" title="{$agent_name}">{$agent_name}</a></h5>
                    {$extra}
	            </div>
            </div>
HTML;

		}
		$html .= <<<HTML
		</div>
HTML;
		echo $html;
	}
	static function estate_map($coordinates)
	{
		global $pgl_options;
		wp_enqueue_script('google-map-api', 'http://maps.google.com/maps/api/js?sensor=false');
		$coordinates = explode(',', $coordinates);
		if (count($coordinates) < 2)
			return;
		?>
		<div id="map_canvas" style="width: 100%;height: 300px;"></div>
		<script type="text/javascript">
			var my_map;
			function map_init() {
				var location = new google.maps.LatLng("<?php
		echo $coordinates[0]; ?>", "<?php
		echo $coordinates[1]; ?>");
				var map_options = {
					zoom: <?php echo $pgl_options->option('map_zoom_level')?$pgl_options->option('map_zoom_level'):'12' ?>,
					center: location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				my_map = new google.maps.Map(document.getElementById("map_canvas"), map_options);
				var marker = new google.maps.Marker({
					position: location,
					map: my_map
				});
			}
			jQuery(function () {
				map_init();
			});
		</script>
	<?php
	}

	static function the_post_thumbnail($post_id = '', $size = 'estate-list-view-thumbnail', $echo = TRUE)
	{
		if (!$post_id) {
			$post_id = get_the_ID();
		}
		if (has_post_thumbnail($post_id)) {
			the_post_thumbnail(PGL_Image::_size($size));
		} else {
			PGL_Template_Tag::the_post_thumbnail($size);
		}
	}

	/**
	 * @param WP_Query $query
	 *
	 * @return \WP_Query
	 */
	static function __action_list_display($query)
	{
		if (!is_admin() && $query->is_main_query() && ($query->is_post_type_archive('estate') || $query->is_tax('estate-type'))) {
			/**
			 * @var PGL_Options $pgl_options
			 */
			global $pgl_options;
            global $paged;
            if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
            elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
            else { $paged = 1; }

			$query->set('posts_per_page', $pgl_options->option('number_of_estate'));
            $query->set('paged', $paged);
			if (isset($_GET['sort']) && $order = $_GET['sort']){
				if($order == 'price'){
					$query->set('orderby', 'meta_value_num');
					$query->set('meta_key', 'estate_price');
				}else{
					$query->set('orderby', 'title');
				}
				$query->set('order', isset($_GET['dir']) ? $_GET['dir'] : "DESC");
			}
		}
		return $query;
	}

	/**
	 * @param WP_Query $query
	 *
	 * @return mixed
	 */
	static function __action_search($query)
	{
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		if (!is_admin()
			&&
			(
				($query->is_search
					|| ($query->is_post_type_archive('estate') && isset($_GET['search'])))
				&& isset($_GET['post_type'])
				&& $_GET['post_type'] == 'estate'
			)
		) {
			$searchable_fields = $pgl_options->option('estate_searchable_fields');
			if (!empty($searchable_fields)) {
				$searchable_fields = array_keys($searchable_fields);
			} else {
				$searchable_fields = array();
			}
			$searchable_fields[] = 'price';

			$conditional_array = array();
			/**
			 * Automatic find & add search values to query. Only apply for number type
			 */
			$sType = $pgl_options->option('estate_system_type');
			if ($sType == 'both' || $sType == 'rental') {
				$conditional_array[] = array(
					'key' => 'estate_purpose',
					'value' => isset($_GET['purpose']) ? $_GET['purpose'] : 'rent',
					'compare' => 'LIKE',
				);
			} elseif ($sType == 'both' || $sType == 'sale') {
				$conditional_array[] = array(
					'key' => 'estate_purpose',
					'value' => isset($_GET['purpose']) ? $_GET['purpose'] : 'sale',
					'compare' => 'LIKE',
				);
			}


			foreach ($searchable_fields as $field) {
				if (isset($_GET[$field . '_from']) && $_GET[$field . '_from']) {
					$conditional_array[] = array(
						'key' => 'estate_' . $field,
						'value' => $_GET[$field . '_from'],
						'compare' => '>=',
						'type' => 'numeric',
					);
				}

				if (isset($_GET[$field . '_to']) && $_GET[$field . '_to']) {
					$conditional_array[] = array(
						'key' => 'estate_' . $field,
						'value' => $_GET[$field . '_to'],
						'compare' => '<=',
						'type' => 'numeric',
					);
				}
			}

			$conditional_array = apply_filters('estate/filter/search/meta_query', $conditional_array);
			if (count($conditional_array) > 1) {
				$conditional_array['relation'] = 'AND';
			}
			$query->set('meta_query', $conditional_array);

			$tax_query = array(
				'relation' => 'AND',
			);
			if (isset($_GET['term']) && $_GET['term']) {
				$tax_query[] = array(
					'taxonomy' => 'estate-type',
					'terms' => $_GET['term'],
					'field' => 'slug',
					'compare' => 'LIKE',
				);
			}
			if (isset($_GET['location']) && $_GET['location']) {
				$tax_query[] = array(
					'taxonomy' => 'estate-location',
					'terms' => $_GET['location'],
					'field' => 'slug',
					'compare' => 'LIKE',
				);
			}
			$query->set('tax_query', $tax_query);
		}
		return $query;
	}

	/**
	 * ##############################################
	 * Add metabox
	 * ##############################################
	 */
	static function add_meta_box()
	{
		wp_enqueue_style('estate-admin-css', PGL_URI_CSS . 'estate/estate-admin.css');
		wp_enqueue_style('pgl-admin-css', PGL_URI_CSS . 'admin/admin-style.css');
		add_meta_box('estate-gallery', __('Estate Gallery', PGL), array(
			'PGL_Addon_Estate',
			'estate_gallery_box2'
		), 'estate', 'normal', 'high');

		add_meta_box('estate-featured-video', __('Estate Featured Video', PGL), array(
			'PGL_Addon_Estate',
			'estate_featured_video'
		), 'estate', 'side', 'low');
		/*add_meta_box('estate-core-fields', __('Estate information', PGL), array(
			'PGL_Addon_Estate',
			'estate_core_fields_box'
		), 'estate', 'normal', 'high');*/

		add_meta_box('estate-image-fields', __('Icon fields', PGL), array(
			'PGL_Addon_Estate',
			'icon_field_metabox'
		), 'estate', 'advanced', 'low');
	}

	static function save_meta_box($post_id)
	{
		global $post;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

			return $post_id;
		}
		if (is_null($post))
			return NULL;
		if ($post->post_type != 'estate') {

			return NULL;
		}
		$estate_video = sanitize_text_field($_POST['estate_video']);
		update_post_meta($post->ID, 'estate_featured_video', sanitize_text_field($_POST['estate_video']));
		if ($estate_video) {
			update_post_meta($post->ID, 'estate_featured_video_thumbnail_url', PGL_Utilities::get_video_thumbnail($estate_video));
		}

		update_post_meta($post->ID, '_estate_image_gallery', $_POST['estate_image_gallery']);

		if (isset($_POST['estate_icon'])) {
			$icons = json_encode($_POST['estate_icon']);
			update_post_meta($post->ID, 'estate_icon', $icons);
		}

		return TRUE;
	}

	static function icon_field_metabox()
	{
		global $post;
		global $pgl_options;
		$icons = get_post_meta($post->ID, 'estate_icon', TRUE);
		if ($icons) {
			$icons = json_decode($icons, TRUE);
		} else {
			$icons = array();
		}
		$icon_fields = $pgl_options->option('estate_image_fields');
		$len = count($icon_fields);
		?>
		<table>
			<?php for ($i = 0; $i < $len; $i++) {
				?>
				<tr>
					<td><?php
						echo wp_get_attachment_image($icon_fields[$i]['id']);
						?></td>
					<td>
						<?php
						$icon_id = $icon_fields[$i]['id'] . '_' . (str_replace(' ', '_', strtolower($icon_fields[$i]['label'])));
						$name = "estate_icon[$icon_id]";
						?>
						<input type="checkbox" name="<?php echo $name ?>"
							   value="1" <?php if (isset($icons[$icon_id])) echo 'checked'; ?> />
					</td>
				</tr>
			<?php
			}?>
		</table>
	<?php
	}

	static function estate_featured_video()
	{
		global $post;
		$video_url = get_post_meta($post->ID, 'estate_featured_video', TRUE);
		$video_thumbnail_url = get_post_meta($post->ID, 'estate_featured_video_thumbnail_url', TRUE);
		// $thumbnail = PGL_Utilities::get_video_thumbnail( $video_url );

		?>
		<div id="estate-featured-video-container" class="estate-metabox side">
			<input type="text" name="estate_video" id="estate-featured-video" value="<?php
			echo esc_attr($video_url); ?>">

			<p>
				<img src="<?php
				echo esc_attr($video_thumbnail_url) ?>" alt=""/>
			</p>

			<p class="notice">
				<?php
				_e('You must not set the featured image in order to display the feature video', PGL) ?>
			</p>
		</div>
	<?php
	}

	static function estate_gallery_box2()
	{
		global $post;
		wp_enqueue_script('estate-admin-gallery', PGL_URI_JS . 'estate/admin-gallery2.js', array(
			'jquery',
			'backbone'
		), '1.0', true);
		wp_enqueue_script('holderjs', '//cdn.jsdelivr.net/holder/1.9.0/holder.js', array(), '1.9', TRUE);

		$gallery_string = get_post_meta($post->ID, '_estate_image_gallery', TRUE);
		?>
		<div id="gallery-container" class="pgl-meta-box">
			<ul></ul>
			<p class="gallery_commands">
				<a href="#" id="add_image"><?php
					_e('Add image', PGL); ?></a>
				<a id="add_video" href="#"><?php
					_e('Add video', PGL) ?></a>
			</p>
			<input type="hidden" id="ids" name="estate_image_gallery" value='<?php
			echo esc_attr($gallery_string); ?>'/>
		</div>
	<?php
	}

	static function estate_gallery_box()
	{
		global $post;
		wp_enqueue_script('estate-admin-gallery', PGL_URI_JS . 'estate/admin-gallery.js', array(
			'jquery'
		), '1.0');
		wp_enqueue_script('holderjs', '//cdn.jsdelivr.net/holder/1.9.0/holder.js', array(), '1.9', TRUE);
		?>
		<div id="estate_images_container">
			<ul class="product_images">
				<?php
				$gallery = get_post_meta($post->ID, '_estate_image_gallery', TRUE);
				$gallery = array_filter(explode(',', $gallery));
				if (!empty($gallery)) {

					foreach ($gallery as $image) {
						?>
						<li data-id="<?php
						echo esc_attr($image); ?>">
							<?php
							echo wp_get_attachment_image($image) ?>
							<a class="close" href="#">&times;</a>
						</li>
					<?php
					}
				}
				?>
			</ul>
			<input type="hidden" id="estate_image_gallery" name="estate_image_gallery" value="<?php
			if (!empty($gallery)) echo esc_attr(implode(',', $gallery)); ?>"/>
		</div>
		<p class="gallery_commands">
			<a href="#" class="add_image_btn"><?php
				_e('Add image', PGL); ?></a>
			<!-- <a href="#" class="add_video_btn"><?php
		_e('Add video', PGL); ?></a> -->
		</p>
	<?php
	}

	/**
	 * ##############################################
	 * Add option to theme option panel
	 * ##############################################
	 */
	static function add_option_panel()
	{
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		/**
		 * Search settings
		 *
		 * @var array $search
		 */
		$search     = array(
			'id'         => 'search',
			'icon'       => 'search',
			'title'      => __( 'Estate search', PGL ),
			'desc'       => __( 'Search setting(s)', PGL ),
			'fields'     => array(
				array(
					'id' => 'estate_search_home',
					'title' => __('Show search form on homepage', PGL),
					'type'     => 'checkbox',
					'switch'   => TRUE,
					'std' => 1
				),
				array(
					'id' => 'estate_search_archive',
					'title' => __('Show search form on archive page', PGL),
					'type'     => 'checkbox',
					'switch'   => TRUE,
					'std' => 0
				),
				array(
					'id' => 'estate_search_result',
					'title' => __('Show search form on search result page', PGL),
					'type'     => 'checkbox',
					'switch'   => TRUE,
					'std' => 0
				),
				array(
					'id' => 'estate_search_map',
					'title' => __('Estate search map', PGL),
					'type'     => 'checkbox',
					'switch'   => TRUE,
					'desc' => __('Display map under search form', PGL),
					'std' => 0
				),
				array(
					'id' => 'estate_search_latlong',
					'title' => __('Centered map point(s)', PGL),
					'type' => 'text',
					'desc' => __('Latitude and Longitude, separated by semicolon (Example for London: 51.511214;-0.126160) click <a target="_blank" href="http://www.latlong.net/">here</a> to search', PGL),
					'std' => '51.511214;-0.126160'
				),
				array(
					'id' => 'estate_search_zoom',
					'title' => __('Map zoom level', PGL),
					'type'     => 'text',
					'validate'  => 'numeric',
					'desc' => __('Zoom level of display map', PGL),
					'std' => 12
				),
				array(
					'id' => 'estate_search_layout',
					'title' => __('Estate search layout', PGL),
					'type' => 'select',
					'options' => PGL_Utilities::list_template_file('templates/estate-loop', 'estate-loop'),
					'std' => 'estate-loop-default'
				),
				array(
					'id' => 'estate_searchable_fields',
					'title' => __('Searchable Fields (By default, we can perform searching by title & price)', PGL),
					'type' => 'multi_checkbox',
					'options' => array(
						'bathrooms' => __('Bathrooms', PGL),
						'bedrooms' => __('Bedrooms', PGL),
						'area' => __('Area', PGL)
					)
				),
				array(
					'id' => 'estate_searchable_field_sale_price_from',
					'title' => __('Price from for sale search', PGL),
					'type' => 'text',
					'desc' => __('Values are separated by semicolons (eg. 100;200;300)', PGL),
					'std' => ''
				),
				array(
					'id' => 'estate_searchable_field_sale_price_to',
					'title' => __('Price to for sale search', PGL),
					'type' => 'text',
					'desc' => __('Values are separated by semicolons (eg. 100;200;300)', PGL),
					'std' => ''
				),
				array(
					'id' => 'estate_searchable_field_rent_price_from',
					'title' => __('Price from for rental search', PGL),
					'type' => 'text',
					'desc' => __('Values are separated by semicolons (eg. 100;200;300)', PGL),
					'std' => ''
				),
				array(
					'id' => 'estate_searchable_field_rent_price_to',
					'title' => __('Price to for rental search', PGL),
					'type' => 'text',
					'desc' => __('Values are separated by semicolons (eg. 100;200;300)', PGL),
					'std' => ''
				),
			)
		);
		if ($searchable_fields = $pgl_options->option('estate_searchable_fields')) {

			foreach ($searchable_fields as $key => $val) {
				$search['fields'][] = array(
					'id' => 'estate_searchable_field_' . $key,
					'title' => __('Configure value for ' . ucfirst($key) . ' search'),
					'type' => 'text',
					'desc' => __('Values are separated by semicolons', PGL),
					'std' => '0'
				);
			}
		}
		$section = array(
			'id' => 'estate',
			'icon' => 'home',
			'title' => __('Estate Property', PGL),
			'desc' => __('Settings for estate custom post type', PGL),
			'fields' => array(
				array(
					'id' => 'estate_slug',
					'title' => __('Custom Estate Slug', PGL),
					'type' => 'text',
					'desc' => __('Change url for browsing, viewing estate (estate,listings,..)', PGL),
					'std' => 'estate',
				),
				array(
					'id' => 'estate_system_type',
					'title' => __('Estate system type', PGL),
					'type' => 'select',
					'options' => array('both' => __('Both Sale & Rental', PGL), 'sale' => __('Sale Only', PGL), 'rental' => __('Rental Only', PGL), 'showcase' => __('Showcase', PGL)),
					'std' => 'both'
				),
				array(
					'id' => 'estate_currency',
					'title' => __('Estate Currency', PGL),
					'type' => 'select',
					'options' => PGL_Utilities::get_currencies(),
					'std' => 'USD',
				),
                array(
                    'id' => 'estate_currency_placement',
                    'title' => __('Where to place currency symbol ? ', PGL),
                    'type' => 'select',
                    'options' => array(
                        'before' => __('Before the price', PGL),
                        'after' => __('After the price', PGL)
                    ),
                    'std' => 'before'
                ),
				array(
					'id' => 'estate_custom_currency',
					'title' => __('Estate Custom Currency Symbol', PGL),
					'type' => 'text',
					'std' => '$',
				),
                array(
                    'id'       => 'estate_price_decimal',
                    'title'    => __( 'Decimal price', PGL ),
                    'type'     => 'checkbox',
                    'desc'     => __( 'Estate price with decimals', PGL ),
                    'switch'   => TRUE,
                    'std'      => '1',
                ),
                array(
                    'id' => 'estate_thousand_sep',
                    'title' => __('Thousand Separator', PGL),
                    'type' => 'text',
                    'std' => '.',
                ),
                array(
                    'id' => 'estate_decimal_sep',
                    'title' => __('Decimal Separator', PGL),
                    'type' => 'text',
                    'std' => ',',
                ),
                array(
                    'id' => 'estate_decimal_num',
                    'title' => __('Number of Decimals', PGL),
                    'type' => 'text',
                    'std' => '2',
                    'sub_desc' => __('Number of decimals show in price, default is "2"',PGL)
                ),
				array(
					'id' => 'estate_sale_price_suffix',
					'title' => __('Sale price\'s suffix ', PGL),
					'type' => 'text',
					'std' => '',
					'desc' => ''
				),
				array(
					'id' => 'estate_rent_price_suffix',
					'title' => __('Rental price \'s suffix ', PGL),
					'type' => 'text',
					'std' => '',
					'sub_desc' => 'You can set suffix for rental price here. For example: 100$ <strong>per month</strong>'
				),
				array(
					'id' => 'estate_no_price_text',
					'title' => __('No price text', PGL),
					'sub_desc' => __('Text displayed when you leave the price field empty', PGL),
					'type' => 'text',
					'std' => __('Contact for price', PGL)
				),
				array(
					'id' => 'estate_area_unit',
					'title' => __('Area unit', PGL),
					'type' => 'text',
					'std' => ''
				),
				array(
					'id' => 'estate_list_layout',
					'title' => __('Estate list layout', PGL),
					'type' => 'select',
					'options' => PGL_Utilities::list_template_file('templates/estate-loop', 'estate-loop'),
					'std' => 'estate-loop-default'
				),

				array(
					'id' => 'number_of_estate',
					'title' => __('How many estates are displayed per page ?', PGL),
					'type' => 'text',
					'std' => 5
				),
				array(
					'id' => 'estate_single_layout',
					'title' => __('Estate Single Layout', PGL),
					'type' => 'select',
					'options' => PGL_Utilities::list_template_file('templates/estate-single'),
					'std' => 'estate-single-default'
				),
				array(
					'id' => 'estate_image_fields',
					'title' => __('Create icon fields', PGL),
					'callback' => array('PGL_Addon_Estate', 'create_image_fields')
				)
			)
		);
		$pgl_options->add_section($section, 'addons');
		$pgl_options->add_section($search, 'search');
	}

	static function create_image_fields($field, $value)
	{
		global $pgl_options;
		wp_enqueue_script('estate-image-field', PGL_URI_JS . 'estate/image_fields.js', array('jquery'));
		?>
		<div class="estate_image_field_wrapper">
			<div class="actionbar">
				<button id="add_image_field" type="button" class="button"><?php _e('Add image field', PGL);?></button>
				<input type="hidden" id="id_field"
					   value="<?php echo $pgl_options->THEME_OPTION . '[' . $field['id'] . ']'; ?>"/>
			</div>
			<div class="fields">
				<table id="image_field_tbl" class="table">
					<?php
					if (isset( $value ) && !empty($value)) {
						$i = 0;
						foreach ($value as $v) {
							list($image) = wp_get_attachment_image_src($v['id']);
							?>
							<tr>
								<td>
									<input type="hidden"
										   name="<?php echo $pgl_options->THEME_OPTION . '[' . $field['id'] . '][' . $i . '][id]' ?>"
										   value="<?php echo $v['id']; ?>"/><img src="<?php echo $image; ?>" alt=""/>
								</td>
								<td>
									<input type="text"
										   name="<?php echo $pgl_options->THEME_OPTION . '[' . $field['id'] . '][' . $i . '][label]' ?>"
										   value="<?php echo $v['label']; ?>"/>
								</td>
								<td>
									<input type="button" value="Remove" class="removeRowBtn"/>
								</td>
							</tr>
						<?php
							$i++;
						}
					}
					?>
				</table>
			</div>
		</div>
	<?php
	}

	static function estate_list_shortcode($atts)
	{
		extract(shortcode_atts(array(
			'display' => 'grid',
			'filter' => 1,
			'count' => 6,
			'column' => 3,
			'total_col' => 12,
			'agent_id' => '',
			'agent_slug' => '',
			'location_id' => '',
			'type_id' => '',
			'type_slug' => '',
			'acs' => '',
			'pager' => false
		), $atts));
		/**
		 * @var $display
		 * @var $filter
		 * @var $count
		 * @var $column
		 * @var $total_col
		 * @var $agent_id
		 * @var $agent_slug
		 * @var $location_id
		 * @var $type_id
		 * @var $type_slug
		 * @var $acs
		 * @var $pager
		 */
		$args = array(
			'posts_per_page' => $count,
			'meta_query' => array(),
			'tax_query' => array()
		);
		if ($agent_id) {
			$args['meta_query'][] = array(
				'key' => 'agent_id',
				'value' => explode(',', $agent_id),
				'compare' => 'IN'
			);
		}elseif($agent_slug){
			$agents = get_posts(array('post_type'=>'estate_agent','name'=>$agent_slug));
			if(count($agents)){
				$args['meta_query'][] = array(
					'key' => 'agent_id',
					'value' => explode(',', $agents[0]->ID),
					'compare' => 'IN'
				);
			}
		}
		if ($location_id) {
			$args['tax_query'][] = array(
				'taxonomy' => 'estate-location',
				'field' => 'id',
				'terms' => explode(',', $location_id),
			);
		}
		if ($type_id) {
			$args['tax_query'][] = array(
				'taxonomy' => 'estate-type',
				'field' => 'id',
				'terms' => explode(',', $type_id),
			);
		}elseif($type_slug){
			$args['tax_query'][] = array(
				'taxonomy' => 'estate-type',
				'field' => 'slug',
				'terms' => $type_slug
			);
			$type_id = $type_slug;
		}
		if (count($args['meta_query']) > 2) {
			$args['tax_query']['relation'] = 'AND';
		}
		$output_html = null;
		if ($display == 'grid') {
			$output_html = self::estate_grid($args, $filter, $type_id, $column, $total_col, $pager, NULL, $acs);
		} else if ($display == 'list') {
			$output_html = self::estate_list($args, $type_id, $pager, NULL, $acs);
		}
		return $output_html;
	}

	static function estate_grid($args = array(), $show_filter = TRUE, $type = null, $column = 3, $total_span = 12, $pager = FALSE, $the_query = NULL, $acs_group = '')
	{
		global $paged;
		$paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');
		if ( get_query_var('page') ) $paged = get_query_var('page');
		if (is_null($the_query)) {
			$defaults = array(
				'posts_per_page' => 9,
				'post_type' => 'estate',
				'meta_query' => array(),
				'tax_query' => array()
			);
			if(1!=$paged){
				$args['paged'] = $paged;
			}
			$params = wp_parse_args($args, $defaults);
			if ($acs_group) {
				$the_query = add_acs_query($acs_group, $params);
			} else
				$the_query = new WP_Query($params);
		}
		if ($the_query->have_posts()) {
			$htmlOut = null;
			wp_enqueue_script('jquery-mixitup', PGL_URI_JS . 'mixitup/jquery.mixitup.min.js', array(
				'jquery'
			), '2.0', TRUE);

			$estate_list_html = '';
			$taxonomies_list = array();
			$extract_func = create_function('$obj', 'return $obj->slug;');
			$extract_name = create_function('$obj', 'return $obj->name;');
			$item_span = ceil($total_span / $column);
			$count = 0;
			while ($the_query->have_posts()) {
				$count++;
				$the_query->the_post();
				$the_id = get_the_ID();
				$taxonomies = get_the_terms($the_id, 'estate-type');
				if ($taxonomies) {
					$taxonomies_list = $taxonomies_list + $taxonomies;
					$taxonomy_slugs = array_map($extract_func, $taxonomies);
				} else {
					$taxonomy_slugs = array();
				}



				$purpose = get_post_meta($the_id, 'estate_purpose', TRUE);
				$status = get_post_meta($the_id, 'estate_status', TRUE);
				$status_span = '';
				if($status){
					if($purpose == 'sale'){
						$status_span = '<span class="status">'.__('Sold', PGL).'</span>';
					}elseif($purpose == 'rent'){
						$status_span = '<span class="status">'.__('Rented', PGL).'</span>';
					}
				}

				$types = explode(',',get_the_term_list( $the_id, 'estate-type', '', ',' ));
				$typeHtml = '';
				$tipHtml = null;
				$typeLbl = __( 'Type', PGL );
				if(!$show_filter && !$type){
					$typeHtml .= <<<HTML
				<div class="col-md-12 col-sm-12">
                    <span class="line-top">
                        {$typeLbl}:
                        <span class="pull-right">
HTML;
					if(count($types)>3){
						for($i=0; $i<3; $i++){
							$typeHtml .= $types[$i];
							if($i<2) $typeHtml .= ', ';
						}
						$count = 0;
						for($i=3; $i<count($types); $i++){
							$count++;
							$tipHtml .= $types[$i];
						}
						$typeHtml .= <<<HTML
	<span class="more-type"><a href="javascript:void(0)" class="type-popover" data-toggle="popover" data-placement="left" data-container="body" data-content='{$tipHtml}' data-html="true">{$count}+</a></span>
HTML;
					}else{
						$typeHtml .= get_the_term_list( $the_id, 'estate-type', '', ', ' );
					}
				$typeHtml .= <<<HTML
						</span>
					</span>
				</div>
HTML;
				}
				$params = array(
					'thumb' => self::get_estate_thumbnail($the_id, 'estate-respond-thumbnail'),
					'html' => apply_filters('estate/list/fields', ''),
					'link' => get_permalink($the_id),
					'title' => get_the_title($the_id),
					'price' => PGL_Addon_Estate::format_price(get_post_meta($the_id, 'estate_price', TRUE), get_post_meta($the_id, 'estate_purpose', TRUE)),
					'default_fields' => PGL_Addon_Estate::display_default_fields($the_id, 12),
					'filters' => implode(' ', $taxonomy_slugs),
					'status_span' => $status_span,
					'item_span' => $item_span,
					'typeHtml'  => $typeHtml
				);
				$estate_list_html .= PGL_Utilities::get_include_contents('templates/item/grid.php', $params);
			}
			wp_reset_postdata();
			$filterClass = ($show_filter)? ' filter-active' : '';
			$filterOn = ($show_filter)? ' filter-on' : '';
			$htmlJs = '';
			$pagerHtml = '';
			if ($pager) {
				$pagination_links = PGL_pagination(array(
					'next_text' => '<i class="fa fa-angle-right"></i>',
					'prev_text' => '<i class="fa fa-angle-left"></i>',
				), $the_query);
				$pagerHtml .= <<<HTML
				<div class="page-ination onleft">
					<div class="page-in">
						<ul class="pager">
HTML;
							if ($pagination_links) {
								foreach ($pagination_links as $link){
									$pagerHtml .= <<<HTML
<li>{$link}</li>
HTML;

								}
							}
				$pagerHtml .= <<<HTML
						</ul>
					</div>
				</div>
HTML;
			}
			if ($show_filter) {
				$htmlJs = <<<HTML
				<script type="text/javascript">
					jQuery(function($){
						var mixList = $('#able-list');
						var listFil = $('#able-filter');
						var seleFil = $('#able-select');
						$(window).load(function(){

							mixList.mixitup({
								effects: ["fade","blur"],
								onMixLoad: function(){
									mixList.masonry({
									    columnWidth: ".grid-sizer",
										itemSelector: ".mix",
										transitionDuration: 0
									})
								},
								onMixEnd: function(){
									mixList.data('masonry').layout();
									data = listFil.find("a.active").first().data("filter");
									seleFil.val(data);
								}
							});
						});
						seleFil.change(function(){
							mixList.mixitup("remix",seleFil.val());
						});
						$(window).resize(function(){
							data = listFil.find("a.active").first().data("filter");
							if(seleFil.is(":visible")){
								data=seleFil.val();
							}
							mixList.mixitup("remix",data);
						});
						$('.type-popover').popover({html:true});
						$('.has-tooltip').tooltip();
					});
				</script>
HTML;
			}else{
				$htmlJs = <<<HTML
				<script type="text/javascript">
					jQuery(function($){
						var mixList = $('#able-list');
						$(window).load(function(){
							mixList.mixitup({
								effects: ["fade","blur"],
								onMixLoad: function(){
									mixList.masonry({
										columnWidth: ".grid-sizer",
										itemSelector: '.mix',
										transitionDuration: 0,
										isResizeBound: false
									})
								},
								onMixEnd: function(){
									mixList.data('masonry').layout();
								}
							});
						});
						$(window).resize(function(){
							mixList.mixitup("remix","all");
						});
						$('.type-popover').popover({html:true});
						$('.has-tooltip').tooltip();
					});
				</script>
HTML;
			}
			$headText = __('Properties', PGL);
			$headClass = 'grid-title';
			if($type){
				if(is_numeric($type)){
					$term = get_term_by('id', $type, 'estate-type');
					$headText = $term->name;
				}else{
					$term = get_term_by('slug', $type, 'estate-type');
					$headText = $term->name;
				}
			}elseif($post = get_post()){
				if($post->post_type=='estate_agent'){
					$headText = __('Agent\'s Properties', PGL);
					$headClass = 'agent-estate';
				}

			}
			$htmlOut = <<<HTML
			<div class="properties">
				<div id="property-list" class="{$filterClass}">
					<h3 class="{$headClass}">{$headText}</h3>
HTML;
			if($show_filter){
				$label = __('All', PGL);
				$selectHtml = null;
				$htmlOut .= <<<HTML
					<div class="filter-pro clearfix">
						<div class="row">
							<div class="col-md-12">
								<div id="able-filter" class="filter-options">
									<a href="javascript:void(0)" data-filter="all" class="filter active">{$label}</a>
HTML;
				if (!empty($taxonomies_list)) {
					foreach ($taxonomies_list as $tax) {
						$htmlOut .= <<<HTML
<a class="filter" href="javascript:void(0)" data-filter="{$tax->slug}">{$tax->name}</a>
HTML;
						$selectHtml .= <<<HTML
<option value="{$tax->slug}">{$tax->name}</option>
HTML;
					}
				}
				$htmlOut .= <<<HTML
								</div>
							</div>
							<div class="col-sm-12 visible-xs">
								<select class="form-control" id="able-select">
									<option class="active" value="all">{$label}</option>
									{$selectHtml}
								</select>
							</div>
						</div>
					</div>
HTML;
			}
			$htmlOut .= <<<HTML
                    <div class="row products{$filterOn}" id="able-list">
                        <div class="col-md-{$item_span} col-sm-6 col-xs-12 grid-sizer"></div>
                        {$estate_list_html}

                    </div>
					{$htmlJs}
					{$pagerHtml}
				</div>
			</div>
HTML;
			if ($acs_group) {
				reset_query_from_acs();
			}
			return $htmlOut;
		} else {
			//well, if there's no post, let's add some and comeback
		}
	}

	static function get_estate_thumbnail($id, $size = 'estate-detail-thumbnail', $echo = FALSE)
	{

		$thumbnail_id = get_post_meta($id, '_thumbnail_id', TRUE);
		if ($thumbnail_id) {
			list($thumbnail_url) = wp_get_attachment_image_src($thumbnail_id, PGL_Image::_size($size));
		} else {
			$thumbnail_url = get_post_meta($id, 'estate_featured_video_thumbnail_url', TRUE);
			if (!$thumbnail_url)
				return '';
		}
		$size_info = PGL_Image::size($size);
		$img = '<img src="' . $thumbnail_url . '"  />';
		if ($echo) {
			echo $img;
		} else {

			return $img;
		}
	}

	/**
	 * ##############################################
	 * Utility functions
	 * ##############################################
	 */
	static function format_price($price = '', $price_type = NULL, $for_range = false)
	{
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
        $suffix = '';
        $tsep = $pgl_options->option('estate_thousand_sep');
        $dsep = $pgl_options->option('estate_decimal_sep');
        $decs = $pgl_options->option('estate_decimal_num');
        if(!$pgl_options->option('estate_price_decimal')){
            $decs = 0;
        }
        $pos = $pgl_options->option('estate_currency_placement');
		if (!$price) {
			$no_price_text = $pgl_options->option('estate_no_price_text');
			return apply_filters('estate/format_price/noprice', $no_price_text);
		} else {
			$symbol = PGL_Utilities::get_currency_symbol($pgl_options->option('estate_currency'));
			if (!is_null($price_type) && in_array($price_type, array('sale','rent'))) {
				$suffix = '<span class="suffix"> ' . $pgl_options->option("estate_{$price_type}_price_suffix"). '</span>';
			}
            $price = number_format((float)$price, $decs, $dsep, $tsep);
			if($for_range){
                return apply_filters('estate/format_price', (($pos == 'before') ? $symbol . ' ' . $price : $price . ' ' . $symbol) . $suffix);
            }else{
                return apply_filters('estate/format_price', (($pos == 'before') ? '<span class="symbol">'. $symbol . '</span> <span class="price-value">' . $price . '</span>' : '<span class="price-value">' . $price . '</span> <span class="symbol">' . $symbol . '</span>') . $suffix);
            }
		}
	}

	/**
	 * Display core extra fields (area, bathrooms, bedrooms)
	 *
	 * @param string $id
	 *
	 * @internal param string $before_list
	 * @internal param string $after_list
	 *
	 * @return string
	 */
	static function display_default_fields($id = '', $col = 6)
	{
		if (!$id) {
			$id = get_the_ID();
		}
		$html = '';
		$haveRoom = false;
		$bathrooms = get_post_meta($id, 'estate_bathrooms', TRUE);
		$bedrooms = get_post_meta($id, 'estate_bedrooms', TRUE);
		if($bathrooms || $bedrooms){
			$haveRoom = true;
			$html .= '<div class="col-md-'.$col.' col-sm-'.$col.'"><span class="line-top">'.__('Room(s)', PGL).'<span class="pull-right">';
		}
		if (is_numeric($bathrooms) && $bathrooms >= 0) $html .= sprintf( _n( '%d bath', '%d baths', $bathrooms, PGL ), $bathrooms );
		if ($bathrooms && $bedrooms) $html .= ', ';
		if (is_numeric($bedrooms) && $bedrooms >= 0) $html .= sprintf( _n( '%d bed', '%d beds', $bedrooms, PGL ), $bedrooms );
		if($haveRoom){
			$html .= '</span></span></div>';
		}
		$area = get_post_meta($id, 'estate_area', TRUE);
		if (is_numeric($area) && $area >= 0) $html .= '<div class="col-md-'.$col.' col-sm-'.$col.'"><span class="line-top">' . __('Area', PGL) . '<span> ' . self::format_area($area) . '</span></span></div>';

		$icon_fields = json_decode(get_post_meta($id, 'estate_icon', TRUE), true);
		if (!empty($icon_fields)) {
			$tmp = '';
			foreach (array_keys($icon_fields) as $key) {
				$key = explode('_', $key);
				$id = array_shift($key);
				$title = ucfirst(implode(' ', $key));
				$tmp .= '<span class="pull-right more-type"><a href="javascript:void(0)" class="has-tooltip" title="' . $title . '">' . wp_get_attachment_image($id,'PGL_estate-icon') . '</a></span>';
			}
			$html .= '<div class="col-md-'.$col.' col-sm-'.$col.'"><span class="line-top">'.__('Characteristics', PGL) . $tmp . '</span></div>';
		}

		return apply_filters('estate/list/display_default_field', $html);
	}

	static function format_area($area = 0)
	{
		global $pgl_options;
		$unit = $pgl_options->option('estate_area_unit');

		return apply_filters('estate/format_area', $area .' '. $unit);
	}

	static function estate_list($args = array(), $type = false, $pager = FALSE, $the_query = NULL, $acs_group = '')
	{
		global $paged;
		$paged = 1;
		if ( get_query_var('paged') ) $paged = get_query_var('paged');
		if ( get_query_var('page') ) $paged = get_query_var('page');
		global $pgl_options;
		if (is_null($the_query)) {
			$defaults = array(
				'posts_per_page' => 9,
				'post_type' => 'estate',
				'meta_query' => array(),
				'tax_query' => array()
			);
			if(1!=$paged){
				$args['paged'] = $paged;
			}
			$params = wp_parse_args($args, $defaults);
			if ($acs_group) {
				$the_query = add_acs_query($acs_group, $params);
			} else
				$the_query = new WP_Query($params);
		}
		$isShowCase = false;
		$purpose =  $pgl_options->option('estate_system_type');
		if($purpose=='showcase'){
			$isShowCase = true;
		}
		$headText = __('Properties', PGL);
		$headClass = 'grid-title';
		if($type){
			if(is_numeric($type)){
				$term = get_term_by('id', $type, 'estate-type');
				$headText = $term->name;
			}else{
				$term = get_term_by('slug', $type, 'estate-type');
				$headText = $term->name;
			}
		}elseif($post = get_post()){
			if($post->post_type=='estate_agent'){
				$headText = __('Agent\'s Properties', PGL);
				$headClass = 'agent-estate';
			}

		}
		$html = '';
		if ($the_query->have_posts()) {
			$html .= <<<HTML
	<div class="grid_full_width">
		<div class="row">
			<div class="products grid_list_product">
				<div class="col-md-12"><h3 class="{$headClass}">{$headText}</h3></div>
HTML;
			while ($the_query->have_posts()) {
				$the_query->the_post();
				$status = get_post_meta(get_the_ID(), 'estate_status', TRUE);
				$purpose = get_post_meta(get_the_ID(), 'estate_purpose', TRUE);
				$purpose_span = '';
				$title = get_the_title();
				$excerpt = PGL_Addon_Estate::the_excerpt(false);
				$link = get_permalink(get_the_ID());
				$thumb = PGL_Addon_Estate::get_estate_thumbnail( get_the_ID(), 'estate-respond-thumbnail', false );
				$price = PGL_Addon_Estate::format_price( get_post_meta( get_the_ID(), 'estate_price', TRUE ) );
				$default_fields = PGL_Addon_Estate::display_default_fields( get_the_ID(), 12 );
				$default_fields = apply_filters( 'estate/list/fields', $default_fields );
				if(!$isShowCase){
					$purpose_span_content = '<span>'.__( 'Purpose', PGL ).'<span>';
					$purpose_span_content .= get_post_meta( get_the_ID(), 'estate_purpose', TRUE )=="sale"?__('Sale', PGL):__('Rent', PGL);
					$purpose_span_content .= '</span></span>';
					$purpose_span .= <<<HTML
					<div class="col-md-12 col-sm-12">
						{$purpose_span_content}
					</div>
HTML;
				}
				$status_span = '';
				if($status){
					$status_span .= '<span class="status">';
					$status_span .= ($purpose == 'sale')?__('Sold', PGL):__('Rented', PGL);
					$status_span .= '</span>';
				}
				$types = explode(',',get_the_term_list( get_the_ID(), 'estate-type', '', ',' ));
				$typeHtml = '';
				$tipHtml = null;
				$typeLbl = __( 'Type', PGL );
				$typeHtml .= <<<HTML
				<div class="col-md-12 col-sm-12">
                    <span class="line-top">
                        {$typeLbl}:
                        <span class="pull-right">
HTML;
							if(count($types)>3){
								for($i=0; $i<3; $i++){
									$typeHtml .= $types[$i];
									if($i<2) $typeHtml .= ', ';
								}
								$count = 0;
								for($i=3; $i<count($types); $i++){
									$count++;
									$tipHtml .= $types[$i];
								}
								$typeHtml .= <<<HTML
<span class="more-type"><a href="javascript:void(0)" class="type-popover" data-toggle="popover" data-placement="left" data-container="body" data-content='{$tipHtml}' data-html="true">{$count}+</a></span>
HTML;
							}else{
								$typeHtml .= get_the_term_list( get_the_ID(), 'estate-type', '', ', ' );
							}
							$typeHtml .= <<<HTML
						</span>
					</span>
				</div>
HTML;
				$html .= <<<HTML
							<div class="col-md-12 property col-sm-12">
								<div class="product-item">
									<div class="row">
										<div class="table-row">
											<div class="col-md-4 col-sm-4 image-container">
												<div class="imagewrapper">
													<a href="{$link}">
														{$thumb}
													</a>
													<div class="label-hanger">
														<span class="price">{$price}</span>
														{$status_span}
													</div>
												</div>
											</div>
											<div class="col-md-8 col-sm-8 estate-data">
												<div class="list-right-info">
													<div class="row">
														<div class="col-md-6 col-sm-7">
															<h3>
																<a href="{$link}">{$title}</a>
															</h3>
															<p class="excerpt">{$excerpt}</p>
														</div>
														<div class="col-md-6 col-sm-5">
															<div class="title-info row">
																{$purpose_span}
																{$typeHtml}
																{$default_fields}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
HTML;
						}
						if ($acs_group) {
							reset_query_from_acs();
						}
					}
$html .= <<<HTML
			</div>
		</div>
	</div>
		<script type="text/javascript">
		jQuery(function($){
			$('.type-popover').popover({html:true})
		});
		</script>
HTML;
		$pagerHtml = '';
		if ($pager) {
			$pagination_links = PGL_pagination(array(
				'next_text' => '<i class="fa fa-angle-right"></i>',
				'prev_text' => '<i class="fa fa-angle-left"></i>',
			), $the_query);

			if ($pagination_links) {
				$pagerHtml .= <<<HTML
				<div class="page-ination onleft">
					<div class="page-in">
						<ul class="pager">
HTML;
				foreach ($pagination_links as $link){
					$pagerHtml .= <<<HTML
<li>{$link}</li>
HTML;

				}
				$pagerHtml .= <<<HTML
						</ul>
					</div>
				</div>
HTML;
			}

		}
		$html .= $pagerHtml;
		return $html;
	}

	/**
	 * Display the excerpt for estate custom post type
	 */
	static function the_excerpt($echo = TRUE)
	{
		$excerpt = apply_filters('estate_the_excerpt', get_the_excerpt());
		if ($echo) {
			echo esc_html($excerpt);

			return '';
		} else
			return $excerpt;
	}

	static function estate_search_shortcode($atts)
	{
		ob_start();
		self::estate_search();
		$result = ob_get_clean();
		return $result;
	}
	static function cord_cal($post_id = null){
		$post_id = ($post_id) ? $post_id : get_the_ID();
		$ray = false;
		$cord = get_post_meta($post_id, 'estate_coordinates', TRUE);
		if($cord){
			$cord = explode(',', $cord);
		}
		if(count($cord)==2){
			$ray = array(
				'id' => $post_id,
				'title' => get_the_title($post_id),
				'img' => get_the_post_thumbnail($post_id, 'PGL_estate-grid-view-3-column-thumbnail'),
				'url' => esc_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ),
				'lat'=> $cord[0],
				'lng'=> $cord[1]
			);
			return $ray;
		}
		return $ray;
	}
	static function estate_search()
	{
		global $pgl_options;
		$isMapOn = $pgl_options->option('estate_search_map');
		$map_js = null;
		if ($isMapOn) {
			wp_register_script('google-map', '//maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '3.0', false);
			wp_enqueue_script('google-map');
			$json = array();
			$json['err'] = false;
			$latlong = array(51.511214, -0.126160);
			$latlongCfg = $pgl_options->option('estate_search_latlong');
            $zoomCfg = $pgl_options->option('estate_search_zoom')?$pgl_options->option('estate_search_zoom'):14;
			if($latlongCfg )
			$latlong = explode(';',$latlongCfg);
			if(is_search()){
				if(have_posts()){
					$found = false;
					while(have_posts()){
						the_post();
						$ray = self::cord_cal(get_the_ID());
						if($ray){
							if(!$found && $ray['lat']){
								$latlong = array($ray['lat'],$ray['lng']);
								$found = true;
							}
							$json['posts'][] = $ray;
						}
					}

				}
			}else{
				$posts = get_posts(array(
					'offset' => 0,
					'post_type' => 'estate',
					'nopaging'  => 1
				));
				if ($posts) {
					foreach ($posts as $post) {
						$ray = self::cord_cal($post->ID);
						if($ray)
							$json['posts'][] = $ray;
					}
				}
			}
			$json = json_encode($json);
			$map_js = <<<HTML
<script type="text/javascript">
  function initialize() {
	var mapOptions = {
	  center: new google.maps.LatLng({$latlong[0]}, {$latlong[1]}),
	  zoom: {$zoomCfg},
	  scrollwheel: 0,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	  panControl: false,
	  zoomControlOptions: {
        style: google.maps.ZoomControlStyle.SMALL
      }
	};
	var map = new google.maps.Map(document.getElementById("search-map-canvas"),
		mapOptions);
	var json = {$json};
	var activeWin;
	if(json.posts){
		jQuery.each(json.posts, function(key, data){
			var latLng = new google.maps.LatLng(data.lat, data.lng);
	        var marker = new google.maps.Marker({
	            map: map,
	            position: latLng,
	            title: data.title
	        });
	        var infWin = new google.maps.InfoWindow({
	            content: createWin(data),
	            maxWidth: 300
	        });
	        google.maps.event.addListener(marker,"click",function(){
	        	if(activeWin)
	        		activeWin.close();
	            infWin.open(map, marker);
	            activeWin = infWin;
	        });
		});
	}
	function createWin(data){
		lo = '<a class="info-link" href="'+data.url+'" title="'+data.title+'">'; lc = '</a>'
		html = '<div style="width:300px; height:200px">'+lo+data.img+lc+'</div>';
		html += lo+data.title+lc;
		return html;
	}
  }
  jQuery(document).ready(function($){
	google.maps.event.addDomListener(window, 'load', initialize);
  });
</script>
HTML;

		}
		$terms_1 = get_terms('estate-type'); //search by category
		$term1_html = '';
		if (!empty($terms_1)) {
			$s_term = isset($_GET['term']) ? $_GET['term'] : '';
			foreach ($terms_1 as $term) {
				$term1_html .= '<option value="' . $term->slug . '" ' . ($term->slug == $s_term ? 'selected' : '') . '>' . $term->name . '</option>';
			}
		}
		$term_2 = get_terms('estate-location'); //search by location
		$term2_html = '';
		if (!empty($term_2)) {
			$s_term = isset($_GET['location']) ? $_GET['location'] : '';
			foreach ($term_2 as $term) {
				$term2_html .= '<option value="' . $term->slug . '" ' . ($term->slug == $s_term ? 'selected' : '') . '>' . $term->name . '</option>';
			}
		}
		?>
		<div class="search-container<?php if($isMapOn){?> map-on<?php }else{?> map-off<?php }?> clearfix">
		<?php if($isMapOn):?>
		<div id="search-map-canvas"></div>
		<?php endif;?>
		<?php $sType = $pgl_options->option('estate_system_type'); ?>
		<?php $purpose = isset($_GET['purpose']) && $_GET['purpose'] ? trim($_GET['purpose']) : 'sale';?>
		<div id="findtabber" class="find tabberlive">
			<div class="container">
				<ul class="nav nav-tabs tabbernav">
					<?php if($sType == 'both' || $sType == 'sale'):?>
					<li<?php if($purpose == 'sale' || $sType == 'sale'):?> class="active"<?php endif;?>>
						<a href="#sale" data-toggle="tab">
							<?php _e('For sale', PGL); ?>
						</a>
					</li>
					<?php endif;?>
					<?php if($sType == 'both' || $sType == 'rental'):?>
					<li<?php if($purpose == 'rent' || $sType == 'rental'):?> class="active"<?php endif;?>>
						<a href="#rent" data-toggle="tab">
							<?php _e('For rent', PGL); ?>
						</a>
					</li>
					<?php elseif($sType=='showcase'):?>
					<li class="active">
						<a href="#showcase" data-toggle="tab">
							<?php _e('Search for estate', PGL); ?>
						</a>
					</li>
					<?php endif;?>
				</ul>
				<div class="tab-content">
						<?php if ($sType == 'both' || $sType == 'sale'): ?>
						<div class="tab-pane<?php if($purpose == 'sale' || $sType == 'sale'):?> active<?php endif;?>" id="sale">
							<div class="row">
								<form action="<?php echo get_home_url() ?>">
                                    <input type="hidden" name="s" />
									<input type="hidden" name="purpose" value="sale" />
									<input type="hidden" name="search" value="1" />
									<input type="hidden" name="post_type" value="estate" />
									<?php
									$sale_html_array = array();
									if ($term2_html) {
										$label = __('Select location', PGL);
										$sale_html_array[] .= <<<HTML
	<div class="col-md-3 col-sm-3">
	<select name="location" class="form-control">
		<option value="" selected>{$label}</option>
		{$term2_html}
	</select>
	</div>
HTML;
									}

									do_action('estate/search_field/before_default_fields_listing');
									$price_range['from'] = $pgl_options->option('estate_searchable_field_sale_price_from');
									$price_range['to'] = $pgl_options->option('estate_searchable_field_sale_price_to');
									if (!empty($price_range)) {
										$label = array( 'from' => __('Price from', PGL), 'to' => __('Price to', PGL));
										$col_class = (!empty($price_range['from'])&&!empty($price_range['to']))?'two-fields':'one-field';
										$html = '<div class="col-md-3 col-sm-3 '.$col_class.'">';
										foreach($price_range as $k => $value){
											if(!empty($value)):
												$html .= '<select name="price_'.$k.'" class="form-control price-range price-'.$k.'">';
												$prices = explode(';', $value);
												$price_query = isset($_GET['price_'.$k]) ? $_GET['price_'.$k] : null;
												if($price_query){
													$html .= '<option value="">'.$label[$k].'</option>';
												}else{
													$html .= '<option value="" selected>'.$label[$k].'</option>';
												}
												foreach ($prices as $price) {
													if ($price) {
														$html .= '<option value="' . ($price) . '" ' . ($price == $price_query ? 'selected' : '') . '>' . PGL_Addon_Estate::format_price($price, null, true) . '</option>';
													}
												}
												$html .= '</select>';
											endif;
										}
										$html .= '</div>';
										$sale_html_array[] = $html;
									}

									$searchable_fields = $pgl_options->option('estate_searchable_fields');
									if (!empty($searchable_fields)) {
										$sale_html_array = array_merge($sale_html_array, self::display_default_search_fields($searchable_fields, FALSE));
									}

									$sale_html_array = apply_filters('estate/search_field/after_default_fields_listing', $sale_html_array, 'search_form');

									if ($term1_html) {
										$label = __('Select type', PGL);
										$sale_html_array[] = <<<HTML
	<div class="col-md-3 col-sm-3">
	<select name="term" class="form-control">
		<option value="" selected>{$label}</option>
		{$term1_html}
	</select>
	</div>
HTML;
									}
									$label = __('Search', PGL);
									$sale_html_array[] = <<<HTML
	<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
	<button class="search" type="submit" id="searchsubmit">{$label}</button>
	</div>
HTML;
									foreach ($sale_html_array as $part) {
										echo $part;
									}
									?>
								</form>
							</div>
						</div>
						<?php endif; ?>
						<?php if ($sType == 'both' || $sType == 'rental'): ?>
							<!-- Rent purpose -->
							<div class="tab-pane<?php if($purpose == 'rent' || $sType == 'rental'):?> active<?php endif;?>" id="rent">
								<div class="row">
								<form action="<?php echo get_home_url() ?>">
                                    <input type="hidden" name="s" />
                                    <input type="hidden" name="purpose" value="rent" />
									<input type="hidden" name="search" value="1" />
									<input type="hidden" name="post_type" value="estate" />
									<?php
									$rent_html_array = array();
									if ($term2_html) {
										$label = __('Select location', PGL);
										$rent_html_array[] .= <<<HTML
<div class="col-md-3 col-sm-3">
	<select name="location" class="form-control">
		<option value="" selected>{$label}</option>
		{$term2_html}
	</select>
</div>
HTML;
									}
									?>
									<?php
									do_action('estate/search_field/before_default_fields_listing');
									$price_range['from'] = $pgl_options->option('estate_searchable_field_rent_price_from');
									$price_range['to'] = $pgl_options->option('estate_searchable_field_rent_price_to');
									if (!empty($price_range)) {
										$label = array( 'from' => __('Price from', PGL), 'to' => __('Price to', PGL));
										$col_class = (!empty($price_range['from'])&&!empty($price_range['to']))?'two-fields':'one-field';
										$html = '<div class="col-md-3 col-sm-3 '.$col_class.'">';
										foreach($price_range as $k => $value){
											if(!empty($value)):
												$html .= '<select name="price_'.$k.'" class="form-control price-range price-'.$k.'">';
												$prices = explode(';', $value);
												$price_query = isset($_GET['price_'.$k]) ? $_GET['price_'.$k] : null;
												if($price_query){
													$html .= '<option value="">'.$label[$k].'</option>';
												}else{
													$html .= '<option value="" selected>'.$label[$k].'</option>';
												}
												foreach ($prices as $price) {
													if ($price) {
														$html .= '<option value="' . ($price) . '" ' . ($price == $price_query ? 'selected' : '') . '>' . PGL_Addon_Estate::format_price($price) . '</option>';
													}
												}
												$html .= '</select>';
											endif;
										}
										$html .= '</div>';
										$rent_html_array[] = $html;
									}
									$searchable_fields = $pgl_options->option('estate_searchable_fields');
									if (!empty($searchable_fields)) {
										$rent_html_array = array_merge($rent_html_array, self::display_default_search_fields($searchable_fields, FALSE));
									}

									$rent_html_array = apply_filters('estate/search_field/after_default_fields_listing', $rent_html_array, 'search_form');

									if ($term1_html) {
										$label = __('Select type', PGL);
										$rent_html_array[] = <<<HTML
<div class="col-md-3 col-sm-3">
	<select name="term" class="form-control">
		<option value="" selected>{$label}</option>
		{$term1_html}
	</select>
</div>
HTML;
									}
									$label = __('Search', PGL);
									$rent_html_array[] = <<<HTML
<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
	<button class="search" type="submit" id="searchsubmit">{$label}</button>
</div>
HTML;
									foreach ($rent_html_array as $part) {
										echo $part;
									}
									?>
								</form>
								</div>
							</div>
						<?php
						endif;
						?>
						<?php if ($sType == 'showcase'): ?>
							<!-- Showcase purpose -->
							<div class="tab-pane active">
								<div class="row">
								<form action="<?php echo get_home_url() ?>">
                                    <input type="hidden" name="s" />
                                    <input type="hidden" name="search" value="1" />
									<input type="hidden" name="post_type" value="estate" />
									<?php
									$rent_html_array = array();
									if ($term2_html) {
										$label = __('Select location', PGL);
										$rent_html_array[] .= <<<HTML
<div class="col-md-3 col-sm-3">
	<select name="location" id="term2" class="form-control">
		<option value="" selected>{$label}</option>
		{$term2_html}
	</select>
</div>
HTML;
									}
									?>
									<?php
									do_action('estate/search_field/before_default_fields_listing');
									$price_value = $pgl_options->option('estate_searchable_field_rent_price');
									if (!empty($price_value)) {
										$prices = explode(';', $price_value);
										$html_price_from = $html_price_to = '';
										$price_from = isset($_GET['price_from']) ? $_GET['price_from'] : '';

										foreach ($prices as $price) {
											if ($price) {
												$html_price_from .= '<option value="' . ($price) . '" ' . ($price == $price_from ? 'selected' : '') . '>' . PGL_Addon_Estate::format_price($price) . '</option>';
											}
										}
										$label = __('Price from', PGL);
										$rent_html_array[] = <<<HTML
<div class="col-md-3 col-sm-3">
	<select name="price_from" class="form-control">
		<option value="" selected>{$label}</option>
		{$html_price_from}
	</select>
</div>
HTML;
									}

									$searchable_fields = $pgl_options->option('estate_searchable_fields');
									if (!empty($searchable_fields)) {
										$rent_html_array = array_merge($rent_html_array, self::display_default_search_fields($searchable_fields, FALSE));
									}

									$rent_html_array = apply_filters('estate/search_field/after_default_fields_listing', $rent_html_array, 'search_form');

									if ($term1_html) {
										$label = __('Select type', PGL);
										$rent_html_array[] = <<<HTML
<div class="col-md-3 col-sm-3">
	<select name="term" class="form-control">
		<option value="" selected>{$label}</option>
		{$term1_html}
	</select>
</div>
HTML;
									}
									$label = __('Search', PGL);
									$rent_html_array[] = <<<HTML
<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
	<button class="search" type="submit" id="searchsubmit">{$label}</button>
</div>
HTML;
									foreach ($rent_html_array as $part) {
										echo $part;
									}
									?>
								</form>
								</div>
							</div>
						<?php
						endif;
						?>
				</div>
			</div>
		</div>
		<?php echo $map_js ?>
		</div>
	<?php
	}

	static function display_default_search_fields($searchable_fields, $echo = TRUE, $span_size = 3, $wrap = TRUE)
	{
		global $pgl_options;
		$return = array();
		if (isset($searchable_fields['bathrooms'])) {
			$bathrooms_search_values = $pgl_options->option('estate_searchable_field_bathrooms');
			if (!empty($bathrooms_search_values)) {
				$values = explode(';', $bathrooms_search_values);
				$bathrooms_value_from = isset($_GET['bathrooms_from']) ? $_GET['bathrooms_from'] : '';
				$bathroom_html_from = '';

				foreach ($values as $v) {
					if ($v) {
						$bathroom_html_from .= '<option value="' . ($v) . '" ' . ($bathrooms_value_from == $v ? 'selected' : '') . '>' . $v . '</option>';
					}
				}
				$return[] = ($wrap ? '<div class="col-md-' . $span_size . ' col-sm-'.$span_size.'">' : '') . '
						<select name="bathrooms_from" id="bathrooms_from" class="form-control">
							<option value="" selected>' . __('Bathrooms from', PGL) . '</option>
							' . $bathroom_html_from . '
						</select>
				' . ($wrap ? '</div>' : '');
			}
		}

		if (isset($searchable_fields['bedrooms'])) {
			$bedrooms_search_values = $pgl_options->option('estate_searchable_field_bedrooms');
			if (!empty($bedrooms_search_values)) {
				$values = explode(';', $bedrooms_search_values);
				$bedrooms_value_from = isset($_GET['bedrooms_from']) ? $_GET['bedrooms_from'] : '';
				$bedrooms_html_from = '';

				foreach ($values as $v) {
					if ($v) {
						$bedrooms_html_from .= '<option value="' . ($v) . '" ' . ($bedrooms_value_from == $v ? 'selected' : '') . '>' . $v . '</option>';
					}
				}
				$return[] = ($wrap ? '<div class="col-md-' . $span_size . ' col-sm-'.$span_size.'">' : '') . '
						<select name="bedrooms_from" id="bedrooms_from" class="form-control">
							<option value="" selected>' . __('Bedrooms from', PGL) . '</option>
							' . $bedrooms_html_from . '
						</select>
				' . ($wrap ? '</div>' : '');
			}
		}

		if (isset($searchable_fields['area'])) {
			$area_search_values = $pgl_options->option('estate_searchable_field_area');
			if (!empty($area_search_values)) {
				$values = explode(';', $area_search_values);
				$area_value_from = isset($_GET['area_from']) ? $_GET['area_from'] : '';
				$area_html_from = '';

				foreach ($values as $v) {
					if ($v) {
						$area_html_from .= '<option value="' . ($v) . '" ' . ($area_value_from == $v ? 'selected' : '') . '>' . $v . '</option>';
					}
				}
				$return[] = ($wrap ? '<div class="col-md-' . $span_size . ' col-sm-'.$span_size.'">' : '') . '
						<select name="area_from" id="area_from" class="form-control">
							<option value="" selected>' . __('Area from', PGL) . '</option>
							' . $area_html_from . '
						</select>
				' . ($wrap ? '</div>' : '');
			}
		}

		if ($echo) {
			echo implode('', $return);
		}

		return $return;
	}

	/**
	 * #############################################
	 * Filter
	 * #############################################
	 */
	static function __filter_the_excerpt($excerpt)
	{
		$len = 20;
		$num = $len + 1;
		$temp = explode(' ', $excerpt, $num);
		if (count($temp) >= $num) {
			array_pop($temp);
			$r = implode(' ', $temp);

			return $r . ' ...';
		}

		return implode(' ', $temp);
	}

	static function __filter_load_search_template($template)
	{
		global $wp_query;
		$search_template = locate_template('templates/estate-loop/estate-search.php');
		if ((is_search() && isset($_GET['post_type']) && trim($_GET['post_type']) == 'estate') || (is_post_type_archive('estate') && isset($_GET['search']))) {
			$wp_query->is_search = TRUE;

			return $search_template;
		} else {

			return $template;
		}
	}

	function add_default_options()
	{
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		if (!$pgl_options->option('estate_list_layout')) {
			$pgl_options->set_option('estate_list_layout', 'estate-loop-default');
			$pgl_options->set_option('estate_search_layout', 'estate-loop-default');
			$pgl_options->set_option('estate_single_layout', 'estate-single-default');
			$pgl_options->set_option('estate_currency', 'USD');
			$pgl_options->set_option('estate_currency_placement', 'before');
			$pgl_options->set_option('number_of_estate', '5');
			$pgl_options->set_option('estate_searchable_fields', array(
				'bathrooms' => '1',
				'bedrooms' => '1',
				'area' => '1'
			));
			$pgl_options->set_option('estate_extra_fields', array(
				'bathrooms' => '1',
				'bedrooms' => '1',
				'area' => '1'
			));
		}
	}
	static function estate_horizontal_slide_shortcode($atts)
	{
		extract(shortcode_atts(array(
			'count' => 6,
			'item_id' => '',
			'acs' => ''
		), $atts));
		/**
		 * @var int $count
		 * @var string $item_id
		 * @var string $acs
		 */
		$item_id = strlen($item_id) ? explode(',', $item_id) : array();
		$query_array = array(
			'posts_per_page' => $count
		);
		if (!empty($item_id)) {
			$query_array['post__in'] = $item_id;
		}
		ob_start();
		self::estate_horizontal_slider($query_array, $acs);
		$result = ob_get_clean();

		return do_shortcode(shortcode_unautop(trim($result)));
	}

	static function estate_horizontal_slider($args = array(), $acs_group = '')
	{
		$default_array = array(
			'posts_per_page' => 10,
			'post_type' => 'estate',
			'post__in' => array(),
			'orderby' => 'post__in',
			'meta_query' => array(
				array(
					'key' => 'estate_featured',
					'value' => 1
				)
			)
		);
		$args = wp_parse_args($args, $default_array);
        $cols = round($args['posts_per_page'] / 5);
        $page = ($args['posts_per_page']%5 == 0 ? $cols : $cols+1);
        $colClass = 12/$page;
		$acs_enable = FALSE;
		if ($acs_group) {
			global $acs;
			if (!is_null($acs) && get_class($acs) == 'Acs') {
				$acs_enable = TRUE;
			}
		}

		if ($acs_enable) {
			$tmpa = array('group_name' => $acs_group);
			$acs->query_posts(array_merge($tmpa, $args));
			global $wp_query;
			$the_query = $wp_query;
		} else {
			$the_query = new WP_Query($args);
		}
		if ($the_query->have_posts()) {
			wp_enqueue_script('jquery-nicescroll', PGL_URI_JS . 'nicescroll/jquery.nicescroll.js', array(
				'jquery'
			), '3.2.0', TRUE);
			?>
			<div class="properties">
				<div id="property-scroll" class="container">
					<div id="wrapper">
						<div class="box<?php echo $page>1 ? ' rail-on' : ' rail-off'?>">
							<div class="scroll-properties" style="width:<?php echo 100*$page?>%">
								<div class="row">
								<?php
								$i = 1;
								$items_per_big_column = 5;
								$html = '';
								while ($the_query->have_posts()) {
									$the_query->the_post();
									$the_id = get_the_ID();
									$class = 'small';
									if($i%5==1){
										$html.= '<div class="col-md-'.($colClass/2).' col-sm-'.($colClass/2).'">';
										$class = 'big';
									}
									if($class=='small'){
										$sm_class = in_array($i, array(2,3,7,8)) ? ' item-above' : ' item-under';
										$html .= '<div class="col-md-6 col-sm-6'.$sm_class.'">';
									}
									$html .= '<div class="container-'.$class.'">
												<a href="' . get_permalink($the_id) . '">' . PGL_Template_Tag::the_post_thumbnail($the_id, 'estate-showcase-'.$class.'-thumbnail','', false) . '</a>
												<article class="text-'.$class.'">
													<div class="infotexthv">
														<h3><a href="' . get_permalink($the_id) . '">' . get_the_title($the_id) . '</a></h3>
														<p>' . PGL_Addon_Estate::the_excerpt(FALSE) . '</p>
													</div>
												</article>
											</div>';
									if($class=='small'){
										$html .= '</div>';
									}
									if($i%5==1){
										$html.= '</div>';
										$html.= '<div class="col-md-'.($colClass/2).' col-sm-'.($colClass/2).'">';
										$html.= '<div class="row">';
									}
                                    if($i%5==0||$i==$the_query->post_count){
										$html.= '</div>';
										$html.= '</div>';
									}
									$i++;
								}
								echo $html;
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <?php if($page>1):?>
			<script type="text/javascript">
				jQuery(function ($) {
                    var horScroll = $('.scroll-properties').first();
                    var addSpace = <?php echo $page*($page*5)?>;
                    horScroll.css({'width':horScroll.parent().outerWidth()*<?php echo $page?>+addSpace});
					var scrollbar_color = $('.realestate-logo a').first().css('background-color');
					jQuery('.box').niceScroll(".scroll-properties",{
						autohidemode      : false,
						scrollspeed       : 100,
						cursorcolor       : scrollbar_color,
						cursorwidth       : '15px',
						cursorborderradius: '0px',
						cursorborder      : '0',
						background        : '#dddddd',
                        railpadding:{top:0,right:0,left:0,bottom:40}
					});
                    $(window).resize(function(){
                        horScroll.css({'width':horScroll.parent().outerWidth()*<?php echo $page?>+addSpace});
                        horScroll.getNiceScroll().resize();
                    });
				});
			</script>
            <?php endif;?>
			<?php
			if ($acs_enable) {
				wp_reset_query();
			}
		}
	}

	static function estate_shortcode($atts)
	{
		extract(shortcode_atts(array(
			'id' => '',
			'display' => 'normal'
		), $atts));
		/**
		 * @var string $id
		 */
		if (!$id) {
			return '';
		}
		$estate = get_post($id);
		if (!$estate) {

			return '';
		}
		global $post;
		$post = $estate;
		setup_postdata($post);
		ob_start();
		?>
		<div class="estate-single">
			<div class="imagewrapper">
				<a href="<?php the_permalink(); ?>"><?php
					PGL_Addon_Estate::get_estate_thumbnail(get_the_ID(), 'estate-list-view-thumbnail', TRUE) ?></a>
				<span class="price"><?php
					echo PGL_Addon_Estate::format_price(get_post_meta(get_the_ID(), 'estate_price', TRUE)); ?></span>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		wp_reset_postdata();
		return $html;
	}
}

function add_acs_query($acs_group, $args = array())
{
	global $acs;
	if (!is_null($acs) && get_class($acs) == 'Acs') {
		$tmp = array('group_name' => $acs_group);
		$acs->query_posts(array_merge($tmp, $args));
		global $wp_query;
		return $wp_query;
	}
}

function reset_query_from_acs()
{
	wp_reset_query();
}
<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

class TMM_Page {

	public static $post_pod_types = array();

	public static function init() {

		self::$post_pod_types = array(
			'default' => __("Default", 'diplomat'),
			'video' => __("Video", 'diplomat'),
			'audio' => __("Audio", 'diplomat'),
			//'link' => __("Link", 'diplomat'),
			'quote' => __("Quote", 'diplomat'),
			'gallery' => __("Gallery", 'diplomat'),
		);

		//ajax
		add_action('wp_ajax_add_post_podtype_gallery_image', array(__CLASS__, 'add_post_podtype_gallery_image'));
                add_action('wp_ajax_change_post_gallery_type', array(__CLASS__, 'change_post_gallery_type'));
                
	}

	public static function admin_init() {
		self::init_meta_boxes();
	}

	public static function save_post() {
		global $post;
		if (is_object($post)) {
			if (isset($_POST) && !empty($_POST) && ($post->post_type == 'post' || $post->post_type == 'page' || $post->post_type == 'gall')) {
                
				update_post_meta($post->ID, "meta_title", @$_POST["meta_title"]);
				update_post_meta($post->ID, "meta_keywords", @$_POST["meta_keywords"]);
				update_post_meta($post->ID, "meta_description", @$_POST["meta_description"]);
				
				update_post_meta($post->ID, "post_pod_type", @$_POST["post_pod_type"]);
				update_post_meta($post->ID, "post_type_values", @$_POST["post_type_values"]);
                update_post_meta($post->ID, "gallery_type", @$_POST["gallery_type"]);
                update_post_meta($post->ID, "post_gallery_accordion", @$_POST["post_gallery_accordion"]);				
                
                update_post_meta($post->ID, "header_type", @$_POST["header_type"]);
				update_post_meta($post->ID, "another_page_title", @$_POST["another_page_title"]);

                update_post_meta($post->ID, "headerbg_hide", @$_POST["headerbg_hide"]);
				update_post_meta($post->ID, "post_template", @$_POST["post_template"]);

                update_post_meta($post->ID, "footer_sidebar", @$_POST["footer_sidebar"]);                               
				update_post_meta($post->ID, "page_sidebar_position", @$_POST["page_sidebar_position"]);
				
			}
		}
	}

	public static function init_meta_boxes() {
		add_meta_box("seo_options", __("Seo options", 'diplomat'), array(__CLASS__, 'page_seo_options'), "page", "normal", "low");
		add_meta_box("seo_options", __("Seo options", 'diplomat'), array(__CLASS__, 'page_seo_options'), "post", "normal", "low");

		add_meta_box("post_types_data", __("Post type data", 'diplomat'), array(__CLASS__, 'post_type_meta_panel'), "post", "normal");
        
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'diplomat'), array(__CLASS__, 'page_background_options'), "post", "side", "low");
		add_meta_box("tmm_page_bg", __("Custom Page Options", 'diplomat'), array(__CLASS__, 'page_background_options'), "page", "side", "low");
		        
	}    

	public static function page_background_options() {
		global $post;
		echo TMM::draw_html('page/background_options', self::get_page_settings($post->ID));
	}

	public static function get_page_settings($post_id) {
		$custom = get_post_custom($post_id);
		$data = array();       
        $data['header_type'] = (isset($custom["header_type"][0])) ? $custom["header_type"][0] : 'default';
		$data['another_page_title'] = (isset($custom["another_page_title"][0])) ? $custom["another_page_title"][0] : '';
		$data['headerbg_hide'] = (isset($custom["headerbg_hide"][0])) ? $custom["headerbg_hide"][0] : '0';
		$data['post_template'] = (isset($custom["post_template"][0])) ? $custom["post_template"][0] : 'default';
		$data['footer_sidebar'] = (isset($custom["footer_sidebar"][0])) ? $custom["footer_sidebar"][0] : '1';
		$data['page_sidebar_position'] = (isset($custom["page_sidebar_position"][0])) ? $custom["page_sidebar_position"][0] : TMM::get_option('sidebar_position');
		return $data;
	}

	public static function page_seo_options() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['meta_title'] = (isset($custom["meta_title"][0])) ? $custom["meta_title"][0] : '';
		$data['meta_keywords'] = (isset($custom["meta_keywords"][0])) ? $custom["meta_keywords"][0] : '';
		$data['meta_description'] = (isset($custom["meta_description"][0])) ? $custom["meta_description"][0] : '';
		echo TMM::draw_html('page/seo_options', $data);
	}

	public static function post_type_meta_panel() {
		global $post;
		$data = array();
		$custom = get_post_custom($post->ID);
		$data['post_pod_types'] = self::$post_pod_types;
		$data['current_post_pod_type'] = (get_post_format($post->ID)) ? get_post_format($post->ID) : 'default';
		$data['post_id'] = $post->ID;
		$data['post_type_values'] = get_post_meta($post->ID, 'post_type_values', true);

		echo TMM::draw_html('page/post_pod_type_panel', $data);
	}

	//ajax
	public static function add_post_podtype_gallery_image() {
		$data = array();
		$data['imgurl'] = $_REQUEST['imgurl'];

		echo TMM::draw_html('page/draw_post_podtype_gallery_image', $data);
		exit;
	}
    public static function change_post_gallery_type(){
                $gallery_type = $_REQUEST['gallery_type'];
                $post_id = $_REQUEST['post_id']; 
                $post_type_values = get_post_meta($post_id, 'post_type_values', true);
                 
                if ($gallery_type=='accordion_grid_gallery'){
                    ?>
                    <tr>
                        <th style="width:25%">
                                <label for="post_type_conrainer">
                                        <strong><?php esc_html_e('Gallery', 'diplomat') ?></strong>
                                        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
                                                <?php esc_html_e('Choose accordion grid slider', 'diplomat'); ?>
                                        </span>
                                </label>
                        </th>
                        <td>
                            <?php $sliders = (class_exists('TMM_Grid_Slider')) ? TMM_Grid_Slider::get_sliders() : array(); ?>
                            <?php if (count($sliders)==0){
								esc_html_e('Please, create accordion grid slider at first','diplomat');
                            }else{
                            ?>
                            <select name="post_gallery_accordion" >
                                <?php
                                foreach ($sliders as $slider) {
                                    ?>
                                        <option value="<?php echo esc_attr(absint($slider->ID)) ?>"><?php echo esc_html($slider->post_title) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select> 
                            <div class="clear"></div>
                            <?php
                            } ?>
                                
                        </td>
                    </tr>
                    <?php
                }  else {              
                    ?>
                    <tr>
                        <th style="width:25%">
                                <label for="post_type_conrainer">
                                        <strong><?php esc_html_e('Gallery', 'diplomat') ?></strong>
                                        <span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">
                                                <?php esc_html_e('Create your gallery for post', 'diplomat'); ?>
                                        </span>
                                </label>
                        </th>
                        <td>
                            <p><a href="#" class="add-images-to-page button"><?php esc_html_e('Add Images', 'diplomat'); ?></a></p>

                            <ul id="post_pod_gallery">                                                                  
                                                            
                                <?php
                                if (!empty($post_type_values['gallery']) AND is_array($post_type_values['gallery'])){ 
                                    foreach ($post_type_values['gallery'] as $imgurl){                                                                                  
                                     echo TMM::draw_html('page/draw_post_podtype_gallery_image', array('change_gallry_type' => true, 'imgurl' => $imgurl, 'gallery_type'=>$gallery_type)); 
                                    }
                                }
                                ?>
                            </ul>

                            <div class="clear"></div>
                        </td>
                    </tr>
                                                
                    <?php
                }
                
                exit;
        }
}

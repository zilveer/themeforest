<?php
class CsheroFrameworkMetaboxes {
	public function __construct(){
		global $smof_data;
		$this->data = $smof_data;
		add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_boxes'));
		add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
	}
	function admin_script_loader() {

		$_screen = get_current_screen();

		if (in_array($_screen->id, array('restaurantmenu', 'post', 'page', 'pointofsale'))) {
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_style('cs-metabox', get_template_directory_uri().'/framework/assets/css/metabox.css');
			wp_enqueue_style('colpick', get_template_directory_uri().'/framework/assets/css/colpick.css');

			wp_enqueue_script('colpick', get_template_directory_uri().'/framework/assets/js/colpick.js');
			wp_enqueue_script('cshero-upload', get_template_directory_uri().'/js/upload.js');
			wp_enqueue_script('blog-tabs', get_template_directory_uri().'/framework/assets/js/blog.tab.js');
			wp_enqueue_script('meta-box', get_template_directory_uri().'/framework/assets/js/meta.box.js');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
		}
	}
	public function add_meta_boxes()
	{
		$post_types = get_post_types( array( 'public' => true ) );

		$this->add_meta_box('page_options', esc_html__('Page Options','wp_nuvo'), 'page');
		$this->add_meta_box('post_options', esc_html__('Post Options','wp_nuvo'), 'post');

		$this->add_meta_box('post_video', esc_html__('Video Settings','wp_nuvo'), 'post');
		$this->add_meta_box('post_audio', esc_html__('Audio Settings','wp_nuvo'), 'post');
		$this->add_meta_box('post_quote', esc_html__('Quote Settings','wp_nuvo'), 'post');
		$this->add_meta_box('post_link', esc_html__('Link Settings','wp_nuvo'), 'post');
		$this->add_meta_box('portfolio', esc_html__('Portfolio Setting','wp_nuvo'), 'portfolio');
		$this->add_meta_box('restaurantmenu', esc_html__('Menu Setting','wp_nuvo'), 'restaurantmenu');
		$this->add_meta_box('pointofsale', esc_html__('Point of Sale','wp_nuvo'), 'pointofsale');
	}
	public function save_meta_boxes($post_id)
	{
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		foreach($_POST as $key => $value) {
			if(strstr($key, 'cs_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	public function add_meta_box($id, $label, $post_type)
	{
		add_meta_box(
		'cs_' . $id,
		$label,
		array($this, $id),
		$post_type
		);
	}
	/* post */
	public function post_options()
	{
	    include 'views/metaboxes/post_options.php';
	}
	public function page_options()
	{
		include 'views/metaboxes/blog_options.php';
	}
	public function post_video()
	{
		include 'views/metaboxes/post_video.php';
	}
	public function post_audio()
	{
		include 'views/metaboxes/post_audio.php';
	}
	public function post_quote()
	{
		include 'views/metaboxes/post_quote.php';
	}
	public function post_link()
	{
		include 'views/metaboxes/post_link.php';
	}
	/* team */
	public function team(){
		include 'views/metaboxes/team.php';
	}
	/* client */
	public function client(){
		include 'views/metaboxes/client.php';
	}
	public function portfolio(){
		include 'views/metaboxes/portfolio.php';
	}
	public function restaurantmenu(){
	    include 'views/metaboxes/restaurantmenu.php';
	}
	public function pointofsale(){
	    include 'views/metaboxes/pointofsale.php';
	}
	/*
	 * Element Field
	 */
	public function text($id, $label, $default, $desc = '')
	{
		global $post;
		$value = get_post_meta($post->ID, 'cs_' . $id, true);
		if (!$value){
			$value = $default;
		}
		$html = '';
		$html .= '<div id="cs_metabox_field_'.$id.'" class="cs_metabox_field">';
		$html .= '<label for="cs_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input type="text" id="cs_' . $id . '" name="cs_' . $id . '" value="' . $value . '" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
	public function hidden($id){
		global $post;
		$html = '<input type="hidden" id="cs_' . $id . '" name="cs_' . $id . '" value="' . get_post_meta($post->ID, 'cs_' . $id, true) . '" />';
		echo $html;
	}
	public function select($id, $label, $options, $default = '', $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div id="cs_metabox_field_'.$id.'" class="cs_metabox_field">';
		$html .= '<label for="cs_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select id="cs_' . $id . '" name="cs_' . $id . '">';

		if(get_post_meta($post->ID, 'cs_' . $id, true)){
			$default = get_post_meta($post->ID, 'cs_' . $id, true);
		}
		foreach($options as $key => $option) {
			if($default == $key) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}

			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;

		$html = '';
		$html .= '<div id="cs_metabox_field_'.$id.'" class="cs_metabox_field">';
		$html .= '<label for="cs_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<select multiple="multiple" id="cs_' . $id . '" name="cs_' . $id . '[]">';
		foreach($options as $key => $option) {
			if(is_array(get_post_meta($post->ID, 'cs_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'cs_' . $id, true))) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}

			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
    /* select list taxonomy a post type */
	public function taxonomy($id, $label, $tag = 'category', $defualt = array(), $hide_empty = false, $desc = ''){
	    global $post;
	    $terms = get_terms($tag, array('hide_empty' => $hide_empty));
	    $option = array();
	    $option[''] = "None";
	    foreach ($terms as $term){
	        $option[$term->term_id] = $term->name.' ('.$term->count.')';
	    }
	    $this->multiple($id, $label, $option, $desc);
	}
	/* select list taxonomy multiple post type */
	public function taxonomys($id, $label, $desc = '') {
	    global $post;
	    $options = $this->cshero_get_post_types_assoc();
	    $this->select('post_type_'.$id, $label, $options, array(), $desc = '');

	    $post_type = get_post_meta($post->ID, 'cs_post_type_' . $id, true);
	    if($post_type){
	        $tags = $this->cshero_get_taxomonies_by_post_type($post_type);
	        if(!empty($tags)){

	            $arrTaxOutput = array();
	            $arrTaxOutput[''] = 'None';
	            foreach($tags as $taxName=>$taxTitle){
	                $cats = $this->cshero_get_categories_assoc($taxName);
	                if(!empty($cats)){
	                    foreach ($cats as $_id=>$cat){
	                        $arrTaxOutput[$_id] = $cat;
	                    }
	                }
	            }
	            $this->multiple('taxonomy_'.$id, 'Post Categories', $arrTaxOutput, $desc);
	        }
	    }
	}
    /* textarea */
	public function textarea($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div id="cs_metabox_field_'.$id.'" class="cs_metabox_field">';
		$html .= '<label for="cs_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<textarea cols="30" rows="5" id="cs_' . $id . '" name="cs_' . $id . '">' . get_post_meta($post->ID, 'cs_' . $id, true) . '</textarea>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}

	public function upload($id, $label, $desc = '')
	{
		global $post;

		$html = '';
		$html = '';
		$html .= '<div id="cs_metabox_field_'.$id.'" class="cs_metabox_field">';
		$html .= '<label for="cs_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		$html .= '<div class="field">';
		$html .= '<input name="cs_' . $id . '" class="upload_field" id="cs_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'cs_' . $id, true) . '" />';
		$html .= '<input class="cshero_upload_button button button-primary" type="button" value="Browse" />';
		$html .= '<input data-id="cs_' . $id . '" class="cshero_clear_button button button-danger" type="button" value="Clear" />';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
	}
	/*
	 * Return object category items
	 */
	private function cshero_get_post_types_with_cats(){
	    $arrPostTypes = $this->cshero_get_post_types_with_taxomonies();

	    $arrPostTypesOutput = array();
	    foreach($arrPostTypes as $name=>$arrTax){

	        $arrTaxOutput = array();
	        foreach($arrTax as $taxName=>$taxTitle){
	            $cats = $this->cshero_get_categories_assoc($taxName);
	            if(!empty($cats))
	                $arrTaxOutput[] = array(
	                    "name"=>$taxName,
	                    "title"=>$taxTitle,
	                    "cats"=>$cats);
	        }

	        $arrPostTypesOutput[$name] = $arrTaxOutput;

	    }

	    return($arrPostTypesOutput);
	}
	/*
	 *
	 */
	private function cshero_get_post_types_with_taxomonies(){
	    $arrPostTypes = $this->cshero_get_post_types_assoc();

	    foreach($arrPostTypes as $postType=>$title){
	        $arrTaxomonies = $this->cshero_get_taxomonies_by_post_type($postType);
	        $arrPostTypes[$postType] = $arrTaxomonies;
	    }

	    return($arrPostTypes);
	}
	/*
	 * Get Post Types + Custom Post Types
	 */
	private function cshero_get_post_types_assoc($arrPutToTop = array()){
	    $arrBuiltIn = array("post"=>"post", "page"=>"page");

	    $arrCustomTypes = get_post_types(array('_builtin' => false));

	    //top items validation - add only items that in the customtypes list
	    $arrPutToTopUpdated = array();
	    foreach($arrPutToTop as $topItem){
	        if(in_array($topItem, $arrCustomTypes) == true){
	            $arrPutToTopUpdated[$topItem] = $topItem;
	            unset($arrCustomTypes[$topItem]);
	        }
	    }

	    $arrPostTypes = array_merge($arrPutToTopUpdated,$arrBuiltIn,$arrCustomTypes);

	    //update label
	    foreach($arrPostTypes as $key=>$type){
	        $objType = get_post_type_object($type);

	        if(empty($objType)){
	            $arrPostTypes[$key] = $type;
	            continue;
	        }

	        $arrPostTypes[$key] = $objType->labels->singular_name;
	    }

	    return($arrPostTypes);
	}
	/*
	 * get taxomonies by post type
	 */
	private function cshero_get_taxomonies_by_post_type($postType){
	    $arrTaxonomies = get_object_taxonomies(array('post_type' => $postType), 'objects');

	    $arrNames = array();
	    foreach($arrTaxonomies as $key=>$objTax){
	        $arrNames[$objTax->name] = $objTax->labels->name;
	    }

	    return($arrNames);
	}
	/**
	 * get post categories list assoc - id / title
	 */
	private function cshero_get_categories_assoc($taxonomy = "category"){

	    if(strpos($taxonomy,",") !== false){
	        $arrTax = explode(",", $taxonomy);
	        $arrCats = array();
	        foreach($arrTax as $tax){
	            $cats = $this->cshero_get_categories_assoc($tax);
	            $arrCats = array_merge($arrCats,$cats);
	        }

	        return($arrCats);
	    }

	    //$cats = get_terms("category");
	    $args = array("taxonomy"=>$taxonomy);

	    //Essential_Grid_Wpml::disable_language_filtering();

	    $cats = get_categories($args);

	    //Essential_Grid_Wpml::enable_language_filtering();

	    $arrCats = array();
	    foreach($cats as $cat){
	        $numItems = $cat->count;
	        $itemsName = "items";
	        if($numItems == 1)
	            $itemsName = "item";

	        $title = $cat->name . " ($numItems $itemsName)";

	        $id = $cat->cat_ID;
	        $id = Essential_Grid_Wpml::get_id_from_lang_id($id,$cat->taxonomy);

	        $arrCats[$id] = $title;
	    }
	    return($arrCats);
	}
}
$metaboxes = new CsheroFrameworkMetaboxes;
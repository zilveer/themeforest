<?php 
class Theme_Metabox_Slideshow extends Theme_Metabox_With_Tabs {
	public $slug = 'slideshow';

	public function config(){
		return array(
			'title' => sprintf(__('%s SlideShow Item Options','theme_admin'),THEME_NAME),
			'post_types' => array('slideshow'),
			'callback' => '',
			'context' => 'normal',
			'priority' => 'high',
		);
	}
		public function __construct(){
		parent::__construct();
		foreach($this->config['post_types'] as $post_type){
			if (theme_is_post_type($post_type)){
				add_action('admin_init', array(&$this, '_enqueue_assets'));
			}
		}

		/* gallery start */
		//gallery insert image ajax action callback
		add_action('wp_ajax_theme-gallery-get-image', array(&$this,'_gallery_get_image_callback'));
	
		//gallery hook
		if (isset($_GET['gallery_image_upload']) || isset($_POST['gallery_image_upload'])) {
			include_once (THEME_ADMIN_FUNCTIONS . '/gallery-media-upload.php');
		}
		if (isset($_GET['gallery_edit_image'])) {
			wp_enqueue_script('theme-gallery-edit-image', THEME_ADMIN_ASSETS_URI . '/js/gallery-edit-image.js');
			
			wp_enqueue_style('theme-gallery-edit-image', THEME_ADMIN_ASSETS_URI . '/css/gallery-edit-image.css');
		}
		/* gallery end */
	}

	public function _enqueue_assets(){
		wp_enqueue_script('theme-metabox-portfolio', THEME_ADMIN_ASSETS_URI . '/js/metabox_portfolio.js', array('jquery'));
	
		/* gallery start */
		wp_deregister_script('autosave');
		wp_enqueue_script('theme-metabox-portfolio-gallery', THEME_ADMIN_ASSETS_URI . '/js/gallery.js', array('jquery-ui-sortable'));
		wp_enqueue_style('theme-metabox-portfolio-gallery', THEME_ADMIN_ASSETS_URI . '/css/gallery.css');
		
		add_thickbox();
		/* gallery end */
	}

	
	public function _gallery_get_image_callback() {
		$html = $this->_gallery_create_image_item($_POST['id']);
		if (! empty($html)) {
			echo $html;
		} else {
			die(0);
		}
		die();
	}

	// gallery metaboax function
	public function _gallery_create_image_item($attachment_id) {
		$image = get_post($attachment_id);
		if ($image) {
			$meta = wp_get_attachment_metadata($attachment_id);
			$date = mysql2date(get_option('date_format'), $image->post_date);
			$size = $meta['width'] . ' x ' . $meta['height'] . 'pixel';
			
			include (THEME_ADMIN_AJAX . '/gallery-image-item.php');
		}
	}

	function _option_slideshow_gallery_function($value, $default) {
		global $post;
?>
	<li class="theme-option">
		<div id="gallery_actions">
<?php
		global $wp_version;
		if(version_compare($wp_version, "3.5", '<')){
			echo '<a title="Add Media" class="thickbox" id="add_media" href="media-upload.php?post_id='.$post->ID.'&gallery_image_upload=1&type=image&TB_iframe=1&width=640&height=644" style="border:none;text-decoration:none;">
				<input type="button" class="button-primary" value="Add Image" id="add-image" name="add">
			</a>';
		} else {
			echo '<a href="#" class="button theme-add-gallery-button" data-uploader_title="Add Images to gallery" data-uploader_button_text="Add Images" title="Add Image">Add Images</a>';
		}
?>	
		</div>

		<div id="gallery_table_wrapper">
			<table class="widefat gallery_table">
				<thead>
					<tr>
						<th width="10" scope="row">&nbsp;</th>
						<th width="70" scope="row">Thumbnail</th>
						<th width="150" scope="row">Title</th>
						<th scope="row">Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="4">
							<div>
								<ul id="images_sortable">
		<?php 
			$image_ids_str = get_post_meta($post->ID, '_image_ids', true);
			if(!empty($image_ids_str)){
				$image_ids = explode(',',str_replace('image-','',$image_ids_str));
				foreach($image_ids as $image_id){
					$this->_gallery_create_image_item($image_id);
				}
			}
		?>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" id="gallery_image_ids" name="_image_ids" value="<?php echo get_post_meta($post->ID, '_image_ids', true);?>">
		</div>
	</li>
<?php
	}

	public function tabs(){
		return array(
			array(
				"name" => __("Easy &#34;<em>Slideshow</em>&#34; Creator",'theme_admin'),
				'id' => '_slideshow_gallery',
				"options" => array(
					array(
						"name" => __("Slideshow Caption Options",'theme_admin'),
						"desc" => __("<p>Choose here the option desired for the caption of each slide in the slideshow.&nbsp;&nbsp;The options are:
<ol><li>Title of Image - is the title one has given an image when one uploads it ->after an image is uploaded a wordpress meta dialogue box is displayed <i>Add Images to Gallery</i> and at the right hand side of the box is a section &#34;Attachment Details&#34; which has a a title field where one can set the title of the image uploaded.</li><li>Caption of Image - same as the above title except that it grabs the caption you have placed in the image caption field</li><li>Title of Slider Item - this takes the title one has given to this Add New Slider Item.  In this case all of the slides would show the same slide caption.</li><li>None - the slides would have no caption.</li></p><p>New images do not have to be uploaded in order to create the gallery slideshow -> the other option is to select images from the media library.</p>",'theme_admin'),
						"id" => "_gallery_caption",
						"default" => 'title',
						"options" => array(
							"title" => __('Title of Image','theme_admin'),
							"caption" => __('Caption of Image','theme_admin'),
							"slider" => __('Title of Slider item','theme_admin'),
							"none" => __('None','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Slideshow Description Options",'theme_admin'),
						"desc" => __("<p>Choose here the option desired for the visible description of each slide in the gallery type slideshow.&nbsp;&nbsp;The options are:
<ol><li>Description of Image - is the description field of an image when one uploads it ->after an image is uploaded a wordpress meta dialogue box is displayed <i>Add Images to Gallery</i> and at the right hand side of the box is a section &#34;Attachment Details&#34; which has a field where one can set the description of the image uploaded.</li><li>Description of Slider Item - will take content you put into the wp editor above and apply it as the description -> in this instance all slides will have the same description.</li><li>None - no description at all.</li></p>",'theme_admin'),
						"id" => "_gallery_desc",
						"default" => 'image',
						"options" => array(
							"image" => __('Description of Image','theme_admin'),
							"slider" => __('Description of Slider item','theme_admin'),
							"none" => __('None','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"id" => "_image_ids",
						"layout" => false,
						"default" => '',
						"function" => "_option_slideshow_gallery_function",
						"type" => "custom",
					),
				),
			),
			array(
				"name" => __("Single Slide Options",'theme_admin'),
				"options" => array(
					array(
						"name" => __("Slide Caption (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p>If one has enabled captions in the slider they are using, Striking will show the title of the slide post, unless you fill out this field.</p>",'theme_admin'),	 				
						"id" => "_caption",
						"default" => "",
						"class" => 'full',
						"htmlspecialchars" => true,
						"type" => "text"
					),
					array(
						"name" => __("URL (Optional)&#x200E;",'theme_admin'),
						"desc" => __("The url that the slider item linked to.",'theme_admin'),
						"id" => "_link_to",
						"default" => "",
						"type" => "superlink"
					),
					array(
						"name" => __("Link Target",'theme_admin'),
						"id" => "_link_target",
						"default" => '_self',
						"options" => array(
							"_blank" => __('Load in a new window','theme_admin'),
							"_self" => __('Load in the same frame as it was clicked','theme_admin'),
							"_parent" => __('Load in the parent frameset','theme_admin'),
							"_top" => __('Load in the full body of the window','theme_admin'),
						),
						"type" => "select",
					),
				),
			),
			
		);
	}
}

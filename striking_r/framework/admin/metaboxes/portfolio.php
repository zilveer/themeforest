<?php
class Theme_Metabox_Portfolio extends Theme_Metabox_With_Tabs {
	public $slug = 'portfolio';
	public function config(){
		return array(
			'title' => sprintf(__('%s Portfolio Post Setup & Options','theme_admin'),THEME_NAME),
			'post_types' => array('portfolio'),
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
			if(is_array($meta)){
				$date = mysql2date(get_option('date_format'), $image->post_date);
				if(isset($meta['width']) && isset($meta['height'])){
					$size = $meta['width'] . ' x ' . $meta['height'] . 'pixel';
				} else {
					$size = '';
				}
				
				include (THEME_ADMIN_AJAX . '/gallery-image-item.php');
			}
		}
	}

	function _option_portfolio_type_gallery_function($value, $default) {
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
				"name" => __("Portfolio Post Setup",'theme_admin'),
				"desc" => sprintf(__("<h3 align='center'>INTRODUCTION</H3>
<p align='justify'>A portfolio item is a custom post type developed especially for our theme. &nbsp;Its purpose is to allow for creation of varied types of media content that can be displayed in condensed form via a list in a webpage, and each list item may by choice lead to a full post webpage.  &nbsp;The full post can contain expanded descriptive content fully customized as desired. &nbsp;So a portfolio &#34;item&#34; is simply a post, and like the better known blog post, it can have short form display (lists, widgets) and long form display as a full webpage with as much content as needed.</p>
<h4>Difference between a Portfolio List and a WP Gallery, and Featured Image vs a Thumbnail Image</h4>
<p align='justify'>Please go to the <a href='%1s' target='_blank'>Striking -> Portfolio Panel</a> and review the information on this topic found in the panel Help tab (the Help tab is found in the upper right hand corner and when clicked upon will open a dropdown containing help content).</p>
<h4>PORTFOLIO TYPES AND REQUIREMENTS</h4>
 <p align='justify'>There are <u>9 different Portfolio Types</u> available in Striking MultiFlex designed to fulfill every conceivable portfolio display requirement.  &nbsp;The <b>Set the Portfolio Type of this Post</b> setting below has a detailed help field discussing the 9 types and the use for each.  &nbsp;After selecting a type in the dropdown field its corresponding admin tab (left of this dialogue) will become active and this is where the specific settings for that portfolio type can be adjusted.</p>
<p align='justify'><u>Please note it is necessary to set a featured image, and give the portfolio item a title</u> for all Portfolio Types other then the HTML Portfolio type (which does not require a Featured Image). &nbsp;The Portfolio Type choice determines the action of the featured image thumbnail when selected by a site viewer - it will either open a lightbox with content or transport the website viewer somewhere else in the site, or even to an external url.</p>
<p align='justify'>A portfolio list inserted in any page or post content in the site can range in size from just one item in the list to as many as desired. &nbsp;All the settings for creating a list/display of portfolio items in any webpage are found in the portfolio shortcode, and portfolio behaviours that one desires to standardize for lists or the post page are set in the <a href='%2s' target='_blank'>Striking -> Portfolio Panel</a>.</p>
<p align='justify'>The shortcode allows for display of portfolio items that have been placed together into a category, to display multiple portfolio categories (which may contain many individual portfolio items between them) or to choose specific portfolio items by name for display in a list. &nbsp;The shortcode allows for complete control over what is displayed each time a portfolio list is created, how it is ordered, and what is displayed along with the thumbnail image. &nbsp;There are 26 settings in the shortcode some of which are for overriding the <b>Portfolio Panel</b> default settings for unique situations.</p>
<p align='justify'> Most portfolio types list thumbnail images open into a lightbox. &nbsp;In some instances one sets the lightbox size in a Portfolio Type tab. &nbsp;If there is no individual setting, then the lightbox size will be per the settings found in the <a href='%3s' target='_blank'>Portfolio Panel->Lightbox Dimensions Tab</a>.</p>
<p align='justify'>However, Image portfolio types have a special setting below <b>Restrict Image Lightbox Dimension</b> which provides an override of the themewide settings for an image portfolio item lightbox size -> this setting will allow for an image to open to its fullsize if desired even if it is bigger then the url window (which would then cause window scrolling in order to see the whole image).</p>  
<p align='justify'>Finally, the portfolio items grouped into a portfolio category are entirely determined by choice ->a portfolio category may be used to group same type items or it can have a mixed group of portfolio types - there are no restrictions of any sort as to what portfolio items are placed into any portfolio category.  &nbsp;Portfolio Categories are like shelves in a bookcase, what is put in them and how they are organized is all according to choice and convenience. &nbsp;The Portfolio Shortcode is used to display the portfolio items, grouped by category(s), or selected individually, as part of the content.</p>", 'theme_admin'),admin_url( 'admin.php?page=theme_portfolio'),admin_url( 'admin.php?page=theme_portfolio'),admin_url( 'admin.php?page=theme_portfolio&tab=lightbox_dimension')),
				"options" => array(
					array(
						"name" => __("Display Featured Image on Post Page",'theme_admin'),
						"desc" => __("<p align='justify'>This setting allows the option of whether to display the Featured Image in in the single post webpage -> this setting will override the global setting for the same option found in the Portfolio Panel.</p>
<p align='justify'>The featured image of every post item does double duty, it serves as the thumbnail image in a list (note that the thumbnail image has many sizes and depends on the number of columns one is using for a portfolio list), and optionally, it appears in its full size (or at least a larger size) as the initial body content of the single post webpage.  &nbsp;The only exception to this rule is for the HTML Portfolio type. &nbsp; See the description of the HTML Portfolio type for more information.</p>
<p align='justify'>An example of use for this setting -> one has to set a featured image for audio, video and doc type portfolio items so that they have a &#34;placeholder image&#34; in a portfolio list and will show as an item in the list. &nbsp;But this placeholder image is usually redundant for the single post webpage where one has embedded the actual audio or video (using the media shortcodes).  &nbsp;So this setting allows for the featured image it to be turned off so the featured image/&#34;placeholder&#34; does not show in the single post webpage.</p>",'theme_admin'),
						"id" => "_featured_image",
						"default" => '',
						"type" => "tritoggle",
					),
					array(
						"name" => __("Different Image for Portfolio List (Optional)&#x200E;",'theme_admin'),
						"desc" => __("This setting allows substitution of an alternate image for appearence in a portfolio list (ie the portfolio shortcode) in place of the featured image of the post. &nbsp;If not assigned, the featured image will appear in the post list.",'theme_admin'),
						"id" => "_list_image",
						"button" => "Insert Image",
						"default" => '',
						"type" => "upload",
					),
					array(
						"name" => __("Different Image for Masonry List (Optional)&#x200E;",'theme_admin'),
						"desc" => __("This setting allows substitution of an alternate image for appearence in a Masonry list (ie the masonry shortcode) in place of the featured image of the post. &nbsp;If not assigned, the featured image will appear in the masonry list.  ",'theme_admin'),
						"id" => "_masonry_image",
						"button" => "Insert Image",
						"default" => '',
						"type" => "upload",
					),
					array(
						"name" => __("Set the Portfolio Type of this Post",'theme_admin'),
						"desc" => __("<p align='justify'><p><strong>PORTFOLIO TYPES:</strong><ul>
<li><strong><u>IMAGE</u></strong> - The Image portfolio type is dual purpose. &nbsp;Normally it is a thumbnail image which opens up into a larger size in a lightbox when the thumbnail is clicked by the viewer ->the lightbox opening is automatic. &nbsp;The Image type also allows for image substitution so that one image shows as the thumbnail in a portfolio list, and another image will show up in the lightbox. &nbsp;The image substitution setting is found within the Image admin tab.</li>
<li><strong><u>VIDEO</u></strong> - The theme supports Youtube, Vimeo, and unique feature to the Striking theme is that it also supports self-hosted mp4 video as a portfolio item. &nbsp;The settings for the url link, and lightbox size are found in the Video tab. &nbsp;One loads a featured image to serve as the thumbnail image in the portfolio list, and when a viewer clicks on the image, it opens a lightbox containing the video per the settings in the Video tab.<br /><br />If an mp4 video, it should be loaded up in advance by using the &#34;Add New Media&#34; function of the media library or by ftp into a subfolder in your site, and make a note of the file path for the url field in the video admin settings.</li>
<li><strong><u>AUDIO</u></strong> - The Audio type is for embedding an .mp3 in a pop up lightbox. &nbsp; A featured image must still be set to act as the portfolio list thumbnail for the audio file, and when the thumbnail is clicked, the audio item shows up in a lightbox. &nbsp;The settings for the audio link, autoplay and loop are found in the Audio Tab. &nbsp;The mp3 it should be loaded up in advance by using the &#34;Add New Media&#34; function of the media library or by ftp into a subfolder in your site, and make a note of the file path for the url field in the audio admin settings.</li>
<li><strong><u>LIGHTBOX</u></strong> - The Lightbox type is an example of a feature which has both simple, and expert user level facets to its use.  &nbsp;Simple uses can be using an iframe or embed code to display a pdf, to use an iframe to display within the frame another url, or for displaying any other content one wants to have show up in an iframe or lightbox. &nbsp;The Iframe url field, lightbox content and width and height fields are found in the Lightbox tab.<br /><br />The expert level functionality comes from the fact the Lighbox Portfolio type can be very powerful for customization (just like the lightbox shortcode), as advanced users with html and css skills can design sophisticated custom content for the lightbox. &nbsp;See the settings in the Lightbox tab for more info.</li>
<li><strong><u>DOC</u></strong> - The Doc type is another unique Striking portfolio type that allows embedding of many common file types using the Google Docs Viewer including PDF, Word, Powerpoint, Excel, Zips and much more (see Doc tab settings for expanded list). &nbsp;On a desktop viewport the document will open in a lightbox. &nbsp;For mobile viewports this portfolio type has direct link fallback since support and behavior across mobile browsers & platforms is quite uneven for lightboxes with documents.</li>
<li><strong><u>LINK</u></strong> - The Link portfolio type is non-lightbox portfolio type which is sets the portfolio list thumbnail image link to something other then the single portfolio post webpage. &nbsp;So when a Link Portfolio type, the settings in the Link tab allow choosing direct linking to any site page, category, blog or custom post, or to link to any other url (internal or external). &nbsp;Like all other portfolio types, its necessary to set a featured image so that a thumbnail appears in the list, which when clicked by a site visitor, takes them to the link set in the Link admin tab. </li>
<li><strong><u>HTML</u></strong> - with this portfolio type the list content is created and styled entirely within the wp editor.  &nbsp;The <b>Help Information</b> in the Portfolio Type: HTML tab has more information on usage. </li>
<li><strong><u>PORTFOLIO GALLERY</u></strong> - is used to create a gallery of grouped images, which will show up in the lightbox when the featured image in the list is clicked upon for enlargement. &nbsp;The Portfolio Gallery tab contains detailed help and the functions for loading the gallery images.</li>
<li><strong><u>DOCUMENT</u></strong> - There is no admin tab for a Document type portfolio item as it is a portfolio type whereby when a viewer clicks on the thumbnail in a portfolio list, it transports the viewer directly to the single portfolio post rather then opening up an enlarged version of the thumbnail image in a lightbox.  
<br /><br />The only &#8220;setting&#8221; typically applicable to a Document portfolio type (other then the content created in the post body) is the actual loading of a featured image to act as the portfolio list thumbnail. <br /><br />A Document type is similar in function to the Read More button which when clicked moves the viewer to the single post webpage, but by way of the image and is often used when not showing the Read More Button in a portfolio list. <br /><br />In summary, a Document portfolio type allows haveing any content desired in the portfolio post body, and the Document setting causes the thumbnail image to act as a trigger to bring the site viewer directly to the post page when they click upon it.</li></ul>
----------------------------
<p align='justify'>Sometimes there is confusion between the Link and Document portfolio types. &nbsp;The Link type is used to bring the site viewer to another webpage within a site or an external url when they click on thumbnail image, whereas the Document type is used to bring the viewer to the single portfolio post webpage when they click on the thumbnail image.</p>",'theme_admin'),
						"id" => "_type",
						"default" => 'image',
						"options" => array(
							"image" => __('Image','theme_admin'),
							"video" => __('Video','theme_admin'),
							"audio" => __('Audio', 'theme_admin'),
							"lightbox" => __('Lightbox','theme_admin'),
							"gdoc" => __('Doc','theme_admin'),
							"link" => __('Link','theme_admin'),
							"html" => __('HTML','theme_admin'),
							"gallery" => __('Gallery','theme_admin'),
							"doc" => __('Document','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Breadcrumbs Parent Page",'theme_admin'),
						"desc" => __("<p align='justify'>Wordpress does not have a static page setting for a &#34;Portfolio&#34; page in the manner that it has for a blog page.  &nbsp;So portfolio posts, which are a custom post type, don&#180;t follow the normal blog post breadcrumbs convention. &nbsp;This setting can provide an alternative as it allows for selection of a page to be the breadcrumbs parent page for all portfolio items that are created for the website.</p>
<p align='justify'>An example usage with this feature is to have created a &#34;My Portfolio&#34; top level navigation page and then select it in the dropdown field below to act as the parent page for breadcrumbs. &nbsp;After saving, someone viewing any portfolio post in the site would see in the breadcrumbs string &#34;Home -> My Portfolios -> Portfolio Post&#34;. &nbsp;If no breadcrumb parent is set, then the breadcrumb string appearing in the single portfolio post webpage would be &#34;Home -> Portfolio Post&#34;.</p>
<p align='justify'>NOTE : &nbsp;&nbsp;This setting is also found in the <b>Portfolio Panel ->General Portfolio Settings</b> tab, but the setting in this metabox provides an override to a new breadcrumbs parent page just for this post item.</p>",'theme_admin'),
						"id" => "_breadcrumbs_page",
						"page" => 0,
						"default" => 0,
						"chosen" => "true", 
						"prompt" => __("Default",'theme_admin'),
						"type" => "select",
					),
					array(
						"name" => __("Choose a Thumbnail Hover Icon",'theme_admin'),
						"desc" => __("<p align='justify'>Choose the Icon Effect desired when hovering over an image. &nbsp;The Icon will only show if not employing a special image effect such as hover or rotate.</p>"),
						"id" => "_icon",
						"default" => 'default',
						"options" => array(
							"default" => __('Default','theme_admin'),
							"zoom" => __('Image','theme_admin'),
							"play" => __('Video','theme_admin'),
							"doc" => __('Document','theme_admin'),
							"link" => __('Link','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Enable Read More Button",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If this is on, the Read More button will show. &nbsp;However, the portfolio list shortcode now contains a full array of options related to the Read More button and this setting is mostly left in the default position, following the lead of the setting in the <a href='%1s' target='_blank'>Portfolio Panel->General Tab - Enable Read More setting</a>, to which the shortcode can override if desired.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=general')),
						"id" => "_more",
						"default" => "",
						"type" => "tritoggle"
					),
					array(
						"name" => __("Link for Read More",'theme_admin'),
						"desc" => __("<p align='justify'>There is already a link type portfolio, and a document portfolio type, and so what is the purpose of this setting? &nbsp;This is effectively a &#34;9th&#34; portfolio type as it allows the Read More Button to be used as a link alternative, but for any portfolio type!  &nbsp;If the Read More is enabled for the portfolio list and a linking option from the list below is set, a site viewer clicking on the Read More button will follow to the link selected below, versus whatever is the action of clicking on the thumbnail (or Title if it is turned ON in the as it is also an active weblink to the single post webpage).</p><p align='justify'>This setting is most often used when inserting a portfolio list which requires a different action for linking at the end of the post excerpt - for example the &#34;Read More Button Text&#34; has been changed (this ability is in the shortcode to create custom read more text) to say &#34;Buy Here&#34; and they are transported to the online store part of the website to purchase the item they have just viewed in the portfolio list.</p>",'theme_admin'),
						"id" => "_more_link",
						"default" => "",
						"shows" => array('page','cat','post','manually'),
						"type" => "superlink"
					),
					array(
						"name" => __("Link Target for Read More",'theme_admin'),
						"id" => "_more_link_target",
						"default" => '_self',
						"options" => array(
							"_blank" => __('Load in a new window','theme_admin'),
							"_self" => __('Load in the same frame as it was clicked','theme_admin'),
							"_parent" => __('Load in the parent frameset','theme_admin'),
							"_top" => __('Load in the full body of the window','theme_admin'),
						),
						"type" => "select",
					),
					array(
						"name" => __("Restrict image Lightbox Dimension",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>This setting provides the ability to maintain the default, or counteract, the same global setting found in the <a href='%1s' target='_blank'>Advanced Panel -> Lightbox Tab - Fit To View setting</a>. When the restriction is on, the lightbox size will be constrained to within the size of the url window.</p><p align='justify'>For example, the full size image of the thumbnail might be 4000xp x 3000px. &nbsp;With the restriction on, the image will be restricted to fit to a size such as 800 x 600, in a normal desktop viewport whereas with it off, the full size image will show up, and one will have to scroll the image with a mouse or the scroll bars in order view the whole image.  &nbsp;This might be a desired outcome if the full size image is a map, or more detail is apparent in the enlarged image.</p> ",'theme_admin'),admin_url('admin.php?page=theme_advanced&tab=lightbox')),
						"id" => "_image_lightbox_fittoview",
						"default" => "",
						"type" => "tritoggle"
					),
				),
			),
				array(
					"name" => __("Portfolio Type: Image",'theme_admin'),
					'id' => 'portfolio_type_image',
					"options" => array(
					array(
						"name" => __("Substitute Image for Lightbox (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p align='justify'>This setting allows substitution of an alternate image for appearence in the lightbox in place of the featured image of the portfolio post. &nbsp;If not assigned, the featured image will appear in the lightbox.</p>",'theme_admin'),
						"id" => "_image",
						"button" => "Insert Image",
						"default" => '',
						"type" => "upload",
					),
				),
			),
				array(
					"name" => __("Portfolio Type: Video",'theme_admin'),
					'id' => 'portfolio_type_video',
					"options" => array(
					array(
						"name" => __("Video Link URL for Lightbox",'theme_admin'),
						"desc" => __("<p align='justify'>Paste the full url of the YouTub, Vimeo or mp4 starting with http:// into the url field below. &nbsp;The mp4 ability is designed for self-hosted video only. &nbsp;If an mp4 video, it should be loaded up in advance by using the &#34;Add New Media&#34; function of the media library or by ftp into a subfolder in the site, and make a note of the file path for pasting into this url field.</p>",'theme_admin'),
						"size" => 30,
						"id" => "_video",
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Video Width",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a width is specified below, this will override the portfolio video lightbox width default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Video Type Width</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),
						"id" => "_video_width",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Video Height",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a height is specified below, this will override the portfolio video lightbox height default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Video Type Height</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),	
						"id" => "_video_height",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"id" => "_video_autoplay",
						"desc" => sprintf(__("<p align='justify'>If an autoplay function is set below, this will override the portfolio video autoplay default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Video & Audio Tab - Video Autoplay</a> setting. &nbsp;It is important to remember that many browsers have a preloading requirement before a video will autoplay, and so if the video is a large one, the user may be left waiting for some (many!) seconds prior to autoplay commencing. &nbsp;Not all mobile browsers support autoplay.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=video_audio')),	
						"default" => 'default',
						"type" => "tritoggle"
					),
				),
			),
				array(
					"name" => __("Portfolio Type: Audio",'theme_admin'),
					'id' => 'portfolio_type_audio',
					"options" => array(
					array(
						"name" => __("Audio Link for Lightbox",'theme_admin'),
					"desc" => __("<p align='justify'>Paste the full url of the mp3 starting with http:// into the url field below. &nbsp;The audio file should be loaded up in advance by using the &#34;Add New Media&#34; function of the media library or by ftp into a subfolder in the site, and make a note of the file path for pasting into this url field.</p>",'theme_admin'),	
						"size" => 30,
						"id" => "_audio",
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Autoplay",'theme_admin'),
						"id" => "_audio_autoplay",
						"desc" => sprintf(__("<p align='justify'>If an autoplay function is set below, this will override the portfolio audio autoplay default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Video & Audio Tab - Audio Autoplay</a> setting. &nbsp;It is important to remember that many browsers have a preloading requirement before an audio will autoplay, and so if the audio file is large, the user may be left waiting for some (many!) seconds prior to autoplay commencing. &nbsp;Not all mobile browsers support autoplay.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=video_audio')),	
						"default" => 'default',
						"type" => "tritoggle"
					),
					array(
						"name" => __("Loop",'theme_admin'),
						"id" => "_audio_loop",
						"desc" => sprintf(__("<p align='justify'>If an audio looping function is set below, this will override the portfolio audio looping default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Video & Audio Tab - Audio Loop</a> setting. &nbsp;Not all mobile browsers support looping.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=video_audio')),
						"default" => 'default',
						"type" => "tritoggle"
					),
				),
			),
				array(
					"name" => __("Portfolio Type: Lightbox",'theme_admin'),
					'id' => 'portfolio_type_lightbox',
					"options" => array(
					array(
						"name" => __("Lightbox iframe href",'theme_admin'),
						"desc" => __("<p align='justify'>A common simple use of the portfolio lightbox is to use it to display an external url. &nbsp;Place the full url of the website into the field, and when a user clicks on the portfolio thumbnail, a lightbox will open with the website contained within the lightbox iframe. &nbsp;Another use is to place the url of a pdf uploaded into the site (using the media uploader or by ftp) opening into an iframe.</p>",'theme_admin'),
						"id" => '_lightbox_href',
						"size" => 30,
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Lightbox Content",'theme_admin'),
						"desc" => __("<p align='justify'>The content placed into the field below will display in the lightbox when the the portfolio list thumbnail is selected.  &nbsp;Both html and shortcode can be used in this field and the lightbox can be styled the same as any page or post content, thus this can be a very sophisticated tool for content display for the advanced web designer. &nbsp;A common simple usage of the lightbox field is for displaying a pdf via embed, and an example code to do such is as follows: <br /><br />&#60;embed src=&#34;http://yourdomain.com/name.pdf&#34; width=&#34;860&#34; height=&#34;1100&#34; &#62;</code><br /><br />With a pdf, it is usually best to specify the height and width within the embed code and not use the size settings below.</p>",'theme_admin'),
						"id" => "_lightbox_content",
						"default" => '',
						"type" => "textarea",
					),
					array(
						"name" => __("Lightbox Width",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a width is specificed below, this will override the portfolio lightbox width default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Lightbox Type Width</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),	
						"id" => "_lightbox_width",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Lightbox Height",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a height is specified below, this will override the portfolio lightbox height default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Lightbox Type Height</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),	
						"id" => "_lightbox_height",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Link For mobile viewing (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p>For mobile platforms such as pads and phones, lightboxes are often not desirable and lightbox behaviour is very erratic from platform to platform due to extremely varied support by the mobile browsers for document viewing.  &nbsp;So this setting gives the option of providing a direct link to the lightbox content, and if the user is on a mobile device, it will be detected and instead of the content being shown in a lightbox, the content will be shown in the url window or they will be directed to the alternate link if one is specified in the field below.</p>",'theme_admin'),
						"id" => "_lightbox_mobile_link",
						"size" => 30,
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
						"id" => "_lightbox_mobile_link_target",
						"default" => '_blank',
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
				array(
					"name" => __("Portfolio Type: Doc",'theme_admin'),
					'id' => 'portfolio_type_gdoc',
					"options" => array(
					array(
						"name" => __("URL Path to the File (the &#34;href&#34;)",'theme_admin'),
						"desc" => __("<p align='justify'>The first step is to upload the file either by ftp into a folder or the via the Media Panel (if it is a supported file type by the media panel uploader) in order to set a url path. &nbsp;Then place the full url of the file inlcuding the http:// into the field below.  &nbsp;A Featured Image is still required for the portfolio list thumbnail.  &nbsp;When a user clicks on the portfolio thumbnail, the google doc embedded iframe will be opened in a lightbox. &nbsp;This portfolio type supports different types of files including the following:</p><ul>
<li>Adobe Acrobat (PDF)</li>
<li>Microsoft Word (DOC/DOCX*)</li>
<li>Microsoft PowerPoint (PPT/PPTX*)</li>
<li>Microsoft Excel (XLS/XLSX*)</li>
<li>TIFF Images (TIF, TIFF)</li>
<li>Apple Pages (PAGES)</li>
<li>Adobe Illustrator (AI)</li>
<li>Adobe Photoshop (PSD)</li>
<li>Autodesk AutoCad (DXF)</li>
<li>Scalable Vector Graphics (SVG)</li>
<li>PostScript (EPS/PS)</li>
<li>OpenType/TrueType Fonts (OTF, TTF)</li>
<li>XML Paper Specification (XPS)</li>
<li>Archive Files (ZIP/RAR)</li>
</ul>

<p align='justify'> ** Office XML formats from 2007 and later sometimes can have a problem with the google viewer. &nbsp;Its a good idea to test xml types and where possible use the 2003 format instead.</p><p align='justify'>On rare ocassions, one might experience an error from Google indicating a bandwidth limit has been reached, etc. &nbsp;This is a google problem, and it goes away after a while as the google docs api refreshes its available resources periodically.</p>",'theme_admin'),
						"id" => '_gdoc_href',
						"size" => 30,
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Lightbox Width",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a width is specified below, this will override the portfolio Doc type lightbox width default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Google Doc Type Width</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),	
						"id" => "_gdoc_width",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Lightbox Height",'theme_admin'),
						"desc" => sprintf(__("<p align='justify'>If a height is specified below, this will override the portfolio Doc type lightbox height default set in the <a href='%1s' target='_blank'>Portfolio Panel -> Lightbox Dimension Tab - Google Doc Type Height</a> setting.</p> ",'theme_admin'),admin_url('admin.php?page=theme_portfolio&tab=lightbox_dimension')),	
						"id" => "_gdoc_height",
						"default" => "",
						"min" => 0,
						"max" => 960,
						"step" => "1",
						"unit" => 'px',
						"type" => "range",
					),
					array(
						"name" => __("Link For mobile viewing (Optional)&#x200E;",'theme_admin'),
						"desc" => __("<p align='justify'>For mobile platforms such as pads and phones, lightboxes are not desirable and lightbox behaviour is very erratic from platform to platform due to extremely varied support by the mobile browsers for document viewing.  &nbsp;Use this setting for placing the url of the document into the field below, and if the user is on a mobile device, it will be detected and instead of the document being shown in a lightbox, the document will be shown directly in the url window. &nbsp;It is much faster, and the user can scroll, save, print, and enjoy all the other benefits of the document.<br /><br />IMPORTANT - the user on the mobile device must have the appropriate software, such as the adobe reader for pdfs or kingsoft for office docs, in order to be able to open the document successfully.</p>",'theme_admin'),
						"id" => "_gdoc_mobile_link",
						"size" => 30,
						"default" => '',
						"class" => 'full',
						"type" => "text",
					),
					array(
						"name" => __("Link Target (Optional)&#x200E;",'theme_admin'),
						"id" => "_gdoc_mobile_link_target",
						"default" => '_blank',
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
			array(
				"name" => __("Portfolio Type: Link",'theme_admin'),
				'id' => 'portfolio_type_link',
				"options" => array(
					array(
						"name" => __("Link for Portfolio item",'theme_admin'),
						"desc" => __("<p align='justify'>This setting allows the featured image to act as a direct link to another url, either internal to the website or external. &nbsp;Below select linking to a page, post, category, or link manually -> where the url can be manually set, usually an external url.  &nbsp;Upon making a selection another field will appear allowing one to choose the specific page, post or category in a dropdown list.  &nbsp;If manually is selected, a field will appear in which to enter the full url (including http://) for linking.</p>",'theme_admin'),
						"id" => "_link",
						"default" => "",
						"shows" => array('page','post','cat','manually'),
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
				array(
					"name" => __("Portfolio Type: HTML",'theme_admin'),
					"desc" => __("<p align='justify'>The Portfolio HTML type enables creation of a custom designed portfolio list items using the content of the wp editor in place of the normal featured image.  &nbsp;Whereas typical portfolio items have an arranged layout displaying a featured image, title, description, excerpt, etc, for each post item, with an html portfolio item what is displayed in a portfolio list will be exactly as it has been created in the content editor.</p>
<p align='justify'>An analogy for long time users of Striking is the html slide in the Anything Slider. Or the content of a single slide in the Revolution slider. &nbsp;The slide displays exactly what is input into the editor, and similarly so with the HTML Portfolio item. &nbsp;Whether displayed in a list, or the single post page, what is designed is exactly what the viewer will see.</p>
<p align='justify'>It is envisioned that this portfolio type will most often be displayed in a one column or two column list.  &nbsp;Content has to be designed within the column width as the reference parameter (ie the html content is designed knowing that it is to be employed in a one column full width portfolio list - which provides the full width of 980px less padding as the list content container, or a 2 column list with sidebar - which provides a max width of 293px for content, and so on...). &nbsp;But any number of columns can be utilized in either full width or page with sidebar configuration.  &nbsp;There is absolute design freedom similar to the html type slider.</p>
<p align='justify'><b>IMPORTANT:</b> &nbsp;Content will wrap according to the normal viewports so it is advisable when designing to test the content for its mobile behavior - the set portfolio types have special responsive css rules which do not apply to the portfolio html type.</p>
<p align='justify'><u>OPTIONAL SETTINGS:</u> &nbsp;There are 3 optional settings below (with theme defaults also in the Portfolio Panel). &nbsp;The <b>Title</b> and <b>Read More</b> are convenience type settings.  &nbsp;The Title field will show the Portfolio title and it will be place left justified above the html content. &nbsp;The Read More is also left justified, below the html content. If employing H tags in the html content likely the Title setting will not be used.  &nbsp;The Read More allows for easy consistency of appearence if showing mixed portfolio lists which include HTML portfolio items and linking to single post pages is being accomplished by the read more (which is just an atag).  &nbsp;If you find the spacing between the settings and the html content inadequate, just use a br tag or a divider padding at the start and/or end of the html content.</p>
<p align='justify'>HTML portfolio items do not require a featured image (as the content is the substitute for the FI).  &nbsp;But an FI can be loaded if desiring to have it associated with the post, and it will appear alongside the editor content and the setting below is ON. &nbsp;If this setting is active, the FI for the HTML type will act identically to the FI of all other images in that list, per the settings in the shortcode. &nbsp;Depending on the number of columns in the list the post content will either appear beside or below the featured image.</p>
<p align='justify'>The other purpose of the featured image is to act as the widget thumbnail if employing portfolio widgets in the website.  &nbsp;Thus there are options:</p><ol>
<li>Do not load a featured image, but use the Default Widget Thumbnail settings in the Portfolio Panel to supply the widget thumbnail image.</li>
<li>Upload a Featured Image that is the exact size of the widget thumbnails - default size is 65 x 65 which can be adjusted in the Portfolio panel Widget admin tab. &nbsp;This option provides the best control of the thumbnail appearence.</li>
<li>Load up a Featured Image and either allow WP to auto resize/crop it to the widget thumbnail image, or edit the image after uploading utilizing the wp function for creating a custom thumbnail image.</li></ol>
<p align='justify'>The HTML portfolio item is a unique and powerful tool for creating &#34;freestyle&#34; portfolio list items for every custom purpose, and we hope much utility is provided for your website design.
",'theme_admin'),
					'id' => 'portfolio_type_html',
					"options" => array(
					array(
						"name" => __("Display Featured Image on portfolio list",'theme_admin'),
						"id" => "_html_image",
						"default" => 'default',
						"type" => "tritoggle",
					),
					array(
						"name" => __("Display Title on portfolio list",'theme_admin'),
						"id" => "_html_title",
						"default" => 'default',
						"type" => "tritoggle",
					),
					array(
						"name" => __("Display Read more on portfolio list",'theme_admin'),
						"id" => "_html_more",
						"default" => 'default',
						"type" => "tritoggle",
					),
				),
			),
				array(
					"name" => __("Portfolio Type: Gallery",'theme_admin'),
					"desc" => __("<p align='justify'>The Portfolio Gallery type is where a thumbnail image (using the post featured image as always) clicked upon by the viewer opens a lightbox and the images added below will be viewable in consecutive order within the lightbox using the lightbox left/right navigation arrows. &nbsp;The post featured image is not included in the lightbox gallery so if one wishes it to appear in the gallery it should be included in the images added below.</p>
<p align='justify'>If desiring to display the porfolig gallery images on the actual post webpage, then it is necessary to create a wp gallery in the post body (using the main content editor above) selecting the same images from the media library for the wp gallery.</p><p align='justify'>Each portfolio gallery image, either during the loading process or subsequently, may be edited to adjust its dimensions, title, caption, alt and description by selecting the Edit button beside the image once it appears below. &nbsp;Images can be deleted and uploaded to the existing portfolio gallery at will, and the gallery image order is drag and drop by placing your cursor on the left margin of the image dialogue boxes -> the 4 sided move icon will appear on hover and you can then left button mouse click and holding the mouse button drag to the appropriate position and release.</p>",'theme_admin'),
					'id' => 'portfolio_type_gallery',
					"options" => array(
					array(
				
						"id" => "_image_ids",
						"layout" => false,
						"default" => '',
						"function" => "_option_portfolio_type_gallery_function",
						"type" => "custom",
					),
				),
			),
		);
	}
}

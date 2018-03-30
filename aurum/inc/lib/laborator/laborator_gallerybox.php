<?php
/*
	Plugin: Gallery Box
	Created by: Arlind Nushi
	Version: 1.1
	
	This plugin creates a metabox field/custom field for posts and adds ability to create post gallery using WordPress Default Image Browser
*/

if(class_exists('GalleryBox'))
	return;

class GalleryBox
{
	// Field ID to be stored the field meta information
	protected $field_id;
	
	// Options to apply to this field
	protected $options = array('title' => 'Gallery Box', 'multiple' => true, 'post_types' => array('page', 'post'), 'post_id' => null, 'post_templates' => array(), 'inherit_imm' => FALSE);
	
	// Current Post Being Edited
	protected $post;
	
	public function __construct($field_id, $options = array())
	{
		global $post;
		
		$this->field_id = $field_id;

		if(is_array($options) && count($options))
			$this->options = array_merge($this->options, $options);
		
		// In case when this is a new post
		$file_name = basename($_SERVER['SCRIPT_FILENAME']);
		
		if(in_array($file_name, array('post-new.php', 'page-new.php')))
		{
			$post = get_post();
			$this->post = $post;
			
			$this->init_gallerybox_direct();
		}
		
			
		add_action('pre_get_posts', array($this, 'init_gallerybox'));
		add_action('admin_footer', array($this, 'footer_css'));
		add_action('admin_init', array($this, 'admin_init'));
		add_action('save_post', array($this, 'save_post'));
		
		// Track "Update" for related media attachments
		if(isset($_COOKIE['gb_hide_thickbox']) && $_COOKIE['gb_hide_thickbox'] == 1)
		{
			setcookie('gb_hide_thickbox', 0, time() - 1000);
			
			$this->remove_tb();
		}
		else
		{
			add_action('load-media.php', array($this, 'load_media'), 100, 3);
		}
	}
		
	// Check if the page is permitted to add the gallery box	
	public function _add_gallery_box()
	{
		extract($this->options);
		
		if( ! $this->post)
			return FALSE;
			
		if( ! is_array($post_types))
			$post_types = array($post_types);
		
		if( ! is_array($post_templates))
			$post_templates = array($post_templates);
		
		$cond = TRUE;
			
		if(is_numeric($post_id))
		{
			$cond = $cond && $post->ID == $post_id;
		}
		
		if(count($post_types))
		{
			$cond = $cond && in_array($this->post->post_type, $post_types);
		}
		
		if(count($post_templates))
		{
			$cond = $cond && in_array($this->post->_wp_page_template, $post_templates);
		}
		
		return $cond;
	}
	
	
	// Initialize Post and Metaboxes
	public function init_gallerybox()
	{
		global $post;
					
		# Add Meta Boxes
		if ( is_admin() ) {
			$this->post = $post;
			add_action('add_meta_boxes', array($this, 'add_metabox'), 10, 3);
		}
			
		/*
		if($this->post)
			$post = $this->post;
		
		if($post)
		{
			if($post)
				$this->post = $post;
			
			# Add Meta Boxes
			add_action('add_meta_boxes', array($this, 'add_metabox'), 10, 3);
		}*/
	}
	
	public function init_gallerybox_direct()
	{
		$this->add_metabox();
	}
	
	public function add_metabox()
	{
		extract($this->options);
		
		if($this->_add_gallery_box())
		{
			add_meta_box($this->field_id, $title, array($this, 'metabox_content'), $this->post->post_type, 'advanced');
		}
	}
	
	public function metabox_content($post)
	{
		global $wp_version;
		
		if(version_compare($wp_version, '3.5.0', '>='))
		{
			$this->gallery_box_style();
			$this->gallery_box_js();
			$this->gallery_box_html();
		}
		else
		{
			?>
			<div>Your WordPress version (<?php echo $wp_version; ?>) doesn't support Gallery Box! Please <a href="<?php echo admin_url('update-core.php'); ?>">update</a> your WordPress to 3.5 or newer version.</div>
			<?php
		}
	}
	
	private function gallery_box_style()
	{
		$id = $this->field_id;
?>
<style type="text/css">

#<?php echo $id; ?> {
	margin-top: 40px;
}

#<?php echo $id; ?> .hndle {
	top: -20px;
	position: relative;
	padding: 0;
	font-size: 11px;
	font-family: sans-serif;
	font-weight: bold;
	background: none;
	border: none;
	height: 0;
}

#<?php echo $id; ?> .handlediv {	
	position: relative;
	top: -28px;
	left: 8px;
	display: none;
}

#<?php echo $id; ?> .hndle span {
	font-weight: bold;
}

#<?php echo $id; ?> .inside {
	padding: 0;
	position: relative;
	margin: 0;
}

#<?php echo $id; ?> .gallery_box_toolbar {
	border-bottom: #DFDFDF solid 1px;
	background-color: #F1F1F1;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#F9F9F9), to(#ECECEC));
	background-image: -webkit-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -moz-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: -o-linear-gradient(top, #F9F9F9, #ECECEC);
	background-image: linear-gradient(to bottom, #F9F9F9, #ECECEC);
	padding: 8px;
}


#<?php echo $id; ?> .gallery_box_toolbar .gb_count {
	float: right;
	font-size: 13px;	
	font-family: sans-serif;
	color: #868686;
	position: relative;
	top: 3px;
	font-style: italic;
	margin-right: 5px;
	display: none;
}

#<?php echo $id; ?> .gallery_box_images_env {
	min-height: 100px;
	padding: 10px;
}

#<?php echo $id; ?> .no_images, 
#<?php echo $id; ?> .loading_images {
	font-size: 16px;
	font-family: Georgia,"Times New Roman","Bitstream Charter",Times,serif;
	color: #868686;
	text-align: center;
	padding: 38px 0;
	font-style: italic;
}

#<?php echo $id; ?> .gb_image_entry {
	position: relative;
	border: 1px solid #e7e7e7;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	-moz-background-clip: padding;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y3ZjdmNyIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2ZkZmRmZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgIDwvbGluZWFyR3JhZGllbnQ+Cgo8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0idXJsKCNoYXQwKSIgLz4KPC9zdmc+);
	background-image: -moz-linear-gradient(bottom, #f7f7f7 0%, #fdfdfd 100%);
	background-image: -o-linear-gradient(bottom, #f7f7f7 0%, #fdfdfd 100%);
	background-image: -webkit-linear-gradient(bottom, #f7f7f7 0%, #fdfdfd 100%);
	background-image: linear-gradient(bottom, #f7f7f7 0%, #fdfdfd 100%);
	padding: 10px;
	margin-bottom: 15px;
	padding-left: 15px;
	cursor: default;
}

#<?php echo $id; ?> .gb_image_entry .gb_border {
	position: absolute;
	display: block;
	margin: 0;
	padding: 0;
	left: 0;
	top: 0;
	bottom: 0;
	width: 5px;
	background: #1575a0;
	-moz-border-radius: 4px 0px 0px 4px;
	-webkit-border-radius: 4px 0px 0px 4px;
	border-radius: 4px 0px 0px 4px;
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail {
	float: left;
	width: 14.5%;
	position: relative;
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail .actions {
	position: absolute;
	bottom: 5px;
	right: 12px;
	left: 0px;
	padding: 5px;
	text-align: center;
	opacity: .0;
	-webkit-transition: all .2s linear;
}

#<?php echo $id; ?> .gb_image_entry:hover .gb_thumbnail .actions {
	-webkit-transition: all .37s linear;
	opacity: 1;
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail .actions a {
	display: inline-block;
	background: #FFF;
	color: #868686;
	padding: 3px 6px;
	text-decoration: none;
	font-size: 9px;
	line-height: 1.2;
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail .actions a.edit {
	-moz-border-radius: 4px 0px 0px 4px;
	-webkit-border-radius: 4px 0px 0px 4px;
	border-radius: 4px 0px 0px 4px;
	border-right: 1px solid rgba(100,100,100, .25);
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail .actions a.delete {
	-moz-border-radius: 0px 4px 4px 0px;
	-webkit-border-radius: 0px 4px 4px 0px;
	border-radius: 0px 4px 4px 0px;
	background: #fff2f5;
}

#<?php echo $id; ?> .gb_image_entry .gb_thumbnail .img {
	border: 5px solid #fff;
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,.1);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.1);
	box-shadow: 0 1px 3px rgba(0,0,0,.1);
	width: 105px;
	height: 90px;
	background: no-repeat center center;
	display: block;
	cursor: move;
	position: relative;
}

#<?php echo $id; ?> .gb_image_entry .gb_details {
	float: left;
	width: 84.5%;
}

#<?php echo $id; ?> .gb_image_entry .gb_details .detail span {
	display: block;
	font-size: 8px;
	text-transform: uppercase;
	color: #b2b2b2;
	margin: 0;
	line-height: 1.8;
}

#<?php echo $id; ?> .gb_image_entry .gb_details .detail p {
	display: block;
	margin: 0;
	font-size: 11px;
	padding: 0;
	line-height: 1.2;
	color: #868686;
}

#<?php echo $id; ?> .gb_image_entry .gb_details .detail p.bold {
	font-weight: bold;
}

#<?php echo $id; ?> .gb_placeholder {
	border: 2px dashed #DDD;
	padding: 60px;
	background: #ffffe5;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
}

#<?php echo $id; ?> .gb_image_entry .sep {
	border-top: 1px solid #ececec;
	border-bottom: 1px solid #FFF;
	margin: 5px 0;
}

.clearfix:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}

.clearfix {
    display: inline-block;
}

.clearfix {
    display: block;
}

</style>
<?php
	}

	private function gallery_box_js()
	{
		$id = $this->field_id;
		$attachments = $this->get_images();
		
		extract($this->options);
?>
<script type="text/javascript">
(function($, window, undefined)
{	
$(document).ready(function()
{
	var 
	gb_env = $("#<?php echo $id; ?>_wrapper"),
	
	gb_count = $('#<?php echo $id; ?> .gb_count'),
	
	opts = {
		title: '<?php echo esc_attr($title); ?>',
		multiple: <?php echo $multiple ? 'true' : 'false'; ?>,
		library: {
			type: 'image'
		}
	
	},
	
	add_image = $("#<?php echo $id; ?>_add_image"),
	
	frame = wp.media.frames.customHeader = wp.media(opts);
	
	add_image.click(function(ev){
	
		ev.preventDefault();

		frame.open();
	});
	
	
	var selected_attachments = <?php echo json_encode($attachments); ?>;
	
	
	gb_env.find('.gb_images_env').disableSelection().sortable({
		placeholder: 'gb_placeholder',
		items: '.gb_image_entry'
	});
	
	// Drag Safe
	gb_env.on({
		mousedown: function()
		{
			gb_env.height(gb_env.height());
		},
		
		mouseup: function()
		{
			gb_env.height('auto');
		}
	})
	
	// Edit Image
	gb_env.on('click', '.gb_image_entry .edit', function(ev)
	{
		ev.preventDefault();
		
		var href = $(this).attr('href');
		
		tb_show('Gallery Box - Update Media' , href + '&TB_iframe=1');
	});
	
	// Delete Image
	gb_env.on('click', '.gb_image_entry .delete', function(ev)
	{
		ev.preventDefault();
		
		var image_entry = $(this).parent().parent().parent();
		removeImage(image_entry.data('id'));
		
		image_entry.slideUp('normal', function()
		{
			image_entry.remove();
				
			if(selected_attachments.length == 0)
			{
				gb_env.find('.no_images').slideDown('fast');
			}
		});
	});
	
	frame.on('select', function(props, attachment) 
	{
		var attachments = frame.state().get('selection').models;
		
		_.each(attachments, function(attachment)
		{
			if( ! imageExists(attachment))
				selected_attachments.push(attachment.attributes);
		});
		
		updateImages();
	});
	
	frame.on('open', function()
	{
		var selection = frame.state().get('selection');
		
		$.each(selected_attachments, function(i, att)
		{
			attachment = wp.media.attachment(att.id);
            attachment.fetch();
            selection.add( attachment ? [ attachment ] : [] )
		});
	});
	
	// Render Images
	function updateImages()
	{
		var el = $('#<?php echo $id; ?>_list');
		
		gb_env.find('.no_images, .loading_images')[selected_attachments.length ? 'hide' : 'show']();			
							
		if(selected_attachments.length)
		{
			var options = {
				evaluate:    /<#([\s\S]+?)#>/g,
				interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
				escape:      /\{\{([^\}]+?)\}\}(?!\})/g
			};
			
			_.templateSettings = options;
			
			var html = $('#<?php echo $id; ?>_gbimageentry').html();
			var compiled = _.template( html );
			el.html( compiled( { images: selected_attachments } ) );
		}
		
		updateCounter();
		
	}
	
	function updateCounter()
	{				
		if(selected_attachments.length)
		{
			gb_count.show().html('<strong>' + selected_attachments.length  + '</strong> ' + (selected_attachments.length == 1 ? 'image' : 'images'));
		}
		else
		{
			gb_count.hide();
		}
	}
	
	updateImages();
	
	function removeImage(image_id)
	{
		var new_selected_attachments = [];
		
		for(var i in selected_attachments)
		{
			if(selected_attachments[i].id != image_id)
			{
				new_selected_attachments.push( selected_attachments[i] );
			}
		}
		
		selected_attachments = new_selected_attachments;
		updateCounter();
	}
	
	function imageExists(image)
	{
		if(selected_attachments)
		{
			var resp = false;
			
			_.each(selected_attachments, function(attachment)
			{
				if(attachment.id == image.id)
				{
					resp = true;
				}
			});
			
			return resp;
		}
		
		return false;
	}
});	
})(jQuery, window);

</script>
<script type="text/template" id="<?php echo $id; ?>_gbimageentry">
<# _.each(images, function(image){ #>
<li class="gb_image_entry clearfix" data-id="{{ image.id }}">
	<i class="gb_border"></i>
	
	<div class="gb_thumbnail">
		<div class="img" style="background-image: url({{ image.sizes.thumbnail ? image.sizes.thumbnail.url : '' }}); background-size: cover;"></div>
		<div class="actions">
			<a href="<?php echo admin_url(); ?>media.php?attachment_id={{ image.id }}&action=edit&gb_gallery=true" class="edit">Edit</a><a href="#" class="delete">Remove</a>
		</div>
	</div>
	
	<div class="gb_details">
		
		<div class="detail">
			<span>Title</span>
			<p class="bold">{{ image.title }}</p>
		</div>
		
		<div class="sep"></div>
		
		<# if(image.caption){ #>
		<div class="detail">
			<span>Caption</span>
			<p>{{ image.caption }}</p>
		</div>
		<# } else if(image.alt){ #>
		<div class="detail">
			<span>Alternative Text</span>
			<p>{{ image.alt }}</p>
		</div>
		<# } else { #>
		<div class="detail">
			<span>Name and Date</span>
			<p>{{ image.name }} / <em>{{ image.dateFormatted }}<em></p>
		</div>
		<# }; #>
		
		<# if(image.description){ #>
		<div class="sep"></div>
		
		<div class="detail">
			<span>Description</span>
			<p>{{ image.description }}</p>
		</div>
		<# }; #>
		
		<input type="hidden" name="<?php echo $id; ?>_images[]" value="{{ image.id }}" />
	</div>
</li>
<# }); #>
</script>
<?php
	}
	
	public function gallery_box_html()
	{
		$id = $this->field_id;
		$attachments = $this->get_images();
		
		$att_count = count($attachments);
?>
<div class="gallery_box_toolbar">
	<span class="gb_count"><strong>0</strong> images</span>
	
	<a href="#" class="button-primary" id="<?php echo $id; ?>_add_image">Add Image</a>
</div>

<div class="gallery_box_images_env" id="<?php echo $id; ?>_wrapper">
	<?php if(count($attachments)): ?>
	<div class="loading_images">Currently loading and processing <?php echo $att_count == 1 ? '<strong>1 image</strong>' : "<strong>{$att_count}</strong> images"; ?>...</div>
	<?php endif; ?>
	
	<div class="no_images" style="<?php echo $att_count ? 'display: none' : ''; ?>">There are currently no images. Click <strong>Add Image</strong> to add or upload images.</div>
	
	<ul id="<?php echo $id; ?>_list" class="gb_images_env">
	</ul>
</div>
<?php
	}
	
	public function footer_css()
	{
?>
<style type="text/css">
.gb-selected {
	opacity: .2;
}

.gb-selected.details.attachment {
	box-shadow: none !important;
}

.gb-selected .check {
	display: block !important;
}

<?php if(lab_get('gb_gallery')): ?>
#adminmenuwrap, #adminmenuback, #wpadminbar, #wpfooter, .add-new-h2, #screen-meta-links, tr.submit {
	display: none !important;
}

.media-upload-form .submit:first-child {
	display: none;
}

#wpcontent {
	margin-left: 15px !important;
	margin-top: -28px;
}
<?php endif; ?>

</style>
<?php
	}
	
	
	public function admin_init()
	{
		if($this->_add_gallery_box())
		{
			wp_enqueue_script(array('jquery-ui', 'jquery-ui-sortable'));
		}
	}
	
	
	public function save_post($post_id)
	{
		global $post;
		
		if(defined("DOING_AUTOSAVE"))
		{
			return FALSE;
		}
		
		// Initialize Post
		$this->post = $post;
		
		if($this->_add_gallery_box())
		{
			// Request Images Array
			$attachment_ids = isset($_POST[ $this->field_id . '_images' ]) ? $_POST[ $this->field_id . '_images' ] : array();
			
			if( ! is_array($attachment_ids))
				$attachment_ids = array();
			
			update_post_meta($post_id, $this->field_id, $attachment_ids);
		}
	}
	
	
	public function load_media()
	{
		$post = get_post($_GET['attachment_id']);
		
		if(isset($_POST['save']) && $_GET['gb_gallery'])
		{
			setcookie('gb_hide_thickbox', 1, time() + 60);
		}
	}
	
	protected function remove_tb()
	{
?>
<style>
body {
}

h3 {		
	font-size: 14px;
	font-family: Georgia,"Times New Roman","Bitstream Charter",Times,serif;
	color: #868686;
	text-align: center;
	padding: 20px 0;
	font-style: italic;
}
</style>
<h3>Changes have been saved! Closing this window now...</h3>
<script type="text/javascript">
parent.tb_remove();
</script>
<?php
		exit;
	}
	
	
	public function get_images($post_id = null, $js_format = TRUE)
	{
		$post = get_post($post_id);
		$attachments = array();
		
		$attachment_ids = get_post_meta($post->ID, $this->field_id, TRUE);
				
		# Inherit Legacy Gallery from Inline Media Metabox (created by Laborator)
		if( ! $attachment_ids && $this->options['inherit_imm'])
		{	
			$filter = array(
				'post_parent' => $post->ID,
				'post_type' => 'attachment',
				'post_status' => 'any',
				'posts_per_page' => -1
			);
			
			$attachments = new WP_Query($filter);
			$attachments = $attachments->posts;
		}
		
		if(is_array($attachment_ids) && count($attachment_ids))
		{	
			# Attachments
			$filter = array(
				'post__in' => $attachment_ids,
				'post' => $attachment_ids,
				'post_type' => 'attachment',
				'post_status' => 'any',
				'orderby' => 'post__in',
				'posts_per_page' => -1
			);

			$attachments = new WP_Query($filter);
			$attachments = $attachments->posts;
		}
		
		if($js_format)
		{	
			foreach($attachments as & $attachment)
			{
				$attachment = wp_prepare_attachment_for_js($attachment);
			}
		}
		
		return $attachments;
	}
}


function gb_field($field_id, $js_format = FALSE, $inherit_imm = TRUE)
{
	global $post;
	
	$copy_of_post = $post;
	
	$attachments = array();
	
	# If post is not defined, then do not fetch any image.
	if ( ! $post )
	{
		return $attachments;
	}
	
	$attachment_ids = get_post_meta($post->ID, $field_id, TRUE);
			
	# Inherit Legacy Gallery from Inline Media Metabox (created by Laborator)
	if( ! $attachment_ids && $inherit_imm)
	{	
		$filter = array(
			'post_parent' 		=> $post->ID,
			'post_type' 		=> 'attachment',
			'post_status'		=> 'any',
			'posts_per_page'	=> -1
		);
		
		$attachments = get_children($filter);
	}
	
	if(is_array($attachment_ids) && count($attachment_ids))
	{	
		# Attachments
		$filter = array(
			'post__in' 			=> $attachment_ids,
			'post' 				=> $attachment_ids,
			'post_type' 		=> 'attachment',
			'post_status' 		=> 'any',
			'orderby' 			=> 'post__in',
			'posts_per_page' 	=> -1
		);

		$attachments = get_posts($filter);
	}
	
	if($js_format)
	{	
		foreach($attachments as & $attachment)
		{
			$attachment = wp_prepare_attachment_for_js($attachment);
		}
	}
	
	$thumbnail_id = get_post_thumbnail_id($copy_of_post->ID);
	
	if($thumbnail_id && isset($attachments[$thumbnail_id]))
	{
		unset($attachments[$thumbnail_id]);
	}
	
	$post = $copy_of_post;
	setup_postdata( $post );
	
	return $attachments;
}
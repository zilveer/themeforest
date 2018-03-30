<?php
// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * Functions that support AJAX callbacks.
 *
 */
if (!class_exists("Shiba_Media_Manager")) :
	 
class Shiba_Media_Manager {

	function __construct() {
		global $shiba_mlib;
		
		if ($shiba_mlib->is_option('ex_search')) {
			add_filter( 'media_view_settings', array($this, 'media_view_settings'), 10, 2);
//			add_filter( 'media_view_strings', array($this, 'media_view_strings'), 10, 2);
		}
		
		if (defined('DOING_AJAX') &&isset($_REQUEST['action']) && ($_REQUEST['action'] == 'query-attachments') ) {

			add_action('wp_ajax_query-attachments', array($this, 'wp_ajax_query_attachments'), 1);
			if (!isset($_REQUEST['query']) || !isset($_REQUEST['query']['s'])) return;
			// Expand image search to use both title and alt
//			add_action('pre_get_posts', array($shiba_mlib->ajax, 'ajax_query_attachments'));
			if (( $shiba_mlib->is_option('alt_search') || 
				  $shiba_mlib->is_option('ex_search')) && 
				isset($_REQUEST['query']['post_mime_type']) && ($_REQUEST['query']['post_mime_type'] == 'image'))
				add_filter( 'ajax_query_attachments_args', array($this, 'ajax_query_attachments'));
		}
		
	}

	function admin_head() { ?>
    	<style>
    	.attachment .icon { padding-top: 0px; margin: auto;}
		.attachment .attachment-preview { overflow:hidden; }
		.attachment .landscape .icon {
			max-width: 100%;
			height: 100%;
		}
		.attachment .portrait .icon {
			width: 100%;
			max-height: 100%;
		}
		</style>
    <?php }
	
	
	// Add menu options for posts, pages, and other custom post types into media manager
	function media_view_settings($settings, $post) {
		global $shiba_mlib;
		
		// Add in post types
		foreach ($shiba_mlib->post_types as $slug => $label) {
			if ($slug == 'attachment') continue;
			$settings['postTypes'][$slug] = $label;	
		}
		
//		add_action( 'admin_head', array($this, 'admin_head'));

		// Override some media manager javascript functions
		add_action( 'admin_print_footer_scripts', array($this, 'override_filter_object'), 51);
		// Override attachment template - i.e. how attachment objects are viewed
		// in the media manager interface
//		add_action( 'admin_footer', array($this, 'print_media_templates'), 5);
		return $settings;	
	}

	function media_view_strings($strings, $post) {
		return $strings;	
	}

	function override_filter_object() { ?>
    	<script type="text/javascript">
		// Add custom post type filters
		l10n = wp.media.view.l10n = typeof _wpMediaViewsL10n === 'undefined' ? {} : _wpMediaViewsL10n;
		wp.media.view.AttachmentFilters.Uploaded.prototype.createFilters = function() {
			var type = this.model.get('type'),
				types = wp.media.view.settings.mimeTypes,
				text;
			if ( types && type )
				text = types[ type ];

			filters = {
				all: {
					text:  text || l10n.allMediaItems,
					props: {
						uploadedTo: null,
						orderby: 'date',
						order:   'DESC'
					},
					priority: 10
				},

				uploaded: {
					text:  l10n.uploadedToThisPost,
					props: {
						uploadedTo: wp.media.view.settings.post.id,
						orderby: 'menuOrder',
						order:   'ASC'
					},
					priority: 20
				}
			};
			// Add post types only for gallery
			if (this.options.controller._state.indexOf('gallery') !== -1) {
				delete(filters.all);
				filters.image = {
					text:  'Images',
					props: {
						type:    'image',
						uploadedTo: null,
						orderby: 'date',
						order:   'DESC'
					},
					priority: 10
				};
				_.each( wp.media.view.settings.postTypes || {}, function( text, key ) {
					filters[ key ] = {
						text: text,
						props: {
							type:    key,
							uploadedTo: null,
							orderby: 'date',
							order:   'DESC'
						}
					};
				});
			}
			this.filters = filters;
			
		}; // End create filters

		wp.media.view.AttachmentFilters.Uploaded.prototype.select = function() {
//			console.log("select " + this.$el.val());
			// Don't switch to Image every time
			if (this.options.controller._state.indexOf('gallery') !== -1) {
				// Set filter based on view
				this.$el.val(this.model.attributes.type);
				return;
			}
				
			var model = this.model,
				value = 'all',
				props = model.toJSON();

			_.find( this.filters, function( filter, id ) {
				var equal = _.all( filter.props, function( prop, key ) {
					return prop === ( _.isUndefined( props[ key ] ) ? null : props[ key ] );
				});
				if ( equal )
					return value = id;
			});
			this.$el.val( value );
		};
		
		</script>
    <?php }
	
	// From wp-includes/media-template.php
	function print_media_templates() { ?>
		<script type="text/html" id="tmpl-attachment">
            <div class="attachment-preview js--select-attachment type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
                <div class="thumbnail">
                    <# if ( data.uploading ) { #>
                        <div class="media-progress-bar"><div style="width: {{ data.percent }}%"></div></div>
                    <# } else if ( 'image' === data.type && data.sizes ) { #>
                        <div class="centered">
                            <img src="{{ data.size.url }}" draggable="false" alt="" />
                        </div>
 					<# } else if ( ('video' === data.type) || ('audio' === data.type) || ('media' === data.type) ) { #>
                        <div class="centered">
                            <# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
                                <img src="{{ data.image.src }}" class="thumbnail" draggable="false" />
                            <# } else { #>
                                <img src="{{ data.icon }}" class="icon" draggable="false" />
                            <# } #>
                        </div>
                        <div class="filename">
                            <div>{{ data.filename }}</div>
                        </div>
					<# } else { // Custom post types 
						#>
						<div class="thumbnail">
							<div class="centered">
								<img src="{{ data.url }}" draggable="false" />
							</div>
						</div>
						<div class="filename">
							<# if ( !data.describe ) { #>
								<div>{{ data.title }}</div>
							<# } else { #>
								<div>{{ data.type }}</div>						
							<# } #>
						</div>
					<# } #>

                </div>
                <# if ( data.buttons.close ) { #>
                    <a class="close media-modal-icon" href="#" title="<?php esc_attr_e('Remove'); ?>"></a>
                <# } #>
            </div>
            <# if ( data.buttons.check ) { #>
                <a class="check" href="#" title="<?php esc_attr_e('Deselect'); ?>" tabindex="-1"><div class="media-modal-icon"></div></a>
            <# } #>
            <#
            var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
            if ( data.describe ) {
                if ( 'image' === data.type ) { #>
                    <input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
                        placeholder="<?php esc_attr_e('Caption this image&hellip;'); ?>" {{ maybeReadOnly }} />
                <# } else { #>
                    <input type="text" value="{{ data.title }}" class="describe" data-setting="title"
                        <# if ( 'video' === data.type ) { #>
                            placeholder="<?php esc_attr_e('Describe this video&hellip;'); ?>"
                        <# } else if ( 'audio' === data.type ) { #>
                            placeholder="<?php esc_attr_e('Describe this audio file&hellip;'); ?>"
                        <# } else { #>
                            placeholder="<?php esc_attr_e('Describe this media file&hellip;'); ?>"
                        <# } #> {{ maybeReadOnly }} />
                <# }
            } #>
        </script>
    
<!--    
	<script type="text/html" id="tmpl-attachment">
		<div class="attachment-preview type-{{ data.type }} subtype-{{ data.subtype }} {{ data.orientation }}">
			<# if ( data.uploading ) { #>
				<div class="media-progress-bar"><div></div></div>
			<# } else if ( 'image' === data.type ) { #>
				<div class="thumbnail">
					<div class="centered">
						<img src="{{ data.size.url }}" draggable="false" />
					</div>
				</div>
			<# } else if ( ('video' === data.type) || ('audio' === data.type) || ('media' === data.type) ) { #>
				<img src="{{ data.icon }}" class="icon" draggable="false" />
				<div class="filename">
					<div>{{ data.filename }}</div>
				</div>
			<# } else { // Custom post types 
				#>
				<div class="thumbnail">
					<div class="centered">
						<img src="{{ data.url }}" draggable="false" />
					</div>
				</div>
				<div class="filename">
					<# if ( !data.describe ) { #>
						<div>{{ data.title }}</div>
					<# } else { #>
						<div>{{ data.type }}</div>						
					<# } #>
				</div>
			<# } #>

			<# if ( data.buttons.close ) { #>
				<a class="close media-modal-icon" href="#" title="<?php _e('Remove'); ?>"></a>
			<# } #>

			<# if ( data.buttons.check ) { #>
				<a class="check" href="#" title="<?php _e('Deselect'); ?>"><div class="media-modal-icon"></div></a>
			<# } #>
		</div>
		<#
		var maybeReadOnly = data.can.save || data.allowLocalEdits ? '' : 'readonly';
		if ( data.describe ) { #>
			<# if ( 'image' === data.type ) { #>
				<input type="text" value="{{ data.caption }}" class="describe" data-setting="caption"
					placeholder="<?php esc_attr_e('Caption this image&hellip;'); ?>" {{ maybeReadOnly }} />
			<# } else { #>
				<input type="text" value="{{ data.title }}" class="describe" data-setting="title"
					<# if ( 'video' === data.type ) { #>
						placeholder="<?php esc_attr_e('Describe this video&hellip;'); ?>"
					<# } else if ( 'audio' === data.type ) { #>
						placeholder="<?php esc_attr_e('Describe this audio file&hellip;'); ?>"
					<# } else { #>
						placeholder="<?php esc_attr_e('Describe this media file&hellip;'); ?>"
					<# } #> {{ maybeReadOnly }} />
			<# } #>
		<# } #>
	</script>
    -->
	<?php }    

	// From wp-admin/includes/ajax-actions.php
	function wp_ajax_query_attachments() {
		if ( ! current_user_can( 'upload_files' ) )
			wp_send_json_error();
	
		$query = isset( $_REQUEST['query'] ) ? (array) $_REQUEST['query'] : array();
		$query = array_intersect_key( $query, array_flip( array(
			's', 'order', 'orderby', 'posts_per_page', 'paged', 'post_mime_type',
			'post_parent', 'post__in', 'post__not_in',
		) ) );

		// Check if post__in then enable query for all types
		if (isset($query['post__in']) && isset($query['post_mime_type']) && ($query['post_mime_type'] == "image")) {
			$query['post_type'] = 'any';
			$query['post_status'] = array('inherit', 'publish');
			unset($query['post_mime_type']);
		} elseif (isset($query['post_mime_type']) && ($query['post_mime_type'] != "image")) {
			// post type
			$query['post_type'] = $query['post_mime_type'];
			$query['post_status'] = 'publish';
			unset($query['post_mime_type']);
		} else { 
			// image
			$query['post_type'] = 'attachment';
			$query['post_status'] = 'inherit';
			if ( current_user_can( get_post_type_object( 'attachment' )->cap->read_private_posts ) )
				$query['post_status'] .= ',private';
		}
		
		$query = apply_filters( 'ajax_query_attachments_args', $query );
		$query = new WP_Query( $query );
	
//		$posts = array_map( 'wp_prepare_attachment_for_js', $query->posts );
		$posts = array_map( array($this, 'prepare_items_for_js'), $query->posts );
		$posts = array_filter( $posts );
	
		wp_send_json_success( $posts );
	}
	
	function ajax_query_attachments($query) {
		global $shiba_mlib;
		
		// Do $query->query_vars if we need to use 'pre_get_posts 
		$query['meta_key'] = '_wp_attachment_image_alt';
		$query['meta_value'] = $query['s'];
		$query['meta_compare'] = 'LIKE';
		add_filter('posts_where', array($this, 'image_posts_where') );
		
		return $query;
	}

	function image_posts_where($where) {
		global $wpdb;
		$where = str_replace("AND ( ({$wpdb->postmeta}.meta_key =", "OR ( ({$wpdb->postmeta}.meta_key =", $where);
		return $where;
	}

	function prepare_items_for_js($item) {
		switch($item->post_type) {
		case 'attachment':
			return wp_prepare_attachment_for_js($item);
		case 'post':
		case 'page':
		case 'gallery':
		default:
			return $this->prepare_post_for_js($item);
		}
	}
	
	function prepare_post_for_js( $post ) {
		if ( ! $post = get_post( $post ) )
			return;
	
		$attachment_id = get_post_thumbnail_id( $post->ID );
		$attachment = get_post($attachment_id);
		$post_link = get_permalink( $post->ID );

//		$type = 'image'; $subtype = 'png';
		$type = $post->post_type; $subtype = 'none';
		if ($attachment) {
			$url = wp_get_attachment_url( $attachment->ID );
		} else { // Show default image
			$url = includes_url('images/crystal/default.png'); // get_permalink( $post->ID );
		}
		
		$response = array(
			'id'          => $post->ID,
			'title'       => $post->post_title, 
			'filename'    => wp_basename( $post_link ), 
			'url'         => $url,
			'link'        => $post_link,
			'alt'         => '',
			'author'      => $post->post_author,
			'description' => $post->post_content,
			'caption'     => $post->post_excerpt,
			'name'        => $post->post_name,
			'status'      => $post->post_status,
			'uploadedTo'  => $post->post_parent,
			'date'        => strtotime( $post->post_date_gmt ) * 1000,
			'modified'    => strtotime( $post->post_modified_gmt ) * 1000,
			'menuOrder'   => '', // $attachment->menu_order,
			'mime'        => '', // $attachment->post_mime_type,
			'type'        => $type,
			'subtype'     => $subtype,
			'icon'        => $url, // wp_mime_type_icon( $attachment_id ),
			'dateFormatted' => mysql2date( get_option('date_format'), $post->post_date ),
			'nonces'      => array(
				'update' => false,
				'delete' => false,
			),
			'editLink'   => false,
		);
	
		// Don't allow delete or update for posts. So don't create nonces.
		
		return apply_filters( 'wp_prepare_post_for_js', $response, $post );
	}

} // end class	
endif;
?>
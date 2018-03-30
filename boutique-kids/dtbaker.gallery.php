<?php

if ( ! defined( 'ABSPATH' ) ) exit;


class boutique_custom_gallery {
    /**
     * Stores the class instance.
     *
     * @var boutique_custom_gallery
     */
    private static $instance = null;


    /**
     * Returns the instance of this class.
     *
     * It's a singleton class.
     *
     * @return boutique_custom_gallery The instance
     */
    public static function get_instance() {

        if ( ! self::$instance ){
	        self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Initialises the plugin.
     */
    public function init_plugin() {

        $this->init_hooks();
    }

    /**
     * Initialises the WP actions.
     *  - admin_print_scripts
     */
    private function init_hooks() {

        add_action( 'wp_enqueue_media', array( $this, 'wp_enqueue_media' ) );
        add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
        add_action( 'admin_print_footer_scripts', array( $this, 'admin_print_footer_scripts' ), 100 );
		//return apply_filters( 'wp_prepare_attachment_for_js', $response, $attachment, $meta );
	    add_filter( 'wp_prepare_attachment_for_js', array($this, 'wp_prepare_attachment_for_js'), 10, 3 );
    }

	public function wp_prepare_attachment_for_js($response, $attachment, $meta){
		if(isset($response['id']) && $response['id'] > 0){
			$response['_slidercolor'] = get_post_meta($response['id'], '_slidercolor', true);
		}
		return $response;
	}

    /**
     * Enqueues the script.
     */
    public function wp_enqueue_media() {

        if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' )
            return;

    }

    public function admin_print_footer_scripts() {
	    if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
		    return;
	    }
	    ?>

	    <script type="text/javascript">
		    ( function( $ ) {

                var postID = $( '#post_ID' ).val() || 0;
                var custom_gallery = _.extend( {}, {

                    edit: function( text, update ) {
                        var media = wp.media[ this.type ],
                            frame = media.edit( text );

                        this.pausePlayers && this.pausePlayers();

                        _.each( this.state, function( state ) {
                            frame.state( state ).on( 'update', function( selection ) {
                                update( media.shortcode( selection ).string() );
                            } );
                        } );

                        frame.on( 'close', function() {
                            frame.detach();
                        } );

                        frame.open();
                    },
                    state: [ 'gallery-edit' ],
                    template: wp.media.template( 'editor-gallery' ),

                    initialize: function() {
                        var attachments = wp.media.gallery.attachments( this.shortcode, postID ),
                            attrs = this.shortcode.attrs.named,
                            self = this;

                        if(typeof attrs.slider != 'undefined'){
                            switch(attrs.slider){
                                case 'flexslider':
                                    this.template = wp.media.template( 'editor-gallery-dtbaker-flexslider' );
                                    break;
                                case 'flex':
                                    this.template = wp.media.template( 'editor-gallery-dtbaker-flex' );
                                    break;
                                case 'pretty':
                                    this.template = wp.media.template( 'editor-gallery-dtbaker-pretty' );
                                    break;
                                case 'profile':
                                    this.template = wp.media.template( 'editor-gallery-dtbaker-profile' );
                                    break;
                                default:
                                // leave the existing template (editor-gallery)
                            }
                        }

                        attachments.more()
                            .done( function() {
                                attachments = attachments.toJSON();
                                _.each( attachments, function( attachment ) {
                                    if ( attachment.sizes ) {
                                        if ( attrs.size && attachment.sizes[ attrs.size ] ) {
                                            attachment.thumbnail = attachment.sizes[ attrs.size ];
                                        } else if ( attachment.sizes.thumbnail ) {
                                            attachment.thumbnail = attachment.sizes.thumbnail;
                                        } else if ( attachment.sizes.full ) {
                                            attachment.thumbnail = attachment.sizes.full;
                                        }
                                    }
                                } );
                                self.render( self.template( {
	                                verifyHTML: function(){},
                                    attachments: attachments,
                                    columns: attrs.columns ? parseInt( attrs.columns, 10 ) : wp.media.galleryDefaults.columns
                                } ) );
                            } )
                            .fail( function( jqXHR, textStatus ) {
                                self.setError( textStatus );
                            } );
                    }
                } );
                wp.mce.views.unregister('gallery');
                wp.mce.views.register('gallery',custom_gallery);

		    })(jQuery);

	        function dtbaker_slider_instructions(type){
		        switch(type){
			        case 'no':
				        jQuery('#dtbaker_slider_instructions').text('');
				        break;
			        case 'profile':
				        jQuery('#dtbaker_slider_instructions').text('Please set "Size" to "Medium" above. Then click on each gallery image and enter a "Title", "Caption", "Description" and optional "Image Link".');
				        break;
			        case 'flex':
				        jQuery('#dtbaker_slider_instructions').text('Please set "Size" to "Medium" above.');
				        break;
			        case 'flexslider':
				        jQuery('#dtbaker_slider_instructions').text('Please set "Size" to "Large" above. Then click on each gallery image and enter a "Title", "Caption" and optional "Image Link". The ideal image size is 697px by 300px');
				        break;
			        case 'pretty':
				        jQuery('#dtbaker_slider_instructions').text('Please set "Size" to "Medium" above. Then click on each gallery image and enter a "Title", "Caption" and optional "Image Link". The ideal image size is 160px by 140px.');
				        break;
			        default:
				        jQuery('#dtbaker_slider_instructions').text('');
		        }
	        }
            ( function( $ ) {
                var media = wp.media;

	            media.view.Attachment = media.view.Attachment.extend({
		            toggleSelectionHandler: function(event){
			            alert('select');
			            media.view.Attachment.prototype.toggleSelectionHandler(event);
		            }
	            });

                media.view.Settings.Gallery = media.view.Settings.Gallery.extend({
                    render: function() {
                        media.view.Settings.prototype.render.apply( this, arguments );

                        // Append the custom template
                        this.$el.append( media.template( 'custom-gallery-setting' ) );

                        // Save the setting
                        media.gallery.defaults.size = 'large';
                        media.gallery.defaults.slider = 'no';
                        //media.gallery.defaults.link = 'file'; // not sure if this will go fucky or not.

                        this.update.apply( this, ['size'] );
                        this.update.apply( this, ['slider'] );

	                    jQuery('body').delegate('.dtbaker_slider_settings','change',function(){
		                    dtbaker_slider_instructions(jQuery(this).val());
	                    });
	                    jQuery('.dtbaker_slider_settings').change();


                        return this;
                    }
                } );
            } )( jQuery );
	    </script>
    <?php
    }
    /**
     * Outputs the view template with the custom setting.
     */
    public function print_media_templates() {

        if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' )
            return;

        ?>

	    <script type="text/html" id="tmpl-editor-gallery-dtbaker-pretty">
			<# if ( data.attachments ) { #>
				<div class="gallery gallery-columns-{{ data.columns }} gallery-dtbaker-pretty">
					<# _.each( data.attachments, function( attachment, index ) { #>
						<dl class="gallery-item">
							<dd class="gallery-icon">
								<div class='gallery-icon-inner' <# if ( attachment._slidercolor ) { #> style="background-color: {{ attachment._slidercolor }}" <# } #>>
								<# if ( attachment.medium ) { #>
									<img src="{{ attachment.medium.url }}" width="{{ attachment.medium.width }}" height="{{ attachment.medium.height }}" />
								<# } else if ( attachment.thumbnail ) { #>
									<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" />
								<# } else { #>
									<img src="{{ attachment.url }}" />
								<# } #>
								</div>
							</dd>
							<# if ( attachment.title ) { #>
							<dt class="dtbaker-pretty-title">
								{{ attachment.title }}
							</dt>
							<# } #>
							<# if ( attachment.caption ) { #>
								<dt class="wp-caption-text gallery-caption">
									{{ attachment.caption }}
								</dt>
							<# } #>
						</dl>
						<# if ( index % data.columns === data.columns - 1 ) { #>
							<br style="clear: both;">
						<# } #>
					<# } ); #>
				</div>
			<# } else { #>
				<div class="wpview-error">
					<div class="dashicons dashicons-format-gallery"></div><p><?php _e( 'No items found.','boutique-kids' ); ?></p>
				</div>
			<# } #>
		</script>
	    <script type="text/html" id="tmpl-editor-gallery-dtbaker-profile">
			<# if ( data.attachments ) { #>
				<div class="gallery gallery-columns-{{ data.columns }} gallery-dtbaker-profile">
					<# _.each( data.attachments, function( attachment, index ) { #>
						<dl class="gallery-item">
							<dt class="gallery-icon">
								<div class='gallery-icon-inner' <# if ( attachment._slidercolor ) { #> style="background-color: {{ attachment._slidercolor }}" <# } #>>
								<# if ( attachment.medium ) { #>
									<img src="{{ attachment.medium.url }}" width="{{ attachment.medium.width }}" height="{{ attachment.medium.height }}" />
								<# } else if ( attachment.thumbnail ) { #>
									<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" />
								<# } else { #>
									<img src="{{ attachment.url }}" />
								<# } #>
								</div>
							</dt>
							<# if ( attachment.title ) { #>
							<dt class="dtbaker-pretty-title">
								{{ attachment.title }}
							</dt>
							<# } #>
							<# if ( attachment.caption ) { #>
								<dt class="wp-caption-text gallery-caption">
									{{ attachment.caption }}
								</dt>
							<# } #>
							<# if ( attachment.description ) { #>
							<dt class="dtbaker-pretty-description">
								{{ attachment.description }}
							</dt>
							<# } #>
						</dl>
						<# if ( index % data.columns === data.columns - 1 ) { #>
							<br style="clear: both;">
						<# } #>
					<# } ); #>
				</div>
			<# } else { #>
				<div class="wpview-error">
					<div class="dashicons dashicons-format-gallery"></div><p><?php _e( 'No items found.','boutique-kids' ); ?></p>
				</div>
			<# } #>
		</script>
	    <script type="text/html" id="tmpl-editor-gallery-dtbaker-flex">
			<# if ( data.attachments ) { #>
				<div class="gallery gallery-columns-{{ data.columns }} gallery-dtbaker-flex">
					<# _.each( data.attachments, function( attachment, index ) { #>
						<dl class="gallery-item">
							<dt class="gallery-icon">
								<div class='gallery-icon-inner' <# if ( attachment._slidercolor ) { #> style="background-color: {{ attachment._slidercolor }}" <# } #>>
								<# if ( attachment.medium ) { #>
									<img src="{{ attachment.medium.url }}" width="{{ attachment.medium.width }}" height="{{ attachment.medium.height }}" />
								<# } else if ( attachment.thumbnail ) { #>
									<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" />
								<# } else { #>
									<img src="{{ attachment.url }}" />
								<# } #>
								</div>
							</dt>
						</dl>
						<# if ( index % data.columns === data.columns - 1 ) { #>
							<br style="clear: both;">
						<# } #>
					<# } ); #>
				</div>
			<# } else { #>
				<div class="wpview-error">
					<div class="dashicons dashicons-format-gallery"></div><p><?php _e( 'No items found.','boutique-kids' ); ?></p>
				</div>
			<# } #>
		</script>
	    <script type="text/html" id="tmpl-editor-gallery-dtbaker-flexslider">
		    Flex Image Slider Will Appear Here:
			<# if ( data.attachments ) { #>
				<div class="gallery gallery-columns-{{ data.columns }}">
					<# _.each( data.attachments, function( attachment, index ) { #>
						<dl class="gallery-item">
							<dt class="gallery-icon">
								<# if ( attachment.thumbnail ) { #>
									<img src="{{ attachment.thumbnail.url }}" width="{{ attachment.thumbnail.width }}" height="{{ attachment.thumbnail.height }}" />
								<# } else { #>
									<img src="{{ attachment.url }}" />
								<# } #>
							</dt>
							<dd class="wp-caption-text gallery-caption">
								<# if ( attachment.title ) { #>
								{{ attachment.title }}
								<# } #>
									-
								<# if ( attachment.caption ) { #>
									{{ attachment.caption }}
								<# } #>
							</dd>
						</dl>
						<# if ( index % data.columns === data.columns - 1 ) { #>
							<br style="clear: both;">
						<# } #>
					<# } ); #>
				</div>
			<# } else { #>
				<div class="wpview-error">
					<div class="dashicons dashicons-format-gallery"></div><p><?php esc_html_e( 'No items found.', 'boutique-kids'); ?></p>
				</div>
			<# } #>
		</script>

        <script type="text/html" id="tmpl-custom-gallery-setting">
            <label class="setting">
                <span><?php esc_html_e('Gallery Type', 'boutique-kids');?></span>
                <select class="type dtbaker_slider_settings" name="slider" data-setting="slider">
                    <?php
                    $options = array(
                        'no' => __('Gallery (Default)','boutique-kids'),
                        'profile' => __('Gallery (Profile)','boutique-kids'),
                        'pretty' => __('Gallery (Styled Buttons)','boutique-kids'),
                        'flex' => __('Gallery (Flex)','boutique-kids'),
                        'flexslider' => __('Home Image Slider','boutique-kids'),
                    );
                    foreach ( $options as $value => $name ) { ?>
                        <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'no' ); ?>>
                            <?php echo esc_html( $name ); ?>
                        </option>
                    <?php } ?>
                </select>
	            <span>Please set "Link To" as "Media File" above.</span><span id="dtbaker_slider_instructions"></span>
            </label>
        </script>
        <?php
    }

}

// Put your hands up...
add_action( 'admin_init', array( boutique_custom_gallery::get_instance(), 'init_plugin' ), 20 );

add_filter('post_gallery', 'dtbaker_boutique_post_gallery', 10, 2);
if(!function_exists('dtbaker_boutique_post_gallery')) {
	function dtbaker_boutique_post_gallery( $output, $attr ) {
		if ( $output != '' ) {
			return $output;
		}
		global $post;
		static $gallery_count = 0;
		$gallery_count ++;

		// copy of gallery output function from wp-includes/media.php
		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		extract( shortcode_atts( array(
			'order'        => 'ASC',
			'orderby'      => 'menu_order ID',
			'id'           => $post->ID,
			'itemtag'      => 'dl',
			'icontag'      => 'dd',
			'instance'     => '',
			'captiontag'   => 'dt',
			'show_caption' => true,
			'columns'      => 3,
			'size'         => 'boutique_gallery',
			'include'      => '',
			'exclude'      => ''
		), $attr ) );


		$id = intval( $id );
		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}

		if ( ! empty( $include ) ) {
			$_attachments = get_posts( array(
				'include'        => $include,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		} elseif ( ! empty( $exclude ) ) {
			$attachments = get_children( array(
				'post_parent'    => $id,
				'exclude'        => $exclude,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		} else {
			$attachments = get_children( array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $order,
				'orderby'        => $orderby
			) );
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			}

			return $output;
		}


		$size_class = sanitize_html_class( $size );
		$selector   = "gallery-{$id}-{$gallery_count}";


		if ( isset( $attr['slider'] ) ) {
			switch ( $attr['slider'] ) {
				case 'flexslider':
					ob_start();
					?>
					<script type="text/javascript">
						jQuery(window).load(function () {
							jQuery('.flexslider').flexslider({
								controlNav: false
							});
						});
					</script>

					<div id="<?php echo esc_attr( $selector ); ?>"
					     class="gallery gallery-slider galleryid-<?php echo (int) $id; ?> gallery-count-<?php echo (int) $gallery_count; ?> gallery-size-<?php echo esc_attr( $size_class ); ?> fancy_border">
						<div class="flexslider">
							<ul class="slides">
								<?php
								foreach ( $attachments as $id => $attachment ) {
									//$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

									$url      = wp_get_attachment_image_src( $attachment->ID, $size );
									$link_url = get_post_meta( $attachment->ID, '_sliderlink', true );
									?>
									<li>
										<?php if ( $link_url ) { ?>
											<a href="<?php echo esc_attr( $link_url ); ?>"><img
													src="<?php echo esc_attr( $url[0] ); ?>"
													alt="<?php echo esc_attr( $attachment->post_excerpt ); ?>"
													title="<?php echo esc_attr( $attachment->post_excerpt ); ?>"
													width="<?php echo (int)$url[1];?>" height="<?php echo (int)$url[2];?>"></a>
										<?php } else { ?>
											<img src="<?php echo esc_attr( $url[0] ); ?>"
											     alt="<?php echo esc_attr( $attachment->post_excerpt ); ?>"
											     title="<?php echo esc_attr( $attachment->post_excerpt ); ?>"
											     width="<?php echo (int)$url[1];?>" height="<?php echo (int)$url[2];?>">
										<?php } ?>
										<?php if ( trim( $attachment->post_excerpt ) || trim( $attachment->post_title ) ) { ?>
											<?php if ( $link_url ) { ?>
												<a href="<?php echo esc_attr( $link_url ); ?>" class="flex-caption">
													<?php
													if ( trim( $attachment->post_title ) ) { ?>
														<span><?php echo wptexturize( $attachment->post_title ); ?></span> <?php
													}
													echo wptexturize( $attachment->post_excerpt ); ?>
												</a>
											<?php } else { ?>

												<p class="flex-caption">
													<?php
													if ( trim( $attachment->post_title ) ) { ?>
														<span><?php echo wptexturize( $attachment->post_title ); ?></span> <?php
													}
													echo wptexturize( $attachment->post_excerpt ); ?>
												</p>
											<?php } ?>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php

					return ob_get_clean();
			}

		}

		$itemtag    = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$icontag    = tag_escape( $icontag );
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'dl';
		}
		if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'dt';
		}
		if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'dd';
		}

		$columns   = intval( $columns );
		$itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
		$float     = is_rtl() ? 'right' : 'left';


		$gallery_style = $gallery_div = '';

		$gallery_type = isset( $attr['slider'] ) ? ' gallery-dtbaker-' . $attr['slider'] : '';
		$gallery_div  = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}{$gallery_type}'>";
		$output       = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {

			$link_url = get_post_meta( $attachment->ID, '_sliderlink', true );
			if ( $link_url ) {
				$link = '<a href="' . esc_attr( $link_url ) . '" title="' . esc_attr( $attachment->post_excerpt ) . '" class="nopopup">';
				$link .= wp_get_attachment_image( $id, $size, false, array(
					'alt'   => esc_attr( $attachment->post_title ),
					'class' => isset( $attr['slider'] ) && $attr['slider'] == 'flex' ? 'fancy_border' : '',
				) );
				$link .= '</a>';
			} else if ( isset( $attr['link'] ) && 'file' == $attr['link'] ) {
				$large_image = wp_get_attachment_image_src( $id, 'boutique-blog-large' );
				$link        = '<a href="' . esc_attr( $large_image[0] ) . '" title="' . esc_attr( $attachment->post_excerpt ) . '" rel="prettyPhoto[rel-1]">';
				$link .= wp_get_attachment_image( $id, $size, false, array(
					'alt'   => esc_attr( $attachment->post_title ),
					'class' => isset( $attr['slider'] ) && $attr['slider'] == 'flex' ? 'fancy_border' : '',
				) );
				$link .= '</a>';
				//wp_get_attachment_link($id, $size, false, false)
			} else {
				$link = wp_get_attachment_link( $id, $size, true, false );
			}

			$output .= "<{$itemtag} class='gallery-item";
			$i ++;
			if ( $columns > 0 && $i % $columns == 0 ) {
				$output .= " gallery-item-last";
			}
			$output .= "'>";
			if ( isset( $attr['slider'] ) && ( $attr['slider'] == 'pretty' || $attr['slider'] == 'profile' ) ) {
				$output .= "
				<{$captiontag} class='dtbaker-pretty-title'>
				" . $attachment->post_title . "
				</{$captiontag}>";
			}
			if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				$output .= "
				<{$captiontag} class='wp-caption-text gallery-caption'>
				" . wptexturize( $attachment->post_excerpt ) . "
				</{$captiontag}>";
			}
			if ( isset( $attr['slider'] ) && ( $attr['slider'] == 'profile' ) ) {
				$output .= "
				<{$captiontag} class='dtbaker-pretty-description'>
				" . $attachment->post_content . "
				</{$captiontag}>";
			}
			$output .= "
			<{$icontag} class='gallery-icon'><div class='gallery-icon-inner'";
			if ( isset( $attr['slider'] ) && $attr['slider'] == 'pretty' ) {
				// slidercolor
				$color = get_post_meta( $attachment->ID, '_slidercolor', true );
				$output .= " style='background-color: " . esc_attr( $color ) . "'";

			}
			$output .= ">
				$link ";
			$output .= " </div></{$icontag}>";
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && $i % $columns == 0 ) {
				//$output .= " <br style='clear: both;' />";
			}
		}

		$output .= "
			<br style='clear: both;' />
		</div>\n";

		return $output;
	}
}


/**
 * Adding our custom fields to the $form_fields array
 *
 * @param array $form_fields
 * @param object $post
 * @return array
 */
if(!function_exists('dtbaker_boutique_image_attachment_fields_to_edit')) {
	function dtbaker_boutique_image_attachment_fields_to_edit( $form_fields, $post ) {
		// we find out the post data.
    if(!$post||!$post->post_parent)return $form_fields;

		// add our custom field to the $form_fields array
		// input type="text" name/id="attachments[$attachment->ID][custom1]"
		$form_fields["sliderlink"] = array(
			"label" => esc_html__( "Image Link", 'boutique-kids' ),
			"input" => "text", // this is default if "input" is omitted
			"value" => get_post_meta( $post->ID, "_sliderlink", true ),
        "helps" => __('(optional) Please enter the full URL where users will be directed after clicking on this image.','boutique-kids'),
    );
    $form_fields["slidercolor"] = array(
        "label" => __("Color",'boutique-kids'),
        "input" => "text", // this is default if "input" is omitted
        "value" => get_post_meta($post->ID, "_slidercolor", true),
        "helps" => __('(optional) Hex color to display behind image. Only used in the "Styled Gallery Buttons". Example colors: #ffdaeb or #c6efeb or #f3dbab or #b9e4e2.','boutique-kids'),
		);

		return $form_fields;
	}
}
// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "dtbaker_boutique_image_attachment_fields_to_edit", 14, 2);

if(!function_exists('dtbaker_boutique_image_attachment_fields_to_save')) {
	function dtbaker_boutique_image_attachment_fields_to_save( $post, $attachment ) {
		// $attachment part of the form $_POST ($_POST[attachments][postID])
		// $post attachments wp post array - will be saved after returned
		//     $post['post_type'] == 'attachment'
		if ( isset( $attachment['sliderlink'] ) ) {
			// update_post_meta(postID, meta_key, meta_value);
			update_post_meta( $post['ID'], '_sliderlink', $attachment['sliderlink'] );
		}
    if( isset($attachment['slidercolor']) ) {
			update_post_meta( $post['ID'], '_slidercolor', $attachment['slidercolor'] );
    }
		return $post;
	}
}
add_filter("attachment_fields_to_save", "dtbaker_boutique_image_attachment_fields_to_save", 10, 2);



add_filter('gallery_style', create_function('$a', 'return preg_replace("%<style type=\'text/css\'>(.*?)</style>%s", "", $a);'));

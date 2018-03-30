<?php 

remove_action('wp_head', 'ebor_framework_load_favicons');

remove_filter( 'wp_title', 'ebor_framework_wp_title', 10, 2 );

if(!( function_exists('ebor_remove_more_link_scroll') )){ 
	function ebor_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
	add_filter( 'the_content_more_link', 'ebor_remove_more_link_scroll' );
}

if(!( function_exists('ebor_body_classes') )){ 
	function ebor_body_classes($classes) {
		
		if( 'no' == get_option('foundry_use_parallax','yes') ){
       		$classes[] = 'no-parallax';
		}
		
		if( 'yes' == get_option('foundry_use_custom_forms', 'yes') ){
			$classes[] = 'custom-forms';
		}
		
		if( 'yes' == get_option('perm_fixed_nav', 'no') ){
			$classes[] = 'perm-fixed-nav';
		}
		
        return $classes;
        
	}
	add_filter('body_class', 'ebor_body_classes');
}

/**
 * Force easy google fonts plugin styles
 */
if(!( function_exists('ebor_egf_force_styles') )){ 
	function ebor_egf_force_styles( $force_styles ) {
	    return true;
	}
	add_filter( 'tt_font_force_styles', 'ebor_egf_force_styles' );
}

/**
 * Add a clearfix to the end of the_content()
 */
if(!( function_exists('ebor_add_clearfix') )){ 
	function ebor_add_clearfix( $content ) { 
		if( is_single() )
	   		$content = $content .= '<div class="clearfix"></div>';
	    return $content;
	}
	add_filter( 'the_content', 'ebor_add_clearfix' ); 
}

/**
 * Control default more
 */
if(!( function_exists('ebor_excerpt_more') )){
	function ebor_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'ebor_excerpt_more');
}

/**
 * Control default excerpt length.
 */
if(!( function_exists('ebor_excerpt_length') )){
	function ebor_excerpt_length( $length ) {
		return 21;
	}
	add_filter( 'excerpt_length', 'ebor_excerpt_length', 999 );
}

/**
 * Remove leading whitespace from the_excerpt
 */
if(!( function_exists('ebor_ltrim_excerpt') )){
	function ebor_ltrim_excerpt( $excerpt ) {
	    return preg_replace( '~^(\s*(?:&nbsp;)?)*~i', '', $excerpt );
	}
	add_filter( 'get_the_excerpt', 'ebor_ltrim_excerpt' );
}

/**
 * Filter the tag cloud appearance to match Tucson styling
 */
if(!( function_exists('ebor_tag_cloud') )){
	function ebor_tag_cloud($tag_string){
		$tag_string = preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
		return $tag_string;
	}
	add_filter('wp_generate_tag_cloud', 'ebor_tag_cloud',10,3);
}

/**
 * Add additional settings to gallery shortcode
 */
if(!( function_exists('ebor_add_gallery_settings') )){ 
	function ebor_add_gallery_settings(){
	?>
	
		<script type="text/html" id="tmpl-foundry-gallery-setting">
			<h3>Foundry Theme Gallery Settings</h3>
			<label class="setting">
				<span><?php _e('Gallery Layout', 'foundry'); ?></span>
				<select data-setting="layout">
					<option value="default">Default Layout</option>
					<option value="slider">Foundry Slider</option>
					<option value="slider-thumbnail">Foundry Slider with Thumbnails</option>        
					<option value="lightbox">Foundry Lightbox Gallery</option> 
					<option value="lightbox-fullwidth">Foundry Lightbox Gallery (Fullwidth)</option> 
					<option value="masonry">Foundry Masonry Gallery</option>
				</select>
			</label>
		</script>
	
		<script>
			jQuery(document).ready(function(){
				jQuery.extend(wp.media.gallery.defaults, { layout: 'default' });
				
				wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
					template: function(view){
					  return wp.media.template('gallery-settings')(view)
					       + wp.media.template('foundry-gallery-setting')(view);
					}
				});
			});
		</script>
	  
	<?php
	}
	add_action('print_media_templates', 'ebor_add_gallery_settings');
}


/**
 * Custom gallery shortcode
 *
 * Filters the standard WordPress gallery shortcode.
 *
 * @since 1.0.0
 */
if(!( function_exists('ebor_post_gallery') )){
	function ebor_post_gallery( $output, $attr) {
		
		global $post, $wp_locale;
	
	    static $instance = 0;
	    $instance++;
	
	    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	    if ( isset( $attr['orderby'] ) ) {
	        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
	        if ( !$attr['orderby'] )
	            unset( $attr['orderby'] );
	    }
	
	    extract(shortcode_atts(array(
	        'order'      => 'ASC',
	        'orderby'    => 'menu_order ID',
	        'id'         => $post->ID,
	        'itemtag'    => 'div',
	        'icontag'    => 'dt',
	        'captiontag' => 'dd',
	        'columns'    => 3,
	        'size'       => 'large',
	        'include'    => '',
	        'exclude'    => '',
	        'layout'     => ''
	    ), $attr));
	
	    $id = intval($id);
	    if ( 'RAND' == $order )
	        $orderby = 'none';
	
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }
	
	    if ( empty($attachments) )
	        return '';
	
	    if ( is_feed() ) {
	        $output = "\n";
	        foreach ( $attachments as $att_id => $attachment )
	            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
	        return $output;
	    }
	    
	    /**
	     * Return Lightbox Layout
	     */
	    if( $layout == 'lightbox' ){
	    	$output = '<div class="lightbox-grid square-thumbs" data-gallery-title="'. esc_attr(get_the_title()) .'"><ul>';
	    	foreach ( $attachments as $id => $attachment ) {
	    		$url = wp_get_attachment_image_src($id, 'full');
	    	    $output .= '<li><a href="'. $url[0] .'" data-lightbox="true"><span class="background-image-holder">'. wp_get_attachment_image($id, 'medium', 0, array('class' => 'background-image')) .'</span></a></li>';
	    	} 
	    	$output .= '</ul></div>';    
		    return $output;
	    }
	    
	    /**
	     * Return Masonry Layout
	     */
	    if( $layout == 'masonry' ){
	    	$output = '<div class="row"><div class="col-sm-12"><div class="masonry-feed masonry masonryFlyIn">';
	    	foreach ( $attachments as $id => $attachment ) {
	    		$url = wp_get_attachment_image_src($id, 'full');
	    	    $output .= '
	    	    	<div class="masonry-item">
	    	    	    <a href="'. $url[0] .'" data-lightbox="true">
	    	    	        '. wp_get_attachment_image($id, 'full') .'
	    	    	    </a>
	    	    	</div>
	    	    ';
	    	} 
	    	$output .= '</ul></div></div>';
	    	return $output; 
	    }
	    
	    /**
	     * Return Lightbox Layout
	     */
	    if( $layout == 'lightbox-fullwidth' ){
	    	$output = '<div class="lightbox-grid third-thumbs bg-dark"><ul>';
	    	foreach ( $attachments as $id => $attachment ) {
	    		$url = wp_get_attachment_image_src($id, 'full');
	    	    $output .= '
	    	    	<li>
	    	    	    <a href="'. $url[0] .'" data-lightbox="true">
	    	    	        <span class="background-image-holder">
	    	    	            '. wp_get_attachment_image($id, 'large', 0, array('class' => 'background-image')) .'
	    	    	        </span>
	    	    	    </a>
	    	    	</li>
	    	    ';
	    	}  
	    	$output .= '</ul></div>';       
	        return $output;
	    }
	    
	    /**
	     * Return Slider Layout
	     */
	    if( $layout == 'slider' ){
	    	$output = '<div class="image-slider slider-all-controls controls-inside"><ul class="slides">';
	    		foreach ( $attachments as $id => $attachment ) {
	    		    $output .= '<li>'. wp_get_attachment_image($id, 'full') .'</li>';
	    		} 
	    	$output .= '</ul></div>';
	    	return $output;
	    }
	    
	    /**
	     * Return Slider Layout with thumbnails
	     */
	    if( $layout == 'slider-thumbnail' ){
	    	$output = '<div class="image-slider slider-thumb-controls controls-inside"><ul class="slides">';
	    		foreach ( $attachments as $id => $attachment ) {
	    		    $output .= '<li>'. wp_get_attachment_image($id, 'full') .'</li>';
	    		} 
	    	$output .= '</ul></div>';
	    	return $output;
	    }
	    
	}
	add_filter( 'post_gallery', 'ebor_post_gallery', 10, 2 );
}
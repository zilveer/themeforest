<?php
//
// New Post Type
//


add_action('init', 'portfolio_register');  

function portfolio_register() {
    $args = array(
        'label' => __('Portfolio', 'spacing_backend'),
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'thumbnail')
       );  

    register_post_type( 'portfolio' , $args );
}

//
// New Taxonomy
//

register_taxonomy(
	"project-type", 
	array("portfolio"), 
	array(
		"hierarchical" => true, 
		"context" => "normal", 
		'show_ui' => true,
		"label" => "Portfolio Categories", 
		"singular_label" => "Portfolio Category", 
		"rewrite" => true
	)
);

//
// New Columns
//

add_filter( 'manage_edit-portfolio_columns', 'portfolio_columns_settings' ) ;

function portfolio_columns_settings( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Title', 'spacing_backend'),
		'category' => __( 'Category', 'spacing_backend'),
		'date' => __('Date', 'spacing_backend'),
		'thumbnail' => ''	
	);

	return $columns;
}

add_action( 'manage_portfolio_posts_custom_column', 'portfolio_columns_content', 10, 2 );

function portfolio_columns_content( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'category' :

			$taxonomy = "project-type";
			$post_type = get_post_type($post_id);
			$terms = get_the_terms($post_id, $taxonomy);
		 
			if ( !empty($terms) ) {
				foreach ( $terms as $term )
					$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
				echo join( ', ', $post_terms );
			}
			else echo '<i>No categories.</i>';

			break;

		/* If displaying the 'genre' column. */
		case 'thumbnail' :

			the_post_thumbnail('thumbnail', array('class' => 'column-img'));

			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}


//
// Portfolio Post Custom Fields
//


// Portfolio Post Settings


add_action("admin_init", "portfolio_post_settings");   

function portfolio_post_settings(){
    add_meta_box("portfolio_settings", "Portfolio Post Settings", "portfolio_settings_config", "portfolio", "normal", "high");
}   

function portfolio_settings_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$portfolio_post_type = $custom["portfolio_post_type"][0];
		$portfolio_summary = $custom["portfolio_summary"][0];
		$portfolio_external_url = $custom["portfolio_external_url"][0];
		$portfolio_page_layout = $custom["portfolio_page_layout"][0];
?>
    <table class="form-table custom-table">
    	<tr>
            <td class="title-column">Portfolio Post Type:</td>
            <td class="select-fields post-type-radios">        
                <span><input type="radio" name="portfolio_post_type" class="enable-radio" value="standard" <?php if(!$portfolio_post_type || $portfolio_post_type == "standard") { echo 'checked="checked"'; } ?>>Standard</span>
                <span><input type="radio" name="portfolio_post_type" class="disable-radio" value="direct" <?php if($portfolio_post_type == "direct") { echo 'checked="checked"'; } ?>>Direct Lightbox</span>
                <span><input type="radio" name="portfolio_post_type" class="disable-radios" value="external" <?php if($portfolio_post_type == "external") { echo 'checked="checked"'; } ?>>External Link</span>
            </td>
        </tr>
        <tr id="external-url" <?php if($portfolio_post_type == "external") { echo 'style="display:table-row"'; } ?>>
        	<td class="title-column">External URL:</td>
            <td class="description-textarea">
            	<input type="text" name="portfolio_external_url" value="<?php echo $portfolio_external_url; ?>" />
            </td>
        </tr>
        <tr>
        	<td class="title-column">Page Layout:</td>
            <td class="select-fields">
            <span><input type="radio" name="portfolio_page_layout" value="sidebar-right" <?php if(!$portfolio_page_layout || $portfolio_page_layout == "sidebar-right") { echo 'checked="checked"'; } ?>>Right Sidebar</span>
            	<span><input type="radio" name="portfolio_page_layout" value="sidebar-left" <?php if(!$portfolio_page_layout || $portfolio_page_layout == "sidebar-left") { echo 'checked="checked"'; } ?>>Left Sidebar</span>
                <span><input type="radio" name="portfolio_page_layout" value="fullwidth" <?php if($portfolio_page_layout == "fullwidth") { echo 'checked="checked"'; } ?>>Full Width</span>
            </td>
        </tr> 
        <tr>
        	<td class="title-column">Short Description:</td>
            <td class="description-textarea">
            	<textarea name="portfolio_summary" rows="3" /><?php echo $portfolio_summary; ?></textarea>
            </td>
        </tr>        
    </table>
<?php
    }		
	

// Custom Media Uploader


include_once 'media-uploader/setup.php';
include_once 'media-uploader/custom-spec.php';


// Video Post


add_action("admin_init", "portfolio_video_post");   

function portfolio_video_post(){
    add_meta_box("portfolio_video", "Video Post", "portfolio_video_config", "portfolio", "normal", "low");
}   

function portfolio_video_config(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$video_post_enable = $custom["video_post_enable"][0];
		$video_player_type = $custom["video_player_type"][0];
		$portfolio_video_id = $custom["portfolio_video_id"][0];
?>
    <table class="form-table custom-table">
    	<tr>
            <td class="title-column">Video Post?</td>
            <td class="select-fields video-post-radios">        
                <span><input type="checkbox" name="video_post_enable" value="enabled" <?php if($video_post_enable) { echo 'checked="checked"'; } ?>></span>
            </td>
        </tr>
        <tr>
            <td class="title-column">Video Type:</td>
            <td class="select-fields video-type-radios">        
                <span><input type="radio" name="video_player_type" value="youtube" <?php if(!$video_player_type || $video_player_type == "youtube") { echo 'checked="checked"'; } ?>>YouTube</span>
                <span><input type="radio" name="video_player_type" value="vimeo" <?php if($video_player_type == "vimeo") { echo 'checked="checked"'; } ?>>Vimeo</span>
                <span><input type="radio" name="video_player_type" value="html5" <?php if($video_player_type == "html5") { echo 'checked="checked"'; } ?>>HTML5</span>
            </td>
        </tr>
        <tr id="video_site">
        	<td class="title-column video-file-id" <?php if($video_player_type == "html5") { echo 'style="display:none"'; } ?>>Video ID:</td>
            <td class="title-column video-file-url" <?php if($video_player_type !== "html5") { echo 'style="display:none"'; } ?>>Video File URL:</td>
            <td class="description-textarea">
            	<input type="text" name="portfolio_video_id" value="<?php echo $portfolio_video_id; ?>" />
            </td>
        </tr>     
    </table>
<?php
    }
	
	
// Portfolio Page Settings

add_action("admin_init", "portfolio_page_categories");   

function portfolio_page_categories(){
    add_meta_box("portfolio_page_categories", "Portfolio Page Settings", "portfolio_categories", "page", "normal", "high");
}   

function portfolio_categories(){
        global $post;
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);
		$portfolio_page_template = $custom["portfolio_page_template"][0];
		$portfolio_cols = $custom["portfolio_cols"][0];
		$portfolio_style = $custom["portfolio_style"][0];
		$portfolio_page_cats = $custom["portfolio_page_cats"][0];
?>
    <table class="form-table custom-table">
    	<tr>
            <td class="title-column">Portfolio Style:</td>
            <td class="select-fields"> 
            	<select name="portfolio_style">             	
					<option value="default"<?php if($portfolio_style == "default"){ echo "selected"; } ?>>Default - Title on Overlay</option>
                    <option value="alt"<?php if($portfolio_style == "alt"){ echo "selected"; } ?>>Alternative - Post Title and Excerpt under the Thumbnail</option>
                </select>
            </td>
        </tr>
    	<tr>
            <td class="title-column">Columns:<br /><span class="custom-subtitle">Note: 4 Columns aren't supported by the Sidebar page layout</span></td>
            <td class="select-fields"> 
            	<select name="portfolio_cols">             	
					<option value="4"<?php if($portfolio_cols == 4){ echo "selected"; } ?>>4 Columns</option>
                    <option value="3"<?php if($portfolio_cols == 3){ echo "selected"; } ?>>3 Columns</option>
                    <option value="2"<?php if($portfolio_cols == 2){ echo "selected"; } ?>>2 Columns</option>
                    <option value="1"<?php if($portfolio_cols == 1){ echo "selected"; } ?>>1 Column</option>
                </select>
            </td>
        </tr>        		
    	<tr>
            <td class="title-column">Portfolio Categories:</td>
            <td class="select-fields">  
            	<?php
				
				$portfolio_categories = get_categories('taxonomy=project-type');
	
				foreach ($portfolio_categories  as $portfolio_category ) { 
                
					$pos = strpos($portfolio_page_cats, $portfolio_category->slug); ?>
						
					<span><input type="checkbox" name="portfolio_page_cats[]" <?php if($pos !== false){ echo 'checked="checked"'; } ?> value="<?php echo $portfolio_category->slug; ?>" ><?php echo $portfolio_category->name; ?></span>	 
				
                <?php } ?>  

            </td>
        </tr>        
    </table>
<?php
    }
	
	
// Save Custom Fields
	
add_action('save_post', 'save_portfolio_settings'); 

function save_portfolio_settings(){
    global $post;  

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}else{
		update_post_meta($post->ID, "page_sidebar", $_POST["page_sidebar"]);
		
		update_post_meta($post->ID, "portfolio_post_type", $_POST["portfolio_post_type"]);
		update_post_meta($post->ID, "portfolio_summary", $_POST["portfolio_summary"]);
		update_post_meta($post->ID, "portfolio_external_url", $_POST["portfolio_external_url"]);
		update_post_meta($post->ID, "portfolio_page_layout", $_POST["portfolio_page_layout"]);
		
		update_post_meta($post->ID, "video_post_enable", $_POST["video_post_enable"]);
		update_post_meta($post->ID, "video_player_type", $_POST["video_player_type"]);
		update_post_meta($post->ID, "portfolio_video_id", $_POST["portfolio_video_id"]);

		if($_POST["portfolio_page_cats"]){
		$portfolio_cats = implode(",",$_POST["portfolio_page_cats"]); 
		update_post_meta($post->ID, "portfolio_page_cats", $portfolio_cats);		
		}
		update_post_meta($post->ID, "portfolio_style", $_POST["portfolio_style"]);
		update_post_meta($post->ID, "portfolio_cols", $_POST["portfolio_cols"]);
		update_post_meta($post->ID, "page_title_disabled", $_POST["page_title_disabled"]);
		update_post_meta($post->ID, "page_tagline", $_POST["page_tagline"]);
    }

}


//
// Filtering Menu
//

function portfolio_filters(){
		
	global $post;	
	
	$portfolio_cats = explode(",", get_post_meta($post->ID, 'portfolio_page_cats', true));
	foreach ($portfolio_cats as $value){
		$term = get_term_by('slug', $value, 'project-type');
		echo '<li><a href="#filter" " data-option-value=".'. $value .'">' . $term->name . "</a></li>";	 
	}	

}

function portfolio_item_class(){
	
	global $post;
    $terms = wp_get_object_terms($post->ID, "project-type");
	foreach ( $terms as $term ) {
		echo $term->slug . " ";
	}		
	
}

function portfolio_post_class(){
	
	global $post;
    $terms = wp_get_object_terms($post->ID, "project-type");
	foreach ( $terms as $term ) {
		return $term->slug . ",";
	}	
	
}

function portfolio_holder_class(){
	
	global $post;
	
	if(get_post_meta($post->ID, 'portfolio_post_type', true) == "direct" || get_post_meta($post->ID, 'video_post_type', true) == "direct")
	
	echo "gallery clearfix";	
}


//
// Retrieve Custom Values
//


function portfolio_overlay_link(){

	global $post,$of_option;	
	$post_type = get_post_meta($post->ID, 'portfolio_post_type', true);
	
	if(get_post_meta($post->ID, 'video_post_enable', true) && $post_type == "direct"){
		echo "play-video";
	}elseif($post_type == "standard") {
	}elseif($post_type == "direct"){
		echo "open-gallery";
	}elseif($post_type == "external"){
		echo "external-url";
	}else{
	}
				
}	

function portfolio_post_href($type){

	global $post;		
	$video = get_post_meta($post->ID, 'video_post_enable', true);	
	$post_type = get_post_meta($post->ID, 'portfolio_post_type', true);
	
	if(!$video){		
		if($post_type == "standard") {			
			echo 'href="';
			echo the_permalink();
			echo '"';			
		}elseif($post_type == "direct" && $type == 1){			
			$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
			echo 'id="'.$post->ID.'"href="'.$imgurl[0].'" rel="gallery[gallery'.$post->ID.']"';		
		}elseif($post_type == "direct" && $type == 2){			
			$imgurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); 
			?> onclick="$('#<?php echo $post->ID ?>').trigger('click');" href="#" <?php		
		}elseif($post_type == "external"){
			echo 'href="'.get_post_meta($post->ID, 'portfolio_external_url', true).'"';
		}
	}elseif($video){		
		if($post_type == "standard"){			
			echo 'href="';
			echo the_permalink();
			echo '"';			
		}elseif($post_type == "direct"){			
			$player_type = get_post_meta($post->ID, 'video_player_type', true);						
			echo 'href="';
			if($player_type == "youtube"){
				echo 'http://www.youtube.com/watch?v='. get_post_meta($post->ID, 'portfolio_video_id', true);	
			}elseif($player_type == "vimeo"){
				echo 'http://vimeo.com/'. get_post_meta($post->ID, 'portfolio_video_id', true);	
			}
			echo '" rel="gallery"';
			
		}
		
	}
				
}

function lightbox_gallery_images(){
	
	global $post;
	global $post_gallery;	
	$gallery = $post_gallery->the_meta();
	
	echo '<div class="lightbox-hidden">';
	foreach ($gallery['docs'] as $image)
	{
		echo '<a href="' . $image['imgurl'] . '" rel="gallery[gallery'. $post->ID .']"></a>';
	}
	echo '</div>';

}
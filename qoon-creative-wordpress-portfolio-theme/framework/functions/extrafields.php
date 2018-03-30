<?php
/* ------------------------------------------------------------------------ */
/* Extra Fields.  */
/* ------------------------------------------------------------------------ */
add_action('admin_init', 'qoon_extra_fields', 1);
function qoon_extra_fields() {
	add_meta_box( 'extra_fields', 'Additional settings', 'qoon_extra_fields_for_pages', 'page', 'normal', 'high'  );
}
@the_post_thumbnail();
@wp_link_pages( $args );
@comments_template( $file, $separate_comments );
@add_theme_support( 'automatic-feed-links' );
@add_theme_support( 'custom-header', $args );
@add_theme_support( 'custom-background', $args );



//Extra Field for Pages
function qoon_extra_fields_for_pages( $post ){
?>
    <div style="padding:20px; border:1px solid #eaeaea; background:#f6f6f6; margin:20px;">
    <h4><?php _e('You can use any sidebar, just choose it','qoon-creative-wordpress-portfolio-theme')?></h4>
    <?php global $wp_registered_sidebars;
  	?>
    <select name="extra[sidebarss]">
    <?php foreach ($wp_registered_sidebars as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'sidebarss', 1)) { echo 'selected';} ?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
	<?php } ?>
    </select>
    <br>
  	<h4><?php _e('Show Sidebar','qoon-creative-wordpress-portfolio-theme')?></h4>
  <select name="extra[sidebarss_position]">
  	<?php
	$oi_sidebars_position = array (
		"right"  => array("name" => "Right Sidebar"),
		"left"  => array("name" => "Left Sidebar"),
		"disabled"  => array("name" => "Disabled"),
	);
	?>
    <?php foreach ($oi_sidebars_position as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'sidebarss_position', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
	<?php } ?>
   </select>
   
    <h4><?php _e('Show Title','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[page_title]">
    <?php
    $page_title = array (
    "yes"  => array("name" => "Yes"),
    "no"  => array("name" => "No"),
    );
    ?>
    <?php foreach ($page_title as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'page_title', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <h4><?php _e('Contant Layout','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[cont_lay]">
    <?php
    $cont_lay = array (
    "with_paddings"  => array("name" => "With Paddings"),
    "without_paddings"  => array("name" => "Without Paddings"),
	"full_page"  => array("name" => "Full Page"),
	"full_page_scroll"  => array("name" => "Full Page Raw Scroller"),
    );
    ?>
    <?php foreach ($cont_lay as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'cont_lay', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    
    <h4><?php _e('Featured Image Height','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h]">
    <?php
    $feat_h = array (
	"Do Not Show"  => array("name" => "Do Not Show"),
    "1/3"  => array("name" => "1/3"),
    "1/2"  => array("name" => "1/2"),
	"2/3"  => array("name" => "2/3"),
	"1/1"  => array("name" => "Full Screen"),
    );
    ?>
    <?php foreach ($feat_h as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    <h4><?php _e('Featured Image Position','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[feat_h_pos]">
    <?php
    $feat_h_pos = array (
    "center bottom"  => array("name" => "center bottom"),
    "center center"  => array("name" => "center center"),
	"center top"  => array("name" => "center top"),
    );
    ?>
    <?php foreach ($feat_h_pos as $val){ ?>
    <option <?php if ($val['name'] == get_post_meta($post->ID, 'feat_h_pos', 1)) { echo 'selected';} ?> value="<?php echo $val['name'] ?>"><?php echo $val['name'] ?></option>
    <?php } ?>
    </select>
    
    <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
	?>
    <h4><?php _e('Slider instead Featured Image?','qoon-creative-wordpress-portfolio-theme')?></h4>
    <select name="extra[rev_s]">
    <?php
	$slider = new RevSlider();
	$slugs = $slider->getAllSliderAliases();
	array_unshift($slugs, "Do not use Slider");
    ?>
    <?php foreach ($slugs as $val){ ?>
    <option <?php if ($val == get_post_meta($post->ID, 'rev_s', 1)) { echo 'selected';} ?> value="<?php echo $val ?>"><?php echo $val ?></option>
    <?php } ?>
    </select>
    <?php }?>
    
   
   
    <div id="oi_admin_page_descr">
        <h4><?php _e('Page Description','qoon-creative-wordpress-portfolio-theme')?></h4>
        <div>
            <p>
            <textarea rows="10" style="width:600px;" type="text" name="extra[page-d]" value="<?php echo esc_textarea(get_post_meta($post->ID, 'page-d', true)); ?>" ><?php echo esc_textarea(get_post_meta($post->ID, 'page-d', true)); ?></textarea>
            </p>
        </div>
    </div>
    </div>
<?php }



//Save Extra Fields
add_action('save_post', 'qoon_extra_fields_update', 0);


function qoon_extra_fields_update( $post_id ){
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; 
	if ( !current_user_can('edit_post', $post_id) ) return false; 
	if( !isset($_POST['extra']) ) return false;	

	
	$_POST['extra'] = array_map('trim', $_POST['extra']);
	foreach( $_POST['extra'] as $key=>$value ){
		if( empty($value) )	delete_post_meta($post_id, $key);
		update_post_meta($post_id, $key, $value);
	}
	return $post_id;
}


function qoon_upload_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/framework/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}



function qoon_upload_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'qoon_upload_scripts'); 
add_action('admin_enqueue_scripts', 'qoon_upload_styles');


// Customize the search form
function qoon_style_search_form($form) {
    $form = '<form method="get" id="searchform" action="' . home_url() . '/" >
            <div class="row">';
   
        $form .='<div class="col-md-12">
		<input type="hidden" name="post_type" value="post" />
			<div class="row">
			  <div class="col-md-8">
						<input type="text" value="'.esc_html__('Search','qoon-creative-wordpress-portfolio-theme').' " name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/>
			  </div>
			  <div class="col-md-4">
				<input type="submit" value="'.esc_html__('Search','qoon-creative-wordpress-portfolio-theme').'" />
			  </div>
			</div> 

		</div>';
    $form .= '</div></form>';
    return $form;
}
add_filter('get_search_form', 'qoon_style_search_form');

function qoon_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) { $end = strpos($link, '"',$offset); }
	if ($end) { $link = substr_replace($link, '', $offset, $end-$offset); }
	return $link;
}
add_filter('the_content_more_link', 'qoon_remove_more_jump_link');




/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 */
if ( is_singular() ) wp_enqueue_script( "comment-reply" );
add_theme_support( "title-tag" );

function qoon_is_blog () {
    return ( is_archive() || is_author() || is_search() || is_category() || is_home() || is_single() || is_tag() || is_page_template( 'blog.php' )) && 'post' == get_post_type();
}
?>
<?php
/*-----------------------------------------------------------------------------------*/
# Register The Meta Boxes
/*-----------------------------------------------------------------------------------*/
add_action("admin_init", "tie_posts_options_init");
function tie_posts_options_init(){
	add_meta_box("tie_post_options", THEME_NAME .' - '. __( 'Post Options', 'tie' ), "tie_post_options_module", "post", "normal", "high");
	add_meta_box("tie_post_options", THEME_NAME .' - '. __( 'Page Options', 'tie' ), "tie_post_options_module", "page", "normal", "high");
	add_meta_box("tie_post_general_options", THEME_NAME .' - '. __( 'More Options', 'tie' ), "tie_post_general_options_module", "post", "side", "default");
}


/*-----------------------------------------------------------------------------------*/
# Post & page Main Meta Boxes
/*-----------------------------------------------------------------------------------*/
function tie_post_options_module(){
	global $post, $wp_roles ;
	$get_meta = get_post_custom($post->ID);
	
	$checked = 'checked="checked"';
	
	//Sidebar Position -------------------- \\
	if( !empty($get_meta["tie_sidebar_pos"][0]) )
		$tie_sidebar_pos = $get_meta["tie_sidebar_pos"][0];

	//Get Categories 
	$categories_obj = get_categories();
	$categories = array();
	foreach ($categories_obj as $pn_cat) {
		$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
	}
	
	//Custom Sliders
	$original_post = $post;

	$sliders = array();
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$sliders[get_the_ID()] = get_the_title();
	}

	$post = $original_post;
	wp_reset_query();

	//Sidebars
	$sidebars = tie_get_option( 'sidebars' );
	$new_sidebars = array(''=> __( 'Default', 'tie' ));
	if (class_exists('Woocommerce')) $new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;	
	if($sidebars){
		foreach ($sidebars as $sidebar) {
			$new_sidebars[$sidebar] = $sidebar;
		}
	}
	
	//User Roles
	$roles = $wp_roles->get_names(); ?>
		
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/framework/admin/images/empty.png'});
		 });
	</script>
	
	<input type="hidden" name="tie_hidden_flag" value="true" />
	
	
	<?php //Categories options for the page templates -------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie-template-blog">
		<h3><?php _e( 'Categories', 'tie' ) ?></h3>
		<div class="option-item">
			<span class="label"><?php _e( 'Categories', 'tie' ) ?></span>
			<select multiple="multiple" name="tie_blog_cats[]" id="tie_blog_cats">
				<?php
				$tie_blog_cats = '';
				if( !empty( $get_meta["tie_blog_cats"][0] ) )
					$tie_blog_cats = unserialize($get_meta["tie_blog_cats"][0]);

				foreach ($categories as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $tie_blog_cats ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</div>
		<div id="tie_posts_num">
		<?php	
		tie_post_meta_box(				
			array(	"name"	=> "Number of Posts",
					"id"	=> "tie_posts_num",
					"type"	=> "text"));
		?>
		</div>
	</div>
	
	
	<?php //Authors options for the page templates -------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie-template-authors">
		<h3><?php _e( 'Authors template Options', 'tie' ) ?></h3>
		<div class="option-item">
				<span class="label"><?php _e( 'User Roles', 'tie' ) ?></span>
				<select multiple="multiple" name="tie_authors[]" id="tie_authors">
				<?php
				$tie_authors = '';
				if( !empty( $get_meta["tie_authors"][0] ) )
					$tie_authors = unserialize($get_meta["tie_authors"][0]);
				foreach ($roles as $key => $option) { ?>
					<option value="<?php echo $key ?>" <?php if ( @in_array( $key , $tie_authors ) ) { echo ' selected="selected"' ; } ?>><?php echo $option; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	
	
	<?php //Post Head Options ----------------------------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie_post_head_options_box">
		<h3><?php _e( 'Post Head Options', 'tie' ) ?></h3>
		
		<?php	
		tie_post_meta_box(
			array(	"name"	=> __( 'Post Head Cover layout', 'tie' ),
					"id"	=> "tie_post_head_cover",
					"type"	=> "checkbox"));
					
		tie_post_meta_box(				
			array(	"name"		=> __( 'Display', 'tie' ),
					"id"		=> "tie_post_head",
					"type"		=> "select",
					"options"	=> array(
						''				=> __( 'Default', 'tie' ),
						'none'			=> __( 'None', 'tie' ),
						'video'			=> __( 'Video', 'tie' ),
						'audio'			=> __( 'Audio - Self Hosted', 'tie' ),
						'soundcloud'	=> __( 'Audio - SoundCloud', 'tie' ),
						'slider'		=> __( 'Slider', 'tie' ),
						'map'			=> __( 'Google Maps', 'tie' ),
						'thumb'			=> __( 'Featured Image', 'tie' ),
						'lightbox'		=> __( 'Featured Image + Lightbox', 'tie' )
					)));
							
		tie_post_meta_box(				
			array(	"name"	=> __( 'Embed Code', 'tie' ),
					"id"	=> "tie_embed_code",
					"type"	=> "textarea"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Video URL <br /><small>supports : YouTube, Vimeo, Viddler, Qik, Hulu, FunnyOrDie, DailyMotion, WordPress.tv and blip.tv</small>', 'tie' ),
					"id"	=> "tie_video_url",
					"type"	=> "text"));
						
		tie_post_meta_box(				
			array(	"name"	=> __( 'Self Hosted Video', 'tie' ),
					"id"	=> "tie_video_self",
					"type"	=> "text"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'SoundCloud URL', 'tie' ),
					"id"	=> "tie_audio_soundcloud",
					"type"	=> "text"));
						
		tie_post_meta_box(				
			array(	"name"	=> __( 'Auto Play', 'tie' ),
					"id"	=> "tie_audio_soundcloud_play",
					"type"	=> "checkbox"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Visual Style', 'tie' ),
					"id"	=> "tie_audio_soundcloud_visual",
					"type"	=> "checkbox"));
						
		tie_post_meta_box(				
			array(	"name"	=> __( 'MP3 file URL', 'tie' ),
					"id"	=> "tie_audio_mp3",
					"type"	=> "text"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'M4A file URL', 'tie' ),
					"id"	=> "tie_audio_m4a",
					"type"	=> "text"));
						
		tie_post_meta_box(				
			array(	"name"	=> __( 'OGA file URL', 'tie' ),
					"id"	=> "tie_audio_oga",
					"type"	=> "text"));	
						
		tie_post_meta_box(				
			array(	"name"		=> __( 'Custom Slider', 'tie' ),
					"id"		=> "tie_post_slider",
					"type"		=> "select",
					"options"	=> $sliders ));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Google Maps URL', 'tie' ),
					"id"	=> "tie_googlemap_url",
					"type"	=> "text"));
		?>
	</div>
		
		
	<?php //Sidebar Position ----------------------------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie_sidebar_options_box">
		<h3><?php _e( 'Sidebar Options', 'tie' ) ?></h3>
		
		<div class="option-item">
			<ul id="sidebar-position-options" class="tie-options">
				<li id="tie_sidebar_position_default">
					<input id="tie_sidebar_pos_default"  name="tie_sidebar_pos" type="radio" value="default" <?php if( ( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'default' ) || empty( $tie_sidebar_pos ) ) echo $checked; ?> />
					<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-default.png" /></a>
				</li>
				<li id="tie_sidebar_position_right">
					<input id="tie_sidebar_pos_right"  name="tie_sidebar_pos" type="radio" value="right" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'right' ) echo $checked; ?> />
					<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-right.png" /></a>
				</li>
				<li id="tie_sidebar_position_left">
					<input id="tie_sidebar_pos_left"  name="tie_sidebar_pos" type="radio" value="left" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'left' ) echo $checked; ?> />
					<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-left.png" /></a>
				</li>
				<li id="tie_sidebar_position_full">
					<input id="tie_sidebar_pos_full"  name="tie_sidebar_pos" type="radio" value="full" <?php if( !empty( $tie_sidebar_pos ) && $tie_sidebar_pos == 'full' ) echo $checked; ?> />
					<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/sidebar-no.png" /></a>
				</li>
			</ul>
		</div>
		<?php

		tie_post_meta_box(				
			array(	"name"		=> __( 'Choose Sidebar', 'tie' ),
					"id"		=> "tie_sidebar_post",
					"type"		=> "select",
					"options"	=> $new_sidebars ));	
		?>
	</div>
		
		
	<?php //Post Style ----------------------------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie_post_style_box">
		<h3><?php _e( 'Custom Styles', 'tie' ) ?></h3>
	
		<?php
		tie_post_meta_box(				
			array(	"name"	=> __( 'Custom color', 'tie' ),
					"id"	=> "post_color",
					"type"	=> "color" ));
								
		tie_post_meta_box(
			array(	"name"	=> __( 'Background', 'tie' ),
					"id"	=> "post_background",
					"type"	=> "background"));
								
		tie_post_meta_box(
			array(	"name"	=> __( 'Full Screen Background', 'tie' ),
					"id"	=> "post_background_full",
					"type"	=> "checkbox"));
		?>
	</div>
		
		
	<?php //Ads Options ----------------------------------------------------------------- */ ?>
	<div class="tiepanel-item" id="tie_ads_options_box">
		<h3><?php _e( 'Ads Options', 'tie' ) ?></h3>
			
		<?php	
		tie_post_meta_box(				
			array(	"name"	=> __( 'Hide Above Banner', 'tie' ),
					"id"	=> "tie_hide_above",
					"type"	=> "checkbox"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Custom Above Banner', 'tie' ),
					"id"	=> "tie_banner_above",
					"type"	=> "textarea"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Hide Below Banner', 'tie' ),
					"id"	=> "tie_hide_below",
					"type"	=> "checkbox"));

		tie_post_meta_box(				
			array(	"name"	=> __( 'Custom Below Banner', 'tie' ),
					"id"	=> "tie_banner_below",
					"type"	=> "textarea"));
		?>
	</div>
  <?php
}



/*-----------------------------------------------------------------------------------*/
# Post More Options
/*-----------------------------------------------------------------------------------*/
function tie_post_general_options_module(){
	tie_post_meta_box(				
		array(	"name"		=> __( 'Hide Post Meta', 'tie' ),
				"id"		=> "tie_hide_meta",
				"type"		=> "select",
				"options"	=> array(	""		=> "" ,
										"yes"	=> "Yes",
										"no"	=> "No")));
										
	tie_post_meta_box(				
		array(	"name"		=> __( 'Hide Author Information', 'tie' ),
				"id"		=> "tie_hide_author",
				"type"		=> "select",
				"options"	=> array(	""		=> "" ,
										"yes"	=> "Yes",
										"no"	=> "No")));	
										
	tie_post_meta_box(				
		array(	"name"		=> __( 'Hide Share Buttons', 'tie' ),
				"id"		=> "tie_hide_share",
				"type"		=> "select",
				"options"	=> array(	""		=> "" ,
										"yes"	=> "Yes",
										"no"	=> "No")));		
										
	tie_post_meta_box(				
		array(	"name"		=> __( 'Hide Related Posts', 'tie' ),
				"id"		=> "tie_hide_related",
				"type"		=> "select",
				"options"	=> array(	""		=> "" ,
										"yes"	=> "Yes",
										"no"	=> "No")));		
										
	tie_post_meta_box(				
		array(	"name"		=> __( 'Hide Fly Check Also Box', 'tie' ),
				"id"		=> "tie_hide_check_also",
				"type"		=> "select",
				"options"	=> array(	""		=> "" ,
										"yes"	=> "Yes",
										"no"	=> "No")));
}


/*-----------------------------------------------------------------------------------*/
# Get The Post Options
/*-----------------------------------------------------------------------------------*/
function tie_post_meta_box ( $value ){
	global $post;
	$data = false;
	$id = $value['id'];
	$get_meta = get_post_custom($post->ID);
	if( isset( $get_meta[$id][0] ) ) $data = $get_meta[$id][0]; 
	tie_options_build ( $value, $id, $data  );
}


/*-----------------------------------------------------------------------------------*/
# Save Post Options
/*-----------------------------------------------------------------------------------*/
add_action('save_post', 'tie_save_post');
function tie_save_post( $post_id ){
	global $post;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return $post_id;
		
    if (isset($_POST['tie_hidden_flag'])) {
	
		$custom_meta_fields = array(
			'tie_hide_meta',
			'tie_hide_author',
			'tie_hide_share',
			'tie_hide_related',
			'tie_hide_check_also',
			'tie_sidebar_pos',
			'tie_sidebar_post',
			'tie_post_head',
			'tie_post_head_cover',
			'tie_post_slider',
			'tie_googlemap_url',
			'tie_video_url',
			'tie_video_self',
			'tie_embed_code',
			'tie_audio_m4a',
			'tie_audio_mp3',
			'tie_audio_oga',
			'tie_audio_soundcloud',
			'tie_audio_soundcloud_play',
			'tie_audio_soundcloud_visual',
			'tie_hide_above',
			'tie_banner_above',
			'tie_hide_below',
			'tie_banner_below',
			'tie_posts_num',
			'post_color',
			'post_background_full',
			'tie_blog_cats',
			'post_background',
			'tie_authors'
		);
			
		foreach( $custom_meta_fields as $custom_meta_field ){
			if( isset( $_POST[$custom_meta_field] ) && !empty( $_POST[ $custom_meta_field] ) ){
				$custom_meta_field_data = $_POST[$custom_meta_field];
				if( is_array( $custom_meta_field_data ) ){
					$custom_meta_field_data		= array_filter( $custom_meta_field_data );
					if( !empty( $custom_meta_field_data ) ){
						update_post_meta( $post_id, $custom_meta_field, $custom_meta_field_data );
					}else{
						delete_post_meta( $post_id, $custom_meta_field );
					}
				}else{
					if( !empty( $custom_meta_field_data ) ){
						update_post_meta( $post_id, $custom_meta_field, htmlspecialchars(stripslashes( $custom_meta_field_data )) );
					}else{
						delete_post_meta( $post_id, $custom_meta_field );
					}
				}
			}else{
				delete_post_meta( $post_id, $custom_meta_field );
			}
		}

	}
}
?>
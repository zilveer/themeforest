<?php
/*-----------------------------------------------------------------------------------*/
# Get The Category Options
/*-----------------------------------------------------------------------------------*/
function tie_cat_options ( $value ){
	$data = false;
	$tie_cats_options = get_option( 'tie_cats_options' );

	if( $tie_cats_options[ $value['cat'] ] ) $data = $tie_cats_options[ $value['cat'] ];
	
	if( !empty( $data[$value['id']] ) )
		$data = $data[$value['id']];
	else
		$data = false;

	tie_options_build ( $value, 'tie_cat['.$value["id"].']', $data );
}


/*-----------------------------------------------------------------------------------*/
# Category Custom Options
/*-----------------------------------------------------------------------------------*/
add_action ( 'edit_category_form_fields', 'tie_category_fields');
function tie_category_fields( $tag ) {

	$checked = 'checked="checked"';

    $t_id = $tag->term_id;
	$tie_cats_options = get_option( 'tie_cats_options' );
		
	if( !empty( $tie_cats_options[ $t_id ] ) )
		$cat_option = $tie_cats_options[ $t_id ];

	wp_enqueue_media();

	$sidebars = tie_get_option( 'sidebars' ) ;
	$new_sidebars = array(''=> __( 'Default', 'tie' ));
	
	if (class_exists('Woocommerce'))
		$new_sidebars ['shop-widget-area'] = __( 'Shop - For WooCommerce Pages', 'tie' ) ;
		
	if($sidebars){
		foreach ($sidebars as $sidebar) {
		$new_sidebars[$sidebar] = $sidebar;
		}
	}
		
	$custom_slider = new WP_Query( array( 'post_type' => 'tie_slider', 'posts_per_page' => -1, 'no_found_rows' => 1  ) );
	$cat_slider = array();
	$cat_slider[''] = __( 'Disable', 'tie' );
	$cat_slider['recent'] = __( 'Recent Posts', 'tie' );
	$cat_slider['random'] = __( 'Random Posts', 'tie' );

	while ( $custom_slider->have_posts() ) {
		$custom_slider->the_post();
		$cat_slider[get_the_ID()] = get_the_title();
	}
	wp_reset_query();
?>
<tr class="form-field">
	<td colspan="2">
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				jQuery('.on-of').checkbox({empty:'<?php echo get_template_directory_uri(); ?>/framework/admin/images/empty.png'});
			});
			
			/* To Fix WPML Bug */
			jQuery( window ).load(function($) {
				var logo_settings = jQuery('input[name=logo_setting_save]').val();
					jQuery("#logo_setting-item input").each(function(){	
					if( jQuery(this).val() == logo_settings ) jQuery(this).attr('checked','checked');
			});
		 });
		</script>
		<div class="tiepanel-item">
			<h3><?php echo THEME_NAME ?> - <?php _e( 'Category Layout', 'tie' ) ?></h3>
			
			<?php
				$tie_category_layout = '';
				if ( !empty( $cat_option[ 'category_layout' ] ) )
					$tie_category_layout = $cat_option[ 'category_layout' ];
			?>
			
			<div class="option-item">
				<ul id="tie_category_layout" class="tie-options tie-archives-options" style="padding:0; margin:0;">
					<li>
						<input name="tie_cat[category_layout]" type="radio" value="excerpt" <?php if($tie_category_layout == 'excerpt' || !$tie_category_layout ) echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-1.png" /></a>
					</li>
					<li>
						<input name="tie_cat[category_layout]" type="radio" value="full_thumb" <?php if($tie_category_layout == 'full_thumb') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-2.png" /></a>
					</li>
					<li>
						<input name="tie_cat[category_layout]" type="radio" value="content" <?php if($tie_category_layout == 'content') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-3.png" /></a>
					</li>
					<li>
						<input name="tie_cat[category_layout]" type="radio" value="masonry" <?php if($tie_category_layout == 'masonry') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-4.png" /></a>
					</li>
					<li>
						<input name="tie_cat[category_layout]" type="radio" value="timeline" <?php if($tie_category_layout == 'timeline') echo $checked; ?> />
						<a class="checkbox-select" href="#"><img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/arc-6.png" /></a>
					</li>
				</ul>
			</div>
			
		</div>



		<div class="tiepanel-item">
			<h3><?php echo THEME_NAME ?> - <?php _e( 'Category Sidebar', 'tie' ) ?></h3>
			<?php
					
				tie_cat_options(				
					array(	"name"		=> __( 'Custom Sidebar', 'tie' ),
							"id"		=> "cat_sidebar",
							"type"		=> "select",
							"cat"		=> $t_id ,
							"options"	=> $new_sidebars ));
							

			?>
		</div>	
		
		
		<div class="tiepanel-item">
			<h3><?php echo THEME_NAME ?> - <?php _e( 'Category Slider', 'tie' ) ?></h3>
			<?php
				tie_cat_options(				
					array(	"name"		=> __( 'Slider', 'tie' ),
							"id"		=> "cat_slider",
							"type"		=> "select",
							"cat"		=> $t_id ,
							"options"	=> $cat_slider ));
							
				tie_cat_options(
					array(	"name"		=> __( 'Number of posts to show', 'tie' ),
							"id"		=> "slider_number",
							"default"	=> 5,
							"cat"		=> $t_id ,
							"type"		=> "short-text"));
		
				tie_cat_options(
					array(	"name"		=> __( 'Slider Type', 'tie' ),
							"id"		=> "slider_type",
							"type"		=> "radio",
							"cat"		=> $t_id ,
							"options"	=> array(	"flexi"		=> __( 'FlexSlider', 'tie' ) ,
													"elastic"	=> __( 'Elastic Slideshow', 'tie' ) )));
													
			?>
			<div id="elastic">
			<?php
				tie_cat_options(
					array(	"name"		=> __( 'Animation Effect', 'tie' ),
							"id"		=> "elastic_slider_effect",
							"type"		=> "select",
							"cat"		=> $t_id ,
							"options"	=> array(
											'center'	=> __( 'Center', 'tie' ),
											'sides'		=> __( 'Sides', 'tie' )	)));

				tie_cat_options(
					array(	"name"	=> __( 'Autoplay', 'tie' ),
							"id"	=> "elastic_slider_autoplay",
							"cat"		=> $t_id ,
							"type"	=> "checkbox"));
						
						
				tie_cat_options(
					array(	"name"		=> __( 'Slideshow Speed', 'tie' ),
							"id"		=> "elastic_slider_interval",
							"type"		=> "slider",
							"cat"		=> $t_id ,
							"unit"		=> "ms",
							"default"	=> 3000,
							"max"		=> 40000,
							"min"		=> 100 ));

				tie_cat_options(
					array(	"name"		=> __( 'Animation Speed', 'tie' ),
							"id"		=> "elastic_slider_speed",
							"type"		=> "slider",
							"cat"		=> $t_id ,
							"unit"		=> "ms",
							"default"	=> 800,
							"max"		=> 40000,
							"min"		=> 100 ));
				?>
			</div>

			<div id="flexi">
				<?php
				tie_cat_options(
					array(	"name"		=> __( 'Animation Effect', 'tie' ),
							"id"		=> "flexi_slider_effect",
							"type"		=> "select",
							"cat"		=> $t_id ,
							"options"	=> array(
												'fade'		=> __( 'Fade', 'tie' ),
												'slideV'	=> __( 'Slide Vertical', 'tie' ),
												'slideH'	=> __( 'Slide Horizontal', 'tie' ))));
						
				tie_cat_options(
					array(	"name"		=> __( 'Slideshow Speed', 'tie' ),
							"id"		=> "flexi_slider_speed",
							"type"		=> "slider",
							"cat"		=> $t_id ,
							"unit"		=> "ms",
							"default"	=> 7000,
							"max"		=> 40000,
							"min"		=> 100 ));

				tie_cat_options(
					array(	"name"		=> __( 'Animation Speed', 'tie' ),
							"id"		=> "flexi_slider_time",
							"type"		=> "slider",
							"cat"		=> $t_id ,
							"unit"		=> "ms",
							"default"	=> 600,
							"max"		=> 40000,
							"min"		=> 100 ));
					?>
			</div>
			<?php
				tie_cat_options(
					array(	"name"	=> __( 'Show Slides Caption', 'tie' ),
							"id"	=> "slider_caption",
							"cat"		=> $t_id ,
							"type"	=> "checkbox")); 

				tie_cat_options(
					array(	"name"		=> __( 'Slides Caption Length', 'tie' ),
							"id"		=> "slider_caption_length",
							"cat"		=> $t_id ,
							"default"	=> 100,
							"type"		=> "short-text"));								
			?>
			
		</div>
			
			
		<div class="tiepanel-item">
			<h3><?php echo THEME_NAME ?> - <?php _e( 'Category Logo', 'tie' ) ?></h3>
			<?php
				tie_cat_options(
					array(	"name"	=> __( 'Custom Logo', 'tie' ),
							"id"	=> "cat_custom_logo",
							"cat"	=> $t_id ,
							"type"	=> "checkbox"));
							
				tie_cat_options(
					array( 	"name"		=> __( 'Logo Setting', 'tie' ),
							"id"		=> "logo_setting",
							"type"		=> "radio",
							"cat"		=> $t_id ,
							"options"	=> array(	"logo"	=>	__( 'Custom Image Logo', 'tie' ) ,
													"title"	=>	__( 'Display The Category Title', 'tie' ) )));
				?>
				<input type="hidden" name="logo_setting_save" value="<?php if( !empty($cat_option[ 'logo_setting' ]) )  echo $cat_option['logo_setting'];?>" />
				<?php
				tie_cat_options(
					array(	"name"	=> __( 'Custom Logo Image', 'tie' ),
							"id"	=> "logo",
							"cat"	=> $t_id ,
							"type"	=> "upload"));
					
				tie_cat_options(
					array(	"name"			=> __( 'Logo Image (Retina Version @2x)', 'tie' ),
							"id"			=> "logo_retina",
							"type"			=> "upload",
							"cat"			=> $t_id ,
							"extra_text"	=> __( 'Please choose an image file for the retina version of the logo. It should be 2x the size of main logo.', 'tie' ))); 			
					
				tie_cat_options(
					array(	"name"			=> __( 'Standard Logo Width for Retina Logo', 'tie' ),
							"id"			=> "logo_retina_width",
							"type"			=> "short-text",
							"cat"			=> $t_id ,
							"extra_text"	=> __( 'If retina logo is uploaded, please enter the standard logo (1x) version width, do not enter the retina logo width.', 'tie' ))); 			

				tie_cat_options(
					array(	"name"			=> __( 'Standard Logo Height for Retina Logo', 'tie' ),
							"id"			=> "logo_retina_height",
							"type"			=> "short-text",
							"cat"			=> $t_id ,
							"extra_text"	=> __( 'If retina logo is uploaded, please enter the standard logo (1x) version height, do not enter the retina logo height.', 'tie' ))); 			
								
								
				tie_cat_options(
					array(	"name"	=> __( 'Logo Margin Top', 'tie' ),
							"id"	=> "logo_margin",
							"type"	=> "slider",
							"cat"	=> $t_id ,
							"unit"	=> "px",
							"max"	=> 100,
							"min"	=> 0 ));
							
				tie_cat_options(
					array(	"name"	=> __( 'Logo Margin Bottom', 'tie' ),
							"id"	=> "logo_margin_bottom",
							"type"	=> "slider",
							"cat"	=> $t_id ,
							"unit"	=> "px",
							"max"	=> 100,
							"min"	=> 0 ));
			?>
		</div>
		
		<div class="tiepanel-item">
			<h3><?php echo THEME_NAME ?> - <?php _e( 'Category Style', 'tie' ) ?></h3>
			<?php
				tie_cat_options(				
					array(	"name"	=> __( 'Main Color', 'tie' ),
							"id"	=> "cat_color",
							"cat"	=> $t_id ,
							"type"	=> "color" ));
								
				tie_cat_options(
					array(	"name"	=> __( 'Background', 'tie' ),
							"id"	=> "cat_background",
							"cat"	=> $t_id ,
							"type"	=> "background"));
								
				tie_cat_options(
					array(	"name"	=> __( 'Full Screen Background', 'tie' ),
							"id"	=> "cat_background_full",
							"cat"	=> $t_id ,
							"type"	=> "checkbox"));
				?>
		</div>
				
	</td>
</tr>
<?php
}


/*-----------------------------------------------------------------------------------*/
# Save Category Custom Options
/*-----------------------------------------------------------------------------------*/
add_action ( 'edited_category', 'tie_save_extra_category_fileds');
function tie_save_extra_category_fileds( $term_id ) {

	if( !empty( $_POST["tie_cat"] ) ){
		$tie_cats_options = get_option( 'tie_cats_options' );
		$tie_cats_options[ $term_id ] = $_POST["tie_cat"];

		update_option( "tie_cats_options", $tie_cats_options );
	}
}
?>
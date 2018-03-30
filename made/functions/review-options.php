<?php
//foreach($oswcPostTypes->postTypes as $postType){
	//$oswc_reviews['enable_' . $postType->safe_name] = true;
//}

if ( is_admin() ) : // Load only if we are viewing an admin page

function oswc_register_review_settings() {
	// Register settings and call sanitation functions
	register_setting( 'oswc_theme_reviews', 'oswc_reviews', 'oswc_validate_reviews' );
}

add_action( 'admin_init', 'oswc_register_review_settings' );

function oswc_review_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Review Options', 'Review Options', 'edit_theme_options', 'review_options', 'oswc_review_home_page' );
}

add_action( 'admin_menu', 'oswc_review_options' );

// Function to generate options page
function oswc_review_home_page() {
	global $pagenow;

	if ( $pagenow == 'themes.php' && $_GET['page'] == 'review_options' ) :

    	theme_reviews_options();

	endif;
}

// Function to generate options page
function theme_reviews_options() {
	global $oswc_reviews, $oswcPostTypes;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'made' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<div class="wrap">

	<form method="post" action="options.php">

	<?php $settings = get_option( 'oswc_reviews', $oswc_reviews ); ?>

	<?php settings_fields( 'oswc_theme_reviews' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

    	<div style="margin-top:20px;">

            <div style="float:left;width:250px;">

                <?php screen_icon(); echo "<h2>" . __( 'Review Options','made' ) . "</h2>"; ?>

            </div>

            <div style="float:left;margin-top:5px;">

                <img src="<?php echo get_template_directory_uri(); ?>/functions/images/review-icons.jpg" alt="Review Icons" />

            </div>

            <div style="clear:both;">&nbsp;</div>

        </div>

        <div style="padding:15px 15px 20px 15px;background:#F0F6FF;border:1px solid #CCC;margin:0px 0px 25px 0px;width:820px;">
            <table class="form-table">

            <tr valign="top"><th scope="row" style="text-align:right;">
            <div class="review-types-label">
            	<div class="review-types-header">
                	<label for="review_types"><?php _e( 'Review Types', 'made' ); ?></label>
                </div>
                <div class="review-types-note">
                	<?php _e( 'separated by commas','made' ); ?>
                </div>
            </div>
            <div style="border:1px solid #DDD;background:#FFF;font-size:1.4em;padding:18px 12px;color:#555;text-align:left;margin:15px 0px 0px 0px;line-height:1.8em;">
            	<span style="font-size:1.2em;color:#333;letter-spacing:-1px;"><?php _e( 'Easy as 1, 2, 3...','made' ); ?></span><br />
                <?php _e( '1. Enter Types','made' ); ?><br />
                <?php _e( '2. Click Update','made' ); ?><br />
                <?php _e( '3. Adjust Settings','made' ); ?>
            </div>
            </th>
            <td>
            <!--<input id="review_types" name="oswc_reviews[review_types]" type="text" value="<?php if(!empty($settings['review_types'])) { esc_attr_e($settings['review_types']);} ?>" style="width:580px;padding:7px 15px;background:#FFF;color:#000;font-size:1.3em;border:1px solid #666;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;" />-->
            <textarea id="review_types" name="oswc_reviews[review_types]" rows="4" cols="50" style="width:580px;padding:7px 15px;background:#FFF;color:#000;font-size:1.3em;border:1px solid #666;font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif;"><?php if(!empty($settings['review_types'])) { esc_attr_e($settings['review_types']);} ?></textarea>
            <div style="color:#777;">
                <span style="font-size:.9em;"><em><?php _e( 'Example: Laptop, Tablet, Smart Phone', 'made' ); ?></em></span><br />                
                <span style="color:red;font-size:.9em;"><?php _e( 'WARNING: Removing or renaming a review type will cause you to lose all settings. Instead, disable it below. If you need to rename a review type, see the FAQ in the theme item description for instructions on how to do so.','made' ); ?></span>               
                <br />
            	<?php _e( 'Click "Update Review Types" after you enter your review types to refresh the settings panels below.','made' ); ?><br /><br />
                <?php _e( 'Tip: it is recommended (but not required) to use the singular instead of plural version of the review type name ("Movie" instead of "Movies") for aesthetic purposes. You can name the review page in your menu whatever you want independant of the official review type name entered above.','made' ); ?><br /><br />
                <b><?php _e( 'Make sure you capitalize the names of your review types and separate each one with a comma!','made' ); ?></b><br />
                <?php _e( 'Also any time you modify your list of review types you should go to Settings >> Permalinks and click Save.','made' ); ?><br /><br />
                <input type="submit" class="button-primary" value="Update Review Types" />
                <br class="clearer" />
            </div>
            </td>
            </tr>

            </table>
        </div>

        <div class="rm_wrap">
            <div class="rm_opts">

                <?php
				if(!empty($settings['review_types'])) {
                	$reviewTypes = explode(",",$settings['review_types']);				
					foreach($reviewTypes as $reviewTypeName) {
						$reviewTypeName = trim($reviewTypeName);
						//get equivalent of "safe_name" for this review type
						$reviewType = trim(str_replace(" ","_",str_replace("/", "", str_replace("-","_",$reviewTypeName)))); ?>
                        
                        <?php //setup defaults
						if(!isset($settings['enabled_'.$reviewType])) {
							$settings['enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['taxonomies_number_'.$reviewType])) {
							$settings['taxonomies_number_'.$reviewType] = 1;
						}	
						if(!isset($settings['skin_'.$reviewType])) {
							$settings['skin_'.$reviewType] = 'light';
						}	
						if(!isset($settings['color_'.$reviewType])) {
							$settings['color_'.$reviewType] = 'C32C0D';
						}
						if(!isset($settings['link_color_'.$reviewType])) {
							$settings['link_color_'.$reviewType] = 'DB2303';
						}
						if(!isset($settings['bg_color_'.$reviewType])) {
							$settings['bg_color_'.$reviewType] = 'F0F0F0';
						}
						if(!isset($settings['rating_type_'.$reviewType])) {
							$settings['rating_type_'.$reviewType] = 'stars';
						}
						if(!isset($settings['user_ratings_enabled_'.$reviewType])) {
							$settings['user_ratings_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['rating_color_range_enabled_'.$reviewType])) {
							$settings['rating_color_range_enabled_'.$reviewType] = 1;
						}	
						if(!isset($settings['rating_color_ranges_'.$reviewType])) {
							$settings['rating_color_ranges_'.$reviewType] = array(20, 40, 60, 80);
						}	
						if(!isset($settings['rating_color_'.$reviewType])) {
							$settings['rating_color_'.$reviewType] = 'yellow';
						}
						if(!isset($settings['rating_criteria_number_'.$reviewType])) {
							$settings['rating_criteria_number_'.$reviewType] = 1;
						}	
						if(!isset($settings['layout_'.$reviewType])) {
							$settings['layout_'.$reviewType] = 'A';
						}
						if(!isset($settings['featured_enabled_'.$reviewType])) {
							$settings['featured_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['featured_size_'.$reviewType])) {
							$settings['featured_size_'.$reviewType] = 'small';
						}
						if(!isset($settings['front_sidebar_enabled_'.$reviewType])) {
							$settings['front_sidebar_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['dontmiss_enabled_'.$reviewType])) {
							$settings['dontmiss_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['latest_enabled_'.$reviewType])) {
							$settings['latest_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['excerpt_enabled_'.$reviewType])) {
							$settings['excerpt_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['meta_enabled_'.$reviewType])) {
							$settings['meta_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['trending_enabled_'.$reviewType])) {
							$settings['trending_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_layout_'.$reviewType])) {
							$settings['tax_layout_'.$reviewType] = 'A';
						}
						if(!isset($settings['tax_sidebar_enabled_'.$reviewType])) {
							$settings['tax_sidebar_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_dontmiss_enabled_'.$reviewType])) {
							$settings['tax_dontmiss_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_latest_enabled_'.$reviewType])) {
							$settings['tax_latest_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_excerpt_enabled_'.$reviewType])) {
							$settings['tax_excerpt_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_meta_enabled_'.$reviewType])) {
							$settings['tax_meta_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_trending_enabled_'.$reviewType])) {
							$settings['tax_trending_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['meta_fields_number_'.$reviewType])) {
							$settings['meta_fields_number_'.$reviewType] = 1;
						}	
						if(!isset($settings['single_dontmiss_enabled_'.$reviewType])) {
							$settings['single_dontmiss_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['single_latest_enabled_'.$reviewType])) {
							$settings['single_latest_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['sidebar_enabled_'.$reviewType])) {
							$settings['sidebar_enabled_'.$reviewType] = 1;
						}
						if(!isset($settings['tax_above_meta_'.$reviewType])) {
							$settings['tax_above_meta_'.$reviewType] = 0;
						}
						if(!isset($settings['positive_'.$reviewType])) {
							$settings['positive_'.$reviewType] = 'Positives';
						}
						if(!isset($settings['negative_'.$reviewType])) {
							$settings['negative_'.$reviewType] = 'Negatives';
						}
						if(!isset($settings['bottom_line_'.$reviewType])) {
							$settings['bottom_line_'.$reviewType] = 'Bottom Line';
						}
						if(!isset($settings['related_number_'.$reviewType])) {
							$settings['related_number_'.$reviewType] = 6;
						}
						
						?>
	
						<?php //general settings ?>
						<div class="rm_section">
							<div class="rm_title">
								<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus" /><?php _e( $reviewType.' Settings', 'made' ); ?></h3>
								<span class="submit">
									<input type="submit" value="Save Options" />
								</span>
								<div class="clearfix"></div>
							</div>
	
							<div class="rm_options">
                            
                            	<table class="form-table">
                            	<tr valign="top"><th scope="row"><?php _e( 'Review Type Status', 'made' ); ?></th>
                                <td>
                                <input type="radio" id="enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['enabled_'.$reviewType], 1 ); ?> />
                                <label for="enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;    
                                <input type="radio" id="enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['enabled_'.$reviewType], 0 ); ?> />
                                <label for="enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php _e( 'Disabling this review type will retain all the settings and reviews.', 'made' ); ?>
                                </td>
                                </tr>
                                </table>
                            
                            	<div class="rm_section">
									<div class="rm_title rm_subtitle">
										<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus"><?php _e( 'Global Settings', 'made' ); ?></h3>
										<span class="submit">
											<input type="submit" value="Save Options" />
										</span>
										<div class="clearfix"></div>
									</div>
									<div class="rm_options">
	
										<table class="form-table">
	
										<tr valign="top">
										<td colspan="2">
										<div class="note"><?php _e( 'These settings apply to all the pages in this review type, including the front page, taxonomy pages, and single review pages.', 'made' ); ?></div>
										</td>
										</tr>
	
										<?php //default of 4 taxonomies
										$num = $settings['taxonomies_number_'.$reviewType];
										if($num=="" || empty($num) || $num==0 || is_null($num)) $num=4;
										?>
										<tr valign="top"><th scope="row"><?php _e( 'Number of Taxonomies', 'made' ); ?></th>
										<td>
										<select id="taxonomies_number_<?php echo $reviewType; ?>" name="oswc_reviews[taxonomies_number_<?php echo $reviewType; ?>]">
											<?php $i=1;
											while ($i<=15) { ?>
												<option value="<?php echo $i; ?>"<?php if($num==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
											<?php $i++;
											} ?>
										</select>
										<?php _e('If you change this number you must click Save Changes to update the number of textboxes below.','made'); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top">
										<td colspan="2">
										<div class="note"><?php _e( 'Each value entered will be added as a new custom taxonomy for this review type. Think of taxonomies as a way of grouping and organizing the posts in this review type. Taxonomies are just like regular WordPress categories that you assign to standard posts, except they are tailored to this specific review type. For instance, for a Movie review type, the taxonomies could be Genre, Director, MPAA Rating, and Main Actor. The primary taxonomy is what is used to create the taxonomy submenu.', 'made' ); ?></div>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Taxonomies', 'made' ); ?></th>
										<td>
											<?php //extract values from array
											$taxonomies = $settings['taxonomies_'.$reviewType];
	
											// echo "<h1>settings?</h1>";
											// print "<pre>";
											// print_r($settings);
											// print "</pre>";
	
											for($i = 1; $i <= $num; $i++) {
												$taxonomy = fixObject($taxonomies[$i-1]); //array index starts at 0
	
												// print "<pre>";
												// print_r($taxonomy);
												// print "</pre>";
	
												// if(is_object($taxonomy)){
												//     echo "it's an object";
												// }else{
												//     echo "it is not an object";
												// }
												//die();
												$taxonomyName = trim($taxonomy->name);
												$taxonomySlug = trim($taxonomy->id);
												//echo "taxonomyName=".$taxonomyName;
												if(!isset($settings['taxonomies_'.$reviewType])) {
													$taxonomyName = 'taxonomy 1'; //set the default for this taxonomy
													//$taxonomySlug = $reviewtype . '_taxonomy-1';
												}
												?>
													<?php if($i==1) { ?>
                                                    	<div style="float:left;width:210px;"><b><?php _e( 'Primary Taxonomy Name:','made' ); ?></b></div>
                                                        <div style="float:left;width:380px;margin-left:20px;color:#999;"><?php _e( 'Slug (optional - leave this alone unless you need to specify one):','made' ); ?></div>
                                                        <br class="clearer" />
                                                    <?php } elseif($i==2) { ?>
                                                    	<br />
                                                    	<div style="float:left;width:210px;"><b><?php _e( 'Secondary Taxonomy Name(s):','made' ); ?></b></div>
                                                        <div style="float:left;width:380px;margin-left:20px;color:#999;"><?php _e( 'Slug (optional - leave this alone unless you need to specify one):','made' ); ?></div>
                                                        <br class="clearer" />
                                                    <?php } ?>
                                                    <div style="float:left;width:210px;">
                                                    	<input id="taxonomy_<?php echo $i; ?>_<?php echo $reviewType; ?>" name="oswc_reviews[taxonomy_<?php echo $i; ?>_<?php echo $reviewType; ?>]" type="text" value="<?php echo $taxonomyName; ?>" style="width:200px;" />
                                                    </div>
                                                    <div style="float:left;width:380px;margin-left:20px;">
                                                    	<input id="taxonomy_slug_<?php echo $i; ?>_<?php echo $reviewType; ?>" name="oswc_reviews[taxonomy_slug_<?php echo $i; ?>_<?php echo $reviewType; ?>]" type="text" value="<?php echo $taxonomySlug; ?>" style="width:200px;color:#999;" />
                                                    </div>
                                                    <br class="clearer" />
	
											<?php } ?>										
	
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Display Header Ad', 'made' ); ?></th>
										<td>
										<input type="checkbox" id="header_ad_show_<?php echo $reviewType; ?>" name="oswc_reviews[header_ad_show_<?php echo $reviewType; ?>]" value="1" <?php checked( true, $settings['header_ad_show_' . $reviewType] ); ?> />
										<label for="header_ad_show_<?php echo $reviewType; ?>"><?php _e( 'Show the header ad for this review type', 'made' ); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="header_ad_<?php echo $reviewType; ?>"><?php _e( 'Header Ad HTML', 'made' ); ?></label></th>
										<td>
										<textarea id="header_ad_<?php echo $reviewType; ?>" name="oswc_reviews[header_ad_<?php echo $reviewType; ?>]" rows="4" cols="70"><?php echo stripslashes($settings['header_ad_'.$reviewType]); ?></textarea><br />
										<?php _e( 'This will override the value specified in the standard Theme Options for this review type (optional)', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Review-Specific Latest Slider', 'made' ); ?></th>
										<td>
										<input type="checkbox" id="latest_specific_<?php echo $reviewType; ?>" name="oswc_reviews[latest_specific_<?php echo $reviewType; ?>]" value="1" <?php checked( true, $settings['latest_specific_' . $reviewType] ); ?> />
										<label for="latest_specific_<?php echo $reviewType; ?>"><?php _e( 'The latest slider should only show posts from the current review type', 'made' ); ?></label>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Hide "Review" Verbiage', 'made' ); ?></th>
										<td>
										<input type="checkbox" id="hide_review_verbiage_<?php echo $reviewType; ?>" name="oswc_reviews[hide_review_verbiage_<?php echo $reviewType; ?>]" value="1" <?php checked( true, $settings['hide_review_verbiage_' . $reviewType] ); ?> />
										<label for="hide_review_verbiage_<?php echo $reviewType; ?>"><?php _e( 'Hide the word "Review" or "Reviews" wherever it is appended to a label or header.', 'made' ); ?></label>
										</td>
										</tr>
	
										</table>
	
									</div>
								</div>
	
								<div class="rm_section">
									<div class="rm_title rm_subtitle">
										<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus"><?php _e( 'Ratings, Colors, and Styles', 'made' ); ?></h3>
										<span class="submit">
											<input type="submit" value="Save Options" />
										</span>
										<div class="clearfix"></div>
									</div>
									<div class="rm_options">
	
										<table class="form-table">
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Skin', 'made' ); ?></th>
                                        <td>
                                        <input type="radio" id="skin_light_<?php echo $reviewType; ?>" name="oswc_reviews[skin_<?php echo $reviewType; ?>]" value="light" <?php checked( $settings['skin_'.$reviewType], "light" ); ?> />
                                        <label for="skin_light_<?php echo $reviewType; ?>"><?php _e('Light','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp; 
                                        <input type="radio" id="skin_dark_<?php echo $reviewType; ?>" name="oswc_reviews[skin_<?php echo $reviewType; ?>]" value="dark" <?php checked( $settings['skin_'.$reviewType], "dark" ); ?> />
                                        <label for="skin_dark_<?php echo $reviewType; ?>"><?php _e('Dark','made'); ?></label>
                                        </td>
                                        </tr> 
	
										<tr valign="top"><th scope="row"><label for="color_<?php echo $reviewType; ?>"><?php _e( 'Main Color', 'made' ); ?></label></th>
										<td>
										<div style="float:left;">
											#<input id="color_<?php echo $reviewType; ?>" name="oswc_reviews[color_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['color_'.$reviewType]); ?>" style="width:80px;" />
										</div>
										<div class="color_preview_wrapper">
											<div id="color_preview_<?php echo $reviewType; ?>" class="color_preview" style="background-color:#<?php esc_attr_e($settings['color_'.$reviewType]); ?>;">&nbsp;</div>
										</div>
	
										<br class="clearer" />
	
										<?php _e('The main review color that applies to the menu backgrounds and widget icon backgrounds','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="link_color_<?php echo $reviewType; ?>"><?php _e( 'Link Color', 'made' ); ?></label></th>
										<td>
										<div style="float:left;">
											#<input id="link_color_<?php echo $reviewType; ?>" name="oswc_reviews[link_color_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['link_color_'.$reviewType]); ?>" style="width:80px;" />
										</div>
										<div class="color_preview_wrapper">
											<div id="link_color_preview_<?php echo $reviewType; ?>" class="color_preview" style="background-color:#<?php esc_attr_e($settings['link_color_'.$reviewType]); ?>;">&nbsp;</div>
										</div>
	
										<br class="clearer" />
	
										<?php _e('The color of hyperlinks (leave blank to use default color)','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="link_color_<?php echo $reviewType; ?>"><?php _e( 'Background Color', 'made' ); ?></label></th>
										<td>
										<div style="float:left;">
											#<input id="bg_color_<?php echo $reviewType; ?>" name="oswc_reviews[bg_color_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['bg_color_'.$reviewType]); ?>" style="width:80px;" />
										</div>
										<div class="color_preview_wrapper">
											<div id="bg_color_preview_<?php echo $reviewType; ?>" class="color_preview" style="background-color:#<?php esc_attr_e($settings['bg_color_'.$reviewType]); ?>;">&nbsp;</div>
										</div>
	
										<br class="clearer" />
	
										<?php _e('The page background color (leave blank to use default color)','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="rating_type_<?php echo $reviewType; ?>"><?php _e( 'Rating Type', 'made' ); ?></label></th>
										<td class="smallbuttons">
										<div class="radiowrapper">
											<div class="radiobutton">
												<input type="radio" id="rating_stars_<?php echo $reviewType; ?>" name="oswc_reviews[rating_type_<?php echo $reviewType; ?>]" value="stars" <?php checked( $settings['rating_type_'.$reviewType], "stars" ); ?> />
											</div>
											<div class="radioimage">
												<label for="rating_stars_<?php echo $reviewType; ?>">
												stars<br />
												<img src="<?php echo get_template_directory_uri(); ?>/functions/images/rating-type-stars.png" alt="stars" />
												</label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												<input type="radio" id="rating_number_<?php echo $reviewType; ?>" name="oswc_reviews[rating_type_<?php echo $reviewType; ?>]" value="number" <?php checked( $settings['rating_type_'.$reviewType], "number" ); ?> />
											</div>
											<div class="radioimage">
												<label for="rating_number_<?php echo $reviewType; ?>">
												numbers<br />
												<img src="<?php echo get_template_directory_uri(); ?>/functions/images/rating-type-number.png" alt="numbers" />
												</label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												<input type="radio" id="rating_percentage_<?php echo $reviewType; ?>" name="oswc_reviews[rating_type_<?php echo $reviewType; ?>]" value="percentage" <?php checked( $settings['rating_type_'.$reviewType], "percentage" ); ?> />
											</div>
											<div class="radioimage">
												<label for="rating_percentage_<?php echo $reviewType; ?>">
												percentages<br />
												<img src="<?php echo get_template_directory_uri(); ?>/functions/images/rating-type-percentage.png" alt="percentages" />
												</label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												<input type="radio" id="rating_letter_<?php echo $reviewType; ?>" name="oswc_reviews[rating_type_<?php echo $reviewType; ?>]" value="letter" <?php checked( $settings['rating_type_'.$reviewType], "letter" ); ?> />
											</div>
											<div class="radioimage">
												<label for="rating_letter_<?php echo $reviewType; ?>">
												letters<br />
												<img src="<?php echo get_template_directory_uri(); ?>/functions/images/rating-type-letter.png" alt="letters" />
												</label>
											</div>
										</div>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'User Ratings', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="user_ratings_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[user_ratings_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['user_ratings_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="user_ratings_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;    
                                        <input type="radio" id="user_ratings_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[user_ratings_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['user_ratings_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="user_ratings_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label><br />
                                        <?php _e( 'Allow users to add a rating when they post a comment, and display the average user rating along with the number of user ratings directly underneath the Total Score in the rating overview panel on single review pages.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Rating Color Ranges', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="rating_color_range_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['rating_color_range_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="rating_color_range_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;    
                                        <input type="radio" id="rating_color_range_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['rating_color_range_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="rating_color_range_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label><br />
                                        <?php _e( 'Use rating background colors based on rating color ranges specified below (does not apply to star ratings). Note: the rating background color will still display behind the Total Score on single reviews.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top">
										<th scope="row" colspan="2">
										<div class="note"><?php _e( 'The following four values will split the ratings into five possible color ranges, from least to greatest: red, orange, yellow, light green, and dark green. Use whole numbers between 0 and 100 for percentage ratings or decimals between 0 and 10 for number ratings. The five possible colors are hard-coded into style.css lines 142 - 146, so if you want to override the standard colors you will need to add style to your custom.css file (recommended) or edit those lines in style.css (will be overwritten if you update the theme)', 'made' ); ?></div>
										</th>
										</tr>
	
										<?php //extract values from array
										$ranges = $settings['rating_color_ranges_'.$reviewType];
										?>
										<tr valign="top"><th scope="row"><?php _e( 'Color Ranges', 'made' ); ?></th>
										<td>
										<div style="float:left;">
										<input id="rating_color_range_1_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_1_<?php echo $reviewType; ?>]" type="text" value="<?php echo $ranges[0]; ?>" style="width:30px;" />
										</div>&nbsp;&nbsp;
										<div style="float:left;">
										<input id="rating_color_range_2_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_2_<?php echo $reviewType; ?>]" type="text" value="<?php echo $ranges[1]; ?>" style="width:30px;" />
										</div>&nbsp;&nbsp;
										<div style="float:left;">
										<input id="rating_color_range_3_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_3_<?php echo $reviewType; ?>]" type="text" value="<?php echo $ranges[2]; ?>" style="width:30px;" />
										</div>&nbsp;&nbsp;
										<div style="float:left;">
										<input id="rating_color_range_4_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_range_4_<?php echo $reviewType; ?>]" type="text" value="<?php echo $ranges[3]; ?>" style="width:30px;" />
										</div>
										<br class="clearer" />
										<?php _e('Recommended values: 20, 40, 60, 80 (percentages) and 2, 4, 6, 8 (numbers).','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="rating_color_<?php echo $reviewType; ?>"><?php _e( 'Star Color', 'made' ); ?></label></th>
										<td class="smallbuttons">
										<div style="width:640px;">
											<div class="radiowrapper">
												<div class="radiobutton">
													<input type="radio" id="rating_stars_yellow_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_<?php echo $reviewType; ?>]" value="yellow" <?php checked( $settings['rating_color_'.$reviewType], "yellow" ); ?> />
												</div>
												<div class="radioimage">
													<label for="rating_stars_yellow_<?php echo $reviewType; ?>">
													yellow<br />
													<img src="<?php echo get_template_directory_uri(); ?>/functions/images/stars-yellow.png" alt="yellow" />
													</label>
												</div>
											</div>
											<div class="radiowrapper">
												<div class="radiobutton">
													<input type="radio" id="rating_stars_orange_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_<?php echo $reviewType; ?>]" value="orange" <?php checked( $settings['rating_color_'.$reviewType], "orange" ); ?> />
												</div>
												<div class="radioimage">
													<label for="rating_stars_orange_<?php echo $reviewType; ?>">
													orange<br />
													<img src="<?php echo get_template_directory_uri(); ?>/functions/images/stars-orange.png" alt="orange" />
													</label>
												</div>
											</div>
											<div class="radiowrapper">
												<div class="radiobutton">
													<input type="radio" id="rating_stars_red_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_<?php echo $reviewType; ?>]" value="red" <?php checked( $settings['rating_color_'.$reviewType], "red" ); ?> />
												</div>
												<div class="radioimage">
													<label for="rating_stars_red_<?php echo $reviewType; ?>">
													red<br />
													<img src="<?php echo get_template_directory_uri(); ?>/functions/images/stars-red.png" alt="red" />
													</label>
												</div>
											</div>
											<div class="radiowrapper">
												<div class="radiobutton">
													<input type="radio" id="rating_stars_blue_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_<?php echo $reviewType; ?>]" value="blue" <?php checked( $settings['rating_color_'.$reviewType], "blue" ); ?> />
												</div>
												<div class="radioimage">
													<label for="rating_stars_blue_<?php echo $reviewType; ?>">
													blue<br />
													<img src="<?php echo get_template_directory_uri(); ?>/functions/images/stars-blue.png" alt="blue" />
													</label>
												</div>
											</div>
											<div class="radiowrapper">
												<div class="radiobutton">
													<input type="radio" id="rating_stars_green_<?php echo $reviewType; ?>" name="oswc_reviews[rating_color_<?php echo $reviewType; ?>]" value="green" <?php checked( $settings['rating_color_'.$reviewType], "green" ); ?> />
												</div>
												<div class="radioimage">
													<label for="rating_stars_green_<?php echo $reviewType; ?>">
													green<br />
													<img src="<?php echo get_template_directory_uri(); ?>/functions/images/stars-green.png" alt="green" />
													</label>
												</div>
											</div>
										</div>
										</td>
										</tr>
	
										<?php //default of 4 criteria
										$num = $settings['rating_criteria_number_'.$reviewType];
										if($num=="" || empty($num) || $num==0 || is_null($num)) $num=4;
										?>
										<tr valign="top"><th scope="row"><?php _e( 'Number of Rating Criteria', 'made' ); ?></th>
										<td>
										<select id="rating_criteria_number_<?php echo $reviewType; ?>" name="oswc_reviews[rating_criteria_number_<?php echo $reviewType; ?>]">
											<?php $i=1;
											while ($i<=20) { ?>
												<option value="<?php echo $i; ?>"<?php if($num==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
											<?php $i++;
											} ?>
										</select>
										<?php _e('If you change this number you must click Save Changes to update the number of textboxes below.','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Rating Criteria', 'made' ); ?></th>
										<td>
										<div style="float:left;">
											<?php //extract values from array
											$criteria = $settings['rating_criteria_'.$reviewType];
											for($i = 1; $i <= $num; $i++) {
												//print_r($criteria);
												$criterion = fixObject($criteria[$i-1]); //array index starts at 0
												// if(is_object($criterion)){
												//     die("name: " . $criterion->name);
												// }else{
												//     die("ftw?!?!?!");
												// }												
												$criterionName = trim($criterion->name);
												$criterion = trim(str_replace(" ","_",str_replace("/", "", str_replace("-","_",$criterionName))));
												if(!isset($settings['rating_criteria_'.$reviewType])) {
													$criterionName = 'criteria 1'; //set the default for this rating criterion
												}
												?>
													<input id="rating_criteria_<?php echo $i; ?>_<?php echo $reviewType; ?>" name="oswc_reviews[rating_criteria_<?php echo $i; ?>_<?php echo $reviewType; ?>]" type="text" value="<?php echo $criterionName; ?>" style="width:200px;" /><br />
	
											<?php } ?>
										</div>
	
										<div style="float:left;width:410px;margin-left:20px;margin-top:-10px;">
											<div class="note"><?php _e( 'Each value entered will be added in the "Review Info" box under the post content when editing a review, and will be averaged into the total score for the review. If you only specify one rating criteria it will be used as the total score.', 'made' ); ?></div>
										</div>
	
										<br class="clearer" />
	
										</td>
										</tr>
	
										<tr valign="top">
										<th scope="row" colspan="2">
										<div class="note"><?php _e( 'For the following image URL options you can use the Media >> Add New screen to upload your image. Copy + Paste the URL of your uploaded image into the appropriate box below', 'made' ); ?></div>
										</th>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="logo_<?php echo $reviewType; ?>"><?php _e( 'Logo URL', 'made' ); ?></label></th>
										<td>
										<textarea id="logo_<?php echo $reviewType; ?>" name="oswc_reviews[logo_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['logo_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review type logo (leave blank to use main site logo specified in Theme Options >> Miscellaneous)', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><label for="logo_<?php echo $reviewType; ?>"><?php _e( 'Logo URL (mobile)', 'made' ); ?></label></th>
										<td>
										<textarea id="logo_iphone_<?php echo $reviewType; ?>" name="oswc_reviews[logo_iphone_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['logo_iphone_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review type logo for mobile devices (leave blank to use main site logo specified in Theme Options >> Miscellaneous). Should be no more than about 300px wide.', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><label for="logo_<?php echo $reviewType; ?>"><?php _e( 'Logo URL (tablets)', 'made' ); ?></label></th>
										<td>
										<textarea id="logo_ipad_<?php echo $reviewType; ?>" name="oswc_reviews[logo_ipad_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['logo_ipad_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review type logo for tablets (leave blank to use main site logo specified in Theme Options >> Miscellaneous). Should be no more than about 720px wide.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="icon_<?php echo $reviewType; ?>"><?php _e( 'Icon Image URL (Dark on Light)', 'made' ); ?></label></th>
										<td>
										<textarea id="icon_<?php echo $reviewType; ?>" name="oswc_reviews[icon_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['icon_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review icon for use on light backgrounds. The icon itself should be dark. This is the small icon that displays on the front page and post listing pags next to the post thumbnail. Recommended size is 16px by 16px.', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><label for="icon_light_<?php echo $reviewType; ?>"><?php _e( 'Icon Image URL (Light on Dark)', 'made' ); ?></label></th>
										<td>
										<textarea id="icon_light_<?php echo $reviewType; ?>" name="oswc_reviews[icon_light_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['icon_light_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review icon for use on dark backgrounds. The icon itself should be light. This is the small icon that displays on the front page and post listing pags next to the post thumbnail. Recommended size is 16px by 16px. Please note, you should specify both a light and a dark icon since, even if you are not using the dark color scheme anywhere on your site, there are still a few places where a dark on light icon is needed. The exception to this would be if the icon you are using looks good on light and dark backgrounds, in which case you can leave this box blank.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="icon_admin_<?php echo $reviewType; ?>"><?php _e( 'Icon Image URL (Admin)', 'made' ); ?></label></th>
										<td>
										<textarea id="icon_admin_<?php echo $reviewType; ?>" name="oswc_reviews[icon_admin_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['icon_admin_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the review icon that displays in your WordPress dashboard. Recommended size is 16px by 16px.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="bg_image_<?php echo $reviewType; ?>"><?php _e( 'Background Image URL', 'made' ); ?></label></th>
										<td>
										<textarea id="bg_image_<?php echo $reviewType; ?>" name="oswc_reviews[bg_image_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['bg_image_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the background image (leave blank to use the main site background image specified in Theme Options >> Miscellaneous)', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Background Attachment', 'made' ); ?></th>
										<td>
										<input type="radio" id="bg_attach_fixed_<?php echo $reviewType; ?>" name="oswc_reviews[bg_attach_<?php echo $reviewType; ?>]" value="fixed" <?php checked( $settings['bg_attach_'.$reviewType], 'fixed' ); ?> />
										<label for="bg_attach_fixed_<?php echo $reviewType; ?>"><?php _e('Fixed','made'); ?></label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" id="bg_attach_scroll_<?php echo $reviewType; ?>" name="oswc_reviews[bg_attach_<?php echo $reviewType; ?>]" value="scroll" <?php checked( $settings['bg_attach_'.$reviewType], 'scroll' ); ?> />
										<label for="bg_attach_scroll_<?php echo $reviewType; ?>"><?php _e('Scroll','made'); ?></label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php _e( 'The CSS positioning of the background image', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><label for="logo_bar_image_<?php echo $reviewType; ?>"><?php _e( 'Logo Bar BG Image URL', 'made' ); ?></label></th>
										<td>
										<textarea id="logo_bar_image_<?php echo $reviewType; ?>" name="oswc_reviews[logo_bar_image_<?php echo $reviewType; ?>]" rows="2" cols="90"><?php echo stripslashes($settings['logo_bar_image_'.$reviewType]); ?></textarea><br />
										<?php _e( 'The URL of the logo bar background image (leave blank to use the review color specified above as the background color)', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Hide Logo Bar Background', 'made' ); ?></th>
										<td>
										<input type="checkbox" id="hide_logo_bar_bg_<?php echo $reviewType; ?>" name="oswc_reviews[hide_logo_bar_bg_<?php echo $reviewType; ?>]" value="1" <?php checked( true, $settings['hide_logo_bar_bg_' . $reviewType] ); ?> />
										<label for="hide_logo_bar_bg_<?php echo $reviewType; ?>"><?php _e( 'Do not display anything for the background of the logo bar, regardless of what is specified above for the review color and logo bar bg image url. This is handy if you want to let your main background image show through in the logo bar area.', 'made' ); ?></label>
										</td>
										</tr>
	
										</table>
	
									</div>
								</div>
	
								<div class="rm_section">
									<div class="rm_title rm_subtitle">
										<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus"><?php _e( 'Front Page', 'made' ); ?></h3>
										<span class="submit">
											<input type="submit" value="Save Options" />
										</span>
										<div class="clearfix"></div>
									</div>
									<div class="rm_options">
	
										<table class="form-table">
	
										<tr valign="top">
										<td colspan="2">
										<div class="note"><?php _e( 'This is the front page of this specific review type. Each review type you create has its own front page, which can be thought of as a minisite homepage. These settings all work independently of each other review type and the main site front page (Theme Options >> Front Page).', 'made' ); ?></div>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Layout', 'made' ); ?></th>
										<td>
										<div class="radiowrapper">
											<div class="radiobutton">
												A<br />
												<input type="radio" id="layout_A_<?php echo $reviewType; ?>" name="oswc_reviews[layout_<?php echo $reviewType; ?>]" value="A" <?php checked( $settings['layout_'.$reviewType], "A" ); ?> />
											</div>
											<div class="radioimage">
												<label for="layout_A_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-A.png" alt="layout A" /></label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												B<br />
												<input type="radio" id="layout_B_<?php echo $reviewType; ?>" name="oswc_reviews[layout_<?php echo $reviewType; ?>]" value="B" <?php checked( $settings['layout_'.$reviewType], "B" ); ?> />
											</div>
											<div class="radioimage">
												<label for="layout_B_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-B.png" alt="layout B" /></label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												C<br />
												<input type="radio" id="layout_C_<?php echo $reviewType; ?>" name="oswc_reviews[layout_<?php echo $reviewType; ?>]" value="C" <?php checked( $settings['layout_'.$reviewType], "C" ); ?> />
											</div>
											<div class="radioimage">
												<label for="layout_C_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-C.png" alt="layout C" /></label>
											</div>
										</div>	
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Featured Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="featured_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[featured_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['featured_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="featured_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;    
                                        <input type="radio" id="featured_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[featured_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['featured_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="featured_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="front_sidebar_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[front_sidebar_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['front_sidebar_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="front_sidebar_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="front_sidebar_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[front_sidebar_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['front_sidebar_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="front_sidebar_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Featured Slider Size', 'made' ); ?></th>
										<td>
										<input type="radio" id="featured_size_small_<?php echo $reviewType; ?>" name="oswc_reviews[featured_size_<?php echo $reviewType; ?>]" value="small" <?php checked( $settings['featured_size_'.$reviewType], 'small' ); ?> />
										<label for="featured_size_small_<?php echo $reviewType; ?>"><?php _e('Small','made'); ?></label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="radio" id="featured_size_large_<?php echo $reviewType; ?>" name="oswc_reviews[featured_size_<?php echo $reviewType; ?>]" value="large" <?php checked( $settings['featured_size_'.$reviewType], 'large' ); ?> />
										<label for="featured_size_large_<?php echo $reviewType; ?>"><?php _e('Large','made'); ?></label>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Dont-Miss Bar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="dontmiss_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[dontmiss_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['dontmiss_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="dontmiss_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="dontmiss_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[dontmiss_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['dontmiss_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="dontmiss_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Latest Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="latest_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[latest_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['latest_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="latest_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="latest_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[latest_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['latest_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="latest_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Review Excerpts', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="excerpt_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[excerpt_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['excerpt_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="excerpt_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="excerpt_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[excerpt_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['excerpt_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="excerpt_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Review Meta', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="meta_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[meta_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['meta_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="meta_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="meta_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[meta_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['meta_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="meta_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'The rating, number of comments, date, comments, tags, etc.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Trending Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="trending_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[trending_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['trending_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="trending_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="trending_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[trending_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['trending_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="trending_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										</table>
	
									</div>
								</div>
	
								<div class="rm_section">
									<div class="rm_title rm_subtitle">
										<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus"><?php _e( 'Taxonomy Pages', 'made' ); ?></h3>
										<span class="submit">
											<input type="submit" value="Save Options" />
										</span>
										<div class="clearfix"></div>
									</div>
									<div class="rm_options">
	
										<table class="form-table">
	
										<tr valign="top">
										<td colspan="2">
										<div class="note"><?php _e( 'These are pages that list articles from your taxonomies within the review type. Any time you click on a taxonomy link (for instance "Genre" in a "Movie" review type), you are viewing a taxonomy page. It is the same as a standard WordPress category archive page, except it lists posts from the custom taxonomies that you have specified for this review type.', 'made' ); ?></div>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Layout', 'made' ); ?></th>
										<td>
										<div class="radiowrapper">
											<div class="radiobutton">
												A<br />
												<input type="radio" id="tax_layout_A_<?php echo $reviewType; ?>" name="oswc_reviews[tax_layout_<?php echo $reviewType; ?>]" value="A" <?php checked( $settings['tax_layout_'.$reviewType], "A" ); ?> />
											</div>
											<div class="radioimage">
												<label for="tax_layout_A_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-A.png" alt="layout A" /></label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												B<br />
												<input type="radio" id="tax_layout_B_<?php echo $reviewType; ?>" name="oswc_reviews[tax_layout_<?php echo $reviewType; ?>]" value="B" <?php checked( $settings['tax_layout_'.$reviewType], "B" ); ?> />
											</div>
											<div class="radioimage">
												<label for="tax_layout_B_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-B.png" alt="layout B" /></label>
											</div>
										</div>
										<div class="radiowrapper">
											<div class="radiobutton">
												C<br />
												<input type="radio" id="tax_layout_C_<?php echo $reviewType; ?>" name="oswc_reviews[tax_layout_<?php echo $reviewType; ?>]" value="C" <?php checked( $settings['tax_layout_'.$reviewType], "C" ); ?> />
											</div>
											<div class="radioimage">
												<label for="tax_layout_C_<?php echo $reviewType; ?>"><img src="<?php echo get_template_directory_uri(); ?>/functions/images/post-layout-C.png" alt="layout C" /></label>
											</div>
										</div>	
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_sidebar_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_sidebar_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_sidebar_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_sidebar_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_sidebar_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_sidebar_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_sidebar_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_sidebar_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Dont-Miss Bar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_dontmiss_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_dontmiss_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_dontmiss_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_dontmiss_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_dontmiss_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_dontmiss_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_dontmiss_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_dontmiss_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Latest Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_latest_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_latest_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_latest_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_latest_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_latest_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_latest_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_latest_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_latest_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Review Excerpts', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_excerpt_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_excerpt_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_excerpt_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_excerpt_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_excerpt_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_excerpt_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_excerpt_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_excerpt_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Review Meta', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_meta_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_meta_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_meta_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_meta_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_meta_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_meta_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_meta_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_meta_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e( 'The rating, number of comments, date, comments, tags, etc.', 'made' ); ?>
										</td>
										</tr>										
	
										<tr valign="top"><th scope="row"><?php _e( 'Trending Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_trending_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_trending_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_trending_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="tax_trending_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_trending_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_trending_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_trending_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="tax_trending_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										</table>
	
									</div>
								</div>
	
								<div class="rm_section">
									<div class="rm_title rm_subtitle">
										<h3><img src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png" class="inactive" alt="plus"><?php _e( 'Single Review Pages', 'made' ); ?></h3>
										<span class="submit">
											<input type="submit" value="Save Options" />
										</span>
										<div class="clearfix"></div>
									</div>
									<div class="rm_options">
	
										<table class="form-table">
	
										<tr valign="top">
										<td colspan="2">
										<div class="note"><?php _e( 'These are the full review details page, and they work just like regular WordPress post single pages, except all of these settings only apply to a single review page for this review type. There are several options that can be overwritten on a per-post basis (see the Layout meta panel below the post when editing the review for more information).', 'made' ); ?></div>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><?php _e( 'Dont-Miss Bar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="single_dontmiss_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[single_dontmiss_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['single_dontmiss_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="single_dontmiss_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="single_dontmiss_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[single_dontmiss_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['single_dontmiss_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="single_dontmiss_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Latest Slider', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="single_latest_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[single_latest_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['single_latest_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="single_latest_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="single_latest_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[single_latest_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['single_latest_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="single_latest_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Sidebar', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="sidebar_enabled_true_<?php echo $reviewType; ?>" name="oswc_reviews[sidebar_enabled_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['sidebar_enabled_'.$reviewType], 1 ); ?> />
                                        <label for="sidebar_enabled_true_<?php echo $reviewType; ?>"><?php _e('Enabled','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="sidebar_enabled_false_<?php echo $reviewType; ?>" name="oswc_reviews[sidebar_enabled_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['sidebar_enabled_'.$reviewType], 0 ); ?> />
                                        <label for="sidebar_enabled_false_<?php echo $reviewType; ?>"><?php _e('Disabled','made'); ?></label><br />
                                        <?php _e( 'This enables the Sidebar next to the post content. If disabled, the post content will expand to fulll-width automatically, but the sidebar will still display next to the review overview panel at the top.', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="summary_header_text_<?php echo $reviewType; ?>"><?php _e( 'Summary Header Text', 'made' ); ?></label></th>
										<td>
										<input id="summary_header_text_<?php echo $reviewType; ?>" name="oswc_reviews[summary_header_text_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['summary_header_text_'.$reviewType]); ?>" /><br />
										<?php _e( 'The header text for the summary box that houses all of the post meta information (leave blank for default value of "Summary")', 'made' ); ?>
										</td>
										</tr>
	
										<?php //default of 4 meta fields
										$num = $settings['meta_fields_number_'.$reviewType];
										if($num=="" || empty($num) || $num==0 || is_null($num)) $num=4;
										?>
										<tr valign="top"><th scope="row"><?php _e( 'Number of Meta Fields', 'made' ); ?></th>
										<td>
										<select id="meta_fields_number_<?php echo $reviewType; ?>" name="oswc_reviews[meta_fields_number_<?php echo $reviewType; ?>]">
											<?php $i=1;
											while ($i<=30) { ?>
												<option value="<?php echo $i; ?>"<?php if($num==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
											<?php $i++;
											} ?>
										</select>
										<?php _e('If you change this number you must click Save Changes to update the number of textboxes below.','made'); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Meta Fields', 'made' ); ?></th>
										<td>
										<div style="float:left;">
											<?php //extract values from array
											$metafields = $settings['meta_fields_'.$reviewType];
											for($i = 1; $i <= $num; $i++) {
												$metafield = fixObject($metafields[$i-1]); //array index starts at 0
												$metafieldName = trim($metafield->name);
												if(!isset($settings['meta_fields_'.$reviewType])) {
													$metafieldName = 'meta field 1'; //set the default for this meta field
												}
												//echo "metafieldName=".$metafieldName;
												?>
													<input id="meta_field_<?php echo $i; ?>_<?php echo $reviewType; ?>" name="oswc_reviews[meta_field_<?php echo $i; ?>_<?php echo $reviewType; ?>]" type="text" value="<?php echo $metafieldName; ?>" style="width:200px;" /><br />
	
											<?php } ?>
										</div>
	
										<div style="float:left;width:380px;margin-left:20px;margin-top:-10px;">
											<div class="note"><?php _e( 'Each value entered will be added in the "Review Info" box under the post content when editing a review, and will be displayed in the review summary box on single review pages. Meta fields should be used for identifying information that is not easily grouped into a list of taxonomies (categories). For instance, for a Movie review type, this could include such information as Length, Synopsis, Release Date, and Producers.', 'made' ); ?></div>
										</div>
	
										<br class="clearer" />
	
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="positive_<?php echo $reviewType; ?>"><?php _e( 'Positives Label', 'made' ); ?></label></th>
										<td>
										<input id="positive_<?php echo $reviewType; ?>" name="oswc_reviews[positive_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['positive_'.$reviewType]); ?>" />
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="negative_<?php echo $reviewType; ?>"><?php _e( 'Negatives Label', 'made' ); ?></label></th>
										<td>
										<input id="negative_<?php echo $reviewType; ?>" name="oswc_reviews[negative_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['negative_'.$reviewType]); ?>" />
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="bottom_line_<?php echo $reviewType; ?>"><?php _e( 'Bottom Line Label', 'made' ); ?></label></th>
										<td>
										<input id="bottom_line_<?php echo $reviewType; ?>" name="oswc_reviews[bottom_line_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['bottom_line_'.$reviewType]); ?>" />
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><?php _e( 'Position of Taxonomies', 'made' ); ?></th>
										<td>
                                        <input type="radio" id="tax_above_meta_true_<?php echo $reviewType; ?>" name="oswc_reviews[tax_above_meta_<?php echo $reviewType; ?>]" value="1" <?php checked( $settings['tax_above_meta_'.$reviewType], 1 ); ?> />
                                        <label for="tax_above_meta_true_<?php echo $reviewType; ?>"><?php _e('Above Meta Fields','made'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;   
                                        <input type="radio" id="tax_above_meta_false_<?php echo $reviewType; ?>" name="oswc_reviews[tax_above_meta_<?php echo $reviewType; ?>]" value="0" <?php checked( $settings['tax_above_meta_'.$reviewType], 0 ); ?> />
                                        <label for="tax_above_meta_false_<?php echo $reviewType; ?>"><?php _e('Below Meta Fields','made'); ?></label><br />
                                        <?php _e( 'On single review pages in the overview panel, you can list taxonomies above or below the review meta fields.', 'made' ); ?>
										</td>
										</tr>
                                        
                                        <tr valign="top"><th scope="row"><label for="full_article_text_<?php echo $reviewType; ?>"><?php _e( 'Full Article Header Text', 'made' ); ?></label></th>
										<td>
										<input id="full_article_text_<?php echo $reviewType; ?>" name="oswc_reviews[full_article_text_<?php echo $reviewType; ?>]" type="text" value="<?php esc_attr_e($settings['full_article_text_'.$reviewType]); ?>" /><br />
										<?php _e( 'The header text for the Full Article Header bar that appears below the review overview area and above the full review content (leave blank for default value of "Full Article")', 'made' ); ?>
										</td>
										</tr>
	
										<tr valign="top"><th scope="row"><label for="related_number_<?php echo $reviewType; ?>"><?php _e( 'Number of Related Posts', 'made' ); ?></label></th>
										<td>
										<select id="related_number_<?php echo $reviewType; ?>" name="oswc_reviews[related_number_<?php echo $reviewType; ?>]">
											<?php $i=1;
											while ($i<=20) { ?>
												<option value="<?php echo $i; ?>"<?php if($settings['related_number_'.$reviewType]==$i) { ?> selected="selected"<?php } ?>><?php echo $i; ?></option>
											<?php $i++;
											} ?>
										</select>
										<?php _e( 'Maximum number of articles to display in each of the tabbed related posts boxes', 'made' ); ?><br />
										<?php _e( '(may be less depending on how many related posts there are)', 'made' ); ?>
										</td>
										</tr>
	
										</table>
	
									</div>
								</div>
							</div>
						</div>
	
						<br />
	
						<!-- enable color pickers for this review type (this needs to be done for each review type due to unique IDs) -->
						<script type="text/javascript">
						jQuery(document).ready(function(){
							//colorpickers
							jQuery('#color_<?php echo $reviewType; ?>').ColorPicker({
								onSubmit: function(hsb, hex, rgb, el) {
									jQuery(el).val(hex);
									jQuery(el).ColorPickerHide();
								},
								onBeforeShow: function () {
									jQuery(this).ColorPickerSetColor(this.value);
								},
								onChange: function (hsb, hex, rgb) {
									jQuery('#color_preview_<?php echo $reviewType; ?>').css('backgroundColor', '#' + hex);
									jQuery('#color_<?php echo $reviewType; ?>').val(hex);
								}
							})
							jQuery('#link_color_<?php echo $reviewType; ?>').ColorPicker({
								onSubmit: function(hsb, hex, rgb, el) {
									jQuery(el).val(hex);
									jQuery(el).ColorPickerHide();
								},
								onBeforeShow: function () {
									jQuery(this).ColorPickerSetColor(this.value);
								},
								onChange: function (hsb, hex, rgb) {
									jQuery('#link_color_preview_<?php echo $reviewType; ?>').css('backgroundColor', '#' + hex);
									jQuery('#link_color_<?php echo $reviewType; ?>').val(hex);
								}
							})
							jQuery('#bg_color_<?php echo $reviewType; ?>').ColorPicker({
								onSubmit: function(hsb, hex, rgb, el) {
									jQuery(el).val(hex);
									jQuery(el).ColorPickerHide();
								},
								onBeforeShow: function () {
									jQuery(this).ColorPickerSetColor(this.value);
								},
								onChange: function (hsb, hex, rgb) {
									jQuery('#bg_color_preview_<?php echo $reviewType; ?>').css('backgroundColor', '#' + hex);
									jQuery('#bg_color_<?php echo $reviewType; ?>').val(hex);
								}
							})
							.bind('keyup', function(){
								jQuery(this).ColorPickerSetColor(this.value);
							});
						});
						</script>
	
					<?php } //end for each 
				} //end if !empty settings ?>

            </div>
        </div>

        <p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

        </form>

    </div>

	<?php
}


function oswc_validate_reviews( $input ) {
	global $oswc_reviews, $oswcPostTypes;

	$settings = get_option( 'oswc_reviews', $oswc_reviews );

	//create arrays based on multiple string inputs
	$reviewTypes = explode(",",$settings['review_types']);
	foreach($reviewTypes as $reviewTypeName) { //do this for each review type
		$reviewTypeName = trim($reviewTypeName);
		$reviewType = trim(str_replace(" ","_",str_replace("/", "", str_replace("-","_",$reviewTypeName))));	
		//color ranges
		$input['rating_color_ranges_'.$reviewType] = array($input['rating_color_range_1_'.$reviewType],$input['rating_color_range_2_'.$reviewType],$input['rating_color_range_3_'.$reviewType],$input['rating_color_range_4_'.$reviewType]);
		//rating criteria
		$num = $input['rating_criteria_number_'.$reviewType];
		$input['rating_criteria_'.$reviewType] = array();
		for($i = 1; $i <= $num; $i++) {
			$criterionName = trim($input['rating_criteria_'.$i.'_'.$reviewType]); //array index starts at 0
			array_push($input['rating_criteria_'.$reviewType],new OSWCRatingCriteria($criterionName));
		}
		//meta fields
		$num = $input['meta_fields_number_'.$reviewType];
		$input['meta_fields_'.$reviewType] = array();
		for($i = 1; $i <= $num; $i++) {
			$metafieldName = trim($input['meta_field_'.$i.'_'.$reviewType]); //array index starts at 0
			//die("meta field".$metafieldName);
			array_push($input['meta_fields_'.$reviewType],new OSWCMetaField($metafieldName));
		}
		//taxonomies
		$num = $input['taxonomies_number_'.$reviewType];
		$input['taxonomies_'.$reviewType] = array();
		for($i = 1; $i <= $num; $i++) {
			$taxonomyName = trim($input['taxonomy_'.$i.'_'.$reviewType]); //array index starts at 0
			$taxonomySlug = trim($input['taxonomy_slug_'.$i.'_'.$reviewType]); //array index starts at 0
			if($taxonomySlug=='' || $taxonomySlug==strtolower($reviewType)."_") { //if it's blank or it's just the default value, it's not been really set/saved yet
				$taxonomySlug=strtolower($reviewType)."_".str_replace("/", "", str_replace(" ","_",$taxonomyName)); //normalize slug
			}
			//die("taxonomy".$taxonomyName);
			if($i==1) {
				array_push($input['taxonomies_'.$reviewType],new OSWCTaxonomy($reviewType, $taxonomyName, $taxonomySlug, true, true));
			} else {
				array_push($input['taxonomies_'.$reviewType],new OSWCTaxonomy($reviewType, $taxonomyName, $taxonomySlug));//was this accidentaly a meta field instead of a taxonomy? ROFL, YES!!!!
			}
		}
	}
	//echo("<br /><br />review-options.php<br /><br />************************<br /><br />".var_export($input));
	return $input;
}

endif;  // EndIf is_admin()
?>
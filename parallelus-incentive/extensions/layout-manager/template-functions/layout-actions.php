<?php

#-----------------------------------------------------------------
# Layout Actions (called in theme header.php and footer.php)
#-----------------------------------------------------------------
// Start layout 
//................................................................
if ( ! function_exists( 'output_layout_block' ) ) :
	function output_layout_block($section = 'start') {

		global $context;

		$section = ($section == 'start') ? 'start' : 'end';
		if ( $layout = has_layout() ) {
			generate_content_layout( $section, $layout, $context );
		} else {
			// NOTE: There's got to be a better way. This should be revisited.
			echo ($section == 'start') ? '<div class="row-fluid">' : '</div>';  // the default
		}
	}
	add_action( 'output_layout', 'output_layout_block');
endif;


// Has Layout? 
//................................................................
if ( ! function_exists( 'has_layout' ) ) :
function has_layout() {
	global $context, $layouts_manager;

	$layout = false;
	if ( isset($context) && is_object($layouts_manager) ) {
		$layout = apply_filters('context_fallbacks', $context);  // fallbacks for $context values
	}
	return ($layout) ? $layout : false;
}
endif;

// Get Context 
//................................................................
if ( ! function_exists( 'get_context' ) ) :
function get_context() {
	global $context;
	return ($context) ? $context : false;
}
endif;

// Get Layout Settings (just easier to remember than 'has_layout')
//................................................................
if ( ! function_exists( 'get_layout' ) ) :
function get_layout() {
	return has_layout(); 
}
endif;

// Get Header Info
//................................................................
if ( ! function_exists( 'get_layout_header' ) ) :
function get_layout_header() {
	global $context, $layouts_manager;
	// return $layouts_manager->get_header('custom-page-header');
	return ($context) ? context_cascade( $context, 'header') : false; 
}
endif;

// Get Footer Info
//................................................................
if ( ! function_exists( 'get_layout_footer' ) ) :
function get_layout_footer() {
	global $context;
	return ($context) ? context_cascade( $context, 'footer') : false; 
}
endif;

// Retrieve options data for a layout, header or footer 
// (intended for theme designers to access data in theme output)
//................................................................
if ( ! function_exists( 'get_layout_options' ) ) :
function get_layout_options($section = 'layout', $alias = false) {	
	global $context, $libraries;	

	$layoutOptions = array();
	$layoutData  = array();
	$layout = array();

	if ($alias) {
		// Get a specific layout options data
		$layout = get_layout_section($alias, $section);
	} else {
		// Get the current layout options data
		$layout = ($context) ? context_cascade( $context, $section) : false;
		// With custom headers/footer we already have the data at this point
		if (in_array($section, array('header','footer','other_options'))){
			return $layout;
			
		}
	}

	// Check that we have layout data
	if (!isset($layout['alias']) || empty($layout['alias'])) {
		return false;
	}

	return $layout;
}
endif;

// Generic funciton to look up header, footer or layout by alias
//................................................................
if ( ! function_exists( 'get_layout_section' ) ) :
function get_layout_section($alias = false, $section = 'layout') {
	global $layouts_manager;

	$value = false;
	if ($alias) {
		$value = get_layout_options_data($alias, $section);
	}
	return $value;
}
endif;

if ( ! function_exists( 'get_layout_options_data' ) ) :
function get_layout_options_data($layout_alias = null, $section = null, $qualification = null){
	if($layout_alias != null && $section != null){				
		global $layouts_manager;
		$value = array();
		$layout = $layouts_manager->get_layout($layout_alias);
		switch ($section) {
			case 'header':{
				if(isset($layout['header']) || $qualification !== null){					
					$header_alias = ($qualification == null) ? $layout['header'] : $qualification;
					$value = $layouts_manager->get_header($header_alias);
					$value = (isset($value['custom_options']['_framework']))? $value['custom_options']['_framework'] : $value;
					$value['alias'] = $header_alias;
				}
			} break;
			case 'footer':{
				if(isset($layout['footer']) || $qualification !== null){
					$footer_alias = ($qualification == null) ? $layout['footer'] : $qualification;
					$value = $layouts_manager->get_footer($footer_alias);
					$value = (isset($value['custom_options']['_framework']))? $value['custom_options']['_framework'] : $value;
					$value['alias'] = $footer_alias;
				}
			} break;
			case 'other_options':{
				$value['custom_options'] = $layouts_manager->get_layout_other_options($layout['alias']);
				$value = (isset($value['custom_options']['_framework']))? $value['custom_options']['_framework'] : $value;
			} break;
			default:{ // layout
				$value = $layout;
			} break;
		}
		return $value;
	}
}
endif;

// Context Cascade
//................................................................
/*
 * Alias/Context Fallbacks - defines a fallback cascade of alias
 * values so users can specify the layout at different levels to
 * override defaults and have more granular controls.
 */
if ( ! function_exists( 'context_cascade' ) ) :
	function context_cascade( $context = 'default', $section = 'layout' ) {
		global $layouts_manager;

		$queried_page_id = get_queried_object_id(); // $post->ID can change, this is what WP loaded first. (since WP v3.1)

		if (!$queried_page_id) {
			// this might be a search page or other special WP page. Need to check here 
			// (temporary fix for not recognizing search context)
			if (is_search()) {
				$context = 'search';
			}
		}


		// first, check for a user specified layout in the specific post/page (skip if this is the search)
		if ($context != 'search') {

			$section_alias = null; 
			$field = ($section == 'other_options') ? 'layout' : $section;
			$alias = get_post_meta($queried_page_id, $field, true);

			if ($alias) {
				switch ($section) {	
					case 'header':
						$section_alias = $alias;						
						break;

					case 'footer':
						$section_alias = $alias;
						break;

				}
				
				$value = get_layout_options_data($alias, $section, $section_alias);

				// check if we have an array...
				if ( is_array($value) ) return $value;
			}
		}
		
		// next, try the specified $context in layout manager (defaults for: page, post, blog, home, etc.)
		$alias = $layouts_manager->get_alias($context);
		if (isset($alias)) {
			// We only know the layout ID so we need to determine the header/footer/layout data to get

			$value = get_layout_section($alias, $section);					
				
			// check if we have an array...
			if ( is_array($value) ) return $value;
		}		
		
		// Done checking context settings. Now check fallbacks.
		//................................................................

		// Things that fallback to the "blog"
		$fallbacks = array('category', 'author', 'tag', 'date');
		if (in_array($context, $fallbacks) || preg_match('/^category\-/', $context)) {
			// Get the fallback layout
			$alias = $layouts_manager->get_alias('blog');
			if (isset($alias)) {
				// We only know the layout alias so we need to determine the header/footer/layout data to get
				$value = get_layout_section($alias, $section);
				// check if we have an array...
				if ( is_array($value) ) return $value;
			}
		}

		// Next, use the post type as a default layout based on post type
		switch (get_post_type()) {
			case "page":
			case "post":
				$contentType = get_post_type();
				break;
			default:
				// if no other option fits...
				$contentType = 'default';
		} 
		// other cases for $contentType
		if (is_home() || is_front_page()) $contentType = 'home';

		// Look up the alias for the post/content type
		$alias = $layouts_manager->get_alias($contentType);
		if (isset($alias)) {
			// We only know the layout alias so we need to determine the header/footer/layout data to get
			$value = get_layout_section($alias, $section);
			// check if we have an array...
			if ( is_array($value) ) return $value;
		}

		// As a last resort, get to the default layout
		$alias = $layouts_manager->get_alias('default');
		if (isset($alias)) {
			// We only know the layout alias so we need to determine the header/footer/layout data to get
			$value = get_layout_section($alias, $section);
			// check if we have an array...
			if ( is_array($value) ) return $value;
		}

		// We found nothing so return the first layout in the database
		// This should never happen so we're grasping at straws.
		$value = get_layout_section($alias, $section);

		if ( is_array($value) && count($value) > 0 ) {
			return $value[0];  // send the first one found
		} else {
			return false;
		}

		return false;
	}

	add_filter( 'context_fallbacks', 'context_cascade' );

endif;


#-----------------------------------------------------------------
# Generate Layouts
#-----------------------------------------------------------------

// Generate layout content containers
//................................................................
if ( ! function_exists( 'generate_content_layout' ) ) :
	function generate_content_layout($position = 'start', $layout = false, $context = false) {
		global $layouts_manager, $has_layout;
		// Make sure some layout information was found
		//................................................................
		// get_layout_options('layout', 'layout-1374843373');

		// Final check before we start outputting the layout
		if (!isset($layout) || empty($layout)) {
			// No layout information was found
			return false;
		} else {

			$alias = $layout['alias'];

			// Begin displaying the layout
			//................................................................
		
			// This variable is used to determine the start/stop position between 
			// the header and footer display of the layout
			$contentBreak = false;

			if (is_array($layout['body_structure'])) {

				// Do we print the information yet?
				$output = false;
				if ($position == 'start' && !$contentBreak) {
					$output = true;  // the header/start of the layout BEFORE the content break is reached
				} elseif ($position == 'end' && $contentBreak) {
					$output = true;  // the footer/end of the layout AFTER the content break is reached
				}

				// loop through the rows
				if(IS_CHILD && isset($layouts_manager->layouts_manager_options['settings'])) {
					$grid_type = (false === strstr($layouts_manager->layouts_manager_options['settings']['column-class-format'], '%') )? 'fixed' : 'fluid'; // for unsemantic
					if($grid_type == 'fluid')
						$column_fluid_width = 100/$layouts_manager->layouts_manager_options['settings']['columns'];
				}
				else
					$grid_type = 'fixed';

				$rows = $layout['body_structure'];

				$row_count = 1;
				$row_id = 'id="'.$alias.'_row_'.$row_count.'"';
				$layout_name = 'layout_' . sanitize_title($layouts_manager->layouts_manager_options['layouts'][$alias]['title']);
				$row_class = (IS_CHILD  && isset($layouts_manager->layouts_manager_options['settings']))? $layouts_manager->layouts_manager_options['settings']['row-class'] : 'row-fluid';

				//if ($output) echo '<div '. $row_id .' class="page-width">' . PHP_EOL; // with line break
				if ($output) echo '<div id="'. $layout_name .'" class="grid-wrapper">' . 
								  // '<section class="grid-section">' . 
								  PHP_EOL; // with line break
				
				foreach ((array) $rows as $columns) {

					//if ($output) echo '<div '. $row_id .' class="row">' . PHP_EOL; // with line break
					if ($output) echo '<section class="grid-section-'.$row_count.'">' .
					                  '<div class="grid-row ' . $row_class . '">' . PHP_EOL; // with line break

					// loop through the columns in each container
					$column_count = 1;
					$grid_used    = 0; // this tracks the previous column widths
					foreach ((array) $columns as $column) {

						// Set the visible combo tags for responsive layouts
						$visible = '';
						$visible_on = '';
						if (isset($column['visible_on'])) {
							// Select the correct class
							switch ($visible_on) {
								case 'P': // Phone only
									$visible = ' visible-phone';
									break;
								case 'T': // Tablet only
									$visible = ' visible-tablet';
									break;
								case 'D': // Desktop only
									$visible = ' visible-desktop';
									break;
								case 'TD': // Tablet and Desktop
									$visible = ' hidden-phone';
									break;
								case 'PD': // Phone and Desktop
									$visible = ' hidden-tablet';
									break;
								case 'PT': // Phone and Tablet
									$visible = ' hidden-desktop';
									break;
								
								default:
									// Nothing to set.
									// If nothing is selected as visible... assume the user screwed up?
									break;
							}							
							foreach ( (array) $column['visible_on'] as $device ) {
								if ( $device == 'phone' )
									$visible_on .= "P"; // P for Phone
								if ( $device == 'tablet' )
									$visible_on .= "T"; // T for Tablet
								if ( $device == 'desktop' )
									$visible_on .= "D"; // D for Desktop
							}
						}

						// The position set in the layout
						$gridPosition = ( isset($column['grid_position']) ) ? $column['grid_position'] : $layouts_manager->layouts_manager_options['settings']['columns'];						
						$gridPosition = ($grid_type == 'fixed')? $gridPosition : $gridPosition * $column_fluid_width;
						
						// Set the style and class variables 
						$size = ($grid_type == 'fixed')? $gridPosition - $grid_used : intval($gridPosition - $grid_used);
						//$col_class = 'span'.$size.' column-'.$column_count.' '.$visible;
						
						if(IS_CHILD  && isset($layouts_manager->layouts_manager_options['settings']))
							$column_class_format = ($grid_type == 'fixed')? str_replace('#', '', $layouts_manager->layouts_manager_options['settings']['column-class-format']) . $size :
																			str_replace('%', '', $layouts_manager->layouts_manager_options['settings']['column-class-format']) . $size;
						else
							$column_class_format = 'span' . $size;

						// Output the container
						//if ($output) echo '<div class="'.$col_class.'">' . PHP_EOL; // with line break
						if ($output) echo '<div class="grid-column-' . $column_count . ' '.$column_class_format.'">' . PHP_EOL; // with line break

						// loop through the content elements in each column
						$element_count = 1;
						foreach ((array) $column['content_elements'] as $content) {

							$block_class = 'content-element-'.$element_count;
							if ($output) {
								echo '<div class="'.$block_class.'">' . PHP_EOL; // with line break
								echo get_layout_content_block( $content['content_type'], $content['content_source'] );
							}

							// Record when 'default_content' is reached for the first time
							if (!$contentBreak && $content['content_type'] == 'default_content') {
								// This is the first "default_content" (there should only be one, but people can get confused...)
								$contentBreak = true; // record that we reached the break

								if ($position == 'start') {
									$output = false; // don't output anymore in the 'start' section 
									break 3;         // break out of layout loop entirely, no more to do in 'start'
								} elseif ($position == 'end') {
									// This is where we start outputting the 'end' section
									$output = true; 
								}
							}

							if ($output) echo '</div> <!-- / .'. $block_class .' -->' . PHP_EOL; // with line break

							$element_count++;
						} // END foreach $column['content_elements']

						//if ($output) echo '</div> <!-- / .'. $col_class .' -->' . PHP_EOL; // with line break
						if ($output) echo '</div> <!-- / .'. $column_class_format .' -->' . PHP_EOL; // with line break

						$grid_used += $size; // Update the used portion of the row.
						$column_count++;
					} // END foreach $columns

					//if ($output) echo '</div> <!-- / #'. $row_id .' -->' . PHP_EOL; // with line break						
					if ($output) echo '</div> <!-- / #'. $row_class .' -->' . PHP_EOL; // with line break						
					if ($output) echo '</section> <!-- section - '.$row_count.' -->' . PHP_EOL; // with line break

					$row_count++;
				} // END foreach $rows

				//if ($output) echo '</div> <!-- page-width -->' . PHP_EOL; // with line break	
				// if ($output) echo '</section> <!-- section -->' . PHP_EOL; // with line break	
				if ($output) echo '</div> <!-- grid-wrapper -->' . PHP_EOL; // with line break	

			}

		}
		
	}
endif;


// Get the content for this section of the layout 
//................................................................
if ( ! function_exists( 'get_layout_content_block' ) ) :
	function get_layout_content_block( $type = false, $source = false) {

		if (!$type || $type == 'default_content') {		
			return '';
		
		} else {

			// no problems so far, start outputting the content
			switch ($type) {
				case "sidebar":
					echo '<div class="widget-area">';
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($source)) : endif;
					echo '</div> <!-- / .widget-area -->';
					break;
				case "static_block":
					if (class_exists('StaticBlockContent')) {
						$id = $source;
						$args["id"] = (!is_numeric($id)) ? get_ID_by_slug($id, 'static_block') : $id;
						$args["id"] = $id;
						return StaticBlockContent::get_static_content($args);
					}
					break;
				case "page":
					$id = $source;
					$id = (!is_numeric($id)) ? get_ID_by_slug($id, 'page') : $id;
					return get_content_for_layout($id);
					break;
				case "post":
					$id = $source;
					$id = (!is_numeric($id)) ? get_ID_by_slug($id, 'post') : $id; // not sure this works with posts
					return get_content_for_layout($id);
					break;
				default:
					// if no other option fits...
					return '<!-- [Unknown Type: '. $type .', Source: '. $source .'] -->';
			}
		}

	}

endif;


// Get content for a specific page/post
//................................................................
if ( ! function_exists( 'get_content_for_layout' ) ) :

	function get_content_for_layout($id, $title = false) {
		global $bbpress;

		if (!$id) return false;

		// Get the page contenet
		$page_data = get_post( $id );
		$content = $page_data->post_content; // get the content
		if($page_data->post_type == 'forum') {
			$forum_id = $id;
			$content =  empty($bbpress['context'])? "[bbp-single-forum id=$forum_id]" : $bbpress['context'];
		}

		// Apply only default filters. This is the safe way, not 
		// risking plugin injection/overrides of 'the_content'
		$content = wptexturize($content);
		$content = convert_smilies($content);
		$content = convert_chars($content);
		if (!wpautop_disable($id)) {
			$content = wpautop($content); // Add paragraph tags.
		}
		$content = shortcode_unautop($content);
		$content = prepend_attachment($content);
		$content = do_shortcode($content);

		// Get title, add to output<br />
		if ($title) $content =  '<h3 class="layout-block-title page-title">'. $page_data->post_title .'</h3>' . $content; 
		
		// Apply function specific
		$content = apply_filters('get_content_for_layout', $content, $id);

		return  $content;
	}
endif;


// Get content ID by slug 
//................................................................
if ( ! function_exists( 'get_ID_by_slug' ) ) :
	function get_ID_by_slug($slug, $post_type = 'page') {

		// Find the page object (works for any post type)
		$page = get_page_by_path( $slug, 'OBJECT', $post_type );
		if ($page) {
			return $page->ID;
		} else {
			return null;
		}
	}
endif;

if ( ! function_exists( 'context_fallbacks_func' ) ) :
	function context_fallbacks_func($layout) {
		global $context, $layouts_manager;

		$context = ( is_category() && empty( $layouts_manager->layouts_manager_options['contexts'][$context] ) )? 'category' : $context;
		switch ($context) {
			case "bbpress":
				return $layouts_manager->layouts_manager_options['layouts'][ $layouts_manager->layouts_manager_options['contexts']['forum'] ];
				break;
			default:
				return $layout;
				break;
		}
	}
	add_filter( 'context_fallbacks', 'context_fallbacks_func');
endif;
?>
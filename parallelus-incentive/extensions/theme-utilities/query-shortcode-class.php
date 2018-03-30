<?php
/**
 * 
 * A class to create WP queries from shortcode data
 * 
 */

class Runway_ShortcodeQueryBuilder {

	public $args           = array();
	public $json_args      = array();
	public $string_args    = array();
	public $attribute_args = array();
	public $wp_query_args  = array();


	/**
	 * Setup the query
	 */
	public function getQueryParams( $params=array() ) {

		if (isset($params) && is_array($params)) {
			$this->args = $params;
		}

		$this->parseShortcode();

		return $this->wp_query_args;
	}

	/**
	 * Output the content rotator code.
	 */
	public function parseShortcode() {
		global $paged, $post;

		// Make sure we have shortcode arguments
		if(!isset($this->args) || empty($this->args) || $this->args == null) {
			return;
		}

		// Fix hyphenated shortcode values
		$this->fixHyphenParams();

		// Extract json params
		$this->jsonParams();

		// Setup taxonomy query array
		$this->makeTaxQueryArray();

		// Extract string params
		$this->stringParams();

		// Get attribute params (comma lists to arrays)
		$this->attributeParams();

		// merge all query params
		$this->wp_query_args = array_merge_recursive($this->wp_query_args, $this->json_args);
		$this->wp_query_args = array_merge_recursive($this->wp_query_args, $this->string_args);
		$this->wp_query_args = array_merge_recursive($this->wp_query_args, $this->attribute_args);

		// exclude current post from query to prevent recursion
		$this->wp_query_args = array_merge_recursive($this->wp_query_args, array('post__not_in' => array($post->ID)));

		// Add the current page value
		$this->wp_query_args['paged'] = $paged;

		return $this->wp_query_args;
	}

	/**
	 * Fix parameters that are hyphenated
	 */
	public function fixHyphenParams() {

		$hyphen_args = $this->args;

		foreach($hyphen_args as $key => $value) {
			if (isset($key) && isset($value) && is_numeric($key) && strpos($value, '=')) {
			
				$new_arg = explode("=", $value);
			
				if (is_array($new_arg)) {
					
					// Check for value in quotes
					preg_match('/\"([^\"]*?)\"/', $new_arg[1], $matches);
					
					if (isset($matches[1])) {
						// in quotes
						$this->args[$new_arg[0]] = $matches[1];	    			
					} else {
						// not in quotes
						$this->args[$new_arg[0]] = $new_arg[1];	    				    				
					}
				}
			}
		}

	}

	/**
	 * Extract JSON params
	 */
	public function jsonParams() {

		// extract json params
		if (isset($this->args['json'])) {
			$this->args['json'] = str_replace('(', "[", $this->args['json']);
			$this->args['json'] = str_replace(')', "]", $this->args['json']);
			$this->json_args = json_decode($this->args['json'], true);
			unset($this->args['json']);
		}
	}

	/**
	 * Make taxonomy query array
	 * 
	 * Simple method to conver shortcode params 'taxonomy_slug' and 'taxonomy_terms' into the 
	 * array format required for taxonomy queries
	 */
	public function makeTaxQueryArray() {

		if ( isset($this->args['taxonomy_slug']) && !empty($this->args['taxonomy_slug']) && isset($this->args['taxonomy_terms']) && !empty($this->args['taxonomy_terms']) ) {
			
			$terms = explode(",", $this->args['taxonomy_terms']);

			if (!is_array($terms) && empty($terms)) {
				$terms = array($this->args['taxonomy_terms']);
			}
			
			$this->args['tax_query'][] = array(
				'taxonomy' => $this->args['taxonomy_slug'],
				'field' => 'slug',
				'terms' => $terms
			);

			unset($this->args['taxonomy_slug']);
			unset($this->args['taxonomy_terms']);
		}
	}

	/**
	 * Extract string parameters
	 */
	public function stringParams() {

		if (isset($this->args['string'])) {
			$temp = str_replace('&amp;', '&', $this->args['string']);
			$temp = explode("&", $temp);
			
			foreach($temp as $arg) {
				
				$exp_ar = explode("=", $arg);
				
				// string params cannot override array params
				if (isset($exp_ar[1])) {
					$_temp = explode(",", $exp_ar[1]);
				}
				
				if(count($_temp) > 1) {
					$this->string_args[$exp_ar[0]] = $_temp;
				} else {
					$this->string_args[$exp_ar[0]] = (isset($exp_ar[1])) ? trim($exp_ar[1]) : '';
				}
			}
			unset($this->args['string']);
		}
	}

	/**
	 * Convert attribute parameters from strings to arrays
	 *
	 * Make this:
	 *     tags="one,two,three"
	 *
	 * Into this:
	 *     tags = array("one","two","three");
	 * 
	 * This simpley finds comma separated lists and makes them arrays. This allows
	 * query params requiring arrays to work.
	 */
	public function attributeParams() {

		// Parameters that use comma separated strings, not array
		$exceptions = array('category_name'); 

		foreach($this->args as $key => $val) {
			if (!is_array($val) && !in_array($key, $exceptions)) {
				$temp = explode(",", $val);
			}

			if(count($temp) > 1) {
				$this->attribute_args[$key] = $temp;
			} else {
				$this->attribute_args[$key] = $val;
			}
		}
	}

}


#-----------------------------------------------------------------
# [query] Shortcode - Runs a WP Query, and some helpers
#-----------------------------------------------------------------

if ( ! function_exists( 'custom_wp_query' ) ) :
	function custom_wp_query($args = null, $content = null) {
		global $custom_query, $paged;


		// Initiate shortcode query builder class
		$shortcodeQuery = new Runway_ShortcodeQueryBuilder();
		$wp_query_args = $shortcodeQuery->getQueryParams( $args );

		if (!$wp_query_args) {
			return;
		}

	    // Force a default template
	    if(!isset($wp_query_args['template'])) {
			
			$wp_query_args['template'] = "blog";	 

		    /**
		     * TODO: This would be a great place to use WP template functions to test for the
		     * existance of a template file before setting a default or using the one specified.
		     */
	    }

		// workaround for shortcode paging not working on static home page
		$paged = ($paged) ? $paged : get_query_var('page');
		if ($paged < 1) {
		  $paged = 1;
		}
		$wp_query_args['paged'] = $paged;
		// end of paging workaround
		 
		// make new query based on shortcode
		$custom_query = new WP_Query($wp_query_args);

	    // make html
	    ob_start();
	    get_template_part('templates/'. $wp_query_args['template']);
	    $html = ob_get_clean();

	    unset($custom_query);
	    unset($wp_query_args);

		wp_reset_postdata();

	    return $html;
	}

	add_shortcode('query', 'custom_wp_query');
endif;

?>
<?php
global $oswcPostTypes;

/**
 * Class: OSWCPostType
 *
 * Description: This is the custom post type that OSWC uses for its Custom Reviews.
 *
 * Params <denotes required> [denotes optional]:
 *	<$options					- A HashMap style array with key value pairs corresponding with ANY of the public properties of this object, including, but not limited to, the following:
 *		[taxonomies]			- A List style array of OSWCTaxonomy objects for this review
 *		[metafields]			- A List style array of OSWCMetaField objects for this review
 *		[criteria]				- A List style array of OSWCReviewCriteria objects for this review
 *		[enabled]				- boolean. If false, review type not enabled.
 *		[chile_theme_post_type]	- boolean. Only set to true if this post type was created in a child theme. This helps OSWCPostType know where to look for certain image resources
 *	>
 */
class OSWCPostType{
	public $id = null; //full id, like "oswc_music_reviews" (system setting)											
	public $name = null; //something like "casino" or "music"															
	public $safe_name = null; //slug: replaces underscores with spaces (system setting)	
	public $url_name = null; //for use in the rewrite for use in the URL permalink (system setting)								
	public $enabled = true; //this review type is enabled																
	public $post_type_vars = null; //the variables (system setting)														
	public $taxonomies = array(); //array of custom taxonomies
	public $positive = 'Positives';	//label for the positives text														
	public $negative = 'Negatives'; //label for the negatives text														
	public $bottom_line = 'Our Review'; //label for the bottom line text												
	public $positive_negative_icons = null; //hand or check																
	public $meta_fields = array(); //array of custom meta fields
	public $child_theme_post_type = false;//post type is added by a child theme (system setting)						
	public $more_link = null; //permalink for the more link (system setting)											
	public $tax_above_meta = true; //display taxonomies above meta fields in summary box
	public $skin = 'light'; //skin can be light or dark								
	public $color = '666666'; //main review color (menus and review icon bgs)	
	public $logo_bar_image = null; //the background image that displays in the logo bar		
	public $hide_logo_bar_bg = false; //hide the background of the logo bar							
	public $link_color = null; //color for hyperlinks																	
	public $logo = null; //this section has a different logo
	public $logo_iphone = null; //this section has a different logo	
	public $logo_ipad = null; //this section has a different logo																
	public $header_ad_show = null; //show the header ad on this section													
	public $header_ad = null; //this section has a different header ad													
	public $icon = null; //review type icon to display on front-facing site	
	public $icon_light = null; //review type icon to display on front-facing site for dark-colored backgrounds											
	public $icon_admin = null; //review type icon to display on admin panels											
	public $bg_color = null; //background color for this review type													
	public $bg_image = null; //background image for this review type													
	public $bg_attach = "scroll"; //fix or scroll																		
	public $rating_type = 'stars'; //stars, percentage, number, or letter												
	public $rating_color = 'yellow'; //color of the stars (only applies to stars)										
	public $rating_color_range_enabled = true; //change rating colors based on ranges (does not apply to stars)			
	public $rating_color_ranges = array(20,40,60,80); //range increments where the colors should change	
	public $user_ratings_enabled = true; //enable user ratings for this review type				
	public $layout = 'A'; //layout to use for review type homepage														
	public $featured_enabled = true; //show the featured slider for this review type
	public $featured_size = true; //the size of the featured image slider	
	public $front_sidebar_enabled = true; //show the sidebar on the front page
	public $dontmiss_enabled = true; //show don't miss scroller on the front page							
	public $latest_enabled = true; //show the latest scroller for this review type					
	public $latest_specific = true; //should the latest scroller only show posts from this review type																	
	public $meta_enabled = true; //show date and comments on review listing pages
	public $excerpt_enabled = true; //show excerpt on review listing pages												
	public $trending_enabled = true; //show trending at the bottom of review listing pages					
	public $tax_layout = 'A'; //layout to use for taxonomy pages
	public $tax_dontmiss_enabled = true; //show don't miss scroller on taxonomy pages																
	public $tax_latest_enabled = true; //show latest scroller on taxonomy pages											
	public $tax_meta_enabled = true; //show date and comments on taxonomy pages											
	public $tax_sidebar_enabled = true; //show sidebar on taxonomy pages												
	public $tax_excerpt_enabled = true; //show excerpt on taxonomy pages												
	public $tax_trending_enabled = true; //show trending at the bottom of taxonomy pages					
	public $sidebar_enabled = true; //show the sidebar on single review pages	
	public $single_dontmiss_enabled = false; //show dont miss slider on single review pages											
	public $single_latest_enabled = false; //show latest slider on single review pages									
	public $summary_header_text = 'Summary'; //header text for the summary box		
	public $full_article_text = 'Full Article'; //header text for the full article bar									
	public $rating_criteria = array(); //array of rating criteria
	public $related_number = 6; //number of posts to show in the related box	
	public $hide_review_verbiage = false; //hide the "Review" and "Reviews" verbiage from being appended to labels/headers										

	function __construct($options){
		foreach($options as $opt_id => $option){
			$this->$opt_id = $option;
		}

		if(!empty($taxonomies)){
			$this->taxonomies = $taxonomies;
		}

		if(!empty($metafields)){
			$this->meta_fields = $metafields;
		}

		if(!empty($criteria)){
			$this->rating_criteria = $criteria;
		}

		$clean_name = strtolower(str_replace(" ","_",strtolower(str_replace("/", "", str_replace("-", "_", $this->name)))));
		$this->id = 'os_'.$clean_name;

		$this->id = substr($this->id, 0, 20);

		$this->safe_name = str_replace(" ","_",str_replace("/", "", str_replace("-","_",$this->name)));
		
		$this->url_name = strtolower(str_replace(" ","-",str_replace("/", "-", str_replace("&", "-", str_replace("'", "", $this->name)))));

		if(!isset($this->post_type_vars)){
			$this->post_type_vars = array(
				'labels' => array(
					'name' => ucwords($this->name) . __( ' Articles' , 'made'),
					'singular_name' => ucwords($this->name) . __( ' Article' , 'made'),
					'add_new' => __('Add new article', 'made'),
					'edit_item' => __('Edit article', 'made'),
					'new_item' => __('New article', 'made'),
					'view_item' => __('View article', 'made'),
					'search_items' => __('Search articles', 'made'),
					'not_found' => __('No articles found', 'made'),
					'not_found_in_trash' => __('No articles found in Trash', 'made')
				),
				'public' => true,
				'menu_position' => 27,
				'menu_icon' => $this->icon_admin,
				//'rewrite' => array('slug' => $this->safe_name . '-detail'),
				'rewrite' => array('slug' => $this->url_name),
				'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions'),
				'taxonomies' => array('category', 'post_tag'),
				'show_in_nav_menus' => true
			);
		}

		$this->create_more_link();
	}

	public function create_more_link(){
		$moreLink = null;
		$args = array('post_type' => 'page',
			'posts_per_page' => 1,
			'meta_query' => array(
				array(
					'key' => 'Review Type',
					'value' => $this->name,
					'compare' => 'LIKE'
				)
			)
		 );
		 $postcount=0;
		$moreLinkLoop = new WP_Query( $args );
        if ($moreLinkLoop->have_posts()) : while ($moreLinkLoop->have_posts()) : $moreLinkLoop->the_post(); $postcount++;
            $moreLink = get_permalink();
        	endwhile;
        endif;

        $this->more_link = $moreLink;

	}

	public function create_review(){
		if($this->enabled){
			add_action( 'init', array($this, 'register_review') );
		}
	}

	public function register_review(){
		register_post_type( $this->id, $this->post_type_vars);

		foreach($this->taxonomies as $taxonomy){
			$labels = array(
				'name' => _x( ucwords($taxonomy->name), 'taxonomy general name' ),
				'singular_name' => _x( ucwords($taxonomy->name), 'taxonomy singular name' ),
				'search_items' =>  __( 'Search '.ucwords($taxonomy->name) ),
				'all_items' => __( 'All '.ucwords($taxonomy->name) ),
				'parent_item' => __( 'Parent '.ucwords($taxonomy->name) ),
				'parent_item_colon' => __( 'Parent '.ucwords($taxonomy->name).':' ),
				'edit_item' => __( 'Edit '.ucwords($taxonomy->name) ), 
				'update_item' => __( 'Update '.ucwords($taxonomy->name) ),
				'add_new_item' => __( 'Add New '.ucwords($taxonomy->name) ),
				'new_item_name' => __( 'New '.ucwords($taxonomy->name).' Name' ),
				'menu_name' => __( ucwords($taxonomy->name) ),
			);
			register_taxonomy(
				$taxonomy->id,
				array($this->id),
				array(
					'hierarchical' => true,
					'labels' => $labels,
					'query_var' => true,
					'rewrite' => array('slug' => $taxonomy->url_name),
					'capabilities' => array(
									'manage_terms' => 'edit_posts',
									'edit_terms' => 'edit_posts',
									'delete_terms' => 'edit_posts',
									'assign_terms' => 'edit_posts'
								)
				)
			);
		}
	}

	public function get_taxonomy_by_id($taxId){
		foreach($this->taxonomies as $tax){
			if($tax->id == $taxId){
				return $tax;
			}
		}
	}

	public function get_taxonomy_by_name($taxName){
		foreach($this->taxonomies as $tax){
			if($tax->name == $taxName){
				return $tax;
			}
		}
	}

	public function get_primary_taxonomy(){
		foreach($this->taxonomies as $tax){
			if($tax->isPrimary){
				return $tax;
			}
		}
	}

	public function get_excerpt_taxonomies(){
		$excerptTaxes = array();

		foreach($this->taxonomies as $tax){
			if($tax->includeInExcerpt){
				array_push($excerptTaxes, $tax);
			}
		}

		return $excerptTaxes;
	}

	public function get_excerpt_meta_fields(){
		$excerptFields = array();

		foreach($this->meta_fields as $mf){

			//make backwards compatible
			if(is_object($mf)){
				if($mf->includeInExcerpt){
					array_push($excerptFields, $mf);
				}
			}else{
				array_push($excerptFields, $mf);
			}

		}

		return $excerptFields;
	}
}

/**
 * Class: OSWCTaxonomy
 *
 * new SwagTaxonomy(string name [, boolean isPrimary, boolean includeInExcerpt, string id, string slug]);
 *
 * name = the user visible name, example: Type
 * isPrimary = [optional] whether the taxonomy is the "primary" taxonomy. defaults to false
 * includeInExcerpt = [optional] whether it should show up in the excerpt box, defaults to true
 * id = [optional] the unique id for this taxonomy, example: casino_type, defaults to 'casino_' . strtolower($name)
 * slug = [optional] the slug, example: casino-type, defaults to 'casino-' . strtolower($name)
 */
class OSWCTaxonomy{
	public $isPrimary = false;
	public $includeInExcerpt = true;
	public $id = null;
	public $name = null;
	public $safe_name = null;			
	public $slug = null;
	public $url_name = null;

	function __construct($postTypeName, $name, $id, $isPrimary = NULL, $includeInExcerpt = NULL, $slug = NULL, $url_name = NULL){
		$this->name = $name;
		$this->safe_name = str_replace("/", "", str_replace(" ","_",$name));

		if(!isset($id)){
			$this->id = strtolower($postTypeName) . '_' . strtolower($name);
		}else{
			$this->id = $id;
		}
		$this->id = str_replace("/", "", str_replace(" ","_",$this->id));//normalize id

		if(!isset($slug)){
			$this->slug = strtolower($postTypeName) . '_' .strtolower($name);
		}else{
			$this->slug = $slug;
		}
		
		if(!isset($url_name)){
			//$this->url_name = strtolower($postTypeName) . '-' . strtolower(str_replace("/", "-", str_replace(" ","-",str_replace("&","-",str_replace("'","",$name)))));
			$this->url_name = strtolower($postTypeName) . '-' . strtolower(str_replace("/", "-", str_replace(" ","-",str_replace("&","-",str_replace("'","",$this->id))))); //new in 2.6
			//if you don't want the post type name appended to the beginning of the taxonomy name in the permalink
			//and only want the name of the taxonomy, comment out the line above and use the line below instead
			//please note you cannot have taxonomies with the same name in multiple review types if you do this
			//also note that if you change this you will need to refresh your permalinks (go to Settings >> Permalinks and click Save)
			//$this->url_name = strtolower(str_replace("/", "-", str_replace(" ","-",str_replace("&","-",str_replace("'","",$this->id)))));
		}else{
			$this->url_name = $url_name;
		}
	
		if(isset($isPrimary)){
			$this->isPrimary = $isPrimary;
		}

		if(isset($includeInExcerpt)){
			$this->includeInExcerpt = $includeInExcerpt;
		}
	}
}

/**
 * Class: OSWCMetaField
 *
 * new OSWCMetaField(string name [boolean includeInExcerpt = false]);
 *
 * name = the user visible name, example: Type
 * includeInExcerpt = [optional] whether it should show up in the excerpt box, defaults to false
 */
class OSWCMetaField{
	public $includeInExcerpt = true;
	public $name = null;

	function __construct($name, $includeInExcerpt = NULL){
		$this->name = $name;

		if(isset($includeInExcerpt)){
			$this->includeInExcerpt = $includeInExcerpt;
		}else{
			$this->includeInExcerpt = false;
		}
	}
}


/**
 * Class: OSWCRatingCriteria
 *
 * new OSWCRatingCriteria(string name);
 *
 * name = the name of the custom meta field used for the criteria, example: Usability
 */
class OSWCRatingCriteria {
	public $name = null;

	function __construct($name){
		$this->name = $name;
	}
}

//singleton, instantiation to immediately follow. You should NEVER say new oswcPostType() anywhere else!
class oswcPostTypes {
	public $postTypes;

	function __construct(){
		//if you create a new PostType Object, add it to this array
		$possiblePostTypes = array();

		if(function_exists('add_post_types')){
			$possiblePostTypes = add_post_types($possiblePostTypes);
		}

		$this->postTypes = array();
		foreach($possiblePostTypes as $postType){
			//echo "<!-- post type: $postType->name -->";
			$this->postTypes[$postType->id] = $postType;/*replaced name*/
		}

		if(function_exists('add_post_types')){
			//echo "child theme detected";
			//$possiblePostTypes = add_post_types($possiblePostTypes);
		}else{
			//echo "no child theme detected";
		}

		$this->register_sidebars();
	}

	function register_sidebars(){
		if (function_exists('register_sidebar')) {
			foreach($this->postTypes as $postType){
				if($postType->enabled) {
					//standard sidebars
					register_sidebar(array(
						'name' => ucwords($postType->name) . ' Sidebar',
						'id'   => strtolower($postType->safe_name) . '-sidebar',
						'description'   => __( 'These widgets appear in the right sidebar of the ' . $postType->name . ' reviews pages.', 'made' ),
						'before_widget' => '<div class="widget-wrapper"><div class="widget">',
						'after_widget'  => '</div></div>',
						'before_title'  => '<div class="section-wrapper"><div class="section">',
						'after_title'   => '</div></div>'
					));
					//featured sidebars
					register_sidebar(array(
						'name' => ucwords($postType->name) . ' Featured Sidebar',
						'id'   => strtolower($postType->safe_name) . '-featured-sidebar',
						'description'   => __( 'These widgets appear to the right of the featured slider on the ' . $postType->name . ' review listing page.', 'made' ),
						'before_widget' => '<div class="widget-wrapper"><div class="widget">',
						'after_widget'  => '</div></div>',
						'before_title'  => '<div class="section-wrapper"><div class="section">',
						'after_title'   => '</div></div>'
					));
				}
			}
		}
	}

	/**
	 * Method: has_type
	 *
	 * A utility function to determine if made has a post type named "n",
	 * or, if has post type with id of "n"
	 *
	 * Example:
	 *	if($oswcPostTypes->has_type("movie")){
	 *		echo "<h1>YEAH</h1>";
	 *	}else{
	 *		echo "<h1>nope</h1>";
	 *	}
	 *
	 * Can also be used like (to signify passed value is an id):
	 *	if($oswcPostTypes->has_type("oswc_movie", true)){
	 *		echo "<h1>YEAH</h1>";
	 *	} else {
	 *		echo "<h1>nope</h1>";
	 *	}
	 */
	function has_type($type, $byId = NULL){
		if(!isset($byId)){
			$byId = false;
		}

		//echo "<!-- looking for $type by id? $byId -->";

		if($byId && !empty($this->postTypes[$type])){
			//echo "<!-- has $type type -->";
			return true;
		}else if(!$byId){
			//echo "<!-- looking for $type by name. -->";
			foreach($this->postTypes as $postType){
				if($type == $postType->name){
					//echo "<!-- has $type type -->";
					return true;
				}
			}
		}

		//echo "<!-- DOES NOT HAVE $type type -->";
		//echo "<!--";
		//print_r($this->postTypes);
		//echo "-->";

		return false;
	}

	/**
	 * Method: get_type_by_name
	 *
	 * A utility function that returns the post type with a given name
	 *
	 * Example:
	 *	$postType = oswcPostTypes->get_type_by_name("products");
	 */
	function get_type_by_name($type){
		foreach($this->postTypes as $postType){
			if($postType->name == $type){
				return $postType;
			}
		}
	}

	/**
	 * Method: get_type_by_id
	 *
	 * A utility function that returns the post type with a given id
	 *
	 * Example:
	 *	$postType = oswcPostTypes->get_type_by_id("oswc_product_reviews");
	 */
	function get_type_by_id($type){
		return $this->postTypes[$type];
	}

	public function the_taxonomies($postType, $getExcerptOnly = NULL){
		global $post;

		if(!empty($getExcerptOnly) && $getExcerptOnly){
			$taxonomies = $postType->get_excerpt_taxonomies();
		}else{
			$taxonomies = $postType->taxonomies;
		}


		foreach($taxonomies as $taxonomy){
			echo get_the_term_list( $post->ID, $taxonomy->id, '<span class="taxName">' . __(ucwords($taxonomy->name),'made') . '</span>: <span class="taxContent">', ', ', '</span><div class="separator">&nbsp;</div>' );
		}
	}

	public function the_meta_fields($postType, $getExcerptOnly = NULL){
		global $post;

		if(!empty($getExcerptOnly) && $getExcerptOnly){
			$meta_fields = $postType->get_excerpt_meta_fields();
		}else{
			$meta_fields = $postType->meta_fields;
		}


		foreach($meta_fields as $meta){

			//make backwards compatible
			if(is_object($meta)){
				$metaName = $meta->name;
			}else{
				$metaName = $meta;
			}

			$theMeta = get_post_meta($post->ID, $metaName, $single = true);
			if(!empty($theMeta)){
				echo '<span class="metaName">';
				_e("$metaName", "made");
				echo '</span>: <span class="metaContent">'.$theMeta . '</span><div class="separator">&nbsp;</div>';
			}
		}
	}

	//outputs the html of the rating criteria for use on a single review page
	public function the_rating_criteria($postType){
		global $post;
		$meta_fields = $postType->rating_criteria;
		$reviewSkin = $postType->skin; //get the review skin
		if($reviewSkin=="dark") {
			$ratingImage="rating-meter-inner-bg-dark.png";
		} else {
			$ratingImage="rating-meter-inner-bg.png";
		}
		$num_ratings = count($meta_fields);
		$count=0;
		$total=0;

		$letters=array('A+' => 14, 'A' => 13, 'A-' => 12, 'B+' => 11, 'B' => 10, 'B-' => 9, 'C+' => 8, 'C' => 7, 'C-' => 6, 'D+' => 5, 'D' => 4, 'D-' => 3, 'F+' => 2, 'F' => 1);
		$numbers=array(14 => 'A+', 13 => 'A', 12 => 'A-', 11 => 'B+', 10 => 'B', 9 => 'B-', 8 => 'C+', 7 => 'C', 6 => 'C-', 5 => 'D+', 4 => 'D', 3 => 'D-', 2 => 'F+', 1 => 'F');

		$rating_type = $postType->rating_type; //we'll need this to determine averaging method
		$rating_color_ranges = $postType->rating_color_ranges; //and this to determine bargarph color of total score

		foreach($meta_fields as $meta){

			$style="";
			$style_last="";
			$rating_style="";
			$criteriaID="criteria".$count; //each animated criterion div needs a unique id for the jquery effect
			$ratingID="rating".$count; //each animated rating div needs a unique id as well
			$meterID="meter".$count; //each rating meter needs a unique id
			$delay=$count*500+1000; //increment delay by .5 seconds for each criteria, and don't start any animations for 2 seconds
			$duration=$count*1200; //duration of the total score animation
			//setup the inline styles used in the rating criteria
			$color=' style="background-image:url('.get_template_directory_uri().'/images/'.$ratingImage.');background-position:0px 0px;background-repeat:repeat-x;"';
			$color1=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color1.png);opacity:0"';
			$color2=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color2.png);opacity:0"';
			$color3=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color3.png);opacity:0"';
			$color4=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color4.png);opacity:0"';
			$color5=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color5.png);opacity:0"';
			$opacity=' style="opacity:0;"';
			$left=' style="position:relative;left:-160px;"'; //used for stars and letters
			$left_last=' style="position:relative;left:-100px;"'; //used for stars and letters

			//make backwards compatible
			if(is_object($meta)){
				$metaName = $meta->name;
			}else{
				$metaName = $meta;
			}
			$rating = get_post_meta($post->ID, $metaName, $single = true);
			$bgPosition=$rating*22.5; //width of rating box is 225px
			if($rating_type=="percentage") $bgPosition=$bgPosition/10; //percentages are 1 order of magnitude above numers

			if(((!empty($rating) || $rating==0) || $rating===0) && ($rating_type=="number" || $rating_type=="percentage")) {
				if($rating<$rating_color_ranges[0]) {
					$meter_style_last=$color1;
				} elseif($rating<$rating_color_ranges[1]) {
					$meter_style_last=$color2;
				} elseif($rating<$rating_color_ranges[2]) {
					$meter_style_last=$color3;
				} elseif($rating<$rating_color_ranges[3]) {
					$meter_style_last=$color4;
				} else {
					$meter_style_last=$color5;
				}
				$style_last='';
			} elseif ((!empty($rating) || $rating==0) && ($rating_type=="letter" || $rating_type=="stars")) {
				$style_last=$opacity;
				$rating_style=$left_last;
			}
			//figure out rich snippets schema info for each type
			switch ($rating_type) {
				case 'stars':					
					$schemaRating = $rating;
					$bestRating = 5;
					break;
				case 'percentage':					
					$schemaRating = $rating;
					$bestRating = 100;
					break;
				case 'number':					
					$schemaRating = $rating;
					$bestRating = 10;
					break;
				case 'letter':
					$schemaRating = $letters[$rating]; //get associated number value for the letter
					$bestRating = 14;
					break;
			}

			if($num_ratings==1) { //only one matching criterion
				if((!empty($rating) || $rating==0)) {
					$count++;
					?>
                    <div class="rating-criteria-outer <?php echo $rating_type; ?>">
                        <div id="last-criteria" class="rating-criteria-wrapper last <?php echo $rating_type; ?> only"<?php echo $style_last; ?>>
                            <div class="rating-criteria">
                                <?php _e("$metaName", "made"); ?>
                            </div>
                            <div id="last-rating" class="rating-wrapper"<?php echo $rating_style; ?><?php echo $meter_style_last; ?>>
                                <div class="rich-snippet-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                    <meta itemprop="worstRating" content="0">
                                    <?php if($rating_type=='stars' || $rating_type=='letter') { ?>
                                	<meta itemprop="ratingValue" content="<?php echo $schemaRating; ?>"> 
                                    <?php oswc_get_rating($rating, $postType, true); ?>                                   
                                <?php } else { ?>
									<div itemprop="ratingValue"><?php oswc_get_rating($rating, $postType, true); ?></div>
								<?php } ?>
                                    <meta itemprop="bestRating" content="<?php echo $bestRating; ?>">							
                                </div>
                                <br class="clearer" />
                            </div>
                            <br class="clearer" />
                        </div>
                    </div>

                    <script type="text/javascript">
						jQuery(window).load(function() {							
							jQuery('#last-criteria').delay(1000).animate({
								opacity:1,
								backgroundPosition: '<?php echo $bgPosition; ?> 0'
							}, 2500, 'easeOutCubic');
							jQuery('.number #last-rating, .percentage #last-rating').delay(<?php echo $delay+500; ?>).animate({
								opacity:1
							}, 2500, 'easeOutCubic');
							<?php if($rating_type=="stars" || $rating_type=="letter") { ?>
								jQuery('#last-rating').delay(<?php echo $delay+500; ?>).animate({
									left: '0'
								}, 2000, 'easeOutCubic');
							<?php } ?>								
						});
                    </script>
            <?php }
			} else { //more than one rating - tally rating criteria
				if((!empty($rating) || $rating==0)) {
					$count++;
					$number=$rating; //set a variable to use for appending number to total
					//different averaging method for each rating type
					if ($rating_type=="letter") {
						$number=$letters[$rating]; //get associated number value for the letter
						$style=$opacity;
						$rating_style=$left;
					} elseif ($rating_type=="stars") {
						$style=$opacity;
						$rating_style=$left;
					} elseif ($rating_type=="number" || $rating_type=="percentage") {						
						$meter_style=$color;					
					}
					$total+=$number; //add rating number to total
					?>
					<div id="<?php echo $criteriaID; ?>" class="rating-criteria-wrapper regular <?php echo $rating_type; ?>"<?php echo $style; ?>>
						<div class="rating-criteria">
							<?php _e("$metaName", "made"); ?>
						</div>
						<div id="<?php echo $ratingID; ?>" class="rating-wrapper small"<?php echo $rating_style; ?>>
							<?php oswc_get_rating($rating, $postType, true); ?>
							<br class="clearer" />
						</div>
						<br class="clearer" />
                        <div class="rating-meter-wrapper"><div class="rating-meter" id="<?php echo $meterID; ?>"<?php echo $meter_style; ?>>&nbsp;</div></div>
					</div>
					<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery('#<?php echo $criteriaID; ?>').delay(<?php echo $delay; ?>).animate({
								opacity:1 //set opacity for entire criteria line
							}, 1500, 'easeOutCubic');
							jQuery('#<?php echo $meterID; ?>').delay(<?php echo $delay; ?>).animate({										
								backgroundPosition: '<?php echo $bgPosition; ?> 0' //change background position for just the meter bar
							}, 1500, 'easeOutCubic');
							<?php if($rating_type=="stars" || $rating_type=="letter") { ?>
								jQuery('#<?php echo $ratingID; ?>').delay(<?php echo $delay; ?>).animate({
									left: '0' //change the position of the actual criteria value 
								}, 1500, 'easeOutCubic');
							<?php } ?>			
						});						
					</script>
					<?php if($count==$num_ratings) {
						//different averaging method for each rating type
						switch ($rating_type) {
							case 'stars':
								$rating = $total / $num_ratings;
								$rating = round($rating * 2) / 2; //need to get an even .5 rating for stars
								$style_last = $opacity;
								$delay_last = $delay+500; //hold off until after all criteria have been displayed since there is no bg animation
								$rating_style=$left_last;
								//setup rich snippet rating values
								$schemaRating = $rating;
								$bestRating = 5;
								break;
							case 'percentage':
								$rating = $total / $num_ratings;
								$rating = round($rating); //round to the closest whole number
								$bgPosition=0;
								if((!empty($rating) || $rating==0)) {
									if($rating<$rating_color_ranges[0]) {
										$meter_style_last=$color1;
									} elseif($rating<$rating_color_ranges[1]) {
										$meter_style_last=$color2;
									} elseif($rating<$rating_color_ranges[2]) {
										$meter_style_last=$color3;
									} elseif($rating<$rating_color_ranges[3]) {
										$meter_style_last=$color4;
									} else {
										$meter_style_last=$color5;
									}
								}
								$delay_last = 1000;
								$style_last = '';
								//setup rich snippet rating values
								$schemaRating = $rating;
								$bestRating = 100;
								break;
							case 'number':
								$rating = $total / $num_ratings;
								$rating = round($rating, 1); //round to the closest decimal point (tenth place)
								$bgPosition=0;
								if((!empty($rating) || $rating==0)) {
									if($rating<$rating_color_ranges[0]) {
										$meter_style_last=$color1;
									} elseif($rating<$rating_color_ranges[1]) {
										$meter_style_last=$color2;
									} elseif($rating<$rating_color_ranges[2]) {
										$meter_style_last=$color3;
									} elseif($rating<$rating_color_ranges[3]) {
										$meter_style_last=$color4;
									} else {
										$meter_style_last=$color5;
									}
								}
								$delay_last = 1000;
								$style_last = '';
								//setup rich snippet rating values
								$schemaRating = $rating;
								$bestRating = 10;
								break;
							case 'letter':
								$rating = $total / $num_ratings;
								$rating = round($rating); //round to the closest whole number
								//setup rich snippet rating values
								$schemaRating = $rating;
								$bestRating = 14;
								//turn the rating number back into a letter
								$rating=$numbers[$rating]; //get associated number value for the letter
								$style_last=$opacity;
								$delay_last = $delay+500; //hold off until after all criteria have been displayed since there is no bg animation
								$rating_style=$left_last;								
								break;
						}
						?>
						<div class="rating-criteria-outer <?php echo $rating_type; ?>">
                            <div id="last-criteria" class="rating-criteria-wrapper last <?php echo $rating_type; ?>"<?php echo $style_last; ?>>
                                <div class="rating-criteria">
                                    <?php _e("Total Score", "made"); ?>
                                </div>
                                <div id="last-rating" class="rating-wrapper"<?php echo $rating_style; ?><?php echo $meter_style_last; ?>>
                                    <div class="rich-snippet-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                        <meta itemprop="worstRating" content="0">
                                        <?php if($rating_type=='stars' || $rating_type=='letter') { ?>
                                            <meta itemprop="ratingValue" content="<?php echo $schemaRating; ?>"> 
                                            <?php oswc_get_rating($rating, $postType, true); ?>                                   
                                        <?php } else { ?>
                                            <div itemprop="ratingValue"><?php oswc_get_rating($rating, $postType, true); ?></div>
                                        <?php } ?>
                                        <meta itemprop="bestRating" content="<?php echo $bestRating; ?>">							
                                    </div>
                                    <br class="clearer" />
                                </div>
                                <br class="clearer" />
                            </div>
                        </div>

                        <script type="text/javascript">
							jQuery(window).load(function() {
								jQuery('#last-criteria').delay(<?php echo $delay_last; ?>).animate({
									opacity:1,
									backgroundPosition: '<?php echo $bgPosition; ?> 0'
								}, <?php echo $duration; ?>, 'easeOutCubic');
								jQuery('.number #last-rating, .percentage #last-rating').delay(<?php echo $delay_last; ?>).animate({
									opacity:1
								}, <?php echo $duration; ?>, 'easeOutCubic');
								<?php if($rating_type=="stars" || $rating_type=="letter") { ?>
									jQuery('#last-rating').delay(<?php echo $delay+500; ?>).animate({
										left: '0'
									}, 2000, 'easeOutCubic');
								<?php } ?>
							});
						</script>

					<?php
					}
				}
			}
		}
		if($count==0) { //user only specified a final rating ("Rating") and no criteria yet for this review
			$count=1;
			$style="";
			$style_last="";
			$rating_style="";
			$criteriaID="criteria".$count; //each animated criterion div needs a unique id for the jquery effect
			$ratingID="rating".$count; //each animated rating div needs a unique id as well
			$delay=$count*500+1000; //increment delay by .5 seconds for each criteria, and don't start any animations for 2 seconds
			$duration=$count*2000; //duration of the total score animation
			//setup the inline styles used in the rating criteria
			$color=' style="background-image:url('.get_template_directory_uri().'/images/'.$ratingImage.');background-position:0px 0px;background-repeat:repeat-x;"';
			$color1=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color1.png);opacity:0"';
			$color2=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color2.png);opacity:0"';
			$color3=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color3.png);opacity:0"';
			$color4=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color4.png);opacity:0"';
			$color5=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color5.png);opacity:0"';
			$opacity=' style="opacity:0;"';
			$left=' style="position:relative;left:-160px;"'; //used for stars and letters
			$left_last=' style="position:relative;left:-100px;"'; //used for stars and letters
			$rating = get_post_meta($post->ID, 'Rating', $single = true);
			$bgPosition=$rating*22.5; //width of rating box is 225px
			if($rating_type=="percentage") $bgPosition=$bgPosition/10; //percentages are 1 order of magnitude above numers
			if(((!empty($rating) || $rating==0) || $rating===0) && ($rating_type=="number" || $rating_type=="percentage")) {
				if($rating<$rating_color_ranges[0]) {
					$meter_style_last=$color1;
				} elseif($rating<$rating_color_ranges[1]) {
					$meter_style_last=$color2;
				} elseif($rating<$rating_color_ranges[2]) {
					$meter_style_last=$color3;
				} elseif($rating<$rating_color_ranges[3]) {
					$meter_style_last=$color4;
				} else {
					$meter_style_last=$color5;
				}
				$bgPosition=0;
				$style_last='';
			} elseif ((!empty($rating) || $rating==0) && ($rating_type=="letter" || $rating_type=="stars")) {
				$style_last=$opacity;
				$rating_style=$left_last;
			}
			//figure out rich snippets schema info for each type
			switch ($rating_type) {
				case 'stars':					
					$schemaRating = $rating;
					$bestRating = 5;
					break;
				case 'percentage':					
					$schemaRating = $rating;
					$bestRating = 100;
					break;
				case 'number':					
					$schemaRating = $rating;
					$bestRating = 10;
					break;
				case 'letter':
					$schemaRating = $letters[$rating]; //get associated number value for the letter
					$bestRating = 14;
			}
			
			if((!empty($rating) || $rating==0)){ ?>
                <div class="rating-criteria-outer <?php echo $rating_type; ?>">
                    <div id="last-criteria" class="rating-criteria-wrapper last <?php echo $rating_type; ?> only"<?php echo $style_last; ?>>
                        <div class="rating-criteria">
                            <?php _e("Total Score", "made"); ?>
                        </div>
                        <div id="last-rating" class="rating-wrapper"<?php echo $rating_style; ?><?php echo $meter_style_last; ?>>
                            <div class="rich-snippet-text" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                <meta itemprop="worstRating" content="0">
                                <?php if($rating_type=='stars' || $rating_type=='letter') { ?>
                                	<meta itemprop="ratingValue" content="<?php echo $schemaRating; ?>"> 
                                    <?php oswc_get_rating($rating, $postType, true); ?>                                   
                                <?php } else { ?>
									<div itemprop="ratingValue"><?php oswc_get_rating($rating, $postType, true); ?></div>
								<?php } ?>
                                <meta itemprop="bestRating" content="<?php echo $bestRating; ?>">							
                            </div>
                            <br class="clearer" />
                        </div>
                        <br class="clearer" />
                    </div>
                </div>

                <script type="text/javascript">
                    jQuery(window).load(function() {                        
						jQuery('#last-criteria').delay(1000).animate({
							opacity:1,
							backgroundPosition: '<?php echo $bgPosition; ?> 0'
						}, 2500, 'easeOutCubic');
						jQuery('.number #last-rating, .percentage #last-rating').delay(<?php echo $delay+500; ?>).animate({
							opacity:1
						}, 2500, 'easeOutCubic');
						<?php if($rating_type=="stars" || $rating_type=="letter") { ?>
							jQuery('#last-rating').delay(<?php echo $delay+500; ?>).animate({
								left: '0'
							}, 2000, 'easeOutCubic');
						<?php } ?>                           
                    });
                </script>
			<?php }
		}
	}

	//outputs the html of the rating criteria for use when only the avg (total) rating should be displayed
	//(which would be all pages except the single review page with the drill-down criteria)
	public function the_rating($postType){
		global $post;
		$meta_fields = $postType->rating_criteria;
		$num_ratings = count($meta_fields);
		$count=0;
		$total=0;

		$letters=array('A+' => 14, 'A' => 13, 'A-' => 12, 'B+' => 11, 'B' => 10, 'B-' => 9, 'C+' => 8, 'C' => 7, 'C-' => 6, 'D+' => 5, 'D' => 4, 'D-' => 3, 'F+' => 2, 'F' => 1);
		$numbers=array(14 => 'A+', 13 => 'A', 12 => 'A-', 11 => 'B+', 10 => 'B', 9 => 'B-', 8 => 'C+', 7 => 'C', 6 => 'C-', 5 => 'D+', 4 => 'D', 3 => 'D-', 2 => 'F+', 1 => 'F');

		$rating_type = $postType->rating_type; //we'll need this to determine averaging method

		if (!$meta_fields) return; //added for version 2.3 on 12/31/2012
		
		foreach($meta_fields as $meta){

			//make backwards compatible
			if(is_object($meta)){
				$metaName = $meta->name;
			}else{
				$metaName = $meta;
			}
			$rating = get_post_meta($post->ID, $metaName, $single = true);

			if($num_ratings==1) { //only one matching criterion
				if((!empty($rating) || $rating==0)) {
					$count++;
					oswc_get_rating($rating, $postType);
				}
			} else { //more than one rating - tally rating criteria
				if((!empty($rating) || $rating==0)) {
					$count++;
					$number=$rating; //set a variable to use for appending number to total
					//different averaging method for each rating type
					if ($rating_type=="letter") {
						$number=$letters[$rating]; //get associated number value for the letter
					}
					$total+=$number; //add rating number to total
					if($count==$num_ratings) {
						//different averaging method for each rating type
						switch ($rating_type) {
							case 'stars':
								$rating = $total / $num_ratings;
								$rating = round($rating * 2) / 2; //need to get an even .5 rating for stars
								break;
							case 'percentage':
								$rating = $total / $num_ratings;
								$rating = round($rating); //round to the closest whole number
								break;
							case 'number':
								$rating = $total / $num_ratings;
								$rating = round($rating, 1); //round to the closest decimal point (tenth place)
								break;
							case 'letter':
								$rating = $total / $num_ratings;
								$rating = round($rating); //round to the closest whole number
								//turn the rating number back into a letter
								$rating=$numbers[$rating]; //get associated number value for the letter
								break;
						}
						oswc_get_rating($rating, $postType);
					}
				}
			}
		}
		if($count==0) { //user only specified a final rating ("Rating") and no criteria yet for this review
			$rating = get_post_meta($post->ID, 'Rating', $single = true);
			if((!empty($rating) || $rating==0)){
				oswc_get_rating($rating, $postType);
			}
		}
	}

	public function the_primary_taxonomy($post, $primaryTaxonomy){
    	try{
    		$terms = wp_get_object_terms($post->ID, $primaryTaxonomy->id);

	        $cat_name = $terms[0]->name;
	        $cat_slug = $terms[0]->slug;
	        $cat_link = get_term_link($cat_slug, $primaryTaxonomy->id);
	        if($cat_name=="") {
	            echo get_the_term_list( $post->ID, $primaryTaxonomy->id, ' ', ', ', '' );
	        } else {
	            echo "<a href=\"$cat_link\">$cat_name</a>";
	        }
    	}catch(Exception $e){

    	}

	}
	
	public function the_user_rating($postType, $userRatingsEnabled, $post) {
	
		if($userRatingsEnabled) {
									
			//get the user rating info
			$rating_type = $postType->rating_type; //we'll need this to determine averaging method
			$rating_color_ranges = $postType->rating_color_ranges; //and this to determine bargarph color of total score
			$letters=array('A+' => 14, 'A' => 13, 'A-' => 12, 'B+' => 11, 'B' => 10, 'B-' => 9, 'C+' => 8, 'C' => 7, 'C-' => 6, 'D+' => 5, 'D' => 4, 'D-' => 3, 'F+' => 2, 'F' => 1);
			$numbers=array(14 => 'A+', 13 => 'A', 12 => 'A-', 11 => 'B+', 10 => 'B', 9 => 'B-', 8 => 'C+', 7 => 'C', 6 => 'C-', 5 => 'D+', 4 => 'D', 3 => 'D-', 2 => 'F+', 1 => 'F');
			$meta = get_post_meta($post->ID, "user_rating", $single = true);
			$ip=$_SERVER['REMOTE_ADDR'];		
			$user_rating = substr_replace($meta,"",-1);
			$ratings = explode(";",$user_rating);
			$rating = 0; //initial rating value
			foreach ($ratings as $entry) {
				$entry = substr($entry, 0, strpos($entry, ',')); //strip out the ip address
				if ($rating_type=="letter") {
					$entry = $letters[$entry]; //get the numerical value of this letter grade for averaging purposes	
				}
				$rating += $entry; //add to the total rating
			}
			$number_ratings = count($ratings); //get total number of user ratings (subtract 1 for last empty delimiter)	
			if($user_rating=='') $number_ratings=0;	 //set rating number to 0 if user_rating custom field doesn't exist						
			if($rating_type=="percentage") {
				$precision=0;
			} else {
				$precision=1;	
			}
			if($number_ratings!=0) $rating = round($rating / $number_ratings, $precision); //get total average of all ratings									
			//setup inline style for user ratings								
			$color1=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color1.png);"';
			$color2=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color2.png);"';
			$color3=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color3.png);"';
			$color4=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color4.png);"';
			$color5=' style="background-image:url('.get_template_directory_uri().'/images/rating-number-last-color5.png);"';
			if($rating_type=="number" || $rating_type=="percentage") {
				if($rating<$rating_color_ranges[0]) {
					$meter_style_last=$color1;
				} elseif($rating<$rating_color_ranges[1]) {
					$meter_style_last=$color2;
				} elseif($rating<$rating_color_ranges[2]) {
					$meter_style_last=$color3;
				} elseif($rating<$rating_color_ranges[3]) {
					$meter_style_last=$color4;
				} else {
					$meter_style_last=$color5;
				}	
			} elseif ($rating_type=="letter") {
				$rating = $numbers[$rating]; //convert the rating back to the letter grade value for display purposes
			}
			?>
			
			<div class="user-ratings-wrapper<?php if($number_ratings==0) { ?> empty<?php } ?>">
			
				<div class="inner">
				
					<div class="label-wrapper">
			
						<div class="label"><?php _e('User Rating','made'); ?></div>
						
						<div class="count">
							<span class="count_value">
								<?php if($number_ratings==1) { 
									echo $number_ratings . "&nbsp;" . __('total rating','made');
								} elseif($number_ratings==0) { 
									 _e('no ratings yet','made');
								} else { 
									echo $number_ratings . "&nbsp;" . __('total ratings','made');
								} ?>
							</span>
						</div>
						
					</div>
				
					<div class="rating-wrapper"<?php echo $meter_style_last; ?>>                                                
						
						<?php //different user rating type depending on selected rating type
						if ($rating_type=="stars") { ?>
							
							<div class="rateit bigstars" data-rateit-starwidth="20" data-rateit-starheight="20" data-rateit-resetable="false" data-rateit-value="<?php echo $rating; ?>" data-rateit-ispreset="true" data-postid="<?php echo $post->ID; ?>"<?php if(strpos($meta,$ip) != false) { ?> data-rateit-readonly="true"<?php } ?>></div>
							
							<script type ="text/javascript">
								 //we bind only to the rateit controls within the ratings wrapper div
								 jQuery('.ratings-wrapper .rateit').bind('rated reset', function (e) {
									 var ri = jQuery(this);
									
									 var value = ri.rateit('value');
									 var postID = ri.data('postid');
							 
									 //disable rating ability after user submits rating
									 ri.rateit('readonly', true);
							 
									 jQuery.ajax({
										 url: '<?php echo get_template_directory_uri(); ?>/functions/rateit.php',
										 data: { id: postID, value: value },
										 type: 'POST',
										 success: function (data) {
											 jQuery('.ratings-wrapper .count_value').html(data);
							 
										 },
										 error: function (jxhr, msg, err) {
											 jQuery('.ratings-wrapper .count_value').html(msg);
										 }
									 });
								 });
							 </script>
								
						<?php } else { ?>
							
							<ul class="user-ratings <?php echo $rating_type; ?>-wrapper<?php if(strpos($meta,$ip) != false) { ?> disabled<?php } ?>">
							
								<?php if($number_ratings==0) { ?>
								
									<li><a class="overall"><div class="number single"><?php _e('Rate','made'); ?>&nbsp;&darr;</div></a>
								
								<?php } else { ?>
									
									<li><a class="overall"><?php echo oswc_get_rating($rating, $postType); ?></a>
									
								<?php } ?>
									
									<ul>
									
										<?php 
										switch ($rating_type) {																		
											case "number":
												for( $i=10; $i >= 1; $i-=1 )
													echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="'.$i.'">'. $i .'</a></li>';	
												break;				
											case "percentage":
												for( $i=100; $i >= 0; $i-=10 )
													echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="'.$i.'">'. $i .'%</a></li>';																				
												break;
											case "letter":
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="A+">A+</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="A">A</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="A-">A-</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="B+">B+</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="B">B</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="B-">B-</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="C+">C+</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="C">C</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="C-">C-</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="D+">D+</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="D">D</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="D-">D-</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="F+">F+</a></li>';
												echo '<li><a data-postid="'.$post->ID.'" data-rateit-value="F">F</a></li>';
												break;			
										}
										?>
									
									</ul>
								
								</li>
								
							</ul>
							
							<script type ="text/javascript">
								 jQuery('ul.user-ratings li ul li a').click(function() {
									 var ri = jQuery(this);
									
									 var value = ri.rateit('value');
									 var postID = ri.data('postid');
									 
									 jQuery.ajax({
										 url: '<?php echo get_template_directory_uri(); ?>/functions/rateit.php',
										 data: { id: postID, value: value },
										 type: 'POST',
										 success: function (data) {
											 jQuery('.ratings-wrapper ul.user-ratings').addClass('disabled'); //disable drop down
											 jQuery('.ratings-wrapper .count_value').html(data); //update number of ratings
											 <?php if($rating_type=='percentage') { ?>
												jQuery('.ratings-wrapper a.overall div').html(value + '%'); //update current user rating
											 <?php } else { ?>
												jQuery('.ratings-wrapper a.overall div').html(value); //update current user rating
											 <?php } ?>
											 jQuery('.ratings-wrapper a.overall').animate({ //change background to black
												backgroundColor: '#000'
											}, 1000);
										 },
										 error: function (jxhr, msg, err) {
											 jQuery('.ratings-wrapper .count_value').html(msg);
										 }
									 });
								 });
							</script>
							
						<?php } ?>                                               
						
					</div>
									 
					<br class="clearer" />
				
				</div>
			
			</div>
			
			<script type="text/javascript">
				//animate the user ratings wrapper
				jQuery(window).load(function() {
				
					jQuery('.user-ratings-wrapper .inner').delay(1000).animate({
					 opacity:1			 
					}, 1000, "easeOutCubic" );	
				
				});								
			</script>
		
		<?php 
		}
        
    } 

}

//instantiate single instance of oswcPostTypes to be used throughout site
$oswcPostTypes = new oswcPostTypes();

function add_post_types($possiblePostTypes){

	global $oswc_reviews;
	$oswc_reviews = get_option( 'oswc_reviews', $oswc_reviews );
	if(!empty($oswc_reviews['review_types'])) {
		$reviewTypes = explode(",",$oswc_reviews['review_types']);
		foreach($reviewTypes as $reviewTypeName) {
			$reviewTypeName = trim($reviewTypeName);
			//get equivalent of "safe_name" for this review type
			$reviewType = trim(str_replace(" ","_",str_replace("/", "", str_replace("-","_",$reviewTypeName))));
			//echo("<br /><br />oswc-post-types.php<br /><br />************************<br /><br />".var_export($oswc_reviews));
	
			$rating_criteria = fixObject($oswc_reviews['rating_criteria_'.$reviewType]);
			$taxonomies = fixObject($oswc_reviews['taxonomies_'.$reviewType]);
			$meta_fields = fixObject($oswc_reviews['meta_fields_'.$reviewType]);
	
			array_push($possiblePostTypes, new OSWCPostType(
				array(
					'name' => $reviewTypeName,
					'enabled' => $oswc_reviews['enabled_'.$reviewType],
					'positive' => $oswc_reviews['positive_'.$reviewType],
					'negative' => $oswc_reviews['negative_'.$reviewType],
					'bottom_line' => $oswc_reviews['bottom_line_'.$reviewType],
					'bg_attach' => $oswc_reviews['bg_attach_'.$reviewType],
					'tax_above_meta' => $oswc_reviews['tax_above_meta_'.$reviewType],
					'rating_color_range_enabled' => $oswc_reviews['rating_color_range_enabled_'.$reviewType],
					'rating_color_ranges' => $oswc_reviews['rating_color_ranges_'.$reviewType],
					'rating_type' => $oswc_reviews['rating_type_'.$reviewType],
					'rating_color' => $oswc_reviews['rating_color_'.$reviewType],
					'user_ratings_enabled' => $oswc_reviews['user_ratings_enabled_'.$reviewType],
					'header_ad_show' => $oswc_reviews['header_ad_show_'.$reviewType],
					'header_ad' => $oswc_reviews['header_ad_'.$reviewType],
					'logo' => $oswc_reviews['logo_'.$reviewType],
					'logo_iphone' => $oswc_reviews['logo_iphone_'.$reviewType],
					'logo_ipad' => $oswc_reviews['logo_ipad_'.$reviewType],
					'icon' => $oswc_reviews['icon_'.$reviewType],
					'icon_light' => $oswc_reviews['icon_light_'.$reviewType],
					'icon_admin' => $oswc_reviews['icon_admin_'.$reviewType],
					'bg_image' => $oswc_reviews['bg_image_'.$reviewType],
					'color' => $oswc_reviews['color_'.$reviewType],
					'skin' => $oswc_reviews['skin_'.$reviewType],
					'logo_bar_image' => $oswc_reviews['logo_bar_image_'.$reviewType],
					'hide_logo_bar_bg' => $oswc_reviews['hide_logo_bar_bg_'.$reviewType],
					'link_color' => $oswc_reviews['link_color_'.$reviewType],
					'bg_color' => $oswc_reviews['bg_color_'.$reviewType],
					'layout' => $oswc_reviews['layout_'.$reviewType],
					'featured_enabled' => $oswc_reviews['featured_enabled_'.$reviewType],
					'featured_size' => $oswc_reviews['featured_size_'.$reviewType],
					'front_sidebar_enabled' => $oswc_reviews['front_sidebar_enabled_'.$reviewType],
					'dontmiss_enabled' => $oswc_reviews['dontmiss_enabled_'.$reviewType],
					'latest_enabled' => $oswc_reviews['latest_enabled_'.$reviewType],
					'latest_specific' => $oswc_reviews['latest_specific_'.$reviewType],
					'meta_enabled' => $oswc_reviews['meta_enabled_'.$reviewType],
					'excerpt_enabled' => $oswc_reviews['excerpt_enabled_'.$reviewType],
					'trending_enabled' => $oswc_reviews['trending_enabled_'.$reviewType],
					'tax_layout' => $oswc_reviews['tax_layout_'.$reviewType],
					'tax_dontmiss_enabled' => $oswc_reviews['tax_dontmiss_enabled_'.$reviewType],
					'tax_latest_enabled' => $oswc_reviews['tax_latest_enabled_'.$reviewType],
					'tax_meta_enabled' => $oswc_reviews['tax_meta_enabled_'.$reviewType],
					'tax_sidebar_enabled' => $oswc_reviews['tax_sidebar_enabled_'.$reviewType],
					'tax_excerpt_enabled' => $oswc_reviews['tax_excerpt_enabled_'.$reviewType],
					'tax_trending_enabled' => $oswc_reviews['tax_trending_enabled_'.$reviewType],
					'single_dontmiss_enabled' => $oswc_reviews['single_dontmiss_enabled_'.$reviewType],
					'single_latest_enabled' => $oswc_reviews['single_latest_enabled_'.$reviewType],
					'sidebar_enabled' => $oswc_reviews['sidebar_enabled_'.$reviewType],
					'summary_header_text' => $oswc_reviews['summary_header_text_'.$reviewType],
					'full_article_text' => $oswc_reviews['full_article_text_'.$reviewType],
					'related_number' => $oswc_reviews['related_number_'.$reviewType],
					'rating_criteria' => $rating_criteria,
					'meta_fields' => $meta_fields,
					'taxonomies' => $taxonomies,
					'hide_review_verbiage' => $oswc_reviews['hide_review_verbiage_'.$reviewType],
					'child_theme_post_type' => false
				)
			));
		}

// echo "<pre>";
// print_r($possiblePostTypes);
// echo "</pre>";
	}
	return $possiblePostTypes;
}

//html display of rating
function oswc_get_rating($rating, $reviewType, $single = NULL) {
	if(!isset($single)){
		$single = false;
	}
	if($single) {
		$single=" single"; //css class added if this is a single review page
	} else {
		$single="";
	}
	//get rating type and color
	$rating_type = $reviewType->rating_type;
	$rating_color = $reviewType->rating_color;
	$rating_color_ranges = $reviewType->rating_color_ranges;
	$rating_color_range_enabled = $reviewType->rating_color_range_enabled;

	//display rating based on type
	switch ($rating_type) {
		case 'stars':
			//check for acceptable rating value
			if(!is_numeric($rating)) { $rating = 0; } //if rating is not a number, set it to 0
			$valid=false;
			foreach (range(0, 5, .5) as $num) {
				if($rating == $num) { $valid=true; }
			}
			if(!$valid) { $rating = 0; } //if rating was not in the acceptable range of values, set it to 0
			//begin html output
			$output = '<div class="stars '.$rating_color.'">';
			$output .= '<div class="star ';
			if($rating>=1) {
				$output .= ' full';
			} elseif($rating>0) {
				$output .= ' half';
			}
			$output .= '">&nbsp;</div>';
			$output .= '<div class="star ';
			if($rating>=2) {
				$output .= ' full';
			} elseif($rating>1) {
				$output .= ' half';
			}
			$output .= '">&nbsp;</div>';
			$output .= '<div class="star ';
			if($rating>=3) {
				$output .= ' full';
			} elseif($rating>2) {
				$output .= ' half';
			}
			$output .= '">&nbsp;</div>';
			$output .= '<div class="star ';
			if($rating>=4) {
				$output .= ' full';
			} elseif($rating>3) {
				$output .= ' half';
			}
			$output .= '">&nbsp;</div>';
			$output .= '<div class="star ';
			if($rating>=5) {
				$output .= ' full';
			} elseif($rating>4) {
				$output .= ' half';
			}
			$output .= $single.'">&nbsp;</div>';

			break;
		case 'percentage':
			//check for acceptable rating value
			if(!is_numeric($rating)) { $rating = 0; } //if rating is not a number, set it to 0
			$valid=false;
			foreach (range(0, 100, 1) as $num) {
				if($rating == $num) { $valid=true; }
			}
			if(!$valid) { $rating = 0; } //if rating was not in the acceptable range of values, set it to 0
			//check for acceptable range color values
			if($rating<$rating_color_ranges[0]) {
				$color = 'color1';
			} elseif($rating<$rating_color_ranges[1]) {
				$color = 'color2';
			} elseif($rating<$rating_color_ranges[2]) {
				$color = 'color3';
			} elseif($rating<$rating_color_ranges[3]) {
				$color = 'color4';
			} else {
				$color = 'color5';
			}
			if(!$rating_color_range_enabled) { $color = 'nocolor'; }

			//begin html output
			$output = '<div class="number '.$color.$single.'">';
			$output .= $rating . "&#37;";

			break;
		case 'number':
			//check for acceptable rating value
			if(!is_numeric($rating)) { $rating = 0; } //if rating is not a number, set it to 0
			//check for acceptable range color values
			if($rating<$rating_color_ranges[0]) {
				$color = 'color1';
			} elseif($rating<$rating_color_ranges[1]) {
				$color = 'color2';
			} elseif($rating<$rating_color_ranges[2]) {
				$color = 'color3';
			} elseif($rating<$rating_color_ranges[3]) {
				$color = 'color4';
			} else {
				$color = 'color5';
			}
			if(!$rating_color_range_enabled) { $color = 'nocolor'; }
			if(!strpos($rating,".") && $rating!=10 && $rating>=.9) { $rating .= ".0"; } //add .0 if rating is an even number
			if($rating<1) { $rating = "0".$rating; } //add leading 0 for ratings less than 1
			//begin html output
			$output = '<div class="number '.$color.$single.'">';
			$output .= $rating;

			break;
		case 'letter':
			//get letter rating in correct format
			$rating = trim(str_replace(" ","",strtoupper($rating)));
			//create array of acceptable values
			$arrRatings = array('A+','A','A-','B+','B','B-','C+','C','C-','D+','D','D-','F+','F','F-');
			//check for acceptable rating value
			if(!in_array($rating,$arrRatings)) { $rating = "F-"; } //if rating is not a number, set it to F-
			//check for acceptable range color values
			if($rating=='F+' || $rating=='F' || $rating=='F-') {
				$color = 'color1';
			} elseif($rating=='D+' || $rating=='D' || $rating=='D-') {
				$color = 'color2';
			} elseif($rating=='C+' || $rating=='C' || $rating=='C-') {
				$color = 'color3';
			} elseif($rating=='B+' || $rating=='B' || $rating=='B-') {
				$color = 'color4';
			} else {
				$color = 'color5';
			}
			if(!$rating_color_range_enabled) { $color = 'nocolor'; }
			//begin html output
			$output = '<div class="letter '.$color.$single.'">';
			$output .= $rating;

			break;
	}
	//close the div wrapper
	$output .= '</div>';
	//return the html output
	echo $output;
}

?>
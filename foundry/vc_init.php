<?php 

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if( function_exists('vc_set_as_theme') ){
	function ebor_vcSetAsTheme() {
		vc_set_as_theme(true);
	}
	add_action( 'vc_before_init', 'ebor_vcSetAsTheme' );
}

if(!( function_exists('ebor_custom_css_classes_for_vc_row_and_vc_column') )){
	function ebor_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
		}
		return $class_string; // Important: you should always return modified or original $class_string
	}
	add_filter( 'vc_shortcodes_css_class', 'ebor_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
}

if(!( function_exists('ebor_icons_settings_field') )){
	function ebor_icons_settings_field( $settings, $value ) {
		
		$icons = $settings['value'];
		
		$output = '<a href="#" id="ebor-icon-toggle" class="button button-primary button-large">Show/Hide Icons</a><div class="ebor-icons"><div class="ebor-icons-wrapper">';
		foreach( $icons as $icon ){
			$active = ( $value == $icon) ? ' active' : '';
			$output .= '<i class="icon '. $icon . $active .'" data-icon-class="'. $icon .'"></i>';
		}
		$output .= '</div><input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ebor-icon-value ' .
		esc_attr( $settings['param_name'] ) . ' ' .
		esc_attr( $settings['type'] ) . '_field" type="text" value="' . esc_attr( $value ) . '" />' . '</div>';
		
	   return $output;
	}
	vc_add_shortcode_param( 'ebor_icons', 'ebor_icons_settings_field' );
}

/**
 * Add additional functions to certain blocks.
 * vc_map runs before custom post types and taxonomies are created, so this function is used
 * to add custom taxonomy selectors to VC blocks, a little annoying, but works perfectly.
 */
if(!( function_exists('ebor_vc_add_att') )){
	function ebor_vc_add_attr(){
		
		//Designate background style
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Section Layout",
			'param_name' => 'foundry_background_style',
			'value' => array_flip(array(
				'light-wrapper'    => 'Standard Section (Light Background)',
				'bg-secondary'     => 'Standard Section (Dark Background)',
				'bg-dark'          => 'Standard Section (Black Background)',
				'bg-primary'       => 'Standard Section (Highlight Colour Background)',
			)),
			'description' => "Choose Layout For This Row"
		);
		vc_add_param('vc_row', $attributes);
		
		//Designate background style
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Section Padding",
			'param_name' => 'foundry_padding',
			'value' => array_flip(array(
				'normal-padding'    => 'Regular Padding',
				'pt64 pb64'         => 'Small Padding',
				'pt180 pb180 pt-xs-80 pb-xs-80' => 'Large Padding',
				'pb0'               => 'No Bottom Padding',
				'pt240'             => 'Large Top Padding',
				'pt0'               => 'No Top Padding',
				'pt0 pb0'           => 'No Padding'
			)),
		);
		vc_add_param('vc_row', $attributes);
		
		//Add border to bottom of section
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Add Border to Section Bottom?",
			'param_name' => 'append_hr',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			)
		);
		vc_add_param('vc_row', $attributes);
		
		//Add icons to background
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Add Icons to section background?",
			'param_name' => 'foundry_icons',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			)
		);
		vc_add_param('vc_row', $attributes);
		
		//Vertical Align children
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Vertically Align the Child Columns of this row?",
			'param_name' => 'foundry_vertical_align',
			'value' => array(
				'No' => 'no',
				'Yes' => 'yes'
			)
		);
		vc_add_param('vc_row', $attributes);
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Parallax Image Background?",
			'description' => 'Requires background image to be set in Design tab.',
			'param_name' => 'foundry_parallax',
			'value' => array(
				'Yes' => 'overlay parallax',
				'No' => 'not-parallax'
			)
		);
		vc_add_param('vc_row', $attributes);
		
		/**
		 * Add client category selectors
		 */
		$client_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'client_category'
		);
		$client_cats = get_categories( $client_args );
		$final_client_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('client_category') ){
			if( is_array($client_cats) ){
				foreach( $client_cats as $cat ){
					$final_client_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific client Category?",
			'param_name' => 'filter',
			'value' => $final_client_cats
		);
		vc_add_param('foundry_clients', $attributes);
		
		/**
		 * Add team category selectors
		 */
		$team_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team_category'
		);
		$team_cats = get_categories( $team_args );
		$final_team_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('team_category') ){
			if( is_array($team_cats) ){
				foreach( $team_cats as $cat ){
					$final_team_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Team Category?",
			'param_name' => 'filter',
			'value' => $final_team_cats
		);
		vc_add_param('foundry_team', $attributes);
		
		/**
		 * Add portfolio category selectors
		 */
		$portfolio_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'portfolio_category'
		);
		$portfolio_cats = get_categories( $portfolio_args );
		$final_portfolio_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('portfolio_category') ){
			if( is_array($portfolio_cats) ){
				foreach( $portfolio_cats as $cat ){
					$final_portfolio_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific Portfolio Category?",
			'param_name' => 'filter',
			'value' => $final_portfolio_cats
		);
		vc_add_param('foundry_portfolio', $attributes);
		
		/**
		 * Add blog category selectors
		 */
		$blog_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'category'
		);
		$blog_cats = get_categories( $blog_args );
		$final_blog_cats = array( 'Show all categories' => 'all' );
		
		if( is_array($blog_cats) ){
			foreach( $blog_cats as $cat ){
				$final_blog_cats[$cat->name] = $cat->term_id;
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific blog Category?",
			'param_name' => 'filter',
			'value' => $final_blog_cats
		);
		vc_add_param('foundry_blog', $attributes);
		
		/**
		 * Add testimonial category selectors
		 */
		$testimonial_args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'testimonial_category'
		);
		$testimonial_cats = get_categories( $testimonial_args );
		$final_testimonial_cats = array( 'Show all categories' => 'all' );
		
		if( taxonomy_exists('testimonial_category') ){
			if( is_array($testimonial_cats) ){
				foreach( $testimonial_cats as $cat ){
					$final_testimonial_cats[$cat->name] = $cat->term_id;
				}
			}
		}
		
		$attributes = array(
			'type' => 'dropdown',
			'heading' => "Show Specific testimonial Category?",
			'param_name' => 'filter',
			'value' => $final_testimonial_cats
		);
		vc_add_param('foundry_testimonial_carousel', $attributes);
		
		vc_remove_param('vc_row', 'video_bg');
		vc_remove_param('vc_row', 'video_bg_url');
		vc_remove_param('vc_row', 'video_bg_parallax');
		vc_remove_param('vc_row', 'parallax');
		vc_remove_param('vc_row', 'parallax_image');
		vc_remove_param('vc_row', 'content_placement');
		
	}
	add_action('init', 'ebor_vc_add_attr', 999);
}

/**
 * Redirect page template if vc_row shortcode is found in the page.
 * This lets us use a dedicated page template for Visual Composer pages
 * without the need for on page checks, or custom page templates.
 * 
 * It's buyer-proof basically.
 */
if(!( function_exists('ebor_vc_page_template') )){
	function ebor_vc_page_template( $template ){
		global $post;
		
		if( is_archive() || is_404() || is_home() )
			return $template;
		
		if( !( isset($post->post_content) ) || is_search() )
			return $template;
			
		if( 'page' == $post->post_type && get_post_meta( $post->ID, '_wp_page_template', true ) == 'page_sidebar.php' )
			return $template;
			
		if( 'no' == get_option('foundry_vc_redirect_' . $post->post_type) )
			return $template;
			
		if( has_shortcode($post->post_content, 'vc_row') ){
			$new_template = locate_template( array( 'page_visual_composer.php' ) );
			if (!( '' == $new_template )){
				return $new_template;
			}
		}
		
		return $template;
	}
	add_filter( 'template_include', 'ebor_vc_page_template', 99 );
}

/**
 * Page builder blocks below here
 * Whoop-dee-doo
 */
get_template_part('vc_blocks/vc_blog_block');
get_template_part('vc_blocks/vc_portfolio_block');
get_template_part('vc_blocks/vc_hero_block');
get_template_part('vc_blocks/vc_hero_slider_block');
get_template_part('vc_blocks/vc_hero_video_slider_block');
get_template_part('vc_blocks/vc_page_title_block');
get_template_part('vc_blocks/vc_alert_block');
get_template_part('vc_blocks/vc_skill_bar_block');
get_template_part('vc_blocks/vc_feature_list_block');
get_template_part('vc_blocks/vc_tabs_block');
get_template_part('vc_blocks/vc_toggles_block');
get_template_part('vc_blocks/vc_pricing_table_block');
get_template_part('vc_blocks/vc_icon_box_block');
get_template_part('vc_blocks/vc_video_block');
get_template_part('vc_blocks/vc_video_background_block');
get_template_part('vc_blocks/vc_instagram_block');
get_template_part('vc_blocks/vc_flickr_block');
get_template_part('vc_blocks/vc_twitter_block');
get_template_part('vc_blocks/vc_clients_block');
get_template_part('vc_blocks/vc_team_block');
get_template_part('vc_blocks/vc_text_image_block');
get_template_part('vc_blocks/vc_text_images_block');
get_template_part('vc_blocks/vc_testimonials_block');
get_template_part('vc_blocks/vc_title_card_block');
get_template_part('vc_blocks/vc_resume_block');
get_template_part('vc_blocks/vc_simple_social_icon_block');
get_template_part('vc_blocks/vc_masonry_services_block');
get_template_part('vc_blocks/vc_menu_block');
get_template_part('vc_blocks/vc_embed_block');
get_template_part('vc_blocks/vc_tour_date_block');
get_template_part('vc_blocks/vc_big_social_block');
get_template_part('vc_blocks/vc_call_to_action_block');
get_template_part('vc_blocks/vc_sharing_block');
get_template_part('vc_blocks/vc_modal_block');
get_template_part('vc_blocks/vc_image_carousel_block');
get_template_part('vc_blocks/vc_half_carousel_block');
get_template_part('vc_blocks/vc_process_carousel_block');
get_template_part('vc_blocks/vc_counter_block');
get_template_part('vc_blocks/vc_image_tile_block');
get_template_part('vc_blocks/vc_image_caption_block');

/**
 * Add Pages to VC Template system
 */
if(!( function_exists('ebor_classic_1_template') )){
function ebor_classic_1_template($data){
    $template               = array();
    $template['name']       = 'Classic Homepage 1';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/classic.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_slider][foundry_slider_content image="960"]
        <h1 class="mb40 mb-xs-16 large" style="text-align: center;">Sleek, Intuitive &amp; Performant,
        It's your design toolkit.</h1>
        <h6 class="uppercase mb16" style="text-align: center;">A PERFORMANCE FOCUSSED TEMPLATE.</h6>
        <p class="lead mb40" style="text-align: center;">Build beautiful, contemporary sites in just moments
        with Foundry and Visual Composer.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">START EXPLORING</a></p>
        [/foundry_slider_content][foundry_slider_content image="961"]
        <h1 class="mb40 mb-xs-16 large" style="text-align: center;">Foundry brings your content to life in stunning clarity</h1>
        <h6 class="uppercase mb16" style="text-align: center;">A COMPLETE BLOCK-BASED SOLUTION</h6>
        <p class="lead mb40" style="text-align: center;">Build beautiful, contemporary sites in just moments
        with Foundry and Visual Composer.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-white" href="#">START EXPLORING</a></p>
        [/foundry_slider_content][/foundry_slider][/vc_column][/vc_row][vc_row parallax="" parallax_image=""][vc_column][vc_row_inner][vc_column_inner width="1/6"][/vc_column_inner][vc_column_inner width="2/3"][vc_column_text]
        <h1 style="text-align: center;">Sleek, Flexible &amp; Stylish.</h1>
        <p style="text-align: center;">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements. Whether promoting a product, service or portfolio - Foundry's unique and flexible style has you covered.</p>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/6"][/vc_column_inner][/vc_row_inner][foundry_text_image layout="shadow-left" image="166"][vc_column_text]
        <h3>Build a slick, modern site faster than ever</h3>
        Foundry is your complete design toolkit, built from the ground up to be flexible, extensible and stylish. Building slick, contemporary sites has never been this easy!
        
        <a class="btn btn-lg" href="#">EXPLORE FOUNDRY</a>[/vc_column_text][/foundry_text_image][vc_empty_space height="12px"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column][vc_column_text]
        <h3 style="text-align: center;">Foundry gives you the flexibility to build your site using purpose-made content blocks.</h3>
        [/vc_column_text][vc_empty_space][vc_row_inner][vc_column_inner width="1/2"][foundry_icon_box icon="ti-view-grid" title="EXPERT, MODULAR DESIGN"]
        <p style="text-align: center;">Customers love our block-based approach to template building, <br class="hidden-sm" />it makes assembling beautiful pages fast and enjoyable, leaving <br class="hidden-sm" />more time to craft your perfect layout.</p>
        [/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/2"][foundry_icon_box icon="ti-heart" title="FLEXIBILITY FOR DEVELOPERS"]
        <p style="text-align: center;">We haven't forgotten developers, that's why we've built Foundry <br class="hidden-sm" />from the ground-up as a powerful, easy to understand framework <br class="hidden-sm" />with a particular focus on code readability.</p>
        [/foundry_icon_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-right" image="386"][vc_column_text]
        <h3 class="mb40 mb-xs-16">Get started fast with one of our unique, pre-built concepts.</h3>
        <p class="lead mb40">We've built 10 fresh and distinct concepts to showcase Foundry's adaptability for almost any purpose.</p>
        [/vc_column_text][foundry_testimonial_carousel pppage="1" layout="boxed" type="boxed"][/foundry_text_image][/vc_column][/vc_row][vc_row css=".vc_custom_1435852031922{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home7.jpg?id=388) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">People just like you are already loving Foundry</h3>
        [/vc_column_text][foundry_testimonial_carousel][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_padding="pb0"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h2 class="mb64 mb-xs-24" style="text-align: center;">Flexible, Adaptable &amp; Timeless.</h2>
        [/vc_column_text][foundry_tabs type="icon-tabs"][foundry_tabs_content icon="ti-layers" title="History"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.[/foundry_tabs_content][foundry_tabs_content icon="ti-package" title="Approach"]Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?[/foundry_tabs_content][foundry_tabs_content icon="ti-stats-up" title="Culture"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.[/foundry_tabs_content][foundry_tabs_content icon="ti-layout-media-center-alt" title="Method"]Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?[/foundry_tabs_content][/foundry_tabs][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_vertical_align="yes"][vc_column width="7/12"][foundry_video_popup image="106" webm="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.webm" mpfour="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.mp4" ogv="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.ogv"][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="4/12"][vc_column_text]
        <h3>Design that looks less 'theme' and more you.</h3>
        Foundry offers you the modularity and ease-of-use of a template with the style and aesthetic of contemporary, bespoke web design.[/vc_column_text][/vc_column][/vc_row][vc_row parallax="" parallax_image=""][vc_column][vc_column_text]
        <h3 style="text-align: center;">Get all this and more by purchasing
        a copy of Foundry today.</h3>
        [/vc_column_text][vc_empty_space height="52px"][foundry_masonry_services][foundry_masonry_services_content title="80+" subtitle="Page Templates"]Pre-made WordPress page templates including fully realized shop, blog and portfolio layouts.[/foundry_masonry_services_content][foundry_masonry_services_content title="Infinite" subtitle="Layout Possibilites"]With tons of purpose-built content blocks, colors and fonts, Foundry presents a mind-boggling number of combinations. Test drive the builder now![/foundry_masonry_services_content][foundry_masonry_services_content title="Concepts" subtitle="Kickstart Your Projects"]Fresh and unique concepts included out of the box. From portfolio to property showcase, Foundry's adaptable look is perfect for your next project.[/foundry_masonry_services_content][foundry_masonry_services_content title="One / Multi" subtitle="Suit yourself"]Capabilities for one and multi-page are built right in. Create a one page scrolling site with ease in Visual Composer.[/foundry_masonry_services_content][foundry_masonry_services_content title="Page Builder" subtitle="Intuitive &amp; Powerful"]We've worked hard to bring you a page builder that speeds up your workflow, leaving more time for your to experiment with layout combinations.[/foundry_masonry_services_content][foundry_masonry_services_content title="Support" subtitle="Timely &amp; Personable"]Receive included support with your purchase via our dedicated support forum. We aim to assist you in plain English as quickly as possible.[/foundry_masonry_services_content][/foundry_masonry_services][/vc_column][/vc_row][vc_row css=".vc_custom_1435849636296{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home2.jpg?id=364) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">27,000+</h1>
        <h6 class="uppercase" style="text-align: center;">Customers using our themes</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">Layout potential using Foundry</h6>
        [/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">Authentic, handcrafted design that gives your
        site subtle, confident appeal.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">Check Out The Demos</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_classic_1_template' );
}

if(!( function_exists('ebor_classic_2_template') )){
function ebor_classic_2_template($data){
    $template               = array();
    $template['name']       = 'Classic Homepage 2';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/classic.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-video-bottom" image="173" embed="https://vimeo.com/25737856"]
        <h1 class="mb16" style="text-align: center;">Foundry is a complete design <br class="hidden-sm" />toolkit, perfect for your next project</h1>
        <h6 class="uppercase mb32" style="text-align: center;">MODULAR DESIGN FOR ABSOLUTE FREEDOM.</h6>
        [/foundry_hero][/vc_column][/vc_row][vc_row parallax="" parallax_image=""][vc_column][foundry_image_carousel][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="988"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][/foundry_image_carousel][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_portfolio pppage="3" type="full-grid-3col" show_filter="No"][/vc_column][/vc_row][vc_row parallax="" parallax_image=""][vc_column][vc_column_text]
        <h3 style="text-align: center;">Our Expertise</h3>
        [/vc_column_text][vc_empty_space][vc_row_inner][vc_column_inner width="1/12"]
        [/vc_column_inner][vc_column_inner width="5/12"][foundry_icon_box icon="ti-layers" layout="large-left-top" title="Modular Design"]
        
        With a plethora of purpose-built content blocks, colors and fonts, Foundry presents a mind-boggling number of combinations. Test drive the builder now!
        
        [/foundry_icon_box][foundry_icon_box icon="ti-package" layout="large-left-top" title="Unique Concepts"]
        
        10 Fresh and unique concepts included out of the box. From portfolio to property showcase, Foundry's adaptable look is perfect for your next project.
        
        [/foundry_icon_box][/vc_column_inner][vc_column_inner width="5/12"][foundry_icon_box icon="ti-gallery" layout="large-left-top" title="Silky Parallax"]
        
        We've built a buttery smooth parallax scrolling experience with a heavy focus on performance. Extensively tested across a range of browser and mouse types.
        
        [/foundry_icon_box][foundry_icon_box icon="ti-infinite" layout="large-left-top" title="Infinite Possibility"]
        
        With over 100 pre-made HTML templates included, it's easier than ever to find a look that suits you. If not, just create your own with Variant Page Builder!
        
        [/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/12"]
        [/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1435848006797{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home-2-5.jpg?id=347) !important;}"][vc_column width="1/6"]
        [/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="mb8" style="text-align: center;">Subscribe for a monthly roundup of best bits.</h3>
        <p style="text-align: center;">Don't worry, we hate spam too - that's why we only send out monthly emails.</p>
        [/vc_column_text][contact-form-7 id="274"][foundry_clients pppage="4" layout="static" filter="13"][/vc_column][vc_column width="1/6"]
        [/vc_column][/vc_row][vc_row parallax="" parallax_image=""][vc_column width="1/12"]
        [/vc_column][vc_column width="10/12"][vc_column_text]
        <h3 style="text-align: center;">A team of friendly creatives combining
        design and development.</h3>
        <p class="mb0" style="text-align: center;">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements. Whether promoting a product, service or portfolio - Foundry's unique and flexible style has you covered.</p>
        [/vc_column_text][vc_empty_space][vc_single_image image="300" img_size="full" alignment="center"][vc_empty_space][foundry_tabs][foundry_tabs_content title="History"]
        
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.
        
        [/foundry_tabs_content][foundry_tabs_content title="Approach"]
        
        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
        
        [/foundry_tabs_content][foundry_tabs_content title="Culture"]
        
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.
        
        [/foundry_tabs_content][foundry_tabs_content title="Method"]
        
        Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
        
        [/foundry_tabs_content][/foundry_tabs][/vc_column][vc_column width="1/12"]
        [/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column][vc_column_text]
        <h3 style="text-align: center;">Latest Posts</h3>
        [/vc_column_text][vc_empty_space height="52px"][foundry_blog pppage="3"][/vc_column][/vc_row][vc_row css=".vc_custom_1435849636296{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home2.jpg?id=364) !important;}"][vc_column width="1/6"]
        [/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">27,000+</h1>
        <h6 class="uppercase" style="text-align: center;">Customers using our themes</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">Layout potential using Foundry</h6>
        [/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">Authentic, handcrafted design that gives your
        site subtle, confident appeal.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">Check Out The Demos</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"]
        [/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_classic_2_template' );
}

if(!( function_exists('ebor_classic_3_template') )){
function ebor_classic_3_template($data){
    $template               = array();
    $template['name']       = 'Classic Homepage 3';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/classic.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-video-bottom" image="173" embed="https://vimeo.com/25737856"]
        <h1 class="mb16" style="text-align: center;">Foundry is a complete design <br class="hidden-sm" />toolkit, perfect for your next project</h1>
        <h6 class="uppercase mb32" style="text-align: center;">MODULAR DESIGN FOR ABSOLUTE FREEDOM.</h6>
        [/foundry_hero][/vc_column][/vc_row][vc_row][vc_column width="1/3"][foundry_icon_box icon="ti-layers" layout="large-circular-centered" title="Modular Design"]With a plethora of purpose-built content blocks, colors and fonts, Foundry presents a mind-boggling number of combinations. Test drive the builder now![/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-image" layout="large-circular-centered" title="Silky Parallax"]We've built a buttery smooth parallax scrolling experience with a heavy focus on performance. Extensively tested across a range of browser and mouse types.[/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-package" layout="large-circular-centered" title="Unique Concepts"]10 Fresh and unique concepts included out of the box. From portfolio to property showcase, Foundry's adaptable look is perfect for your next project.[/foundry_icon_box][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_text_image layout="box-left" image="310"][vc_column_text]
        <h3>Build a slick, modern site faster than ever before.</h3>
        <p class="mb0">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements. Whether promoting a product, service or portfolio - Foundry's unique and flexible style has you covered.</p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">Built from the ground-up to be the ultimate in flexibility</h3>
        <p class="lead mb0" style="text-align: center;">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements. Whether promoting a product, service or portfolio - Foundry's unique and flexible style has you covered.</p>
        [/vc_column_text][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large">100+</h1>
        Pre-made HTML page templates including fully realized shop, blog and portfolio layouts.[/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large">Elite</h1>
        We're a trusted, elite author who have been featured multiple times on Themeforest.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_text_image layout="box-right" image="432"][vc_column_text]
        <h3>Start building beautiful pages directly in your browser.</h3>
        <p class="mb0">Foundry is your complete design toolkit, built from the ground up to be flexible, extensible and stylish. Building slick, contemporary sites has never been this easy!</p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
        <h3 style="text-align: center;">People like you love Foundry</h3>
        [/vc_column_text][foundry_testimonial_carousel pppage="3" layout="grid"][/vc_column][/vc_row][vc_row css=".vc_custom_1435849636296{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home2.jpg?id=364) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">27,000+</h1>
        <h6 class="uppercase" style="text-align: center;">Customers using our themes</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">Layout potential using Foundry</h6>
        [/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">Authentic, handcrafted design that gives your
        site subtle, confident appeal.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">Check Out The Demos</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_classic_3_template' );
}

if(!( function_exists('ebor_classic_4_template') )){
function ebor_classic_4_template($data){
    $template               = array();
    $template['name']       = 'Classic Homepage 4';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/classic.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-centered-social" image="730"]<img class="aligncenter wp-image-731 size-medium" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/logo-dark-300x72.png" alt="logo-dark" width="300" height="72" />[/foundry_hero][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
        <h6 class="uppercase fade-half" style="text-align: center;">YOUR DESIGN TOOLKIT</h6>
        <h3 class="mb0" style="text-align: center;">Foundry is your ultimate design toolkit. Use stylish pre-built blocks to assemble your perfect layout.</h3>
        [/vc_column_text][foundry_portfolio pppage="4" type="grid-2col" show_filter="No"][/vc_column][/vc_row][vc_row css=".vc_custom_1436195043899{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home21.jpg?id=456) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
        <h6 class="uppercase fade-half" style="text-align: center;">Our Expertise</h6>
        [/vc_column_text][vc_empty_space][vc_row_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-layers" title="Silky Parallax"]
        <p style="text-align: center;">We've built a buttery smooth parallax scrolling experience with a heavy focus on performance. Extensively tested across a range of browser and mouse types.</p>
        [/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-package" title="Unique Concepts"]
        <p style="text-align: center;">10 Fresh and unique concepts included out of the box. From portfolio to property showcase, Foundry's adaptable look is perfect for your next project.</p>
        [/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-image" title="Modular Design"]
        <p style="text-align: center;">With a plethora of purpose-built content blocks, colors and fonts, Foundry presents a mind-boggling number of combinations. Test drive the builder now!</p>
        [/foundry_icon_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_text_image layout="shadow-left" image="437"][vc_column_text]
        <h3>Build a slick, modern site faster than ever</h3>
        Foundry is your complete design toolkit, built from the ground up to be flexible, extensible and stylish. Building slick, contemporary sites has never been this easy!
        
        <a class="btn" href="#">LEARN MORE</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row css=".vc_custom_1435849636296{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home2.jpg?id=364) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">27,000+</h1>
        <h6 class="uppercase" style="text-align: center;">Customers using our themes</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">Layout potential using Foundry</h6>
        [/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">Authentic, handcrafted design that gives your
        site subtle, confident appeal.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">Check Out The Demos</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_classic_4_template' );
}

if(!( function_exists('ebor_classic_5_template') )){
function ebor_classic_5_template($data){
    $template               = array();
    $template['name']       = 'Classic Homepage 5';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/classic.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_video_background image="243" embed="dmgomCutGqc"]
        <h1 class="large">Your Ultimate
        Design Toolkit</h1>
        <p class="lead mb40 mb-xs-24">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements, perfect for promoting a product, service or portfolio.</p>
        <a class="btn btn-lg btn-white" href="#">START EXPLORING</a>[/foundry_video_background][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="offscreen-right" image="190"][vc_column_text]
        <h1 class="large mb64 mb-xs-24">Slick, Fresh, Flexible, Fun.</h1>
        [/vc_column_text][foundry_icon_box icon="ti-image" layout="small-left" title="Silky Smooth Parallax"]We've built a buttery smooth parallax scrolling experience with a heavy focus on performance.[/foundry_icon_box][foundry_icon_box icon="ti-layers" layout="small-left" title="Modular Design"]With a plethora of purpose-built content blocks, colors and fonts, Foundry presents a mind-boggling number of combinations.[/foundry_icon_box][/foundry_text_image][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image image="441"][vc_column_text]
        <h2>Build a slick, modern
        site faster than ever</h2>
        Foundry is your complete design toolkit, built from the ground up to be flexible, extensible and stylish. Building slick, contemporary sites has never been this easy!
        
        <a class="btn btn-lg" href="#">EXPLORE FOUNDRY</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/4"][vc_column_text]<img class="aligncenter size-full wp-image-448" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/avatar51.png" alt="avatar5" width="120" height="120" />[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4"][vc_column_text]<img class="aligncenter size-full wp-image-447" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/avatar22.png" alt="avatar2" width="120" height="120" />[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4"][vc_column_text]<img class="aligncenter size-full wp-image-446" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/avatar41.png" alt="avatar4" width="120" height="120" />[/vc_column_text][/vc_column_inner][vc_column_inner width="1/4"][vc_column_text]<img class="aligncenter size-full wp-image-445" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/avatar11.png" alt="avatar1" width="120" height="120" />[/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h2 style="text-align: center;">Built by professionals, just for you.</h2>
        <p class="mb40 mb-xs-24" style="text-align: center;">Foundry is a remarkably complete template offering you a plethora of handcrafted design elements. Whether promoting a product, service or portfolio - Foundry's unique and flexible style has you covered.</p>
        <p style="text-align: center;"><a class="mb0 btn btn-lg btn-filled" href="#">PURCHASE FOUNDRY</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row css=".vc_custom_1436194382299{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home7.jpg?id=388) !important;}"][vc_column][vc_column_text]
        <h2 class="mb16" style="text-align: center;">There's so much to love</h2>
        <p class="lead mb64" style="text-align: center;">A remarkably versatile template packed with features.</p>
        [/vc_column_text][vc_row_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-package" layout="large-centered-boxed" title="Unique Concepts"]10 Fresh and unique concepts included out of the box. From portfolio to property showcase, Foundry's adaptable look is perfect for your next project.[/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-infinite" layout="large-centered-boxed" title="Infinite Potential"]With over 100 pre-made templates included, it's easier than ever to find a look that suits you. If not, just create your own with Visual Composer![/foundry_icon_box][/vc_column_inner][vc_column_inner width="1/3"][foundry_icon_box icon="ti-heart" layout="large-centered-boxed" title="Developer Friendly"]We haven't forgotten developers, that's why we've built Foundry from the ground-up as a powerful, easy to understand framework, with a focus on code readability.[/foundry_icon_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
        <h3 class="mb16" style="text-align: center;">The Right Plan For You</h3>
        <p class="lead mb64" style="text-align: center;">Foundry is your complete design toolkit, built from the ground up
        to be flexible, extensible and stylish.</p>
        [/vc_column_text][vc_row_inner][vc_column_inner width="1/3"][foundry_pricing_table amount="$12" button_text="Get Started" title="Starter" small="Per Month" button_url="#"]
        <ul>
        	<li><strong>10</strong> unique logins</li>
        	<li><strong>Fully Secure</strong> online backup</li>
        	<li><strong>One Year</strong> round the clock support</li>
        	<li><strong>FREE</strong> complimentary lanyard</li>
        </ul>
        [/foundry_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][foundry_pricing_table amount="$25" button_text="Get Started" layout="boxed" title="Value" small="Per Month" button_url="#"]
        <ul>
        	<li><strong>10</strong> unique logins</li>
        	<li><strong>Fully Secure</strong> online backup</li>
        	<li><strong>One Year</strong> round the clock support</li>
        	<li><strong>FREE</strong> complimentary lanyard</li>
        </ul>
        [/foundry_pricing_table][/vc_column_inner][vc_column_inner width="1/3"][foundry_pricing_table amount="$99" button_text="Get Started" title="Enterprise" small="Per Month" button_url="#"]
        <ul>
        	<li><strong>10</strong> unique logins</li>
        	<li><strong>Fully Secure</strong> online backup</li>
        	<li><strong>One Year</strong> round the clock support</li>
        	<li><strong>FREE</strong> complimentary lanyard</li>
        </ul>
        [/foundry_pricing_table][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1435849636296{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/home2.jpg?id=364) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">27,000+</h1>
        <h6 class="uppercase" style="text-align: center;">Customers using our themes</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="1/2"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">Layout potential using Foundry</h6>
        [/vc_column_text][/vc_column_inner][/vc_row_inner][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">Authentic, handcrafted design that gives your
        site subtle, confident appeal.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">Check Out The Demos</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_classic_5_template' );
}

if(!( function_exists('ebor_adventure_travel_template') )){
function ebor_adventure_travel_template($data){
    $template               = array();
    $template['name']       = 'Adventure Travel';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/adventure.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-video-bottom-left" image="520" embed="https://vimeo.com/25737856"]
        <h6 class="uppercase">Adventure Travel With Heart</h6>
        <p class="lead"><img class="alignnone wp-image-522 size-large" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/vent1-1024x439.png" alt="vent1" width="1024" height="439" />
        Take a vacation on the wild side with Foundry
        Adventure Tours and never look at life the same.</p>
        [/foundry_hero][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="uppercase mb40 mb-xs-24" style="text-align: center;">SMASH YOUR COMFORT ZONE</h3>
        <p class="lead mb64" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</p>
        <p class="lead mb64" style="text-align: center;"><img class="aligncenter size-medium wp-image-463" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/signature-300x116.png" alt="signature" width="300" height="116" /></p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_vertical_align="yes"][vc_column width="5/12"][vc_column_text]
        <h2 class="uppercase mb16" style="text-align: center;">#FOUNDRYLIFE</h2>
        <h6 class="uppercase" style="text-align: center;">FOLLOW US FOR UPDATES</h6>
        <p class="lead mb0" style="text-align: center;">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</p>
        [/vc_column_text][/vc_column][vc_column width="7/12"][foundry_instagram title="colerise"][/vc_column][/vc_row][vc_row foundry_padding="pt64 pb64"][vc_column][vc_column_text]
        <h6 class="uppercase mb0" style="text-align: center;">Popular Foundry Tours</h6>
        [/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1436270152577{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/vent3.jpg?id=510) !important;}"][vc_column][vc_column_text]
        <h2 class="uppercase mb8" style="text-align: center;">TREK NEPAL</h2>
        <p class="lead mb40" style="text-align: center;">A brief description of the tour.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-white mb0" href="#">EXPLORE TOUR</a></p>
        [/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1436270188200{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/vent4.jpg?id=511) !important;}"][vc_column][vc_column_text]
        <h2 class="uppercase mb8" style="text-align: center;">EXPLORE ANTELOPE CANYON</h2>
        <p class="lead mb40" style="text-align: center;">A brief description of the tour.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-white mb0" href="#">EXPLORE TOUR</a></p>
        [/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1436270210307{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/vent5.jpg?id=512) !important;}"][vc_column][vc_column_text]
        <h2 class="uppercase mb8" style="text-align: center;">SCALE SIERRA NEVADA</h2>
        <p class="lead mb40" style="text-align: center;">A brief description of the tour.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-white mb0" href="#">EXPLORE TOUR</a></p>
        [/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-left" image="514"][vc_column_text]
        <h3 class="uppercase">BOOK YOUR NEXT
        ADVENTURE TODAY.</h3>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
        do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        <ul class="bullets mb40 mb-xs-24">
        	<li>All Inclusive Packages</li>
        	<li>Multi-Night Stays</li>
        	<li>Equipment Provided</li>
        </ul>
        <a class="btn btn-lg bg-dark mb0" href="#">BOOK A TOUR</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="3/12"][/vc_column][vc_column width="6/12"][vc_column_text]<img class="size-full wp-image-516 aligncenter" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/vent2.png" alt="vent2" width="1558" height="381" />
        <h5 class="uppercase" style="text-align: center;">EXCLUSIVE OFFERS, TRAVEL TIPS &amp; MORE</h5>
        [/vc_column_text][contact-form-7 id="274"][vc_column_text]
        <p style="text-align: center;">*Newsletters are sent bi-monthly</p>
        [/vc_column_text][/vc_column][vc_column width="3/12"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_adventure_travel_template' );
}

if(!( function_exists('ebor_app_landing_template') )){
function ebor_app_landing_template($data){
    $template               = array();
    $template['name']       = 'App Landing';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/app.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-app" shortcode="274" image="588"]
        <h1 class="large" style="text-align: center;">Present your app, easily.</h1>
        <p class="lead" style="text-align: center;">The perfect layout for presenting landing pages for apps
        or software in contemporary style.</p>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column width="2/12"][/vc_column][vc_column width="4/12"][foundry_icon_box icon="ti-medall" layout="small-left" title="Stay Organized"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.[/foundry_icon_box][foundry_icon_box icon="ti-layers" layout="small-left" title="Silky Parallax"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.[/foundry_icon_box][/vc_column][vc_column width="4/12"][foundry_icon_box icon="ti-ruler-alt" layout="small-left" title="Get Creative"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.[/foundry_icon_box][foundry_icon_box icon="ti-heart" layout="small-left" title="Elite Author Item"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.[/foundry_icon_box][/vc_column][vc_column width="2/12"][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="mb40 mb-xs-24" style="text-align: center;">A landing page for the next generation.</h3>
        <p class="lead" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi.</p>
        [/vc_column_text][foundry_video_popup image="530" webm="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.webm" mpfour="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.mp4" ogv="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/video.ogv"][foundry_clients layout="static" filter="13"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="offscreen-right" image="555"][vc_column_text]
        <h3 class="mb40 mb-xs-16">Use the pre-built text and image variations to spruik cool features.</h3>
        <p class="lead mb40">We've built three distinct image and text combinations for you to showcase the features of your product or service.</p>
        [/vc_column_text][foundry_testimonial_carousel pppage="1" layout="boxed"][/foundry_text_image][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image image="559"][vc_column_text]
        <h3 class="mb40 mb-xs-16">Combine different blocks together to form your perfect layout.</h3>
        <p class="lead mb40">We've built three distinct image and text combinations for you to showcase the features of your product or service.</p>
        [/vc_column_text][foundry_icon_box icon="ti-user" layout="small-left" title="Built for you"][/foundry_icon_box][foundry_icon_box icon="ti-package" layout="small-left" title="Incredible Value"][/foundry_icon_box][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_icons="yes"][vc_column][vc_column_text]
        <h1 class="thin mb80 mb-xs-24" style="text-align: center;">Pricing? That's easy.</h1>
        [/vc_column_text][vc_row_inner][vc_column_inner width="2/12"][/vc_column_inner][vc_column_inner width="4/12"][foundry_pricing_table amount="$12" button_text="Get Started" title="One User" small="Per Month" button_url="#"]
        <p style="text-align: center;">30 Day Free Trial
        No Credit Card Required</p>
        [/foundry_pricing_table][/vc_column_inner][vc_column_inner width="4/12"][foundry_pricing_table amount="$29" button_text="Get Started" layout="emphasis" title="Unlimited Users" small="Per Month" button_url="#"]
        <p style="text-align: center;">30 Day Free Trial
        No Credit Card Required</p>
        [/foundry_pricing_table][/vc_column_inner][vc_column_inner width="2/12"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1436454091879{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/app2.jpg?id=585) !important;}"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h3 style="text-align: center;">People just like you are already loving Foundry</h3>
        [/vc_column_text][foundry_testimonial_carousel][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column][vc_column_text]
        <h4 class="uppercase" style="text-align: center;">A DESIGN TO BE PROUD OF</h4>
        [/vc_column_text][vc_row_inner][vc_column_inner width="2/12"][/vc_column_inner][vc_column_inner width="4/12"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">10,000+</h1>
        <h6 class="uppercase" style="text-align: center;">CUSTOMERS USING OUR TEMPLATES</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="4/12"][vc_column_text]
        <h1 class="large mb8" style="text-align: center;">Limitless</h1>
        <h6 class="uppercase" style="text-align: center;">LAYOUT POTENTIAL USING FOUNDRY</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="2/12"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h3 style="text-align: center;">Start building more beautiful pages today.</h3>
        [/vc_column_text][contact-form-7 id="274"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_app_landing_template' );
}

if(!( function_exists('ebor_architecture_template') )){
function ebor_architecture_template($data){
    $template               = array();
    $template['name']       = 'Architecture';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/architect.png';
    $template['content']    = <<<CONTENT
        [vc_row full_height="yes" css=".vc_custom_1439542065851{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/arch11.jpg?id=1161) !important;}"][vc_column][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pb0"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="uppercase" style="text-align: center;">CREATING VIBRANT
        SPACES &amp; COMMUNITES</h3>
        <p style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column width="2/12"][/vc_column][vc_column width="4/12"][foundry_icon_box layout="large-centered-boxed"]
        <h1 class="large" style="text-align: center;">64</h1>
        <h5 class="uppercase" style="text-align: center;">AWARD WINNING PROJECTS</h5>
        [/foundry_icon_box][/vc_column][vc_column width="4/12"][foundry_icon_box layout="large-centered-boxed"]
        <h1 class="large" style="text-align: center;">#3</h1>
        <h5 class="uppercase" style="text-align: center;">ARCHITECTS AUSTRALIA</h5>
        [/foundry_icon_box][/vc_column][vc_column width="2/12"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="uppercase color-primary mb40 mb-xs-24" style="text-align: center;">A PLACE TO CALL HOME</h3>
        <p class="lead" style="text-align: center;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][foundry_tabs type="text-tabs no-border"][foundry_tabs_content title="History"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.[/foundry_tabs_content][foundry_tabs_content title="Approach"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.
         
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.[/foundry_tabs_content][foundry_tabs_content title="Culture"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.[/foundry_tabs_content][/foundry_tabs][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_portfolio pppage="4" type="full-grid-2col" show_filter="No"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="uppercase color-primary mb40 mb-xs-24" style="text-align: center;">MEET OUR TEAM</h3>
        <p class="lead" style="text-align: center;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column][foundry_team pppage="6" layout="box" filter="15"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column][foundry_twitter title="628493843713904640"][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-left" image="481"][vc_column_text]
        <h3 class="uppercase color-primary">GET IN TOUCH</h3>
        <p class="lead">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
         
         
        <hr />
         
        438 Marine Parade
        Elwood, Victoria
        P.O Box 3184
         
        <strong>E:</strong> hello@foundry.net
        <strong>P:</strong> +614 3948 2726[/vc_column_text][/foundry_text_image][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_architecture_template' );
}

if(!( function_exists('ebor_capital_firm_template') )){
function ebor_capital_firm_template($data){
    $template               = array();
    $template['name']       = 'Capital Firm';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/capital.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-button" image="548" button_text="Plan A Project" button_url="#"]
        <h1 class="thin mb0" style="text-align: center">A San Francisco based venture capital firm funding driven and innovative entrepenuers.</h1>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column][vc_column_text]
        <h6 class="uppercase">About Foundry</h6>
        
        <hr />
        
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column][vc_column_text]
        <h1 class="thin">Investing in innovative technology companies since '88</h1>
        <p class="lead">Foundry partners with passionate entrepreneurs and startups to build
        enduring, era-defining companies that define their categories.</p>
        [/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_column_text]
        <h1 class="large color-primary mb0">140+</h1>
        <h5 class="color-primary mb0">Profitable M&amp;A Ventures</h5>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
        <h1 class="large color-primary mb0">$1.2b+</h1>
        <h5 class="color-primary mb0">Capital Invested</h5>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
        <h1 class="large color-primary mb0">4/5</h1>
        <h5 class="color-primary mb0">Companies Yielding Profit</h5>
        [/vc_column_text][/vc_column][/vc_row][vc_row css=".vc_custom_1436271187121{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/capital3.jpg?id=530) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pb0"][vc_column][vc_column_text]
        <h6 class="uppercase">PORTFOLIO SECTORS</h6>
        
        <hr />
        
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pb0"][vc_column][vc_column_text]
        <h1 class="thin">Focused, Diverse, Disruptive.</h1>
        <p class="lead">Foundry maintains a portfolio spanning multiple sectors. Disruptive
        technology is our unifying theme.</p>
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column width="1/4"][foundry_icon_box icon="ti-pulse" layout="large-left-top" title="Health Monitoring"]
        <ul>
        	<li>Medibank Private</li>
        	<li>Fit Bit</li>
        	<li>GoPro LTD.</li>
        	<li>Adventours</li>
        	<li>Airbnb</li>
        	<li>Chemist Warehouse</li>
        </ul>
        [/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-map-alt" layout="large-left-top" title="Location Services"]
        <ul>
        	<li>Find My iPhone</li>
        	<li>FourSquare</li>
        	<li>Periscope</li>
        	<li>Crackle</li>
        	<li>Urban Spoon</li>
        	<li>Yelp</li>
        </ul>
        [/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-mobile" layout="large-left-top" title="Social Data"]
        <ul>
        	<li>Life Invader</li>
        	<li>Twitter</li>
        	<li>Google AdWords</li>
        	<li>Track My Day</li>
        	<li>SocialScape</li>
        	<li>Tinder</li>
        </ul>
        [/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-harddrives" layout="large-left-top" title="Cloud Enterprise"]
        <ul>
        	<li>Box</li>
        	<li>Sunny Cloudy</li>
        	<li>Cumulii</li>
        	<li>Precipitatr</li>
        	<li>Nimb.us</li>
        </ul>
        [/foundry_icon_box][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-right" image="533"][vc_column_text]
        <h3 class="mb32">Foundry provided us the tools, capital and expertise we needed to launch Lactick to reach a global audience.</h3>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column][vc_column_text]
        <h6 class="uppercase">THE FOUNDRY TEAM</h6>
        
        <hr />
        
        [/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][foundry_team layout="grid-small" filter="15"][/vc_column][/vc_row][vc_row css=".vc_custom_1436271738213{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/capital4.jpg?id=537) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column][vc_column_text]
        <h6 class="uppercase">UPDATES &amp; INSIGHTS</h6>
        
        <hr />
        
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column width="1/2"][vc_column_text]<a class="h1 thin color-primary inline-block mb24" href="#">@foundrycapital</a>
        <p class="lead">Engagement and sharing knowledge are the cornerstones of our success. Follow us for SV related insights.</p>
        [/vc_column_text][/vc_column][vc_column width="1/2"][/vc_column][/vc_row][vc_row][vc_column][foundry_twitter layout="grid" title="492085717044981760"][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1436272206907{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/overlay.jpg?id=539) !important;}"][vc_column][vc_column_text]
        <h1 class="large mb0" style="text-align: center">See you soon.</h1>
        [/vc_column_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_capital_firm_template' );
}

if(!( function_exists('ebor_music_template') )){
function ebor_music_template($data){
    $template               = array();
    $template['name']       = 'Music';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/music.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-everything" image="734" embed="https://vimeo.com/25737856" button_text="Purchase Music" button_url="#"]
        <h1 class="mb16 large uppercase" style="text-align: center;">F0UNDERS</h1>
        <h5 class="uppercase mb32" style="text-align: center;">NEW EP RESTLESS TUNDRA OUT NOW</h5>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h2 class="uppercase thin mb40 mb-xs-24" style="text-align: center;">A DIFFERENT
        KIND OF SOUND.</h2>
        <p class="mb64 mb-xs-24" style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
        <p style="text-align: center;"><strong>JOE SWANSON</strong> / Vocals, Lead Guitar
        <strong>AMANDA SIMS</strong> / Bass
        <strong>RICK BOHN</strong> / Keyboard</p>
        [/vc_column_text][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][vc_row css=".vc_custom_1436523296747{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/music2.jpg?id=711) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pb0"][vc_column width="1/2"][vc_column_text]
        <h2 class="uppercase mb40 mb-xs-24 text-center" style="text-align: center;">See Us</h2>
        
        <hr class="mb40 mb-xs-24 fade-half" />
        
        [/vc_column_text][foundry_tour_date date="24 Sep" button_url="#" button_text="Get Tickets"]
        <h6 class="uppercase mb0">MELBOURNE, AU</h6>
        Rod Laver Arena[/foundry_tour_date][foundry_tour_date date="28 Sep" button_url="#" button_text="Get Tickets"]
        <h6 class="uppercase mb0">SYDNEY, AU</h6>
        <p class="uppercase mb0">Sydney Opera House</p>
        [/foundry_tour_date][foundry_tour_date date="29 Sep" button_url="#" button_text="Get Tickets"]
        <h6 class="uppercase mb0">SYDNEY, AU</h6>
        <p class="uppercase mb0">Chinese Laundry</p>
        [/foundry_tour_date][foundry_tour_date date="2 Oct" button_url="#" button_text="Get Tickets"]
        <h6 class="uppercase mb0">PERTH, AU</h6>
        <p class="uppercase mb0">Fremantle Stadium</p>
        [/foundry_tour_date][/vc_column][vc_column width="1/2"][vc_column_text]
        <h2 class="uppercase mb40 mb-xs-24 text-center" style="text-align: center;">Hear Us</h2>
        
        <hr class="mb40 mb-xs-24 fade-half" />
        
        [/vc_column_text][foundry_embed title="https://soundcloud.com/jonathanwilson/sets/jonathan-wilson-fanfare"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column][vc_column_text]
        <h2 class="uppercase large mb80 mb-xs-24" style="text-align: center;">FOLLOW US</h2>
        [/vc_column_text][foundry_big_social][foundry_big_social_content icon="ti-instagram" url="#"][foundry_big_social_content icon="ti-facebook" url="#"][foundry_big_social_content icon="ti-soundcloud" url="#"][foundry_big_social_content icon="ti-vimeo-alt" url="#"][/foundry_big_social][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-dark"][vc_column][foundry_instagram layout="full" title="thevaccines"][/foundry_instagram][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_music_template' );
}

if(!( function_exists('ebor_event_seminar_template') )){
function ebor_event_seminar_template($data){
    $template               = array();
    $template['name']       = 'Event & Seminar';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/event.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-video-right" image="741" embed="https://vimeo.com/88883554"]
        <h2 class="mb16">Discussing future trends in
        e-commerce and digital design</h2>
        <h6 class="uppercase mb32">2ND AUGUST MELBOURNE, VICTORIA</h6>
        <a class="btn btn-filled btn-lg mb0" href="#">PURCHASE A TICKET</a>[/foundry_hero][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_column_text]
        <h4 class="uppercase color-primary mb40 mb-xs-24">VISUAL DESIGN</h4>
        <h5>Training user expectations</h5>
        <h5>Emerging UI trends</h5>
        <h5>Reflecting on mobile trends</h5>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
        <h4 class="uppercase color-primary mb40 mb-xs-24">CODE EFFICIENCY</h4>
        <h5>Concepts in Angular</h5>
        <h5>Optimising Grunt Workflows</h5>
        <h5>Demystifying Bower</h5>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
        <h4 class="uppercase color-primary mb40 mb-xs-24">SELLING TECHNIQUE</h4>
        <h5>Better Calls to Action</h5>
        <h5>Understanding the buyer</h5>
        <h5>Tracking user behaviour</h5>
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_padding="pb0"][vc_column width="1/12"][/vc_column][vc_column width="10/12"][vc_column_text]
        <h3 style="text-align: center;">Meet our delightful panel of speakers</h3>
        <p class="lead" style="text-align: center;">A collective of the web's brightest minds gathered in one place to discuss emerging trends.</p>
        [/vc_column_text][foundry_team pppage="6" layout="grid-extra-small"][/vc_column][vc_column width="1/12"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">Interested in speaking at FoundryCon?</h3>
        <p class="mb40 mb-xs-24" style="text-align: center;">We're always looking for talented and passionate speakers keen to contribute to the FoundryCon experience. Past speakers have come from a variety of companies such as Google, Facebook, Vimeo, Dribbble.</p>
        
        <h3 style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">APPLY HERE</a></h3>
        <div style="text-align: center;"><span class="fade-1-4">Now taking applications for 2016</span></div>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row][vc_column width="2/12"][/vc_column][vc_column width="4/12"][vc_column_text]
        <h3>Join us for a day of
        ideas &amp; discussion.</h3>
        <p class="lead mb40">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        [/vc_column_text][foundry_icon_box icon="ti-package" layout="small-left" title="ALL INCLUSIVE PACKAGE"][/foundry_icon_box][foundry_icon_box icon="ti-medall-alt" layout="small-left" title="FOUNDRY CLUB ACCESS"][/foundry_icon_box][/vc_column][vc_column width="4/12"][foundry_pricing_table amount="$89" button_text="Buy Now" layout="emphasis" title="Admit One" small="Per Ticket" button_url="#"]
        <p style="text-align: center;"><a href="http://foundry.mediumra.re/home-event.html#">Contact Us for</a>
        large ticket volumes</p>
        [/foundry_pricing_table][/vc_column][vc_column width="2/12"][/vc_column][/vc_row][vc_row css=".vc_custom_1436538868628{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/06/cover16.jpg?id=128) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">Strap yourself in for ideas</h3>
        <p class="lead" style="text-align: center;">Prepare for a full day of discussion from some of the web's best and brightest.</p>
        [/vc_column_text][foundry_tabs][foundry_tabs_content title="Morning"]
        <h6 class="uppercase mb8 number">9:30AM - 10:30AM</h6>
        <h4>Alice French - E-Commerce &amp; Fashion</h4>
        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
        
        <hr />
        
        &nbsp;
        <h6 class="uppercase mb8 number">11:00AM - 12:00PM</h6>
        <h4>Luke Hess - Better Selling Technique</h4>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
        
        <hr />
        
        [/foundry_tabs_content][foundry_tabs_content title="Afternoon"]
        <h6 class="uppercase mb8 number">1:30PM - 02:30PM</h6>
        <h4>Porter Ricks - Abstract Angulr</h4>
        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
        
        <hr />
        
        &nbsp;
        <h6 class="uppercase mb8 number">3:00PM - 4:00PM</h6>
        <h4>Jesse Tare - Producing Spacious Beats</h4>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
        
        <hr />
        
        [/foundry_tabs_content][foundry_tabs_content title="Evening"]
        <h6 class="uppercase mb8 number">5:30PM - 06:30PM</h6>
        <h4>Kane Thompson - Blasting Pesky Bugs</h4>
        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
        
        <hr />
        
        &nbsp;
        <h6 class="uppercase mb8 number">7:00PM - 08:00PM</h6>
        <h4>Grace Adler - Tolerating Canned Laughter</h4>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni
        
        <hr />
        
        [/foundry_tabs_content][/foundry_tabs][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column][foundry_twitter title="492085717044981760"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column][vc_column_text]
        <h2 class="uppercase  mb16" style="text-align: center;">#FOUNDRYCON</h2>
        <h6 class="uppercase" style="text-align: center;">FOLLOW US FOR UPDATES</h6>
        [/vc_column_text][foundry_instagram title="awwwards"][/foundry_instagram][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary" foundry_padding="pt64 pb64"][vc_column][foundry_call_to_action_block title="Purchase Early-Bird tickets for 20% off" url="#" button_text="Purchase Tickets"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_event_seminar_template' );
}

if(!( function_exists('ebor_ken_burns_template') )){
function ebor_ken_burns_template($data){
    $template               = array();
    $template['name']       = 'Ben Kurns';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/kenburns.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_slider type="ken"][foundry_slider_content type="ken" image="879" title="Ben Kurns" subtitle="Landscape Photographer" button_text="#" button_url="Contact Me"]To photograph is to hold one's breath, when all faculties converge to capture fleeting reality. It's at that precise moment that mastering an image becomes a great physical and intellectual joy.[/foundry_slider_content][foundry_slider_content type="ken" image="880" title="Ben Kurns" subtitle="Landscape Photographer" button_text="#" button_url="Contact Me"]To photograph is to hold one's breath, when all faculties converge to capture fleeting reality. It's at that precise moment that mastering an image becomes a great physical and intellectual joy.[/foundry_slider_content][foundry_slider_content type="ken" image="881" title="Ben Kurns" subtitle="Landscape Photographer" button_text="#" button_url="Contact Me"]To photograph is to hold one's breath, when all faculties converge to capture fleeting reality. It's at that precise moment that mastering an image becomes a great physical and intellectual joy.[/foundry_slider_content][/foundry_slider][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_ken_burns_template' );
}

if(!( function_exists('ebor_photography_template') )){
function ebor_photography_template($data){
    $template               = array();
    $template['name']       = 'Photography';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/photog.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-left" image="873"]
        <h4 class="uppercase bold mb0">MAYER RAFFERTY</h4>
        <h4 class="uppercase">PHOTOGRAPHER</h4>
        [/foundry_hero][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_portfolio pppage="2" type="full-grid-2col"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24" style="text-align: center;">SUBSCRIBE FOR UPDATES</h4>
        [/vc_column_text][contact-form-7 id="274"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_photography_template' );
}

if(!( function_exists('ebor_portfolio_template') )){
function ebor_portfolio_template($data){
    $template               = array();
    $template['name']       = 'Portfolio';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/portfolio.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero image="592"]
        <h1 class="uppercase large mb8" style="text-align: center;"><strong>ALICE</strong>COLE</h1>
        <h5 class="mb0" style="text-align: center;">Dutch Interactive Designer</h5>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_padding="pt64 pb64"][vc_column][vc_column_text]
        <h6 class="uppercase mb0" style="text-align: center;">Selected Projects</h6>
        [/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_portfolio pppage="6" type="full-masonry-3col"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_portfolio_template' );
}

if(!( function_exists('ebor_property_listing_template') )){
function ebor_property_listing_template($data){
    $template               = array();
    $template['name']       = 'Property Listing';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/property.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-button-alt" image="564" button_text="Register Interest" button_url="#"]
        <h1 class="large uppercase mb16" style="text-align: center;">53 HOPETOUN RD.</h1>
        <h5 class="uppercase mb0" style="text-align: center;">CONTEMPORARY LIVING IN THE HEART OF TOORAK</h5>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_vertical_align="yes"][vc_column width="5/12"][vc_column_text]
        <h2 class="uppercase color-primary">THE PERFECT PLACE TO CALL HOME</h2>
        
        <hr />
        
        Adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.[/vc_column_text][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="3/12"][foundry_icon_box layout="large-centered-bordered" title="2"]
        <h5 class="uppercase" style="text-align: center;">Living</h5>
        [/foundry_icon_box][foundry_icon_box layout="large-centered-bordered" title="3"]
        <h5 class="uppercase" style="text-align: center;">Parking</h5>
        [/foundry_icon_box][/vc_column][vc_column width="3/12"][foundry_icon_box layout="large-centered-bordered" title="5"]
        <h5 class="uppercase" style="text-align: center;">Bedrooms</h5>
        [/foundry_icon_box][foundry_icon_box layout="large-centered-bordered" title="4"]
        <h5 class="uppercase" style="text-align: center;">Bathrooms</h5>
        [/foundry_icon_box][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][vc_column_text]
        
        [gallery layout="slider" ids="565,566,567"]
        
        [/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][foundry_text_image layout="shadow-left" image="573"][vc_column_text]
        <h2 class="uppercase color-primary">PRIME LOCATION</h2>
        <h5 class="uppercase">MELBOURNE'S SOPHISTICATED INNER SOUTH-EAST</h5>
        
        <hr />
        <p class="mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row][vc_column][foundry_text_image layout="shadow-right" image="574"][vc_column_text]
        <h2 class="uppercase color-primary">THE PERFECT ENTERTAINER</h2>
        <h5 class="uppercase">SOPHISTICATED, CLEVER, BUILT FOR SOCIALISING</h5>
        
        <hr />
        <p class="mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.</p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row css=".vc_custom_1436452648675{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/prop6.jpg?id=577) !important;}"][vc_column width="3/12"][/vc_column][vc_column width="6/12"][vc_column_text]
        <h3 class="uppercase mb40" style="text-align: center;">PROPERTY DETAILS</h3>
        [/vc_column_text][foundry_feature_list text="Architect**Kronghold Construction,Year Constructed**2010,Land Size**4046 SQM.,Efficiency Rating**SIX STAR,Accolades**BEST LARGE HOME 2011"][/vc_column][vc_column width="3/12"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="3/12"][/vc_column][vc_column width="6/12"][vc_column_text]
        <h2 class="uppercase color-primary" style="text-align: center;">REGISTER INTEREST</h2>
        <p class="lead" style="text-align: center;">We'll update you via e-mail with property inspection times</p>
        [/vc_column_text][contact-form-7 id="274"][/vc_column][vc_column width="3/12"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_property_listing_template' );
}

if(!( function_exists('ebor_resume_template') )){
function ebor_resume_template($data){
    $template               = array();
    $template['name']       = 'Resume';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/resume.png';
    $template['content']    = <<<CONTENT
        [vc_row foundry_background_style="bg-dark" foundry_padding="pt240" append_hr="no" foundry_icons="no"][vc_column width="9/12"][foundry_title_card image="324" title="MAYER RAFFERTY" subtitle="ART DIRECTOR"][vc_empty_space height="52px"][vc_column_text]
        <p class="lead fade-half">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
        [/vc_column_text][/vc_column][vc_column width="3/12"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="normal-padding" append_hr="no" foundry_icons="no"][vc_column width="1/1"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24">ABOUT ME</h4>
        [/vc_column_text][vc_row_inner][vc_column_inner el_class="" width="1/3"][vc_column_text]
        <p class="fade-half">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.</p>
        [/vc_column_text][/vc_column_inner][vc_column_inner el_class="" width="1/3"][vc_column_text]
        <p class="fade-half">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.</p>
        [/vc_column_text][/vc_column_inner][vc_column_inner el_class="" width="1/3"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row full_width="" parallax="" parallax_image="" foundry_background_style="bg-dark" foundry_padding="normal-padding" append_hr="no" foundry_icons="no" el_id=""][vc_column width="8/12"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24">EXPERTISE</h4>
        [/vc_column_text][vc_column_text]
        <p class="lead fade-half">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
        [/vc_column_text][foundry_skill_bar_block layout="outside" title="Art Direction" amount="90" align="text-left"][foundry_skill_bar_block layout="outside" title="Branding &amp; Identity" amount="80" align="text-left"][foundry_skill_bar_block layout="outside" title="Interface Design" amount="70" align="text-left"][/vc_column][vc_column width="4/12"][/vc_column][/vc_row][vc_row full_width="" parallax="" parallax_image="" foundry_background_style="bg-dark" foundry_padding="normal-padding" append_hr="no" foundry_icons="no" el_id=""][vc_column width="8/12"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24">EMPLOYMENT</h4>
        [/vc_column_text][vc_column_text css_animation=""]
        <p class="lead fade-half">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
        [/vc_column_text][foundry_resume_item title="COUNT AGENCY" subtitle="Lead Art Direction" date="2015"][foundry_resume_item title="GOOGLE INC." subtitle="Art Direction" date="2015"][foundry_resume_item title="PIED PIPER" subtitle="Interface Design" date="2014"][/vc_column][vc_column width="4/12"][/vc_column][/vc_row][vc_row full_width="" parallax="" parallax_image="" foundry_background_style="bg-dark" foundry_padding="normal-padding" append_hr="no" foundry_icons="no" el_id=""][vc_column width="8/12"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24">Education</h4>
        [/vc_column_text][vc_column_text css_animation=""]
        <p class="lead fade-half">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
        [/vc_column_text][foundry_resume_item title="MASTERS, CONTEMPORARY ARTS" subtitle="Melbourne University" date="2010"][foundry_resume_item title="BACHELOR OF DESIGN &amp; COMMUNICATION" subtitle="Monash University" date="2007"][/vc_column][vc_column width="4/12"][/vc_column][/vc_row][vc_row full_width="" parallax="" parallax_image="" foundry_background_style="bg-dark" foundry_padding="normal-padding" append_hr="no" foundry_icons="no" el_id=""][vc_column width="8/12"][vc_column_text]
        <h4 class="uppercase mb40 mb-xs-24">Contact</h4>
        [/vc_column_text][vc_row_inner][vc_column_inner el_class="" width="1/2"][vc_column_text]
        <h6 class="uppercase mb0">EMAIL</h6>
        <p class="fade-half">hello@foundryresume.net</p>
        [/vc_column_text][vc_column_text]
        <h6 class="uppercase mb0">PHONE</h6>
        <p class="fade-half">+614 482726</p>
        [/vc_column_text][/vc_column_inner][vc_column_inner el_class="" width="1/2"][foundry_simple_social_icon icon="ti-twitter-alt" title="Twitter" url="#"][foundry_simple_social_icon icon="ti-facebook" title="Facebook" url="#"][foundry_simple_social_icon icon="ti-dribbble" title="Dribbble" url="#"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="4/12"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_resume_template' );
}

if(!( function_exists('ebor_restaurant_template') )){
function ebor_restaurant_template($data){
    $template               = array();
    $template['name']       = 'Restaurant';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/resto.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-button-alt" image="685" button_text="Book a Table" button_url="#"]<img class="aligncenter size-medium wp-image-686" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/logo-light-300x72.png" alt="logo-light" width="300" height="72" />[/foundry_hero][/vc_column][/vc_row][vc_row][vc_column][foundry_text_images image1="690" image2="691"]
        <h1 class="large uppercase mb64 mb-xs-24">BON GOÛT</h1>
        <p class="mb80 mb-xs-24">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a class="btn btn-lg btn-filled" href="#book-table">BOOK A TABLE</a>[/foundry_text_images][/vc_column][/vc_row][vc_row css=".vc_custom_1436520888762{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/resto2.jpg?id=687) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][foundry_menu]
        <h1 class="large uppercase mb64 mb-xs-24">MENU</h1>
        <strong>Please note we offer vegetarian options and can cater
        for most dietary requirements.</strong>
        
        In addition, we are also able to offer dietary
        specific tasting menus upon request.[/foundry_menu][foundry_menu layout="bg-primary"]
        <h3 class="uppercase mb40 mb-xs-24" style="text-align: center;">MAIN</h3>
        <h6 class="mb8 uppercase" style="text-align: center;">BRAISED DUCK CONFIT</h6>
        <p style="text-align: center;">Lightly seasoned with buttered sage and fig hearts.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">ROASTED ARTICHOKE</h6>
        <p style="text-align: center;">Served with a tangy horseradish cream on a bed of slaw.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">SALAD OF NORTHERN GREENS</h6>
        <p style="text-align: center;">A selection of freshly foraged greens from Northern Australia.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">FRIED SPRING ROLLS</h6>
        <p style="text-align: center;">Lightly fried in Sesami Oil, filled with fresh chicken or beef.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">CARAMEL PORK BELLY</h6>
        <p style="text-align: center;">Slow roasted Pork Belly served with apple slaw.</p>
        [/foundry_menu][/vc_column][vc_column width="1/2"][vc_empty_space height="82px"][foundry_menu layout="bg-secondary"]
        <h3 class="uppercase mb40 mb-xs-24" style="text-align: center;">ENTRÉE</h3>
        <h6 class="mb8 uppercase" style="text-align: center;">BRAISED DUCK CONFIT</h6>
        <p style="text-align: center;">Lightly seasoned with buttered sage and fig hearts.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">ROASTED ARTICHOKE</h6>
        <p style="text-align: center;">Served with a tangy horseradish cream on a bed of slaw.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">SALAD OF NORTHERN GREENS</h6>
        <p style="text-align: center;">A selection of freshly foraged greens from Northern Australia.</p>
        [/foundry_menu][foundry_menu]
        <h3 class="uppercase mb40 mb-xs-24" style="text-align: center;">DESSERT</h3>
        <h6 class="mb8 uppercase" style="text-align: center;">BERRY CONFIT</h6>
        <p style="text-align: center;">Lightly seasoned berries with buttered sage and fig hearts.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">ROASTED PEAR CRUMBLE</h6>
        <p style="text-align: center;">Served with a fluffy butterscotch cream on a bed of apple slaw.</p>
        
        <h6 class="mb8 uppercase" style="text-align: center;">SALAD OF NORTHERN FRUITS</h6>
        <p style="text-align: center;">A selection of freshly foraged fruit from Northern Australia.</p>
        [/foundry_menu][/vc_column][/vc_row][vc_row css=".vc_custom_1436520945084{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/resto4.jpg?id=688) !important;}"][vc_column][vc_empty_space height="300px"][/vc_column][/vc_row][vc_row][vc_column][foundry_instagram layout="restaurant" title="ashrod"]
        <h1 class="large uppercase mb32 mb-xs-24" style="text-align: center;">Feast Your Eyes</h1>
        
        <hr class="mb32" />
        <p class="mb-xs-24" style="text-align: center;">Follow us <a href="#">@eatfoundry</a> for delicious updates.</p>
        [/foundry_instagram][/vc_column][/vc_row][vc_row css=".vc_custom_1436522319742{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/resto3.jpg?id=699) !important;}"][vc_column][foundry_testimonial_carousel layout="carousel-bordered"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][foundry_menu]
        <h1 class="large uppercase mb64 mb-xs-24">BOOK A TABLE</h1>
        [contact-form-7 id="703" title="Foundry Restaurant Form"][/foundry_menu][/vc_column][vc_column width="1/2"][vc_empty_space height="82px"][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZ3d3cuZ29vZ2xlLmNvbSUyRm1hcHMlMkZlbWJlZCUzRnBiJTNEJTIxMW0xOCUyMTFtMTIlMjExbTMlMjExZDYzMDQuODI5OTg2MTMxMjcxJTIxMmQtMTIyLjQ3NDY5NjgwMzMwOTIlMjEzZDM3LjgwMzc0NzUyMTYwNDQzJTIxMm0zJTIxMWYwJTIxMmYwJTIxM2YwJTIxM20yJTIxMWkxMDI0JTIxMmk3NjglMjE0ZjEzLjElMjEzbTMlMjExbTIlMjExczB4ODA4NTg2ZTYzMDI2MTVhMSUyNTNBMHg4NmJkMTMwMjUxNzU3YzAwJTIxMnNTdG9yZXklMkJBdmUlMjUyQyUyQlNhbiUyQkZyYW5jaXNjbyUyNTJDJTJCQ0ElMkI5NDEyOSUyMTVlMCUyMTNtMiUyMTFzZW4lMjEyc3VzJTIxNHYxNDM1ODI2NDMyMDUxJTIyJTIwd2lkdGglM0QlMjI2MDAlMjIlMjBoZWlnaHQlM0QlMjI0NTAlMjIlMjBmcmFtZWJvcmRlciUzRCUyMjAlMjIlMjBzdHlsZSUzRCUyMmJvcmRlciUzQTAlMjIlMjBhbGxvd2Z1bGxzY3JlZW4lM0UlM0MlMkZpZnJhbWUlM0U=" size="200"][foundry_menu]
        <h4 class="uppercase">CONTACT US</h4>
        428 Marine Parade
        Elwood VIC 3184
        
        <strong>P:</strong> +614837483
        <strong>E:</strong> eat@foundry.net[/foundry_menu][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_restaurant_template' );
}

if(!( function_exists('ebor_app_landing_two_template') )){
function ebor_app_landing_two_template($data){
    $template               = array();
    $template['name']       = 'App Landing 2';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/app2.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-left-half" image="864"]
        <h1>Built by designers,
        tailored to you.</h1>
        <p class="lead mb48 mb-xs-32">A simple, stylish way to showcase your product,
        built with Foundry &amp; Visual Composer Page Builder</p>
        <p class="lead mb48 mb-xs-32"><img class="alignleft wp-image-866 " src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/appstore-300x87.png" alt="appstore" width="164" height="52" /></p>
        [/foundry_hero][/vc_column][/vc_row][vc_row][vc_column width="1/12"][/vc_column][vc_column width="4/12"][vc_column_text]
        <h2 class="mb64 mb-xs-32">Meet Foundry, your new best friend.</h2>
        <div class="mb40 mb-xs-24">
        <h5 class="uppercase bold mb16">SCREENSHOTS FOR DAYS</h5>
        <p class="fade-1-4">Utilize the near infinite number of Apple Watch mockups to showcase your app in clear context. Thank god for Dribbble, huh?</p>
        
        <h5 class="uppercase bold mb16">CALL OFF THE SEARCH</h5>
        <p class="fade-1-4">This is it, that perfect template you've been looking for. It's well built and sharp looking, goodbye competition!</p>
        
        </div>
        [/vc_column_text][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="5/12"][vc_single_image image="763" img_size="full" alignment="center"][/vc_column][vc_column width="1/12"][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" css=".vc_custom_1437060366799{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/app9.jpg?id=764) !important;}"][vc_column width="1/2"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h2>Share meaningful moments with loved ones</h2>
        <p class="lead mb48 mb-xs-32">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.</p>
        [/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="3/12"][vc_column_text]
        <h5 class="uppercase bold mb16" style="text-align: right;">NEVER FORGET AGAIN</h5>
        <p class="fade-1-4" style="text-align: right;">The reminder that just keeps reminding! Scramble to your watch to silence these intrusive notifications.</p>
        
        <h5 class="uppercase bold mb16" style="text-align: right;"></h5>
        [/vc_column_text][vc_empty_space height="52px"][vc_column_text]
        <h5 class="uppercase bold mb16" style="text-align: right;">STAY ACTIVE, BE HEALTHY</h5>
        <p class="fade-1-4" style="text-align: right;">No more personal responsibility! You'll now be constantly reminded to stand up and move around.</p>
        [/vc_column_text][/vc_column][vc_column width="6/12"][vc_column_text]
        
        [gallery layout="slider" ids="857,858,859"]
        
        [/vc_column_text][/vc_column][vc_column width="3/12"][vc_column_text]
        <h5 class="uppercase bold mb16">POWERED BY YOU</h5>
        <p class="fade-1-4">Forget empty branding promises, this thing is powered by awesome (you), and we stand by that.</p>
        [/vc_column_text][vc_empty_space height="52px"][vc_column_text]
        <h5 class="uppercase bold mb16">LEAVE YOUR PHONE</h5>
        <p class="fade-1-4">And you wont be able to use the app! Make sure you have the phone within close proximity at all times!</p>
        [/vc_column_text][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary"][vc_column width="1/3"][foundry_icon_box icon="ti-layers" layout="small-left" title="Flexible Layouts"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.[/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-medall" layout="small-left" title="Timely Updates"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.[/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-download" layout="small-left" title="Elite Author Item"]Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.[/foundry_icon_box][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pb0"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h1 class="large" style="text-align: center;">Go on, buy it.</h1>
        <p class="lead mb48 mb-xs-32 fade-1-4" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.</p>
        <p style="text-align: center;"><a class="btn btn-lg btn-filled" href="#">I'M READY TO START THE JOURNEY</a></p>
        [/vc_column_text][vc_single_image image="862" img_size="full" alignment="center"][/vc_column][vc_column width="1/4"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_app_landing_two_template' );
}

if(!( function_exists('ebor_agency_template') )){
function ebor_agency_template($data){
    $template               = array();
    $template['name']       = 'Agency';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/agency.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-centered" image="868"]
        <h3 class="mb56 mb-xs-24" style="text-align: center;">Foundry is a digital design collective, tailoring experiences in web and print for clients all around the globe.</h3>
        <p style="text-align: center;"><a class="btn btn-lg btn-white mb0" href="#">GET TO KNOW US BETTER</a></p>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" el_id="about"][vc_column width="1/6"]
        [/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="mb40 mb-xs-32" style="text-align: center;">An agency founded on the principles of Honesty, Clarity, Simplicity.</h3>
        <p class="lead mb0" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        [/vc_column_text][/vc_column][vc_column width="1/6"]
        [/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_text_image layout="box-right" image="748"][vc_column_text]
        <h5 class="uppercase"><strong>VAULT</strong></h5>
        <h4 class="mb64">See how we increased Vault's service signups by more than double.</h4>
        <a class="btn btn-lg" href="#">VIEW CASE STUDY</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-left" image="749"][vc_column_text]
        <h5 class="uppercase"><strong>ALBM</strong></h5>
        <h4 class="mb64">We worked with ALBM to deliver an immersive mobile experience.</h4>
        <a class="btn btn-lg" href="#">VIEW CASE STUDY</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_parallax="not-parallax" css=".vc_custom_1437389871886{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/agency4.jpg?id=750) !important;}"][vc_column width="1/2"][vc_column_text]
        <h5 class="uppercase"><strong>AVIARY GALLERY</strong></h5>
        <h4 class="mb64">This impeccably designed Melbourne gallery establishes a new online presence.</h4>
        <a class="btn btn-lg btn-filled" href="#">VIEW CASE STUDY</a>[/vc_column_text][/vc_column][vc_column width="1/2"]
        [/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column width="1/6"]
        [/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 class="mb48 mb-xs-32" style="text-align: center;">Some amazing companies we've had the pleasure to work with.</h3>
        [/vc_column_text][foundry_testimonial_carousel layout="carousel-agency"][/vc_column][vc_column width="1/6"]
        [/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column][vc_column_text]
        <h5 class="uppercase text-center fade-half mb64 mb-xs-32" style="text-align: center;">SELECTED CLIENTS</h5>
        [/vc_column_text][vc_row_inner][vc_column_inner width="2/12"]
        [/vc_column_inner][vc_column_inner width="4/12"][vc_column_text]
        <h6 class="uppercase mb8" style="text-align: center;">APPLE</h6>
        <h6 class="uppercase mb8" style="text-align: center;">ACORN TECHNOLOGY</h6>
        <h6 class="uppercase mb8" style="text-align: center;">GOOGLE</h6>
        <h6 class="uppercase mb8" style="text-align: center;">GOURMET TRAVELLER</h6>
        <h6 class="uppercase mb8" style="text-align: center;">BROADSHEET</h6>
        <h6 class="uppercase mb8" style="text-align: center;">PADRE FOOD CO.</h6>
        <h6 class="uppercase mb8" style="text-align: center;">FOUNDRY</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="4/12"][vc_column_text]
        <h6 class="uppercase mb8" style="text-align: center;">APPLE</h6>
        <h6 class="uppercase mb8" style="text-align: center;">ACORN TECHNOLOGY</h6>
        <h6 class="uppercase mb8" style="text-align: center;">GOOGLE</h6>
        <h6 class="uppercase mb8" style="text-align: center;">GOURMET TRAVELLER</h6>
        <h6 class="uppercase mb8" style="text-align: center;">BROADSHEET</h6>
        <h6 class="uppercase mb8" style="text-align: center;">PADRE FOOD CO.</h6>
        <h6 class="uppercase mb8" style="text-align: center;">FOUNDRY</h6>
        [/vc_column_text][/vc_column_inner][vc_column_inner width="2/12"]
        [/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column][vc_column_text]
        <h3 class="mb64 mb-xs-32" style="text-align: center;">News &amp; Views</h3>
        [/vc_column_text][foundry_blog pppage="6" type="box"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" foundry_parallax="not-parallax" css=".vc_custom_1437390020851{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/Screen-Shot-2015-07-14-at-16.13.09.png?id=758) !important;}"][vc_column width="1/2"][vc_column_text]
        <h3 class="mb64 mb-xs-32">Get In Touch</h3>
        <h4 class="mb16">hello@foundry.net</h4>
        [/vc_column_text][foundry_simple_social_icon icon="ti-facebook" title="Facebook" url="#"][foundry_simple_social_icon icon="ti-twitter-alt" title="Twitter" url="#"][foundry_simple_social_icon icon="ti-dribbble" title="Dribbble" url="#"][vc_empty_space][vc_column_text]
        <h6 class="uppercase mb0">SAN FRANCISCO</h6>
        1420 Chilvers Avenue.
        San Francisco
        (03) 4374 4628[/vc_column_text][/vc_column][vc_column width="1/2"]
        [/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_agency_template' );
}

if(!( function_exists('ebor_fitness_template') )){
function ebor_fitness_template($data){
    $template               = array();
    $template['name']       = 'Fitness';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/fitness.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-left-half" image="896"]
        <h1 class="mb0 uppercase bold italic">BEN DOBSON</h1>
        <h5 class="uppercase mb32">PERSONAL TRAINING &amp; DIETARY ADVICE</h5>
        <p class="lead mb0">“Everyone deserves good health and happiness.
        My goal is to help people achieve both.”</p>
        [/foundry_hero][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="5/12"][vc_column_text]
        <h1 class="uppercase mb24 bold italic" style="text-align: right;">FITNESS
        FOR LIFE</h1>
        <h5 class="uppercase italic fade-1-4" style="text-align: right;">“MY PASSION IS MOTIVATING
        PEOPLE TO GET RESULTS”</h5>
        [/vc_column_text][/vc_column][vc_column width="7/12"][vc_column_text]Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.
        
        Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur
        
        <img class="alignleft  wp-image-892" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/fitness1-300x198.png" alt="fitness1" width="195" height="142" />[/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-left" image="898"][vc_column_text]
        <h2 class="uppercase bold italic">INDIVIDUAL
        TRAINING</h2>
        Perfect for those who need a little extra motivation.
        You'll receive a fully personalized workout and dietary program
        that we'll monitor together.
        <h6 class="uppercase mb8">FLEXIBLE BOOKING TIMES</h6>
        <h6 class="uppercase mb8">PERSONAL DIETARY ADVICE</h6>
        <h6 class="uppercase mb8">MULTI-SESSION DISCOUNTS</h6>
        <h6 class="uppercase mb8">WEEKLY PROGRESS TRACKING</h6>
        <a class="btn btn-lg mt32 mb0" href="#">BOOK A SESSION NOW</a>[/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_text_image layout="box-right" image="894"][vc_column_text]
        <h2 class="uppercase bold italic" style="text-align: right;">GROUP
        TRAINING</h2>
        <p style="text-align: right;">Training in a positively charged environment, we work together
        to achieve our own goals. Groups are made up of 10 - 15 people
        and cater to all ability levels.</p>
        
        <h6 class="uppercase mb8" style="text-align: right;">COME TO ANY SESSION</h6>
        <h6 class="uppercase mb8" style="text-align: right;">MULTI-SESSION DISCOUNTS</h6>
        <h6 class="uppercase mb8" style="text-align: right;">TRAIN WITH FRIENDS</h6>
        <p style="text-align: right;"><a class="btn btn-lg mt32 mb0" href="#">BOOK A SESSION NOW</a></p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h2 class="bold italic uppercase fade-3-4 mb0" style="text-align: center;">WEEKLY SCHEDULE</h2>
        [/vc_column_text][foundry_tabs][foundry_tabs_content title="Monday"]
        <h6 class="uppercase mb8">06:30AM - 07:30AM</h6>
        <h4>Beacon Hill Reserve</h4>
        <p class="mb0">420 Lancaster Road
        Melbourne, 3001
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">08:00AM - 09:00AM</h6>
        <h4>Beacon Hill Reserve - Advanced</h4>
        <p class="mb0">420 Lancaster Road
        Melbourne, 3001
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">06:00PM - 07:00PM</h6>
        <h4>Clapham Park</h4>
        <p class="mb0">34 Bauer Road
        South Melbourne, 3008
        <a href="#">Get Directions</a></p>
        [/foundry_tabs_content][foundry_tabs_content title="Tuesday"]
        <h6 class="uppercase mb8">06:00PM - 07:00PM</h6>
        <h4>Clapham Park</h4>
        <p class="mb0">34 Bauer Road
        South Melbourne, 3008
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">07:30AM - 08:30AM</h6>
        <h4>Clapham Park - Advanced</h4>
        <p class="mb0">434 Bauer Road
        South Melbourne, 3008
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">06:00PM - 07:00PM</h6>
        <h4>Beacon Hill Reserve - Advanced</h4>
        <p class="mb0">420 Lancaster Road
        Melbourne, 3001
        <a href="#">Get Directions</a></p>
        [/foundry_tabs_content][foundry_tabs_content title="Wednesday"]
        <h6 class="uppercase mb8">06:30AM - 07:30AM</h6>
        <h4>Beacon Hill Reserve</h4>
        <p class="mb0">420 Lancaster Road
        Melbourne, 3001
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">08:00AM - 09:00AM</h6>
        <h4>Beacon Hill Reserve - Advanced</h4>
        <p class="mb0">420 Lancaster Road
        Melbourne, 3001
        <a href="#">Get Directions</a></p>
        
        
        <hr class="mt40 mb40 mt-xs-0 mb-xs-24" />
        
        <h6 class="uppercase mb8">06:00PM - 07:00PM</h6>
        <h4>Clapham Park</h4>
        <p class="mb0">34 Bauer Road
        South Melbourne, 3008
        <a href="#">Get Directions</a></p>
        [/foundry_tabs_content][/foundry_tabs][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" css=".vc_custom_1437383895013{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/2015/07/Unknown-21.jpeg?id=895) !important;}"][vc_column width="1/2"][vc_column_text]
        <h4 class="bold uppercase italic mb8">“TRAINING WITH BEN HAS BEEN TOUGH AS HELL, AND A TON OF FUN. I'VE NEVER FELT BETTER ABOUT MYSELF!”</h4>
        <h6 class="uppercase mb0">JANE SIMPSON - CLIENT OF 2 YEARS</h6>
        [/vc_column_text][/vc_column][vc_column width="1/2"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <h2 class="uppercase bold italic" style="text-align: center;"><span class="ti-instagram"> </span>BENDOBSONFITNESS</h2>
        <p class="lead" style="text-align: center;">Follow me on Instagram for workout inspiration and shots from our awesome group fitness sessions.</p>
        [/vc_column_text][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-dark"][vc_column][foundry_instagram layout="full" title="fitlinepersonaltraining"][/foundry_instagram][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pt64 pb64"][vc_column width="1/4"][/vc_column][vc_column width="1/2"][vc_column_text]
        <p style="text-align: center;"><a class="btn btn-lg btn-filled mb0" href="#">See more on Instagram</a></p>
        [/vc_column_text][/vc_column][vc_column width="1/4"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
        <h2 class="uppercase bold italic fade-3-4 mb0" style="text-align: center;">INSIGHTS</h2>
        [/vc_column_text][foundry_blog pppage="3" type="box"][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="5/12"][vc_column_text]
        <h1 class="uppercase bold italic" style="text-align: right;">LET'S SMASH
        YOUR GOALS
        TOGETHER</h1>
        [/vc_column_text][/vc_column][vc_column width="2/12"][foundry_icon_box icon="ti-bolt"][/foundry_icon_box][/vc_column][vc_column width="5/12"][vc_column_text]
        <p class="lead">Questions, bookings or feedback? Contact me by any of the channels below. I'll respond ASAP!</p>
        
        <h4 class="mb8">P: 0417 374 992</h4>
        <h4 class="mb8">E: train@bendobson.net</h4>
        <h4 class="mb0"> @bendobson</h4>
        [/vc_column_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_fitness_template' );
}

if(!( function_exists('ebor_winery_template') )){
function ebor_winery_template($data){
    $template               = array();
    $template['name']       = 'Winery';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/winery.png';
    $template['content']    = <<<CONTENT
        [vc_row full_width="stretch_row"][vc_column][foundry_hero image="1155"]
        <p class="lead italic"><img class="aligncenter size-full wp-image-1144" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine1.png" alt="wine1" width="413" height="560" /></p>
        
        <h5 class="lead italic" style="text-align: center;"><em>“Without doubt, one of the most consistently
        high-quality wineries in the Barossa region”</em></h5>
        <p style="text-align: center;">David Halladay - Respected Wino</p>
        [/foundry_hero][/vc_column][/vc_row][vc_row][vc_column][foundry_text_image layout="offscreen-right" image="1157"][vc_column_text]
        <h5 class="uppercase fade-half mb-xs-24" style="text-align: center;">• EST. 1968 •</h5>
        <h4 style="text-align: center;">Combining over 100 years of hard work and shared family knowledge</h4>
        <p class="lead" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        <p class="lead" style="text-align: center;"><img class="aligncenter  wp-image-1145" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine2-300x135.png" alt="wine2" width="198" height="80" /></p>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1439476327113{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine13.jpg?id=1154) !important;}"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">“We've been producing fine wine for over 65 years,
        I think we know what we're talking about”</h3>
        <p class="lead" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        [/vc_column_text][/vc_column][vc_column width="1/6"][/vc_column][/vc_row][vc_row foundry_padding="pt0"][vc_column][foundry_image_carousel][foundry_image_carousel_content image="1146"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="1147"]
        <h4 style="text-align: center;">Foundry Chardonnay</h4>
        <h5 style="text-align: center;">“A rich fruit palet with subtle Oak influence and a lingering dry, fresh finish”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="1148"]
        <h4 style="text-align: center;">Foundry Cabernet</h4>
        <h5 style="text-align: center;">“Generous sweet blackcurrant and mulberry character with soft, velvety tannins”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="1147"]
        <h4 style="text-align: center;">Foundry Chardonnay</h4>
        <h5 style="text-align: center;">“A rich fruit palet with subtle Oak influence and a lingering dry, fresh finish”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="1146"]
        <h4 style="text-align: center;">Foundry Shiraz</h4>
        <h5 style="text-align: center;">“Aged five years in solid, French Oak barrels sports notes of pepper and blackberry”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][foundry_image_carousel_content image="1148"]
        <h4 style="text-align: center;">Foundry Cabernet</h4>
        <h5 style="text-align: center;">“Generous sweet blackcurrant and mulberry character with soft, velvety tannins”</h5>
        <p style="text-align: center;"><a class="btn btn-filled mb0" href="#">VISIT SHOP</a></p>
        [/foundry_image_carousel_content][/foundry_image_carousel][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1439476837386{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine12.jpg?id=1153) !important;}"][vc_column width="1/3"][vc_empty_space height="72px"][vc_column_text]
        <p style="text-align: center;"><img class="aligncenter wp-image-1150 " src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine9-300x300.png" alt="" width="191" height="191" /></p>
        <p class="lead" style="text-align: center;">Winemaker of the Year
        Foundry Vineyard, 20014</p>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]
        <h3 style="text-align: center;">Awards &amp; Recognition</h3>
        [/vc_column_text][vc_column_text]
        <p style="text-align: center;"><img class="aligncenter  wp-image-1151" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine10-300x300.png" alt="wine10" width="198" height="199" /></p>
        <p class="lead" style="text-align: center;">Winemaker of the Year
        Foundry Vineyard, 20014</p>
        [/vc_column_text][/vc_column][vc_column width="1/3"][vc_empty_space height="72px"][vc_column_text]
        <p style="text-align: center;"><img class="aligncenter wp-image-1152 " src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/08/wine11-300x300.png" alt="" width="199" height="199" /></p>
        <p class="lead" style="text-align: center;">Winemaker of the Year
        Foundry Vineyard, 20014</p>
        [/vc_column_text][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_text_image layout="box-left" image="1156"][vc_column_text]
        <h4>Join us for tastings at the Cellar Door</h4>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p>
        
        
        <hr />
        <p class="lead">1240 Kilgour Road
        Rowland Flat
        South Australia 5352</p>
        
        <ul>
        	<li>P: (05) 3928 9283</li>
        	<li>E: enquiries@foundry.net</li>
        </ul>
        [/vc_column_text][/foundry_text_image][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column width="1/6"][/vc_column][vc_column width="2/3"][vc_column_text]
        <h3 style="text-align: center;">Sign up to our monthly newsletter</h3>
        <p class="lead" style="text-align: center;">Get special offers and news on newest cellar releases.</p>
        [/vc_column_text][contact-form-7 id="274"][/vc_column][vc_column width="1/6"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_winery_template' );
}

if(!( function_exists('ebor_coming_soon_template') )){
function ebor_coming_soon_template($data){
    $template               = array();
    $template['name']       = 'Coming Soon';
    $template['image_path'] = 'http://i.imgur.com/yXX6NaD.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_height="yes" css=".vc_custom_1440768165531{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/project-single-6.jpg?id=1112) !important;}"][vc_column width="3/12"]
		[/vc_column][vc_column width="6/12"][vc_column_text]
		<p class="uppercase mb40 mb-xs-24" style="text-align: center;"><img class="aligncenter size-medium wp-image-686" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/logo-light-300x72.png" alt="logo-light" width="300" height="72" /></p>
		
		<h3 class="uppercase mb40 mb-xs-24" style="text-align: center;">LAUNCHING SOON</h3>
		<p style="text-align: center;">[foundry_countdown date="2016/12/01"]</p>
		<p style="text-align: center;">We'll be launching our new site in the coming weeks. Hit the form below to get notified as we launch. Thanks for your interest!</p>
		[/vc_column_text][contact-form-7 id="274"][vc_column_text]
		<p style="text-align: center;">*We won't share your email with third parties.</p>
		[/vc_column_text][/vc_column][vc_column width="3/12"]
		[/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_coming_soon_template' );
}

if(!( function_exists('ebor_optician_template') )){
function ebor_optician_template($data){
    $template               = array();
    $template['name']       = 'Optician';
    $template['image_path'] = 'http://i.imgur.com/KHfMYTt.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-video-top" image="1181" embed="https://vimeo.com/88883554"]
		<h1 style="text-align: center;">Glasses by designers,
		tailored to you.</h1>
		<p class="lead mb48 mb-xs-32" style="text-align: center;">A simple, stylish way to showcase your business,
		built with Foundry &amp; Visual Composer Page Builder</p>
		[/foundry_hero][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">SEE OUR CLEARVIEW GLASSES</h4>
		<p class="lead mb64" style="text-align: center;">We've got the best custom optics that you need.</p>
		[/vc_column_text][product_category per_page="3" columns="4" orderby="menu_order" order="DESC" category="glasses"][/vc_column][/vc_row][vc_row full_width="stretch_row" foundry_background_style="bg-secondary"][vc_column][foundry_half_carousel][foundry_half_carousel_content image="1187"]
		<h3>Check out this slick content slider!</h3>
		<p class="mb0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		[/foundry_half_carousel_content][foundry_half_carousel_content image="1188"]
		<h3>Half Text, Half Image, All Awesome!</h3>
		<p class="mb0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
		[/foundry_half_carousel_content][/foundry_half_carousel][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">WHAT DO WE STOCK?</h4>
		<p class="lead mb64" style="text-align: center;">Check out the brands that you can enjoy.</p>
		[/vc_column_text][foundry_clients filter="13"][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary"][vc_column][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">HEAR WHAT WE DO</h4>
		<p class="lead mb64" style="text-align: center;">See our latest Tweets.</p>
		[/vc_column_text][foundry_twitter title="628493843713904640"][/vc_column][/vc_row][vc_row foundry_vertical_align="yes"][vc_column width="1/2"][vc_column_text]
		<h3>Meet your new optician!</h3>
		Foundry is your complete design toolkit, built from the ground up to be flexible, extensible and stylish. Building slick, contemporary sites has never been this easy!
		
		<a class="btn-filled btn" href="#">Book Appointment</a>[/vc_column_text][/vc_column][vc_column width="1/2"][foundry_team pppage="1" layout="box" filter="42"][/vc_column][/vc_row][vc_row css=".vc_custom_1440770167323{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/home23.jpg?id=424) !important;}"][vc_column width="1/4"][vc_column_text]
		[/vc_column_text][/vc_column][vc_column width="1/2"][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">GET IN TOUCH</h4>
		<p class="lead mb64" style="text-align: center;">Drop us an email, we'll get your appointment sorted.</p>
		[/vc_column_text][contact-form-7 id="249"][/vc_column][vc_column width="1/4"][vc_column_text]
		[/vc_column_text][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_optician_template' );
}

if(!( function_exists('ebor_agency_two_template') )){
function ebor_agency_two_template($data){
    $template               = array();
    $template['name']       = 'Agency 2';
    $template['image_path'] = 'http://i.imgur.com/QZLn8Ck.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_video_slider][foundry_video_slider_content image="1187" webm="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video.webm" mpfour="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video.mp4" ogv="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video.ogv"]
		<h1 class="large" style="text-align: center;">Flexslider + Video Backgrounds</h1>
		<p class="lead" style="text-align: center;">Simple markup with intellegent auto play and pause functionality.</p>
		[/foundry_video_slider_content][foundry_video_slider_content image="1187" webm="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video2.webm" mpfour="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video2.mp4" ogv="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/video2.ogv"]
		<h1 class="large" style="text-align: center;">Flexslider + Video Backgrounds</h1>
		<p class="lead" style="text-align: center;">Simple markup with intellegent auto play and pause functionality.</p>
		[/foundry_video_slider_content][/foundry_video_slider][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" el_id="about"][vc_column width="1/6"]
		[/vc_column][vc_column width="2/3"][vc_column_text]
		<h3 class="mb40 mb-xs-32" style="text-align: center;">An agency founded on the principles of Honesty, Clarity, Simplicity.</h3>
		<p class="lead mb0" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		[/vc_column_text][/vc_column][vc_column width="1/6"]
		[/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_process_carousel][foundry_process_carousel_content background_style="bg-secondary"]
		<h1 class="mb40 mb-xs-32">1. Brilliant Design</h1>
		<h3 class="mb40 mb-xs-32">An agency founded on the principles of Honesty, Clarity, Simplicity.</h3>
		<p class="lead mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		[/foundry_process_carousel_content][foundry_process_carousel_content background_style="bg-dark"]
		<h1 class="mb40 mb-xs-32">2. Simple &amp; Quick Functionality</h1>
		<h3 class="mb40 mb-xs-32">An agency founded on the principles of Honesty, Clarity, Simplicity.</h3>
		<p class="lead mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		[/foundry_process_carousel_content][foundry_process_carousel_content background_style="bg-primary"]
		<h1 class="mb40 mb-xs-32">3. Built by a Trusted Author</h1>
		<h3 class="mb40 mb-xs-32">An agency founded on the principles of Honesty, Clarity, Simplicity.</h3>
		<p class="lead mb0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		[/foundry_process_carousel_content][/foundry_process_carousel][/vc_column][/vc_row][vc_row full_width="stretch_row" el_id="work"][vc_column][foundry_portfolio pppage="6" type="full-masonry-3col"][/vc_column][/vc_row][vc_row el_id="clients"][vc_column][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">WHO WE'VE WORKED WITH</h4>
		<p class="lead mb80" style="text-align: center;">We have the best clients.</p>
		[/vc_column_text][foundry_clients pppage="4" layout="static" filter="13"][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" el_id="news"][vc_column][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">NEWS &amp; VIEWS</h4>
		<p class="lead mb80" style="text-align: center;">Hear what we have to say.</p>
		[/vc_column_text][foundry_blog pppage="4" type="masonry-3col"][/vc_column][/vc_row][vc_row el_id="contact"][vc_column width="5/12"][vc_column_text]
		<h4 class="uppercase mb16" style="text-align: center;">Get in Touch</h4>
		<p class="lead mb8" style="text-align: center;">We want to talk.</p>
		[/vc_column_text][contact-form-7 id="249"][/vc_column][vc_column width="7/12"][vc_empty_space height="230px"][vc_gmaps link="#E-8_JTNDaWZyYW1lJTIwc3JjJTNEJTIyaHR0cHMlM0ElMkYlMkZ3d3cuZ29vZ2xlLmNvbSUyRm1hcHMlMkZlbWJlZCUzRnBiJTNEJTIxMW0xOCUyMTFtMTIlMjExbTMlMjExZDYzMDQuODI5OTg2MTMxMjcxJTIxMmQtMTIyLjQ3NDY5NjgwMzMwOTIlMjEzZDM3LjgwMzc0NzUyMTYwNDQzJTIxMm0zJTIxMWYwJTIxMmYwJTIxM2YwJTIxM20yJTIxMWkxMDI0JTIxMmk3NjglMjE0ZjEzLjElMjEzbTMlMjExbTIlMjExczB4ODA4NTg2ZTYzMDI2MTVhMSUyNTNBMHg4NmJkMTMwMjUxNzU3YzAwJTIxMnNTdG9yZXklMkJBdmUlMjUyQyUyQlNhbiUyQkZyYW5jaXNjbyUyNTJDJTJCQ0ElMkI5NDEyOSUyMTVlMCUyMTNtMiUyMTFzZW4lMjEyc3VzJTIxNHYxNDM1ODI2NDMyMDUxJTIyJTIwd2lkdGglM0QlMjI2MDAlMjIlMjBoZWlnaHQlM0QlMjI0NTAlMjIlMjBmcmFtZWJvcmRlciUzRCUyMjAlMjIlMjBzdHlsZSUzRCUyMmJvcmRlciUzQTAlMjIlMjBhbGxvd2Z1bGxzY3JlZW4lM0UlM0MlMkZpZnJhbWUlM0U="][vc_empty_space height="80px"][foundry_big_social][foundry_big_social_content icon="ti-twitter-alt" url="#"][foundry_big_social_content icon="ti-facebook" url="#"][foundry_big_social_content icon="ti-flickr-alt" url="#"][/foundry_big_social][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_agency_two_template' );
}

if(!( function_exists('ebor_blog_template') )){
function ebor_blog_template($data){
    $template               = array();
    $template['name']       = 'Blog';
    $template['image_path'] = 'http://i.imgur.com/LT65aM1.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_blog type="carousel"][/vc_column][/vc_row][vc_row foundry_padding="pb0"][vc_column][vc_column_text]<img class="aligncenter size-medium wp-image-731" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/logo-dark-300x72.png" alt="logo-dark" width="300" height="72" />
		<p class="lead" style="text-align: center;">Welcome to our blog.</p>
		[/vc_column_text][/vc_column][/vc_row][vc_row append_hr="yes"][vc_column width="1/3"][foundry_image_tile image="711" title="ABOUT US" subtitle="Find out who we are" url="#"][/vc_column][vc_column width="1/3"][foundry_image_tile image="734" title="FOLLOW US" subtitle="We're quite social" url="#"][/vc_column][vc_column width="1/3"][foundry_image_tile image="764" title="CONTACT US" subtitle="Give us a shout" url="#"][/vc_column][/vc_row][vc_row][vc_column][foundry_blog pppage="3" type="simple" pagination="yes"][/vc_column][/vc_row][vc_row full_width="stretch_row"][vc_column][foundry_instagram layout="full" title="funsizeco"]
		[/foundry_instagram][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_blog_template' );
}

if(!( function_exists('ebor_construction_template') )){
function ebor_construction_template($data){
    $template               = array();
    $template['name']       = 'Construction';
    $template['image_path'] = 'http://i.imgur.com/TR5KWTu.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-bottom-left" shortcode="249" image="1245" button_text="Contact Us" button_url="#"]<img class="size-medium wp-image-686 alignnone" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/logo-light-300x72.png" alt="logo-light" width="300" height="72" />
		<p class="lead uppercase fade-half" style="text-align: left;">Award Winning
		Construction Management</p>
		[/foundry_hero][/vc_column][/vc_row][vc_row foundry_background_style="bg-primary" foundry_padding="pt64 pb64"][vc_column][foundry_call_to_action_block title="Want a qualified manager for your next build?" url="#" button_text="Get a Quote"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][vc_column_text]<img class="aligncenter size-large wp-image-1249" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/Unknown-2-1024x683.jpeg" alt="Unknown-2" width="1024" height="683" />
		<h5 style="text-align: center;">Unique, Engaging Style</h5>
		<p style="text-align: center;">Foundry has a bright, flexible persona that can be adapted to suit almost any use. Use Foundry to sell or create a simple business website.</p>
		[/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]<img class="aligncenter wp-image-1248 size-large" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/Unknown1-1024x683.jpeg" alt="" width="1024" height="683" />
		<h5 style="text-align: center;">Built for mobile and up</h5>
		<p style="text-align: center;">Tested comprehensively on a number of mobile devices, Foundry is well prepared to impress your mobile audience.</p>
		[/vc_column_text][/vc_column][vc_column width="1/3"][vc_column_text]<img class="aligncenter wp-image-1247 size-large" src="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/Unknown-1-1024x683.jpeg" alt="" width="1024" height="683" />
		<h5 style="text-align: center;">Visual Composer included</h5>
		<p style="text-align: center;">Themeforest’s most popular page builder just keeps getting better, Smart controls and font options give you complete control.</p>
		[/vc_column_text][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1442847852943{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/09/Unknown2.jpeg?id=1250) !important;}"][vc_column][vc_column_text]
		<h2 style="text-align: center;">We build bungalows to skyscrapers, all for our exacting clients demands, we can do the same for you too!</h2>
		<p style="text-align: center;"><a class="btn btn-lg" href="#">Call Now</a></p>
		[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column width="1/3"][foundry_icon_box icon="ti-ruler-alt-2" layout="large-centered-boxed" title="Precision Engineering"]
		
		Foundry has a bright, flexible persona that can be adapted to suit almost any use. Use Foundry to sell or create a simple business website.
		
		[/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-ruler-pencil" layout="large-centered-boxed" title="Exacting Designs"]
		
		Foundry has a bright, flexible persona that can be adapted to suit almost any use. Use Foundry to sell or create a simple business website.
		
		[/foundry_icon_box][/vc_column][vc_column width="1/3"][foundry_icon_box icon="ti-paint-roller" layout="large-centered-boxed" title="Decorating Services"]
		
		Foundry has a bright, flexible persona that can be adapted to suit almost any use. Use Foundry to sell or create a simple business website.
		
		[/foundry_icon_box][/vc_column][/vc_row][vc_row foundry_background_style="bg-secondary" foundry_padding="pt0"][vc_column][foundry_page_title layout="center-large-grey" title="Customer Testimonials" subtitle="Our customers love the work we do!"][foundry_testimonial_carousel pppage="4" layout="grid"][/vc_column][/vc_row][vc_row][vc_column width="5/12"][vc_column_text]
		<h3 class="uppercase color-primary">GET IN TOUCH</h3>
		<p class="lead">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.</p>
		
		
		<hr />
		
		438 Marine Parade
		Elwood, Victoria
		P.O Box 3184
		
		E: hello@foundry.net
		P: +614 3948 2726[/vc_column_text][/vc_column][vc_column width="1/12"][/vc_column][vc_column width="6/12"][contact-form-7 id="249"][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" foundry_padding="pt0"][vc_column][foundry_page_title layout="center-large-dark" title="Our Partners" subtitle="We love the brands we use, you will too!"][foundry_clients pppage="4" layout="static" filter="20"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_construction_template' );
}

if(!( function_exists('ebor_resume_2_template') )){
function ebor_resume_2_template($data){
    $template               = array();
    $template['name']       = 'Resume 2';
    $template['image_path'] = 'http://i.imgur.com/0SIXD1K.jpg';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_hero layout="intro-everything" image="896" embed="https://vimeo.com/88883554" button_text="Contact Me" button_url="#"]
		<h1 class="large" style="text-align: center;">Ben Kurns</h1>
		<p class="lead uppercase" style="text-align: center;">Designer &amp; Photographer</p>
		[/foundry_hero][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column width="1/6"][vc_column_text]
		[/vc_column_text][/vc_column][vc_column width="2/3"][vc_column_text]
		<h3 class="mb40 mb-xs-32" style="text-align: center;">A freelancer founded on the principles of Honesty, Clarity, Simplicity.</h3>
		<p class="lead mb0" style="text-align: center;">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
		[/vc_column_text][/vc_column][vc_column width="1/6"][vc_column_text]
		[/vc_column_text][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1443181935008{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/Unknown-2.jpeg?id=881) !important;}"][vc_column][vc_column_text]
		<h1 class="large" style="text-align: center;">My Work</h1>
		[/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column][foundry_portfolio pppage="6" type="grid-3col"][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1443181938883{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/Unknown-1.jpeg?id=880) !important;}"][vc_column][vc_column_text]
		<h1 class="large" style="text-align: center;">About Me</h1>
		[/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column width="1/2"][vc_column_text]
		<h4 class="uppercase mb40 mb-xs-24">EXPERTISE</h4>
		[/vc_column_text][vc_column_text]
		<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
		[/vc_column_text][foundry_skill_bar_block layout="outside" align="text-left" title="Art Direction" amount="90"][foundry_skill_bar_block layout="outside" align="text-left" title="Branding &amp; Identity" amount="80"][foundry_skill_bar_block layout="outside" align="text-left" title="Interface Design" amount="70"][foundry_skill_bar_block layout="outside" align="text-left" title="WordPress" amount="100"][/vc_column][vc_column width="1/2"][vc_column_text]
		<h4 class="uppercase mb40 mb-xs-24">EMPLOYMENT</h4>
		[/vc_column_text][vc_column_text]
		<p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
		[/vc_column_text][foundry_resume_item title="COUNT AGENCY" subtitle="Lead Art Direction" date="2015"][foundry_resume_item title="GOOGLE INC." subtitle="Art Direction" date="2015"][foundry_resume_item title="PIED PIPER" subtitle="Interface Design" date="2014"][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1443182108870{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/07/Unknown.jpeg?id=879) !important;}"][vc_column][vc_column_text]
		<h1 class="large" style="text-align: center;">My Blog</h1>
		[/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80"][vc_column][foundry_blog pppage="6" type="box"][/vc_column][/vc_row][vc_row full_height="yes" css=".vc_custom_1443182294183{background-image: url(http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/06/cover7.jpg?id=135) !important;}"][vc_column][vc_column_text]
		<h1 class="large" style="text-align: center;">Contact Me</h1>
		[/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pt180 pb180 pt-xs-80 pb-xs-80" parallax="" parallax_image=""][vc_column width="1/3"][vc_column_text]
		<h6 class="uppercase mb0">EMAIL</h6>
		<p class="fade-half">hello@foundryresume.net</p>
		[/vc_column_text][vc_column_text]
		<h6 class="uppercase mb0">PHONE</h6>
		<p class="fade-half">+614 482726</p>
		[/vc_column_text][vc_column_text]
		<h6 class="uppercase mb0">SKYPE</h6>
		<p class="fade-half">foundryresume</p>
		[/vc_column_text][vc_column_text]
		<h6 class="uppercase mb0">SNAIL MAIL</h6>
		<p class="fade-half">foundryresume
		melbourne
		australia</p>
		[/vc_column_text][/vc_column][vc_column width="1/3"][foundry_simple_social_icon icon="ti-dribbble" title="Dribbble" url="#"][foundry_simple_social_icon icon="ti-dropbox" title="Dropbox" url="#"][foundry_simple_social_icon icon="ti-facebook" title="Facebook" url="#"][foundry_simple_social_icon icon="ti-wordpress" title="WordPress" url="#"][foundry_simple_social_icon icon="ti-twitter-alt" title="Twitter" url="#"][foundry_simple_social_icon icon="ti-github" title="Github" url="#"][/vc_column][vc_column width="1/3"][contact-form-7 id="249"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_resume_2_template' );
}

if(!( function_exists('ebor_fashion_template') )){
function ebor_fashion_template($data){
    $template               = array();
    $template['name']       = 'Fashion';
    $template['image_path'] = 'http://foundry.mediumra.re/img/chooser/fashion.png';
    $template['content']    = <<<CONTENT
		[vc_row full_width="stretch_row"][vc_column][foundry_slider height="650px"][foundry_slider_content image="1324"]
		<h2 class="mb40 uppercase" style="text-align: center;">BOLD, VIBRANT, YOU.</h2>
		<p style="text-align: center;"><a class="btn btn-lg" href="#">EXPLORE COLLECTION</a></p>
		[/foundry_slider_content][/foundry_slider][/vc_column][/vc_row][vc_row foundry_padding="pt64 pb64"][vc_column][vc_column_text]
		<h6 class="uppercase mb0" style="text-align: center;">Free shipping on all orders over £50 for the month of October</h6>
		[/vc_column_text][/vc_column][/vc_row][vc_row foundry_padding="pt0 pb0"][vc_column width="1/2"][foundry_image_tile layout="vertical" image="1329" title="Fall Lookbook" url="#"][/vc_column][vc_column width="1/2"][foundry_image_tile layout="vertical" image="1323" title="Sustainability" url="#"][/vc_column][/vc_row][vc_row foundry_padding="pt64 pb64"][vc_column][vc_column_text]
		<h6 class="uppercase mb0" style="text-align: center;">Recent Arrivals This Month</h6>
		[/vc_column_text][recent_products per_page="3" columns="4" orderby="title" order="ASC"][/vc_column][/vc_row][vc_row foundry_padding="pt0 pb0"][vc_column width="1/2"][foundry_video_popup image="1322" webm="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/06/video.webm" mpfour="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/06/video.mp4" ogv="http://foundry.tommusdemos.wpengine.com/wp-content/uploads/sites/14/2015/06/video.ogv"][/vc_column][vc_column width="1/2"][foundry_image_tile layout="vertical" image="1330" title="#foundrylife" url="#"][/vc_column][/vc_row][vc_row el_class="no-padding-row"][vc_column width="1/4"][foundry_icon_box icon="ti-shopping-cart-full" layout="fashion" title="Shop Range"][/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-package" layout="fashion" title="Shipping Info"][/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-help-alt" layout="fashion" title="FAQ"][/foundry_icon_box][/vc_column][vc_column width="1/4"][foundry_icon_box icon="ti-receipt" layout="fashion" title="Returns Policy"][/foundry_icon_box][/vc_column][/vc_row][vc_row foundry_background_style="bg-dark" css=".vc_custom_1446119673757{padding-top: 40px !important;padding-bottom: 0px !important;}"][vc_column width="2/12"][foundry_modal fullscreen="yes" button_text="Sale!" image="1321" delay="5000" cookie="sale"][vc_column_text]
		<h2 class="uppercase pt96 pt-xs-0" style="text-align: center;">SPRING
		CLEARANCE SALE</h2>
		<p class="lead mb48" style="text-align: center;">Pick up all the hottest looks from our spring collection in our
		Spring Clearance Runout. Hurry, they won't last!</p>
		<p style="text-align: center;"><a class="btn btn-lg" href="#">SHOP THE SALE</a></p>
		[/vc_column_text][/foundry_modal][/vc_column][vc_column width="2/12"][vc_empty_space height="15px"][foundry_simple_social_icon icon="ti-facebook" title="Facebook" url="#"][/vc_column][vc_column width="2/12"][vc_empty_space height="15px"][foundry_simple_social_icon icon="ti-twitter-alt" title="Twitter" url="#"][/vc_column][vc_column width="6/12"][contact-form-7 id="274"][/vc_column][/vc_row]
CONTENT;
    array_unshift($data, $template);
    return $data;
}
add_filter( 'vc_load_default_templates', 'ebor_fashion_template' );
}
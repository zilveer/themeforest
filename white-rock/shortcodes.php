<?php
//////////////////////////////////////////////////////////////////
// Button shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button', 'shortcode_button');
	function shortcode_button($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'size' => '',
				'link' => '#',
				'target' => '',
				'color' => '',
			), $atts);
		
			return '<span><a href="' . $atts['link'] . '" target="' . $atts['target'] . '" class="' . $atts['size'] .' '. $atts['color'] . '">' .do_shortcode($content). '</a></span>';
	}
	
	
	add_shortcode('button_progression', 'shortcode_button_progression');
		function shortcode_button_progression($atts, $content = null) {
			$atts = shortcode_atts(
				array(
					'size' => '',
					'link' => '#',
					'target' => '',
					'color' => '',
				), $atts);
		
				return '<span><a href="' . $atts['link'] . '" target="' . $atts['target'] . '" class="' . $atts['size'] .' '. $atts['color'] . '">' .do_shortcode($content). '</a></span>';
		}




		
	//////////////////////////////////////////////////////////////////
	// Background shortcode
	//////////////////////////////////////////////////////////////////
	add_shortcode('background', 'shortcode_background');
		function shortcode_background($atts, $content = null) {
			$atts = shortcode_atts(
				array(
					'heading' => ''
				), $atts);

				return '<span></div><!-- close .container -->
				<div class="clearfix"></div>
				<div class="content-highlight">
					<div class="container"><h3>' . $atts['heading'] . '</h3>' .do_shortcode($content). '</div>
				</div><!-- close .content-highlight -->
				<div class="container"></span>';
		}

	



	//////////////////////////////////////////////////////////////////
	// Divider shortcode
	//////////////////////////////////////////////////////////////////

	add_shortcode('divider', 'shortcode_divider');
		function shortcode_divider($atts, $html = null) {
			$html .= '<hr class="progression-hr"></hr>';

			return $html;
		}

	
//////////////////////////////////////////////////////////////////
// Column one_half shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_half', 'shortcode_one_half');
	function shortcode_one_half($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid2column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid2column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_third', 'shortcode_one_third');
	function shortcode_one_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid3column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid3column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column two_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('two_third', 'shortcode_two_third');
	function shortcode_two_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid3columnbig lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid3columnbig">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_fourth', 'shortcode_one_fourth');
	function shortcode_one_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid4column lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid4column">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column three_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('three_fourth', 'shortcode_three_fourth');
	function shortcode_three_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="grid4columnbig lastcolumn">' .do_shortcode($content). '</div><div class="clearfix"></div>';
			} else {
				return '<div class="grid4columnbig">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// toggle shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('toggle', 'shortcode_toggle');
	function shortcode_toggle($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'status' => '',
				'title' => '',
				'target' => '',
				'color' => '',
			), $atts);
		
			return '<span><ul class="progression-toggle"><li class="progression_active">' . $atts['title'] . '</li><div class="div_progression_toggle ' . $atts['status'] . '">' .do_shortcode($content). '</div></ul></span>';
	}
	

	
	
//////////////////////////////////////////////////////////////////
// Add Tabs shortcode
//////////////////////////////////////////////////////////////////	
	
add_shortcode( 'tabgroup', 'jqtools_tab_group' );
function jqtools_tab_group( $atts, $content ){
	$GLOBALS['tab_count'] = 0;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		$counter=1;
		$panes[] = '';
		foreach( $GLOBALS['tabs'] as $tab ){
			if($counter == 1) {
				$tabs[] = '<li class="progression-tab"><a href="#tab'.$counter.'">'.$tab['title'].'</a></li>';
			} else {
				$tabs[] = '<li class="progression-tab"><a href="#tab'.$counter.'">'.$tab['title'].'</a></li>';
			}

			if($counter == 1) {
				$panes[] = '<div id="tab'.$counter.'">'.$tab['content'].'</div>';
			} else {
				$panes[] = '<div id="tab'.$counter.'">'.$tab['content'].'</div>';
			}
			$counter++;
		}
		$panes[] = '';
		$return = "".'<!-- the tabs --><div class="progression-tab-container"><ul class="progression-etabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" -->'.implode( "\n", $panes ).''."\n</div>";
	}
	return $return;
}

add_shortcode( 'tab', 'jqtools_tab' );
function jqtools_tab( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}
	
//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
add_action('init', 'add_button');


function add_button() {
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages')){
         return;
        }
        if ( get_user_option('rich_editing') == 'true' ) {
            global $typenow;
            if (empty($typenow) && !empty($_GET['post'])) {
                $post = get_post($_GET['post']);
                $typenow = $post->post_type;
            }
            if ("portfolio" == $typenow || "product" == $typenow || "post" == $typenow || "page" == $typenow){
               	add_filter('mce_external_plugins', 'add_plugin');  

			     add_filter('mce_buttons_3', 'register_button');
            }
       }
    }

 

function register_button($buttons) {  
   array_push($buttons, "button", "button_progression", "one_half", "one_third", "two_third", "one_fourth", "three_fourth", "toggle", "tabs", "divider");  
   return $buttons;  
}  

function add_plugin($plugin_array) {  
   $plugin_array['button'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['button_progression'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_half'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_third'] = get_template_directory_uri().'//tinymce/customcodes.js';
   $plugin_array['two_third'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['one_fourth'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['three_fourth'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['toggle'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['divider'] = get_template_directory_uri().'/tinymce/customcodes.js';
   return $plugin_array;  
}  
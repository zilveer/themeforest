<?php

include_once LANDINGPAGES_PATH.'hooks/hooks.global.php';


/*add_action( 'wp_enqueue_scripts', 'lp_fontend_enqueue_scripts' );

function lp_fontend_enqueue_scripts( $hook ) {
	global $post;
	if ( $post->post_type=='landing-page' ) {
		// Conditional TINYMCE for landing pages
		//wp_register_script('jquery-bindfirst',LANDINGPAGES_URLPATH . 'js/jquery.bindfirst.js');
		//wp_enqueue_script('jquery-bindfirst');
	}

}*/

function lp_conversion_area( $content=null, $return=false ) {
	global $post;
	$wrapper_class = "";

	if ( lp_get_value( $post, 'lp', 'conversion-area' ) ) {
		$content = do_shortcode( lp_get_value( $post, 'lp', 'conversion-area' ) );
	}
	else {
		$content = do_shortcode( $content );
	}

	$standardize_form = get_option( 'main-landing-page-auto-format-forms' , 1 ); // conditional to check for options

	if ( $standardize_form ) {
		$wrapper_class = lp_discover_important_wrappers( $content );
		$content = lp_rebuild_attributes( $content );
	}

	if ( !$return ) {

		echo "<div id='lp_container' class='$wrapper_class'>".$content."</div>";
	}
	else {
		return "<div id='lp_container'  class='$wrapper_class'>".$content."</div>";
	}
}

function lp_discover_important_wrappers( $content ) {
	$wrapper_class = "";
	if ( strstr( $content, 'gform_wrapper' ) ) {
		$wrapper_class = 'gform_wrapper';
	}
	return $wrapper_class;
}

function lp_rebuild_attributes( $content ) {
	if ( strstr( $content, '<form' ) ) {
		// Remove All Divs Elements
		$content = strip_tags( $content, '<button><script><textarea><style><input><form><select><label><a><p><b><u><strong><i><img><strong><span><font><h1><h2><h3><tbody><center><blockquote><embed><object><small>' );

		if ( !strstr( $content, '<label' )&&strstr( $content, '<p' ) ) {
			$content = str_replace( '<p>', '<label >', $content );
			$content = str_replace( '</p>', '</label>', $content );
			//echo $content; exit;
		}

		if ( !strstr( $content, '<label' )&&strstr( $content, '<span' ) ) {
			$content = str_replace( '<span', '<label', $content );
			$content = str_replace( '</span>', '</label>', $content );
		}

		$form = preg_match_all( '/\<form(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				$new_value = $value;
				$form_name = preg_match( '/ name *= *["\']?([^"\']*)/i', $value, $name ); // 1 for true. 0 for false
				$form_id = stristr( $value, ' id=' );
				$form_class = stristr( $value, ' class=' );

				( $form_name ) ? $name = $name[1] : $name = "id";

				if ( $form_id ) {
					$new_value = preg_replace( '/ id=(["\'])(.*?)(["\'])/', ' id="lp-form-'.$name.' $2"', $new_value );
				}
				else {
					$new_value = str_replace( '<form ', '<form id="lp-form-'.$name.'" ', $new_value );
				}

				if ( $form_class ) {
					$new_value = preg_replace( '/ class=(["\'])(.*?)(["\'])/', ' class="lp-form $2"', $new_value );
				}
				else {
					$new_value = str_replace( '<form ', '<form class="lp-form" ', $new_value );
				}

				$content = str_replace( $value, $new_value, $content );
			}
		}

		// Standardize all Labels
		$inputs = preg_match_all( '/\<label(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				$new_value = $value;
				// regex to match text in label /(?<=[>])[^<>]+(?=[<])/g
				( preg_match( '/ for *= *["\']?([^"\']*)/i', $value, $for ) ) ?  $for = $for[1] : $for = 'input';
				$for = str_replace( ' ', '-', $for );

				$new_value = preg_replace( '/ id=(["\'])(.*?)(["\'])/', '', $new_value );

				$new_value = preg_replace( '/ class=(["\'])(.*?)(["\'])/', '', $new_value );

				$new_value = str_replace( '<label ', '<label id="lp-label-'.$for.'" ', $new_value );
				$new_value = str_replace( '<label ', '<label class="lp-input-label" ', $new_value );
				//$new_value = str_replace('<label>','<label class="lp-select-heading"> ', $new_value); // fix select headings


				//$new_value  = "<div id='lp_field_'
				$content = str_replace( $value, $new_value, $content );
			}
		}

		/* Fix empty labels (aka select headings)
			$inputs = preg_match_all('/\<label(.*?)\>/s',$content, $matches);
			if (!empty($matches[0]))
			{
				foreach ($matches[0] as $value)
				{
					$new_value = str_replace('<label>','<p class="lp-select-heading">', $value);
					$new_value = str_replace('</label>','</p>', $new_value); // doesn't work
					$content = str_replace($value,$new_value, $content);
				}
			}
		*/
		// Standardize all input fields
		$inputs = preg_match_all( '/\<input(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				$new_value = $value;
				//get input name
				( preg_match( '/ name *= *["\']?([^"\']*)/i', $new_value, $name ) ) ? $name = $name[1] : $name = "button";

				// get input type
				( preg_match( '/ type *= *["\']?([^"\']*)/i', $new_value, $type ) ) ? $type = $type[1] : $type = "text";


				// if class exists do this
				if ( preg_match( '/ class *= *["\']?([^"\']*)/i', $new_value, $class ) ) {
					$new_value = preg_replace( '/ class=(["\'])(.*?)(["\'])/', ' class="lp-input-'.$type.'"', $new_value );
				}
				else {
					$new_value = str_replace( '<input ', '<input class="lp-input-'.$type.'" ', $new_value );
				}

				// if id exists do this
				if ( preg_match( '/ id *= *["\']?([^"\']*)/i', $new_value, $class ) ) {
					$new_value = preg_replace( '/ id=(["\'])(.*?)(["\'])/', ' id="lp-'.$type.'-'.$name.'"', $new_value );
				}
				else {
					$new_value = str_replace( '<input ', '<input id="lp-'.$type.'-'.$name.'" ', $new_value );
				}

				$content = str_replace( $value, $new_value, $content );
			}
		}


		// Standardize All Select Fields
		$selects = preg_match_all( '/\<select(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				preg_match( '/ name *= *["\']?([^"\']*)/i', $value, $name );
				$name = $name[1];

				$new_value = preg_replace( '/ id=(["\'])(.*?)(["\'])/', ' id="lp-select-'.$name.'"', $value );
				$new_value = preg_replace( '/ class=(["\'])(.*?)(["\'])/', ' class="lp-input-select"', $new_value );
				$content = str_replace( $value, $new_value, $content );
			}
		}




		// Standardize All Select Fields
		$fields = preg_match_all( "/\<label(.*?)\<input(.*?)\>/si", $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				//echo $value;exit;
				//echo "<hr>";
				( preg_match( '/Email|e-mail|email/i', $value, $email_input ) ) ? $email_input = "lp-email-value" : $email_input = "";

				// match name or first name. (minus: name=, last name, last_name,)
				( preg_match( '/(?<!((last |last_)))name(?!\=)/im', $value, $first_name_input ) ) ? $first_name_input = "lp-first-name-value" : $first_name_input = "";

				// Match Last Name
				( preg_match( '/(?<!((first)))(last name|last_name|last)(?!\=)/im', $value, $last_name_input ) ) ? $last_name_input = "lp-last-name-value" : $last_name_input = "";


				$new_value  = "<div class='lp_form_field $email_input $first_name_input $last_name_input'>".$value."</div>";

				$content = str_replace( $value, $new_value, $content );
			}

		}


		// Fix All Span Tags
		$inputs = preg_match_all( '/\<span(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				$new_value = preg_replace( '/\<span(.*?)\>/s', '<span class="lp-span">', $value );
				$content = str_replace( $value, $new_value, $content );
			}
		}

		// Fix All <p> Tags
		$inputs = preg_match_all( '/\<p(.*?)\>/s', $content, $matches );
		if ( !empty( $matches[0] ) ) {
			foreach ( $matches[0] as $value ) {
				$new_value = preg_replace( '/\<p(.*?)\>/s', '<p class="lp-paragraph">', $value );
				$content = str_replace( $value, $new_value, $content );
			}
		}

		//handle gform error messages
		if ( strstr( $content, 'There was a problem with your submission. Errors have been highlighted below.' ) ) {
			$content = preg_replace( '/(There was a problem with your submission. Errors have been highlighted below.)/', '<div class="validation_error">$1</div>', $content );
			$content = preg_replace( '/(Please enter a valid email address.)/', '<div class="gfield_description validation_message">$1</div>', $content );
			$content = preg_replace( '/(This field is required.)/', '<div class="gfield_description validation_message">$1</div>', $content );
		}
		//echo $content;exit;
	}

	return $content;
}

function lp_main_headline( $headline=null, $return=false ) {
	if ( !$headline ) {
		global $post;
		if ( !$return ) {
			echo lp_get_value( $post, 'lp', 'main-headline' );
		}
		else {
			return lp_get_value( $post, 'lp', 'main-headline' );
		}
	}
	else {
		if ( !$return ) {
			echo $headline;
		}
		else {
			return $headline;
		}
	}
}


function lp_body_class() {
	global $post;
	global $lp_data;
	// Need to add in lp_right or lp_left classes based on the meta to float forms
	// like $conversion_layout = lp_get_value($post, $key, 'conversion-area-placement');
	if ( get_post_meta( $post->ID, 'lp-selected-template', true ) ) {
		$lp_body_class = "template-" . get_post_meta( $post->ID, 'lp-selected-template', true );
		$postid = "page-id-" . get_the_ID();
		echo 'class="';
		echo $lp_body_class . " " . $postid . " wordpress-landing-page";
		echo '"';
	}
	return $lp_body_class;
}

function lp_get_parent_directory( $path ) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		$array = explode( "\\", $path );
	} else {
		$array = explode( '/', $path );
	}
	$count = count( $array );
	$key = $count -1;
	$parent = $array[$key];

	return $parent;
}

function lp_get_extended_template_paths() {
	//scan through templates directory and pull in name paths
	$uploads = wp_upload_dir();
	$uploads_path = $uploads['basedir'];
	$extended_path = $uploads_path.'/landing-pages/templates/';
	$template_paths = array();

	if ( !is_dir( $extended_path ) ) {
		wp_mkdir_p( $extended_path );
	}

	$results = scandir( $extended_path );


	//scan through templates directory and pull in name paths
	foreach ( $results as $name ) {
		if ( $name === '.' or $name === '..' or $name === '__MACOSX' ) continue;

		if ( is_dir( $extended_path . '/' . $name ) ) {
			$template_paths[] = $name;
		}
	}

	return $template_paths;
}

function lp_get_core_template_paths() {

	$template_path =LANDINGPAGES_PATH."/templates/" ;
	$results = scandir( $template_path );

	//scan through templates directory and pull in name paths
	foreach ( $results as $name ) {
		if ( $name === '.' or $name === '..' or $name === '__MACOSX' ) continue;

		if ( is_dir( $template_path . '/' . $name ) ) {
			$template_paths[] = $name;
		}
	}

	return $template_paths;
}

function lp_get_template_data() {
	global $lp_data;
	return $lp_data;
}

function lp_get_value( $post, $key, $id ) {
	if ( isset( $post ) )
		return get_post_meta( $post->ID, $key.'-'.$id , true );
}


function lp_check_active() {
	return 1;
}
/* Not Working =(
function lp_add_option_box($key) {
	// $path = LANDINGPAGES_URLPATH.'templates/'.$key.'/';
	// include_once(LANDINGPAGES_PATH."/templates/$key/custom-functions.php");
$path = dirname(__FILE__) . '/templates/' . $key;
if(file_exists( $path . '/custom-functions.php')) {
 	include $path . "/custom-functions.php";
}
}
*/
?>

<?php
//Access Wordpress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp . '/wp-load.php' );

//Shortcodes Definitions
require_once( 'shortcodes-definitions.php' );

//Option Element Function
require_once( 'shortcode-attributes.php' );
 
//Shortcode html
$html_options = null;

$shortcode_html = '

<div id="shortcode-generator">
    					
	<div class="shortcode-content">
		<div class="row">
		<div class="label"><strong>Shortcodes</strong></div>			
		<div class="content"><select id="thb-shortcodes" data-placeholder="' . __("Choose a shortcode", 'north') .'">
	    <option></option>';
		
		foreach( $thb_shortcodes as $shortcode => $options ){
			
			if(strpos($shortcode,'header') !== false) {
				$shortcode_html .= '<optgroup label="'.$options['title'].'">';
			}
			else {
				$shortcode_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
				$html_options .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'" data-type="'.$options['type'].'">';
				
				if( !empty($options['attr']) ){
					 foreach( $options['attr'] as $name => $attr_option ){
						$html_options .= thb_option_element( $name, $attr_option, $options['type'], $shortcode );
					 }
				}

				$html_options .= '</div>'; 
			}
			
		} 

$shortcode_html .= '</select></div></div>'; ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo THB_THEME_ROOT; ?>/inc/tinymce/shortcode_generator/css/tinymce.css" />
<link rel="stylesheet" href="<?php echo THB_THEME_ROOT; ?>/inc/tinymce/shortcode_generator/css/chosen/chosen.css" />
<script src="<?php echo THB_THEME_ROOT; ?>/inc/tinymce/shortcode_generator/js/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo THB_THEME_ROOT; ?>/inc/tinymce/shortcode_generator/js/popup.min.js"></script>

</head>

<body>	
<?php echo $shortcode_html . $html_options;  ?>

	<code class="shortcode_storage">
			<span id="shortcode-storage-thb"></span>
	</code>
	<a class="thb-btn" id="add-shortcode"><?php echo __( 'Add Shortcode', 'north' ); ?></a>
	
</div>

</div>
</body>
</html>
<?php

// Load WordPress Bootstrap
$wp_include = '../wp-load.php';
$i = 0; while ( !file_exists( $wp_include ) && $i++ < 10 ) {
  $wp_include = "../$wp_include";
}

require_once( $wp_include );

if ( !current_user_can( 'upload_files' ) )
	wp_die( __( 'You do not have permission to access this file.', MYSITE_ADMIN_TEXTDOMAIN ) );
	
@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

// Output CSS for the menu
?><style type = "text/css">
body{padding:0px;margin:0px;font-family:"arial";font-size:11px;}
ul{padding:6px 15px;margin:0px;}
.icon_tab_holder{border-bottom:1px solid #d7d7d7;background:#f7f7f7;position:relative;width:100%;height:34px;}
.icon_tab_holder li{color:#555;float:left;padding:7px 25px;list-style-type:none;margin-right:1px;border:1px solid transparent;border-radius:4px 4px 0 0;}
.icon_tab_holder li:hover{cursor:pointer;}
.icon_tab_holder li.active{border:1px solid #ddd;border-bottom-color:#fff;;background:#fff;}
.icon_folder{clear:both;display:none;margin:10px;position:relative;}
#result{float:left;margin-right:15px;}
.icon_folder img{margin-right:2px;margin-bottom:2px;}
div.active{display:block !important;}

</style>

<?php
// Output javascript for the menu
wp_print_scripts( 'jquery' );

?><script type = "text/javascript">
jQuery(document).ready(function(){
	jQuery(".icon_tab_holder ul > li:first, .icon_folder:first").addClass("active");
	jQuery(".icon_tab_holder ul li").live("click", function(){
		jQuery(".icon_folder, li").removeClass("active");
		var i = jQuery(this).attr("data-id");
		jQuery("." + i + "_icons").addClass("active");
		jQuery(this).addClass("active");
	});

var type = window.parent.jQuery("#current_icon_type").attr("data-type");
jQuery(".icon_folder img").live("click", function(){
	window.parent.jQuery("#"+type+"_result").html("<img src = "+jQuery(this).get(0).src+" />");
	window.parent.tb_remove();
	window.parent.jQuery("#sc-"+type+"-type").val(jQuery(this).attr("data-type"));
	window.parent.jQuery("#sc-"+type+"-style").val(jQuery(this).attr("data-style"));
});

});
</script>

<?php

$out = '';

// Scan folders in icon directory
$folders = array();
$template_path = THEME_IMAGES_DIR . '/icons';
$dir_iterator = new RecursiveDirectoryIterator( $template_path );
$iterator = new RecursiveIteratorIterator( $dir_iterator, RecursiveIteratorIterator::SELF_FIRST );

// Loop through each file & folder & create array()
foreach ( $iterator as $file ) {
	if( $file->isDir() ) {
		$file_name = $file->getFilename();
		if( $file_name[0] != '.' ) {
			$folders[$file_name] = $file_name;
			$folder_var = $file_name;
		}
	}
	if( !$file->isDir() )
		${$folder_var}[] = $file->getFilename();
}

// Unset icon folders from array if not needed
if( isset( $_GET['shortcode'] ) ) {
	if( $_GET['shortcode'] != 'icon_banner' ) {
		unset( $folders['_banners'] );

	} elseif( $_GET['shortcode'] == 'icon_banner' ) {
		foreach( $folders as $folder ) {
			if( $folder != '_banners' )
				unset( $folders[$folder] );
		}
	}
}

// Our thickbox that holds the preset icons
$out .= '<div id = "icon_preset_tb">';
$out .= '<div class = "icon_tab_holder"><ul>';

// Display folder items
foreach ($folders as $folder) {
	$label = strtoupper(str_replace('_', ' ', $folder));
	$out .= '<li data-id = "'.$folder.'">'.$label.'</li>';
}

$out .= '</ul></div>';

// Display icons within each folder
foreach ($folders as $folder) {
	$out .= '<div class = "'.$folder.'_icons icon_folder">'; 

	foreach( ${$folder} as $key => $icon ){
		if ($icon === '.' or $icon === '..') continue;
		$type = str_replace('.png', '', $icon);
		$out .= '<img data-style = "'.$folder.'" data-type = "'.$type.'" src = "' . THEME_IMAGES . '/icons/' . $folder . '/' . $icon .'" />';
	}
	
	$out .= '</div>';
}

$out .= '</div>';

echo $out;

?>
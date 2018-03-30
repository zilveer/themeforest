<?php
//======================================================================
// MAP
//======================================================================

//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'full-map';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// Map
//-----------------------------------------------------

$display_in_page_header = get_post_meta($post->ID, $key.'_in_heder', true );
$gmap_title = get_post_meta($post->ID, $key.'_title', true );
$gmap_address = get_post_meta($post->ID, $key.'_address', true );
$gmap_loc = get_post_meta($post->ID, $key.'_loc', true );
$gmap_height = get_post_meta($post->ID, $key.'_height', true );
$gmap_width = get_post_meta($post->ID, $key.'_width', true );
$gmap_zoom = get_post_meta($post->ID, $key.'_zoom', true );
$gmap_align = get_post_meta($post->ID, $key.'_align', true );

$gmap_location = ($gmap_address > "" ? $gmap_address : $gmap_loc);

if ($gmap_location > "" && $display_in_page_header != 1){
    $gmap_shortcode = '[google_map title="'.$gmap_title.'" location="'.$gmap_location.'" height="'.$gmap_height.'" width="'.$gmap_width.'" zoom="'.$gmap_zoom.'" align="'.$gmap_align.'"]';
?>
<div class="row">
<div class="col-xs-12"><div class="aligncenter"><?php echo do_shortcode($gmap_shortcode); ?></div></div>
</div>
<?php }

//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );

//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
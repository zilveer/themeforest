<?php
//======================================================================
// Page Header Template
//======================================================================

//-----------------------------------------------------
// Set Key
//-----------------------------------------------------
$key = 'themo_page_header';
$i = 1;
$key = 'themo_page_header_'.$i;

//-----------------------------------------------------
// Display On?
//-----------------------------------------------------
$themo_page_ID = $post->ID;

// Support for Woo Pages.
// Sometimes the page id isn't explicit so we have to go and look for it.
$themo_woo_page_ID = themo_return_woo_page_ID();
if($themo_woo_page_ID){
    $themo_page_ID = $themo_woo_page_ID;
}

$show = get_post_meta($themo_page_ID, $key.'_show', true );
$show_header = get_post_meta($themo_page_ID, $key.'_show_header', true );
$page_header_float = get_post_meta($themo_page_ID, $key.'_header_float', true );

// Animation
$themo_enable_animate = get_post_meta($themo_page_ID, $key.'_animate', true );
$themo_animation_style = get_post_meta($themo_page_ID, $key.'_animate_style', true );

// Anchor
if($key > ""){
	$anchor_id_markup = "";
	$anchor_key = sanitize_text_field(get_post_meta($themo_page_ID, $key.'_anchor', true ));
	if($anchor_key > ""){
		$anchor_id_markup = "id='$anchor_key'";
	}
};

// Return Icon Markup
$glyphicon_markup = false;
$glyphicon_markup = themo_do_glyphicons_markup(null,$themo_page_ID,$key,true);


if($page_header_float == ''){
	$page_header_float = "centered";
}

if ($show == 1){ ?>

	<?php
	// Default Header Styling
	$page_subheader_default = '<div class="subheader"></div>';
	$page_subheader_default_show = true; // Show subheader by default
    $page_header_title = "<h1>" . roots_title() . "</h1>";

	$page_header_text = "";
	?>

	<?php
	//-----------------------------------------------------
	// Header and Subtext
	//-----------------------------------------------------
	if($show_header == 1){ // Show header / subetext?
		$meta_box_heading = get_post_meta($themo_page_ID, $key.'_header', true ); // get heading
		$meta_box_subtext = get_post_meta($themo_page_ID, $key.'_subtext', true ); // get subtext


		$meta_box_float = get_post_meta($themo_page_ID, $key.'_header_float', true ); // get alignment

		$page_header_title = "<h1 class='page-title-h1 ".themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .page-title-h1')."'>" . $meta_box_heading. "</h1>"; // Returns Page header title
		$page_header_text = "";
		if($meta_box_subtext > ""){
			$page_header_text = "<h4 class='page-title-h4 ".themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .page-title-h4')."'>" . $meta_box_subtext. "</h4>"; // Returns Page header text
		}

		// Button
        $button = false;
        $button2 = false;
        $page_header_button = false;

        $button = themo_do_shortocde_button($themo_page_ID, $key, true);
        $button2 = themo_do_shortocde_button($themo_page_ID, $key, true,false,2);
        if ($button > "" || $button2 > "") {
            $page_header_button = "<div class='page-title-button ".themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .page-title-button')."'>".do_shortcode($button).do_shortcode($button2)."</div>";
        }

	?>

	<?php
	//-----------------------------------------------------
	// MAP
	//-----------------------------------------------------
	$show_map = get_post_meta($themo_page_ID, 'themo_map_1_show', true ); // Returns Show Map (on / off)

	$gmap_title = get_post_meta($themo_page_ID, 'themo_map_1_title', true );
	$gmap_address = get_post_meta($themo_page_ID, 'themo_map_1_address', true );
	$gmap_loc = get_post_meta($themo_page_ID, 'themo_map_1_loc', true );
	$gmap_height = get_post_meta($themo_page_ID, 'themo_map_1_height', true );
	$gmap_width = get_post_meta($themo_page_ID, 'themo_map_1_width', true );
	$gmap_zoom = get_post_meta($themo_page_ID, 'themo_map_1_zoom', true );
	$gmap_align = get_post_meta($themo_page_ID, 'themo_map_1_align', true );
	$gmap_location = ($gmap_address > "" ? $gmap_address : $gmap_loc);
	$map_in_header = get_post_meta($themo_page_ID, 'themo_map_1_in_heder', true ); // Returns Google Map
	$gmap_show = false;

	// Check if gmail is in header  / output
	if ($map_in_header == 1 && $map_in_header > "" && $show_map == 1){
	$gmap_show = true;
	$gmap_shortcode = '[google_map title="'.$gmap_title.'" location="'.$gmap_location.'" height="'.$gmap_height.'" width="'.$gmap_width.'" zoom="'.$gmap_zoom.'"]';

	$page_subheader_default_show = false; // Don't show subheader, we'll replace with gmaip ?>
		<div class="aligncenter"><?php echo do_shortcode($gmap_shortcode); ?></div>
	<?php } ?>
	<?php
	//-----------------------------------------------------
	// Background
	//-----------------------------------------------------
	$background_show = get_post_meta($themo_page_ID, $key.'_show_background', true );

	if($background_show == 1 && !$gmap_show){
		$page_subheader_default_show = false; // Don't show subheader, we'll replace with an image
		$partName = 'background';
		include( locate_template('templates/meta-part-' . $partName . '.php') );
		?>
        <?php
		//-----------------------------------------------------
		// GET BORDER
		//-----------------------------------------------------
		$partName = 'border';
		include( locate_template('templates/meta-part-' . $partName . '.php') );
		// If there is a anchor link for one pager style, create output
		?>
   		<div <?php echo sanitize_text_field($anchor_id_markup); ?> class="preloader loading">
			<section <?php if($key > ""){echo 'id="'.$key.'"';} ?> class="<?php echo sanitize_text_field($parallax_classes) ; ?>" <?php echo sanitize_text_field($parallax_data) ; ?> >
				<div class='container'>
					<div class='row'>
                        <div class="<?php echo 'page-title ' . $page_header_float; ?>">
                            <?php echo wp_kses_post($glyphicon_markup); ?>
                            <?php echo wp_kses_post($page_header_title); ?>
							<?php echo wp_kses_post($page_header_text); ?>
                            <?php echo wp_kses_post($page_header_button); ?>
						</div>
					</div><!-- /.row -->
				</div><!-- /.container -->
			</section>
		</div>
        <?php
		//-----------------------------------------------------
		// GET BORDER CLOSE
		//-----------------------------------------------------
		$partName = 'border-close';
		include( locate_template('templates/meta-part-' . $partName . '.php') );
		?>
    <?php
	// backstretch for mobile support
	if ($background_js > ""){ ?>
		<script>
    		jQuery(document).load(function($) {
				"use strict";
				if (Modernizr.touch) {
					<?php echo sanitize_text_field($background_js);  ?>
				}
			});
    	</script>
    <?php } ?>
	<?php }elseif($show_header == 1 && !$gmap_show){
	$page_subheader_default_show = false; // Don't show subheader, we'll replace with an image
	echo wp_kses_post($page_subheader_default);
	?>
    <?php
	//-----------------------------------------------------
	// GET BORDER
	//-----------------------------------------------------
	$partName = 'border';
	include( locate_template('templates/meta-part-' . $partName . '.php') );
	?>
        <div class="container">
            <div class="row">
                <section <?php if($key > ""){echo 'id="'.$key.'"';} ?> class="<?php echo 'page-title ' . $page_header_float; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.'.page-title'); ?>">
                    <?php echo wp_kses_post($glyphicon_markup); ?>
                    <?php echo wp_kses_post($page_header_title) ?>
                    <?php echo wp_kses_post($page_header_text) ?>
					<?php echo wp_kses_post($page_header_button); ?>
                </section>
             </div>
        </div>
    <?php
	//-----------------------------------------------------
	// GET BORDER CLOSE
	//-----------------------------------------------------
	$partName = 'border-close';
	include( locate_template('templates/meta-part-' . $partName . '.php') );
	?>
	<?php }
		 // background ?>
<?php } // Header = on ?>

<?php
// Output subheader if no map or image
if ($page_subheader_default_show){
	echo wp_kses_post($page_subheader_default); ?>

	<?php
    //-----------------------------------------------------
    // GET BORDER
    //-----------------------------------------------------
    $partName = 'border';
    include( locate_template('templates/meta-part-' . $partName . '.php') );
    ?>
    <div class="container">
            <div class="row">
                <section <?php if($key > ""){echo 'id="'.$key.'"';} ?> class="<?php echo 'page-title ' . $page_header_float; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.'.page-title'); ?>">
                    <?php echo wp_kses_post($page_header_title) ?>
                </section>
             </div>
        </div>
	<?php
    //-----------------------------------------------------
    // GET BORDER CLOSE
    //-----------------------------------------------------
    $partName = 'border-close';
    include( locate_template('templates/meta-part-' . $partName . '.php') );
     }
}elseif($show == ''){
    // Check post type and skip product post types
    $post_type = get_post_type( $themo_page_ID );

    if(isset($post_type) && $post_type == 'product'){
        // Do nothing
    }else{
	    $page_subheader_default = '<div class="subheader"></div>';
	    $page_header_title = "<h1>" . roots_title() . "</h1>";
	    echo wp_kses_post($page_subheader_default);
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<section class="page-title left">';
                    echo wp_kses_post($page_header_title);
                echo '</section>';
            echo '</div>';
        echo '</div>';
        echo '<div class="meta-border content-width"></div>';
    }

} // Show = on?>


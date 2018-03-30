<?php
//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
?>

<?php
// If there is a unique ID specified, use it, else use the key.
if(isset($section_uid) && $section_uid > ""){
	$section_key = $section_uid;
}else{
	$section_key = $key;
}
?>

<?php 

// If there is a anchor link for one pager style, create output
if($section_key > ""){
	$anchor_id_markup = "";
	$anchor_key = get_post_meta($post->ID, $key.'_anchor', true );
	if($anchor_key > ""){
		$anchor_id_markup = "id='$anchor_key'";
	}
};

// Check for parallax background images, if present, add preloading classes.
if (strpos($parallax_classes,'parallax-preload') > 0){
	echo '<div '.$anchor_id_markup.' class="preloader loading">';
}else{
	echo '<div '.$anchor_id_markup.' >';
}
?>

<section <?php if($section_key > ""){echo 'id="'.$section_key.'"';} ?> class=" <?php echo sanitize_text_field($section_template_class); ?> <?php echo sanitize_text_field($parallax_classes) ; ?>" <?php echo sanitize_text_field($parallax_data) ; ?> >
<?php echo wp_kses_post($inner_container_open);?>
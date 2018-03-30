<?php
$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(berg_getPageId()), 'large_bg');
$img_url = $img_url[0];

$post_meta = get_post_meta(berg_getPageId());
$section_intro_opacity = 0;
$dataOpacityStart = 30;
$dataOpacityEnd = 100;
$dataHeight = 300;


$section_intro_type = $post_meta['section_intro'][0];
if(isset($post_meta['section_intro_custom_height'][0])){ 
	$section_intro_custom_height = $post_meta['section_intro_custom_height'][0];
} else {
	$section_intro_custom_height = 300;
}

if($section_intro_type == 'default') {
	$dataHeight = YSettings::g('berg_intro_custom_height');
}

if($section_intro_type == 'section_intro_4' && $section_intro_custom_height != '') {
	$dataHeight = $section_intro_custom_height;
}


if(isset($post_meta['intro_opacity'][0])) {
	$section_intro_opacity = $post_meta['intro_opacity'][0];
	if($section_intro_opacity != 'default') {
		$dataOpacityStart = $section_intro_opacity; 

	} else {
		$dataOpacityStart = YSettings::g('berg_intro_opacity_start');
	} 

} 

$section_intro_opacity_end = 0;
if(isset($post_meta['intro_opacity_end'][0])) {
	$section_intro_opacity_end = $post_meta['intro_opacity_end'][0];
	if($section_intro_opacity_end != 'default') {
		$dataOpacityEnd = $section_intro_opacity_end; 

	} else {
		$dataOpacityEnd = YSettings::g('berg_intro_opacity_end');
	}
}

$contact = false; 


if(isset($post_meta['_wp_page_template']) && $post_meta['_wp_page_template'][0] == 'contact.php') {
	$contact = true;

}

if($img_url == '')
	$img_url = 'http://placehold.it/1440x900&amp;text=Please+select+featured+image';
?>
<?php
if (isset($post_meta['intro_color'][0])) {
	$intro_color = $post_meta['intro_color'][0];
	$customIntroColorStyle = 'style="background-color: '.$intro_color.';"';
} else {
	$customIntroColorStyle = '';
}

$intro_txt_position =  isset($post_meta['intro_txt_position'][0]) ? $post_meta['intro_txt_position'][0] : 'default';
if ($intro_txt_position != 'default') {
	$txt_align = 'text-align: '.$intro_txt_position.'';
	$class_position = 'intro-position-'.$intro_txt_position;
} else {
	$txt_align = 'text-align: '.YSettings::g('berg_intro_text_alignment');
	$class_position = 'intro-position-'.YSettings::g('berg_intro_text_alignment');
}

?>
<div class="intro-wrapper" <?php echo $customIntroColorStyle; ?>>
	<div class="section-intro section-intro-custom" data-height="<?php echo $dataHeight; ?>" data-opacity-start="<?php echo $dataOpacityStart;?>" data-opacity-end="<?php echo $dataOpacityEnd;?>" <?php echo (!$contact) ? 'data-background="'.$img_url.'"' : '';?>>
		<?php if($contact == true) {
			get_template_part('intro', 'contact');
		}
		?>


		<div class="pre-content">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-10 col-md-offset-1">
						<h1 style="<?php echo $txt_align ;?>" class="<?php echo $class_position ;?> parallax-element-first <?php echo (get_post_meta(berg_getPageId(),'intro_settings', true) == '') ? 'hidden':'';?>"><?php echo get_post_meta(berg_getPageId(),'intro_settings', true); ?></h1>
						<div style="<?php echo $txt_align ;?>" class="<?php echo $class_position ;?> parallax-element-second <?php echo (get_post_meta(berg_getPageId(),'intro_content_settings', true) == '') ? 'hidden':'';?>">
							<?php echo apply_filters('the_content', get_post_meta(berg_getPageId(),'intro_content_settings', true )); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-space"></div>
</div>
<?php 
function jx_ievent_customcss() {
global $ievent_data;
		//$image_path=get_post_meta(get_the_ID(),'jx_ievent_body_bg_image',false );					
		$images_header_url='';
		$images_url='';	
		$images = rwmb_meta( 'jx_ievent_body_bg_image', 'type=image_advanced' );
		$images_header = rwmb_meta( 'jx_ievent_header_bg_image', 'type=image_advanced' );
		foreach ( $images as $image )
		{$images_url=$image['full_url'];}
		
		foreach ( $images_header as $image_header )
		{$images_header_url=$image_header['full_url'];}

		$image_hoverlay= hex2rgb($ievent_data['image_hoverlay']);
		$google_body_font = $ievent_data['google_body_font'];
		$google_menu_font = $ievent_data['google_menu_font'];
		$google_headings_font = $ievent_data['google_headings_font'];
		$google_subheading_font = $ievent_data['google_subheadings_font'];
		$google_footer_font = $ievent_data['google_footer_headings_font'];		
		$body_font_face = $ievent_data['body_font']['face'];
		$body_font_size = $ievent_data['body_font']['size'];
		$body_font_style = $ievent_data['body_font']['style'];
		$body_font_color = $ievent_data['body_font']['color'];
		$h1_font_face = $ievent_data['h1_font']['face'];
		$h1_font_size = $ievent_data['h1_font']['size'];
		$h1_font_style = $ievent_data['h1_font']['style'];
		$h1_font_color = $ievent_data['h1_font']['color'];		
		$h2_font_face = $ievent_data['h2_font']['face'];
		$h2_font_size = $ievent_data['h2_font']['size'];
		$h2_font_style = $ievent_data['h2_font']['style'];
		$h2_font_color = $ievent_data['h2_font']['color'];		
		$h3_font_face = $ievent_data['h3_font']['face'];
		$h3_font_size = $ievent_data['h3_font']['size'];
		$h3_font_style = $ievent_data['h3_font']['style'];
		$h3_font_color = $ievent_data['h3_font']['color'];		
		$h4_font_face = $ievent_data['h4_font']['face'];
		$h4_font_size = $ievent_data['h4_font']['size'];
		$h4_font_style = $ievent_data['h4_font']['style'];
		$h4_font_color = $ievent_data['h4_font']['color'];		
		$h5_font_face = $ievent_data['h5_font']['face'];
		$h5_font_size = $ievent_data['h5_font']['size'];
		$h5_font_style = $ievent_data['h5_font']['style'];
		$h5_font_color = $ievent_data['h5_font']['color'];		
		$h6_font_face = $ievent_data['h6_font']['face'];
		$h6_font_size = $ievent_data['h6_font']['size'];
		$h6_font_style = $ievent_data['h6_font']['style'];
		$h6_font_color = $ievent_data['h6_font']['color'];
		
				
?>
<style type='text/css'>
<?php	
if($google_body_font || $google_headings_font || $google_menu_font || $google_footer_font ):
		if($google_body_font && $google_body_font !="Select Font"):?>
        body{ font-family: <?php echo esc_attr($google_body_font); ?>, Arial, Helvetica, sans-serif ;}
		<?php endif;
		if($google_headings_font && $google_headings_font !="Select Font"):?>
		h1,h2,h3,h4,h5,h6,h7{ font-family: <?php echo esc_attr($google_headings_font)?>, Arial, Helvetica, sans-serif !important;}
		<?php endif;		
		if($google_subheading_font && $google_subheading_font !="Select Font"):
		?>div.subtitle{ font-family: <?php echo esc_attr($google_subheading_font)?>, Arial, Helvetica, sans-serif !important;}
		<?php endif;		
		if($google_menu_font && $google_menu_font !="Select Font"):?>
        nav ul li a{ font-family: <?php echo esc_attr($google_menu_font)?>, Arial, Helvetica, sans-serif !important;}
		<?php endif;		
		if($google_footer_font && $google_footer_font !="Select Font"):?>
        footer h1,footer h2,footer h3,footer h4,footer h5,footer h6,{ font-family: <?php echo esc_attr($google_footer_font)?>, Arial, Helvetica, sans-serif !important;}
		<?php endif;
		
		else:?>
			body{ font-family: <?php echo esc_attr($body_font_face) ?>, Arial, Helvetica, sans-serif;}
			h1{ font-family: <?php echo esc_attr($h1_font_face) ?>, Arial, Helvetica, sans-serif;}
			h2{ font-family: <?php echo esc_attr($h2_font_face) ?>, Arial, Helvetica, sans-serif;}
			h3{ font-family: <?php echo esc_attr($h3_font_face) ?>, Arial, Helvetica, sans-serif;}
			h4{ font-family: <?php echo esc_attr($h4_font_face) ?>, Arial, Helvetica, sans-serif;}
			h5{ font-family: <?php echo esc_attr($h5_font_face) ?>, Arial, Helvetica, sans-serif;}
			h6{ font-family: <?php echo esc_attr($h6_font_face) ?>, Arial, Helvetica, sans-serif;}
		<?php endif;?>	
			
	
		    body{font-size: <?php echo esc_attr($body_font_size) ?>; font-weight: <?php echo esc_attr($body_font_style) ?>; color: <?php  echo esc_attr($body_font_color) ?>; }
			h1{ font-size: <?php echo esc_attr($h1_font_size) ?>; font-weight: <?php echo esc_attr($h1_font_style) ?>; color: <?php echo esc_attr($h1_font_color) ?>; line-height: 30px;font-weight: 300;}
			h2{ font-size: <?php echo esc_attr($h2_font_size) ?>; font-weight: <?php echo esc_attr($h2_font_style) ?>; color: <?php echo esc_attr($h2_font_color) ?>; }
			h3{ font-size: <?php echo esc_attr($h3_font_size) ?>; font-weight: <?php echo esc_attr($h3_font_style) ?>; color: <?php  echo esc_attr($h3_font_color) ?>; }
			h4{ font-size: <?php echo esc_attr($h4_font_size) ?>; font-weight: <?php echo esc_attr($h4_font_style) ?>; color: <?php echo esc_attr($h4_font_color) ?>; }
			h5{ font-size: <?php echo esc_attr($h5_font_size) ?>; font-weight: <?php echo esc_attr($h5_font_style) ?>; color: <?php echo esc_attr($h5_font_color) ?>; }
			h6{ font-size: <?php echo esc_attr($h6_font_size) ?>; font-weight: <?php echo esc_attr($h6_font_style) ?>; color: <?php echo esc_attr($h6_font_color) ?>; }
			h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited  { font-weight: inherit; color: inherit; }
body{
<?php if(($ievent_data['select_layout'] == 'boxed') || (get_post_meta(get_the_ID(),'jx_ievent_layout_mode',true))=='boxlayout'): ?>
		<?php if(get_post_meta(get_the_ID(), 'jx_ievent_body_bg_color', true)): ?>
		background-color:<?php echo get_post_meta(get_the_ID(), 'jx_ievent_body_bg_color', true); ?>;
		<?php else: ?>
		background-color:<?php echo esc_attr($ievent_data['bg_boxbody_color']); ?>;
		<?php endif; ?>
		
		
		<?php if($ievent_data['select_bg_pattern']=='Background' && $ievent_data['pattern_bg_images'] && !(get_post_meta(get_the_ID(), 'jx_ievent_bg_color', true) || get_post_meta(get_the_ID(), 'jx_ievent_page_bg', true))): ?>
		background-image:url("<?php echo get_template_directory_uri() . '/images/bg/large/' . esc_attr($ievent_data['pattern_bg_images']) . '.png'; ?>");
		background-repeat:repeat;
		<?php endif; ?>
		
		/*<!--<!-- Body Image Background -->-->*/
		
		
		<?php if(get_post_meta(get_the_ID(), 'jx_ievent_body_bg_image', true)): ?>
		background-image:url(<?php echo esc_url($images_url); ?>);
		background-repeat:<?php echo get_post_meta(get_the_ID(), 'jx_ievent_body_bg_repeat', true); ?>;
			<?php if(get_post_meta(get_the_ID(), 'jx_ievent_bg_fullwidth_page', true)): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php elseif($ievent_data['meida_bg_boxbody_image']): ?>
		background-image:url(<?php echo esc_attr($ievent_data['meida_bg_boxbody_image']); ?>);
		background-repeat:<?php echo esc_attr($ievent_data['select_bg_repeat']); ?>;
			<?php if($ievent_data['check_bg_fullwidth']): ?>
			background-attachment:fixed;
			background-position:center center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			<?php endif; ?>
		<?php endif; ?>
		
<?php endif; ?>
	}


</style>
<?php }
add_action( 'wp_head', 'jx_ievent_customcss', 100 );
?>
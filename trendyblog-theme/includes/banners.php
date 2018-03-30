<?php
	$banner_type = df_get_option ( THEME_NAME."_banner_type" );
	$banner_image = df_get_option ( THEME_NAME."_banner_image" );
	$banner_text = stripslashes ( df_get_option ( THEME_NAME."_banner_text" ) );
	$banner_text_image_txt = df_remove_html_slashes ( df_get_option ( THEME_NAME."_banner_text_image_txt" ) );
	$banner_text_image_img = df_get_option ( THEME_NAME."_banner_text_image_img" ) ;
	
	if ( !$banner_image) {
		$banner_image = get_template_directory_uri()."/images/custom-banner.png";
	}	
	if ( !$banner_text_image_img) {
		$banner_text_image_img = get_template_directory_uri()."/images/custom-banner.png";
	}
?>	
<?php
	if ( $banner_type == "image" ) {
	//Image Banner
?>
		<div id="popup_content" style="display:none;">
			<a href="#" id="baner_close"><?php esc_html_e("Close", THEME_NAME);?></a>
			<img src="<?php echo esc_url($banner_image); ?>" />
		</div>
<?php
	} else if ( $banner_type == "text" ) { 
	//Text Banner
?>
		<div id="popup_content" class="text-banner-add" style="display:none;">
			<div style="border: 1px solid #fff; position: relative; -moz-border-radius: 4px; -webkit-border-radius: 4px; border-radius: 4px;">
				<a href="#" id="baner_close"><?php esc_html_e("Close", THEME_NAME);?></a>
				<div class="popup-inner">
					<center><?php echo balanceTags($banner_text, true);?></center>
				</div>
			</div>
		</div>
<?php 
	} else if ( $banner_type == "text_image" ) { 
	//Image And Text Banner
?>
		<div id="popup_content" style="display:none;">
			<a href="#" id="baner_close"><?php esc_html_e("Close", THEME_NAME);?></a>
			<center><img src="<?php echo esc_url($banner_text_image_img);?>"/></center>
			<center><?php echo balanceTags($banner_text_image_txt, true);?></center>
		</div>
<?php }
?>
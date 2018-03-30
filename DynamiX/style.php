<?php 

	if( !empty($NV_skin) ) $skin = $NV_skin; elseif(DEFAULT_SKIN) $skin = DEFAULT_SKIN; else $skin = $NV_defaultskin;

	$get_skin_data = maybe_unserialize(get_option('skin_data_'.$skin));
	
	$layerset1 = ( !empty( $get_skin_data['skin_id_layer1_type'] ) ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer1_type'])) : '';
	$layerset2 = ( !empty( $get_skin_data['skin_id_layer2_type'] ) ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer2_type'])) : '';
	$layerset3 = ( !empty( $get_skin_data['skin_id_layer3_type'] ) ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer3_type'])) : '';
	$layerset4 = ( !empty( $get_skin_data['skin_id_layer4_type'] ) ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer4_type'])) : '';
	$layerset5 = ( !empty( $get_skin_data['skin_id_layer5_type'] ) ) ? stripslashes(htmlspecialchars($get_skin_data['skin_id_layer5_type'])) : '';

	$custom_css = '';
	
	if($layerset1!='') { $custom_css .= setlayer('layer1',$layerset1,$skin);} // do function to get settings if required
	if($layerset2!='') { $custom_css .= setlayer('layer2',$layerset2,$skin);}
	if($layerset3!='') { $custom_css .= setlayer('layer3',$layerset3,$skin);}
	if($layerset4!='') { $custom_css .= setlayer('layer4',$layerset4,$skin);}
	if($layerset5!='') { $custom_css .= setlayer('layer5',$layerset5,$skin);}
	
	$main_settings=$header_settings=$menu_settings=$footer_settings='custom';
	
	if(empty($tabs)) $tabs='';
	if(empty($header_logo)) $header_logo='';
	
	$custom_css .= setelement('background',$skin,'','');
	
	function inherit_chk($element,$settings_array,$skin) {
		$get_skin_data = maybe_unserialize(get_option('skin_data_'.$skin));
		$settings_array= explode(",", $settings_array);
		
		$is_inherited='';
		
		foreach($settings_array as $chk) {
			if(isset($get_skin_data['skin_id_'.$chk.'_inherit'])) $chk_element=stripslashes(htmlspecialchars($get_skin_data['skin_id_'.$chk.'_inherit'])); else $chk_element=''; 
			
			if($chk_element==$element) {
				$is_inherited.=$chk.',';
			}
		}	
		return rTrim($is_inherited,',');
	}
	
	
	if($main_settings=='custom') {
		$inherited_elements=inherit_chk('main','header,menu,footer',$skin);
		$custom_css .= setelement('main',$skin,$inherited_elements,'');
	} 
	
	if($header_settings=='custom') {
		$inherited_elements=inherit_chk('header','main,menu,footer',$skin);
		$custom_css .= setelement('header',$skin,$inherited_elements,'');
	} 
	
	if($menu_settings=='custom') {
		$inherited_elements=inherit_chk('menu','header,main,footer',$skin);
		$custom_css .= setelement('menu',$skin,$inherited_elements,'');
	}
	
	if($footer_settings=='custom') {
		$inherited_elements=inherit_chk('footer','header,main,menu',$skin);
		$custom_css .= setelement('footer',$skin,$inherited_elements,'');
	} 
	
	$count = ( !empty( $get_skin_data['skin_id_custom_count'] ) ) ? $get_skin_data['skin_id_custom_count'] : ''; 
	
	for($z = 0; $z < $count; $z++) {
		$custom_css .= setelement('custom',$skin,'','_'.$z);
	}


	// Custom CSS
	if( of_get_option('max_sitewidth') )
	{
		$custom_css .= '
		@media only screen and (min-width: 1025px) {
			.site-inwrap .tab, .site-inwrap .gallery-wrap.stage .control-wrap, .site-inwrap .gallery-wrap.group-slider,.site-inwrap .accordion-gallery-wrap.stage,.site-inwrap .row, .dock-panel-wrap.dockpanel_type_2.dock_layout_1 .infodock-innerwrap { 
				max-width:'. of_get_option('max_sitewidth') .'px; 
			}
			#primary-wrapper { min-width:'. of_get_option('max_sitewidth') .'px; }
		}
		';			
	}	
		
	if( of_get_option('header_height') )
	{
		$custom_css .='#primary-wrapper #header { min-height:'. of_get_option('header_height') .'px; }';
	}
	
	if( of_get_option('menu_margin') )
	{
		$tabs .= 'margin-top:'. of_get_option('menu_margin') .'px;';
	} 
	
	if( of_get_option('branding_margin') )
	{
		$header_logo .= 'margin-top:'. of_get_option('branding_margin') .'px;';
	} 
	
	if( !empty( $tabs ) )
	{ 
		$custom_css .= '#primary-wrapper #nv-tabs {'. $tabs .'}';
	}
	
	if( !empty( $header_logo ) )
	{ 
		$custom_css .= '#primary-wrapper #header-logo {'. $header_logo .'}';
	}
	
	if( of_get_option( 'header_css' ) )
	{
		$custom_css .= of_get_option( 'header_css' );
	}

	if( of_get_option( 'responsive_css' ) )
	{
		$custom_css .= '@media only screen and (max-width: 767px) {'. of_get_option( 'responsive_css' ). '}';
	}	
	
	wp_enqueue_style( 'themeva-custom-styles',	get_template_directory_uri() . '/style.css', false, null );
	wp_add_inline_style( 'themeva-custom-styles', $custom_css );
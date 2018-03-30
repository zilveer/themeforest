<?php
/*
 * Netlabs Admin Framework
 */

 
// CREATES THE PAGE TABS
function ntl_draw_tabs( $current, $type, $page ) {
	
	switch ($type) {
			
		case 'admin':
			$tabs = array( 
				 __('General', 'localize'), 
				__('Fonts', 'localize'), 
				__('Audio-maps', 'localize'), 
				__('Messages', 'localize'), 
				__('Social', 'localize')
			); 
		break;
		
		case 'slide':
			 $tabs = array( 
				__('Manager', 'localize'), 
				__('Settings', 'localize')
			); 
		break;
		
		case 'video':
			 $tabs = array( 
				__('Manager', 'localize')
			); 
		break;
		
		case 'utility':
			 $tabs = array( 
				__('Feedback', 'localize'), 
				__('Bannerlink', 'localize')
			); 
		break;
		
		case 'facebook':
			 $tabs = array( 
				__('General', 'localize')
			); 
		break;
			
	}
	  
    echo '<h2 class="nav-tab-wrapper">';
	$counter = 1;
    foreach( $tabs as $name ){
        $class = ( $counter == $current ) ? ' nav-tab-active' : '';
        echo '<a class="nav-tab ' . $class  . '" href="?page=' .  $page  . '&tab=' . $counter .'">' . $name . '</a>';
		$counter++;        
    }
    echo '</h2>';
}



// ADDS A NEW SLIDESHOW
function ntl_add_slide($type) {
	
	if ($_POST['slide-name']) {		
		$post_id = wp_insert_post( array(
			'post_type' => $type,
			'post_status' => 'publish',
			'comment_status' => 'closed',
			'post_content' => '',
			'post_title' => $_POST['slide-name'],
			'post_author' => '1'
		) );	
	}	
	return;
}

function ntl_delete_slide($id) {	
	wp_delete_post( $id, true );	
	return;	
}


function ntl_build_soc($soclist){
	$settings = get_option( "ntl_theme_settings" );		
	$countr = 1;	
	
	$outp = '';			
	$outp .= '
		<table class="fonter">
			<tbody>	
				<tr>
					<th>&nbsp;</th>
					<th>&nbsp;</th><th>'.__('Address', 'localize').'</th>
					<th>'.__('Post', 'localize').'</th>
					<th>'.__('Widget', 'localize').'</th>
				</tr>
	';
	
	foreach ($soclist as $socname){
		
		if ($countr%2 == 0) {$alter = 'fontalt';} else {$alter = '';}
		
		$tname = str_replace(' ', '', $socname);
		
		$secon1 = 'ntl_' . strtolower($tname)  . '_addr';
		$secon2 = 'ntl_' . strtolower($tname)  . '_post';
		$secon3 = 'ntl_' . strtolower($tname)  . '_widg';
		
		if ($settings[$secon2] == 'on') {
			$primoffer = "socselected";
		} else {
			$primoffer = "";
		}
		
		if ($settings[$secon3] == 'on') {
			$secoffer = "socselected";
		} else {
			$secoffer = "";
		}

		$outp .= '
			<tr class="' .  $alter .  '">
			<td><span><img src="' . get_template_directory_uri()  . '/admin/images/' . strtolower($tname) . '.png"></span></td>
			<td><span>' . $socname . '</span></td>
			<td><span><input type="text" id="setinputvaluesec" size="50" name="ntl_' . strtolower($tname)  . '_addr" value="'. $settings[$secon1] .'"></span></td>
			<td class="soctop">
				<span class="socprim ' .  $primoffer . '"></span>
				<input type="hidden" id="setinputvaluesec" size="50" name="ntl_' . strtolower($tname)  . '_post" value="'. $settings[$secon2] .'">
			</td>
			<td class="soctop">
				<span class="socsec ' .  $secoffer . '"></span>
				<input type="hidden" id="setinputvaluesec" size="50" name="ntl_' . strtolower($tname)  . '_widg" value="'. $settings[$secon3] .'">
			</td>
			</tr>';		
		$countr++;
	}
	
	$outp .= '</tbody></table>';	
	return $outp;
}

function ntl_build_fonts($settings, $fontlist){
	$settings = get_option( "ntl_theme_settings" );
	$prim = $settings["ntl_font_primary"];
	$secon = $settings["ntl_font_secondary"];
	$outp = '';	
	$countr = 1;
	
	$outp .= '
		<table class="fonter">
			<tbody>
				<tr>
					<th>&nbsp;</th>
					<th>'.__('Primary', 'localize').'</th>
					<th>'.__('Secondary', 'localize').'</th>
					<th>'.__('Preview', 'localize').'</th>
				</tr>
	';
	
			
	foreach ($fontlist as $fontname){		
		if ($fontname == $prim) {$pclass = 'fontselected';} else {$pclass = '';}		
		if ($fontname == $secon) {$sclass = 'fontselected';} else {$sclass = '';}		
		if ($countr%2 == 0) {$alter = 'fontalt';} else {$alter = '';}

		$outp .= '
			<tr class="' .  $alter .  '">
			<td><span class="fontname">' .  $fontname .  '</span></td>
			<td><span class="fontprim fontchoice ' . $pclass  . '" rel="' .  $fontname  . '">&nbsp;</span></td>
			<td><span class="fontsec fontchoice ' . $sclass  . '" rel="' .  $fontname  . '">&nbsp;</span></td>
			<td>
				<span class="fontpreview">&nbsp;
					<span class="fontshow" rel="' .  $fontname .  '">
						<a class="popclose">X</a>
						<span class="apishow">
							<span class="apiinner"></span>
						</span>
					</span>
				</span>
			</td>
			</tr>
		';		
		$countr++;
	}
		
	$outp .= '
			</tbody>
		</table>
		<input type="hidden" id="setinputvalueprim" name="ntl_font_primary" value="'. $prim .'">
		<input type="hidden" id="setinputvaluesec" name="ntl_font_secondary" value="'. $secon .'">
	';	
	return $outp;	
}


// CREATE AN INPUT BOX


// TYPE: 		either post number or 'option'
// INPUTTYPE:	type of input to create
// BEFORE:		content before
// HEADING: 	heading
// DESCRIPTION: description
// NAME: 		input name
// CLASS:		css class to add
// OPTION:		options and arrays


function ntl_create_box($type, $inputtype, $before, $heading, $description, $name, $class, $option){
		
	$settings = get_option( "ntl_theme_settings");	
	$oputs = $before . '<span class="lefterinner lefterinner2 ' .  $class  . '">';
	$oputs .= '<h4><span>' . $heading . '</span></h4>';
	
	$val = '';
	
	if ($type == 'option'){
		if (isset ($settings[$name])) {
		$val = $settings[$name];
		}
	} else {
		$val = get_post_meta($type, $name, true);
	}
	switch ($inputtype) {
		
		case 'textarea':
			$oputs .= '<textarea cols="28" rows="' . $option . '" name="' . $name  . '">' . esc_html( stripslashes($val ))  . '</textarea>';		
		break;
		
		case 'input':
			$oputs .= '<input type="text" size="32"  name="' . $name  . '" value="' . esc_html( stripslashes($val ))  . '" />';
		break;
		
		case 'selectlink':
			$oputs .= '<select name="' .  $name  .'">';
			foreach ($option as $posthead) {
				$oputs .= '<optgroup label="' .  $posthead  . '">';			
				$myargs = array('post_type'=>$posthead,'showposts'=> 10000);			
				$my_newquery = new WP_Query($myargs);
				if ($my_newquery->have_posts()) : while ($my_newquery->have_posts()) : $my_newquery->the_post();
					if ($type == 'option') {
						$stval = $settings[$name];
					} else {
						$stval = get_post_meta($type, $name, true);
					}
					if (get_the_ID() == $stval ) { $sel = 'selected="selected"';} else {$sel = ' ';}
					$oputs .= '<option value="' . get_the_ID()  . '" ' . $sel  . '>' . get_the_title() . '</option>';
				endwhile;
				else : endif;
				wp_reset_query();
			
				$oputs .= '</optgroup>';			
			}
			$oputs .= '</select>';			
		break;
		
		case 'uploader':	
			$oputs .= '<a class="ntl_asaver" rel="' . $type  . '" href="media-upload.php?post_id=' . $type  . '&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=454" onclick="return false;">' . __('Click to upload image', 'localize')  . '</a>';	
			$uimg = get_the_post_thumbnail( $type, 'full');
			if ($uimg){
				$oputs .= '<span class="uimg">' . $uimg  .  '</span>';
			}				
		break;
		
		case 'saver':
			$oputs .= '<input type="hidden" name="postid" value="' . $type .  '">';
			$oputs .= '<input type="hidden" name="slidesave" value="Y">';
			$oputs .= '<input type="submit" value="Save Slideshow" class="button-primary menu-save" id="save_menu_footer" name="save_slide">';
		break;	
		
		case 'uloader':
			if ($val) {	
				$oputs .= '
					<div class="image_upload_div" style="min-height: 27px;">
						<span id="' .  $name  .  '" class="uploader image_upload_button">' . __('Upload image', 'localize')  . '</span>
						<span id="' .  $name  .  '" class="uploader image_reset_button ">' . __('Reset', 'localize')  . '</span>
						<br class="clear">
					</div>
				';		
				$oputs .= '<img alt="" src="' .  $val  .   '" id="image_' .  $name  .  '">';	
			} else {	
				$oputs .= '
					<div class="image_upload_div" style="min-height: 27px;">
						<span id="' .  $name  .  '" class="uploader image_upload_button">' . __('Upload image', 'localize')  . '</span>
						<span id="' .  $name  .  '" class="uploader image_reset_button reset_hide">' . __('Reset', 'localize')  . '</span>
						<br class="clear">
					</div>
				';		
			}		
		break;
		
		case 'options':	
			foreach ($option as $optvalue) {
				if 	($val == $optvalue ){		
					$oputs .= '<span class="optionbut" rel="' . $optvalue  . '">' . $optvalue  . '</span>';		
				} elseif ($val != $optvalue ) {			
					$oputs .= '<span class="optionbut butoff" rel="' . $optvalue  . '">' . $optvalue  . '</span>';			
				}
			}	
			$oputs .= '<input type="hidden" id="setinputvalue" name="' . $name  . '" value="'. $val .'">'; 
		break;
		
		case 'colorpicker':			
			$oputs .= '
				<div class="color-picker" style="position: relative;">
					<input type="text" id="color" name="' . $name   .   '" value="' . $val   .   '" size="29" style="background: ' . $val   . ';" />
					<div style="position: absolute;" id="colorpicker"></div>
				</div>
			';
		break;
		
		case 'on_off':			
			if ($val) {
				$swithch = 'offswitch';
			}	else {
				$swithch = '';
			}
			$oputs .= '
				<span class="on_off '  .  $swithch  . '"></span>
				<input type="hidden" id="onoffswitch" name="' . $name   .   '" value="' . $val   .   '" size="29"  />
			';
		break;
		
		case 'value':						
			if (!$val){$val = $option;}			
			$oputs .= '
				<span class="valswitch" rel="' . $option  . '"><span class="valname">' . $val   .   '</span><span class="valup"></span><span class="valdown"></span></span>
				<input type="hidden" id="updownswitch" name="' . $name   .   '" value="' . $val   .   '" size="29"  />
			';
		break;
	}
	
	if ($description){
		$oputs .= '<p class="leftexplain">' .  $description  .  '</p>';
	}
	
	$oputs .= '</span>';		
	return $oputs;	
}

?>
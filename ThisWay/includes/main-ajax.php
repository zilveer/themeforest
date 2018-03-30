<?php
if(is_admin())
{
add_action('wp_ajax_load_font_variants', 'load_font_variants');
function load_font_variants()
{
	echo '{"status":"OK", "variants":'.json_encode(getFont($_POST['font'],'variants')).'}';
	die();
}

add_action('wp_ajax_General_save', 'General_save');
function General_save()
{
	global $regSettings, $defValues;
	$re='';
	for($i=0; $i<sizeof($regSettings); $i++)
	{
		if(array_key_exists($regSettings[$i], $_POST))
			update_option($regSettings[$i], $_POST[$regSettings[$i]]);
		else
			if(array_key_exists($regSettings[$i], $defValues))
				update_option($regSettings[$i], $defValues[$regSettings[$i]]);
			else
				update_option($regSettings[$i], '');
	}
	
	if(empty($_POST['settingsID']))
		echo '{"status":"OK", "type":"apply"}';
	else
		General_db_save();
	die();
}

add_action('wp_ajax_General_db_save', 'General_db_save');
function General_db_save()
{
	global $regSettings, $defValues;
	global $wpdb;
	$re = '{';
	for($i=0; $i<sizeof($regSettings); $i++)
	{
		if(array_key_exists($regSettings[$i], $_POST))
			$re.='"'.$regSettings[$i].'":"'.str_replace("\'","'",$_POST[$regSettings[$i]]).'", ';
		else
			if(array_key_exists($regSettings[$i], $defValues))
				$re.='"'.$regSettings[$i].'":"'.str_replace("\'","'",$defValues[$regSettings[$i]]).'", ';
			else
				$re.='"'.$regSettings[$i].'":"", ';
	}
	$re = substr($re, 0, -2);
	$re .= '}';
	
	if(empty($_POST['settingsID']) && !empty($_POST['name']))
	{
		//insert
		$insert_query = "INSERT INTO {$wpdb->prefix}settings (ID, NAME, SETTINGS) VALUES ('NULL', '".$wpdb->escape($_POST['name'])."', '".$wpdb->escape($re)."')";
		$insert = $wpdb->get_results($insert_query);
		if(sizeof($insert)==0)
		{
			$setItem = '<tr id="set'.$wpdb->insert_id.'">
					<td>'.$_POST['name'].'</td>
					<td>
						<a href="javascript:void(0);" onclick="getSet('.$wpdb->insert_id.')" >[Get]</a>&nbsp;&nbsp;
						<a href="javascript:void(0);" onclick="deleteSet('.$wpdb->insert_id.')" >[Delete]</a>&nbsp;&nbsp;
						<a href="'.site_url().'?preview='.$wpdb->insert_id.'" target="_blank">[Preview]</a>
					</td>
				</tr>';
			$setItem = str_replace("\n",'',$setItem);
			$setItem = str_replace("\r",'',$setItem);
			$setItem = str_replace("\t",'',$setItem);
			
			$ret = array('status'=>'OK', 'type'=>'insert', 'settingsID'=>$wpdb->insert_id,
			'name'=>$_POST['name'], 'html'=>$setItem);
			echo json_encode($ret);
		}else{
			echo '{"status":"NOK", "ERR":"Have got an error when adding settings."}';
		}
	}elseif(!empty($_POST['settingsID']) && empty($_POST['name'])){
		// update
		$update_query = "UPDATE {$wpdb->prefix}settings SET SETTINGS='".$wpdb->escape($re)."' WHERE ID='".$_POST['settingsID']."'";
		$update = $wpdb->get_results($update_query);
		if(sizeof($update)==0)
		{
			echo '{"status":"OK", "type":"update", "settingsID":"'.$_POST['settingsID'].'"}';
		}else{
			echo '{"status":"NOK", "ERR":"Have got an error when updating settings."}';
		}
	}else{
		//error
		echo '{"status":"NOK", "ERR":"Data error."}';
	}
	die();
}

add_action('wp_ajax_delete_set', 'delete_set');
function delete_set()
{
	global $wpdb;
	$result = $wpdb->query("DELETE FROM {$wpdb->prefix}settings WHERE ID = ".$_POST['setID']);
	if($result>0)
		echo '{"status":"OK", "setID":"'.$_POST['setID'].'"}';
	else
		echo '{"status":"NOK", "ERR":"Have got an error when deleting."}';
	die();
}

add_action('wp_ajax_delete_image', 'delete_image');
function delete_image()
{
	global $wpdb;
	$upload_dir = wp_upload_dir();
	$src = $upload_dir['path'].'/'.$_POST['imgName'];
	
	if(unlink($src))
	{
		$result = $wpdb->query("DELETE FROM {$wpdb->prefix}settings_images WHERE ID = ".$_POST['imgID']);
		if($result>0)
			echo '{"status":"OK", "imgID":"'.$_POST['imgID'].'"}';
		else
			echo '{"status":"NOK", "ERR":"Have got an error when deleting record."}';
	}else{
		echo '{"status":"NOK", "ERR":"Have got an error when deleting file."}';
	}
	die();
}

add_action('wp_ajax_get_general', 'get_general');
function get_general()
{
	global $regSettings;
	$re = '{';
	for($i=0; $i<sizeof($regSettings); $i++)
	{
		$re.='"'.$regSettings[$i].'":"'.str_replace("\'","'",get_option($regSettings[$i])).'", ';
	}
	$re = substr($re, 0, -2);
	$re .= '}';
	echo $re;
	die();
}

add_action('wp_ajax_get_set', 'get_set');
function get_set()
{
	global $wpdb;
	$row = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}settings where ID=".$_POST['setID']);
		echo '{"status":"OK", "settingsID":"'.$row->ID.'" ,"name":"'.str_replace("\'","'",$row->NAME).'", "data":['.$row->SETTINGS.']}';
	die();
}


add_action('wp_ajax_save_audio_list', 'save_audio_list');
function save_audio_list(){
	update_option('audioList', $_POST['list']);
	echo '{"status":"OK"}';
	die();
}

function getSliderItemImage($imageID, $type, $content, $caption, $description, $thumb, $width, $height)
{
	$total = "";
	$upload_dir = wp_upload_dir();
	$total = 	'<tr id="imageID'.$imageID.'" class="sliderImageItem ui-state-default">';
	$total .= 	'<td><input type="hidden" name="imageID[]" value="'.$imageID.'" />';
	if(function_exists('wpthumb'))
		$thumb = wpthumb($thumb,'width=120&height=80&resize=true&crop=1&crop_from_position=center,center');
	$total .= 	'<div class="sliderImageItemImage ui-icon ui-icon-arrowthick-2-n-s">
					<img width="120" height="80" src="'.$thumb.'" />
					<br/>';
	if($type=='vimeo' || $type=='youtube' || $type=='player')
	{
		$total .= 'Video <span class="videoWidth"><a href="javascript:void(0);" onclick="changeDimension(this, \'Width\')">'.$width.'</a></span> x
					<span class="videoHeight"><a href="javascript:void(0);" onclick="changeDimension(this, \'Height\')">'.$height.'</a></span><br>';
	}
	$total .=	'<a href="javascript:void(0);" onclick="deleteItemImage(this)">[Delete]</a> <br/>
				<a class="thumbUploaderBtn" href="javascript:void(0);" onclick="thumUploader(this)">[Upload Thumbnail]</a>
				</div>
				</td>';
	$total .=	'<td>
				<input type="hidden" name="IMAGEID[]" value="'.$imageID.'" />';
	$total .=	'<div class="sliderImageItemControl">
				<span>CAPTION</span><br />
				<input type="text" name="CAPTION[]" value="'.$caption.'" style="width:470px;" />
				<br />
				<span>DESCRIPTION</span><br />
				<textarea name="DESCRIPTION[]" style="width:470px; height:100px;">'.$description.'</textarea>
				</div>';
	$total .= 	'</td>';
	$total .= 	'</tr>';
	return $total;
}

add_action('wp_ajax_list_slider_items', 'list_slider_items');
function list_slider_items()
{
	global $wpdb;
	$result = $wpdb->get_results("SELECT IMAGEID, TYPE, CONTENT, THUMB, CAPTION, DESCRIPTION, WIDTH, HEIGHT FROM {$wpdb->prefix}backgrounds ORDER BY SLIDERORDER");
	$i=0;
	foreach($result as $row)
	{
		echo getSliderItemImage($row->IMAGEID, $row->TYPE, $row->CONTENT, stripslashes($row->CAPTION), stripslashes($row->DESCRIPTION), $row->THUMB, $row->WIDTH, $row->HEIGHT);
		$i++;
	}
	die();
}

add_action('wp_ajax_save_slider_items', 'save_slider_items');
function save_slider_items()
{
	global $wpdb;
	for($i=0; $i<count($_POST['imageID']); $i++)
	{
		$wpdb->update($wpdb->prefix.'backgrounds', array('CAPTION'=>$_POST['CAPTION'][$i], 'DESCRIPTION'=>$_POST['DESCRIPTION'][$i], 'SLIDERORDER'=>($i+1)), array('IMAGEID'=>$_POST['imageID'][$i]), array('%s', '%s', '%d'), array('%d')); 
	}
	die();
}


add_action('wp_ajax_change_video_dimension', 'change_video_dimension');
function change_video_dimension()
{
	global $wpdb;
	$resultOld = $wpdb->get_row( "SELECT WIDTH, HEIGHT FROM {$wpdb->prefix}backgrounds WHERE IMAGEID=".$_POST['IMAGEID']);
	if($_POST['dimType']=='Width'){
		$wpdb->update($wpdb->prefix.'backgrounds', array('WIDTH'=>$_POST['value']), array('IMAGEID'=>$_POST['IMAGEID']), array('%d'), array('%d')); 
	}elseif($_POST['dimType']=='Height'){
		$wpdb->update($wpdb->prefix.'backgrounds', array('HEIGHT'=>$_POST['value']), array('IMAGEID'=>$_POST['IMAGEID']), array('%d'), array('%d')); 
	}
	$resultNew = $wpdb->get_row( "SELECT WIDTH, HEIGHT FROM {$wpdb->prefix}backgrounds WHERE IMAGEID=".$_POST['IMAGEID']);
	
	if($_POST['dimType']=='Width'){
		echo '{"status":"OK", "IMAGEID":"'.$_POST['IMAGEID'].'", "dimType":"'.$_POST['dimType'].'", "value":"'.$resultNew->WIDTH.'"}';
	}elseif($_POST['dimType']=='Height'){
		echo '{"status":"OK", "IMAGEID":"'.$_POST['IMAGEID'].'", "dimType":"'.$_POST['dimType'].'", "value":"'.$resultNew->HEIGHT.'"}';
	}
	die();
}

add_action('wp_ajax_add_video_item', 'add_video_item');
function add_video_item(){
	global $wpdb;
	$result = $wpdb->get_row( "SELECT MAX(SLIDERORDER)+1 as lastid FROM {$wpdb->prefix}backgrounds ");
	$target = $_POST['data'];
	$thumb = '';
	if($_POST['type']=='youtube')
		$thumb = 'http://img.youtube.com/vi/'.$_POST['data'].'/1.jpg';
	elseif($_POST['type']=='vimeo'){
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$_POST['data'].".php"));
		$thumb = $hash[0]['thumbnail_medium'];
	}	
	$insertResult = $wpdb->insert( $wpdb->prefix.'backgrounds', array( 'SLIDERORDER'=>$result->lastid, 'CONTENT'=>$target, 'TYPE'=>$_POST['type'], 
	'THUMB'=>$thumb, 'WIDTH'=>$_POST['width'], 'HEIGHT'=>$_POST['height']), array('%d','%s', '%s', '%s', '%d', '%d') );
	
	if($insertResult>0)
		echo '{"status":"OK", "IMAGEID":"'.$wpdb->insert_id.'"}';
	else
		echo '{"status":"NOK"}';
	
	die();
}


add_action('wp_ajax_remove_item_image', 'remove_item_image');
function remove_item_image()
{
	global $wpdb;
	$result = $wpdb->query("DELETE FROM {$wpdb->prefix}backgrounds WHERE IMAGEID = ".$_POST['IMAGEID']);
	if($result>0)
		echo '{"status":"OK", "IMAGEID":"'.$_POST['IMAGEID'].'"}';
	else
		echo '{"status":"NOK" "IMAGEID":"'.$_POST['IMAGEID'].'"}';
	die();
}

add_action('wp_ajax_insert_new_bg_item', 'insert_new_bg_item');
function insert_new_bg_item(){
	global $wpdb;
	
	if(sizeof($_POST['urls'])>0)
	{
		$err=0;
		foreach($_POST['urls'] as $url)
		{
			//echo $url."\n";
			$result = $wpdb->get_row( "SELECT IFNULL(MAX(SLIDERORDER)+1,1) as lastid FROM {$wpdb->prefix}backgrounds ");
			$insertResult = $wpdb->insert( $wpdb->prefix.'backgrounds', array( 'SLIDERORDER'=>$result->lastid, 'CONTENT'=>$url, 'TYPE'=>'image', 'THUMB'=>$url),  array('%d','%s', '%s', '%s') );
			if(!$insertResult) $err++;
		}
		
		if($err==0)
			$ret = array('status'=>'OK');
		elseif($err==sizeof($_POST['urls']))
			$ret = array('status'=>'NOK');
		else
			$ret = array('status'=>'OK', 'Err'=>'There has been some errors while inserting to database. Please check your items.');
	}
	echo json_encode($ret);
	die();
}

add_action('wp_ajax_change_thumb_of_item', 'change_thumb_of_item');
function change_thumb_of_item(){
	global $wpdb;
	$imageid = (int) $_POST['imageid'];
	if(isset($_POST['url']) && $imageid>0)
	{
		$url = $_POST['url'];
		$updateResult = $wpdb->update($wpdb->prefix.'backgrounds', array('THUMB'=>$url), array('IMAGEID'=>$imageid), array('%s'), array('%d')); 
		
		if(sizeof($updateResult)>0){
			$thumbpath = $url;
			if(function_exists('wpthumb'))
				$thumbpath = wpthumb($thumbpath,'width=120&height=80&resize=true&crop=1&crop_from_position=center,center');
				
			$ret = array('status'=>'OK', 'IMAGEID'=>$imageid, 'thumbpath'=>$thumbpath );
		}else
			$ret = array('status'=>'NOK', 'Err'=>'Have gots an error while inserting to database.');		
	}else{
		$ret = array('status'=>'NOK', 'Err'=>'There is a prameters problem.');
	}
	echo json_encode($ret);
	die();
}

}
?>
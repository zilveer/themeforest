<?php
add_action('admin_menu', 'add_control_panel'); 
$addScript = '';
function add_control_panel()
{
	add_menu_page('This Way Panel', 'This Way Settings', 'manage_options', 'top-level-menu-action', 'thiswaysettings', '','64');
	add_action( 'admin_init', 'reg_settings' );  
}

function create_settings_table()
{
	global $wpdb;
	$create_query = <<<EOT
CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}settings` (
  `ID` bigint(20) NOT NULL auto_increment,
  `NAME` varchar(50) NOT NULL,
  `SETTINGS` longtext NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
EOT;
	$create = $wpdb->get_results($create_query);
	
	$create_query2 = <<<EOT
CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}settings_images` (
  `ID` bigint(20) NOT NULL auto_increment,
  `NAME` text,
  `ORGINAL` varchar(255) default NULL,
  `EXT` varchar(5) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
EOT;
	$create2 = $wpdb->get_results($create_query2);
	
	$insert_query = <<<EOT
INSERT INTO `{$wpdb->prefix}settings` (`ID`, `NAME`, `SETTINGS`) VALUES
(19, 'Light', '{\\"contentFont\\":\\"PT Sans\\", \\"contentFontVariant\\":\\"regular\\", \\"headerFont\\":\\"Oswald\\", \\"headerFontVariant\\":\\"regular\\", \\"copyrighttext\\":\\"Copyright  2016 | ThisWay Wordpress Theme\\", \\"logo_url\\":\\"http://rb.renklibeyaz.com/thisway/wp-content/uploads/2016/01/settingsimage_cmabFSDIVBaZDBMO.png\\", \\"logo_left\\":\\"\\", \\"logo_top\\":\\"\\", \\"h1FontSize\\":\\"24\\", \\"h2FontSize\\":\\"20\\", \\"h3FontSize\\":\\"18\\", \\"h4FontSize\\":\\"16\\", \\"h5FontSize\\":\\"14\\", \\"h6FontSize\\":\\"12\\", \\"contentFontSize\\":\\"12\\", \\"menuFontSize\\":\\"14\\", \\"analyticsCode\\":\\"\\", \\"favicon\\":\\"http://rb.renklibeyaz.com/thisway/wp-content/uploads/2016/01/settingsimage_lWfF36LV03IU3O5l.ico\\", \\"theme_style\\":\\"light\\", \\"bgPaused\\":\\"false\\", \\"autoPlay\\":\\"true\\", \\"loop\\":\\"true\\", \\"audioController\\":\\"block\\", \\"bgController\\":\\"block\\", \\"thController\\":\\"block\\", \\"twitter\\":\\"block\\", \\"twt_name\\":\\"EnvatoWebDesign\\", \\"twt_number\\":\\"5\\", \\"shareIcons\\":\\"block\\", \\"bgPattern\\":\\"block\\", \\"bgNormalFade\\":\\"false\\", \\"bgAniTime\\":\\"6000\\", \\"menuDelay\\":\\"700\\", \\"menuOpenText\\":\\"MENU\\", \\"menuCloseText\\":\\"CLOSE\\", \\"frontPageURL\\":\\"\\"}'),
(20, 'Dark', '{\\"contentFont\\":\\"PT Sans\\", \\"contentFontVariant\\":\\"regular\\", \\"headerFont\\":\\"Oswald\\", \\"headerFontVariant\\":\\"regular\\", \\"copyrighttext\\":\\"Copyright  2016 | ThisWay Wordpress Theme\\", \\"logo_url\\":\\"http://rb.renklibeyaz.com/thisway/wp-content/uploads/2016/01/settingsimage_cmabFSDIVBaZDBMO.png\\", \\"logo_left\\":\\"\\", \\"logo_top\\":\\"\\", \\"h1FontSize\\":\\"24\\", \\"h2FontSize\\":\\"20\\", \\"h3FontSize\\":\\"18\\", \\"h4FontSize\\":\\"16\\", \\"h5FontSize\\":\\"14\\", \\"h6FontSize\\":\\"12\\", \\"contentFontSize\\":\\"12\\", \\"menuFontSize\\":\\"14\\", \\"analyticsCode\\":\\"\\", \\"favicon\\":\\"http://rb.renklibeyaz.com/thisway/wp-content/uploads/2016/01/settingsimage_lWfF36LV03IU3O5l.ico\\", \\"theme_style\\":\\"dark\\", \\"bgPaused\\":\\"true\\", \\"autoPlay\\":\\"false\\", \\"loop\\":\\"false\\", \\"audioController\\":\\"block\\", \\"bgController\\":\\"block\\", \\"thController\\":\\"block\\", \\"twitter\\":\\"block\\", \\"twt_name\\":\\"EnvatoWebDesign\\", \\"twt_number\\":\\"5\\", \\"shareIcons\\":\\"block\\", \\"bgPattern\\":\\"block\\", \\"bgNormalFade\\":\\"true\\", \\"bgAniTime\\":\\"6000\\", \\"menuDelay\\":\\"700\\", \\"menuOpenText\\":\\"MENU\\", \\"menuCloseText\\":\\"CLOSE\\", \\"frontPageURL\\":\\"\\"}');
EOT;
	$insert = $wpdb->get_results($insert_query);
}

	// Check Table
	if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}settings'") != $wpdb->prefix.'settings')
		create_settings_table();

function reg_settings()
{
	global $regSettings, $addScript;
	for($i=0; $i<sizeof($regSettings); $i++)
		register_setting( 'thiswaysettings', $regSettings[$i] ); 
		
		// Define Google Web Fonts
	register_setting('thiswaysettings', 'fonts');
	if(get_option('fonts')=='' || isset($_GET['updatefonts']))
	{
		$googleFonts = @file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBgeqKlFdYj3Y7VwmrEXnXzpnx5TfKXG4o');
		if(empty($googleFonts))
		{
			include 'googleFontList.php';
			$googleFonts = $googleFontList;
		}else{
			$addScript = "alert('Google Fonts has been updated');\n";
		}
		update_option('fonts', $googleFonts);
	}
}


function thiswaysettings()
{
wp_enqueue_media();
global $wpdb, $addScript;
$pURL = str_replace('http://'.$_SERVER['SERVER_NAME'],'',get_template_directory_uri());
$fonts = json_decode(get_option('fonts'));
?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/ibutton/jquery.ibutton.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/ibutton/jquery.ibutton.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript">
	<?php echo $addScript; ?>
	
	<?php 
		global $regSettings;
		$settingsVar = "var settingsVar = new Array(";
		for($i=0; $i<sizeof($regSettings); $i++)
			$settingsVar .= "'".$regSettings[$i]."', ";
		$settingsVar = substr($settingsVar,0,-2);
		$settingsVar.=");\n";
		echo $settingsVar;
	?>
	var $ = jQuery.noConflict();
	
	jQuery(document).ready(function($){
	
		$(":checkbox").not("#twitter").iButton();
		
		$('#twitter').iButton({change:function(){
			if($('#twitter').is(':checked'))
				$('#generalSettings .twitter').show();
			else
				$('#generalSettings .twitter').hide();
		}});
		
		$('#settings select[name=headerFont], #settings select[name=contentFont]').change(function(){
			loadFontVariants($(this).attr('name'), $(this).val()); 
		});  
		
		$("#saveas, #saveas2").click(function(){
			if($('#activename').attr('rel')=='')
			{
				alert('Please choose a predefined settings before saving.');
				return;
			}else{
				saveasSettings();
			}
		});
		$("#save, #save2").click(function(){
			if($('#activename').attr('rel')=='')
			{
				alert('Please choose a predefined settings before saving.');
				return;
			}else if($('#activename').attr('rel')=='0'){
				saveasSettings();
			}else{
				saveSettings(undefined,'db',$('#activename').attr('rel'));
			}
		});
		$("#preview, #preview2").click(function(){
			previewID = $('#activename').attr('rel'); 
			window.open('<?php echo site_url(); ?>/?preview='+previewID, 'preview'+previewID);
		});
		
	});
	
	function saveasSettings()
	{
		var newName = window.prompt('Please give a name for your settings.','')
		if(newName)
		{
			saveSettings(newName, 'db');
		}
	}

	jQuery(document).ready(function($){
	
		locateMsg();
		$('#messageArea').css('opacity', 0.8);
		$(window).bind('resize', function() {
					locateMsg();
				});
		$(window).bind('scroll', function() {
					locateMsg();
				});
	
		$('.colorSelector').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).find('input').val(hex);
				$(el).find('div').css('backgroundColor', '#'+hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor($(this).find('input').val());
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
		$('.colorSelectorControl').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).find('input').val(hex);
				$(el).find('div').css('backgroundColor', '#'+hex);
				$(el).ColorPickerHide();
				setBg($(el).parent().parent());
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor($(this).find('input').val());
			}
		})
		.bind('keyup', function(){
			$(this).ColorPickerSetColor(this.value);
		});
		
	});
	
	function locateMsg()
	{					
		var left = ($(window).width() - $('#messageArea').outerWidth()) / 2;
		left += $(window).scrollLeft();
		var top = 20+$(window).scrollTop();
		$('#messageArea').css('left', left+'px');
		$('#messageArea').css('top', top+'px');
	}
		
	function showMessage(type, message, id)
	{
		if(type=='waiting')
		{
			$('#messageArea').append('<div class="waiting" id="waiting_'+id+'">'+message+'</div>').find('#waiting_'+id).slideDown('slow');
		}
		else if(type=='successful')
		{
			$('#waiting_'+id).slideUp('slow', function(){$(this).remove()});
			$('#messageArea').append('<div class="successful" id="successful_'+id+'">'+message+'</div>').find('#successful_'+id).slideDown('slow').delay(3000).slideUp('slow',function(){$(this).remove();});
		}
		else if(type=='error')
		{
			$('#waiting_'+id).slideUp('slow', function(){$(this).remove()});
			$('#messageArea').append('<div class="error2" id="error_'+id+'">'+message+'</div>').find('#error_'+id).slideDown('slow').delay(3000).slideUp('slow',function(){$(this).remove();});
		}
	}
		
	function saveSettings(name, type, id)
	{
		if(type==undefined)
			type='apply';
			
		if(type=='apply')
		{
			if(!window.confirm('Are you sure to apply. If you continue all current settings will be change.'))
			{
				return false;
			}
		}
			
		settingsData = '';
		$.each(settingsVar,function(i,el){
			if($('#settings input[name='+el+']').length==1)
				if($('#settings input[name='+el+']').is(':checkbox'))
				{
					if($('#settings input[name='+el+']').is(':checked'))
						settingsData+='&'+el+'='+$('#settings input[name='+el+']').first().val();
				}
				else
					settingsData+='&'+el+'='+$('#settings input[name='+el+']').val();
			else if($('#settings select[name='+el+']').length==1)
				settingsData+='&'+el+'='+$('#settings select[name='+el+']').val();		
		});
		
		if(name!=undefined)
			settingsData+="&name="+encodeURIComponent(name);
		else if(id!=undefined)
			settingsData+="&settingsID="+id;
		else
			settingsData+="&settingsID="+$('#activename').attr('rel');

		if(type=='apply')
			settingsData+="&action=General_save";
		else if(type=='db')
			settingsData+="&action=General_db_save";
			
		showMessage('waiting', 'Saving general settings...', 'Generalsave');
		$.post(ajaxurl, settingsData, function(data){

		data = $.parseJSON(data);
		if(data.status=='OK')
		{
			if(data.type=='insert')
			{
				$('#savedSettings tbody').append(data.html);
				$('#activename').html(data.name);
				$('#activename').attr('rel', data.settingsID);
				$('#apply, #apply2').val('Apply and Save Settings');
				showMessage('successful', 'New settings has been saved successfully', 'Generalsave');
			}else{
				showMessage('successful', 'General settings has been updated successfully', 'Generalsave');
			}
		}
		else
			showMessage('error', 'Have got an error while saving settings.', 'Generalsave');
			
		});
		return false;
	}
	
	function getGeneral()
	{
		showMessage('waiting', 'Getting current settings...', 'get_general');
		$.post(ajaxurl, {'action':'get_general'}, function(data){
			data = $.parseJSON(data);
			$('#generalSettings:hidden').show('fast');
			$('#generalSettings').animate({backgroundColor:'#fffeee'},500).animate({backgroundColor:'#FFFFFF'},500);
			$('#activename').html('Current Settings').attr('rel','0');
			$('#apply, #apply2').val('Apply Settings');
			showMessage('successful', 'Current settings has been gotten successfully', 'get_general');	
			setForm(data);
			$('#savedSettings').hide();
			$('#settingShow').show();
			$('#settingShow a').text('Show');
		});
	}
	
	function getSet(setID)
	{
		showMessage('waiting', 'Getting settings...', 'get_set');
		$.post(ajaxurl, {'action':'get_set', 'setID':setID}, function(data){
			data = $.parseJSON(data);
			if(data.status=='OK')
			{
				showMessage('successful', 'Settings has been gotten successfully', 'get_set');	
				$('#generalSettings:hidden').show('fast');
				$('#generalSettings').animate({backgroundColor:'#fffeee'},500).animate({backgroundColor:'#FFFFFF'},500);
				$('#activename').html(data.name).attr('rel',data.settingsID);
				$('#apply, #apply2').val('Apply and Save Settings');
				setForm(data.data[0]);
				$('#savedSettings').hide();
				$('#settingShow').show();
				$('#settingShow a').text('Show');
				
			}else
				showMessage('error', 'Have got an error while getting settings.'+data.ERR, 'get_set');
		});
	}
	
	function deleteSet(setID)
	{
		if(window.confirm('Are you sure to delete this settings?'))
		{
			showMessage('waiting', 'Getting settings...', 'delete_set');
			$.post(ajaxurl, {'action':'delete_set', 'setID':setID}, function(data){
				data = $.parseJSON(data);
				if(data.status=='OK')
				{
					showMessage('successful', 'Settings has been deleted successfully', 'delete_set');	
					$('#set'+data.setID).remove();
					if($('#activename').attr('rel')==data.setID)
					{
						$('#activename').attr('rel','').html('');
						$('#generalSettings').hide('fast');
					}
				}else
					showMessage('error', 'Have got an error while deleting settings.'+data.ERR, 'delete_set');
			});
		}
	}
	
	function imageDelete(imgID, imgName)
	{
		if(window.confirm('Are you sure to delete this image?'))
		{
			showMessage('waiting', 'Deleting image...', 'delete_image');
			$.post(ajaxurl, {'action':'delete_image', 'imgID':imgID, 'imgName':imgName}, function(data){
				data = $.parseJSON(data);
				if(data.status=='OK')
				{
					showMessage('successful', 'Settings has been deleted successfully', 'delete_image');	
					$('#imgitem'+data.imgID).remove();
				}else
					showMessage('error', 'Have got an error while deleting image.'+data.ERR, 'delete_image');
			});
		}
	}
	
	function loadFontVariants(area, font)
	{
		$.ajax({ url:ajaxurl,
				 async: false,
				 data: {'action':'load_font_variants', 'font':font },
				 dataType:'text',
				 type: "POST",
				 success:function(data){
					data = $.parseJSON(data); 
					if(data.status=='OK')
					{
						$('#settings select[name="'+area+'Variant"] option').remove();
						for(i=0; i<data.variants.length; i++)
							$('#settings select[name="'+area+'Variant"]').append($('<option></option>').text(data.variants[i]).attr('value', data.variants[i]));
					}else
						showMessage('error', 'Have got an error while getting font variant', 'get_variant');
					}
			});
	}
	
	function setForm(data)
	{
		$('#settings input[type=text]').val('');
		$('#settings select').selectedIndex = -1;
		$('#settings .colorSelectorControl div').css("backgroundColor",'#FFFFFF');
		$('#generalSettings tr:not(.gs)').hide();
		
		loadFontVariants('headerFont', data.headerFont);
		loadFontVariants('contentFont', data.contentFont);
		
			$.each(data, function(name,i){
				// setting all inputs ans selects
				if($('#settings input:checkbox[name='+name+']').length==1){
					if($('#settings input:checkbox[name='+name+']').val()==data[name])
					{
						$('#settings input:checkbox[name='+name+']').attr('checked','checked');
					}else{
						$('#settings input:checkbox[name='+name+']').removeAttr('checked');
					}
				}else{
					$('#settings input[name='+name+']').val(data[name]);
					$('#settings select[name='+name+']').attr('selectedIndex', -1).find('option[value="'+data[name]+'"]').attr('selected','selected');
					// set colors as backgroundColor starting with "color"
					$('#settings input[name='+name+'][name*="color"]').parent().find("div").css('backgroundColor', '#'+data[name]);
				}
			});
		
		if($('#twitter').is(':checked'))
			$('#generalSettings .twitter').show();
		$(":checkbox").iButton("repaint");
		$('#twitter').iButton("repaint");
	}
	
	var urlObj; 
	var activeLink;
	function getUrlFromFile(el) 
	{
		var file_manager;
		if (file_manager) {
			file_manager.open();
			return;
		}
 
		file_manager = wp.media.frames.file_frame = wp.media({
			multiple: false,
			library: {
			  type: 'image'
			},
			title: 'Choose an Image',
			button: {
				text: 'Choose an Image'
			}
		});
 
		file_manager.on('select', function() {
			attachment = file_manager.state().get('selection').first().toJSON();
			$(el).parent().find('input').val(attachment.url);
		});
		file_manager.open();
	}
	
	function showSavedSetting()
	{
		if($('#savedSettings').is(':hidden'))
		{ 
			$('#savedSettings').show();
			$('#settingShow a').text('Hide');
		}
		else
		{
			$('#savedSettings').hide(); 
			$('#settingShow a').text('Show');
		}
	}
	
</script>
<style>
#messageArea { position:absolute; left:200px; top:20px; width:720px; margin:10px; z-index:999;}
#messageArea .waiting{padding:5px 5px 5px 25px; background:url('<?php echo get_template_directory_uri(); ?>/images/admin-loading.gif') #FF7300 5px center no-repeat; color:#FFFFFF; display:none;}
#messageArea .successful{padding:5px; background-color:#10CD02; color:#FFFFFF; display:none;}
#messageArea .error2{padding:5px; background-color:#FF0000; color:#FFFFFF; display:none;}

.widefat td{
	padding:8px;
}

#imageManager{
	position: absolute;
	left: 850px;
	top:170px;
	z-index:998;
}

.trueHeader{
	background: url('../images/gray-grad.png') repeat-x scroll left top #DFDFDF;	
	-moz-border-radius-topleft:3px;
	-moz-border-radius-topright:3px;
	padding:10px;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
	border:1px solid #DFDFDF;
}
.trueWrapper{
	background-color:#FFFFFF;
	-moz-border-radius-topleft:3px;
	-moz-border-radius-topright:3px;
	-moz-border-radius-bottomleft:3px;
	-moz-border-radius-bottomright:3px;
	border:1px solid #DFDFDF;
}
.colorSelectorWrapper{
	height:35px;
}
.colorSelector, .colorSelectorControl {
	width: 36px;
	height: 36px;
	float:left;
}
.colorSelector div, .colorSelectorControl div{
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: url(<?php echo get_template_directory_uri(); ?>/includes/colorpicker/images/select2.png) center;
}
.color{
	display:none;
	margin-left:40px;
}
.bgcontrol > div {
	clear:both;
}
.bgcontrol select{
	width:100px;
}
.bgcontrol label{
	float:left;
	width:80px;
}

.gl{
	border:3px solid #ddd;
	padding:2px;
	text-align:center;
	margin:2px auto;
}
.gl_active
{
	border-color:#bbb; 
}
.da{
	width:200px;
}
.glcontrol{
	border: 2px solid #ddd;
	background-color: #eee;
	position:absolute;
	padding:5px;
} 
.glcontrol h5{
	margin:0;
}

.subText{
	float:left;
	margin-right:5px;
	width:50px;
}
#settingShow{
	display:none;
}
</style>

<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
		<h2>General Settings</h2>
		<div id="messageArea">
		</div> 
		
		<h4>Saved Settings <span id="settingShow"><a href="javascript:void(0);" onclick="showSavedSetting()">Show</a></span></h4>
		<p><a href="?page=top-level-menu-action&updatefonts=true">Update Google Fonts</a></p>
		<table id="savedSettings" cellpadding="0" style="width:650px" class="widefat">
			<thead>
				<tr>
					<th>Name</th>
					<th>Action</th>
				</tr>
			</thead>                   
			<tbody>
				<tr>
					<td><font color="red">Current Settings</font></td>
					<td><a href="javascript:void(0);" onclick="getGeneral()" >Get Settings</a></td>
				</tr>
				<?php
				$select_query = "SELECT s.ID, s.NAME
									FROM {$wpdb->prefix}settings s
									ORDER BY s.NAME ASC";
				$query = $wpdb->get_results($select_query);
				foreach($query as $set){
				?>
				<tr id="set<?php echo $set->ID ?>">
					<td><?php echo $set->NAME ?></td>
					<td>
						<a href="javascript:void(0);" onclick="getSet(<?php echo $set->ID ?>)" >[Get]</a>&nbsp;
						<a href="javascript:void(0);" onclick="deleteSet(<?php echo $set->ID ?>)" >[Delete]</a>&nbsp;
						<a href="<?php echo site_url().'?preview='.$set->ID; ?>" target="_blank">[Preview]</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		

		<h5>Settings Name: <span id="activename" rel=""style="color:red"></span></h5>
		<form id="settings" method="post" action="#" onsubmit="return saveSettings()"> 
			<table id="generalSettings" cellpadding="0" width="500"  style="width:650px; display:none" class="widefat">
				<thead>
					<tr>
						<th>Option</th>
						<th>Value</th>
					</tr>
				</thead>                
				<tbody>
					<tr class="gs">
						<td align="left">
	                        <input type="submit" id="apply" class="button" value="Apply Settings" />
                        </td>
						<td align="right">
	                        <input type="button" id="save" class="button" value="Save Settings" />
	                        <input type="button" id="saveas" class="button" value="Save as Settings" />
	                        <input type="button" id="preview" class="button" value="Preview" />
                        </td>
					</tr>

					<tr class="gs">
						<td>Theme Style</td>
						<td>
							<select name="theme_style" style="width:100px;">
								<option value="light">Light</option>
								<option value="dark">Dark</option>
							</select>
						</td>
					</tr>
					<tr class="gs">
						<td>Background Animation Pause</td>
						<td>
							<input type="checkbox" name="bgPaused" value="true" id="bgPaused" />
						</td>
					</tr>
					<tr class="gs">
						<td>Background AutoPlay Disable</td>
						<td>
							<input type="checkbox" name="videoPaused" value="true" id="videoPaused" />
						</td>
					</tr>
					<tr class="gs">
						<td>Normal Fade Animation</td>
						<td>
							<input type="checkbox" name="bgNormalFade" value="true" id="bgNormalFade" />
						</td>
					</tr>
					<tr class="gs">
						<td>Stretch Background Images/Videos</td>
						<td>
							<input type="checkbox" name="bgStretch" value="true" id="bgStretch" />
						</td>
					</tr>
					<tr class="gs">
						<td>Audio AutoPlay</td>
						<td>
							<input type="checkbox" name="autoPlay" value="true" id="autoPlay" />
						</td>
					</tr>
					<tr class="gs">
						<td>Audio Loop</td>
						<td>
							<input type="checkbox" name="loop" value="true" id="loop" />
						</td>
					</tr>
					<tr class="gs">
						<td>Audio Controller</td>
						<td>
							<input type="checkbox" name="audioController" value="block" id="audioController" />
						</td>
					</tr>
					<tr class="gs">
						<td>Background Controller</td>
						<td>
							<input type="checkbox" name="bgController" value="block" id="bgController" />
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Position Fixed</td>
						<td>
							<input type="checkbox" name="menuPositionFixed" value="true" id="menuPositionFixed" />
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Always Open</td>
						<td>
							<input type="checkbox" name="menuAlwaysOpen" value="true" id="menuAlwaysOpen" />
						</td>
					</tr>
					<tr class="gs">
						<td>Share Icons</td>
						<td>
							<input type="checkbox" name="shareIcons" value="block" id="shareIcons" />
						</td>
					</tr>
					<tr class="gs">
						<td>Thumbnail Sidebar</td>
						<td>
							<input type="checkbox" name="thController" value="block" id="thController" />
						</td>
					</tr>
					<tr class="gs">
						<td>Background Pattern</td>
						<td>
							<input type="checkbox" name="bgPattern" value="block" id="bgPattern" />
						</td>
					</tr>
					<tr class="gs">
						<td>Twitter</td>
						<td>
							<input type="checkbox" name="twitter" value="block" id="twitter" />
						</td>
					</tr>
					<tr class="twitter">
						<td>Twitter Informations<br />
						<a target="_blank" href="http://www.renklibeyaz.com/forum/twitterdevaccount.html"> How to create a twitter developer account </a>
						</td>
						<td>
							<label> Username <input type="text" name="twt_name" value="" id="twt_name" /></label>
							<label> Number <input type="text" name="twt_number" value="" id="twt_number" /></label><br />
							<label> Twitter ConsumerKey <br /> <input type="text" name="twt_consumerkey" value="" id="twt_consumerkey" style="width:400px;" /></label><br />
							<label> Twitter ConsumerSecret <br /> <input type="text" name="twt_consumersecret" value="" id="twt_consumersecret" style="width:400px;" /></label><br />
							<label> Twitter AccessToken <br /> <input type="text" name="twt_accesstoken" value="" id="twt_accesstoken" style="width:400px;" /></label><br />
							<label> Twitter AccessTokenSecret <br /> <input type="text" name="twt_accesstokensecret" value="" id="twt_accesstokensecret" style="width:400px;" /></label>
						</td>
					</tr>
					<tr class="gs">
						<td>Background Animation Duration</td>
						<td>
							<input type="text" name="bgAniTime" value="" id="bgAniTime" /> ms
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Delay</td>
						<td>
							<input type="text" name="menuDelay" value="" id="menuDelay" /> ms
						</td>
					</tr>
					
					<tr class="gs">
						<td>Front Page URL</td>
						<td>
							<input type="text" name="frontPageURL" value="" style="width:300px;"/>
						</td>
					</tr>
					<tr class="gs">
						<td>Link Hover Sound</td>
						<td>
							<input type="text" name="btnSoundURL" value="" style="width:300px;"/>
						</td>
					</tr>
					<tr class="gs">
						<td>Logo URL</td>
						<td>
								<div class="url">
									<input type="text" name="logo_url" value="" style="width:300px;"/>
									<a href="javascript:void(0);" onclick="getUrlFromFile(this)">Get URL</a>
								</div>
						</td>
					</tr>
					<tr class="gs">
						<td>Favicon URL (Only .ico file )</td>
						<td>
								<div class="url">
									<input type="text" name="favicon" value="" style="width:300px;"/>
									<a href="javascript:void(0);" onclick="getUrlFromFile(this)">Get URL</a>
								</div>
						</td>
					</tr>
					<tr class="gs">
						<td>Copyright Text</td>
						<td>
							<input type="text" name="copyrighttext" value="" style="width:300px;" />
						</td>
					</tr>
					<tr class="gs">
						<td>Google Analytics Code</td>
						<td>
							<input type="text" name="analyticsCode" value="" style="width:300px;" />
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Open Text</td>
						<td>
							<input type="text" name="menuOpenText" value="" style="width:300px;" />
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Close Text</td>
						<td>
							<input type="text" name="menuCloseText" value="" style="width:300px;" />
						</td>
					</tr>
					
					
					
					
					
					
					<!-- <COLORS> -->
					<tr class="gs">
						<td>Header Font</td>
						<td>
							<select name="headerFont" style="width:200px;">
								<option value="">Default</option>
								<?php for($i=0; $i<sizeof($fonts->items); $i++){ ?>
								<option value="<?php echo $fonts->items[$i]->family; ?>" ><?php echo $fonts->items[$i]->family;?></option>
								<?php } ?>
							</select>
							<select name="headerFontVariant" style="width:100px;">
							</select>
						</td>
					</tr>
					<tr class="gs">
						<td>Content Font</td>
						<td>
							<select name="contentFont" style="width:200px;">
								<option value="">Default</option>
								<?php for($i=0; $i<sizeof($fonts->items); $i++){ ?>
								<option value="<?php echo $fonts->items[$i]->family; ?>" ><?php echo $fonts->items[$i]->family;?></option>
								<?php } ?>
							</select> 
							<select name="contentFontVariant" style="width:100px;" >
							</select>
						</td>
					</tr>
					<tr class="gs">
						<td>Menu Font Size</td>
						<td>
							<input type="text" name="menuFontSize" style="width:50px;" value="" /> px
						</td>
					</tr>
					<tr class="gs">
						<td>Content Font Size</td>
						<td>
							<input type="text" name="contentFontSize" style="width:50px;" value="" /> px
						</td>
					</tr>
					<tr class="gs">
						<td>H1 to H6 Font Size (px)</td>
						<td>
							<input type="text" name="h1FontSize" style="width:50px;" value="" /> 
							<input type="text" name="h2FontSize" style="width:50px;" value="" /> 
							<input type="text" name="h3FontSize" style="width:50px;" value="" /> 
							<input type="text" name="h4FontSize" style="width:50px;" value="" /> 
							<input type="text" name="h5FontSize" style="width:50px;" value="" /> 
							<input type="text" name="h6FontSize" style="width:50px;" value="" />
						</td>
					</tr>
					<!-- </COLORS> -->
					
					
					<tr class="gs">
						<td align="left">
	                        <input type="submit" id="apply2" class="button" value="Apply Settings" />
                        </td>
						<td align="right">
	                        <input type="button" id="save2" class="button" value="Save Settings" />
	                        <input type="button" id="saveas2" class="button" value="Save as Settings" />
	                        <input type="button" id="preview2" class="button" value="Preview" />
                        </td>
					</tr>
				</tbody>
			</table>
		</form>
</div>	
<?php
}
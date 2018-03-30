<?php
function admin_audio() 
{
	add_submenu_page('top-level-menu-action', 'Audio Manager Admin', 'Audio Manager', 'manage_options', 'sub-level-menu1-action', 'get_audio_manager');
}
add_action('admin_menu', 'admin_audio');

function get_audio_manager() 
{
	global $wpdb;
	$pURL = str_replace('http://'.$_SERVER['SERVER_NAME'],'',get_template_directory_uri());
	?>
	<style>
	.sliderItem{padding:3px; background-color:#EEEEEE; margin-bottom:3px}
	.sliderImageItemImage{}
	.sliderImageItem, .sliderImageItem td{cursor:move;}
	.sliderImageItem{
		background: url('<?php echo get_template_directory_uri(); ?>/images/lined.png') repeat;
	}
	.activeMove{
		background-color:#FEFFE2;
	}
	label.error{ margin-left: 10; display:block}
	#messageArea { position:absolute; left:200px; top:20px; width:720px; margin:10px;}
	#messageArea .waiting{padding:5px 5px 5px 25px; background:url('<?php echo get_template_directory_uri(); ?>/images/admin-loading.gif') #FF7300 5px center no-repeat; color:#FFFFFF; display:none;}
	#messageArea .successful{padding:5px; background-color:#10CD02; color:#FFFFFF; display:none;}
	#messageArea .error2{padding:5px; background-color:#FF0000; color:#FFFFFF; display:none;}
	#sliderOptions form input[type="text"], #sliderOptions form select{
		width:150px;
	}
	#sliderOptions form input[type="text"]{
		text-align:right;
	}
	input.editText{
		width:100%;
		padding:0;
		background:transparent;
		border:none;
	}
	</style>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/jquery-ui-1.9.2.custom.min.js"></script>

	<script type="text/javascript">
	var $ = jQuery.noConflict();
	function locateMsg()
	{					
		var left = ($(window).width() - $('#messageArea').outerWidth()) / 2;
		left += $(window).scrollLeft();
		var top = 20+$(window).scrollTop();
		$('#messageArea').css('left', left+'px');
		$('#messageArea').css('top', top+'px');
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

		$('#addAudioButton').click(function(){
			if($('#audioPath').val()!='')
			{
				$('#audioPaths table tbody').append($('<tr><td>'+$('#audioPath').val()+"</td><td><a href=\"javascript:void(0);\" onclick=\"removeAudio(this)\">Remove</a></td></tr>"));
				$( "#audioPaths tbody tr td:nth-child(1)").click(editPath);
			}else{
				alert('Please enter a url');
			}
		});
		$( "#audioPaths tbody").sortable({
			start:function(event, ui){
				ui.item.addClass('activeMove');
			},
			stop:function(event, ui){ 
				ui.item.removeClass('activeMove');
			},
			cancel: 'input, textarea'
		});
		$( "#saveAudio").click(function(){
			var audioList = '';
			$( "#audioPaths tbody tr").each(function(){
				audioList += $(this).find('td:nth-child(1)').text()+';';
			});
			audioList = audioList.substr(0,audioList.length-1);
			showMessage('waiting', 'Audio list is deleting...', 'save_audio');
			$.post(ajaxurl, {action:'save_audio_list', list:audioList},function(data){
				data = $.parseJSON(data);
				if(data.status=='OK')
				{
					showMessage('successful', 'Audio list has been saved successfully.', 'save_audio');
				}else
					showMessage('error', 'Audio list coudn\'t updated.', 'save_audio');
			});
		});
		$( "#audioPaths tbody tr td:nth-child(1)").click(editPath);
	});
	
	function editPath(){
		if($(this).find('input').length>0)return;
		$(this).unbind('click');
		var value = $(this).text();
		$(this).html('');
		$(this).append($('<input class="editText" type="text" name="edit" value="'+value+'" />').blur(function(){
			$(this).parent().click(editPath);
			var valueNew = $(this).val();
			$(this).parent().append(valueNew);
			$(this).parent().find('input').remove();
		}));
		$(this).find('input').focus();
	}
	
	function removeAudio(me){
		$(me).parent().parent().remove();
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
	 
	</script>
	<div class="wrap">
		<div id="icon-edit-pages" class="icon32"><br/></div>
		<h2>Audio Manager</h2>
		<div style="clear: both"></div>
		
		<div id="messageArea">
		</div>
		
		<div id="audioPaths" style="margin-top:15px; width:650px;">
			<div id="addAudio" style="padding:10px 0">
			<h3>Attention Please</h3>
			<p>Every item includes a song url. But it doesn't contain file extensions. 
			Because some off browsers support .mp3 and others support .ogg format. It automatically recognise it. 
		For the wider browser support you should put filename.mp3, filename.ogg formats to the folder. 
		There are many online web sites for converting mp3 format to ogg format.</p>
				<label style="margin-right:20px">URL</label>
				<input type="text" name="audioPath" id="audioPath" style="width:495px; margin-right:20px"/> 
				<input class="button" type="button" name="addAudioButton" id="addAudioButton" value="Add Audio"/>
			</div>
			<div id="sliderImages">
				<form id="sliderImageForm">
				<table id="sliderImageItems" class="widefat" cellspacing="0" style="width:650px">
					<thead>
						<th width="80%">URL</th>
						<th>Action</th>
					</thead>
					<tfoot>
						<th colspan="2">
							<input type="button" name="saveAudio" id="saveAudio" class="button" value="Save" />
						</th>
					</tfoot>
					<tbody>
						<?php 
						$audioList = get_option("audioList");
						if(empty($audioList)){
							register_setting('thiswaysettings', 'audioList');
						}else{
							$audioList = explode(';',$audioList);
							foreach($audioList as $audioItem)
							{
								echo "<tr>
								<td>$audioItem</td>
								<td>
									<a href=\"javascript:void(0);\" onclick=\"removeAudio(this)\">Remove</a>
								</td>
								</tr>
								";
							}
						}
						?>
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div>
	<?php
}
?>
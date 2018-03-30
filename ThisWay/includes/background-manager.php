<?php
function admin_backgrounds() 
{
	add_submenu_page('top-level-menu-action', 'Background Manager Admin', 'Background Manager', 'manage_options', 'sub-level-menu3-action', 'get_background_manager');
}
add_action('admin_menu', 'admin_backgrounds');

function create_background_table(){
		global $wpdb;
		$prf = $wpdb->prefix;
		$create_query2 = <<<EOT
CREATE TABLE `{$prf}backgrounds` (
  `IMAGEID` int(11) NOT NULL auto_increment,
  `SLIDERORDER` int(11) unsigned NOT NULL,
  `EXT` varchar(255) NOT NULL,
  `CAPTION` text,
  `DESCRIPTION` mediumtext NOT NULL,
  `TYPE` varchar(20) default NULL,
  `CONTENT` text,
  `THUMB` text,
  `WIDTH` int(11) default NULL,
  `HEIGHT` int(11) NOT NULL,
  PRIMARY KEY  (`IMAGEID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
EOT;
		$create2 = $wpdb->get_results($create_query2);
}

	
	//Check Table
	if($wpdb->get_var("SHOW TABLES LIKE '{$wpdb->prefix}backgrounds'") != $wpdb->prefix.'backgrounds')
		create_background_table();

function get_background_manager() 
{
	wp_enqueue_media();
	 
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
	.video{
		display:none;
		clear:both;
		border:1px solid #ECECEC;
		padding:10px;
		margin-bottom:10px;
	}
	.image{
		clear:both;
		border:1px solid #ECECEC;
		padding:10px;
		margin-bottom:10px;
	}
	#addBg ul{list-style:none;}
	#addBg ul li{
		float:left;
		margin:0 5px 0 0;
	}
	#addBg ul li a:link,
	#addBg ul li a:visited{
		display:block;
		padding:6px 12px;
		color:#333333;
		background-color: #F1F1F1;
		background-image:-moz-linear-gradient(center top , #F9F9F9, #ECECEC);
		font-family:Georgia,"Times New Roman","Bitstream Charter",Times,serif;
		text-decoration:none;
		border-radius:6px 6px 0px 0px;
		text-shadow:0 1px 0 rgba(255, 255, 255, 0.8);
	}
	#addBg ul li a:hover,
	#addBg ul li a:active{
		color:#333333;
		background-image:-moz-linear-gradient(center top , #ECECEC, #F9F9F9);
	}
	#addBg ul li a.selected:link,
	#addBg ul li a.selected:visited,
	#addBg ul li a.selected:hover,
	#addBg ul li a.selected:active
	{
		color:#F1F1F1;
		background-color: #333333;
		background-image: none;
		text-shadow:0 1px 0 rgba(0, 0, 0, 0.8);
	}
	</style>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/js/jquery-ui-1.9.2.custom.min.js"></script>

	<script type="text/javascript">
	
	jQuery(document).ready(function($) {		
		var bg_multi_image_uploader;
		$('#clickandload').click(function(e) {
			e.preventDefault();
	 
			if (bg_multi_image_uploader) {
				bg_multi_image_uploader.open();
				return;
			}
	 
			bg_multi_image_uploader = wp.media.frames.file_frame = wp.media({
				multiple: true,
				library: {
				  type: 'image'
				},
				title: 'Choose an Image',
				button: {
					text: 'Choose an Image'
				}
			});
	 
			bg_multi_image_uploader.on('select', function() {
				var selection = bg_multi_image_uploader.state().get('selection');
				var urls = new Array();
				selection.map( function( attachment ) {
				  attachment = attachment.toJSON();
				  urls.push(attachment.url);
				});
				if(urls.length>0){
					$.post(ajaxurl, {action:'insert_new_bg_item', urls:urls},function(data){
						data = $.parseJSON(data);
						if(data.status=='OK')
						{
							getSliderDetail();
							showMessage('successful', 'New items has been added successfully.', 'additem');
						}
						else
							showMessage('error', 'Have been an error while adding new items.', 'additem');
							
						if(data.Err) alert(data.Err);
					});
				}
			});
			bg_multi_image_uploader.open();
	 
		});
	});
	
	

	
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
				
		$('#addBg ul li a').click(function(){
			$('#addBg ul li a').removeClass('selected');
			$(this).addClass('selected');
			if($(this).attr('rel')=='video')
			{
				$('#addBg .video').show();
				$('#addBg .image').hide();
			}else{
				$('#addBg .video').hide();
				$('#addBg .image').show();
			}
		});
				
		$('#sliderImageForm').submit(function(){
			showMessage('waiting', 'Slider items are saving...', 'slideritemssave');
			var serialdata = $(this).serialize();
			serialdata+='&action=save_slider_items';
			$.ajax({
			   type: "POST",
			   url: ajaxurl,
			   data: serialdata,
			   success: function(msg){
				 showMessage('successful', 'Slider items has been saved successfuly.', 'slideritemssave');
				}
			});
			return false;
		});
		
		$('#addBg .video select').change(function(){
			var videoType = $('#addBg .video select option:selected').val();
			$('#addBg .video .videotype').hide();
			if(videoType=='youtube' || videoType=='vimeo')
				$('#addBg .video .videoid').show();
			else if(videoType=='player')
				$('#addBg .video .videourl').show();
			/*else if(videoType=='iframe')
				$('#addBg .video .videocode').show();*/
			
			if(videoType=='youtube' || videoType=='vimeo' || videoType=='player')
				$('#addBg .video .videowh').show();
			else
				$('#addBg .video .videowh').hide();
		});
		
		$('#addVideo').click(function(){
			var videoType = $('#addBg .video select option:selected').val();
			var videoData = '';
			if(videoType=='youtube' || videoType=='vimeo')
				videoData = $('#addBg .video .videoid input').val();
			else if(videoType=='player')
				videoData = $('#addBg .video .videourl input').val();
			else if(videoType=='iframe')
				videoData = $('#addBg .video .videocode textarea').val();
			
			var vW = $('#addBg .video .videowh input[name=width]').val();
			var vH = $('#addBg .video .videowh input[name=height]').val();
			
			if(videoType=='youtube' || videoType=='vimeo' || videoType=='player')
			{
				if(videoData=='' || vW=='' || vH=='' ){
					alert('You must fill all field');
					return;
				}
			}/*else if(videoType=='iframe'){
				if(videoData==''){
					alert('You must fill all field');
					return;
				}
			}*/
			
			showMessage('waiting', 'Adding your video item...', 'additem');
			$.post(ajaxurl, {action:'add_video_item', type:videoType, data:videoData, width:vW, height:vH},function(data){
				data = $.parseJSON(data);
				if(data.status=='OK')
				{
					getSliderDetail();
					showMessage('successful', 'New video item has been added successfully.', 'additem');
				}
				else
					showMessage('error', 'Have been an error while adding video item.', 'additem');
			});
			
		});
		
		
		$('#emptyItem').click(function(){
			showMessage('waiting', 'Adding an empty slider item...', 'additem');
			$.post(ajaxurl, {action:'add_empty_slider_item', sliderID:$("#sliderOptions input[name='SLIDERID']").val()},function(data){
				data = $.parseJSON(data);
				if(data.status=='ok')
				{
					getSliderDetail();
					showMessage('successful', 'New empty slider item has been added successfully.', 'additem');
				}
				else
					showMessage('error', 'Have been an error while adding empty slider item.', 'additem');
			});
		});
		
		getSliderDetail();
	});
	
	
	$.fn.clearForm = function() {
	  return this.each(function() {
	 var type = this.type, tag = this.tagName.toLowerCase();
	 if (tag == 'form')
	   return $(':input',this).clearForm();
	 if (type == 'text' || type == 'password' || tag == 'textarea')
	   this.value = '';
	 else if (type == 'checkbox' || type == 'radio')
	   this.checked = false;
	 else if (tag == 'select')
	   this.selectedIndex = -1;
	  });
	};
	
	function getSliderDetail()
	{
		showMessage('waiting', 'Backgrounds are getting...', 'slider_details');
		$.post(ajaxurl, {action:'list_slider_items'},function(data){
			showMessage('successful', 'Backgrounds has been getted successfully.', 'slider_details');
			$('#sliderImageItems tbody').html(data);
			$( "#sliderImageItems tbody").sortable({
				start:function(event, ui){
					ui.item.addClass('activeMove');
				},
				stop:function(event, ui){
					ui.item.removeClass('activeMove');
				},
				cancel: 'input, textarea'
			});
			$( "#sliderImageItems input, #sliderImageItems textarea" ).bind('click.sortable mousedown.sortable',function(ev){
				ev.target.focus();
			});
		});
	}
	
	function deleteItemImage(me)
	{
		if(window.confirm('Are you sure to delete this image?'))
		{
			var imgID = $(me).parent().parent().parent().find("input[name='imageID[]']").val();
			if(imgID!=undefined){
				showMessage('waiting', 'Image is deleting...', 'delete_image'+imgID);
				$.post(ajaxurl, {action:"remove_item_image", IMAGEID:imgID}, function(data){
					var jdata = $.parseJSON(data);
					if(jdata.status=='OK')
					{
						showMessage('successful', 'Image has been deleted successfully.', 'delete_image'+jdata.IMAGEID);
						$("#sliderImageItems input[name='imageID[]'][value='"+jdata.IMAGEID+"']").parent().parent().remove();
					}
					else
					{
						showMessage('error', 'Image coudn\'t be deleted.', 'delete_image'+jdata.IMAGEID);
					}
				});
			}
		}
	}
	
	function changeDimension(me, type)
	{
		var imgID = $(me).parent().parent().parent().find("input[name='imageID[]']").val();
		var dimValue = $(me).text();
		var newValue = window.prompt('Please enter a new value', dimValue);
		if(newValue!=false && dimValue!=newValue)
		{
			$('#imageID'+imgID+' .video'+type+' a').text(newValue);
			showMessage('waiting', 'Dimension of Video is deleting...', 'dim_video'+imgID);
			$.post(ajaxurl, {action:"change_video_dimension", IMAGEID:imgID, dimType:type, value:newValue}, function(data){
				var jdata = $.parseJSON(data);
				if(jdata.status=='OK')
				{
					showMessage('successful', 'Dimension of Video has been updated successfully.', 'dim_video'+jdata.IMAGEID);
					$('#imageID'+jdata.IMAGEID+' .video'+jdata.dimType+' a').text(jdata.value);
				}
				else
				{
					showMessage('error', 'Dimension of Video coudn\'t be updated.', 'dim_video'+jdata.IMAGEID);
				}
			});
		}
	}
	
	function thumUploader(me){
		var imgID = $(me).parent().parent().parent().find("input[name='imageID[]']").val();
		$('.thumbUplodifyWrap').remove();
		if($('#imageID'+imgID+' td:nth-child(2) .thumbUplodifyWrap').length==0)
		{
			var bg_thumb_uploader;
			if (bg_thumb_uploader) {
				bg_thumb_uploader.open();
				return;
			}
	 
			bg_thumb_uploader = wp.media.frames.file_frame = wp.media({
				multiple: false,
				library: {
				  type: 'image'
				},
				title: 'Choose a Thumbnail',
				button: {
					text: 'Choose an Image'
				}
			});
	 
			bg_thumb_uploader.on('select', function() {
				attachment = bg_thumb_uploader.state().get('selection').first().toJSON();
				
				$.post(ajaxurl, {action:'change_thumb_of_item', url:attachment.url, imageid:imgID },function(data){
					data = $.parseJSON(data);
					if(data.status=='OK')
					{
						if(data.status=='OK')
						$('#imageID'+imgID+' td:nth-child(1) .sliderImageItemImage img').attr('src', data.thumbpath);
					}
						
					if(data.Err) alert(data.Err);
				});
				
			});
			bg_thumb_uploader.open();
	 
		}
		
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
		<h2>Background Manager</h2>
		<div style="clear: both"></div>
		
		<div id="messageArea">
		</div>
		
		<div id="sliderDetail" style="margin-top:15px; width:650px;">
			<div id="addBg">
				<ul>
				 <li><a rel="image" class="selected" href="javascript:void(0);" >Image</a></li>
				 <li><a rel="video" href="javascript:void(0);" >Video</a></li>
				</ul>
				<div class="image">
		
					<input type="button" id="clickandload" class="button" value="Choose Image" />
				</div>
				<div class="video">
					<form>
					<select name="type" style="float:left; width:200px">
						<option value="youtube">Youtube</option>
						<option value="vimeo">Vimeo</option>
						<!--<option value="iframe">Iframe Code</option>-->
					</select>
					<div class="videotype videoid" style="float:left; margin-left:10px">
						<label style="width:100px">Video ID</label>
						<input type="text" name="id" value="" style="width:100px" />
					</div>
					<div class="videotype videourl" style="display:none">
						<label>Video URL</label>
						<input type="text" name="url" value="" />
					</div>
					<div class="videotype videocode" style="display:none; clear:both; padding:10px 0;">
						<label style="vertical-align: top; padding-right:150px;">Iframe Code</label>
						<textarea name="iframecode" style="width:400px;"></textarea>
					</div>
					<div class="videotype videowh" style="clear:both; padding:10px 0;">
						<label>Width</label>
						<input type="text" name="width" value="" style="width:50px; margin-left:15px" />
						<label>Height</label>
						<input type="text" name="height" value="" style="width:50px"/>
					</div>
					<input type="button" name="addVideo" id="addVideo" class="button" value="Add Video" />
					</form>
				</div>
			</div>
			<div id="sliderImages">
				<form id="sliderImageForm">
				<table id="sliderImageItems" class="widefat" cellspacing="0" style="width:650px">
					<thead>
						<th>Image</th>
						<th>Informations</th>
					</thead>
					<tfoot>
						<th colspan="2">
							<input type="submit" name="submit" class="button" value="Save Changes" />
						</th>
					</tfoot>
					<tbody>
					</tbody>
				</table>
				</form>
			</div>
		</div>
	</div>
	<?php
}
?>
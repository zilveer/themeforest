<?php
global $post;
$portfolio_slider = get_post_meta($post->ID,THEME_SLUG.'_portfolio_slider',true);
$portfolio_slider = unserialize($portfolio_slider);
?>

<div class="uploader">
	<input type="hidden" name="_portfolio_slider" value="1"/>
	<a href="javascript:void(0)" class="button stag-metabox-table" name="_unique_name_button" id="_unique_name_button"/>Insert</a>
	<a href="javascript:void(0)" class="button clear-all-slides" name="clear-all-slides" id="clear-all-slides"/>Clear</a>
	<div class="sortable-wrapper">
		<ul id="sortable">
			<?php
			if( is_array($portfolio_slider) && count($portfolio_slider) > 0 ):
				foreach( $portfolio_slider as $single_slider ):
			?>
				<li>
					<div id="image-value<?php echo $single_slider['id'];?>" class="hidden lightbox-image">
						<img  class="lightbox-preview-img" src="<?php echo $single_slider['image_url'];?>" alt="<?php echo $single_slider['alt'];?>" title="<?php echo $single_slider['title'];?>">
						<input type="hidden" value="<?php echo $single_slider['id'];?>" name="element_id[]" class="inline-element element_id">
						<input type="hidden" value="<?php echo $single_slider['image_url'];?>" name="element_image_url[]" id="element_image_url" class="inline-element insert_url">
						<input type="hidden" value="<?php echo $single_slider['thumb_id'];?>" name="thumb_id[]" id="thumb_id" class="inline-element element_thumb_id">
						<input type="hidden" value="<?php echo $single_slider['thumb_url'];?>" name="thumb_url[]" id="thumb_url" class="inline-element element_thumb">
						<p><span class="label">Slide Url</span><input type="text" value="<?php echo $single_slider['url'];?>" name="element_url[]" class="inline-element link_url"></p>
						<p><span class="label">Image Title</span><input type="text" value="<?php echo $single_slider['title'];?>" name="element_title[]" class="inline-element image_title "></p>
						<p><span class="label">Image Alt</span><input type="text" value="<?php echo $single_slider['alt'];?>" name="element_alt[]" class="inline-element image_alt"></p>
						<div class="btn fancy-button-wrapper">
							<a href="javascript:void(0)" class="button save-slide" name="save-slide"/>Save</a>
							<a href="javascript:void(0)" class="button save-slide" name="close-slide"/>Close</a>
						</div>	
					</div>
					
					
					<p class="image-wrappper">
						<img  class="preview-img" src="<?php echo $single_slider['thumb_url'];?>" alt="<?php echo $single_slider['alt'];?>" title="<?php echo $single_slider['title'];?>" width="120" height="120">
						<a href="#image-value<?php echo $single_slider['id'];?>" class="preview-img-edit">Edit</a>
						<a href="javascript:void(0)" class="preview-img-remove">Del</a>
					</p>
				</li>						
			<?php	
				endforeach;		
			endif;	
			?>

		</ul> 
	</div>
  
</div>
<script type="text/javascript">
//<![CDATA[
	function sort_list_images(){
		jQuery( "#sortable" ).sortable();
	}
    jQuery(document).ready(function($){

		clear_button = $('#clear-all-slides');
		
		if( $('#sortable > li').length > 0 )
			clear_button.show();
		else
			clear_button.hide();
		
		clear_button.click(function(event){
			$('#sortable').html('');
			clear_button.hide();
		});
		
		count_id = '<?php echo rand(0,1000),time()?>';
		count_id = parseInt(count_id); 
	var ready_lightbox = false;
	fancy = $(".preview-img-edit").fancybox({
		'minWidth' : 450
		,'minHeight' : 450
		,beforeLoad : function(){
			if(	ready_lightbox ){
			}			
		}
		,beforeClose  : function(){
			ready_lightbox = false;
		}
	});

	$(".save-slide").live('click',function(){
		$('.fancybox-close').trigger('click');
	});	

	

	$( "#sortable" ).disableSelection();	
		sort_list_images();
		var _custom_media = true,_orig_send_attachment = wp.media.editor.send.attachment;
		$('.stag-metabox-table').click(function(e) {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(this);
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment){
				console.log(attachment);
				//console.log(props);
				var thumb_id  = attachment.id;
				if( attachment.type == 'image' ){
					var thumb_url = '';
					if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
						thumb_url = attachment.sizes.thumbnail.url;
					}else{
						thumb_url = attachment.sizes[props.size].url;
					}
					//var insert_url = attachment.sizes[props.size].url;
					var insert_url = attachment.sizes['full'].url;
					var link_url = props.linkUrl;
					if( props.link == 'file' ){
						link_url = attachment.url;
					}
					if( props.link == 'post' ){
						link_url = attachment.link;
					}	
					if( props.link == 'none' ){
						link_url = '#';
					}					
					var image_title = attachment.title;
					var image_alt = attachment.alt;		
					build_html = '';
					if ( _custom_media ) {
						count_id = count_id + 1;
						build_html += '<div id="image-value' + count_id + '" class="hidden lightbox-image">';
						build_html += '<img  class="lightbox-preview-img" src="' + insert_url + '" alt="' + image_alt + '" title="' + image_title + '">';
						build_html += '<input type="hidden" value="' + count_id + '" name="element_id[]" class="inline-element element_id">';
						build_html += '<input type="hidden" value="' + thumb_url + '" name="thumb_url[]" id="thumb_url" class="inline-element element_thumb">';
						build_html += '<input type="hidden" value="' + thumb_id + '" name="thumb_id[]" id="thumb_id" class="inline-element element_thumb_id">';
						build_html += '<input type="hidden" value="' + insert_url + '" id="element_image_url" name="element_image_url[]" class="inline-element insert_url">';
						build_html += '<p><span class="label">Slide Url</span><input type="text" value="' + link_url + '" name="element_url[]" class="inline-element link_url"></p>';
						build_html += '<p><span class="label">Image Title</span><input type="text" value="' + image_title + '" name="element_title[]" class="inline-element image_title "></p>';
						build_html += '<p><span class="label">Image Alt</span><input type="text" value="' + image_alt + '" name="element_alt[]" class="inline-element image_alt"></p>';
						build_html += '<div class="btn fancy-button-wrapper"><a href="javascript:void(0)" class="button save-slide" name="save-slide"/>Save</a>';
						build_html += '<a href="javascript:void(0)" class="button save-slide" name="close-slide"/>Close</a></div>';
						build_html += '</div>';
						
						
						build_html += '<p class="image-wrappper">';
						build_html += '<img  class="preview-img" src="' + thumb_url + '" alt="' + image_alt + '" title="' + image_title + '" width="120" height="120">';
						build_html += '<a href="#image-value' + count_id + '" class="preview-img-edit">Edit</a>';
						build_html += '<a href="javascript:void(0)" class="preview-img-remove">Del</a>';
						build_html += '</p>';
						
						jQuery('<li class="ui-state-default"></li>').html(build_html).appendTo('#sortable');
						clear_button.show();

					} else {
						return _orig_send_attachment.apply( this, [props, attachment] );
					};
				}
			}
			wp.media.editor.open(button);
			sort_list_images();
			
			return false;
		});
		
		//bind editor upload image
		$('.add_media').on('click', function(){
			_custom_media = false;
		});
		
		//remove thumb function
		$('.image-wrappper > .preview-img-remove').live('click',function(){
			$(this).parent().parent().remove();
			if( $('#sortable > li').length > 0 )
				clear_button.show();
			else
				clear_button.hide();			
			sort_list_images();
		});
    });
//]]>	
</script>
<style>
	.iron-importer {
		position: relative;
	}
	.iron-importer .loader{
		display:none;
		position:absolute;
		background-image:url(<?php echo IRON_PARENT_URL; ?>/admin/assets/img/ajax-loader.gif);
		background-repeat:no-repeat;
		width:31px;
		height:31px;
		top: -1px;
		right: 5px;
	}
	.iron-importer .status{
		display:none;
		border:1px solid #ddd;
		padding:20px;
		margin-top:15px;
	}
	.iron-importer .status.error{
		border:1px solid red;
	}
	.iron-importer .status.success{
		border:1px solid green;
	}
</style>
<script>
	var iron_refresh_page = window.iron_refresh_page || false;

	jQuery(function($) {

		$('#iron-get-demos').click(function(e) {

			var postData = { action: 'iron_get_demos' };
			
			var loader   = $('#iron-importer-loader');
			var $this = $(this);
			var demo_list = $('#import_theme');
			var importer = $('#iron-importer');
			
			loader.fadeIn();
			
			$.ajax({
				url      : ajaxurl+'<?php echo (defined('ICL_LANGUAGE_CODE') ? '?lang='.ICL_LANGUAGE_CODE : ''); ?>',
				data     : postData,
				type     : 'post',
				dataType : 'json',
				success  : function (data) {
					
					if(data) {
							
						var themes = '';

						$.each(data, function(i, item) {
				
							themes += '<option value="'+item.id+'"';
							
							if(item.redux)
								themes += ' data-redux="'+item.redux+'"';
								
							if(item.revslider)	
								 themes += ' data-revslider="'+item.revslider+'"';
								 
							if(item.essgrid)	
								 themes += ' data-essgrid="'+item.essgrid+'"';	 
								 
							themes += '>';
							
							themes += item.name;
							
							themes += '</option>';
						
						});

						demo_list.html(themes).fadeIn();
								
					}
					
					$this.hide();
					loader.fadeOut();
					importer.fadeIn();
					
					
				}
			});		

						
		});
		
		
		$('#iron-importer').click(function(e) {
			e.preventDefault();

			var $this = $(this);

			if ( iron_refresh_page ) {
				window.location.reload(true);
				return;
			}

			if ( ! confirm("Attention: This will flush all posts, post metas, comments, links in your actual DB before importing. Are you sure you want to continue?") )
				return -1;

			var theme = "";
			var redux = "";
			var revslider = "";
			if($('#import_theme').length > 0) {
				theme = $('#import_theme').val();
				redux = $("#import_theme option[value='"+theme+"']").data('redux');
				revslider = $("#import_theme option[value='"+theme+"']").data('revslider');
			}

			var postData = { action: 'iron_import_default_data', theme: theme, redux: redux, revslider: revslider };
			var loader   = $('#iron-importer-loader');
			var status   = $('#iron-importer-status');


			loader.fadeIn();
			status.html('<p><strong>Flushing Current Data ... </strong></p>').fadeIn();

			$.ajax({
				url      : ajaxurl+'<?php echo (defined('ICL_LANGUAGE_CODE') ? '?lang='.ICL_LANGUAGE_CODE : ''); ?>',
				data     : postData,
				type     : 'post',
				dataType : 'json',
				success  : function (data) {

					status.append(data.msg);

					if ( data.error )
					{
						status.removeClass('success');
						status.addClass('error');
						loader.fadeOut();

					} else {

						status.removeClass('error');
						status.addClass('success');

						status.append('<hr><p><strong>Assigning Pages To Template...</strong></p>');

						postData = { action: 'iron_import_assign_templates', theme: theme, redux: redux, revslider: revslider };

						$.ajax({
							url      : ajaxurl+'<?php echo (defined('ICL_LANGUAGE_CODE') ? '?lang='.ICL_LANGUAGE_CODE : ''); ?>',
							data     : postData,
							type     : 'POST',
							dataType : 'json',
							success  : function (data) {

								status.append(data.msg);

								if ( data.error )
								{
									status.removeClass('success');
									status.addClass('error');
								}

								$this.addClass('button-primary').val('Reload Page');
								iron_refresh_page = true;

								loader.fadeOut();
							}
						});

					}


				}
			});
		});
	});
</script>


<div class="iron-importer">

	
	<input id="iron-get-demos" type="button" class="button" value="Get Available Demos">

	<select id="import_theme" style="display:none"></select>
	<input id="iron-importer" type="button" class="button" value="Import Default Data" style="display: none">

	<div id="iron-importer-loader" class="loader"></div>
	<div id="iron-importer-status" class="status" style="margin-top:20px;"></div>
</div>


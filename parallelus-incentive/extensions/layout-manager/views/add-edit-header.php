<?php global $shortname; ?>
<form id="header-add-edit" action="<?php echo $this->self_url(); ?>&navigation=headers-list&action=update-header<?php echo isset($header) ? '&old_alias='.$header['alias'] : ''; ?>" method="post">
	<?php require_once "header-form.php"; ?>
	<input type="hidden" id="header-alias" value="<?php echo (isset($_GET['alias'])) ? $_GET['alias'] : ''; ?>">
	<input class="button-primary" type="button" id="save-button" value="<?php _e('Save Settings', 'framework') ?>">
</form>
<script type="text/javascript">
	(function($){

		$('#save-button').click(function(e){			
			var prefix = '<?php echo $shortname . "layout_header_"; ?>';
			var headerTitle = $('#header-title').val().trim();
			
			if(headerTitle == ''){
				$('#header-title').css('border-color', 'Red');
			}			
			else{
				var header = $('#header-alias').val();
				if(header == ''){
					$.ajax({
						url: ajaxurl,
						async: false,
						data: {
							action: 'sanitize_title',
							string: headerTitle
						}
					}).done(function(responce){
						header = responce;
						$('#header-alias').val(header);
					});
				}

				console.log(prefix+header);
				save_custom_options(header, prefix+header, 'header');
				$('#header-add-edit').submit();
			}
		});
	})(jQuery);
</script>
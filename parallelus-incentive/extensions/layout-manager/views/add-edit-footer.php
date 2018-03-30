<?php global $shortname; ?>
<form id="footer-add-edit" action="<?php echo $this->self_url(); ?>&navigation=footers-list&action=update-footer<?php echo isset($footer) ? '&old_alias='.$footer['alias'] : ''; ?>" method="post">
	<input type="hidden" id="footer-alias" value="<?php echo isset($_GET['alias']) ? $_GET['alias'] : ''; ?>">
	<?php require_once "footer-form.php"; ?>
	<input class="button-primary" type="button" id="save-button" value="<?php _e('Save Settings', 'framework') ?>">
</form>
<script type="text/javascript">
	(function($){

		$('#save-button').click(function(e){			

			var footerTitle = $('#footer-title').val().trim();
			var prefix = '<?php echo $shortname . "layout_footer_"; ?>';

			if(footerTitle == ''){
				$('#footer-title').css('border-color', 'Red');
			}			
			else{
				var footer = $('#footer-alias').val();
				if(footer == ''){
					$.ajax({
						url: ajaxurl,
						async: false,
						data: {
							action: 'sanitize_title',
							string: footerTitle
						}
					}).done(function(responce){
						footer = responce;
						$('#footer-alias').val(footer);
					});
				}
				save_custom_options(footer, prefix+footer, 'footer');
				$('#footer-add-edit').submit();
			}
		});

	})(jQuery);
</script>
<div class="mc-metabox mc-page-meta">
	
	<div class="form-group">
		<?php $mb->the_field('hide_title'); ?>
		<div class="checkbox">
			<label id="label-mc-metabox-hide-title"><input type="checkbox" id="mc-metabox-hide-title" name="<?php $mb->the_name(); ?>" value="1" <?php $mb->the_checkbox_state('1'); ?>/> <?php echo __( 'Hide Title', 'mediacenter' ); ?></label>
		</div>
		<span class="help-block"><em><?php echo __( 'Check this if you do not want to display title in your page.', 'mediacenter' ); ?></em></span>
	</div>
	<div class="hide-title form-group">
		<?php $mb->the_field( 'page_title' ); ?>
		<label for="mc-page-meta-page-title"><?php echo __( 'Page Title', 'mediacenter' ); ?></label>
		<input id="mc-page-meta-page-title" class="form-control" type="text" name="<?php $mb->the_name('page_title'); ?>" value="<?php $mb->the_value('page_title'); ?>">
		<span class="help-block"><em><?php echo __( 'Leave blank if you do not want to display a different title for your page', 'mediacenter' );?>.</em></span>
	</div>
	<div class="hide-title form-group">
		<?php $mb->the_field( 'page_subtitle' ); ?>
		<label for="mc-page-meta-page-subtitle"><?php echo __( 'Page Subtitle', 'mediacenter' );?></label>
		<input id="mc-page-meta-page-subtitle" class="form-control" type="text" name="<?php $mb->the_name('page_subtitle'); ?>" value="<?php $mb->the_value('page_subtitle'); ?>">
	</div>
</div>
<script type="text/javascript">
jQuery(function ($) {
	$(document).ready(function(){
		toggleTitleFields();
		$('#mc-metabox-hide-title, #label-mc-metabox-hide-title').on('click', function(){
			toggleTitleFields();
		});	
	});

	function toggleTitleFields(){
		if($('#mc-metabox-hide-title').prop('checked')){
			$('.hide-title').hide();
		}else{
			$('.hide-title').show();
		}
	}
});

</script>
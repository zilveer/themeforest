<?php defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call ?>

<div class="mental_meta_control">
	<div class="metabox-gallery">

		<?php while( $mb->have_fields_and_multi( 'gallery' ) ): ?>
			<?php $mb->the_group_open(); ?>

			<?php $mb->the_field( 'imgid' ); ?>

			<div class="image">
				<button type="button" class="button azl_upload_image_button"
				        data-uploader_title="Choose Image for Metabox gallery"
				        data-uploader_button_text="Use Image"><?php _e( 'Choose Image', 'mental' ) ?></button>
				<br>
				<span class="azl_field_image_preview"><?php echo wp_get_attachment_image( $mb->get_the_value(), 'thumbnail' ); ?></span><br>
				<input class="azl_field_image_id hide" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"
				       type="text" value="<?php $mb->the_value(); ?>"/>
			</div>
			<div class="description">
				<a href="#" class="dodelete button"><?php _e( 'Remove Slide', 'mental' ) ?></a>

				<div class="clearfix"></div>

				<?php $mb->the_field( 'title' ); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Title', 'mental' ) ?></label>
				<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"
				       value="<?php $mb->the_value(); ?>"/>

				<?php $mb->the_field( 'description' ); ?>
				<label for="<?php $mb->the_name(); ?>"><?php _e( 'Description', 'mental' ) ?></label>
				<input type="text" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>"
				       value="<?php $mb->the_value(); ?>"/>

			</div>

			<?php $mb->the_group_close(); ?>
		<?php endwhile; ?>

		<p><a href="#" class="docopy-gallery button"><?php _e( 'Add Slide', 'mental' ) ?></a> <a href="#" class="dodelete-gallery button"><?php _e( 'Remove All Slides', 'mental' ) ?></a>
		</p>
	</div>
</div>


<!-- Show metabox only for page-onepage.php template-->
<script type="text/javascript">
	jQuery(document).ready(function(){
		metabox_template_switcher('page-onepage.php', '#onepage_top_slider_metabox');
	});
</script>
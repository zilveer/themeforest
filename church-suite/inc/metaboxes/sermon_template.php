<div id="sermon_video">
		<h4>Video</h4>
	<p>
		<?php $mb->the_field('sermon_video'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>Enter the Video URL</p>
</div>
<div id="sermon_audio">

		<h4>Audio</h4>
	<p>
		<?php $mb->the_field('sermon_audio'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>Enter the Audio URL</p>
</div>
<div id="sermon_pdf">
		<h4>File for Download</h4>
	<p>
		<?php $mb->the_field('sermon_pdf'); ?>
		<input type="text" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" class="widefat"/>	
	</p>
	<p>Enter the PDF or Media URL</p>
</div>
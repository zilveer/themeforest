	<div class="yit_options">
		<h3><?php _e( 'Download Sample Images', 'yit' ) ?></h3>
		<p><?php _e('Sample images must be used in combination with sample data.', 'yit' ) ?></p>
		<p><?php _e('Once you\'ve downloaded the zip file, you simply need the following steps to import the images:', 'yit' ); ?></p>
		<ol>
			<li><?php _e('Extract the zip package in your computer.', 'yit' ) ?></li>
			<li><?php _e('Upload it into the <strong>wp-content</strong> folder via FTP.', 'yit' ) ?></li>			
		</ol>

        <h4><?php _e('Please download the package according to Sample Data installed:','yit') ?></h4>
		<?php if( !defined('YIT_SAMPLE_IMAGES_URL') ): ?>
		<p>
			<a target="_blank" href="<?php echo admin_url('admin.php?page=yit_panel_support') ?>" class="button-secondary"><?php _e('Download Sample Images', 'yit') ?></a>
		</p>
		<?php else: ?>
		<p>
			<a target="_blank" href="<?php echo YIT_SAMPLE_IMAGES_URL ?>" class="button-secondary"><?php _e('Download Sample Images', 'yit') ?></a>
			<a target="_blank" href="<?php echo YIT_SAMPLE_IMAGES_LIGHT_URL ?>" class="button-secondary"><?php _e('Download Sample Images (Light version)', 'yit') ?></a>
		</p>
		<?php endif ?>
	</div>

<?php

$mk_artbees_products = new mk_artbees_products();
?>
 <div class="control-panel-holder">

<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-templates')); ?>

<div class="wp-install-template cp-pane">
	<div class="import_message"></div>
	<div class="install-template">
	<?php
		if ($mk_artbees_products->is_api_key_exists()){
			$compatibility = new Compatibility();
			$compatibility->setMkTemplatesDirectory();
			if($compatibility->isWritable($compatibility->getTemplateDir()) == TRUE){
	?>

			<div class="template-uploader">
				<h3><?php _e( 'Install Templates', 'mk_framework'); ?></h3>
				<ol>
					<li><strong><?php printf( __( 'Select and <a href="%s" target="_blank">Download</a> your desired template.', 'mk_framework' ), 'https://artbees.net/themes/template/' ); ?></strong></li>
					<li><?php _e( '<strong>Drag the file to install.</strong> Locate the downloaded file in your computer and Drag it into the section below.', 'mk_framework' ); ?></li>
				</ol>
				<div class="uploader-box uploader" id="drag-and-drop-zone">
						<span class="ic-drag-icon"><img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/drag-icon.png" alt=""></span>
						<h2><?php _e('Drag your template file here', 'mk_framework'); ?></h2>
						<input type="file" id="upload-btn" name="files[]" class="upload-btn" title="<?php _e('Browser Your Computer', 'mk_framework'); ?>" />
						<?php wp_nonce_field('abb_install_template_nonce', 'abb_install_template_security');?>
				</div>
			</div>

		<?php
			}else{
				echo mk_get_control_panel_view('permission-error', true, array('message' => 'In order to install new templates you must set right permission on upload directory.<br> <a target="_blank" href="https://artbees.net/themes/docs/template-errors/">Learn More</a>'));
			}
		}else{
    		echo mk_get_control_panel_view('register-product-popup', true, array('message' => 'In order to install new templates you must register theme.<br><a target="_blank" href="https://artbees.net/themes/docs/how-to-register-theme/">Learn how to register</a>'));
		}
		?>

<div id="fileList">
<!-- Files will be placed here -->
</div>

		<div class="current-template">
			<h3><?php _e( 'Installed Templates', 'mk_framework'); ?></h3>
			<div class="template-list" id="template-list">
				<?php $mk_artbees_products->get_list_of_templates();?>
			</div>
		</div>
		<?php echo mk_get_control_panel_view('template-callout', true); ?>
		<hr/>
		<div class="how-to">
			<strong><?php printf( __( 'Any problem? <a href="%s" target="_blank"><strong>View the tutorial here</strong></a>', 'mk_framework' ), 'https://artbees.net/themes/docs/how-to-register-theme/' ); ?></strong>
			<div class="how-to-video-list">
				<div class="video-item">
					<a target="_blank" href="https://www.youtube.com/watch?v=ZAu2bgcp3uQ">
						<img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/install-template-tuts-video.jpg" alt="">
						<i class="ic-play"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

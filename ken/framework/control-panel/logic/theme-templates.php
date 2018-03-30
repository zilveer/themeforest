<?php

$mk_artbees_products = new mk_artbees_products();
?>
 <div class="control-panel-holder">

<?php echo mk_get_control_panel_view('header', true, array('page_slug' => 'theme-templates')); ?>

<div class="wp-install-template cp-pane">
	<?php $mk_artbees_products->install_template_warnings(); ?>
	<div class="install-template">
	<?php if ($mk_artbees_products->is_verified_artbees_customer()) : ?>

			<div class="template-uploader">
				<h3>Install Templates</h3>
				<ol>
					<li><strong>Select and <a href="https://artbees.net/themes/template/" target="_blank">Download</a> your desired template.</strong></li>
					<li><strong>Drag the file to install.</strong> Locate the downloaded file in your computer and Drag it into the section below.</li>
				</ol>
				<div class="uploader-box uploader" id="drag-and-drop-zone">
						<span class="ic-drag-icon"><img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/drag-icon.png" alt=""></span>
						<h2>Drag your template file here</h2>
						<input type="file" id="upload-btn" name="files[]" class="upload-btn" title="Browser Your Computer" />
						<?php wp_nonce_field('abb_install_template_nonce', 'abb_install_template_security'); ?>
				</div>
			</div>

		<?php else : 
				echo mk_get_control_panel_view('register-product-popup', true, array('message' => 'In order to install new templates you must resgiter theme.<br> <a target="_blank" href="https://artbees.net/themes/docs/how-to-register-theme/">Learn how to register</a>')); 
			endif;
		?>
		
<div id="fileList">
<!-- Files will be placed here -->
</div>
		
		<div class="current-template">
			<h3>Installed Templates</h3>
			<div class="template-list" id="template-list">
				<?php $mk_artbees_products->get_list_of_templates(); ?>
			</div>
		</div>
		<?php echo mk_get_control_panel_view('template-callout', true); ?>
		<hr/>
		<div class="how-to">
			<strong>Any problem? <a href="https://artbees.net/themes/docs/how-to-install-templates/" target="_blank">View the tutorial here</a></strong>
			<div class="how-to-video-list">
				<div class="video-item">
					<a target="_blank" href="https://www.youtube.com/watch?v=8V7LSmCvf9g">
						<img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/install-template-tuts-video.jpg" alt="">
						<i class="ic-play"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

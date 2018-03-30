<?php if(! defined('ABSPATH')){ return; }
	$config = apply_filters( 'zn_dummy_data_locations', array() );
	$nonce = wp_create_nonce( 'zn_dummy_install' );
?>
<div class="zn-about-dummy-container" data-znnonce="<?php echo $nonce;?>">

	<div class="znfb-row">
		<div class="znfb-col-12">
			<div class="zn-lead-text">
				<p class="zn-lead-text--larger">These are the sample data packages that you can import into your website to reproduce an exact structured website like our demos. <br>We strongly recommend this step!</p>
				<p>* Please know that images, videos and other media, are not included.</p>
				<p>** The import process <strong>might take even 10-15 minutes</strong>. There are known web-hostings that are having issues with importing the data (eg: HostGator and GoDaddy) that are simply not connecting to our server to download the data. <strong>If you can't get the sample data to install</strong>, please follow this "<a href="http://support.hogash.com/documentation/alternative-dummy-data-install/" target="_blank">Alternative dummy/sample data install</a>" guide with alternative methods.</p>
			</div>
		</div>
	</div>

	<div class="znfb-row">

		<?php foreach ($config as $key => $value) : ?>
			<div class="znfb-col-3">
				<div class="zn-about-dummy-wrapper zn-about-box">
					<div class="zn-about-dummy-image">
						<img src="<?php echo $value['image']; ?>" alt="<?php echo $value['title']; ?>" />
						<div class="zn-about-dummy-details">
							<h4 class="zn-about-dummy-title"><?php echo $value['title']; ?></h4>
							<div class="zn-about-dummy-desc">
								<?php echo $value['desc']; ?>
							</div>
						</div>
						<div class="zn-dummy-import-block" style="display:none;"></div>
					</div>
					<div class="zn-about-dummy-actions">
						<a href="#" class="zn-about-dummy-button zn-about-dummy-install"
						   data-install_folder="<?php echo $value['folder']; ?>"
							data-demo_name="<?php echo $key;?>">Install</a>
						<a href="<?php echo $value['preview']; ?>" class="zn-about-dummy-button zn-about-dummy-green" target="_blank">Preview</a>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>


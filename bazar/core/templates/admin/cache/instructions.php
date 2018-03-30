<div class="wrap">
	<h2 class="response">Changing File Permissions to cache folder using FileZilla</h2>
	
	<p><strong>File Permissions</strong> affect the capability of users or group of users to <em>Read</em>, <em>Write</em> or <em>Execute</em> files. They define who or what can read , write or execute the files or directories.</p>

	<h3>The steps to change File Permissions using FileZilla</h3>
	<ol>
	<li><a target="_blank" href="http://filezilla-project.org/download.php">Download and install FileZilla</a>, if you haven’t done it yet.</li>
	<li>Open <em>FileZilla</em> and put your FTP data within <strong>Quickconnect bar</strong>
	<p></p><div style="width: 310px" class="wp-caption aligncenter"><a href="http://yithemes.com/cdn/images/cache/quickconnect.jpg"><img alt="Selecting File Permissions" src="http://yithemes.com/cdn/images/cache/quickconnect_thumb.jpg" class="size-medium"></a><p class="wp-caption-text">Quickconnect</p></div></li>
	<li>Browse to the theme directory: <?php echo YIT_THEME_PATH ?></li>
	<li>Right-click on <strong>cache</strong> folder and click on “File Permissions…”
	<p></p><div style="width: 310px" class="wp-caption aligncenter"><a href="http://yithemes.com/cdn/images/cache/filepermissions.jpg"><img alt="Selecting File Permissions" src="http://yithemes.com/cdn/images/cache/filepermissions_thumb.jpg" class="size-medium"></a><p class="wp-caption-text">Selecting Folder Permissions</p></div></li>
	<li>An interface would pop-up asking for the required <em>File Permissions</em>. Fill the box <em>Numeric value</em> with <strong>777</strong> value. Choose the option <em>“Recurse into Subdirectories“</em> and then select <em>Apply to all files and directories</em> sub-options.
	<p></p><div style="width: 310px" class="wp-caption aligncenter" id="attachment_226"><a href="http://yithemes.com/cdn/images/cache/numericvalue.jpg"><img alt="Entering the Required File Permission" src="http://yithemes.com/cdn/images/cache/numericvalue_thumb.jpg" class="size-medium"></a><p class="wp-caption-text">Entering the Required File Permission</p></div></li>
	<li>Then click “OK“. You can see the status of the process of changing <em>File Permissions</em> in the Status Bar on top.</li>
	</ol>

	<h4 style="margin-top:50px">Need more help? Submit a ticket in our <a href="<?php echo admin_url('admin.php?page=yit_panel_support') ?>">support forum</a>.</h4>

</div>
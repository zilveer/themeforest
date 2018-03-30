<?php
	/*Welcome message template - backend*/

	echo '<div class="admin-page ">';
    	options::get_header( '', '', '' );
    	echo '<div class="content">
				<h2>Please choose below the theme section you wish to edit</h2>
				<div class="info-panel general-settings">
					<h3>
						<a href="admin.php?page=cosmothemes__settings">General settings</a>
					</h3>
					<p>Choose general settings, Styles, Typography, Post settings, Tooltips, etc. </p>
				</div>
				<div class="info-panel template-builder">
					<h3>
						<a href="admin.php?page=cosmothemes__templates">Templates builder</a>
					</h3>
					<p>Create custom templates: choose desired elements, content type and style.</p>
				</div>
				<div class="info-panel layouts">
					<h3>
						<a href="admin.php?page=cosmothemes__layouts">Layouts</a>
					</h3>
					<p>Assign created templates to site sections</p>
				</div>
				<div class="info-panel extra-settings">
					<h3>
						<a href="admin.php?page=cosmothemes__extra">Extra settings</a>
					</h3>
					<p>Create sidebars, Import / Export data, Custom CSS, Notifications, Download more themes, etc</p>
				</div>
			</div>';
    echo '</div>';
?>
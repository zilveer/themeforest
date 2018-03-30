<?php
global $iron_updates;
$theme_data = wp_get_theme();
$item_uri = $theme_data->get('ThemeURI');
$name = $theme_data->get('Name');
$description = $theme_data->get('Description');
$author = $theme_data->get('Author');
$author_uri = $theme_data->get('AuthorURI');
$version = $theme_data->get('Version');
$tags = $theme_data->get('Tags');	
?>
<!-- CSS -->
<link rel="stylesheet" href="<?php echo IRON_PARENT_URL; ?>/admin/assets/css/blueprint-css/screen.css" type="text/css" media="screen, projection">
<!--[if lt IE 8]><link rel="stylesheet" href="<?php echo IRON_PARENT_URL; ?>/admin/assets/blueprint-css/ie.css" type="text/css" media="screen, projection"><![endif]-->
<link rel="stylesheet" href="<?php echo IRON_PARENT_URL; ?>/admin/assets/css/blueprint-css/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="<?php echo IRON_PARENT_URL; ?>/admin/assets/css/style.css" type="text/css" media="screen, projection">
<link href="//fonts.googleapis.com/css?family=Monda:400,700" rel="stylesheet" type="text/css">

<script>
jQuery(document).ready(function(e) {
	jQuery('.toggle').on('click', function(e) {
		e.preventDefault();
		$toggle = jQuery(this);
		$target = jQuery($toggle.attr('href'));
		
		$target.toggle('fade', function() {
			
			if(jQuery(this).is(':hidden')) {
				$toggle.text('+');
			}else{
				$toggle.text('-');
			}
		});
	});	
});	
</script>

<div class="iron-docs">
	<div class="container">
		<div class="top center">
			<div class="box">
				<img src="<?php echo IRON_PARENT_URL ?>/admin/assets/img/logo.png">
			</div>
		</div>
		<h1><?php echo esc_html($name); ?></h1>

		<div class="borderTop">
			<div class="span-8 colborder info prepend-1">
				<p class="prepend-top">
					<strong>
						Name: <?php echo esc_html($name); ?>br>
						Version: <?php echo esc_html($version); ?><br>
						Created: October 2014<br>
						By: <a href="<?php echo esc_url($author_uri); ?>"><?php echo esc_html($author); ?></a><br>
						<a href="mailto:support@irontemplates.com">support@irontemplates.com</a>
					</strong>
				</p>
			</div>

			<div class="span-10 last">
				<p class="prepend-top append-0">Thank you for purchasing our template. If you need support or have any questions, you can contact us via our ThemeForest <a target="_blank" href="http://themeforest.net/user/irontemplates">profile page</a>.</p>
			</div>
		</div>

		<hr>
		<h2>Documentation</h2>
		
		<p><a target="_blank" href="http://docs.irontemplates.com/<?php echo IRON_TEXT_DOMAIN; ?>">Visit our online documentation</a></p>


		<?php if(!empty($iron_updates)): ?>
		<hr>
		<h2>Change-Log <a href="#changelog" class="toggle">+</a></h2>
		<div id="changelog" class="changelog prepend-1">
		<?php foreach($iron_updates as $update): ?>
		
			<h4>V.<?php echo esc_html($update["version"]); ?> - <em><?php echo esc_html($update["date"]); ?></em></h4>
			<ul>
			<?php foreach($update["changes"] as $change): ?>
			
				<li><?php echo esc_html($change); ?></li>
				
			<?php endforeach; ?>
			</ul>
			
		<?php endforeach; ?>
		</div>
		<?php endif; ?>
		
		<hr>

		<p>Thank you again for purchasing our template. Feel free to <a href="mailto:support@irontemplates.com">contact us</a> if you have any questions or concerns.</p>

		<hr class="space">
		<p class="append-bottom large"><strong>IronTemplates.com</strong></p>

	</div>
</div>
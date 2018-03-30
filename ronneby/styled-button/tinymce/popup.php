<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php require_once '../../../../../wp-load.php'; ?>
<?php require_once '../config.php'; ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php wp_title('|'); ?></title>
	
	<link type="text/css" rel="stylesheet" href="<?php echo admin_url('css/wp-admin.css'); ?>" />
	<link type="text/css" rel="stylesheet" href="css/popup-style.css?<?php echo date('YmdHis'); ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/icons/css/icon-font-style.css?<?php echo date('YmdHis'); ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/styled-button.css?<?php echo date('YmdHis'); ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/icons/css/generator.css?<?php echo date('YmdHis'); ?>" />
	<?php
	$fonts = get_option('dfd_ronneby_fonts');
	$uploads_dir = wp_upload_dir();
	if(is_array($fonts)) {
		foreach($fonts as $font => $info) {
			if(strpos($info['style'], 'http://' ) !== false) {
				echo '<link type="text/css" rel="stylesheet" href="'.$info['style'].'?'. date('YmdHis') .'" />';
			} else {
				echo '<link type="text/css" rel="stylesheet" href="'.trailingslashit($uploads_dir['baseurl']).'/dfd_ronneby_fonts/'.$info['style'].'?'. date('YmdHis') .'" />';
			}
		}
	}
	?>
	
	<script type="text/javascript" src="<?php echo includes_url('/js/jquery/jquery.js') ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('/js/tinymce/tiny_mce_popup.js') ?>"></script>
	<script type="text/javascript" src="js/popup.js?<?php echo date('YmdHis'); ?>"></script>
	
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/icons/js/generator.js?<?php echo date('YmdHis'); ?>"></script>
	
	<script type="text/javascript">
		var button_shortcode_name = '<?php echo $button_shortcode_name; ?>';
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	
	<style type="text/css">
		body.styled-button-body #mnky-generator-wrap {
			min-width: 0 !important;
			min-height: 0 !important;
		}
		
		body.styled-button-body .mnky-generator-icon-select ul {
			max-height: 300px;
		}
	</style>
</head>
<body class="wp-admin styled-button-body">
	<form method="post" action="" onsubmit="return StyledButtonPopup.insert(jQuery(this));">
		<div class="mceContentBody">
			<?php if (!empty($button_settings)) : ?>
				<?php foreach ($button_settings as $setting) : ?>
				<div <?php echo (!empty($setting['col_span'])) ? 'class="'.$setting['col_span'].'"' : ''; ?>>
					<label <?php echo ($setting['type'] === 'delim') ? 'class="section-title"' : ''; ?>><?php echo $setting['label']; ?></label>
					
					<?php if ($setting['type'] === 'delim') : ?>
						<div class="clearfix"></div>
					<?php endif; ?>
						
					<?php if ($setting['type'] === 'text') : ?>
						<input id="<?php echo esc_attr($setting['id']); ?>" type="text" name="<?php echo esc_attr($setting['name']); ?>" value="" />
					<?php endif; ?>
						
					<?php if ($setting['type'] === 'icon') : ?>
						<input id="<?php echo esc_attr($setting['id']); ?>" class="iconname" type="text" name="<?php echo esc_attr($setting['name']); ?>" value="" />
						<a href="#" class="updateButton crum-icon-add"><?php _e('Add Icon', 'dfd'); ?></a>
					<?php endif; ?>
						
					<?php if ($setting['type'] === 'select') : ?>
						<select id="<?php echo esc_attr($setting['id']); ?>" name="<?php echo esc_attr($setting['name']); ?>">
							<?php foreach ($setting['options'] as $option) : ?>
								<option value="<?php echo esc_attr($option['class']); ?>" 
									<?php if (isset($option['default']) && $option['default']===true) echo 'selected="selected"'?>>
										<?php echo $option['label'] ?>
								</option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<div id="preview" style="text-align: center; min-height: 50px;"></div>
		</div>
		
		<div class="mceActionPanel">
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
			<input type="button" id="apply" name="apply" value="{#preview.preview_desc}" onclick="return StyledButtonPopup.insert(jQuery('body.styled-button-body>form'), true);" />
		</div>
	</form>
	
	<?php if (function_exists('crum_i_generator')) { crum_i_generator(); } ?>
</body>
</html>

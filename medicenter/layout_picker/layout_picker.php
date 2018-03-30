<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/layout_picker/layout_picker.css" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/layout_picker/layout_picker.js"></script>
<div class="layout_picker">
	<a href="#" class="layout_picker_icon">&nbsp;</a>
	<div class="layout_picker_content">
		<h3 class="layout_picker_header"><?php _e("Layout", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_layout">
					<option value="layout_picker_wd"<?php echo (!isset($_COOKIE['mc_layout']) || $_COOKIE['mc_layout']=="" ? ' selected="selected"' : ''); ?>><?php _e("Wide", 'medicenter'); ?></option>
					<option value="layout_picker_bx"<?php echo (isset($_COOKIE['mc_layout']) && $_COOKIE['mc_layout']=="boxed" ? ' selected="selected"' : ''); ?>><?php _e("Boxed", 'medicenter'); ?></option>
					<option value="layout_picker_fw"<?php echo (isset($_COOKIE['mc_layout']) && $_COOKIE['mc_layout']=="fullwidth" ? ' selected="selected"' : ''); ?>><?php _e("Full width", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
		<h3 class="layout_picker_header"><?php _e("Color Skin", 'medicenter'); ?></h3>
		<?php
		$site_url_explode = explode("/", site_url());
		$current = array_pop($site_url_explode);
		$site_url = implode("/", $site_url_explode) . "/";
		?>
		<ul class="color_skin_list clearfix">
			<li>
				<a href="<?php echo $site_url; ?>medicenter/" class="mc_skin_blue<?php echo ($current=="medicenter" ? ' selected' : ''); ?>"></a>
			</li>
			<li>
				<a href="<?php echo $site_url; ?>medicenter-green/" class="mc_skin_green<?php echo ($current=="medicenter-green" ? ' selected' : ''); ?>"></a>
			</li>
			<li class="last">
				<a href="<?php echo $site_url; ?>medicenter-orange/" class="mc_skin_orange<?php echo ($current=="medicenter-orange" ? ' selected' : ''); ?>"></a>
			</li>
			<li>
				<a href="<?php echo $site_url; ?>medicenter-red/" class="mc_skin_red<?php echo ($current=="medicenter-red" ? ' selected' : ''); ?>"></a>
			</li>
			<li>
				<a href="<?php echo $site_url; ?>medicenter-turquoise/" class="mc_skin_turquoise<?php echo ($current=="medicenter-turquoise" ? ' selected' : ''); ?>"></a>
			</li>
			<li class="last">
				<a href="<?php echo $site_url; ?>medicenter-violet/" class="mc_skin_violet<?php echo ($current=="medicenter-violet" ? ' selected' : ''); ?>"></a>
			</li>
		</ul>
		<h3 class="layout_picker_header"><?php _e("Header type", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_header_type">
					<option value="1"<?php echo (!isset($_COOKIE['mc_header_type']) || (int)$_COOKIE['mc_header_type']==1 ? ' selected="selected"' : ''); ?>><?php _e("Type 1", 'medicenter'); ?></option>
					<option value="2"<?php echo (isset($_COOKIE['mc_header_type']) && (int)$_COOKIE['mc_header_type']==2 ? ' selected="selected"' : ''); ?>><?php _e("Type 2", 'medicenter'); ?></option>
					<option value="3"<?php echo (isset($_COOKIE['mc_header_type']) && (int)$_COOKIE['mc_header_type']==3 ? ' selected="selected"' : ''); ?>><?php _e("Type 3", 'medicenter'); ?></option>
					<option value="4"<?php echo (isset($_COOKIE['mc_header_type']) && (int)$_COOKIE['mc_header_type']==4 ? ' selected="selected"' : ''); ?>><?php _e("Type 4", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
		<h3 class="layout_picker_header"><?php _e("Top sidebar", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_header_sidebar">
					<option value="1"<?php echo (!isset($_COOKIE['mc_header_sidebar']) || (int)$_COOKIE['mc_header_sidebar']==2 ? ' selected="selected"' : ''); ?>><?php _e("Yes", 'medicenter'); ?></option>
					<option value="0"<?php echo (isset($_COOKIE['mc_header_sidebar']) && (int)$_COOKIE['mc_header_sidebar']==0 ? ' selected="selected"' : ''); ?>><?php _e("No", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
		<div id="layout_picker_header_sidebar_right_container"<?php echo (isset($_COOKIE["mc_header_type"]) && (int)$_COOKIE["mc_header_type"]!=2 ? ' style="display: none;"' : ''); ?>>
			<h3 class="layout_picker_header"><?php _e("2nd sidebar", 'medicenter'); ?></h3>
			<ul class="layout_picker_layout_list">
				<li>
					<select name="layout_picker_header_sidebar_right">
						<option value="1"<?php echo (!isset($_COOKIE['mc_header_sidebar_right']) || (int)$_COOKIE['mc_header_sidebar_right']==1 ? ' selected="selected"' : ''); ?>><?php _e("Yes", 'medicenter'); ?></option>
						<option value="0"<?php echo (isset($_COOKIE['mc_header_sidebar_right']) && (int)$_COOKIE['mc_header_sidebar_right']==0 ? ' selected="selected"' : ''); ?>><?php _e("No", 'medicenter'); ?></option>
					</select>
				</li>
			</ul>
		</div>
		<h3 class="layout_picker_header"><?php _e("Sticky Menu", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_sticky_menu">
					<option value="0"<?php echo (!isset($_COOKIE['mc_sticky_menu']) || (int)$_COOKIE['mc_sticky_menu']==0 ? ' selected="selected"' : ''); ?>><?php _e("No", 'medicenter'); ?></option>
					<option value="1"<?php echo (isset($_COOKIE['mc_sticky_menu']) && (int)$_COOKIE['mc_sticky_menu']==1 ? ' selected="selected"' : ''); ?>><?php _e("Yes", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
		<h3 class="layout_picker_header"><?php _e("Direction", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_direction">
					<option value="LTR"<?php echo (!isset($_COOKIE['mc_direction']) || $_COOKIE['mc_direction']=="LTR" ? ' selected="selected"' : ''); ?>><?php _e("LTR", 'medicenter'); ?></option>
					<option value="RTL"<?php echo (isset($_COOKIE['mc_direction']) && $_COOKIE['mc_direction']=="RTL" ? ' selected="selected"' : ''); ?>><?php _e("RTL", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
		<h3 class="layout_picker_header"><?php _e("Animations", 'medicenter'); ?></h3>
		<ul class="layout_picker_layout_list">
			<li>
				<select name="layout_picker_animations">
					<option value="1"<?php echo (!isset($_COOKIE['mc_animations']) || (int)$_COOKIE['mc_animations']==1 ? ' selected="selected"' : ''); ?>><?php _e("yes", 'medicenter'); ?></option>
					<option value="0"<?php echo (isset($_COOKIE['mc_animations']) && (int)$_COOKIE['mc_animations']==0 ? ' selected="selected"' : ''); ?>><?php _e("no", 'medicenter'); ?></option>
				</select>
			</li>
		</ul>
	</div>
</div>

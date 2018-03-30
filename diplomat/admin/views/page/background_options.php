<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" name="tmm_meta_saving" value="1" />

<div class="custom-page-options">       
        
    <p>
		<strong><?php esc_html_e('Header Type', 'diplomat'); ?></strong>
	</p>
    
    <div class="sel">            
		<select name="header_type" class="header_type">
			<?php
                        
			$options = array(
				'light' => __('Default Light', 'diplomat'),
				'dark' => __('Default Dark', 'diplomat'),
				'blue' => __('Default Blue', 'diplomat'),
				'alternate' => __('Alternate', 'diplomat')
			);			
			?>
			<?php foreach ($options as $key => $option){ ?>
				<option <?php echo($key == $header_type ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php } ?>
		</select>			
	</div>
        
	<p>
		<strong><?php esc_html_e('Another page title', 'diplomat'); ?></strong>
	</p>

	<input type="text" name="another_page_title" value="<?php if (isset($another_page_title)) echo esc_attr($another_page_title) ?>" />

	<p>
		<strong><?php esc_html_e('Hide Page Title', 'diplomat'); ?></strong>
	</p>

	<div class="sel">
		<select name="headerbg_hide" class="headerbg_type_image_option">
			<?php
			$options = array(
				0 => __('No', 'diplomat'),
				1 => __('Yes', 'diplomat'),
			);

			if (!isset($headerbg_hide)) {
				$headerbg_hide = 0;
			}
			?>
			<?php foreach ($options as $key => $option) : ?>
				<option <?php echo($key == $headerbg_hide ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php endforeach; ?>
		</select>			
	</div>

	<?php global $post;
		$type = $post->post_type;
	if ($type == 'post'){
		?>
		<p>
			<strong><?php esc_html_e('Post Layout', 'diplomat'); ?></strong>
		</p>

		<div class="sel">
			<select name="post_template" class="post_template_option">
				<?php
				$options = array(
					'default' => __('Default', 'diplomat'),
					'alternate' => __('Alternate', 'diplomat'),
				);

				if (!isset($post_template)) {
					$post_template = 'default';
				}
				?>
				<?php foreach ($options as $key => $option) : ?>
					<option <?php echo($key == $post_template ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	<?php
	}
	?>

    <p>
		<strong><?php esc_html_e('Footer Sidebar', 'diplomat'); ?></strong>
	</p>
    
    <div class="sel">
		<select name="footer_sidebar" class="footer_sidebar">
			<?php
			$options = array(
				1 => __('Display Footer Sidebar', 'diplomat'),
				0 => __('Do Not Display Footer Sidebar', 'diplomat'),
			);

			if (!isset($footer_sidebar)) {
				$footer_sidebar = 1;
			}
			?>
			<?php foreach ($options as $key => $option) : ?>
				<option <?php echo($key == $footer_sidebar ? "selected" : "") ?> value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php endforeach; ?>
		</select>			
	</div>
    
</div>

<hr>

<h4><?php esc_html_e('Page Sidebar Position', 'diplomat'); ?></h4>
<input type="hidden" value="<?php echo (!$page_sidebar_position ? "sbr" : esc_attr($page_sidebar_position)) ?>" name="page_sidebar_position" />

<ul class="admin-page-choice-sidebar clearfix">
	<li class="lside <?php echo esc_attr($page_sidebar_position == "sbl" ? "current-item" : "") ?>"><a href="sbl" data-val="sbl"><?php esc_html_e('Left Sidebar', 'diplomat'); ?></a></li>
	<li class="wside <?php echo esc_attr($page_sidebar_position == "no_sidebar" ? "current-item" : "") ?>"><a href="no_sidebar" data-val="no_sidebar"><?php esc_html_e('Without Sidebar', 'diplomat'); ?></a></li>
	<li class="rside <?php echo esc_attr($page_sidebar_position == "sbr" ? "current-item" : "") ?>"><a href="sbr" data-val="sbr"><?php esc_html_e('Right Sidebar', 'diplomat'); ?></a></li>
</ul>
<div class="clear"></div>

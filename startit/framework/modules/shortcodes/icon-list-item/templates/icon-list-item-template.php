<?php
$icon_html = qode_startit_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div class="qodef-icon-list-item">
	<div class="qodef-icon-list-icon-holder">
        <div class="qodef-icon-list-icon-holder-inner clearfix">
			<?php 
			print $icon_html;
			?>
		</div>
	</div>
	<p class="qodef-icon-list-text" <?php echo qode_startit_get_inline_style($title_style)?> > <?php echo esc_attr($title)?></p>
</div>
<?php
$icon_html = flow_elated_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div class="eltd-icon-list-item">
	<div class="eltd-icon-list-icon-holder">
        <div class="eltd-icon-list-icon-holder-inner clearfix">
			<?php 
			print $icon_html;
			?>
		</div>
	</div>
	<p class="eltd-icon-list-text" <?php echo flow_elated_get_inline_style($title_style)?> > <?php echo esc_attr($title)?></p>
</div>
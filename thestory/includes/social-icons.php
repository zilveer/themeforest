<?php
//PRINT THE SOCIAL ICONS
$p_icons = pexeto_option("sociable_icons");

if(!empty($p_icons)){
		?>
	<div class="social-profiles"><ul class="social-icons">
	<?php
	$icon_style = pexeto_option('header_icon_style');
	foreach ($p_icons as $icon) {
		$title=!empty($icon["icon_title"])?' title="'.$icon["icon_title"].'"':'';
		$icon_url = $icon_style=='light' ? 
			str_replace('/icons/', '/icons_white/', $icon["icon_url"]) : $icon["icon_url"];
		?>
	<li>
		<a href="<?php echo esc_url( $icon["icon_link"] );?>" target="_blank" <?php echo stripslashes($title); ?>>
			<div>
				<img src="<?php echo $icon_url; ?>" alt="" />
			</div>
		</a>
	</li>
	<?php } ?>
	</ul></div>
	<?php 
}
?>
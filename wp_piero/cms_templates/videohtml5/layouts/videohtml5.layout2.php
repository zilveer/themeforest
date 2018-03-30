<div class="<?php echo $class;?>">
	<img src="<?php echo $image_src; ?>" alt="poster" />
	<video class="videohtml5" <?php echo join(' ', $attr_strings);?>>
		<?php echo $source_html;?>
	</video>
	<div class="ww-video-bg" style="background:<?php echo $bg_video_color;?>;"></div>
	<?php if($show_btn||$content):	?>
		<div class="content_wrap">
		<?php if($show_btn):	?>
			<div class="exp-videobg-control-btn control-btn-<?php echo $style;?> btn-<?php echo $size;?>">
			<?php if($text):?>
			<div class="exp-fonts-giant"><?php echo $text;?></div>
			<?php endif;?>
			<i class="<?php echo $icon;?>"></i>
			</div>
		<?php endif;?>
		<?php if($content):	?>
			<div class="exp-videobg-content">
			<?php echo $content;?>
			</div>
		<?php endif;?>
		</div>
	<?php endif;?>
</div>
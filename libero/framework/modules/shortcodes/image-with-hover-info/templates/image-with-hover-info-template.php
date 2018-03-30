<div class="mkd-image-with-hover-info">
   <div class="mkd-image-with-hover-info-inner">
       <a class= "mkd-link" href="<?php echo esc_url($params['link'])?>" target="_blank"></a>
       <?php echo wp_get_attachment_image($image,'full'); ?>
       <div class="mkd-info-holder">
			<div class="mkd-info">
				<?php echo do_shortcode($content);?>
       		</div>
			<div class="mkd-mask">
       		</div>
       </div>
   </div>
</div>

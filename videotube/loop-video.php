<div class="col-sm-<?php print mars_get_columns();?> col-xs-6 item responsive-height">
	<div class="item-img">
		<?php 
			if( has_post_thumbnail() ){
				$thumbnail_size = mars_convert_columns_to_thumbnail_size();
				print '<a href="'.get_permalink(get_the_ID()).'">'. get_the_post_thumbnail(null,$thumbnail_size, array('class'=>'img-responsive')) . '</a>';
			}
		?>
		<?php if( get_post_type() == 'video' ):?>
			<a href="<?php echo get_permalink(get_the_ID()); ?>"><div class="img-hover"></div></a>
		<?php endif;?>
	</div>
	<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	<?php do_action( 'mars_video_meta' );?>
</div>
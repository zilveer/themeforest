
<?php
global $portfolio_category,$portfolio_gallery, $gallery_layout, $gallery_item;
?>
<?php 

if($portfolio_gallery){
	if($gallery_layout == 'grid'){

		echo '<div class="single-post-gallery single-post-thumbnail single-portfolio-thumbnail">';
		if (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false) ) {
				echo the_post_thumbnail('');
		}
		echo do_shortcode($portfolio_gallery);
		echo '</div>';
	} elseif($gallery_layout == 'carousel') { 

		preg_match('/\[gallery.*ids=.(.*).\]/', $portfolio_gallery, $ids);
		$array_id = explode(",", $ids[1]);
		$gallery_ids = $array_id;
		if(!empty($gallery_ids)) :
		?>
			<div class="single-post-gallery single-post-thumbnail single-portfolio-thumbnail">
				<div id="carousel-example-generic<?php get_the_ID()?>" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()&&wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
						<div class="item active">
							<?php the_post_thumbnail(''); ?>
						</div>
						<?php } ?>
					    <?php $i = 0; ?>
					    <?php foreach ($gallery_ids as $image_id): ?>
							<?php
							$cls=''; if($i==0) $cls .='active';
					        $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
					        if($attachment_image[0] != ''):?>
								<div class="item <?php if (!has_post_thumbnail()) echo $cls;?>">
					        		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]); ?>" alt="" />
					        	</div>
					        <?php $i++; endif; ?>
					    <?php endforeach; ?>
					</div>
				    <a class="carousel-control left" href="#carousel-example-generic<?php get_the_ID();?>" role="button" data-slide="prev">
					    <span class="pe-7s-angle-left"></span>
					</a>
					<a class="carousel-control right" href="#carousel-example-generic<?php get_the_ID();?>" role="button" data-slide="next">
					    <span class="pe-7s-angle-right"></span>
					</a>
				</div>
			</div>
		<?php endif; 
	}
} elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()&&wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
		<div class="single-post-thumbnail single-portfolio-thumbnail">
			<?php the_post_thumbnail(''); ?>
		</div>
	<?php } else { ?>
		<div class="single-post-thumneil single-portfolio-thumbnail">
			<img alt="<?php the_title();?>" title="<?php echo the_title();?>" src="<?php echo get_template_directory_uri();?>/assets/images/no-image.jpg" />
		</div>
	<?php } 
?>
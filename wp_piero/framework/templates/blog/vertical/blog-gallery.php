<?php
/**
 * @package cshero
 */
	global $smof_data,$post; 
	$gallery_ids = cshero_grab_ids_from_gallery()->ids;
	if ( $gallery_ids || has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) { 
		$class1 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6 nopaddingall';
		$class2 = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
	} else {
		$class1 ='col-xs-12 col-sm-12 col-md-12 col-lg-12 nopaddingall';
		$class2 ='col-xs-12 col-sm-12 col-md-12 col-lg-12';
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog row">
		<div class="<?php echo $class1;?>">
			<div class="cs-blog-media">
				<?php
				if(!empty($gallery_ids)):?>
					<div id="carousel-example-generic<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
	   	                <div class="carousel-inner">
	   	                <?php $i = 0; ?>
	   	                <?php foreach ($gallery_ids as $image_id): ?>
	    					<?php
	   	                    $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
	   	                    if($attachment_image[0] != ''):?>
								<div class="item <?php if($i==0){ echo 'active'; } ?>">
	   	                    		<img style="width:100%;" data-src="holder.js" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
	   	                    	</div>
	   	                    <?php $i++; endif; ?>
	   	                <?php endforeach; ?>
	   	                </div>
	                    <a class="left carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="prev">
						    <span class="pe-7s-angle-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic<?php the_ID(); ?>" role="button" data-slide="next">
						    <span class="pe-7s-angle-right"></span>
						</a>
					</div>
				<?php elseif (has_post_thumbnail() && ! post_password_required() && ! is_attachment()): ?>
	    			<div class="cs-blog-thumbnail">
	    				<?php
							$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
			                $image_resize = mr_image_resize( $attachment_image[0], 570, 380, true, 'c', false );
			                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
						?>
	    				<?php echo cshero_info_category_render('categories'); ?>
	    			</div><!-- .entry-thumbnail -->
				<?php endif; ?>
			</div>
		</div><!-- .entry-header -->
		<div class="cs-blog-content <?php echo $class2;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render();?>
			</div>
			<?php cshero_content_render(); ?>
			
			<?php echo cshero_info_footer_render(); ?>
			
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->


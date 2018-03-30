<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<?php
        $date = time() . '_' . uniqid(true);
        $gallery_ids = cshero_grab_ids_from_gallery()->ids;
        if(!empty($gallery_ids)):
        ?>
            <div id="carousel-generic<?php echo esc_attr($date); ?>" class="carousel slide single-post-thumbnail single-post-gallery" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $i = 0; ?>
   	                <?php foreach ($gallery_ids as $image_id): ?>
                        <?php
                            $attachment_image = wp_get_attachment_image_src($image_id, 'full', false);
                            if($attachment_image[0] != ''):
                        ?>
                            <div class="item single-post-thumbnail <?php echo $i==0?'active':''; ?>">
                                <img style="width:100%;" src="<?php echo esc_url($attachment_image[0]);?>" alt="" />
                            </div>
                        <?php $i++; endif; ?>
                    <?php endforeach; ?>
                </div>
                <a class="left carousel-control" href="#carousel-generic<?php echo esc_attr($date); ?>" role="button" data-slide="prev">
                    <span class="pe-7s-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-generic<?php echo esc_attr($date); ?>" role="button" data-slide="next">
                    <span class="pe-7s-angle-right"></span>
                </a>
            </div>
    <?php elseif ($smof_data['post_featured_images'] == '1' ) : ?>
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="single-post-thumbnail">
					<?php the_post_thumbnail('full'); ?>
				</div><!-- .entry-thumbnail -->
			<?php endif; ?>
	<?php endif; ?>
	
	<header class="single-post-header">
		<?php echo cshero_post_details_info_render();?>
		<?php if($smof_data['show_post_title'] == '1'): ?>
			<div class="single-post-title"><<?php echo esc_attr($smof_data['detail_title_heading']);?> class="cs-entry-title"><?php the_title(); ?></<?php echo esc_attr($smof_data['detail_title_heading']);?>></div>
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="single-post-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
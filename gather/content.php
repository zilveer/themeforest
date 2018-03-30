<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 
global $cththemes_options;
?>
<div <?php post_class('content-content post-entry');?>>
    <div class="row">
        
        <?php
		$gallery = get_post_gallery( get_the_ID(), false );
			
		if(isset($gallery['ids'])) { ?>
		<div class="col-md-4 col-sm-4">
			<div class="flexslider blogslider">
                <ul class="slides">
	                <?php
						$gallery_ids = $gallery['ids'];
						$img_ids = explode(",",$gallery_ids);
						$i=1;
						foreach( $img_ids AS $img_id ){
						
					?>
					<li>
						<?php echo wp_get_attachment_image( $img_id, 'gatherblog-thumb', false, array('class'=>'res-image') ); ?>
					</li>
					<?php $i++; } ?>
	            </ul>
	        </div>
	    </div>
		<div class="col-md-8 col-sm-8">
		<?php }elseif(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""){ ?>	
		<div class="col-md-4 col-sm-4">
			<div class="responsive-video">
				<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cmb_embed_video', true) )); ?>
			</div>
		</div>
		<div class="col-md-8 col-sm-8">
		<?php }elseif(has_post_thumbnail( )){ ?>
		<div class="col-md-4 col-sm-4">
	        <?php the_post_thumbnail('gatherblog-thumb',array('class'=>'img-responsive center-block') ); ?>
		</div>
		<div class="col-md-8 col-sm-8">
		<?php }else{ ?>
		<div class="col-md-12 col-sm-12">
		<?php } ?>
        
            <h5 class="post-heading"><?php the_title( );?> <?php edit_post_link( __( 'Edit', 'gather' ), '<span class="edit-link">', '</span>' ); ?> </h5>
            <?php if($cththemes_options['blog_date'] || $cththemes_options['blog_author'] || $cththemes_options['blog_cats'] || $cththemes_options['blog_comments']):?>
			<p class="post-meta">
		        <?php if($cththemes_options['blog_date']) :?>
				<?php _e('on ','gather');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_time(__('M d Y','gather'));?></a>
				<?php endif;?>
				<?php if($cththemes_options['blog_author']) :?>
				<?php _e('by ','gather');?> <?php the_author_posts_link( );?>
				<?php endif;?> 
				<?php if($cththemes_options['blog_comments']) :?>
				<?php _e('comment ','gather');?><?php comments_popup_link(__('0', 'gather'), __('1', 'gather'), __('%', 'gather')); ?>
				<?php endif;?>
		        <?php if($cththemes_options['blog_cats']) :?>
					<?php if(get_the_category( )) { ?>
						<?php _e('category ','gather');?>
						<?php the_category(', ' );?>					
					<?php } ?>	
				<?php endif;?>  
		    </p>	
			<?php endif;?>

           	<?php the_excerpt();?>
            <?php
				wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gather' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				) );
			?>
			<?php if($cththemes_options['blog_tags']) :?>
				<?php if(get_the_tags( )) { ?>
				<div class="tag-cloud top-space">
					<?php the_tags('','','');?>	
                </div>
				<?php } ?>
			<?php endif;?>
			<div class="clearfix"></div>
            <a class="btn btn-outline" href="<?php the_permalink();?>" role="button"><?php _e('Read Article →','gather');?></a>

        </div>
    </div>
</div>

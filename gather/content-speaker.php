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
<div <?php post_class('content-speaker post-entry');?>>
    <div class="row">
        
		<?php if(has_post_thumbnail( )){ ?>
		<div class="col-md-4 col-sm-4">
	        <?php the_post_thumbnail('gatherblog-thumb',array('class'=>'img-responsive center-block') ); ?>
		</div>
		<div class="col-md-8 col-sm-8">
		<?php }else{ ?>
		<div class="col-md-12 col-sm-12">
		<?php } ?>
        
            <h5 class="post-heading"><?php the_title( );?> <?php edit_post_link( __( 'Edit', 'gather' ), '<span class="edit-link">', '</span>' ); ?> </h5>
            <?php if($cththemes_options['blog_date'] || $cththemes_options['blog_author']  ):?>
			<p class="post-meta">
		        <?php if($cththemes_options['blog_date']) :?>
				<?php _e('on ','gather');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_time(__('M d Y','gather'));?></a>
				<?php endif;?>
				<?php if($cththemes_options['blog_author']) :?>
				<?php _e('by ','gather');?> <?php the_author_posts_link( );?>
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
			<div class="clearfix" style="margin-bottom: 10px;"></div>
            <a class="btn btn-outline" href="<?php the_permalink();?>" role="button"><?php _e('Bio Details →','gather');?></a>

        </div>
    </div>
</div>

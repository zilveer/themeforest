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
if(get_post_meta(get_the_ID(), '_cmb_single_layout', true)){
	$sideBar = get_post_meta(get_the_ID(), '_cmb_single_layout', true);
}else{
	$sideBar = $cththemes_options['blog_layout'];
}
$single_header_subtitle = get_post_meta(get_the_ID(), '_cmb_single_header_subtitle', true);
get_header(); 

?>
<!-- 
 Sub Header - for inner pages
 ====================================== -->

<header id="top" class="sub-header">
    <div class="container">
        <h3 class="page-title wow fadeInDown"><?php single_post_title( ) ;?><small><?php echo esc_attr($single_header_subtitle );?></small></h3>
        <?php gather_breadcrumbs();?>
    </div>
    <!-- end .container -->
</header>
<!-- end .sub-header -->

<div class="container">
    <div class="row">
    <?php if($sideBar==='left_sidebar'):?>
		<div class="col-md-3 left-sidebar">
			<div class="sidebar">
    			<?php get_sidebar(); ?>
    		</div>
		</div>
	<?php endif;?>
	<?php if($sideBar==='fullwidth'):?>
		<div class="col-md-12">
	<?php else:?>
		<div class="col-md-9">
	<?php endif;?>
		
		<?php while(have_posts()) : the_post(); ?>
			
			<article <?php post_class('cth-single blog-content' );?>>
            	<!-- <h4 class="article-title"><?php the_title( );?></h4> -->
				

				<?php
				$gallery = get_post_gallery( get_the_ID(), false );

				if($gallery){
					
					if(isset($gallery['ids'])) : ?>
					<div class="blogsingleslider">
		                <ul class="slides">
			                <?php
								$gallery_ids = $gallery['ids'];
								$img_ids = explode(",",$gallery_ids);
								$i=1;
								foreach( $img_ids AS $img_id ){
								
							?>
							<li>
								<?php echo wp_get_attachment_image( $img_id, 'full', false, array('class'=>'res-image') ); ?>
							</li>
							<?php $i++; } ?>
			            </ul>
			        </div>

					<?php endif; ?>
				<?php }elseif(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""){ ?>
				<div class="entry-image">
					<div class="responsive-video">
						<?php echo wp_oembed_get(esc_url( get_post_meta(get_the_ID(), '_cmb_embed_video', true) )); ?>
					</div>
				</div>
				<?php }elseif(has_post_thumbnail( )){ ?>
				<div class="entry-image">
			        <?php the_post_thumbnail('full',array('class'=>'res-image') ); ?>
			    </div>
				<?php } ?>

				<?php if($cththemes_options['blog_date'] || $cththemes_options['blog_author'] || $cththemes_options['blog_cats'] || $cththemes_options['blog_comments']):?>
				<p class="post-meta">
			        <?php if($cththemes_options['blog_date']) :?>
					<?php _e('on ','gather');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_time(__('M d Y','gather'));?></a>
					<?php endif;?>
					<?php if($cththemes_options['blog_author']) :?>
					<?php _e('by ','gather');?> <?php the_author_posts_link( );?>
					<?php endif;?> 
					<?php if($cththemes_options['blog_comments']) :?>
					<?php _e('com ','gather');?><?php comments_popup_link(__('0', 'gather'), __('1', 'gather'), __('%', 'gather')); ?>
					<?php endif;?>
			        <?php if($cththemes_options['blog_cats']) :?>
						<?php if(get_the_category( )) { ?>
							<?php _e('cat ','gather');?>
							<?php the_category(', ' );?>					
						<?php } ?>	
					<?php endif;?>
			    </p>	
				<?php endif;?>
				
				<div class="entry-content">
					<?php the_content();?>
				</div>
                <?php
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gather' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				?>
				<?php 
				if($cththemes_options['blog_tags']) :?>
					<?php if(get_the_tags( )) { ?>
					<div class="tag-cloud top-space">
						<?php the_tags('','','');?>	
                    </div>
					<?php } ?>
				<?php endif;?>
				<?php gather_post_nav();?>


            </article>

            <?php
			if ( comments_open() || get_comments_number() ) :
				
			 	comments_template(); 
			 	
			endif; ?>

		<?php endwhile;?>

		</div>
	<?php if($sideBar ==='right_sidebar'):?>
		<div class="col-md-3 right-sidebar">
	        <div class="sidebar">
	            <?php 
					get_sidebar(); 
				?>
	        </div>
	    </div>
	<?php endif;?>
	</div>
</div>

<?php 
get_footer(); 
?>
<?php
/**
 * @package cshero
 */
	global $smof_data,$post; 
	if ( get_post_format() == 'link' || has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) { 
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
    			<div class="cs-blog-thumbnail">
    				<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment()) { ?>
    					<?php the_post_thumbnail(); ?>
    				<?php } else { 
    					$no_image = CSCORE_PLUGIN_URL.'assets/images/no-image.jpg';
    					echo '<img alt="'.$the_title.'" title="'.$the_title.'" src="'.$no_image.'" />';
    				} ?>
    				<?php echo cshero_info_category_render('categories'); ?>
    				<?php echo cshero_post_link_render('link'); ?>
    			</div><!-- .entry-thumbnail -->
			</div>
		</div><!-- .entry-header -->
		<div class="cs-blog-content <?php echo $class2;?>">
			<div class="cs-blog-meta cs-itemBlog-meta">
				<?php echo cshero_title_render(); ?>
				<?php echo cshero_info_bar_render(); ?>
			</div>
			<?php cshero_content_render(); ?>
			
			<?php echo cshero_info_footer_render(); ?>
			
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->


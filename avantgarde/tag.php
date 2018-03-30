<?php get_header(); ?>
<div class="fitvids container"><!-- Container Start -->
<?php $default_sidebar = $theme_prefix['blog_sidebar']; ?>
	<div class="title pos-center margint60 cat-title"><h6><?php printf( __( 'Tag: %s', '2035Themes-fm' ), single_cat_title( '', false ) ); ?></h6></div>
	<div class="row clearfix"><!-- Row Start -->

		<?php if($theme_prefix['sidebar-type'] == "left" ){ ?> 
		    <aside class="col-lg-3 col-sm-4 sidebar">
		        <?php if ( is_active_sidebar( $default_sidebar ) ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($default_sidebar)) :  ?>
                        <a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a>
                    <?php endif; ?>
                <?php } ?>
		    </aside>
		<?php } ?>

	    <?php if($theme_prefix['sidebar-type'] == "none" ){ ?> 
	    <div class="col-lg-12 col-sm-12" ><?php } else { ?> <div class="col-lg-9 col-sm-8" > <?php } ?> <!-- If Sidebar is not defined, then Post will be Full Screen -->
	    	<?php if (have_posts()) : while(have_posts()) :  the_post(); ?>
	    	<?php get_template_part('inc/content'); ?>
	    	<?php endwhile; else : ?>
	    	<div class="margint30"><h4><?php echo __('Not Post Found!','2035Themes-fm') ?></h4></div>
	    	<?php endif; ?>
	    	<?php Theme2035_pagination(); ?>
	    </div>

		<?php if($theme_prefix['sidebar-type'] == "right" ){ ?> 
		    <aside class="col-lg-3 col-sm-4 sidebar">
		        <?php if ( is_active_sidebar( $default_sidebar ) ) { ?>
                    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar($default_sidebar)) :  ?>
                        <a href="wp-admin/widgets.php"><?php echo __("Please Add Widget <a href='wp-admin/widgets.php'>here</a>","2035Themes-fm") ?></a>
                    <?php endif; ?>
                <?php } ?>
		    </aside>
		<?php } ?>

	</div><!-- Row Finish -->
</div> <!-- Container Finish -->
<?php get_footer(); ?>
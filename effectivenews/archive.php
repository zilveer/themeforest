<?php get_header(); ?>
<?php
        $layout = mom_option('cat_layout');
	$share = mom_option('cat_share');
	if (is_category()) {
		$cat_data = get_option("category_".get_query_var('cat'));
		$layout = isset($cat_data['layout']) ? $cat_data['layout'] :'';
		$enable_slider = isset($cat_data['slider']) ? $cat_data['slider'] :'';
		if ($layout == '') {
		    $layout = mom_option('cat_layout');
		}
	
		if ($enable_slider == '') {
		    $enable_slider = mom_option('cat_slider');
		}
	}
	$post_count = 1;
	$grid_class = '';
	$ad_id = mom_option('cat_ad_id');
	$ad_count = mom_option('cat_ad_count');
	$ad_repeat = mom_option('cat_ad_repeat');
?>
            <div class="inner">
            <div class="main_container">
            <div class="main-col">
                <div class="category-title">
                    <?php mom_breadcrumb(); ?>
                    <?php if (is_category() && mom_option('cat_rss') == 1) { ?>
                    <a class="bc-rss" target="_blank" href="<?php echo esc_url(home_url()); ?>?cat=<?php echo get_query_var('cat'); ?>&feed=rss2"><i class="fa-icon-rss"></i></a>
                    <?php } ?>
                    <?php if (is_tag() && mom_option('cat_rss') == 1) { ?>
                    <a class="bc-rss" target="_blank" href="<?php echo esc_url(home_url()); ?>?tag=<?php echo get_query_var('tag'); ?>&feed=rss2"><i class="fa-icon-rss"></i></a>
                    <?php } ?>
                </div>
                <?php if(is_category() && category_description() != '') { ?>
                <div class="category-description base-box">
                    <?php echo do_shortcode(category_description()); ?>
                </div>
                <?php } ?>
		<?php if (is_author()) {
			$bg = get_the_author_meta('ab_bg');
			if ($bg == '') {
				$bg = mom_option('author_bg', 'url');
			}
			if ($bg != '') {
				$bg = 'style="background-image:url('.$bg.'); background-size: cover;"';
			}
			$layout = get_the_author_meta('ap_l');
			if ($layout == '') {
				$layout = mom_option('author_layout');
			}
		
		?>
			<div class="base-box">
				<div class="single-author-box" <?php echo $bg; ?>>
					<?php mom_author_box('min'); ?>
				</div>
			</div>
		<?php } ?>
                
                <?php
			if (is_category()) {
				if ($enable_slider == true) {
				    $slider_orderby = mom_option('cat_slider_orderby');
				    $slider_count = mom_option('cat_slider_count');
				    $slider_timeout = mom_option('cat_slider_timeout');
				    $slider_animation = mom_option('cat_slider_animation');
				    $slider_speed = mom_option('cat_slider_ani_speed');
				    $slider_caption_style = mom_option('cat_slider_caption_style');
				    $slider_nav_style = mom_option('cat_slider_nav_style');
				    
				    if ($slider_orderby == 'popular') {
					$slider_orderby = 'orderby="comment_count"';
				    } elseif ($slider_orderby == 'random') {
					$slider_orderby = 'orderby="rand"';
				    } else {
					$slider_orderby = '';
				    }
				  
				    echo do_shortcode('[feature_slider display="category" category="'.get_query_var('cat').'" count="'.$slider_count.'" '.$slider_orderby.' caption_style="'.$slider_caption_style.'" animation="'.$slider_animation.'" speed="'.$slider_speed.'" timeout="'.$slider_timeout.'" nav="'.$slider_nav_style.'"]');
				}
			}
                ?>
                
            <?php if ($layout == 't') { ?>
                <div class="base-box page-wrap">
		<?php
		if ( is_archive() ) {
		if ( is_category() || is_tag() || is_tax() ) {
			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );
		?>
                <h1 class="page-title"><?php echo $term->name; ?></h1>
		<?php } else if (function_exists( 'is_post_type_archive' ) && is_post_type_archive()) {
		$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
		?>
                <h1 class="page-title"><?php echo $post_type_object->labels->name; ?></h1>
		<?php } else if ( is_date() ) {
			if ( is_day() )
				echo '<h1 class="page-title">'.__( 'Archives for ', 'theme' ) . get_the_time( 'F j, Y' ).'</h1>';
			elseif ( is_month() )
				echo '<h1 class="page-title">'.__( 'Archives for ', 'theme' ) . single_month_title( ' ', false ).'</h1>';
			elseif ( is_year() )
				echo '<h1 class="page-title">'.__( 'Archives for ', 'theme' ) . get_the_time( 'Y' ).'</h1>';
		} ?>
		
		<?php } // end of archives ?>

                <div class="entry-content">
                <?php echo mom_posts_timeline(); ?>
                </div> <!-- entry content -->
                </div> <!-- base box -->
            <?php } else if ($layout == 'g') { ?>
            <div class="posts-grid clearfix">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
                        <?php
				if ($post_count%2 == 0) {
						$grid_class = 'second';
				} else {
						$grid_class = '';
				}
				mom_blog_post($layout, $share, '', $grid_class);
				if ($ad_id != '') {
						if ($ad_repeat == 1) { 
								if ($post_count%$ad_count == 0) {
									echo do_shortcode('[ad id="'.$ad_id.'"]');
								}
						} else {
								if ($post_count == $ad_count) {
									echo do_shortcode('[ad id="'.$ad_id.'"]');
								}
						}
				}
				$post_count ++;
			?>
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
            </div>
            <?php } else { ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php mom_blog_post($layout, $share); ?>
                <?php endwhile; ?>
                <?php  else:  ?>
                <!-- Else in here -->
                <?php  endif; ?>
            <?php }// end if layout ?>
	    <?php if ($layout != 't') { mom_pagination(); } ?>
            <?php wp_reset_query(); ?>
            </div> <!--main column-->
            <?php get_sidebar('secondary'); ?>
            <div class="clear"></div>
</div> <!--main container-->            
<?php get_sidebar(); ?>
            </div>
<?php get_footer(); ?>

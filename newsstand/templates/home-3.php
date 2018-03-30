<?php
	/*
		Template Name: Home 3
	*/

get_header(); ?>

<?php
	$gns_show = get_post_meta( get_the_ID(), 'newsstand_block_gns_show', 1, true );
	$gns_cat = get_post_meta( get_the_ID(), 'newsstand_block_gns_category', 1, true );
	$gns_style = get_post_meta( get_the_ID(), 'newsstand_block_gns_style', 1, true );

	$args = "";

	if ($gns_show=='latest') {
	    $args = array('post_type' => 'post', 'posts_per_page' => 8, 'post__not_in' => get_option( 'sticky_posts' ));
	} elseif($gns_show=='mostpopular') {
	    function filter_where_4($where = '') {
	        // show posts form last 3 days
	        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	        return $where;
	    }
	    add_filter('posts_where', 'filter_where_4');
	    $args = array('post_type' => 'post', 'posts_per_page' => 8, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
	} elseif($gns_show=='category') {
	    $cat_id = $gns_cat[0];

	    $args = array('post_type'=>'post', 'posts_per_page'=>8, 'cat'=>$cat_id);
	}

	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<?php if ($gns_style=='fullwidth'): ?>
		<section class="great-news-slider full-width">
	<?php elseif($gns_style=='incontainer'): ?>
		<section class="great-news-slider full-width">
			<div class="container">
	<?php else: ?>
		<section class="great-news-slider">
	<?php endif ?>

	    <!-- .full-width for full width /// .full-width and .container wrapper for .great-new-slider-container for in container -->

	    <div class="great-news-slider-container">
	        <div class="gns-slider">
	            <div class="gns-slider-actual">

	            	<?php $total_posts = 0; ?>

	            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	            		<?php $total_posts++; ?>
	            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

		                <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                    <a href="<?php the_permalink(); ?>" class="plus-hover">
		                        <span class="plus"></span>

		                        <span class="valign">
		                            <span class="post-info">
		                                <span><?php the_time($newsstand_dateformat); ?></span>
		                                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                            </span>
		                            <span class="post-title"><?php the_title(); ?></span>
		                        </span>
		                    </a>
		                </div><!-- end of single -->

	                <?php endwhile; ?>
	            </div>
	        </div>
	        <div class="gns-choose">
	            <div class="gns-choose-slider">

	            	<?php $x=1; $y=1; while($wp_query->have_posts()): $wp_query->the_post(); ?>

	            		<?php if ($x==1): ?>
	            			<div class="single">
	            		<?php endif ?>

		            		<a href="javascript:void(null);">
		            		    <span class="post-info">
		            		        <span><?php the_time($newsstand_dateformat); ?></span>
		            		        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		            		    </span>
		            		    <span class="post-title">
		            		        <?php the_title(); ?>
		            		    </span>
		            		</a><!-- end of a -->

	            		<?php if ($x==4 || $y==$total_posts): ?>
	            			</div><!-- end of single -->

	            			<?php $x=0; ?>
	            		<?php endif ?>

	            	<?php $x++; $y++; endwhile; ?>

	            </div>
	            <div class="arrows"></div>
	        </div>
	    </div>

	    <?php if ($gns_style=='incontainer'): ?>
	    	</div><!--end of container-->
	    <?php endif ?>

	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	function filter_where($where = '') {
		// show posts form last 3 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	    return $where;
	}
	add_filter('posts_where', 'filter_where');

	$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC');
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>

	<section class="hot-ticker pt">
	    <div class="container">
	        <div class="ht-wrapper">
	            <div class="ht-title"><i class="fa fa-fire"></i> <?php echo _e('What\'s hot', 'newsstand'); ?></div>
	            <div class="ht-container">
	            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	            		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	            	<?php endwhile; ?>
	            </div>
	        </div>
	    </div>
	</section>

<?php endif ?>

<?php remove_filter('posts_where', 'filter_where'); ?>

<?php wp_reset_query(); ?>

<?php

	$cat_args=array( 'post_type' => 'post', 'orderby' => 'name', 'order' => 'ASC');
	$categories=get_categories($cat_args);
?>

<?php if (!empty($categories)): ?>

	<section class="featured-news">
	    <div class="container">
	        <div class="section-title">
	            <span><?php echo _e('FEATURED', 'newsstand'); ?></span>
	            <h3><?php echo _e('This Week', 'newsstand'); ?></h3>
	        </div>
	        <div class="section-content">
	            <div class="fn-blocks">
	                <div class="row">

	                    <?php foreach ($categories as $category): ?>
	                    	<?php
	                    		$cat_color = Taxonomy_MetaData::get( 'category', $category->cat_ID, 'newsstand_cat_color');
	                    		$cat_name = $category->cat_name;
	                    		$cat_link = get_category_link( $category->cat_ID);

	                    		$args = array('post_type' => 'post', 'posts_per_page'=>3, 'cat'=>$category->cat_ID, 'tag'=>'featured');
	                    		$wp_query = new WP_Query( $args );
	                    	?>

	                    	<?php if ($wp_query->have_posts()): ?>

		                    	<div class="col-sm-6 col-md-4">
		                    	    <div class="single">

		                    	    	<?php $y=0; while($wp_query->have_posts()): $wp_query->the_post(); ?><?php $y++; ?><?php endwhile; ?>

		                    	    	<?php $x=1; while($wp_query->have_posts()): $wp_query->the_post(); ?>

		                    	    		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

											<?php if ($x==1): ?>
												<div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span><span class="overlay" style="background-color: <?php echo esc_attr($cat_color); ?>;"></span></a></div>
												<div class="info">
												    <div class="post-info">
												        <span><?php the_time($newsstand_dateformat) ?></span>
												        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
												    </div>
												    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
												    <p><?php echo newsstand_excerpt(140); ?></p>
												</div>
											<?php endif ?>

											<?php if ($x==2): ?>
												<div class="more">
											<?php endif ?>
												<?php if ($x==2 || $x==3): ?>
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												<?php endif ?>
											<?php if ($x==3 || $x==$y && $x>1): ?>
												</div>
											<?php endif ?>

		                    	    	<?php $x++; endwhile; ?>

		                    	        <a href="<?php echo esc_url($cat_link); ?>" class="read-all"><?php _e('Read All from', 'newsstand'); ?> <?php echo esc_html($cat_name); ?></a>

		                    	    </div><!-- end of single -->
		                    	</div><!-- end of col -->

	                    	<?php endif ?>

	                    <?php endforeach ?>

	                </div>
	            </div><!-- end of fn-blocks -->
	        </div>
	    </div>
	</section>

<?php endif ?>

<?php remove_filter('posts_where', 'filter_where_2'); ?>

<?php wp_reset_query(); ?>

	<?php
		$show_b8 = get_post_meta( get_the_ID(), 'newsstand_show_b8', true, 1 );
		$b8_what = get_post_meta( get_the_ID(), 'newsstand_block_8_show', true, 1 );
		$b8_category = get_post_meta( get_the_ID(), 'newsstand_block_8_category', true, 1 );
		$b8_morelink = get_post_meta( get_the_ID(), 'newsstand_block_8_morelink', true, 1 );

		if ($b8_what=='latest') {
		    $args = array('post_type' => 'post', 'posts_per_page' => 2, 'post__not_in' => get_option( 'sticky_posts' ));
		} elseif($b8_what=='mostpopular') {
		    function filter_where_4($where = '') {
		        // show posts form last 3 days
		        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
		        return $where;
		    }
		    add_filter('posts_where', 'filter_where_4');
		    $args = array('post_type' => 'post', 'posts_per_page' => 2, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
		} elseif($b8_what=='category') {
		    $cat_id = $b8_category[0];

		    $args = array('post_type'=>'post', 'posts_per_page'=>2, 'cat'=>$cat_id);
		}

		$wp_query = new WP_Query( $args );
	?>

<?php if ($show_b8=='on'): ?>

	<?php if ($wp_query->have_posts()): ?>

		<section class="more-featured-news">
		    <div class="container">
		    	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		    	<?php
		    		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		    		$cat_color = newsstand_cat_color($post->ID);
		    	?>

		        <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		            <a href="<?php the_permalink(); ?>">
		                <span class="overlay" style="background-color: <?php echo esc_attr($cat_color); ?>;"></span>
		                <span class="valign">
		                    <span class="post-info">
		                        <span><?php the_time($newsstand_dateformat); ?></span>
		                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                    </span>
		                    <span class="post-title"><?php the_title(); ?></span>
		                </span>
		            </a>
		        </div><!-- end of single -->

		    	<?php endwhile; ?>

		    	<?php if ($b8_what=='latest'): ?>
		    		<a href="<?php echo esc_url($b8_morelink); ?>" class="view-more"><span class="valign">More News</span></a>
		    	<?php elseif($b8_what=='mostpopular'): ?>
		    		<a href="<?php echo esc_url($b8_morelink); ?>" class="view-more"><span class="valign">More News</span></a>
		    	<?php else: ?>
		    		<a href="<?php echo get_category_link( $b8_category[0] ); ?>" class="view-more"><span class="valign">More from <?php echo get_cat_name($b8_category[0]); ?></span></a>
		    	<?php endif ?>
		    </div>
		</section>

	<?php endif ?>

<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$show_b9 = get_post_meta( get_the_ID(), 'newsstand_show_b9', true, 1 );
	$b9_what = get_post_meta( get_the_ID(), 'newsstand_block_9_show', true, 1 );
	$b9_category = get_post_meta( get_the_ID(), 'newsstand_block_9_category', true, 1 );

	if ($b9_what=='latest') {
	    $args = array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ));
	} elseif($b9_what=='videos') {
	    $args = array('post_type' => 'video', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ));
	} elseif($b9_what=='category') {
	    $cat_id = $b9_category[0];

	    $args = array('post_type'=>'post', 'posts_per_page'=>4, 'cat'=>$cat_id);
	}

	$wp_query = new WP_Query( $args );
?>

<?php if ($show_b9=="on"): ?>
	<?php if ($wp_query->have_posts()): ?>

		<section class="latest-videos-slider">
		    <div class="container">
		        <div class="actual-container">
		            <div class="lvs-choose">

		            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		            	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

		                <div class="single">
		                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
		                    <div class="info">
		                        <span class="post-info">
		                            <span><?php the_time($newsstand_dateformat); ?></span>
		                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                        </span>
		                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
		                    </div>
		                </div><!-- end of single -->

		                <?php endwhile; ?>

		            </div><!-- end of lvs-choose -->

		            <div class="lvs-slider">
		            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		            	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

		                <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                    <a href="<?php the_permalink(); ?>">
		                        <span class="valign">
		                            <span class="post-info">
		                                <span><?php the_time($newsstand_dateformat); ?></span>
		                                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                            </span>
		                            <span class="post-title"><?php the_title(); ?></span>
		                        </span>
		                    </a>
		                </div><!-- end of single -->

		            	<?php endwhile; ?>
		            </div><!-- end of lvs-slider -->
		        </div>
		    </div>
		</section>

	<?php endif ?>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$show_b10 = get_post_meta( get_the_ID(), 'newsstand_show_b10', true, 1 );
	$b10_what = get_post_meta( get_the_ID(), 'newsstand_block_10_show', true, 1 );
	$b10_category = get_post_meta( get_the_ID(), 'newsstand_block_10_category', true, 1 );

	if ($b10_what=='latest') {
	    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
	} elseif($b10_what=='mostpopular') {
	    function filter_where_4($where = '') {
	        // show posts form last 3 days
	        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	        return $where;
	    }
	    add_filter('posts_where', 'filter_where_4');
	    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
	} elseif($b10_what=='category') {
	    $cat_id = $b10_category[0];

	    $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
	}

	$wp_query = new WP_Query( $args );
?>

<?php if ($show_b10=='on'): ?>

	<?php if ($wp_query->have_posts()): ?>

		<section class="whatspopular">
		    <div class="container">
		    	<?php if ($b10_what=='latest'): ?>
		    		<div class="section-title">
		    		    <span><?php _e('Latest', 'newsstand'); ?></span>
		    		    <h3><?php _e('Posts', 'newsstand'); ?></h3>
		    		</div>
		    	<?php elseif($b10_what=='mostpopular'): ?>
		    		<div class="section-title">
		    		    <span><?php _e("What's", 'newsstand'); ?></span>
		    		    <h3><?php _e('Popular', 'newsstand'); ?></h3>
		    		</div>
		    	<?php elseif($b10_what=='category'): ?>
		    		<div class="section-title">
		    		    <span><?php _e('Posts in', 'newsstand'); ?></span>
		    		    <h3><?php echo get_cat_name($b10_category[0]); ?></h3>
		    		</div>
		    	<?php endif ?>
		        <div class="section-content">
		            <div class="wp-blocks">

		            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

							<div class="single">
							    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
							    <div class="info">
							        <div class="post-info">
							            <span><?php the_time($newsstand_dateformat); ?></span>
							            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
							        </div>
							        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
							        <p><?php echo newsstand_excerpt(240); ?></p>
							    </div>
							</div><!-- end of single -->

		            	<?php endwhile; ?>

		            </div>
		        </div>
		    </div>
		</section>

	<?php endif ?>

<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$show_blv = get_post_meta( get_the_ID(), 'newsstand_show_blv', true, 1 );
	$args = array( 'post_type' => 'video', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ));
	$wp_query = new WP_Query( $args );
?>

<?php if ($show_blv=='on'): ?>

	<?php if ($wp_query->have_posts()): ?>

		<section class="latest-videos-block">
		    <div class="container">
		        <div class="section-title">
		            <span><?php _e('Latest', 'newsstand'); ?></span>
		            <h3><?php _e('Videos', 'newsstand'); ?></h3>
		        </div>
		        <div class="section-content">
		            <div class="lv-blocks lightGallery-videos-4">

		                <div class="row">

		                	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		                	<?php
		                		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		                		$video_src = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true );
		                	?>

		                    <div class="col-sm-6 col-md-3">
		                        <div class="single">
		                            <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                            	<a href="<?php the_permalink(); ?>" class="plus-hover" data-thumb-src="<?php echo esc_url($thumb_url); ?>" data-src="<?php echo esc_url($video_src); ?>"><span class="plus"></span></a>
		                            </div>
		                            <div class="info">
		                                <div class="post-info">
		                                    <span><?php the_time($newsstand_dateformat); ?></span>
		                                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                                </div>
		                                <a href="javascript:void(null);" class="post-title"><?php the_title(); ?></a>
		                            </div>
		                        </div><!-- end of single -->
		                    </div>

		                	<?php endwhile; ?>

		                </div>

		            </div>
		        </div>
		    </div>
		</section>

	<?php endif ?>

<?php endif ?>

<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>
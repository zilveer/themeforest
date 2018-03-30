<?php
	/* Template Name: Home 2 */
get_header(); ?>


<?php
	function filter_where_3($where = '') {
		// show posts form last 3 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	    return $where;
	}
	add_filter('posts_where', 'filter_where_3');

	$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC', 'post__not_in' => get_option( 'sticky_posts' ));
	$wp_query = new WP_Query( $args );
?>
<?php if ($wp_query->have_posts()): ?>
	<section class="most-popular">
	    <div class="container">
	        <div class="popular-title sameHeight">
	            <span><?php echo _e('Most <span>Popular</span>News', 'newsstand'); ?></span>
	        </div>
	        <div class="popular-slider">

	            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	            	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

					<div class="single">
					    <a href="<?php the_permalink(); ?>" class="image plus-hover" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><span class="plus"></span></a>
					    <div class="info">
					        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </div>
					</div><!-- end of single -->

	            <?php endwhile; ?>


	        </div>
	    </div>
	</section>
<?php endif ?>

<?php remove_filter('posts_where', 'filter_where_3'); ?>

<?php wp_reset_query(); ?>

<?php
	$args = array('post_type'=>'post', 'posts_per_page'=>-1, 'post__in' => get_option('sticky_posts'));
	$wp_query = new WP_Query( $args );
?>
<?php if ($wp_query->have_posts()): ?>

	<section class="sticky-slider-holder">
	    <div class="container">
	        <div class="sticky-slider">

	            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	            	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

					<div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
					    <div class="valign">
					        <span class="post-info">
					            <span><?php the_time($newsstand_dateformat); ?></span>
					            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
					        </span>
					        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
					        <p><?php echo newsstand_excerpt(250); ?></p>
					    </div>
					</div><!-- end of single -->

	            <?php endwhile; ?>

	        </div>
	    </div>
	</section>

<?php endif ?>

<?php wp_reset_query(); ?>

<section class="white-content">

    <div class="container">
        <div class="actual-container">

            <div class="row matchMe">
                <div class="col-md-8">

                	<?php
                		$args = array( 'post_type' => 'post', 'posts_per_page' => 7, 'post__not_in' => get_option( 'sticky_posts' ) );
                		$wp_query = new WP_Query( $args );
                	?>

                	<?php if ($wp_query->have_posts()): ?>
                		<section class="latest-news">

                			<?php $x = 1; while($wp_query->have_posts()): $wp_query->the_post(); ?>

                				<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	                		    <?php if ($x!=7): ?>
	                		    	<div class="single">
	                		    	    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>"><?php _e('Read More', 'newsstand'); ?></a></div>
	                		    	    <div class="info">
	                		    	        <span class="post-info">
	                		    	            <span><?php the_time($newsstand_dateformat); ?></span>
	                		    	        </span>
	                		    	        <a href="<?php the_permalink(); ?>" class="post-title"><?php echo newsstand_title(25); ?></a>
	                		    	    </div>
	                		    	</div><!-- end of single -->

	                		    <?php else: ?>

									<div class="single biggy">
									    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>"><?php _e('Read More', 'newsstand'); ?></a></div>
									    <div class="info">
									        <span class="post-info">
									            <span><?php the_time($newsstand_dateformat); ?></span>
									        </span>
									        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
									        <p><?php echo newsstand_excerpt(120); ?></p>
									    </div>
									</div>

	                		    <?php endif ?>

                			<?php $x++; endwhile; ?>


                		</section>
                	<?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                        $banner_1 = get_post_meta( get_the_ID(), 'newsstand_banner_1_image', 1, true );
                        $banner_1_link = get_post_meta( get_the_ID(), 'newsstand_banner_1_link', 1, true );
                    ?>

                    <?php if (!empty($banner_1) && !empty($banner_1_link)): ?>
                        <section class="banner-holder">
                            <a href="<?php echo esc_url($banner_1_link); ?>" target="_blank"><img src="<?php echo esc_url($banner_1); ?>" alt=""></a>
                        </section>
                    <?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                        $args = array( 'post_type' => 'post', 'posts_per_page' => 1, 'offset' => '7', 'post__not_in' => get_option( 'sticky_posts' ) );
                        $wp_query = new WP_Query( $args );
                    ?>

                    <?php if ($wp_query->have_posts()): ?>
                        <section class="latest-news">

                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                <div class="single biggy">
                                    <div class="image right" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>"><?php _e('Read More', 'newsstand'); ?></a></div>
                                    <div class="info">
                                        <span class="post-info">
                                            <span><?php the_time($newsstand_dateformat); ?></span>
                                        </span>
                                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                        <p><?php echo newsstand_excerpt(120); ?></p>
                                    </div>
                                </div><!-- end of single -->

                            <?php endwhile; ?>

                        </section>
                    <?php endif ?>

                    <?php wp_reset_query(); ?>

                </div>

                <div class="col-md-4">
                    <div class="box-sidebar">

                        <?php
                            $on_category = get_post_meta( get_the_ID(), 'newsstand_block_othernews_category', 1, true );
                            $cat_id = $on_category[0];


                            $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
                            $wp_query = new WP_Query( $args );
                        ?>

                        <?php if ($wp_query->have_posts()): ?>
                            <div class="box">
                                <h3 class="box-title"><?php _e('Other News', 'newsstand'); ?></h3>
                                <div class="box-content">
                                    <div class="latest-posts">

                                        <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                            <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                            <div class="single">
                                                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
                                                <div class="info">
                                                    <div class="post-info">
                                                        <span><?php the_time($newsstand_dateformat); ?></span>
                                                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
                                                    </div>
                                                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                                    <p><?php echo newsstand_excerpt(80); ?></p>
                                                </div>
                                            </div><!-- end of single -->

                                        <?php endwhile; ?>

                                    </div>
                                </div>
                            </div><!-- end of box -->
                        <?php endif ?>

                        <?php wp_reset_query(); ?>

                        <?php
                            $nl_subtitle = get_post_meta( get_the_ID(), 'newsstand_block_newsletter_subtitle', 1, true );
                            $nl_shortcode = get_post_meta( get_the_ID(), 'newsstand_block_newsletter_shortcode', 1, true );
                        ?>

                        <?php if (!empty($nl_shortcode)): ?>

                            <div class="box">
                                <div class="box-content">
                                    <div class="subscribe-box">
                                        <h3><?php _e('Newsletter', 'newsstand'); ?></h3>
                                        <?php if (!empty($nl_subtitle)): ?>
                                            <span><?php echo esc_html($nl_subtitle); ?></span>
                                        <?php endif ?>

                                        <?php echo do_shortcode($nl_shortcode); ?>
                                    </div>
                                </div>
                            </div><!-- end of box -->

                        <?php endif ?>

                        <?php wp_reset_query(); ?>

                        <?php
                            $sevents = get_post_meta( get_the_ID(), 'newsstand_show_b_events', 1, true );
                        ?>

                        <?php if ($sevents=='on'): ?>
                            <?php
                                $get_date = getdate();
                                $current_day = $get_date['mday'];
                                $current_month = $get_date['mon'];

                                $args = array( 'post_type' => 'event', 'posts_per_page' => 3 );
                                $wp_query = new WP_Query( $args );
                            ?>

                            <?php if ($wp_query->have_posts()): ?>
                                <div class="box">
                                    <h3 class="box-title"><?php _e('Upcoming Events', 'newsstand'); ?></h3>

                                    <div class="box-content">
                                        <div class="upcoming-events">

                                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
                                                <?php
                                                    $date = get_post_meta(get_the_ID(), 'newsstand_event_date', 1, true);
                                                    $date = explode('/', $date);

                                                    if (isset($date[1]) && !empty($date[1])) {
                                                        $date_day = $date[1];
                                                    } else {
                                                        $date_day = 0;
                                                    }

                                                    if (isset($date[0]) && !empty($date[0])) {
                                                        $date_month = date( 'F' , mktime(1, 1, 1, $date[0], 1) );
                                                        $date_month_number = $date[0];
                                                    } else { $date_month = 0; $date_month_number = 0; }


                                                    $short_desc = get_post_meta( get_the_ID(), 'newsstand_event_shortdesc',1,true );
                                                ?>


                                                <?php if ($date_month_number == $current_month): ?>
                                                    <div class="single">
                                                        <div class="date">
                                                            <span class="day"><?php echo esc_html($date_day); ?> <span><?php echo esc_html($date_month); ?></span></span>
                                                        </div>
                                                        <div class="info">
                                                            <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                                            <?php if (!empty($short_desc)): ?>
                                                                <span class="location"><?php echo esc_html($short_desc); ?></span>
                                                            <?php endif ?>
                                                        </div>
                                                    </div><!-- end of single -->
                                                <?php endif ?>
                                            <?php endwhile; ?>

                                        </div>
                                    </div>
                                </div><!-- end of box -->
                            <?php endif ?>

                        <?php endif ?>

                    </div>
                </div>
            </div>

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

                <section class="hot-ticker">
                    <div class="ht-wrapper">
                        <div class="ht-title"><i class="fa fa-fire"></i> <?php echo _e('What\'s hot', 'newsstand'); ?></div>
                        <div class="ht-container">
                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>

            <?php endif ?>

            <?php remove_filter('posts_where', 'filter_where'); ?>


            <?php wp_reset_query(); ?>

            <?php
                $wposts = get_post_meta( get_the_ID(), 'newsstand_block_wposts_show', 1, true );
                $wposts_cat = get_post_meta( get_the_ID(), 'newsstand_block_wposts_category', 1, true );

                if ($wposts=='latest') {
                    $wposts_title = "Latest News";
                    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
                } elseif($wposts=='mostpopular') {
                    $wposts_title = "Popular News";

                    function filter_where_4($where = '') {
                        // show posts form last 3 days
                        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
                        return $where;
                    }
                    add_filter('posts_where', 'filter_where_4');
                    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
                } elseif($wposts=='category') {
                    $wposts_cat = get_category($wposts_cat[0]);
                    $wposts_title = $wposts_cat->cat_name;

                    $cat_id = $wposts_cat->cat_ID;


                    $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
                    $wp_query = new WP_Query( $args );
                }

                $wp_query = new WP_Query( $args );
            ?>


            <section class="popular-news">
                <div class="section-title">
                    <?php if ($wposts!='category'): ?>
                        <h3><?php echo esc_html(_e($wposts_title, 'newsstand')); ?></h3>
                    <?php else: ?>
                        <h3><?php echo esc_html($wposts_title); ?></h3>
                    <?php endif ?>
                </div>

                <?php if ($wp_query->have_posts()): ?>

                    <div class="section-content">

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
                                <p><?php echo newsstand_excerpt(240); ?></p>
                            </div>
                        </div><!-- end of single -->

                        <?php endwhile; ?>

                    </div>

                <?php endif ?>

            </section>

            <?php remove_filter('posts_where', 'filter_where_4'); ?>

            <?php wp_reset_query(); ?>

            <?php
                $args = array('post_type' => 'video', 'posts_per_page' => 8 );
                $wp_query = new WP_Query( $args );
            ?>

            <?php if ($wp_query->have_posts()): ?>
                <section class="latest-videos">
                    <div class="section-title">
                        <h3><?php echo _e('Latest Videos', 'newsstand'); ?></h3>
                    </div>

                    <div class="section-content">

                        <div class="latest-videos-slider-actual">

                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                            <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                            <div class="single">
                                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
                                <div class="info">
                                    <span class="post-info">
                                        <span><?php the_time($newsstand_dateformat); ?></span>
                                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
                                    </span>
                                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                </div>
                            </div><!-- end of single -->

                            <?php endwhile; ?>

                        </div>

                    </div>
                </section>
            <?php endif ?>

            <?php wp_reset_query(); ?>


        </div>
    </div>

</section>

<?php
    $banner_2 = get_post_meta( get_the_ID(), 'newsstand_banner_2_image', 1, true );
    $banner_2_link = get_post_meta( get_the_ID(), 'newsstand_banner_2_link', 1, true );
?>

<?php if (!empty($banner_1) && !empty($banner_1_link)): ?>
    <section class="big-banner-holder">
        <div class="container">
            <a href="<?php echo esc_url($banner_1_link); ?>" target="_blank"><img src="<?php echo esc_url($banner_1); ?>" alt=""></a>
        </div>
    </section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>
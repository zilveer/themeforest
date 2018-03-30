<?php
	/* Template Name: Home 1 */
get_header(); ?>

<?php
	$args = array('post_type'=>'post', 'posts_per_page'=>4);
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>

	<section class="featured-posts">
	    <div class="container">

	        <div class="fp-slider">
	            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	            	<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

					<div class="slide" style="background-image: url(<?php echo esc_url($url); ?>);">
					    <a href="<?php the_permalink(); ?>">
					        <span class="valign">
					            <span class="info">
					                <span><?php the_time($newsstand_dateformat); ?></span>
					                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
					            </span>
					            <span class="title"><?php the_title(); ?></span>
					        </span>
					    </a>
					</div>

	        	<?php endwhile; ?>
	        </div>

	    </div>
	</section><!-- end of featured-posts -->

<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	function filter_where($where = '') {
		// show posts form last 7 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
	    return $where;
	}
	add_filter('posts_where', 'filter_where');

	$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC');
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>

	<section class="hot-ticker">
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

<section class="boxed-content">
    <div class="container">
        <div class="row">

            <div class="col-md-8 box-holder paddingright0">

            	<?php wp_reset_query(); ?>

            	<?php
            		$show = get_post_meta(get_the_ID(), 'newsstand_block_1_show', 1, true);

            		if ($show=='category') {
            			$cat_id = get_post_meta(get_the_ID(), 'newsstand_block_1_category', 1, true);
            			$cat_id = $cat_id[0];
            			$args = array('post_type'=>'post', 'posts_per_page'=>6, 'cat'=>$cat_id);
            		} elseif ($show=='mostpopular') {
            			function filter_where_2($where = '') {
            				// show posts form last 30 days
            			    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
            			    return $where;
            			}
            			add_filter('posts_where', 'filter_where_2');

            			$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC');
            		} elseif ($show=='latest') {
            			$args = array('post_type'=>'post', 'posts_per_page'=>6);
            		}

            		$wp_query = new WP_Query( $args );
            	?>

            	<?php if ($wp_query->have_posts()): ?>

            		<section class="box-1 no-top-border blogPosts fcusotmhome">

            		    <div class="row">

            		    	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

            		    		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

								<div class="col-sm-6 col-md-4">
								    <div class="single-post">
								        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
								            <a href="<?php the_permalink(); ?>" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><span class="plus"></span></a>
								            <span class="cat" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><?php echo esc_html(newsstand_cat_name($post->ID)); ?></span>
								        </div>
								        <div class="content">
								            <div class="post-info">
								                <span><?php the_time($newsstand_dateformat); ?></span>
								                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
								            </div>
								            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
								            <p><?php echo newsstand_excerpt(110); ?></p>
								        </div>
								    </div><!-- end of single-post-->
								</div><!-- end of col-->

            		    	<?php endwhile; ?>

            		    </div>
            		</section>

            	<?php endif ?>

                <?php remove_filter('posts_where', 'filter_where_2'); ?>

                <?php wp_reset_query(); ?>

                <?php
                    $editor_pick = get_post_meta(get_the_ID(), 'newsstand_editors_pick', 1, true);
                    $editor_pick_slug = get_post_meta(get_the_ID(), 'newsstand_editors_pick_slug', 1, true);

                    $args = array( 'post__in' => $editor_pick, 'posts_per_page' => 6, 'post__not_in' => get_option( 'sticky_posts' ) );

                    $wp_query = new WP_Query( $args );
                ?>

                <?php if ($wp_query->have_posts()): ?>
                    <section class="box-2 no-top-border editorsChoice">

                        <div class="section-title">
                            <h3><?php echo _e('Editors Choice', 'newsstand'); ?></h3>
                        </div>

                        <div class="row">

                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                            <?php
                                $cat_color = newsstand_cat_color($post->ID);
                                $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                            ?>

                            <div class="col-sm-6 col-md-4 sameHeight">
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="single-post" style="background-image: url(<?php echo esc_url($thumb_url); ?>); ?>;">
                                <?php else: ?>
                                    <div class="single-post" style="background-color: <?php echo esc_attr($cat_color); ?>;">
                                <?php endif ?>
                                    <a href="<?php the_permalink(); ?>" class="plus-hover">
                                        <span class="plus"></span>
                                        <span class="valign">
                                            <span class="post-icon"><i class="fa fa-pencil"></i></span>
                                            <span class="post-title"><?php the_title(); ?></span>
                                            <span class="post-text"><?php echo newsstand_excerpt(65); ?></span>
                                        </span>
                                    </a>
                                </div><!-- end of single-post -->
                            </div><!-- end of col -->

                            <?php endwhile; ?>

                        </div>
                    </section>
                <?php endif ?>

            </div>

    <?php wp_reset_query(); ?>

            <div class="col-md-4">
                <div class="box-sidebar">

                	<?php
                		$args = array('post_type'=>'post', 'posts_per_page'=>4);
                		$wp_query = new WP_Query( $args );
                	?>

                	<?php if ($wp_query->have_posts()): ?>

                		<div class="box no-top-border">
                		    <div class="box-title"><?php echo _e('Latest News', 'newsstand'); ?></div>
                		    <div class="box-content">
                		        <div class="latestNews">

		                		<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
									<div class="single">
									    <a href="<?php the_permalink(); ?>">
									        <span class="post-info">
									            <span><?php the_time($newsstand_dateformat); ?></span>
									            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
									        </span>
									        <span class="post-title"><?php the_title(); ?></span>
									        <span class="post-text"><?php echo newsstand_excerpt(50); ?></span>
									    </a>
									</div><!-- end of single-->
								<?php endwhile; ?>

						        </div>
						    </div>
						</div>

                	<?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                        function filter_where_135($where = '') {
                            // show posts form last 30 days
                            $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
                            return $where;
                        }
                        add_filter('posts_where', 'filter_where_135');

                        $args = array('post_type'=>'post', 'posts_per_page'=>4, 'orderby'=>'comment_count', 'order'=>'DESC');
                        $wp_query = new WP_Query( $args );
                    ?>

                    <?php if ($wp_query->have_posts()): ?>

                    <div class="box">
                        <div class="box-title"><?php echo _e('Popular', 'newsstand'); ?></div>
                        <div class="box-content">
                            <div class="latestNews">

                                <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                <div class="single">
                                    <a href="<?php the_permalink(); ?>">
                                        <span class="post-info">
                                            <span class="hot"><?php echo _e('hot', 'newsstand'); ?></span>
                                            <span><?php the_time($newsstand_dateformat); ?></span>
                                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
                                        </span>
                                        <span class="post-title"><?php the_title(); ?></span>
                                        <span class="post-text"><?php echo newsstand_excerpt(50); ?></span>
                                    </a>
                                </div><!-- end of single-->

                                <?php endwhile; ?>

                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                    <?php remove_filter('posts_where', 'filter_where_135'); ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
    $get_date = getdate();
    $month_days = date("t");
    $current_mon = $get_date['mon'];
    $current_mon = str_pad($current_mon, 2, 0, STR_PAD_LEFT);
    $current_month = $get_date['month'];
    $current_day = $get_date['mday'];

    $show_events = get_post_meta( get_the_ID(), 'newsstand_show_events', 1, true );
?>

<?php if ($show_events=='on'): ?>

    <section class="events-list">
        <div class="container">
            <div class="section-title">
                <h3>Events that is happening this month <span class="arrows"></span></h3>
            </div>
            <div class="events-title">
                <h3><?php echo esc_html($current_month); ?></h3>
                <p>A very interesting month, a lots of events happened during this month.</p>
            </div>
            <div class="list">

                <?php $x = 1; while($x <= $month_days): ?>
                    <?php if ($x==$current_day): ?>
                        <div class="single current">
                    <?php else: ?>
                        <div class="single">
                    <?php endif ?>

                        <div class="date"><span><?php echo esc_html($x); ?></span><a href="<?php echo site_url() . '/event'; ?>"><?php echo _e('View All', 'newsstand'); ?></a></div>
                        <ul class="list">
                            <li class="emptyList"><?php echo _e('Nothing this day.', 'newsstand'); ?></li>
                            <?php
                                $args = array( 'post_type' => 'event', 'posts_per_page' => -1 );
                                $wp_query = new WP_Query( $args );
                            ?>

                            <?php if ($wp_query->have_posts()): ?>

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
                                            $date_month = $date[0];
                                        } else {
                                            $date_month = 0;
                                        }
                                    ?>
                                    <?php if ($x==$date_day && $date_month == $current_mon): ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php endif ?>
                                <?php endwhile; ?>

                            <?php endif ?>
                        </ul>

                    </div>
                <?php $x++; endwhile; ?>

                <?php wp_reset_query(); ?>
            </div>
        </div>
    </section>

<?php endif ?>

<?php
    $b4_cat_to_loop = get_post_meta( get_the_ID(), 'newsstand_block_4_category', 1, true );
    $b4_cat_name = get_category($b4_cat_to_loop);
    $b4_cat_name = $b4_cat_name->cat_name;
    $args = array('post_type'=>'post', 'posts_per_page'=>6, 'cat'=>$b4_cat_to_loop[0]);
    $wp_query = new WP_Query( $args );
?>



<section class="boxed-content">
    <div class="container">
        <div class="row">

            <div class="col-md-8 box-holder">

                <?php if ($wp_query->have_posts()): ?>
                    <section class="box-2 top-fake-border catPosts">
                        <div class="section-title">
                            <h3><?php echo esc_html($b4_cat_name); ?></h3>
                        </div>
                        <div class="row">
                            <?php $y=0; ?>
                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?><?php $y++; endwhile; ?>
                            <?php $x=1; while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                <?php if ($x==1): ?>
                                    <div class="col-md-6">
                                <?php endif ?>

                                <?php if ($x==1 || $x==2): ?>
                                    <div <?php post_class("single-post"); ?>>
                                        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
                                        <div class="post-content">
                                            <div class="post-info">
                                                <span><?php the_time($newsstand_dateformat); ?></span>
                                                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                            <p><?php echo newsstand_excerpt(110); ?></p>
                                        </div>
                                    </div><!-- end of single-post-->
                                <?php endif ?>

                                <?php if ($x<3): ?>
                                    <?php if ($x==2 || $x==$y): ?>
                                        </div><!--end of col-md-6 -->
                                    <?php endif ?>
                                <?php endif ?>

                                <?php if ($x==3): ?>
                                    <div class="col-md-6 margin-top-992"><div class="row">
                                <?php endif ?>

                                    <?php if ($x==3 || $x==4 || $x==5 || $x==6): ?>

                                        <div class="col-sm-6">
                                            <div <?php post_class("single-post smaller"); ?>>
                                                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
                                                <div class="post-content">
                                                    <div class="post-info">
                                                        <span><?php the_time($newsstand_dateformat); ?></span>
                                                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                                                    </div>
                                                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                                    <p><?php echo newsstand_excerpt(110); ?></p>
                                                </div>
                                            </div><!-- end of single-post-->
                                        </div><!-- end of col-->

                                    <?php endif ?>

                                <?php if ($x>2): ?>
                                    <?php if ($x==6 || $x==$y): ?>
                                        </div><!--end of row --></div><!--end of col-md-6 -->
                                    <?php endif ?>
                                <?php endif ?>


                            <?php $x++; endwhile; ?>
                            <?php wp_reset_query(); ?>
                        </div><!-- end of all row -->
                    </section>
                <?php endif ?>


                <?php if (class_exists('woocommerce')): ?>
                    <?php
                        global $woocommerce;
                        $args = array('post_type' => 'product', 'posts_per_page' => 12);
                        $loop = new WP_Query( $args );
                    ?>

                    <?php if ($loop->have_posts()): ?>
                        <section class="box-2 no-top-border no-bottom-border shopItems">
                            <div class="shopitems-slider">

                                <?php while($loop->have_posts()): $loop->the_post(); ?>

                                    <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                    <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                                        <a href="<?php the_permalink(); ?>">
                                            <span class="valign">
                                                <span class="title"><?php the_title(); ?></span>
                                                <span class="text"><?php echo newsstand_excerpt(50); ?></span>
                                            </span>
                                        </a>
                                    </div><!-- end of single -->

                                <?php endwhile; ?>

                            </div>
                            <div class="shopitems-slider-arrows sec-arrows"></div>
                        </section>
                    <?php endif ?>

                <?php endif ?>

                <?php wp_reset_query(); ?>


                <?php
                    $show_upcomingevents = get_post_meta( get_the_ID(), 'newsstand_show_upcomingevents', 1, true );
                ?>

                <?php if ($show_upcomingevents=='on'): ?>
                    <?php
                        $args = array( 'post_type' => 'event' );
                        $wp_query = new WP_Query( $args );
                    ?>

                    <?php if ($wp_query->have_posts()): ?>

                            <section class="box-2 top-fake-border upcomingEvents">
                                <div class="section-title">
                                    <h3><?php echo _e('Upcoming Events', 'newsstand'); ?></h3>
                                </div>

                                <div class="upcomingevents-slider">

                                    <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                        <?php
                                            $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                            $date = get_post_meta(get_the_ID(), 'newsstand_event_date', 1, true);
                                            $date = explode('/', $date);
                                            if (isset($date[1])) {
                                                $date_day = $date[1];
                                            } else { $date_day = 0; }
                                            if (isset($date[0]) && !empty($date[0])) {
                                                $date_month = date( 'F' , mktime(1, 1, 1, $date[0], 1) );
                                            } else { $date_month = 0; }
                                        ?>

                                            <div class="single-wrapper">
                                                <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <span class="valign">
                                                            <span class="date">
                                                                <?php if ($date_day==1): ?>
                                                                        <?php echo esc_html($date_day); ?><span>st</span>
                                                                    <?php elseif($date_day==2): ?>
                                                                        <?php echo esc_html($date_day); ?><span>nd</span>
                                                                    <?php elseif($date_day==3): ?>
                                                                    <?php echo esc_html($date_day); ?><span>rd</span>
                                                                    <?php else: ?>
                                                                        <?php echo esc_html($date_day); ?><span>th</span>
                                                                <?php endif ?>
                                                            </span>
                                                            <span class="month"><?php echo esc_html($date_month); ?></span>
                                                            <span class="title"><?php the_title(); ?></span>
                                                        </span>
                                                    </a>
                                                </div><!-- end of single -->
                                            </div><!-- end of single wrapper -->

                                    <?php endwhile; ?>

                                </div>

                                <div class="upcomingevents-slider-arrows sec-arrows"></div>
                            </section>

                    <?php endif ?>

                <?php endif ?>

                <?php wp_reset_query(); ?>


                <?php
                    $args = array( 'post_type' => 'blog', 'posts_per_page' => 6 );
                    $wp_query = new WP_Query( $args );
                ?>

                <?php if ($wp_query->have_posts()): ?>

                    <section class="box-2 no-top-border blogPosts style-2">
                        <div class="section-title">
                            <h3><?php echo _e('Latest from Blog', 'newsstand'); ?></h3>
                        </div>

                        <div class="row">

                            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                <div class="col-sm-6 col-md-4">
                                    <div <?php post_class('single-post'); ?>>
                                        <div class="content">
                                            <div class="post-info">
                                                <span><?php echo the_time($newsstand_dateformat); ?></span>
                                                <span><i class="fa fa-clock-o"></i> <?php echo the_time($newsstand_timeformat); ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                            <p><?php echo newsstand_excerpt(110); ?></p>
                                        </div>
                                    </div><!-- end of single-post-->
                                </div><!-- end of col-->

                            <?php endwhile; ?>

                        </div>
                    </section>

                <?php endif ?>

            </div>

            <?php wp_reset_query(); ?>

            <div class="col-md-4">
                <div class="box-sidebar">
                    <?php
                        $user_query = new WP_User_Query( array( 'role' => 'editor', 'fields' => 'all_with_meta', 'number' => 3, 'orderby' => 'post_count', 'order' => 'DESC' ) );
                    ?>
                    <?php if (!empty($user_query->results)): ?>

                        <div class="box">
                            <div class="box-title"><?php echo _e('Top Editors', 'newsstand'); ?></div>
                            <div class="box-content">
                                <div class="editorsList">

                                    <?php foreach ( $user_query->results as $user ): ?>
                                        <?php
                                            $user_info = get_userdata($user->ID);
                                            $user_position = get_user_meta($user->ID, 'newsstand_user_position', 1);
                                            $user_stats = get_user_meta($user->ID, 'newsstand_user_stats', 1);
                                            $user_photo = get_user_meta($user->ID, 'newsstand_user_photo', 1);
                                        ?>
                                        <div class="single">
                                            <?php if (!empty($user_photo)): ?>
                                                <div class="author-info">
                                            <?php else: ?>
                                                <div class="author-info no-up">
                                            <?php endif ?>

                                                <?php if (!empty($user_photo)): ?>
                                                    <div class="image" style="background-image: url(<?php echo esc_url($user_photo); ?>);"></div>
                                                <?php endif ?>

                                                <div class="info">
                                                    <span class="name"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_html($user->display_name); ?></a></span>
                                                    <?php if (!empty($user_position)): ?>
                                                        <span class="title"><?php echo esc_html($user_position); ?></span>
                                                    <?php endif ?>
                                                    <p><?php echo newsstand_user_excerpt($user->ID, 150); ?></p>
                                                </div>
                                            </div>
                                            <div class="author-stats">
                                                <ul>
                                                    <li><span><?php echo count_user_posts($user->ID); ?></span> <?php _e('Blog Posts Written', 'newsstand'); ?></li>
                                                    <?php if (isset($user_stats) && !empty($user_stats)): ?>
                                                        <?php foreach ($user_stats as $stats): ?>
                                                            <li><span><?php echo esc_htmL($stats['number']); ?></span> <?php echo esc_html($stats['title']); ?></li>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </div><!-- end of single-->
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div><!-- end of box -->

                    <?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                        $args = array( 'post_type' => 'recipe', 'posts_per_page' => 3 );
                        $wp_query = new WP_Query($args);
                    ?>

                    <?php if ($wp_query->have_posts()): ?>
                        <div class="box">
                            <div class="box-title"><?php echo _e('Food Recipes', 'newsstand'); ?></div>
                            <div class="box-content">
                                <div class="recipessList">

                                    <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                        <?php
                                            $prep_time = get_post_meta( get_the_ID(), 'newsstand_prep_time', 1 );
                                            $persons = get_post_meta( get_the_ID(), 'newsstand_persons', 1 );
                                            $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                        ?>

                                        <div class="single">
                                            <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"></div>
                                            <div class="info">
                                                <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                                                <span class="info"><?php echo esc_html($prep_time); ?> | <?php echo esc_html($persons); ?></span>
                                                <p><?php echo newsstand_excerpt(60); ?></p>
                                                <a href="<?php the_permalink(); ?>" class="read"><?php echo _e('Read Recipe', 'newsstand'); ?></a>
                                            </div>
                                        </div><!-- end of single-->

                                    <?php endwhile; ?>

                                </div>
                            </div>
                        </div><!-- end of box -->
                    <?php endif ?>

                </div>
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query(); ?>


<?php
    function filter_where_3($where = '') {
        // show posts form last 30 days
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
        return $where;
    }
    add_filter('posts_where', 'filter_where_3');
    $args = array( 'post_type' => 'gallery', 'posts_per_page' => 5, 'orderby'=>'comment_count', 'order'=>'DESC' );
    $wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>

    <section class="popular-galleries">
        <div class="container overlay">
            <div class="gal-title"><?php echo _e('Popular Galleries', 'newsstand'); ?></div>
        </div>
        <div class="container slider-arrows"></div>
        <div class="popular-galleries-slider">

            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                <?php
                    $gallery_images = get_post_meta( get_the_ID(), 'newsstand_images', 1, true );
                    $gi_count = 0;
                    foreach ($gallery_images as $image) { $gi_count++; }

                    $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    if (empty($thumb_url)) {
                        $x=1;
                        foreach ($gallery_images as $image) {
                            if ($x==1) {
                                $thumb_url = $image;
                            }
                            $x++;
                        }
                    }
                ?>

                <div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                    <div class="container">
                        <div class="valign">
                            <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                            <div class="buttons">
                                <a href="<?php the_permalink(); ?>"><?php echo _e('Open Gallery', 'newsstand'); ?> <span><i class="fa fa-angle-right"></i></span></a>
                                <span><?php echo esc_html($gi_count); ?> <?php echo _e('Images', 'newsstand'); ?></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end of single -->

            <?php endwhile; ?>

        </div>
    </section>

<?php endif ?>

<?php remove_filter('posts_where', 'filter_where_3') ?>

<?php wp_reset_query(); ?>

<?php
    $b6_show = get_post_meta( get_the_ID(), 'newsstand_show_b6', 1, true );
    $b6_category = get_post_meta( get_the_ID(), 'newsstand_block_6_category', 1, true );

    $b6_cat_name = get_category($b6_category);
    $b6_cat_name = $b6_cat_name->cat_name;
    $args = array('post_type'=>'post', 'posts_per_page'=>2, 'cat'=>$b6_category,'post__not_in' => get_option( 'sticky_posts' ));
    $wp_query = new WP_Query( $args );

    $args2 = $args;
    $args2['posts_per_page'] = 4;
    $args2['offset'] = 2;
    $wp_query2 = new WP_Query( $args2 );
?>

<?php if ($b6_show=='on'): ?>
    <?php if ($wp_query->have_posts()): ?>
        <section class="boxed-content" style="margin-top: 30px;">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 box-holder">
                        <section class="box-2 box-full-height no-top-border blogPosts style-2">

                            <div class="section-title">
                                <h3><?php echo esc_html($b6_cat_name); ?></h3>
                            </div>

                            <div class="row">

                                <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
                                    <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                <div class="col-sm-6">
                                    <div <?php post_class('single-post'); ?>>
                                        <div class="image bigger-height" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                                            <a href="<?php the_permalink(); ?>" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><span class="plus"></span></a>
                                            <span class="cat" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><?php echo esc_html(newsstand_cat_name($post->ID)); ?></span>
                                        </div>
                                        <div class="content">
                                            <div class="post-info">
                                                <span><?php the_time($newsstand_dateformat); ?></span>
                                                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                            <p><?php echo newsstand_excerpt(110); ?></p>
                                        </div>
                                    </div><!-- end of single-post-->
                                </div><!-- end of col-->

                                <?php endwhile; ?>

                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <div class="box-sidebar">
                            <div class="box no-top-border">
                                <div class="box-title style-2 no-padding-top"><?php _e('More', 'newsstand'); ?></div>
                                <div class="box-content">
                                    <div class="latestNews">

                                        <?php if ($wp_query2->have_posts()): ?>

                                            <?php while($wp_query2->have_posts()): $wp_query2->the_post(); ?>
                                                <div class="single">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <span class="post-info">
                                                            <span><?php the_time($newsstand_dateformat); ?></span>
                                                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                                                        </span>
                                                        <span class="post-title"><?php the_title(); ?></span>
                                                    </a>
                                                </div><!-- end of single-->
                                            <?php endwhile; ?>

                                        <?php else: ?>

                                            <p>No more posts.</p>

                                        <?php endif ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <?php endif ?>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
    $b7_show = get_post_meta( get_the_ID(), 'newsstand_show_b7', 1, true );
    $b7_category = get_post_meta( get_the_ID(), 'newsstand_block_7_category', 1, true );

    $b7_cat_name = get_category($b7_category);
    $b7_cat_name = $b7_cat_name->cat_name;
    $args = array('post_type'=>'post', 'posts_per_page'=>2, 'cat'=>$b7_category,'post__not_in' => get_option( 'sticky_posts' ));
    $wp_query = new WP_Query( $args );

    $args2 = $args;
    $args2['posts_per_page'] = 4;
    $args2['offset'] = 2;
    $wp_query2 = new WP_Query( $args2 );
?>


<?php if ($b7_show=='on'): ?>
    <?php if ($wp_query->have_posts()): ?>
        <section class="boxed-content" style="margin-top: 30px;">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 box-holder">
                        <section class="box-2 box-full-height no-top-border blogPosts style-2">

                            <div class="section-title">
                                <h3><?php echo esc_html($b7_cat_name); ?></h3>
                            </div>

                            <div class="row">

                                <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                                    <?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                                <div class="col-sm-6">
                                    <div <?php post_class('single-post'); ?>>
                                        <div class="image bigger-height" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
                                            <a href="<?php the_permalink(); ?>" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><span class="plus"></span></a>
                                            <span class="cat" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><?php echo esc_html(newsstand_cat_name($post->ID)); ?></span>
                                        </div>
                                        <div class="content">
                                            <div class="post-info">
                                                <span><?php the_time($newsstand_dateformat); ?></span>
                                                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
                                            </div>
                                            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                                            <p><?php echo newsstand_excerpt(110); ?></p>
                                        </div>
                                    </div><!-- end of single-post-->
                                </div><!-- end of col-->

                                <?php endwhile; ?>

                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <div class="box-sidebar">
                            <div class="box no-top-border">
                                <div class="box-title style-2 no-padding-top"><?php _e('More', 'newsstand'); ?></div>
                                <div class="box-content">
                                    <div class="latestNews">

                                        <?php if ($wp_query2->have_posts()): ?>

                                            <?php while($wp_query2->have_posts()): $wp_query2->the_post(); ?>
                                                <div class="single">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <span class="post-info">
                                                            <span><?php the_time($newsstand_dateformat); ?></span>
                                                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                                                        </span>
                                                        <span class="post-title"><?php the_title(); ?></span>
                                                    </a>
                                                </div><!-- end of single-->
                                            <?php endwhile; ?>

                                        <?php else: ?>

                                            <p>No more posts.</p>

                                        <?php endif ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <?php endif ?>
<?php endif ?>


<?php get_footer(); ?>



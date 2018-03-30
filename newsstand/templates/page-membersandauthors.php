<?php
	/* Template Name: Members or Authors Page */
get_header(); ?>

<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
        </ul>
    </div>
</div>

<?php
	$whattoshow = get_post_meta( get_the_ID(), 'newsstand_maa_what', 1, true );
?>

<section class="boxed-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 box-holder">
                <section class="box-1 no-top-border no-bottom-border no-bottom-padding authorsList">

                	<?php if ($whattoshow=='members'): ?>
                		<?php
                			wp_reset_query();
                			$args = array( 'post_type' => 'team', 'posts_per_page' => -1 );
                			$wp_query = new WP_Query( $args );
                		?>
                		<?php if ($wp_query->have_posts()): ?>
                			<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

                				<?php
                					$photo = get_post_meta( get_the_ID(), 'newsstand_member_photo', 1, true );
                					$namesurname = get_post_meta( get_the_ID(), 'newsstand_member_namesurname', 1, true );
                					$position = get_post_meta( get_the_ID(), 'newsstand_member_position', 1, true );
                					$shortdesc = get_post_meta( get_the_ID(), 'newsstand_member_shortdesc', 1, true );
                					$siteurl = get_post_meta( get_the_ID(), 'newsstand_member_siteurl', 1, true );
                					$social = get_post_meta( get_the_ID(), 'newsstand_member_social', 1, true );
                				?>

								<div class="single">
								    <div class="image" style="background-image: url(<?php echo esc_url($photo); ?>);">
								        <?php if (!empty($siteurl)): ?>
								        	<a href="<?php echo esc_url($siteurl); ?>" class="plus-hover"><span class="plus"></span></a>
								        <?php endif ?>
								    </div>
								    <div class="info">
								        <span class="position"><?php echo esc_html($position); ?></span>
								        <span class="name"><?php echo esc_html($namesurname); ?></span>
								        <p><?php echo esc_html($shortdesc); ?></p>
								        <?php if (!empty($social) && isset($social)): ?>
								        	<div class="social">
								        	    <?php foreach ($social as $single): ?>
								        	    	<a href="<?php echo esc_url($single['url']); ?>"><i class="fa <?php echo esc_attr($single['icon']); ?>"></i></a>
								        	    <?php endforeach ?>
								        	</div>
								        <?php endif ?>
								    </div>
								</div><!-- end of single -->

                			<?php endwhile; ?>
                		<?php endif ?>
                	<?php endif ?>

                	<?php if ($whattoshow=='authors'): ?>
						<?php $user_query = new WP_User_Query( array( 'role' => 'editor', 'fields' => 'all_with_meta', 'number' => 3, 'orderby' => 'post_count', 'order' => 'DESC' ) ); ?>

						<?php if (!empty($user_query->results)): ?>
							<?php foreach ( $user_query->results as $user ): ?>
							    <?php
							        $user_info = get_userdata($user->ID);
							        $user_position = get_user_meta($user->ID, 'newsstand_user_position', 1);
							        $user_stats = get_user_meta($user->ID, 'newsstand_user_stats', 1);
							        $user_photo = get_user_meta($user->ID, 'newsstand_user_photo', 1);
							    ?>

							    <div class="single">
							    	<?php if (!empty($user_photo)): ?>
							    		<div class="image" style="background-image: url(<?php echo esc_url($user_photo); ?>);">
							    		    <a href="<?php echo get_author_posts_url( $user->ID ); ?>" class="plus-hover"><span class="plus"></span></a>
							    		</div>
							    	<?php endif ?>

							        <?php if (!empty($user_photo)): ?>
							        	<div class="info">
							        <?php else: ?>
							        	<div class="info" style="width: 100%;padding-left:0;">
							        <?php endif ?>

							            <span class="position"><?php echo esc_html($user_position); ?></span>
							            <span class="name"><a href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo esc_html($user_info->display_name); ?></a></span>
							            <p><?php echo newsstand_limit($user_info->description, 380); ?></p>
							        </div>
							    </div><!-- end of single -->

							<?php endforeach; ?>
						<?php endif; ?>
                	<?php endif ?>

                </section>
            </div>

            <div class="col-md-4">
                <div class="box-sidebar no-bottom-border">

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
									    <a href="javascript:void(null);">
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
                        function filter_where_2($where = '') {
                            // show posts form last 30 days
                            $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
                            return $where;
                        }
                        add_filter('posts_where', 'filter_where_2');

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
                    <?php wp_reset_query(); ?>
                </div>
            </div>

        </div>
    </div>
</section>

<br>

<?php get_footer(); ?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package News Stand
 */

get_header(); ?>

	<?php /* SAME AS ARCHIVE.PHP */ ?>
		<div class="breadcrumbs">
		    <div class="container">
		        <ul>
		            <li><?php the_archive_title(); ?></li>
		        </ul>
		    </div>
		</div>

		<section class="boxed-content">
		    <div class="container">
		        <div class="row">

		            <div class="col-md-8 box-holder">
		                <section class="box-1 no-top-border no-bottom-border no-bottom-padding blogPosts">

		                    <div class="row">

	    	                    	<?php if (have_posts()): ?>

	    	                    		<?php while(have_posts()): the_post(); ?>
	    	                    			<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	    	                    			<div class="col-sm-6 col-md-4">
	    	                    			    <div <?php post_class('single-post'); ?>>
	    	                    			        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
	        								            <a href="<?php the_permalink(); ?>" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><span class="plus"></span></a>
	        								            <span class="cat" style="background-color: <?php echo esc_attr(newsstand_cat_color($post->ID)); ?>;"><?php echo esc_html(newsstand_cat_name($post->ID)); ?></span>
	        								        </div>
	    	                    			        <div class="content">
	    	                    			            <div class="post-info">
	    	                    			                <span><?php the_time($newsstand_dateformat); ?></span>
	    	                    			                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
	    	                    			            </div>
	    	                    			            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
	    	                    			            <p><?php echo newsstand_excerpt(90); ?></p>
	    	                    			        </div>
	    	                    			    </div><!-- end of single-post-->
	    	                    			</div><!-- end of col-->
	    	                    		<?php endwhile; ?>

	    	                    		<?php else: ?>

	    	                    		<div class="col-xs-12">
	    	                    			<h4><?php echo _e('Nothing to see here.', 'newsstand'); ?></h4>
	    	                    		</div>

	    	                    	<?php endif ?>

	    	                    <?php if (get_previous_posts_link() || get_next_posts_link()): ?>
	    	                        <ul class="pagination ns no-bottom-margin">
	    	                            <?php echo newsstand_pagination(); ?>
	    	                        </ul>
	    	                    <?php endif ?>

		                    </div>

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
	<?php /* SAME AS ARCHIVE.PHP */ ?>

<?php get_footer(); ?>

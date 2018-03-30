<?php
	/* Template Name: Blog Page */
get_header(); ?>

<?php
	function filter_where_3($where = '') {
		// show posts form last 7 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
	    return $where;
	}
	add_filter('posts_where', 'filter_where_3');

	$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC', 'post__not_in' => get_option( 'sticky_posts' ));
	$wp_query = new WP_Query( $args );
?>
<?php if ($wp_query->have_posts()): ?>
	<section class="most-popular full-width">
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
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args = array('post_type' => 'post', 'posts_per_page' => 9, 'paged' => $paged);
	$wp_query = new WP_Query( $args );
?>
<section class="news-splitted blogpage">
    <div class="container">
        <div class="actual-container">
            <div class="row">

            		<div class="col-md-9">

                        <?php if ($wp_query->have_posts()): ?>

                		    <div class="col-title" style="border-color: #e6e6e6;"></div>

                		    <div class="row">

                		        <div class="posts-holder bunch blogpg pt30 reviews">

                		            <div class="col-title-2"><?php the_title(); ?></div>

                                    <div class="row">

                		            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
                                        <?php
                                            $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                        ?>

    	            		            <div class="col-sm-6 col-md-4">
    	            		                <div <?php post_class('single'); ?>>
    	            		                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
    	            		                        <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
    	            		                    </div>
    	            		                    <div class="post-info">
    	            		                        <span><?php the_time($newsstand_dateformat); ?></span>
    	            		                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
    	            		                    </div>
    	            		                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
    	            		                    <p><?php echo newsstand_excerpt(90); ?></p>
    	            		                </div><!-- end of single -->
    	            		            </div><!-- end of col -->

                		       		<?php endwhile; ?>

                                    <?php if (get_previous_posts_link() || get_next_posts_link()): ?>
                                        <ul class="pagination ns no-bottom-margin">
                                            <?php echo newsstand_pagination(); ?>
                                        </ul>
                                    <?php endif ?>

                                    </div>

                		        </div>

                		    </div>
                            <?php else: ?>

                            <h4 style="padding: 15px;"><?php _e('There are no blog posts to show.', 'newsstand'); ?></h4>
                        <?php endif ?>

            		</div>


                <?php wp_reset_query(); ?>
                <div class="col-md-3 secondcol">
                    <?php get_template_part('inc/theme/page_custom_sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>
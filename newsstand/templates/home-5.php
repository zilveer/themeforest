<?php
	/* Template Name: Home 5 */
get_header(); ?>

<?php
	$args = array('post_type' => 'post', 'posts_per_page' => 1,'post__not_in' => get_option( 'sticky_posts' ));
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<section class="top-latest">

	    <div class="container">
	    	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	    		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	        <div class="tl-single" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
	            <div class="valign">
	                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
	                <span class="post-info">
	                    <span><?php the_time($newsstand_dateformat); ?></span>
	                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
	                </span>
	            </div>
	        </div>

	    	<?php endwhile; ?>
	    </div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<section class="news-stylish-block">
    <div class="container">
        <div class="row">

        	<?php
        		$b20_show = get_post_meta( get_the_ID(), 'newsstand_block_block20_show', 1, true );
        		$b20_cat = get_post_meta( get_the_ID(), 'newsstand_block_block20_category', 1, true );

        		if ($b20_show=='latest') {
        		    $args = array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ));
        		} elseif($b20_show=='mostpopular') {
        		    function filter_where_4($where = '') {
        		        // show posts form last 3 days
        		        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
        		        return $where;
        		    }
        		    add_filter('posts_where', 'filter_where_4');
        		    $args = array('post_type' => 'post', 'posts_per_page' =>4, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
        		} elseif($b20_show=='category') {
        		    $cat_id = $b20_cat;
        		    $categoryID = get_category($cat_id);
        		    $cat_name = $categoryID->category_nicename;
        		    $cat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');

        		    $args = array('post_type'=>'post', 'posts_per_page'=>4, 'cat'=>$cat_id, 'post__not_in' => get_option( 'sticky_posts' ));
        		}

        		$wp_query = new WP_Query( $args );
        	?>

        	<?php if ($wp_query->have_posts()): ?>
        		<div class="col-md-8">
        		    <div class="box-wrapper">
        		        <?php if ($b20_show=='latest'): ?>
        		        	<div class="title-bar"><span><?php _e('Latest News', 'newsstand'); ?></span></div>
        		        <?php elseif($b20_show=='mostpopular'): ?>
        		        	<div class="title-bar"><span><?php _e('Hot News', 'newsstand'); ?></span></div>
        		        <?php elseif($b20_show=='category'): ?>
        		        	<div class="title-bar" style="background-color: <?php echo esc_attr($cat_color); ?>;"><span><?php echo esc_html($cat_name); ?></span></div>
        		        <?php endif ?>

        		        <div class="box-content">
        		            <div class="row fouritems">

        		            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
        		            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

        		                <div class="col-sm-6">
        		                    <div class="single">
        		                        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
        		                            <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
        		                        </div>
        		                        <div class="post-info">
        		                            <span><?php the_time($newsstand_dateformat); ?></span>
        		                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
        		                        </div>
        		                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
        		                        <p><?php echo newsstand_excerpt(110); ?></p>
        		                    </div><!-- end of single -->
        		                </div><!-- end of col-->

        		                <?php endwhile; ?>

        		            </div>
        		        </div>
        		    </div>
        		</div>
        	<?php endif ?>

        	<?php remove_filter("filter_where", "filter_where_4"); ?>

        	<?php wp_reset_query(); ?>

        	<?php
        		$b21_show = get_post_meta( get_the_ID(), 'newsstand_block_block21_show', 1, true );
        		$b21_cat = get_post_meta( get_the_ID(), 'newsstand_block_block21_category', 1, true );

        		if ($b21_show=='latest') {
        		    $args = array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option( 'sticky_posts' ));
        		} elseif($b21_show=='mostpopular') {
        		    function filter_where_5($where = '') {
        		        // show posts form last 3 days
        		        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
        		        return $where;
        		    }
        		    add_filter('posts_where', 'filter_where_5');
        		    $args = array('post_type' => 'post', 'posts_per_page' =>6, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
        		} elseif($b21_show=='category') {
        		    $cat_id = $b21_cat;
        		    $categoryID = get_category($cat_id);
        		    $cat_name = $categoryID->category_nicename;
        		    $cat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');

        		    $args = array('post_type'=>'post', 'posts_per_page'=>6, 'cat'=>$cat_id, 'post__not_in' => get_option( 'sticky_posts' ));
        		}

        		$wp_query = new WP_Query( $args );
        	?>

            <?php if ($wp_query->have_posts()): ?>

            	<div class="col-md-4">
            	    <div class="box-wrapper">
            	    	<?php if ($b21_show=='latest'): ?>
            	    		<div class="title-bar" style="background-color: #333;"><span><?php _e('Latest News', 'newsstand'); ?></span></div>
            	    	<?php elseif($b21_show=='mostpopular'): ?>
            	    		<div class="title-bar" style="background-color: #333;"><span><?php _e('Hot News', 'newsstand'); ?></span></div>
            	    	<?php elseif($b21_show=='category'): ?>
            	    		<div class="title-bar" style="background-color: <?php echo esc_attr($cat_color); ?>;"><span><?php echo esc_html($cat_name); ?></span></div>
            	    	<?php endif ?>

            	        <div class="box-content">
            	            <div class="row boxeditems">

            	            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

            	            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

            	                <div class="col-xs-6 col-sm-4 col-md-6">
            	                    <div class="single-boxed sameHeight">
            	                        <a href="<?php the_permalink(); ?>" class="sameHeight" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
            	                            <span class="title"><?php the_title(); ?></span>
            	                            <span class="read-more"><?php _e('Read More', 'newsstand'); ?></span>
            	                        </a>
            	                    </div><!-- end of single -->
            	                </div><!-- end of col-->

            	                <?php endwhile; ?>

            	            </div>
            	        </div>
            	    </div>
            	</div>

            <?php endif ?>
            <?php remove_filter("filter_where", "filter_where_5"); ?>

        </div>
    </div>
</section>

<?php wp_reset_query(); ?>

<?php
	$args = array( 'post_type' => 'gallery', 'posts_per_page' => 5 );
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<section class="big-gallery-slider">
	    <div class="container">
	        <div class="actual-container">
	            <div class="bgs-slider">
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
						    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</div><!-- end of single -->
	                <?php endwhile; ?>
	            </div>
	        </div>
	    </div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$b22_show = get_post_meta( get_the_ID(), 'newsstand_block_block22_show', 1, true );
	$b22_cat = get_post_meta( get_the_ID(), 'newsstand_block_block22_category', 1, true );

	if ($b22_show=='latest') {
	    $args = array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option( 'sticky_posts' ));
	} elseif($b22_show=='mostpopular') {
	    function filter_where_6($where = '') {
	        // show posts form last 3 days
	        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	        return $where;
	    }
	    add_filter('posts_where', 'filter_where_6');
	    $args = array('post_type' => 'post', 'posts_per_page' =>6, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
	} elseif($b22_show=='category') {
	    $cat_id = $b22_cat;
	    $categoryID = get_category($cat_id);
	    $cat_name = $categoryID->category_nicename;
	    $cat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');

	    $args = array('post_type'=>'post', 'posts_per_page'=>6, 'cat'=>$cat_id, 'post__not_in' => get_option( 'sticky_posts' ));
	}

	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<section class="news-stylish-block">
	        <div class="container">
	            <div class="row">

	                <div class="col-md-12">
	                    <div class="box-wrapper">
	                        <?php if ($b22_show=='latest'): ?>
	                        	<div class="title-bar"><span><?php _e('Latest News', 'newsstand'); ?></span></div>
	                        <?php elseif($b22_show=='mostpopular'): ?>
	                        	<div class="title-bar"><span><?php _e('Hot News', 'newsstand'); ?></span></div>
	                        <?php elseif($b22_show=='category'): ?>
	                        	<div class="title-bar" style="background-color: <?php echo esc_attr($cat_color); ?>;"><span><?php echo esc_html($cat_name); ?></span></div>
	                        <?php endif ?>

	                        <div class="box-content">
	                            <div class="row tpl">

	                            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	                            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

		                                <div class="col-sm-6 col-md-4">
		                                    <div class="single">
		                                        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                                            <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
		                                        </div>
		                                        <div class="post-info">
		                                            <span><?php the_time($newsstand_dateformat); ?></span>
		                                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                                        </div>
		                                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
		                                        <p><?php echo newsstand_excerpt(110); ?></p>
		                                    </div><!-- end of single -->
		                                </div><!-- end of col-->

	                                <?php endwhile; ?>

	                            </div>
	                        </div>
	                    </div>
	                </div>

	            </div>
	        </div>
	</section>
<?php endif ?>

<?php remove_filter('posts_where', 'filter_where_6'); ?>
<?php wp_reset_query(); ?>

<?php
	$args = array( "post_type" => 'video', 'posts_per_page' => 6, 'post__not_in' => get_option( 'sticky_posts' ) );
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<div class="news-stylish-block">
	    <div class="container">
	        <div class="title-bar"><span><?php _e('Latest Videos', 'newsstand'); ?></span></div>

	        <div class="box-content">
	            <div class="latest-galleries-slider lightGallery-videos-3">

	            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	            		<?php
	            			$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	            			$video_url = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true );
	            		?>

		                <div class="single-gallery" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                    <a href="javascript:void(null);" data-src="<?php echo esc_url($video_url); ?>" data-thumb-src="<?php echo esc_url($thumb_url); ?>" class="plus-hover"><span class="plus"></span></a>
		                    <div class="valign">
		                        <span class="title"><?php the_title(); ?></span>
		                        <span class="num"><?php the_time($newsstand_dateformat); ?></span>
		                    </div>
		                </div><!-- end of single-gallery -->

	                <?php endwhile; ?>

	            </div>
	        </div>
	    </div>
	</div>
<?php endif ?>

<?php wp_reset_query(); ?>
<?php
	$instagram_userid = $newsstand['newsstand_instagram_userid'];
	$show_instafeed = get_post_meta(get_the_ID(), 'newsstand_show_instagram_feed', 1, true);
?>
<?php if (!empty($instagram_userid) && $show_instafeed=='on'): ?>
	<section class="instagram-feed">
	    <div class="container">
	        <div class="sec-title">
	            <span>Instagram Feed</span>
	        </div>
	        <div class="sec-content">
	            <div id="instagram_feed"></div>
	        </div>
	    </div>
	</section>

	<script>
	    (function($) {
	        "use strict";

	        $(document).ready(function() {
            	if ($("#instagram_feed").length > 0) {
            	    var feed = new Instafeed({
            	        target: "instagram_feed",
            	        get: 'user',
            	        limit: 5,
            	        userId: <?php echo esc_js($instagram_userid); ?>,
            	        accessToken: '1068835781.467ede5.bed6906b0d4f43279648a2d6bf6c7b0d',
            	        template: '<a class="sameHeight plus-hover" href="{{link}}" target="_blank" style="background-image: url({{image}});color:transparent;">.<span class="plus"></span></a>',
            	        sortBy: 'most-recent',
            	        useHttp: true,
            	        resolution: 'low_resolution'
            	    });
            	    feed.run();
            	}
	        });
	    })(jQuery);
	</script>
<?php endif ?>


<?php get_footer(); ?>
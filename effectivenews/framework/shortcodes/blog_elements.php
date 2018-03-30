<?php

/* ==========================================================================
 *              Blog Posts
   ========================================================================== */
function mom_blog_post($style='', $share = true, $excerpt_length='', $grid_class = '') {
                global $post;
		global $da;
		$full_post = mom_option('post_full_post');
		if ($full_post == false) {
				$full_post = get_post_meta($post->ID, 'mom_full_post', true);
		}
if ($style == 'm2') { ?>
<?php
		if ($excerpt_length == '') {
				$excerpt_length = 190;
		}
?>
    <div <?php post_class('base-box blog-post default-blog-post'); ?> itemscope itemtype="http://schema.org/Article">
    <div class="bp-entry">
        <div class="bp-head">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php mom_posts_meta('bp-meta'); ?>
        </div> <!--blog post head-->
        <div class="bp-details">
		<?php if (mom_post_image() != false) { ?>
            <div class="post-img">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('blog_medium'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
                <span class="post-format-icon"></span>
            </div> <!--img-->
	    <?php } ?>
                <?php if ($full_post) { the_content(); } else { ?>
                                <P>
                                    <?php
                                            $excerpt = get_the_excerpt();
                                            if ($excerpt == false) {
                                            $excerpt = get_the_content();
                                            }
                                            echo wp_html_excerpt(strip_shortcodes($excerpt), $excerpt_length, '...');
                                    ?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                    <?php } ?>
                    <div class="clear"></div>
        </div> <!--details-->
    </div> <!--entry-->
    <?php if ($share == true) { mom_posts_share($post->ID, get_permalink($post->ID)); }  ?>
    <div class="clear"></div>
</div> <!--blog post-->
<?php } elseif ($style == 'l') { ?>
<?php
		if ($excerpt_length == '') {
				$excerpt_length = 450;
		}
?>
<div <?php post_class('base-box blog-post default-blog-post bp-full-img'); ?> itemscope itemtype="http://schema.org/Article">
    <div class="bp-entry">
		<?php if (mom_post_image() != false) { ?>
            <div class="post-img">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('bigger-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
                <span class="post-format-icon"></span>
            </div> <!--img-->
	    <?php } ?>
        <div class="bp-head">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php mom_posts_meta('bp-meta'); ?>
        </div> <!--blog post head-->
        <div class="bp-details">
                <?php if ($full_post) { the_content(); } else { ?>
                                <P>
                                    <?php
                                            $excerpt = get_the_excerpt();
                                            if ($excerpt == false) {
                                            $excerpt = get_the_content();
                                            }
                                            
                                            echo wp_html_excerpt(strip_shortcodes($excerpt), $excerpt_length, '...');
                                    ?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                    <?php } ?>
                    <div class="clear"></div>
        </div> <!--details-->
    </div> <!--entry-->
    <?php if ($share == true) { mom_posts_share($post->ID, get_permalink($post->ID)); }  ?>
    <div class="clear"></div>
</div> <!--blog post-->
<?php } elseif ($style == 'g') { ?>
<?php
		if ($excerpt_length == '') {
				$excerpt_length = 190;
		}
?>
    <div <?php post_class("base-box blog-post default-blog-post bp-full-img $grid_class"); ?> itemscope itemtype="http://schema.org/Article">
    <div class="bp-entry">
		<?php if (mom_post_image() != false) { ?>
            <div class="post-img">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box_big'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
                <span class="post-format-icon"></span>
            </div> <!--img-->
	    <?php } ?>
        <div class="bp-head">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php mom_posts_meta('bp-meta'); ?>
        </div> <!--blog post head-->
        <div class="bp-details">
                                <P>
                                    <?php
                                            $excerpt = get_the_excerpt();
                                            if ($excerpt == false) {
                                            $excerpt = get_the_content();
                                            }
                                            
                                            echo wp_html_excerpt(strip_shortcodes($excerpt), $excerpt_length, '...');
                                    ?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                    <div class="clear"></div>
        </div> <!--details-->
    </div> <!--entry-->
    <?php if ($share == true) { mom_posts_share($post->ID, get_permalink($post->ID), false, true); } ?>
    <div class="clear"></div>
</div> <!--blog post-->
<?php } else { ?>
<?php
		if ($excerpt_length == '') {
				$excerpt_length = 190;
		}
		$share_off = '';
		if ($share == false) {
			$share_off = 'share-off';	
		}
?>
    <div <?php post_class("base-box blog-post default-blog-post bp-vertical-share ".$share_off); ?> itemscope itemtype="http://schema.org/Article">
    <div class="bp-entry">
        <div class="bp-head">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php mom_posts_meta('bp-meta'); ?>
        </div> <!--blog post head-->
        <div class="bp-details">
	<?php if (mom_post_image() != false) { ?>
            <div class="post-img">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('related-posts'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
                <span class="post-format-icon"></span>
            </div> <!--img-->
	    <?php } ?>
                <?php if ($full_post) { the_content(); } else { ?>
                                <P>
                                    <?php
                                            $excerpt = get_the_excerpt();
                                            if ($excerpt == false) {
                                            $excerpt = get_the_content();
                                            }
                                            
                                            echo wp_html_excerpt(strip_shortcodes($excerpt), $excerpt_length, '...');
                                    ?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                    <?php } ?>
        </div> <!--details-->
    </div> <!--entry-->
    <?php if ($share == true) { mom_posts_share($post->ID, get_permalink($post->ID), 'vertical', true); } ?>
    <div class="clear"></div>
</div> <!--blog post-->
<?php }
}

function mom_posts_timeline($custom_query='') { ?>
<div class="mom-timeline"  data-count="10">
		     <!--<div class="tl-years">-->
<?php
global $wp;
if ($custom_query == '') {
$wp->query_vars['posts_per_page'] = -1;
$custom_query = $wp->query_vars;

}
//print_r($custom_query);

$all_posts = get_posts($custom_query);

// this variable will contain all the posts in a associative array
// with three levels, for every year, month and posts.

$ordered_posts = array();

foreach ($all_posts as $single) {

  $year  = mysql2date('Y', $single->post_date);
  $month = mysql2date('F', $single->post_date);
  $monthmin = mysql2date('F', $single->post_date);
  $day = mysql2date('j', $single->post_date);

  // specifies the position of the current post
  $ordered_posts[$year][$month][$day][] = $single;

}

// iterates the years
foreach ($ordered_posts as $year => $months) { ?>
<!--  <div class="tl-year">
-->
    <!--<h3><?php echo $year ?></h3>-->

<!--    <div class="tl-months">-->
<?php foreach ($months as $month => $days ) { // iterates the moths ?>
		<?php
			$t_class = 'closed';
		?>
      <div class="tl-month <?php echo $t_class; ?>">
            <div class="tlm-title">
                <i class="handle brankic-icon-add"></i>
                <span class="month-name"><?php echo $month.', '.$year; ?></span>
            </div><!-- title -->

        <div class="tl-days">
          <?php foreach ($days as $day => $posts ) { // iterates the posts ?>
            <div class="tl-day">
		<div class="tld-title">
                    <span><?php echo $month.' '.$day; ?></span>
                </div>

        <ul class="tl-posts">
          <?php foreach ($posts as $single ) { // iterates the posts ?>

	      <li class="tl-post">
		<?php
		$is_img = '';
		if (mom_post_image('',$single->ID) != false) {
			$is_img = 'has-feature-image';
		?>
		<div class="post-img">
				<a href="<?php echo get_permalink($single->ID); ?>"><img src="<?php echo mom_post_image('small-wide', $single->ID); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd', $single->ID); ?>" alt="<?php the_title(); ?>"></a>
		</div>
		<?php } ?>
		<div class="details <?php echo $is_img; ?>">
				<h3><a href="<?php echo get_permalink($single->ID); ?>"><?php echo get_the_title($single->ID); ?></a></h3>
				<div class="tl-meta mom-post-meta">
				<span><?php echo mysql2date('g:i a', $single->post_date); ?></span>
				<?php
					$num_comments = get_comments_number($single->ID); // get_comments_number returns only a numeric value
						if ( comments_open() ) {
							if ( $num_comments == 0 ) {
								$comments = __('No Comments', 'theme');
							} elseif ( $num_comments > 1 ) {
								$comments = $num_comments . __(' Comments', 'theme');
							} else {
								$comments = __('1 Comment', 'theme');
							}
							$write_comments = '<a class="comment_number" href="' . get_comments_link($single->ID) .'">'. $comments.'</a>';
						} else {
							//$write_comments =  __('Comments off', 'theme');
							$write_comments = '';
						}
				?>
				<span><?php echo $write_comments; ?></span>
				</div>
				<?php
						$score = get_post_meta($single->ID,'_mom_review-final-score',true);
						if ($score != 0) {
						    echo '<div class="star-rating mom_review_score"><span style="width:'.$score.'%;"></span></div>';
						}
				?>
		</div>
		<div class="clear"></div>
		</li>

          <?php } // ends foreach $posts ?>
        </ul> <!-- ul.posts -->
		
            </div>
          <?php } // ends foreach $days ?>
        </div> <!-- ul.days -->

      </div>
    <?php } // ends foreach for $months ?>
    <!--</div>--> <!-- ul.months -->

 <!-- </div>--> <?php
} // ends foreach for $ordered_posts

?>
<!--</div>--><!-- ul.years -->
</div> <!--.mom-timeline-->

<!--<div class="tlin_event_handle"></div>-->
<?php }

function mom_elements_blog_posts($atts, $content) {
	extract(shortcode_atts(array(
	'style' => '',
	'share' => 'on',
	'display' => '',
	'category' => '',
	'tag' => '',
	'format' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'count' => 4,
	'excerpt_length' => '',
	'pagination' => 'on',
	'pagination_type' => '', // default, ajax, infinite scroll
	'load_more_count' => 3,
	'ad_id' => '',
	'ad_count' => 3,
	'ad_repeat' => '',
	), $atts));
	ob_start();

	if ($share == 'on') {
		$share = true;
	} else {
		$share = false;
	}
	$sm_format = $format;
	//orderby 
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} elseif ($orderby == 'random') {
		$orderby = 'rand';
	} else {
		$orderby = 'date';
	}
	//post format
	if ($format != '') {
		$format = explode(',',$format);
		$formats = array ();
		foreach ($format as $f) {
			$formats[] = 'post-format-'.$f;
		}
		$format = array(
				array(
				    'taxonomy' => 'post_format',
				    'field' => 'slug',
				    'terms' => $formats,
				    'operator' => 'IN'
				)
			);
	}
	?>

		<?php
       global $wp_query;
        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			'paged' => $paged,
			'cache_results' => false
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			'paged' => $paged,
			'cache_results' => false
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format,
				'paged' => $paged,
				'cache_results' => false
			); 
		}
		$post_count = 1;
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : ?>
		<?php if ($style == 'g') { ?> <div class="posts-grid clearfix"> <?php } ?>
		<?php while ( $query->have_posts() ) : $query->the_post();
				$grid_class = '';
				if ($style == 'g') {
						if ($post_count%2 == 0) {
								$grid_class = 'second';
						} else {
								$grid_class = '';
						}
				}
				mom_blog_post($style, $share, $excerpt_length, $grid_class);
				if ($ad_id != '') {
						if ($ad_repeat == 'yes') { 
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
		endwhile; ?>
		<?php if ($style == 'g') { ?> </div> <!--end post grid--> <?php } ?>
		<?php else: ?>
		<?php endif; ?>
		<?php if ($pagination == 'on' && $pagination_type == '') { mom_pagination($query->max_num_pages); } ?>
		<?php if ($pagination == 'on' && $pagination_type == 'ajax') { ?>
		<a href="#" class="button medium full show-more-posts" data-offset="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-style="<?php echo $style; ?>" data-share="<?php echo $share; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>" data-format="<?php echo $sm_format; ?>" data-excerpt_length="<?php echo $excerpt_length; ?>" data-load_more_count="<?php echo $load_more_count; ?>"><?php _e('Show More Posts','theme'); ?><i class="dashicons dashicons-update"></i></a>
		<?php } ?>
		<?php wp_reset_postdata(); ?>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('blog_posts', 'mom_elements_blog_posts');
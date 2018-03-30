<?php
//double arrows
	$da = '<i class="fa-icon-double-angle-right"></i>';
	if (is_rtl()) {
		$da = '<i class="fa-icon-double-angle-left"></i>';
	}
	$la = '<i class="fa-icon-long-arrow-right"></i>';
	if (is_rtl()) {
		$la = '<i class="fa-icon-long-arrow-left"></i>';
	}
	
/* ==========================================================================
       Feathure slider
   ========================================================================== */
function mom_elements_feature_slider($atts, $content) {

global $unique_posts;
global $do_unique_posts;


	extract(shortcode_atts(array(
	'display' => '',
	'category' => '',
	'tag' => '',
	'count' => 5,
	'orderby' => 'date', // recent, popular
	'caption' => 'on',
	'caption_style' => '', //1, 2
	'caption_length' => 110,
	'nav' => 'bullets', //bullets, thumbs, numbers
	'navigation' => 'true',
	'animation' => 'crossfade', //"none", "scroll", "directscroll", "fade", "crossfade", "cover", "cover-fade", "uncover" or "uncover-fade"
	'easing' => 'easeInOutCubic',
	'speed' => 600,
	'timeout' => 4000,
	'arrows' => 'on',
	'post_type' => ''
	
	), $atts));
	ob_start();
global $da;
global $la;
$img_size = 'big-wide-img';
$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'bigger-wide-img';
	$wide_class = 'fs-wide';
}


	$detect = new Mobile_Detect;
	if( $detect->isMobile()) {
		wp_enqueue_script('TSwipe');
	}

	//orderby 
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} else {
		$orderby = 'date';	
	}
	$rndn = rand(1,1000);
	//wp_enqueue_script('crf');
	//wp_enqueue_script('easing');

	?>
	<script>
		jQuery(document).ready(function($){
		
			$('.fc-nav-<?php echo $rndn; ?> li').each(function(i) {
				$(this).addClass( 'item'+i );
				$(this).click(function() {
					$('.fs-<?php echo $rndn; ?>').trigger( 'slideTo', [i, 0, true] );
				return false;
				});
			});
			$('.fc-nav-<?php echo $rndn; ?> li.item0').addClass( 'active' );
		
			var carou_items = 6;
			if ($(window).width() < 768) {
					carou_items = 5;
			}
			if ($(window).width() < 568) {
					carou_items = 4;
			}

			if ($(window).width() < 480 ) {
					carou_items = 2;
			}

			$(".fs-<?php echo $rndn; ?>").carouFredSel({
					circular: true,
                                        responsive: true,
					swipe: {
						onTouch: true,
						fx : 'scroll'
					},
					items: 1,
					auto: {
                                             play: true,
                                             duration: <?php echo $speed; ?>,
                                             timeoutDuration: <?php echo $timeout; ?>,
                                             },
					prev: '.fc-nav-<?php echo $rndn; ?> .fs-prev, .fs-dnav-<?php echo $rndn; ?> span.fsd-prev',
					next: '.fc-nav-<?php echo $rndn; ?> .fs-next, .fs-dnav-<?php echo $rndn; ?> span.fsd-next',
					pagination: '.fs-nav-<?php echo $rndn; ?>',
					scroll: {
						fx: '<?php echo $animation; ?>',
                                                  duration : <?php echo $speed; ?>,
                                                easing  : '<?php echo $easing; ?>',
						pauseOnHover : true,
                                        	onBefore: function() {
							var pos = $(this).triggerHandler( 'currentPosition' );
							$('.fc-nav-<?php echo $rndn; ?> li').removeClass( 'active' );
							$('.fc-nav-<?php echo $rndn; ?> li.item'+pos).addClass( 'active' );
							var page = Math.floor( pos / carou_items );
							$('.fc-nav-<?php echo $rndn; ?> ul').trigger( 'slideToPage', page );

						},
						onAfter: function() {
						}

					}
			});

			$(".fc-nav-<?php echo $rndn; ?> ul").carouFredSel({
						auto: false,
						circular:true,
                                        responsive: true,
						swipe: {
							onTouch: true
						},
						items: carou_items,
						scroll: {
							items:carou_items,
						}
			});			
		});

	</script>
	<div class="feature-slider base-box <?php echo $wide_class; ?>">
		<?php if ($arrows == 'on') {?>
		<div class="fs-drection-nav fs-dnav-<?php echo $rndn; ?>">
			<span class="fsd-prev"><i class="fa-icon-angle-left"></i></span>
			<span class="fsd-next"><i class="fa-icon-angle-right"></i></span>
		</div>
		<?php } else { ?>
		<div class="mom_visibility_mobile fs-drection-nav fs-dnav-<?php echo $rndn; ?>">
			<span class="fsd-prev"><i class="fa-icon-angle-left"></i></span>
			<span class="fsd-next"><i class="fa-icon-angle-right"></i></span>
		</div>
		<?php }?>
	<ul class="fslides fs-<?php echo $rndn; ?>">

		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
		); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
		); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'orderby' => $orderby,
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php if (mom_post_image() != false) {
			if ($nav != 'thumbs') {
			if ($unique_posts) {$do_unique_posts[] = get_the_ID();}
			}
			
		?>
                        <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                            <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($img_size); ?>" alt="<?php the_title(); ?>"></a>
			    <?php if ($caption != 'off') {
				if ($caption_style == 2) {
					$caption_style = 'fs-caption-alt';
				}
					$nav_class = ' nav-is-'.$nav;
				?>
                            <div class="slide-caption <?php echo $caption_style.$nav_class; ?>">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php if ($caption_length != 0) { ?>
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), $caption_length, '...');
					?>
				</P>
				<?php } ?>
                            </div>
			    <?php } ?>
                        </li>
			<?php } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                    </ul>
		    <?php if ($nav == 'thumbs') { ?>
                    <div class="fs-image-nav fc-nav-<?php echo $rndn; ?>">
			<span class="fs-prev"><i class="enotype-icon-arrow-left5"></i></span>
			<span class="fs-next"><i class="enotype-icon-arrow-right5"></i></span>
	<ul>
		<?php
		if ($display == 'category') {
			$args = array(
'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
		); 
		} elseif ($display == 'tag') {
			$args = array(
'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
		); 
		} else {
			$args = array(
'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'orderby' => $orderby,
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php if (mom_post_image() != false) { if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                       <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                            <img src="<?php echo mom_post_image('small-wide'); ?>" alt="<?php the_title(); ?>">
                        </li>
		<?php } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                    </ul>
		    </div>
		    <?php } else { ?>
                    <div class="fs-nav fs-nav-<?php echo $rndn; ?> <?php echo $nav; ?>"></div>
		    <?php } ?>
		
                </div> <!--fearure slider-->
<?php

	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('feature_slider', 'mom_elements_feature_slider');

/* ==========================================================================
       Scrolling Box
   ========================================================================== */
function mom_elements_scrolling_box($atts, $content) {
global $unique_posts;
global $do_unique_posts;

	extract(shortcode_atts(array(
	'title' => '',
	'display' => '',
	'category' => '',
	'tag' => '',
	'format' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'count' => 6,
	'excerpt_length' => 0,
	'items' => 4,
	'autoplay' => '',
	'timeout' => '5000',
	'post_type' => '',
	'header_background' => '',
	'header_text_color' => '',
	'hide_dots' => 'no',
	'navigation' => 'true',
	
	
	), $atts));
	ob_start();
global $da;
global $la;

	if ($autoplay == 'yes') {
		$autoplay = 'true';		
	} else {
		$autoplay = 'false';
	}

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
	// title & display
      if ($header_background != '') {
        $header_background = 'style="background:'.$header_background.';"';
      }
      if ($hide_dots == 'yes') {
        $hide_dots = 'background:none;';
      }
      if ($header_text_color != '') {
        $header_text_color = 'style="color:'.$header_text_color.';'.$hide_dots.'"';
      } else {
        $header_text_color = 'style="'.$hide_dots.';"';
      }
      
	$title_holder = '<span '.$header_background.'>'.$title.'</span>';
	$url = '';
	$rndn = rand(1,1000);
	if ($display == 'category') {
		$cat_data = get_category($category);
		if ($title == '') {
			$title = $cat_data->name;
			$url = get_category_link( $category );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == 'tag') {
		$tag_data = get_tag($tag);
		if ($title == '') {
			$title = $tag_data->name;
			$url = get_tag_link( $tag );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == '' && $title == '') {
		$title_holder = '<span '.$header_background.'>'.__('Recent Posts','theme').'</span>';
	}
	
	?>
	<script>
		jQuery(document).ready(function($){
				var rtl = false;
				<?php if (is_rtl()) { ?>
					rtl = true;
				<?php } ?>
			 $(".sb-content-<?php echo $rndn; ?>").owlCarousel({
				items: <?php echo $items; ?>,
				baseClass: 'mom-carousel',
				rtl: rtl,
				navigation: true,
				autoplay:<?php echo $autoplay; ?>,
				autoplayTimeout:<?php echo $timeout; ?>,
				autoplayHoverPause : true,				
				responsive:{	
				1000:{
				  items:<?php echo $items; ?>
				},

				671:{
				  items:3
				},
				
				480:{
				  items:2
				},
			    
				320:{
				  items:1
				}
					     }
			});
		});
	</script>
	<div class="nb_wrap scrolling_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box scrolling-box-wrap">
                    <div class="nb-content">
                        <div class="scrolling-box">
                            <div class="sb-content mom-carousel sb-content-<?php echo $rndn; ?>">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format
		); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format
			
		); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format
				
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                <div <?php post_class('sb-item'); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                   <div class="sb-item-img">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('scrolling-box'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                   </div>
				<?php } ?>
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php if ($excerpt_length != 0) { ?>
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
				   

                                </div> <!--sb item-->
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                            </div> <!--sb-content-->
                        </div> <!--scrolling box-->
                    </div>
                    <footer class="nb-footer">
                        
                    </footer>
                </div> <!--news box-->
	</div><!--End Wrap-->
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('scrolling_box', 'mom_elements_scrolling_box');

/* ==========================================================================
       News List
   ========================================================================== */
function mom_elements_news_list($atts, $content) {
global $unique_posts;
global $do_unique_posts;

	extract(shortcode_atts(array(
	'title' => '',
	'display' => '', //cat, tag
	'category' => '',
	'tag' => '',
	'format' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'image_size' => 'medium', //medium & big
	'count' => 4,
	'excerpt_length' => 150,
	'show_more' => '',
	'show_more_type' => 'ajax',
	'post_type' => '',
	'header_background' => '',
	'header_text_color' => '',
	'hide_dots' => '',

	), $atts));
	ob_start();
global $da;
global $la;
	$nl_class = '';
	$sm_format = $format;
	// image size
	if ($image_size == 'big') {
		$image_size = 'scrolling-box';
		$nl_class = 'nl-big';
	} else {
		$image_size = 'related-posts';
	}
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
	// title & display
      if ($header_background != '') {
        $header_background = 'style="background:'.$header_background.';"';
      }
      if ($hide_dots == 'yes') {
        $hide_dots = 'background:none;';
      }
      if ($header_text_color != '') {
        $header_text_color = 'style="color:'.$header_text_color.';'.$hide_dots.'"';
      } else {
        $header_text_color = 'style="'.$hide_dots.';"';
      }
      
	$title_holder = '<span '.$header_background.'>'.$title.'</span>';
	$url = '';
	$rndn = rand(1,1000);
	if ($display == 'category') {
		$cat_data = get_category($category);
		if ($title == '') {
			$title = $cat_data->name;
			$url = get_category_link( $category );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == 'tag') {
		$tag_data = get_tag($tag);
		if ($title == '') {
			$title = $tag_data->name;
			$url = get_tag_link( $tag );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == '' && $title == '') {
		$title_holder = '<span '.$header_background.'>'.__('Recent Posts','theme').'</span>';
	}
	
	?>
	<div class="nb_wrap news_list_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box">
                    <div class="nb-content">
                        <div class="news-list <?php echo $nl_class; ?>">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'tax_query' => $format,
			
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format,
			); 
		}

		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class('nl-item'); ?> itemscope itemtype="http://schema.org/Article">
			    <div class="base-box">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($image_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary <?php echo $is_img; ?>">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                    <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
					<?php mom_show_review_score(); ?>				   
                                   </div> <!--meta-->
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
                                </div>
			    </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                        </div> <!--news list-->
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="news_list" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>" data-format="<?php echo $sm_format; ?>" data-excerpt_length="<?php echo $excerpt_length; ?>" data-image_size="<?php echo $image_size; ?>"><?php _e('Show More','theme'); ?><?php echo $la; ?></a>
                    </footer>
		    <?php } ?>
                    
                </div> <!--news box-->
	</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('news_list', 'mom_elements_news_list');

/* ==========================================================================
 *                News Boxes
   ========================================================================== */
function mom_elements_news_boxes($atts, $content) {
global $unique_posts;
global $do_unique_posts;

	extract(shortcode_atts(array(
	'style' => '1',
	'title' => '',
	'display' => '', //category, tag, latest
	'category' => '',
	'tag' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'count' => '',
	'last' => '', //just for newsbox 2 columns
	'show_more' => '',
	'show_more_type' => 'ajax',
	'post_type' => '',
	'header_background' => '',
	'header_text_color' => '',
	'hide_dots' => '',
	
	), $atts));
	ob_start();
global $da;
global $la;
	if ($count == '') {
		switch ($style) {
			case '1':
				$count = 6;
			break;
			case '2':
				$count = 4;
			break;
			case '3':
				$count = 4;
			break;
			case 'two_cols':
				$count = 3;
			break;
			case '4':
				$count = 5;
			break;
			case 'floated_posts' :
				$count = 2;
			break;
		}
	}
	//orderby 
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} elseif ($orderby == 'random') {
		$orderby = 'rand';
	} else {
		$orderby = 'date';
	}
	// title & display
      if ($header_background != '') {
        $header_background = 'style="background:'.$header_background.';"';
      }
      if ($hide_dots == 'yes') {
        $hide_dots = 'background:none;';
      }
      if ($header_text_color != '') {
        $header_text_color = 'style="color:'.$header_text_color.';'.$hide_dots.'"';
      } else {
        $header_text_color = 'style="'.$hide_dots.';"';
      }
      
	$title_holder = '<span '.$header_background.'>'.$title.'</span>';
	$url = '';
	$rndn = rand(1,1000);
	if ($display == 'category') {
		$cat_data = get_category($category);
		if ($title == '') {
			$title = $cat_data->name;
			$url = get_category_link( $category );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == 'tag') {
		$tag_data = get_tag($tag);
		if ($title == '') {
			$title = $tag_data->name;
			$url = get_tag_link( $tag );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == '' && $title == '') {
		$title_holder = '<span '.$header_background.'>'.__('Recent Posts','theme').'</span>';
	}
	
	
	?>
<?php if($style == 2) { ?>
		<!--News box two-->
	<div class="nb_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
               <div class="news-box base-box nb-style2">
                    <div class="nb-content">
                      <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                                <div class="rn-title">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <span class="category"><?php _e('In', 'theme'); ?>: <?php the_category(', '); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                </div> <!--rn title-->
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box_big'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 240, '...');
					?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                  </div> <!--recent news-->

                            <div class="older-articles">
                                <ul class="two-cols">

		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                    <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                 <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
		 <?php } ?>
                                        <div class="details <?php echo $is_img; ?>">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
                                   </div> <!--meta-->
					<?php mom_show_review_score(); ?>				   
                                   </div>
                                    </li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

                                </ul>
                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
		    <?php } ?>
                    
                </div> <!--news box-->
	</div>
		<!--News box two-->	
<?php } elseif ($style == 3) { ?>
		<!--News box three-->
	<div class="nb_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
               <div class="news-box base-box nb-style3">
                    <div class="nb-content">
                            <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box3'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
					?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

                            </div> <!--recent news-->
                            <div class="older-articles">
                                <ul>
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                    <li itemscope itemtype="http://schema.org/Article">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                 <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
				<?php } ?>
                                        <div class="details <?php echo $is_img; ?>">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
                                   </div> <!--meta-->
					<?php mom_show_review_score(); ?>				   
                                   </div>
                                    </li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                                </ul>

                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
		    <?php } ?>
                    
                </div> <!--news box-->
	</div>
		<!--News box three-->	
<?php } elseif ($style == 4) { ?>
		<!--News box three-->
	<div class="nb_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
               <div class="news-box base-box nb-style3">
                    <div class="nb-content">
                            <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'posts_per_page' => 1,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('news_box3'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
					?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

                            </div> <!--recent news-->
                            <div class="older-articles">
                                <ul>
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                    <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
					<?php mom_show_review_score(); ?>				   
                                   </div> <!--meta-->
                                    </li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                                </ul>

                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
		    <?php } ?>
                    
                </div> <!--news box-->
	</div>
		<!--News box three-->	
<?php } elseif ($style == 'two_cols') {
	if ($last != '') {
		$last = 'last';
	}
	$img_size = 'news_box_big';
	$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'big-wide-img';
	$wide_class = ' nb2c-wide';
}	
	?>
		<!--News box 2 columns-->
	<div class="nb_wrap nb-style2 nb-2col <?php echo $last.$wide_class; ?>">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box base-box">
                    <div class="nb-content">
                            <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($img_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
					?>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
				</P>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
			    
                            </div> <!--recent news-->
                            <div class="older-articles">
                                <ul>
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                      <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
                 <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
		 <?php } ?>
                                        <div class="details <?php echo $is_img; ?>">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
                                   </div> <!--meta-->
					<?php mom_show_review_score(); ?>				   
					</div>
                                    </li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                                </ul>

                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
			<?php } ?>
                    
                </div> <!--news box-->
	</div>
		<?php if ($last != '') { ?>
			<div class="clear"></div>
		<?php } ?>
<?php } elseif ($style == 'four_cols') {
	if ($last != '') {
		$last = 'last';
	}
	$img_size = 'news_box_big';
	$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'big-wide-img';
	$wide_class = ' nb4c-wide';
}	
	?>
		<!--News box 4 columns-->
	<div class="nb_wrap nb-style4 nb-4col <?php echo $last.$wide_class; ?>">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box base-box">
                    <div class="nb-content">
                            <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($img_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
			    
                            </div> <!--recent news-->
                            <div class="older-articles">
                                <ul>
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                                      <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
				<?php
				$is_img = '';
				if (mom_post_image() != false) {
					$is_img = 'has-feature-image';
				?>
		 <?php } ?>
				<h4><a href="<?php the_permalink(); ?>"><i></i><?php the_title(); ?></a></h4>
                                    </li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                                </ul>

                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
			<?php } ?>
                    
                </div> <!--news box-->
	</div>
		<?php if ($last != '') { ?>
			<div class="clear"></div>
		<?php } ?>

		<!--News box 4 columns-->	
<?php }  elseif ($style == 'floated_posts') {
	if ($last != '') {
		$last = 'last';
	}
	$img_size = 'news_box_big';
	$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'big-wide-img';
	$wide_class = ' nb2c-wide';
}	
	?>
		<!--News box 2 columns-->
	<div class="nb_wrap nb-style5 nb-floated <?php echo $last.$wide_class; ?>">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box base-box">
                    <div class="nb-content">
                            <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class('nb_floated_box'); ?> itemscope itemtype="http://schema.org/Article">
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image($img_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 100, '...');
					?>
				</P>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
			    
                            </div> <!--recent news-->
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
			<?php } ?>
                    
                </div> <!--news box-->
	</div>
		<?php if ($last != '') { ?>
			<div class="clear"></div>
		<?php } ?>
		<!--News box 2 columns-->	
<?php } else {  // default news box?>
		<!--News box one-->
	<div class="nb_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
                <div class="news-box base-box nb-style1">
                    <div class="nb-content">
                      <div class="recent-news">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                            <article <?php post_class('nb_floated_box'); ?> itemscope itemtype="http://schema.org/Article">
                                <div class="rn-title">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                   <div class="mom-post-meta nb-item-meta">
                                <span datetime="<?php the_time('c'); ?>" class="entry-date"><?php mom_date_format(); ?></span>
                                    <span class="category"><?php _e('In', 'theme'); ?>: <?php the_category(', '); ?></span>
                                    <a href="<?php comments_link(); ?>" class="comment_number"><?php comments_number(__('No comments', 'theme'), __('1 Comment', 'theme'), __('% Comments')); ?></a>
				    <?php mom_show_review_score(); ?>
                                   </div> <!--meta-->
                                </div> <!--rn title-->
				<?php if (mom_post_image() != false) { ?>
                                <div class="news-image">
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('small-wide-hd'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a><span class="post-format-icon"></span>
                                </div>
				<?php } ?>
                                <div class="news-summary">
                                <P>
					<?php
						$excerpt = get_the_excerpt();
						if ($excerpt == false) {
						$excerpt = get_the_content();
						}
						
						echo wp_html_excerpt(strip_shortcodes($excerpt), 270, '...');
					?>
				</P>
				   <a href="<?php the_permalink(); ?>" class="read-more-link"><?php _e('Read more', 'theme'); ?> <?php echo $da; ?></a>
                                </div>
                            </article>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                  </div> <!--recent news-->

                            <div class="nb1-older-articles">
                                <ul class="two-cols">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
				'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
        <li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article"><?php echo $da; ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

                                </ul>
                            </div>
                    </div>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $count+1; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo $style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
		    <?php } ?>
                    
                </div> <!--news box-->
	</div>
		<!--News box one-->
	<?php } ?>

<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('news_box', 'mom_elements_news_boxes');

/* ==========================================================================
	media box
   ========================================================================== */
function mom_elements_media_box($atts, $content) {
global $unique_posts;
global $do_unique_posts;

	extract(shortcode_atts(array(
	'title' => __('Latest Media','theme'),
	'url' => '',
	'format' => 'audio,video,gallery',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	), $atts));
	ob_start();
global $da;
global $la;
	//orderby 
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} elseif ($orderby == 'random') {
		$orderby = 'rand';
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
	//title & display
	$title_holder = '<span>'.$title.'</span>';
	if ($url != '') {
		$title_holder = '<a href="'.$url.'">'.$title.'</a>';
	}

	
	?>
	<div class="nb_wrap">
                <div class="news-box base-box media-box">
                    <header class="nb-header">
                        <h2 class="nb-title"><?php echo $title_holder; ?></h2>
                    </header> <!--nb header-->
                    <div class="nb-content">
		<?php
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format
			); 
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
                        <div class="recent-media">
                            <img src="<?php echo MOM_IMG; ?>/demo/img.png" alt="">
                        </div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                        <div class="older-media">
                            <ul>
		<?php
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 4,
				'orderby' => $orderby,
				'order' => $sort,
				'tax_query' => $format
			); 
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>                              <li><a href="#"><img src="<?php echo MOM_IMG; ?>/demo/simg.png" alt=""></a></li>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                            </ul>
                        </div>
                    </div> <!--nb content-->
                    <footer class="nb-footer">
                        <a href="#" class="show-more"><?php _e('Show More', 'theme'); ?> <?php echo $la; ?> </a>
                    </footer>
                    
                </div> <!--news box --> 
	</div>

<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('media_box', 'mom_elements_media_box');

/* ==========================================================================
       News In pics
   ========================================================================== */
function mom_elements_news_in_pics($atts, $content) {
global $unique_posts;
global $do_unique_posts;

	extract(shortcode_atts(array(
	'title' => '',
	'style' => '',
	'display' => '',
	'category' => '',
	'tag' => '',
	'orderby' => 'date', // recent, popular, random
	'sort' => 'DESC', //DESC & ASC
	'count' => 18,
	'show_more' => '',
	'show_more_type' => 'ajax',
	'post_type' => '',
	'header_background' => '',
	'header_text_color' => '',
	'hide_dots' => '',
	

	), $atts));
	ob_start();
global $da;
global $la;
	if ($orderby == 'popular') {
		$orderby = 'comment_count';	
	} elseif ($orderby == 'random') {
		$orderby = 'rand';
	}
	
	// title & display
      if ($header_background != '') {
        $header_background = 'style="background:'.$header_background.';"';
      }
      if ($hide_dots == 'yes') {
        $hide_dots = 'background:none;';
      }
      if ($header_text_color != '') {
        $header_text_color = 'style="color:'.$header_text_color.';'.$hide_dots.'"';
      } else {
        $header_text_color = 'style="'.$hide_dots.';"';
      }
      
	$title_holder = '<span '.$header_background.'>'.$title.'</span>';
	$url = '';
	$rndn = rand(1,1000);
	if ($display == 'category') {
		$cat_data = get_category($category);
		if ($title == '') {
			$title = $cat_data->name;
			$url = get_category_link( $category );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == 'tag') {
		$tag_data = get_tag($tag);
		if ($title == '') {
			$title = $tag_data->name;
			$url = get_tag_link( $tag );
			$title_holder = '<a href="'.$url.'"'.$header_background.'>'.$title.'</a>';
		}
	}
	if ($display == '' && $title == '') {
		$title_holder = '<span '.$header_background.'>'.__('News In Pictures','theme').'</span>';
	}
		
$np_class = '';
if ($style == '2') {
	$np_class = 'nip-big';
	$count = 9;
}

	$img_size = 'news_in_pics_big';
	$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'big-wide-img';
	$wide_class = ' nip-wide';
}	

?>
	<div class="nb_wrap">
		<header class="nb-header" <?php echo $header_background; ?>>
                        <h2 class="nb-title" <?php echo $header_text_color; ?>><?php echo $title_holder; ?></h2>
                </header> <!--nb header-->
	          <div class="news-box base-box new-in-pics <?php echo $np_class.$wide_class; ?>">
                    <div class="nb-content">
		<?php if ($style == '2') { ?>
                            <div <?php post_class('nip-recent'); ?> itemscope itemtype="http://schema.org/Article">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 1,
			'cat' => $category,
			'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,		
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'post_type' => $post_type,'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'posts_per_page' => 1,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => 1,
				'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
				<?php if (mom_post_image() != false) { ?>
                                <a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image($img_size); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
				<?php } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>		
                            </div>
                            <div class="nip-grid">
                                <ul class="clearfix">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			'offset' => '1',
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			'offset' => '1',
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
						<?php if (mom_post_image() != false) { ?>
				<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                                <a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image('small-wide'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
				</li>
				<?php } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		</ul>
                            </div>
                            <div class="clear"></div>
		<?php } else { ?>
                            <div class="nip-grid">
                                <ul class="clearfix">
		<?php
		if ($display == 'category') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'cat' => $category,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} elseif ($display == 'tag') {
			$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
			'tag_id' => $tag,
			'orderby' => $orderby,
			'order' => $sort,
			); 
		} else {
			$args = array(
				'ignore_sticky_posts' => 1,
				'posts_per_page' => $count, 'post_type' => $post_type, 'cache_results' => false, 'no_found_rows' => true, 'post__not_in' => $do_unique_posts,
				'orderby' => $orderby,
				'order' => $sort,
			); 
		}
		$query = new WP_Query( $args ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ($unique_posts) {$do_unique_posts[] = get_the_ID();} ?>
				<?php if (mom_post_image() != false) { ?>
		<li <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
                                <a href="<?php the_permalink(); ?>" data-tooltip="<?php the_title(); ?>" class="simptip-position-top simptip-movable"><img src="<?php echo mom_post_image('news_in_pics'); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd'); ?>" alt="<?php the_title(); ?>"></a>
				</li>
				<?php } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
                                </ul>
                            </div>
		<?php } ?>
                    </div> <!--nb content-->
		<?php
		$offset = $count;
		if ($style == 2) {
			$offset = $count+1;
		}
		?>
		    <?php if ($show_more == 'on') { ?>
                    <footer class="nb-footer">
                        <a href="<?php echo $url; ?>" data-post_type="<?php echo $post_type; ?>" class="show-more-<?php echo $show_more_type; ?>" data-offset="<?php echo $offset; ?>" data-number_of_posts="<?php echo $count; ?>" data-display="<?php echo $display; ?>" data-category="<?php echo $category; ?>" data-tag="<?php echo $tag; ?>" data-nbs="<?php echo 'npic'.$style; ?>" data-sort="<?php echo $sort; ?>" data-orderby="<?php echo $orderby; ?>"><?php _e('Show More','theme'); ?> <?php echo $la; ?> </a>
                    </footer>
		<?php } ?>
                    
                </div> <!--news box -->
	</div>
<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;

	}

add_shortcode('news_in_pics', 'mom_elements_news_in_pics');
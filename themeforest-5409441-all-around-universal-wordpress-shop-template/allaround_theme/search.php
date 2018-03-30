<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

	get_header();
	global $allaround_data;
	if ( $allaround_data['sidebar-blog'] == 0 ) $class = " no-sidebar"; else $class = "";
?>
	<div class="clear"></div><!--clear -->	
	<?php allaround_breadcrumbs(); ?>
	<div class="content_wrapper">
		<div class="content<?php echo $class; ?>">
			<?php 
				global $wp_query;
				$number_of_posts = $wp_query -> found_posts;
				$header = '<span>' . __( 'Search results', 'allaround' ) . '</span> - ' . $number_of_posts . __( ' post/s found', 'allaround' );
				echo do_shortcode('[aa_title]' . $header . '[/aa_title]');
			?>
			<div class="real_content">
			<?php
				if ( $wp_query->have_posts() ) :
					$out = '';
					$firstrow = 0;
					$post_counter = 0;
					$type = $allaround_data['blog-type'];
					switch ($type) {
						case 1 :
							$columns = 1;
							$class = '';
							$words = 512;
						break;
						case 2 :
							$columns = 1;
							$class = ' blog2';
							$words = 256;
						break;
						case 3 :
							$columns = 1;
							$class = ' blog2 blog3';		
							$words = 256;
						break;
						case 4 :
							$columns = 2;
							$class = ' blog2 blog2-2col';		
							$words = 256;
						break;
						case 5 :
							$columns = 3;
							$class = ' index_preview blog2 blog2-2col';		
							$words = 192;
						break;
						case 6 :
							$class = ' blog2 blog3 blog3-2col';
							$columns = 2;
							$words = 256;
						break;
						case 7 :
							$class = ' blog2 blog3 blog3-3col';
							$columns = 3;
							$words = 256;
						break;
					}

					$out .= "<div class='blog_content type-{$type}'>";
					switch( $type ) {
						case 1 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
							$out .= '<div class="blog_post_wrapper">';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="blog_post_main_content">';
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
							if ( has_post_thumbnail()) {
								$out .= '<div class="blog_image_wrap"><div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-full', array('class' => 'blog_post_image')); 
								$out .= '</a>';
								$out .= '</div><!-- blog_image_wrap -->';
							 }
							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post_wrapper -->';
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more float_right button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post -->';
							$out .= $clear;
						endwhile;
						break;
						case 2 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_socials">
										<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
										<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
										<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
										</div><!-- image_socials -->';
								$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg"/>'; 
								$out .= '</a></div><!-- image_more_info -->';
								$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$out .= '</div><!-- image_wrapper -->';
							}
							$out .= '<div class="blog_post_main_content">';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';
							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 -->';
							$out .= $clear;
						endwhile;
						break;
						case 3 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
								$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
								$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
							}
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="blog_post_main_content">';
							$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
							$out .= $clear;
						endwhile;
						break;
						case 4 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_socials">
										<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
										<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
										<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
										</div><!-- image_socials -->';
								
								$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
								$out .= '</a></div><!-- image_more_info -->';
								$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$out .= '</div><!-- image_wrapper -->';
							}
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="blog_post_main_content">';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
							$out .= $clear;
						endwhile;
						break;
						case 5 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . '">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-231', array('class' => 'content_image'));
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_socials">
										<a href="http://www.facebook.com/sharer.php?u=' . get_permalink() . '&amp;t=' . get_the_title() . '" class="facebook-like fb" data-href="' . get_permalink() . '" data-send="false" data-layout="button_count" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/facebook.png" alt="fb" /></span></a>
										<a href="http://pinterest.com/pin/create/button/?url=' . get_permalink() . '&amp;media=' . $large_image_url[0] . '&amp;description=' . get_the_title() . '" class="pinterest-pinit pin" data-count-layout="horizontal" rel="nofollow" ><span><img src="' . get_template_directory_uri() . '/images/home/socials/pinterest.png" alt="pin" /></span></a>
										<a href="http://twitter.com/home/?status=' . get_the_title() . ' ' . get_permalink() . '" class="twitter-share tw" data-count-layout="horizontal" rel="nofollow" target="_blank"><span><img src="' . get_template_directory_uri() . '/images/home/socials/twitter.png" alt="tw" /></span></a>
										</div><!-- image_socials -->';
								
								$out .= '<div class="image_more_info"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
								$out .= '</a></div><!-- image_more_info -->';
								$out .= '<div class="date_bubble_holder"><div class="date customColorBg"><span>' . get_the_date('d') . '<span>' . get_the_date('M') . '</span></span></div><!-- date --><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$out .= '</div><!-- image_wrapper -->';
							}
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="blog_post_main_content">';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog4-->';
							$out .= $clear;
						endwhile;
						break;
						case 6 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top . '">';
							$out .= '<div class="blog_post_main_content">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
								$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
								$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper -->';
							}
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							
							$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="clear"></div>';

							$out .= '<span class="blog_post_text"><div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span><span class="date">' . get_the_date() . '</span><span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!-- blog_post blog2 blog3 -->';
							$out .= $clear;
						endwhile;
						break;
						case 7 :
						while( $wp_query->have_posts() ): $wp_query->the_post();
							$post_counter++;
							$excerpt = get_the_excerpt();
							if ( is_sticky() ) $sticky = __('<span>Sticky</span> - ', 'allaround'); else $sticky = '';
							if ( $firstrow == 0 ) { $top = ' top'; } else $top = '';
							if ( $post_counter == $columns ) { $post_counter = 0; $firstrow = 1; $last = ' last'; $clear = '<div class="clear"></div>'; } else { $last = ''; $clear = ''; }
							if ( !has_post_thumbnail()) $has_thumbail = ' no_thumbnail'; else $has_thumbail = '';
							$out .= '<div class="blog_post' . $class . $last . $has_thumbail . $top . '">';
							if ( has_post_thumbnail()) {
								$out .= '<div class="image_wrapper">';
								$out .= get_the_post_thumbnail(get_the_ID(), 'blog-148', array('class' => 'content_image'));
								$out .= '<div class="date_bubble_holder"><div class="comments customColorBg"><a href="' . get_permalink() . '" title="' . __('Comment on this post', 'allaround') . '">' . get_comments_number() . '</a></div><!-- comments --></div><!-- date_bubble_holder -->';
								$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
								$out .= '<div class="image_more_info small"><a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="prettyPhoto">';
								$out .= '<img src="' . get_template_directory_uri() . '/images/home/more.png" alt="" class="customColorBg" />'; 
								$out .= '</a></div><!-- image_more_info --></div><!-- image_wrapper --><div class="clear"></div><!-- clear -->';
							}
							if ( get_comments_number() == 1 ) $comments = __('Comment', 'allaround'); else $comments = __('Comments', 'allaround');
							$out .= '<div class="blog_post_main_content">';
							$out .= '<span class="category">' . get_the_category_list(', ') . '</span>';
							$out .= '<h3><a href="' . get_permalink() . '">'. $sticky . get_the_title() .'</a></h3>';
							$out .= '<div class="author_date_comments"><span class="author">' . get_the_author_meta('nickname') . '</span> | <span class="date">' . get_the_date() . '</span> | <span class="comments">' . get_comments_number() . ' ' . $comments . '</span></div><!-- author_date_comments -->';

							$out .= '<span class="blog_post_text">' . string_limit_words( $excerpt, $words ) . '</span><div class="clear"></div><!-- clear -->';				
							$out .= '<a href="' . get_permalink() . '" title="' . __('View', 'allaround') . ' ' . get_the_title() . '" class="read_more button_hover_effect">' . __('Read More', 'allaround') . '</a><!-- read_more --><div class="clear"></div><!-- clear --></div><!-- blog_post_main_content --><div class="clear"></div><!-- clear --></div><!--  blog_post blog2 blog3 -->';
							$out .= $clear;
						endwhile;
						break;
					}
					$out .=  '<div class="clear"></div>';
					$out .= allaround_pagination($wp_query->max_num_pages, $paged, 'no');
					$out .=  '</div><div class="clear"></div>';
					wp_reset_query();
					echo $out;
				endif;
				if ( $number_of_posts == 0 ) {
					_e('No posts were found for the searched critera. Search again or browse the latest archives.', 'allaround');
					get_search_form();
					echo do_shortcode('[aa_title]' . __('Posts', 'aa_allaround') . '[/aa_title][aa_blog type="4" rows="3" category="-1" order="rand" ajax="yes"]');
					echo do_shortcode('[aa_title]' . __('Products', 'aa_allaround') . '[/aa_title][aa_products rows="3" category="-1" order="rand" ajax="yes"]');
				}
			?>
			</div><!-- real_content -->
			<?php 
				if ( $allaround_data['sidebar-blog'] == 1 ) {
					echo '<!------- SIDEBAR ---------><div class="sidebar_wrapper margin-left48">';
					dynamic_sidebar( 'sidebar-blog' );
					echo '</div>';
				} 
			?>
			<div class="clear"></div>
		</div><!-- content -->
	<div class="divider padding-top48"></div>	
	</div><!-- content_wrapper -->
<?php get_footer(); ?>
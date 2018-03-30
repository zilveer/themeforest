<?php
/**
 * The template for displaying all single posts.
 *
 * @package News Stand
 */

get_header(); ?>

	<?php
		$single_style = $newsstand['newsstand_single_style'];
		$single_mostpopular = $newsstand['newsstand_single_mostpopular'];

		$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>

	<?php if ($single_mostpopular=='yes'): ?>
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
			<?php if ($single_style==1): ?>
				<section class="most-popular full-width">
			<?php else: ?>
				<section class="most-popular no-title">
			<?php endif ?>

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

		<?php wp_reset_query(); ?>
	<?php endif ?>

	<?php if ($single_style==1): ?>

		<section class="news-splitted blogpage">
		    <div class="container">
		        <div class="actual-container">
		            <div class="row">
		                <div class="col-md-9">

		                    <div class="col-title" style="border-color: #e6e6e6;"></div>

		                    <div class="post-single">
		                        <div class="post-info">
		                            <span><?php the_time($newsstand_dateformat); ?></span>
		                            <span><i class="fa fa-clock-o"></i>  <?php the_time($newsstand_timeformat); ?></span>
		                            <?php if (get_the_tags()!=''): ?>
		                            	<span><?php echo _e('Tags', 'newsstand'); ?>: <?php the_tags( ' ', ', ', '' ); ?></span>
		                            <?php endif ?>
		                            <?php if (!is_singular('video') && !is_singular('gallery')): ?>
		                            	<span><?php echo _e('Category', 'newsstand'); ?>: <?php echo get_the_category_list(', '); ?></span>
		                            <?php endif ?>
		                        </div>
		                        <h3 class="post-title"><?php the_title(); ?></h3>

		                        <?php if (is_singular('gallery')): ?>
    	                        	<?php
    	                        		$gallery_images = get_post_meta( get_the_ID(), 'newsstand_images', 1, true );
    	                        	?>

    								<?php if (isset($gallery_images) && !empty($gallery_images)): ?>
    									<div class="post-image gallery">
    									    <div class="pig-slider">
    									    	<?php foreach ($gallery_images as $image): ?>
    									    		<div><img src="<?php echo esc_url($image); ?>" alt=""></div>
    									    	<?php endforeach ?>
    									    </div>
    									</div>
    								<?php endif ?>
		                        <?php endif ?>

								<?php if (is_singular('video')): ?>
									<?php
										$video_url = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true );
										if (strpos($video_url,'vimeo') !== false) {
										    $id = substr(parse_url($video_url, PHP_URL_PATH), 1);
										    echo '<iframe src="//player.vimeo.com/video/'.$id.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
										} elseif(strpos($video_url,'youtube') !== false || strpos($video_url,'youtu.be') !== false) {
											$my_array_of_vars = array();
											parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
											$id = $my_array_of_vars['v'];
											echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe>';
										}
									?>

									<?php if (!empty($video_iframe)): ?>
										<div class="post-image video">
										    <?php echo apply_filters('the_content', $video_iframe); ?>
										</div>
									<?php endif ?>
								<?php endif ?>



		                        <?php if ('video' == get_post_format()): ?>

		                        	<?php
		                        		$video_iframe = get_post_meta( get_the_ID(), 'newsstand_post_video_iframe', 1, true );
		                        	?>

		                        	<?php if (!empty($video_iframe)): ?>
		                        		<div class="post-image video">
		                        		    <?php echo apply_filters('the_content', $video_iframe); ?>
		                        		</div>
		                        	<?php endif ?>

		                        <?php elseif('gallery' == get_post_format()): ?>

		                        	<?php
		                        		$gallery_images = get_post_meta( get_the_ID(), 'newsstand_post_gallery_images', 1, true );
		                        	?>

									<?php if (isset($gallery_images) && !empty($gallery_images)): ?>
										<div class="post-image gallery">
										    <div class="pig-slider">
										    	<?php foreach ($gallery_images as $image): ?>
										    		<div><img src="<?php echo esc_url($image); ?>" alt=""></div>
										    	<?php endforeach ?>
										    </div>
										</div>
									<?php endif ?>

								<?php elseif('audio' == get_post_format()): ?>

									<?php
										$audio_id = get_post_meta( get_the_ID(), 'newsstand_post_audio_id', 1, true );
									?>

									<?php if (!empty($audio_id)): ?>
										<div class="post-image soundcloud">
										    <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo esc_attr($audio_id); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
										</div>
									<?php endif ?>

								<?php elseif('quote' == get_post_format()): ?>

									<?php
										$quote_text = get_post_meta( get_the_ID(), 'newsstand_post_quote_text', 1, true );
										$quote_by = get_post_meta( get_the_ID(), 'newsstand_post_quote_by', 1, true );
										$quote_image = get_post_meta( get_the_ID(), 'newsstand_post_quote_image', 1, true );
									?>

									<?php if (!empty($quote_text)): ?>
										<div class="post-image quote" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
										    <div class="quote-inner">
										        <p><?php echo esc_htmL($quote_text); ?></p>
										        <?php if (!empty($quote_by)): ?>
										        	<span>- <?php echo esc_html($quote_by); ?></span>
										        <?php endif ?>
										    </div>
										    <?php if (!empty($quote_image)): ?>
										    	<div class="img-who" style="background-image: url(<?php echo esc_url($quote_image); ?>)"></div>
										    <?php endif ?>
										</div>
									<?php endif ?>

		                        <?php else: ?>
		                        	<?php if (has_post_thumbnail()): ?>
		                        		<?php if (!is_singular('video') && !is_singular('gallery')): ?>
		                        			<div class="post-image">
		                        			    <?php the_post_thumbnail(); ?>
		                        			</div>
		                        		<?php endif ?>
		                        	<?php endif ?>
		                        <?php endif ?>
		                        <div class="post-content">
		                            <?php the_content(); ?>

		                            <?php wp_link_pages(); ?>
		                        </div>

		                        <?php $post_title = get_the_title( $post->ID ); ?>

		                        <div class="social-share">
		                            <h3><?php _e('Social Share', 'newsstand'); ?></h3>
		                            <div class="sh-networks">
		                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
		                                <a href="https://twitter.com/home?status=<?php echo urlencode($post_title); ?>-<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
		                                <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
		                            </div>
		                        </div>

		                         <?php
		                         	$user_description =  get_the_author_meta( 'description' );
		                         	$user_url =  get_the_author_meta( 'url' );
		                         	$user_name =  get_the_author_meta( 'display_name' );
		                         	$user_position = get_user_meta( get_the_author_meta('ID'), 'newsstand_user_position', true);
		                         	$user_image = get_user_meta( get_the_author_meta('ID'), 'newsstand_user_photo', 1, 'medium' );
		                         ?>

		                         <?php if (!empty($user_description)): ?>
		                         	<div class="fp-title"><?php echo _e('About The Author', 'newsstand'); ?></div>
		                         	<div class="fp-content">
		                         	    <div class="maineditor-list">
		                         	        <div class="single">
		                         	            <div class="image" style="background-image: url(<?php echo esc_url($user_image); ?>);">
		                         	            	<?php if (!empty($user_url)): ?>
		                         	            		<a href="<?php echo esc_url($user_url); ?>" class="plus-hover"><span class="plus"></span></a>
		                         	            	<?php endif ?>
		                         	            </div>
		                         	            <div class="info">
		                         	                <span class="name"><?php echo esc_html($user_name); ?></span>
		                         	                <?php if (!empty($user_position)): ?>
		                         	                	<div class="desc"><?php echo esc_html($user_position); ?></div>
		                         	                <?php endif ?>
		                         	                <p><?php echo newsstand_limit($user_description, 350); ?></p>
		                         	            </div>
		                         	        </div><!-- end of single -->
		                         	    </div>
		                         	</div><!-- end of fp-content-->
		                         <?php endif ?>

		                         <?php wp_reset_query(); ?>

		                         <?php $tags = wp_get_post_tags($post->ID); ?>
		                         <?php if ($tags): ?>
		                         	<?php
		                         		$tag_ids = array();
		                         		foreach($tags as $individual_tag){
		                         			$tag_ids[] = $individual_tag->term_id;
		                         		}
		                         		$args = array(
		                         				'tag__in' => $tag_ids,
		                         				'posts_per_page'=> 3,
		                         				'ignore_sticky_posts'=> 1,
		                         				'post__not_in' => array($post->ID),
		                         			);
		                         		$my_query = new WP_Query($args);
		                         	?>
		                         	<?php if ($my_query->have_posts()): ?>

										<h3 class="fp-title"><?php echo _e('Related Posts', 'newsstand'); ?></h3>
										<div class="fp-content">

										    <div class="latestblog-list">

										        <div class="row">

										        	<?php while($my_query->have_posts()): $my_query->the_post(); ?>

										        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

										            <div class="col-sm-4">
										                <div class="single">
										                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
										                    	<a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
										                    </div>
										                    <div class="info">
										                        <span class="post-info">
										                            <span><?php the_time($newsstand_dateformat); ?></span>
										                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
										                        </span>
										                        <a href="javascript:void(null);" class="post-title"><?php the_title(); ?></a>
										                        <p><?php echo newsstand_excerpt(120); ?> </p>
										                    </div>
										                </div> <!-- end of row -->
										            </div><!-- end of col -->

										            <?php endwhile; ?>

										        </div>

										    </div>
										</div><!-- end of fp-content -->

		                         	<?php endif; ?>
		                         <?php endif; ?>

		                        <br><br><br>

		                        <?php
		                        	if (comments_open() || get_comments_number()) { ?>
		                        		<div class="styled-comments">
		                        			<?php comments_template(); ?>
		                        		</div>
		                        	<?php }
		                        ?>
		                    </div>

		                </div>
		                <div class="col-md-3 secondcol">
		                	<?php get_sidebar(); ?>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>

	<?php endif ?>

	<?php if ($single_style==2): ?>

		<div class="contact-block hasMap singlePost">

		    <div class="container">
		                            <?php if ('video' == get_post_format()): ?>
		                            	<div class="content-img video" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
		                            		<?php
		                            			$video_iframe = get_post_meta( get_the_ID(), 'newsstand_post_video_iframe', 1, true );
		                            		?>
		                            		<?php echo apply_filters('the_content', $video_iframe); ?>
		                            	</div>

		                            <?php elseif('gallery' == get_post_format()): ?>

		                            	<?php
		                            		$gallery_images = get_post_meta( get_the_ID(), 'newsstand_post_gallery_images', 1, true );
		                            	?>

		    							<?php if (isset($gallery_images) && !empty($gallery_images)): ?>
		    								<div class="content-img gallery">
		    								    <div class="pig-slider">
		    								        <?php foreach ($gallery_images as $image): ?>
		    								        	<div><img src="<?php echo esc_url($image); ?>" alt=""></div>
		    								        <?php endforeach ?>
		    								    </div>
		    								</div>
		    							<?php endif ?>

		    						<?php elseif('audio' == get_post_format()): ?>

		    							<?php
		    								$audio_id = get_post_meta( get_the_ID(), 'newsstand_post_audio_id', 1, true );
		    							?>

		    							<?php if (!empty($audio_id)): ?>
		    								<div class="content-img soundcloud" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
		    								    <iframe width="100%" height="250" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo esc_attr($audio_id); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
		    								</div>
		    							<?php endif ?>

		    						<?php elseif('quote' == get_post_format()): ?>

		    							<?php
		    								$quote_text = get_post_meta( get_the_ID(), 'newsstand_post_quote_text', 1, true );
		    								$quote_by = get_post_meta( get_the_ID(), 'newsstand_post_quote_by', 1, true );
		    								$quote_image = get_post_meta( get_the_ID(), 'newsstand_post_quote_image', 1, true );
		    							?>

		    							<?php if (!empty($quote_text)): ?>
		    								<div class="content-img quote" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
		    								    <div class="quote-inner">
		    								        <p><?php echo esc_htmL($quote_text); ?></p>
		    								        <?php if (!empty($quote_by)): ?>
		    								        	<span>- <?php echo esc_html($quote_by); ?></span>
		    								        <?php endif ?>
		    								    </div>
		    								</div>
		    							<?php endif ?>

		                            <?php else: ?>
		                            	<?php if (has_post_thumbnail()): ?>
		                            		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		                            		<div class="content-img" style="background-image: url(<?php echo esc_url($thumb_url); ?>)"></div>
		                            	<?php endif ?>
		                            <?php endif ?>

		        <div class="contact-content">
		            <div class="cc-content">
		                <div class="whitepart">
		                    <div class="post-info">
	                            <span><?php the_time($newsstand_dateformat); ?></span>
	                            <span><i class="fa fa-clock-o"></i>  <?php the_time($newsstand_timeformat); ?></span>
	                            <?php if (get_the_tags()!=''): ?>
	                            	<span><?php echo _e('Tags', 'newsstand'); ?>: <?php the_tags( ' ', ', ', '' ); ?></span>
	                            <?php endif ?>
	                            <?php if (!is_singular('video') && !is_singular('gallery')): ?>
	                            	<span><?php echo _e('Category', 'newsstand'); ?>: <?php echo get_the_category_list(', '); ?></span>
	                            <?php endif; ?>
	                        </div>
		                    <h1 class="page-title"><?php the_title(); ?></h1>
		                    <span class="written-by">
		                    	<?php $user_name =  get_the_author_meta( 'display_name' ); ?>
		                        <?php _e('Written by', 'newsstand'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php echo esc_html($user_name); ?></a>
		                    </span>
		                        <?php the_content(); ?>

		                        <?php wp_link_pages(); ?>

		                    <div class="social-share">
	                            <h3><?php _e('Social Share', 'newsstand'); ?></h3>
	                            <div class="sh-networks">
	                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
	                                <a href="https://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
	                                <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
	                            </div>
	                        </div>

		                    <?php
	                         	$user_description =  get_the_author_meta( 'description' );
	                         	$user_url =  get_the_author_meta( 'url' );
	                         	$user_name =  get_the_author_meta( 'display_name' );
	                         	$user_position = get_user_meta( get_the_author_meta('ID'), 'newsstand_user_position', true);
	                         	$user_image = get_user_meta( get_the_author_meta('ID'), 'newsstand_user_photo', 1, 'medium' );
	                         ?>

	                         <?php if (!empty($user_description)): ?>
	                         	<div class="fp-title"><?php echo _e('About The Author', 'newsstand'); ?></div>
	                         	<div class="fp-content">
	                         	    <div class="maineditor-list">
	                         	        <div class="single">
	                         	            <div class="image" style="background-image: url(<?php echo esc_url($user_image); ?>);">
	                         	            	<?php if (!empty($user_url)): ?>
	                         	            		<a href="<?php echo esc_url($user_url); ?>" class="plus-hover"><span class="plus"></span></a>
	                         	            	<?php endif ?>
	                         	            </div>
	                         	            <div class="info">
	                         	                <span class="name"><?php echo esc_html($user_name); ?></span>
	                         	                <?php if (!empty($user_position)): ?>
	                         	                	<div class="desc"><?php echo esc_html($user_position); ?></div>
	                         	                <?php endif ?>
	                         	                <p><?php echo newsstand_limit($user_description, 350); ?></p>
	                         	            </div>
	                         	        </div><!-- end of single -->
	                         	    </div>
	                         	</div><!-- end of fp-content-->
	                         <?php endif ?>

		                    <?php wp_reset_query(); ?>

		                         <?php $tags = wp_get_post_tags($post->ID); ?>
		                         <?php if ($tags): ?>
		                         	<?php
		                         		$tag_ids = array();
		                         		foreach($tags as $individual_tag){
		                         			$tag_ids[] = $individual_tag->term_id;
		                         		}
		                         		$args = array(
		                         				'tag__in' => $tag_ids,
		                         				'posts_per_page'=> 3,
		                         				'ignore_sticky_posts'=> 1,
		                         				'post__not_in' => array($post->ID),
		                         			);
		                         		$my_query = new WP_Query($args);
		                         	?>
		                         	<?php if ($my_query->have_posts()): ?>

										<h3 class="fp-title"><?php echo _e('Related Posts', 'newsstand'); ?></h3>
										<div class="fp-content">

										    <div class="latestblog-list">

										        <div class="row">

										        	<?php while($my_query->have_posts()): $my_query->the_post(); ?>

										        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

										            <div class="col-sm-4">
										                <div class="single">
										                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
										                    	<a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
										                    </div>
										                    <div class="info">
										                        <span class="post-info">
										                            <span><?php the_time($newsstand_dateformat); ?></span>
										                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
										                        </span>
										                        <a href="javascript:void(null);" class="post-title"><?php the_title(); ?></a>
										                        <p><?php echo newsstand_excerpt(120); ?> </p>
										                    </div>
										                </div> <!-- end of row -->
										            </div><!-- end of col -->

										            <?php endwhile; ?>

										        </div>

										    </div>
										</div><!-- end of fp-content -->

		                         	<?php endif; ?>
		                         <?php endif; ?>

		                    <br><br><br>
		                    <?php
		                    	if (comments_open() || get_comments_number()) { ?>
		                    		<div class="styled-comments">
		                    			<?php comments_template(); ?>
		                    		</div>
		                    	<?php }
		                    ?>
		                </div>

		            </div>
		        </div>
		    </div>

		</div>

	<?php endif ?>

<?php get_footer(); ?>

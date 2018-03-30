<?php
/**
 * The main template file for display single post page.
 *
 * @package WordPress
*/


get_header(); 

?>
		<br class="clear"/>

		<!-- Begin content -->
		<div id="content_wrapper">
			
			<div class="inner">
			
				<!-- Begin main content -->
				<div class="inner_wrapper">
				
					<div class="sidebar_content">
					
						<h2 class="widgettitle header"><?php the_title(); ?></h2>
					
<?php

if (have_posts()) : while (have_posts()) : the_post();

?>

						<!-- Begin each blog post -->
						<div class="post_wrapper">
						
							<?php
								if(has_post_thumbnail(get_the_ID(), 'blog_ft'))
								{
								    $image_id = get_post_thumbnail_id(get_the_ID());
								    $image_thumb = wp_get_attachment_image_src($image_id, 'blog_ft', true);
								    
								    
								  	$pp_blog_image_width = 600;
									$pp_blog_image_height = 250;
								}
							
								if(!empty($image_thumb))
								{
							?>
							
							<div class="post_img">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<img src="<?php echo $image_thumb[0]; ?>" alt="" class=""/>
								</a>
								
								<?php
								    if(isset($cats[0]))
								    {
								?>
								
								<div class="caption_cat"><?php echo $cats[0]['name']; ?></div>
								
								<?php
								    }
								?>
							</div>
							
							<?php
								}
							?>
							
							<div class="post_inner_wrapper">
							
							<div class="post_header_wrapper single">
								<br/>
								<div class="post_detail">
								
								<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
								<a href=""><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
								</div>
							</div>
							
							<?php
							$pp_blog_display_social = get_option('pp_blog_display_social');
							
							if(!empty($pp_blog_display_social)):
							?>
							<div class="post_social single">
								<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:80px; height:21px;" allowTransparency="true"></iframe>
								
								<a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
							</div>
							<?php
							endif; ?>
							
							<br class="clear"/><br/><hr/>
							
							<?php
								the_content();
							?>
							
							</div>
							
						</div>
						<!-- End each blog post -->
						
						<div class="post_wrapper">
						
						<?php
							$pp_blog_display_author = get_option('pp_blog_display_author');
							
							if($pp_blog_display_author)
							{
						?>
						
						<h2 class="widgettitle">Written by <?php the_author_link(); ?></h2>
							
						<div id="about_the_author">
							<div class="thumb"><?php echo get_avatar( get_the_author_meta('email'), '50' ); ?></div>
							<div class="description">
								<?php the_author_meta('description'); ?>
							</div>
						</div><br class="clear"/>
						
						<?php
							}
						?>
						
						<?php
							$pp_blog_display_related = get_option('pp_blog_display_related');
							
							if($pp_blog_display_related)
							{
						?>
						
						<?php
						//for use in the loop, list 5 post titles related to first tag on current post
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
						  $first_tag = $tags[0]->term_id;
						  $args=array(
						    'tag__in' => array($first_tag),
						    'post__not_in' => array($post->ID),
						    'showposts'=>3,
						    'caller_get_posts'=>1
						   );
						  $my_query = new WP_Query($args);
						  if( $my_query->have_posts() ) {
						  	echo '<h2 class="widgettitle">Related Posts</h2><br class="clear"/>';
						 ?>
						  
						  <div class="related_posts">
						  
						 <?php
						 	global $have_related;
						    while ($my_query->have_posts()) : $my_query->the_post();
						    $have_related = TRUE; 
						 ?>
						    <div class="each_item">
						    	<?php
						    		if(has_post_thumbnail($post->ID, 'related_post'))
									{
										$image_id = get_post_thumbnail_id($post->ID);
										$image_url = wp_get_attachment_image_src($image_id, 'related_post', true);
						    	?>
						    		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="" class="frame"/>
						    		</a><br/>
						    	<?php
						    		}
						    	?>
						    	<div class="content">
						    		<strong class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong>
						    		<br/>
									<span class="post_attribute"><?php echo get_the_time('F j, Y', $post->ID); ?></span>
						      	</div>
							</div>
						  <?php
								endwhile;
								    
								wp_reset_query();
						  ?>
						    </div>
						    <br class="clear"/>
						<?php
						  }
						}
						?>
						
						<?php
							} //end if show related
						?>

						<?php comments_template( '' ); ?>
						

<?php wp_link_pages(); endwhile; endif; ?>

						</div>

						</div>
					
					<div class="sidebar_wrapper">
						<?php
						    $twitter_id = get_option('pp_twitter_username');
						    $pp_facebook_username = get_option('pp_facebook_username');
						    
						    if(!empty($twitter_id) OR !empty($pp_facebook_username)):
						?>
						<div class="social_profile">
						    <div class="profile">
						    	<a href="<?php echo $pp_facebook_username; ?>">
						    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_facebook.png" alt="" class="alignleft social"/>
						    	</a>
						    	<h4><?php pp_facebook_fans(); ?></h4>
						    	<span class="count">fans</span>
						    </div>
						
						    <?php
						    	$pp_twitter_consumer_key = get_option('pp_twitter_consumer_key');
						    	$pp_twitter_consumer_secret = get_option('pp_twitter_consumer_secret');
						    	$pp_twitter_access_token = get_option('pp_twitter_access_token');
						    	$pp_twitter_access_token_secret = get_option('pp_twitter_access_token_secret');
						    ?>
						    <?php
						    	if(!empty($pp_twitter_consumer_key) && !empty($pp_twitter_consumer_secret) && !empty($pp_twitter_access_token) && !empty($pp_twitter_access_token_secret))
						    	{
						    ?>
						    <div class="profile">
						    	<a href="http://twitter.com/<?php echo $twitter_id; ?>">
						    		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_twitter.png" alt="" class="alignleft social"/>
						    	</a>
						    	<h4><?php pp_twitter_followers($pp_twitter_consumer_key, $pp_twitter_consumer_secret, $pp_twitter_access_token, $pp_twitter_access_token_secret); ?></h4>
						    	<span class="count">followers</span>
						    </div>
						    <?php
						    	}
						    ?>
						    
						     <br class="clear"/>
						</div>
						<?php
						    endif; 
						?>
						
						<div class="ads125_wrapper">
						    <?php
						        $pp_side_banner = get_option('pp_side_banner');
						    
						        if(!empty($pp_side_banner))
						        {
						        	echo stripslashes($pp_side_banner);
						        }
						    ?>
						</div>
					
						<div class="sidebar">
							
							<div class="content">
							
								<ul class="sidebar_widget">
									<?php dynamic_sidebar('Single Post Sidebar'); ?>
								</ul>
								
							</div>
						
						</div>
						<br class="clear"/>
					
						<div class="sidebar_bottom"></div>
					</div>
					
				</div>
				<!-- End main content -->
				
				<br class="clear"/>
			</div>
			
			<div class="bottom"></div>
			
		</div>
		<!-- End content -->

				

<?php get_footer(); ?>
<?php get_header(); ?>

<?php	
	
	$options = get_option('sf_dante_options');
	$default_sidebar_config = $options['default_sidebar_config'];
	$default_left_sidebar = $options['default_left_sidebar'];
	$default_right_sidebar = $options['default_right_sidebar'];
	
	$page_wrap_class = 'has-no-sidebar';
	
	global $sf_has_gallery;
	$sf_has_gallery = true;
	
	$same_category_navigation = false;
	if ( isset($options['same_category_navigation']) ) {
		$same_category_navigation = $options['same_category_navigation'];
	}
?>


<?php if (have_posts()) : the_post(); ?>
	
	<?php		
		$post_author = get_the_author_link();
		$post_date = get_the_date();
		$post_categories = get_the_category_list(', ');
		
		$figure = $main_slider = $thumb_slider = "";
		
		$gallery_images = rwmb_meta( 'sf_gallery_images', 'type=image&size=full-width-image-gallery');	
		$thumb_images = rwmb_meta( 'sf_gallery_images', 'type=image&size=thumb-square');	
	    
	    $figure .= '<div class="spb_gallery_widget">';
	    
		$main_slider .= '<div class="flexslider gallery-slider" data-transition="slide"><ul class="slides">'. "\n";
					
		foreach ( $gallery_images as $image ) {
		    $main_slider .= "<li><a href='{$image['url']}' class='view' rel='gallery-{$post->ID}'><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a>". "\n";
		    if ($image['caption'] != "") {
		    $main_slider .= '<p class="flex-caption">'.$image['caption'].'</p>';
		    }
		    $main_slider .= "</li>". "\n";
		}
														
		$main_slider .= '</ul></div>'. "\n";
			
		$thumb_slider .= '<div class="flexslider gallery-nav"><ul class="slides">'. "\n";
		
		foreach ( $thumb_images as $image ) {
		    $thumb_slider .= "<li><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></li>". "\n";
		}
		
		$thumb_slider .= '</ul></div>'. "\n";
		
		$figure .= $main_slider;
		$figure .= $thumb_slider;
		
		$figure .= '</div>';	
		
	?>
	
	<div class="container">
	
		<div class="inner-page-wrap <?php echo $page_wrap_class; ?> clearfix">
			
			<?php echo $figure; ?>
			
			<!-- OPEN article -->
			<article <?php post_class('clearfix row'); ?> id="<?php the_ID(); ?>" itemscope itemtype="http://schema.org/BlogPosting">
			
				<div class="page-content col-sm-12 clearfix">
					
					<ul class="post-pagination-wrap curved-bar-styling clearfix">
						<li class="prev"><?php next_post_link('%link', __('<i class="ss-navigateleft"></i> <span class="nav-text">%title</span>', 'swiftframework'), $same_category_navigation, '', 'gallery-category'); ?></li>
						<li class="next"><?php previous_post_link('%link', __('<span class="nav-text">%title</span><i class="ss-navigateright"></i>', 'swiftframework'), $same_category_navigation, '', 'gallery-category'); ?></li>
					</ul>
					
					<div class="post-info clearfix">
						<span><?php echo sprintf(__('Posted by <a href="%2$s" rel="author" itemprop="author">%1$s</a> on %3$s in %4$s', 'swiftframework'), $post_author, get_author_posts_url(get_the_author_meta( 'ID' )), $post_date, $post_categories); ?></span>
						<?php if ( comments_open() ) { ?>
						<div class="comments-likes">
							<div class="comments-wrapper"><a href="#comments"><i class="ss-chat"></i><span><?php comments_number(__('0 Comments', 'swiftframework'), __('1 Comment', 'swiftframework'), __('% Comments', 'swiftframework')); ?></span></a></div>
						</div>
						<?php } ?>
					</div>
																
					<section class="article-body-wrap">
						<div class="body-text clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							<div class="link-pages"><?php wp_link_pages(); ?></div>
						</div>
										
						<div class="tags-link-wrap clearfix">
							<?php if (has_tag()) { ?>
							<div class="tags-wrap"><?php _e("Tags:", "swiftframework"); ?><span class="tags"><?php the_tags(''); ?></span></div>
							<?php } ?>
						</div>
						
						<div class="share-links curved-bar-styling clearfix">
							<div class="share-text"><?php _e("Share this gallery:", "swiftframework"); ?></div>
							<ul>
								<li class="sf-love">
								<div class="comments-likes">
								<?php if (function_exists( 'lip_love_it_link' )) {
									echo lip_love_it_link(get_the_ID(), '<i class="ss-heart"></i>', '<i class="ss-heart"></i>', false);
								} ?>				
								</div>
								</li>
							    <li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="post_share_facebook" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i class="fa-facebook"></i></a></li>
							    <li class="twitter"><a href="https://twitter.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;" class="product_share_twitter"><i class="fa-twitter"></i></a></li>   
							    <li class="google-plus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa-google-plus"></i></a></li>
							    <li class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php if(function_exists('the_post_thumbnail')) echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo get_the_title(); ?>" onclick="javascript:window.open(this.href,
							      '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=320,width=600');return false;"><i class="fa-pinterest"></i></a></li>
								<li class="mail"><a href="mailto:?subject=<?php the_title(); ?>&body=<?php echo strip_tags(get_the_excerpt()); ?> <?php the_permalink(); ?>" class="product_share_email"><i class="ss-mail"></i></a></li>
							    <li class="page-link"><a class="permalink item-link" href="<?php the_permalink(); ?>"><i class="ss-link"></i></a></li>
							</ul>						
						</div>					
											
					</section>
									
					<?php if ( comments_open() ) { ?>
					<div id="comment-area">
						<?php comments_template('', true); ?>
					</div>
					<?php } ?>
				
				</div>
			
			<!-- CLOSE article -->
			</article>
					
		</div>
	
	</div>
	
<?php endif; ?>

<!--// WordPress Hook //-->
<?php get_footer(); ?>